<script setup>

import Galleria from "primevue/galleria";
import {computed} from "vue";

const props = defineProps({
    images: Array
})

// console.log(props.images)


const galleryImages = computed(() => {
    if(!props.images.length) return [];

    return props.images.map(img => ({
        itemImageSrc: img.path,
        alt: img.id,
        thumbnailImageSrc: img.path
    }));
});

console.log(galleryImages.value)

</script>

<template>

    <div v-if="galleryImages.length" class="mt-2">
        <Galleria
            :value="galleryImages"
            :numVisible="5"
            containerStyle="max-width: 640px; border-radius: 12px; overflow: hidden;"
            style="max-width: 640px;"
            class="w-full"
        >
            <template #item="slotProps">
                <div
                    class="relative w-full"
                    style="height: 400px; background: #1a1a1a;"
                >
                    <img
                        :src="slotProps.item.itemImageSrc"
                        :alt="slotProps.item.alt"
                        class="w-full h-full object-contain"
                    />
                </div>
            </template>

            <template #thumbnail="slotProps">
                <div
                    class="w-20 h-20 overflow-hidden rounded-lg border-2 border-transparent hover:border-indigo-500 transition-colors"
                >
                    <img
                        :src="slotProps.item.thumbnailImageSrc"
                        :alt="slotProps.item.alt"
                        class="w-full h-full object-cover"
                    />
                </div>
            </template>
        </Galleria>
    </div>
</template>
