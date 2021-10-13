import campaign from "@/api/campaign";

const initialState = {
  campaigns: [],
  campaignPaginateData: {
    total: 0,
    per_page:0,
    current_page:1
  },
  recentCampaigns: [],
  campaign: {
    id: null,
    name: null,
    image: null,
  },
  campaignLoading: false,
  categoryLoading: false,
  categoryList: [],
  campaignFilters: {
    category_id:'',
    created_by:''
  }
};

const getters = {
  campaigns: state => state.campaigns,
  recentCampaigns: state => state.recentCampaigns,
  campaign: state => state.campaign,
  campaignPaginateData: state => state.campaignPaginateData,
  campaignLoading: state => state.campaignLoading,
  categoryLoading: state => state.categoryLoading,
  categoryList: state => state.categoryList,
  campaignFilters: state => state.campaignFilters,
};

const actions = {
  fetchCampaigns({ commit, getters }, page) {
    commit('campaignLoading', true);
    return new Promise((resolve, reject) => {

        // get campaignFilters object and convert to querystring for filter
        const campaignFilters = getters.campaignFilters
        let str = [];
        for (var p in campaignFilters){
          if (campaignFilters.hasOwnProperty(p)) {
            str.push(encodeURIComponent(p) + "=" + encodeURIComponent(campaignFilters[p]))
          }
        }
        let filters = str.join("&")
        //end

        campaign.fetchCampaigns(page, filters)
        .then(res => { 
          commit('setCampaigns', res.data.data);
          commit('setCampaignPaginateData', res.data);
          commit('campaignLoading', false);
          resolve(res.data);
        })
        .catch(error => {
          commit('campaignLoading', false);
          reject(error.response);
        });
    });
  },

  fetchRecentCampaigns({ commit }) {
    commit('recentCampaignLoading', true);
    return new Promise((resolve, reject) => {
        campaign.fetchRecentCampaigns()
        .then(res => { 
          commit('setRecentCampaigns', res.data);
          commit('recentCampaignLoading', false);
          resolve(res.data);
        })
        .catch(error => {
          commit('recentCampaignLoading', false);
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

  setCampaignCategoryId({ commit }, category_id) {
    commit('setCampaignCategoryId', category_id);
    commit('setCampaignCreatedById', '');
  },

  setCampaignCreatedById({ commit }, user_id) {
    commit('setCampaignCreatedById', user_id);
    commit('setCampaignCategoryId', '');
  },
};

const mutations = {
  setCampaigns(state, value) {
    state.campaigns = value;
  },
  setCampaignPaginateData(state, value) {
    state.campaignPaginateData = value;
  },
  setRecentCampaigns(state, value) {
    state.recentCampaigns = value;
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
  recentCampaignLoading(state, value){
    state.recentCampaignLoading = value;
  },
  categoryLoading(state, value){
    state.categoryLoading = value;
  },
  setCampaignCategoryId(state, value){
    state.campaignFilters.category_id = value;
  },
  setCampaignCreatedById(state, value){
    state.campaignFilters.created_by = value;
  }
};

export default {
  namespaced: true,
  state: initialState,
  getters,
  actions,
  mutations
};
