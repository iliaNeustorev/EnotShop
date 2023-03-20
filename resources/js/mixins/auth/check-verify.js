import { mapGetters } from "vuex";
export default {
    computed: {
        ...mapGetters("userModule", ["user"]),
        verified() {
            return this.user?.email_verified_at !== null;
        },
    },
};
