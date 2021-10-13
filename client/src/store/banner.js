import banner from "@/api/banner";

const initialState = {
  banners: [],
  bannerLoading: false
};

const getters = {
  banners: state => state.banners,
  bannerLoading: state => state.bannerLoading,
};

const actions = {
  fetchBanners({ commit }) {
    commit('bannerLoading', true);
    return new Promise((resolve, reject) => {
        banner.fetchBanners()
        .then(res => { 
          commit('setBanners', res.data);
          commit('bannerLoading', false);
          resolve(res.data);
        })
        .catch(error => {
          commit('bannerLoading', false);
          reject(error.response);
        });
    });
  },
};

const mutations = {
  setBanners(state, value) {
    state.banners = value;
  },
  bannerLoading(state, value){
    state.bannerLoading = value;
  }
};

export default {
  namespaced: true,
  state: initialState,
  getters,
  actions,
  mutations
};
