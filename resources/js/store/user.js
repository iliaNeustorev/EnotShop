export default (profileApi, userApi) => {
    return {
        namespaced: true,

        state: {
            user: {},
        },
        getters: {
            user: (state) => state.user,
            isAuth: (state) => state.user?.name != undefined,
        },
        mutations: {
            setUser(state, payload) {
                state.user = payload;
            },
            setPersonalDiscount(state, { discount }) {
                state.user.discount = discount ?? 0;
            },
            updateUser(state, payload) {
                Object.assign(state.user, payload);
            },
        },
        actions: {
            async init(context, user) {
                context.commit("setUser", user);
            },
            async getDiscount({ commit, getters }) {
                if (getters.isAuth) {
                    let discount = await profileApi.getDiscount();
                    commit("setPersonalDiscount", {
                        discount: discount.personalDiscount,
                    });
                }
            },
            async getFull({ commit }) {
                let response = await userApi.get();
                if (response) {
                    commit("updateUser", response);
                }
            },
        },
    };
};
