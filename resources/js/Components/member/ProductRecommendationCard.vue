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
        <div v-if="thumbnail" class="tw-relative tw-h-full tw-overflow-hidden">
            <div class="tw-w-full">
                <img
                    :src="thumbnail"
                    :alt="title"
                    class="tw-w-full tw-h-auto tw-object-cover tw-object-center tw-border-b"
                    style="aspect-ratio: 1 / 1"
                />
            </div>
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

        <div class="tw-flex tw-flex-1 tw-flex-col tw-p-3 md:tw-p-5">
            <header class="tw-space-y-2">
                <h3
                    class="tw-text-sm md:tw-text-base tw-font-semibold tw-text-slate-900"
                >
                    {{ title }}
                </h3>
            </header>

            <div
                class="tw-mt-auto tw-flex tw-items-center tw-justify-between tw-border-slate-200 tw-pt-2 md:tw-pt-4"
            >
                <div class="tw-flex tw-items-baseline tw-gap-1">
                    <span class="tw-text-sm tw-font-medium tw-text-slate-500">
                        {{ currency }}
                    </span>
                    <span
                        class="tw-text-base md:tw-text-xl tw-font-bold text-primary tw-truncate tw-max-w-[8rem]"
                        :title="price"
                    >
                        {{ price }}
                    </span>
                </div>
            </div>
            <span
                class="tw-text-xs md:tw-text-xs tw-font-medium tw-text-slate-500"
            >
                Tersedia: {{ quantity }}
            </span>
        </div>
    </article>
</template>
