/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

import Vue from 'vue';
import VueI18n from "vue-i18n";
import Vuex from 'vuex';

Vue.use(VueI18n);

import store from './store';

const messages = require('./messages');
const i18n = new VueI18n({
    locale: locale,
    messages
});

const files = require.context('./components', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

let app = new Vue({
    i18n,
    store
}).$mount('#app');