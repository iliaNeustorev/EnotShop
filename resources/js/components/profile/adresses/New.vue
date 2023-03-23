<template>
    <template v-if="!limitAdress">
        <button class="button is-info is-small" @click="showForm">
            {{ buttonName }}
        </button>
        <div class="box" v-if="show">
            <div class="field has-addons mt-4">
                <div class="control">
                    <form-input-component
                        :form="newAdress"
                        :name="input.name"
                        :object-validation="input.validation"
                        @validation-field="validationField($event)"
                    />
                </div>
                <AppFormControls
                    class-name="is-link"
                    button-name="Новый адрес"
                    :validation="validationForm"
                    :loading="loading"
                    @click="addNew"
                />
            </div>
            <form-checkbox-component
                :form="newAdress"
                name="main"
                label="Сделать основным"
            />
        </div>
    </template>
    <div v-else>
        <i class="has-text-warning-dark my-2">Лимит {{ limit }} адресов</i>
    </div>
</template>
<script>
import AppFormControls from "@/components/forms/buttons/Controls.vue";
export default {
    components: { AppFormControls },
    props: {
        limit: { type: Number, default: 0 },
        countAdress: { type: Number, default: 0 },
    },
    emits: ["change-adresses"],
    data() {
        return {
            show: false,
            loading: false,
            newAdress: this.$vform.make({
                text: "",
            }),
            input: {
                name: "text",
                validation: {
                    valid: false,
                    rule: /^.{4,256}$/,
                    text: "Размер адреса от 4 до 256 символов",
                },
            },
        };
    },
    computed: {
        validationForm() {
            return this.input.validation.valid;
        },
        limitAdress() {
            return this.countAdress == this.limit;
        },
        buttonName() {
            return this.show ? "Скрыть" : "Добавить";
        },
    },
    methods: {
        async addNew() {
            if (this.validationForm) {
                this.loading = true;
                try {
                    await this.$api.user.profile.adress.add(this.newAdress);
                    this.$emit("change-adresses");
                } catch (e) {
                } finally {
                    this.loading = false;
                }
            }
        },
        showForm() {
            this.show = !this.show;
        },
        validationField(elem) {
            this.input.validation.valid = elem.currentRule;
        },
    },
};
</script>
