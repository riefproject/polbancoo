<script>
import { ArrowLeft } from "lucide-vue-next";
import CartIcon from "../CartIcon.vue";
export default {
    name: "MemberMobileTopBar",
    components: {
        CartIcon,
        ArrowLeft,
    },
    props: {
        title: { type: String, default: "Title" },
        leftText: { type: String, default: "" },
        leftArrow: { type: Boolean, default: true },
        iconSize: { type: [String, Number], default: "30px" },
        showCart: { type: Boolean, default: true },
    },
    methods: {
        onClickLeft() {
            if (this.$router && typeof this.$router.back === "function") {
                this.$router.back();
            } else if (
                window &&
                window.history &&
                typeof window.history.back === "function"
            ) {
                window.history.back();
            } else {
                window.location.href = "/";
            }
        },
    },
};
</script>

<template>
    <div
        class="tw-sticky tw-top-0 tw-z-40 tw-border-b tw-border-slate-200 tw-bg-white/95 tw-backdrop-blur tw-px-4 tw-py-3 md:tw-hidden"
    >
        <div class="tw-flex tw-items-center">
            <div class="tw-w-20 tw-flex tw-items-center">
                <button
                    type="button"
                    class="tw-flex tw-items-center tw-gap-2 tw-text-slate-700"
                    @click="onClickLeft"
                >
                    <ArrowLeft v-if="leftArrow" class="tw-text-3xl" />
                    <span class="tw-text-sm tw-font-medium">{{
                        leftText
                    }}</span>
                </button>
            </div>

            <!-- Center: title -->
            <div class="tw-flex-1 tw-text-center">
                <div class="tw-text-lg tw-font-extrabold text-primary">
                    {{ title }}
                </div>
            </div>

            <!-- Right: fixed width to match left -->
            <div class="tw-w-20 tw-flex tw-items-center tw-justify-end">
                <template v-if="showCart">
                    <CartIcon />
                </template>
            </div>
        </div>
    </div>
</template>
