export interface IProps {
    length: number
    rate: number
    showCount?: boolean
    changeRate: (number: number) => void
}
