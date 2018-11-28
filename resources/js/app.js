//vuex
import store from './store';
//vue-tables-2
import {ClientTable, Event} from 'vue-tables-2';
//element
import Element from 'element-ui';
import locale from 'element-ui/lib/locale/lang/ja';
import 'element-ui/lib/theme-chalk/index.css'
//moment
import VueMoment from 'vue-moment';
//wysiwyg
import VueWysiwyg from "vue-wysiwyg";

require('./bootstrap');

window.Vue = require('vue');

Vue.use(ClientTable);
Vue.use(Element, {locale});
Vue.use(VueMoment);
Vue.use(VueWysiwyg, {
  image: {
    uploadURL: process.env.MIX_APP_URL + '/webApi/wysiwyg',
  },
});

//user
Vue.component('header-nav', require('./views/layouts/HeaderNav'));
Vue.component('send-magazine', require('./views/SendMagazine'));
Vue.component('magazine-log', require('./views/MagazineLog'));

const app = new Vue({
  store,
}).$mount('#app');
