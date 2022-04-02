import Vue from "vue";
import Vuex from "vuex";
import createPersistedState from "vuex-persistedstate";
import moment from "moment";

Vue.use(Vuex);

export default new Vuex.Store({
    namespaced: true,
    plugins: [createPersistedState()],
    state: {
    },
    getters: {
    },
    actions: {
    },
    mutations: {
    }
});
