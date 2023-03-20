<template>
    <div class="container">
        <p class="title is-2 has-text-warning-dark mx-2">
            {{ title }}
        </p>
        <p class="title is-4 has-text-grey mx-2">
            Количество товара:
            <span class="has-text-success-dark">{{ count }}</span>
        </p>
        <div :class="$style.cards">
            <div v-if="emptyProducts"><i>Нет продуктов</i></div>
            <div
                v-else
                v-for="product in products"
                :key="product.id"
                class="card p-2"
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
            products: [],
            title: "",
            count: 0,
        };
    },
    computed: {
        slug() {
            return this.$route.params.slug;
        },
        emptyProducts() {
            return this.products?.length === 0;
        },
    },
    methods: {
        async getProducts(slug) {
            this.data = await this.$api.category.oneWithProducts(slug);
            this.products = this.data.products;
            this.title = this.data.categoryName;
            this.count = this.data.count;
        },
    },
    created() {
        this.getProducts(this.slug);
    },
    watch: {
        slug() {
            this.getProducts(this.slug);
        },
    },
};
</script>

<style module>
.cards {
    display: grid;
    gap: 10px;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
}
.cards a {
    color: #000;
}
</style>
