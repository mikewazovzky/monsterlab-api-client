export default Vue.component('status', {
    template: `
        <pre id="status" v-text="status"></pre>
    `,

    props: ['message'],

    data() {
        return {
            status: this.message
        }
    },

    created() {
        window.events.$on('status:update', (message) => {
            if (message['trace']) message['trace'] = '...';
            this.status = message;
        });
    }
});
