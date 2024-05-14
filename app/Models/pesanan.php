<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'nama', 'status'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member', 'id');
    }
}
