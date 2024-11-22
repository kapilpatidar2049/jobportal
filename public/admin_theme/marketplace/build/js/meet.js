'use strict';

document.addEventListener("DOMContentLoaded", function() {
    var meetingToggle = document.getElementById('meetingToggle');
    var arrowIcon = document.getElementById('arrowIcon');
    var meetingDropdown = document.getElementById('meetingDropdown');

    // Add event listener for collapse toggle
    meetingToggle.addEventListener('click', function() {
        if (meetingDropdown.classList.contains('show')) {
            // If dropdown is visible, switch to down arrow
            arrowIcon.classList.remove('fa-chevron-right');
            arrowIcon.classList.add('fa-chevron-down');
        } else {
            // If dropdown is hidden, switch to right arrow
            arrowIcon.classList.remove('fa-chevron-down');
            arrowIcon.classList.add('fa-chevron-right');
        }
    });

    // Listen to collapse event to check status when user clicks anywhere
    meetingDropdown.addEventListener('shown.bs.collapse', function() {
        arrowIcon.classList.remove('fa-chevron-down');
        arrowIcon.classList.add('fa-chevron-right');
    });

    meetingDropdown.addEventListener('hidden.bs.collapse', function() {
        arrowIcon.classList.remove('fa-chevron-right');
        arrowIcon.classList.add('fa-chevron-down');
    });
});
