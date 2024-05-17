<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // Hanya atribut yang didefinisikan di sini yang bisa diisi secara massal
    protected $fillable = [
        'nama_payment',
        'status',
    ];

    // Definisikan relasi dengan model Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order', 'id');
    }
}
