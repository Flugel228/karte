<script setup lang="ts">
import SelectCategories from "./shop-grid-sidebar/SelectCategories.vue";
import ColorOption from "./shop-grid-sidebar/ColorOption.vue";
import FilterByPrice from "./shop-grid-sidebar/FilterByPrice.vue";
import Tags from "./shop-grid-sidebar/Tags.vue";
import SearchInput from "./shop-grid-sidebar/SearchInput.vue";
import {IEmit, IProps} from "../../types/components/shop/shop-grid-sidebar";
import {computed} from "vue";
import {useStore} from "vuex";

const store = useStore();

const isActive = computed(() => store.getters["shop/GET_SLIDE_BAR_FILTER_IS_ACTIVE"]);

const sidebarSwitch = () => store.commit("shop/SWITCH_SLIDE_BAR_FILTER_IS_ACTIVE");
</script>

<template>
    <div class="col-xl-3 col-lg-4">
        <div
            :class="{
                'shop-grid-sidebar': true,
                'active': isActive
            }">
            <button
                class="remove-sidebar d-lg-none d-block"
                @click="sidebarSwitch"
            ><i class="flaticon-cross"></i></button>
            <div class="sidebar-holder">
                <search-input/>
                <select-categories/>
                <color-option/>
                <filter-by-price/>
                <tags/>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
