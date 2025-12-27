
<x-layouts.main>

@php
    $diningBar = \App\Models\DiningBar::with('images')->first();
    $social = \App\Models\SocialLinks::first();
    $menus = \App\Models\Menu::all();
    $companyInfo = \App\Models\CompanyInformation::first();

     $companyName = $companyInfo?->company_name ?? 'Parle Group';


    // HERO
    $heroTitle = filled($diningBar?->title)
        ? $diningBar->title
        : 'Parle Dining & Bar';

    $heroMotto = filled($diningBar?->motto)
        ? $diningBar->motto
        : 'The Ultimate Dining Experience with a Spectacular View';

    // SECTION HEADING
    $sectionSubtitle = filled($diningBar?->subtitle)
        ? $diningBar->subtitle
        : 'Food Items';

    $sectionTitle = filled($diningBar?->title)
        ? $diningBar->title
        : 'Food Showcase';
@endphp




    <!-- Start Hero -->
    <section>
        <div class="ak-hero ak-style1 heignt-100vh">
            <div class="ak-hero-bg ak-bg" data-src="{{ asset('images/background-dining-bar.png') }}"></div>
            <div class="container">
                <div class="hero-text-section container-fluid container-md">
                    <div class="ak-slider ak-slider-hero-2">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="slider-info">
      @php
    // ===== MOTTO SOURCE (AMAN KALAU NULL) =====
    $mottoText = trim(
        $diningBar?->motto
        ?? 'The Ultimate Dining Experience with a Spectacular View'
    );

    // ===== SPLIT KATA 50:50 =====
    $words = preg_split('/\s+/', $mottoText);
    $totalWords = count($words);
    $half = (int) ceil($totalWords / 2);

    $whiteWords = implode(' ', array_slice($words, 0, $half));
    $goldWords  = implode(' ', array_slice($words, $half));
@endphp


<div class="hero-title">
    <p class="mini-title">{{ $companyName }}</p>

    {{-- PUTIH --}}
    <h1 class="hero-main-title">
        {{ $whiteWords }}
    </h1>

    {{-- GOLD --}}
    <h1 class="hero-main-title-1 style-2">
        <span style="color:#D09A40">
            {{ $goldWords }}
        </span>
    </h1>
