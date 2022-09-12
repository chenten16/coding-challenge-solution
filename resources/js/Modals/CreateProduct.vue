<template>
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div v-show="open" class=" absolute inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50 ">
                <div class="max-w-2xl p-6 bg-white rounded-md shadow-xl">
                    <div class="flex items-center justify-between">
                        <h3 class="text-2xl">Add product</h3>
                        <span class="text-xl">x</span>
                    </div>
                    <div class="mt-4">
                        <form action="#" class="w-[500px]" method="POST">
                            <div class="mb-5">
                                <label for="image" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Image
                                </label>
                                <input type="file" name="image" accept="image/png, image/jpeg" />
                            </div>
                            <div class="mb-5">
                                <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Name
                                </label>
                                <input type="text" name="name" placeholder="Product name"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                            </div>
                            <div class="mb-5">
                                <label for="description" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Description
                                </label>
                                <textarea rows="4" name="message" id="message" placeholder="Product description"
                                    class="w-full resize-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"></textarea>
                            </div>
                            <div class="mb-5">
                                <label for="price" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Price
                                </label>
                                <input type="number" name="price" placeholder="Product price"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                            </div>

                            <div>

                            </div>
                        </form>
                        <div class="flex gap-3 justify-end">
                            <button type="button" @click="$emit('update:open', false)"
                                class="inline-flex items-center px-4 py-2  rounded-md shadow-sm text-sm font-medium text-indigo-600  focus:outline-none focus:ring-2 focus:ring-offset-2 border border-indigo-600">
                                Cancel
                            </button>
                            <button type="button"
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
const emit = defineEmits(["update"]);

const props = defineProps({
    open: {
        type: Boolean,
        default: false,
    }
})


</script>
  