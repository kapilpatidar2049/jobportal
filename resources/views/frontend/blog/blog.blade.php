@extends('frontend.layouts.master')
@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Unlock Your Career Potential: Job Opportunities Await</h1>
            <p>Discover the latest job openings, expert career advice, and essential tips to advance in your
                professional journey.</p>
            <div class="author-info">
                <span>Emily Stone</span>
                <span>6 Nov 2024 · 5 mins read</span>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="blog-section">
        <div class="categories">
            <button>Job Portal</button>
            <button>Market Place</button>
        </div>

        <div class="blog-page">
            <h1 class="latest_heading">Latest Blog Posts</h1>
            <!-- First Blog Card (Larger) -->
            <div class="row">
                <div class="col-lg-8">
                    <a href="{{ route('blog.detail') }}" class="blog-card-link">
                        <div class="blog-card">
                            <div class="row">
                                <div class="col-6">
                                    <img src="frontend/images/blog3.jpg" alt="Blog Image 1">
                                </div>
                                <div class="col-6">
                                    <div class="blog-content">
                                        <p class="category">Product & Innovation</p>
                                        <p class="blog_card_detail">Upwork Updates Fall 2024: AI Innovation and New Solutions for Better Work
                                            Outcomes</p>
                                        <p class="date">October 16, 2024</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Remaining Blog Cards (Smaller) -->
            <div class="row">
                <div class="col-lg-4">
                    <a href="{{ route('blog.detail') }}" class="blog-card-link">
                        <div class="blog-card">
                            <img src="frontend/images/blog1.jpg" alt="Blog Image 2">
                            <div class="blog-content">
                                <p class="category">Product & Innovation</p>
                                <p class="blog_card_detail">Transform Your Ideas into Polished Websites: Webflow Experts Are Now on Upwork
                                    On-Demand
                                    Outcomes</p>
                                <p class="date">October 23, 2024</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="{{ route('blog.detail') }}" class="blog-card-link">
                        <div class="blog-card">
                            <img src="frontend/images/blog2.jpg" alt="Blog Image 3">
                            <div class="blog-content">
                                <p class="category">Product & Innovation</p>
                                <p class="blog_card_detail">A New Era of Work: Evolving the World’s Work Marketplace from On-Demand Hiring to
                                    On-Demand Outcomes</p>
                                <p class="date">October 16, 2024</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="{{ route('blog.detail') }}" class="blog-card-link">
                        <div class="blog-card">
                            <img src="frontend/images/blog3.jpg" alt="Blog Image 4">
                            <div class="blog-content">
                                <p class="category">Research & Reports</p>
                                <p class="blog_card_detail">Introducing the Work Innovator Research Assistant: AI-Powered Insights for Business
                                    Leaders</p>
                                <p class="date">October 11, 2024</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="{{ route('blog.detail') }}" class="blog-card-link">
                        <div class="blog-card">
                            <img src="frontend/images/blog1.jpg" alt="Blog Image 5">
                            <div class="blog-content">
                                <p class="category">Product & Innovation</p>
                                <p class="blog_card_detail">Scaling AI Models for Better Work Outcomes</p>
                                <p class="date">October 3, 2024</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
