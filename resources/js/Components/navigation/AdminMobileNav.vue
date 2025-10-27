<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";
import { TextAlignStart } from "lucide-vue-next";
import AdminSidebar from "./AdminSidebar.vue";

const props = defineProps({
    modelValue: {
        type: Boolean,
        default: false,
    },
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

const emit = defineEmits(["update:modelValue"]);

const drawerVisible = computed({
    get: () => props.modelValue,
    set: (value) => emit("update:modelValue", value),
});

const toggleDrawer = () => emit("update:modelValue", !props.modelValue);
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
                aria-label="Toggle navigation"
                @click="toggleDrawer"
            >
                <template v-if="drawerVisible">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        class="tw-h-6 tw-w-6 tw-text-slate-600"
                        aria-hidden="true"
                    >
                        <path
                            fill="currentColor"
                            d="m6.4 6.4 11.2 11.2m0-11.2L6.4 17.6"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                        />
                    </svg>
                </template>
                <template v-else>
                    <TextAlignStart class="tw-text-base" />
                </template>
            </button>

            <div class="tw-text-sm tw-font-semibold tw-text-slate-700">
                {{ user?.name }}
            </div>

            <Link :href="route('profile.edit')" class="btn-icon">
                <van-icon name="user-o" class="tw-text-xl" />
            </Link>
        </div>
    </header>

    <div
        class="tw-fixed tw-inset-0 tw-z-30 tw-bg-black/40 tw-transition-opacity tw-duration-300 md:tw-hidden"
        :class="
            drawerVisible
                ? 'tw-opacity-100'
                : 'tw-pointer-events-none tw-opacity-0'
        "
        @click="closeDrawer"
    />

    <div
        class="tw-fixed tw-inset-y-0 tw-left-0 tw-z-40 tw-w-64 tw-bg-white tw-shadow-xl tw-transition-all tw-duration-300 tw-ease-in-out md:tw-hidden"
        :style="{ left: drawerVisible ? '0' : '-100%' }"
    >
        <AdminSidebar
            :links="links"
            :title="title"
            :user="user"
            :show-on-mobile="true"
            @navigate="closeDrawer"
        />
    </div>
</template>
