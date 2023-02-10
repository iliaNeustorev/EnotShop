export default (http, store, router) => {
    http.interceptors.response.use(
        (r) => r,
        (error) => {
            if ("errorStub" in error.config) {
                let { errorStub } = error.config;
                store.dispatch("alertModule/add", {
                    text: errorStub.text,
                    timeout: 5000,
                    importance: errorStub.importance ?? "info",
                });
                return { data: errorStub.fallback };
            }
            return Promise.reject(error);
        }
    );
};
