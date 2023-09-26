import api from "../axios/api";
import {LikeClickBody} from "../types/components/shop/tab-content";
import axios from "axios";
import store from "../store";
import {computed} from "vue";
import {Meta} from "../types/store/modules/shop";

const meta = computed((): Meta => store.getters["shop/GET_META"]);

export default async (id: number) => {
    try {
        await api.post<any, any, LikeClickBody>("/api/users/auth/products/likes", {
            product_id: id
        });
        await store.dispatch("shop/FETCH_PRODUCTS", meta.value.current_page);
    } catch (e) {
        if (axios.isAxiosError(e)) {
            console.log(e.message, "err");
            console.log(e.response?.data.message, "error");
        } else if (e instanceof Error) {
            console.log(e.message);
        }
    }
}
