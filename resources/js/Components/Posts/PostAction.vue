<script setup>
import {
    Popover,
    PopoverContent,
    PopoverTrigger,
} from '@/components/ui/popover'
import PostDelete from "@/Components/Posts/PostDelete.vue";
import {ref} from "vue";
import {Pencil} from "@lucide/vue";
import {Link, usePage} from "@inertiajs/vue3";

const props = defineProps({
    post: {
        type: Object,
        required: true
    },
})

const user = usePage().props.auth.user;
const canSeeAction = user.id === props.post.user.id

const isOpen = ref(false)

const closePopover = () => {
    isOpen.value = false;
}

</script>

<template>
    <Popover v-model:open="isOpen">
        <PopoverTrigger>
            <span class="text-gray-400 cursor-pointer">•••</span>
        </PopoverTrigger>
        <PopoverContent class="bg-zinc-900 text-white p-1">

            <div v-if="canSeeAction">
                <PostDelete
                    :post-id="props.post.id"
                    @close-popover="closePopover"
                />

                <Link :href="route('posts.edit', props.post)">
                    <button class="flex items-center pl-3 py-2 rounded hover:bg-zinc-800/80 cursor-pointer transition-colors">
                        <Pencil class="mr-2 text-blue-500" />
                        Edit
                    </button>
                </Link>
            </div>

        </PopoverContent>
    </Popover>
</template>
