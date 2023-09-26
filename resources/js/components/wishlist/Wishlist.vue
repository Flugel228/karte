<script setup lang="ts">
import {onMounted, ref} from "vue";
import {WishlistProduct as Product, WishlistResponse} from "../../types/components/wishlist/wishlist";
import api from "../../axios/api";
import axios from "axios";
import WishlistProduct from "./WishlistProduct.vue";
import {useI18n} from "vue-i18n";

const {t} = useI18n({useScope: 'global'});

const products = ref<Product[]>();

onMounted(async () => {
    await fetchProducts();
})

const fetchProducts = async (): Promise<void> => {
    try {
        const res = await api.post<WishlistResponse, axios.AxiosResponse<WishlistResponse>>("/api/users/auth/wishlist");
        products.value = res.data;
    } catch (e) {
        if (axios.isAxiosError(e)) {
            console.log(e.message, "err");
            console.log(e.response?.data.message, "error");
        } else if (e instanceof Error) {
            console.log(e.message);
        }
    }
}
</script>

<template>
    <section class="wishlist pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 wow fadeInUp  animated" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="wishlist-table-box">
                        <div class="wishlist-table-outer">
                            <table class="wishlist-table">
                                <thead class="wishlist-header">
                                <tr>
                                    <th>{{ $t('wishlist.wishlist.image')}}</th>
                                    <th>{{ $t('wishlist.wishlist.product')}}</th>
                                    <th>{{ $t('wishlist.wishlist.price')}}</th>
                                    <th>{{ $t('wishlist.wishlist.status')}}</th>
                                    <th>{{ $t('wishlist.wishlist.add')}}</th>
                                    <th>{{ $t('wishlist.wishlist.delete')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <WishlistProduct
                                        v-for="(product, id) in products"
                                        :key="id"
                                        :product="product"
                                    />
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped lang="sass">
.wishlist-table
    tbody
        tr
            .absence
                position: relative
                display: inline-block
                font-size: 12px
                background-color: var(--thm-black)
                color: #fff
                text-transform: uppercase
                padding: 4px 13px
</style>
