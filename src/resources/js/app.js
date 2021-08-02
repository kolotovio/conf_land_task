import { createApp } from 'vue'
// import App from './App.vue'
import registrationForm from './components/registrationForm.vue'
import registrationTable from './components/registrationTable.vue'
import { VueReCaptcha } from 'vue-recaptcha-v3'

const app = createApp({})
app.use(VueReCaptcha, { siteKey: process.env.MIX_RECAPTCHA_SITE_KEY })
app.component('registration-form-component', registrationForm)
app.component('registration-table-component', registrationTable)
app.config.globalProperties.appUrl = process.env.MIX_APP_URL
app.mount('#app')