import {Meta} from "../../views/shop";

export interface IProps {
    meta: Meta
    changePage: (page: number) => Promise<void>
}
