<template>
    <label :for="id" class="label"> {{ label }} </label>
    <div class="select is-multiple" :class="inputClasses">
        <select
            :multiple="multiple"
            :id="id"
            :size="size"
            :name="name"
            v-model="form[name]"
            @change="validationField"
        >
            <option v-if="!multiple" value="" disabled>---Не выбрано---</option>
            <option
                v-for="option in options"
                :key="option.id"
                :value="option.id"
            >
                {{ option.description }}
            </option>
        </select>
        <p v-if="hasError" class="help is-danger">
            {{ errorText }}
        </p>
        <p v-else-if="text" class="help is-danger">
            {{ objectValidation.text }}
        </p>
    </div>
</template>

<script>
import baseForm from "@/mixins/base-form";
export default {
    mixins: [baseForm],
    props: {
        options: { type: Array, required: true },
        multiple: { type: Boolean, default: false },
        userSize: { type: Number, required: false },
    },
    computed: {
        size() {
            return this.multiple ? this.userSize : 1;
        },
        text() {
            return this.objectValidation.text && !this.validation;
        },
    },
};
</script>
