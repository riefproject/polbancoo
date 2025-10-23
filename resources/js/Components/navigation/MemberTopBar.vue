<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    links: {
        type: Array,
        default: () => [],
    },
    user: {
        type: Object,
        default: null,
    },
});
</script>

<template>
    <header class="tw-sticky tw-top-0 tw-z-40 tw-hidden tw-border-b tw-border-slate-200 tw-bg-white/95 tw-backdrop-blur md:tw-block">
        <div class="tw-flex tw-items-center tw-justify-between tw-px-6 tw-py-4">
            <div class="tw-text-xl tw-font-semibold text-primary">
                KopSy Member
            </div>

            <div class="tw-flex tw-items-center tw-gap-2">
                <Link
                    :href="route('profile.edit')"
                    class="btn btn-outline btn-sm"
                >
                    <van-icon name="user-circle-o" class="tw-me-2 tw-text-base" />
                    {{ user?.name }}
                </Link>
            </div>
        </div>

        <nav class="tw-flex tw-items-center tw-gap-2 tw-border-t tw-border-slate-200 tw-px-6 tw-py-2">
            <Link
                v-for="link in links"
                :key="link.name"
                :href="link.href"
                class="tw-rounded-lg tw-px-3 tw-py-1.5 tw-text-xs tw-font-medium tw-uppercase tw-tracking-wide tw-transition"
                :class="[
                    link.active
                        ? 'bg-primary tw-text-white tw-shadow-sm'
                        : 'tw-text-slate-600 hover:bg-secondary-light',
                ]"
            >
                <div class="tw-flex tw-items-center tw-gap-2">
                    <van-icon :name="link.icon" class="tw-text-base" />
                    <span>{{ link.label }}</span>
                </div>
            </Link>
        </nav>
    </header>
</template>
