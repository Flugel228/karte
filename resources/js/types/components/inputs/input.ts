export interface IProps {
    errors?: string[]
    value?: string
    name: string
    type?: string
    placeholder: string
    width?: string
}

export interface IEmit {
    'update:value': [value: string]
}
