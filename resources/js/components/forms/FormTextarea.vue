<template>
    <div class="field">
        <label class="label" :for="id">{{ label }}</label>
        <div class="control has-icons-right" :class="iconClass">
            <textarea
                :id="id"
                ref="first"
                class="textarea"
                :name="name"
                :class="[inputClasses, className]"
                :placeholder="placeholder"
                :rows="row"
                @change="validationField"
                v-model.trim="form[name]"
            ></textarea>
            <span v-if="iconName" class="icon is-small is-left">
                <mdicon :name="iconName" />
            </span>
            <span v-if="validation && !hasError" class="icon is-small is-right">
                <mdicon name="check-outline" />
            </span>
            <span
                v-else-if="(!validation && !emptyField) || hasError"
                class="icon is-small is-right"
            >
                <mdicon name="close-outline" />
            </span>
        </div>
        <p v-if="hasError" class="help is-danger">{{ errorText }}</p>
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
        row: { type: Number, default: 3 },
    },
};
</script>
