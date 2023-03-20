<template>
    <AppAuthAccess>
        <AppNotification :class-name="className" v-if="isDiscount">
            Ваша персональная скидка <b>{{ user.discount }} %</b>
        </AppNotification>
    </AppAuthAccess>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
    props: { addClass: { type: String, default: "" } },
    computed: {
        ...mapGetters("userModule", ["user"]),
        isDiscount() {
            return this.user.discount > 0;
        },
        className() {
            return "is-success is-light " + this.addClass;
        },
    },
    methods: {
        ...mapActions("userModule", ["getDiscount"]),
    },
    async created() {
        if (!this.isDiscount) {
            await this.getDiscount();
        }
    },
};
</script>
