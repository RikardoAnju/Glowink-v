<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Tambahkan properti yang diperlukan, seperti table name, fillable fields, dll.
    protected $fillable = ['title', 'content'];
}

