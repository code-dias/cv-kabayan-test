<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone'];

    // Relasi: Satu pelanggan bisa punya banyak transaksi
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}