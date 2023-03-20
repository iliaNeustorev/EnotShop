<template>
    <td>
        <router-link
            :to="linkToProduct"
            :title="`Перейти на старницу ${product.name}`"
            >{{ product.name }}</router-link
        >
    </td>
    <td>{{ count }}</td>
    <td>
        <AppPriceProduct
            :price="+product.price"
            :discount="+product.total_discount"
            @send-price="setPrice($event)"
        />
    </td>
    <td>{{ sum }}</td>
    <td class="is-flex is-justify-content-center">
        <AppCartControls :id="product.id" :count-store="product.count_store" />
    </td>
</template>
<script>
import { mapGetters } from "vuex";
import AppPriceProduct from "@/components/product/Price.vue";
import AppCartControls from "@/components/product/Controls.vue";

export default {
    components: {
        AppCartControls,
        AppPriceProduct,
    },
    emits: ["reload", "sendSum"],
    props: { product: { type: Object, required: true } },
    data() {
        return {
            price: 0,
        };
    },
    computed: {
        ...mapGetters("cartModule", ["quantity"]),
        count() {
            return this.quantity(this.product.id);
        },
        sum() {
            return (this.price * this.count).toFixed(2);
        },
        linkToProduct() {
            return { name: "product", params: { slug: this.product.slug } };
        },
    },
    methods: {
        setPrice(price) {
            this.price = price;
        },
        sendSum() {
            this.$emit("sendSum", { id: this.product.id, sum: this.sum });
        },
    },
    mounted() {
        this.sendSum();
    },
    watch: {
        count() {
            if (this.count <= 0) {
                return this.$emit("reload", this.product.id);
            }
            this.sendSum();
        },
    },
};
</script>
