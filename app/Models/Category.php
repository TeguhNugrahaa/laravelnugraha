<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    /* menampilkan use SoftDeletes */
    use SoftDeletes;
    /* menampilkan tabel categories */
    //protected $table = 'categories';

    /* menampilkan fillable */
    protected $fillable = [
        'id_user',
        'name_category',
    ];


    //Hasone untuk ngambil satu per satu data di table yang mau dijoin table category
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }


    //BelongsTo untuk ngambil satu per satu data di table yang mau dijoin table category
    //public function user()
    //{
    //return $this->belongsTo(User::class, 'id', 'id_user');
    //}
}
