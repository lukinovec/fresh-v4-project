/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
// import Echo from '@ably/laravel-echo';
// import * as Ably from 'ably';
// window.Ably = Ably;

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

// Set window.tenantKey in <script>
const tenantPrefix = window.tenantKey ? window.tenantKey + '.' : '';

window.Echo.private(`users.${window.userId}`)
    .listen('TestingEvent', e => {
        console.log(e.tenant)
        console.log(e.user)
    }).listen('TestingEvent2', e => {
        console.log(e.tenant)
        console.log(e.user)
    })

if (tenantPrefix) {
    Object.keys(window.Echo.connector.channels).forEach(channel => {
        if (window.skippedChannels.includes(channel)) {
            // Skip cloning channels specifically defined as central channels
            return;
        }

        let tenantChannel = null

        if (channel.startsWith('private-encrypted-')) {
            tenantChannel = window.Echo.privateEncrypted(tenantPrefix + channel.split('-')[2])
        } else if (channel.startsWith('private-')) {
            tenantChannel = window.Echo.private(tenantPrefix + channel.split('-')[1])
        } else if (channel.startsWith('presence-')) {
            tenantChannel = window.Echo.presence(tenantPrefix + channel.split('-')[1])
        } else {
            tenantChannel = window.Echo.channel(tenantPrefix + channel)
        }

        // Give the tenant channel the original channel's callbacks (listen() etc.)
        tenantChannel.subscription.callbacks._callbacks = window.Echo.connector.channels[channel].subscription.callbacks._callbacks
    })
}
