import Vuex from "vuex";

import auth from "./auth";
import campaign from "./campaign";

const debug = process.env.NODE_ENV !== "production";

export default new Vuex.Store({
  modules: {
    auth,
    campaign,
  },
  strict: debug,
});
