export type Product = {
    "id": number
    "title": string
    "description": string
    "price": number
    "quantity": number
    "category": string
    "images": Image[]
    "colors": Color[]
    "tags": Tag[]
    "likedUsers": LikedUser[]
    "productComments": ProductComment[]
}

export type RecentProduct = {
    id: number
    title: string
    price: number
    category: string
    image: RecentProductImage
}

export type Image = {
    "id": number
    "path": string
    "url": string
    "pivot": {
        "product_id": number
        "image_id": number
    }
}

type Color = {
    "id": number
    "title": string
    "code": string
}

type Tag = {
    "id": number
    "title": string
}

type LikedUser = {
    "id": number
}

export type ProductComment = {
    "user": CommentedUser
    "title": string
    "comment": string
    "rate": number
    "date": string
}

type CommentedUser = {
    "first_name": string
    "last_name": string
}

type RecentProductImage = {
    id: number
    path: string
    url: string
    pivot: {
        product_id: number
        image_id: number
    }
}

export type ProductResponse = {
    "data": Product
}

export type RecentProductResponse = {
    "data": RecentProduct[]
}
