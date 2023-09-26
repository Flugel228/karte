import {Product} from "../types/views/shop";
import {WishlistProduct} from "../types/components/wishlist/wishlist"
import store from "../store";

export default (product: Product | WishlistProduct, quantity: number = null) => {
        const cart: string = localStorage.getItem('cart');
        let newProduct: cartProduct | null = null;
        if ('description' in product) {
             newProduct = {
                id: product.id,
                title: product.title,
                image: {
                    url: product.images[0].url
                },
                price: product.price,
                quantity: !quantity ? 1 : quantity
            };
        } else {
             newProduct = {
                id: product.id,
                title: product.title,
                image: {
                    url: product.image.url
                },
                price: product.price,
                quantity: !quantity ? 1 : quantity
            };
        }
        if (!cart) {
            localStorage.setItem('cart', JSON.stringify([newProduct]));
            store.commit("SET_CART_PRODUCTS");
        } else {
            let parsedCart: object[] = JSON.parse(cart);
            parsedCart.forEach((productInCart: object): void => {
                if (productInCart.id === product.id) {
                    if (quantity) {
                        productInCart.quantity += quantity;
                    } else {
                        productInCart.quantity += 1;
                    }
                    newProduct = null;
                }
            })
            if (newProduct) {
                parsedCart.push(newProduct)
            }
            localStorage.setItem('cart', JSON.stringify(parsedCart))
            store.commit("SET_CART_PRODUCTS");
        }
}

type cartProduct = {
    id: number
    title: string
    image: {
        url: string
    },
    price: number
    quantity: number
}
