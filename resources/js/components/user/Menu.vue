<script setup lang="ts">
import {useI18n} from "vue-i18n";
import {useStore} from "vuex";
import {useRouter} from "vue-router";

const store = useStore();
const router = useRouter();

const {t} = useI18n({useScope: 'global'});

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
                    <span> {{$t('user.accountPage.menu.buttons.orders')}}</span>
                </button>
                <button @click="clickHandler" class="nav-link"><span> {{ $t('user.accountPage.menu.buttons.logout')}} </span></button>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
