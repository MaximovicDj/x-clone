<script setup>
import {Link, usePage} from "@inertiajs/vue3";

const activeClass = 'bg-gray-900 font-bold text-white';
const inActiveClass = 'text-gray-400 hover:text-white';

const user = usePage().props.auth.user;

</script>

<template>
    <nav class="flex-1 space-y-1">
        <!-- Home -->
        <Link :href="route('dashboard')"
              class="left-link"
              :class="route().current('dashboard') ? activeClass : inActiveClass">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span>Home</span>
        </Link>

        <!-- Profile -->
        <Link :href="route('profile.edit')"
              class="left-link"
              :class="route().current('profile.edit') ? activeClass : inActiveClass"  >
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span>Profile</span>
        </Link>
    </nav>

    <Link :href="route('logout')"
          method="post"
          as="button"
          class="flex items-center gap-2 px-3 py-3 hover:bg-gray-900 rounded-full transition text-gray-400 hover:text-white">
        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 16l4-4m0 0l-4-4m4 4H9m4 8H7a2 2 0 01-2-2V6a2 2 0 012-2h6"/>
        </svg>
        <span>Logout</span>
        <span class="text-sm text-gray-300">{{ user.email }}</span>
    </Link>
</template>

<style scoped>
.left-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem;
    border-radius: 9999px;
    transition: all 0.3s ease;
}

.left-link:hover {
    background-color: #111827;  /* hover:bg-gray-900 */
}
</style>
