<template>
    <div class="bg-gray-100 h-full p-20">
        <div class="flex mb-8 justify-between items-center">
            <h2 class="text-2xl font-semibold ">Products</h2>
            <button type="button"
                @click="isProductModal=true"
                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Create new product
            </button>
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
import { ref } from 'vue';
import ProductsTable from '../Components/ProductsTable.vue';
import CreateProduct from '../Modals/CreateProduct.vue';
const isProductModal = ref(false)

</script>