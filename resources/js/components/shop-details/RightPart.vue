<script setup lang="ts">
import {IProps} from "../../types/components/shop-details/right-part";
import transformToTwoDecimalPlaces from "../../composables/transformToTwoDecimalPlaces";
import addToCart from "../../composables/addToCart";
import {computed, ref} from "vue";
import {ProductComment} from "../../types/views/shop-details";
import {types} from "sass";
import Number = types.Number;

const props = defineProps<IProps>();

const quantity = ref<number>(1);
const length = 5;

// computed variables
const numberOfReviews = computed((): number => props.product.productComments.length);
const avgRate = computed((): number => {
    let avg: number = 0;
    props.product.productComments.forEach((comment: ProductComment): void => {
        avg += comment.rate;
    })
    avg = Math.round(avg / numberOfReviews.value)
    return avg;
})

const incrementQty = () => quantity.value++;
const decrementQty = () => {
    if (quantity.value > 1) {
        quantity.value--;
    }
}
</script>

<template>
    <div class="col-xl-6 col-lg-6 mt-30 wow fadeInUp  animated"
         style="visibility: visible; animation-name: fadeInUp;">
        <div class="shop-details-top-right ">
            <div class="shop-details-top-right-content-box">
                <div class="shop-details-top-review-box">
                    <div class="shop-details-top-review">
                        <ul>
                            <li
                                v-for="(item, id) in length"
                                :key="id"
                            >
                                <i
                                    v-if="numberOfReviews > 0"
                                    :class="['flaticon-star-1', {'unselected': avgRate < id + 1}]"
                                ></i>
                                <i
                                    v-else
                                    class="flaticon-star-1 unselected"
                                />
                            </li>
                        </ul>
                        <p>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">({{ numberOfReviews }} отзыва)</font>
                            </font>
                        </p>
                    </div>
                </div>
                <div class="shop-details-top-title">
                    <h3>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">{{ product.title }}</font>
                        </font>
                    </h3>
                </div>
                <ul class="shop-details-top-info">
                    <li><span><font style="vertical-align: inherit;"><font
                        style="vertical-align: inherit;">Артикул:</font></font></span><font
                        style="vertical-align: inherit;"><font
                        style="vertical-align: inherit;">25d5214</font></font></li>
                    <li><span><font style="vertical-align: inherit;"><font
                        style="vertical-align: inherit;">Продавец:</font></font></span><font
                        style="vertical-align: inherit;"><font
                        style="vertical-align: inherit;">Флемено</font></font></li>
                </ul>
                <div class="shop-details-top-price-box">
                    <h3>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">
                                ${{ transformToTwoDecimalPlaces(product.price) }}
                            </font>
                        </font>
                    </h3>
                    <p>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">(+15% НДС включен)</font>
                        </font>
                    </p>
                </div>
                <div class="shop-details-top-color-sky-box">
                    <h4>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Цвета:</font>
                        </font>
                    </h4>
                    <div class="color-varient">
                        <a
                            v-for="(color,id) in product.colors"
                            :key="id"
                            class="color-name"
                            :style="{
                                            background: color.code
                                        }">
                            <span data-v-616224fa="">{{ color.title }}</span>
                        </a>
                    </div>
                </div>
                <div class="product-quantity">
                    <h4>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Количество:</font>
                        </font>
                    </h4>
                    <div
                        v-if="product.quantity > 0"
                        class="product-quantity-box d-flex align-items-center flex-wrap"
                    >
                        <div class="qty mr-2">
                            <div class="qtySelector text-center">
                                <span
                                    @click="decrementQty"
                                    class="decreaseQty"
                                >
                                    <i class="flaticon-minus"></i>
                                </span>
                                <input
                                    type="number"
                                    class="qtyValue"
                                    v-model="quantity"
                                >
                                <span
                                    @click="incrementQty"
                                    class="increaseQty"
                                >
                                    <i class="flaticon-plus"></i>
                                </span>
                            </div>
                        </div>
                        <div
                            v-if="product.quantity"
                            class="product-quantity-check"
                        >
                            <i class="flaticon-select"></i>
                            <p>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">В наличии</font>
                                </font>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="shop-details-top-order-now"
                     v-if="product.quantity < 100 && product.quantity > 0"
                >
                    <i class="flaticon-point"></i>
                    <p>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Закажите
                                сейчас, осталось всего {{ product.quantity }}!</font>
                        </font></p>
                </div>
                <div
                    v-if="product.quantity > 0"
                    class="shop-details-top-cart-box-btn mt-4"
                >
                    <button
                        @click.prevent="addToCart(product, quantity)"
                        class="btn--primary style2 "
                        type="submit"
                    >
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">добавить в корзину</font>
                        </font>
                    </button>
                </div>
                <div class="shop-details-top-social-box mt-3">
                    <p><font style="vertical-align: inherit;"><font
                        style="vertical-align: inherit;">Делиться:</font></font>
                    </p>
                    <ul class="ps-1 social_link d-flex align-items-center">
                        <li><a href="https://www.facebook.com/" class="active" target="_blank"><i
                            class="flaticon-facebook-app-symbol"></i></a></li>
                        <li><a href="https://www.youtube.com/" target="_blank"><i
                            class="flaticon-youtube"></i></a></li>
                        <li><a href="https://twitter.com/" target="_blank"><i class="flaticon-twitter"></i></a>
                        </li>
                        <li><a href="https://www.instagram.com/" target="_blank"><i
                            class="flaticon-instagram"></i></a></li>
                    </ul>
                </div>
                <p class="shop-details-top-product-delivery">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                            Ориентировочная доставка этого продукта между
                        </font>
                    </font>
                    <span>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Среда, 27 октября</font>
                                    </font>
                                </span>
                    <br>
                    <span>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Вторник, 2 ноября</font>
                                    </font>
                                </span>
                </p>
                <ul class="shop-details-top-category-tags">
                    <li>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Категория:</font>
                        </font>
                        <span>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">{{ product.category }}</font>
                                        </font>
                                    </span>
                    </li>
                    <li>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">
                                Теги:</font>
                        </font>
                        <span
                            v-for="(tag, id) in product.tags"
                        >
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">{{ tag.title }},</font>
                                        </font>
                                    </span>
                    </li>
                </ul>
                <ul class="shop-details-top-feature">
                    <li>
                        <div class="icon"><i class="flaticon-portfolio"></i></div>
                        <div class="text">
                            <p><font style="vertical-align: inherit;"><font
                                style="vertical-align: inherit;">Гарантия возврата денег</font></font></p>
                        </div>
                    </li>
                    <li>
                        <div class="icon"><i class="flaticon-truck"></i></div>
                        <div class="text">
                            <p><font style="vertical-align: inherit;"><font
                                style="vertical-align: inherit;">Бесплатная доставка и возврат</font></font>
                            </p>
                        </div>
                    </li>
                    <li>
                        <div class="icon"><i class="flaticon-security"></i></div>
                        <div class="text">
                            <p><font style="vertical-align: inherit;"><font
                                style="vertical-align: inherit;">Портативная поддержка</font></font></p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<style scoped lang="sass">
.shop-details-top-review ul li:last-child i
    color: var(--thm-black)
.shop-details-top-review ul li i.unselected
    color: #74787c
</style>
