export default (http) => ({
    async all() {},
    async one(slug) {
        let response = await http.get(`/products/${slug}`, {
            errorStub: {
                text: "Не удалось загрузить товар",
                fallback: {},
            },
        });
        return response.data;
    },

    async mostSold() {
        let response = await http.get("/products/mostSold", {
            errorStub: {
                text: "Не удалось список продаваемых товаров",
                fallback: [],
            },
        });
        return response.data;
    },
    async loadSelected(items) {
        let response = await http.post(
            "/products/selected",
            { items },
            {
                errorStub: {
                    text: "Ошибка загрузки ",
                    importance: "warning",
                    fallback: [],
                },
            }
        );
        return response.data;
    },
});
