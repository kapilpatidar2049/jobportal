"use strict";
$(document).ready(function () {
    let currentStep = 0;

    // Function to show the current step and hide the others
    function showStep(stepIndex) {
        $('.step').removeClass('active');
        $('.step').eq(stepIndex).addClass('active');
    }

    // Next button click
    $('.next-btn').click(function () {
        currentStep++;
        showStep(currentStep);
    });

    // Back button click
    $('.back-btn').click(function () {
        currentStep--;
        showStep(currentStep);
    });

    // Form submit
    // $('#multiStepForm').submit(function (e) {
    //     e.preventDefault();
    //     alert('Form submitted successfully!');
    // });
});