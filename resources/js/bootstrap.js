import _ from 'lodash';
import axios from 'axios';
import Pusher from 'pusher-js';
import Echo from 'laravel-echo';

window._ = _;
window.axios = axios;

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.PUSHER_APP_KEY,
    cluster: import.meta.env.PUSHER_APP_CLUSTER,
    encrypted: true,
    forceTLS: true,

});
console.log(key);
