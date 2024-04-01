import Category from "@/src/Category/Structure/Category";

export default class Notification {
    constructor(params = {}) {
        /** @type string */
        this.id = params.id;

        /** @type string */
        this.content = params.content;

        /** @type string */
        this.type = params.type;

        /** @type Role|null */
        this.category = params.category ? new Category(params.category) : null;

        /** @type string */
        this.created_at = params.created_at;
    }
}
