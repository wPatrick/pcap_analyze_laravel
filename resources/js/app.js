import {createApp, h} from 'vue'
import {InertiaProgress} from '@inertiajs/progress'
import {createInertiaApp} from '@inertiajs/inertia-vue3'

import route from 'ziggy-js/dist/index.m';
import { Ziggy } from './ziggy.generated';
import { ZiggyVue } from 'ziggy-js/src/js/vue'

import {CustomWindow} from "@/custom-window";
// declare window: CustomWindow;
import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    wsHost: process.env.MIX_PUSHER_HOST,
    wsPort: process.env.MIX_PUSHER_PORT,
    wssPort: process.env.MIX_PUSHER_PORT,
    forceTLS: false,
    encrypted: true,
    disableStats: true,
    enabledTransports: ['ws', 'wss'],
});



InertiaProgress.init()

void createInertiaApp({
    resolve: name => require(`./Pages/${name}`),
    title: title => title ? `${title} - Ping CRM` : 'Ping CRM',
    setup({el, app, props, plugin}) {
        createApp({render: () => h(app, props)})
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .mount(el)
    },
})
