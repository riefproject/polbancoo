<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Keranjang Belanja" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="tw-text-xl tw-font-semibold tw-leading-tight tw-text-gray-800"
            >
                Keranjang
            </h2>
        </template>

        <div class="tw-space-y-4">
            <van-card
                class="tw-rounded-xl tw-border tw-border-dashed tw-border-slate-200"
            >
                <template #title>Keranjang Produk</template>
                <template #desc>
                    <p class="tw-mb-3 tw-text-sm tw-text-slate-600">
                        Belum ada item di keranjang. Tambahkan produk dari
                        katalog untuk mulai berbelanja.
                    </p>
                    <van-button type="primary" icon="shop-o">
                        Jelajahi Produk
                    </van-button>
                </template>
            </van-card>
        </div>
    </AuthenticatedLayout>
</template>
