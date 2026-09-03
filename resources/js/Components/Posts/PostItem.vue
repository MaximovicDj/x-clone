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

const isLiked = ref(props.post.is_liked)

const likePost = async () => {
    isLiked.value = !isLiked.value;
    try {
        const response = await axios.post(`api/like-post/${props.post.id}`)
        isLiked.value = response.data.liked
        props.post.likes_count = response.data.likedCount
    }
    catch (error) {
        isLiked.value = !isLiked.value;
        console.log(error)
    }
}

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

            <div @click="likePost()"
                class="flex mt-2">
                <svg v-if="!isLiked"
                    width="24" height="24" viewBox="0 0 24 24" fill="black" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12 21s-8-4.35-10.5-9.5C-0.5 6.5 3 3 7 3c2.2 0 4 1.2 5 3 1-1.8 2.8-3 5-3 4 0 7.5 3.5 5.5 8.5C20 16.65 12 21 12 21Z"
                        stroke="white"
                        stroke-width="1.5"
                        stroke-linejoin="round"
                    />
                </svg>

                <svg v-if="isLiked"
                    width="24" height="24" viewBox="0 0 24 24" fill="#ef6b6b" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12 21s-8-4.35-10.5-9.5C-0.5 6.5 3 3 7 3c2.2 0 4 1.2 5 3 1-1.8 2.8-3 5-3 4 0 7.5 3.5 5.5 8.5C20 16.65 12 21 12 21Z"
                        stroke="#ef6b6b"
                        stroke-width="1.5"
                        stroke-linejoin="round"
                    />
                </svg>
                <span class="ml-2">
                    <span>{{ post.likes_count }}</span>
                </span>
            </div>

        </div>
    </div>
</template>
