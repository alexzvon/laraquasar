import * as $q from "quasar";
//import {ref} from "vue"
//import { boot } from 'quasar/wrappers'
import axios from 'axios'
import { Notify } from 'quasar'
//import { useAuthStore } from 'stores/auth.store'

//import { Cookies } from 'quasar'

//const cookies = Cookies.getAll()

const bearer = 'Bearer '

const getToken = () => {
    return bearer + $q.Cookies.get('tokenApi')
}

// const setToken = (t) => {
//     $q.Cookies.set('tokenApi', t.toString())
// }

const hasToken = () => {
    return $q.Cookies.has('tokenApi')
}

const api = axios.create({
//  withCredentials: true,
  withXSRFToken: true,
  baseURL: 'http://localhost/api',                         //process.env.API_PATH,
  timeout: 5000
})

api.interceptors.request.use(
    config => {

        // console.log(cookies)
        // console.log($q.Cookies.has('tokenApi'))


        if(hasToken()) {
            // config.headers['Authorization'] = getToken()
        }

        return config
    },

    error => Promise.reject(error)
)

api.interceptors.response.use(
  response => {
    return response
  },

  error => {
    let message = error.response.status + ' ' + error.response.statusText + ' ' + error.response.data.Message + ' ' + error.response.data.error

    switch (parseInt(error.response.status)) {
      case 422:
        message = error.response.data.error
        message = message ? message : error.response.data.message
        break;
      case 401:
//        const authStore = useAuthStore()
//        authStore.refreshLogin(error)
        message = error.response.data.message
        break;
      case 403:
        message = error.response.data.message
        break;
      default:
        message = 'Неизвестная ошибка'
        break;
    }

    // Notify.create({
    //   type: 'negative',
    //   message: message,
    //   position: 'top'
    // })

    return Promise.reject(error)
  }
)


// axios.defaults.withCredentials = true;
// axios.defaults.withXSRFToken = true;

// Be careful when using SSR for cross-request state pollution
// due to creating a Singleton instance here;
// If any client changes this (global) instance, it might be a
// good idea to move this instance creation inside of the
// "export default () => {}" function below (which runs individually
// for each client)
//const api = axios.create({ baseURL: 'https://api.example.com/api' })

// export default boot(({ app }) => {
//   // for use inside Vue files (Options API) through this.$axios and this.$api

//   app.config.globalProperties.$axios = axios
//   // ^ ^ ^ this will allow you to use this.$axios (for Vue Options API form)
//   //       so you won't necessarily have to import axios in each vue file

//   app.config.globalProperties.$api = api
//   // ^ ^ ^ this will allow you to use this.$api (for Vue Options API form)
//   //       so you can easily perform requests against your app's API
// })

// api.get(process.env.CSRF_PATH)     //'http://template.loc/sanctum/csrf-cookie'
//     .then(response => {
//     console.log(response)
//   })

export { api }
