@extends('frontend.layouts.master')
@section('content')
    <section class="faq_banner">
        <div class="faq_banner_content">
            <h1>FAQ's</h1>
            {{-- <p>Welcome to the Job Portal Help Center!</p> --}}
        </div>
    </section>
    <section class="faq_section">
        <div class="faq-container">
            <h1>FAQ's</h1>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleAnswer(this)">
                    How do I create an account?
                    <span class="arrow">&#9660;</span>
                </div>
                <div class="faq-answer">
                    Answer: To create an account, click on the “Sign Up” button at the top right of the homepage. Fill in
                    your details, verify your email, and you’re ready to start exploring job opportunities!
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleAnswer(this)">
                    How do I update my profile information?
                    <span class="arrow">&#9660;</span>
                </div>
                <div class="faq-answer">
                    Answer: Go to the “My Profile” section in your dashboard. Here, you can edit personal details, update
                    your resume, and add new skills or experience.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleAnswer(this)">
                    How do I search for jobs?
                    <span class="arrow">&#9660;</span>
                </div>
                <div class="faq-answer">
                    Answer: Use the search bar on the homepage to look for specific job titles, companies, or keywords. You
                    can also filter jobs by location, industry, and other preferences.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleAnswer(this)">
                    How do I apply for jobs?
                    <span class="arrow">&#9660;</span>
                </div>
                <div class="faq-answer">
                    Answer: Once you find a job that interests you, click on it to view details. If you meet the requirements, click
                    the “Apply” button. You’ll be asked to upload your resume and provide any additional information
                    requested by the employer.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleAnswer(this)">
                    What information should I include in my profile?
                    <span class="arrow">&#9660;</span>
                </div>
                <div class="faq-answer">
                    Answer: A complete profile should include your work experience, education, skills, and a summary about yourself.
                    Adding certifications, languages, and projects can also improve your profile visibility.
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question" onclick="toggleAnswer(this)">
                    What information should I include in my profile?
                    <span class="arrow">&#9660;</span>
                </div>
                <div class="faq-answer">
                    Answer: A complete profile should include your work experience, education, skills, and a summary about yourself.
                    Adding certifications, languages, and projects can also improve your profile visibility.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleAnswer(this)">
                    What information should I include in my profile?
                    <span class="arrow">&#9660;</span>
                </div>
                <div class="faq-answer">
                    Answer: A complete profile should include your work experience, education, skills, and a summary about yourself.
                    Adding certifications, languages, and projects can also improve your profile visibility.
                </div>
            </div>

        </div>
    </section>
@endsection
