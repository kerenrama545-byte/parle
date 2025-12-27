<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiningBar extends Model
{
    protected $fillable = [
    'title',
    'subtitle', // ⬅️ TAMBAHKAN
    'description',
    'image',
    // field lain biarin
];

    public function images()
    {
        return $this->hasMany(DiningBarImage::class);
    }
}
