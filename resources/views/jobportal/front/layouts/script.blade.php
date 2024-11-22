<script src="{{ url('assets/js/jquery.min.js') }}"></script>
<script src="{{ url('assets/toastr/toastr.js') }}"></script>
<script src="{{ url('/assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('assets/datatable/datatables.min.js') }}"></script>
<script src="{{ url('assets/datepicker/jquery-ui.js') }}"></script>
<script src="{{ url('assets/select2/select2.min.js') }}"></script>
{{-- <script src="https://cdn.tiny.cloud/1/qordj17iv3q6xc891d5yq08jnys9redwd40dlmh7b6db9cbd/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script> --}}

<script>
    function get_state_country(params) {
        if (params) {
            $.ajax({
                type: "GET",
                url: "{{ route('get.state.country') }}",
                data: {
                    city: params
                },
                success: function(data) {
                    if (data.status === 'True') {
                        $('.city_id').val(data.city_id);
                        $('.state').val(data.state);
                        $('.state_id').val(data.state_id);
                        $('.country').val(data.country);
                        $('.country_id').val(data.country_id);
                        $('.error').hide();
                    } else {
                        $('.city_id').val('');
                        $('.state').val('');
                        $('.state_id').val('');
                        $('.country').val('');
                        $('.country_id').val('');
                        $('.error').show();
                        $('.error').text(data.msg);
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest);
                }
            });
        }
    }
</script>
<script>
    $(document).ready(function() {
        $(".datepicker").datepicker({
            dateFormat: "yy-mm-dd",
        });
    });
</script>
<script>
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#' + input.name).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
{{-- Alert Code Start --}}
<script>
    $(document).ready(function() {
        $('.alert').delay(3000);
        $('.alert').hide(4000);
    });
</script>
{{-- Alert Code End --}}
{{-- <script>
    tinymce.init({
        selector: '#desc',
        plugins: [
            // Core editing features
            'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'link', 'lists', 'searchreplace',
            'table', 'visualblocks', 'wordcount',
            'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker',
            'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage',
            'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags',
            'autocorrect', 'typography', 'inlinecss', 'markdown',
        ],
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline  | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [{
                value: 'First.Name',
                title: 'First Name'
            },
            {
                value: 'Email',
                title: 'Email'
            },
        ],
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
            'See docs to implement AI Assistant')),
    });
</script> --}}
<script>
    $(document).ready(function() {
        $('.select2').select2({
            dropdownParent: $('#personalInformationModal'),
            placeholder: "Select Multiple",
            allowClear: true,
        });
    });
</script>
<script src="{{url('jobportal/js/notification.js')}}"></script>
@yield('scripts')
