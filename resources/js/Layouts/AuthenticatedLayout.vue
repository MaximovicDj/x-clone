<script setup>
import LeftSidebar from "@/Layouts/LeftSidebar.vue";
import RightSidebar from "@/Layouts/RightSidebar.vue";

</script>

<template>
    <div class="bg-black min-h-screen">
        <div class="hidden lg:grid lg:grid-cols-[256px_1fr_320px] max-w-[1280px] mx-auto">

            <!-- Left sidebar, navigation -->
            <LeftSidebar />

            <!-- Middle - main content -->
            <div class="min-h-screen border-r border-gray-800">
<!--                TODO For you Page and Following-->
                <div class="sticky top-0 z-10 bg-black/80 backdrop-blur-md border-b border-gray-800 px-4 py-3">
<!--                    <h1 class="text-xl font-bold text-white">For you</h1>-->
                </div>

                <!-- Scrollable content -->
                <div class="pb-4">
                    <slot />
                </div>
            </div>

            <!-- Right sidebar -->
            <RightSidebar />
        </div>
    </div>
</template>
