<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";

const props = defineProps({
  applications: Array,
  filters: Object,
});

// state filter
const dateFilter = ref(props.filters?.date_filter || "all");
const statusFilter = ref(props.filters?.status_filter || "");
const sortDirection = ref(props.filters?.sort_price || "");

// untuk custom tanggal
const startDate = ref("");
const endDate = ref("");

// dropdown state
const openMenu = ref(null);
const openSubmenu = ref(false);

const toggleMenu = (menu) => {
  if (openMenu.value === menu) {
    openMenu.value = null;
    openSubmenu.value = false;
  } else {
    openMenu.value = menu;
    if (menu !== "status") openSubmenu.value = false;
  }
};

const toggleSubmenu = () => {
  openSubmenu.value = !openSubmenu.value;
};

// tutup dropdown kalo klik di luar
onMounted(() => {
  window.addEventListener("click", (e) => {
    if (!e.target.closest(".dropdown")) {
      openMenu.value = null;
      openSubmenu.value = false;
    }
  });
});

// kirim filter ke backend
const applyFilter = () => {
  router.get(
    route("member.status"),
    {
      date_filter: dateFilter.value,
      status_filter: statusFilter.value,
      sort_price: sortDirection.value,
    },
    { preserveState: true }
  );
};

// filter custom tanggal
const applyCustomDateFilter = () => {
  if (!startDate.value || !endDate.value) {
    alert("Pilih tanggal mulai dan tanggal akhir terlebih dahulu!");
    return;
  }
  router.get(
    route("member.status"),
    {
      date_filter: "custom",
      start_date: startDate.value,
      end_date: endDate.value,
      status_filter: statusFilter.value,
      sort_price: sortDirection.value,
    },
    { preserveState: true }
  );
  openMenu.value = null; // tutup dropdown setelah apply
};

// toggle urutan harga
const toggleSort = () => {
  if (sortDirection.value === "") sortDirection.value = "highest";
  else if (sortDirection.value === "highest") sortDirection.value = "lowest";
  else sortDirection.value = "";
  applyFilter();
};
</script>

