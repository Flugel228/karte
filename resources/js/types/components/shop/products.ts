import {Meta, Product} from "../../views/shop";

export interface IEmit {
    'slidebarfilter'
}

export interface IProps {
    products: Product[]
    meta: Meta
    changePage: (page: number) => Promise<void>
}

