window._ = require('lodash');
window.Cookie = require('js-cookie');
window.axios = require('axios');
window.bootstrap = require('bootstrap');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = Cookie.get('csrfToken');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
}

window.Vue = require('vue');
window.eventManager = new Vue();
Vue.prototype._ = require("lodash");
Vue.prototype.events = new Vue();
window.flash = function(message, level = 'success') {
    window.eventManager.$emit('flash', {message, level});
}
