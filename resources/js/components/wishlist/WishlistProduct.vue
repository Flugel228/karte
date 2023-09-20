<script setup lang="ts">
import {IProps} from "../../types/components/wishlist/wishlist-product";
import addToCart from "../../composables/addToCart";

const props = defineProps<IProps>();
</script>

<template>
    <tr>
        <td>
            <div class="wishlist-thumb"> <img :src="product.image.url" :alt="product.image.id"> </div>
        </td>
        <td>
            <h5>{{ product.title }}</h5>
        </td>
        <td>
            <p class="price">${{ product.price}}</p>
        </td>
        <td>
            <p
                v-if="product.quantity > 0"
                class="instock"
            >На складе</p>
            <p
                v-else
                class="absence"
            >Отсутствует</p>
        </td>
        <td class="add-to-cart-btn">
            <a
                @click.prevent="addToCart(product)"
                class=" btn--primary style2 "
            >Добавить в корзину</a>
        </td>
        <td>
            <div class="remove"> <i class="flaticon-cross"></i> </div>
        </td>
    </tr>
</template>

<style scoped>

</style>
