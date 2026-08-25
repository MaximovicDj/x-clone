<script setup>
import { computed } from 'vue'
import {Head, Link} from '@inertiajs/vue3'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";

const props = defineProps({
    status: {
        type: Number,
        required: true
    }
})

const title = computed(() => {
    return {
        503: '503: Service Unavailable',
        500: '500: Server Error',
        404: '404: Page Not Found',
        403: '403: Forbidden',
    }[props.status] || 'An Error Occurred'
})

const description = computed(() => {
    return {
        503: 'Sorry, we are doing some maintenance. Please check back soon.',
        500: 'Whoops, something went wrong on our servers.',
        404: 'Sorry, the page you are looking for could not be found.',
        403: 'Sorry, you are forbidden from accessing this page.',
    }[props.status] || 'An unexpected error has occurred on our server.'
})
</script>

<template>
    <Head :title="title" />

    <div class="error-container bg-black text-white">
        <h1>{{ title }}</h1>
        <p>{{ description }}</p>
        <Link :href="route('welcome')">Return Home</Link>
    </div>

</template>

<style scoped>
.error-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    font-family: sans-serif;
    text-align: center;
}
h1 { font-size: 2rem; margin-bottom: 1rem; }
p { margin-bottom: 1.5rem; }
a { text-decoration: underline; }
</style>
