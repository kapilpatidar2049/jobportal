@extends('jobportal.front.layouts.master')
@section('title', 'Chat')
@section('main-container')
    <div class="contentbar">
        <div class="row">
            <div class="col-12">
                <div class="client-area">
                    <div class="chat-user-list">
                        <div id="chat-app">
                            <ul class="list-group">
                                <!-- Single v-for loop for users -->
                                <div v-for="user in users" :key="user.id" class="message">
                                    <a :href="`/jobportal/chat/user/${user.id}`" :title="user.email">
                                        <li>
                                            <div class="row align-center"
                                                :class="{ 'highlight': user.seen == 0 && user.receiver_id == user.auth_id }">
                                                <div class="col-lg-1 col-3  ">
                                                    <img :src="user.avatar" alt="UserImage" class="img-fluid">
                                                </div>
                                                <div class="col-lg-11 col-9">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-12">
                                                            @{{ user.email }}
                                                        </div>
                                                        <div class="col-lg-3 col-12 text-small">
                                                            @{{ user.last_message }}
                                                        </div>
                                                        <div class="col-lg-3 col-12 text-small">
                                                            @{{ user.time }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </a>
                                    <hr style="background-color: var(--bg_black)">
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var userId = "{{ Auth::guard('jobportal')->user()->id }}"; // Get the authenticated user ID
        new Vue({
            el: '#chat-app',
            data: {
                users: [], // Store the list of users
                userId: userId,
            },
            mounted() {
                this.fetchUsers(); // Fetch users when the component mounts

                // Optionally, set an interval to refresh the user list
                setInterval(() => {
                    this.fetchUsers();
                }, 1000); // Adjust the interval as needed
            },
            methods: {
                fetchUsers() {
                    axios.get(`/jobportal/chat/user`) // Fetch users from the endpoint
                        .then(response => {
                            this.users = response.data;
                        })
                        .catch(error => {
                            console.error('Error fetching users:', error);
                        });
                },
            },
        });
    </script>
@endsection

<style scoped>
    .highlight {
        background-color: #f0f8ff;
        /* Highlight color for unseen messages */
    }

    .sendermsg {
        font-weight: bold;
        /* Optional: make it bold for sent messages */
    }
</style>
