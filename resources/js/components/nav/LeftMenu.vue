<template>
    <div class="mt-2">
        <AppAuthAccess
            ><div><AppUserPanel /></div
        ></AppAuthAccess>
    </div>
</template>

<script>
import AppUserPanel from "@/components/auth/UserPanel.vue";
export default {
    components: {
        AppUserPanel,
    },
};
</script>

<style></style>
