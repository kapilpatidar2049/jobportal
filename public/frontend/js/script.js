// =========================Nav Bar==============================//
//Toggle Side Menu
function toggleMenu() {
  const sideMenu = document.getElementById('side-menu');
  const overlay = document.getElementById('overlay');
  sideMenu.style.width = '250px'; // Set the width to show the menu
  overlay.style.display = 'block'; // Show the overlay
}

// Close Side Menu
function closeMenu() {
  const sideMenu = document.getElementById('side-menu');
  const overlay = document.getElementById('overlay');
  sideMenu.style.width = '0'; // Hide the menu
  overlay.style.display = 'none'; // Hide the overlay
}

// Optional: Close side menu when clicking on a side-nav-link
document.querySelectorAll('.side-nav-link, .dropdown-link').forEach(function (link) {
  link.addEventListener('click', function () {
    closeMenu();
  });
});
// =========================Nav Bar==============================//

// =====================description slider===================//
document.addEventListener("DOMContentLoaded", function () {
  new Swiper('.description-swiper-container', {
    loop: true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    breakpoints: {
      600: {
        slidesPerView: 1,
      },
      770: {
        slidesPerView: 1,
      },
      993: {
        slidesPerView: 1,
      },
      1000: {
        slidesPerView: 1,
      },
    }
  });
});

// =====================description slider===================//

// =====================Popular Service======================//
document.addEventListener("DOMContentLoaded", function () {
  const swiper = new Swiper('.service-swiper-container', {
    loop: true,
    speed: 2000, // Adjust speed for smoother movement
    // autoplay: {
    //   delay: 3,
    //   disableOnInteraction: false,
    // },
    
    // spaceBetween: 20,
    breakpoints: {
      1200: {
        slidesPerView: 7,
      },
      992: {
        slidesPerView: 6,
      },
      768: {
        slidesPerView: 5,
      },
      576: {
        slidesPerView: 4,
      },
      0: {
        slidesPerView: 2,
      }
    }
  });
});
// =====================Popular Service======================//

// =======================jobs section=======================//
document.addEventListener('DOMContentLoaded', function() {
  const swiper = new Swiper('.jobs-swiper-container', {
    loop: true,
    speed: 2000, // Adjust speed for smoother movement
    // autoplay: {
    //   delay: 1, // Continuous autoplay
    //   disableOnInteraction: false,
    // },
    grabCursor: true,
    spaceBetween: 10,
    slidesPerView: 'auto', // Adjust automatically for responsive
    centeredSlides: false, // Keeps slides aligned to the left
    breakpoints: {
      1200: {
        slidesPerView: 10,
      },
      992: {
        slidesPerView: 8,
      },
      768: {
        slidesPerView: 6,
      },
      576: {
        slidesPerView: 4,
      },
      0: {
        slidesPerView: 2,
      }
    }
  });
});


// =======================jobs section=======================//

// -------------------------review section--------------------//

    document.addEventListener('DOMContentLoaded', function() {
        // Switch between Job and Market reviews
        const jobBtn = document.getElementById('jobBtn');
        const marketBtn = document.getElementById('marketBtn');
        const jobReviews = document.getElementById('jobReviews');
        const marketReviews = document.getElementById('marketReviews');

        jobBtn.addEventListener('click', function() {
            jobReviews.style.display = 'flex';
            marketReviews.style.display = 'none';
            jobBtn.classList.add('active');
            marketBtn.classList.remove('active');
        });

        marketBtn.addEventListener('click', function() {
            marketReviews.style.display = 'flex';
            jobReviews.style.display = 'none';
            marketBtn.classList.add('active');
            jobBtn.classList.remove('active');
        });

        // Default to showing job reviews when the page loads
        window.onload = function() {
            jobReviews.style.display = 'flex';
            marketReviews.style.display = 'none';
            jobBtn.classList.add('active');
        };

        // Open video in full screen
        function openVideoFullscreen(card) {
            const video = card.querySelector('video');
            if (video) {
                const fullscreenVideo = document.createElement('video');
                fullscreenVideo.src = video.src;
                fullscreenVideo.autoplay = true;
                fullscreenVideo.controls = true;
                fullscreenVideo.style.position = 'fixed';
                fullscreenVideo.style.top = '50%';
                fullscreenVideo.style.left = '50%';
                fullscreenVideo.style.transform = 'translate(-50%, -50%)';
                fullscreenVideo.style.zIndex = '9999';
                fullscreenVideo.style.width = '100%';
                fullscreenVideo.style.height = '100%';
                document.body.appendChild(fullscreenVideo);

                fullscreenVideo.addEventListener('click', function() {
                    document.body.removeChild(fullscreenVideo);
                });
            }
        }

        // Add event listener to all review cards
        const reviewCards = document.querySelectorAll('.review-card');
        reviewCards.forEach(function(card) {
            card.addEventListener('click', function() {
                openVideoFullscreen(card);
            });
        });
    });
