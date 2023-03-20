export default () => ({
    getTimeCart() {
        return JSON.parse(localStorage.getItem("timeCart")) ?? {};
    },
    setTimeCart(cart) {
        localStorage.setItem("timeCart", JSON.stringify(cart));
    },
    removeTimeCart() {
        localStorage.removeItem("timeCart");
    },
});