</div>


                                    <div class="ak-height-40 ak-height-lg-30"></div>
                                    <a href="#" class="hero-btn style-1">
                                        <div class="ak-btn style-5">
                                            View More
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          <div class="social-icon-section">
    <p>FOLLOW US</p>
    <div class="social-border"></div>

    <div class="social-icon">

        {{-- FACEBOOK --}}
        <a href="{{ !empty($social?->facebook) ? 'https://www.facebook.com/'.$social->facebook : '#' }}"
           target="{{ !empty($social?->facebook) ? '_blank' : '_self' }}">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                    <path d="M9.26 16.56V9.27h2.45l.37-2.85H9.26V4.61c0-.82.23-1.38 1.41-1.38h1.51V.68c-.26-.03-1.15-.11-2.19-.11-2.17 0-3.66 1.33-3.66 3.76v2.09H3.87v2.85h2.45v7.29h2.94z" fill="white"/>
                </svg>
            </span>
        </a>

        {{-- LINKEDIN --}}
        <a href="{{ !empty($social?->linkedin) ? 'https://www.linkedin.com/in/'.$social->linkedin : '#' }}"
           target="{{ !empty($social?->linkedin) ? '_blank' : '_self' }}">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                    <path d="M16.02 16.57v-5.87c0-2.87-.62-5.08-3.97-5.08-1.61 0-2.7.89-3.14 1.73h-.05V5.88H5.68v10.68h3.31v-5.29c0-1.39.26-2.74 1.99-2.74 1.7 0 1.72 1.59 1.72 2.83v5.2h3.32zM.29 5.88h3.32v10.68H.29zM1.94.57a1.94 1.94 0 1 0 0 3.88 1.94 1.94 0 0 0 0-3.88z" fill="white"/>
                </svg>
            </span>
        </a>

        {{-- TWITTER --}}
        <a href="{{ !empty($social?->twitter) ? 'https://twitter.com/'.$social->twitter : '#' }}"
           target="{{ !empty($social?->twitter) ? '_blank' : '_self' }}">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14" fill="none">
                    <path d="M16.55 1.61c-.6.26-1.22.44-1.88.52.68-.4 1.2-1.04 1.44-1.82-.64.38-1.34.64-2.08.8A3.25 3.25 0 0 0 11.63.07c-1.82 0-3.28 1.48-3.28 3.28 0 .26.02.5.08.74-2.72-.12-5.12-1.44-6.74-3.42-1.16 2.08.14 3.8 1 4.38-.52 0-1.04-.16-1.48-.4 0 1.62 1.14 2.96 2.62 3.26-.32.1-.72.16-1.12.08.42 1.3 1.64 2.26 3.06 2.28-1.12.88-2.76 1.58-4.86 1.36 1.46.94 3.18 1.48 5.04 1.48 6.04 0 9.32-5 9.32-9.32v-.32c.68-.5 1.24-1.08 1.66-1.74z" fill="white"/>
                </svg>
            </span>
        </a>

        {{-- INSTAGRAM --}}
        <a href="{{ !empty($social?->instagram) ? 'https://www.instagram.com/'.$social->instagram.'/' : '#' }}"
           target="{{ !empty($social?->instagram) ? '_blank' : '_self' }}">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="white">
                    <path d="M7 2C4.2 2 2 4.2 2 7v10c0 2.8 2.2 5 5 5h10c2.8 0 5-2.2 5-5V7c0-2.8-2.2-5-5-5H7z"/>
                </svg>
            </span>
        </a>

        {{-- WHATSAPP --}}
        <a href="{{ !empty($social?->whatsapp) ? 'https://wa.me/'.preg_replace('/[^0-9]/', '', $social->whatsapp) : '#' }}"
           target="{{ !empty($social?->whatsapp) ? '_blank' : '_self' }}">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="white">
                    <path d="M20.5 3.5A11.9 11.9 0 0 0 12 0C5.4 0 .1 5.3.1 11.9c0 2.1.6 4.1 1.7 5.9L0 24l6.4-1.7a11.9 11.9 0 0 0 5.6 1.4h.1c6.6 0 11.9-5.3 11.9-11.9 0-3.2-1.3-6.2-3.5-8.3z"/>
                </svg>
            </span>
        </a>

    </div>
</div>


      
</section>
    <!-- End Hero -->

    <!-- Start Gallery -->
    <div class="ak-height-150 ak-height-lg-60"></div>
    <section class="container" id="foodItems">
       <div class="ak-section-heading ak-style-1 ak-type-1">
    <div class="ak-section-subtitle">
        {{ $sectionSubtitle }}
    </div>

    <h2 class="ak-section-title anim-title">
        {{ $sectionTitle }}
    </h2>
</div>

<div class="ak-height-65 ak-height-lg-30"></div>

<div id="static-thumbnails">
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5">

        {{-- ======================
            JIKA ADA DATA DARI DB
        ======================= --}}
        @if(isset($diningBar) && $diningBar->images->count())

            @foreach($diningBar->images as $image)
                <div class="col">
                    <div class="gallery ak-bg" data-src="{{ asset($image->image) }}">
                        <div class="gallery style-1">
                            <div class="gallery-hover">
                                <div class="gallery-hover-icon">
                                    <a href="{{ asset($image->image) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="41" height="41"
                                             viewBox="0 0 41 41" fill="none">
                                            <rect x="0.507812" y="19.7305" width="40" height="1"
                                                  fill="#D09A40"/>
                                            <rect x="20.0078" y="0.730469" width="1" height="40"
                                                  fill="#D09A40"/>
                                        </svg>
                                    </a>
                                </div>

                                <div class="gallery-hover-info">
                                    <a href="#">
                                        <h6>{{ $diningBar->title ?? 'Food Showcase' }}</h6>
                                        <p>{{ $diningBar->subtitle ?? 'Dining & Bar' }}</p>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        {{-- ======================
            JIKA NULL / KOSONG
        ======================= --}}
        @else

            @php
                $defaultImages = [
                    'images/menu1.jpg',
                    'images/menu2.jpg',
                    'images/menu3.jpg',
                ];
            @endphp

            @foreach($defaultImages as $img)
                <div class="col">
                    <div class="gallery ak-bg" data-src="{{ asset($img) }}">
                        <div class="gallery style-1">
                            <div class="gallery-hover">
                                <div class="gallery-hover-icon">
                                    <a href="{{ asset($img) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="41" height="41"
                                             viewBox="0 0 41 41" fill="none">
                                            <rect x="0.507812" y="19.7305" width="40" height="1"
                                                  fill="#D09A40"/>
                                            <rect x="20.0078" y="0.730469" width="1" height="40"
                                                  fill="#D09A40"/>
                                        </svg>
                                    </a>
                                </div>

                                <div class="gallery-hover-info">
                                    <a href="#">
                                        <h6>Paella Valencene</h6>
                                        <p>Italian</p>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        @endif

    </div>
