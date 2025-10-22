<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const user = computed(() => page.props.auth.user);
</script>

<template>
    <Head title="Super Admin Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Super Admin Control Panel
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-5xl space-y-6 sm:px-6 lg:px-8">
                <van-card
                    class="rounded-xl shadow-sm"
                    :title="`Selamat datang, ${user?.name ?? ''}`"
                >
                    <template #desc>
                        <p class="mb-4 text-gray-700">
                            Anda memiliki akses penuh untuk mengelola pengguna
                            dan konfigurasi sistem.
                        </p>
                        <div class="flex flex-wrap gap-3">
                            <van-button type="primary" icon="manager-o">
                                Kelola Admin
                            </van-button>
                            <van-button type="default" icon="setting-o">
                                Pengaturan Sistem
                            </van-button>
                        </div>
                    </template>
                </van-card>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
