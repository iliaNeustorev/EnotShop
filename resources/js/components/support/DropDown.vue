<template>
    <div class="dropdown" :class="[active, classNameTrigger]">
        <div class="dropdown-trigger">
            <slot name="trigger"></slot>
        </div>
        <div class="dropdown-menu">
            <div class="dropdown-content" :class="classNameContent">
                <slot name="content"></slot>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        show: { type: Boolean, default: false },
        classNameTrigger: { type: String, default: "" },
        classNameContent: { type: String, default: "" },
    },
    computed: {
        active() {
            return { "is-active": this.show };
        },
    },
};
</script>
