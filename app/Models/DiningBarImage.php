<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiningBarImage extends Model
{
    protected $fillable = [
        'dining_bar_id',
        'image',
    ];

    public function diningBar()
    {
        return $this->belongsTo(DiningBar::class);
    }
}
