export type UserData = {
    first_name: string
    last_name: string
    gender: number
    address: string
    telephone: string
    email: string
    password: string
    confirm_password: string
}

export type GendersResponse = {
    data: string[]
}

export type SubmitFormResponse = {
    message: string
}
