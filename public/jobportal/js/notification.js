"use strict";
$(document).ready(function() {
    function checkNotification() {
        $.ajax({
            url: '/jobportal/check/notification',
            type: 'post',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                const notificationMenu = $('#notification-item'); // Get the notification dropdown
                notificationMenu.empty(); // Clear existing notifications

                if (Array.isArray(data[0]) && data[0].length > 0) {
                    var length = data[0].length;
                    var i = 0;
                    data[0].forEach(function(item) {
                        if (item.message) {
                            // Convert the timestamp to a relative time
                            const timeAgo = convertToTimeAgo(item.created_at);

                            if (item.read == 0) {
                                i++;
                                notificationMenu.prepend(
                                    `<li class="fw-bold dropdown-item"><i class="fa-solid fa-bell"></i> &nbsp;&nbsp;${item.message}</li>
                                    <div>   </div> <small class="float-left">${timeAgo}</small>

                                    <hr>`
                                );
                            } else {
                                notificationMenu.prepend(
                                    `<li class="dropdown-item"><div class="d-flex align-items-center"><i class="fa-solid fa-bell"></i> &nbsp;&nbsp;<span>${item.message}</span></div> <div class="float-end"><small>${timeAgo}</small></div> </li>

                                    <hr>`
                                );
                            }
                        } else {
                            console.log("Missing 'message' property in item:", item);
                        }
                    });
                    $('#count').text(i);
                } else {
                    // If no notifications, show a default message
                    notificationMenu.append('<li class="dropdown-item">No notifications</li>');
                }
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseText);
            }
        });
    }

    // Function to convert timestamp to a human-readable "X time ago" format
    function convertToTimeAgo(dateString) {
        const now = new Date();
        const pastDate = new Date(dateString);
        const diffInSeconds = Math.floor((now - pastDate) / 1000); // Difference in seconds

        if (diffInSeconds < 60) {
            return `${diffInSeconds} second${diffInSeconds !== 1 ? 's' : ''} ago`;
        } else if (diffInSeconds < 3600) {
            const diffInMinutes = Math.floor(diffInSeconds / 60);
            return `${diffInMinutes} minute${diffInMinutes !== 1 ? 's' : ''} ago`;
        } else if (diffInSeconds < 86400) {
            const diffInHours = Math.floor(diffInSeconds / 3600);
            return `${diffInHours} hour${diffInHours !== 1 ? 's' : ''} ago`;
        } else if (diffInSeconds < 2592000) {
            const diffInDays = Math.floor(diffInSeconds / 86400);
            return `${diffInDays} day${diffInDays !== 1 ? 's' : ''} ago`;
        } else if (diffInSeconds < 31536000) {
            const diffInMonths = Math.floor(diffInSeconds / 2592000);
            return `${diffInMonths} month${diffInMonths !== 1 ? 's' : ''} ago`;
        } else {
            const diffInYears = Math.floor(diffInSeconds / 31536000);
            return `${diffInYears} year${diffInYears !== 1 ? 's' : ''} ago`;
        }
    }
    setInterval(checkNotification, 1000);
    $('#notification').on('click', function(){
        $.ajax({
            url: '/jobportal/read/notification',
            type: 'post',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){

            }
        });
    });
});

$('.clearallnotification').on('click',function(){
    $.ajax({
        url: '/jobportal/clear/notification',
        type: 'post',
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        },
        success:function(data){
            const notificationMenu = $('#notification-item'); // Get the notification dropdown
            notificationMenu.empty();
            notificationMenu.html(`<li>No Notification</li>`);
            toastr.success(data.message);
        }
    });
});

$('#notificationlist .dropdown-menu').on('click', function (event) {
    event.stopPropagation(); // Prevent closing on inner click
});

// Dropdown bahar click hone par default behavior allow kijiye
$(document).on('click', function (event) {
    if (!$(event.target).closest('#notificationlist').length) {
        $('#notificationlist .dropdown-menu').dropdown('hide'); // Hide dropdown if clicked outside
    }
});