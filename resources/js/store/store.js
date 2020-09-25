import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
import config from "../config";

const URL_API_SUBASTA = config.url_api.URL_API_SUBASTA;
const URL_API_CENTRAL = config.url_api.URL_API_CENTRAL;
/**
 * Arma la URL de el servicio
 */
function buildURL(api, resource = "") {
  if (api == "URL_API_CENTRAL") {
    return URL_API_CENTRAL + resource;
  } else {
    return URL_API_SUBASTA + resource;
  }
}

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        status: '',
        token: localStorage.getItem('token') || '',
        user: {},
        errors: {}        
    },
    mutations: {
        auth_request(state) {
            state.status = 'loading'
        },
        verify_email(state) {
            state.status = 'verified'
        },
        auth_success(state, token, user) {
            state.status = 'success';
            state.token = token;
            state.user = user;
        },
        auth_error_authnotorized(state, err) {
            state.status = 'auth_error_authnotorized';
            state.errors = err;
        },
        auth_error_validation(state, err) {
            state.status = 'auth_error_validation';
            state.errors = err;
        },
        logout(state) {
            state.status = '';
            state.token = '';
            state.user = '';
        },
    },
    actions: {
        login({commit}, user) {
            return new Promise((resolve, reject) => {
                commit('auth_request')                
                axios.post(buildURL("URL_API_SUBASTA", "auth/login"), user, {
                     headers: {
                         Authorization: 'Bearer ' + localStorage.getItem('access_token')
                     }
                })
                .then((resp) => {
                    const token = resp.data.access_token;
                    const user = resp.data.user;
                    localStorage.setItem('access_token', token);
                    axios.defaults.headers.common['Authorization Bearer'] = token;
                    commit('auth_success', token, user);
                    resolve(resp)
                })
                .catch((err) => {
                    if(err != undefined && err.response.status == 401) {
                        commit('auth_error_authnotorized', err)
                        localStorage.removeItem('access_token')
                        reject(err)
                    } else if (err != undefined && err.response.status == 422) {
                        commit('auth_error_validation', err)
                        localStorage.removeItem('access_token')
                        reject(err)
                    }                  
                })
            })
        },
        register({commit}, user) {
            return new Promise((resolve, reject) => {
                commit('auth_request')
                axios.post(buildURL("URL_API_SUBASTA", "auth/register"), user)
                .then((resp) => {
                    console.log(resp);
                    const token = resp.data.access_token;
                    const user = resp.data.user;
                    localStorage.setItem('access_token', token);
                    commit('auth_success', token, user);
                    resolve(resp)
                })
                .catch((err) => {
                    console.log(err);
                    if(err != undefined && err.response.status == 401) {
                        commit('auth_error_authnotorized', err)
                        localStorage.removeItem('access_token')
                        reject(err)
                    } else if (err != undefined && err.response.status == 422) {
                        commit('auth_error_validation', err)
                        localStorage.removeItem('access_token')
                        reject(err)
                    }                  
                })
            })
        },
        logout({commit}) {
            return new Promise((resolve, reject) => {
                commit('logout')
                localStorage.removeItem('access_token');
                delete axios.defaults.headers.common['Authorization Bearer'];
                resolve()
            })
        },
    },
    getters: {
        isLoggedIn: state => !!state.token,
        authStatus: state => state.status,
        errors: state => state.errors,
        user: state => state.user
    }
})