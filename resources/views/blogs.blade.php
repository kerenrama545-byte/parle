<x-layouts.main>

@php
    $blogs = \App\Models\Blog::whereNotNull('published_at')
        ->orderBy('published_at', 'desc')
        ->get();
       
@endphp

<!-- Start Hero -->
<section>
    <div class="ak-commmon-hero ak-style1 ak-bg ak-overlay" data-src="{{ asset('images/background.png') }}">
        <div class="ak-commmon-heading">
            <div class="ak-section-heading ak-style-1 ak-type-1 ak-color-1 page-top-title">
                <div class="ak-section-subtitle">
                    <a href="{{ route('home') }}">Home</a> / Blog
                </div>
                <h2 class="ak-section-title page-title-anim">Blog</h2>
            </div>
        </div>
    </div>
</section>
<!-- End Hero -->

<!-- Start All Blog -->
<div class="container">
    <div class="ak-height-150 ak-height-lg-60"></div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="pagination-container">

        {{-- =====================
            JIKA BLOG DARI DB ADA
        ====================== --}}
        @if ($blogs->count())

            @foreach ($blogs as $blog)
                <div class="col ak-border drop-anim-gallery">
                    <div class="blog h-100">

                        <img
                            src="{{ (!empty($blog->image)
                                    && file_exists(public_path('blog/' . $blog->image)))
                                ? asset('blog/' . $blog->image)
                                : asset('template/restaurant/assets/img/blog_1.jpg') }}"
                            class="blog-img-top"
                            alt="{{ $blog->title }}"
                        >

                        <div class="blog-body">
                            <p class="blog-time">
                                {{ optional($blog->published_at)->format('d F Y') }}
                            </p>

                            <a href="#">
                                <h6 class="blog-title">
                                    {{ $blog->title }}
                                </h6>
                            </a>

                            <a href="#" class="blog-text">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach

        {{-- =====================
            JIKA DB KOSONG → TEMPLATE ASLI
        ====================== --}}
        @else

            <div class="col ak-border drop-anim-gallery">
                <div class="blog h-100">
                    <img src="{{ asset('template/restaurant/assets/img/blog_1.jpg') }}" class="blog-img-top">
                    <div class="blog-body">
                        <p class="blog-time">06 June 2023</p>
                        <h6 class="blog-title">Exquisite Dining Make Moment</h6>
                        <a href="#" class="blog-text">Read More</a>
                    </div>
                </div>
            </div>

            <div class="col ak-border drop-anim-gallery">
                <div class="blog h-100">
                    <img src="{{ asset('template/restaurant/assets/img/blog_2.jpg') }}" class="blog-img-top">
                    <div class="blog-body">
                        <p class="blog-time">06 June 2023</p>
                        <h6 class="blog-title">Exquisite Dining Make Moment</h6>
                        <a href="#" class="blog-text">Read More</a>
                    </div>
                </div>
            </div>

            <div class="col ak-border border-none-right">
                <div class="blog h-100">
                    <img src="{{ asset('template/restaurant/assets/img/blog_3.jpg') }}" class="blog-img-top">
                    <div class="blog-body">
                        <p class="blog-time">06 June 2023</p>
                        <h6 class="blog-title">Exquisite Dining Make Moment</h6>
                        <a href="#" class="blog-text">Read More</a>
                    </div>
                </div>
            </div>

        @endif

    </div>
</div>
<!-- End All Blog -->

</x-layouts.main>
