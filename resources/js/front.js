/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import 'bootstrap';

window.Vue = require('vue');
window.Axios = require('axios');


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import PageHome from './Pages/PageHome.vue';
import PageAbout from './Pages/PageAbout.vue';
import PostIndex from './Pages/PostIndex.vue';
import PostShow from './Pages/PostShow.vue';
import Page404 from './Pages/Page404.vue';




const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '*',
            name: 'Page404',
            component: Page404,
        },
        {
          path: '/',
          name: 'home',
          component: PageHome
        },
        {
            path: '/about',
            name: 'about',
            component: PageAbout
        },
        {
            path: '/posts',
            name: 'index',
            component: PostIndex
        },
        {
            path: '/posts/:slug',
            name: 'show',
            component: PostShow,
            props: true
        },
    ],
})


import App from './views/App.vue';
const app = new Vue({
    el: '#app',
    render: h => h(App),
    router // short for `router: router`
});


