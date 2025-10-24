<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Ledger Keuangan" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="tw-text-xl tw-font-semibold tw-leading-tight tw-text-gray-800"
            >
                Ledger Keuangan
            </h2>
        </template>

        <div class="tw-space-y-4">
            <van-card
                class="tw-rounded-xl tw-border tw-border-dashed tw-border-gray-200"
            >
                <template #title>Ringkasan Buku Besar</template>
                <template #desc>
                    <p class="tw-mb-3 tw-text-sm tw-text-gray-600">
                        Gunakan halaman ini untuk menampilkan transaksi
                        simpanan, penjualan, dan cicilan yang memengaruhi buku
                        besar koperasi.
                    </p>
                    <van-button type="primary" icon="chart-trending-o">
                        Lihat Ledger
                    </van-button>
                </template>
            </van-card>
        </div>
    </AuthenticatedLayout>
</template>
