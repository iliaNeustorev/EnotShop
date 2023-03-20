<template>
    <div class="control">
        <button
            class="button is-warning is-light is-outlined mr-1"
            v-if="quantity(id)"
            title="Удалить из корзины"
            @click="
                changeCart({
                    id,
                    cnt: 0,
                    countStore,
                })
            "
        >
            <span class="icon is-small">
                <mdicon name="delete-outline" />
            </span>
        </button>
    </div>
    <div class="control">
        <button
            class="button is-danger"
            :disabled="!quantity(id)"
            @click="
                changeCart({
                    id,
                    cnt: quantity(id) - 1,
                    countStore,
                })
            "
        >
            -
        </button>
    </div>
    <div class="control">
        <input
            class="input"
            :value="quantity(id)"
            @input="
                changeCart({
                    id,
                    cnt: $event.target.value,
                    countStore,
                })
            "
            type="number"
            style="width: 100px"
        />
    </div>
    <div class="control">
        <button
            class="button is-success"
            :disabled="limitStore"
            @click="
                changeCart({
                    id,
                    cnt: quantity(id) + 1,
                    countStore,
                })
            "
        >
            +
        </button>
    </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
    props: {
        id: { type: Number, required: true, default: 0 },
        countStore: { type: Number, required: true, default: 0 },
    },
    computed: {
        ...mapGetters("cartModule", ["quantity"]),
        limitStore() {
            return this.quantity(this.id) === this.countStore;
        },
    },
    methods: {
        ...mapActions("cartModule", {
            addCart: "add",
            removeCart: "remove",
            changeCart: "setCnt",
        }),
    },
};
</script>
