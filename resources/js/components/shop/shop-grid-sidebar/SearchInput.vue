<script setup lang="ts">
import {useStore} from "vuex";
import {computed, ref} from "vue";
import {Meta} from "../../../types/store/modules/shop";

const store = useStore();

const query = ref<string>('');
const meta = computed((): Meta => store.getters['shop/GET_META'])

const queryFilter = async (): Promise<void> => {
    await store.commit('shop/SET_TITLE', query.value);
    await store.dispatch('shop/FETCH_PRODUCTS', meta.value.current_page);
}
</script>

<template>
    <form action="#0" class="footer-default__subscrib-form m-0 p-0 wow fadeInUp  animated"
          style="visibility: visible; animation-name: fadeInUp;">
        <div class="footer-input-box p-0">
            <input
                type="text"
                placeholder="Название..."
                name="title"
                v-model="query"
                @keypress.enter.prevent="queryFilter"
            >
            <button
                type="submit"
                class="subscribe_btn"
                @click.prevent="queryFilter"
            >
                <i class="flaticon-magnifying-glass"></i>
            </button>
        </div>
    </form>
</template>

<style scoped>

</style>
