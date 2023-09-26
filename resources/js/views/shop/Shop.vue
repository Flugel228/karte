<script setup lang="ts">
import ShopGridSidebar from "../../components/shop/ShopGridSidebar.vue";
import Products from "../../components/shop/Products.vue";
import Breadcrumb from "../../components/Breadcrumb.vue";
import {useI18n} from "vue-i18n";

const {t} = useI18n({useScope: 'global'});
</script>
<template>

    <main class="overflow-hidden ">
        <!--Start Breadcrumb Style2-->
        <Breadcrumb
            :from="{
                title: $t('shop.breadcrumb.from'),
                name: 'index'
            }"
            :active="$t('shop.breadcrumb.active')"
        />
        <!--End Breadcrumb Style2-->
        <!--Start Product Categories One-->
        <!--End Product Categories One-->
        <!--Start product-grid-->
        <div class="product-grid pt-60 pb-120">
            <div class="container">
                <div class="row gx-4">
                    <shop-grid-sidebar/>
                    <products/>
                </div>
            </div>
        </div>
        <!--End product-grid-->
    </main>
</template>

<style scoped>

</style>
