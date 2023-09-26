<script setup lang="ts">
import Breadcrumb from "../components/Breadcrumb.vue";
import CartArea from "../components/cart/CartArea.vue";
import {useI18n} from "vue-i18n";

const {t} = useI18n({useScope: 'global'});
</script>

<template>
    <main class="overflow-hidden ">
        <!--Start Breadcrumb Style2-->
        <Breadcrumb
            :from="{
                title: $t('cart.breadcrumb.from'),
                name: 'index'
            }"
            :active="$t('cart.breadcrumb.active')"
        />
        <!--End Breadcrumb Style2-->
        <!--Start cart area-->
        <CartArea/>
        <!--End cart area-->
    </main>
</template>

<style scoped>

</style>
