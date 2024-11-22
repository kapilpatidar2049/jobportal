@extends('frontend.layouts.master')
@section('content')
    <section class="hs_banner">
        <div class="hs_banner_content">
            <h1>How can I help you?</h1>
            <p>Welcome to the Job Portal Help Center!</p>
        </div>
    </section>
    <section class="hs_box">
        <p>We’re here to assist you with any questions or issues.</p>
        <div class="hs_row hs_box_card">
            <div class="col-auto hs_col" onclick="openModal('jobPortalModal')">
                <div class="row">
                    <div class="col-4">
                        <h2 class="help_heading">Job Portal</h2>
                        <h4 class="help_heading2">Help Center</h4>
                    </div>
                    <div class="col-8"><img src="/frontend/images/support3.png" alt="" class="hs-card-image">
                    </div>
                </div>
            </div>
            <div class="col-auto hs_col" onclick="openModal('marketPlaceModal')">
                <div class="row">
                    <div class="col-4">
                        <h2 class="help_heading">Market Place</h2>
                        <h4 class="help_heading2">Help Center</h4>
                    </div>
                    <div class="col-8"> <img src="/frontend/images/support1.jpg" alt="" class="hs-card-image">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Job Portal Modal -->
    <div class="modal_hs" id="jobPortalModal">
        <div class="modal-content_hs">
            <span class="close_hs" onclick="closeModal('jobPortalModal')"><i class="fa-solid fa-circle-xmark"
                    style="color: #000000;"></i></span>
            <h3 class="model_hs_heading">Select User Type</h3>
            <button class="hs_model_button" onclick="openChat()"><i class="fa-solid fa-comments"
                    style="color: #FFD43B;"></i> Jobseeker </button>
            <button class="hs_model_button" onclick="openChat()"><i class="fa-solid fa-comments"
                    style="color: #FFD43B;"></i> Employer </button>
        </div>
    </div>

    <!-- Market Place Modal -->
    <div class="modal_hs" id="marketPlaceModal">
        <div class="modal-content_hs">
            <span class="close_hs" onclick="closeModal('marketPlaceModal')"><i class="fa-solid fa-circle-xmark"
                    style="color: #000000;"></i></span>
            <h3 class="model_hs_heading">Select User Type</h3>
            <button class="hs_model_button" onclick="openChat()"><i class="fa-solid fa-comments"
                    style="color: #FFD43B;"></i> Freelancer</button>
            <button class="hs_model_button" onclick="openChat()"><i class="fa-solid fa-comments"
                    style="color: #FFD43B;"></i> Client</button>
        </div>
    </div>

    <!-- Chat Box -->
    <div class="chat-box-hs small" id="chatBox">
        <div class="chat-header-hs">
            <h3>Support Chat</h3>
            <span class="resize-icon" onclick="toggleChatSize()">
                <i class="fa-solid fa-expand" style="color: #000000;"></i>
            </span>
            <span onclick="toggleChat()">
                <i class="fa-solid fa-circle-xmark" style="color: #000000;     size:17px"></i>
            </span>
        </div>
        <div class="chat-content-hs" id="chatContent">
            <p>How can we assist you today?</p>
        </div>
        <div class="chat-input-hs">
            <div class="input-wrapper">
                <input type="text" id="messageInput" placeholder="Type a message..." oninput="enableSendButton()">
                <span class="hs_icon" onclick="document.getElementById('fileInput').click()">
                    <i class="fa-solid fa-paperclip" title="Attach File"></i>
                </span>
                <span class="hs_icon" onclick="document.getElementById('linkInput').focus()">
                    <i class="fa-solid fa-link" title="Add Link"></i>
                </span>
            </div>
            <button id="sendButton" onclick="sendMessage()">Send</button>
        </div>
        <input type="file" id="fileInput" style="display:none" onchange="previewMedia()">
        <input type="url" id="linkInput" style="display:none;" placeholder="Paste a link..." oninput="enableSendButton()">
    </div>
    
    
    
@endsection
