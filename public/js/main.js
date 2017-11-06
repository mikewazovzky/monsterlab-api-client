import Status from './components/Status.js';
import RequestBuilder from './components/RequestBuilder.js';

window.events = new Vue();

const app = new Vue({
    el: '#root',
    data: {
        showBuilder: false
    }
});
