<script setup lang="ts">

</script>

<template>
    <div class="shop-details-breadcrumb wow fadeInUp  overflow-hidden  animated" style="visibility: visible; animation-name: fadeInUp;">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="shop-details-inner">
                        <ul class="shop-details-menu">
                            <li>
                                <router-link
                                    :to="{
                                        name: 'index'
                                    }"
                                >
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Главная</font>
                                    </font>
                                </router-link>
                            </li>
                            <li class="active">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Подробнее о продукте</font>
                                </font>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
