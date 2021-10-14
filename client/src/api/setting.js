import session from "./session";

export default {
  fetchSettings() {
    return session.get("api/v1/settings");
  },
};
