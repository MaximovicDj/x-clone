<script setup>
import PostItem from "@/Components/Posts/PostItem.vue";
import {InfiniteScroll} from "@inertiajs/vue3";

const props = defineProps({
    posts: Object
})

</script>

<template>

    <InfiniteScroll data="posts" preserve-url only-next>
        <div
            v-for="post in props.posts.data"
            :key="post.id"
            class="border-b border-gray-800 p-4 hover:bg-white/5 transition-colors last:border-0"
        >
            <PostItem :post="post" />
        </div>
        <template #loading>
            <div class="border-b border-gray-800 p-4 hover:bg-white/5 transition-colors last:border-0 text-white">
                Loading more posts...
            </div>
        </template>
    </InfiniteScroll>

</template>
