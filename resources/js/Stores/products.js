import { defineStore } from 'pinia'


export const useProducts = defineStore('products', {
    state: () => ({
        products: []
    }),
    actions: {
        mutate({ key, value }) {
            this[key] = value;
        },
    }
})