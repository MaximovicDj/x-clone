<script setup>

import {Link} from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import LeftNav from "@/Layouts/LeftNav.vue";
</script>

<template>
    <div class="h-screen overflow-y-auto border-r border-gray-800 px-4 sticky top-0">
        <div class="flex flex-col h-full py-4">
            <!-- Logo -->
            <div class="mb-6 px-3">
                <Link :href="route('dashboard')">
                    <ApplicationLogo class="block h-8 w-auto fill-current text-white" />
                </Link>
            </div>
            <LeftNav />
        </div>
    </div>
</template>

