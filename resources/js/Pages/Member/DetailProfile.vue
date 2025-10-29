<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps({
    user: Object,
    member: Object,
});
</script>

<template>
    <Head title="Profil Saya" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="tw-text-xl tw-font-semibold tw-leading-tight tw-text-gray-800"
            >
                Profil Saya
            </h2>
        </template>

        <div class="tw-py-6">
            <div class="tw-max-w-3xl tw-mx-auto tw-space-y-4">
                <div class="tw-bg-white tw-p-6 tw-shadow sm:tw-rounded-lg">
                    <h3 class="tw-text-lg tw-font-medium tw-mb-4">Akun</h3>
                    <dl
                        class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 tw-gap-4"
                    >
                        <div>
                            <dt class="tw-text-sm tw-text-gray-500">Nama</dt>
                            <dd class="tw-mt-1 tw-text-sm tw-text-gray-900">
                                {{ props.user?.name }}
                            </dd>
                        </div>
                        <div>
                            <dt class="tw-text-sm tw-text-gray-500">Email</dt>
                            <dd class="tw-mt-1 tw-text-sm tw-text-gray-900">
                                {{ props.user?.email }}
                            </dd>
                        </div>
                    </dl>
                </div>

                <div class="tw-bg-white tw-p-6 tw-shadow sm:tw-rounded-lg">
                    <h3 class="tw-text-lg tw-font-medium tw-mb-4">
                        Detail Anggota
                    </h3>
                    <dl
                        class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 tw-gap-4"
                    >
                        <div>
                            <dt class="tw-text-sm tw-text-gray-500">
                                Nomor Anggota
                            </dt>
                            <dd class="tw-mt-1 tw-text-sm tw-text-gray-900">
                                {{ props.member?.member_id_number ?? "-" }}
                            </dd>
                        </div>
                        <div>
                            <dt class="tw-text-sm tw-text-gray-500">
                                Unit / Fakultas
                            </dt>
                            <dd class="tw-mt-1 tw-text-sm tw-text-gray-900">
                                {{ props.member?.faculty_or_unit ?? "-" }}
                            </dd>
                        </div>
                        <div>
                            <dt class="tw-text-sm tw-text-gray-500">Status</dt>
                            <dd class="tw-mt-1 tw-text-sm tw-text-gray-900">
                                {{ props.member?.status ?? "-" }}
                            </dd>
                        </div>
                    </dl>

                    <div class="tw-mt-6 tw-flex tw-justify-end">
                        <Link
                            :href="route('profile.edit')"
                            class="btn btn-primary"
                        >
                            Edit Profil
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
