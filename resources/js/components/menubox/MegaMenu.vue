<script setup lang="ts">
import {useI18n} from "vue-i18n";

const {t} = useI18n({useScope: 'global'});
</script>

<template>
    <div class="mega-menu-default mega-menu d-lg-block d-none">
        <div class="container position-relative">
            <div class="row">
                <nav>
                    <ul class="page-dropdown-menu d-flex align-items-center justify-content-center">
                        <li
                        >
                            <router-link :to="{name: 'index'}">
                                <span>{{ $t('app.menubox.megaMenu.home')}} </span>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{name: 'shop'}">
                                <span>{{ $t('app.menubox.megaMenu.shop')}} </span>
                            </router-link>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>

<style scoped lang="sass">
.mega-menu
    li
        margin: 10px
        padding-right: 5%
        span
            font-size: 16px
            color: var(--thm-black)
            transition: 0.25s
            &:hover
                color: var(--thm-gray)
                transition: 0.5s
</style>
