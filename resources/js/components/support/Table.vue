<template>
    <div class="table-container">
        <table class="table" :class="classTable">
            <thead>
                <th
                    class="has-text-centered"
                    v-for="(name, i) of nameTitles"
                    :key="i"
                >
                    {{ name }}
                </th>
            </thead>
            <tbody>
                <slot></slot>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: {
        nameTitles: { type: Array, required: true },
        classTable: { type: String, default: "" },
    },
};
</script>
