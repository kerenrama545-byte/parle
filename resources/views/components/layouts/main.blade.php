<?php
    $companyInfo = App\Models\CompanyInformation::first();
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Primary Meta Tags -->
    <title>{{ $seo['title'] ?? 'Parle Group' }}</title>
    <meta name="title" content="{{ $seo['title'] ?? 'Parle Group' }}" />
    <meta name="description" content="{{ $seo['description'] ?? 'Established in 2023, Parle Group\'s vision is to be a leader in building strong and everlasting lifestyle brands globally in the lifestyle & hospitality industry' }}" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ $seo['og_url'] ?? url()->current() }}" />
    <meta property="og:title" content="{{ $seo['title'] ?? 'Parle Group' }}" />
    <meta property="og:description" content="{{ $seo['description'] ?? 'Established in 2023, Parle Group\'s vision is to be a leader in building strong and everlasting lifestyle brands globally in the lifestyle & hospitality industry' }}" />
    <meta property="og:image" content="{{ $seo['og_image'] ?? asset('images/meta-tag.png') }}" />

    <!-- X (Twitter) -->
    <meta property="twitter:card" content="{{ $seo['twitter_card'] ?? 'summary_large_image' }}" />
    <meta property="twitter:url" content="{{ $seo['og_url'] ?? url()->current() }}" />
    <meta property="twitter:title" content="{{ $seo['title'] ?? 'Parle Group' }}" />
    <meta property="twitter:description" content="{{ $seo['description'] ?? 'Established in 2023, Parle Group\'s vision is to be a leader in building strong and everlasting lifestyle brands globally in the lifestyle & hospitality industry' }}" />
    <meta property="twitter:image" content="{{ $seo['og_image'] ?? asset('images/meta-tag.png') }}" />

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ $seo['canonical_url'] ?? url()->current() }}" />

    <!-- Structured Data (JSON-LD) -->
    @if(isset($seo['structured_data']) && $seo['structured_data'])
    <script type="application/ld+json">
        {!! $seo['structured_data'] !!}
    </script>
    @endif

    <!-- Additional Company Info Meta Tags -->
    @if($seo['company_info'])
        @if($seo['company_info']->email)
            <meta name="contact:email" content="{{ $seo['company_info']->email }}">
        @endif
        @if($seo['company_info']->phones && count($seo['company_info']->phones) > 0)
            <meta name="contact:phone" content="{{ $seo['company_info']->phones[0] }}">
        @endif
        @if($seo['company_info']->address)
            <meta name="contact:address" content="{{ str_replace(["\r", "\n"], ", ", strip_tags($seo['company_info']->address)) }}">
        @endif
    @endif

    <!-- Dynamic Favicon from Company Information -->
    @if($companyInfo && $companyInfo->icon)
        <link rel="icon" href="{{ asset('logoicon/' . $companyInfo->icon) }}" sizes="any">
    @else
        <link rel="icon" href="{{ asset('/favicon.ico') }}" sizes="any">
    @endif

    <!-- Apple Touch Icon -->
    @if($companyInfo && $companyInfo->icon)
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logoicon/' . $companyInfo->icon) }}">
    @else
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/apple-touch-icon.png') }}">
    @endif

    <!-- PNG Favicons -->
    @if($companyInfo && $companyInfo->icon)
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('logoicon/' . $companyInfo->icon) }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('logoicon/' . $companyInfo->icon) }}">
    @else
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicon-16x16.png') }}">
    @endif

    <!-- Manifest -->
    <link rel="manifest" href="{{ asset('/site.webmanifest') }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('template/restaurant/assets/css/plugins/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('template/restaurant/assets/css/plugins/lightgallery.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('template/restaurant/assets/css/plugins/swiper.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('template/restaurant/assets/css/style.css') }}"/>

    <!-- Custom Styles -->
    <style>
        .ak-hero {
            position: relative;
            overflow: hidden;
        }

        .ak-hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .ak-hero-bg::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.55);
            z-index: 1;
        }

        .ak-commmon-hero {
            position: relative;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 140px 0 80px;
            z-index: 1;
        }

        /* overlay */
        .ak-commmon-hero.ak-overlay::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.55);
            z-index: 1;
        }

        /* pastikan content berada di atas overlay */
        .ak-commmon-heading {
            position: relative;
            z-index: 2;
        }
    </style>
