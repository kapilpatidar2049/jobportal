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

    {{-- -------------------------blog content-------------------- --}}
    <div class="blog-detail">
        <!-- Header Section -->
        <header class="blog-header">
            <h1>Innovation and New Solutions for Better Work Outcomes</h1>
            <p class="date">October 16, 2024</p>
        </header>
        <hr>
        <!-- Banner Image -->
        <section class="blog-banner">
            <a href="{{ route('blog') }}">Blog>></a>
            <h1>Innovation and New Solutions for Better Work Outcomes</h1>
            <img src="/frontend/images/blog1.jpg" alt="Blog Banner Image">
        </section>

        <!-- Blog Content Section -->
        <section class="blog-content">
            <h2>Delivering better work outcomes with our Managed Services</h2>
            <p>Our team is dedicated to bringing innovative solutions that improve work outcomes for businesses
                worldwide Managed Services are available to all Upwork Enterprise clients, offering complex business
                solutions across many different work categories like sales, HR, and customer support. Upwork Managed
                Services now also offers fully-managed AI services to rapidly meet our customers’ growing AI needs, like
                creating custom AI agents to support internal operations. If a client comes to Upwork and asks to build
                an AI chatbot for their business, Uma streamlines workflows by helping Upwork’s Managed Services team
                swiftly vet and identify top AI professionals like high-quality AI and machine learning engineers or
                experienced data labelers. Backed by Uma, the dedicated team manages the project end-to-end, ultimately
                reducing time-to-completion and ensuring delivery of a successful outcome for the client. </p>
            <!-- Multiple sections as in the original code -->

            <div class="row">
                <div class="col-7 blog-paragraph">
                    <h2>Innovative solutions to achieve true business outcomes </h2>
                    <p>We understand the importance of supporting clients the moment they need high quality talent to
                        drive real-world business outcomes. To meet our customers where they are, we’ve introduced a new
                        way for clients to access solutions for their work needs directly within the third-party
                        platforms they already use.Select partners can now offer fully managed projects delivered by
                        Upwork directly within their own platform experiences. Innovative providers like Lettuce and
                        Ocoya have partnered with Upwork to offer their customers easy access to tailored projects
                        combining quality work by proven pros and AI-driven managed service support, creating more
                        earning opportunities for freelancers and expanding access to Upwork’s guaranteed work outcomes.
                    </p>
                </div>
                <div class="col-5 blog-banner2">
                    <img src="/frontend/images/blog3.jpg" alt="">
                </div>
            </div>

            <div class="row">
                <div class="col-5 blog-banner2">
                    <img src="/frontend/images/blog4.jpg" alt="">
                </div>
                <div class="col-7 blog-paragraph">
                    <h2>Expanding work management & payment options</h2>
                    <p>We’re adding features and functionality that make it easier and faster for freelancers to get
                        paid for the high-quality work outcomes they’re delivering, find their next job, and manage the
                        businesses they’re building on Upwork. We’ve listened to feedback from freelancers on Upwork
                        that they want greater transparency into their Job Success Score (JSS). Our new Job Success
                        Insights gives freelancers insight into their JSS, helping them understand, build and maintain
                        their reputation. These insights include an up-to-date Job Success Score and health range, JSS
                        requirements and factors that impact the score, and actionable tips to improve it.
                    </p>
                </div>

            </div>
        </section>
    </div>
    <!-- Social Media Fixed Section -->
    <div class="social-media-fixed">
        <ul class="social-media-logo">
            <h3>Share </h3>
            <li><a href="#"><img src="/frontend/images/icons/facebook.png" alt="facebook" class="social_media"></a>
            </li>
            <li><a href="#"><img src="/frontend/images/icons/twitter.png" alt="twitter" class="social_media"></a>
            </li>
            <li><a href="#"><img src="/frontend/images/icons/linkedin.png" alt="LinkedIn" class="social_media"></a>
            </li>
            <li><a href="#"><img src="/frontend/images/icons/whatsapp.png" alt="WhatsApp" class="social_media"></a>
            </li>
        </ul>
    </div>
@endsection
