
import {usePage} from "@inertiajs/vue3";
import {computed} from "vue";

export function useFlashMessages() {
    const page = usePage();
    const successMessage = computed(() => page.props.flash.success || '')

    return { successMessage }
}
