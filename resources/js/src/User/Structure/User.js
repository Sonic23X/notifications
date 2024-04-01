export default class Notification {
    constructor(params = {}) {
        /** @type string */
        this.id = params.id;

        /** @type string */
        this.name = params.name;
    }
}
