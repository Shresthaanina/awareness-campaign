import session from "./session";

export default {
  fetchBanners() {
    return session.get("api/v1/banners");
  },
};
