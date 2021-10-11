import campaign from "@/api/campaign";

const initialState = {
  campaigns: [],
  campaign: {
    id: null,
    name: null,
    image: null,
  },
  campaignLoading: false,
  categoryLoading: false,
  categoryList: [],
};

const getters = {
  campaigns: state => state.campaigns,
  campaign: state => state.campaign,
  campaignLoading: state => state.campaignLoading,
  categoryLoading: state => state.categoryLoading,
  categoryList: state => state.categoryList,
};

const actions = {
  fetchCampaigns({ commit }, page) {
    commit('campaignLoading', true);
    return new Promise((resolve, reject) => {
        campaign.fetchCampaigns(page)
        .then(res => { 
          commit('setCampaigns', res.data.data);
          commit('campaignLoading', false);
          resolve(res.data);
        })
        .catch(error => {
          commit('campaignLoading', false);
          reject(error.response);
        });
    });
  },

  getCategoryList({ commit }) {
    commit('categoryLoading', true);
    return new Promise((resolve, reject) => {
        campaign.categoryList()
        .then(res => {
          commit('setCategoryList', res.data);
          commit('categoryLoading', false);
          resolve(res.data);
        })
        .catch(error => {
          commit('categoryLoading', false);
          reject(error.response);
        });
    });
  },

  fetchCampaignDetail({ commit }, slug ) {
    commit('campaignLoading', true);
    return campaign.getCampaignDetail(slug)
      .then(({ data }) => {
        commit('campaignLoading', false);
        commit('setCampaign', data);
        return Promise.resolve(data);
      })
      .catch(error => {
        commit('campaignLoading', false);
        return Promise.reject(error.response.data);
      });
  },

  createCampaign({ commit }, formData) {
    commit('campaignLoading', true);
    return new Promise((resolve, reject) => {
        campaign.createCampaign(formData)
        .then(res => {
          commit('campaignLoading', false);
          resolve(res.data);
        })
        .catch(error => {
          commit('campaignLoading', false);
          reject(error.response);
        });
    });
  },

  updateCampaign({ commit }, { id, formData }) {
    commit('campaignLoading', true);
    return new Promise((resolve, reject) => {
        campaign.updateCampaign(id, formData)
        .then(res => {
          commit('campaignLoading', false);
          resolve(res.data);
        })
        .catch(error => {
          commit('campaignLoading', false);
          reject(error.response);
        });
    });
  },

  deleteCampaign({ commit }, {id}) {
    commit('campaignLoading', true);
    return new Promise((resolve, reject) => {
        campaign.deleteCampaign(id)
        .then(res => {
          commit('campaignLoading', false);
          resolve(res.data);
        })
        .catch(error => {
          commit('campaignLoading', false);
          reject(error.response);
        });
    });
  },
};

const mutations = {
  setCampaigns(state, value) {
    state.campaigns = value;
  },
  setCategoryList(state, value) {
    state.categoryList = value;
  },
  setCampaign(state, value) {
    state.campaign = value;
  },
  campaignLoading(state, value){
    state.campaignLoading = value;
  },
  categoryLoading(state, value){
    state.categoryLoading = value;
  }
};

export default {
  namespaced: true,
  state: initialState,
  getters,
  actions,
  mutations
};
