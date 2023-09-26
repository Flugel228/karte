<script setup lang="ts">
import {useStore} from "vuex";
import {computed} from "vue";

const store = useStore();

const meta = computed(() => store.getters['shop/GET_META']);
const changePage = (page: number) => {
    store.dispatch("shop/FETCH_PRODUCTS", page);
}
</script>

<template>
    <div class="row">
        <div class="col-12 d-flex justify-content-center wow fadeInUp  animated"
             style="visibility: visible; animation-name: fadeInUp;">
            <ul
                class="pagination text-center"
                v-if="meta"
            >
                <li
                    v-if="meta.current_page !== 1"
                    class="next"
                    @click="changePage(meta.current_page - 1)"
                ><a><i class="flaticon-left-arrow-1" aria-hidden="true"></i> </a></li>
                <li
                    v-for="(link, id) in meta.links"
                    :key="id"
                ><a
                    v-if="Number(link.label) &&
                          (meta.current_page - parseInt(link.label) > -2 &&
                          meta.current_page - parseInt(link.label) < 2) ||
                          Number(link.label) === 1 ||
                          Number(link.label) === meta.last_page
                    "
                    :class="{
                        'active': link.active
                    }"

                    @click="changePage(Number(link.label))"
                >{{ link.label }}</a>
                <a
                    v-if="Number(link.label) &&
                          meta.current_page !== meta.last_page -2 &&
                          meta.current_page - parseInt(link.label) === -2 ||
                          Number(link.label) &&
                          meta.current_page !== 3 &&
                          meta.current_page - parseInt(link.label) === 2
                    "
                >...</a>
                </li>
                <li
                    v-if="meta.current_page !== meta.last_page"
                    class="next"
                    @click="changePage(meta.current_page + 1)"
                ><a href="#0"><i class="flaticon-next-1" aria-hidden="true"></i> </a></li>
            </ul>
        </div>
    </div>
</template>

<style lang="sass" scoped>
.pagination
    li
        a:hover
            cursor: pointer
</style>
