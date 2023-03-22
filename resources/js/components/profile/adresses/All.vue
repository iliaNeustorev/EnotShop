<template>
    <div class="field" :class="$style.field">
        <form-radio-component
            v-for="adress in data"
            :key="adress.id"
            :modelValue="String(adress.id)"
            :label="adress.text"
            :checked="Boolean(adress.main)"
            v-model="adressMain"
            @change="sendMain"
            ><AppDeleteAdress
                :id="adress.id"
                class-name="ml-1"
                :main="Boolean(adress.main)"
                @deleted-adress="getAdresses"
        /></form-radio-component>
        <AppNewAdress
            @change-adresses="getAdresses"
            :limit="limit"
            :count-adress="data.length"
        />
    </div>
</template>
<script>
import AppNewAdress from "@/components/profile/adresses/New.vue";
import AppDeleteAdress from "@/components/profile/adresses/Delete.vue";
import { mapActions } from "vuex";
export default {
    components: { AppNewAdress, AppDeleteAdress },
    data() {
        return {
            data: [],
            adress: this.$vform.make({
                main: "",
            }),
            adressMain: "",
            limit: 0,
        };
    },
    methods: {
        ...mapActions("userModule", ["getFull"]),
        async getAdresses() {
            let result = await this.$api.user.profile.adress.get();
            this.data = result.adresses;
            this.limit = result.limit;
        },
        async sendMain() {
            this.adress.main = this.adressMain;
            let res = await this.$api.user.profile.adress.changeMain(
                this.adress
            );
            if (res) {
                this.getAdresses();
                this.getFull();
            }
        },
    },
    created() {
        this.getAdresses();
    },
};
</script>

<style module>
.field {
    border: 2px dashed coral;
    border-radius: 20%;
    width: max-content;
    padding: 2% 2%;
}
</style>
