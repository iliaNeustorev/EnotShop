import axios from "axios";
import createHomeApi from "@/api/home";
import createUserMainApi from "@/api/user/main";

axios.defaults.baseURL = "api/";

export default () => {
    const http = axios.create({});

    const api = {
        home: createHomeApi(http),

        user: {
            main: createUserMainApi(http),
        },
    };

    return { http, api };
};
