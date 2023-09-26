<script setup lang="ts">
import {useStore} from "vuex";
import {computed} from "vue";

const store = useStore();

const isActive = computed(() => store.getters["GET_SIDEBAR_CONTENT_IS_ACTIVE"])

const closeSidebar = () => store.commit("SWITCH_SIDEBAR_CONTENT_IS_ACTIVE");
</script>

<template>
    <div
        :class="{
            'sidebar-content-closer': true,
            'active': isActive
        }"
    ></div>
    <div
        :class="{
            'sidebar-content': true,
            'active': isActive
        }"
    >
        <div class="sidebar-widget-container">
            <div class="widget-heading d-flex justify-content-end align-content-center">
                <span
                    class="close-side-widget"
                    @click="closeSidebar"
                >X</span></div>
            <div class="sidebar-textwidget">
                <div class="sidebar-info-contents">
                    <div class="content-inner">
                        <div class="logo"><a href="index.html"><img src="assets/images/logo/logo-2.png" alt=""></a>
                        </div>
                        <div class="content-box">
                            <h4>About Us</h4>
                            <div class="inner-text">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
                            </div>
                        </div>
                        <div class="form_inner">
                            <h4>Support</h4>
                            <form action="index.html" method="post">
                                <div class="form-group mt-4"><input type="text" name="name" placeholder="Name"
                                                                    required=""></div>
                                <div class="form-group mt-4"><input type="email" name="email" placeholder="Email"
                                                                    required=""></div>
                                <div class="form-group mt-4"><textarea name="message"
                                                                       placeholder="Message..."></textarea></div>
                                <div class="form-group message-btn mt-4">
                                    <button type="submit" class="btn--secondary"><span class="txt">Submit Now</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="sidebar-contact-info">
                            <h4>Contact Info</h4>
                            <ul>
                                <li><span class="flaticon-pin-1"></span> New York, United States</li>
                                <li><span class="flaticon-telephone"></span> <a href="tel:+44203700001">+44 123 456
                                    789</a></li>
                                <li><span class="flaticon-mail"></span> <a href="mailto:info@example.com">info@example.com</a>
                                </li>
                            </ul>
                        </div>
                        <div class="thm-medio-boxx1">
                            <ul class="social-box">
                                <li class="facebook"><a href="https://www.facebook.com/" target="_blank"><i
                                    class="flaticon-facebook-app-symbol"></i></a></li>
                                <li class="twitter"><a href="https://twitter.com/" target="_blank"><i
                                    class="flaticon-twitter"></i></a></li>
                                <li class="instagram"><a href="https://www.instagram.com/" target="_blank"><i
                                    class="flaticon-instagram"></i></a></li>
                                <li class="youtube"><a href="https://www.youtube.com/" target="_blank"><i
                                    class="flaticon-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
