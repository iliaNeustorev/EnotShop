export default (backendRedirect) => ({
    install(app) {
        let routes = {
            login(redirect = false) {
                if (redirect) {
                    return (document.location = backendRedirect.auth);
                } else {
                    return backendRedirect.auth;
                }
            },
            logout() {
                return backendRedirect.logout;
            },
            register(redirect = false) {
                if (redirect) {
                    return (document.location = backendRedirect.register);
                } else {
                    return backendRedirect.register;
                }
            },
            verifyEmail() {
                return backendRedirect.verifyEMail;
            },
        };
        app.config.globalProperties["$redirectRoutes"] = routes;
        app.provide("$redirectRoutes", routes);
    },
});
