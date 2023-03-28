import Home from "../views/Home.vue";
import E404 from "../components/E404.vue";
import Catalog from "../views/Catalog.vue";
import Contacts from "../views/Contacts.vue";
import Products from "../views/product/Products.vue";
import Product from "../views/product/One.vue";
import Cart from "../views/Cart.vue";
import ProfileMain from "../views/profile/Main.vue";
import ProfileEdit from "../views/profile/Edit.vue";
import ProfilePassword from "../views/profile/Password.vue";
import ProfileAvatar from "../views/profile/Avatar.vue";

export default function () {
    const routes = [
        {
            path: "/",
            name: "home",
            component: Home,
        },
        {
            path: "/categories",
            name: "catalog",
            component: Catalog,
        },
        {
            path: "/:slug/products",
            name: "products",
            component: Products,
            props: true,
        },
        {
            path: "/product/:slug",
            name: "product",
            component: Product,
        },
        {
            path: "/contacts",
            name: "contacts",
            component: Contacts,
        },
        {
            path: "/cart",
            name: "cart",
            component: Cart,
        },
        {
            path: "/profile/",
            meta: { auth: true },
            children: [
                {
                    path: "main",
                    name: "profile",
                    component: ProfileMain,
                },
                {
                    path: "edit",
                    name: "profile.edit",
                    component: ProfileEdit,
                },
                {
                    path: "password",
                    name: "profile.password",
                    component: ProfilePassword,
                },
                {
                    path: "avatar",
                    name: "profile.avatar",
                    component: ProfileAvatar,
                },
            ],
        },
        {
            path: "/:any(.*)*",
            component: E404,
        },
    ];

    return routes;
}
