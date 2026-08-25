<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import HappeningNow from "@/Components/HappeningNow.vue";
import AuthText from "@/Components/AuthText.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Reset Password" />

    <GuestLayout>
        <div class="flex flex-col items-start gap-6">
            <Link :href="route('welcome')">
                <ApplicationLogo />
            </Link>
            <HappeningNow />
            <AuthText text="Choose a new password for your account. Make sure it’s strong and secure." />
        </div>

        <div class="flex justify-center lg:justify-end pt-10">

            <div class="w-full max-w-sm space-y-6">
                <div class="rounded-2xl border border-gray-200  p-6 space-y-4 text-white">
                    <h2 class="text-2xl font-bold">
                        Enter new password
                    </h2>

                    <div>
                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="email" value="Email" class="text-white" />

                                <TextInput
                                    id="email"
                                    type="email"
                                    class="mt-1 block w-full bg-black text-white border-gray-700"
                                    v-model="form.email"
                                    required
                                    autofocus
                                    autocomplete="username"
                                />

                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="password" value="Password" class="text-white" />

                                <TextInput
                                    id="password"
                                    type="password"
                                    class="mt-1 block w-full bg-black text-white border-gray-700"
                                    v-model="form.password"
                                    autocomplete="new-password"
                                />

                                <InputError class="mt-2" :message="form.errors.password" />
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
                                    v-model="form.password_confirmation"
                                    autocomplete="new-password"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.password_confirmation"
                                />
                            </div>

                            <div class="mt-4 flex items-center justify-end">
                                <PrimaryButton
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Reset Password
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </GuestLayout>
</template>
