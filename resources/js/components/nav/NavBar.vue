<template>
    <nav class="navbar is-light" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <router-link :to="{ name: 'home' }" class="image is-64x64">
                <img class="is-rounded" src="@/assets/logo.jpg" />
            </router-link>
            <a class="navbar-burger mt-2 mr-1">
                <span
                    v-for="(item, i) in 3"
                    :key="i"
                    class="burger-button"
                    aria-hidden="true"
                ></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <router-link
                    v-for="route in menu"
                    :key="route.name"
                    :to="{ name: route.name }"
                    class="navbar-item"
                >
                    {{ route.text }}
                </router-link>
                <AppItemCategories />
                <router-link class="navbar-item" :to="{ name: 'cart' }"
                    >Корзина<span class="ml-1" v-if="totalAmount"
                        >({{ totalAmount }})</span
                    ></router-link
                >
            </div>
            <div class="navbar-end">
                <div class="navbar-item">
                    <AppAuthAccess :noAuth="true">
                        <div class="buttons">
                            <a
                                :href="$redirectRoutes.register()"
                                class="button is-primary"
                            >
                                <strong>Регистрация</strong>
                            </a>
                            <a
                                :href="$redirectRoutes.login()"
                                class="button is-light"
                            >
                                Войти
                            </a>
                        </div>
                    </AppAuthAccess>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import { mapGetters } from "vuex";

import AppItemCategories from "@/components/nav/nav-items/Categories.vue";
export default {
    components: {
        AppItemCategories,
    },
    data() {
        return {
            menu: [
                { name: "home", text: "Главная" },
                { name: "catalog", text: "Каталог" },
                { name: "contacts", text: "Контакты" },
            ],
        };
    },
    computed: {
        ...mapGetters("cartModule", ["totalAmount"]),
    },
};
</script>
