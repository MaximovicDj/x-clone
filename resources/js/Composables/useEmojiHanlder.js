import {ref} from "vue";

export function useEmojiHanlder(form) {
    const cursorPointer = ref(0);
    const showEmojies = ref(false)

    const trackCursorPointer = (event) => {
        cursorPointer.value = event.target.selectionStart
    }

    const onSelectEmoji = (emoji) => {
        form.content =
            form.content.slice(0, cursorPointer.value) +
            emoji.i +
            form.content.slice(cursorPointer.value)
    }

    return {
        showEmojies,
        trackCursorPointer,
        onSelectEmoji
    }
}
