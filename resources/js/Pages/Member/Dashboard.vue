<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import MemberQuickActions from "@/Components/member/MemberQuickActions.vue";
import ProductRecommendationCard from "@/Components/member/ProductRecommendationCard.vue";
import { Head, router, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage();
const user = computed(() => page.props.auth.user);

const quickActions = computed(() => [
    {
        label: "Keuangan",
        icon: "Wallet",
        href: route("member.finances"),
    },
    {
        label: "Status Pembiayaan",
        icon: "FileText",
        href: route("member.status"),
    },
    {
        label: "Lihat Produk",
        icon: "ShoppingBag",
        href: route("member.products"),
        comingSoon: false,
    },
    {
        label: "Ajukan Murabahah",
        icon: "HandCoins",
        href: null,
        comingSoon: true,
    },
    {
        label: "Setor Simpanan",
        icon: "PiggyBank",
        href: null,
        comingSoon: true,
    },
    {
        label: "Tagihan Cicilan",
        icon: "Receipt",
        href: null,
        comingSoon: true,
    },
]);

const recommendedProducts = [
    {
        id: 1,
        title: "iPad Pro 12.9 256GB",
        description:
            "Tablet premium untuk menunjang produktivitas dan kreatifitas harian.",
        price: "20.000.000",
        currency: "Rp. ",
        quantity: 2,
        thumbnail: "https://fastly.jsdelivr.net/npm/@vant/assets/ipad.jpeg",
        tag: "Cash Only",
        tagType: "danger",
    },
    {
        id: 2,
        title: "Laptop Kerja Syariah",
        description:
            "Laptop ringan dengan cicilan murabahah khusus anggota aktif.",
        price: "12.500.000",
        currency: "Rp. ",
        quantity: 1,
        thumbnail: "https://fastly.jsdelivr.net/npm/@vant/assets/ipad.jpeg",
        tag: "Cicilan",
        tagType: "primary",
    },
    {
        id: 3,
        title: "Laptop Kerja Syariah",
        description:
            "Laptop ringan dengan cicilan murabahah khusus anggota aktif.",
        price: "12.500.000",
        currency: "Rp. ",
        quantity: 1,
        thumbnail: "https://fastly.jsdelivr.net/npm/@vant/assets/ipad.jpeg",
        tag: "Cicilan",
        tagType: "primary",
    },
];

const handleQuickAction = (action) => {
    if (action?.href && !action?.comingSoon) {
        router.visit(action.href);
    }
};
</script>

<template>
    <Head title="Member Dashboard" />

    <AuthenticatedLayout>
        <div class="tw-mx-auto tw-max-w-5xl tw-space-y-6 sm:tw-px-6 lg:tw-px-8">
            <h1 class="tw-my-3 tw-text-3xl tw-font-bold tw-text-gray-800">
                Selamat datang, {{ user?.name ?? "" }}!
            </h1>

            <MemberQuickActions
                :actions="quickActions"
                @select="handleQuickAction"
            />
        </div>

        <div
            class="tw-mx-auto tw-mt-6 tw-grid tw-w-full sm:tw-px-6 tw-max-w-5xl tw-grid-cols-2 tw-gap-3 md:tw-grid-cols-3 lg:tw-px-8"
        >
            <ProductRecommendationCard
                v-for="product in recommendedProducts"
                :key="product.id"
                :title="product.title"
                :description="product.description"
                :price="product.price"
                :currency="product.currency"
                :quantity="product.quantity"
                :thumbnail="product.thumbnail"
                :tag="product.tag"
                :tag-type="product.tagType"
            />
        </div>
    </AuthenticatedLayout>
</template>
