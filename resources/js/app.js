import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";

import { OhVueIcon, addIcons } from "oh-vue-icons";
import {
    FaHome,
    FaTachometerAlt,
    FaTasks,
    FaCog,
    FaStickyNote,
    FaPlus,
} from "oh-vue-icons/icons";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue"),
        ),
    setup({ el, App, props, plugin }) {
        addIcons(FaHome, FaTachometerAlt, FaTasks, FaCog, FaStickyNote, FaPlus);

        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .component("v-icon", OhVueIcon)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
