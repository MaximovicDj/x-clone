<script setup>
import {computed, ref} from "vue";
import PostGallery from "@/Components/Posts/PostGallery.vue";
import PostAction from "@/Components/Posts/PostAction.vue";
import PostTagsItem from "@/Components/Posts/PostTagsItem.vue";
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    post: Object
})
const isExpanded = ref(false)

const shouldSlice = computed(() => {
    return props.post.content.length > 100;
})

const content = computed(() => {
    if(!shouldSlice) {
        return props.post.content;
    }

    return isExpanded.value ? props.post.content : props.post.content.slice(0, 100)
})

</script>

<template>
    <div class="flex gap-3">
        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center text-white font-bold">
            {{ props.post.user.name?.charAt(0).toUpperCase() }}
        </div>

        <div class="flex-1 min-w-0">
            <div class="flex items-center gap-2 mb-2">
                <span class="font-bold text-white hover:underline cursor-pointer">
                    <Link :href="route('profile.show', props.post.user.slug)">{{ props.post.user.name }}</Link>
                </span>
                <span class="text-sm text-gray-500">
                    {{ props.post.user.email }}
                </span>
                <span class="text-sm text-gray-500">
                    ·
                </span>
                <span class="text-sm text-gray-500">
                    {{ props.post.created_at }}
                </span>

                <div class="ml-auto">
                    <PostAction :post="props.post" />
                </div>

            </div>

            <p class="text-white leading-relaxed break-words mb-3">
                {{ content }}
                <span
                    v-if="shouldSlice"
                    @click="isExpanded = !isExpanded"
                    class="mt-1 text-sm font-medium text-blue-400 hover:text-blue-300 hover:underline transition-colors cursor-pointer"
                >
            {{ isExpanded ? '...less' : '...more' }}</span>
            </p>

            <div
                v-if="props.post.tags && props.post.tags.length"
                class="flex flex-wrap gap-2 mb-4"
            >
                <PostTagsItem :tags="props.post.tags" />
            </div>

            <PostGallery :images="props.post.images" />
        </div>
    </div>
</template>
