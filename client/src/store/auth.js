import auth from "@/api/auth";
import session from "@/api/session";
import {
  LOGIN_BEGIN,
  LOGIN_FAILURE,
  LOGIN_SUCCESS,
  REGISTRATION_SUCCESS,
  LOGOUT,
  REMOVE_TOKEN,
  SET_TOKEN,
  SET_ACCOUNT_DETAIL,
  REMOVE_ACCOUNT_DETAIL
} from "./types";

const TOKEN_STORAGE_KEY = "TOKEN_STORAGE_KEY";

const initialState = {
  authenticating: false,
  token: null,
  accountDetail: {
    id: null,
    name: null,
    email: null,
    phone_no: null,
    image: null,
  },
  isLoading:false,
};

const getters = {
  isAuthenticated: state => !!state.token,
  accountDetail: state => state.accountDetail,
  isLoading: state => state.isLoading,
};

const actions = {
  login({ commit }, data) {
    commit(LOGIN_BEGIN);
    return auth.login(data)
      .then(response => {
        commit(SET_TOKEN, response.data.access_token);
        commit(LOGIN_SUCCESS);
        commit(SET_ACCOUNT_DETAIL, {
          id: response.data.user_id,
          name: response.data.name,
          email: response.data.email,
          image: response.data.image,
        });
      })
      .catch(error => {
        commit(LOGIN_FAILURE);
        return Promise.reject(error.response.data);
      });
  },
  register({commit}, data) {
    return auth.register(data)
      .then(response => {
        commit(REGISTRATION_SUCCESS)
        return Promise.resolve(response.data);
      })
      .catch(error => {
        return Promise.reject(error.response.data);
      });
  },
  logout({ commit }) {
    return auth.logout()
      .then(() => commit(LOGOUT))
      .finally(() => {
        commit(REMOVE_TOKEN);
        commit(REMOVE_ACCOUNT_DETAIL);
      });
  },
  initialize({ commit }) {
    const token = localStorage.getItem(TOKEN_STORAGE_KEY);
    if (token) {
      commit(SET_TOKEN, token);
      const user = localStorage.getItem('user');
      commit(SET_ACCOUNT_DETAIL, JSON.parse(user));
    } else {
      commit(REMOVE_TOKEN);
    }
  },
  getAccountDetail({ commit }) {
    return auth.getAccountDetails()
      .then(res => {
        commit(SET_ACCOUNT_DETAIL, res.data);
        return Promise.resolve(res.data);
      })
      .catch(error => {
          commit(REMOVE_TOKEN);
          commit(REMOVE_ACCOUNT_DETAIL);
          return Promise.reject(error.response.data);
      });
  },
  updateProfile({ commit }, formData) {
    commit('isLoading', true);
    return auth.updateProfile(formData)
      .then(res => {
        commit('isLoading', false);
        commit(SET_ACCOUNT_DETAIL, res.data.user);
        return Promise.resolve(res.data);
      })
      .catch(error => {
        commit('isLoading', false);
          return Promise.reject(error.response.data);
      });
  },
  updatePassword({ commit }, formData) {
    commit('isLoading', true);
    return auth.updatePassword(formData)
      .then(res => {
        commit('isLoading', false);
        return Promise.resolve(res.data);
      })
      .catch(error => {
        commit('isLoading', false);
          return Promise.reject(error.response.data);
      });
  }
};

const mutations = {
  [LOGIN_BEGIN](state) {
    state.authenticating = true;
    state.error = false;
  },
  [LOGIN_FAILURE](state) {
    state.authenticating = false;
    state.error = true;
  },
  [LOGIN_SUCCESS](state) {
    state.authenticating = false;
    state.error = false;
  },
  [REGISTRATION_SUCCESS](state) {
    state.error = false;
  },
  [LOGOUT](state) {
    state.authenticating = false;
    state.error = false;
  },
  [SET_TOKEN](state, token) {
    localStorage.setItem(TOKEN_STORAGE_KEY, token);
    session.defaults.headers.Authorization = `Bearer ${token}`;
    state.token = token;
  },
  [REMOVE_TOKEN](state) {
    localStorage.removeItem(TOKEN_STORAGE_KEY);
    delete session.defaults.headers.Authorization;
    state.token = null;
  },
  [SET_ACCOUNT_DETAIL](state, value) {
    localStorage.setItem('user', JSON.stringify(value));
    state.accountDetail = value;
  },
  [REMOVE_ACCOUNT_DETAIL](state) {
    state.accountDetail = null;
  },
  isloading(state, value){
    state.isLoading = value;
  }
};

export default {
  namespaced: true,
  state: initialState,
  getters,
  actions,
  mutations
};
