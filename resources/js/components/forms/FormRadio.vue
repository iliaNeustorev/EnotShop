<template>
    <div class="control">
        <label class="radio">
            <input
                type="radio"
                name="group"
                :value="modelValue"
                :checked="checked"
                @input="changed($event)"
            />
            {{ label }}
        </label>
        <slot></slot>
    </div>
</template>
<script>
export default {
    emits: ["update:modelValue", "change-main"],
    props: {
        checked: { type: Boolean, default: false },
        modelValue: { type: String, required: false },
        label: { type: String, required: true },
    },
    methods: {
        changed(e) {
            this.$emit("update:modelValue", e.target.value);
            this.$emit("change-main");
        },
    },
};
</script>
