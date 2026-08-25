<script setup>

const props = defineProps({
    tags: {
        type: Object,
        required: true
    }
});

</script>

<template>
    <span
        v-for="tag in props.tags"
        :key="tag.id"
        class="inline-flex items-center rounded-full bg-gray-800 px-3 py-1 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors cursor-pointer"
    >
        #{{ tag.name }}
    </span>
</template>
