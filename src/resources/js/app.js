import { createApp } from 'vue'
import App from './App.vue'
import axios from './axios'

const app = createApp(App).use(axios)
app.config.globalProperties.appUrl = process.env.MIX_APP_URL
app.mount('#app')