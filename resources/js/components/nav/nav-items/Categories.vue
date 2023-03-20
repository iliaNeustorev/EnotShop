<template>
    <div
        class="navbar-item has-dropdown"
        :class="{ 'is-hoverable': showCategory }"
        @click="getCategories"
    >
        <a class="navbar-link"> Категории </a>

        <div class="navbar-dropdown">
            <button
                v-if="emptyCategories"
                class="button is-white is-loading is-small"
            >
                Loading
            </button>
            <router-link
                :to="{ name: 'products', params: { slug } }"
                v-else
                v-for="(name, slug) in categories"
                :key="slug"
                class="navbar-item"
            >
                {{ name }}
            </router-link>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            categories: [],
            showCategory: false,
        };
    },
    computed: {
        emptyCategories() {
            return this.categories.length === 0;
        },
    },
    methods: {
        async getCategories() {
            this.showCategory = !this.showCategory;
            if (this.showCategory && this.emptyCategories) {
                this.categories = await this.$api.category.allForNavBar();
            }
        },
    },
};
</script>
