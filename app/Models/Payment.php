<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_order',
        'nama_barang', // Menggunakan id_produk sebagai pengganti id_member
        'total',
        'provinsi',
        'kabupaten',
        'detail_alamat',
        'email',
        'status',
        'payment_token',
        'checkout_link',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    // Mengubah relasi dengan model Member
    public function OrderDetail()
    {
        return $this->belongsTo(Member::class, 'id_produk', 'id'); // Sesuaikan dengan nama kolom dalam tabel members
    }
}
