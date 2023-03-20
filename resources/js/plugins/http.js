import axios from "axios";
import createHomeApi from "@/api/home";
import createCategoryApi from "@/api/category";
import createUserMainApi from "@/api/user/main";
import createProductApi from "@/api/product";
import createCartApi from "@/api/cart";
import createProfileApi from "@/api/user/profile";
export default () => {
    const http = axios.create({
        baseURL: "/api/",
        timeout: 10000,
        headers: {
            Accept: "application/json",
            "X-Requested-With": "XMLHttpRequest",
        },
    });

    const api = {
        home: createHomeApi(http),
        category: createCategoryApi(http),
        product: createProductApi(http),
        cart: createCartApi(http),
        user: {
            main: createUserMainApi(http),
            profile: createProfileApi(http),
        },
    };
    return { http, api };
};
