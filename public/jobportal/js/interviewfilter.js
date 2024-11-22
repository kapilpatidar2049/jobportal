"use strict";
$(document).ready(function(){
    $('.btn-filter').on('click',function(){
        let status = $(this).data('status');
        $.ajax({
            url:'interview/filter',
            type:'POST',
            data:{
                status:status
            },
            headers: {
                "x-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
                $('#candidates').html(response);
            }
        });
    });
});