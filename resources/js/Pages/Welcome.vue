<script setup>
import {App, Head, Link, useForm, usePage} from '@inertiajs/vue3';
import { ref } from 'vue';
import InputError from "@/Components/InputError.vue";
import Checkbox from "@/Components/Checkbox.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import HappeningNow from "@/Components/HappeningNow.vue";
import AuthText from "@/Components/AuthText.vue";

const { status } = defineProps({
    status: {
        type: String,
    },
});

const loginForm = useForm({
    email: '',
    password: '',
    remember: false,
});

const login = () => {
    loginForm.post(route('login'), {
        onFinish: () => loginForm.reset('password'),
    });
};

const registerForm = useForm({
    name: '',
    last_name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const register = () => {
    registerForm.post(route('register'), {
        onFinish: () => registerForm.reset('password', 'password_confirmation'),
    });
};

const showRegisterForm = ref(false);

const toggleForms = () => {
    showRegisterForm.value = !showRegisterForm.value
}

</script>

<template>
    <Head title="Welcome" />

<!--    bg-gray-50 text-black/50 dark:bg-black dark:text-white/50-->

    <div class="bg-black/100">
        <div class="relative flex min-h-screen flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <main class="min-h-[80vh] flex items-center justify-center px-6">

                    <div class="grid w-full max-w-6xl grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                        <div class="flex flex-col items-start gap-6 text-white">
                            <Link :href="route('welcome')">
                                <ApplicationLogo />
                            </Link>
                            <HappeningNow />
                            <AuthText text="Join today and start sharing what’s happening in your world." />
                        </div>

                        <div class="flex justify-center lg:justify-end pt-10">
                            <div class="w-full max-w-sm space-y-6">
                                <div class="rounded-2xl border border-gray-200 p-6 space-y-4 text-white">

                                    <h2 class="text-2xl font-bold text-black text-white">
                                        Sign {{ showRegisterForm ? 'up' : 'in' }} to Laravel X Clone
                                    </h2>

                                    <p class="text-sm text-black/60 text-white">
                                        {{ showRegisterForm ? 'Welcome to X-Clone' : 'Welcome back' }}
                                    </p>

                                    <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
                                        {{ status }}
                                    </div>

                                    <div id="loginForm" v-if="!showRegisterForm">
                                        <form @submit.prevent="login">
                                            <div>
                                                <InputLabel for="email" value="Email" class="text-white" />

                                                <TextInput
                                                    id="email"
                                                    type="email"
                                                    class="mt-1 block w-full bg-black text-white border-gray-700"
                                                    v-model="loginForm.email"
                                                    autofocus
                                                    autocomplete="username"
                                                />

                                                <InputError class="mt-2" :message="loginForm.errors.email"/>
                                            </div>

                                            <div class="mt-4">
                                                <InputLabel for="password" value="Password" class="text-white" />

                                                <TextInput
                                                    id="password"
                                                    type="password"
                                                    class="mt-1 block w-full bg-black text-white border-gray-700"
                                                    v-model="loginForm.password"
                                                    autocomplete="current-password"
                                                />

                                                <InputError class="mt-2" :message="loginForm.errors.password" />
                                            </div>

                                            <div class="mt-4 block">
                                                <label class="flex items-center">
                                                    <Checkbox name="remember" v-model:checked="loginForm.remember" />
                                                    <span class="ms-2 text-sm text-gray-600"
                                                    >Remember me</span
                                                    >
                                                </label>
                                            </div>

                                            <div class="mt-4 flex items-center justify-end">
                                                <Link
                                                    :href="route('password.request')"
                                                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                                >
                                                    Forgot your password?
                                                </Link>

                                                <PrimaryButton
                                                    class="ms-4"
                                                    :class="{ 'opacity-25': loginForm.processing }"
                                                    :disabled="loginForm.processing"
                                                >
                                                    Log in
                                                </PrimaryButton>
                                            </div>
                                        </form>
                                    </div>

                                    <div v-if="showRegisterForm" id="registerForm">
                                        <form @submit.prevent="register">
                                            <div>
                                                <InputLabel for="name" value="Name" class="text-white" />

                                                <TextInput
                                                    id="name"
                                                    type="text"
                                                    class="mt-1 block w-full bg-black text-white border-gray-700"
                                                    v-model="registerForm.name"
                                                    autofocus
                                                    autocomplete="name"
                                                />

                                                <InputError class="mt-2" :message="registerForm.errors.name" />
                                            </div>

                                            <div class="mt-4">
                                                <InputLabel for="last_name" value="Last Name" class="text-white" />

                                                <TextInput
                                                    id="last_name"
                                                    type="text"
                                                    class="mt-1 block w-full bg-black text-white border-gray-700"
                                                    v-model="registerForm.last_name"
                                                    autofocus
                                                    autocomplete="last_name"
                                                />

                                                <InputError class="mt-2" :message="registerForm.errors.last_name" />
                                            </div>

                                            <div class="mt-4">
                                                <InputLabel for="email" value="Email" class="text-white" />

                                                <TextInput
                                                    id="email"
                                                    type="email"
                                                    class="mt-1 block w-full bg-black text-white border-gray-700"
                                                    v-model="registerForm.email"
                                                    autocomplete="username"
                                                />

                                                <InputError class="mt-2" :message="registerForm.errors.email" />
                                            </div>

                                            <div class="mt-4">
                                                <InputLabel for="password" value="Password" class="text-white" />

                                                <TextInput
                                                    id="password"
                                                    type="password"
                                                    class="mt-1 block w-full bg-black text-white border-gray-700"
                                                    v-model="registerForm.password"
                                                    autocomplete="new-password"
                                                />

                                                <InputError class="mt-2" :message="registerForm.errors.password" />
                                            </div>

                                            <div class="mt-4">
                                                <InputLabel
                                                    for="password_confirmation"
                                                    value="Confirm Password"
                                                    class="text-white"
                                                />

                                                <TextInput
                                                    id="password_confirmation"
                                                    type="password"
                                                    class="mt-1 block w-full bg-black text-white border-gray-700"
                                                    v-model="registerForm.password_confirmation"
                                                    autocomplete="new-password"
                                                />

                                                <InputError
                                                    class="mt-2"
                                                    :message="registerForm.errors.password_confirmation"
                                                />
                                            </div>

                                            <div class="mt-4 flex items-center justify-end">
                                                <PrimaryButton
                                                    class="ms-4"
                                                    :class="{ 'opacity-25': registerForm.processing }"
                                                    :disabled="registerForm.processing"
                                                >
                                                    Register
                                                </PrimaryButton>
                                            </div>
                                        </form>
                                    </div>

                                    <div>
                                        <p class="text-white">{{ !showRegisterForm ? 'No account?' : 'Already registered?' }}
                                            <span @click="toggleForms()" class="text-white cursor-pointer">
                                                {{ !showRegisterForm ? 'Register' : 'Login' }}
                                            </span>
                                        </p>
                                    </div>

                                </div>

                                <p class="text-xs text-black/50 dark:text-white/50 text-center">
                                    By signing up, you agree to the Terms of Service and Privacy Policy.
                                </p>

                            </div>

                        </div>

                    </div>
                </main>

                <footer
                    class="py-16 text-center text-sm text-black dark:text-white/70"
                >
                    Welcome to Laravel X Clone
                </footer>
            </div>
        </div>
    </div>
</template>
