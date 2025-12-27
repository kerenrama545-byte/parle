<x-layouts.main>

@php
      $index = \App\Models\Index::first();
    $companyInfo = \App\Models\CompanyInformation::first();
    $social = \App\Models\SocialLinks::first();

    /*
    |--------------------------------------------------------------------------
    | FINAL INDEX BLADE
    | - Tidak pakai partial
    | - Social media TIDAK DIHAPUS
    | - DB kosong AMAN
    | - Image dari public/index
    |--------------------------------------------------------------------------
    */

    // ================= COMPANY INFO =================
    $companyName = $companyInfo?->company_name ?? 'Parle Group';

    // ================= HERO TEXT (SPLIT 50:50) =================
    $defaultQuote = 'Taste the different live the experiences';

    $mottoText = !empty($index?->quote)
        ? trim($index->quote)
        : $defaultQuote;

    $words       = preg_split('/\s+/', $mottoText);
    $totalWords  = count($words);
    $half        = (int) ceil($totalWords / 2);

    $whiteWords  = implode(' ', array_slice($words, 0, $half));
    $goldWords   = implode(' ', array_slice($words, $half));

    // ================= IMAGES =================
    $heroBg = (!empty($index?->bg_img) && file_exists(public_path('index/' . $index->bg_img)))
        ? asset('index/' . $index->bg_img)
        : asset('images/background-all.png');

    $aboutImage = (!empty($index?->image) && file_exists(public_path('index/' . $index->image)))
        ? asset('index/' . $index->image)
        : asset('images/chef.jpg');

    // ================= DESCRIPTION =================
    $desc1 = $index?->description_1
        ?? 'Established in 2023, PARLE GROUP’s vision is to be a leader in building strong and everlasting lifestyle brands globally in the lifestyle & hospitality industry.';

    $desc2 = $index?->description_2
        ?? 'With this vision in mind, Parle Group continues to create original and innovative lifestyle concepts in major cities in Indonesia, South East Asia and globally.';
@endphp


<!-- ================= HERO ================= -->
<section>
    <div class="ak-hero ak-style1 heignt-100vh">

        <div
            class="ak-hero-bg"
            style="
                background-image: url('{{ $heroBg }}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            "
        ></div>

        <div class="container">
            <div class="hero-text-section container-fluid container-md">
                <div class="ak-slider ak-slider-hero-2">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="slider-info">

                                <div class="hero-title">
                                    <p class="mini-title">{{ $companyName }}</p>

                                    <h1 class="hero-main-title">
                                        {{ $whiteWords }}
                                    </h1>

                                    <h1 class="hero-main-title-1 style-2">
                                        <span style="color:#D09A40">
                                            {{ $goldWords }}
                                        </span>
                                    </h1>
                                </div>

                                <div class="ak-height-40 ak-height-lg-30"></div>

                                <a href="{{ route('abouts') }}" class="hero-btn style-1">
                                    <div class="ak-btn style-5">About Us</div>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- ================= SOCIAL MEDIA (JANGAN DIHAPUS) ================= -->
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
<!-- =============== END HERO =============== -->


<!-- ================= ABOUT ================= -->
<section class="ak-about-bg-color">
    <div class="ak-height-150 ak-height-lg-60"></div>

    <div class="ak-about ak-style-1">
        <div class="ak-about-bg-img ak-bg">
            <img class="imagesZoom" src="{{ $aboutImage }}" alt="About Image">
        </div>

        <div class="ak-about-hr"></div>

        <div class="container">
            <div class="about-section ak-about-1">
                <div class="about-text-section">

                    <h2 class="about-title">
                        About <br>
                        <span class="anim-title-2">{{ $companyName }}</span>
                    </h2>

                    <div class="ak-height-30"></div>

                    <p class="about-subtext">{{ $desc1 }}</p>

                    <div class="ak-height-30"></div>

                    <p class="about-subtext">{{ $desc2 }}</p>

                    <div class="ak-height-50"></div>

                    <div class="text-btn">
                        <a href="{{ route('abouts') }}" class="text-btn1">
                            View More
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<div class="ak-height-150 ak-height-lg-60"></div>

</x-layouts.main>
