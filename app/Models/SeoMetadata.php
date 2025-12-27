<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;

class SeoMetadata extends Model
{
    protected $fillable = [
        'page_name',
        'meta_title',
        'meta_description',
        'og_image',
        'canonical_url',
        'structured_data',
    ];

    protected $casts = [
        'structured_data' => AsArrayObject::class,
    ];

    /**
     * Get SEO data for a specific page
     */
    public static function forPage(string $pageName, array $defaults = []): self
    {
        $seo = static::where('page_name', $pageName)->first();

        if (! $seo) {
            // Create new SEO data with defaults
            $seo = new static([
                'page_name' => $pageName,
                'meta_title' => $defaults['title'] ?? 'Parle Group',
                'meta_description' => $defaults['description'] ?? 'Established in 2023, Parle Group\'s vision is to be a leader in building strong and everlasting lifestyle brands globally in the lifestyle & hospitality industry',
                'og_image' => $defaults['og_image'] ?? 'images/meta-tag.png',
                'canonical_url' => $defaults['canonical_url'] ?? null,
            ]);
        }

        return $seo;
    }
}
