<template>
    <div class="item notification" :class="classMessage">
        <span :class="classText">{{ text }}</span>
        <slot></slot>
    </div>
</template>

<script>
export default {
    props: {
        text: { type: String, required: true },
        importance: { type: String, default: "info" },
    },
    computed: {
        classMessage() {
            return {
                "is-info": this.importance == "info",
                "is-warning is-light": this.importance == "warning",
                "is-danger": this.importance == "danger",
            };
        },
        classText() {
            return {
                "has-text-danger-dark": this.importance == "warning",
            };
        },
    },
};
</script>
