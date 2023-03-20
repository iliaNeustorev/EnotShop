<template>
    <div class="container mt-2">
        <div :class="$style.cards">
            <loading-component v-if="loading" />
            <div
                v-else
                v-for="category in categories"
                :key="category.id"
                class="card p-2"
            >
                <AppCardCategory
                    :name="category.name"
                    :description="category.description"
                    :slug="category.slug"
                    :picture="category.picture"
                />
            </div>
        </div>
    </div>
</template>

<script>
import AppCardCategory from "@/components/cards/CardCategory.vue";
export default {
    components: {
        AppCardCategory,
    },
    data() {
        return {
            categories: [],
            loading: false,
        };
    },
    methods: {
        async getCategories() {
            this.loading = true;
            this.categories = await this.$api.category.all();
            this.loading = false;
        },
    },
    created() {
        this.getCategories();
    },
};
</script>

<style module>
.cards {
    display: grid;
    gap: 10px;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
}
.cards a {
    color: #000;
}
</style>
