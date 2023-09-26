export interface IProps {
    errors?: string[]
    options: string[]
    name: string
    width?: string
    height?: string
}

export interface IEmit {
    'update:value': [value: string]
}

type Option = {
    id: number
    title: string
}
