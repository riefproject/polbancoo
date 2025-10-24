<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />
        <div
            class="tw-container tw-flex tw-justify-center tw-align-center tw-my-5"
        >
            <div class="tw-text-lg tw-font-medium tw-text-gray-700">
                Untuk melakukan pendaftaran akun, silakan datang ke Kantor
                Koperasi Syariah POLBAN.
            </div>
        </div>
        <div class="tw-text-sm tw-text-gray-600">
            Alamat: Jl. Gegerkalong Hilir, Desa Ciwaruga, Kecamatan Parongpong,
            Kabupaten Bandung Barat, Jawa Barat 40559, Indonesia
            <div
                class="tw-mt-4 tw-flex tw-items-center tw-justify-between tw-gap-2"
            >
                <a href="/" class="tw-block tw-underline tw-text-primary"
                    >&larr; Back</a
                >
                <a
                    href="https://maps.app.goo.gl/JLe3PV5aJUoiVXtE6"
                    target="_blank"
                    class="tw-py-1 tw-px-2 tw-bg-primary tw-text-white tw-rounded-md"
                >
                    Lihat di Google Maps
                </a>
            </div>
        </div>
    </GuestLayout>
</template>
