<template>
    <span v-if="verified" class="has-text-link-dark" title="Активирован"
        >✓</span
    >
    <span v-else class="has-text-danger-dark" title="Неактивирован">X</span>
</template>
<script>
import checkVerify from "@/mixins/auth/check-verify.js";
export default {
    mixins: [checkVerify],
};
</script>
