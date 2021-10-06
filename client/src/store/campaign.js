import campaign from "@/api/campaign";

const initialState = {
  campaigns: [],
  campaign: {
    id: null,
    name: null,
    image: null,
  },
  campaignLoading: false,
};

const getters = {
  campaigns: state => state.campaigns,
  campaign: state => state.campaign,
  campaignLoading: state => state.campaignLoading,
};

const actions = {
  fetchCampaigns({ commit }) {
    commit('campaignLoading', true);
    return new Promise((resolve, reject) => {
        campaign.fetchCampaigns()
        .then(res => {
          commit('setCampaigns', res.data);
          commit('campaignLoading', false);
          resolve(res.data);
        })
        .catch(error => {
          commit('campaignLoading', false);
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
  setCampaign(state, value) {
    state.campaign = value;
  },
  campaignLoading(state, value){
    state.campaignLoading = value;
  }
};

export default {
  namespaced: true,
  state: initialState,
  getters,
  actions,
  mutations
};
