<script setup lang="ts">
import {onMounted, ref} from "vue";
import {OrderProduct as Product, ResponseOrderProduct} from "../../types/components/user/tab-content";
import api from "../../axios/api";
import OrderProduct from "./OrderProduct.vue";

const products = ref<Product[]>();

onMounted(async () => {
    await fetchProducts();
})

const fetchProducts = async (): Promise<void> => {
    const res = await api.get<ResponseOrderProduct>('/api/users/auth/products/orders');
    products.value = res.data.data;

}
</script>

<template>
    <div class="col-lg-7">
        <div class="tab-content " id="v-pills-tabContent">
            <div class="tab-pane fade" id="v-pills-orders" role="tabpanel" aria-labelledby="v-pills-orders-tab">
                <div class="tabs-content__single">
                    <section class="wishlist pt-120 pb-120">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-12 wow fadeInUp  animated"
                                     style="visibility: visible; animation-name: fadeInUp;">
                                    <div class="wishlist-table-box">
                                        <div class="wishlist-table-outer">
                                            <table class="wishlist-table">
                                                <thead class="wishlist-header">
                                                <tr>
                                                    <th>{{ $t('user.tabContent.order.image') }}</th>
                                                    <th>{{ $t('user.tabContent.order.product') }}</th>
                                                    <th>{{ $t('user.tabContent.order.price') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <OrderProduct
                                                    v-for="(product, id) in products"
                                                    :product="product"
                                                    :key="id"
                                                />
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
