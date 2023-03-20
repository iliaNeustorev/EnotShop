<template>
    <slot v-if="auth"></slot>
</template>

<script>
import { mapGetters } from "vuex";
export default {
    props: { noAuth: { type: Boolean, default: false } },
    computed: {
        ...mapGetters("userModule", ["isAuth"]),
        auth() {
            return !this.noAuth ? this.isAuth : !this.isAuth;
        },
    },
};
</script>
