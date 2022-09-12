<template>
    <div class="bg-gray-100 min-h-full p-20">
        <div class="flex mb-8 justify-between items-center">
            <h2 class="text-2xl font-semibold ">Products</h2>
            <div class="flex gap-5 items-center">
                <select
                    class="form-select appearance-none block w-[200px] px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    v-model="category">
                    <option value=""> --- Filter by category ---</option>
                    <option v-for="category in categories" :value="category.id">{{category.name}}</option>
                </select>
                <select
                    class="form-select appearance-none block w-[200px] px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    name="" id="" v-model="sort">
                    <option value="">--- Sort by price ---</option>
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>

                <button type="button" @click="isProductModal=true"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Create new product
                </button>
            </div>

        </div>
        <Suspense>
            <ProductsTable />
            <template #fallback>
                Loading...
            </template>
        </Suspense>
        <CreateProduct :open="isProductModal" @update:open="isProductModal = $event" />
    </div>

</template>
<script setup>
import { ref, watch } from 'vue';
import ProductsTable from '../Components/ProductsTable.vue';
import CreateProduct from '../Modals/CreateProduct.vue';
import { useProducts } from '../Stores/products';
import { storeToRefs } from 'pinia'
import { get } from '../Utils/api';

const productsStore = useProducts()
const { categories } = storeToRefs(productsStore)
const category = ref('')
const sort = ref('')
const isProductModal = ref(false)

const applyFilters = async () => {
    let endpoint = '/api/products?category={categoryId}&sort={sort}'
    endpoint = endpoint.replace('{categoryId}', category.value)
    endpoint = endpoint.replace('{sort}', sort.value)
    
    if (endpoint === '/api/products?category=&sort=') return

    const allProducts = await get(endpoint)
    productsStore.mutate({ key: 'products', value: allProducts })

}

watch(() => category.value, applyFilters);
watch(() => sort.value, applyFilters);
</script>