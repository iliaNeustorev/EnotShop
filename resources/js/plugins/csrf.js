export default () => ({
    install(app) {
        let token = document.querySelector("[name='csrf-token']")?.content;
        app.config.globalProperties["$csrf"] = token;
        app.provide("$csrf", token);
    },
});
