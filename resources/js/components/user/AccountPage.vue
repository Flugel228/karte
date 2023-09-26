<script setup lang="ts">
import Menu from "./Menu.vue";
import TabContent from "./TabContent.vue";
</script>

<template>
    <section class="my-account-page pt-120 pb-120">
        <div class="container">
            <div class="row wow fadeInUp  animated" style="visibility: visible; animation-name: fadeInUp;">
                <!--Start My Account Page Menu-->
                <Menu/>
                <TabContent/>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
