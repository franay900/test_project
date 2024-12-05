import { createApp } from 'vue';
import './bootstrap';
import router from './router';
import store from './store';
import '../scss/styles.scss'
import * as bootstrap from 'bootstrap/dist/js/bootstrap.bundle';



import App from './App.vue';

const app = createApp(App);

app.use(router);

app.mount('#app');

app.provide('bootstrap', bootstrap);

app.use(store);
