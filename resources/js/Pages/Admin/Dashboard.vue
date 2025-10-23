<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const user = computed(() => page.props.auth.user);
</script>

<template>
    <Head title="Admin Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="tw-text-xl tw-font-semibold tw-leading-tight tw-text-gray-800">
                Admin Dashboard
            </h2>
        </template>

        <div class="tw-py-12">
            <div class="tw-mx-auto tw-max-w-5xl tw-space-y-6 sm:tw-px-6 lg:tw-px-8">
                <van-card
                    class="tw-rounded-xl tw-shadow-sm"
                    :title="`Halo, ${user?.name ?? ''}`"
                >
                    <template #desc>
                        <p class="tw-mb-4 tw-text-gray-700">
                            Gunakan panel ini untuk mengelola produk, pesanan,
                            dan pengajuan pembiayaan anggota.
                        </p>
                        <div class="tw-flex tw-flex-wrap tw-gap-3">
                            <van-button type="primary" icon="bag-o">
                                Kelola Produk
                            </van-button>
                            <van-button type="success" icon="orders-o">
                                Pantau Pesanan
                            </van-button>
                        </div>
                    </template>
                </van-card>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
