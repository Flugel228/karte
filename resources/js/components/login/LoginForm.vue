<script setup lang="ts">
import {computed, reactive} from "vue";
import {SubmitFormResponse, UserData} from "../../types/components/login/login-form";
import {email, helpers, required} from "@vuelidate/validators";
import useVuelidate from "@vuelidate/core";
import axios from "axios";
import Input from "../inputs/Input.vue";
import {useRouter} from "vue-router";
import {useStore} from "vuex";

const store = useStore();
const router = useRouter();

const state = reactive<UserData>({
    email: '',
    password: ''
})

const rules = computed(() => ({
    email: {
        required: helpers.withMessage('Это поле обязательно для заполнения.', required),
        email: helpers.withMessage('Это поле должно содержать адрес электронной почты.', email)
    },
    password: {
        required: helpers.withMessage('Это поле обязательно к заполнению.', required),
    },
}));

const v$ = useVuelidate(rules, state);

const submitForm = async (): Promise<void> => {
    const isFormCorrect = await v$.value.$validate();

    if (isFormCorrect) {
        try {
            const res = await axios.post<SubmitFormResponse>('/api/users/auth/login', state);
            localStorage.setItem("access_token", res.data.access_token);
            store.commit("SET_ACCESS_TOKEN");
            await store.dispatch("FETCH_USER");
            await router.push({name: 'index'});
        } catch (e) {
            if (axios.isAxiosError(e)) {
                console.log(e.message, "err");
                console.log(e.response?.data.message, "error");
            } else if (e instanceof Error) {
                console.log(e.message);
            }
        }
    }
}
</script>

<template>
    <section class="login-page pt-120 pb-120 wow fadeInUp  animated"
             style="visibility: visible; animation-name: fadeInUp;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8 col-md-9">
                    <div class="login-register-form">
                        <div class="top-title text-center ">
                            <h2>Вход</h2>
                            <p>У вас еще нет аккаунта? <router-link :to="{name: 'users.register'}">Зарегестрироваться</router-link></p>
                        </div>
                        <form class="common-form">
                            <Input
                                :errors="v$.email.$errors"
                                type="email"
                                name="email"
                                placeholder="Ваш Email"
                                v-model:value="v$.email.$model"
                            />
                            <Input
                                :errors="v$.password.$errors"
                                type="password"
                                name="password"
                                placeholder="Ваш пароль"
                                v-model:value="v$.password.$model"
                            />
                            <div class="checkk ">
                                <div class="form-check p-0 m-0">
                                    <input type="checkbox" id="remember">
                                    <label class="p-0" for="remember">Запомнить меня</label>
                                </div>
                                <a href="#0" class="forgot"> Забыли пароль?</a>
                            </div>
                            <button
                                @click.prevent="submitForm"
                                type="submit"
                                class="btn--primary style2">Войти
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped lang="sass">
.login-register-form
    background: url('/public/assets/images/inner-pages/login-bg.png')
    background-size: 100% 100%
</style>
