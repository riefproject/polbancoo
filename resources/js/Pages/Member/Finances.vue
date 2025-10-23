<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Keuangan Anggota" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="tw-text-xl tw-font-semibold tw-leading-tight tw-text-gray-800"
            >
                Keuangan Saya
            </h2>
        </template>

        <div class="tw-space-y-4">
            <h1 class="tw-text-lg">INI TAMPILAN KEUANGAN</h1>
        </div>
    </AuthenticatedLayout>
</template>
