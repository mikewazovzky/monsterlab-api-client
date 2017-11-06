import Param from '../param.js';

export default Vue.component('request-parameter', {

    template: `
        <div class="param">
            <input type="checkbox" v-model="param['active']" @change="onChange"/>
            <span class="key" v-text="param['key']"></span>
            <input type="text" v-model="param['value']" :disabled="!param['active']" @input="onChange"/>
        </div>
    `,

    props: ['parameter'],

    data() {
        return {
            param: new Param(this.parameter.key, this.parameter.value, this.parameter.active)
        };
    },

    methods: {
        onChange() {
            this.$emit('update:parameter', this.param);
        }
    }
});
