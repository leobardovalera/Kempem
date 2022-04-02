require('./bootstrap');
import vueRouter from "vue-router";
import VCalendar from 'v-calendar';
import axios from "./axios";

Vue.prototype.$axios = axios;

import store from "./store";

Vue.config.ignoredElements = [/^ion-/]
Vue.use(vueRouter);
Vue.use(VCalendar, {});

import Questions from "./Components/Questions.vue";
if(document.getElementById('questions-wrapper')){
    Vue.component('questions', Questions);
    new Vue({ el: '#questions-wrapper', store });
}

import Instrument from "./Components/Instrument.vue";
if(document.getElementById('instrument-wrapper')){
    Vue.component('instrument', Instrument);
    new Vue({ el: '#instrument-wrapper', store });
}

import InstrumentOptions from "./Components/InstrumentOptions.vue";
if(document.getElementById('instrument-options-wrapper')){
    Vue.component('instrument-options', InstrumentOptions);
    new Vue({ el: '#instrument-options-wrapper', store });
}
