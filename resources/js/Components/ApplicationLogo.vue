<!-- pake props ukuran -->
<script setup>
const props = defineProps({
    size: {
        type: String,
        default: "20",
    },
});
</script>

<template>
    <img
        src="/img/logo.png"
        :alt="'Application Logo'"
        :class="`tw-h-${props.size} tw-w-${props.size}`"
    />
</template>
