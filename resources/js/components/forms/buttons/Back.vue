<template>
    <button @click="back" class="button" :class="className">Назад</button>
</template>

<script>
export default {
    props: {
        route: { type: String, required: false },
        className: { type: String, default: "is-link is-medium" },
    },
    methods: {
        back() {
            if (this.route === undefined) {
                return this.$router.back(-1);
            } else if (this.route !== undefined) {
                return this.$router.push({ name: this.route });
            }
        },
    },
};
</script>
