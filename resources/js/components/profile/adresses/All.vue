<template>
    <div class="field" :class="$style.field">
        <form-radio-component
            v-for="adress in data"
            :key="adress.id"
            :modelValue="String(adress.id)"
            :label="adress.text"
            :checked="Boolean(adress.main)"
            v-model="adressMain"
            @change-main="sendMain"
        >
            <AppDeleteAdress
                :id="adress.id"
                class-name="ml-1"
                :main="Boolean(adress.main)"
                @deleted-adress="getAdresses"
            />
            <AppEditAdress
                :id="adress.id"
                :adress="adress.text"
                ref="edit"
                @change-adresses="getAdresses"
                @click="showEdit(adress.id)"
            />
        </form-radio-component>
        <div class="mt-2">
            <AppNewAdress
                @change-adresses="getAdresses"
                :limit="limit"
                :count-adress="data.length"
            />
        </div>
    </div>
</template>
<script>
import AppNewAdress from "@/components/profile/adresses/New.vue";
import AppEditAdress from "@/components/profile/adresses/Edit.vue";
import AppDeleteAdress from "@/components/profile/adresses/Delete.vue";
import { mapActions } from "vuex";
export default {
    components: { AppNewAdress, AppDeleteAdress, AppEditAdress },
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
        showEdit(id) {
            let arrayRefs = this.$refs.edit;
            arrayRefs
                .filter((elem) => elem.id != id)
                .map((elem) => (elem.show = false));
            let elem = arrayRefs.find((elem) => elem.id == id);
            elem.show = true;
        },
    },
    created() {
        this.getAdresses();
    },
};
</script>

<style module>
.field {
    box-sizing: border-box;
    border: 2px dashed coral;
    border-radius: 15%;
    width: max-content;
    padding: 20px 20px;
}
</style>
