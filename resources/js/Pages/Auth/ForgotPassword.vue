<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Link, Head, useForm } from "@inertiajs/vue3";

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
});

const submit = () => {
    form.post(route("password.email"));
};
</script>

<template>
    <GuestLayout>
        <Head title="Forgot Password" />

        <div class="tw-mb-4 tw-text-sm tw-text-gray-600">
            Jika anda melupakan password anda, tidak masalah. Cukup datang ke
            Kantor Koperasi Syariah POLBAN untuk melakukan reset password.
        </div>
        <Link href="/" class="tw-rounded-md btn btn-primary"
            >Back to Login</Link
        >
    </GuestLayout>
</template>
