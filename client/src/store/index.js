import Vuex from "vuex";

import auth from "./auth";
import campaign from "./campaign";
import banner from "./banner";

const debug = process.env.NODE_ENV !== "production";

export default new Vuex.Store({
  modules: {
    auth,
    campaign,
    banner,
  },
  strict: debug,
});
