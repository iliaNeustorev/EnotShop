export default (form, http) => ({
    install(app) {
        form.axios = http;
        app.config.globalProperties["$vform"] = form;
        app.provide("$vform", form);
    },
});
