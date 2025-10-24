<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref, Text } from "vue";

const isModalMandatoryOpen = ref(false); // Status Modal Simpanan Pokok //
const isModalVoluntaryOpen = ref(false); // Status Modal Simpanan Sukarela //
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

        <!-- Belum menggunakan data dari database -->
        <div class="tw-bg-gray-50 tw-p-5 tw-flex tw-flex-col tw-items-center tw-gap-5">
            <div class="tw-bg-gradient-to-r tw-from-orange-500 tw-to-orange-400 tw-rounded-2xl tw-w-full tw-text-white tw-p-6 tw-shadow-lg">
                <h3 class="tw-text-lg tw-font-medium">Total Saldo</h3>
                <p class="tw-text-3xl tw-font-bold tw-mt-2">Rp 12.500.000</p>
                <p class="tw-text-sm tw-opacity-80 tw-mt-1">Update: 22 Okt 2025</p>
            </div>
            <div class="tw-grid tw-grid-cols-1 tw-gap-4 tw-w-full">
                <div class="tw-bg-white tw-rounded-xl tw-shadow-sm tw-p-4 tw-flex tw-justify-between tw-items-center">
                <span class="tw-text-gray-700 tw-font-medium">Simpanan Wajib</span>
                <span class="tw-text-orange-600 tw-font-semibold">Rp 5.000.000</span>
                </div>
                
                <div class="tw-bg-white tw-rounded-xl tw-shadow-sm tw-p-4 tw-flex tw-flex-col tw-gap-3">
                    <div class="tw-flex tw-justify-between tw-items-center">
                    <span class="tw-text-gray-700 tw-font-medium">Simpanan Pokok</span>
                    <span class="tw-text-orange-600 tw-font-semibold">Rp 6.000.000</span>
                    </div>
                    <button @click="isModalMandatoryOpen = true" round class="tw-font-semibold tw-py-2 tw-shadow-md hover:tw-brightness-110 tw-transition">
                    <van-icon name="add-o" class="tw-mr-2" />
                    Tambah Simpanan Pokok
                    </button>
                    <Teleport to="body"> <!-- Model -->
                        <div
                            v-if="isModalMandatoryOpen"
                            class="tw-fixed tw-inset-0 tw-bg-black/50 tw-flex tw-items-center tw-justify-center tw-z-[9999]"
                        >
                            <div class="tw-bg-white tw-rounded-xl tw-shadow-xl tw-w-96 tw-p-6 tw-text-center">
                                <h3 class="tw-text-lg tw-font-semibold tw-mb-4">Tambah Simpanan Pokok</h3>
                                <div class="tw-text-left">
                                <label class="tw-block tw-text-gray-700 tw-font-medium tw-mb-1">Nominal Simpanan</label> <!-- Input Nominal -->
                                <input
                                    v-model="nominal" type="number" placeholder="Masukkan nominal"
                                    class="tw-w-full tw-border tw-border-gray-300 tw-rounded-lg tw-px-3 tw-py-2 focus:tw-ring-2 focus:tw-ring-indigo-500 focus:tw-outline-none"
                                />
                                </div>

                                <div class="tw-text-left">
                                <label class="tw-block tw-mt-5 tw-text-gray-700 tw-font-medium tw-mb-1">Catatan</label> <!-- Input Catatan -->
                                <input
                                    v-model="catatan" type="text" placeholder="Tambahkan catatan (opsional)"
                                    class="tw-w-full tw-border tw-border-gray-300 tw-rounded-lg tw-px-3 tw-py-2 focus:tw-ring-2 focus:tw-ring-indigo-500 focus:tw-outline-none"
                                />
                                </div>

                                <div class="tw-text-left">
                                <label class="tw-block tw-mt-5 tw-text-gray-700 tw-font-medium tw-mb-1">Bukti Pembayaran</label> <!-- Input Bukti Transfer -->
                                <!-- Inputan File Gambar Masih Dalam Tahap Uji Coba -->
                                <input type="file" accept="image/*" @change="handleFileChange" class="tw-mb-4 tw-w-full">
                                </div>

                                <div class="tw-flex tw-justify-center tw-gap-4">
                                    <button
                                    @click="isModalMandatoryOpen = false" class="tw-bg-red-600 tw-text-white tw-rounded-lg tw-mt-5 tw-px-4 tw-py-2 hover:tw-brightness-110"
                                    > Batal
                                    </button>
                                    <!-- Button simpan belom bisa dipake -->
                                    <button
                                    @click="simpanData" class="tw-bg-green-600 tw-text-white tw-rounded-lg tw-mt-5 tw-px-4 tw-py-2 hover:tw-brightness-110"
                                    > Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </Teleport>
                </div>

                <div class="tw-bg-white tw-rounded-xl tw-shadow-sm tw-p-4 tw-flex tw-flex-col tw-gap-3">
                    <div class="tw-flex tw-justify-between tw-items-center">
                    <span class="tw-text-gray-700 tw-font-medium">Simpanan Sukarela</span>
                    <span class="tw-text-orange-600 tw-font-semibold">Rp 1.500.000</span>
                    </div>
                    <button @click="isModalVoluntaryOpen = true" round class="tw-font-semibold tw-py-2 tw-shadow-md hover:tw-brightness-110 tw-transition">
                    <van-icon name="add-o" class="tw-mr-2" />
                    Tambah Simpanan Sukarela
                    </button>
                    <Teleport to="body"> <!-- Model -->
                        <div
                            v-if="isModalVoluntaryOpen"
                            class="tw-fixed tw-inset-0 tw-bg-black/50 tw-flex tw-items-center tw-justify-center tw-z-[9999]"
                        >
                            <div class="tw-bg-white tw-rounded-xl tw-shadow-xl tw-w-96 tw-p-6 tw-text-center">
                                <h3 class="tw-text-lg tw-font-semibold tw-mb-4">Tambah Simpanan Sukarela</h3>
                                <div class="tw-text-left">
                                <label class="tw-block tw-text-gray-700 tw-font-medium tw-mb-1">Nominal Simpanan</label> <!-- Input Nominal -->
                                <input
                                    v-model="nominal" type="number" placeholder="Masukkan nominal"
                                    class="tw-w-full tw-border tw-border-gray-300 tw-rounded-lg tw-px-3 tw-py-2 focus:tw-ring-2 focus:tw-ring-indigo-500 focus:tw-outline-none"
                                />
                                </div>

                                <div class="tw-text-left">
                                <label class="tw-block tw-mt-5 tw-text-gray-700 tw-font-medium tw-mb-1">Catatan</label> <!-- Input Catatan -->
                                <input
                                    v-model="catatan" type="text" placeholder="Tambahkan catatan (opsional)"
                                    class="tw-w-full tw-border tw-border-gray-300 tw-rounded-lg tw-px-3 tw-py-2 focus:tw-ring-2 focus:tw-ring-indigo-500 focus:tw-outline-none"
                                />
                                </div>

                                <div class="tw-text-left">
                                <label class="tw-block tw-mt-5 tw-text-gray-700 tw-font-medium tw-mb-1">Bukti Pembayaran</label> <!-- Input Bukti Pembayaran -->
                                <!-- Inputan File Gambar Masih Dalam Tahap Uji Coba -->
                                <input type="file" accept="image/*" @change="handleFileChange" class="tw-mb-4 tw-w-full">
                                </div>

                                <div class="tw-flex tw-justify-center tw-gap-4">
                                    <button
                                    @click="isModalVoluntaryOpen = false" class="tw-bg-red-600 tw-text-white tw-rounded-lg tw-mt-5 tw-px-4 tw-py-2 hover:tw-brightness-110"
                                    > Batal
                                    </button>
                                    <!-- Button simpan belum bisa digunakan -->
                                    <button
                                    @click="simpanData" class="tw-bg-green-600 tw-text-white tw-rounded-lg tw-mt-5 tw-px-4 tw-py-2 hover:tw-brightness-110"
                                    > Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </Teleport>
                </div>
            </div>
        </div>

        <div class="tw-p-5 tw-flex tw-flex-col tw-items-center tw-gap-5">
            <div class="tw-bg-gradient-to-r tw-from-blue-900 tw-to-orange-500 tw-rounded-2xl tw-w-full tw-text-white tw-p-6 tw-shadow-xl">
                <h1 class="tw-text-xl tw-font-bold tw-text-center tw-mb-6 tw-tracking-wide">
                History Simpanan Anggota
                </h1>

                <div class="tw-bg-white/20 tw-rounded-xl tw-p-4 tw-mb-4 tw-shadow-inner">
                    <p class="tw-text-lg tw-font-semibold tw-mb-2 tw-text-white/90">Simpanan Wajib</p>
                    <table class="tw-w-full tw-text-sm tw-text-left tw-border-collapse">
                        <tbody>
                            <tr class="hover:tw-bg-white/10 tw-transition">
                                <td class="tw-py-2 tw-pr-3 tw-text-white/90">Tanggal Terakhir</td>
                                <td class="tw-py-2 tw-pr-3">:</td>
                                <td class="tw-py-2 tw-font-semibold">29/02/2026</td>
                            </tr>
                            <tr class="hover:tw-bg-white/10 tw-transition">
                                <td class="tw-py-2 tw-pr-3 tw-text-white/90">Nominal Terakhir</td>
                                <td class="tw-py-2 tw-pr-3">:</td>
                                <td class="tw-py-2 tw-font-semibold">Rp 5.000.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="tw-bg-white/20 tw-rounded-xl tw-p-4 tw-mb-4 tw-shadow-inner">
                    <p class="tw-text-lg tw-font-semibold tw-mb-2 tw-text-white/90">Simpanan Pokok</p>
                    <table class="tw-w-full tw-text-sm tw-text-left tw-border-collapse">
                        <tbody>
                            <tr class="hover:tw-bg-white/10 tw-transition">
                                <td class="tw-py-2 tw-pr-3 tw-text-white/90">Tanggal Terakhir</td>
                                <td class="tw-py-2 tw-pr-3">:</td>
                                <td class="tw-py-2 tw-font-semibold">29/02/2026</td>
                            </tr>
                            <tr class="hover:tw-bg-white/10 tw-transition">
                                <td class="tw-py-2 tw-pr-3 tw-text-white/90">Nominal Terakhir</td>
                                <td class="tw-py-2 tw-pr-3">:</td>
                                <td class="tw-py-2 tw-font-semibold">Rp 6.000.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="tw-bg-white/20 tw-rounded-xl tw-p-4 tw-shadow-inner">
                    <p class="tw-text-lg tw-font-semibold tw-mb-2 tw-text-white/90">Simpanan Sukarela</p>
                    <table class="tw-w-full tw-text-sm tw-text-left tw-border-collapse">
                        <tbody>
                            <tr class="hover:tw-bg-white/10 tw-transition">
                                <td class="tw-py-2 tw-pr-3 tw-text-white/90">Tanggal Terakhir</td>
                                <td class="tw-py-2 tw-pr-3">:</td>
                                <td class="tw-py-2 tw-font-semibold">29/02/2026</td>
                            </tr>
                            <tr class="hover:tw-bg-white/10 tw-transition">
                                <td class="tw-py-2 tw-pr-3 tw-text-white/90">Nominal Terakhir</td>
                                <td class="tw-py-2 tw-pr-3">:</td>
                                <td class="tw-py-2 tw-font-semibold">Rp 1.500.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </AuthenticatedLayout>
</template>
