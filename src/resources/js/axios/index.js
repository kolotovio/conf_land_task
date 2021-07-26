import axios from 'axios'

const config = {
    baseURL: `${process.env.MIX_APP_URL}/api`
}

const _axios = axios.create(config)

export default _axios
