import session from "./session";

export default {
  fetchCampaigns() {
    return session.get("api/v1/campaigns");
  },
  getCampaignDetail(slug) {
    return session.get("api/v1/campaigns/" + slug);
  },
  createCampaign(formData) {
    return session.post("/api/v1/campaigns", formData);
  },
  updateCampaign(id, formData) {
    return session.patch("/api/v1/campaigns/" + id, formData);
  },
  deleteCampaign(id) {
    return session.delete("/api/v1/campaigns/" + id);
  },
};
