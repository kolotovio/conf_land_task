import axios from 'axios'

const config = {
    baseURL: `${process.env.MIX_APP_URL}/api`
}

const _axios = axios.create(config)

// _axios.interceptors.request.use(config => {
//     if (store.getters.isLogged) {
//         config.headers.common['Authorization'] = `Bearer ${store.getters.getAccessToken}`
//     }
//     return config
// }, null)

// _axios.interceptors.response.use(null, async (error) => {
//     const originalRequest = error.config
//     if (error.response.status === 401 && !originalRequest._retry) {
//         originalRequest._retry = true
//         await store.dispatch('refresh')
//         originalRequest.headers.Authorization = `Bearer ${store.getters.getAccessToken}`

//         return _axios(originalRequest)
//     }
//     // Remove user tokens and maybe logout or invalidate used tokens from localstorage
//     return Promise.reject(error)
// })

export default _axios