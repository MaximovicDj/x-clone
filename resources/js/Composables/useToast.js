import { toast } from 'vue3-toastify';

export function useToast() {
    const toastAlert = (message, type) => {
        return toast(message, {
            "theme": "dark",
            "type": type,
            "transition": "slide",
            "autoClose": 1500
        })
    }

    return { toastAlert };
}
