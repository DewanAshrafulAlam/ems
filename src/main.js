import { createApp } from 'vue'
import App from './App.vue'
import './assets/tailwind.css'
import router from './router';
import Toast from 'vue-toastification'
import 'vue-toastification/dist/index.css'

const app = createApp(App);
app.use(router); // 👈 use the router
app.use(Toast);
app.mount('#app');

