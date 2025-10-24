<script setup>
const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    description: {
        type: String,
        default: "",
    },
    price: {
        type: [Number, String],
        required: true,
    },
    currency: {
        type: String,
        default: "Rp. ",
    },
    quantity: {
        type: [Number, String],
        default: 1,
    },
    thumbnail: {
        type: String,
        default: "",
    },
    tag: {
        type: String,
        default: "",
    },
    tagType: {
        type: String,
        default: "primary",
    },
});
</script>

<template>
    <article
        class="tw-flex tw-h-full tw-flex-col tw-overflow-hidden tw-rounded-2xl tw-border tw-border-slate-200 tw-bg-white tw-shadow-sm"
    >
        <div
            v-if="thumbnail"
            class="tw-relative tw-h-[180px] tw-overflow-hidden sm:tw-h-[200px]"
        >
            <img
                :src="thumbnail"
                :alt="title"
                class="tw-h-full tw-w-full tw-object-cover tw-object-center"
            />
            <span
                v-if="tag"
                class="tw-absolute tw-left-3 tw-top-3 tw-rounded-full tw-bg-slate-900/90 tw-px-3 tw-py-1 tw-text-xs tw-font-semibold tw-uppercase tw-text-white"
                :class="{
                    'tw-bg-red-600/90': tagType === 'danger',
                    'tw-bg-indigo-600/90': tagType === 'primary',
                }"
            >
                {{ tag }}
            </span>
        </div>

        <div class="tw-flex tw-flex-1 tw-flex-col tw-gap-4 tw-p-5">
            <header class="tw-space-y-2">
                <h3 class="tw-text-lg tw-font-semibold tw-text-slate-900">
                    {{ title }}
                </h3>
            </header>

            <div
                class="tw-mt-auto tw-flex tw-items-center tw-justify-between tw-border-t tw-border-slate-200 tw-pt-4"
            >
                <div class="tw-flex tw-items-baseline tw-gap-1">
                    <span class="tw-text-sm tw-font-medium tw-text-slate-500">
                        {{ currency }}
                    </span>
                    <span class="tw-text-xl tw-font-bold text-primary">
                        {{ price }}
                    </span>
                </div>
            </div>
            <span class="tw-text-xs tw-font-medium tw-text-slate-500">
                Tersedia: {{ quantity }}
            </span>
        </div>

        <footer class="tw-grid tw-gap-3 tw-px-5 tw-pb-5">
            <slot name="footer">
                <button
                    class="tw-inline-flex tw-items-center tw-justify-center tw-rounded-md tw-border tw-border-transparent tw-bg-primary tw-px-4 tw-py-2 tw-text-sm tw-font-medium tw-text-white hover:tw-bg-primary/80 focus:outline-none focus:ring-2 focus:ring-primary/50"
                >
                    Lihat Detail
                </button>
                <button
                    class="tw-inline-flex tw-items-center tw-justify-center tw-rounded-md tw-border tw-border-primary tw-bg-white tw-px-4 tw-py-2 tw-text-sm tw-font-medium tw-text-primary hover:tw-bg-primary/10 focus:outline-none focus:ring-2 focus:ring-primary/50"
                >
                    Tambah ke Keranjang
                </button>
            </slot>
        </footer>
    </article>
</template>
