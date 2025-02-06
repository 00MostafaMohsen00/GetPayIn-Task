import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import MainLayout from "@/Layouts/MainLayout.vue";
import { ZiggyVue } from 'ziggy';
import { InertiaProgress } from '@inertiajs/progress';
import '../css/app.css';
import 'vue-toast-notification/dist/theme-sugar.css';
import Vue3Lottie from 'vue3-lottie';
import '@fortawesome/fontawesome-free/css/all.css';


InertiaProgress.init({
    delay: 0,
    color: '#4B5563',
    includeCSS: true,
    showSpinner: true,
});

createInertiaApp({
    resolve: async (name) => {
        const pages = import.meta.glob('./Pages/**/*.vue');
        const page = (await pages[`./Pages/${name}.vue`]());
            page.default.layout = page.default.layout || MainLayout;
            return page;
    },
    setup({ el, App, props, plugin }) {
            const app = createApp({ render: () => h(App, props) });
            app.use(plugin)
                .use(ZiggyVue)
                .use(Vue3Lottie)
                .mount(el);

            // Set the direction based on the locale
            document.documentElement.dir = props.initialPage.props.local_dir;
        },
    });
