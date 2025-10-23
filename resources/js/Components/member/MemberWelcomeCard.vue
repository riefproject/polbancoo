<script setup>
import { computed } from "vue";

const props = defineProps({
    userName: {
        type: String,
        default: "",
    },
});

const displayName = computed(() => props.userName ?? "");
</script>

<template>
    <van-card
        class="tw-rounded-xl tw-shadow-sm"
        :title="
            displayName ? `Assalamualaikum, ${displayName}` : 'Assalamualaikum,'
        "
    >
        <template #desc>
            <div class="tw-space-y-4 tw-text-gray-700">
                <p class="tw-text-sm">
                    <slot name="message">
                        Manfaatkan layanan koperasi Syariah untuk mengelola
                        keuangan dan kebutuhan konsumtif dengan lebih mudah.
                    </slot>
                </p>
                <slot name="actions" />
            </div>
        </template>
    </van-card>
</template>
