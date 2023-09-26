import {
    Actions,
    ActionsTypes,
    AugmentedActionContext,
    Category,
    CategoryResponse,
    Color,
    ColorResponse,
    Getters,
    GettersTypes,
    Links,
    Meta,
    Mutations,
    MutationsTypes, Prices, PricesResponse,
    Product,
    ProductBody,
    ProductResponse,
    State,
    Tag,
    TagResponse, Value
} from "../../types/store/modules/shop";
import {ActionTree, GetterTree, Module, MutationTree} from "vuex";
import {State as IRoot} from "../../types/store";
import axios from "axios";

// set state
const state: State = {
    products: null,
    links: null,
    meta: null,
    categories: null,
    colors: null,
    tags: null,
    prices: null,
    slideBarFilterIsActive: false,
    selectedCategories: [],
    selectedColors: [],
    selectedTags: [],
    selectedPrices: [],
    cartIsActive: false,
    title: ''
}

// set getters
const getters: GetterTree<State, IRoot> & Getters = {
    [GettersTypes.GET_PRODUCTS]: (state: State): null | Product[] => state.products,
    [GettersTypes.GET_LINKS]: (state: State): null | Links => state.links,
    [GettersTypes.GET_META]: (state: State): null | Meta => state.meta,
    [GettersTypes.GET_CATEGORIES]: (state: State): null | Category[] => state.categories,
    [GettersTypes.GET_COLORS]: (state: State): null | Color[] => state.colors,
    [GettersTypes.GET_TAGS]: (state: State): null | Tag[] => state.tags,
    [GettersTypes.GET_PRICES]: (state: State): null | Prices => state.prices,
    [GettersTypes.GET_SLIDE_BAR_FILTER_IS_ACTIVE]: (state: State): boolean => state.slideBarFilterIsActive,
    [GettersTypes.GET_SELECTED_CATEGORIES]: (state: State): number[] => state.selectedCategories,
    [GettersTypes.GET_SELECTED_COLORS]: (state: State): number[] => state.selectedColors,
    [GettersTypes.GET_SELECTED_TAGS]: (state: State): number[] => state.selectedTags,
    [GettersTypes.GET_SELECTED_PRICES]: (state: State): Value[] => state.selectedPrices,
    [GettersTypes.GET_CART_IS_ACTIVE]: (state: State): boolean => state.cartIsActive,
    [GettersTypes.GET_TITLE]: (state: State): string => state.title,
}

// set mutations
const mutations: MutationTree<State> & Mutations = {
    [MutationsTypes.SET_PRODUCTS]: (state: State, payload: Product[]): void => {
        state.products = payload;
    },
    [MutationsTypes.SET_LINKS]: (state: State, payload: Links): void => {
        state.links = payload;
    },
    [MutationsTypes.SET_META]: (state: State, payload: Meta): void => {
        state.meta = payload;
    },
    [MutationsTypes.SET_CATEGORIES]: (state: State, payload: Category[]): void => {
        state.categories = payload;
    },
    [MutationsTypes.SET_COLORS]: (state: State, payload: Color[]): void => {
        state.colors = payload;
    },
    [MutationsTypes.SET_TAGS]: (state: State, payload: Tag[]): void => {
        state.tags = payload;
    },
    [MutationsTypes.SET_PRICES]: (state: State, payload: Prices): void => {
        state.prices = payload;
    },
    [MutationsTypes.SWITCH_SLIDE_BAR_FILTER_IS_ACTIVE]: (state: State): void => {
        state.slideBarFilterIsActive = !state.slideBarFilterIsActive;
    },
    [MutationsTypes.PUSH_SELECTED_CATEGORY]: (state: State, payload: number): void => {
        state.selectedCategories.push(payload);
    },
    [MutationsTypes.DELETE_SELECTED_CATEGORY]: (state: State, payload: number): void => {
        const index = state.selectedCategories.indexOf(payload);
        state.selectedCategories.splice(index, 1);
    },
    [MutationsTypes.PUSH_SELECTED_COLOR]: (state: State, payload: number): void => {
        state.selectedColors.push(payload);
    },
    [MutationsTypes.DELETE_SELECTED_COLOR]: (state: State, payload: number): void => {
        const index = state.selectedColors.indexOf(payload);
        state.selectedColors.splice(index, 1);
    },
    [MutationsTypes.PUSH_SELECTED_TAG]: (state: State, payload: number): void => {
        state.selectedTags.push(payload);
    },
    [MutationsTypes.DELETE_SELECTED_TAG]: (state: State, payload: number): void => {
        const index = state.selectedTags.indexOf(payload);
        state.selectedTags.splice(index, 1);
    },
    [MutationsTypes.SET_SELECTED_PRICES]: (state: State, payload: Value[]): void => {
        state.selectedPrices = payload;
    },
    [MutationsTypes.SWITCH_CART_IS_ACTIVE]: (state: State): void => {
        state.cartIsActive = !state.cartIsActive;
    },
    [MutationsTypes.SET_TITLE]: (state: State, payload: string): void => {
        state.title = payload;
    }
}

