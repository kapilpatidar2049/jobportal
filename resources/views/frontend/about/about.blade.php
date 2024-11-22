@extends('frontend.layouts.master')
@section('content')
    <!-------------------------------- banner Section ------------------------------->
    <section class="about_hero">
        <div>
            <h1>About Us</h1>
        </div>
    </section>
    <!-------------------------------- banner Section ------------------------------->

    <!---------------------- Company Overview Section ---------------------------->
    <section class="company-overview">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="overview-content">
                        <img src="/frontend/images/about-2.jpg" alt="Team Image" class="about_image1">
                        <img src="/frontend/images/about-bg-8.jpg" alt="Team Image" class="about_image2">
                    </div>
                </div>
                <div class="col-6">
                    <div class="about-content">
                        <h1>Who We Are</h1>
                        <h2>Experience the Advantage Why We're the Right Choice</h2>
                        <p>We aim to bridge the gap between job seekers and employers by creating a seamless, intuitive
                            platform.</p>
                        <p> where people can discover, apply for, and secure their dream jobs. We're also committed to
                            empowering freelancers and businesses through our marketplace, connecting talent with
                            opportunitiesin real-time. </p>
                        <p>At our core, we believe in making career journeys more accessible and
                            efficient.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!---------------------- Company Overview Section ---------------------------->

    <!------------------------- Statistics Section ------------------------------->
    <section class="statistics">
        <div class="stat_container">
            <div class="stat">
                <img src="/frontend/images/icons/team.png" alt="" class="stat_icon">
                <p>Connect & Collaborate</p>
            </div>
            <div class="stat">
                <img src="/frontend/images/icons/choose.png" alt="" class="stat_icon">
                <p>Hire & Trade</p>
            </div>
            <div class="stat">
                <img src="/frontend/images/icons/job-portal.png" alt="" class="stat_icon">
                <p>Jobs & Services Hub</p>
            </div>
            <div class="stat">
                <img src="/frontend/images/icons/career-path.png" alt="" class="stat_icon">
                <p>Unified Career & Marketplace</p>
            </div>
        </div>
    </section>
    <!------------------------- Statistics Section ------------------------------->

    <!--------------------------- About Section ---------------------------------->
    <div class="about-section">
        <!-- Job Portal Section -->
        <div class="about-section-box">
            <div class="text-content">
                <h2>Job Portal</h2>
                <p>At the heart of our job portal is a commitment to connect job seekers with rewarding opportunities,
                    and companies with qualified talent. We aim to streamline the hiring process and empower users to
                    take control of their careers.</p>
                <ul>
                    <li>Provide a user-friendly platform for job seekers and employers.</li>
                    <li>Promote career growth through valuable connections.</li>
                    <li>Ensure transparency and integrity in every interaction.</li>
                    <li>Drive continuous innovation in job search technology.</li>
                </ul>
            </div>
            <div class="image-content">
                <img src="/frontend/images/about-7.jpg" alt="Job Portal Mission">
            </div>
        </div>
        <!-- Market Place Section -->
        <div class="about-section-box">
            <div class="image-content">
                <img src="/frontend/images/about-9.jpg" alt="Marketplace Vision & Values">
            </div>
            <div class="text-content">
                <h2>Market Place</h2>
                <p>Our vision for the marketplace is to be the go-to platform for freelance work, offering high-quality
                    services and reliable transactions. We believe in empowering freelancers and businesses to achieve
                    their goals together.</p>
                <ul>
                    <li>Foster innovation and excellence in freelance services.</li>
                    <li>Enable a sustainable future for all participants.</li>
                    <li>Promote fair practices and reliable partnerships.</li>
                    <li>Empower freelancers and businesses to reach their full potential.</li>
                </ul>
            </div>

        </div>
    </div>
    <!--------------------------- About Section ---------------------------------->

    {{-- --------------------------support banner---------------------------------- --}}
    <div class="customer-banner">
        <div>
            <img src="/frontend/images/customer-support.png" alt="" class="support_image">
        </div>
        <div class="customer-content">
            <div class="customer-text">
                <h2>We're Delivering the best customer Experience</h2>
            </div>
        </div>
    </div>
    {{-- --------------------------support banner---------------------------------- --}}

    {{-- ---------------------------oval image section------------------------------- --}}
    <section class="about-hero-section">
        <div class="hero-image-left">
            <img src="frontend/images/about-10.jpg" alt="Person working in office">
        </div>

        <div class="about-hero-content">
            <h1>Comprehensive SEO & Digital Marketing Solutions.</h1>
            <p>Welcome to SEOC where we specialize in revolutionizing your online presence through expert SEO and
                digital marketing solutions.Welcome to SEOC where we specialize in revolutionizing your online presence
                through expert SEO and digital marketing solutions.Welcome to SEOC where we specialize in
                revolutionizing your online presence through expert SEO and digital marketing solutions.</p>
        </div>

        <div class="hero-image-right">
            <img src="frontend/images/about6.jpg" alt="Person working on laptop">
        </div>
    </section>
    {{-- ---------------------------oval image section------------------------------- --}}

    {{-- ----------------------------------collage collection--------------------- --}}
    <div class="collage-container my-5">
        <div class="row">
            <!-- Text Content Column -->
            <div class="col-md-5">
                <div class="collage-section-title">What We Do</div>
                <h2 class="collage-content-title">We Iusto Creative Digital Agency, We Provide Professional Web Page.
                </h2>
                <p class="collage-content-text">Design must be functional, and futionality must translated into, and
                    futionality must translated into.Design must be functional, and futionality must translated into,
                    and futionality must translated into. Deos et accusamus et iusto odio dignissimos qui blanditiis
                    praesentium voluptatum dele corrupti quos dolores et quas molestias a orci facilisis rutrum.</p>

                <ul class="list-unstyled mt-4">
                    <li><span>&#8226;</span> Design must be functional</li>
                    <li><span>&#8226;</span> Aenean pellentes vitae</li>
                    <li><span>&#8226;</span> Lusce enim nulla mollis</li>
                    <li><span>&#8226;</span> Futionality must into</li>
                    <li><span>&#8226;</span> Mattis effic iutur magna</li>
                    <li><span>&#8226;</span> Phasellus eget felis</li>
                </ul>
            </div>

            <!-- Image Grid Column -->
            <div class="col-md-7 collage_collection">
                <div class="image-grid">
                    <div class="image-item">
                        <img src="frontend/images/collage-1.jpg" alt="Image 1" class="grid_image1">
                    </div>
                    <div class="image-item">
                        <img src="frontend/images/collage-2.jpg" alt="Image 2" class="grid_image2">
                    </div>
                    <div class="image-item">
                        <img src="frontend/images/collage-3.jpg" alt="Image 3" class="grid_image3">
                    </div>
                    <div class="image-item">
                        <img src="frontend/images/collage-4.jpg" alt="Image 4" class="grid_image4">
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- -------------------------------------collage collection---------------------------- --}}

   
@endsection