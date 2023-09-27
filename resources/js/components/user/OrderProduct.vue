<script setup lang="ts">
import {IProps} from "../../types/components/user/order-product";

const props = defineProps<IProps>();
</script>

<template>
    <tr>
        <td>
            <div class="wishlist-thumb"> <img :src="product.image.url" :alt="product.image"> </div>
        </td>
        <td>
            <h5>{{ product.title }}</h5>
        </td>
        <td>
            <p class="price">${{ product.price}}</p>
        </td>
    </tr>
</template>

<style scoped>

</style>
