<template>
    <div class="carousel">
        <div class="carousel-inner">
            <carousel-indicators
                v-if="indicators"
                :total="slides.length"
                :current-index="currentSlide"
                @switch="switchSlide($event)"
            ></carousel-indicators>
            <carousel-item
                v-for="(slide, index) in slides"
                :slide="slide.url"
                :key="`item-${index}`"
                :current-slide="currentSlide"
                :index="index"
                :direction="direction"
                @mouseenter="stopSlideTimer"
                @mouseout="startSlideTimer"
            ></carousel-item>
            <carousel-controls
                v-if="controls"
                @prev="prev"
                @next="next"
            ></carousel-controls>
        </div>
    </div>
</template>

<script>
import CarouselItem from "@/components/carousel/CarouselItem.vue";
import CarouselControls from "@/components/carousel/CarouselControls.vue";
import CarouselIndicators from "@/components/carousel/CarouselIndicators.vue";

export default {
    props: {
        slides: {
            type: Array,
            required: true,
        },
        controls: {
            type: Boolean,
            default: false,
        },
        indicators: {
            type: Boolean,
            default: false,
        },
        timer: {
            type: Boolean,
            default: false,
        },
        interval: {
            type: Number,
            default: 5000,
        },
    },
    components: { CarouselItem, CarouselControls, CarouselIndicators },
    data: () => ({
        currentSlide: 0,
        slideInterval: null,
        direction: "right",
    }),
    methods: {
        setCurrentSlide(index) {
            this.currentSlide = index;
        },
        prev(step = -1) {
            const index =
                this.currentSlide > 0
                    ? this.currentSlide + step
                    : this.slides.length - 1;
            this.setCurrentSlide(index);
            this.direction = "left";
            this.startSlideTimer();
        },
        _next(step = 1) {
            const index =
                this.currentSlide < this.slides.length - 1
                    ? this.currentSlide + step
                    : 0;
            this.setCurrentSlide(index);
            this.direction = "right";
        },
        next(step = 1) {
            this._next(step);
            this.startSlideTimer();
        },
        startSlideTimer() {
            if (this.timer) {
                this.stopSlideTimer();
                this.slideInterval = setInterval(() => {
                    this._next();
                }, this.interval);
            }
        },
        stopSlideTimer() {
            if (this.timer) {
                clearInterval(this.slideInterval);
            }
        },
        switchSlide(index) {
            const step = index - this.currentSlide;
            if (step > 0) {
                this.next(step);
            } else {
                this.prev(step);
            }
        },
    },
    mounted() {
        this.startSlideTimer();
    },
    beforeUnmount() {
        this.stopSlideTimer();
    },
};
</script>

<style scoped>
.carousel {
    display: flex;
    justify-content: center;
}
.carousel-inner {
    position: relative;
    width: 600px;
    height: 350px;
    overflow: hidden;
}

@media (min-width: 200px) and (max-width: 560px) {
    .carousel-inner {
        height: 200px;
    }
}
</style>
