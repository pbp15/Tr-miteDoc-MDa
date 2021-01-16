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

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/*INICIO DEL COMPONENTES DEL PANEL ADMINISTRADOR */
Vue.component('persona', require('./components/Persona.vue').default);
Vue.component('rol', require('./components/Rol.vue').default);
Vue.component('user', require('./components/User.vue').default);
Vue.component('categoria', require('./components/Categoria.vue').default);
Vue.component('comunicado', require('./components/Comunicado.vue').default);
Vue.component('contacto', require('./components/Contacto.vue').default);
Vue.component('evento', require('./components/Evento.vue').default);
Vue.component('institucion', require('./components/Institucion.vue').default);
Vue.component('testimonio', require('./components/Testimonio.vue').default);
/*FIN  DEL COMPONENTES DEL PANEL ADMINISTRADOR */

/*INICIO DEL COMPONENTES DE LA PAGINA WEB */
Vue.component('eventito', require('./components/paginaweb/Eventito.vue').default);





const app = new Vue({
    el: '#app',
    data :{
        menu : 0
    }
});
