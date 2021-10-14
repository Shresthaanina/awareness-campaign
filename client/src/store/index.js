import Vuex from "vuex";

import auth from "./auth";
import campaign from "./campaign";
import banner from "./banner";
import setting from "./setting";

const debug = process.env.NODE_ENV !== "production";

export default new Vuex.Store({
  modules: {
    auth,
    campaign,
    banner,
    setting,
  },
  strict: debug,
});
