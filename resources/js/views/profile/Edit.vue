<template>
    <div class="container">
        <div class="box">
            <div class="column is-half">
                <form-input-component
                    v-for="input in inputs"
                    :key="input.name"
                    :form="profile"
                    :name="input.name"
                    :label="input.label"
                    :placeholder="input.placeholder"
                    :object-validation="input.validation"
                    @validation-field="validationField($event, input.name)"
                />
                <div class="buttons is-right mt-4">
                    <AppFormControls
                        @click="editProfile"
                        button-name="Принять изменения"
                        :validation="validationForm"
                        :loading="loading"
                    />
                    <AppButtonBack />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import AppFormControls from "@/components/forms/buttons/Controls.vue";
import { mapGetters, mapActions } from "vuex";
export default {
    components: { AppFormControls },
    data() {
        return {
            inputs: [
                {
                    name: "name",
                    label: "Имя",
                    placeholder: "Введите имя",
                    validation: {
                        valid: false,
                        rule: /^[a-zA-Zа-яА-Я\d]{2,29}$/,
                        text: "Имя должно начинаться с буквы или цифры и иметь от 3 до 30 символов",
                    },
                },
                {
                    name: "email",
                    label: "Email",
                    placeholder: "Введите email",
                    validation: {
                        valid: false,
                        rule: /^.{2,256}@.+\.[a-zA-Z]{2,256}$/,
                        text: "должен быть корректный email",
                    },
                },
                {
                    name: "number",
                    label: "Номер телефона",
                    placeholder: "Введите номер телефона",
                    validation: {
                        valid: false,
                        rule: /^\d*$/,
                        text: "должен содержать цифры от 5 до 50 символов",
                    },
                },
            ],
            profile: this.$vform.make({
                name: "",
                number: "",
                email: "",
            }),
            loading: false,
        };
    },
    computed: {
        ...mapGetters("userModule", ["user"]),
        validationForm() {
            return this.inputs.every((input) => input.validation.valid);
        },
    },
    methods: {
        ...mapActions("userModule", ["getFull"]),
        async editProfile() {
            this.loading = true;
            try {
                if (this.validationForm) {
                    await this.$api.user.profile.edit(this.profile);
                    await this.getFull();
                }
            } catch (e) {
            } finally {
                this.loading = false;
            }
        },
        validationField(elem, name) {
            let input = this.inputs.find((input) => input.name === name);
            if (input) {
                input.validation.valid = elem.currentRule;
            }
        },
    },
    async created() {
        await this.getFull();
        Object.assign(this.profile, {
            name: this.user.name,
            number: this.user.number,
            email: this.user.email,
        });
    },
};
</script>
