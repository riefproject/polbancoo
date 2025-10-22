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
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Admin Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-5xl space-y-6 sm:px-6 lg:px-8">
                <van-card
                    class="rounded-xl shadow-sm"
                    :title="`Halo, ${user?.name ?? ''}`"
                >
                    <template #desc>
                        <p class="mb-4 text-gray-700">
                            Gunakan panel ini untuk mengelola produk, pesanan,
                            dan pengajuan pembiayaan anggota.
                        </p>
                        <div class="flex flex-wrap gap-3">
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
