@extends('frontend.layouts.master')
@section('content')
    <!----------------- Banner Section ---------------------->
    <section class="job_banner">
        <div class="job_banner_content">
            <h1>Find Your Dream Job</h1>
            <p>Join millions of job seekers who trust us in their search for the perfect role every day.</p>
        </div>
    </section>
    <!----------------- Banner Section ---------------------->
    <section class="job_cards_section">
        <h1>Find Your Dream Job</h1>

        <div class="job-page-card-container">
            <div class="job-page-card">
                <div class="job-page-card-icon">1</div>
                <img src="frontend/images/icons/parttime.gif" alt="" class="job-page-image">
                <h3>Find a Job</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua.</p>
                <a href="#" class="action-link">Sign Up</a>
            </div>
            <div class="job-page-card ">
                <div class="job-page-card-icon">2</div>
                <img src="frontend/images/icons/cv.gif" alt="" class="job-page-image">

                <h3>Create a CV</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua.</p>
                <a href="#" class="action-link">Create CV</a>
            </div>
            <div class="job-page-card">
                <div class="job-page-card-icon">3</div>
                <img src="frontend/images/icons/applied.gif" alt="" class="job-page-image">

                <h3>Get Applied</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua.</p>
                <a href="#" class="action-link">Apply Now</a>
            </div>
        </div>
    </section>
    <!-- SVG Wave Divider (Flipped Upward) -->
    <div style="position: relative; width: 100%; overflow: hidden; line-height: 0; transform: rotate(180deg);">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none"
            style="width: 100%; height: auto;">
            <path class="elementor-shape-fill" opacity="0.33"
                d="M473,67.3c-203.9,88.3-263.1-34-320.3,0C66,119.1,0,59.7,0,59.7V0h1000v59.7 c0,0-62.1,26.1-94.9,29.3c-32.8,3.3-62.8-12.3-75.8-22.1C806,49.6,745.3,8.7,694.9,4.7S492.4,59,473,67.3z">
            </path>
            <path class="elementor-shape-fill" opacity="0.66"
                d="M734,67.3c-45.5,0-77.2-23.2-129.1-39.1c-28.6-8.7-150.3-10.1-254,39.1 s-91.7-34.4-149.2,0C115.7,118.3,0,39.8,0,39.8V0h1000v36.5c0,0-28.2-18.5-92.1-18.5C810.2,18.1,775.7,67.3,734,67.3z">
            </path>
            <path class="elementor-shape-fill"
                d="M766.1,28.9c-200-57.5-266,65.5-395.1,19.5C242,1.8,242,5.4,184.8,20.6C128,35.8,132.3,44.9,89.9,52.5C28.6,63.7,0,0,0,0 h1000c0,0-9.9,40.9-83.6,48.1S829.6,47,766.1,28.9z">
            </path>
        </svg>
    </div>

    <section class="job_detail_section">
        <div class="particles-container"></div> <!-- Particle container -->
        <div class="job_detail">
            <div class="row job_detail_row">
                <div class="col-6 job_detail_box">
                    <h2>Your Path to Success</h2>
                    <p>[Name] is a comprehensive, user-friendly platform designed to connect job seekers with employers
                        across diverse industries. Whether you're looking to advance your career or discover top talent, our
                        portal provides all the tools and resources you need to succeed.</p>
                </div>
                <div class="col-6 job_detail_image">
                    <img src="frontend/images/job-box-3.jpg" alt="">
                </div>
            </div>
        </div>
    </section>



    <section class="job_page_image">
        <div class="job_page_image_box">
            <img src="frontend/images/job_image_box.jpg" alt="image">
        </div>
        <div class="job_page_content">
            <h2>Discover Your Dream Job or Find the Perfect Candidate</h2>
            <p>
                Explore thousands of job listings from leading companies in various fields, including IT, healthcare,
                finance, marketing, engineering, and more. Filter by location, industry, and job type to find the perfect
                match for your skills and career goals.Our easy-to-use CV builder lets you create a standout resume in
                minutes. Highlight your skills, experience, and achievements to make a lasting impression on potential
                employers.Apply directly to job postings with just a few clicks. Track your application status, get
                real-time notifications, and prepare for interviews with our curated tips and resources.Stay competitive in
                today’s job market with our career advice blog, professional development courses, and expert tips on resume
                writing, interview preparation, and career advancement.
            </p>
        </div>
    </section>

   
   
  
@endsection
