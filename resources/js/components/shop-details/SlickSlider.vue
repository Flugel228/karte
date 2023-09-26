<script setup lang="ts">
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';
import {IProps} from "../../types/components/shop-details/slick-slider";

const props = defineProps<IProps>();
</script>

<template>
    <Carousel :wrapAround="wrapAround" :autoplay="autoplay">
        <Slide
            v-for="(image, id) in images"
            :key="id"
        >
            <img
                :src="image.url"
                alt=""
                style="width: 375px; height: 550px"
            >
        </Slide>
        <template #addons>
            <Navigation/>
            <Pagination/>
        </template>
    </Carousel>

</template>

<style scoped>

</style>
