<template>
    <div class="has-text-centered" v-if="!verified">
        <p><i>Активируйте аккаунт</i></p>
        <form
            method="POST"
            @submit="show"
            :action="$redirectRoutes.verifyEmail()"
        >
            <input type="hidden" name="_token" :value="$csrf" />
            <button v-if="!sendEmail" type="submit" class="button is-ghost">
                (отправить письмо повторно)
            </button>
            <button v-else class="button is-loading">Loading</button>
        </form>
    </div>
</template>

<script>
import checkVerify from "@/mixins/auth/check-verify.js";
export default {
    mixins: [checkVerify],
    data() {
        return {
            sendEmail: false,
        };
    },
    methods: {
        show() {
            this.sendEmail = !this.sendEmail;
        },
    },
};
</script>
