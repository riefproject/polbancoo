<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Kelola Produk" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="tw-text-xl tw-font-semibold tw-leading-tight tw-text-gray-800">
                Kelola Produk
            </h2>
        </template>

        <div class="tw-space-y-4">
            <van-card class="tw-rounded-xl tw-border tw-border-dashed tw-border-gray-200">
                <template #title>Inventaris Produk</template>
                <template #desc>
                    <p class="tw-mb-3 tw-text-sm tw-text-gray-600">
                        Tempatkan tabel atau modul manajemen produk di sini:
                        daftar produk, stok, harga, dan aksi CRUD.
                    </p>
                    <van-button type="primary" icon="plus">
                        Tambah Produk
                    </van-button>
                </template>
            </van-card>
        </div>
    </AuthenticatedLayout>
</template>
