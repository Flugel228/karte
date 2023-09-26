import {ProductComment} from "../../views/shop-details";

export interface IProps {
    description: string
    id: number
    productComments: ProductComment[]
    fetchProduct: (id: number | string) => Promise<void>
}
