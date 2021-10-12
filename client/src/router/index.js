import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import store from "@/store";

const requireAuthenticated = (to, from, next) => {
  store.dispatch("auth/initialize").then(() => {
    if (!store.getters["auth/isAuthenticated"]) {
      next("/login");
    } else {
      next();
    }
  });
};

const requireUnauthenticated = (to, from, next) => {
  store.dispatch("auth/initialize").then(() => {
    if (store.getters["auth/isAuthenticated"]) {
      next({ name: "Home" });
    } else {
      next();
    }
  });
};

const redirectLogout = (to, from, next) => {
  store.dispatch("auth/logout").then(() => next("/login"));
};

const routes = [
  {
    path: '/',
    name: 'home',
    component: Home
  },
  {
    path: '/about',
    name: 'About',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('../views/Auth/Login.vue'),
    beforeEnter: requireUnauthenticated
  },
  {
    path: '/register',
    name: 'register',
    component: () => import('../views/Auth/Register.vue'),
    beforeEnter: requireUnauthenticated
  },
  {
    path: '/campaigns/:slug',
    name: 'campaign',
    component: () => import('../views/Campaign.vue'),
  },
  {
    path: '/profile',
    name: 'profile',
    component: () => import('../views/Auth/Profile.vue'),
    beforeEnter: requireAuthenticated
  },
  {
    path: '/change_password',
    name: 'change-password',
    component: () => import('../views/Auth/ChangePassword.vue'),
    beforeEnter: requireAuthenticated
  },
  {
    path: '/profile/new_campaign',
    name: 'new-campaign',
    component: () => import('../views/NewCampaign.vue'),
    beforeEnter: requireAuthenticated
  },
  {
    path: '/profile/my_campaigns',
    name: 'my-campaigns',
    component: () => import('../views/MyCampaigns.vue'),
    beforeEnter: requireAuthenticated
  },
  {
    path: '/profile/my_campaigns/:slug',
    name: 'edit-campaign',
    component: () => import('../views/NewCampaign.vue'),
    beforeEnter: requireAuthenticated
  },
  {
    path: "/logout",
    name: 'logout',
    beforeEnter: redirectLogout
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
