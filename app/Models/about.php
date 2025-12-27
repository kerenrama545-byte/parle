<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote',
        'description',
        'opening_hours_description',
        'image_1',
        'image_2',
    ];
}
