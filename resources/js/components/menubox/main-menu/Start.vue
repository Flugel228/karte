<script setup lang="ts">
import {useStore} from "vuex";
const store = useStore();

const clickMenubar = () => store.commit("SWITCH_MOBILE_MENU_IS_ACTIVE");
</script>

<template>
    <div class="col-4 text-start">
        <div class="left d-lg-block d-none">
            <div class="search-box-holder">
                <form action="#0">
                    <div class="form-group search-box menu"><input type="text" class="form-control"
                                                                   placeholder="Search for products"> <span
                        class="search-icon"><i class="flaticon-magnifying-glass"></i></span></div>
                </form>
            </div>
        </div>
        <div class="right d-lg-none d-block">
            <ul class="main-menu__widge-box d-flex align-items-center">
                <li class="menubar" @click="clickMenubar"><span></span> <span></span> <span></span></li>
            </ul>
        </div>
    </div>
</template>

<style scoped>

</style>
