import {Category, Color, Tag} from "../../views/shop";

export interface IProps {
    isActive: boolean
    categories: Category[]
    colors: Color[]
    tags: Tag[]
}

export interface IEmit {
    'slidebarfilter'
}
