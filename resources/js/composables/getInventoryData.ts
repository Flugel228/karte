import axios from "axios";
import {
    Category,
    CategoryResponse,
    Color,
    ColorResponse,
    Links,
    Meta,
    Product,
    ProductBody,
    ProductResponse,
    Tag, TagResponse
} from "../types/views/shop";
import {ref} from "vue";

export const getInventoryData = () => {

    // reactive variables
    const products = ref<null | Product[]>();
    const links = ref<null | Links>();
    const meta = ref<null | Meta>();
    const categories = ref<null | Category[]>();
    const colors = ref<null | Color[]>();
    const tags = ref<null | Tag[]>();


    // functions
    const getProducts = async (page: number): Promise<void> => {
        try {
            const res = await axios.post<ProductResponse, axios.AxiosResponse<ProductResponse>, ProductBody>("/api/shop/products", {
                page
            });
            products.value = res.data.data;
            links.value = res.data.links;
            meta.value = res.data.meta;
        } catch (e) {
            if (axios.isAxiosError(e)) {
                console.log(e.message, "err");
                console.log(e.response?.data.message, "error");
            } else if (e instanceof Error) {
                console.log(e.message);
            }
        }
    }

    const getCategories = async (): Promise<void> => {
        try {
            const res = await axios.get<CategoryResponse>("api/shop/categories");
            categories.value = res.data.data
        } catch (e) {
            if (axios.isAxiosError(e)) {
                console.log(e.message, "err");
                console.log(e.response?.data.message, "error");
            } else if (e instanceof Error) {
                console.log(e.message);
            }
        }
    }

    const getColors = async (): Promise<void> => {
        try {
            const res = await axios.get<ColorResponse>("api/shop/colors");
            colors.value = res.data.data
        } catch (e) {
            if (axios.isAxiosError(e)) {
                console.log(e.message, "err");
                console.log(e.response?.data.message, "error");
            } else if (e instanceof Error) {
                console.log(e.message);
            }
        }
    }

    const getTags = async (): Promise<void> => {
        try {
            const res = await axios.get<TagResponse>("api/shop/tags");
            tags.value = res.data.data
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

