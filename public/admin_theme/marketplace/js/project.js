"use strict"
            function showMoreSkills() {
                var moreSkills = document.getElementById('moreSkills');
                var btn = document.getElementById('viewMoreBtn');
                var viewbtn = document.getElementById('viewButton');

                if (moreSkills.style.display === "none") {
                    moreSkills.style.display = "block"; // Show hidden skills
                    viewbtn.innerHTML = "View Less"; // Change button text
                } else {
                    moreSkills.style.display = "none"; // Hide the skills again
                    viewbtn.innerHTML = "View More"; // Reset button text
                }
            }
      
            function showTypeBox() {
                var moreSkills = document.getElementById('project_type_Item');
                var btn = document.getElementById('type_button');

                if (moreSkills.style.display === "none") {
                    moreSkills.style.display = "block"; // Show hidden skills
                    btn.innerHTML = "-"; // Change button text
                } else {
                    moreSkills.style.display = "none"; // Hide the skills again
                    btn.innerHTML = "+"; // Reset button text
                }
            }

            function showItemBox() {
                var moreSkills = document.getElementById('project_rate_Item');
                var btn = document.getElementById('clear_button');

                if (moreSkills.style.display === "none") {
                    moreSkills.style.display = "block"; // Show hidden skills
                    btn.innerHTML = "-"; // Change button text
                } else {
                    moreSkills.style.display = "none"; // Hide the skills again
                    btn.innerHTML = "+"; // Reset button text
                }
            }
     
            function showFixedBox() {
                var moreSkills = document.getElementById('fixed_Item');
                var btn = document.getElementById('fixed_button');

                if (moreSkills.style.display === "none") {
                    moreSkills.style.display = "block"; // Show hidden skills
                    btn.innerHTML = "-"; // Change button text
                } else {
                    moreSkills.style.display = "none"; // Hide the skills again
                    btn.innerHTML = "+"; // Reset button text
                }
            }
     
            function showHourlyBox() {
                var moreSkills = document.getElementById('hourly_Item');
                var btn = document.getElementById('hourly_button');

                if (moreSkills.style.display === "none") {
                    moreSkills.style.display = "block"; // Show hidden skills
                    btn.innerHTML = "-"; // Change button text
                } else {
                    moreSkills.style.display = "none"; // Hide the skills again
                    btn.innerHTML = "+"; // Reset button text
                }
            }
        
            function showSkillsBox() {
                var moreSkills = document.getElementById('skills_Item');
                var btn = document.getElementById('skills_button');

                if (moreSkills.style.display === "none") {
                    moreSkills.style.display = "block"; // Show hidden skills
                    btn.innerHTML = "-"; // Change button text
                } else {
                    moreSkills.style.display = "none"; // Hide the skills again
                    btn.innerHTML = "+"; // Reset button text
                }
            }
      
            function showListingBox() {
                var moreSkills = document.getElementById('listing_Item');
                var btn = document.getElementById('listing_button');

                if (moreSkills.style.display === "none") {
                    moreSkills.style.display = "block"; // Show hidden skills
                    btn.innerHTML = "-"; // Change button text
                } else {
                    moreSkills.style.display = "none"; // Hide the skills again
                    btn.innerHTML = "+"; // Reset button text
                }
            }
     
            function showLocationBox() {
                var moreSkills = document.getElementById('location_Item');
                var btn = document.getElementById('location_button');

                if (moreSkills.style.display === "none") {
                    moreSkills.style.display = "block"; // Show hidden skills
                    btn.innerHTML = "-"; // Change button text
                } else {
                    moreSkills.style.display = "none"; // Hide the skills again
                    btn.innerHTML = "+"; // Reset button text
                }
            }
        
            function showLocationBox() {
                var moreSkills = document.getElementById('location_Item');
                var btn = document.getElementById('location_button');

                if (moreSkills.style.display === "none") {
                    moreSkills.style.display = "block"; // Show hidden skills
                    btn.innerHTML = "-"; // Change button text
                } else {
                    moreSkills.style.display = "none"; // Hide the skills again
                    btn.innerHTML = "+"; // Reset button text
                }
            }
      
            function showCountryBox() {
                var moreSkills = document.getElementById('country_Item');
                var btn = document.getElementById('country_button');

                if (moreSkills.style.display === "none") {
                    moreSkills.style.display = "block"; // Show hidden skills
                    btn.innerHTML = "-"; // Change button text
                } else {
                    moreSkills.style.display = "none"; // Hide the skills again
                    btn.innerHTML = "+"; // Reset button text
                }
            }
            
            $(document).on('click', '.all_industry_name', function() {
                // Remove class from all other industry names
                $('.all_industry_name').removeClass('all_industry_filter_active');
                
                // Add class to the clicked industry name
                $(this).addClass('all_industry_filter_active');
            });