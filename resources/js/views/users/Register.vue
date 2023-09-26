<script setup lang="ts">
import RegisterForm from "../../components/register/RegisterForm.vue";
import Breadcrumb from "../../components/Breadcrumb.vue";
import {From} from "../../types/components/breadcrumb";
import {useI18n} from "vue-i18n";

const {t} = useI18n({useScope: 'global'});

const from: From = {
    title: 'Главная',
    name: 'index'
}
const active: string = 'Регистрация'
</script>

<template>
    <main class="overflow-hidden ">
        <!--Start Breadcrumb Style2-->
        <Breadcrumb
            :from="{
                title: $t('register.breadcrumb.from'),
                name: 'index'
            }"
            :active="$t('register.breadcrumb.active')"
        />
        <!--End Breadcrumb Style2-->
        <!--Start Login Page-->
        <section class="login-page pt-120 pb-120">
            <div class="container">
                <RegisterForm/>
            </div>
        </section>
        <!--End Login Page-->
    </main>
</template>

<style scoped>

</style>
