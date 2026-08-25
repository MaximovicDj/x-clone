<script setup>

import {computed} from "vue";

const props = defineProps({
    previews: Array
})
const previewLength = computed(() => props.previews.length)

</script>

<template>
    <div v-if="previewLength" class="text-sm text-gray-400">
        {{ previewLength }} file{{ previewLength > 1 ? 's' : '' }} selected
    </div>
</template>
