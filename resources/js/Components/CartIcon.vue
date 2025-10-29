<script setup>
import { Link } from "@inertiajs/vue3";
import { ShoppingCart } from "lucide-vue-next";

const props = defineProps({
    cartRoute: {
        type: String,
        default: route("member.cart"),
    },
    cartQty: {
        type: Number,
        default: 1,
    },
    iconClass: {
        type: String,
        default: "tw-text-3xl tw-text-slate-600",
    },
    bubleClass: {
        type: String,
        default:
            "tw-absolute tw--right-1 tw--top-1 tw-inline-flex tw-h-5 tw-min-w-[1.25rem] tw-items-center tw-justify-center tw-rounded-full tw-bg-primary tw-px-1 tw-text-[10px] tw-font-semibold tw-text-white",
    },
});

const humanizeQty = (qty) => {
    return qty > 99 ? "99+" : qty;
};
</script>

<!-- Icon keranjang -->
<template>
    <Link
        :href="cartRoute"
        class="btn-icon tw-relative tw-h-12 tw-w-12 tw-flex-shrink-0"
    >
        <ShoppingCart :class="iconClass" />
        <template v-if="cartQty != 0">
            <span :class="bubleClass">
                {{ humanizeQty(cartQty) }}
            </span>
        </template>
    </Link>
</template>
