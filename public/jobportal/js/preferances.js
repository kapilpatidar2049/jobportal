
$(document).ready(function() {
    $('#add-email').click(function() {
        $('#email-wrapper').append(`
    <div class="email-input-group mb-2">
        <div class="input-group">
            <input type="email" name="email[]" class="form-control form-control-padding_10" placeholder="Enter email">
            <button type="button" class="btn btn-danger remove-email"><i class="fa-solid fa-minus"></i></button>
        </div>
    </div>
`);
    });

    // Remove email input field when clicking the "Remove" button
    $(document).on('click', '.remove-email', function() {
        $(this).closest('.email-input-group').remove();
    });
    $('.deadlinetime').on('click',function(){
        const val = $(this).val();
        if(val == 'yes'){
            $('#deadlinetime').removeClass('d-none');
        }else{
            $('#deadlinetime').addClass('d-none');
        }
    });
});