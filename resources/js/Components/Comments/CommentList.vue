<script setup>

import CommentItem from "@/Components/Comments/CommentItem.vue";
import CreateComment from "@/Components/Comments/CreateComment.vue";

const props = defineProps({
    comments: {
        type: Array,
        default: () => []
    },
    postId: Number,
    nextPageUrl: {
        type: String,
        default: null
    },
    loading: Boolean
})

const emit = defineEmits([
    'load-more',
    'comment-deleted',
    'comment-created'
])

const loadMore = () => {
    if(!props.nextPageUrl || props.loading) return
    emit('load-more', props.nextPageUrl)
}

const deleteComment = (id) => {
    emit('comment-deleted', id)
}

const handleCommentCreated = () => {
    emit('comment-created')
}

</script>

<template>
    <div class="mt-4 space-y-4">

        <CreateComment
            :postId="props.postId"
            @comment-created="handleCommentCreated"
        />

        <div v-if="props.comments.length">
            <div
                v-for="comment in props.comments"
                :key="comment.id"
                class="bg-gray-800/50 rounded-lg p-4 border border-gray-700/50"
            >
                <CommentItem
                    :comment="comment"
                    @deleted="deleteComment"
                />
            </div>
        </div>

        <div v-if="props.nextPageUrl" class="flex justify-center mt-4">
            <span
                @click="loadMore"
                :class="[
                    'text-sm text-gray-500 hover:text-blue-400 cursor-pointer transition-colors',
                    props.loading && 'pointer-events-none'
                ]"
            >
                {{ props.loading ? 'Loading...' : 'Load more comments...' }}
            </span>
        </div>

    </div>
</template>
