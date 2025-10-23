<script setup>
import { Link } from "@inertiajs/vue3";
import { ShoppingCart } from "lucide-vue-next";

const props = defineProps({
    cartRoute: {
        type: String,
        default: "#",
    },
});
</script>

<template>
    <div
        class="tw-sticky tw-top-0 tw-z-40 tw-border-b tw-border-slate-200 tw-bg-white/95 tw-backdrop-blur tw-px-4 tw-py-3 md:tw-hidden"
    >
        <div class="tw-flex tw-items-center tw-gap-3">
            <label class="tw-relative tw-flex-1">
                <span class="tw-sr-only">Cari produk</span>
                <span
                    class="tw-pointer-events-none tw-absolute tw-inset-y-0 tw-left-4 tw-flex tw-items-center"
                >
                    <van-icon
                        name="search"
                        class="tw-text-lg tw-text-slate-400"
                    />
                </span>
                <input
                    type="search"
                    name="q"
                    placeholder="Cari produk atau kebutuhan Syariah..."
                    class="tw-h-12 tw-w-full tw-rounded-full tw-border tw-border-slate-200 tw-bg-white tw-pl-12 tw-pr-5 tw-text-sm tw-text-slate-700 tw-shadow-sm focus:tw-border-primary focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-primary/40"
                />
            </label>

            <Link
                :href="cartRoute"
                class="btn-icon tw-relative tw-h-12 tw-w-12 tw-flex-shrink-0"
            >
                <ShoppingCart class="tw-text-3xl tw-text-slate-600" />
                <span
                    class="tw-absolute tw--right-1 tw--top-1 tw-inline-flex tw-h-5 tw-min-w-[1.25rem] tw-items-center tw-justify-center tw-rounded-full tw-bg-primary tw-px-1 tw-text-[10px] tw-font-semibold tw-text-white"
                >
                    2
                </span>
            </Link>
        </div>
    </div>
</template>
