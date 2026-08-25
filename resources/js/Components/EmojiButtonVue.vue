<script setup>
import EmojiPicker from "vue3-emoji-picker";
import {ref} from "vue";

const showEmojies = ref(false)
const emit = defineEmits(['select'])

const onSelectEmoji = (emoji) => {
    emit('select', emoji.i)
}

</script>

<template>
    <button
        type="button"
        class="absolute bottom-3 right-3 text-gray-400 hover:text-white transition-colors"
        @click="showEmojies = !showEmojies"
    >
        <svg
            class="h-6 w-6"
            viewBox="0 0 48 48"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <circle cx="24" cy="24" r="18" stroke="currentColor" stroke-width="2" />
            <circle cx="18" cy="20" r="2" fill="currentColor" />
            <circle cx="30" cy="20" r="2" fill="currentColor" />
            <path d="M16 28C18.5 32 29.5 32 32 28" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
        </svg>
    </button>

    <div
        class="absolute 50 right-0 z-50"
        v-if="showEmojies">
        <EmojiPicker theme="dark" :native="true" @select="onSelectEmoji" />
    </div>
</template>
