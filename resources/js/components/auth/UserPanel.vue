<template>
    <article class="panel is-success">
        <p class="panel-heading is-flex is-justify-content-space-between">
            <span>{{ user.name }}</span
            ><AppStatus />
        </p>
        <p
            class="panel-tabs is-flex is-justify-content-space-around is-flex-wrap-wrap"
        >
            <router-link
                v-for="link in links"
                :key="link.name"
                :to="{ name: link.routeName }"
                exact-active-class="is-active"
                >{{ link.name }}</router-link
            >
        </p>
        <AppVerifyEmail />
        <div
            class="panel-block is-flex is-flex-wrap-wrap is-justify-content-center"
        >
            <AppPersonalDiscount add-class="my-2" />
            <AppLogout />
        </div>
    </article>
</template>

<script>
import { mapGetters } from "vuex";
import AppStatus from "@/components/auth/Status.vue";
import AppLogout from "@/components/auth/Logout.vue";
import AppVerifyEmail from "@/components/auth/SendVerifyEmail.vue";
import AppPersonalDiscount from "@/components/profile/PersonalDiscount.vue";
export default {
    data() {
        return {
            links: [
                { routeName: "profile", name: "Профиль" },
                { routeName: "profile", name: "Заказы" },
                { routeName: "profile.password", name: "Смена пароля" },
            ],
        };
    },
    components: { AppLogout, AppVerifyEmail, AppPersonalDiscount, AppStatus },
    computed: {
        ...mapGetters("userModule", ["user"]),
    },
};
</script>
