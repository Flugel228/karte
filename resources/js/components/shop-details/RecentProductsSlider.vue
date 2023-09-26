<script setup lang="ts">
import RecentProduct from "./RecentProduct.vue";
import {Carousel, Navigation, Pagination, Slide} from 'vue3-carousel'
import {IProps} from "../../types/components/shop-details/recent-products-slider";

const props = defineProps<IProps>();
</script>

<template>
    <div class="container mb-5">
        <div class="row">
            <div class="col-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                <div class="section-head text-center">
                    <h2>Recent Products </h2>
                </div>
            </div>
        </div>
        <div class="row wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
            <div class="catagory-slider slick-initialized slick-slider">
                <Carousel :wrapAround="true" :itemsToShow="2">
                    <Slide
                        v-for="(product, id) in products"
                        :key="id"
                    >
                        <RecentProduct
                            :product="product"
                        />
                    </Slide>
                    <template #addons>
                        <Navigation/>
                        <Pagination/>
                    </template>
                </Carousel>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
