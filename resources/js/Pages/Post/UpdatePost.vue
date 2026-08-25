<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import {Textarea} from "@/components/ui/textarea/index.js";
import Multiselect from "vue-multiselect";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import {computed, onMounted} from "vue";
import {useFlashMessages} from "@/Composables/useFlashMessages.js";
import {useToast} from "@/Composables/useToast.js";
import {useEmojiHanlder} from "@/Composables/useEmojiHanlder.js";
import EmojiButtonVue from "@/Components/EmojiButtonVue.vue";
import {useImageUpload} from "@/Composables/useImageUpload.js";
import PostImagesPreview from "@/Components/Posts/PostImagesPreview.vue";
import SelectedFilesCount from "@/Components/SelectedFilesCount.vue";

const data = defineProps({
    post: Object,
    tags: Object,
})

const { toastAlert } = useToast()
const { successMessage } = useFlashMessages()

const postData = computed(() => data.post.data || [])
const tagsData = computed(() => data.tags.data || [])


const form = useForm({
    content: postData.value.content,
    tags: postData.value.tags,
    existingImages: postData.value.images,
    images: [],
})
const { trackCursorPointer, onSelectEmoji } = useEmojiHanlder(form)
const { handleImages, removeImage, previews } = useImageUpload(form)

const handleEmoji = (emoji) => {
    onSelectEmoji({ i:emoji })
}

const updatePost = () => {
  form.patch(route('posts.update', postData.value.id), {
      onSuccess: () => {
          toastAlert(successMessage.value, 'success')
      }
  })
}


</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-8 bg-black/10 text-white">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div>
                    <h2>Edit Post</h2>
                    <span class="text-sm">
                        Make changes to your post here. Click save when you're done.
                    </span>
                </div>

                <div class="mt-8">
                    <form @submit.prevent="updatePost">
                        <div class="grid gap-4">
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

                            <div class="grid gap-3">
                                <multiselect
                                    id="multiselect"
                                    v-model="form.tags"
                                    :options="tagsData"
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
                                <InputError :message="form.errors.tags" />
                            </div>

                            <div class="grid gap-3 mb-3">
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
                        </div>

                        <div v-if="previews.length" class="mb-3 grid grid-cols-3 sm:grid-cols-3 md:grid-cols-4 gap-3">
                            <PostImagesPreview
                                :previews="previews"
                                @remove="removeImage" />
                        </div>
                        <div class="mb-3 grid grid-cols-3 sm:grid-cols-3 md:grid-cols-4 gap-3">
                            <SelectedFilesCount :previews="previews" />
                        </div>

                        <PrimaryButton
                            :disabled="form.processing"
                        >
                            Save
                        </PrimaryButton>
                    </form>
                </div>
            </div>

        </div>


    </AuthenticatedLayout>
</template>
