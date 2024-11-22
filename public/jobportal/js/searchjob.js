"use sctrict";
$(document).ready(function () {
    let data = {};

    $('#findjobs').click(function () {
        const title = $('#title').val();
        const cities = $('#cities').val();
        const date = $('#date').val();
        const lang = $('#lang').val();
        const job_type = $('#job_type').val();
        const type = $('#type').val();
        const minimum = $('#minimumamount').val();
        const maximum = $('#maximumamount').val();

        // Collect data
        data = {
            title: title || null,
            city: cities || null,
            date: date || null,
            lang:lang||null,
            job_type: job_type || null,
            type: type || null,
            minimum: minimum || null,
            maximum: maximum || null,
        };

        // Optional: Validate inputs here
        searchJobs(data);
    });
    $('#lang').on('change',function () {
        const title = $('#title').val();
        const cities = $('#cities').val();
        const date = $('#date').val();
        const lang = $('#lang').val();
        const job_type = $('#job_type').val();
        const type = $('#type').val();
        const minimum = $('#minimumamount').val();
        const maximum = $('#maximumamount').val();

        // Collect data
        data = {
            title: title || null,
            city: cities || null,
            date: date || null,
            lang:lang||null,
            job_type: job_type || null,
            type: type || null,
            minimum: minimum || null,
            maximum: maximum || null,
        };

        // Optional: Validate inputs here
        searchJobs(data);
    });
    $('#date').on('change',function () {
        const title = $('#title').val();
        const cities = $('#cities').val();
        const date = $('#date').val();
        const lang = $('#lang').val();
        const job_type = $('#job_type').val();
        const type = $('#type').val();
        const minimum = $('#minimumamount').val();
        const maximum = $('#maximumamount').val();

        // Collect data
        data = {
            title: title || null,
            city: cities || null,
            date: date || null,
            lang:lang||null,
            job_type: job_type || null,
            type: type || null,
            minimum: minimum || null,
            maximum: maximum || null,
        };

        // Optional: Validate inputs here
        searchJobs(data);
    });

    $('#minimumamount').on('keyup',function () {
        const title = $('#title').val();
        const cities = $('#cities').val();
        const date = $('#date').val();
        const lang = $('#lang').val();
        const job_type = $('#job_type').val();
        const type = $('#type').val();
        const minimum = $('#minimumamount').val();
        const maximum = $('#maximumamount').val();

        // Collect data
        data = {
            title: title || null,
            city: cities || null,
            date: date || null,
            lang:lang||null,
            job_type: job_type || null,
            type: type || null,
            minimum: minimum || null,
            maximum: maximum || null,
        };

        // Optional: Validate inputs here
        searchJobs(data);
    });

    $('#maximumamount').on('keyup',function () {
        const title = $('#title').val();
        const cities = $('#cities').val();
        const date = $('#date').val();
        const lang = $('#lang').val();
        const job_type = $('#job_type').val();
        const type = $('#type').val();
        const minimum = $('#minimumamount').val();
        const maximum = $('#maximumamount').val();

        // Collect data
        data = {
            title: title || null,
            city: cities || null,
            date: date || null,
            lang:lang||null,
            job_type: job_type || null,
            type: type || null,
            minimum: minimum || null,
            maximum: maximum || null,
        };

        // Optional: Validate inputs here
        searchJobs(data);
    });

    $('#job_type').on('change',function () {
        const title = $('#title').val();
        const cities = $('#cities').val();
        const date = $('#date').val();
        const lang = $('#lang').val();
        const job_type = $('#job_type').val();
        const type = $('#type').val();
        const minimum = $('#minimumamount').val();
        const maximum = $('#maximumamount').val();

        // Collect data
        data = {
            title: title || null,
            city: cities || null,
            date: date || null,
            lang:lang||null,
            job_type: job_type || null,
            type: type || null,
            minimum: minimum || null,
            maximum: maximum || null,
        };
        // Optional: Validate inputs here
        searchJobs(data);
    });

    $('#type').on('change',function () {
        const title = $('#title').val();
        const cities = $('#cities').val();
        const date = $('#date').val();
        const job_type = $('#job_type').val();
        const type = $('#type').val();
        const minimum = $('#minimumamount').val();
        const maximum = $('#maximumamount').val();
        const lang = $('#lang').val();

        // Collect data
        data = {
            title: title || null,
            city: cities || null,
            date: date || null,
            lang:lang||null,
            job_type: job_type || null,
            type: type || null,
            minimum: minimum || null,
            maximum: maximum || null,
        };

        // Optional: Validate inputs here
        searchJobs(data);
    });



    function searchJobs(data) {
        $.ajax({
            url: 'search-jobs',
            method: 'POST',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token for Laravel
            },
            beforeSend: function () {
                $('#filteredjobs').html('<p>Loading jobs...</p>'); // Show loading message
            },
            success: function (response) {
                $('#filteredjobs').html(response); // Display results
            },
            error: function (error) {
                console.error('Error fetching jobs:', error);
                $('#filteredjobs').html('<p>Failed to fetch jobs. Please try again later.</p>'); // Show error message
            }
        });
    }
});