import {cartProduct, User} from "../types/store";
import api from "../axios/api";
import axios from "axios";
import {OrderProductBody} from "../types/components/cart";
import {computed, ref, Ref} from "vue";
import store from "../store";
import router from "../router";


export default (): {
    checkoutBtn: Ref<null | HTMLLinkElement>,
    toOrderProduct: () => Promise<void>
} => {
    // computed variables
    const user = computed((): null | User => store.getters["GET_USER"]);
    const cart = computed((): null | cartProduct[] => store.getters["GET_CART_PRODUCTS"]);

// refs
    const checkoutBtn = ref<null | HTMLLinkElement>();

// methods
    const toOrderProduct = async (redirect: boolean = false): Promise<void> => {
        try {
            checkoutBtn.value.disabled = true;
            if (user) {
                let productIds = [];
                cart.value.forEach((element: cartProduct) => {
                    for (let i = 0; i < element.quantity; i++)
                    productIds.push(element.id);
                })
                await api.post<null, axios.AxiosResponse<null>, OrderProductBody>('api/users/auth/products/orders', {
                    product_ids: productIds
                });
                localStorage.removeItem('cart');
                store.commit("SET_CART_PRODUCTS");
                if (redirect) {
                    await router.push({name: 'shop'});
                }

            } else {
                await router.push({name: 'users.login'});
            }
            checkoutBtn.value.disabled = false;
        } catch (e) {
            if (axios.isAxiosError(e)) {
                console.log(e.message, "err");
                console.log(e.response?.data.message, "error");
            } else if (e instanceof Error) {
                console.log(e.message);
            }
        }
    }
    return {
        checkoutBtn,
        toOrderProduct
    }
}
