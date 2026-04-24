<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class POSController extends Controller
{
    public function index(Request $request) 
    {
        $products = Product::orderBy('name')->get();
        $customers = Customer::orderBy('name')->get();
        
        $salesQuery = Sale::with(['customer', 'items.product']);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = $request->start_date . ' 00:00:00';
            $endDate   = $request->end_date . ' 23:59:59';
            $salesQuery->whereBetween('sale_date', [$startDate, $endDate]);
        }

        if ($request->filled('year')) {
            $salesQuery->whereYear('sale_date', $request->year);
        }
    
        $sales = $salesQuery->latest('sale_date')->paginate(10)->appends(request()->all());

        // 1. Ambil Produk Paling Laris (Top 5)
        $bestProducts = \App\Models\SaleItem::select('product_id', DB::raw('SUM(qty) as total_qty'))
        ->with('product')
        ->groupBy('product_id')
        ->orderByDesc('total_qty')
        ->take(5)
        ->get();

        // 2. Ambil Mitra/Pelanggan Paling Sering (Top 5)
        $topCustomers = \App\Models\Sale::select('customer_id', DB::raw('COUNT(*) as total_transaksi'), DB::raw('SUM(total_price) as total_spent'))
        ->whereNotNull('customer_id') // Hanya yang terdaftar sebagai mitra
        ->with('customer')
        ->groupBy('customer_id')
        ->orderByDesc('total_transaksi')
        ->take(5)
        ->get();
    
        return view('dashboard', [
            'products'    => $products,
            'customers'   => $customers,
            'sales'       => $sales,
            'bestProducts'  => $bestProducts,
            'topCustomers' => $topCustomers  
        ]);
    }

    // --- CRUD PRODUCT ---
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:1',
            'price' => 'required|integer|min:0',
        ]);

        // Logika agar tidak dobel: cari berdasarkan nama
        $product = Product::where('name', $request->name)->first();

        if ($product) {
            // Jika sudah ada, tambahkan stoknya
            $product->increment('stock', $request->stock);
            // Opsional: update harga ke harga terbaru
            $product->update(['price' => $request->price]);
            
            return redirect()->back()->with('success', 'Stok produk ' . $request->name . ' berhasil ditambah!');
        }

        // Jika belum ada, buat baru
        Product::create([
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price,
        ]);

        return redirect()->back()->with('success', 'Produk baru berhasil disimpan!');
    }

    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|integer|min:0',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'name'  => $request->name,
            'stock' => $request->stock,
            'price' => $request->price,
        ]);

        return redirect()->back()->with('success', 'Data produk berhasil diperbarui!');
    }

    public function deleteProduct(Product $product) 
    {
        if ($product->saleItems()->exists()) {
            return back()->with('error', 'Produk tidak bisa dihapus karena memiliki riwayat transaksi.');
        }
        
        $product->delete();
        return back()->with('success', 'Produk berhasil dihapus');
    }

    // --- CRUD CUSTOMER ---
    public function storeCustomer(Request $request) 
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        Customer::create($validated);
        return back()->with('success', 'Pelanggan berhasil ditambah');
    }

    public function updateCustomer(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update([
            'name'  => $request->name,
            'phone' => $request->phone,
        ]);

        return redirect()->back()->with('success', 'Data mitra ' . $request->name . ' berhasil diperbarui!');
    }

    public function deleteCustomer(Customer $customer) 
    {
        $customer->delete();
        return back()->with('success', 'Pelanggan berhasil dihapus');
    }

    // --- TRANSAKSI (SALE) ---
    public function storeSale(Request $request) 
    {
        // 1. Validasi Input (Pastikan 'items' benar-benar ada dan valid)
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.qty' => 'required|integer|min:1',
        ]);
    
        try {
            // 2. Gunakan DB Transaction
            return DB::transaction(function () use ($request) {
                $total = 0;
    
                // Buat Header Penjualan
                $sale = Sale::create([
                    'customer_id' => $request->customer_id,
                    'sale_date' => now(),
                    'total_price' => 0
                ]);
    
                foreach ($request->items as $item) {
                    // Gunakan lockForUpdate() agar stok tidak "balapan" jika ada 2 kasir klik bersamaan
                    $product = Product::lockForUpdate()->findOrFail($item['product_id']);
    
                    // 3. Cek Stok Produk
                    if ($product->stock < $item['qty']) {
                        // Pesan error lebih spesifik
                        throw new \Exception("Stok produk '{$product->name}' tidak mencukupi (Tersisa: {$product->stock})");
                    }
    
                    $subtotal = $product->price * $item['qty'];
    
                    // 4. Simpan Detail menggunakan relasi (lebih bersih)
                    $sale->items()->create([
                        'product_id' => $product->id,
                        'qty' => $item['qty'],
                        'subtotal' => $subtotal
                    ]);
    
                    // 5. Update Stok
                    $product->decrement('stock', $item['qty']);
                    $total += $subtotal;
                }
    
                // 6. Update Total Harga Akhir
                $sale->update(['total_price' => $total]);
    
                // Format angka untuk pesan sukses agar rapi
                $formattedTotal = number_format($total, 0, ',', '.');
                return back()->with('success', "Transaksi Berhasil! Total: Rp $formattedTotal");
            });
    
        } catch (\Exception $e) {
            // Balikkan input agar kasir tidak capek ketik ulang kalau stok cuma kurang satu barang
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
}