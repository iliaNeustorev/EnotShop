<template>
    <AppBaseCard
        :name="name"
        :description="description"
        :slug="slug"
        route-name="products"
    >
        <template v-slot:image>
            <figure class="image is-square">
                <img :src="picture" alt="Картинка" />
            </figure>
        </template>
    </AppBaseCard>
</template>

<script>
import AppBaseCard from "@/components/cards/BaseCard.vue";
import baseCard from "@/mixins/base-card";

export default {
    mixins: [baseCard],
    components: { AppBaseCard },
    props: {
        picture: { type: String, required: false },
    },
};
</script>
