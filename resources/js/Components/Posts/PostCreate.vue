<script setup>
import { ref } from 'vue'
import {useForm} from '@inertiajs/vue3';
import {Button} from "@/components/ui/button/index.js";
import {Textarea} from "@/components/ui/textarea/index.js";
import InputError from "@/Components/InputError.vue";
import {useImageUpload} from "@/Composables/useImageUpload.js";
import Multiselect from 'vue-multiselect'
import {useEmojiHanlder} from "@/Composables/useEmojiHanlder.js";
import {useFlashMessages} from "@/Composables/useFlashMessages.js";
import {useToast} from "@/Composables/useToast.js";
import PostImagesPreview from "@/Components/Posts/PostImagesPreview.vue";
import EmojiButtonVue from "@/Components/EmojiButtonVue.vue";
import SelectedFilesCount from "@/Components/SelectedFilesCount.vue";

const props = defineProps({
    postsTag: Object
})

const form = useForm({
    content: '',
    tags: [],
    images: []
})

const options = ref(props.postsTag.data);

const { handleImages, removeImage, previews } = useImageUpload(form)
const { trackCursorPointer, onSelectEmoji } = useEmojiHanlder(form)

const { successMessage } = useFlashMessages()
const { toastAlert } = useToast()

const handleEmoji = (emoji) => {
    onSelectEmoji({ i:emoji })
}

const submit = () => {
    form.post(route('posts.store'), {
        onSuccess: () => {
            toastAlert(successMessage.value, 'success')
            form.reset()
            previews.value = []
        }
    })
}

</script>

<template>

    <form @submit.prevent="submit" class="space-y-4">
        <div class="relative">
            <Textarea
                v-model="form.content"
                @click="trackCursorPointer"
                @keyup="trackCursorPointer"
                placeholder="What's on your mind?"
                class="h-40 border border-gray-700 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-0 resize-none pr-12"
            />
            <EmojiButtonVue @select="handleEmoji" />

            <InputError :message="form.errors.content" />
        </div>

        <div>
            <multiselect
                id="multiselect"
                v-model="form.tags"
                :options="options"
                :multiple="true"
                :taggable="true"
                :close-on-select="false"
                :clear-on-select="false"
                :preserve-search="true"
                placeholder="Pick some tag"
                label="name"
                track-by="name"> <!-- :preselect-first="true" -->
                @tag="addNewTag"
            </multiselect>
        </div>

        <div>
            <div
                class="relative border-2 border-dashed border-gray-600 rounded-lg p-2 hover:border-gray-400 transition-colors cursor-pointer"
                @dragover.prevent
            >
                <input
                    type="file"
                    multiple
                    accept="image/*"
                    @change="handleImages"
                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                />

                <div class="text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <p class="mt-2 text-sm text-gray-400">
                        <span class="font-semibold text-white">Click to upload</span> or drag and drop
                    </p>
                    <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 10MB each</p>
                </div>
            </div>

            <InputError
                v-if="Object.keys(form.errors).some(key => key.startsWith('images.'))"
                :message="'Please check your images (allowed: JPEG, PNG, JPG, GIF, SVG).'"
            />
        </div>

        <div v-if="previews.length" class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-4 gap-3">
            <PostImagesPreview :previews="previews" @remove="removeImage" />
        </div>

        <div class="flex items-center justify-between ">

            <SelectedFilesCount :previews="previews" />

            <Button
                :disabled="form.processing || (!form.content.trim() && !previews.length)"
                variant="outline"
                class="px-6 py-2 ml-auto transition-all hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed text-white border-white bg-black hover:bg-gray-900"
            >
            <span v-if="form.processing" class="flex items-center gap-2">
                <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Posting...
            </span>
            <span v-else>Post</span>
            </Button>
        </div>
    </form>
</template>

