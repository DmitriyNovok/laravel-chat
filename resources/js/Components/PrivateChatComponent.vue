<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <textarea class="form-control mb-4" rows="10" readonly>{{messages.join('\n')}}</textarea>
                <input @keyup.enter="sendMessage" @keydown="actionUser" v-model="message" type="text" class="form-control">
                <span v-if="isActive">{{ isActive.name }} печатает...</span>
            </div>
            <div class="col-sm-4">
                <p class="text-black">В сети</p>
                <ul>
                    <li v-for="activeUser in activeUsers">{{ activeUser }}</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'PrivateChatComponent',
        props: {
            route_messages: String,
            channel: String,
            user: Object
        },
        data() {
            return {
                messages: [],
                message : '',
                isActive: false,
                typingTimer: false,
                activeUsers: []
            }
        },
        methods: {
            sendMessage() {
                axios.post(this.route_messages, { message: this.message, channel: this.channel });
                this.messages.push(this.message);
                this.message = '';
            },
            actionUser() {
                window.Echo.join('channel.' + this.channel)
                    .whisper('typing', {
                        name: this.user.name
                    })
            }
        },
        mounted() {
            window.Echo.join('channel.' + this.channel)
                .here((users) => {
                    this.activeUsers = users;
                })
                .joining((user) => {
                    this.activeUsers.push(user);
                })
                .leaving((user) => {
                    this.activeUsers.splice(this.activeUsers.indexOf(user), 1)
                })
                .listen('PrivateMessage', ({data}) => {
                    this.messages.push(data.message);
                    this.isActive = false;
                })
                .listenForWhisper('typing', (e) => {
                    this.isActive = e;

                    if (this.typingTimer) {
                        clearTimeout(this.typingTimer)
                    }

                    this.typingTimer = setTimeout(() => {
                        this.isActive = false;
                    }, 2000);
                });
        }
    }
</script>
