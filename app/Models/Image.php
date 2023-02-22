<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// ini untuk memanggil simpannya
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    /* menampilkan fillable */
    protected $fillable = [
        'image_name',
        'image',
    ];

    // fungsi untuk simpan gambar
    public function getThumbnailUrlAttribute()
    {
        /** @var  \Illuminate\Filesystem\FilesystemManager $storage */
        $storage = Storage::disk('public');
        $thumbnail = str_replace('image/file', 'image/file/resize', $this->image);

        return asset($storage->url($thumbnail));
    }
}
