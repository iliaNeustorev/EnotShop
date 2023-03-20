<template>
    <div class="container">
        <div
            class="box is-flex is-flex-wrap-wrap is-justify-content-space-around"
        >
            <figure>
                <AppShowImage :images="product.images" />
                <div>Rating</div>
            </figure>
            <div>
                <p class="title is-3 has-text-success-dark">
                    {{ product.name }}
                </p>
                <hr />
                <p class="title is-5 has-text-info-dark">Описание</p>
                <p>{{ product.description }}</p>
                <hr />
                <div class="field has-addons height-footer">
                    <AppCartControls
                        :id="product.id"
                        :count-store="product.count_store"
                    ></AppCartControls>
                    <p class="is-size-5 ml-2" v-if="quantity(product.id)">
                        Выбрано:
                        <span class="has-text-success-dark"
                            >({{ quantity(product.id) }})</span
                        >
                        Сумма:
                        <span class="has-text-success-dark">{{
                            totalPrice
                        }}</span>
                    </p>
                </div>
                <p class="title is-5 has-text-info-dark">
                    Цена:
                    <AppPriceProduct
                        :price="+product.price"
                        :discount="+product.total_discount"
                        @send-price="setPrice($event)"
                    />
                </p>
                <div
                    class="is-flex is-flex-wrap-wrap is-align-content-flex-end is-justify-content-space-between"
                >
                    <p>
                        Осталось товара на складе:
                        <span class="title is-5 has-text-info-dark">{{
                            product.count_store
                        }}</span>
                    </p>
                    <p>
                        Категория:
                        <router-link
                            v-if="categorySlug"
                            :to="linkToCategory"
                            class="title is-5 has-text-info-dark"
                            >{{ product.category?.name }}</router-link
                        >
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AppShowImage from "@/components/product/ShowImage.vue";
import AppCartControls from "@/components/product/Controls.vue";
import AppPriceProduct from "@/components/product/Price.vue";
import { mapGetters } from "vuex";

export default {
    components: { AppShowImage, AppCartControls, AppPriceProduct },
    data() {
        return {
            product: [],
            price: 0,
        };
    },
    computed: {
        ...mapGetters("cartModule", ["quantity"]),
        slug() {
            return this.$route.params.slug;
        },
        categorySlug() {
            return this.product.category?.slug;
        },
        linkToCategory() {
            return {
                name: "products",
                params: { slug: this.product.category?.slug },
            };
        },
        totalPrice() {
            return (this.price * this.quantity(this.product.id)).toFixed(2);
        },
    },
    methods: {
        async getProduct(slug) {
            this.product = await this.$api.product.one(slug);
        },
        setPrice(price) {
            this.price = price;
        },
    },
    created() {
        this.getProduct(this.slug);
    },
    watch: {
        slug() {
            this.getProduct(this.slug);
        },
    },
};
</script>

<style scoped>
@media screen and (min-width: 1464px) {
    .height-footer {
        height: 75px;
    }
}
</style>
