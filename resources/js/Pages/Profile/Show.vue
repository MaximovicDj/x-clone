<script setup>

import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {ref} from "vue";
import PostList from "@/Components/Posts/PostList.vue";

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
            <div class="flex items-center gap-4 mb-6">
                <div class="w-20 h-20 rounded-full bg-blue-500 flex items-center justify-center text-2xl font-bold text-white">
                    {{ userData.name.charAt(0) }}{{ userData.last_name.charAt(0) }}
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-white">{{ userData.name }} {{ userData.last_name }}</h1>
                    <p class="text-gray-400">{{ userData.email }}</p>
                </div>
            </div>

            <div class="mb-6">
                <p class="text-gray-300 leading-relaxed">{{ userData.bio || 'No bio yet.' }}</p>
            </div>

            <div class="flex gap-8 border-t border-gray-700 pt-4">
                <div>
                    <span class="text-gray-400 text-sm">Posts</span>
                    <p class="text-white font-semibold text-lg">{{ userData.posts_count }}</p>
                </div>
                <div>
                    <span class="text-gray-400 text-sm">Following</span>
                    <p class="text-white font-semibold text-lg">0</p>
                </div>
                <div>
                    <span class="text-gray-400 text-sm">Followers</span>
                    <p class="text-white font-semibold text-lg">0</p>
                </div>
            </div>

            <div class="mt-4 text-gray-400 text-sm">
                Joined {{ new Date(userData.created_at).toLocaleDateString('en-US', { month: 'long', year: 'numeric' }) }}
            </div>
        </div>

        <div v-if="showPosts" class="mt-8">
            <PostList :posts="props.posts"/>
        </div>

    </AuthenticatedLayout>
</template>
