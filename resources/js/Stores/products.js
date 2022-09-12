import { defineStore } from 'pinia'


export const useProducts = defineStore('products', {
    state: () => ({
        products: [],
        categories: []
    }),
    getters: {
        getCategoriesName(state) {
            return state.categories.map(el => el.name)
        }
    },
    actions: {
        mutate({ key, value }) {
            this[key] = value;
        },
    }
})