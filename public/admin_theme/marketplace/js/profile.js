"use strict"

$(document).ready(function() {
    // When the user selects an image
    $('#imageinput').hide(); // Hide the file input
    $('#imageinput').change(function(e) {
        const reader = new FileReader();
        reader.onload = function(e) {
            $('#preview-image4').attr('src', e.target.result);
            $('#preview-image4').show();
            $('#imageinput').hide(); // Hide the file input
        }
        reader.readAsDataURL(this.files[0]);
    });

    // When the user clicks on the preview image
    $('#preview-image4').click(function() {
        $('#imageinput').click(); // Open the file input dialog
    });
});
$(document).ready(function() {
    // When the user selects an image
    $('#image').change(function(e) {
        const reader = new FileReader();
        reader.onload = function(e) {
            $('#preview-image3').attr('src', e.target.result);
            $('#preview-image3').show();
            $('#image').hide(); // Hide the file input
        }
        reader.readAsDataURL(this.files[0]);
    });

    // When the user clicks on the preview image
    $('#preview-image3').click(function() {
        $('#image').click(); // Open the file input dialog
    });
});

$(document).ready(function() {
    // When the user selects an image
    $('#image').change(function(e) {
        const reader = new FileReader();
        reader.onload = function(e) {
            $('#preview-image').attr('src', e.target.result);
            $('#preview-image').show();
            $('#image').hide(); // Hide the file input
        }
        reader.readAsDataURL(this.files[0]);
    });

    // When the user clicks on the preview image
    $('#preview-image').click(function() {
        $('#image').click(); // Open the file input dialog
    });
});


$(document).ready(function() {
    // When the user selects an image
    $('#companylogo').change(function(e) {
        const reader = new FileReader();
        reader.onload = function(e) {
            $('#preview-image2').attr('src', e.target.result);
            $('#preview-image2').show();
            $('#companylogo').hide(); // Hide the file input
        }
        reader.readAsDataURL(this.files[0]);
    });
    
    // When the user clicks on the preview image
    $('#preview-image2').click(function() {
        $('#companylogo').click(); // Open the file input dialog
    });
});




const inputElements = document.getElementsByClassName("create_user_name");
for (let i = 0; i < inputElements.length; i++) {
    inputElements[i].addEventListener("input", function() {
        const inputValue = this.value;
        const slugValue = inputValue.replace(/\s+/g, "_");
        this.value = slugValue;
    });
}

