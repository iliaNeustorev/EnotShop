<template>
    <div class="control">
        <label class="radio">
            <input
                type="radio"
                name="group"
                :value="modelValue"
                :checked="checked"
                @input="$emit('update:modelValue', $event.target.value)"
            />
            {{ label }}
        </label>
        <slot></slot>
    </div>
</template>
<script>
export default {
    emits: ["update:modelValue"],
    props: {
        checked: { type: Boolean, default: false },
        modelValue: { type: String, required: false },
        label: { type: String, required: true },
    },
};
</script>
