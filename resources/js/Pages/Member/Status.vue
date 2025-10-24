<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

// Data dikirim dari Laravel controller lewat Inertia
defineProps({
  applications: Array,
});
</script>

<template>
  <Head title="Status Pengajuan Pembiayaan" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="tw-text-xl tw-font-semibold tw-leading-tight tw-text-gray-800">
        Status Pengajuan Pembiayaan
      </h2>
    </template>

    <div class="tw-bg-white tw-rounded-xl tw-shadow-sm tw-p-6 tw-space-y-4">
      <table class="tw-w-full tw-text-left tw-border-collapse">
        <thead>
          <tr class="tw-bg-gray-100 tw-text-gray-700">
            <th class="tw-border tw-p-2">ID</th>
            <th class="tw-border tw-p-2">Produk</th>
            <th class="tw-border tw-p-2">Tenor</th>
            <th class="tw-border tw-p-2">Total Harga</th>
            <th class="tw-border tw-p-2">Status</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="app in applications"
            :key="app.id"
            class="hover:tw-bg-gray-50 tw-transition"
          >
            <td class="tw-border tw-p-2">{{ app.id }}</td>
            <td class="tw-border tw-p-2">{{ app.order_id ?? "-" }}</td>
            <td class="tw-border tw-p-2">{{ app.tenor }} bulan</td>
            <td class="tw-border tw-p-2">
              Rp {{ Number(app.selling_price_total).toLocaleString("id-ID") }}
            </td>
            <td class="tw-border tw-p-2">
              <span
                class="tw-font-semibold"
                :class="{
                  'tw-text-orange-500': app.status === 'Pending',
                  'tw-text-blue-500': app.status === 'Approved',
                  'tw-text-red-500': app.status === 'Rejected',
                  'tw-text-green-600': app.status === 'Active',
                  'tw-text-gray-500': app.status === 'Lunas',
                }"
              >
                {{ app.status }}
              </span>
            </td>
          </tr>
        </tbody>
      </table>

      <div
        v-if="applications.length === 0"
        class="tw-text-center tw-text-gray-500 tw-mt-4"
      >
        Belum ada pengajuan pembiayaan.
      </div>
    </div>
  </AuthenticatedLayout>
</template>