</div>

    </section>
    <!-- End Gallery -->

    <div class="ak-height-150 ak-height-lg-60"></div>

    <div class="container">

 @php
    $menuHeading = isset($menus) && $menus->count() ? $menus->first() : null;
@endphp

<div class="ak-section-heading ak-style-1 ak-type-1">

    {{-- SUBTITLE (QUOTE) --}}
    <div class="ak-section-subtitle">
        {{ filled($menuHeading?->quote) ? $menuHeading->quote : 'Special Selection' }}
    </div>

    {{-- TITLE --}}
    <h2 class="ak-section-title anim-title">
        {{ filled($menuHeading?->title) ? $menuHeading->title : 'Food Menu' }}
    </h2>

</div>



        <div class="ak-height-65 ak-height-lg-30"></div>

<div class="ak-menu-list">

    @php
        $fallbackImages = ['item-show.png','item-show_2.png'];
    @endphp

    {{-- ================= JIKA MENU ADA ================= --}}
    @if(isset($menus) && $menus->count())

        @foreach($menus as $index => $menu)

            {{-- SKIP JIKA BUKAN MENU ASLI (CUMA TITLE / QUOTE) --}}
            @continue(
                blank($menu->name) ||
                blank($menu->price) ||
                blank($menu->description)
            )

            <div class="ak-menu-list-section-1">

                {{-- IMAGE --}}
                <img
                    src="{{ filled($menu->image)
                        ? asset('menu/' . $menu->image)
                        : asset('template/restaurant/assets/img/' . $fallbackImages[$index % 2]) }}"
                    alt="{{ $menu->name }}"
                >

                <div class="food-menu style-1">

                    {{-- ===== TOP ROW ===== --}}
                    <div class="food-menu-section-1">

                        <div class="food-menu-title">
                            <p>{{ $menu->name }}</p>
                        </div>

                        <div class="food-menu-hr">
                            <div class="food-menu-hr style-1"></div>
                            <div class="food-menu-hr style-1"></div>
                        </div>

                        <div class="food-menu-price">
                            <p>${{ number_format($menu->price, 0) }}</p>
                        </div>

                    </div>

                    {{-- ===== BOTTOM ROW (DESCRIPTION SAJA) ===== --}}
                    <div class="food-menu-section-2">
                        <div class="food-menu-subsitle">
                            <p>{{ $menu->description }}</p>
                        </div>
                    </div>

                </div>
            </div>

        @endforeach

    {{-- ================= JIKA MENU KOSONG ================= --}}
    @else

        @for($i = 0; $i < 6; $i++)
            <div class="ak-menu-list-section-1">

                <img src="{{ asset('template/restaurant/assets/img/' . $fallbackImages[$i % 2]) }}">

                <div class="food-menu style-1">

                    <div class="food-menu-section-1">

                        <div class="food-menu-title">
                            <p>Spaghetti alla Carbonara</p>
                        </div>

                        <div class="food-menu-hr">
                            <div class="food-menu-hr style-1"></div>
                            <div class="food-menu-hr style-1"></div>
                        </div>

                        <div class="food-menu-price">
                            <p>$49</p>
                        </div>

                    </div>

                    <div class="food-menu-section-2">
                        <div class="food-menu-subsitle">
                            <p>Lorem passionate chefs masterfully</p>
                        </div>
                    </div>

                </div>

            </div>
        @endfor

    @endif

</div>






