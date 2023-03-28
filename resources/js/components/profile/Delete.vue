<template>
    <button @click="showModal" class="button is-danger">Удалить профиль</button>
    <AppModalWindow ref="modal"
        ><p>Вы действительно удалить профиль?</p>
        <template v-slot:footer>
            <div class="buttons is-centered">
                <button
                    class="button is-warning is-light is-outlined"
                    @click="cancelDelete"
                >
                    Нет
                </button>
                <button
                    @click="deleteProfile"
                    class="button is-success is-light is-outlined"
                >
                    ДА
                </button>
            </div>
        </template>
    </AppModalWindow>
</template>
<script>
import AppModalWindow from "@/components/modal/Window.vue";
export default {
    components: {
        AppModalWindow,
    },
    props: { id: { type: Number, required: true } },
    methods: {
        showModal() {
            this.$refs.modal.show = true;
        },
        cancelDelete() {
            this.$refs.modal.show = false;
        },
        async deleteProfile() {
            let res = await this.$api.user.profile.deleteProfile(this.id);
            if (res) {
                window.location.href = this.$redirectRoutes.login();
            }
        },
    },
};
</script>
