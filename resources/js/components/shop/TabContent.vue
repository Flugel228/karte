<script setup lang="ts">
import {computed, onMounted} from "vue";
import {Product} from "../../types/views/shop";
import {useStore} from "vuex";
import {User} from "../../types/store";
import api from "../../axios/api";
import {LikeClickBody} from "../../types/components/shop/tab-content";
import {Meta} from "../../types/store/modules/shop";
import axios from "axios";
import transformToTwoDecimalPlaces from "../../composables/transformToTwoDecimalPlaces";
import addToCart from "../../composables/addToCart";
import {useI18n} from "vue-i18n";

const {t} = useI18n({useScope: 'global'});

// connection to vuex store
const store = useStore();

// computed variables
const products = computed((): Product[] => store.getters["shop/GET_PRODUCTS"])
const user = computed((): User => store.getters["GET_USER"]);
const meta = computed((): Meta => store.getters["shop/GET_META"]);


// METHODS

// like methods
const likeHandler = (array: { id: number }[]): boolean => array.some((e: { id: number }): boolean => e.id === user.value.id);
const likeClickHandler = async (id: number) => {
    try {
        await api.post<any, any, LikeClickBody>("/api/users/auth/products/likes", {
            product_id: id
        });
        await store.dispatch("shop/FETCH_PRODUCTS", meta.value.current_page);
    } catch (e) {
        if (axios.isAxiosError(e)) {
            console.log(e.message, "err");
            console.log(e.response?.data.message, "error");
        } else if (e instanceof Error) {
            console.log(e.message);
        }
    }
}


onMounted(async () => {
    await store.dispatch("shop/FETCH_PRODUCTS", 1);
})
</script>

