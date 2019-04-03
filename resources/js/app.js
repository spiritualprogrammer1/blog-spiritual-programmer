
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

Vue.component('example-component', require('./components/ExampleComponent.vue'));

Vue.component('AppHome', require('./components/AppHome.vue'));
Vue.component('ToolBar',require('./components/Toolbar.vue'))
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
/**
 * importer la routes
 */

import Vue from 'vue'

import VueSimplemde from 'vue-simplemde'
import 'simplemde/dist/simplemde.min.css'
import md from 'marked'
window.md = md

Vue.use(VueSimplemde)

import router from './Router/router.js'
import User from './Helper/User.js'
/***instancier la classe user*******/
window.User = User

import Exception from './Helper/Exception'
/***instancier la classe exception*******/
window.Exception = Exception

window.EventBus = new Vue();

import Vuetify from 'vuetify'

Vue.use(Vuetify)

const app = new Vue({
    el: '#app',
    router
});
