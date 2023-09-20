<script setup lang="ts">
import RegisterForm from "../../components/register/RegisterForm.vue";
import Breadcrumb from "../../components/register/Breadcrumb.vue";
</script>

<template>
    <main class="overflow-hidden ">
        <!--Start Breadcrumb Style2-->
        <Breadcrumb/>
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
