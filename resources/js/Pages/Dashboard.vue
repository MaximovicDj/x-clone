<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import PostCreate from "@/Components/Posts/PostCreate.vue";
import PostList from "@/Components/Posts/PostList.vue";

const data = defineProps({
    posts: Object,
    tags: Object
})

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-8 bg-black/10 text-white">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <PostCreate :posts-tag="data.tags" />
            </div>

            <div class="border-t border-b border-gray-800 p-6 py-2 my-12">
                <PostList :data="data.posts.data"  />
            </div>

        </div>


    </AuthenticatedLayout>
</template>
