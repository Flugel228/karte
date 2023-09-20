export type UserData = {
    email: string
    password: string
}

export type SubmitFormResponse = {
    access_token: string
    token_type: string
    expires_in: number
}
