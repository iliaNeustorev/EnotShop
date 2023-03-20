<template>
    <router-link :title="'Посмотреть подробнее ' + name" :to="linkTo">
        <div class="card-image"><slot name="image"></slot></div>
        <div class="card-content has-text-justified">
            <div class="media">
                <div class="media-content">
                    <hr />
                    <p class="title is-4 has-text-centered">{{ name }}</p>
                    <p class="content has-text-justified">
                        {{ description }}
                    </p>
                </div>
            </div>
        </div>
    </router-link>
    <slot></slot>
</template>

<script>
import baseCard from "@/mixins/base-card.js";

export default {
    mixins: [baseCard],
    props: {
        routeName: { type: String, required: true },
    },
    computed: {
        linkTo() {
            return {
                name: this.routeName,
                params: { slug: this.slug },
            };
        },
    },
};
</script>
<style scoped>
.content {
    height: 97px;
    overflow: hidden;
}
</style>
