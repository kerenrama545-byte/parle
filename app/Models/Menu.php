<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
        'title',        // judul menu (English)
        'quote',        // kutipan (English)
        'name',
        'description',
        'image',
        'price',
    ];
}
