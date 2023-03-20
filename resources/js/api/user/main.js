export default (http) => ({
    async get() {
        let response = await http.get("/get", {
            errorStub: {
                text: "Ошибка при проверке аутентификации",
                fallback: { auth: false },
                importance: "warning",
            },
        });
        return response.data;
    },
});
