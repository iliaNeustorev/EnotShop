export default {
    props: {
        form: { type: Object, required: true },
        name: { type: String, required: true },
        label: { type: String, required: false },
        placeholder: { type: String, required: false },
        iconName: { type: String, required: false },
        objectValidation: {
            type: Object,
            default: function () {
                return {
                    valid: true,
                    rule: /^.*$/,
                    text: "",
                };
            },
        },
    },
    emits: ["validation-field"],
    computed: {
        validation() {
            return this.objectValidation
                ? this.objectValidation.rule.test(this.form[this.name])
                : true;
        },
        text() {
            return (
                this.objectValidation.text &&
                !this.emptyFieldClass &&
                !this.validation
            );
        },
        id() {
            return `field-${this.name}`;
        },
        hasError() {
            return this.form.errors.has(this.name);
        },
        emptyFieldClass() {
            if (this.emptyField && !this.hasError && !this.validation) {
                return "is-link";
            }
        },
        emptyField() {
            return !this.form[this.name]?.length;
        },
        inputClasses() {
            return {
                "is-danger": this.hasError || !this.validation,
                "is-success": this.validation,
            };
        },
        errorText() {
            return this.hasError ? this.form.errors.get(this.name) : null;
        },
        iconClass() {
            return { "has-icons-left": this.iconName };
        },
    },
    watch: {
        validation() {
            this.validationField();
        },
    },
    methods: {
        validationField() {
            return this.$emit("validation-field", {
                currentRule: this.validation,
            });
        },
    },
};