// -------------------------review section--------------------//
//  -------------------job page particle----------------------//
window.addEventListener('load', () => {
  const particlesContainer = document.querySelector('.particles-container');
  console.log(particlesContainer); // This should log the element if it exists
});

document.addEventListener('DOMContentLoaded', () => {
  const particlesContainer = document.querySelector('.particles-container');

  if (!particlesContainer) {
    console.error("No element with class 'particles-container' found in the DOM.");
    return;
  }

  function createParticle() {
    const particle = document.createElement('div');
    particle.classList.add('particle');

    // Set random position and animation delay for each particle
    particle.style.left = `${Math.random() * 100}%`;
    particle.style.top = `${Math.random() * 100}%`;
    particle.style.animationDelay = `${Math.random() * 3}s`;

    particlesContainer.appendChild(particle);

    // Remove particle after animation
    setTimeout(() => {
      particle.remove();
    }, 3000);
  }

  // Generate particles every 100ms
  setInterval(createParticle, 100);
});

//------------------------faq page-----------------//
function toggleAnswer(questionElement) {
  const allAnswers = document.querySelectorAll(".faq-answer");
  const allArrows = document.querySelectorAll(".arrow");
  const answer = questionElement.nextElementSibling;
  const arrow = questionElement.querySelector(".arrow");

  // Check if the clicked answer is already open
  const isAnswerOpen = answer.style.display === "block";

  // Close all answers and reset all arrows
  allAnswers.forEach(ans => ans.style.display = "none");
  allArrows.forEach(arr => arr.style.transform = "rotate(0deg)");

  // If the clicked answer was not open, open it
  if (!isAnswerOpen) {
    answer.style.display = "block";
    arrow.style.transform = "rotate(180deg)";
  }
}

// ---------------------help support chat------------------------------//

function openModal(modalId) {
  document.getElementById(modalId).style.display = 'flex';
}

function closeModal(modalId) {
  document.getElementById(modalId).style.display = 'none';
}

function openChat() {
  closeModal('jobPortalModal');
  closeModal('marketPlaceModal');
  toggleChat();
}

function toggleChat() {
  var chatBox = document.getElementById('chatBox');
  chatBox.style.display = chatBox.style.display === 'none' || chatBox.style.display === '' ? 'flex' : 'none';
}

// Enable or disable the Send button depending on input field status
// Enable send button if there's text, media, or a link
function enableSendButton() {
    const messageInput = document.getElementById("messageInput").value;
    const linkInput = document.getElementById("linkInput").value;
    document.getElementById("sendButton").disabled = !(messageInput || linkInput);
}

// Function to preview media file with fixed size
function previewMedia() {
    const fileInput = document.getElementById("fileInput");
    const file = fileInput.files[0];
    const chatContent = document.getElementById("chatContent");

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const mediaContainer = document.createElement("div");
            mediaContainer.classList.add("media-preview");

            // Preview image or video
            if (file.type.startsWith("image/")) {
                const img = document.createElement("img");
                img.src = e.target.result;
                img.alt = "Uploaded Image";
                img.classList.add("media-thumbnail");
                mediaContainer.appendChild(img);
            } else if (file.type.startsWith("video/")) {
                const video = document.createElement("video");
                video.src = e.target.result;
                video.controls = true;
                video.classList.add("media-thumbnail");
                mediaContainer.appendChild(video);
            }

            chatContent.appendChild(mediaContainer);
        };
        reader.readAsDataURL(file);
    }
}

// Function to toggle chat box size between small and medium
function toggleChatSize() {
    const chatBox = document.getElementById("chatBox");
    chatBox.classList.toggle("small");
    chatBox.classList.toggle("medium");

    // Update icon depending on size
    const resizeIcon = document.querySelector(".resize-icon i");
    if (chatBox.classList.contains("medium")) {
        resizeIcon.classList.remove("fa-expand");
        resizeIcon.classList.add("fa-compress");
    } else {
        resizeIcon.classList.remove("fa-compress");
        resizeIcon.classList.add("fa-expand");
    }
}

// Function to send the message or media preview to chat
function sendMessage() {
    const messageInput = document.getElementById("messageInput");
    const linkInput = document.getElementById("linkInput");
    const chatContent = document.getElementById("chatContent");

    // Append message text
    if (messageInput.value.trim()) {
        const messageElement = document.createElement("p");
        messageElement.textContent = messageInput.value;
        chatContent.appendChild(messageElement);
        messageInput.value = ""; // Clear input
    }

    // Append link
    if (linkInput.value.trim()) {
        const linkElement = document.createElement("a");
        linkElement.href = linkInput.value;
        linkElement.textContent = linkInput.value;
        linkElement.target = "_blank";
        linkElement.classList.add("chat-link");
        chatContent.appendChild(linkElement);
        linkInput.value = ""; // Clear input
    }

    // Reset file input for new uploads
    document.getElementById("fileInput").value = "";

    // Scroll to the bottom
    chatContent.scrollTop = chatContent.scrollHeight;
}
