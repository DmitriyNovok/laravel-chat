<template>
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <textarea class="form-control" rows="10" readonly>{{messages.join('\n')}}</textarea>
                <hr>
                <input @keyup.enter="sendMessage" v-model="messageText" type="text" class="form-control">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'ChatComponent',
        data() {
            return {
                messages: [],
                messageText : ''
            }
        },
        methods: {
            sendMessage() {
                axios.post('/messages', { body: this.messageText });
                this.messages.push(this.messageText);
                this.messageText = '';
            }
        },
        mounted() {
            window.Echo.channel('chat')
                .listen('Message', ({message}) => {
                    this.messages.push(message)
                })
        }
    }
</script>
