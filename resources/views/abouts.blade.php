<x-layouts.main>
    <!-- Start Hero -->
    <section>
        <div class="ak-commmon-hero ak-style1 ak-bg ak-overlay" data-src="{{ asset('images/background.png') }}">
            <div class="ak-commmon-heading">
                <div class="ak-section-heading ak-style-1 ak-type-1 ak-color-1 page-top-title">
                    <div class="ak-section-subtitle">
                        <a href="{{ route('home') }}">Home</a> / About Us
                    </div>
                    <h2 class="ak-section-title page-title-anim">About Us</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero -->

<!-- Start About -->
<!-- Start About -->
<section class="ak-about-bg-color">
    <div class="ak-height-150 ak-height-lg-60"></div>

    <div class="ak-about ak-style-1">
        @php
    $about = \App\Models\About::first();
@endphp

<div class="ak-about-bg-img ak-bg">
    @if($about && $about->image_1)
        <img 
            class="imagesZoom" 
            src="{{ asset($about->image_1) }}" 
            alt="About Background"
        >
    @else
        <img 
            class="imagesZoom" 
            src="{{ asset('template/restaurant/assets/img/about_bg.jpg') }}" 
            alt="About Background"
        >
    @endif
</div>

        <div class="ak-about-hr"></div>

        <div class="container">
            <div class="about-section ak-about-1">
                <div class="about-text-section">

                    @php
                        $about = \App\Models\About::first();

                        $firstPart = '';
                        $lastWord = '';

                        if ($about && $about->quote) {
                            $words = explode(' ', $about->quote);
                            $lastWord = array_pop($words);
                            $firstPart = implode(' ', $words);
                        }
                    @endphp

                    <!-- Quote -->
                    <div class="about-section">
                        @if($about && $about->quote)
                            <h2 class="about-title">
                                {{ $firstPart }}
                                <br>
                                <span class="anim-title-2">{{ $lastWord }}</span>
                            </h2>
                        @else
                            <h2 class="about-title">
                                Exquisite Dining Experience Fit for
                                <br><span class="anim-title-2">Royalty</span>
                            </h2>
                        @endif
                    </div>

                    <!-- Description -->
                    @if($about && $about->description)
                        @foreach(explode("\n", $about->description) as $paragraph)
                            @if(trim($paragraph))
                                <div class="ak-height-30 ak-height-lg-30"></div>
                                <p class="about-subtext">{{ $paragraph }}</p>
                            @endif
                        @endforeach
                    @endif

                    <div class="ak-height-50 ak-height-lg-30"></div>

                    <!-- Button -->
                    <div class="text-btn">
                        <a href="{{ route('abouts') }}" class="text-btn1">
                            Discover The Kitchen
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- End About -->

<!-- End About -->

    <!-- End About -->

    <!-- Start Testimonial -->
    <section class="container">
        <div class="ak-height-150 ak-height-lg-60"></div>
        <div class="ak-slider ak-slider-3">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="container">
                        <div class="testimonial-section">
                            <div class="testimonial-icon-1">
                                <img src="template/restaurant/assets/img/testimonial_icon_l.svg" alt="...">
                            </div>
                            <div class="testimonial-info-section">
                                <div class="testimonial-info">
                                    <img src="template/restaurant/assets/img/testimonial_1.jpg" class="testimonial-info-img" alt="...">
                                    <h6 class="testimonial-info-title">Steven K. Roberts</h6>
                                    <p class="short-title">From USA</p>
                                    <p class="testimonial-info-subtitle">“Their talented team of passionate chefs
                                        masterfully crafts each dish, combining the finest ingredients with
                                        innovative techniques to present culinary creations that are as visually
                                        stunning as they are delicious.”</p>
                                </div>
                            </div>
                            <div class="testimonial-icon-1">
                                <img src="template/restaurant/assets/img/testimonial_icon_r.svg" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="container">
                        <div class="testimonial-section">
                            <div class="testimonial-icon-1">
                                <img src="template/restaurant/assets/img/testimonial_icon_l.svg" alt="...">
                            </div>
                            <div class="testimonial-info-section">
                                <div class="testimonial-info">
                                    <img src="template/restaurant/assets/img/testimonial_1.jpg" class="testimonial-info-img" alt="...">
                                    <h6 class="testimonial-info-title">Steven K. Roberts</h6>
                                    <p class="short-title">From USA</p>
                                    <p class="testimonial-info-subtitle">“Their talented team of passionate chefs
                                        masterfully crafts each dish, combining the finest ingredients with
                                        innovative techniques to present culinary creations that are as visually
                                        stunning as they are delicious.”</p>
                                </div>
                            </div>
                            <div class="testimonial-icon-1">
                                <img src="template/restaurant/assets/img/testimonial_icon_r.svg" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="container">
                        <div class="testimonial-section">
                            <div class="testimonial-icon-1">
                                <img src="template/restaurant/assets/img/testimonial_icon_l.svg" alt="...">
                            </div>
                            <div class="testimonial-info-section">
                                <div class="testimonial-info">
                                    <img src="template/restaurant/assets/img/testimonial_1.jpg" class="testimonial-info-img" alt="...">
                                    <h6 class="testimonial-info-title">Steven K. Roberts</h6>
                                    <p class="short-title">From USA</p>
                                    <p class="testimonial-info-subtitle">“Their talented team of passionate chefs
                                        masterfully crafts each dish, combining the finest ingredients with
                                        innovative techniques to present culinary creations that are as visually
                                        stunning as they are delicious.”</p>
                                </div>
                            </div>
                            <div class="testimonial-icon-1">
                                <img src="template/restaurant/assets/img/testimonial_icon_r.svg" alt="...">
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
    $about = $about ?? \App\Models\About::first();
@endphp

<div class="opening-hour-img-section style-2">
    <img 
        src="{{ $about && $about->image_2 
            ? asset($about->image_2) 
            : asset('template/restaurant/assets/img/about_open_hour.jpg') 
        }}"
        class="imagesZoom opening-bg-img ak-bg"
        alt="Opening Hour"
    >
    <div class="overlap-opening-img"></div>
</div>

            <div class="opening-hour-text-section type-2">
                <h2 class="opening-hour-title  anim-title-2">Opening Hours</h2>
                <div class="ak-height-30 ak-height-lg-30"></div>
                 @php
    $about = \App\Models\About::first();
    $companyInfo = \App\Models\CompanyInformation::first();
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
                    <a href="https://www.erestaurants.co/modules/booking/book_form_section.php?redirect=1&bkrestaurant=ID_JK_R_ParleSenayan&bktracking=WEBSITE" class="text-btn1">
                        Reservation
                    </a>

                </div>
            </div>
        </div>
    </section>
    <!-- End  Opening Hour  -->

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
<!-- End Video 
</x-layouts.main>
