<script setup lang="ts">
import {useStore} from "vuex";
import {computed} from "vue";
import {User} from "../../../types/store";

const store = useStore();

const accessToken = computed(() => store.getters["GET_ACCESS_TOKEN"]);
const user = computed((): User => store.getters["GET_USER"]);
const quantityOfCartProducts = computed((): number => store.getters["GET_QUANTITY_OF_CART_PRODUCTS"]);

const clickMenubar = () => store.commit("SWITCH_SIDEBAR_CONTENT_IS_ACTIVE");

const openCart = () => store.commit("shop/SWITCH_CART_IS_ACTIVE");
</script>

<template>
    <div class="col-4 text-end">
        <div class="right d-flex align-items-center justify-content-end">
            <ul class="main-menu__widge-box d-flex align-items-center">
                <li class="d-lg-block d-none">
                    <router-link
                        v-if="accessToken"
                        :to="{name: 'users.user', params: {id: 1}}"
                    >
                        <i class="flaticon-user"></i>
                    </router-link>
                    <router-link
                        v-if="!accessToken"
                        :to="{name: 'users.register'}"
                    >
                        <i class="flaticon-user-1"/>
                        <i class="flaticon-plus"/>
                    </router-link>
                </li>
                <li v-if="accessToken && user"
                    class="d-lg-block d-none">
                    <router-link :to="{name: 'users.user.wishlist', params: {id: user.id}}" class="number">
                        <i class="flaticon-heart"></i>
                    </router-link>
                </li>
                <li class="cartm">
                    <a
                        class="number cart-icon pointer"
                        @click.prevent="openCart"
                    >
                        <i class="flaticon-shopping-cart"></i>
                        <span class="count">({{quantityOfCartProducts}})</span>
                    </a>
                </li>
                <li
                    class="menubar d-lg-block d-none"
                    @click="clickMenubar"
                ><span></span> <span></span> <span></span></li>
            </ul>
        </div>
    </div>
</template>

<style scoped lang="sass">
.cartm
    a:hover
        cursor: pointer
</style>