<!-- End Food Menu -->

    
    <!-- End Food Menu -->

    <!-- Start Testimonial -->
    <section class="container">
        <div class="ak-height-150 ak-height-lg-60"></div>
        <div class="ak-slider ak-slider-3">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="container">
                        <div class="testimonial-section">
                            <div class="testimonial-icon-1">
                                <img src="{{ asset('/template/restaurant/assets/img/testimonial_icon_l.svg') }}"
                                     alt="image">
                            </div>
                            <div class="testimonial-info-section">
                                <div class="testimonial-info">
                                    <img src="{{ asset('/template/restaurant/assets/img/testimonial_1.jpg') }}"
                                         class="testimonial-info-img"
                                         alt="image">
                                    <h6 class="testimonial-info-title">Steven K. Roberts</h6>
                                    <p class="short-title">From USA</p>
                                    <p class="testimonial-info-subtitle">“Their talented team of passionate
                                        chefs masterfully crafts each dish, combining the finest ingredients
                                        with innovative techniques to present culinary creations that are as
                                        visually stunning as they are delicious.”</p>
                                </div>
                            </div>
                            <div class="testimonial-icon-1">
                                <img src="{{ asset('/template/restaurant/assets/img/testimonial_icon_r.svg') }}"
                                     alt="image">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="container">
                        <div class="testimonial-section">
                            <div class="testimonial-icon-1">
                                <img src="{{ asset('/template/restaurant/assets/img/testimonial_icon_l.svg') }}"
                                     alt="image">
                            </div>
                            <div class="testimonial-info-section">
                                <div class="testimonial-info">
                                    <img src="{{ asset('/template/restaurant/assets/img/testimonial_1.jpg') }}"
                                         class="testimonial-info-img"
                                         alt="image">
                                    <h6 class="testimonial-info-title">Steven K. Roberts</h6>
                                    <p class="short-title">From USA</p>
                                    <p class="testimonial-info-subtitle">“Their talented team of passionate
                                        chefs masterfully crafts each dish, combining the finest ingredients
                                        with innovative techniques to present culinary creations that are as
                                        visually stunning as they are delicious.”</p>
                                </div>
                            </div>
                            <div class="testimonial-icon-1">
                                <img src="{{ asset('/template/restaurant/assets/img/testimonial_icon_r.svg') }}"
                                     alt="image">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="container">
                        <div class="testimonial-section">
                            <div class="testimonial-icon-1">
                                <img src="{{ asset('/template/restaurant/assets/img/testimonial_icon_l.svg') }}"
                                     alt="image">
                            </div>
                            <div class="testimonial-info-section">
                                <div class="testimonial-info">
                                    <img src="{{ asset('/template/restaurant/assets/img/testimonial_1.jpg') }}"
                                         class="testimonial-info-img"
                                         alt="image">
                                    <h6 class="testimonial-info-title">Steven K. Roberts</h6>
                                    <p class="short-title">From USA</p>
                                    <p class="testimonial-info-subtitle">“Their talented team of passionate
                                        chefs masterfully crafts each dish, combining the finest ingredients
                                        with innovative techniques to present culinary creations that are as
                                        visually stunning as they are delicious.”</p>
                                </div>
                            </div>
                            <div class="testimonial-icon-1">
                                <img src="{{ asset('/template/restaurant/assets/img/testimonial_icon_r.svg') }}"
                                     alt="image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="ak-swiper-controll-3">
                <div class="ak-swiper-navigation-wrap">
                    <div class="ak-swiper-button-prev-3">
                        <button class="btn-style-2 btn-size btn-style-round button-prev-next-2 rotate-svg"
                                aria-disabled="false">
                            <svg width="20" height="14" xmlns="http://www.w3.org/2000/svg">
                                <g stroke="#fff" fill="none" fill-rule="evenodd">
                                    <path d="M12.743 1.343L18.4 7l-5.657 5.657M18.4 7H.4"></path>
                                </g>
                            </svg>
                            <svg width="20" height="14" xmlns="http://www.w3.org/2000/svg">
                                <g stroke="#fff" fill="none" fill-rule="evenodd">
                                    <path d="M12.743 1.343L18.4 7l-5.657 5.657M18.4 7H.4"></path>
                                </g>
                            </svg>
                        </button>
                    </div>
                    <div class="ak-swiper-button-next-3">
                        <button class="btn-style-2 btn-size btn-style-round button-prev-next-2"
                                aria-disabled="false">
                            <svg width="20" height="14" xmlns="http://www.w3.org/2000/svg">
                                <g stroke="#fff" fill="none" fill-rule="evenodd">
                                    <path d="M12.743 1.343L18.4 7l-5.657 5.657M18.4 7H.4"></path>
                                </g>
                            </svg>
                            <svg width="20" height="14" xmlns="http://www.w3.org/2000/svg">
                                <g stroke="#fff" fill="none" fill-rule="evenodd">
                                    <path d="M12.743 1.343L18.4 7l-5.657 5.657M18.4 7H.4"></path>
                                </g>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Testimonial -->

    <!-- Start Opening Hour -->
    <section class="container">

    <div class="ak-height-150 ak-height-lg-60"></div>
    <div class="opening-hour type-2">

     @php
    $image2Files = \Illuminate\Support\Facades\File::glob(public_path('about/image2_*'));

    $image2 = !empty($image2Files)
        ? 'about/' . basename(end($image2Files))
        : null;