</head>
<body>
    <div id="minicircle"></div>

    <!-- Preloader -->
    <div id="preloader">
        <div id="ak-preloader" class="ak-preloader">
            <div class="animation-preloader">
                <div class="spinner"></div>
                <div class="txt-loading">
                    <span data-text-preloader="P" class="letters-loading">P</span>
                    <span data-text-preloader="A" class="letters-loading">A</span>
                    <span data-text-preloader="R" class="letters-loading">R</span>
                    <span data-text-preloader="L" class="letters-loading">L</span>
                    <span data-text-preloader="E" class="letters-loading">E</span>

                    <span data-text-preloader=" " class="letters-loading">&nbsp;</span>

                    <span data-text-preloader="G" class="letters-loading">G</span>
                    <span data-text-preloader="R" class="letters-loading">R</span>
                    <span data-text-preloader="O" class="letters-loading">O</span>
                    <span data-text-preloader="U" class="letters-loading">U</span>
                    <span data-text-preloader="P" class="letters-loading">P</span>
                </div>
            </div>
            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
        </div>
    </div>

    <!-- Start Header Section -->
    <header class="ak-site_header ak-style1 ak-sticky_header ak-site_header_full_width">
        <div class="header-top">
            <div class="wrapper">
                <div class="header-logo">
                    <a href="https://www.erestaurants.co/modules/booking/book_form_section.php?redirect=1&bkrestaurant=ID_JK_R_ParleSenayan&bktracking=WEBSITE"
                       target="_blank" class="logo">Reservation</a>
                </div>
                
                <div class="center-log">
                    <a href="{{ route('home') }}">
                        @if($companyInfo && $companyInfo->logo)
                            <img src="{{ asset('logoicon/' . $companyInfo->logo) }}" alt="Parle Group Logo" style="max-height: 40px; height: auto;">
                        @else
                            <img src="{{ asset('images/logo/logo.png') }}" alt="Parle Group Logo" style="max-height: 40px; height: auto;">
                        @endif
                    </a>
                </div>

                <button class="ak-menu-toggle" id="akMenuToggle" type="button">
                    <svg viewBox="0 0 20 15" width="40px" height="30px" class="ak-menu-icon">
                        <path d="M20,2 L2,2" class="bar-1"></path>
                        <path d="M2,7 L20,7" class="bar-2"></path>
                        <path d="M30,12 L2,12" class="bar-3"></path>
                    </svg>
                </button>
                
                <ul class="top-main-menu">
                    <li class="top-main-menu-li">
                        <a href="{{ route('home') }}">Home</a>
                        <img class="top-main-menu-img" src="{{ asset('template/restaurant/assets/img/fullWM_1.jpg') }}" alt="image">
                    </li>
                    <li class="top-main-menu-li">
                        <a href="{{ route('dining-and-bar') }}">Dining & Bar</a>
                        <img class="top-main-menu-img menu-img" src="{{ asset('template/restaurant/assets/img/fullWM_menu.jpg') }}" alt="image">
                    </li>
                    <li class="top-main-menu-li">
                        <a href="{{ route('hotel-and-resort') }}">Hotel & Resort</a>
                        <img class="top-main-menu-img" src="{{ asset('template/restaurant/assets/img/fullWM_chef.jpg') }}" alt="image">
                    </li>
                    <li class="top-main-menu-li">
                        <a href="{{ route('fishery-and-plantation') }}">Fishery & Plantation</a>
                        <img class="top-main-menu-img" src="{{ asset('template/restaurant/assets/img/fullWM_chef.jpg') }}" alt="image">
                    </li>
                    <li class="top-main-menu-li">
                        <a href="{{ route('property-and-land') }}">Property & Land</a>
                        <img class="top-main-menu-img" src="{{ asset('template/restaurant/assets/img/fullWM_chef.jpg') }}" alt="image">
                    </li>
                    <li class="top-main-menu-li">
                        <a href="{{ route('contact') }}">Contact</a>
                        <img class="top-main-menu-img" src="{{ asset('template/restaurant/assets/img/fullWM_contact.jpg') }}" alt="image">
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="nav-bar-border"></div>
        
        <div class="ak-main_header">
            <div class="container">
                <div class="ak-main_header_in">
                    <div class="ak-main_header_left">
                        <div class="center-log">
                            <a href="{{ route('home') }}">
                                @if($companyInfo && $companyInfo->logo)
                                    <img src="{{ asset('logoicon/' . $companyInfo->logo) }}" alt="Parle Group Logo" style="max-height: 40px; height: auto;">
                                @else
                                    <img src="{{ asset('images/logo/logo.png') }}" alt="Parle Group Logo" style="max-height: 40px; height: auto;">
                                @endif
                            </a>
                        </div>
                    </div>
                    
                    <div class="ak-main_header_right">
                        <div class="ak-nav ak-medium">
                            <ul class="ak-nav_list">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="{{ route('dining-and-bar') }}">Dining & Bar</a></li>
                                <li><a href="{{ route('fishery-and-plantation') }}">Fishery & Plantation</a></li>
                                <li><a href="{{ route('hotel-and-resort') }}">Hotel & Resort</a></li>
                                <li><a href="{{ route('property-and-land') }}">Property & Land</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End Header Section -->

    <div id="scrollsmoother-container">
        {{ $slot }}

        <!-- Start Footer -->
        <footer>
            <div class="ak-footer ak-style-1">
                <div class="ak-bg footer-bg-img" data-src="template/restaurant/assets/img/footer_bg.png"></div>

                <div class="container ak-hr-container">
                    <div class="ak-braner-logo type-color-1 footer-logo">
                        <div class="footer-log-elem">
                            <div class="footer-log-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="13" viewBox="0 0 30 13" fill="none">
                                    <path d="M28.991 12.2063L14.8322 1L0.67334 12.2063" stroke="white" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <div class="center-log">
                                <a href="{{ route('home') }}">
                                    @if($companyInfo && $companyInfo->logo)
                                        <img src="{{ asset('logoicon/' . $companyInfo->logo) }}" alt="Parle Group Logo" style="max-height: 40px; height: auto;">
                                    @else
                                        <img src="{{ asset('images/logo/logo.png') }}" alt="Parle Group Logo" style="max-height: 40px; height: auto;">
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="ak-height-100 ak-height-lg-60"></div>
                    <div class="ak-footer-hr-top"></div>

                    <div class="footer-main">
                        <div class="footer-eamil-menu">
                            <div class="footer-email">
                                @if($companyInfo && $companyInfo->email)
                                    <a href="mailto:{{ $companyInfo->email }}">{{ $companyInfo->email }}</a>
                                @else
                                    <a href="mailto:info@parle-group.com">info@parle-group.com</a>
                                @endif
                            </div>
                            
                            <div class="footer-menu">
                                <ul>
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ route('blogs') }}">Blog</a></li>
                                    <li><a href="{{ route('contact') }}">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="ak-height-75 ak-height-lg-5"></div>
                        
                        <div class="footer-info">
                            <div class="fooer-phn">
                                @if($companyInfo && !empty($companyInfo->phones))
                                    @foreach($companyInfo->phones as $index => $phone)
                                        @if($index > 0)<br>@endif
                                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}">{{ $phone }}</a>
                                    @endforeach
                                @else
                                    <a href="tel:+62 8111 341 808">+62 8111 341 808</a>
                                @endif
                            </div>
                            
                            <div class="footer-address">
                                @if($companyInfo && $companyInfo->google_map_link && $companyInfo->address)
                                    <a href="{{ $companyInfo->google_map_link }}" target="_blank">
                                        {!! nl2br(e($companyInfo->address)) !!}
                                    </a>
                                @elseif($companyInfo && $companyInfo->address)
                                    <a href="#" title="Map not available">
                                        {!! nl2br(e($companyInfo->address)) !!}
                                    </a>
                                @else
                                    <a href="https://maps.app.goo.gl/yVz9y2EDHgBFwWTT6" target="_blank">
                                        Jl. Gerbang Pemuda No.3, RT.1/RW.3, Gelora,
                                        <br>
                                        Kecamatan Tanah Abang, Kota Jakarta Pusat,
                                        <br>
                                        Daerah Khusus Ibukota Jakarta 10270
                                    </a>
                                @endif
                            </div>
                            
                            <div class="footer-time">
                                @if($companyInfo && !empty($companyInfo->opening_hours))
                                    @foreach($companyInfo->opening_hours as $day => $time)
                                        <p>{{ $day }}: {{ $time }}</p>
                                        @if(!$loop->last)<div class="footer-time-border my-1"></div>@endif
                                    @endforeach
                                @else
                                    <p>MONDAY - WEDNESDAY: 10:00 - 24:00</p>
                                    <div class="footer-time-border my-1"></div>
                                    <p>FRIDAY & SATURDAY: 10:00 - 02:00</p>
                                    <div class="footer-time-border my-1"></div>
                                    <p>SUNDAY: 07:00 - 22:00</p>
                                @endif
                            </div>
                            
                            <div class="footer-btn">
                                <a href="https://www.erestaurants.co/modules/booking/book_form_section.php?redirect=1&bkrestaurant=ID_JK_R_ParleSenayan&bktracking=WEBSITE" target="_blank">
                                    <div class="ak-btn style-5">Reservations</div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="ak-footer-hr-bottom qodef-grid-item"></div>
                    <div class="ak-height-130 ak-height-lg-30"></div>

                    <div class="copy-right-section">
                        <p class="text-uppercase text-md-center text-white">
                            Copyright 2025
                            {{ $companyInfo && !empty($companyInfo->company_name) ? $companyInfo->company_name : 'Parle Group' }}
                            - All Right Reserved
                        </p>
                    </div>

                    <div class="ak-height-45 ak-height-lg-30"></div>
                </div>
            </div>
        </footer>
    </div>

    <div class="loading-overlap"></div>

    <!-- End Footer -->
    <span class="ak-scrollup">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 10L1.7625 11.7625L8.75 4.7875V20H11.25V4.7875L18.225 11.775L20 10L10 0L0 10Z" fill="currentColor"/>
        </svg>
    </span>

    <!-- Start Video Popup -->
    <div class="ak-video-popup">
        <div class="ak-video-popup-overlay"></div>
        <div class="ak-video-popup-content">
            <div class="ak-video-popup-layer"></div>
            <div class="ak-video-popup-container">
                <div class="ak-video-popup-align">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="about:blank"></iframe>
                    </div>
                </div>
                <div class="ak-video-popup-close"></div>
            </div>
        </div>
    </div>
    <!-- End Video Popup -->

    <!-- Scripts -->
    <script>
        // apply background image using data-src
        document.querySelectorAll('.ak-bg').forEach(bg => {
            const img = bg.getAttribute('data-src');
            bg.style.backgroundImage = `url('${img}')`;
        });
    </script>
    <script src="{{ asset('template/restaurant/assets/js/plugins/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('template/restaurant/assets/js/plugins/isotope.pkg.min.js') }}"></script>
    <script src="{{ asset('template/restaurant/assets/js/plugins/swiper.min.js') }}"></script>
    <script src="{{ asset('template/restaurant/assets/js/plugins/lightgallery.min.js') }}"></script>
    <script src="{{ asset('template/restaurant/assets/js/plugins/ScrollSmoother.min.js') }}"></script>
    <script src="{{ asset('template/restaurant/assets/js/plugins/SplitText.min.js') }}"></script>
    <script src="{{ asset('template/restaurant/assets/js/plugins/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('template/restaurant/assets/js/plugins/ScrollToPlugin.min.js') }}"></script>
    <script src="{{ asset('template/restaurant/assets/js/plugins/gsap.min.js') }}"></script>
    <script src="{{ asset('template/restaurant/assets/js/main.js') }}"></script>
</body>
</html>