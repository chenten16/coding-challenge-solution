<template>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs  font-bold text-black uppercase tracking-wider">
                                    Image</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs  font-bold text-black uppercase tracking-wider">
                                    Name</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs  font-bold text-black uppercase tracking-wider">
                                    Description</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs  font-bold text-black uppercase tracking-wider">
                                    Price</th>


                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="product in products">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <img :src="`/storage/${product.image}`" class="h-12" alt="" srcset="">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{product.name}}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{product.description}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${{product.price}}</td>

                            </tr>

                            <!-- More people... -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { get } from '../Utils/api';
import { useProducts } from '../Stores/products';
import { storeToRefs } from 'pinia'

const productsStore = useProducts()
const { products } = storeToRefs(productsStore)

const allProducts = await get('/api/products')
productsStore.mutate({ key: 'products', value: allProducts })

const allCategories = await get('/api/categories')

productsStore.mutate({ key: 'categories', value: allCategories })

</script>