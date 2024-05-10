<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <textarea class="form-control mb-4" rows="10" readonly>{{messages.join('\n')}}</textarea>
                <input @keyup.enter="sendMessage" v-model="message" type="text" class="form-control">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'PrivateChatComponent',
        props: {
            route_messages: String,
            channel: String
        },
        data() {
            return {
                messages: [],
                message : ''
            }
        },
        methods: {
            sendMessage() {
                axios.post(this.route_messages, { message: this.message, channel: this.channel });
                this.messages.push(this.message);
                this.message = '';
            }
        },
        mounted() {
            window.Echo.private('channel.' + this.channel)
                .listen('PrivateMessage', ({data}) => {
                    this.messages.push(data.message)
                })
        }
    }
</script>
