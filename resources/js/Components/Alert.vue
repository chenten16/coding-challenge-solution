<template>
    <div class="relative py-3 pl-4 pr-10 leading-normal text-red-700 bg-red-100 rounded-lg" role="alert">
        <div v-for="error in errorRows">
            <p>{{error}}</p>
        </div>

    </div>
</template>

<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
    errors: {
        type: Array,
        default: [],
    }
})

const errorRows = ref([])
watch(() => props.errors, () => {
    Object.keys(props.errors).forEach(key => {
        errorRows.value.push(...props.errors[key])
    })
});
</script>