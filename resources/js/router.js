import { createRouter, createWebHistory } from 'vue-router';

const router = createRouter({
    history: createWebHistory(),

    routes: [
        {
            path: '/',
            component: () => import('./views/Login.vue'),
            name: 'login'
        },


        {
            path: '/',
            component: () => import('./views/AppLayout.vue'),
            children: [
                {
                    path: '/dashboard',
                    component: () => import('./views/user/Dashboard.vue'),
                    name: 'dashboard'
                },

                {
                    path: '/settings',
                    component: () => import('./views/user/Settings.vue'),
                    name: 'settings'
                },


            ]

        },


    ]
})

export default router;
