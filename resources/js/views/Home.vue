<template>
    <div class="container">
        <p class="title is-2 has-text-warning-dark">
            Самые популярные продукты
        </p>
        <div class="is-flex is-flex-wrap-wrap" :class="$style.cards">
            <div
                v-for="product in popularProducts"
                :key="product.id"
                class="card p-2 mb-2"
                :class="$style['card-width']"
            >
                <AppCardProduct
                    :id="product.id"
                    :name="product.name"
                    :description="product.description"
                    :slug="product.slug"
                    :price="product.price"
                    :count-store="product.count_store"
                    :picture="product.image"
                    :discount="+product.total_discount"
                />
            </div>
        </div>
    </div>
</template>

<script>
import AppCardProduct from "@/components/cards/CardProduct.vue";

export default {
    components: {
        AppCardProduct,
    },
    data() {
        return {
            popularProducts: [],
        };
    },
    methods: {
        async getPopularProducts() {
            this.popularProducts = await this.$api.product.mostSold();
        },
    },
    created() {
        this.getPopularProducts();
    },
};
</script>

<style module>
.cards {
    margin: 0 -10px;
}
.card-width {
    margin: 0 10px;
    flex: 0 3 249px;
}
.card-width a {
    color: #000;
}
.container {
    margin: 0, 30px;
}
@media (min-width: 300px) and (max-width: 560px) {
    .card-width {
        flex-grow: 1;
    }
}
</style>
