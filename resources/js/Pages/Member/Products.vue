<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";

defineProps({
  products: Array,
});

// fungsi buat pindah ke halaman detail
const goToDetail = (product) => {
  router.visit(route("member.products.show", product.id));
};
</script>

<template>
  <Head title="Katalog Produk" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="tw-text-xl tw-font-semibold tw-leading-tight tw-text-gray-800">
        Katalog Produk
      </h2>
    </template>

    <!-- Grid Produk -->
    <div
      class="tw-p-6 tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-6"
    >
      <div
        v-for="product in products"
        :key="product.id"
        @click="goToDetail(product)"
        class="tw-bg-white tw-rounded-xl tw-overflow-hidden tw-shadow hover:tw-shadow-lg hover:tw-scale-[1.02] tw-transition tw-cursor-pointer"
      >
        <img
          :src="product.image_url || '/img/no-image.png'"
          alt="Product Image"
          class="tw-w-full tw-h-48 tw-object-cover"
        />

        <div class="tw-p-4">
          <h3 class="tw-text-lg tw-font-semibold tw-text-blue-900">
            {{ product.name }}
          </h3>

          <p class="tw-text-sm tw-text-gray-600 tw-mt-1">
            {{ product.category?.name ?? "Tanpa Kategori" }}
          </p>

          <p class="tw-text-orange-600 tw-font-bold tw-mt-2">
            Rp {{ Number(product.cash_price).toLocaleString("id-ID") }}
          </p>

          <p class="tw-text-gray-700 tw-text-sm tw-mt-3 tw-line-clamp-2">
            {{ product.description }}
          </p>
        </div>
      </div>
    </div>

    <!-- Jika kosong -->
    <div
      v-if="products.length === 0"
      class="tw-text-center tw-text-gray-500 tw-mt-6"
    >
      Belum ada produk yang tersedia.
    </div>
  </AuthenticatedLayout>
</template>
