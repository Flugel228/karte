<script setup lang="ts">
import {IProps} from "../../types/components/wishlist/wishlist-product";
import addToCart from "../../composables/addToCart";
import {useI18n} from "vue-i18n";

const {t} = useI18n({useScope: 'global'});
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
            >{{ $t('wishlist.wishlist.wishlistProduct.status.inStock')}}</p>
            <p
                v-else
                class="absence"
            >{{ $t('wishlist.wishlist.wishlistProduct.status.absence')}}</p>
        </td>
        <td class="add-to-cart-btn">
            <a
                @click.prevent="addToCart(product)"
                class=" btn--primary style2 "
            >{{ $t('wishlist.wishlist.wishlistProduct.buttons.addToCart')}}</a>
        </td>
        <td>
            <div class="remove"> <i class="flaticon-cross"></i> </div>
        </td>
    </tr>
</template>

<style scoped>

</style>
