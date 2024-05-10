<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <textarea class="form-control mb-4" rows="10" readonly>{{messages.join('\n')}}</textarea>
                <input @keyup.enter="sendMessage" @keydown="actionUser" v-model="message" type="text" class="form-control">
                <span v-if="isActive">{{ isActive.name }} печатает...</span>
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
                typingTimer: false
            }
        },
        methods: {
            sendMessage() {
                axios.post(this.route_messages, { message: this.message, channel: this.channel });
                this.messages.push(this.message);
                this.message = '';
            },
            actionUser() {
                window.Echo.private('channel.' + this.channel)
                    .whisper('typing', {
                        name: this.user.name
                    })
            }
        },
        mounted() {
            window.Echo.private('channel.' + this.channel)
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
