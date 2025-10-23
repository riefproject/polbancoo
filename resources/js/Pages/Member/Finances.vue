<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Keuangan Anggota" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="tw-text-xl tw-font-semibold tw-leading-tight tw-text-gray-800">
                Keuangan Saya
            </h2>
        </template>

        <div class="tw-space-y-4">
            <van-card class="tw-rounded-xl tw-border tw-border-dashed tw-border-gray-200">
                <template #title>Ringkasan Simpanan</template>
                <template #desc>
                    <p class="tw-mb-3 tw-text-sm tw-text-gray-600">
                        Tampilkan total simpanan pokok, wajib, dan sukarela,
                        serta riwayat transaksi terbaru di sini.
                    </p>
                    <van-button type="primary" icon="balance-o">
                        Lihat Detail
                    </van-button>
                </template>
            </van-card>
        </div>
    </AuthenticatedLayout>
</template>
