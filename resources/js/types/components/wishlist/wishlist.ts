export type WishlistProduct = {
    id: number
    title: string
    price: number
    quantity: number
    image: Image
}

type Image = {
    id: number
    path: string
    url: string
}

export type WishlistResponse = WishlistProduct[]
