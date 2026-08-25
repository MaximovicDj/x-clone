import {ref} from "vue";

export function useImageUpload(form) {

    const previews = ref([]);

    if(form.existingImages?.length > 0) {
        previews.value = [...previews.value, ...form.existingImages]
    }

    const handleImages = (e) => {
        const selectedImages = Array.from(e.target.files);
        form.images.push(...selectedImages);
        previews.value.push(...selectedImages.map(file => URL.createObjectURL(file)));
    }

    const removeImage = (index) => {

        if(typeof previews.value[index] === 'string') {
            URL.revokeObjectURL(previews.value[index]);
            form.images.splice(index, 1);
        }
        previews.value.splice(index, 1);
        form.existingImages.splice(index, 1);
    }

    return { handleImages, removeImage, previews }
}
