<template>
    <AppDropDown :show="show" class-name-content="px-2">
        <template v-slot:trigger
            ><span
                class="icon has-text-info is-clickable"
                title="редактировать адрес"
            >
                <mdicon name="home-edit-outline" /></span
        ></template>
        <template v-slot:content
            ><div class="field has-addons">
                <div class="control">
                    <form-input-component
                        :form="editAdress"
                        :name="input.name"
                        :object-validation="input.validation"
                        @validation-field="validationField($event)"
                    />
                </div>
                <AppFormControls
                    class-name="is-success"
                    button-name="OK"
                    :validation="validationForm"
                    :loading="loading"
                    :icon-show="false"
                    @click="edit"
                />
                <div class="control">
                    <button class="button is-info" @click.stop="close">
                        Отмена
                    </button>
                </div>
            </div></template
        >
    </AppDropDown>
</template>
<script>
import AppDropDown from "@/components/support/DropDown.vue";
import AppFormControls from "@/components/forms/buttons/Controls.vue";
export default {
    components: { AppDropDown, AppFormControls },
    props: {
        id: { type: Number, required: true },
        adress: { type: String, required: true, default: "" },
        className: { type: String, default: "" },
    },
    emits: ["change-adresses"],
    data() {
        return {
            loading: false,
            show: false,
            editAdress: this.$vform.make({
                text: this.adress,
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
    },
    methods: {
        validationField(elem) {
            this.input.validation.valid = elem.currentRule;
        },
        async edit() {
            this.lodaing = true;
            try {
                await this.$api.user.profile.adress.edit(
                    this.editAdress,
                    this.id
                );
                this.close();
                this.$emit("change-adresses");
            } catch (e) {
            } finally {
                this.loading = false;
            }
        },
        close() {
            this.show = false;
        },
    },
};
</script>
