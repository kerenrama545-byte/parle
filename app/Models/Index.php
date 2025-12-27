<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Index extends Model
{
    use HasFactory;

    // ⬇️ PENTING
    protected $table = 'indexes';

    protected $fillable = [
        'quote',
        'description_1',
        'description_2',
        'bg_img',
        'image',
    ];
}
