import VueRouter from 'vue-router';

import CreatePaste from '../views/CreatePaste';
import Paste from '../views/Paste';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: CreatePaste,
        },
        {
            path: '/:slug',
            name: 'paste',
            component: Paste,
        }
    ],
});

export default router;
