// declare state
import {ActionContext} from "vuex";

export type State = {
    products: null | Product[]
    links: null | Links
    meta: null | Meta
    categories: null | Category[]
    colors: null | Color[]
    tags: null | Tag[]
    prices: null | Prices
    slideBarFilterIsActive: boolean
    selectedCategories: number[]
    selectedColors: number[]
    selectedTags: number[]
    selectedPrices: Value[]
    cartIsActive: boolean
    title: string
}

// getters enum
export enum GettersTypes {
    GET_PRODUCTS = "GET_PRODUCTS",
    GET_LINKS = "GET_LINKS",
    GET_META = "GET_META",
    GET_CATEGORIES = "GET_CATEGORIES",
    GET_COLORS = "GET_COLORS",
    GET_TAGS = "GET_TAGS",
    GET_PRICES = "GET_PRICES",
    GET_SLIDE_BAR_FILTER_IS_ACTIVE = "GET_SLIDE_BAR_FILTER_IS_ACTIVE",
    GET_SELECTED_CATEGORIES = "GET_SELECTED_CATEGORIES",
    GET_SELECTED_COLORS = "GET_SELECTED_COLORS",
    GET_SELECTED_TAGS = "GET_SELECTED_TAGS",
    GET_SELECTED_PRICES = "GET_SELECTED_PRICES",
    GET_CART_IS_ACTIVE = "GET_CART_IS_ACTIVE",
    GET_TITLE = "GET_TITLE",
}

// mutations enum
export enum MutationsTypes {
    SET_PRODUCTS = "SET_PRODUCTS",
    SET_LINKS = "SET_LINKS",
    SET_META = "SET_META",
    SET_CATEGORIES = "SET_CATEGORIES",
    SET_COLORS = "SET_COLORS",
    SET_TAGS = "SET_TAGS",
    SET_PRICES = "SET_PRICES",
    SWITCH_SLIDE_BAR_FILTER_IS_ACTIVE = "SWITCH_SLIDE_BAR_FILTER_IS_ACTIVE",
    PUSH_SELECTED_CATEGORY = "PUSH_SELECTED_CATEGORY",
    DELETE_SELECTED_CATEGORY = "DELETE_SELECTED_CATEGORY",
    PUSH_SELECTED_COLOR = "PUSH_SELECTED_COLOR",
    DELETE_SELECTED_COLOR = "DELETE_SELECTED_COLOR",
    PUSH_SELECTED_TAG = "PUSH_SELECTED_TAG",
    DELETE_SELECTED_TAG = "DELETE_SELECTED_TAG",
    SET_SELECTED_PRICES = "SET_SELECTED_PRICES",
    SWITCH_CART_IS_ACTIVE = "SWITCH_CART_IS_ACTIVE",
    SET_TITLE = "SET_TITLE",
}

// actions enum
export enum ActionsTypes {
    FETCH_PRODUCTS = "FETCH_PRODUCTS",
    FETCH_CATEGORIES = "FETCH_CATEGORIES",
    FETCH_COLORS = "FETCH_COLORS",
    FETCH_TAGS = "FETCH_TAGS",
    FETCH_PRICES = "FETCH_PRICES",
}

// Getters types
export type Getters<S = State> = {
    [GettersTypes.GET_PRODUCTS](state: S): null | Product[]
    [GettersTypes.GET_LINKS](state: S): null | Links
    [GettersTypes.GET_META](state: S): null | Meta
    [GettersTypes.GET_CATEGORIES](state: S): null | Category[]
    [GettersTypes.GET_COLORS](state: S): null | Color[]
    [GettersTypes.GET_TAGS](state: S): null | Tag[]
    [GettersTypes.GET_PRICES](state: S): null | Prices
    [GettersTypes.GET_SLIDE_BAR_FILTER_IS_ACTIVE](state: S): boolean
    [GettersTypes.GET_SELECTED_CATEGORIES](state: S): number[]
    [GettersTypes.GET_SELECTED_COLORS](state: S): number[]
    [GettersTypes.GET_SELECTED_TAGS](state: S): number[]
    [GettersTypes.GET_SELECTED_PRICES](state: S): Value[]
    [GettersTypes.GET_CART_IS_ACTIVE](state: S): boolean
    [GettersTypes.GET_TITLE](state: S): string
}

