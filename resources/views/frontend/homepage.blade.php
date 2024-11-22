@extends('frontend.layouts.master')
@section('content')
    {{-- -------------------- First Section --------------- --}}
    <section class="image_box_section">
        <div class="image-content">
            <h1 class="main-heading">Find Your Dream Job</h1>
            <p class="sub-heading">Thousands of opportunities are waiting for you!</p>
            <div class="button-group">
                <a href="#" class="image-button1"><i class="fas fa-briefcase"></i> LogIn to Job Portal</a>
                <a href="#" class="image-button2"><i class="fas fa-store"></i> LogIn to Market Place</a>
            </div>
        </div>
        <div class="image-section">
            <img class="background_image" src="/frontend/images/image3.jpg" alt="Dream Job">
            <!-- Overlay Content -->
        </div>
    </section>
    {{-- -------------------- First Section --------------- --}}

    {{-- ----------- Popular Services Section (Cards) ----- --}}
    <section class="services-section">
        <h2 class="section-title">Popular Services</h2>
        <div class="swiper-container service-swiper-container">
            <div class="swiper-wrapper service-swiper-wrapper">

                {{-- <div class="cards-container"> --}}
                <div class="swiper-slide service-swiper-slide service-card1">
                    <div class="title_card">
                        <h3 class="service-title">IT/Support</h3>
                    </div>
                    <div class="card-image">
                        <div class="card-image_color_box">
                            <div class="card-image_boxinner">
                                <img src="/frontend/images/cards/image_1.jpg" alt="IT/Support" class="service-image">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide service-swiper-slide service-card2">
                    <div class="title_card">
                        <h3 class="service-title">Sales and Marketing</h3>
                    </div>
                    <div class="card-image">
                        <div class="card-image_color_box">
                            <div class="card-image_boxinner">
                                <img src="/frontend/images/cards/sales12.jpg" alt="Sales and Marketing"
                                    class="service-image">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide service-swiper-slide service-card3">
                    <div class="title_card">
                        <h3 class="service-title">Data Entry</h3>
                    </div>
                    <div class="card-image">
                        <div class="card-image_color_box">
                            <div class="card-image_boxinner">
                                <img src="/frontend/images/cards/image_2.jpg" alt="Data Entry" class="service-image">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide service-swiper-slide service-card4">
                    <div class="title_card">
                        <h3 class="service-title">Data Mining</h3>
                    </div>
                    <div class="card-image">
                        <div class="card-image_color_box">
                            <div class="card-image_boxinner">
                                <img src="/frontend/images/cards/data_mining.jpg" alt="Data Mining" class="service-image">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide service-swiper-slide service-card5">
                    <div class="title_card">
                        <h3 class="service-title">Business & Accounting</h3>
                    </div>
                    <div class="card-image">
                        <div class="card-image_color_box">
                            <div class="card-image_boxinner">
                                <img src="/frontend/images/cards/business.png" alt="Business & Accounting"
                                    class="service-image">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide service-swiper-slide service-card6">
                    <div class="title_card">
                        <h3 class="service-title">Artificial Intelligence</h3>
                    </div>
                    <div class="card-image">
                        <div class="card-image_color_box">
                            <div class="card-image_boxinner">
                                <img src="/frontend/images/cards/image_3.jpg" alt="Artificial Intelligence"
                                    class="service-image">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    {{-- ----------- Popular Services Section (Cards) ----- --}}

    {{-- --------------portal description Section------------------ --}}
    <section class="description_section">
        <div class="description-swiper-container">
            <div class="swiper-wrapper">
                <!-- Job Portal Slide -->
                <div class="swiper-slide description-swiper-slide">
                    <div class="description-content">
                        <h1 class="description-title">Find Your <span class="description_title_second"> Dream
                                Job</span>
                        </h1>
                        <div class="row">
                            <!-- First Column -->
                            <div class="col-md-6 col-lg-6 description">
                                <h3>The Best Talent</h3>
                                <p>Discover reliable professionals for your projects and immerse yourself in feedback
                                    shared on their profiles.</p>
                            </div>
                            <!-- Second Column -->
                            <div class="col-md-6 col-lg-6 description">
                                <h3>Fast Bids</h3>
                                <p>Get quick, no-obligation quotes from skilled professionals. 80% of jobs receive bids
                                    within 60 seconds.</p>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Third Column -->
                            <div class="col-md-6 col-lg-6 description">
                                <h3>Quality Work</h3>
                                <p>With our talent pool of over 60 million professionals, you'll find the quality talent
                                    you need to get the job done right.</p>
                            </div>
                            <!-- Fourth Column -->
                            <div class="col-md-6 col-lg-6 description">
                                <h3>Be in Control</h3>
                                <p>Stay in the loop while on the move. Chat with your freelancers and get real-time
                                    updates through our mobile app.</p>
                            </div>
                        </div>

                        <a href="#" class="cta-button1">Get Started Now →</a>
                    </div>
                </div>
                <!-- Marketplace Slide -->
                <div class="swiper-slide description-swiper-slide">
                    <div class="description-content">
                        <h1 class="description-title">Buy and <span class="description_title_second">Sell
                                Products</span> </h1>
                        <div class="row">
                            <!-- First Column -->
                            <div class="col-md-6 col-lg-6 description">
                                <h3>Wide Product </h3>
                                <p>Explore a vast array of products across multiple categories. Whether you're buying or
                                    selling, our marketplace.</p>
                            </div>
                            <!-- Second Column -->
                            <div class="col-md-6 col-lg-6 description">
                                <h3>Competitive Pricing</h3>
                                <p>Get the best deals with competitive pricing options. Compare offers from multiple
                                    sellers and find the products .</p>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Third Column -->
                            <div class="col-md-6 col-lg-6 description">
                                <h3>Secure Transactions</h3>
                                <p>Shop with confidence. Our platform ensures secure payments and transactions and find
                                    the products.</p>
                            </div>
                            <!-- Fourth Column -->
                            <div class="col-md-6 col-lg-6 description">
                                <h3>24/7 Support</h3>
                                <p>Need help? Our customer support team is available around the clock to assist with any
                                    questions.</p>
                            </div>
                        </div>
                        <a href="#" class="cta-button1">Get started now →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- --------------portal description Section------------------ --}}
    <section class="hero-section">
        <div class="hero-image">
            <img src="/frontend/images/cards/teamwork.jpg" alt="Background Image">
        </div>
        <div class="hero-content">
            <div class="hero-text">
                <h2>Find talent your way</h2>
                <p>Work with the largest network of independent professionals and get things done.</p>
            </div>
            <div class="hero-cards">
                <div class="card">
                    <h3>Post a job and hire a pro</h3>
                    <p>Talent Marketplace →</p>
                </div>
                <div class="card">
                    <h3>Browse and buy projects</h3>
                    <p>Project Catalog →</p>
                </div>
                <div class="card">
                    <h3>Get advice from an industry expert</h3>
                    <p>Consultations →</p>
                </div>
            </div>
        </div>
    </section>
    {{-- --------------portal description Section------------------ --}}

    {{-- --------------Jobs Section------------------ --}}
    <section>
        <div class="custom-slider">
            <h2>Jobs For You</h2>
            <div class="swiper-container jobs-swiper-container">
                <div class="swiper-wrapper jobs-swiper-wrapper">
                    <div class="swiper-slide job-card">
                        <img src="/frontend/images/icons/IT.gif" alt="IT">
                        <p>IT Software</p>
                    </div>
                    <div class="swiper-slide job-card">
                        <img src="/frontend/images/icons/internship.gif" alt="">
                        <p>Internships</p>
                    </div>
                    <div class="swiper-slide job-card">
                        <img src="/frontend/images/icons/workfromhome.gif" alt="">
                        <p>Work From Home</p>
                    </div>
                    <div class="swiper-slide job-card">
                        <img src="/frontend/images/icons/govt.gif" alt="">
                        <p>Govt Jobs</p>
                    </div>
                    <div class="swiper-slide job-card">
                        <img src="/frontend/images/icons/experienced.gif" alt="">
                        <p>Experienced</p>
                    </div>
                    <div class="swiper-slide job-card">
                        <img src="/frontend/images/icons/parttime.gif" alt="">
                        <p>Part-time Jobs</p>
                    </div>
                    <div class="swiper-slide job-card">
                        <img src="/frontend/images/icons/finance.gif" alt="">
                        <p>Financial Services</p>
                    </div>
                    <div class="swiper-slide job-card">
                        <img src="/frontend/images/icons/healthcare.gif" alt="">
                        <p>Healthcare</p>
                    </div>
                    <div class="swiper-slide job-card">
                        <img src="/frontend/images/icons/HR.gif" alt="">
                        <p>Human Resource</p>
                    </div>
                    <div class="swiper-slide job-card">
                        <img src="/frontend/images/icons/food.gif" alt="">
                        <p>Restaurants & Food Services</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    {{-- --------------Jobs Section------------------ --}}

    {{-- ----------------Video Section--------------- --}}
    <section class="video_background">
        <div class="video_area">
          <img src="frontend/images/jobportal.jpg" alt="" class="video_area_container">
            {{-- <video class="video_area_container" src="/frontend/images/video_area1.mp4" autoplay muted loop></video> --}}
        </div>
    </section>
    {{-- ----------------Video Section--------------- --}}

    {{-- ----------------Reviews Section--------------- --}}
    <section class="employee-reviews">
        <h2>Employee Reviews</h2>
        <!-- Buttons for Job and Market -->
        <div class="review-buttons">
            <button id="jobBtn" class="active">Job</button>
            <button id="marketBtn">Market Place</button>
        </div>

        <!-- Review container for Job and Market -->
        <div class="reviews-container" id="jobReviews">
            <div class="review-card">
                <div class="review_image_box">
                    <img src="/frontend/images/about-1.jpg" alt="" class="review-video">
                </div>
                <div class="youtube-icon">
                    <i class="fab fa-youtube"></i>
                </div>
                <p class="employee-name">John Doe</p>
            </div>

            <div class="review-card">
                <div class="review_image_box">
                    <img src="/frontend/images/about-2.jpg" alt="" class="review-video">
                </div>
                <div class="youtube-icon">
                    <i class="fab fa-youtube"></i>
                </div>
                <p class="employee-name">Jane Smith</p>
            </div>

            <div class="review-card">
                <div class="review_image_box">
                    <img src="/frontend/images/about-6.jpg" alt="" class="review-video">
                </div>
                <div class="youtube-icon">
                    <i class="fab fa-youtube"></i>
                </div>
                <p class="employee-name">Michael Brown</p>
            </div>

            <div class="review-card">
                <div class="review_image_box">
                    <img src="/frontend/images/about-9.jpg" alt="" class="review-video">
                </div>
                <div class="youtube-icon">
                    <i class="fab fa-youtube"></i>
                </div>
                <p class="employee-name">Michael Brown</p>
            </div>
        </div>

        <div class="reviews-container" id="marketReviews" style="display: none;">
            <!-- Add market review cards here -->
            <div class="review-card">
                <div class="review_image_box">
                    <img src="/frontend/images/about-7.jpg" alt="" class="review-video">
                </div>
                <div class="youtube-icon">
                    <i class="fab fa-youtube"></i>
                </div>
                <p class="employee-name">Sarah Lee</p>
            </div>

            <div class="review-card">
                <div class="review_image_box">
                    <img src="/frontend/images/about-5.jpg" alt="" class="review-video">
                </div>
                <div class="youtube-icon">
                    <i class="fab fa-youtube"></i>
                </div>
                <p class="employee-name">John Doe</p>
            </div>

            <div class="review-card">
                <div class="review_image_box">
                    <img src="/frontend/images/about-10.jpg" alt="" class="review-video">
                </div>
                <div class="youtube-icon">
                    <i class="fab fa-youtube"></i>
                </div>
                <p class="employee-name">John Doe</p>
            </div>
        </div>
    </section>

    {{-- ----------------Reviews Section--------------- --}}
@endsection
