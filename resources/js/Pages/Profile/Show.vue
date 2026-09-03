<script setup>

import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {ref} from "vue";
import PostList from "@/Components/Posts/PostList.vue";
import ProfileInfo from "@/Pages/Profile/Partials/ProfileInfo.vue";

const props = defineProps({
    user: Object,
    posts: Object
})

const userData = props.user.data;


const showProfile = ref(true)
const showPosts = ref(false)

</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <div class="border-b border-gray-200 dark:border-gray-700">
            <div class="flex">
                <button
                    @click="showPosts = false; showProfile = true"
                    class="flex-1 px-4 py-4 font-semibold text-gray-500 hover:bg-gray-200 dark:hover:bg-gray-700 transition relative">
                    Profile
                    <span v-if="showProfile" class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-16 h-1 bg-blue-500 rounded-full"></span>
                </button>
                <button
                    @click="showPosts = true; showProfile = false"
                    class="flex-1 px-4 py-4 text-center font-semibold text-gray-500 hover:bg-gray-200 dark:hover:bg-gray-700 transition relative">
                    Posts
                    <span v-if="showPosts" class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-16 h-1 bg-blue-500 rounded-full"></span>
                </button>
            </div>
        </div>

        <div v-if="showProfile" class="max-w-4xl mx-auto px-4 py-10">
            <ProfileInfo :user="userData" />
        </div>

        <div v-if="showPosts" class="mt-8">
            <PostList :posts="props.posts"/>
        </div>

    </AuthenticatedLayout>
</template>
