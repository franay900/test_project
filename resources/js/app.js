import { createApp } from 'vue';
import './bootstrap';
import router from './router';
import store from './store';


import App from './App.vue';

const app = createApp(App);

app.use(router);

app.mount('#app');

app.use(store);
