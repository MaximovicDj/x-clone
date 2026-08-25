<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import Checkbox from "@/Components/Checkbox.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import AuthText from "@/Components/AuthText.vue";
import HappeningNow from "@/Components/HappeningNow.vue";

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>

        <div class="flex flex-col items-start gap-6">
            <Link :href="route('welcome')">
                <ApplicationLogo />
            </Link>
            <HappeningNow />
            <AuthText
                text="Forgot your password? No problem. Just let us know your email
                            address and we will email you a password reset link that will allow
                            you to choose a new one." />
        </div>

        <div class="flex justify-center lg:justify-end pt-10">
            <div class="w-full max-w-sm space-y-6">
                <div class="rounded-2xl border border-gray-200 p-6 space-y-4 text-white">

                    <h2 class="text-2xl font-bold text-black text-white">
                        Enter your email to reset password
                    </h2>

                    <div>
                        <div v-if="status" class="mb-4 text-sm font-medium text-green-600" >
                            {{ status }}
                        </div>
                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="email" value="Email" class="text-white" />

                                <TextInput
                                    id="email"
                                    type="email"
                                    class="mt-1 block w-full bg-black text-white border-gray-700"
                                    v-model="form.email"
                                    autofocus
                                    autocomplete="username"
                                />

                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>

                            <div class="mt-4 flex items-center justify-end">
                                <PrimaryButton
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Email Password Reset Link
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
