import Request from '../request.js';
import RequestPostsIndex  from './RequestPostsIndex.js';
import RequestPostsCreate from './RequestPostsCreate.js';
import RequestPostsUpdate from './RequestPostsUpdate.js';
import RequestPostsDelete from './RequestPostsDelete.js';

export default Vue.component('request-builder', {
    template: `
        <div class="panel panel-default request-builder">
            <div class="panel-heading">
                REQUEST BUILDER:
                <select id="types" v-model="type">
                    <option v-for="item in types" :value="item.component" v-text="item.title"></option>
                </select>

                <input v-show="showId" id="id" type="text" v-model="id"/>

                <button class="btn btn-primary btn-xs pull-right" @click="execute">Excecute</button>
            </div>

            <div class="panel-body">
                <component :is="type" :params.sync="request.query"></component>
            </div>

            <div class="panel-body">
                <strong><em>Request parameters</em></strong>
                <pre v-text="request"></pre>
            </div>

            <div class="panel-body">
                <em>
                    <strong>METHOD:</strong> <span v-text="request.method"></span>
                    <strong>URL:</strong>
                    <span v-text="request.url()"></span>
                </em>
            </div>
        </div>
    `,

    components: {
        RequestPostsIndex,
        RequestPostsCreate,
        RequestPostsUpdate,
        RequestPostsDelete
    },

    props: ['host'],

    data() {
        return {
            type: 'RequestPostsIndex',
            request: new Request(),
            id: 0
        };
    },

    created() {
        this.request.method = 'get';
        this.request.host = this.host;
        this.request.path = '/api/v1.01/posts';
    },

    watch: {
        type() {
            this.request.method = this.type === 'RequestPostsIndex' ? 'get' : 'post';
            this.updatePath();
            this.request.query = [];
        },

        id() {
            this.updatePath();
        }
    },

    computed: {
        // types() {
        //     return Object.keys(this.$options.components).filter(component => component != 'request-builder');
        // },

        types() {
            return [
                { title: 'Find Posts' , component: 'RequestPostsIndex' },
                { title: 'Create New Posts' , component: 'RequestPostsCreate' },
                { title: 'Update Posts' , component: 'RequestPostsUpdate' },
                { title: 'Delete Posts' , component: 'RequestPostsDelete' },
            ];
        },

        showId() {
            return this.type === 'RequestPostsUpdate' || this.type === 'RequestPostsDelete';
        }

    },

    methods: {
        execute() {
            this.request.execute().then(response => {
                window.events.$emit('status:update', response);
            });
        },

        updatePath() {
            switch (this.type) {
                case 'RequestPostsUpdate':
                    this.request.path = `/api/v1.01/posts/${this.id}/update`;
                    break;
                case 'RequestPostsDelete':
                    this.request.path = `/api/v1.01/posts/${this.id}/destroy`;
                    break;
                default:
                    this.request.path = '/api/v1.01/posts';
            }
        }
    }
});
