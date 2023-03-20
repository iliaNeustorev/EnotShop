import { createStore } from "vuex";
import createUserModule from "./user";
import createAlertModule from "./alerts";
import createCartModule from "./cart";

export default (api, storageHelpers) =>
    createStore({
        modules: {
            userModule: createUserModule(api.user.profile, api.user.main),
            alertModule: createAlertModule(),
            cartModule: createCartModule(api.cart, storageHelpers),
        },
        strict: process.env.NODE_ENV !== "production",
    });