<template>
  <Head title="Status Pengajuan Pembiayaan" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="tw-text-xl tw-font-semibold tw-leading-tight tw-text-gray-800">
        Status Pengajuan Pembiayaan
      </h2>
    </template>

    <!-- Filter bar -->
    <div class="tw-flex tw-justify-center tw-mt-6">
      <div
        class="tw-flex tw-items-center tw-bg-white tw-border tw-border-slate-200 tw-rounded-2xl tw-shadow-md tw-px-6 tw-py-3 tw-gap-6"
      >
        <!-- Tanggal Pesanan -->
        <div class="dropdown tw-relative">
          <span
            @click.stop="toggleMenu('date')"
            class="tw-cursor-pointer tw-text-orange-500 tw-font-semibold tw-text-base hover:tw-text-orange-600"
          >
            Tanggal Pesanan
          </span>

          <!-- Dropdown tanggal -->
          <div
            v-show="openMenu === 'date'"
            class="tw-absolute tw-top-full tw-left-0 tw-mt-2 tw-bg-white tw-border tw-border-orange-300 tw-rounded-xl tw-shadow-lg tw-w-56 tw-overflow-hidden tw-z-30"
          >
            <button
              v-for="opt in [
                { key: 'all', label: 'Semua tanggal' },
                { key: '7_days', label: '7 Hari Terakhir' },
                { key: '30_days', label: '30 Hari Terakhir' },
                { key: 'custom', label: 'Pilih Tanggal Sendiri' },
              ]"
              :key="opt.key"
              @click.stop="
                dateFilter = opt.key;
                if (opt.key !== 'custom') applyFilter();
              "
              class="tw-w-full tw-px-4 tw-py-2 tw-text-left tw-font-medium"
              :class="[
                dateFilter === opt.key
                  ? 'tw-bg-orange-500 tw-text-white'
                  : 'tw-text-orange-600 hover:tw-bg-orange-100',
              ]"
            >
              {{ opt.label }}
            </button>

            <!-- custom tanggal -->
            <div
              v-if="dateFilter === 'custom'"
              class="tw-p-4 tw-bg-orange-50 tw-space-y-2 tw-border-t tw-border-orange-200"
            >
              <label
                class="tw-block tw-text-sm tw-font-semibold tw-text-orange-700"
              >
                Tanggal Mulai
              </label>
              <input
                type="date"
                v-model="startDate"
                class="tw-w-full tw-rounded-lg tw-border tw-border-orange-300 tw-px-2 tw-py-1 focus:tw-ring-orange-400 focus:tw-border-orange-400"
              />

              <label
                class="tw-block tw-text-sm tw-font-semibold tw-text-orange-700 tw-mt-2"
              >
                Tanggal Akhir
              </label>
              <input
                type="date"
                v-model="endDate"
                class="tw-w-full tw-rounded-lg tw-border tw-border-orange-300 tw-px-2 tw-py-1 focus:tw-ring-orange-400 focus:tw-border-orange-400"
              />

              <button
                @click.stop="applyCustomDateFilter"
                class="tw-mt-3 tw-bg-orange-500 hover:tw-bg-orange-600 tw-text-white tw-font-semibold tw-px-3 tw-py-1 tw-rounded-lg tw-w-full"
              >
                Terapkan
              </button>
            </div>
          </div>
        </div>

        <!-- Garis pemisah -->
        <div class="tw-h-6 tw-w-px tw-bg-orange-300"></div>

        <!-- Status -->
        <div class="dropdown tw-relative">
          <span
            @click.stop="toggleMenu('status')"
            class="tw-cursor-pointer tw-text-orange-500 tw-font-semibold tw-text-base hover:tw-text-orange-600"
          >
            Status
          </span>

          <div
            v-show="openMenu === 'status'"
            class="tw-absolute tw-top-full tw-left-0 tw-mt-2 tw-bg-white tw-border tw-border-orange-300 tw-rounded-xl tw-shadow-lg tw-min-w-[180px] tw-z-40"
          >
            <button
              @click.stop="
                statusFilter = 'Tunai';
                applyFilter();
                openMenu = null;
              "
              class="tw-w-full tw-px-4 tw-py-2 tw-text-left tw-font-medium"
              :class="[
                statusFilter === 'Tunai'
                  ? 'tw-bg-orange-500 tw-text-white'
                  : 'tw-text-orange-600 hover:tw-bg-orange-100',
              ]"
            >
              Tunai (Lunas)
            </button>

            <div class="tw-relative">
              <button
                @click.stop="toggleSubmenu"
                class="tw-w-full tw-px-4 tw-py-2 tw-text-left tw-font-medium tw-flex tw-justify-between tw-items-center hover:tw-bg-orange-100"
                :class="openSubmenu ? 'tw-bg-orange-100' : ''"
              >
                <span class="tw-text-orange-600">Cicilan</span>
                <span class="tw-text-orange-400">
                  {{ openSubmenu ? "▼" : "›" }}
                </span>
              </button>

              <div
                v-show="openSubmenu"
                class="tw-absolute tw-left-[180px] tw-top-0 tw-bg-white tw-border tw-border-orange-300 tw-rounded-xl tw-shadow-lg tw-min-w-[150px] tw-z-50"
              >
                <button
                  v-for="opt in ['Approved', 'Pending', 'Rejected', 'Active', 'Lunas']"
                  :key="opt"
                  @click.stop="
                    statusFilter = opt;
                    applyFilter();
                    openSubmenu = false;
                    openMenu = null;
                  "
                  class="tw-w-full tw-px-4 tw-py-2 tw-text-left tw-font-medium"
                  :class="[
                    statusFilter === opt
                      ? 'tw-bg-orange-500 tw-text-white'
                      : 'tw-text-orange-600 hover:tw-bg-orange-100',
                  ]"
                >
                  {{ opt }}
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Garis pemisah -->
        <div class="tw-h-6 tw-w-px tw-bg-orange-300"></div>

        <!-- Total Harga -->
        <div>
          <span
            @click="toggleSort"
            class="tw-cursor-pointer tw-text-orange-500 tw-font-semibold tw-text-base hover:tw-text-orange-600 tw-flex tw-items-center tw-gap-1"
            :class="sortDirection ? 'tw-text-orange-600' : ''"
          >
            Total Harga
            <span v-if="sortDirection === 'highest'">▲</span>
            <span v-else-if="sortDirection === 'lowest'">▼</span>
          </span>
        </div>
      </div>
    </div>

    <!-- Tabel data -->
    <div
      class="tw-p-6 tw-bg-gradient-to-r tw-from-blue-900 tw-to-orange-500 tw-rounded-2xl tw-text-white tw-shadow-xl tw-mt-8"
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
