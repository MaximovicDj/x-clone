<script setup>

import {Link, useForm, usePage} from "@inertiajs/vue3";
import { router } from '@inertiajs/vue3'
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu'

import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
} from '@/components/ui/alert-dialog'
import {ref} from "vue";
import InputError from "@/Components/InputError.vue";

const page = usePage();
const user = page.props.auth.user;
const showDialog = ref(false)

const props = defineProps({
    comment: Object,
    postId: Number,
})

const emit = defineEmits(['deleted', 'updated'])

const deleteComment = (id) => {
    router.delete(route('comments.destroy', id), {
        preserveScroll: true,

        onSuccess: () => {
            emit('deleted', id)
        }
    })
}

const editCommentForm = ref(false)
const form = useForm({
    comment: props.comment.comment
})

const editComment = (id) => {
    form.post(route('comments.update', id), {
        preserveScroll: true,
        onSuccess: () => {
            editCommentForm.value = false
            emit('updated', id)
        }
    })
}


</script>

<template>
    <div class="relative flex items-start gap-3">

        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-sm font-bold">
            {{ comment.user.name?.charAt(0).toUpperCase() }}
        </div>

        <div class="flex-1 min-w-0 pr-8">
            <div class="flex items-center gap-2 mb-1">
            <span class="font-semibold text-white text-sm hover:underline cursor-pointer">
                <Link
                    :href="route('profile.show', comment.user.slug)"
                    class="hover:text-blue-400 transition-colors"
                >
                    {{ comment.user.name }}
                </Link>
            </span>

                <span class="text-xs text-gray-500">
                {{ comment.user.email }}
            </span>

                <span class="text-xs text-gray-600">·</span>

                <span class="text-xs text-gray-500">
                {{ comment.created_at }}
            </span>
            </div>

            <p
                v-if="!editCommentForm"
                class="text-gray-200 text-sm leading-relaxed break-words">
                {{ comment.comment }}
            </p>

            <div v-if="editCommentForm">
                <form @submit.prevent="editComment(comment.id)">
                    <textarea
                        rows="2"
                        v-model="form.comment"
                        class="w-full bg-gray-800/50 border border-gray-700/50 rounded-lg px-4 py-2.5 text-white text-sm placeholder-gray-500 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all resize-y min-h-[60px] max-h-32"
                    ></textarea>
                    <InputError
                        :message="form.errors.comment"
                        class="mt-1"
                    />
                    <div class="flex justify-end mt-2">
                        <button
                            type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors"
                        >
                            Edit
                        </button>
                    </div>
                </form>
            </div>




            <div class="flex items-center gap-4 mt-2">
                <button
                    class="text-xs text-gray-500 hover:text-blue-400 transition-colors">
                    Replay...
                </button>
            </div>

<!--            show replies div -->
<!--            <div class="ml-6 mt-2">-->
<!--                <textarea-->
<!--                    rows="1"-->
<!--                    placeholder="Replay.."-->
<!--                    class="w-full bg-gray-800/50 border border-gray-700/50 rounded-lg px-3 py-2 text-white text-sm placeholder-gray-500 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all resize-none"-->
<!--                ></textarea>-->
<!--            </div>-->
        </div>

        <div>

        </div>
        <DropdownMenu v-if="user.id === comment.user.id">
            <DropdownMenuTrigger>
                <button
                    type="button"
                    class="absolute top-0 right-0 p-1 rounded-full text-gray-500 hover:text-white hover:bg-gray-800 transition-colors"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="w-5 h-5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 6.75h.008v.008H12V6.75Zm0 5.25h.008v.008H12V12Zm0 5.25h.008v.008H12v-.008Z"
                        />
                    </svg>
                </button>
            </DropdownMenuTrigger>

            <DropdownMenuContent class="bg-black border border-gray-800 text-white" >
                <DropdownMenuItem @click="editCommentForm = !editCommentForm" class="text-white hover:bg-gray-800 focus:bg-gray-800 focus:text-white cursor-pointer">
                    Edit
                </DropdownMenuItem>
                <DropdownMenuItem @click="showDialog = true" class="text-red-500 hover:bg-gray-800 focus:bg-gray-800 focus:text-red-500 cursor-pointer">
                    Delete
                </DropdownMenuItem>
            </DropdownMenuContent>
        </DropdownMenu>
    </div>

    <AlertDialog v-model:open="showDialog">
        <AlertDialogContent class="bg-black border border-gray-800 text-white
       top-[35%] left-1/2 -translate-x-1/2 -translate-y-1/2">
            <AlertDialogHeader>
                <AlertDialogTitle>Are you absolutely sure?</AlertDialogTitle>
                <AlertDialogDescription class="text-gray-400">
                    This action cannot be undone. This will permanently delete your account
                    and remove your data from our servers.
                </AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter>
                <AlertDialogCancel
                    class="p-2 bg-transparent text-white border-gray-700 hover:bg-gray-800 hover:text-white"
                >Cancel</AlertDialogCancel>
                <AlertDialogAction
                    @click="deleteComment(comment.id)"
                    class="bg-red-600 text-white hover:bg-red-700 p-2"
                >Continue</AlertDialogAction>
            </AlertDialogFooter>
        </AlertDialogContent>
    </AlertDialog>
</template>
