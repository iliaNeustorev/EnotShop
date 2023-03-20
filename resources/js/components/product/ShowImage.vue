<template>
    <carousel :slides="images" indicators></carousel>
</template>

<script>
import Carousel from "@/components/carousel/Carousel.vue";

export default {
    components: { Carousel },
    props: {
        images: {
            type: Array,
            default: [],
        },
    },
};
</script>

<style scoped></style>
