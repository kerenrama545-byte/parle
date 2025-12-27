<?php

namespace Database\Seeders;

use App\Models\SeoMetadata;
use Illuminate\Database\Seeder;

class SeoMetadataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'page_name' => 'home',
                'meta_title' => 'Parle Group - Leader in Lifestyle & Hospitality Brands',
                'meta_description' => 'Established in 2023, Parle Group\'s vision is to be a leader in building strong and everlasting lifestyle brands globally in the lifestyle & hospitality industry',
                'og_image' => 'images/meta-tag.png',
                'structured_data' => json_encode([
                    '@context' => 'https://schema.org',
                    '@type' => 'Organization',
                    'name' => 'Parle Group',
                    'url' => 'https://parle-group.com',
                    'logo' => 'https://parle-group.com/images/logo/logo.png',
                    'sameAs' => [
                        // Add social media URLs here
                    ],
                    'description' => 'Established in 2023, Parle Group\'s vision is to be a leader in building strong and everlasting lifestyle brands globally in the lifestyle & hospitality industry',
                ]),
            ],
            [
                'page_name' => 'about',
                'meta_title' => 'About Us - Parle Group',
                'meta_description' => 'Learn about Parle Group\'s journey in building strong and everlasting lifestyle brands globally in the lifestyle & hospitality industry since 2023.',
                'og_image' => 'images/meta-tag.png',
            ],
            [
                'page_name' => 'dining-and-bar',
                'meta_title' => 'Dining & Bar - Parle Group',
                'meta_description' => 'Experience exceptional dining and bar concepts with Parle Group\'s premium lifestyle and hospitality brands.',
                'og_image' => 'images/meta-tag.png',
                'structured_data' => json_encode([
                    '@context' => 'https://schema.org',
                    '@type' => 'Restaurant',
                    'name' => 'Parle Group - Dining & Bar',
                    'url' => 'https://parle-group.com/dining-and-bar',
                    'description' => 'Experience exceptional dining and bar concepts with Parle Group\'s premium lifestyle and hospitality brands.',
                    'servesCuisine' => ['International', 'Indonesian', 'Asian Fusion'],
                    'priceRange' => '$$$',
                ]),
            ],
            [
                'page_name' => 'hotel-and-resort',
                'meta_title' => 'Hotel & Resort - Parle Group',
                'meta_description' => 'Discover luxury hotels and resorts by Parle Group, offering world-class hospitality experiences in prime locations.',
                'og_image' => 'images/meta-tag.png',
                'structured_data' => json_encode([
                    '@context' => 'https://schema.org',
                    '@type' => 'Hotel',
                    'name' => 'Parle Group - Hotel & Resort',
                    'url' => 'https://parle-group.com/hotel-and-resort',
                    'description' => 'Discover luxury hotels and resorts by Parle Group, offering world-class hospitality experiences in prime locations.',
                    'starRating' => '5',
                    'priceRange' => '$$$$',
                ]),
            ],
            [
                'page_name' => 'fishery-and-plantation',
                'meta_title' => 'Fishery & Plantation - Parle Group',
                'meta_description' => 'Sustainable fishery and plantation operations by Parle Group, delivering quality products with environmental responsibility.',
                'og_image' => 'images/meta-tag.png',
            ],
            [
                'page_name' => 'property-and-land',
                'meta_title' => 'Property & Land - Parle Group',
                'meta_description' => 'Premium property and land development by Parle Group, creating exceptional spaces for living and business.',
                'og_image' => 'images/meta-tag.png',
            ],
            [
                'page_name' => 'contact',
                'meta_title' => 'Contact Us - Parle Group',
                'meta_description' => 'Get in touch with Parle Group. Contact us for inquiries about our lifestyle and hospitality brands, partnerships, and career opportunities.',
                'og_image' => 'images/meta-tag.png',
                'structured_data' => json_encode([
                    '@context' => 'https://schema.org',
                    '@type' => 'ContactPage',
                    'name' => 'Contact Parle Group',
                    'url' => 'https://parle-group.com/contact',
                    'description' => 'Get in touch with Parle Group. Contact us for inquiries about our lifestyle and hospitality brands, partnerships, and career opportunities.',
                ]),
            ],
        ];

        foreach ($pages as $page) {
            SeoMetadata::updateOrCreate(
                ['page_name' => $page['page_name']],
                $page
            );
        }
    }
}
