import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'
import VueAxios from 'vue-axios'
import Vuex from "vuex"
import moment from 'moment'

// plugins
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

// import '@/assets/scripts/bootstrap/bootstrap.min.css'
import '@/assets/scripts/ionicons/css/ionicons.min.css'
import '@/assets/scripts/toast/jquery.toast.min.css'
import '@/assets/scripts/owlcarousel/dist/assets/owl.carousel.min.css'
import '@/assets/scripts/owlcarousel/dist/assets/owl.theme.default.min.css'
import '@/assets/scripts/magnific-popup/dist/magnific-popup.css'
// import '@/assets/scripts/sweetalert/dist/sweetalert.css'
import '@/assets/css/style.css'
import '@/assets/css/skins/all.css'
import '@/assets/css/demo.css'


require("bootstrap")
import "bootstrap/dist/css/bootstrap.min.css";
// import jQuery from 'jquery'
// global.jQuery = jQuery
// global.$ = jQuery

global.jQuery = require('jquery');
var $ = global.jQuery;
window.$ = $;

import '@/assets/js/jquery.migrate.js'
import '@/assets/scripts/jquery-number/jquery.number.min.js'
import '@/assets/scripts/owlcarousel/dist/owl.carousel.min.js'
import '@/assets/scripts/magnific-popup/dist/jquery.magnific-popup.min.js'
import '@/assets/scripts/easescroll/jquery.easeScroll.js'
import '@/assets/scripts/sweetalert/dist/sweetalert.min.js'
import '@/assets/scripts/toast/jquery.toast.min.js'
import '@/assets/js/demo.js'
import '@/assets/js/e-magz.js'

import '@vueup/vue-quill/dist/vue-quill.snow.css';
import CKEditor from '@ckeditor/ckeditor5-vue';

const app = createApp(App)
.use(store)
.use(router)
.use(VueAxios, axios)
.use(Vuex)
.use(VueSweetalert2)
.use( CKEditor )
.use( moment )
.mount('#app')
