import setting from "@/api/setting";

const initialState = {
  settings: [],
  settingLoading: false
};

const getters = {
  settings: state => state.settings,
  settingLoading: state => state.settingLoading,
};

const actions = {
  fetchSettings({ commit }) {
    commit('settingLoading', true);
    return new Promise((resolve, reject) => {
        setting.fetchSettings()
        .then(res => { 
          commit('setSettings', res.data);
          commit('settingLoading', false);
          resolve(res.data);
        })
        .catch(error => {
          commit('settingLoading', false);
          reject(error.response);
        });
    });
  },
};

const mutations = {
  setSettings(state, value) {
    state.settings = value;
  },
  settingLoading(state, value){
    state.settingLoading = value;
  }
};

export default {
  namespaced: true,
  state: initialState,
  getters,
  actions,
  mutations
};
