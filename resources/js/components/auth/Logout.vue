<template>
    <button class="button is-primary" @click="showModal">Выйти</button>
    <AppModalWindow ref="modal"
        ><p>Вы действительно хотите выйти?</p>
        <template v-slot:footer>
            <div class="buttons is-centered">
                <button
                    class="button is-warning is-light is-outlined"
                    @click="cancelDelete"
                >
                    Нет
                </button>
                <form method="POST" :action="$redirectRoutes.logout()">
                    <input type="hidden" name="_token" :value="$csrf" />
                    <button class="button is-success is-light is-outlined">
                        ДА
                    </button>
                </form>
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
    methods: {
        showModal() {
            this.$refs.modal.show = true;
        },
        cancelDelete() {
            this.$refs.modal.show = false;
        },
    },
};
</script>
