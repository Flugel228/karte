import {ActionTree, createLogger, createStore, GetterTree, MutationTree} from "vuex";
import {
    ActionsTypes, AugmentedActionContext,
    Getters,
    GettersTypes, GetUserResponse,
    Mutations,
    MutationsTypes,
    State,
    User,
    Actions, cartProduct
} from "../types/store";
import shop from "./modules/shop";
import api from "../axios/api";

const state: State = {
    version: "4.0.2",
    mobileMenuIsActive: false,
    sidebarContentIsActive: false,
    accessToken: null,
    user: null,
    cartProducts: null
}

const getters: GetterTree<State, State> & Getters = {
    [GettersTypes.GET_VERSION]: (state: State): string => state.version,
    [GettersTypes.GET_MOBILE_MENU_IS_ACTIVE]: (state: State): boolean => state.mobileMenuIsActive,
    [GettersTypes.GET_SIDEBAR_CONTENT_IS_ACTIVE]: (state: State): boolean => state.sidebarContentIsActive,
    [GettersTypes.GET_ACCESS_TOKEN]: (state: State): null | string => state.accessToken,
    [GettersTypes.GET_USER]: (state: State): null | User => state.user,
    [GettersTypes.GET_CART_PRODUCTS]: (state: State): null | cartProduct[] => state.cartProducts,
    [GettersTypes.GET_QUANTITY_OF_CART_PRODUCTS]: (state: State): number => {
        let qty = 0;
        if (state.cartProducts) {
            state.cartProducts.forEach((product: cartProduct) => {
                qty += product.quantity;
            });
        }

        return qty;
    },
    [GettersTypes.GET_TOTAL_PRICE]: (state: State): number => {
        let price = 0;
        if (state.cartProducts) {
            state.cartProducts.forEach((product: cartProduct) => {
                price += product.price * product.quantity;
            });
        }
        return price
    }
}

const mutations: MutationTree<State> & Mutations = {
    [MutationsTypes.SWITCH_MOBILE_MENU_IS_ACTIVE]: (state: State): void => {
        state.mobileMenuIsActive = !state.mobileMenuIsActive;
    },
    [MutationsTypes.SWITCH_SIDEBAR_CONTENT_IS_ACTIVE]: (state: State): void => {
        state.sidebarContentIsActive = !state.sidebarContentIsActive;
    },
    [MutationsTypes.SET_ACCESS_TOKEN]: (state: State): void => {
        state.accessToken = localStorage.getItem('access_token');
    },
    [MutationsTypes.SET_USER]: (state: State, payload: null | User): void => {
        state.user = payload;
    },
    [MutationsTypes.SET_CART_PRODUCTS]: (state: State): void => {
        state.cartProducts = JSON.parse(localStorage.getItem('cart'));
    }
}

const actions: ActionTree<State, State> & Actions = {
    [ActionsTypes.FETCH_USER]: async ({commit, getters}: AugmentedActionContext): Promise<void> => {
        const res = await api.post<GetUserResponse>('/api/users/auth/me');
        commit("SET_USER", res.data);
    },
}

const store = createStore<State>({
    state,
    getters,
    mutations,
    actions,
    modules: {
        shop
    },
    plugins: [createLogger()],
});

export default store;
