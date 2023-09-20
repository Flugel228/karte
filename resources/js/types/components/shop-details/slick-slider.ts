import {Image} from "../../views/shop-details";

export interface IProps {
    images: Image[]
    itemsToShow?: number
    wrapAround?: boolean
    width: string
    height: string
}
