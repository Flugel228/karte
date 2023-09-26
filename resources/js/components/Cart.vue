<script setup lang="ts">
import {useStore} from "vuex";
import {computed, onMounted, } from "vue";
import {cartProduct, User} from "../types/store";
import transformToTwoDecimalPlaces from "../composables/transformToTwoDecimalPlaces";
import {useI18n} from "vue-i18n";
import {useRouter} from "vue-router";
import useOrderProducts from "../composables/OrderProducts";

const {t} = useI18n({useScope: 'global'});
const store = useStore();
const router = useRouter();

// computed variables
const isActive = computed((): boolean => store.getters["shop/GET_CART_IS_ACTIVE"]);
const cart = computed((): null | cartProduct[] => store.getters["GET_CART_PRODUCTS"]);
const quantityOfCartProducts = computed((): number => store.getters["GET_QUANTITY_OF_CART_PRODUCTS"]);
const totalPrice = computed((): number => store.getters["GET_TOTAL_PRICE"]);
const user = computed((): null | User => store.getters["GET_USER"]);

// initialization of composable objects
const orderProducts = useOrderProducts();
const checkoutBtn = orderProducts.checkoutBtn;
const toOrderProducts = () => orderProducts.toOrderProduct();

// methods
const closeCart = () => store.commit("shop/SWITCH_CART_IS_ACTIVE")
onMounted(() => {
    store.commit("SET_CART_PRODUCTS");
    console.log(JSON.parse(localStorage.getItem('cart')))
})

const removeFromCart = (id: number) => {
    let cart: null | cartProduct[] = JSON.parse(localStorage.getItem('cart'));
    cart = cart.filter((product: cartProduct): boolean => product.id !== id);
    localStorage.setItem('cart', JSON.stringify(cart));
    store.commit("SET_CART_PRODUCTS");
}

</script>

<template>
    <div :class="['side-cart d-flex flex-column justify-content-between', {'active': isActive}]">
        <div class="top">
            <div class="content d-flex justify-content-between align-items-center">
                <h6 class="text-uppercase">{{ $t('app.cart.yourCart') }} ({{ quantityOfCartProducts }})</h6>
                <span
                    class="cart-close text-uppercase"
                    @click="closeCart"
                >X</span>
            </div>
            <div class="cart_items">
                <template
                    v-for="(product, id) in cart"
                    :key="id"
                >
                    <div class="items d-flex justify-content-between align-items-center">
                        <div class="left d-flex align-items-center"><a href="shop-details-1.html"
                                                                       class="thumb d-flex justify-content-between align-items-center">
                            <img :src="product.image.url" alt=""> </a>
                            <div class="text">
                                <a href="shop-details-1.html">
                                    <h6>{{ product.title }}</h6>
                                </a>
                                <p>{{ product.quantity }} X <span>${{
                                        transformToTwoDecimalPlaces(product.price)
                                    }}</span></p>
                            </div>
                        </div>
                        <div class="right">
                            <div class="item-remove"
                                 @click="removeFromCart(product.id)"
                            ><i class="flaticon-cross"></i></div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
        <div class="bottom">
            <div class="total-ammount d-flex justify-content-between align-items-center">
                <h6 class="text-uppercase">{{ $t('app.cart.total') }}:</h6>
                <h6 class="ammount text-uppercase">${{ transformToTwoDecimalPlaces(totalPrice) }}</h6>
            </div>
            <div class="button-box d-flex justify-content-between">
                <router-link
                    class="btn_black"
                    :to="{name: 'cart'}"
                >{{ $t('app.cart.buttons.viewCart') }}
                </router-link>
                <a
                    @click.prevent="toOrderProducts()"
                    ref="checkoutBtn"
                    class="button-2 btn_theme"
                > {{
                        $t('app.cart.buttons.checkout')
                    }} </a>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
