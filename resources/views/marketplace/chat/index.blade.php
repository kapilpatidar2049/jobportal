@extends('marketplace.layouts.master')
@section('title', 'Chat')
@section('page-title', 'Chat')
@section('body')

<body data-sidebar="colored">@endsection
    @section('content')
        <div class="chat-container">
            <div class="row">
                <div class="col-md-3 chat_user_list_box">
                    <!-- User list -->
                    <div class="user-list">
                        <ul class="list-group">
                            @foreach ($users as $chatUser)
                                    @if(empty($chatUser))
                                    <a href="{{route('All.project')}}" class="btn btn-primary">{{__('+ Add Freelancer For Chat')}}</a>
                                    @endif
                                    
                                    @php($user = null)
                                    @if($chatUser->user_id == Auth::user()->id)
                                        @php($user = App\Models\User::where('id',$chatUser->client_id)->first())
                                    @elseif($chatUser->client_id == Auth::user()->id) 
                                        @php($user = App\Models\User::where('id',$chatUser->user_id)->first())
                                    @endif
                                 
                                    @if($user->id !== Auth::user()->id)
                                    <a href="{{ route('chats.index', ['receiver_id' => $user->id]) }}">
                                        <li class="list-group-item">
                                            <div class="d-flex">
                                                <img src="{{ asset('/images/' . $user->image) }}"
                                                    class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                                <h4>{{ $user->name }}</h4>
                                            </div>
                                        </li>
                                    </a>
                                    @endif
                            @endforeach
                           
                        </ul>
                    </div>
                </div>

                @if($selectedUser->id == Auth::user()->id)
                <div class="col-md-9" id="no_user_found">
                    <div class="d-flex justify-content-center align-items-center w-100 h-100">
                       <div class="text-center">
                        <i class="fa-regular fa-message fs-1"></i>
                        <h2>{{__("It's nice to chat with someone")}}</h2>
                           <p> {{__('Pick a person from left menu
                            and start your conversation')}}</p>
                       </div>
                    </div>
                </div>
                @else
                <div class="col-md-9">
                    <h4 id="selectedUser">
                        @if ($selectedUser)
                            <div class="d-flex">
                                <img src="{{ asset('/images/' . $selectedUser->image) }}"
                                    class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                <h4>{{ $selectedUser->name }}</h4>
                            </div>
                        @else
                            {{__('Select a user to start chatting')}}
                        @endif
                    </h4>

                    <!-- Chat window showing previous messages -->
                    <div class="chat-window w-100 mt-4">
                        @foreach ($messages as $message)
                            <div class="message {{ $message->sender_id == Auth::id() ? 'my-message' : 'their-message' }}">
                                <div>
                                    @if ($message->attachment)
                                        <a href="{{ Storage::url($message->attachment) }}" target="_blank">
                                            @php($fileExtension = pathinfo($message->attachment, PATHINFO_EXTENSION))
                                        
                                            @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif']))
                                                <img src="{{ asset('/images/' . $message->attachment) }}" alt="Image"
                                                    style="max-width: 200px;">
                                            @else
                                                {{__('Download File')}}
                                            @endif
                                        </a>
                                    @endif
                                    @if ($message->message)
                                        <div class="message-content">
                                            <p class="pe-4">{{ $message->message }}</p>
                                            <small class="pe-4">{{ $message->created_at->format('H:i:s') }}</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Message sending form -->
                    <form action="{{ route('chats.sendMessage') }}" method="POST" enctype="multipart/form-data"
                        id="chat-form">
                        @csrf
                        <input type="hidden" name="receiver_id" id="receiver_id" value="{{ $selectedUser->id }}">
                        <div> <span id="selected_file_name" class="ms-2"></span></div>
                        <div class="d-flex">
                            <textarea name="message" placeholder="Type your message..." class="form-control mb-2"></textarea>
                            <input type="file" name="attachment" class="form-control mx-2 d-none chat_file_select"
                                accept="image/*, .pdf, .doc, .docx" />
                            <button type="button" class="btn chat_send_file">
                                <i class="fa-solid fa-paperclip fs-2"></i>
                            </button>
                            <button type="submit" class="btn me-2" id="chat_send_button"><i
                                    class="fa-solid fa-paper-plane fs-2"></i></button>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>


    @endsection
    @section('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            // Scroll to the latest message when the page loads or after a new message is sent/received
            const chatWindow = document.querySelector('.chat-window');
            chatWindow.scrollTop = chatWindow.scrollHeight;
        </script>
        <script>
            // AJAX call to set the receiver ID
            $('.chat-link').on('click', function(e) {
                e.preventDefault();

                var receiver_id = $(this).data('receiver-id');

                $.ajax({
                    url: '{{ route('chats.setReceiver') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        receiver_id: receiver_id
                    },
                    success: function(response) {
                        window.location.href = '{{ route('chats.index') }}?receiver_id=' + receiver_id;
                    }
                });
            });
        </script>

        <script>
            setInterval(function() {
                const receiverId = $('#receiver_id').val();

                $.ajax({
                    url: '{{ route('chats.fetchMessages') }}',
                    type: 'GET',
                    data: {
                        receiver_id: receiverId
                    },
                    success: function(messages) {
                        let chatWindow = $('.chat-window');

                        // Store the current scroll position and height
                        const isNearBottom = chatWindow.scrollTop() + chatWindow.innerHeight() >=
                            chatWindow[0].scrollHeight - 100;

                        // Clear existing messages and load new ones
                        chatWindow.empty();
                        messages.forEach(function(message) {
                            const messageClass = message.sender_id === {{ Auth::id() }} ?
                                'my-message' : 'their-message';
                            let messageElement = '';

                            // Check if there's a file attachment
                            if (message.attachment && message.message) {
                                // Get the file extension to display images or link for download
                                const fileExtension = message.attachment.split('.').pop()
                                    .toLowerCase();
                                let fileUrl = "{{ asset('images') }}/" + message.attachment;

                                messageElement = `
                            <div class="message ${messageClass}">
                                <div class="message-content">
                                    <!-- Display the file attachment (image or download link) -->
                                    <a href="${fileUrl}" target="_blank">
                                        ${['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension) ? 
                                            `<img src="${fileUrl}" alt="Image" style="max-width: 200px;">` :
                                            'Download File'}
                                    </a>
                                    <p>${message.message}</p> <!-- Display the text message -->
                                    <small>${new Date(message.created_at).toLocaleTimeString()}</small>
                                </div>
                            </div>
                        `;
                            } else if (message.attachment) {
                                // If there's only an attachment, display the attachment
                                const fileExtension = message.attachment.split('.').pop()
                                    .toLowerCase();
                                let fileUrl = "{{ asset('images') }}/" + message.attachment;

                                messageElement = `
                            <div class="message ${messageClass}">
                                <div class="message-content">
                                    <div>
                                    <a href="${fileUrl}" target="_blank">
                                        ${['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension) ? 
                                            `<img src="${fileUrl}" alt="Image" style="max-width: 200px;">` :
                                            'Download File'}
                                    </a>
                                    </div>
                                    <small>${new Date(message.created_at).toLocaleTimeString()}</small>
                                </div>
                            </div>
                        `;
                            } else if (message.message) {
                                // If there's no attachment, just display the text message
                                messageElement = `
                            <div class="message ${messageClass}">
                                <div class="message-content">
                                    <p>${message.message}</p>
                                    <small>${new Date(message.created_at).toLocaleTimeString()}</small>
                                </div>
                            </div>
                        `;
                            }

                            chatWindow.append(messageElement);
                        });

                        // Only scroll to the bottom if the user was near the bottom before new messages loaded
                        if (isNearBottom) {
                            chatWindow.scrollTop(chatWindow.prop("scrollHeight"));
                        }
                    }
                });
            }, 1000);
        </script>
        <script>
            $(document).ready(function() {
                $('.chat_send_file').on('click', function() {
                    $('.chat_file_select').click();
                });
                $('.chat_file_select').on('change', function() {
                    var fileName = $(this).val().split('\\').pop(); // Get the file name from the path
                    $('#selected_file_name').text(fileName); // Update the display element with the file name
                });

            });
        </script>

    @endsection
