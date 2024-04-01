import User from '@/src/User/Structure/User';
import Notification from '@/src/Notification/Structure/Notification';

export default class Log {
    constructor(params = {}) {
        /** @type string */
        this.id = params.id;

        /** @type Notification|null */
        this.notification = params.notification ? new Notification(params.notification.data) : null;

        /** @type User|null */
        this.user = params.user ? new User(params.user.data) : null;

        /** @type string */
        this.sent_at = params.sent_at;
    }
}
