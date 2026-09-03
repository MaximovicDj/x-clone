<script setup>

const props = defineProps({
    user: Object
})

</script>

<template>
    <div class="flex items-center gap-4 mb-6">
        <div class="w-20 h-20 rounded-full bg-blue-500 flex items-center justify-center text-2xl font-bold text-white">
            {{ user.name.charAt(0) }}{{ user.last_name.charAt(0) }}
        </div>
        <div>
            <h1 class="text-2xl font-bold text-white">{{ user.name }} {{ user.last_name }}</h1>
            <p class="text-gray-400">{{ user.email }}</p>
        </div>
    </div>

    <div class="mb-6">
        <p class="text-gray-300 leading-relaxed">{{ user.bio || 'No bio yet.' }}</p>
    </div>

    <div class="flex gap-8 border-t border-gray-700 pt-4">
        <div>
            <span class="text-gray-400 text-sm">Posts</span>
            <p class="text-white font-semibold text-lg">{{ user.posts_count }}</p>
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
        Joined {{ new Date(user.created_at).toLocaleDateString('en-US', { month: 'long', year: 'numeric' }) }}
    </div>
</template>
