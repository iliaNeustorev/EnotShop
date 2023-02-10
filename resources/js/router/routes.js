import Home from "../views/Home.vue";
import E404 from "../components/E404.vue";

export default function () {
    const routes = [
        {
            path: "/",
            name: "home",
            component: Home,
        },
        {
            path: "/:any(.*)*",
            component: E404,
        },
    ];

    return routes;
}
