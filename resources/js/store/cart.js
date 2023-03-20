export default (cartApi, storageHelpers) => {
    return {
        namespaced: true,

        state: {
            products: {},
        },
        getters: {
            all: (state) => state.products,
            empty: (state) => Object.keys(state.products).length === 0,
            quantity: (state) => (id) => state.products[id] ?? 0,
            totalAmount: (state) =>
                Object.values(state.products).reduce(
                    (acc, number) => acc + number,
                    0
                ),
        },
        mutations: {
            setCart(state, cart) {
                if (Object.keys(cart).length === 0) {
                    state.products = Object.create(cart);
                } else {
                    state.products = Object.assign(cart);
                }
            },
            remove(state, id) {
                delete state.products[id];
            },
            setCnt(state, { id, cnt }) {
                state.products[id] = cnt;
            },
        },
        actions: {
            async load({ commit, rootGetters }) {
                let timeCart = storageHelpers.getTimeCart();
                if (rootGetters["userModule/isAuth"]) {
                    if (Object.keys(timeCart).length !== 0) {
                        await cartApi.sync(timeCart);
                    }
                    let cart = await cartApi.all();
                    commit("setCart", cart);
                    storageHelpers.removeTimeCart();
                } else {
                    commit("setCart", timeCart);
                }
            },
            async setCnt(
                { commit, dispatch, rootGetters, getters },
                { id, cnt, countStore }
            ) {
                if (cnt < 1) {
                    try {
                        if (rootGetters["userModule/isAuth"]) {
                            let result = await cartApi.remove(id);
                            return commit("setCart", result.cart);
                        }
                        return commit("remove", id);
                    } catch (e) {
                    } finally {
                        if (!rootGetters["userModule/isAuth"]) {
                            storageHelpers.setTimeCart(getters.all);
                        }
                    }
                }
                let validCnt = Math.min(Math.max(cnt, 1), countStore);
                try {
                    if (rootGetters["userModule/isAuth"]) {
                        let result = await cartApi.add(id, validCnt);
                        commit("setCart", result.cart);
                    }
                } catch (e) {
                    let code = e.response?.status;
                    if (code === 422) {
                        dispatch(
                            "alertModule/add",
                            {
                                text: "Лимит превышает количество на складе",
                                timeout: 5000,
                                importance: "warning",
                            },
                            { root: true }
                        );
                    } else {
                        dispatch(
                            "alertModule/add",
                            {
                                text: "Не удалось добавить товар в корзину. Перезагрузите страницу или попробуйте позднее",
                                timeout: 5000,
                                importance: "danger",
                            },
                            { root: true }
                        );
                    }
                } finally {
                    commit("setCnt", { id, cnt: validCnt });
                    if (!rootGetters["userModule/isAuth"]) {
                        storageHelpers.setTimeCart(getters.all);
                    }
                }
            },
        },
    };
};
