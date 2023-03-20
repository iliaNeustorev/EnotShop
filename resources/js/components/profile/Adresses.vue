<template>
    <form @submit.prevent="sendForm">
        <div class="control">
            <template v-for="adress in data" :key="adress.id">
                <form-radio-component
                    :value="String(adress.id)"
                    :label="adress.text"
                    :checked="Boolean(adress.main)"
                    @change="changeMain($event)"
            /></template>
        </div>
    </form>
</template>
<script>
export default {
    data() {
        return {
            data: [],
            form: this.$vform.make({
                main: "",
            }),
        };
    },
    methods: {
        async getAdresses() {
            this.data = await this.$api.user.profile.adress.get();
        },
        async sendMain($event) {
            this.form.main = $event.target.value;
            await console.log(this.form);
        },
    },
    created() {
        this.getAdresses();
    },
};
</script>
