// declare state
import {ActionContext} from "vuex";

export type State = {
    version: string
    mobileMenuIsActive: boolean
    sidebarContentIsActive: boolean
    accessToken: null | string
    user: null | User
    cartProducts: null | cartProduct[]

}

// getters enum
export enum GettersTypes {
    GET_VERSION = "GET_VERSION",
    GET_MOBILE_MENU_IS_ACTIVE = "GET_MOBILE_MENU_IS_ACTIVE",
    GET_SIDEBAR_CONTENT_IS_ACTIVE = "GET_SIDEBAR_CONTENT_IS_ACTIVE",
    GET_ACCESS_TOKEN = "GET_ACCESS_TOKEN",
    GET_USER = "GET_USER",
    GET_CART_PRODUCTS = "GET_CART_PRODUCTS",
    GET_QUANTITY_OF_CART_PRODUCTS = "GET_QUANTITY_OF_CART_PRODUCTS",
    GET_TOTAL_PRICE = "GET_TOTAL_PRICE",
}

// mutations enum
export enum MutationsTypes {
    SWITCH_MOBILE_MENU_IS_ACTIVE = "SWITCH_MOBILE_MENU_IS_ACTIVE",
    SWITCH_SIDEBAR_CONTENT_IS_ACTIVE = "SWITCH_SIDEBAR_CONTENT_IS_ACTIVE",
    SET_ACCESS_TOKEN = "SET_ACCESS_TOKEN",
    SET_USER = "SET_USER",
    SET_CART_PRODUCTS = "SET_CART_PRODUCTS",
}

// actions enum
export enum ActionsTypes {
    FETCH_USER = "FETCH_USER",
}

// Getters types
export type Getters<S = State> = {
    [GettersTypes.GET_VERSION](state: S): string
    [GettersTypes.GET_MOBILE_MENU_IS_ACTIVE](state: S): boolean
    [GettersTypes.GET_SIDEBAR_CONTENT_IS_ACTIVE](state: S): boolean
    [GettersTypes.GET_ACCESS_TOKEN](state: S): null | string
    [GettersTypes.GET_USER](state: S): null | User
    [GettersTypes.GET_CART_PRODUCTS](state: S): null | cartProduct[]
    [GettersTypes.GET_QUANTITY_OF_CART_PRODUCTS](state: S): number
    [GettersTypes.GET_TOTAL_PRICE](state: S): number
}

// Mutations types
export type Mutations<S = State> = {
    [MutationsTypes.SWITCH_MOBILE_MENU_IS_ACTIVE](state: S): void
    [MutationsTypes.SWITCH_SIDEBAR_CONTENT_IS_ACTIVE](state: S): void
    [MutationsTypes.SET_ACCESS_TOKEN](state: S): void
    [MutationsTypes.SET_USER](state: S, payload: null | User): void
    [MutationsTypes.SET_CART_PRODUCTS](state: S): void
}

export type AugmentedActionContext = {
    commit<K extends keyof Mutations>(
        key: K,
        payload: Parameters<Mutations[K]>[1]
    ): ReturnType<Mutations[K]>
} & Omit<ActionContext<State, State>, "commit">

export interface Actions {
    [ActionsTypes.FETCH_USER](
        {commit, getters}: AugmentedActionContext
    ): Promise<void>
}


export type User = {
    id: number
    first_name: string
    last_name: string
    role: number
    gender: number
    address: string
    telephone: string
    email: string
    email_verified_at: string
    created_at: string
    updated_at: string
}

export type GetUserResponse = User

export type cartProduct = {
    id: number
    title: number
    image: {
        url: string
    }
    price: number
    quantity: number
}
