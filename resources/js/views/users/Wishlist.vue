<script setup lang="ts">
import Breadcrumb from "../../components/Breadcrumb.vue";
import Wishlist from "../../components/wishlist/Wishlist.vue";
import {useI18n} from "vue-i18n";

const {t} = useI18n({useScope: 'global'});
</script>

<template>
    <main class="overflow-hidden">
        <!--Start Breadcrumb Style2-->
        <Breadcrumb
            :from="{
                title: $t('wishlist.breadcrumb.from'),
                name: 'index'
            }"
            :active="$t('wishlist.breadcrumb.active')"
        />
        <!--End Breadcrumb Style2-->
        <!--Start Wishlist-->
        <Wishlist/>
        <!--End Wishlist-->
    </main>
</template>

<style scoped>
</style>
