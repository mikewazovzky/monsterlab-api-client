import Param from './param.js';

class Request {
    constructor({ method = 'get', host = '', path = '', query = [] } = {}) {
        this.method = method;
        this.host = host;
        this.path = path;
        this.query = query;
    }

    endpoint() {
        return '/request';
    }

    addParam($key, $value) {
        this.query.push(new Param($key, $value));
    }

    execute() {
        return new Promise((resolve, reject) => {
            axios.post(this.endpoint(), this)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    }

    url() {
        return `${this.host}${this.path}${this.queryString()}`;
    }

    queryString() {
        let char = '?';
        return this.query.reduce((query, item) => {
            query += char + item.toString();
            char = '&';
            return query;
        }, '');
    }
}

export default Request;
