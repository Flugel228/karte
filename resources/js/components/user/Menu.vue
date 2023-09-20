<script setup lang="ts">
import {useStore} from "vuex";
import {useRouter} from "vue-router";

const store = useStore();
const router = useRouter();

const clickHandler = () => {
    localStorage.removeItem('access_token');
    store.commit("SET_ACCESS_TOKEN");
    router.push({name: 'index'});
}
</script>

<template>
    <div class="col-xl-3 col-lg-4">
        <div class="d-flex align-items-start">
            <div class="nav my-account-page__menu flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                 aria-orientation="vertical">
                <button class="nav-link" id="v-pills-orders-tab" data-bs-toggle="pill" data-bs-target="#v-pills-orders"
                        type="button" role="tab" aria-controls="v-pills-orders" aria-selected="false">
                    <span> Заказы</span>
                </button>
                <button class="nav-link active" id="v-pills-settings-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings"
                        aria-selected="true"><span>Настройки</span>
                </button>
                <button @click="clickHandler" class="nav-link"><span> Выйти </span></button>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
