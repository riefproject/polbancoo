<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="tw-flex tw-min-h-screen tw-flex-col tw-items-center tw-bg-gray-100 tw-pt-6 tw-justify-center sm:tw-pt-0"
    >
        <div>
            <Link href="/">
                <ApplicationLogo
                    class="tw-h-20 tw-w-20 tw-fill-current tw-text-gray-500"
                />
            </Link>
        </div>

        <div
            class="tw-container tw-flex tw-justify-center tw-align-center tw-my-5"
        >
            <div
                class="tw-col tw-bg-white tw-p-8 tw-rounded-lg tw-shadow-md tw-w-[80%] sm:tw-w-96"
            >
                <slot />
            </div>
        </div>
    </div>
</template>
