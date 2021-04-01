import Vue from 'vue'
import App from './App.vue'
import router from './router'
import vuetify from './plugins/vuetify';
import store from "./storage/index";
import 'vuetify/dist/vuetify.min'
import * as VueGoogleMaps from "vue2-google-maps";

Vue.use(VueGoogleMaps, {
  load: {
    key: "AIzaSyBSuYvjDOjXj9KcQeocrnloRTfrDGJmmZI",
    libraries: "", // necessary for places input
  },
});

Vue.config.productionTip = false

import axios from 'axios'

 //axios.defaults.baseURL = `http://localhost:81/api/`
//axios.defaults.baseURL = `http://marketbonn.000webhostapp.com/`
axios.defaults.baseURL = `https://bonnsupermercados.com/`

new Vue({
  vuetify,
  router,
  store,
  render: h => h(App)
}).$mount('#app')
