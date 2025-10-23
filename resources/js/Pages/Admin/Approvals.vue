<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Approval Pembiayaan" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="tw-text-xl tw-font-semibold tw-leading-tight tw-text-gray-800">
                Approval Pembiayaan
            </h2>
        </template>

        <div class="tw-space-y-4">
            <van-card class="tw-rounded-xl tw-border tw-border-dashed tw-border-gray-200">
                <template #title>Pengajuan Murabahah</template>
                <template #desc>
                    <p class="tw-mb-3 tw-text-sm tw-text-gray-600">
                        Tampilkan daftar pengajuan pembiayaan untuk ditinjau,
                        disetujui, atau ditolak dengan catatan evaluasi.
                    </p>
                    <van-button type="primary" icon="passed">
                        Lihat Pengajuan
                    </van-button>
                </template>
            </van-card>
        </div>
    </AuthenticatedLayout>
</template>
