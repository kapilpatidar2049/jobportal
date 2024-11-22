<!-- JAVASCRIPT -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ url('assets/toastr/toastr.js') }}"></script>
<script src="{{ url('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('assets/datatable/datatables.min.js') }}"></script>


@yield('scripts')
<!-- <script src="{{ URL::asset('admin_theme/marketplace/build/libs/metismenu/metisMenu.min.js') }}"></script> -->
<script src="{{ URL::asset('admin_theme/marketplace/build/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('admin_theme/marketplace/build/libs/node-waves/waves.min.js') }}"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<!-- Icon -->
<script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>
<script src="{{ url('admin_theme/marketplace/js/profile.js') }}"></script>
<script src="{{ URL('admin_theme/marketplace/build/js/meet.js') }}"></script>
<script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    new DataTable('.example', {
        layout: {
            bottomEnd: {
                paging: {
                    firstLast: false
                }
            }
        }
    });
</script>



<script>
   $(document).ready(function () {
    // Toggle `tone_box` when clicking on `tone_setting`
    $('#tone_setting').click(function (event) {
        event.stopPropagation();
        $('#tone_box').toggle();

        // Toggle the icon based on `tone_box` visibility
        if ($('#tone_box').is(':visible')) {
            $('.tone_setting_downicon').removeClass('fa-chevron-down').addClass('fa-chevron-right');
        } else {
            $('.tone_setting_downicon').removeClass('fa-chevron-right').addClass('fa-chevron-down');
        }
    });

    // Hide `tone_box` and reset icon when clicking outside
    $(document).click(function () {
        if ($('#tone_box').is(':visible')) {
            $('#tone_box').hide();
            $('.tone_setting_downicon').removeClass('fa-chevron-right').addClass('fa-chevron-down');
        }
    });

    // Prevent hiding when clicking inside `tone_box`
    $('#tone_box').click(function (event) {
        event.stopPropagation();
    });
});
</script>

<!-- Tooltip Js -->
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
{{-- $('[data-toggle="tooltip"]').each(function() {
    if (!$(this).data('bs.tooltip')) {
        new bootstrap.Tooltip(this);
    }
}); --}}
<script>
    // Initialize tooltip manually for the chat button
    var chatButton = document.getElementById('chatButton');
    var chatTooltip = new bootstrap.Tooltip(chatButton);

    // Ensure modal and tooltip work independently
    chatButton.addEventListener('click', function() {
        chatTooltip.hide(); // Hide the tooltip if the button is clicked to open the modal
    });
</script>
<script>
    // Initialize tooltip manually for the chat button
    var chatButton = document.getElementById('page-header-file-dropdown');
    var chatTooltip = new bootstrap.Tooltip(chatButton);

    // Ensure modal and tooltip work independently
    chatButton.addEventListener('click', function() {
        chatTooltip.hide(); // Hide the tooltip if the button is clicked to open the modal
    });
</script>
<script>
    // Initialize tooltip manually for the chat button
    var chatButton = document.getElementById('Languagebutton');
    var chatTooltip = new bootstrap.Tooltip(chatButton);

    // Ensure modal and tooltip work independently
    chatButton.addEventListener('click', function() {
        chatTooltip.hide(); // Hide the tooltip if the button is clicked to open the modal
    });
</script>
<script>
    // Initialize tooltip manually for the chat button
    var chatButton = document.getElementById('currencyDropdown');
    var chatTooltip = new bootstrap.Tooltip(chatButton);

    // Ensure modal and tooltip work independently
    chatButton.addEventListener('click', function() {
        chatTooltip.hide(); // Hide the tooltip if the button is clicked to open the modal
    });
</script>
<script>
    // Initialize tooltip manually for the chat button
    var chatButton = document.getElementById('page-header-notifications-dropdown');
    var chatTooltip = new bootstrap.Tooltip(chatButton);

    // Ensure modal and tooltip work independently
    chatButton.addEventListener('click', function() {
        chatTooltip.hide(); // Hide the tooltip if the button is clicked to open the modal
    });
