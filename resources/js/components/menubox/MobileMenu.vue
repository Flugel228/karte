<script setup lang="ts">
import {useStore} from "vuex";
import {computed, inject, onMounted, onUpdated, ref} from "vue";
import {User} from "../../types/store";
import {useRouter} from "vue-router";

const store = useStore();
const router = useRouter();
const accessToken = computed(() => store.getters["GET_ACCESS_TOKEN"]);
const isActive = computed(() => store.getters["GET_MOBILE_MENU_IS_ACTIVE"]);
const user = computed(() => store.getters["GET_USER"]);

const closeMenu = () => store.commit("SWITCH_MOBILE_MENU_IS_ACTIVE");

const logoutHandler = () => {
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
            }"><span> Close Menu</span> <span
                class="cross cursor-pointer"
                @click="closeMenu"
            ><i
                class="flaticon-cross"></i></span></div>
            <div class="search-box-holder">
                <form action="#0">
                    <div class="form-group search-box menu"><input type="text" class="form-control"
                                                                   placeholder="Search for products"> <span
                        class="search-icon"> <i class="flaticon-magnifying-glass"></i> </span></div>
                </form>
            </div>
            <ul class="page-dropdown-menu">
                <li class="dropdown-list"><a href="#0"> <span>Home </span> <span class="menuarrow"> <i
                    class="flaticon-next-1"></i> </span> </a>
                    <ul class="dropdown">
                        <li><a href="index.html">Home Page 01</a></li>
                        <li><a href="index-2.html">Home Page 02</a></li>
                        <li><a href="index-3.html">Home Page 03</a></li>
                        <li><a href="index-4.html">Home Page 04</a></li>
                        <li><a href="index-5.html">Home Page 05</a></li>
                        <li><a href="index-6.html">Home Page 06</a></li>
                        <li><a href="index-7.html">Home Page 07</a></li>
                    </ul>
                </li>
                <li class="dropdown-list"><a href="#0"> <span>Shop </span> <span class="menuarrow"> <i
                    class="flaticon-next-1"></i> </span> </a>
                    <ul class="dropdown">
                        <li class="subhed position-relative"><a href="#0"> <span>Shop Details Style </span>
                            <span class="menuarrowtwo"> <i class="flaticon-next-1"></i> </span> </a>
                            <ul class="subdropdown">
                                <li><a href="shop-details-1.html">Shop Details 01</a></li>
                                <li><a href="shop-details-2.html">Shop Details 02</a></li>
                                <li><a href="shop-details-3.html">Shop Details 03</a></li>
                            </ul>
                        </li>
                        <li><a href="shop-grid.html"> Shop Grid</a></li>
                        <li><a href="shop-grid-left-sidebar.html">Shop Grid Left Sidebar</a></li>
                        <li><a href="shop-grid-right-sidebar.html">Shop Grid Right Sidebar</a></li>
                        <li><a href="shop-list-right-sidebar.html">Shop List Right Sidebar</a></li>
                        <li><a href="shop-list-left-sidebar.html">Shop LIst Left Sidebar</a></li>
                    </ul>
                </li>
                <li class="dropdown-list"><a href="#0"> <span>Features </span> <span class="menuarrow"> <i
                    class="flaticon-next-1"></i> </span> </a>
                    <ul class="dropdown">
                        <li class="subhed position-relative"><a href="#0"> <span>Category</span> <span
                            class="menuarrowtwo"> <i class="flaticon-next-1"></i> </span> </a>
                            <ul class="subdropdown">
                                <li><a href="shop-grid.html">Latest Shoes</a></li>
                                <li><a href="shop-grid.html">New Shoes</a></li>
                                <li><a href="shop-grid.html">Casual Shoes</a></li>
                                <li><a href="shop-grid.html">Office Shoes</a></li>
                            </ul>
                        </li>
                        <li class="subhed position-relative"><a href="#0"> <span>Offers</span> <span
                            class="menuarrowtwo"> <i class="flaticon-next-1"></i> </span> </a>
                            <ul class="subdropdown">
                                <li><a href="shop-grid.html">New Arrivals </a></li>
                                <li><a href="shop-grid-left-sidebar.html">Shirts</a></li>
                                <li><a href="shop-grid-right-sidebar.html">Polos</a></li>
                                <li><a href="shop-grid-left-sidebar.html">Jeans</a></li>
                                <li><a href="shop-grid-left-sidebar.html">Casual Dress</a></li>
                            </ul>
                        </li>
                        <li class="subhed position-relative"><a href="#0"> <span>accessories</span> <span
                            class="menuarrowtwo"> <i class="flaticon-next-1"></i> </span> </a>
                            <ul class="subdropdown">
                                <li><a href="shop-grid-left-sidebar.html">Latest Items </a></li>
                                <li><a href="shop-grid-left-sidebar.html">Quick Deal</a></li>
                                <li><a href="shop-grid-left-sidebar.html">Shoes Items</a></li>
                                <li><a href="shop-grid-left-sidebar.html">Hot Deal</a></li>
                                <li><a href="shop-grid-left-sidebar.html">Fast Services </a></li>
                            </ul>
                        </li>
                        <li class="subhed position-relative"><a href="#0"> <span>Discount</span> <span
                            class="menuarrowtwo"> <i class="flaticon-next-1"></i> </span> </a>
                            <ul class="subdropdown">
                                <li><a href="shop-grid-left-sidebar.html">10% Off</a></li>
                                <li><a href="shop-grid-left-sidebar.html">20% Off</a></li>
                                <li><a href="shop-grid-left-sidebar.html">30% Off</a></li>
                                <li><a href="shop-grid-left-sidebar.html">40% Off</a></li>
                                <li><a href="shop-list-left-sidebar.html">50% Off</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="dropdown-list"><a href="#0"> <span>Pages</span> <span class="menuarrow"> <i
                    class="flaticon-next-1"></i> </span> </a>
                    <ul class=" dropdown ">
                        <li><a href="about-us.html"> About Us </a></li>
                        <li><a href="cart.html"> Cart </a></li>
                        <li><a href="compare.html"> Compare </a></li>
                        <li><a href="wishlist.html"> Wishlist </a></li>
                        <li><a href="order-track.html"> Order Track </a></li>
                        <li><a href="my-account.html"> My Account </a></li>
                        <li><a href="faq.html"> FAQ </a></li>
                        <li><a href="error.html"> 404 </a></li>
                        <li><a href="shop-grid.html">Shop Grid </a></li>
                        <li><a href="shop-grid-left-sidebar.html"> Shop Grid Left Sidebar </a></li>
                        <li><a href="shop-grid-right-sidebar.html"> Shop Grid Right Sidebar </a></li>
                        <li><a href="shop-list-left-sidebar.html"> Shop List Left Sidebar </a></li>
                        <li><a href="shop-grid-right-sidebar.html"> Shop List Right Sidebar </a></li>
                    </ul>
                </li>
                <li class="dropdown-list"><a href="#0"> <span>Blogs </span> <span class="menuarrow"> <i
                    class="flaticon-next-1"></i> </span> </a>
                    <ul class=" dropdown ">
                        <li><a href="blog.html">Blog Single </a></li>
                        <li><a href="blog-single.html">Blog Details </a></li>
                    </ul>
                </li>
                <li><a href="contact.html">Contact </a></li>
                <template v-if="!accessToken">
                    <li>
                        <router-link :to="{name: 'users.login'}">Login</router-link>
                    </li>
                    <li>
                        <router-link :to="{name: 'users.register'}">Register</router-link>
                    </li>
                </template>
                <template v-else>
                    <li>
                        <router-link v-if="user" :to="{name: 'users.user', params: {id: user.id}}">Account</router-link>
                    </li>
                    <li>
                        <a @click.prevent="logoutHandler">Log Out</a>
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
