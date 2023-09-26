<script setup lang="ts">
import {IProps} from "../../types/components/shop-details/top";
import SlickSlider from "./SlickSlider.vue";
import RightPart from "./RightPart.vue";

const props = defineProps<IProps>();
</script>

<template>
    <section class="shop-details-top two ">
        <div class="container">
            <div class="row mt--30">
                <div class="col-xl-6 col-lg-6 mt-30 wow fadeInUp  animated"
                     style="visibility: visible; animation-name: fadeInUp;">
                    <SlickSlider
                        :images="product.images"
                        :width="'350px'"
                        :height="'450px'"
                        :wrap-around="true"
                        :autoplay="5000"
                    />
                </div>
                <RightPart :product="product"/>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
