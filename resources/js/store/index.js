import { createStore } from "vuex";
import createUserModule from "./user";
import createAlertModule from "./alerts";

export default (api) =>
    createStore({
        modules: {
            userModule: createUserModule(api.user.main),
            alertModule: createAlertModule(),
        },
        strict: process.env.NODE_ENV !== "production",
    });
