<script setup lang="ts">
import {useStore} from "vuex";
import {computed, onMounted} from "vue";
import {Category} from "../../../types/views/shop";
import {useI18n} from "vue-i18n";

const {t} = useI18n({useScope: 'global'});

const store = useStore();

const categories = computed((): Category[] => store.getters['shop/GET_CATEGORIES']);
const selectedCategories = computed(() => store.getters['shop/GET_SELECTED_CATEGORIES']);
const meta = computed(() => store.getters['shop/GET_META']);

onMounted(async () => {
    await store.dispatch("shop/FETCH_CATEGORIES");
})

const transformToLowerCase = (text: string) => text.toLowerCase();

const clickOnCategory = async (id: number): Promise<void> => {
    const includes = selectedCategories.value.includes(id);
    if (includes) {
        store.commit("shop/DELETE_SELECTED_CATEGORY", id);
    } else {
        store.commit("shop/PUSH_SELECTED_CATEGORY", id);
    }
    await store.dispatch("shop/FETCH_PRODUCTS", meta.value.current_page);
}
</script>

<template>
    <div class="single-sidebar-box mt-30 wow fadeInUp  animated"
         style="visibility: visible; animation-name: fadeInUp;"><h4>{{ $t('shop.shopGridSidebar.selectCategories.title')}}</h4>
        <div class="checkbox-item">
            <form>
                <div
                    class="form-group"
                    v-for="(category, id) in categories"
                    :key="id"
                >
                    <input type="checkbox" :id="transformToLowerCase(category.title)">
                    <label
                        @click="clickOnCategory(category.id)"
                        :for="transformToLowerCase(category.title)"
                    >{{ category.title }}</label>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped>

</style>
