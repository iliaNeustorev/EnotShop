<template>
    <div class="control">
        <button
            :disabled="!validation"
            v-if="!loading"
            class="button"
            :class="className"
        >
            <span>{{ buttonName }}</span>
            <span v-if="validation" class="icon is-small">
                <mdicon name="check-circle" />
            </span>
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
    },
};
</script>
