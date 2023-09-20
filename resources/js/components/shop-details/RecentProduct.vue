<script setup lang="ts">
import transformToTwoDecimalPlaces from "../../composables/transformToTwoDecimalPlaces";
import {IProps} from "../../types/components/shop-details/recent-product";

const props = defineProps<IProps>();
</script>

<template>
    <div class="products-three-single slick-slide slick-current slick-active" tabindex="0" style="width: 312px;"
         data-slick-index="4" aria-hidden="false">
        <div class="products-three-single-img img-bg">
            <a href="shop-details-3.html" class="d-block" tabindex="0">
                <img :src="product.image.url" alt="">
            </a>
            <div class="products-grid-one__badge-box"><span class="bg_base badge new ">New</span>
            </div>
            <a href="cart.html" class="addcart btn--primary style2" tabindex="0"> Add To Cart </a>
            <div class="products-grid__usefull-links">
                <ul>
                    <li><a href="wishlist.html" tabindex="0"> <i class="flaticon-heart"> </i> <span>
                                                    wishlist</span> </a></li>
                    <li><a href="compare.html" tabindex="0"> <i class="flaticon-left-and-right-arrows"></i>
                        <span> compare</span> </a></li>
                    <li><a href="#popup4" class="popup_link" tabindex="0"> <i class="flaticon-visibility"></i>
                        <span> quick view</span> </a></li>
                </ul>
            </div>
            <div id="popup4" class="product-gird__quick-view-popup mfp-hide">
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-lg-6">
                            <div class="quick-view__left-content">
                                <div class="tabs ui-tabs ui-corner-all ui-widget ui-widget-content">
                                    <div class="popup-product-thumb-box">
                                        <ul role="tablist"
                                            class="ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix ui-widget-header">
                                            <li class="tab-nav popup-product-thumb ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active ui-state-active"
                                                role="tab" tabindex="0" aria-controls="tab11111"
                                                aria-labelledby="ui-id-13" aria-selected="true" aria-expanded="true"><a
                                                href="#tab11111" tabindex="0" class="ui-tabs-anchor" id="ui-id-13"> <img
                                                src="assets/images/shop/products-v6-img5.jpg" alt=""> </a></li>
                                            <li class="tab-nav popup-product-thumb ui-tabs-tab ui-corner-top ui-state-default ui-tab"
                                                role="tab" tabindex="-1" aria-controls="tab22222"
                                                aria-labelledby="ui-id-14" aria-selected="false" aria-expanded="false">
                                                <a href="#tab22222" tabindex="0" class="ui-tabs-anchor" id="ui-id-14">
                                                    <img src="assets/images/shop/products-v6-img6.jpg" alt=""> </a></li>
                                            <li class="tab-nav popup-product-thumb ui-tabs-tab ui-corner-top ui-state-default ui-tab"
                                                role="tab" tabindex="-1" aria-controls="tab33333"
                                                aria-labelledby="ui-id-15" aria-selected="false" aria-expanded="false">
                                                <a href="#tab33333" tabindex="0" class="ui-tabs-anchor" id="ui-id-15">
                                                    <img src="assets/images/shop/products-v6-img7.jpg" alt=""> </a></li>
                                        </ul>
                                    </div>
                                    <div class="popup-product-main-image-box">
                                        <div id="tab11111"
                                             class="tab-item popup-product-image ui-tabs-panel ui-corner-bottom ui-widget-content"
                                             aria-labelledby="ui-id-13" role="tabpanel" aria-hidden="false">
                                            <div class="popup-product-single-image"><img
                                                src="assets/images/shop/products-v6-img5.jpg" alt=""></div>
                                        </div>
                                        <div id="tab22222"
                                             class="tab-item popup-product-image ui-tabs-panel ui-corner-bottom ui-widget-content"
                                             aria-labelledby="ui-id-14" role="tabpanel" aria-hidden="true"
                                             style="display: none;">
                                            <div class="popup-product-single-image"><img
                                                src="assets/images/shop/products-v6-img6.jpg" alt=""></div>
                                        </div>
                                        <div id="tab33333"
                                             class="tab-item popup-product-image ui-tabs-panel ui-corner-bottom ui-widget-content"
                                             aria-labelledby="ui-id-15" role="tabpanel" aria-hidden="true"
                                             style="display: none;">
                                            <div class="popup-product-single-image"><img
                                                src="assets/images/shop/products-v6-img7.jpg" alt=""></div>
                                        </div>
                                        <button class="prev" tabindex="0"><i class="flaticon-back"></i>
                                        </button>
                                        <button class="next" tabindex="0"><i class="flaticon-next"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="popup-right-content">
                                <h3>Brown Office Shoe</h3>
                                <div class="ratting"><i class="flaticon-star"></i> <i class="flaticon-star"></i> <i
                                    class="flaticon-star"></i> <i class="flaticon-star"></i> <i
                                    class="flaticon-star"></i>
                                    <span>(112)</span></div>
                                <p class="text"> Hydrating Plumping Intense Shine Lip Colour </p>
                                <div class="price">
                                    <h2> $42 USD
                                        <del> $65 USD</del>
                                    </h2>
                                    <h6> In stuck</h6>
                                </div>
                                <div class="color-varient"><a href="#0" class="color-name pink" tabindex="0">
                                    <span>Pink</span> </a> <a href="#0" class="color-name red" tabindex="0">
                                    <span>Red</span> </a> <a href="#0" class="color-name yellow" tabindex="0"><span>Yellow</span>
                                </a> <a href="#0" class="color-name blue" tabindex="0"> <span>Blue</span> </a> <a
                                    href="#0" class="color-name black" tabindex="0"> <span>Black</span> </a>
                                </div>
                                <div class="add-product">
                                    <h6>Qty:</h6>
                                    <div class="button-group">
                                        <div class="qtySelector text-center"> <span class="decreaseQty"><i
                                            class="flaticon-minus"></i>
                                                                </span> <input type="number" class="qtyValue" value="1"
                                                                               tabindex="0"> <span class="increaseQty"> <i
                                            class="flaticon-plus"></i> </span></div>
                                        <button class="btn--primary " tabindex="0"> Add to Cart</button>
                                    </div>
                                </div>
                                <div class="payment-method"><a href="#0" tabindex="0"> <img
                                    src="assets/images/payment_method/method_1.png" alt="">
                                </a> <a href="#0" tabindex="0"> <img src="assets/images/payment_method/method_2.png"
                                                                     alt="">
                                </a> <a href="#0" tabindex="0"> <img src="assets/images/payment_method/method_3.png"
                                                                     alt="">
                                </a> <a href="#0" tabindex="0"> <img src="assets/images/payment_method/method_4.png"
                                                                     alt="">
                                </a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="products-three-single-content text-center"><span>{{ product.category }}</span>
            <h5><a href="shop-details-3.html" tabindex="0">{{ product.title }}</a></h5>
            <p>${{ transformToTwoDecimalPlaces(product.price) }}</p>
        </div>
    </div>
</template>

<style scoped>

</style>
