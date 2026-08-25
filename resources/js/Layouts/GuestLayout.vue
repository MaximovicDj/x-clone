<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>

    <div class="bg-black/100">
        <div class="relative flex min-h-screen flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <main class="min-h-[80vh] flex items-center justify-center px-6">
                <div class="grid w-full max-w-6xl grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <slot />
                </div>
            </main>
        </div>
    </div>

</template>
