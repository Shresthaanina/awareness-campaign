import session from "./session";

export default {
  login(data) {
    return session.post("api/login", data);
  },
  register(data) {
    return session.post("api/register", data);
  },
  logout() {
    return session.post("api/logout", {});
  },
  getAccountDetails() {
    return session.get("api/v1/profile");
  },
  updateProfile(formData) {
    return session.post("api/v1/profile", formData);
  },
  updatePassword(formData) {
    return session.patch("api/v1/profile/change_password", formData);
  }
};
