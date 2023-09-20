<script setup lang="ts">
import ShopGridSidebar from "../../components/shop/ShopGridSidebar.vue";
import Products from "../../components/shop/Products.vue";
import ProductCategoriesOne from "../../components/shop/ProductCategoriesOne.vue"
import {ref} from "vue";
import {useStore} from "vuex";

const store = useStore();

const slideBarFilterIsActive = ref<boolean>(false);

const sidebarSwitch = (): boolean => slideBarFilterIsActive.value = !slideBarFilterIsActive.value;
</script>
<template>

    <main class="overflow-hidden ">
        <!--Start Breadcrumb Style2-->
        <div class="breadcrumb-area"
             style="background-image: url('../../../../public/assets/images/inner-pages/breadcum-bg.png');">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="breadcrumb-content pb-60 text-center wow fadeInUp  animated"
                             style="visibility: visible; animation-name: fadeInUp;">
                            <h2>Shop Grid</h2>
                            <div class="breadcrumb-menu">
                                <ul>
                                    <li><a href="index.html"><i class="flaticon-home pe-2"></i>Home</a></li>
                                    <li><i class="flaticon-next"></i></li>
                                    <li class="active">Shop Grid</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Breadcrumb Style2-->
        <!--Start Product Categories One-->
        <product-categories-one/>
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
