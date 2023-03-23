<template>
    <div class="container">
        <form class="box" @submit.prevent="sendForm">
            <div class="column is-half">
                <form-input-component
                    v-for="input in inputs"
                    :key="input.name"
                    :form="changePassword"
                    :name="input.name"
                    type="password"
                    :label="input.label"
                    placeholder="********"
                    :object-validation="input.validation"
                    @validation-field="validationField($event, input.name)"
                />
                <AppFormControls
                    button-name="Сменить пароль"
                    :validation="validationForm"
                    :loading="loading"
                />
            </div>
        </form>
    </div>
</template>

<script>
import { mapActions } from "vuex";
import AppFormControls from "@/components/forms/buttons/Controls.vue";
export default {
    components: { AppFormControls },
    data() {
        return {
            loading: false,
            changePassword: this.$vform.make({
                current: "",
                password: "",
                password_confirmation: "",
            }),
            inputs: [
                {
                    name: "current",
                    label: "Текущий пароль",
                    iconName: "key-outline",
                    validation: {
                        valid: false,
                        rule: /^.{3,}$/,
                        text: "введите текущий пароль",
                    },
                },
                {
                    name: "password",
                    label: "Новый пароль",
                    iconName: "key-outline",
                    validation: {
                        valid: false,
                        rule: /^.{8,256}$/,
                        text: "Пароль минимум 8 символов",
                    },
                },
                {
                    name: "password_confirmation",
                    label: "Повторите новый пароль",
                    iconName: "key-change",
                    validation: {
                        valid: false,
                        rule: /^.{8,256}$/,
                        text: "Пароль минимум 8 символов",
                    },
                },
            ],
        };
    },
    computed: {
        validationForm() {
            return this.inputs.every((input) => input.validation.valid);
        },
    },
    methods: {
        ...mapActions("alertModule", { addMessage: "add" }),
        validationField(elem, name) {
            let input = this.inputs.find((input) => input.name === name);
            if (input) {
                input.validation.valid = elem.currentRule;
            }
        },
        async sendForm() {
            if (this.validationForm) {
                this.loading = true;
                try {
                    await this.$api.user.profile.changePassword(
                        this.changePassword
                    );
                    window.location.href = this.$redirectRoutes.login();
                } catch (e) {
                    this.addMessage({
                        text: "Ошибка.Сменить пароль не удалось",
                        timeout: 5000,
                        importance: "danger",
                    });
                } finally {
                    this.loading = false;
                }
            }
        },
    },
};
</script>
