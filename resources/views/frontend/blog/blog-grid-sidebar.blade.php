@extends('frontend.layouts.main')

@section('content')
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Blogs</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                        <li><a href="{{ route('blog.grid.sidebar') }}">Blogs</a></li>
                        <li>Blog Grid Sidebar</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Blog Section -->
    <section class="section blog-section blog-list">
        <div class="container">
            <div class="row">
                <!-- Blog Posts -->
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="row ">
                        @foreach ($blogs as $blog)
                            <div class="col-lg-6 mb-3 col-md-6 col-12 d-flex"><!-- ① make column a flex-item -->
                                <!-- Start Single Blog -->
                                <div class="single-blog h-100 d-flex flex-column w-100"><!-- ② stretch & stack -->
                                    <div class="blog-img">
                                        <a href="{{ route('blog.show', $blog->slug) }}">
                                            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                                        </a>
                                    </div>

                                    <div class="blog-content mt-auto"><!-- ③ pushes footer down if needed -->
                                        <a class="category" href="#">
                                            {{ $blog->category->name ?? 'Uncategorized' }}
                                        </a>
                                        <h4>
                                            <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                                        </h4>
                                        <p>{!! $blog->short_body !!}</p>
                                        <div class="button">
                                            <a href="{{ route('blog.show', $blog->slug) }}" class="btn">Read More</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Blog -->
                            </div>
                        @endforeach
                    </div>


                    <!-- Pagination -->
                    <div class="pagination center">
                        {{ $blogs->links('pagination::bootstrap-4') }}
                    </div>
                    <!-- End Pagination -->
                </div>

                <!-- Sidebar -->
                <aside class="col-lg-4 col-md-12 col-12">
                    <div class="sidebar blog-grid-page">
                        <!-- Search Widget -->
                        <div class="widget search-widget">
                            <h5 class="widget-title">Search This Site</h5>
                            <form action="#">
                                <input type="text" placeholder="Search Here...">
                                <button type="submit"><i class="lni lni-search-alt"></i></button>
                            </form>
                        </div>

                        <!-- Featured Posts (Static for now) -->
                        <div class="widget popular-feeds">
                            <h5 class="widget-title">Featured Posts</h5>
                            <div class="popular-feed-loop">

                                @foreach ($featuredBlogs as $featured)
                                    <div class="single-popular-feed">
                                        <div class="feed-desc">
                                            <a class="feed-img" href="{{ route('blog.show', $featured->slug) }}">
                                                <img src="{{ asset('storage/' . $featured->image) }}"
                                                    alt="{{ $featured->title }}">
                                            </a>
                                            <h6 class="post-title">
                                                <a
                                                    href="{{ route('blog.show', $featured->slug) }}">{{ $featured->title }}</a>
                                            </h6>
                                            <span class="time">
                                                <i class="lni lni-calendar"></i>
                                                {{ \Carbon\Carbon::parse($featured->created_at)->format('d M Y') }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Categories (Static for now) -->
                        <div class="widget categories-widget">
                            <h5 class="widget-title">Top Categories</h5>
                            <ul class="custom">
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="{{ route('blog.grid.sidebar', ['category' => $category->id]) }}">
                                            {{ $category->name }}
                                        </a>
                                        <span>({{ $category->blogs_count }})</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Popular Tags -->
                        <div class="widget popular-tag-widget">
                            <h5 class="widget-title">Popular Tags</h5>
                            <div class="tags">
                                <a href="#">#electronics</a>
                                <a href="#">#cpu</a>
                                <a href="#">#gadgets</a>
                                <a href="#">#smartphones</a>
                            </div>
                        </div>
                    </div>
                </aside>
                <!-- End Sidebar -->
            </div>
        </div>
    </section>
    <!-- End Blog Section -->
@endsection
