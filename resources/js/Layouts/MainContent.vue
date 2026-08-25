<script setup>

</script>

<template>
    <div class="min-h-screen border-r border-gray-800">
        <div class="sticky top-0 z-10 bg-black/80 backdrop-blur-md border-b border-gray-800 px-4 py-3">
            <h1 class="text-xl font-bold text-white">Home</h1>
        </div>

        <!-- Scrollable content -->
        <div class="pb-4">
            <slot />
        </div>
    </div>
</template>
