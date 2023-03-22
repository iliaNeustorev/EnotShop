<template>
    <span
        v-if="!main"
        class="icon has-text-primary is-clickable"
        :class="[focused, className]"
        @mouseenter="hover = true"
        @mouseleave="hover = false"
        title="удалить адрес"
        @click.stop="deleteAdress"
    >
        <mdicon name="trash-can-outline"
    /></span>
</template>
<script>
export default {
    props: {
        id: { type: Number, required: true },
        main: { type: Boolean, default: false },
        className: { type: String, default: "" },
    },
    emits: ["deleted-adress"],
    data() {
        return {
            hover: false,
        };
    },
    computed: {
        focused() {
            return { "has-text-danger": this.hover };
        },
    },
    methods: {
        async deleteAdress() {
            let res = await this.$api.user.profile.adress.delete(this.id);
            if (res) {
                this.$emit("deleted-adress");
            }
        },
    },
};
</script>
