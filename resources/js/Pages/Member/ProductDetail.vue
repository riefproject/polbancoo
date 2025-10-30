<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps({
  product: Object,
  recommendations: Array,
});

const quantity = ref(1);

const increaseQty = () => {
  if (quantity.value < product.stock) quantity.value++;
};
const decreaseQty = () => {
  if (quantity.value > 1) quantity.value--;
};

const addToCart = () => {
  alert(
    `Produk "${product.name}" (${quantity.value}x) ditambahkan ke keranjang.`
  );
};

const goToDetail = (id) => {
  router.visit(route("member.products.show", id));
};
</script>

<template>
  <Head :title="product.name" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="tw-text-xl tw-font-semibold tw-leading-tight tw-text-gray-800">
        Detail Produk
      </h2>
    </template>

    <!-- Bagian Utama Produk -->
    <div
      class="tw-flex tw-flex-col md:tw-flex-row tw-gap-8 tw-p-6 md:tw-p-8"
    >
      <!-- FOTO PRODUK -->
      <div class="md:tw-w-[40%] tw-flex tw-justify-center tw-items-start">
        <img
          :src="product.image_url || '/img/no-image.png'"
          alt="Product Image"
          class="tw-w-80 tw-h-80 tw-object-cover tw-rounded-xl tw-border tw-border-gray-200"
        />
      </div>

      <!-- DETAIL PRODUK -->
      <div class="md:tw-w-[60%] tw-space-y-5 tw-text-gray-800">
        <h1 class="tw-text-3xl tw-font-extrabold tw-text-blue-900">
          {{ product.name }}
        </h1>

        <p class="tw-text-2xl tw-text-orange-600 tw-font-bold">
          Rp {{ Number(product.cash_price).toLocaleString("id-ID") }}
        </p>

        <p class="tw-text-lg tw-leading-relaxed tw-text-gray-700 tw-mt-2">
          {{ product.description || "Tidak ada deskripsi untuk produk ini." }}
        </p>

        <!-- Kuantitas -->
        <div class="tw-mt-6 tw-space-y-6">
          <div class="tw-flex tw-flex-col md:tw-flex-row tw-items-start md:tw-items-center tw-gap-2 md:tw-gap-4">
            <div class="tw-flex tw-items-center tw-gap-4">
              <span class="tw-font-semibold tw-text-lg">Kuantitas:</span>

              <div class="tw-flex tw-items-center tw-gap-2">
                <button
                  @click="decreaseQty"
                  class="tw-w-9 tw-h-9 tw-rounded-full tw-bg-gray-200 hover:tw-bg-gray-300 tw-font-bold tw-text-lg tw-leading-none"
                >
                  -
                </button>
                <span
                  class="tw-min-w-[2rem] tw-text-center tw-text-lg tw-font-medium"
                >
                  {{ quantity }}
                </span>
                <button
                  @click="increaseQty"
                  class="tw-w-9 tw-h-9 tw-rounded-full tw-bg-gray-200 hover:tw-bg-gray-300 tw-font-bold tw-text-lg tw-leading-none"
                >
                  +
                </button>
              </div>
            </div>

            <!-- Stok tersedia -->
            <span
              class="tw-text-base tw-text-gray-500 tw-ml-0 md:tw-ml-2 tw-mt-1 md:tw-mt-0"
            >
              Stok tersedia: {{ product.stock }}
            </span>
          </div>

          <!-- Tombol Tambah ke Keranjang -->
          <div class="tw-flex tw-justify-center md:tw-justify-start">
            <button
              @click="addToCart"
              class="tw-border tw-border-orange-500 tw-text-orange-500 tw-font-semibold tw-rounded-full tw-px-8 tw-py-3 hover:tw-bg-orange-50 tw-transition tw-text-base"
            >
              Tambah ke Keranjang
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Produk Rekomendasi -->
    <div class="tw-mt-12">
      <h3 class="tw-text-2xl tw-font-semibold tw-text-gray-800 tw-mb-6">
        Rekomendasi Produk Lainnya
      </h3>

      <div
        class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-6"
      >
        <div
          v-for="rec in recommendations"
          :key="rec.id"
          @click="goToDetail(rec.id)"
          class="tw-bg-white tw-rounded-xl tw-overflow-hidden tw-shadow hover:tw-shadow-lg hover:tw-scale-[1.02] tw-transition tw-cursor-pointer"
        >
          <img
            :src="rec.image_url || '/img/no-image.png'"
            alt="Product Image"
            class="tw-w-full tw-h-44 tw-object-cover"
          />
          <div class="tw-p-4">
            <h4
              class="tw-font-semibold tw-text-blue-900 tw-text-lg tw-truncate"
            >
              {{ rec.name }}
            </h4>
            <p class="tw-text-orange-600 tw-font-bold tw-mt-1 tw-text-base">
              Rp {{ Number(rec.cash_price).toLocaleString("id-ID") }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
