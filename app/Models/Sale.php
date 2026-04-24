<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'sale_date', 'total_price'];

    // Relasi: Transaksi dimiliki oleh satu pelanggan
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relasi: Satu nota transaksi punya banyak baris barang (items)
    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }
}