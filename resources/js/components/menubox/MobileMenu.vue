<script setup lang="ts">
import {useStore} from "vuex";
import {computed} from "vue";
import {User} from "../../types/store";
import {useRouter} from "vue-router";
import {useI18n} from "vue-i18n";

const {t} = useI18n({useScope: 'global'});

const store = useStore();
const router = useRouter();
const accessToken = computed((): string => store.getters["GET_ACCESS_TOKEN"]);
const isActive = computed((): boolean => store.getters["GET_MOBILE_MENU_IS_ACTIVE"]);
const user = computed((): User => store.getters["GET_USER"]);

const closeMenu = () => store.commit("SWITCH_MOBILE_MENU_IS_ACTIVE");

const logoutHandler = (): void => {
    localStorage.removeItem('access_token');
    store.commit("SET_ACCESS_TOKEN")
    store.commit("SET_USER");
    router.push({name: 'index'})
}
</script>

<template>
    <div class="mobile-menu d-lg-none d-block">
        <div :class="{
            'menu-closer': true,
            'active': isActive
        }"></div>
        <div :class="{
            'mobile-menu__sidebar-menu': true,
            'active': isActive
        }">
            <div :class="{
                'menu-closer': true,
                'two': true,
                'active': isActive
            }"><span>
                {{ $t('app.menubox.mobileMenu.close')}}
            </span> <span
                class="cross cursor-pointer"
                @click="closeMenu"
            ><i
                class="flaticon-cross"></i></span></div>
            <ul class="page-dropdown-menu">
                <li>
                    <router-link :to="{name: 'index'}">
                        {{ $t('app.menubox.mobileMenu.home')}}
                    </router-link>
                </li>
                <li>
                    <router-link :to="{name: 'shop'}">
                        {{ $t('app.menubox.mobileMenu.shop')}}
                    </router-link>
                </li>
                <template v-if="!accessToken">
                    <li>
                        <router-link :to="{name: 'users.login'}">
                            {{ $t('app.menubox.mobileMenu.login')}}
                        </router-link>
                    </li>
                    <li>
                        <router-link :to="{name: 'users.register'}">
                            {{ $t('app.menubox.mobileMenu.register')}}
                        </router-link>
                    </li>
                </template>
                <template v-else>
                    <li>
                        <router-link v-if="user" :to="{name: 'users.user', params: {id: user.id}}">
                            {{ $t('app.menubox.mobileMenu.user')}}
                        </router-link>
                    </li>
                    <li>
                        <a @click.prevent="logoutHandler">
                            {{ $t('app.menubox.mobileMenu.logout')}}
                        </a>
                    </li>
                </template>
            </ul>
        </div>
    </div>
</template>

<style scoped lang="sass">
.cursor-pointer
    cursor: pointer
</style>
