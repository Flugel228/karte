<script setup lang="ts">
import {useStore} from "vuex";
import {computed, onMounted, reactive} from "vue";
import {Color, Meta} from "../../../types/store/modules/shop";

const store = useStore();

const colors = computed((): Color[] => store.getters["shop/GET_COLORS"]);
const selectedColors = computed((): number[] => store.getters["shop/GET_SELECTED_COLORS"]);
const meta = computed((): Meta => store.getters['shop/GET_META']);
const activeLinks = reactive<object>({});

onMounted(async (): Promise<void> => {
    await store.dispatch("shop/FETCH_COLORS")
})

const clickOnColor = async (id: number): Promise<void> => {
    toggleActive(id);
    const includes = selectedColors.value.includes(id);
    if (includes) {
        store.commit("shop/DELETE_SELECTED_COLOR", id);
    } else {
        store.commit("shop/PUSH_SELECTED_COLOR", id);
    }
    await store.dispatch("shop/FETCH_PRODUCTS", meta.value.current_page);
}

const isActive = (id: number): boolean => {
    return activeLinks[id];
}

const toggleActive = (id: number): void => {
  activeLinks[id] = !activeLinks[id];
}
</script>

<template>
    <div class="single-sidebar-box mt-30 wow fadeInUp  animated"
         style="visibility: visible; animation-name: fadeInUp;"><h4>Цвет</h4>
        <ul class="color-option">
            <li
                v-for="(color, id) in colors"
                :key="id"
            ><a
                :class="['color-option-single', {'selected': isActive(color.id)}]"
                :style="{ background: color.code}"
                @click="clickOnColor(color.id)"
            ><span> {{ color.title}} </span></a></li>
        </ul>
    </div>
</template>

<style scoped lang="sass">
.single-sidebar-box
    li:hover
        cursor: pointer

    .color-option-single.selected::before
        content: ""
        position: absolute
        top: 5%
        left: 5%
        width: 90%
        height: 90%
        background-image: url('/public/assets/images/check-mark/check.png')
        background-size: cover
        opacity: 0.5
        z-index: 1
</style>
