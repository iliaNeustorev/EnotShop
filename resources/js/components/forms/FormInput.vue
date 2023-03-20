<template>
    <div class="field">
        <label v-if="label" class="label" :for="id">{{ label }}</label>
        <div class="control has-icons-right" :class="iconClass">
            <input
                :id="id"
                ref="first"
                class="input"
                :class="emptyFieldClass ?? inputClasses"
                :type="type"
                :name="name"
                :placeholder="placeholder"
                v-model.trim="form[name]"
            />
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
        type: { type: String, default: "text" },
    },
};
</script>
