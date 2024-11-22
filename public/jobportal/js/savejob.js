"use strict";
$(document).ready(function () {
    $('.save-job').on('click', function () {
        var jobId = $(this).data('jobid');
        $.ajax({
            url: 'savejob',
            type: 'POST',
            data: {
                jobId: jobId
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                toastr.success(response.message); SS
            },
            error: function (error, xhr, status) {
                toastr.error(error);
            }
        });
    });
    $('.btn-filter').on('click',function(){
        var status = $(this).data('status');
        $.ajax({
            url:'myjob/filter',
            type:'POST',
            data: {
                status:status
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response){
                $('#myjobsection').html(response);
            }
        });
    });

    $('.myjobstatus').on('click',function(){
        let status = $(this).data('status');
        let id = $(this).data('id');
        let statusText = $(this).closest('.job-card').find('.content').find('.status');
        $.ajax({
            url:'myjob/status',
            type:'POST',
            data:{
                id:id,
                status:status
            },
            headers: {
                "x-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
                statusText.text(status);
                toastr.success('status Updated Successfully!');
                if(status != 'interview'){
                    $('.interview-time').hide();
                }
            }
        });
    });

    // ------------------Not Intrested-------------------
    $(document).on('click','.notintrested',function(){
        var job_id = $(this).data('jobid');
        var $jobBox = $(this).closest('.job_box');
        $.ajax({
            url:'notintrested',
            type:'POST',
            data: {
                job_id : job_id,
            },
            headers: {
                "X-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                $jobBox.hide('slow');
            }
        });
    });
});