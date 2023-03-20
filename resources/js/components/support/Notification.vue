<template>
    <div v-if="show" class="notification" :class="className">
        <button v-if="closeable" class="delete" @click="show = false"></button>
        <slot></slot>
    </div>
</template>
<script>
export default {
    props: {
        className: { type: String, default: "" },
        closeable: { type: Boolean, default: false },
    },
    data() {
        return {
            show: true,
        };
    },
};
</script>
