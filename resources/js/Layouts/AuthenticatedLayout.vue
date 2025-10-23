<script setup>
import { computed, ref, watch } from "vue";
import { router, usePage } from "@inertiajs/vue3";

import AdminSidebar from "@/Components/navigation/AdminSidebar.vue";
import AdminMobileNav from "@/Components/navigation/AdminMobileNav.vue";
import MemberTopBar from "@/Components/navigation/MemberTopBar.vue";
import MemberBottomNav from "@/Components/navigation/MemberBottomNav.vue";
import MemberMobileSearchBar from "@/Components/navigation/MemberMobileSearchBar.vue";

const page = usePage();

const roles = computed(() => new Set(page.props.auth?.roles ?? []));
const user = computed(() => page.props.auth?.user ?? null);

const hasRole = (role) => roles.value.has(role);

const isSuperAdmin = computed(() => hasRole("Super Admin"));
const isAdminLike = computed(() => isSuperAdmin.value || hasRole("Admin"));

const adminLinks = [
    {
        name: "admin.dashboard",
        label: "Dashboard",
        icon: "wap-home-o",
        patterns: ["admin.dashboard"],
    },
    {
        name: "admin.products",
        label: "Kelola Produk",
        icon: "shop-o",
        patterns: ["admin.products"],
    },
    {
        name: "admin.members",
        label: "Kelola Anggota",
        icon: "friends-o",
        patterns: ["admin.members"],
    },
    {
        name: "admin.approvals",
        label: "Approval",
        icon: "todo-list-o",
        patterns: ["admin.approvals"],
    },
    {
        name: "admin.ledger",
        label: "Ledger",
        icon: "notes-o",
        patterns: ["admin.ledger"],
    },
    {
        name: "profile.edit",
        label: "Profile",
        icon: "user-o",
        patterns: ["profile.*"],
    },
];

const superAdminLinks = [
    {
        name: "superadmin.dashboard",
        label: "Kelola Admin",
        icon: "manager-o",
        patterns: ["superadmin.dashboard"],
    },
    {
        name: "profile.edit",
        label: "Profile",
        icon: "user-o",
        patterns: ["profile.*"],
    },
];

const memberLinks = [
    {
        name: "member.dashboard",
        label: "Home",
        icon: "home-o",
        patterns: ["member.dashboard"],
    },
    {
        name: "member.finances",
        label: "Keuangan",
        icon: "balance-o",
        patterns: ["member.finances"],
    },
    {
        name: "member.status",
        label: "Status",
        icon: "todo-list-o",
        patterns: ["member.status"],
    },
    {
        name: "profile.edit",
        label: "Profile",
        icon: "user-circle-o",
        patterns: ["profile.*"],
    },
];

const sidebarOpen = ref(false);

const isActive = (patterns) =>
    (patterns ?? []).some((pattern) => route().current(pattern));

const currentSidebarLinks = computed(() =>
    (isSuperAdmin.value ? superAdminLinks : adminLinks).map((link) => ({
        ...link,
        href: route(link.name),
        active: isActive(link.patterns ?? [link.name]),
    })),
);

const sidebarTitle = computed(() =>
    isSuperAdmin.value ? "KopSy Super Admin" : "KopSy Admin",
);

const currentMemberLinks = computed(() =>
    memberLinks.map((link) => ({
        ...link,
        href: route(link.name),
        active: isActive(link.patterns ?? [link.name]),
    })),
);

const memberActiveIndex = computed(() => {
    const index = currentMemberLinks.value.findIndex((link) => link.active);

    return index >= 0 ? index : 0;
});

const navigateMember = (index) => {
    const target = currentMemberLinks.value[index];

    if (target) {
        router.visit(target.href);
    }
};

watch(
    () => page.url,
    () => {
        sidebarOpen.value = false;
    },
);
</script>

<template>
    <div class="tw-min-h-screen tw-bg-gray-100">
        <div v-if="isAdminLike" class="tw-flex tw-min-h-screen">
            <AdminSidebar
                :links="currentSidebarLinks"
                :title="sidebarTitle"
                :user="user"
            />

            <div class="tw-flex tw-flex-1 tw-flex-col">
                <AdminMobileNav
                    v-model="sidebarOpen"
                    :links="currentSidebarLinks"
                    :user="user"
                />

                <header
                    v-if="$slots.header"
                    class="tw-border-b tw-border-slate-200 tw-bg-white"
                >
                    <div class="tw-px-4 tw-py-6 sm:tw-px-6 lg:tw-px-8">
                        <slot name="header" />
                    </div>
                </header>

                <main class="tw-flex-1">
                    <div class="tw-px-4 tw-py-6 sm:tw-px-6 lg:tw-px-8">
                        <slot />
                    </div>
                </main>
            </div>
        </div>

        <div v-else class="tw-flex tw-min-h-screen tw-flex-col">
            <MemberMobileSearchBar :cart-route="route('member.cart')" />
            <MemberTopBar :links="currentMemberLinks" :user="user" />

            <header
                v-if="$slots.header"
                class="tw-border-b tw-border-slate-200 tw-bg-white"
            >
                <div class="tw-px-4 tw-py-6 sm:tw-px-6 lg:tw-px-8">
                    <slot name="header" />
                </div>
            </header>

            <main class="tw-flex-1">
                <div
                    class="tw-px-4 tw-py-6 tw-pb-24 sm:tw-px-6 lg:tw-px-8 md:tw-pb-12"
                >
                    <slot />
                </div>
            </main>

            <MemberBottomNav
                :links="currentMemberLinks"
                :model-value="memberActiveIndex"
                @navigate="navigateMember"
            />
        </div>
    </div>
</template>
