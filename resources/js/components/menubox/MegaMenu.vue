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
                        <li class="dropdown-list"><a href="#0"> <span>Home</span> <span class="menuarrow"> <i
                            class="flaticon-down-arrow"></i> </span> </a>
                            <ul class="dropdown">
                                <li><a href="index.html">Home Page 01 <sup class="info three">Popular</sup></a>
                                </li>
                                <li><a href="index-2.html">Home Page 02 <sup class="info one">Hot</sup></a>
                                </li>
                                <li><a href="index-3.html">Home Page 03 </a></li>
                                <li><a href="index-4.html">Home Page 04 </a></li>
                                <li><a href="index-5.html">Home Page 05 <sup class="info two">New</sup></a>
                                </li>
                                <li><a href="index-6.html">Home Page 06 <sup class="info one">New</sup></a>
                                </li>
                                <li><a href="index-7.html">Home Page 07 <sup class="info three">New</sup></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <router-link :to="{name: 'shop'}">
                                <span>{{ $t('app.menubox.megaMenu.shop')}} </span>
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
                                                        <li><a href="shop-details-1.html">Product Style 1 </a>
                                                        </li>
                                                        <li><a href="shop-details-2.html">Product Style 2 </a>
                                                        </li>
                                                        <li><a href="shop-details-3.html">Product Style 3 </a>
                                                        </li>
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
                                                        <li><a href="shop-list-left-sidebar.html">Shop list</a>
                                                        </li>
                                                        <li><a href="shop-grid-right-sidebar.html">Shop 2 colums
                                                        </a></li>
                                                        <li><a href="shop-grid-left-sidebar.html">Shop 3 colums
                                                        </a></li>
                                                        <li><a href="shop-grid.html">Shop 4 colums</a></li>
                                                        <li><a href="shop-grid-left-sidebar.html">Shop Grid Left
                                                            Sidebar </a></li>
                                                        <li><a href="shop-grid-right-sidebar.html">Shop Grid
                                                            Right Sidebar</a></li>
                                                        <li><a href="shop-list-left-sidebar.html">Shop List Left
                                                            Sidebar</a></li>
                                                        <li><a href="shop-list-right-sidebar.html">Shop List
                                                            Right Sidebar</a></li>
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
                                                        <li><a href="order-track.html">Order Track </a></li>
                                                        <li><a href="my-account.html">My Account </a></li>
                                                        <li><a href="blog.html">Blog</a></li>
                                                        <li><a href="blog-single.html">Blog Single</a></li>
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
                                                    src="../../../../public/assets/images/menu/mega-menu.jpg" alt="">
                                                </a>
                                                    <a href="shop-details-1.html" class="title d-block">
                                                        <h6> Super Comfort Sofa </h6>
                                                    </a> <a href="shop-details-1.html" class="price">$250.00</a>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-7">
                                                <div class="offer">
                                                    <h6>Discount</h6>
                                                    <ul>
                                                        <li><a href="shop-grid.html"> <span>%</span> 30% Off
                                                            Everything! </a></li>
                                                        <li><a href="shop-grid-left-sidebar.html">
                                                            <span>%</span> Get an Extra 20% Off Sale! Use
                                                            Code: Sale </a></li>
                                                        <li><a href="shop-grid-right-sidebar.html">
                                                            <span>%</span> Flash Sale Offers </a></li>
                                                        <li><a href="shop-grid.html"> <span>%</span> Flash Sale
                                                            Offers </a></li>
                                                        <li><a href="shop-grid-left-sidebar.html">
                                                            <span>%</span> 30% Off Everything! </a></li>
                                                        <li><a href="shop-grid-right-sidebar.html">
                                                            <span>%</span> Flash Sale Offers </a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown-list"><a href="#0"> <span>Blogs </span> <span class="menuarrow"> <i
                            class="flaticon-down-arrow"></i> </span> </a>
                            <ul class="dropdown">
                                <li><a href="blog.html">All Blog Posts</a></li>
                                <li><a href="blog-single.html">Blog Details</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-list"><a href="#0"> <span>Pages </span> <span class="menuarrow"> <i
                            class="flaticon-down-arrow"></i> </span> </a>
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
</template>

<style scoped lang="sass">
.mega-menu
    li
            span
                font-size: 16px
                color: var(--thm-black)
                transition: 0.25s
                &:hover
                    color: var(--thm-gray)
                    transition: 0.5s
</style>
