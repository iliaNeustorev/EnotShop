export default (http) => ({
    async getDiscount() {
        let response = await http.get("/profile/discount");
        return response.data;
    },
    async edit(profile) {
        let response = await profile.put("/profile/edit");
        return response.data;
    },
    adress: {
        async get() {
            let response = await http.get("/profile/adress", {
                errorStub: {
                    text: "Не удалось загрузить адреса",
                    importance: "danger",
                    fallback: [],
                },
            });
            return response.data;
        },
        async changeMain(form) {
            let response = await form.put("/profile/adress");
            return response.data;
        },
    },
});
