import '../css/robotocondensed.css'
import '../css/app.css'
import './bootstrap'

// Import icon libraries
import "quasar/src/css/index.sass";
import '@quasar/extras/roboto-font-latin-ext/roboto-font-latin-ext.css'

import quasarIconSet from 'quasar/icon-set/fontawesome-v6'
import '@quasar/extras/fontawesome-v6/fontawesome-v6.css'

import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { createApp, h } from 'vue'

import { ZiggyVue } from '../../vendor/tightenco/ziggy'

import { Quasar, Cookies, Notify, Dialog } from "quasar";
import quasarLang from 'quasar/lang/ru'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
        title: (title) => `${title} - ${appName}`,
        resolve: async name => await resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
        setup({ el, App, props, plugin }) {
                return createApp({ render: () => h(App, props) })
                        .use(plugin)
                        .use(ZiggyVue)
                        .use(Quasar, {
                                plugins: {
                                        Cookies,
                                        Notify,
                                        Dialog,
                                }, // import Quasar plugins and add here
                                iconSet: quasarIconSet,
                                lang: quasarLang,
                                config: {}, // quasar config see: https://quasar.dev/start/vite-plugin/
                        })
                        .mount(el);
        },
        progress: {
                color: '#4B5563',
        },
});

