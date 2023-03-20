export default (http, store) => {
    http.interceptors.response.use(
        (r) => r,
        (error) => {
            if ("errorStub" in error.config) {
                let { errorStub } = error.config;
                if (errorStub.text) {
                    store.dispatch("alertModule/add", {
                        text:
                            errorStub.text +
                            (errorStub.critical ? ".Работа невозможна" : ""),
                        timeout: 5000,
                        importance: errorStub.importance ?? "info",
                    });
                }
                return { data: errorStub.fallback };
            }
            return Promise.reject(error);
        }
    );
};
