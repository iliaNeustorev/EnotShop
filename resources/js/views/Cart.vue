<template>
    <div class="container">
        <h1 class="is-size-3 mb-1 has-text-warning-dark">Корзина</h1>
        <AppAuthAccess :noAuth="true">
            <div v-if="!empty" class="is-flex mb-2">
                <AppNotification
                    closeable
                    class-name="is-primary is-light is-flex-grow-1 has-text-centered"
                >
                    Для оформления заказа необходимо
                    <strong>
                        <a class="is-uppercase" :href="$redirectRoutes.login()">
                            войти на сайт
                        </a></strong
                    >
                </AppNotification>
            </div>
        </AppAuthAccess>
        <AppTable
            class-table=" is-bordered is-fullwidth "
            :name-titles="nameTitles"
        >
            <tr v-if="loading">
                <loading-component />
            </tr>
            <template v-else-if="!empty"
                ><tr
                    class="has-text-centered"
                    v-for="product in data"
                    :key="product.id"
                >
                    <AppCartItem
                        :product="product"
                        @reload="filterCart($event)"
                        @send-sum="addToSum($event)"
                    />
                </tr>
                <tr class="has-text-right">
                    <td :colspan="tableCollspan">
                        Общая сумма:
                        <AppPrice
                            :price="+totalAmountPrice"
                            :discount="+generalDiscount"
                        /><span
                            v-if="!promoZero"
                            title="Сбросить скидку"
                            class="icon is-small ml-1 is-clickable"
                            @click="removeDiscount"
                        >
                            <mdicon name="delete-outline" />
                        </span>
                    </td></tr
            ></template>
            <tr v-else>
                <td class="has-text-centered" :colspan="tableCollspan">
                    <i>Корзина пуста</i>
                </td>
            </tr>
        </AppTable>
        <AppPersonalDiscount />
        <AppNotification
            class-name="is-primary is-light"
            v-if="generalDiscount"
        >
            Общая скидка <b>{{ generalDiscount }} %</b>
        </AppNotification>
        <AppAuthAccess>
            <div class="is-flex is-justify-content-end">
                <button
                    :disabled="empty"
                    title="Перейти на страницу оформления заказа"
                    class="button is-info is-medium"
                >
                    Оформить заказ
                </button>
            </div>
            <div class="is-flex is-justify-content-end mt-2">
                <AppPromo
                    v-if="promoZero"
                    :empty-cart="empty"
                    @apply-discount="addDiscount($event)"
                />
                <p v-else>Ваша промо скидка {{ promo.size }} %</p>
            </div>
        </AppAuthAccess>
    </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import AppTable from "@/components/support/Table.vue";
import AppCartItem from "@/components/cart/Item.vue";
import AppPromo from "@/components/cart/Promo.vue";
import AppPrice from "@/components/product/Price.vue";
import AppPersonalDiscount from "@/components/profile/PersonalDiscount.vue";
export default {
    components: {
        AppTable,
        AppCartItem,
        AppPromo,
        AppPrice,
        AppPersonalDiscount,
    },
    data() {
        return {
            nameTitles: [
                "Название",
                "Количество",
                "Цена",
                "Сумма товара",
                "Кнопки",
            ],
            data: [],
            allSum: {},
            loading: false,
            promo: { id: "", size: 0 },
        };
    },
    computed: {
        ...mapGetters("cartModule", ["all", "empty"]),
        ...mapGetters("userModule", ["user"]),
        tableCollspan() {
            return this.nameTitles.length;
        },
        totalAmountPrice() {
            return Object.values(this.allSum)
                .reduce((acc, sum) => acc + +sum, 0)
                .toFixed(2);
        },
        promoZero() {
            return this.promo.size === 0;
        },
        personalDiscount() {
            return this.user.discount ?? 0;
        },
        generalDiscount() {
            return this.personalDiscount + this.promo.size;
        },
    },
    methods: {
        ...mapActions("userModule", ["getDiscount"]),
        async load() {
            this.loading = true;
            new Promise((resolve) => {
                setTimeout(() => {
                    if (!this.empty) {
                        resolve(this.$api.product.loadSelected(this.all));
                    } else {
                        this.loading = false;
                    }
                }, 200);
            })
                .then((result) => {
                    this.data = result;
                })
                .finally(() => (this.loading = false));
        },
        filterCart(id) {
            delete this.allSum[id];
            let ids = Object.keys(this.all).map((key) => Number(key));
            this.data = this.data.filter((product) => ids.includes(product.id));
        },
        addToSum(item) {
            this.allSum[item.id] = item.sum;
        },
        addDiscount(promo) {
            this.promo = promo;
        },
        async removeDiscount() {
            await this.$api.cart.promo.removeFromUser(this.promo.id);
            this.promo.size = 0;
        },
    },
    async created() {
        this.load();
    },
};
</script>

<style scoped>
.notification a:not(.button):not(.dropdown-item) {
    text-decoration: none;
}
</style>
