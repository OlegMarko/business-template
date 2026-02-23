import './bootstrap';
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';

createInertiaApp({
    title: (title) => (title ? `${title} — ${import.meta.env.VITE_APP_NAME || 'Business'}` : (import.meta.env.VITE_APP_NAME || 'Business')),
    resolve: (name) => {
        const pages = import.meta.glob('./Pages/**/*.vue');
        const path = `./Pages/${name.replace(/\./g, '/')}.vue`;
        const page = pages[path];
        if (!page) throw new Error(`Page not found: ${path}`);
        return page();
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el);
    },
});