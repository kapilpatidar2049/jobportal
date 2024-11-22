"use strict";
$(document).ready(function () {
    var savedLang = localStorage.getItem('selectedLang');
    var savedCountry = localStorage.getItem('selectedCountry');

    if (savedLang) {
        $('#selectlang').text(savedLang); // Set previously saved language
    }
    if (savedCountry) {
        $('#selectcountry').text(savedCountry); // Set previously saved country
    }
    $('#savelang').on('click', function () {
        var lang = $('#language option:selected').text();
        var country = $('#country').val();
        $('#selectlang').text(lang);
        $('.selectcountry').text(country);
        localStorage.setItem('selectedLang', lang);
        localStorage.setItem('selectedCountry', country);
    });
    $('#jobtype').on('change', function () {
        var val = $(this).val();
        if (val == 'remote') {
            $('#city').addClass('d-none');
            $('#ads').removeClass('d-none');
        } else {
            $('#city').removeClass('d-none');
            $('#ads').addClass('d-none');
        }
    });
    $('#yes').on('click', function () {
        $('#adsloc').removeClass('d-none');
    });
    $('#no').on('click', function () {
        $('#adsloc').addClass('d-none');
    });
    $('#startdateyes').on('click', function () {
        $('#startdate').removeClass('d-none');
    });
    $('#startdateno').on('click', function () {
        $('#startdate').addClass('d-none');
    });
});
//Select Multiple Radio button
const jobButtons = document.querySelectorAll('.job-btn');
jobButtons.forEach(button => {
    button.addEventListener('click', function () {
        const checkbox = this.querySelector('input[type="checkbox"]');
        var checkboxval = checkbox.value;
        checkbox.checked = !checkbox.checked;
        const icon = this.querySelector('i');

        // Toggle button state and icon
        if (checkbox.checked) {
            this.classList.add('selected');
            icon.className = 'fas fa-check';
        } else {
            this.classList.remove('selected');
            icon.className = 'fas fa-plus';
        }
        const freelanceChecked = document.querySelector('input[value="Freelance"]').checked;
        const contractualChecked = document.querySelector('input[value="Contractual/Temporary"]').checked;
        const parttimeChecked = document.querySelector('input[value="Part-time"]').checked;
        if (parttimeChecked) {
            document.getElementById('parttimediv').classList.remove('d-none');
        } else {
            document.getElementById('parttimediv').classList.add('d-none');
        }
        if (freelanceChecked || contractualChecked) {
            document.getElementById('freelancediv').classList.remove('d-none');
        } else {
            document.getElementById('freelancediv').classList.add('d-none');
        }
    });
});

$(document).ready(function(){
    $('#showby').on('change',function(){
        const val = $(this).val();
        if(val == 'fixed hours')
        {
            $('#fixed').removeClass('d-none');
            $('#range').addClass('d-none');
        }else if(val == 'Range'){
            $('#fixed').addClass('d-none');
            $('#range').removeClass('d-none');
            $('#maximumdiv').removeClass('d-none');
            $('#minimumdiv').removeClass('d-none');
        }else if(val == 'Minimum'){
            $('#fixed').addClass('d-none');
            $('#maximumdiv').addClass('d-none');
             $('#minimumdiv').removeClass('d-none');
            $('#range').removeClass('d-none');
        }else if(val == 'Maximum'){
            $('#fixed').addClass('d-none');
            $('#minimumdiv').addClass('d-none');
            $('#range').removeClass('d-none');
             $('#maximumdiv').removeClass('d-none');
        }
    });

    $('#payby').on('change',function(){
        const val = $(this).val();
        console.log(val);

        if(val == 'Exact Amount'){
            $('#exact').removeClass('d-none');
            $('#amountrange').addClass('d-none');
        }else if(val == 'Range'){
            $('#exact').addClass('d-none');
            $('#amountrange').removeClass('d-none');
            $('#maximumamountdiv').removeClass('d-none');
            $('#minimumamountdiv').removeClass('d-none');
        }else if(val == 'Minimum'){
            $('#exact').addClass('d-none');
            $('#maximumamountdiv').addClass('d-none');
             $('#minimumamountdiv').removeClass('d-none');
            $('#amountrange').removeClass('d-none');
        }else if(val == 'Maximum'){
            $('#exact').addClass('d-none');
            $('#minimumamountdiv').addClass('d-none');
            $('#amountrange').removeClass('d-none');
             $('#maximumamountdiv').removeClass('d-none');
        }
    });
});

$(document).ready(function() {
    $(document).on('change','.jobstatus', function() {
        var id = $(this).data('id');
        var val = $(this).val();
        // console.log('id = '+id+ ' ::: Value = '+val);
        $.ajax({
            url: '/jobportal/jobstatus/update',
            type: 'POST',
            data: {
                id: id,
                value: val
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status == 200) {
                    toastr.success(response.message);
                }
            },
            error: function(xhr, status) {
                toastr.error('Something Went Wrong');

            }
        });

    });
});

$(document).ready(function(){
    $('.job-filter').on('click',function(){
        $('.job-filter').removeClass('active');
        $(this).addClass('active');
        var status = $(this).data('status');
        $.ajax({
            url: '/jobportal/emp/job/filter',
            type: 'POST',
            data: {
                status:status
            },
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            success:function(response){
                console.log(response);

                $('#jobs').html(response);
            }
        })
    });
});