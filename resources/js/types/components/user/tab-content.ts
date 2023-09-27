export type OrderProduct = {
    id: number
    title: string
    price: number
    image: {
        url: string
    }
}

export type ResponseOrderProduct = {
    data: OrderProduct[]
}
