export default (http) => ({
    async all() {
        let response = await http.get("/cart/all", {
            errorStub: {
                text: "Не удалось загрузить корзину",
                importance: "danger",
                critical: true,
                fallback: [],
            },
        });
        return response.data;
    },

    async add(id, quantity) {
        let response = await http.put("/cart/add", { id, quantity });
        return response.data;
    },
    async sync(items) {
        let response = await http.put("/cart/sync", { items });
        return response.data;
    },
    async remove(id) {
        let response = await http.delete(`/cart/${id}/delete`, {
            errorStub: {
                text: "Не удалось удалить из корзины",
                importance: "danger",
                fallback: false,
            },
        });
        return response.data;
    },
    promo: {
        async get() {
            let response = await http.get("/cart/promo/get", {
                errorStub: {
                    fallback: { id: "", size: 0 },
                },
            });
            return response.data;
        },
        async check(form) {
            let response = await form.post("/cart/promo/check");
            return response.data;
        },
        async addToUser(promoId) {
            let response = await http.put("/cart/promo/add", { promoId });
            return response.data;
        },
        async removeFromUser(promoId) {
            let response = await http.put("/cart/promo/remove", { promoId });
            return response.data;
        },
    },
});
