<script setup lang="ts">
import {GendersResponse, SubmitFormResponse, UserData} from "../../types/components/register/register-form";
import {computed, onMounted, reactive, ref} from "vue";
import {between, email, helpers, maxLength, minLength, numeric, required, sameAs} from "@vuelidate/validators";
import {address, letters, requiredContainNumbers, telephone} from "../../types/validation";
import useVuelidate from "@vuelidate/core";
import Input from "../inputs/Input.vue";
import Select from "../inputs/Select.vue";
import CheckBox from "../inputs/CheckBox.vue";
import axios from "axios";

const genders = ref<string[]>();

const state = reactive<UserData>({
    first_name: '',
    last_name: '',
    gender: 0,
    address: '',
    telephone: '',
    email: '',
    password: '',
    confirm_password: '',
});

const rememberCheckBox = ref<boolean>(false);

const rules = computed(() => ({
    first_name: {
        required: helpers.withMessage('Это поле обязательно к заполнению.', required),
        maxLength: helpers.withMessage('Максимально допустимая длина 255 символов.', maxLength(255)),
        letters: helpers.withMessage('Это поле должно содержать только буквы.', letters),
    },
    last_name: {
        required: helpers.withMessage('Это поле обязательно к заполнению.', required),
        maxLength: helpers.withMessage('Максимально допустимая длина 255 смволов.', maxLength(255)),
        letters: helpers.withMessage('Это поле должно содержать только буквы.', letters),
    },
    gender: {
        required: helpers.withMessage('Это поле обязательно к заполнению.', required),
        between: helpers.withMessage('', between(0,1)),
        numeric: helpers.withMessage('', numeric),
    },
    address: {
        required: helpers.withMessage('Это поле обязательно к заполнению.', required),
        address: helpers.withMessage('Это поле должно содержать адресс.', address),
    },
    telephone: {
        required: helpers.withMessage('Это поле обязательно к заполнению.', required),
        telephone: helpers.withMessage('Это поле должно содержать номер телефона.', telephone),
    },
    email: {
        required: helpers.withMessage('Это поле обязательно к заполнению.', required),
        email: helpers.withMessage('Это поле должно содержать адрес электронной почты.', email)
    },
    password: {
        required: helpers.withMessage('Это поле обязательно к заполнению.', required),
        minLength: helpers.withMessage('Минимально допустимая длина 8 символов.', minLength(8)),
        maxLength: helpers.withMessage('Максимально допустимая длина 32 символа.', maxLength(32)),
        requiredContainNumbers: helpers.withMessage('Это поле должно содержать хотя бы одно число.', requiredContainNumbers),
    },
    confirm_password: {
        required: helpers.withMessage('Это поле обязательно к заполнению.', required),
        sameAs: helpers.withMessage('Значение поля должно соответствовать паролю.', sameAs(state.password)),
    },
}));

const v$ = useVuelidate(rules, state);

onMounted(async (): Promise<void> => {
    await fetchGenders();
});

const fetchGenders = async (): Promise<void> => {
    try {
        const res = await axios.get<GendersResponse>(`/api/users/genders`);
        genders.value = res.data.data
    } catch (e) {
        if (axios.isAxiosError(e)) {
            console.log(e.message, "err");
            console.log(e.response?.data.message, "error");
        } else if (e instanceof Error) {
            console.log(e.message);
        }
    }
}

const submitForm = async (): Promise<void> => {
    const isFormCorrect = await v$.value.$validate();

    if (isFormCorrect) {
        try {
            const res = await axios.post<SubmitFormResponse>('/api/users/', state);
            alert(res.data.message)
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
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-8 col-md-9 wow fadeInUp  animated"
             style="visibility: visible; animation-name: fadeInUp;">
            <div class="login-register-form">
                <div class="top-title text-center ">
                    <h2>Регистрация</h2>
                    <p>Уже есть аккаунт? <router-link :to="{name: 'users.login'}">Войти</router-link></p>
                </div>
                <form class="common-form">
                    <Input
                        :errors="v$.first_name.$errors"
                        name="first_name"
                        placeholder="Введите имя"
                        v-model:value="v$.first_name.$model"
                    />
                    <Input
                        :errors="v$.last_name.$errors"
                        name="last_name"
                        placeholder="Введите фамилию"
                        v-model:value="v$.last_name.$model"
                    />
                    <Select
                        v-if="genders"
                        :errors="v$.gender.$errors"
                        name="gender"
                        :options="genders"
                    />
                    <Input
                        :errors="v$.address.$errors"
                        name="address"
                        placeholder="Великобритания, Лондон, Бейкер-стрит 228"
                        v-model:value="v$.address.$model"
                    />
                    <Input
                        :errors="v$.telephone.$errors"
                        name="telephone"
                        type="tel"
                        placeholder="+375293457483"
                        v-model:value="v$.telephone.$model"
                    />
                    <Input
                        :errors="v$.email.$errors"
                        name="email"
                        type="email"
                        placeholder="example@example.com"
                        v-model:value="v$.email.$model"
                    />
                    <Input
                        :errors="v$.password.$errors"
                        name="password"
                        type="password"
                        placeholder="Введите пароль"
                        v-model:value="v$.password.$model"
                    />
                    <Input
                        :errors="v$.confirm_password.$errors"
                        name="confirm_password"
                        type="password"
                        placeholder="Повторите пароль"
                        v-model:value="v$.confirm_password.$model"
                    />
                    <button
                        @click.prevent="submitForm"
                        type="submit"
                        class="btn--primary style2"
                    >Register</button>
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped lang="sass">
.login-register-form
    background: url('/public/assets/images/inner-pages/login-bg.png')
    background-size: 100% 100%
</style>
