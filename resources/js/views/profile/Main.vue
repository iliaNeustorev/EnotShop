<template>
    <div class="container">
        <div class="card">
            <div class="card-content">
                <div
                    class="media is-flex is-justify-content-flex-start is-flex-wrap-wrap"
                >
                    <div class="media-left">
                        <figure class="image is-128x128">
                            <router-link :to="{ name: 'profile.avatar' }"
                                ><img
                                    class="is-rounded"
                                    :src="`/storage/img/profile/` + user.img"
                                    alt="Аватар"
                                    title="Редактировать аватар"
                            /></router-link>
                        </figure>
                    </div>
                    <div class="media-content">
                        <p class="subtitle">
                            <span class="has-text-info">Email: </span>
                            {{ user.email }}
                        </p>
                        <p class="subtitle">
                            <span class="has-text-info">Имя: </span>
                            {{ user.name }}
                        </p>
                        <p class="subtitle">
                            <span class="has-text-info">Номер телефона: </span>
                            <span v-if="user.number != null">{{
                                user.number
                            }}</span
                            ><span v-else>Не задан</span>
                        </p>
                        <p class="subtitle">
                            <span class="has-text-info">Статус: </span>
                            <AppStatus />
                        </p>
                        <p class="subtitle">
                            <span class="has-text-info">Основной адрес: </span>
                            {{ mainAdress }}
                        </p>
                        <p class="subtitle">
                            <span class="has-text-info">Профиль создан:</span>
                            {{ user.created_at }}
                        </p>
                        <transition name="fade">
                            <AppAdresses v-show="adresses" />
                        </transition>
                        <div class="buttons">
                            <router-link
                                class="button is-success"
                                :to="{ name: 'profile.edit' }"
                                >Редактировать</router-link
                            >
                            <button
                                class="button is-info"
                                @click="showAdresses"
                            >
                                Адреса
                            </button>
                            <router-link
                                class="button is-warning"
                                :to="{ name: 'profile.password' }"
                                >Сменить пароль</router-link
                            >
                            <AppDeleteProfile :id="user.id" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import AppStatus from "@/components/auth/Status.vue";
import AppAdresses from "@/components/profile/adresses/All.vue";
import AppDeleteProfile from "@/components/profile/Delete.vue";
import { mapGetters, mapActions } from "vuex";
export default {
    components: { AppStatus, AppAdresses, AppDeleteProfile },
    data: () => ({
        adresses: false,
    }),
    computed: {
        ...mapGetters("userModule", ["user"]),
        mainAdress() {
            return this.user.mainAdress ?? "Не задан";
        },
    },
    methods: {
        ...mapActions("userModule", ["getFull"]),
        showAdresses() {
            this.adresses = !this.adresses;
        },
    },
    async created() {
        await this.getFull();
    },
};
</script>

<style scoped>
.fade-enter-from {
    opacity: 0;
}

.fade-enter-active {
    transition: opacity 0.5s;
}
</style>
