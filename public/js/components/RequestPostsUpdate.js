import Param from '../param.js';
import RequestParameter from './RequestParameter.js';

export default Vue.component('request-posts-create', {
    template: `
        <div>
            <h4>Update: Update existing post.</h4>

            <request-parameter
                v-for="(item, index) in query"
                :parameter.sync="query[index]"
                @update:parameter="onChange">
            </request-parameter>
        </div>
    `,

    props: ['params'],

    data() {
        return {
            query: [
                new Param('title', '', false),
                new Param('body', '', false),
            ]
        };
    },

    created() {
        // Sync query with received data
        const keys = this.params.map(item => item.key);
        keys.forEach(key => {
            let param = this.query.find(item => item.key === key);
            param.active = true;
        });
    },

    computed: {
        updatedQuery() {
            return this.query.filter(item => item.active);
        }
    },

    methods: {
        onChange() {
            this.$emit('update:params', this.updatedQuery);
        }
    }
});
