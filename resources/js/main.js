import createApp from "@/app";

(async function () {
    const { app, router } = await createApp(window.appContext);
    await router.isReady();
    app.mount("#app");
})();
