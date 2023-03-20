<template>
    <span class="has-text-success-dark" :class="classPriceSale"
        >{{ price }}
    </span>
    <span v-if="this.discount" class="has-text-success-dark ml-2">{{
        priceWithSale
    }}</span>
</template>
<script>
export default {
    props: {
        price: { type: Number, required: true },
        discount: { type: Number, required: false },
    },
    emits: ["send-price"],
    computed: {
        classPriceSale() {
            return {
                "text-through has-text-grey-light text-throght": this.discount,
            };
        },
        sale() {
            return this.discount ? (this.price / 100) * this.discount : 0;
        },
        priceWithSale() {
            return (this.price - this.sale).toFixed(2);
        },
    },
    mounted() {
        this.$emit("send-price", this.priceWithSale);
    },
    watch: {
        discount() {
            this.$emit("send-price", this.priceWithSale);
        },
    },
};
</script>

<style scoped>
.text-throght {
    text-decoration: line-through;
}
</style>
