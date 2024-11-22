<script src="{{ url('assets/js/jquery.min.js') }}"></script>
<script src="{{ url('assets/toastr/toastr.js') }}"></script>
<script src="{{ url('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('assets/datatable/datatables.min.js') }}"></script>
<script src="{{ url('assets/datepicker/jquery-ui.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
<script src="https://cdn.tiny.cloud/1/z3i0r6rywx0xm9ed8dixdovdob8ymm3sq23uuubqhrd25uxy/tinymce/6/tinymce.min.js"
    referrerpolicy="origin"></script>
@yield('scripts')
{{-- Side bar Code Start --}}
<script>
    $(document).ready(function() {
        if (localStorage.getItem('sidebarCollapsed') === 'true') {
            $('.sidebar').addClass('collapsed');
            $('.profile-section').addClass('collapsed');
            $('html').addClass('is-collapsed');

            $('#collapse-btn i').removeClass('fa-x').addClass('fa-bars'); // Change icon when collapsed
        }
        $('#collapse-btn').on('click', function() {
            $('.sidebar').toggleClass('collapsed');
            $('html').toggleClass('is-collapsed');
            $('.profile-section').toggleClass('collapsed');

            if ($('.sidebar').hasClass('collapsed')) {
                $('#collapse-btn i').removeClass('fa-x').addClass('fa-bars');
                $('#collapse-btn span').text('');
                localStorage.setItem('sidebarCollapsed', 'true');
            } else {
                $('#collapse-btn i').removeClass('fa-bars').addClass('fa-x');
                $('#collapse-btn span').text('  Collapse')
                localStorage.setItem('sidebarCollapsed', 'false');
            }
        });
    });
    // Menu Dropdown
    $('.menu-link').on('click', function() {
        // Close all other submenus
        $('.submenu').not($(this).next('.submenu')).slideUp();
        $('.toggle-icon').not($(this).find('.toggle-icon')).removeClass('rotate-arrow');

        // Toggle the clicked submenu
        $(this).next('.submenu').slideToggle();
        $(this).find('.toggle-icon').toggleClass('rotate-arrow');
    });

    // Toggle profile options
    $('#profile-options-toggle').on('click', function() {
        $('#profile-options').toggle();
    });

    // Close the dropdown if clicked outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.profile-section').length) {
            $('#profile-options').hide();
        }
    });
</script>
{{-- Side bar Code End --}}
{{-- Alert Code Start --}}
<script>
    $(document).ready(function() {
        $('.alert').delay(3000);
        $('.alert').hide(4000);
    });
</script>
{{-- Alert Code End --}}
<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "270px";
        localStorage.setItem('sidenavState', 'open');
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        localStorage.setItem('sidenavState', 'closed');
    }
    // Check the saved state on page load
    document.addEventListener('DOMContentLoaded', (event) => {
        const sidenavState = localStorage.getItem('sidenavState');
        if (sidenavState === 'open') {
            document.getElementById("mySidenav").style.width = "270px";
        } else {
            document.getElementById("mySidenav").style.width = "0";
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('.fullscreen-icon').on('click', function() {
            var icon = $(this).find('i');

            if (!document.fullscreenElement) {
                // Request fullscreen for the entire website
                $('html')[0].requestFullscreen().then(function() {
                    // Change icon to 'compress' once fullscreen is enabled
                    icon.removeClass('fa-expand').addClass('fa-compress');
                }).catch(function(err) {
                    alert(`Error attempting to enable fullscreen mode: ${err.message}`);
                });
            } else {
                // Exit fullscreen
                document.exitFullscreen().then(function() {
                    // Change icon back to 'expand' when exiting fullscreen
                    icon.addClass('fa-expand').removeClass('fa-compress');
                });
            }
        });
    });
</script>
<script>
    tinymce.init({
        selector: '#desc',
        plugins: [
            // Core editing features
            'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'link', 'lists', 'searchreplace',
            'table', 'visualblocks', 'wordcount',
            // Your account includes a free trial of TinyMCE premium features
            // Try the most popular premium features until Oct 30, 2024:
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
</script>
<script>
    new DataTable('#example');
</script>
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
<script src="{{url('jobportal/js/notification.js')}}"></script>

