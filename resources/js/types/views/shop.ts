export type ProductResponse = {
    data: Product[]
    links: Links
    meta: Meta
}

export type CategoryResponse = {
    data: Category[]
}

export type ColorResponse = {
    data: Color[]
}

export type TagResponse = {
    data: Tag[]
}

export type Product = {
    id: number
    title: string
    description: string
    price: number
    category: string
    images: Image[]
    colors: Color[]
    likedUsers: {id: number}[]
}

export type Category = {
    id: number
    title: string
}

export type Color = {
    id: number
    title: string
    code: string
}

export type Tag = {
    id: number
    title: string
}

export type Image = {
    id: number
    path: string
    url: string
    pivot: {
        product_id: number
        image_id: number
    }
}

export type Meta = {
    current_page: number
    from: number
    last_page: number
    links: Link[]
    path: string
    per_page: number
    to: number
    total: number
}

export type Link = {
    url: null | string
    label: string
    active: boolean
}

export type Links = {
    first: string
    last: string
    prev: null | string
    next: null | string
}

export type ProductBody = {
    page: number
}
