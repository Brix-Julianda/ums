import "./bootstrap";
import "../css/app.css";
import "bootstrap";
import Swal from "sweetalert2";
import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { ZiggyVue } from "ziggy-js";
import "@fortawesome/fontawesome-free/css/all.min.css";

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        return pages[`./Pages/${name}.vue`];
    },
    // setup({ el, App, props, plugin }) {
    //     createApp({ render: () => h(App, props) })
    //         .use(plugin)
    //         .use(ZiggyVue)
    //         .mount(el);

    // },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });
        app.use(plugin);
        app.use(ZiggyVue);
        app.config.globalProperties.$swal = Swal;
        app.mount(el);
    },
});
