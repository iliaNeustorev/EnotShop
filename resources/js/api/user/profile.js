export default (http) => ({
    async getDiscount() {
        let response = await http.get("/profile/discount");
        return response.data;
    },
    async edit(profile) {
        let response = await profile.put("/profile/edit");
        return response.data;
    },
    async changePassword(form) {
        let response = await form.put("/profile/changePassword");
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
            let response = await http.put("/profile/adress/main", form, {
                errorStub: {
                    text: "Не удалось изменить основной адрес",
                    importance: "danger",
                    fallback: false,
                },
            });
            return response.data;
        },

        async add(form) {
            let response = await form.post("/profile/adress");
            return response.data;
        },

        async delete(id) {
            let response = await http.delete(`/profile/adress/${id}`, {
                errorStub: {
                    text: "Не удалось удалить адрес",
                    importance: "danger",
                    fallback: false,
                },
            });
            return response.data;
        },

        async edit(form, id) {
            let response = await form.put(`/profile/adress/${id}`);
            return response.data;
        },
    },
});
