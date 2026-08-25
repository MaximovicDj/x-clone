<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import HappeningNow from "@/Components/HappeningNow.vue";

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(
    () => props.status === 'verification-link-sent',
);
</script>

<template>
    <Head title="Email Verification" />

    <GuestLayout>
        <div class="flex flex-col items-start gap-6">
            <Link :href="route('welcome')">
                <ApplicationLogo />
            </Link>
            <HappeningNow />
        </div>

        <div class="flex justify-center lg:justify-end pt-10">

            <div class="w-full max-w-sm space-y-6">
                <div class="rounded-2xl border border-gray-200 dark:border-gray-800 p-6 space-y-4">
                    <div>

                        <div class="mb-4 text-sm text-gray-600 text-white">
                            Thanks for signing up! Before getting started, could you verify your
                            email address by clicking on the link we just emailed to you? If you
                            didn't receive the email, we will gladly send you another.
                        </div>

                        <div
                            class="mb-4 text-sm font-medium text-green-600"
                            v-if="verificationLinkSent"
                        >
                            A new verification link has been sent to the email address you
                            provided during registration.
                        </div>

                        <form @submit.prevent="submit">
                            <div class="mt-4 flex items-center justify-between">
                                <PrimaryButton
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Resend Verification Email
                                </PrimaryButton>

                                <Link
                                    :href="route('logout')"
                                    method="post"
                                    as="button"
                                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                >Log Out</Link
                                >
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </GuestLayout>

</template>
