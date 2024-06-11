<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = ['nama_barang']; // Tambahkan 'nama_barang' ke dalam $fillable jika ingin mengisinya secara massal

    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member', 'id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'id_order', 'id');
    }
}
