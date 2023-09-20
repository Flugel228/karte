<script setup lang="ts">
import {useStore} from "vuex";
import {computed, onMounted, reactive} from "vue";
import {Tag} from "../../../types/store/modules/shop";

const store = useStore();

const tags = computed((): Tag[] => store.getters['shop/GET_TAGS']);
const selectedTags = computed((): number[] => store.getters['shop/GET_SELECTED_TAGS']);
const meta = computed(() => store.getters['shop/GET_META']);
const activeLinks = reactive<object>({});

onMounted(async () => {
    await store.dispatch("shop/FETCH_TAGS");
})

const clickOnTag = async (id: number): Promise<void> => {
    toggleActive(id);
    const includes = selectedTags.value.includes(id);
    if (includes) {
        store.commit("shop/DELETE_SELECTED_TAG", id);
    } else {
        store.commit("shop/PUSH_SELECTED_TAG", id);
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
    <div class="single-sidebar-box mt-30 wow fadeInUp pb-0 border-bottom-0  animated"
         style="visibility: visible; animation-name: fadeInUp;"><h4>Теги </h4>
        <ul class="popular-tag">
            <li
                v-for="(tag, id) in tags"
                :key="id"
                @click="clickOnTag(tag.id)"
            ><a :class="{
                'selected': isActive(tag.id)
            }">{{ tag.title }}</a></li>
        </ul>
    </div>
</template>

<style scoped lang="sass">
.popular-tag
    li:hover
        cursor: pointer
.selected
    background-color: var(--thm-base)
</style>
