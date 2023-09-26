<script setup lang="ts">
import LoginForm from "../../components/login/LoginForm.vue";
import Breadcrumb from "../../components/Breadcrumb.vue";
import {useI18n} from "vue-i18n";

const {t} = useI18n({useScope: 'global'});
</script>

<template>
    <main class="overflow-hidden ">
        <!--Start Breadcrumb Style2-->
        <Breadcrumb
            :from="{
                title: $t('login.breadcrumb.from'),
                name: 'index'
            }"
            :active="$t('login.breadcrumb.active')"
        />
        <!--End Breadcrumb Style2-->
        <!--Start Login Page-->
        <LoginForm/>
        <!--End Login Page-->
    </main>
</template>

<style scoped>

</style>
