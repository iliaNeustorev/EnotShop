import Loading from "@/components/support/Loading.vue";
import Input from "@/components/forms/FormInput.vue";
import Radio from "@/components/forms/FormRadio.vue";
import Checkbox from "@/components/forms/FormCheckbox.vue";
import AuthAccess from "@/components/accesses/Auth.vue";
import Notification from "@/components/support/Notification.vue";
export default () => ({
    install(app) {
        app.component("form-input-component", Input);
        app.component("form-radio-component", Radio);
        app.component("form-checkbox-component", Checkbox);
        app.component("AppAuthAccess", AuthAccess);
        app.component("AppNotification", Notification);
        app.component("loading-component", Loading);
    },
});
