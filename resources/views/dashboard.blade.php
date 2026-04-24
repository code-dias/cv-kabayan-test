<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-green: #2D6A4F;
            --accent-green: #52B788;
            --light-bg: #f8fafc;
        }
        body { background-color: var(--light-bg); color: #334155; }
        
        .max-w-7xl { max-width: 80rem; margin: auto; }

        .nav-tabs .nav-link { color: #64748b; border: none; font-weight: 600; padding: 1rem 1.5rem; transition: 0.3s; font-size: 0.9rem; }
        .nav-tabs .nav-link.active { color: var(--primary-green); border-bottom: 3px solid var(--primary-green); background: transparent; }
        
        .card-stats { border-radius: 12px; border-left: 5px solid var(--primary-green); transition: 0.3s; background: white; }
        .card-stats:hover { transform: translateY(-3px); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); }
        
        .btn-primary { background-color: var(--primary-green); border: none; border-radius: 8px; font-weight: 600; }
        .btn-primary:hover { background-color: #1B4332; }
        .btn-success { background-color: var(--accent-green); border: none; border-radius: 8px; }
        
        .form-control, .form-select { border-radius: 8px; border: 1px solid #e2e8f0; font-size: 0.9rem; padding: 0.6rem; }
        .form-control:focus { border-color: var(--accent-green); box-shadow: 0 0 0 2px rgba(82, 183, 136, 0.1); }
        
        .table thead th { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b; padding: 1rem; border-top: none; }
        .table td { padding: 1rem; font-size: 0.9rem; vertical-align: middle; }

        .item-row { animation: slideIn 0.3s ease-out; }
        @keyframes slideIn { from { opacity: 0; transform: translateX(-10px); } to { opacity: 1; transform: translateX(0); } }
    </style>

    <div class="py-5">
        <div class="max-w-7xl px-4 sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm mb-4 d-flex align-items-center alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> 
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error') || $errors->any())
                <div class="alert alert-danger border-0 shadow-sm mb-4 d-flex align-items-center alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> 
                    <div>
                        {{ session('error') ?? 'Terdapat kesalahan pada input Anda:' }}
                        @if($errors->any())
                            <ul class="mb-0 small mt-1">
                                @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                            </ul>
                        @endif
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card card-stats shadow-sm border-0 mb-3">
                        <div class="card-body py-4 text-center text-md-start">
                            <h6 class="text-muted mb-2 text-uppercase small fw-bold">Penjualan Hari Ini</h6>
                            <h3 class="fw-bold mb-0" style="color: var(--primary-green)">Rp {{ number_format($sales->filter(function($sale) {return \Carbon\Carbon::parse($sale->sale_date)->isToday();})->sum('total_price'), 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-stats shadow-sm border-0 mb-3" style="border-left-color: var(--accent-green);">
                        <div class="card-body py-4 text-center text-md-start">
                            <h6 class="text-muted mb-2 text-uppercase small fw-bold">Stok Produk</h6>
                            <h3 class="fw-bold mb-0 text-dark">{{ $products->count() }} <span class="fs-6 fw-normal text-muted">Item</span></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-stats shadow-sm border-0 mb-3" style="border-left-color: #f59e0b;">
                        <div class="card-body py-4 text-center text-md-start">
                            <h6 class="text-muted mb-2 text-uppercase small fw-bold">Pelanggan Aktif</h6>
                            <h3 class="fw-bold mb-0 text-dark">{{ $customers->count() }} <span class="fs-6 fw-normal text-muted">Orang</span></h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-4 overflow-hidden border">
                <div class="border-bottom px-4 pt-2 bg-white">
                    <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                        <li class="nav-item"><button class="nav-link active" id="pos-tab" data-bs-toggle="tab" data-bs-target="#pos" type="button" role="tab"><i class="bi bi-cart3 me-2"></i>Kasir</button></li>
                        <li class="nav-item"><button class="nav-link" id="report-tab" data-bs-toggle="tab" data-bs-target="#report" type="button" role="tab"><i class="bi bi-journal-text me-2"></i>Laporan</button></li>
                        <li class="nav-item"><button class="nav-link" id="product-tab" data-bs-toggle="tab" data-bs-target="#product" type="button" role="tab"><i class="bi bi-box-seam me-2"></i>Inventaris</button></li>
                        <li class="nav-item"><button class="nav-link" id="customer-tab" data-bs-toggle="tab" data-bs-target="#customer" type="button" role="tab"><i class="bi bi-people me-2"></i>Pelanggan</button></li>
                    </ul>
                </div>

                <div class="tab-content p-4">
                    <div class="tab-pane fade show active" id="pos" role="tabpanel">
                        <div class="row g-4">
                            <div class="col-lg-8 border-end pe-lg-4">
                                <h6 class="fw-bold mb-4 text-dark"><i class="bi bi-plus-circle me-2 text-success"></i>Transaksi Baru</h6>
                                <form action="{{ route('pos.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="form-label small fw-bold text-muted">Pelanggan</label>
                                        <select name="customer_id" class="form-select border-2" required>
                                            <option value="">-- Pilih Nama Pelanggan --</option>
                                            @foreach($customers as $c) <option value="{{ $c->id }}" {{ old('customer_id') == $c->id ? 'selected' : '' }}>{{ $c->name }} ({{ $c->phone ?? '-' }})</option> @endforeach
                                        </select>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <label class="form-label small fw-bold text-muted mb-0">Daftar Barang Belanja</label>
                                        <button type="button" class="btn btn-sm btn-outline-success px-3" id="add-item-btn"><i class="bi bi-plus-lg me-1"></i> Item</button>
                                    </div>
                                    
                                    <div id="items-container">
                                        <div class="row g-2 mb-3 item-row">
                                            <div class="col-md-8">
                                                <select name="items[0][product_id]" class="form-select border-2" required>
                                                    <option value="">Cari Barang...</option>
                                                    @foreach($products as $p) <option value="{{ $p->id }}">{{ $p->name }} | Stok: {{ $p->stock }} | Rp {{ number_format($p->price, 0, ',', '.') }}</option> @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="number" name="items[0][qty]" class="form-control border-2 text-center fw-bold" value="1" min="1" required>
                                            </div>
                                            <div class="col-md-1 text-end">
                                                <button type="button" class="btn btn-link text-danger p-0 remove-item-btn"><i class="bi bi-x-circle fs-5"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary btn-lg w-100 mt-4 py-3 shadow-sm border-0">
                                        <i class="bi bi-check2-all me-2"></i> KONFIRMASI PEMBAYARAN
                                    </button>
                                </form>
                            </div>
                            <div class="col-lg-4 ps-lg-4 d-none d-lg-block">
                                <div class="p-4 bg-white rounded-4 border border-dashed shadow-sm">
                                    <h6 class="fw-bold mb-4 text-dark d-flex align-items-center">
                                        <i class="bi bi-info-circle-fill text-success me-2"></i> Panduan Transaksi
                                    </h6>
                                    
                                    <div class="d-flex mb-3">
                                        <div class="me-3">
                                            <span class="badge rounded-circle bg-light text-success border px-2 py-1">1</span>
                                        </div>
                                        <div>
                                            <h6 class="small fw-bold mb-1">Pilih Pelanggan</h6>
                                            <p class="text-muted small mb-0">Cari nama mitra atau pelanggan umum dari daftar yang tersedia.</p>
                                        </div>
                                    </div>
                                
                                    <div class="d-flex mb-3">
                                        <div class="me-3">
                                            <span class="badge rounded-circle bg-light text-success border px-2 py-1">2</span>
                                        </div>
                                        <div>
                                            <h6 class="small fw-bold mb-1">Input Barang & Qty</h6>
                                            <p class="text-muted small mb-0">Pilih produk dan tentukan jumlah. Gunakan tombol <span class="text-success fw-bold">+ Item</span> untuk barang lebih dari satu.</p>
                                        </div>
                                    </div>
                                
                                    <div class="d-flex mb-3">
                                        <div class="me-3">
                                            <span class="badge rounded-circle bg-light text-success border px-2 py-1">3</span>
                                        </div>
                                        <div>
                                            <h6 class="small fw-bold mb-1">Cek Stok & Harga</h6>
                                            <p class="text-muted small mb-0">Pastikan stok mencukupi (sistem akan menolak jika stok kurang dari permintaan).</p>
                                        </div>
                                    </div>
                                
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <span class="badge rounded-circle bg-light text-success border px-2 py-1">4</span>
                                        </div>
                                        <div>
                                            <h6 class="small fw-bold mb-1">Konfirmasi</h6>
                                            <p class="text-muted small mb-0">Klik tombol konfirmasi untuk memotong stok dan mencatat laporan secara otomatis.</p>
                                        </div>
                                    </div>        
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="tab-pane fade" id="report" role="tabpanel">
                        <div class="bg-light p-3 rounded-3 mb-4 border">
                            <form action="{{ route('dashboard') }}#report" method="GET" class="row g-2">
                                <div class="col-md-4">
                                    <label class="small fw-bold text-muted ms-1">Mulai Tanggal</label>
                                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="small fw-bold text-muted ms-1">Sampai Tanggal</label>
                                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="small fw-bold text-muted ms-1">Pilih Tahun</label>
                                    <select name="year" class="form-select">
                                        <option value="">Semua Tahun</option>
                                        @for($i = date('Y'); $i >= 2024; $i--)
                                            <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-1 d-flex align-items-end gap-1">
                                    <button type="submit" class="btn btn-dark w-100 py-2 shadow-sm"><i class="bi bi-search"></i></button>
                                    {{-- <a href="{{ route('dashboard') }}#report" class="btn btn-outline-secondary py-2 shadow-sm"><i class="bi bi-arrow-clockwise"></i></a> --}}
                                    <button type="button" onclick="printFullReport()" class="btn btn-danger w-100 py-2 shadow-sm" title="Cetak Laporan PDF">
                                        <i class="bi bi-file-earmark-pdf"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    
                        <div class="table-responsive">
                            <table class="table table-hover border">
                                <thead class="table-light">
                                    <tr>
                                        <th>Inv ID</th>
                                        <th>Tanggal Jual</th>
                                        <th>Pelanggan</th>
                                        <th class="text-end">Total Harga</th>
                                        <th class="text-center">Struk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($sales as $s)
                                    <tr>
                                        <td class="fw-bold text-dark">#INV-{{ $s->id }}</td>
                                        <td>{{ \Carbon\Carbon::parse($s->sale_date)->format('d/m/Y H:i') }}</td>
                                        <td>{{ $s->customer->name ?? 'Umum' }}</td>
                                        <td class="text-end fw-bold text-success">Rp {{ number_format($s->total_price, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-outline-dark px-3 rounded-pill" data-bs-toggle="modal" data-bs-target="#receiptModal{{ $s->id }}">
                                                <i class="bi bi-printer me-1"></i> Cetak
                                            </button>
                                            <x-receipt-modal :sale="$s" />
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="5" class="text-center py-5 text-muted small">Data transaksi tidak ditemukan.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="card border-1 shadow-sm rounded-3">
                                    <div class="card-header bg-white border-1 py-3">
                                        <h6 class="fw-bold mb-0 text-emerald-900">
                                            <i class="bi bi-fire text-danger me-2"></i>Produk Paling Laris
                                        </h6>
                                    </div>
                                    <div class="card-body p-0">
                                        <ul class="list-group list-group-flush">
                                            @forelse($bestProducts as $bp)
                                            <li class="list-group-item d-flex justify-content-between align-items-center py-3 border-0 border-bottom">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-light p-2 rounded-circle me-3 text-center" style="width: 40px;">
                                                        <i class="bi bi-box-seam text-emerald-700"></i>
                                                    </div>
                                                    <div>
                                                        <p class="mb-0 fw-bold">{{ $bp->product->name }}</p>
                                                        <small class="text-muted">Total terjual: {{ $bp->total_qty }} Unit</small>
                                                    </div>
                                                </div>
                                                <span class="badge bg-emerald-100 text-emerald-800 rounded-pill px-3">Top {{ $loop->iteration }}</span>
                                            </li>
                                            @empty
                                            <li class="list-group-item text-center py-4 text-muted small">Belum ada data produk.</li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <div class="card border-1 shadow-sm rounded-3">
                                    <div class="card-header bg-white border-1 py-3">
                                        <h6 class="fw-bold mb-0 text-emerald-900">
                                            <i class="bi bi-people-fill text-primary me-2"></i>Mitra / Pelanggan Teraktif
                                        </h6>
                                    </div>
                                    <div class="card-body p-0">
                                        <ul class="list-group list-group-flush">
                                            @forelse($topCustomers as $tc)
                                            <li class="list-group-item d-flex justify-content-between align-items-center py-3 border-0 border-bottom">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3 text-center" style="width: 40px;">
                                                        <i class="bi bi-person-check-fill text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <p class="mb-0 fw-bold">{{ $tc->customer->name }}</p>
                                                        <small class="text-muted">{{ $tc->total_transaksi }} Transaksi | Rp {{ number_format($tc->total_spent, 0, ',', '.') }}</small>
                                                    </div>
                                                </div>
                                                <i class="bi bi-trophy-fill text-warning fs-5"></i>
                                            </li>
                                            @empty
                                            <li class="list-group-item text-center py-4 text-muted small">Belum ada data pelanggan.</li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="mt-4 d-flex justify-content-between align-items-center">
                            <div class="small text-muted">
                                Menampilkan {{ $sales->firstItem() ?? 0 }} sampai {{ $sales->lastItem() ?? 0 }} dari {{ $sales->total() }} transaksi
                            </div>
                            <div>
                                {{ $sales->links() }}
                            </div>
                        </div>
                    </div>
                    
                    {{-- // PRODUK // --}}
                    <div class="tab-pane fade" id="product" role="tabpanel">
                        <form action="{{ route('product.store') }}#product" method="POST" class="row g-2 mb-4 bg-light p-3 rounded-3 border">
                            @csrf
                            <div class="col-md-4">
                                <input type="text" name="name" id="product_name" class="form-control fw-bold" 
                                       placeholder="Ketik Nama Barang..." list="product-list" required autocomplete="off">
                                
                                <datalist id="product-list">
                                    @foreach($products as $p)
                                        <option value="{{ $p->name }}">
                                    @endforeach
                                </datalist>
                            </div>
                            
                            <div class="col-md-3">
                                <input type="number" name="stock" class="form-control" placeholder="Qty Stok Tambahan" required min="1">
                            </div>
                            
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text small">Rp</span>
                                    <input type="number" name="price" class="form-control" placeholder="Harga Satuan" required>
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-success w-100 fw-bold shadow-sm">
                                    <i class="bi bi-save me-1"></i> SIMPAN
                                </button>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-hover border">
                                <thead class="table-light"><tr><th>Produk</th><th>Status Stok</th><th>Harga Unit</th><th class="text-center">Opsi</th></tr></thead>
                                <tbody>
                                    @foreach($products as $p)
                                    <tr>
                                        <td class="fw-bold">{{ $p->name }}</td>
                                        <td>
                                            @if($p->stock <= 5) 
                                                <span class="badge bg-danger rounded-pill px-3">Kritis: {{ $p->stock }}</span>
                                            @else 
                                                <span class="badge bg-light text-success border border-success rounded-pill px-3">Aman: {{ $p->stock }}</span> 
                                            @endif
                                        </td>
                                        <td class="fw-bold text-dark">Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <button type="button" class="btn btn-link text-primary p-0" data-bs-toggle="modal" data-bs-target="#editProduct{{ $p->id }}">
                                                    <i class="bi bi-pencil-square fs-5"></i>
                                                </button>
                                
                                                <form action="{{ route('product.delete', $p->id) }}#product" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-link text-danger p-0"><i class="bi bi-trash fs-5"></i></button>
                                                </form>
                                            </div>
                                
                                            <div class="modal fade" id="editProduct{{ $p->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content border-0 shadow">
                                                        <div class="modal-header bg-emerald-600 text-white border-0">
                                                            <h5 class="modal-title fw-bold"><i class="bi bi-pencil-square me-2"></i>Edit Produk</h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('product.update', $p->id) }}#product" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body p-4 text-start">
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-bold small text-muted">NAMA PRODUK</label>
                                                                    <input type="text" name="name" class="form-control fw-bold" value="{{ $p->name }}" required>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6 mb-3">
                                                                        <label class="form-label fw-bold small text-muted">STOK SAAT INI</label>
                                                                        <input type="number" name="stock" class="form-control" value="{{ $p->stock }}" required>
                                                                    </div>
                                                                    <div class="col-md-6 mb-3">
                                                                        <label class="form-label fw-bold small text-muted">HARGA SATUAN (Rp)</label>
                                                                        <input type="number" name="price" class="form-control" value="{{ $p->price }}" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer border-0 bg-light">
                                                                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-success px-4 fw-bold shadow-sm">SIMPAN PERUBAHAN</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- // PELANGGAN // --}}
                    <div class="tab-pane fade" id="customer" role="tabpanel">
                        <form action="{{ route('customer.store') }}#customer" method="POST" class="row g-3 mb-4 bg-light p-3 rounded-3 border">
                            @csrf
                            <div class="col-md-5"><input type="text" name="name" class="form-control fw-bold" placeholder="Nama Lengkap Mitra" required></div>
                            <div class="col-md-5"><input type="text" name="phone" class="form-control" placeholder="No. Telp / WhatsApp"></div>
                            <div class="col-md-2"><button type="submit" class="btn btn-success w-100 fw-bold">TAMBAH</button></div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-hover border">
                                <thead class="table-light"><tr><th>Nama Mitra</th><th>Kontak</th><th class="text-center">Aksi</th></tr></thead>
                                <tbody>
                                    @foreach($customers as $c)
                                    <tr>
                                        <td class="fw-bold">{{ $c->name }}</td>
                                        <td>
                                            @if($c->phone)
                                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $c->phone) }}" target="_blank" class="text-success text-decoration-none">
                                                    <i class="bi bi-whatsapp me-2"></i>{{ $c->phone }}
                                                </a>
                                            @else
                                                <span class="text-muted small">- Tidak ada kontak -</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <button type="button" class="btn btn-link text-primary p-0" data-bs-toggle="modal" data-bs-target="#editCustomer{{ $c->id }}">
                                                    <i class="bi bi-pencil-square fs-5"></i>
                                                </button>
                                
                                                <form action="{{ route('customer.delete', $c->id) }}#customer" method="POST" onsubmit="return confirm('Hapus data mitra ini?')">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-link text-danger p-0"><i class="bi bi-trash fs-5"></i></button>
                                                </form>
                                            </div>
                                
                                            <div class="modal fade" id="editCustomer{{ $c->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content border-0 shadow">
                                                        <div class="modal-header bg-emerald-600 text-white border-0">
                                                            <h5 class="modal-title fw-bold"><i class="bi bi-person-gear me-2"></i>Edit Data Mitra</h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('customer.update', $c->id) }}#customer" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body p-4 text-start">
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-bold small text-muted">NAMA LENGKAP MITRA</label>
                                                                    <input type="text" name="name" class="form-control fw-bold" value="{{ $c->name }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-bold small text-muted">NOMOR TELEPON / WHATSAPP</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text bg-light"><i class="bi bi-telephone"></i></span>
                                                                        <input type="text" name="phone" class="form-control" value="{{ $c->phone }}" placeholder="Contoh: 08123456789">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer border-0 bg-light">
                                                                <button type="button" class="btn btn-secondary px-4 shadow-sm" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-success px-4 fw-bold shadow-sm">SIMPAN PERUBAHAN</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="fullReportArea" class="d-none">
            <div class="p-5">
                <div class="text-center mb-4">
                    <h2 class="fw-bold">LAPORAN PENJUALAN</h2>
                    <h4 class="text-success">CV KABAYAN GROUP</h4>
                    <p class="text-muted">Periode: {{ request('start_date') ?? '-' }} s/d {{ request('end_date') ?? date('d/m/Y') }}</p>
                    <hr>
                </div>
        
                <table class="table table-bordered w-100">
                    <thead>
                        <tr class="bg-light">
                            <th>No. Invoice</th>
                            <th>Tanggal</th>
                            <th>Pelanggan</th>
                            <th class="text-end">Total Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $grandTotal = 0; @endphp
                        @foreach($sales as $s)
                        <tr>
                            <td>#INV-{{ $s->id }}</td>
                            <td>{{ \Carbon\Carbon::parse($s->sale_date)->format('d/m/Y H:i') }}</td>
                            <td>{{ $s->customer->name ?? 'Umum' }}</td>
                            <td class="text-end">Rp {{ number_format($s->total_price, 0, ',', '.') }}</td>
                        </tr>
                        @php $grandTotal += $s->total_price; @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="fw-bold bg-light">
                            <td colspan="3" class="text-center">GRAND TOTAL</td>
                            <td class="text-end text-success">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
        
                <div class="mt-5 d-flex justify-content-between">
                    <div class="text-center" style="width: 200px;">
                        <p class="mb-5">Admin Kasir,</p>
                        <br>
                        <p class="fw-bold border-top pt-2">{{ Auth::user()->name }}</p>
                    </div>
                    <div class="text-center" style="width: 200px;">
                        <p class="mb-5">Dicetak pada,</p>
                        <br>
                        <p class="text-muted">{{ date('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // FUNGSI TAMBAH ITEM (DIPERBAIKI DENGAN DATA DINAMIS LARAVEL)
        let itemIndex = 1;
        document.getElementById('add-item-btn').addEventListener('click', function() {
            const container = document.getElementById('items-container');
            const newRow = document.createElement('div');
            newRow.className = 'row g-2 mb-3 item-row';
            newRow.innerHTML = `
                <div class="col-md-8">
                    <select name="items[${itemIndex}][product_id]" class="form-select border-2" required>
                        <option value="">Pilih Produk...</option>
                        @foreach($products as $p) 
                            <option value="{{ $p->id }}">{{ $p->name }} | Stok: {{ $p->stock }} | Rp {{ number_format($p->price, 0, ',', '.') }}</option> 
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" name="items[${itemIndex}][qty]" class="form-control border-2 text-center fw-bold" value="1" min="1" required>
                </div>
                <div class="col-md-1 text-end">
                    <button type="button" class="btn btn-link text-danger p-0 remove-item-btn"><i class="bi bi-x-circle fs-5"></i></button>
                </div>
            `;
            container.appendChild(newRow);
            itemIndex++;
        });

        // HAPUS ITEM
        document.addEventListener('click', function(e) {
            if(e.target.closest('.remove-item-btn')) {
                const row = e.target.closest('.item-row');
                if (document.querySelectorAll('.item-row').length > 1) {
                    row.remove();
                }
            }
        });

        // PERSISTENSI TAB SETELAH RELOAD (MENGGUNAKAN HASH URL)
        document.addEventListener("DOMContentLoaded", function() {
            let activeTab = window.location.hash;
            if (activeTab) {
                let tabEl = document.querySelector(`button[data-bs-target="${activeTab}"]`);
                if (tabEl) {
                    bootstrap.Tab.getOrCreateInstance(tabEl).show();
                }
            }

            const tabLinks = document.querySelectorAll('button[data-bs-toggle="tab"]');
            tabLinks.forEach(link => {
                link.addEventListener('shown.bs.tab', function (e) {
                    window.location.hash = e.target.getAttribute('data-bs-target');
                });
            });
        });

        // CETAK STRUK
        function printReceipt(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            var printStyle = `
                <style>
                    body { font-family: 'Courier New', Courier, monospace; width: 80mm; margin: 0 auto; padding: 10px; }
                    .table { width: 100%; border-collapse: collapse; }
                    .text-center { text-align: center; }
                    .text-end { text-align: right; }
                    .fw-bold { font-weight: bold; }
                    .mb-0 { margin-bottom: 0; }
                    .border-bottom { border-bottom: 1px dashed #000; }
                    @page { size: 80mm auto; margin: 0; }
                </style>
            `;

            document.body.innerHTML = printStyle + printContents;
            window.print();

            document.body.innerHTML = originalContents;
            location.reload(); 
        }

        // CETAK LAPORAN PDF
        function printFullReport() {
            const reportContents = document.getElementById('fullReportArea').innerHTML;
            const originalBody = document.body.innerHTML;

            // Styling khusus kertas A4 Portrait
            const reportStyles = `
                <style>
                    @media print {
                        body { margin: 0; padding: 0; font-family: 'Arial', sans-serif; background: white; }
                        #fullReportArea { display: block !important; }
                        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                        .table th, .table td { border: 1px solid #dee2e6; padding: 12px; font-size: 12px; }
                        .text-end { text-align: right; }
                        .text-center { text-align: center; }
                        .fw-bold { font-weight: bold; }
                        .text-success { color: #2D6A4F !important; }
                        @page { size: A4; margin: 1.5cm; }
                        /* Sembunyikan semua elemen dashboard kecuali area laporan */
                        header, nav, .max-w-7xl, footer, .btn, .modal { display: none !important; }
                    }
                </style>
            `;

            document.body.innerHTML = reportStyles + reportContents;
            window.print();
            
            // Kembalikan tampilan ke normal
            window.location.reload(); 
        }
    </script>
</x-app-layout>