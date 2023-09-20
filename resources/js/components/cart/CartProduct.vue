<script setup lang="ts">
import {IProps} from "../../types/components/cart/cart-product";
import transformToTwoDecimalPlaces from "../../composables/transformToTwoDecimalPlaces";
import {cartProduct} from "../../types/store";
import {useStore} from "vuex";

const props = defineProps<IProps>();
const store = useStore();

const incrementQuantity = (id: number): void => {
    const cartProducts: cartProduct[] = JSON.parse(localStorage.getItem('cart'));
    cartProducts.find((product: cartProduct): boolean => product.id === id).quantity++;
    localStorage.setItem('cart', JSON.stringify(cartProducts));
    store.commit("SET_CART_PRODUCTS");

}
const decrementQuantity = (id: number): void => {
    const cartProducts: cartProduct[] = JSON.parse(localStorage.getItem('cart'));
    const product = cartProducts.find((product: cartProduct): boolean => product.id === id);
    if (product.quantity > 1) {
        product.quantity--;
        localStorage.setItem('cart', JSON.stringify(cartProducts));
        store.commit("SET_CART_PRODUCTS");
    }
}
</script>

<template>
    <tr>
        <td>
            <div class="thumb-box">
                <a href="shop-details-1.html" class="thumb">
                    <img :src="product.image.url" alt="">
                </a>
                <a href="shop-details-1.html" class="title">
                    <h5>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">{{ product.title }}</font>
                        </font>
                    </h5>
                </a>
            </div>
        </td>
        <td>
            <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">${{ transformToTwoDecimalPlaces(product.price) }}</font>
            </font>
        </td>
        <td class="qty">
            <div class="qtySelector text-center">
                                            <span
                                                class="decreaseQty"
                                                @click="decrementQuantity(product.id)"
                                            >
                                                <i class="flaticon-minus"></i>
                                            </span>
                <input
                    type="number"
                    class="qtyValue"
                    v-model="product.quantity"
                >
                <span
                    class="increaseQty"
                    @click="incrementQuantity(product.id)"
                >
                                                <i class="flaticon-plus"></i>
                                            </span>
            </div>
        </td>
        <td class="sub-total">
            <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">${{ transformToTwoDecimalPlaces(product.price * product.quantity) }}</font>
            </font>
        </td>
        <td>
            <div class="remove">
                <i class="flaticon-cross"></i>
            </div>
        </td>
    </tr>
</template>

<style scoped>

</style>
