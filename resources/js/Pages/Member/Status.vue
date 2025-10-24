<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
  applications: Array,
});
</script>

<template>
  <Head title="Status Pengajuan Pembiayaan" />

  <AuthenticatedLayout>
    <template #header>
      <h2
        class="tw-text-xl tw-font-semibold tw-leading-tight tw-text-gray-800"
      >
        Status Pengajuan Pembiayaan
      </h2>
    </template>

    <!-- Wrapper utama -->
    <div
      class="tw-p-6 tw-bg-gradient-to-r tw-from-blue-900 tw-to-orange-500 tw-rounded-2xl tw-text-white tw-shadow-xl tw-mt-5"
    >
      <h3 class="tw-text-2xl tw-font-bold tw-mb-6 tw-text-center">
        Daftar Pengajuan Anda
      </h3>

      <div
        class="tw-bg-white/20 tw-rounded-xl tw-p-4 tw-shadow-inner tw-overflow-x-auto"
      >
        <table
          class="tw-w-full tw-text-sm tw-text-left tw-border-collapse tw-text-white/90"
        >
          <thead>
            <tr class="tw-bg-white/10 tw-text-white">
              <th class="tw-py-3 tw-px-2 tw-text-center">ID</th>
              <th class="tw-py-3 tw-px-2 tw-text-center">Produk</th>
              <th class="tw-py-3 tw-px-2 tw-text-center">Tenor</th>
              <th class="tw-py-3 tw-px-2 tw-text-center">Total Harga</th>
              <th class="tw-py-3 tw-px-2 tw-text-center">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="app in applications"
              :key="app.id"
              class="hover:tw-bg-white/10 tw-transition"
            >
              <td class="tw-py-2 tw-px-2 tw-text-center">{{ app.id }}</td>
              <td class="tw-py-2 tw-px-2 tw-text-center">
                {{ app.order?.id ?? "-" }}
              </td>
              <td class="tw-py-2 tw-px-2 tw-text-center">
                {{ app.tenor }} bulan
              </td>
              <td class="tw-py-2 tw-px-2 tw-text-center">
                Rp {{ Number(app.selling_price_total).toLocaleString("id-ID") }}
              </td>
              <td class="tw-py-2 tw-px-2 tw-text-center">
                <span
                  class="tw-px-3 tw-py-1 tw-rounded-full tw-font-semibold tw-text-sm"
                  :class="{
                    'tw-bg-orange-500/70': app.status === 'Pending',
                    'tw-bg-blue-500/70': app.status === 'Approved',
                    'tw-bg-red-600/70': app.status === 'Rejected',
                    'tw-bg-green-600/70': app.status === 'Active',
                    'tw-bg-gray-400/70': app.status === 'Lunas',
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
          class="tw-text-center tw-text-white/80 tw-mt-4 tw-font-medium"
        >
          Belum ada pengajuan pembiayaan.
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