@endphp


        <div class="opening-hour-img-section style-2">
                <img src="template/restaurant/assets/img/about_open_hour.jpg" class="imagesZoom opening-bg-img ak-bg" alt="...">
                <div class="overlap-opening-img"></div>
            </div>

        <div class="opening-hour-text-section type-2">
            <h2 class="opening-hour-title anim-title-2">Opening Hours</h2>
            <div class="ak-height-30 ak-height-lg-30"></div>

    @php
    $about = \App\Models\About::first();
@endphp

<p class="opening-hour-subtext">
    {{ $about && !empty($about->opening_hours_description) 
        ? $about->opening_hours_description 
        : 'Lorem to our restaurant, where culinary artistry meets exceptional dining experiences. At, we strive to create a gastronomic haven that.' 
    }}
</p>




            <div class="ak-height-30 ak-height-lg-30"></div>

            <div class="opening-hour-date">
                @if($companyInfo && !empty($companyInfo->opening_hours))
                    @foreach($companyInfo->opening_hours as $day => $time)
                        <p>{{ $day }}: {{ $time }}</p>
                        @if(!$loop->last)<div class="opening-hour-hr"></div>@endif
                    @endforeach
                @else
                    <p>MONDAY - WEDNESDAY: 10:00 - 24:00</p>
                    <div class="opening-hour-hr"></div>
                    <p>FRIDAY & SATURDAY: 10:00 - 02:00</p>
                    <div class="opening-hour-hr"></div>
                    <p>SUNDAY: 07:00 - 22:00</p>
                @endif
            </div>

            <div class="ak-height-70 ak-height-lg-30"></div>

            <div class="text-btn">
                <a href="https://www.erestaurants.co/modules/booking/book_form_section.php?redirect=1&bkrestaurant=ID_JK_R_ParleSenayan&bktracking=WEBSITE"
                   target="_blank" class="text-btn1">
                    Reservation
                </a>
            </div>
        </div>

    </div>
</section>

   <!-- Start Best Item -->
@php
    $featuredMenu = \App\Models\FeaturedMenu::first();

    // === TITLE SPLIT LOGIC ===
    $titleText = $featuredMenu->title ?? 'Our Specialities';
    $titleWords = preg_split('/\s+/', trim($titleText));
    $totalWords = count($titleWords);

    $whiteWords = [];
    $goldWords = [];

    if ($totalWords === 4) {
        // 60 : 40 → 2 putih, 2 gold
        $whiteWords = array_slice($titleWords, 0, 2);
        $goldWords  = array_slice($titleWords, 2, 2);
    } else {
        // fallback aman
        $whiteWords = $titleWords;
    }
@endphp

