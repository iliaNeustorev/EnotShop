<template>
    <AppBaseCard
        :name="name"
        :description="description"
        :slug="slug"
        route-name="product"
    >
        <template v-slot:image>
            <figure class="image is-square">
                <img :src="picture" alt="picture" /></figure
        ></template>
        <footer class="card-footer">
            <p class="card-footer-item">
                <span>
                    Цена:
                    <AppPriceProduct :price="price" :discount="discount" />
                </span>
            </p>
            <p class="card-footer-item">
                <span
                    >Осталось на складе:
                    <span class="has-text-info">{{ countStore }}</span></span
                >
            </p>
        </footer>
        <div
            @click="showControls = true"
            @mouseleave="showControls = false"
            class="is-flex is-justify-content-center"
        >
            <span
                v-if="!showControls"
                class="has-text-primary-dark is-clickable"
            >
                Купить
            </span>
            <AppCartControls v-else :id="id" :count-store="countStore" />
        </div>
    </AppBaseCard>
</template>

<script>
import AppCartControls from "@/components/product/Controls.vue";
import AppBaseCard from "@/components/cards/BaseCard.vue";
import AppPriceProduct from "@/components/product/Price.vue";
import baseCard from "@/mixins/base-card";

export default {
    mixins: [baseCard],
    components: { AppBaseCard, AppCartControls, AppPriceProduct },
    props: {
        id: { type: Number, required: true },
        price: { type: Number, required: true },
        countStore: { type: Number, default: 0 },
        picture: { type: String, required: false },
        discount: { type: Number, required: false },
    },
    data() {
        return {
            showControls: false,
        };
    },
};
</script>
