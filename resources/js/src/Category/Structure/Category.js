export default class Category {
    constructor(params = {}) {
        /** @type string */
        this.id = params.id;

        /** @type string */
        this.name = params.name;
    }
}
