# SEO Metadata Management Guide

## Overview

This document explains how the dynamic SEO metadata system works in Parle Group website.

## How It Works

### 1. Database Structure

The `seo_metadata` table stores SEO information for each page:

- `page_name`: Route name (e.g., 'home', 'about', 'dining-and-bar')
- `meta_title`: Page title (max 60 characters recommended)
- `meta_description`: Meta description (max 160 characters recommended)
- `og_image`: Open Graph image path
- `canonical_url`: Canonical URL for the page
- `structured_data`: JSON-LD structured data

### 2. Automatic SEO Data Injection

The system automatically provides SEO data to all views using the main layout through:

- **Model**: `App\Models\SeoMetadata`
- **View Composer**: `App\ViewComposers\SeoMetadataComposer`
- **Registered in**: `AppServiceProvider::boot()`

### 3. Default Values

Each page has predefined defaults in `SeoMetadataComposer::getPageSpecificDefaults()`:

```php
'home' => [
    'title' => 'Parle Group - Leader in Lifestyle & Hospitality Brands',
    'description' => '...',
],
'about' => [
    'title' => 'About Us - Parle Group',
    'description' => '...',
],
// ... other pages
```

## Usage in Views

### In the Layout

The main layout (`components/layouts/main.blade.php`) automatically uses SEO data:

```blade
<title>{{ $seo['title'] ?? 'Parle Group' }}</title>
<meta name="description" content="{{ $seo['description'] ?? 'Default description' }}">
<meta property="og:title" content="{{ $seo['title'] ?? 'Parle Group' }}">
<!-- ... other meta tags -->
```

### Manual Override in Controllers

If you need to override SEO data for a specific page:

```php
public function somePage()
{
    // Share custom SEO data
    view()->share('seo', [
        'title' => 'Custom Page Title',
        'description' => 'Custom page description',
        'og_image' => asset('images/custom-og.jpg'),
        // ... other SEO fields
    ]);

    return view('pages.custom');
}
```

## Admin Management

### Accessing SEO Admin Panel

1. Navigate to `/admin/seo` (if admin routes are configured)
2. View all pages with their SEO metadata
3. Edit existing SEO data
4. Create SEO metadata for new pages

### Managing SEO Data

1. **Edit Page SEO**:
   - Click "Edit" next to any page
   - Update title (keep under 60 characters)
   - Update description (keep under 160 characters)
   - Upload custom OG image if needed
   - Add structured data in JSON format

2. **Create New Page SEO**:
   - Click "Add New"
   - Select from available registered routes
   - Fill in SEO details
   - Save

## Best Practices

### Meta Titles
- Keep under 60 characters
- Include brand name at the end
- Make it descriptive and unique
- Example: "About Us - Parle Group"

### Meta Descriptions
- Keep under 160 characters
- Summarize page content accurately
- Include relevant keywords naturally
- Make it compelling for users

### Open Graph Images
- Recommended size: 1200x630 pixels
- Use images relevant to the page content
- Include text overlay with brand/page name
- Format: JPG, PNG, or GIF
- Max size: 8MB

### Structured Data (JSON-LD)
Use appropriate schema.org types:
- `Organization` for company pages
- `Restaurant` for dining pages
- `Hotel` for hotel/resort pages
- `ContactPage` for contact pages

Example structured data for Restaurant:
```json
{
  "@context": "https://schema.org",
  "@type": "Restaurant",
  "name": "Parle Group - Dining & Bar",
  "url": "https://parle-group.com/dining-and-bar",
  "description": "Experience exceptional dining...",
  "servesCuisine": ["International", "Indonesian"],
  "priceRange": "$$$"
}
```

## Troubleshooting

### SEO Data Not Showing
1. Check if the route name matches `page_name` in database
2. Ensure the view uses the main layout
3. Clear cache: `php artisan view:clear`

### New Page Not Available in Admin
1. Make sure the route has a name
2. Route name should not contain "admin"
3. Run `php artisan route:clear` if routes were recently changed

### Changes Not Reflecting
1. Run `php artisan cache:clear`
2. Run `php artisan view:clear`
3. Check browser cache

## API Access

You can programmatically access SEO data:

```php
// Get SEO for a specific page
$seo = SeoMetadata::forPage('home', [
    'title' => 'Default title',
    'description' => 'Default description'
]);

// Get all SEO metadata
$allSeo = SeoMetadata::all();
```