<section>
    <div class="ak-height-150 ak-height-lg-60"></div>
    <div class="container">
        <div class="ak-best-item">

            {{-- SECTION 1 --}}
            <div class="best-item-section-1">
                <div class="ak-section-heading ak-style-1">
                    <div class="ak-section-subtitle">
                        {{ $featuredMenu->quote ?? 'Our food philosophy' }}
                    </div>

                    {{-- TITLE --}}
                    <h2 class="ak-section-title anim-title-2">
                        <span class="text-white">
                            {{ implode(' ', $whiteWords) }}
                        </span>

                        @if(count($goldWords))
                            <span class="text-[#C9A24D]">
                                {{ implode(' ', $goldWords) }}
                            </span>
                        @endif
                    </h2>
                </div>

                <div class="ak-height-30 ak-height-lg-30"></div>

                <p>
                    {{ $featuredMenu->description
                        ?? 'Welcome to our restaurant, where culinary artistry meets exceptional dining experiences.' }}
                </p>

                <div class="ak-height-50 ak-height-lg-30"></div>

                {{-- IMAGE 1 --}}
                <div class="img-one">
     

                   <img
    src="{{ (!empty($featuredMenu?->image_1)
            && file_exists(public_path($featuredMenu->image_1)))
        ? asset($featuredMenu->image_1)
        : asset('template/restaurant/assets/img/bestItem2.jpg') }}"
    alt="Featured Menu Image 1"
    data-speed="1.2"
    data-lag="0"
>



                    <div class="img-overlay"></div>
                </div>
            </div>

            {{-- SECTION 2 --}}
            <div class="best-item-section-2" data-speed="1.1" data-lag="1">
                <img src="{{ asset('template/restaurant/assets/img/star_line.svg') }}" alt="image">
            </div>

            {{-- SECTION 3 --}}
            <div class="best-item-section-3">
                <div class="img-two">
    <img
    src="{{ (!empty($featuredMenu?->image_2)
            && file_exists(public_path($featuredMenu->image_2)))
        ? asset($featuredMenu->image_2)
        : asset('template/restaurant/assets/img/bestItem1.jpg') }}"
    alt="Featured Menu Image 2"
    data-speed="1.1"
    data-lag="0"
