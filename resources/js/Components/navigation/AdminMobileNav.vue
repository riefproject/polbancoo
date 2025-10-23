<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";
const props = defineProps({
    modelValue: {
        type: Boolean,
        default: false,
    },
    links: {
        type: Array,
        default: () => [
            {
                name: "member.dashboard",
                label: "Home",
                icon: "home-o",
                patterns: ["member.dashboard"],
            },
            {
                name: "member.finances",
                label: "Keuangan",
                icon: "balance-o",
                patterns: ["member.finances"],
            },
            {
                name: "member.status",
                label: "Status",
                icon: "todo-list-o",
                patterns: ["member.status"],
            },
            {
                name: "profile.edit",
                label: "Profile",
                icon: "user-circle-o",
                patterns: ["profile.*"],
            },
        ],
    },
    user: {
        type: Object,
        default: null,
    },
});

const emit = defineEmits(["update:modelValue"]);

const drawerVisible = computed({
    get: () => props.modelValue,
    set: (value) => emit("update:modelValue", value),
});

const closeDrawer = () => emit("update:modelValue", false);
</script>

<template>
    <header
        class="tw-sticky tw-top-0 tw-z-40 tw-border-b tw-border-slate-200 tw-bg-white/95 tw-backdrop-blur md:tw-hidden"
    >
        <div class="tw-flex tw-items-center tw-justify-between tw-px-4 tw-py-3">
            <button
                type="button"
                class="btn-icon"
                @click="drawerVisible = true"
            >
                <van-icon name="menu" class="tw-text-2xl" />
            </button>

            <div class="tw-text-sm tw-font-semibold tw-text-slate-700">
                {{ user?.name }}
            </div>

            <Link :href="route('profile.edit')" class="btn-icon">
                <van-icon name="user-o" class="tw-text-xl" />
            </Link>
        </div>

        <van-popup
            v-model:show="drawerVisible"
            position="left"
            class="!tw-h-full !tw-w-64 tw-p-0 md:!tw-hidden"
        >
            <div
                class="tw-flex tw-h-full tw-flex-col tw-border-r tw-border-slate-200 tw-bg-white"
            >
                <div
                    class="tw-flex tw-items-center tw-justify-between tw-border-b tw-border-slate-200 tw-px-5 tw-pb-3 tw-pt-6"
                >
                    <span class="tw-text-lg tw-font-semibold text-primary">
                        Navigasi
                    </span>
                    <button type="button" class="btn-icon" @click="closeDrawer">
                        <van-icon name="close" class="tw-text-xl" />
                    </button>
                </div>

                <nav
                    class="tw-flex-1 tw-space-y-1 tw-overflow-y-auto tw-px-3 tw-pb-6 tw-pt-4"
                >
                    <Link
                        v-for="link in links"
                        :key="link.name"
                        :href="link.href"
                        class="tw-flex tw-items-center tw-gap-3 tw-rounded-lg tw-px-3 tw-py-2 tw-text-base tw-font-medium tw-transition"
                        :class="[
                            link.active
                                ? 'bg-primary tw-text-white tw-shadow-sm'
                                : 'tw-text-slate-600 hover:bg-secondary-light',
                        ]"
                        @click="closeDrawer"
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
        </van-popup>
    </header>
</template>
