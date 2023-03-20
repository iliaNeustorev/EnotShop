<template>
    <div class="is-flex is-flex-direction-column">
        <button
            :disabled="emptyCart || block"
            @click="showPromo"
            class="button is-success is-medium mb-2"
        >
            {{ buttonName }}
        </button>
        <template v-if="show">
            <form-input-component
                ref="inp"
                :form="form"
                name="name"
                placeholder="Введите промо код"
            />
            <span
                v-if="promo.size > 0"
                class="has-text-success-dark mb-2 is-align-self-center"
                >Скидка: {{ promo.size }} %
                <button
                    class="button is-success is-small"
                    @click="applyDiscount"
                >
                    Применить
                </button></span
            >
            <button
                :disabled="!validationForm"
                class="button is-link mb-1"
                @click="sendPromo"
            >
                Проверить
            </button></template
        >
    </div>
</template>
<script>
import { mapActions } from "vuex";
export default {
    props: { emptyCart: { type: Boolean, default: true } },
    emits: ["apply-discount"],
    data() {
        return {
            show: false,
            form: this.$vform.make({
                name: "",
            }),
            promo: { id: "", size: 0 },
            block: false,
        };
    },
    computed: {
        buttonName() {
            return this.show ? "Скрыть" : "Вести промо код";
        },
        validationForm() {
            return this.form.name.length !== 0;
        },
    },
    methods: {
        ...mapActions("alertModule", { addMessage: "add" }),
        showPromo() {
            this.show = !this.show;
            if (this.show) {
                this.$nextTick(() => {
                    this.$refs.inp.$refs.first.focus();
                });
            }
        },
        async sendPromo() {
            this.promo.size = 0;
            try {
                let result = await this.$api.cart.promo.check(this.form);
                this.promo.size = result.sizeDiscount;
                this.promo.id = result.id;
            } catch (e) {
                let code = e.response?.status;
                if (code === 429) {
                    this.addMessage({
                        text: "Не стоит пытаться подобрать промо. Повторная попытка через 15 минут",
                        importance: "warning",
                        closeable: true,
                    });
                    this.show = false;
                    this.block = true;
                }
            }
        },
        async applyDiscount() {
            try {
                await this.$api.cart.promo.addToUser(this.promo.id);
                this.$emit("apply-discount", this.promo);
            } catch (e) {
                let code = e.response?.status;
                if (code === 405) {
                    this.addMessage({
                        text: "Этот промокод уже использовался вами",
                        importance: "warning",
                        closeable: true,
                    });
                }
            }
        },
    },
    async created() {
        let res = await this.$api.cart.promo.get();
        this.promo = res;
        if (this.promo.size > 0) {
            this.$emit("apply-discount", this.promo);
        }
    },
};
</script>
