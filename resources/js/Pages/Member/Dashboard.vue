<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import { Wallet } from "lucide-vue-next";

const page = usePage();
const user = computed(() => page.props.auth.user);
</script>

<template>
    <Head title="Member Dashboard" />

    <AuthenticatedLayout>
        <div class="tw-mx-auto tw-max-w-5xl tw-space-y-6 sm:tw-px-6 lg:tw-px-8">
            <h1 class="tw-text-1xl tw-font-bold tw-text-gray-800 tw-my-3">
                Selamat datang, {{ user?.name ?? "" }}!
            </h1>
        </div>
        <div
            class="tw-row tw-gap-4 tw-flex tw-justify-between my-5 tw-bg-gray-200 tw-rounded-lg tw-p-4"
        >
            <div class="tw-container">
                <div class="tw-row tw-flex tw-justify-evenly tw-gap-4">
                    <div class="tw-col">
                        <span class="tw-text-black tw-font-bold tw-text-start"
                            >Aksi Cepat</span
                        >
                    </div>
                </div>
                <div class="tw-row">
                    <Wallet />
                </div>
            </div>
            <!-- <div
                class="tw-col tw-bg-[var(--color-primary)] tw-rounded-lg tw-p-5"
            >
                <h4 class="tw-text-white tw-text-lg">Total Saldo</h4>
                <h3 class="tw-text-white tw-text-2xl tw-text-end">
                    Rp. 3.000.000
                </h3>
            </div> -->
        </div>
        <div class="tw-row">
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
