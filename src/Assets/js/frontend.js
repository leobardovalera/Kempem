require('./bootstrap');
import vueRouter from "vue-router";
import VCalendar from 'v-calendar';

import store from "./store";

Vue.config.ignoredElements = [/^ion-/]

window.Cookie = require('js-cookie');
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = csrfToken;
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
} else {
    console.error('CSRF token not found');
}
Vue.prototype.$axios = axios;

Vue.use(vueRouter);
Vue.use(VCalendar, {});

// import RemecardComponent from "./RemecardComponent.vue";
// Vue.component('remecard-component', RemecardComponent);
// new Vue({ el: '#remecard-component-wrapper', store });
