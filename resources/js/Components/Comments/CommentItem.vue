<script setup>

import {Link, usePage} from "@inertiajs/vue3";
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

const page = usePage();
const user = page.props.auth.user;
const showDialog = ref(false)

const props = defineProps({
    comment: Object
})

const emit = defineEmits(['deleted'])

const deleteComment = (id) => {
    router.delete(route('comments.destroy', id), {
        preserveScroll: true,

        onSuccess: () => {
            emit('deleted', id)
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

            <p class="text-gray-200 text-sm leading-relaxed break-words">
                {{ comment.comment }}
            </p>

            <div class="flex items-center gap-4 mt-2">
                <button class="text-xs text-gray-500 hover:text-blue-400 transition-colors">
                    Odgovori
                </button>
            </div>
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
                <DropdownMenuItem class="text-white hover:bg-gray-800 focus:bg-gray-800 focus:text-white cursor-pointer">
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
