import * as VueRouter from 'vue-router';

const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory(),
    routes: [
        {
            path: '/',
            component: () => import('@/views/Index.vue'),
            name: 'index',
        },
        {
            path: '/shop',
            component: () => import('@/views/shop/Shop.vue'),
            name: 'shop',
        },
        {
            path: '/shop/:id',
            component: () => import('@/views/shop/ShopDetails.vue'),
            name: 'shop.details'
        },
        {
            path: '/users/register',
            component: () => import('@/views/users/Register.vue'),
            name: 'users.register',
        },
        {
            path: '/users/login',
            component: () => import('@/views/users/Login.vue'),
            name: 'users.login',
        },
        {
            path: '/users/:id',
            component: () => import('@/views/users/User.vue'),
            name: 'users.user',
        },
        {
            path: '/users/:id/wishlist',
            component: () => import('@/views/users/Wishlist.vue'),
            name: 'users.user.wishlist'
        },
        {
            path: '/cart',
            component: () => import('@/views/Cart.vue'),
            name: 'cart'
        }
    ]
});

router.beforeEach((to, from, next) => {
    const access_token = localStorage.getItem('access_token');
    if (access_token) {
        if (to.name === 'users.login' || to.name === 'users.register') {
            next({name: 'index'});
        }
    } else {
        if (
            to.name === 'users.user' ||
            to.name === 'users.user.wishlist'
        ) {
            next({name: 'index'});
        }
    }
    next();
})

export default router;
