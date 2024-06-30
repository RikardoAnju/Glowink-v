<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_member',
        'tanggal_lahir',
        'email',
        'jenis_kelamin',
        'pekerjaan',
        'alamat',
        'foto_profile',
    ];
}
