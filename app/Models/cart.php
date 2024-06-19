<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['id_member', 'id_barang', 'nama_barang', 'jumlah', 'total', 'is_checkout'];

    /**
     * Get the member that owns the cart.
     */
    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member', 'id');
    }

    /**
     * Get the product that owns the cart.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_barang', 'id');
    }
}
