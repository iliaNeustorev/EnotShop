<template>
    <div class="control">
        <button
            :disabled="!validation"
            v-if="!loading"
            class="button"
            :class="className"
        >
            <span>{{ buttonName }}</span>
            <transition name="fade">
                <span v-if="validation && iconShow" class="icon is-small">
                    <mdicon name="check-circle" />
                </span>
            </transition>
        </button>
        <button v-else class="button is-loading" :class="className">
            Loading...
        </button>
    </div>
</template>
<script>
export default {
    props: {
        loading: { type: Boolean, default: false },
        validation: { type: Boolean, required: true },
        className: { type: String, default: "is-link is-medium" },
        buttonName: { type: String, required: true },
        iconShow: { type: Boolean, default: true },
    },
};
</script>

<style scoped>
.fade-enter-from {
    opacity: 0;
}

.fade-enter-active {
    transition: opacity 1s;
}
</style>
