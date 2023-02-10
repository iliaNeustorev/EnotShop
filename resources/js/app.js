import createRouter from "./router";
import createStore from "./store";
import createHttp from "./plugins/http";
import { createApp } from "vue";
import App from "./App.vue";
import { Form } from "vform";
import initHttpErrorsHandler from "@/connectors/http-errors-handler";

export default () => {
    const { http, api } = createHttp();
    const store = createStore(api);
    const router = createRouter(store);

    initHttpErrorsHandler(http, store, router);

    store.dispatch("userModule/checkUser");

    const app = createApp(App).use(store).use(router);

    app.config.globalProperties["$api"] = api;
    app.config.globalProperties["$vform"] = Form;

    return app;
};
