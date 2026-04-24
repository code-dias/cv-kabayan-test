<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;

    protected $fillable = ['sale_id', 'product_id', 'qty', 'subtotal'];

    // Relasi balik ke nota
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    // Relasi ke produk untuk mengambil nama barang
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}