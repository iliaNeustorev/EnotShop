import { createRouter, createWebHistory } from "vue-router";
import createRoutes from "./routes";

export default (store, redirect) => {
    const routes = createRoutes();

    const router = createRouter({
        history: createWebHistory(),
        routes,
    });
    router.beforeEach((to, from, next) => {
        let go;
        if (to.meta.auth || to.meta.guest || to.meta.admin) {
            let isLogin = store.getters["userModule/isAuth"];
            // let isAdmin = store.getters["userModule/isAdmin"];

            if (to.meta.auth && !isLogin) {
                document.location = "/auth/login";
            } else if (to.meta.guest && isLogin) {
                go = {
                    name: "home",
                };
            }

            // if (to.meta.admin && !isAdmin) {
            //     go = { name: "home" };
            // }
        }
        next(go);
    });

    return router;
};
