<?php

namespace App\ViewComposers;

use App\Models\CompanyInformation;
use App\Models\SeoMetadata;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SeoMetadataComposer
{
    public function compose(View $view)
    {
        $routeName = request()->route()->getName();

        // Default SEO data
        $seoDefaults = [
            'title' => 'Parle Group',
            'description' => 'Established in 2023, Parle Group\'s vision is to be a leader in building strong and everlasting lifestyle brands globally in the lifestyle & hospitality industry',
            'og_image' => 'images/meta-tag.png',
        ];

        // Page-specific SEO defaults
        $pageSeoDefaults = $this->getPageSpecificDefaults($routeName);

        // Get SEO data from database or use defaults
        $seoData = SeoMetadata::forPage($routeName, array_merge($seoDefaults, $pageSeoDefaults));

        // Get company info for additional meta tags
        $companyInfo = CompanyInformation::first();

        // Generate full URLs
        $currentUrl = url()->current();
        $ogImage = $seoData->og_image ? Storage::url($seoData->og_image) : asset('images/meta-tag.png');

        $view->with('seo', [
            'title' => $seoData->meta_title,
            'description' => $seoData->meta_description,
            'og_image' => $ogImage,
            'og_url' => $seoData->canonical_url ?: $currentUrl,
            'canonical_url' => $seoData->canonical_url ?: $currentUrl,
            'twitter_card' => 'summary_large_image',
            'structured_data' => $seoData->structured_data,
            'company_info' => $companyInfo,
        ]);
    }

    private function getPageSpecificDefaults(string $routeName): array
    {
        $defaults = [
            'home' => [
                'title' => 'Parle Group - Leader in Lifestyle & Hospitality Brands',
                'description' => 'Established in 2023, Parle Group\'s vision is to be a leader in building strong and everlasting lifestyle brands globally in the lifestyle & hospitality industry',
            ],
            'about' => [
                'title' => 'About Us - Parle Group',
                'description' => 'Learn about Parle Group\'s journey in building strong and everlasting lifestyle brands globally in the lifestyle & hospitality industry since 2023.',
            ],
            'dining-and-bar' => [
                'title' => 'Dining & Bar - Parle Group',
                'description' => 'Experience exceptional dining and bar concepts with Parle Group\'s premium lifestyle and hospitality brands.',
            ],
            'hotel-and-resort' => [
                'title' => 'Hotel & Resort - Parle Group',
                'description' => 'Discover luxury hotels and resorts by Parle Group, offering world-class hospitality experiences in prime locations.',
            ],
            'fishery-and-plantation' => [
                'title' => 'Fishery & Plantation - Parle Group',
                'description' => 'Sustainable fishery and plantation operations by Parle Group, delivering quality products with environmental responsibility.',
            ],
            'property-and-land' => [
                'title' => 'Property & Land - Parle Group',
                'description' => 'Premium property and land development by Parle Group, creating exceptional spaces for living and business.',
            ],
            'contact' => [
                'title' => 'Contact Us - Parle Group',
                'description' => 'Get in touch with Parle Group. Contact us for inquiries about our lifestyle and hospitality brands, partnerships, and career opportunities.',
            ],
        ];

        return $defaults[$routeName] ?? [];
    }
}
