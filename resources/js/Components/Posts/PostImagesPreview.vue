<script setup>

import { onMounted} from "vue";

const props = defineProps({
    previews: {
        type: Array,
        default: () => []
    }
})

const emit = defineEmits([
    'remove'
])

onMounted(() => {
    // forEach - vidi svaki src i index
        props.previews.forEach((src, index) => {
            // console.log(src)
            // console.log(`Index ${index}:`, src)
            // console.log(`Slika ${index + 1}: ${src}`)
        })

    // Ili kroz for petlju
    // for (let i = 0; i < props.previews.length; i++) {
    //     console.log(`[${i}] = ${props.previews[i]}`)
    // }
    //
    // // Ili for...of sa indeksom
    // for (const [index, src] of props.previews.entries()) {
    //     console.log(`Entry ${index}:`, src)
    // }
})

</script>

<template>

    <div
        v-for="(src, index) in props.previews"
        :key="index"
        class="relative group aspect-square rounded-lg overflow-hidden bg-gray-800 border border-gray-700"
    >
        <img
            :src="typeof src === 'object' && src.link ? src.link : src"
            :alt="`Preview ${index + 1}`"
            class="w-full h-full object-cover"
        />

        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
            <button
                @click="emit('remove', index)"
                type="button"
                class="bg-red-600 hover:bg-red-700 text-white rounded-full p-1.5 transition-colors"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="absolute bottom-1 right-1 bg-black/70 text-white text-xs px-2 py-0.5 rounded-full">
            #{{ index + 1 }}
        </div>
    </div>

</template>
