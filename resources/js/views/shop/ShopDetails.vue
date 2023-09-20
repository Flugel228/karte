<script setup lang="ts">
import Breadcrumb from "../../components/shop-details/Breadcrumb.vue";
import Top from "../../components/shop-details/Top.vue";
import {onMounted, ref} from "vue";
import {Product, ProductResponse, RecentProductResponse} from "../../types/views/shop-details";
import axios from "axios";
import ProductDescriptionTabStart from "../../components/shop-details/ProductDescriptionTabStart.vue";
import RecentProduct from "../../components/shop-details/RecentProduct.vue"
import RecentProductsSlider from "../../components/shop-details/RecentProductsSlider.vue";

// refs
const product = ref<Product>();
const recentProducts = ref<RecentProduct[]>();

//METHODS
onMounted(async (): Promise<void> => {
    const id: number | string = window.location.pathname.replace('/shop/', '')
    await fetchProduct(id);
    await fetchRecentProducts();
})

const fetchProduct = async (id: number | string): Promise<void> => {
    try {
        const res = await axios.get<ProductResponse>(`/api/shop/products/${id}`);
        product.value = res.data.data;
    } catch (e) {
        if (axios.isAxiosError(e)) {
            console.log(e.message, "err");
            console.log(e.response?.data.message, "error");
        } else if (e instanceof Error) {
            console.log(e.message);
        }
    }
}

const fetchRecentProducts = async (): Promise<void> => {
    try {
        const res = await axios.get<RecentProductResponse>('/api/shop/products/recent');
        recentProducts.value = res.data.data;
    } catch (e) {
        if (axios.isAxiosError(e)) {
            console.log(e.message, "err");
            console.log(e.response?.data.message, "error");
        } else if (e instanceof Error) {
            console.log(e.message);
        }
    }
}
</script>

<template>
    <main>
        <!--Start Shop Details Breadcrumb-->
        <Breadcrumb/>
        <!--End Shop Details Breadcrumb-->
        <!--Start Shop Details Top-->
        <Top
            v-if="product"
            :product="product"
        />
        <!--End Shop Details Top-->
        <!-- productdrescription-tabStart -->
        <ProductDescriptionTabStart
            v-if="product"
            :description="product.description"
            :id="product.id"
            :fetch-product="fetchProduct"
            :product-comments="product.productComments.reverse()"
        />
        <!-- productdrescription-tab End -->
        <!-- recent-products Start -->
        <!-- recent-products End -->
    </main>
</template>

<style scoped>

</style>