// Mutations types
export type Mutations<S = State> = {
    [MutationsTypes.SET_PRODUCTS](state: S, payload: Product[]): void
    [MutationsTypes.SET_LINKS](state: S, payload: Links): void
    [MutationsTypes.SET_META](state: S, payload: Meta): void
    [MutationsTypes.SET_CATEGORIES](state: S, payload: Category[]): void
    [MutationsTypes.SET_COLORS](state: S, payload: Color[]): void
    [MutationsTypes.SET_TAGS](state: S, payload: Tag[]): void
    [MutationsTypes.SET_PRICES](state: S, payload: Prices): void
    [MutationsTypes.SWITCH_SLIDE_BAR_FILTER_IS_ACTIVE](state: S): void
    [MutationsTypes.PUSH_SELECTED_CATEGORY](state: S, payload: number): void
    [MutationsTypes.DELETE_SELECTED_CATEGORY](state: S, payload: number): void
    [MutationsTypes.PUSH_SELECTED_COLOR](state: S, payload: number): void
    [MutationsTypes.DELETE_SELECTED_COLOR](state: S, payload: number): void
    [MutationsTypes.PUSH_SELECTED_TAG](state: S, payload: number): void
    [MutationsTypes.DELETE_SELECTED_TAG](state: S, payload: number): void
    [MutationsTypes.SET_SELECTED_PRICES](state: S, payload: Value[]): void
    [MutationsTypes.SWITCH_CART_IS_ACTIVE](state: S): void
    [MutationsTypes.SET_TITLE](state: S, payload: string): void
}

// actions
export type AugmentedActionContext = {
    commit<K extends keyof Mutations>(
        key: K,
        payload: Parameters<Mutations[K]>[1]
    ): ReturnType<Mutations[K]>
} & Omit<ActionContext<State, State>, "commit">

// actions interface
export interface Actions {
    [ActionsTypes.FETCH_PRODUCTS](
        {commit, getters}: AugmentedActionContext,
        payload: number
    ): Promise<void>

    [ActionsTypes.FETCH_CATEGORIES](
        {commit}: AugmentedActionContext
    ): Promise<void>

    [ActionsTypes.FETCH_COLORS](
        {commit}: AugmentedActionContext
    ): Promise<void>

    [ActionsTypes.FETCH_TAGS](
        {commit}: AugmentedActionContext
    ): Promise<void>

    [ActionsTypes.FETCH_PRICES](
        {commit}: AugmentedActionContext
    ): Promise<void>
}

export type Product = {
    id: number
    title: string
    description: string
    price: number
    category: string
    images: Image[]
    colors: Color[]
    likedUsers: {id: number}[]
}

export type Color = {
    id: number
    title: string
    code: string
}

type Image = {
    id: number
    path: string
    url: string
    pivot: {
        product_id: number
        image_id: number
    }
}

export type Links = {
    first: string
    last: string
    prev: null | string
    next: null | string
}

export type Meta = {
    current_page: number
    from: number
    last_page: number
    links: Link[]
    path: string
    per_page: number
    to: number
    total: number
}

type Link = {
    url: null | string
    label: string
    active: boolean
}

export type Category = {
    id: number
    title: string
}

export type Tag = {
    id: number
    title: string
}


export type Prices = {
    min: number
    max: number
}

export type Value = number | string

export type ProductBody = {
    page: number
}

export type ProductResponse = {
    data: Product[]
    links: Links
    meta: Meta
}

export type CategoryResponse = {
    data: Category[]
}

export type ColorResponse = {
    data: Color[]
}

export type TagResponse = {
    data: Tag[]
}

export type PricesResponse = {
    min: number
    max: number
}
