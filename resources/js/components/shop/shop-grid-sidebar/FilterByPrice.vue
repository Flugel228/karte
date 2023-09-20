<script setup lang="ts">
import {computed, onMounted, onUpdated, ref} from "vue";
import VueSlider from "vue-slider-component";
import 'vue-slider-component/theme/default.css';
import {useStore} from "vuex";
import {Meta, Prices} from "../../../types/store/modules/shop";

type Value = number | string

const store = useStore();

const prices = computed((): Prices => store.getters["shop/GET_PRICES"]);
const value = ref<Value[]>([]);
const meta = computed((): Meta => store.getters['shop/GET_META']);

onMounted(async (): Promise<void> => {
    await store.dispatch("shop/FETCH_PRICES");
    value.value = [prices.value.min, prices.value.max]
});

const onSliderChange = (newValue: Value[]): void => {
    value.value = newValue;
}

const filter = async (): Promise<void> => {
    store.commit('shop/SET_SELECTED_PRICES', value.value);
    console.log(store.getters['shop/GET_SELECTED_PRICES']);
    await store.dispatch('shop/FETCH_PRODUCTS', meta.value.current_page);
}
</script>

<template>
    <div class="single-sidebar-box mt-30 wow fadeInUp  animated"
         style="visibility: visible; animation-name: fadeInUp;"><h4>Фильтр по цене</h4>

        <div class="slider-box">
            <vue-slider v-if="prices"
                        :model-value="value"
                        :min="prices.min"
                        :max="prices.max"
                        :interval="0.01"
                        @change="onSliderChange"
            />
            <div class="output-price"><label for="priceRange">Price: {{ `${value[0]} - ${value[1]}` }}</label> <input
                type="text"
                id="priceRange"
                readonly=""></div>
            <button
                class="filterbtn"
                type="submit"
                @click="filter"
            > Filter
            </button>
        </div>
    </div>
</template>

<style scoped lang="sass">
</style>
