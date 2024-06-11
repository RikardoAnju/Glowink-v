<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // Tabel yang digunakan oleh model ini (opsional jika nama tabelnya tidak konvensional)
    // protected $table = 'payments';

    // Nonaktifkan timestamp jika tidak digunakan
    public $timestamps = false;

    // Atribut yang dapat diisi secara massal
    protected $fillable = [
        'id_order',
        'id_member',
        'total',
        'provinsi',
        'kabupaten',
        'detail_alamat',
        'status',
        'payment_token',
        'checkout_link',
    ];

    // Relasi dengan model Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order', 'id');
    }

    // Relasi dengan model Member
    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member', 'id');
    }

    // Jika ada kebutuhan untuk memformat data ketika diambil dari database
    // public function getStatusAttribute($value)
    // {
    //     return ucfirst($value); // Contoh: 'pending' menjadi 'Pending'
    // }

    // Jika ada kebutuhan untuk memformat data sebelum disimpan ke database
    // public function setTotalAttribute($value)
    // {
    //     $this->attributes['total'] = round($value, 2); // Contoh: pastikan total adalah angka desimal
    // }
}
