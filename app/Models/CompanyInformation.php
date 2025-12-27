<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyInformation extends Model
{
    protected $fillable = [
        'company_name',       // ⬅️ TAMBAHAN
        'logo',
        'icon',
        'phones',
        'email',
        'address',
        'google_map_link',
        'opening_hours',
        'video_profile_link',
    ];

    /**
     * Cast attributes.
     */
    protected function casts(): array
    {
        return [
            'phones' => 'array',
            'opening_hours' => 'array',
        ];
    }

    public static function first(): ?static
    {
        return static::query()->first();
    }
}
