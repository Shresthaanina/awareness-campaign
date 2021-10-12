import session from "./session";

export default {
  fetchCampaigns(page = 1, querystring = '') {
    return session.get("api/v1/campaigns?page=" + page + '&' + querystring);
  },
  fetchRecentCampaigns() {
    return session.get("api/v1/recent_campaigns");
  },
  getCampaignDetail(slug) {
    return session.get("api/v1/campaigns/" + slug);
  },
  createCampaign(formData) {
    return session.post("/api/v1/campaigns", formData);
  },
  updateCampaign(id, formData) {
    return session.post("/api/v1/campaigns/" + id, formData);
  },
  deleteCampaign(id) {
    return session.delete("/api/v1/campaigns/" + id);
  },
  categoryList() {
    return session.get("/api/v1/categories");
  },
};
