<template>
    <button class="carousel-control left" @click="$emit('prev')">
        <mdicon name="arrow-left-circle-outline" />
    </button>
    <button class="carousel-control right" @click="$emit('next')">
        <mdicon name="arrow-right-circle-outline" />
    </button>
</template>

<script>
export default {
    emits: ["prev", "next"],
};
</script>
<style scoped>
.carousel-control {
    background-color: rgba(0, 0, 0, 0.5);
    border: none;
    display: inline-block;
    position: absolute;
    height: 10%;
    width: 10%;
    top: calc(50% - 25px);
    color: #f3f3f3;
    cursor: pointer;
    border-radius: 15px;
}
.left {
    left: 0;
}
.right {
    right: 0;
}
</style>
