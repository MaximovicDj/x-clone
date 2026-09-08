<script setup>

import {useForm, usePage} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import {Button} from "@/components/ui/button/index.js";

const props = defineProps({
    postId: Number
})

const page = usePage();
const user = page.props.auth.user

const emit = defineEmits(['comment-created'])

const form = useForm({
    comment: ''
})

const submit = () => {

    form.post(route('comments.store', props.postId), {
        preserveScroll: true,

        onSuccess: () => {
            form.reset()
            emit('comment-created')
        }
    })
}

</script>

<template>
    <div class="mt-6 pt-4 border-t border-gray-700/50">
        <div class="flex gap-3">
            <div class="flex-shrink-0">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm">
                    {{ user.name?.charAt(0).toUpperCase() }}
                </div>
            </div>

            <form @submit.prevent="submit" class="w-full">
                <div class="flex gap-2 items-start">

                    <div class="flex-1 min-w-0">
                        <textarea
                            rows="2"
                            placeholder="Add a comment..."
                            v-model="form.comment"
                            class="w-full bg-gray-800/50 border border-gray-700/50 rounded-lg px-4 py-2.5 text-white text-sm placeholder-gray-500 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all resize-y min-h-[60px] max-h-32"
                        ></textarea>
                        <InputError
                            :message="form.errors.comment"
                            class="mt-1"
                        />
                    </div>
                    <Button
                        type="submit"
                        class="flex-shrink-0 px-3 py-2.5 mt-5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors"
                    >
                        Objavi
                    </Button>

                </div>
            </form>
        </div>
    </div>
</template>
