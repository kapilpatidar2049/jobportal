@extends('frontend.layouts.master')
@section('content')
    <section class="it_banner">
        <div class="it_banner_content">
            <h1>Development and IT experts </h1>
            {{-- <p>Join millions of job seekers who trust us in their search for the perfect role every day.</p> --}}
        </div>
    </section>

    {{-- ------------------------content----------------------  --}}
    <section class="it_section">
        <div class="it_container">
            <!-- Left Section -->
            <div class="it_left-section">
                <h1>Bring top talent to your business, your way</h1>
                <p>Build your dream team, fill skill gaps, and scale with our full-service, customizable Enterprise
                    platform.</p>
                <a href="#" class="it_btn">Get Started</a>
            </div>

            <!-- Right Section - Profile Card -->
            <div class="it_profile-card">
                <div class="info">
                    <img src="frontend/images/it_curve.png" alt="Profile Picture">
                </div>
            </div>
        </div>
    </section>
    {{-- ------------------------content----------------------  --}}
    {{-- -----------------third section----------------- --}}
    <section class="it_image_content">
        <h1 class="it_main-heading">Hire top software developers on Upwork for your next project</h1>
        <p class="it_sub-heading">Tell us about your project needs, and we'll connect you with skilled developers to bring your ideas to life.</p>
        <div class="it_hero-section">
            <div class="it_content">
                <div class="it_services">
                    <div class="it_service">
                        <h2>Custom Software Development</h2>
                        <p>Build tailored software solutions that fit your business needs and improve operational efficiency.</p>
                    </div>
                    <hr>
                    <div class="it_service">
                        <h2>Mobile & Web App Development</h2>
                        <p>Create seamless, high-performance mobile and web applications that engage your users effectively.</p>
                    </div>
                    <hr>
                    <div class="it_service">
                        <h2>Software Consultation & Strategy</h2>
                        <p>Work with expert-vetted professionals to define and implement the best technology strategies for your goals.</p>
                    </div>
                </div>
                <button class="it_cta-button">Let’s Explore</button>
            </div>
            <div class="it_image">
                <img src="frontend/images/it_image.jpg" alt="Team collaboration">
            </div>
        </div>
    </section>
    {{-- ----------------------third section-------------------------------- --}}
    {{-- ----------------------fourth section-------------------------------- --}}
    <section class="it_box_section">
        <div class="it_box_container">
            <h1>Work with a dedicated Upwork team member for each step</h1>
            <p>Enterprise clients have an assigned support team for your business each step along the way.</p>
            <div class="it_box_team-section">
              <div class="it_box_team-card">
                <i class="fas fa-user-tie box_it_icon"></i>
                <h3>Account Manager</h3>
                <p>Maintains your account and works with your team to maximize the return on your Upwork investment.</p>
              </div>
              <div class="it_box_team-card">
                <i class="fas fa-cogs box_it_icon"></i>
                <h3>Solutions Architect</h3>
                <p>Develops custom talent solutions for your organization and unique strategic goals.</p>
              </div>
              <div class="it_box_team-card">
                <i class="fas fa-users box_it_icon"></i>
                <h3>Customer Success Manager</h3>
                <p>Delivers comprehensive support for your team with training, reporting, and end-to-end consultation on projects, hiring, and talent management.</p>
              </div>
            </div>
            {{-- <button class="it_box_btn">Let's talk</button> --}}
          </div>
    </section>
    {{-- ----------------------fourth section-------------------------------- --}}

    <section>
        <div class="it-dev-section">
            <div class="it-dev-image-left">
                <div class="circle-decor"></div> <!-- Decorative element near the image -->
                <img src="frontend/images/it_dev.jpg" alt="Person working in office">
                <div class="circle-decor1"></div>
            </div>
            <div class="it-dev-content">
                <h1>Comprehensive SEO & Digital Marketing Solutions</h1>
                <p>Welcome to SEOC, where we specialize in revolutionizing your online presence through expert SEO and digital 
                marketing solutions. Our dedicated team is committed to enhancing your digital footprint through cutting-edge 
                techniques and personalized strategies designed to meet your business needs.</p>
            </div>
        </div>
    </section>
@endsection
