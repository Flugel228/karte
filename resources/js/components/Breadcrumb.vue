<script setup lang="ts">
import {IProps} from "../types/components/breadcrumb";

const props = defineProps<IProps>();
</script>

<template>
    <section class="breadcrumb-area" style="background-image: url(/public/assets/images/inner-pages/breadcum-bg.png);">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-content text-center wow fadeInUp  animated" style="visibility: visible; animation-name: fadeInUp;">
                        <h2>{{active}}</h2>
                        <div class="breadcrumb-menu">
                            <ul>
                                <li><router-link :to="{name: from.name}"><i class="flaticon-home pe-2"></i>{{ from.title }}</router-link></li>
                                <li> <i class="flaticon-next"></i> </li>
                                <li class="active">{{ active }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
