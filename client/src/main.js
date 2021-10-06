import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'
import VueAxios from 'vue-axios'
import Vuex from "vuex"

// plugins
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import '@/assets/css/style.css'

require("bootstrap")
import "bootstrap/dist/css/bootstrap.min.css";
import jQuery from 'jquery'
global.jQuery = jQuery
global.$ = jQuery

import '@vueup/vue-quill/dist/vue-quill.snow.css';
import CKEditor from '@ckeditor/ckeditor5-vue';

createApp(App)
.use(store)
.use(router)
.use(VueAxios, axios)
.use(Vuex)
.use(VueSweetalert2)
.use( CKEditor )
.mount('#app')
