<template>
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div v-show="open" class=" absolute inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50 ">
                <div class="max-w-2xl p-6 bg-white rounded-md shadow-xl">
                    <div class="flex items-center justify-between">
                        <h3 class="text-2xl">Add product</h3>
                        <span class="text-xl cursor-pointer" @click="$emit('update:open', false)">x</span>
                    </div>
                    <alert v-show="Object.keys(errors).length>0" class="my-5" :errors="errors" />
                    <div class="mt-4">
                        <form ref="form" @submit="onSubmit" id="productForm" action="#" class="w-[500px]" method="POST">
                            <div class="mb-5">
                                <label for="image" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Image
                                </label>
                                <input type="file" required name="image" @change="onFileChange($event)"
                                    accept="image/png, image/jpeg" />
                            </div>
                            <div class="mb-5">
                                <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Name
                                </label>
                                <input type="text" required v-model="name" name="name" placeholder="Product name"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                            </div>
                            <div class="mb-5">
                                <label for="description" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Description
                                </label>
                                <textarea rows="4" required v-model="description" name="description"
                                    placeholder="Product description"
                                    class="w-full resize-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Categories
                                </label>
                                <v-select multiple v-model="selected" :options="getCategoriesName" />
                            </div>
                            <div class="mb-5">
                                <label for="price" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Price
                                </label>
                                <input type="number" required v-model="price" name="price" placeholder="Product price"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                            </div>


                        </form>
                        <div class="flex gap-3 justify-end">
                            <button type="button" @click="$emit('update:open', false)"
                                class="inline-flex items-center px-4 py-2  rounded-md shadow-sm text-sm font-medium text-indigo-600  focus:outline-none focus:ring-2 focus:ring-offset-2 border border-indigo-600">
                                Cancel
                            </button>
                            <button v-if="isSubmitting" form="productForm" disabled
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Save
                            </button>
                            <button v-else form="productForm"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Save
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, watch } from 'vue';
import { useProducts } from '../Stores/products';
import { storeToRefs } from 'pinia'
import { post } from '../Utils/api';
import Alert from '../Components/Alert.vue';

const emit = defineEmits(["update"]);
const productsStore = useProducts()
const { getCategoriesName, categories, products } = storeToRefs(productsStore)

const props = defineProps({
    open: {
        type: Boolean,
        default: false,
    }
})
const name = ref('')
const description = ref('')
const price = ref(0)
const file = ref(null)
const form = ref(null)
const selected = ref(null)
const isSubmitting = ref(false)
const errors = ref([])
const onFileChange = (e) => {
    const files = e.target.files || e.dataTransfer.files;
    file.value = files[0]
}
const onSubmit = (e) => {
    e.preventDefault()
    isSubmitting.value = true
    const formData = new FormData(form.value)

    // for (const name of selected.value) {
    //     const catId = categories.value.find(x => x.name === name)?.id
    //     formData.append('categories[]', catId);
    // }

    post('/api/products/create', formData).then(product => {
        products.value.unshift(product)
    }).finally(() => {
        isSubmitting.value = false
    }).catch(error => {
        errors.value = error.response.data.errors
    })
}
watch(() => props.open, () => {
    name.value = ''
    description.value = ''
    price.value = 0
    file.value = null
    selected.value = null
    form.value.reset()
})
</script>
  