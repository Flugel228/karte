import {Product} from "../../views/shop";

export interface IProps {
    products: Product[]
}

export type LikeClickBody = {
    product_id: number
}
