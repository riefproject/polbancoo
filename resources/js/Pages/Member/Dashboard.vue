<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import {
    Wallet,
    FileText,
    ShoppingBag,
    HandCoins,
    PiggyBank,
    Receipt,
    History,
    PieChart,
} from "lucide-vue-next";

const page = usePage();
const user = computed(() => page.props.auth.user);

const quickActions = [
    {
        label: "Keuangan",
        icon: Wallet,
        href: "/member/finances",
    },
    {
        label: "Status Pembiayaan",
        icon: FileText,
        href: "/member/status",
    },
    {
        label: "Lihat Produk",
        icon: ShoppingBag,
        href: "/products",
        comingSoon: true,
    },
    {
        label: "Ajukan Murabahah",
        icon: HandCoins,
        href: "/member/financing/apply",
        comingSoon: true,
    },
    {
        label: "Setor Simpanan",
        icon: PiggyBank,
        href: null,
        comingSoon: true,
    },
    {
        label: "Tagihan Cicilan",
        icon: Receipt,
        href: null,
        comingSoon: true,
    },
    {
        label: "Riwayat Pesanan",
        icon: History,
        href: "/member/orders",
        comingSoon: true,
    },
    {
        label: "SHU Saya",
        icon: PieChart,
        href: null,
        comingSoon: true,
    },
];
</script>

<template>
    <Head title="Member Dashboard" />

    <AuthenticatedLayout>
        <div class="tw-mx-auto tw-max-w-5xl tw-space-y-6 sm:tw-px-6 lg:tw-px-8">
            <h1 class="tw-text-1xl tw-font-bold tw-text-gray-800 tw-my-3">
                Selamat datang, {{ user?.name ?? "" }}!
            </h1>

            <section class="tw-bg-white tw-rounded-2xl tw-shadow-sm tw-p-5">
                <div class="tw-flex tw-items-center tw-justify-between tw-mb-3">
                    <span class="tw-text-black tw-font-semibold tw-text-base">
                        Aksi Cepat
                    </span>
                </div>
                <div
                    class="quick-actions-scroll tw-grid tw-grid-rows-2 tw-grid-flow-col tw-auto-cols-max tw-gap-3 tw-overflow-x-auto tw-pr-3 tw-pl-3 tw-pb-1"
                >
                    <component
                        v-for="action in quickActions"
                        :key="action.label"
                        :is="action.href ? Link : 'button'"
                        :href="action.href || undefined"
                        :aria-disabled="action.comingSoon"
                        class="tw-flex tw-w-28 tw-flex-col tw-items-center tw-gap-2 tw-rounded-xl tw-bg-blue-50 tw-p-3 tw-text-center tw-transition hover:tw-bg-blue-100 tw-shrink-0"
                        :class="{
                            'tw-opacity-60 tw-cursor-not-allowed hover:tw-bg-blue-50':
                                action.comingSoon,
                        }"
                        @click="
                            action.comingSoon ? $event.preventDefault() : null
                        "
                    >
                        <span
                            class="tw-flex tw-h-10 tw-w-10 tw-items-center tw-justify-center tw-rounded-full tw-bg-white tw-text-[var(--color-primary)]"
                        >
                            <component
                                :is="action.icon"
                                class="tw-h-4 tw-w-4"
                            />
                        </span>
                        <div
                            class="tw-text-xs tw-font-semibold tw-text-gray-700"
                        >
                            <p>
                                {{ action.label }}
                            </p>
                            <p
                                v-if="action.comingSoon"
                                class="tw-mt-1 tw-text-[10px] tw-font-semibold tw-uppercase tw-text-[var(--color-primary)]"
                            >
                                Segera hadir
                            </p>
                        </div>
                    </component>
                </div>
            </section>
        </div>

        <div class="tw-row tw-mt-6">
            <div class="tw-col tw-bg-gray-300">
                <van-card
                    num="2"
                    title="Title"
                    desc="Description"
                    price="2.00"
                    thumb="https://fastly.jsdelivr.net/npm/@vant/assets/ipad.jpeg"
                >
                    <template #tags>
                        <van-tag plain type="danger">Cash Only</van-tag>
                    </template>
                    <template #footer>
                        <van-button size="mini">Lihat Detail</van-button>
                        <van-button size="mini"
                            >Tambahkan ke Keranjang</van-button
                        >
                    </template>
                </van-card>
            </div>
            <div class="tw-col tw-bg-gray-300">
                <van-card
                    num="2"
                    title="Title"
                    desc="Description"
                    price="20,000,000"
                    currency="Rp. "
                    thumb="https://fastly.jsdelivr.net/npm/@vant/assets/ipad.jpeg"
                >
                    <template #tags>
                        <van-tag plain type="danger">Cicilan</van-tag>
                    </template>
                    <template #footer>
                        <van-button size="mini">Lihat Detail</van-button>
                        <van-button size="mini"
                            >Tambahkan ke Keranjang</van-button
                        >
                    </template>
                </van-card>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
.quick-actions-scroll {
    scrollbar-width: thin;
    scrollbar-color: rgba(249, 115, 22, 0.75) rgba(249, 115, 22, 0.2);
    border-radius: 20px;
}

.quick-actions-scroll::-webkit-scrollbar {
    height: 6px;
}

.quick-actions-scroll::-webkit-scrollbar-track {
    background-color: rgba(249, 115, 22, 0.2);
    border-radius: 9999px;
    margin-inline: 32px;
}

.quick-actions-scroll::-webkit-scrollbar-thumb {
    background-color: rgba(249, 115, 22, 0.9);
    border-radius: 9999px;
}

.quick-actions-scroll:hover::-webkit-scrollbar-thumb {
    background-color: rgba(249, 115, 22, 1);
}
</style>
