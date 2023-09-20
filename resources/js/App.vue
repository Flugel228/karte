<script setup lang="ts">
import MegaMenu from "./components/menubox/MegaMenu.vue";
import MainMenu from "./components/menubox/MainMenu.vue";
import MobileMenu from "./components/menubox/MobileMenu.vue";
import SidebarContent from "./components/SidebarContent.vue";
import Cart from "./components/Cart.vue";
import {computed, onMounted} from "vue";
import {useStore} from "vuex";

const store = useStore();
const user = computed(() => store.getters["GET_USER"]);

onMounted(async (): Promise<void> => {
    store.commit("SET_ACCESS_TOKEN");
    await store.dispatch("FETCH_USER");
});
</script>

<template>
    <!-- ==========Preloader========== -->
    <div class="loader"><span>Karte...</span></div>
    <!-- ==========Preloader========== -->
    <!--===scroll bottom to top===-->
    <a href="#0" class="scrollToTop"><i class="flaticon-up-arrow"></i></a>
    <!--===scroll bottom to top===-->

    <!-- header-default start -->
    <header class="header-default">
        <!-- Start Desktop Menu -->
        <div class="menubox">
            <div class="top-info d-flex">
                <div class="container">
                    <div class="row g-0 ">
                        <div class="col-12">
                            <div class="top-info__top-content d-flex align-items-center justify-content-between">
                                <div class="medio-boxx">
                                    <ul>
                                        <li><a href="https://www.facebook.com/" target="_blank"><i
                                            class="flaticon-facebook-app-symbol"></i></a></li>
                                        <li><a href="https://www.youtube.com/" target="_blank"><i
                                            class="flaticon-youtube"></i></a></li>
                                        <li><a href="https://twitter.com/" target="_blank"><i
                                            class="flaticon-twitter"></i></a></li>
                                        <li><a href="https://www.instagram.com/" target="_blank"><i
                                            class="flaticon-instagram"></i></a></li>
                                    </ul>
                                </div>
                                <a href="#0" class="international-shopping d-lg-block d-none "> FREE SHIPPING OVER
                                    $200. INTERNATIONAL SHIPPING AVAILABLE. </a>
                                <div class=" d-flex align-items-center ">
                                    <div class="language currency"><select style="display: none;">
                                        <option>USD</option>
                                        <option value="1">INR</option>
                                        <option value="2">BDT</option>
                                    </select>
                                        <div class="nice-select" tabindex="0"><span class="current">USD</span>
                                            <ul class="list">
                                                <li data-value="USD" class="option selected">USD</li>
                                                <li data-value="1" class="option">INR</li>
                                                <li data-value="2" class="option">BDT</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="language"><select style="display: none;">
                                        <option>ENGLISH</option>
                                        <option value="1">GERMAN</option>
                                        <option value="4">FRENCH</option>
                                    </select>
                                        <div class="nice-select" tabindex="0"><span class="current">ENGLISH </span>
                                            <ul class="list">
                                                <li data-value="ENGLISH" class="option selected">ENGLISH</li>
                                                <li data-value="1" class="option">GERMAN</li>
                                                <li data-value="4" class="option">FRENCH</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <mobile-menu/>
            <main-menu/>
            <mega-menu/>
        </div>
        <div class="sticy-header">
            <div class="mobile-menu d-lg-none d-block ">
                <div class="mobile-menu__menu-top border-bottom-0">
                    <div class="container ">
                        <div class="row">
                            <div class="menu-info d-flex justify-content-between align-items-center">
                                <div class="menubar"><span></span> <span></span> <span></span></div>
                                <a href="index.html" class="logo"> <img src="assets/images/logo/logo.png" alt=""> </a>
                                <div class="cart-holder">
                                    <a href="#0" class="cart cart-icon position-relative">
                                        <i class="flaticon-shopping-cart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container position-relative  d-lg-block d-none ">
                <div class="d-flex align-items-center justify-content-between"><a href="index.html" class="logo me-2">
                    <img src="assets/images/logo/logo.png" alt=""> </a>
                    <div class="mega-menu-default mega-menu d-lg-block d-none">
                        <div class="container ">
                            <div class="row">
                                <nav>
                                    <ul class="page-dropdown-menu d-flex align-items-center justify-content-center">
                                        <li class="dropdown-list"><a href="#0"> <span>Home</span> <span
                                            class="menuarrow"> <i class="flaticon-down-arrow"></i> </span> </a>
                                            <ul class="dropdown">
                                                <li><a href="index.html">Home Page 01 <sup
                                                    class="info three">Popular</sup></a></li>
                                                <li><a href="index-2.html">Home Page 02 <sup class="info one">Hot</sup></a>
                                                </li>
                                                <li><a href="index-3.html">Home Page 03 </a></li>
                                                <li><a href="index-4.html">Home Page 04 </a></li>
                                                <li><a href="index-5.html">Home Page 05 <sup class="info two">New</sup></a>
                                                </li>
                                                <li><a href="index-6.html">Home Page 06 <sup class="info one">New</sup></a>
                                                </li>
                                                <li><a href="index-7.html">Home Page 07 <sup
                                                    class="info three">New</sup></a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <router-link :to="{name: 'shop'}">
                                                <span>Shop </span>
                                            </router-link>
                                        </li>
                                        <li class="dropdown-list megamenu "><a href="#0"> <span>Features </span> <span
                                            class="menuarrow"> <i class="flaticon-down-arrow"></i> </span> </a>
                                            <div class="dropdown megamenu-dropdown">
                                                <div class="row g-0">
                                                    <div class="col-xl-6 col-lg-7 megamenu-padding-one">
                                                        <div class="row g-0">
                                                            <div class="col-lg-4">
                                                                <div class="megamenu-box one">
                                                                    <h6>Home Pages</h6>
                                                                    <ul class="megamenu-list">
                                                                        <li><a href="index.html">Home Page 01</a></li>
                                                                        <li><a href="index-2.html">Home Page 02</a></li>
                                                                        <li><a href="index-3.html">Home Page 03</a></li>
                                                                        <li><a href="index-4.html">Home Page 04</a></li>
                                                                        <li><a href="shop-details-1.html">Product Style
                                                                            1 </a></li>
                                                                        <li><a href="shop-details-2.html">Product Style
                                                                            2 </a></li>
                                                                        <li><a href="shop-details-3.html">Product Style
                                                                            3 </a></li>
                                                                        <li><a href="contact.html">Contact </a></li>
                                                                        <li><a href="faq.html">FAQ</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="megamenu-box one">
                                                                    <h6>Shop Pages</h6>
                                                                    <ul class="megamenu-list">
                                                                        <li><a href="shop-grid.html">Shop Grid </a></li>
                                                                        <li><a href="shop-list-left-sidebar.html">Shop
                                                                            list</a></li>
                                                                        <li><a href="shop-grid-right-sidebar.html">Shop
                                                                            2 colums </a></li>
                                                                        <li><a href="shop-grid-left-sidebar.html">Shop 3
                                                                            colums </a></li>
                                                                        <li><a href="shop-grid.html">Shop 4 colums</a>
                                                                        </li>
                                                                        <li><a href="shop-grid-left-sidebar.html">Shop
                                                                            Grid Left Sidebar </a></li>
                                                                        <li><a href="shop-grid-right-sidebar.html">Shop
                                                                            Grid Right Sidebar</a></li>
                                                                        <li><a href="shop-list-left-sidebar.html">Shop
                                                                            List Left Sidebar</a></li>
                                                                        <li><a href="shop-list-right-sidebar.html">Shop
                                                                            List Right Sidebar</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="megamenu-box four">
                                                                    <h6>Others Pages</h6>
                                                                    <ul class="megamenu-list">
                                                                        <li><a href="cart.html">Cart </a></li>
                                                                        <li><a href="compare.html">Compare </a></li>
                                                                        <li><a href="wishlist.html">Wishlist </a></li>
                                                                        <li><a href="order-track.html">Order Track </a>
                                                                        </li>
                                                                        <li><a href="my-account.html">My Account </a>
                                                                        </li>
                                                                        <li><a href="blog.html">Blog</a></li>
                                                                        <li><a href="blog-single.html">Blog Single</a>
                                                                        </li>
                                                                        <li><a href="login.html">Login</a></li>
                                                                        <li><a href="register.html">Register</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-5 megamenu-padding background">
                                                        <div class="row g-0">
                                                            <div class="col-xl-6 col-lg-5">
                                                                <div class="content"><a href="shop-details-1.html"
                                                                                        class="thumb d-block"> <img
                                                                    src="assets/images/menu/mega-menu.jpg" alt=""> </a>
                                                                    <a href="shop-details-1.html" class="title d-block">
                                                                        <h6> Super Comfort Sofa </h6>
                                                                    </a> <a href="shop-details-1.html" class="price">$250.00</a>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-6 col-lg-7">
                                                                <div class="offer">
                                                                    <h6>Discount</h6>
                                                                    <ul>
                                                                        <li><a href="shop-grid.html"> <span>%</span> 30%
                                                                            Off Everything! </a></li>
                                                                        <li><a href="shop-grid-left-sidebar.html">
                                                                            <span>%</span> Get an Extra 20% Off
                                                                            Sale! Use Code: Sale </a></li>
                                                                        <li><a href="shop-grid-right-sidebar.html">
                                                                            <span>%</span> Flash Sale Offers </a>
                                                                        </li>
                                                                        <li><a href="shop-grid.html"> <span>%</span>
                                                                            Flash Sale Offers </a></li>
                                                                        <li><a href="shop-grid-left-sidebar.html">
                                                                            <span>%</span> 30% Off Everything! </a>
                                                                        </li>
                                                                        <li><a href="shop-grid-right-sidebar.html">
                                                                            <span>%</span> Flash Sale Offers </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="dropdown-list"><a href="#0"> <span>Blogs </span> <span
                                            class="menuarrow"> <i class="flaticon-down-arrow"></i> </span> </a>
                                            <ul class="dropdown">
                                                <li><a href="blog.html">All Blog Posts</a></li>
                                                <li><a href="blog-single.html">Blog Details</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-list"><a href="#0"> <span>Pages </span> <span
                                            class="menuarrow"> <i class="flaticon-down-arrow"></i> </span> </a>
                                            <ul class="dropdown">
                                                <li><a href="about-us.html">About Us </a></li>
                                                <li><a href="contact.html">Contact</a></li>
                                                <li><a href="faq.html">FAQ</a></li>
                                                <li><a href="order-track.html">Order_Track</a></li>
                                                <li><a href="my-account.html">My_Account</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-list"><a href="contact.html">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="side-cart-closer"></div>
        <Cart/>
        <sidebar-content/>
    </header>

    <main class="overflow-hidden">
        <router-view/>
    </main>

    <footer class="footer-default footer-style-1">
        <!--Start Footer-->
        <div class="footer-default__main-footer position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mt-30 wow fadeInUp  animated"
                         style="visibility: visible; animation-name: fadeInUp;">
                        <div class="footer-default__single-box">
                            <div class="company-info">
                                <div class="footer-logo"><a href="index.html"> <img src="assets/images/logo/logo-2.png"
                                                                                    alt=""> </a></div>
                                <div class="text1">
                                    <p>Orchestrate maintainable mindshare through equity invested action items.
                                        Compellingly procrastinate...</p>
                                </div>
                                <div class="newsletter-bottom d-flex align-items-center">
                                    <ul class="footer__medio-boxx  medio-boxx  two d-flex align-items-center">
                                        <li><a href="https://www.facebook.com/" target="_blank" class="active"><i
                                            class="flaticon-facebook-app-symbol"></i></a></li>
                                        <li><a href="https://www.youtube.com/" target="_blank"><i
                                            class="flaticon-youtube"></i></a></li>
                                        <li><a href="https://twitter.com/" target="_blank"><i
                                            class="flaticon-twitter"></i></a></li>
                                        <li><a href="https://www.instagram.com/" target="_blank"><i
                                            class="flaticon-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mt-30 wow fadeInUp  animated"
                         style="visibility: visible; animation-name: fadeInUp;">
                        <div class="footer-default__single-box">
                            <div class="footer-title">
                                <h4> Useful Links </h4>
                            </div>
                            <ul class="footer-links">
                                <li
                                    v-if="user"
                                >
                                    <router-link :to="{name: 'users.user', params: {id: user.id}}">Аккаунт
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{name: 'users.login'}">Вход</router-link>
                                </li>
                                <li><a href="cart.html">Корзина</a></li>
                                <li
                                    v-if="user"
                                ><router-link :to="{name: 'users.user.wishlist', params: {id: user.id}}">Список понравившегося</router-link></li>
                                <li><a href="compare.html">Сравнивать покупки</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mt-30 wow fadeInUp  animated"
                         style="visibility: visible; animation-name: fadeInUp;">
                        <div class="footer-default__single-box">
                            <div class="footer-title">
                                <h4> Information </h4>
                            </div>
                            <ul class="footer-links">
                                <li><a href="about-us.html">About us</a></li>
                                <li><a href="contact.html">Contact Us </a></li>
                                <li><a href="faq.html">Faq</a></li>
                                <li><a href="blog.html">Latest Posts</a></li>
                                <li><a href="order-track.html">Order Track</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mt-30 wow fadeInUp  animated"
                         style="visibility: visible; animation-name: fadeInUp;">
                        <div class="footer-default__single-box">
                            <div class="footer-title">
                                <h4> Office </h4>
                            </div>
                            <div class="footer-address-box ">
                                <div class="text1 pt-3">
                                    <p>29 Holles Place, Dublin 2 D02 YY46</p>
                                </div>
                                <div class="text2">
                                    <p>68 Jay Street, Suite 902 New Side <br> Brooklyn, NY 11201</p>
                                </div>
                                <div class="text3">
                                    <p>New York, United States</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- footer-bottom Footer-->
        <div class="footer_bottom position-relative">
            <div class="container">
                <div class="footer_bottom_content">
                    <div class="copyright wow fadeInUp  animated"
                         style="visibility: visible; animation-name: fadeInUp;">
                        <p>© 2022 <a href="index.html">Karte.</a> All Rights Reserved.</p>
                    </div>
                    <div class="footer-payment wow fadeInUp  animated"
                         style="visibility: visible; animation-name: fadeInUp;"><a href="#0"> <img
                        src="assets/images/payment_method/payment_1.png" alt="payment"> </a> <a href="#0"> <img
                        src="assets/images/payment_method/payment_2.png" alt="payment"> </a> <a href="#0"> <img
                        src="assets/images/payment_method/payment_3.png" alt="payment"> </a> <a href="#0"> <img
                        src="assets/images/payment_method/payment_4.png" alt="payment"> </a></div>
                    <div class="footer-bottom-menu wow fadeInUp  animated"
                         style="visibility: visible; animation-name: fadeInUp;">
                        <ul class="d-flex align-items-center">
                            <li><a href="contact.html">Sitemap</a></li>
                            <li><a href="contact.html">Terms of Service</a></li>
                            <li><a href="contact.html">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<style scoped>

</style>
