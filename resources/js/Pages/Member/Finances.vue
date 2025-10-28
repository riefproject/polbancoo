<script setup>
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import { Head, router } from "@inertiajs/vue3";
    import { ref, computed } from "vue";

    const props = defineProps({
    totalSaldo: Number,
    simpanan: Object,
    lastUpdate: String,
    historytanggalsimpanan: Object,
    historynominalsimpanan: Object
    });

    const isModalOpen = ref(false);
    const modalType = ref(""); // Mandatory atau Voluntary //
    const nominal = ref("");
    const catatan = ref("");
    const file = ref(null);

    function openModal(type) {
        modalType.value = type;
        isModalOpen.value = true;
    }

    function closeModal() {
        isModalOpen.value = false;
        nominal.value = "";
        catatan.value = "";
    }

    const modalLabel = computed(() => {
        if (modalType.value === "Mandatory") return "Simpanan Wajib";
        if (modalType.value === "Voluntary") return "Simpanan Sukarela";
        return "";
    });

    function simpanData() {
        if (!nominal.value) {
            alert("Nominal tidak boleh kosong!");
            return;
        }

        const formData = new FormData();
        formData.append("type", modalType.value);
        formData.append("amount", nominal.value);
        formData.append("description", catatan.value);

        router.post("/member/finances/store", formData, {
            onSuccess: () => {
            alert("Transaksi berhasil dikirim!");
            closeModal();
            },
            onError: (errors) => {
            console.error(errors);
            alert("Terjadi kesalahan saat menyimpan data.");
            },
        });
    }
</script>

