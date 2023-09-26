import './bootstrap.js';
import {createApp} from "vue";
import App from "@/App.vue";
import router from "./router";
import store from "./store";

import {languages, defaultLocale} from "./locales";
import {createI18n, useI18n} from "vue-i18n";

const localStorageLang = localStorage.getItem('lang');

const messages = Object.assign(languages);
const i18n = createI18n({
    legacy: false,
    locale: localStorageLang || defaultLocale,
    fallbackLocale: 'en',
    messages
})

const app = createApp(App, {
    setup() {
        const {t} = useI18n();
        return {t};
    }
});

app.use(router);
app.use(store);
app.use(i18n);


app.mount('#app');
