<script setup>

defineProps({
    text: {
        type: String,
        required: true
    }
})

</script>

<template>
    <p class="text-xl text-black/70 dark:text-white/70 text-white">
        {{ text }}
    </p>
</template>

