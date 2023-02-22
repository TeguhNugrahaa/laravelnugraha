<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Multipic extends Model
{
    use HasFactory;

    /* menampilkan fillable */
    protected $fillable = [
        'image',
    ];

    public function getImageUrlAttribute()
    {
        /** @var  \Illuminate\Filesystem\FilesystemManager $storage */
        $storage = Storage::disk('public');
        return $this->image ? asset($storage->url($this->image)) : '';
    }
}
