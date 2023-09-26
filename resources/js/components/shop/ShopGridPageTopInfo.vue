<script setup lang="ts">
import {computed, reactive, ref} from "vue";
import {useStore} from "vuex";
import {Meta} from "../../types/store/modules/shop";
import {useI18n} from "vue-i18n";

const {t} = useI18n({useScope: 'global'});

const store = useStore();

const meta = computed((): Meta => store.getters["shop/GET_META"]);

const sidebarSwitch = () => store.commit("shop/SWITCH_SLIDE_BAR_FILTER_IS_ACTIVE");
</script>

<template>
    <div class="row">
        <div class="col-xl-12">
            <div class="shop-grid-page-top-info p-0 justify-content-md-between justify-content-center">
                <div class="left-box wow fadeInUp  animated" style="visibility: visible; animation-name: fadeInUp;">
                    <p
                        v-if="meta"
                    >{{ $t('shop.products.shopGridPageTopInfo.showing') }} {{ meta.from }}–{{ meta.to }}
                        {{ $t('shop.products.shopGridPageTopInfo.of') }} {{ meta.total }}
                        {{ $t('shop.products.shopGridPageTopInfo.results') }}</p>
                </div>
                <div class="right-box justify-content-md-between justify-content-center wow fadeInUp  animated"
                     style="visibility: visible; animation-name: fadeInUp;">
                    <div class="product-view-style d-flex justify-content-md-between justify-content-center">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-grid-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-grid" type="button" role="tab" aria-selected="true">
                                    <i class="flaticon-grid"></i>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-list-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-list" type="button" role="tab" aria-selected="false">
                                    <i class="flaticon-list"></i>
                                </button>
                            </li>
                        </ul>
                        <button
                            class="slidebarfilter d-lg-none d-flex"
                            @click="sidebarSwitch"
                        ><i class="flaticon-edit"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
