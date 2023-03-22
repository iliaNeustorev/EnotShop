<template>
    <template v-if="!limitAdress">
        <div class="field has-addons mt-4">
            <div class="control">
                <form-input-component
                    :form="newAdress"
                    :name="input.name"
                    :object-validation="input.validation"
                    @validation-field="validationField($event)"
                />
            </div>
            <div class="control">
                <button
                    :disabled="!validationForm"
                    class="button is-info"
                    @click="addNew"
                >
                    Новый адрес
                </button>
            </div>
        </div>
        <form-checkbox-component
            :form="newAdress"
            name="main"
            label="Сделать основным"
        />
    </template>
    <div v-else>
        <i class="has-text-warning-dark my-2">Лимит {{ limit }} адресов</i>
    </div>
</template>
<script>
export default {
    props: {
        limit: { type: Number, default: 0 },
        countAdress: { type: Number, default: 0 },
    },
    emits: ["change-adresses"],
    data() {
        return {
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
            return this.newAdress.text.length > 0;
        },
        limitAdress() {
            return this.countAdress == this.limit;
        },
    },
    methods: {
        async addNew() {
            if (this.validationForm) {
                try {
                    await this.$api.user.profile.adress.add(this.newAdress);
                    this.$emit("change-adresses");
                } catch (e) {}
            }
        },
        validationField(elem) {
            this.input.validation.valid = elem.currentRule;
        },
    },
};
</script>
