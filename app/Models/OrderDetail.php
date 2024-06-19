<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'orders_details';

    // Definisikan relasi belongsTo ke model Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order');
    }
}