</script>
<script>
    $(document).click(function(event) {
        var $target = $(event.target);
        
        // Check if the clicked target is NOT inside any dropdown or dropdown toggle button
        if (!$target.closest('.dropdown-menu').length && !$target.closest('[data-bs-toggle="dropdown"]').length) {
            // Hide all open dropdowns using Bootstrap's dropdown method
            $('[data-bs-toggle="dropdown"]').dropdown('hide');
        }
    });
</script>
<script>
    const paymentImage = document.getElementById('paymentImage');

    paymentImage.addEventListener('mouseover', function() {
        paymentImage.src = "{{ URL::asset('admin_theme/marketplace/images/hame2.svg') }}"; // Change on hover
    });

    paymentImage.addEventListener('mouseout', function() {
        paymentImage.src =
            "{{ URL::asset('admin_theme/marketplace/images/payment.svg') }}"; // Revert when not hovering
    });
</script>

<script>
    document.getElementById('sidebarCollapse').addEventListener('click', function() {
        var sidebar = document.getElementById('sidebar');
        var content = document.querySelector('.main-content');
        var topbar = document.getElementById('page-topbar');

        // Toggle the sidebar's collapsed state
        sidebar.classList.toggle('collapsed');

        // Adjust the top bar and main content to take full width
        if (sidebar.classList.contains('collapsed')) {
            topbar.classList.add('page-full-topbar'); // Add full-width class to topbar
            content.classList.add('main-full-content'); // Add full-width class to main content
        } else {
            topbar.classList.remove('page-full-topbar'); // Revert topbar width
            content.classList.remove('main-full-content'); // Revert main content width
        }
    });
</script>

<script>
    function toggleClass(clicked) {
        var projectElement = document.getElementById('exampleModalLongProject');
        var saveElement = document.getElementById('exampleModalLongSave');

        if (clicked === 'project') {
            document.getElementById('projectFileDiv').style.display = 'block';
            document.getElementById('saveProjectDiv').style.display = 'none';
            projectElement.classList.add('file_backline');
            saveElement.classList.remove('file_backline');

        } else if (clicked === 'save') {
            document.getElementById('projectFileDiv').style.display = 'none';
            document.getElementById('saveProjectDiv').style.display = 'block';
            saveElement.classList.add('file_backline');
            projectElement.classList.remove('file_backline');
        }
    }
</script>

<script>
    document.getElementById('startTracking').addEventListener('click', () => {
        // Open a new tab with the same URL
        window.open(window.location.href, '_blank');
        startScreenRecording();
    });

    async function startScreenRecording() {
        try {
            // Request screen sharing from the user
            const stream = await navigator.mediaDevices.getDisplayMedia({
                video: {
                    mediaSource: 'screen'
                },
                audio: true,
            });

            const mediaRecorder = new MediaRecorder(stream);
            const chunks = [];

            // Collect video data as it becomes available
            mediaRecorder.ondataavailable = event => {
                if (event.data.size > 0) {
                    chunks.push(event.data);
                }
            };

            // When recording stops, save the video file
            mediaRecorder.onstop = () => {
                const blob = new Blob(chunks, {
                    type: 'video/webm'
                });
                const url = URL.createObjectURL(blob);

                // Download the recorded file
                const a = document.createElement('a');
                a.href = url;
                a.download = 'screen-recording.webm';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                URL.revokeObjectURL(url);
            };

            // Start recording
            mediaRecorder.start();
            alert('Recording started');

        } catch (error) {
            console.error('Error accessing display media:', error);
            alert('Screen recording is not supported or permission was denied.');
        }
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dropdownElement = document.getElementById('currencyDropdown');
        if (dropdownElement) {
            new bootstrap.Dropdown(dropdownElement);
        }
    });
</script>
