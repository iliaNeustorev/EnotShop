<template>
    <div class="file has-name" :class="inputClasses">
        <label class="file-label">
            <input
                class="file-input"
                :id="id"
                type="file"
                ref="firstInp"
                :name="name"
                @change="download"
            />

            <span class="file-cta">
                <span class="file-icon">
                    <mdicon name="download-circle-outline" />
                </span>
                <span v-show="!file" class="file-label"> {{ label }} </span>
            </span>
            <span class="file-name">{{ fileName }}</span>
        </label>

        <button
            :disabled="!file"
            @click.prevent="clearPicture()"
            class="button is-danger"
            title="Очистить картинку"
        >
            X
        </button>
        <slot></slot>
    </div>
    <p v-if="hasError" class="help is-danger">{{ errorText }}</p>
    <p v-else-if="text" class="help is-danger">
        {{ objectValidation.text }}
    </p>
</template>

<script>
import baseForm from "@/mixins/base-form.js";

export default {
    mixins: [baseForm],
    computed: {
        text() {
            return this.objectValidation.text && !this.validation;
        },
        file() {
            return this.form[this.name];
        },
        fileName() {
            return this.file ? this.form[this.name].name : "Нет картинки";
        },
        validation() {
            return this.objectValidation && this.file != null
                ? this.objectValidation.rule.test(this.form[this.name].name)
                : true;
        },
    },
    methods: {
        download() {
            let file = this.$refs.firstInp.files[0];
            this.form[this.name] = file;
            this.validationField();
        },
        clearPicture() {
            if (this.file != null) {
                this.form[this.name] = null;
                this.$refs.firstInp.value = null;
                this.validationField();
            }
        },
    },
};
</script>
