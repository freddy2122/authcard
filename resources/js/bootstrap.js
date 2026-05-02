/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

const pusherKey = import.meta.env.VITE_PUSHER_APP_KEY;
if (pusherKey) {
    const customHost = import.meta.env.VITE_PUSHER_HOST;
    const scheme = import.meta.env.VITE_PUSHER_SCHEME ?? 'https';
    const p = import.meta.env.VITE_PUSHER_PORT;
    const customPort = p != null && p !== '' ? Number(p) : null;

    const echoOptions = {
        broadcaster: 'pusher',
        key: pusherKey,
        cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
        forceTLS: scheme === 'https',
        encrypted: true,
        disableStats: true,
    };

    if (customHost) {
        const defaultPort = scheme === 'https' ? 443 : 80;
        const port = customPort ?? defaultPort;
        echoOptions.wsHost = customHost;
        echoOptions.wsPort = port;
        echoOptions.wssPort = port;
        echoOptions.enabledTransports = ['ws', 'wss'];
    }

    window.Echo = new Echo(echoOptions);
}
