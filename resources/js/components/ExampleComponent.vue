<template>
    <div>
        <div id="chat-box" style="height: 400px; overflow-y: scroll; border: 1px solid #ccc;">
            <div v-for="msg in messages" :key="msg.id" class="message">
                <strong>{{ msg.sender_id === currentUser.id ? 'You' : 'Other User' }}:</strong> {{ msg.message }}
            </div>
        </div>
        <input type="text" v-model="newMessage" @keyup.enter="sendMessage" placeholder="Type your message..." />
    </div>
</template>

<script>
export default {
    data() {
        return {
            messages: [],
            newMessage: '',
            currentUser: { id: this.$store.state.user.id }, // Replace with actual user ID from your state management
        };
    },
    mounted() {
        this.loadMessages();
        const chatChannel = `chat.${this.$route.params.userId}`; // Assuming you're using Vue Router
        window.Echo.private(chatChannel).listen('MessageSent', (e) => {
            this.messages.push(e.message);
        });
    },
    methods: {
        loadMessages() {
            axios.get(`/chat/messages/${this.$route.params.userId}`).then(response => {
                this.messages = response.data;
            });
        },
        sendMessage() {
            if (this.newMessage) {
                axios.post('/chat/send', {
                    receiver_id: this.$route.params.userId,
                    message: this.newMessage
                }).then(response => {
                    this.newMessage = '';
                    this.loadMessages(); // Optional: reload messages after sending
                });
            }
        },
    },
};
</script>
