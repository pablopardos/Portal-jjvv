
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('socio', require('./components/Socio.vue'));
Vue.component('datospersonales', require('./components/Datospersonales.vue'));
Vue.component('certresidencia', require('./components/Certresidencia.vue'));
Vue.component('cuotassociales', require('./components/Cuotassociales.vue'));
Vue.component('publicacion', require('./components/Publicacion.vue'));
Vue.component('publicacion2', require('./components/Publicacion2.vue'));
Vue.component('solicitudcert', require('./components/Solicitudcert.vue'));
Vue.component('ns', require('./components/Nuevosocio.vue'));

const app = new Vue({
    el: '#app',
    data: {
        menu: 0
    }
});