// set actions
const actions: ActionTree<State, IRoot> & Actions = {
    [ActionsTypes.FETCH_PRODUCTS]: async ({commit, getters}: AugmentedActionContext, payload: number): Promise<void> => {
        try {
            const res = await axios.post<ProductResponse, axios.AxiosResponse<ProductResponse>, ProductBody>("/api/shop/products", {
                page: payload,
                category_ids: getters.GET_SELECTED_CATEGORIES,
                color_ids: getters.GET_SELECTED_COLORS,
                tag_ids: getters.GET_SELECTED_TAGS,
                prices: getters.GET_SELECTED_PRICES,
                title: getters.GET_TITLE,
            });
            commit(MutationsTypes.SET_PRODUCTS, res.data.data);
            commit(MutationsTypes.SET_LINKS, res.data.links);
            commit(MutationsTypes.SET_META, res.data.meta);
        } catch (e) {
            if (axios.isAxiosError(e)) {
                console.log(e.message, "err");
                console.log(e.response?.data.message, "error");
            } else if (e instanceof Error) {
                console.log(e.message);
            }
        }
    },
    [ActionsTypes.FETCH_CATEGORIES]: async ({commit}: AugmentedActionContext): Promise<void> => {
        try {
            const res = await axios.get<CategoryResponse>("/api/shop/categories");
            commit(MutationsTypes.SET_CATEGORIES, res.data.data);
        } catch (e) {
            if (axios.isAxiosError(e)) {
                console.log(e.message, "err");
                console.log(e.response?.data.message, "error");
            } else if (e instanceof Error) {
                console.log(e.message);
            }
        }
    },
    [ActionsTypes.FETCH_COLORS]: async ({commit}: AugmentedActionContext): Promise<void> => {
        try {
            const res = await axios.get<ColorResponse>("/api/shop/colors");
            commit(MutationsTypes.SET_COLORS, res.data.data);
        } catch (e) {
            if (axios.isAxiosError(e)) {
                console.log(e.message, "err");
                console.log(e.response?.data.message, "error");
            } else if (e instanceof Error) {
                console.log(e.message);
            }
        }
    },
    [ActionsTypes.FETCH_TAGS]: async ({commit}: AugmentedActionContext): Promise<void> => {
        try {
            const res = await axios.get<TagResponse>("/api/shop/tags");
            commit(MutationsTypes.SET_TAGS, res.data.data);
        } catch (e) {
            if (axios.isAxiosError(e)) {
                console.log(e.message, "err");
                console.log(e.response?.data.message, "error");
            } else if (e instanceof Error) {
                console.log(e.message);
            }
        }
    },
    [ActionsTypes.FETCH_PRICES]: async ({commit}: AugmentedActionContext): Promise<void> => {
        try {
            const res = await axios.get<PricesResponse>("/api/shop/prices");
            commit(MutationsTypes.SET_PRICES, res.data);
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

const module: Module<State, IRoot> = {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}

export default module;