<template>
    <Head title="Keuangan Anggota" />

    <AuthenticatedLayout>
        <template #header>
        <h2 class="tw-text-xl tw-font-semibold tw-leading-tight tw-text-gray-800">
            Keuangan Saya
        </h2>
        </template>

        <!-- Total Saldo -->
        <div class="tw-bg-gray-50 tw-p-5 tw-flex tw-flex-col tw-items-center tw-gap-5">
            <div class="tw-bg-gradient-to-r tw-from-orange-500 tw-to-orange-400 tw-rounded-2xl tw-w-full tw-text-white tw-p-6 tw-shadow-lg" >
                <h3 class="tw-text-lg tw-font-medium">Total Saldo</h3>
                <p class="tw-text-3xl tw-font-bold tw-mt-2">
                Rp {{ totalSaldo.toLocaleString("id-ID") }}
                </p>
                <p class="tw-text-sm tw-opacity-80 tw-mt-1">Update: {{ lastUpdate }}</p>
            </div>

            <!-- Simpanan -->
            <div class="tw-grid tw-grid-cols-1 tw-gap-4 tw-w-full">
                <!-- Simpanan Pokok -->
                <div class="tw-bg-white tw-rounded-xl tw-shadow-sm tw-p-4 tw-flex tw-justify-between tw-items-center" >
                    <div>
                        <span class="tw-text-gray-700 tw-font-medium">Simpanan Pokok</span>
                    </div>
                    <div class="tw-text-right">
                        <p class="tw-text-orange-600 tw-font-semibold">
                        Rp {{ props.simpanan.pokok.toLocaleString("id-ID") }}
                        </p>
                    </div>
                </div>

                <!-- Simpanan Wajib -->
                <div class="tw-bg-white tw-rounded-xl tw-shadow-sm tw-p-4 tw-flex tw-justify-between tw-items-center" >
                    <div>
                        <span class="tw-text-gray-700 tw-font-medium">Simpanan Wajib</span>
                    </div>
                    <div class="tw-text-right">
                        <p class="tw-text-orange-600 tw-font-semibold">
                        Rp {{ props.simpanan.wajib.toLocaleString("id-ID") }}
                        </p>
                        <button @click="openModal('Mandatory')" class="tw-bg-orange-500 tw-text-white tw-rounded-lg tw-px-3 tw-py-1 tw-text-sm hover:tw-brightness-110 tw-transition tw-mt-2" >
                            <van-icon name="add-o" class="tw-text-lg" />
                            Tambah
                        </button>
                    </div>
                </div>

                <!-- Simpanan Sukarela -->
                <div class="tw-bg-white tw-rounded-xl tw-shadow-sm tw-p-4 tw-flex tw-justify-between tw-items-center" >
                    <div>
                        <span class="tw-text-gray-700 tw-font-medium">Simpanan Sukarela</span>
                    </div>
                    <div class="tw-text-right">
                        <p class="tw-text-orange-600 tw-font-semibold">
                        Rp {{ props.simpanan.sukarela.toLocaleString("id-ID") }}
                        </p>
                        <button @click="openModal('Voluntary')" class="tw-bg-orange-500 tw-text-white tw-rounded-lg tw-px-3 tw-py-1 tw-text-sm hover:tw-brightness-110 tw-transition tw-mt-2" >
                            <van-icon name="add-o" class="tw-text-lg" />
                            Tambah
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <Teleport to="body">
        <div v-if="isModalOpen" class="tw-fixed tw-inset-0 tw-bg-black/50 tw-flex tw-items-center tw-justify-center tw-z-[9999]" >
            <div class="tw-bg-white tw-rounded-xl tw-shadow-xl tw-w-96 tw-p-6">
                <h3 class="tw-text-lg tw-font-semibold tw-text-center tw-mb-4">
                    Tambah {{ modalLabel }}
                </h3>

                <div class="tw-text-left">
                    <label class="tw-block tw-text-gray-700 tw-font-medium tw-mb-1"
                    >Nominal Simpanan</label>
                    <input v-model="nominal" type="number" placeholder="Masukkan nominal"
                    class="tw-w-full tw-border tw-border-gray-300 tw-rounded-lg tw-px-3 tw-py-2 focus:tw-ring-2 focus:tw-ring-indigo-500 focus:tw-outline-none"
                    />
                </div>

                <div class="tw-text-left">
                    <label class="tw-block tw-mt-4 tw-text-gray-700 tw-font-medium tw-mb-1"
                    >Catatan</label>
                    <input v-model="catatan" type="text" placeholder="Tambahkan catatan (opsional)"
                    class="tw-w-full tw-border tw-border-gray-300 tw-rounded-lg tw-px-3 tw-py-2 focus:tw-ring-2 focus:tw-ring-indigo-500 focus:tw-outline-none"
                    />
                </div>

                <!-- <div class="tw-text-left">
                    <label class="tw-block tw-mt-4 tw-text-gray-700 tw-font-medium tw-mb-1"
                    >Bukti Pembayaran</label>
                    <input type="file" accept="image/*" @change="handleFileChange"
                    class="tw-w-full tw-border tw-border-gray-300 tw-rounded-lg tw-px-3 tw-py-2"
                    />
                </div> -->

                <div class="tw-flex tw-justify-center tw-gap-4 tw-mt-6">
                    <button @click="closeModal"
                    class="tw-bg-red-600 tw-text-white tw-rounded-lg tw-px-4 tw-py-2 hover:tw-brightness-110"
                    >Batal</button>
                    <button @click="simpanData"
                    class="tw-bg-green-600 tw-text-white tw-rounded-lg tw-px-4 tw-py-2 hover:tw-brightness-110"
                    >Simpan</button>
                </div>
            </div>
        </div>
        </Teleport>

        <div class="tw-p-5 tw-flex tw-flex-col tw-items-center tw-gap-5">
            <div class="tw-bg-gradient-to-r tw-from-blue-900 tw-to-orange-500 tw-rounded-2xl tw-w-full tw-text-white tw-p-6 tw-shadow-xl">
                <h1 class="tw-text-xl tw-font-bold tw-text-center tw-mb-6 tw-tracking-wide">
                History Simpanan Anggota
                </h1>

                <div class="tw-bg-white/20 tw-rounded-xl tw-p-4 tw-mb-4 tw-shadow-inner">
                    <p class="tw-text-lg tw-font-semibold tw-mb-2 tw-text-white/90">Simpanan Pokok</p>
                    <table class="tw-w-full tw-text-sm tw-text-left tw-border-collapse">
                        <tbody>
                            <tr class="hover:tw-bg-white/10 tw-transition">
                                <td class="tw-py-2 tw-pr-3 tw-text-white/90">Tanggal Terakhir</td>
                                <td class="tw-py-2 tw-pr-3">:</td>
                                <td class="tw-py-2 tw-font-semibold">{{ props.historytanggalsimpanan.historypokok }}</td>
                            </tr>
                            <tr class="hover:tw-bg-white/10 tw-transition">
                                <td class="tw-py-2 tw-pr-3 tw-text-white/90">Nominal Terakhir</td>
                                <td class="tw-py-2 tw-pr-3">:</td>
                                <td class="tw-py-2 tw-font-semibold">Rp {{ Number(props.historynominalsimpanan.nominalhistorypokok ?? 0).toLocaleString('id-ID') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="tw-bg-white/20 tw-rounded-xl tw-p-4 tw-mb-4 tw-shadow-inner">
                    <p class="tw-text-lg tw-font-semibold tw-mb-2 tw-text-white/90">Simpanan Wajib</p>
                    <table class="tw-w-full tw-text-sm tw-text-left tw-border-collapse">
                        <tbody>
                            <tr class="hover:tw-bg-white/10 tw-transition">
                                <td class="tw-py-2 tw-pr-3 tw-text-white/90">Tanggal Terakhir</td>
                                <td class="tw-py-2 tw-pr-3">:</td>
                                <td class="tw-py-2 tw-font-semibold">{{ props.historytanggalsimpanan.historywajib }}</td>
                            </tr>
                            <tr class="hover:tw-bg-white/10 tw-transition">
                                <td class="tw-py-2 tw-pr-3 tw-text-white/90">Nominal Terakhir</td>
                                <td class="tw-py-2 tw-pr-3">:</td>
                                <td class="tw-py-2 tw-font-semibold">Rp {{ Number(props.historynominalsimpanan.nominalhistorywajib ?? 0).toLocaleString('id-ID') }}</td>
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
                                <td class="tw-py-2 tw-font-semibold">{{ props.historytanggalsimpanan.historysukarela }}</td>
                            </tr>
                            <tr class="hover:tw-bg-white/10 tw-transition">
                                <td class="tw-py-2 tw-pr-3 tw-text-white/90">Nominal Terakhir</td>
                                <td class="tw-py-2 tw-pr-3">:</td>
                                <td class="tw-py-2 tw-font-semibold">Rp {{ Number(props.historynominalsimpanan.nominalhistorysukarela ?? 0).toLocaleString('id-ID') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>