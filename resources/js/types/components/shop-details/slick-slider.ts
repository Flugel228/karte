import {Image} from "../../views/shop-details";

export interface IProps {
    images: Image[]
    autoplay: number
    wrapAround?: boolean
    width: string
    height: string
}