document.addEventListener('DOMContentLoaded', function () {
    var swiper = new Swiper('.client_slider', {
        slidesPerView: 1,
        spaceBetween: 10,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
});

// document.getElementById('image').addEventListener('change', function (event) {
//         const reader = new FileReader();
//         reader.onload = function () {
//             const previewImage = document.getElementById('preview-image');
//             previewImage.src = reader.result;
//             previewImage.style.display = 'block'; // Show the image preview
//         };
//         reader.readAsDataURL(event.target.files[0]);
// });

document.addEventListener('DOMContentLoaded', function() {
    // Image selection and camera functionality
    const openImageModalBtn = document.getElementById('openImageModal');
    const imageSelectionModal = document.getElementById('imageSelectionModal') ? new bootstrap.Modal(document.getElementById('imageSelectionModal')) : null;
    const selectImageBtn = document.getElementById('selectImageBtn');
    const takePictureBtn = document.getElementById('takePictureBtn');
    const fileInput = document.getElementById('formFile');
    const cameraModal = document.getElementById('cameraModal');
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const snapButton = document.getElementById('snap');
    const closeModalButton = document.getElementById('closeModal');
    const profileImage = document.getElementById('image');
    let stream;

    if (openImageModalBtn && imageSelectionModal) {
        openImageModalBtn.onclick = () => {
            imageSelectionModal.show();
        };
    }

    if (selectImageBtn && fileInput && imageSelectionModal) {
        selectImageBtn.onclick = () => {
            fileInput.click();
            imageSelectionModal.hide();
        };
    }

    if (takePictureBtn && imageSelectionModal) {
        takePictureBtn.onclick = () => {
            imageSelectionModal.hide();
            openCamera();
        };
    }

    if (fileInput) {
        fileInput.onchange = function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (profileImage) {
                        profileImage.src = e.target.result;
                    }
                }
                reader.readAsDataURL(this.files[0]);
            }
        };
    }

    function openCamera() {
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' } })
                .then(function(str) {
                    stream = str;
                    if (video) {
                        video.srcObject = stream;
                    }
                    if (cameraModal) {
                        cameraModal.style.display = 'block';
                    }
                })
                .catch(function(error) {
                    console.error("Error accessing the camera:", error);
                    alert("Unable to access the camera. Please make sure you've granted the necessary permissions.");
                });
        } else {
            alert("Sorry, your browser doesn't support accessing the camera.");
        }
    }

    if (closeModalButton) {
        closeModalButton.onclick = closeCamera;
    }

    function closeCamera() {
        if (stream) {
            stream.getTracks().forEach(track => track.stop());
        }
        if (cameraModal) {
            cameraModal.style.display = 'none';
        }
    }

    if (snapButton && canvas && video && fileInput) {
        snapButton.onclick = function(event) {
            // Prevent form submission
            event.preventDefault();

            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
            closeCamera();

            canvas.toBlob(function(blob) {
                const file = new File([blob], "camera_capture.jpg", { type: "image/jpeg" });

                // Update profile image preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (profileImage) {
                        profileImage.src = e.target.result;
                    }
                }
                reader.readAsDataURL(file);

                // Update file input
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                fileInput.files = dataTransfer.files;
            }, 'image/jpeg');
        };
    }

    // Custom reason modal functionality
    const reasonSelect = document.getElementById('delete-reason');
    const customReasonModal = document.getElementById('customReasonModal') ? new bootstrap.Modal(document.getElementById('customReasonModal')) : null;
    const saveCustomReasonBtn = document.getElementById('saveCustomReason');
    const deleteAccountForm = document.getElementById('deleteAccountForm');
    let customReason = '';

    if (reasonSelect) {
        reasonSelect.onchange = function() {
            if (this.value === 'other' && customReasonModal) {
                customReasonModal.show();
            }
        };
    }

    if (saveCustomReasonBtn) {
        saveCustomReasonBtn.onclick = function() {
            const customReasonInput = document.getElementById('custom-reason');
            if (customReasonInput) {
                customReason = customReasonInput.value.trim();
                if (customReason) {
                    if (customReasonModal) {
                        customReasonModal.hide();
                    }
                    // You can add visual feedback here if needed
                } else {
                    alert("Please provide a reason or select a different option.");
                }
            }
        };
    }

    if (deleteAccountForm) {
        deleteAccountForm.onsubmit = function(e) {
            if (reasonSelect.value === 'other' && !customReason) {
                e.preventDefault();
                alert("Please provide a custom reason for account deletion.");
                if (customReasonModal) {
                    customReasonModal.show();
                }
            } else if (reasonSelect.value === 'other') {
                // Append the custom reason to the form before submission
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'custom_reason';
                input.value = customReason;
                this.appendChild(input);
            }
        };
    }
});

// This function should be globally accessible
function get_state_country(params) {
    if (params && typeof getStateCountryUrl !== 'undefined') {
        $.ajax({
            type: "GET",
            url: getStateCountryUrl,
            data: {
                city: params
            },
            success: function(data) {
                if (data.status === 'True') {
                    const elements = {
                        '.city_id': data.city_id,
                        '.state': data.state,
                        '.state_id': data.state_id,
                        '.country': data.country,
                        '.country_id': data.country_id
                    };

                    for (const [selector, value] of Object.entries(elements)) {
                        const element = document.querySelector(selector);
                        if (element) {
                            if (element.tagName === 'INPUT') {
                                element.value = value;
                            } else {
                                element.textContent = value;
                            }
                        }
                    }

                    const errorElement = document.querySelector('.error');
                    if (errorElement) {
                        errorElement.style.display = 'none';
                    }
                } else {
                    const elements = ['.city_id', '.state', '.state_id', '.country', '.country_id'];
                    elements.forEach(selector => {
                        const element = document.querySelector(selector);
                        if (element && element.tagName === 'INPUT') {
                            element.value = '';
                        }
                    });

                    const errorElement = document.querySelector('.error');
                    if (errorElement) {
                        errorElement.style.display = 'block';
                        errorElement.textContent = data.msg;
                    }
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest);
            }
        });
    }
}

$(document).ready(function() {
    $('#industry').on('change', function() {
        var selectedOption = $(this).find('option:selected');
        var id = selectedOption.data('id');
        $.ajax({
            url: '/marketplace/subindustry',
            type: 'POST',
            data: {
                id: id
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response);
                $('#sub_industry').empty();
                $.each(response.subindustries, function(index, subindustry) {
                    $('#sub_industry').append(new Option(subindustry.name,
                        subindustry.name));
                });
            },
            error: function(xhr) {
                // Handle error
                console.error(xhr.responseText);
                alert('An error occurred while fetching subindustries.');
            }
        });
    });
});