<script setup lang="ts">
import {useStore} from "vuex";
const store = useStore();

const clickMenubar = () => store.commit("SWITCH_MOBILE_MENU_IS_ACTIVE");
</script>

<template>
    <div class="col-4 text-start">
        <div class="right d-lg-none d-block">
            <ul class="main-menu__widge-box d-flex align-items-center">
                <li class="menubar" @click="clickMenubar"><span></span> <span></span> <span></span></li>
            </ul>
        </div>
    </div>
</template>

<style scoped>

</style>
