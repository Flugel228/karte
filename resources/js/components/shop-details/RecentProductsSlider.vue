<script setup lang="ts">
import RecentProduct from "./RecentProduct.vue";
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
import {IProps} from "../../types/components/shop-details/recent-products-slider";

const props = defineProps<IProps>();
</script>

<template>
    <Carousel :wrapAroud="true" :itemsToShow="3">
        <Slide>
            <RecentProduct
                v-for="(product, id) in products"
                :id="id"
                :product="product"
            />
        </Slide>
        <template #addons>
            <Navigation/>
            <Pagination/>
        </template>
    </Carousel>
</template>

<style scoped>

</style>
