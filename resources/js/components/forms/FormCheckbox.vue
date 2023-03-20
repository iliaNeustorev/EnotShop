<template>
    <label class="checkbox" :for="setId">
        <input
            :id="setId"
            :name="name"
            v-model="form[name]"
            type="checkbox"
            :checked="checked"
        />
        {{ label }}
    </label>
</template>

<script>
import baseForm from "@/mixins/base-form";
export default {
    mixins: [baseForm],
    props: {
        checked: { type: Boolean, default: false },
        ordinalNumber: { type: Number, required: false },
    },
    computed: {
        setId() {
            return this.ordinalNumber ? this.id + this.ordinalNumber : this.id;
        },
    },
};
</script>
