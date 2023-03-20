<template>
    <label class="radio">
        <input type="radio" :value="value" :checked="checked" />
        {{ label }}
    </label>
</template>
<script>
export default {
    emits: ["send-form"],
    props: {
        checked: { type: Boolean, default: false },
        value: { type: String, required: true },
        label: { type: String, required: true },
    },
};
</script>
