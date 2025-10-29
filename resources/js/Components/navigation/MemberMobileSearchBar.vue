<script setup>
import { router } from "@inertiajs/vue3";
import { ref } from "vue";
import CartIcon from "../CartIcon.vue";

const props = defineProps({
    cartRoute: {
        type: String,
        default: "#",
    },
    cartQty: {
        type: Number,
        default: 1,
    },
});

const humanizeQty = (qty) => {
    if (qty > 99) {
        return "99+";
    }
    return qty;
};
// state pencarian
const search = ref("");

// fungsi untuk handle pencarian
const handleSearch = () => {
    if (search.value.trim() !== "") {
        router.get(route("member.products"), { q: search.value });
    } else {
        router.get(route("member.products"));
    }
};
</script>

<template>
    <div
        class="tw-sticky tw-top-0 tw-z-40 tw-border-b tw-border-slate-200 tw-bg-white/95 tw-backdrop-blur tw-px-4 tw-py-3 md:tw-hidden"
    >
        <div class="tw-flex tw-items-center tw-gap-3">
            <!-- Search Bar -->
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
                    v-model="search"
                    @keyup.enter="handleSearch"
                    type="search"
                    name="q"
                    placeholder="Cari produk atau kebutuhan Syariah..."
                    class="tw-h-12 tw-w-full tw-rounded-full tw-border tw-border-slate-200 tw-bg-white tw-pl-12 tw-pr-5 tw-text-sm tw-text-slate-700 tw-shadow-sm focus:tw-border-primary focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-primary/40"
                />
            </label>
            <CartIcon :cart-qty="cartQty" />
        </div>
    </div>
</template>
