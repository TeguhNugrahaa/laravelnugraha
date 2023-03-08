<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class slider extends Model
{
    use HasFactory;
    /* menampilkan fillable */
    protected $fillable = [
        'title',
        'description',
        'image',
    ];
}
