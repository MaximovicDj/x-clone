<script setup>
import {computed, onMounted, ref} from 'vue'
import PostItem from "@/Components/Posts/PostItem.vue";

const props = defineProps({
    data: Object
})

</script>

<template>

    <div v-if="props.data.length">
        <div
            v-for="post in props.data"
            :key="post.id"
            class="border-b border-gray-800 p-4 hover:bg-white/5 transition-colors last:border-0"
        >
            <PostItem :post="post" />
        </div>
    </div>

</template>
