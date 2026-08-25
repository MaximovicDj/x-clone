import {ref} from "vue";

const allTags = ref([]);
const loaded = ref(false)

export function useTags() {
    const fetchAllTags = async () => {
        if (loaded.value) return;
        try {
            const response = await axios.get('api/tags')
            allTags.value = response.data
            loaded.value = true
        }
        catch (error) {
            loaded.value = false;
            console.log(error)
        }
    }

    return { allTags, loaded, fetchAllTags }
}
