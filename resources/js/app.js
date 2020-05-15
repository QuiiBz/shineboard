require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import App from './views/App';
import router from './router/router';

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
