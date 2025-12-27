<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote',
        'title',
        'description',
        'image_1',
        'image_2',
    ];
}
