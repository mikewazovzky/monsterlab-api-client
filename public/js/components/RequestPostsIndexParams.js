import Param from '../param.js';
import RequestParameter from './RequestParameter.js';

export default Vue.component('request-posts-index-params', {
    template: `
        <div>
            <request-parameter
                v-for="(item, index) in query"
                :parameter.sync="query[index]"
                @update:parameter="onChange(index, $event)">
            </request-parameter>
        </div>
    `,

    props: ['params'],

    data() {
        return {
            query: [
                new Param('id', 101, false),
                new Param('tag', '', false),
                new Param('year', 2017, false),
                new Param('month', 'October', false),
                new Param('popular', 'DESC', false),
                new Param('limit', 10, false),
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
        onChange(index, data) {
            this.$emit('update:params', this.updatedQuery);
        },


    }
});