>



                    <div class="img-overlay"></div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- End Best Item -->


    <!-- End Best Item -->

    <div class="ak-height-150 ak-height-lg-60"></div>

    <!--  -->
    <div class="container">
        <div class="booking-system-heading">
            <div class="ak-section-heading ak-style-1 ak-type-1">
                <div class="ak-section-subtitle">
                    Reservations
                </div>
                <h2 class="ak-section-title anim-title">Reservations</h2>
            </div>
            <div class="ak-height-60 ak-height-lg-30"></div>
            <div class="booking-system-form">
                <form class="booking-system-form style-2">
                    <div class="select">
                        <select class="ak-form-select">
                            <option selected value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <div class="select-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="10" viewBox="0 0 18 10"
                                 fill="none">
                                <path
                                    d="M8.99516 9.502C8.80335 9.502 8.61135 9.42869 8.46491 9.28225L0.964914 1.78225C0.671852 1.48919 0.671852 1.01463 0.964914 0.72175C1.25798 0.428875 1.73254 0.428688 2.02541 0.72175L8.99516 7.6915L15.9649 0.72175C16.258 0.428688 16.7325 0.428688 17.0254 0.72175C17.3183 1.01481 17.3185 1.48937 17.0254 1.78225L9.52541 9.28225C9.37898 9.42869 9.18698 9.502 8.99516 9.502Z"
                                    fill="#D09A40"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ak-form-time-date">
                        <div class="ak-time">
                            <input value="03:45" class="time-input" type="time" name="time" id="time">
                            <div class="time-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25"
                                     viewBox="0 0 24 25" fill="none">
                                    <g clip-path="url(#clip0_1166_8212)">
                                        <path
                                            d="M12 24.002C5.38581 24.002 0 18.6161 0 12.002C0 5.38777 5.38581 0.00195312 12 0.00195312C18.6142 0.00195312 24 5.38777 24 12.002C24 18.6161 18.6142 24.002 12 24.002ZM12 1.14474C6.01423 1.14474 1.14279 6.01618 1.14279 12.002C1.14279 17.9877 6.01423 22.8592 12 22.8592C17.9858 22.8592 22.8572 17.9877 22.8572 12.002C22.8572 6.01618 17.9858 1.14474 12 1.14474Z"
                                            fill="#D09A40"/>
                                        <path d="M11.4287 4.00195H12.5717V10.2876H11.4287V4.00195Z"
                                              fill="#D09A40"/>
                                        <path d="M11.4287 13.7168H12.5717V16.5739H11.4287V13.7168Z"
                                              fill="#D09A40"/>
                                        <path
                                            d="M12.0001 14.2884C10.7431 14.2884 9.71436 13.2596 9.71436 12.0026C9.71436 10.7455 10.7431 9.7168 12.0001 9.7168C13.2572 9.7168 14.2859 10.7455 14.2859 12.0026C14.2859 13.2596 13.2572 14.2884 12.0001 14.2884ZM12.0001 10.8598C11.3715 10.8598 10.8574 11.374 10.8574 12.0026C10.8574 12.6312 11.3715 13.1454 12.0001 13.1454C12.6288 13.1454 13.1429 12.6312 13.1429 12.0026C13.1429 11.374 12.6288 10.8598 12.0001 10.8598Z"
                                            fill="#D09A40"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1166_8212">
                                            <rect width="24" height="24" fill="white"
                                                  transform="translate(0 0.00195312)"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                        <div class="ak-date">
                            <input class="date-input" value="2023-07-22" type="date" name="date" id="date">
                            <div class="date-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                     viewBox="0 0 25 25" fill="none">
                                    <mask id="mask0_1166_8220" style="mask-type:luminance"
                                          maskUnits="userSpaceOnUse" x="0" y="0" width="25" height="25">
                                        <path d="M0.995117 0.140627H24.9951V24.1406H0.995117V0.140627Z"
                                              fill="white"/>
                                    </mask>
                                    <g mask="url(#mask0_1166_8220)">
                                        <path
                                            d="M12.0732 18.6094H13.917M17.6152 18.6094H19.4589M6.54198 18.6094H8.38571M12.0732 13.0781H13.917M17.6152 13.0781H19.4589M6.54198 13.0781H8.38571M1.93262 8.45311H24.0683M18.537 5.68749V1.07813M7.46387 5.68749V1.07813M5.63077 23.2031H20.3701C22.4125 23.2031 24.0683 21.5474 24.0683 19.5049V6.62006C24.0683 4.57763 22.4125 2.92186 20.3701 2.92186H5.63077C3.58834 2.92186 1.93262 4.57763 1.93262 6.62006V19.5049C1.93262 21.5474 3.58834 23.2031 5.63077 23.2031Z"
                                            stroke="#D09A40" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round"/>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="ak-btn style-5">
                        <button type="submit">
                            Reservations
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--  -->

    <div class="ak-height-150 ak-height-lg-60"></div>

   @php
    $companyInfo = $companyInfo ?? \App\Models\CompanyInformation::first();
@endphp

<!-- Start Video -->
@if($companyInfo && $companyInfo->video_profile_link)

    {{-- 🔥 JIKA ADA VIDEO DARI DB --}}
    <div class="video-section">
        <img 
            src="{{ asset('template/restaurant/assets/img/aboutVideoBg.jpg') }}"
            alt="Video Thumbnail"
            class="video-section-bg-img ak-bg imagesZoom"
            data-speed="1.1"
        >

        <div class="video-section-btn">
            <a 
                href="{{ $companyInfo->video_profile_link }}"
                class="ak-video-block ak-style1 ak-video-open"
            >
                <span class="ak-player-btn ak-accent-color">
                    <span></span>
                </span>
            </a>
        </div>
    </div>

@else

    {{-- 🧱 DEFAULT (SEPERTI AWAL, TIDAK DIUBAH) --}}
    <div class="video-section">
        <img 
            src="{{ asset('template/restaurant/assets/img/aboutVideoBg.jpg') }}"
            alt="Video Thumbnail"
            class="video-section-bg-img ak-bg imagesZoom"
            data-speed="1.1"
        >

        <div class="video-section-btn">
            <a 
                href="https://www.youtube.com/watch?v=UsD1MhKBmD4"
                class="ak-video-block ak-style1 ak-video-open"
            >
                <span class="ak-player-btn ak-accent-color">
                    <span></span>
                </span>
            </a>
        </div>
    </div>

@endif
<!-- End Video -->


    <div class="ak-height-150 ak-height-lg-60"></div>
</x-layouts.main>
