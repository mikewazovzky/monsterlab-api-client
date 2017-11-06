class Param {
    constructor(key, value, active = true) {
        this.key = key;
        this.value = value;
        this.active = active;
    }

    toString() {
        return this.active ? `${this.key}=${this.value}` : '';
    }
}

export default Param;
