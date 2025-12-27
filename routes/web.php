<?php

use App\Http\Controllers\MainController;
use App\Livewire\Dashboard;
use App\Livewire\ManageCompanyInformation;
use App\Livewire\ManageSeoMetadata;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Livewire\BlogManager;
use App\Http\Controllers\DiningBarController;
use App\Livewire\MenuManager;
use App\Livewire\IndexManager;
use App\Livewire\AboutManager;
use App\Livewire\FeaturedMenuManager;

use App\Livewire\SocialLinksManager;
use App\Livewire\ContactInfoManager;
use App\Livewire\DiningBarManager;





Route::middleware(['auth'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dining-page', DiningBarManager::class)
            ->name('admin.dining-page');

    });



Route::get('/admin/contact-info', ContactInfoManager::class)
    ->name('admin.contact-info');


Route::get('/admin/social-links', SocialLinksManager::class)
    ->name('admin.social-links');








Route::middleware(['auth'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/blog-manager', BlogManager::class)
            ->name('admin.blog.manager');

    });



Route::middleware(['auth'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/featured-menu-manager', FeaturedMenuManager::class)
            ->name('featured-menu-manager.index');

    });




Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/about-page', AboutManager::class)
        ->name('admin.about.edit');

});


Route::middleware(['auth'])->group(function () {
    Route::get('/manage/index', IndexManager::class)
        ->name('index.edit');
});



Route::middleware(['auth'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/menu', MenuManager::class)
            ->name('menu.index');

    });






Route::controller(MainController::class)->group(function () {
    // Parle Group
    Route::get('/', 'index')->name('home');
     Route::get('/abouts', [MainController::class, 'abouts'])
    ->name('abouts');
  Route::get('/blogs', [MainController::class, 'blogs'])
    ->name('blogs');
    Route::get('/gallery', 'gallery')->name('gallery');
    Route::get('/contact', 'contact')->name('contact');

    // Dining and Bar
    Route::get('/dining-and-bar', 'diningAndBar')->name('dining-and-bar');
    Route::get('/menu', 'menu')->name('menu');
    Route::get('/chef', 'chef')->name('chef');
    Route::get('/event', 'event')->name('event');

    // Fishery and Plantation
    Route::get('/fishery-and-plantation', 'fisheryAndPlantation')->name('fishery-and-plantation');

    // Hotel and Resort
    Route::get('/hotel-and-resort', 'hotelAndResort')->name('hotel-and-resort');

    // Property and Land
    Route::get('/property-and-land', 'propertyAndLand')->name('property-and-land');
});

Route::get('dashboard', Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::get('manage/company-information', ManageCompanyInformation::class)->name('company-information.edit');
    Route::get('manage/seo-metadata', ManageSeoMetadata::class)->name('seo-metadata.edit');

    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
