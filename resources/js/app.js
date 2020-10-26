/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */


Vue.component('auth-component', require('./components/admin_components/Auth').default);
Vue.component('site-reader', require('./components/admin_components/SiteUpdate').default);
Vue.component('slider-reader', require('./components/admin_components/SliderComponent').default);
Vue.component('plants-reader', require('./components/admin_components/PlantsUpdate').default);

Vue.component('slider-view', require('./components/user_component/Slider').default);
Vue.component('plant-list', require('./components/user_component/PlantsList').default);
Vue.component('send-message', require('./components/user_component/SendMessage').default);

import store from './store/'
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    store,
    el: '#app',
});



