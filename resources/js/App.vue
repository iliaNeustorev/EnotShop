<template>
    <AppAlerts />
    <AppHeader />
    <AppNavbar />
    <div class="columns" :class="$style['columns-height']">
        <div class="column"><router-view></router-view></div>
        <div class="column is-one-fifth"><AppLeftMenu /></div>
    </div>
    <AppFooter />
</template>

<script>
import AppNavbar from "@/components/nav/NavBar.vue";
import AppHeader from "@/components/nav/Header.vue";
import AppLeftMenu from "@/components/nav/LeftMenu.vue";
import AppFooter from "@/components/nav/Footer.vue";
import AppAlerts from "@/components/alerts/Alerts.vue";

export default {
    components: {
        AppNavbar,
        AppHeader,
        AppLeftMenu,
        AppFooter,
        AppAlerts,
    },
};
</script>

<style module>
.columns-height {
    min-height: 100vh;
}
</style>
