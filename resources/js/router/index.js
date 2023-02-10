import { createRouter, createWebHistory } from "vue-router";
import createRoutes from "./routes";

export default (store) => {
    const routes = createRoutes();

    const router = createRouter({
        history: createWebHistory(),
        routes,
    });
    // router.beforeEach(async (to, from, next) => {
    //   let go;
    //   if (to.meta.auth || to.meta.guest || to.meta.admin) {
    //     await store.getters["userModule/ready"];

    //     let isLogin = store.getters["userModule/isAuth"];
    //     let user = store.getters["userModule/user"];
    //     let isAdmin = store.getters["userModule/isAdmin"];

    //     if (to.meta.auth && !isLogin) {
    //       go = { name: "home" };
    //     } else if (to.meta.guest && isLogin) {
    //       go = {
    //         name: "profile.main",
    //         params: { name: user.name },
    //       };
    //     }

    //     if (to.meta.admin && !isAdmin) {
    //       go = { name: "home" };
    //     }
    //   }
    //   next(go);
    // });

    return router;
};
