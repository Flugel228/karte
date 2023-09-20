<script setup lang="ts">
import {useStore} from "vuex";
import {computed} from "vue";
import {cartProduct} from "../../types/store";
import transformToTwoDecimalPlaces from "../../composables/transformToTwoDecimalPlaces";
import CartProduct from "./CartProduct.vue"

const store = useStore();
const cart = computed((): null | cartProduct[] => store.getters["GET_CART_PRODUCTS"]);
const totalPrice = computed((): number => store.getters["GET_TOTAL_PRICE"]);
</script>

<template>
    <section class="cart-area pt-120 pb-120">
        <div class="container">
            <div class="row wow fadeInUp  animated" style="visibility: visible; animation-name: fadeInUp;">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="cart-table-box">
                        <div class="table-outer">
                            <table class="cart-table">
                                <thead class="cart-header">
                                <tr>
                                    <th class=""><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">наименование товара</font></font></th>
                                    <th class="price"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Цена</font></font></th>
                                    <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Количество</font></font></th>
                                    <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Промежуточный итог</font></font></th>
                                    <th class="hide-me"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <CartProduct
                                    v-for="(product, id) in cart"
                                    :key="id"
                                    :product="product"
                                />
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="cart-button-box">
                        <div class="apply-coupon wow fadeInUp  animated" style="visibility: visible; animation-name: fadeInUp;">
                            <div class="apply-coupon-input-box mt-30 ">
                                <input type="text" name="coupon-code" value="" placeholder="код купона">
                            </div>
                            <div class="apply-coupon-button mt-30">
                                <button class="btn--primary style2" type="submit">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Применить купон</font>
                                    </font>
                                </button>
                            </div>
                        </div>
                        <div class="cart-button-box-right wow fadeInUp  animated" style="visibility: visible; animation-name: fadeInUp;">
                            <button class="btn--primary mt-30" type="submit">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Продолжить покупки</font>
                                </font>
                            </button>
                            <button class="btn--primary mt-30" type="submit">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Обновить корзину</font>
                                </font>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-120">
                <div class="col-xl-6 col-lg-7 wow fadeInUp  animated" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="cart-total-box">
                        <div class="inner-title">
                            <h3>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Итоги корзины</font>
                                </font>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt--30">
                <div class="col-xl-6 col-lg-7 wow fadeInUp  animated" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="cart-total-box mt-30">
                        <div class="table-outer">
                            <table class="cart-table2">
                                <thead class="cart-header clearfix">
                                <tr>
                                    <th colspan="1" class="shipping-title">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Перевозки</font>
                                        </font>
                                    </th>
                                    <th class="price">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">$50.00</font>
                                        </font>
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-5 wow fadeInUp  animated" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="cart-check-out mt-30">
                        <h3><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Итоговый чек</font></font></h3>
                        <ul class="cart-check-out-list">
                            <li>
                                <div class="left">
                                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Промежуточный итог</font></font></p>
                                </div>
                                <div class="right">
                                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">${{ transformToTwoDecimalPlaces(totalPrice) }}</font></font></p>
                                </div>
                            </li>
                            <li>
                                <div class="left">
                                    <p>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Перевозки</font>
                                        </font>
                                    </p>
                                </div>
                                <div class="right">
                                    <p>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">$50.00</font>
                                        </font>
                                    </p>
                                </div>
                            </li>
                            <li>
                                <div class="left">
                                    <p>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Итоговая цена:</font>
                                        </font>
                                    </p>
                                </div>
                                <div class="right">
                                    <p>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">${{ transformToTwoDecimalPlaces(totalPrice + 50)}}</font>
                                        </font>
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
