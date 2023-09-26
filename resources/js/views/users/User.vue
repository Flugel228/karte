<script setup lang="ts">
import Breadcrumb from "../../components/Breadcrumb.vue";
import AccountPage from "../../components/user/AccountPage.vue"
import {From} from "../../types/components/breadcrumb";
import {useI18n} from "vue-i18n";

const {t} = useI18n({useScope: 'global'});
</script>

<template>
    <main class="overflow-hidden ">
        <!--Start Breadcrumb Style2-->
        <Breadcrumb
            :from="{
                title: $t('user.breadcrumb.from'),
                name: 'index'
            }"
            :active="$t('user.breadcrumb.active')"
        />
        <!--End Breadcrumb Style2-->
        <!--Start My Account Page-->
        <AccountPage/>
        <!--End My Account Page-->
    </main>
</template>

<style scoped>

</style>