<template>
    <div class="row">
        <div class="col-12">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-grid" role="tabpanel" aria-labelledby="pills-grid-tab">
                    <div class="row">
                        <div class="col-xl-4 col-lg-6 col-6 "
                             v-for="(product, id) in products"
                             :key="id"
                        >
                            <div class="products-three-single w-100  mt-30">
                                <div class="products-three-single-img">
                                    <router-link
                                        :to="{
                                            name: 'shop.details',
                                            params: {
                                                id: product.id
                                            }
                                        }"
                                        class="d-block">
                                        <img
                                            :src="product.images[0].url"
                                            class="first-img"
                                            alt=""
                                        >
                                        <img
                                            :src="product.images[0].url"
                                            alt=""
                                            class="hover-img"
                                        >
                                    </router-link>
                                    <div class="products-grid-one__badge-box"><span
                                        class="bg_base badge new ">{{ $t('shop.products.tabContent.new') }}</span>
                                    </div>
                                    <a @click.prevent="addToCart(product)" href="cart.html"
                                       class="addcart btn--primary style2"
                                    >{{ $t('shop.products.tabContent.buttons.addToCart') }}
                                    </a>
                                    <div class="products-grid__usefull-links">
                                        <ul>
                                            <li v-if="user">
                                                <a
                                                    v-if="likeHandler(product.likedUsers)"
                                                    @click.prevent="likeClickHandler(product.id)"
                                                    class="selected"
                                                >
                                                    <i class="flaticon-heart"></i>
                                                    <span>
                                                        {{ $t('shop.products.tabContent.flaticon.wishlist') }}
                                                    </span>
                                                </a>
                                                <a
                                                    v-else
                                                    @click.prevent="likeClickHandler(product.id)"
                                                >
                                                    <i class="flaticon-heart"></i>
                                                    <span>
                                                        {{ $t('shop.products.tabContent.flaticon.wishlist') }}
                                                    </span>
                                                </a>
                                            </li>
                                            <li v-else>
                                                <a>
                                                    <i class="flaticon-heart"></i>
                                                    <span>
                                                        {{ $t('shop.products.tabContent.flaticon.wishlist') }}
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div :id="`popup${id}`" ref="popup" class="product-gird__quick-view-popup mfp-hide">
                                    <div class="container">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-lg-6">
                                                <div class="quick-view__left-content">
                                                    <div class="tabs ui-tabs ui-corner-all ui-widget ui-widget-content">
                                                        <div class="popup-product-thumb-box">
                                                            <ul role="tablist"
                                                                class="ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix ui-widget-header">
                                                                <li class="tab-nav popup-product-thumb ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active ui-state-active"
                                                                    role="tab" tabindex="0" aria-controls="tabb1"
                                                                    aria-labelledby="ui-id-1" aria-selected="true"
                                                                    aria-expanded="true">
                                                                    <a href="#tabb1" tabindex="-1"
                                                                       class="ui-tabs-anchor" id="ui-id-1">
                                                                        <img
                                                                            src="assets/images/shop/products-v6-img5.jpg"
                                                                            alt=""> </a></li>
                                                                <li class="tab-nav popup-product-thumb ui-tabs-tab ui-corner-top ui-state-default ui-tab"
                                                                    role="tab" tabindex="-1" aria-controls="tabb2"
                                                                    aria-labelledby="ui-id-2" aria-selected="false"
                                                                    aria-expanded="false">
                                                                    <a href="#tabb2" tabindex="-1"
                                                                       class="ui-tabs-anchor" id="ui-id-2">
                                                                        <img
                                                                            src="assets/images/shop/products-v6-img6.jpg"
                                                                            alt=""> </a></li>
                                                                <li class="tab-nav popup-product-thumb ui-tabs-tab ui-corner-top ui-state-default ui-tab"
                                                                    role="tab" tabindex="-1" aria-controls="tabb3"
                                                                    aria-labelledby="ui-id-3" aria-selected="false"
                                                                    aria-expanded="false">
                                                                    <a href="#tabb3" tabindex="-1"
                                                                       class="ui-tabs-anchor" id="ui-id-3">
                                                                        <img
                                                                            src="assets/images/shop/products-v6-img7.jpg"
                                                                            alt=""> </a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="popup-product-main-image-box">
                                                            <div id="tabb1"
                                                                 class="tab-item popup-product-image ui-tabs-panel ui-corner-bottom ui-widget-content"
                                                                 aria-labelledby="ui-id-1" role="tabpanel"
                                                                 aria-hidden="false">
                                                                <div class="popup-product-single-image">
                                                                    <img src="assets/images/shop/products-v6-img5.jpg"
                                                                         alt=""></div>
                                                            </div>
                                                            <div id="tabb2"
                                                                 class="tab-item popup-product-image ui-tabs-panel ui-corner-bottom ui-widget-content"
                                                                 aria-labelledby="ui-id-2" role="tabpanel"
                                                                 aria-hidden="true" style="display: none;">
                                                                <div class="popup-product-single-image">
                                                                    <img src="assets/images/shop/products-v6-img6.jpg"
                                                                         alt=""></div>
                                                            </div>
                                                            <div id="tabb3"
                                                                 class="tab-item popup-product-image ui-tabs-panel ui-corner-bottom ui-widget-content"
                                                                 aria-labelledby="ui-id-3" role="tabpanel"
                                                                 aria-hidden="true" style="display: none;">
                                                                <div class="popup-product-single-image">
                                                                    <img src="assets/images/shop/products-v6-img7.jpg"
                                                                         alt=""></div>
                                                            </div>
                                                            <button class="prev"><i class="flaticon-back"></i>
                                                            </button>
                                                            <button class="next"><i class="flaticon-next"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="products-three-single-content text-center">
                                    <span> {{ product.category }} </span>
                                    <h5>
                                        <router-link
                                            :to="{
                                                name: 'shop.details',
                                                params: {
                                                    id: product.id
                                                }
                                            }"
                                        > {{ product.title }}
                                        </router-link>
                                    </h5>
                                    <p>
                                        <del>${{ transformToTwoDecimalPlaces(product.price) }}</del>
                                        ${{ transformToTwoDecimalPlaces(product.price) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-list" role="tabpanel" aria-labelledby="pills-list-tab">
                    <div class="row ">
                        <div
                            class="col-12"
                            v-for="(product, id) in products"
                            :key="id"
                        >
                            <div class="product-grid-two list mt-30 ">
                                <div class="product-grid-two__img">
                                    <router-link
                                        :to="{
                                            name: 'shop.details',
                                            params: {
                                                id: product.id
                                            }
                                        }"
                                        class="d-block"
                                    >
                                        <img
                                            :src="product.images[0].url"
                                            class="first-img"
                                            alt=""
                                        >
                                        <img
                                            :src="product.images[0].url"
                                            alt=""
                                            class="hover-img"
                                        >
                                    </router-link>
                                    <div class="products-grid-one__badge-box">
                                        <span class="badge discount">
                                            {{ $t('shop.products.tabContent.best') }}
                                        </span>
                                    </div>
                                </div>
                                <div id="popupb" class="product-gird__quick-view-popup mfp-hide">
                                    <div class="container">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-lg-6">
                                                <div class="quick-view__left-content">
                                                    <div class="tabs ui-tabs ui-corner-all ui-widget ui-widget-content">
                                                        <div class="popup-product-thumb-box">
                                                            <ul role="tablist"
                                                                class="ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix ui-widget-header">
                                                                <li class="tab-nav popup-product-thumb ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active ui-state-active"
                                                                    role="tab" tabindex="0" aria-controls="tab7111111b"
                                                                    aria-labelledby="ui-id-31" aria-selected="true"
                                                                    aria-expanded="true">
                                                                    <a href="#tab7111111b" tabindex="-1"
                                                                       class="ui-tabs-anchor" id="ui-id-31"> <img
                                                                        src="assets/images/shop/shop-grid-page-img1.jpg"
                                                                        alt=""> </a></li>
                                                                <li class="tab-nav popup-product-thumb ui-tabs-tab ui-corner-top ui-state-default ui-tab"
                                                                    role="tab" tabindex="-1" aria-controls="tab8111111b"
                                                                    aria-labelledby="ui-id-32" aria-selected="false"
                                                                    aria-expanded="false">
                                                                    <a href="#tab8111111b" tabindex="-1"
                                                                       class="ui-tabs-anchor" id="ui-id-32"> <img
                                                                        src="assets/images/shop/shop-grid-page-img2.jpg"
                                                                        alt=""> </a></li>
                                                                <li class="tab-nav popup-product-thumb ui-tabs-tab ui-corner-top ui-state-default ui-tab"
                                                                    role="tab" tabindex="-1" aria-controls="tab9111111b"
                                                                    aria-labelledby="ui-id-33" aria-selected="false"
                                                                    aria-expanded="false">
                                                                    <a href="#tab9111111b" tabindex="-1"
                                                                       class="ui-tabs-anchor" id="ui-id-33"> <img
                                                                        src="assets/images/shop/shop-grid-page-img3.jpg"
                                                                        alt=""> </a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="popup-product-main-image-box">
                                                            <div id="tab7111111b"
                                                                 class="tab-item popup-product-image ui-tabs-panel ui-corner-bottom ui-widget-content"
                                                                 aria-labelledby="ui-id-31" role="tabpanel"
                                                                 aria-hidden="false">
                                                                <div class="popup-product-single-image">
                                                                    <img
                                                                        src="assets/images/shop/shop-grid-page-img1.jpg"
                                                                        alt=""></div>
                                                            </div>
                                                            <div id="tab8111111b"
                                                                 class="tab-item popup-product-image ui-tabs-panel ui-corner-bottom ui-widget-content"
                                                                 aria-labelledby="ui-id-32" role="tabpanel"
                                                                 aria-hidden="true" style="display: none;">
                                                                <div class="popup-product-single-image">
                                                                    <img
                                                                        src="assets/images/shop/shop-grid-page-img2.jpg"
                                                                        alt=""></div>
                                                            </div>
                                                            <div id="tab9111111b"
                                                                 class="tab-item popup-product-image ui-tabs-panel ui-corner-bottom ui-widget-content"
                                                                 aria-labelledby="ui-id-33" role="tabpanel"
                                                                 aria-hidden="true" style="display: none;">
                                                                <div class="popup-product-single-image">
                                                                    <img
                                                                        src="assets/images/shop/shop-grid-page-img3.jpg"
                                                                        alt=""></div>
                                                            </div>
                                                            <button class="prev"><i class="flaticon-back"></i>
                                                            </button>
                                                            <button class="next"><i class="flaticon-next"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-grid-two-content text-center">
                                    <span>{{ product.category }}</span>
                                    <h5>
                                        <router-link
                                            :to="{
                                                name: 'shop.details',
                                                params: {
                                                    id: product.id
                                                }
                                            }"
                                        >{{ product.title }}
                                        </router-link>
                                    </h5>
                                    <p>
                                        <del>${{ transformToTwoDecimalPlaces(product.price) }}</del>
                                        ${{ transformToTwoDecimalPlaces(product.price) }}
                                    </p>
                                    <p class="text">{{ product.description }}</p>
                                    <div class="product-grid-two__overlay-box">
                                        <div class="title">
                                            <h6><a
                                                @click.prevent="addToCart(product)"
                                            >
                                                {{ $t('shop.products.tabContent.buttons.addToCart') }}
                                            </a></h6>
                                        </div>
                                        <div class="icon">
                                            <ul>
                                                <li v-if="user">
                                                    <a
                                                        v-if="likeHandler(product.likedUsers)"
                                                        @click.prevent="likeClickHandler(product.id)"
                                                        class="selected"
                                                    >
                                                        <i class="flaticon-heart"></i>
                                                    </a>
                                                    <a
                                                        v-else
                                                        @click.prevent="likeClickHandler(product.id)"
                                                    >
                                                        <i class="flaticon-heart"></i>
                                                    </a>
                                                </li>
                                                <li v-else>
                                                    <a href="wishlist.html">
                                                        <i class="flaticon-heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped lang="sass">
.selected
    background-color: var(--thm-base)

.products-grid__usefull-links
    a:hover
        cursor: pointer

.product-grid-two.list .product-grid-two__overlay-box .icon a.selected
    background-color: var(--thm-base)
</style>
