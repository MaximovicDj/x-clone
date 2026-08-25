<script setup>
import { Trash2 } from '@lucide/vue';
import {
    AlertDialog, AlertDialogAction,
    AlertDialogCancel, AlertDialogContent,
    AlertDialogDescription, AlertDialogFooter,
    AlertDialogHeader, AlertDialogTitle, AlertDialogTrigger
} from "@/components/ui/alert-dialog/index.js";
import {ref} from "vue";
import {router} from "@inertiajs/vue3";
import {useToast} from "@/Composables/useToast.js";
import {useFlashMessages} from "@/Composables/useFlashMessages.js";

const props = defineProps({
    postId: Number
})
const emit = defineEmits(['close-popover'])

const { toastAlert } = useToast()
const { successMessage } = useFlashMessages()
const isProcessing = ref(false)

const deletePost = (id) => {
    isProcessing.value = true;
    router.delete(route('posts.destroy', id), {
        onSuccess: () => {
            isProcessing.value = false;
            emit('close-popover')
            toastAlert(successMessage.value, 'success')
        }
    })
}


</script>

<template>
    <AlertDialog>
        <AlertDialogTrigger>
            <button
                :disabled="isProcessing"
                class="flex items-center pl-3 py-2 rounded hover:bg-zinc-800/80 cursor-pointer transition-colors">
                <Trash2 class="mr-2 text-red-600" />
                Delete
            </button>
        </AlertDialogTrigger>
        <AlertDialogContent class="flex flex-col items-center text-center bg-zinc-900 text-white p-5">
            <AlertDialogHeader class="flex flex-col items-center">
                <AlertDialogTitle>Delete post?</AlertDialogTitle>
                <AlertDialogDescription class="text-white">
                    This can’t be undone and it will be removed from your profile, the timeline of any
                    accounts that follow you, and from search results.
                </AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter class="flex flex-col gap-2 sm:flex-col">
                <AlertDialogAction
                    @click="deletePost(props.postId)"
                    class="w-full bg-red-600 hover:bg-red-700 text-white px-8 py-1">Delete</AlertDialogAction>
                <AlertDialogCancel class="w-full bg-gray-600 hover:bg-gray-700 text-white px-8 py-1">Cancel</AlertDialogCancel>
            </AlertDialogFooter>
        </AlertDialogContent>
    </AlertDialog>
</template>
