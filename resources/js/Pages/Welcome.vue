<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: {
        type: Boolean,
        default: false,
    },
    canRegister: {
        type: Boolean,
        default: false,
    },
    laravelVersion: {
        type: String,
        default: "",
    },
    phpVersion: {
        type: String,
        default: "",
    },
});

const currentYear = new Date().getFullYear();
</script>

<template>
    <Head title="KopSy-Campus Polban" />
    <div
        class="tw-flex tw-min-h-screen tw-flex-col tw-bg-muted tw-text-gray-900"
    >
        <header class="tw-bg-secondary-light">
            <div
                class="tw-mx-auto tw-flex tw-w-full tw-max-w-6xl tw-items-center tw-justify-between tw-gap-6 tw-px-6 tw-py-6"
            >
                <div class="tw-flex tw-items-center tw-gap-4">
                    <img
                        src="/img/logo.png"
                        class="tw-h-12 tw-w-12"
                        alt="KopSy-Campus Logo"
                    />
                    <div>
                        <p
                            class="tw-text-lg tw-font-semibold tw-text-secondary"
                        >
                            KopSy-Campus
                        </p>
                        <p class="tw-text-sm tw-text-secondary/70">
                            Koperasi Syariah Digital Polban
                        </p>
                    </div>
                </div>
                <div
                    v-if="canLogin"
                    class="tw-flex tw-flex-wrap tw-items-center tw-gap-3"
                >
                    <Link
                        :href="route('login')"
                        class="tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-border tw-border-secondary tw-px-5 tw-py-2 tw-text-sm tw-font-medium tw-text-secondary tw-transition hover:tw-bg-secondary hover:tw-text-secondary-contrast"
                    >
                        Masuk
                    </Link>
                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-bg-primary tw-px-5 tw-py-2 tw-text-sm tw-font-medium tw-text-primary-contrast tw-shadow hover:tw-bg-ternary hover:tw-text-ternary-contrast"
                    >
                        Daftar Anggota
                    </Link>
                </div>
            </div>
        </header>

        <main class="tw-flex-grow">
            <section
                class="tw-bg-gradient-to-br tw-from-secondary tw-via-secondary tw-to-primary tw-px-6 tw-py-16 tw-text-primary-contrast"
            >
                <div
                    class="tw-mx-auto tw-flex tw-max-w-6xl tw-flex-col tw-gap-12 lg:tw-flex-row lg:tw-items-center"
                >
                    <div class="tw-space-y-6 lg:tw-w-1/2">
                        <span
                            class="tw-inline-flex tw-items-center tw-rounded-full tw-bg-secondary-light tw-px-4 tw-py-1 tw-text-xs tw-font-medium tw-uppercase tw-tracking-wide tw-text-primary-contrast/80"
                        >
                            Politeknik Negeri Bandung
                        </span>
                        <h1
                            class="tw-text-4xl tw-font-bold tw-leading-tight lg:tw-text-5xl"
                        >
                            Koperasi Syariah Terintegrasi Untuk Keluarga Besar
                            Polban
                        </h1>
                        <p
                            class="tw-text-base tw-leading-relaxed tw-text-primary-contrast/90"
                        >
                            KopSy-Campus menghadirkan sistem koperasi digital
                            yang menyatukan marketplace, pengelolaan simpanan,
                            dan pembiayaan
                            <em>Murabahah</em> dalam satu platform terpercaya.
                            Dirancang khusus untuk kebutuhan mahasiswa, dosen,
                            dan tenaga kependidikan Politeknik Negeri Bandung.
                        </p>
                        <div class="tw-flex tw-flex-wrap tw-gap-3">
                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-bg-primary tw-px-6 tw-py-3 tw-text-sm tw-font-semibold tw-text-primary-contrast tw-shadow-lg tw-transition hover:tw-scale-[1.02] hover:tw-bg-ternary hover:tw-text-ternary-contrast"
                            >
                                Bergabung Sekarang
                            </Link>
                            <Link
                                v-if="canLogin"
                                :href="route('login')"
                                class="tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-border tw-border-primary-contrast/40 tw-px-6 tw-py-3 tw-text-sm tw-font-semibold tw-text-primary-contrast tw-transition hover:tw-bg-primary-contrast hover:tw-text-secondary"
                            >
                                Jelajahi Fitur
                            </Link>
                        </div>
                    </div>
                    <div class="tw-w-full lg:tw-w-1/2">
                        <div
                            class="tw-rounded-3xl tw-bg-primary-contrast/15 tw-p-8 tw-shadow-xl tw-backdrop-blur"
                        >
                            <h2
                                class="tw-text-lg tw-font-semibold tw-text-primary-contrast"
                            >
                                Satu Portal, Beragam Solusi
                            </h2>
                            <ul
                                class="tw-mt-6 tw-space-y-4 tw-text-sm tw-text-primary-contrast/90"
                            >
                                <li class="tw-flex tw-items-start tw-gap-3">
                                    <span
                                        class="tw-mt-1 tw-flex tw-h-6 tw-w-6 tw-items-center tw-justify-center tw-text-xs tw-font-semibold tw-text-primary-contrast"
                                    >
                                        1
                                    </span>
                                    <p>
                                        <strong>Akses Terpusat</strong> untuk
                                        anggota Polban: belanja, simpanan, dan
                                        pembiayaan dalam satu akun.
                                    </p>
                                </li>
                                <li class="tw-flex tw-items-start tw-gap-3">
                                    <span
                                        class="tw-mt-1 tw-flex tw-h-6 tw-w-6 tw-items-center tw-justify-center tw-text-xs tw-font-semibold tw-text-primary-contrast"
                                    >
                                        2
                                    </span>
                                    <p>
                                        <strong>Akad Syariah Transparan</strong>
                                        dengan perhitungan margin otomatis dan
                                        persetujuan digital.
                                    </p>
                                </li>
                                <li class="tw-flex tw-items-start tw-gap-3">
                                    <span
                                        class="tw-mt-1 tw-flex tw-h-6 tw-w-6 tw-items-center tw-justify-center tw-text-xs tw-font-semibold tw-text-primary-contrast"
                                    >
                                        3
                                    </span>
                                    <p>
                                        <strong
                                            >Monitoring Simpanan
                                            Real-Time</strong
                                        >
                                        untuk memudahkan perencanaan keuangan
                                        anggota.
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <section class="tw-px-6 tw-py-16">
                <div class="tw-mx-auto tw-max-w-6xl">
                    <h2 class="tw-text-2xl tw-font-semibold tw-text-secondary">
                        Mengapa KopSy-Campus Penting untuk Polban?
                    </h2>
                    <p
                        class="tw-mt-4 tw-max-w-3xl tw-text-base tw-text-gray-600"
                    >
                        Kami merangkum kebutuhan nyata koperasi kampus: tata
                        kelola anggota yang rapi, transaksi usaha yang
                        transparan, dan layanan pembiayaan yang sesuai prinsip
                        syariah. Setiap modul kami kembangkan untuk mendukung
                        kemandirian finansial civitas akademika Polban.
                    </p>
                    <div class="tw-mt-10 tw-grid tw-gap-6 lg:tw-grid-cols-2">
                        <div
                            class="tw-rounded-2xl tw-bg-surface tw-p-6 tw-shadow-sm"
                        >
                            <h3
                                class="tw-text-lg tw-font-semibold tw-text-secondary"
                            >
                                Keanggotaan Terverifikasi
                            </h3>
                            <p class="tw-mt-3 tw-text-sm tw-text-gray-600">
                                Registrasi, verifikasi oleh pengurus, dan
                                dashboard personal yang menampilkan status serta
                                ringkasan simpanan anggota.
                            </p>
                        </div>
                        <div
                            class="tw-rounded-2xl tw-bg-surface tw-p-6 tw-shadow-sm"
                        >
                            <h3
                                class="tw-text-lg tw-font-semibold tw-text-secondary"
                            >
                                Pengelolaan Simpanan
                            </h3>
                            <p class="tw-mt-3 tw-text-sm tw-text-gray-600">
                                Catatan simpanan pokok, wajib, maupun sukarela
                                yang rapi, lengkap dengan riwayat transaksi dan
                                laporan buku besar.
                            </p>
                        </div>
                        <div
                            class="tw-rounded-2xl tw-bg-surface tw-p-6 tw-shadow-sm"
                        >
                            <h3
                                class="tw-text-lg tw-font-semibold tw-text-secondary"
                            >
                                Marketplace Syariah Polban
                            </h3>
                            <p class="tw-mt-3 tw-text-sm tw-text-gray-600">
                                Katalog produk kampus dengan opsi pembayaran
                                tunai maupun cicilan syariah, siap mendukung
                                kebutuhan sehari-hari.
                            </p>
                        </div>
                        <div
                            class="tw-rounded-2xl tw-bg-surface tw-p-6 tw-shadow-sm"
                        >
                            <h3
                                class="tw-text-lg tw-font-semibold tw-text-secondary"
                            >
                                Pelaporan & SHU
                            </h3>
                            <p class="tw-mt-3 tw-text-sm tw-text-gray-600">
                                Laporan penjualan, piutang, dan kalkulator
                                distribusi SHU untuk memastikan transparansi dan
                                keadilan bagi seluruh anggota.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="tw-bg-surface tw-px-6 tw-py-16">
                <div
                    class="tw-mx-auto tw-max-w-5xl tw-rounded-3xl tw-bg-secondary-light tw-px-8 tw-py-12"
                >
                    <h2 class="tw-text-2xl tw-font-semibold tw-text-secondary">
                        Mulai Bersama, Bertumbuh Bersama
                    </h2>
                    <p class="tw-mt-4 tw-text-base tw-text-secondary/80">
                        KopSy-Campus mengajak seluruh keluarga besar Politeknik
                        Negeri Bandung untuk membangun ekosistem ekonomi kampus
                        yang aman, modern, dan sesuai syariah. Dari belanja
                        kebutuhan hingga pembiayaan pendidikan, mari wujudkan
                        koperasi digital yang berdampak.
                    </p>
                    <div class="tw-mt-8 tw-flex tw-flex-wrap tw-gap-3">
                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-bg-secondary tw-px-6 tw-py-3 tw-text-sm tw-font-semibold tw-text-secondary-contrast tw-shadow hover:tw-bg-secondary/90"
                        >
                            Daftar Sebagai Anggota Polban
                        </Link>
                        <Link
                            v-if="canLogin"
                            :href="route('login')"
                            class="tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-border tw-border-secondary tw-px-6 tw-py-3 tw-text-sm tw-font-semibold tw-text-secondary tw-transition hover:tw-bg-secondary hover:tw-text-secondary-contrast"
                        >
                            Masuk untuk Pengurus
                        </Link>
                    </div>
                </div>
            </section>
        </main>

        <footer class="tw-border-t tw-border-gray-200 tw-bg-surface tw-py-6">
            <div
                class="tw-mx-auto tw-flex tw-max-w-6xl tw-flex-col tw-items-center tw-gap-2 tw-px-6 md:tw-flex-row md:tw-justify-between"
            >
                <p class="tw-text-sm tw-text-gray-500">
                    © {{ currentYear }} KopSy-Campus — Politeknik Negeri
                    Bandung.
                </p>
                <p class="tw-text-xs tw-text-gray-400">
                    Laravel v{{ laravelVersion }} · PHP v{{ phpVersion }}
                </p>
            </div>
        </footer>
    </div>
</template>
