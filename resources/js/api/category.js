export default (http) => ({
    async all() {
        let response = await http.get("/categories/all", {
            errorStub: {
                text: "Неудалось загрузить категории",
                fallback: [],
            },
        });
        return response.data;
    },
    async allForNavBar() {
        let response = await http.get("/categories/navBar", {
            errorStub: {
                text: "Неудалось загрузить категории",
                fallback: [],
            },
        });
        return response.data;
    },
    async oneWithProducts(slug) {
        let response = await http.get(`/categories/${slug}/products`, {
            errorStub: {
                text: "Не удалось загрузить товары для категории",
                fallback: [],
            },
        });
        return response.data;
    },
});
