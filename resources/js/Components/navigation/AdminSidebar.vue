<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    links: {
        type: Array,
        default: () => [],
    },
    title: {
        type: String,
        default: "KopSy Admin",
    },
    user: {
        type: Object,
        default: null,
    },
});
</script>

<template>
    <aside
        class="tw-hidden tw-w-64 tw-border-r tw-border-slate-200 tw-bg-white md:tw-block"
    >
        <div
            class="tw-sticky tw-top-0 tw-flex tw-h-screen tw-flex-col tw-bg-white/95 tw-backdrop-blur"
        >
            <div
                class="tw-border-b tw-border-slate-200 tw-px-6 tw-pb-4 tw-pt-6"
            >
                <h2 class="tw-text-lg tw-font-semibold text-primary">
                    {{ title }}
                </h2>
                <p v-if="user" class="tw-mt-1 tw-text-xs tw-text-slate-500">
                    {{ user.email }}
                </p>
            </div>

            <nav
                class="tw-flex-1 tw-space-y-1 tw-overflow-y-auto tw-px-3 tw-py-4"
            >
                <Link
                    v-for="link in links"
                    :key="link.name"
                    :href="link.href"
                    class="tw-flex tw-items-center tw-gap-3 tw-rounded-lg tw-px-3 tw-py-2 tw-text-sm tw-font-medium tw-transition"
                    :class="[
                        link.active
                            ? 'bg-primary tw-text-white tw-shadow-sm'
                            : 'tw-text-slate-600 hover:bg-secondary-light',
                    ]"
                >
                    <van-icon :name="link.icon" class="tw-text-lg" />
                    <span>{{ link.label }}</span>
                </Link>
            </nav>

            <div
                class="tw-border-t tw-border-slate-200 tw-px-3 tw-py-4 tw-text-xs tw-text-slate-400"
            >
                © KopSy Campus
            </div>
        </div>
    </aside>
</template>
