import { createRouter, createWebHistory } from 'vue-router';

const router = createRouter({
    history: createWebHistory(),

    routes: [
        {
            path: '/access',
            component: () => import('./views/Access.vue'),
            name: 'access'
        },

        {
            path: '/',
            component: () => import('./views/Login.vue'),
            name: 'login'
        },

        {
            path: '/user',
            component: () => import('./views/AppLayout.vue'),
            children: [
                {
                    path: '',
                    component: () => import('./views/./user/Index.vue'),
                    name: 'user.index'
                },
                {
                    path: 'create',
                    component: () => import('./views/./user/Create.vue'),
                    name: 'user.create'
                }


            ]

        },

        {
            path: '/campaign',
            component: () => import('./views/AppLayout.vue'),
            children: [
                {
                    path: '',
                    component: () => import('./views/campaign/Index.vue'),
                    name: 'campaign.index'
                },
                {
                    path: 'create',
                    component: () => import('./views/campaign/Create.vue'),
                    name: 'campaign.create'
                }


            ]

        },

        {
            path: '/ad',
            component: () => import('./views/AppLayout.vue'),
            children: [
                {
                    path: '',
                    component: () => import('./views/ad/Index.vue'),
                    name: 'ad.index'
                },
                {
                    path: 'create',
                    component: () => import('./views/ad/Create.vue'),
                    name: 'ad.create'
                },

                {
                    path: ':id/edit',
                    component: () => import('./views/ad/Edit.vue'),
                    name: 'ad.edit'
                },


            ]

        }
    ]
})

export default router;
