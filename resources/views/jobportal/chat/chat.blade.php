@extends('jobportal.layouts.master')
@section('title', 'Chat With Jobseeker')
@section('page-style')
    <style>
        .fa-solid.fa-check {
            display: none;
        }

        .sendermsg .fa-solid.fa-check {
            display: inline;
        }
    </style>
@endsection
@section('main-container')
    <div class="contentbar">
        <div class="row">
            <div class="col-12">
                <div class="client-area mt-80">
                    <div class="chat-container" id="chat-app">
                        <h6>
                            <a href="{{ route('chat') }}" class="btn btn-primary rounded-circle" title="Back">
                                <i class="fa-solid fa-arrow-left"></i>
                            </a>
                            {{ $recieverEmail }}
                        </h6>
                        <div class="msg-container">
                            <div v-for="message in messages" :key="message.id" class="messsage"
                                :class="{ 'text-end': message.sender_id == userId }">
                                <span v-if="message.sender_id == userId" class="sendermsg"
                                    @contextmenu.prevent="showContextMenu($event, message)">
                                    @{{ message.message }}
                                    <i class="fa-solid fa-check" :class="{ 'read': message.seen == 1 }"></i>
                                </span>
                                <span v-else>
                                    @{{ message.message }}
                                    <i class="fa-solid fa-check" :class="{ 'read': message.seen == 1 }"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Custom Context Menu -->
                        <div v-if="contextMenuVisible" class="context-menu"
                            :style="{ top: contextMenuY + 'px', left: contextMenuX + 'px' }" @click="hideContextMenu">
                            <ul>
                                <li @click="optionOne(selectedMessage.id)">Option 1</li>
                                <li @click="optionTwo(selectedMessage.id)">Option 2</li>
                                <li @click="optionThree(selectedMessage.id)">Option 3</li>
                            </ul>
                        </div>

                        <!-- Message input and send button -->
                        <div class="message-input-container">
                            <div>
                                <div class="d-flex justify-content-evenly">
                                    <div class="col-11 text-end">
                                        <textarea v-model="newMessage" class="form-control form-control-padding_10" placeholder="Type your message..."></textarea>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary send-btn form-control form-control-padding_10"
                                            :disabled="sending" @click="sendMessage">
                                            <img src="{{ url('/assets/images/send.svg') }}" width="15px">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var receiverId = "{{ $receiverId }}";
        var userId = "{{ Auth::guard('jobportal')->user()->id }}";
        new Vue({
            el: '#chat-app',
            data: {
                newMessage: '',
                messages: [],
                receiverId: receiverId,
                userId: userId,
                sending: false,
                contextMenuVisible: false,
                contextMenuX: 0,
                contextMenuY: 0,
                selectedMessage: null
            },
            methods: {
                fetchMessages() {
                    axios.get(`/jobportal/chat/messages/${this.receiverId}`)
                        .then(response => {
                            this.messages = response.data;
                            this.scrollToBottom(); // Scroll to the bottom after fetching messages
                            this.markMessagesAsSeen();
                        })
                        .catch(error => {
                            console.error('Error fetching messages:', error);
                        });
                },
                sendMessage() {
                    if (this.newMessage.trim() === '') {
                        toastr.error('Message cannot be empty');
                        return;
                    }
                    this.sending = true;
                    axios.post('/jobportal/chat/send', {
                            receiver_id: this.receiverId,
                            message: this.newMessage
                        })
                        .then(response => {
                            this.newMessage = '';
                            this.fetchMessages(); // Fetch messages after sending
                        })
                        .catch(error => {
                            console.error('Error sending message:', error);
                        })
                        .finally(() => {
                            this.sending = false;
                        });
                },
                showContextMenu(event, message) {
                    if (message.sender_id === this.userId) {
                        this.contextMenuVisible = true;
                        this.contextMenuX = event.clientX; // X position of the click
                        this.contextMenuY = event.clientY; // Y position of the click
                        this.selectedMessage = message; // Store the selected message
                    }
                },
                hideContextMenu() {
                    this.contextMenuVisible = false;
                },
                optionOne(messageId) {
                    alert(`Option 1 clicked for message ID: ${messageId}`);
                    this.hideContextMenu();
                },
                optionTwo(messageId) {
                    alert(`Option 2 clicked for message ID: ${messageId}`);
                    this.hideContextMenu();
                },
                optionThree(messageId) {
                    alert(`Option 3 clicked for message ID: ${messageId}`);
                    this.hideContextMenu();
                },
                markMessagesAsSeen() {
                    const messageIds = this.messages.map(message => message.id);
                    if (messageIds.length) {
                        axios.post('/jobportal/chat/mark-seen', {
                                message_ids: messageIds,
                                receiverId: this.receiverId
                            })
                            .then(response => {
                            })
                            .catch(error => {
                                console.error('Error marking messages as seen:', error.response.data);
                            });
                    }
                },
                scrollToBottom() {
                    this.$nextTick(() => {
                        const msgContainer = this.$el.querySelector('.msg-container');
                        msgContainer.scrollTop = msgContainer.scrollHeight;
                    });
                },
            },
            created() {
                this.fetchMessages();
                setInterval(() => {
                    axios.get(`/jobportal/chat/messages/${this.receiverId}`)
                        .then(response => {
                            const prevLength = this.messages.length;
                            this.messages = response.data;
                            if (this.messages.length > prevLength) {
                                this.scrollToBottom();
                                this.markMessagesAsSeen(); // Mark new messages as seen
                            }
                        });
                }, 2000); // Fetch new messages every 2 seconds
            },
            mounted() {
                this.scrollToBottom(); // Scroll to bottom initially on page load

                window.addEventListener('click', this.hideContextMenu);
            },
            beforeDestroy() {
                window.removeEventListener('click', this.hideContextMenu);
            }
        });
    </script>
@endsection
