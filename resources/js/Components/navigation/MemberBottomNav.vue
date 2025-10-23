<script setup>
const props = defineProps({
    links: {
        type: Array,
        default: () => [],
    },
    modelValue: {
        type: Number,
        default: 0,
    },
});

const emit = defineEmits(["update:modelValue", "navigate"]);

const handleChange = (index) => {
    emit("update:modelValue", index);
    emit("navigate", index);
};
</script>

<template>
    <van-tabbar
        fixed
        placeholder
        :model-value="modelValue"
        active-color="var(--color-primary)"
        inactive-color="var(--color-secondary)"
        @change="handleChange"
        class="md:tw-hidden"
    >
        <van-tabbar-item
            v-for="(link, index) in links"
            :key="link.name"
            :icon="link.icon"
        >
            {{ link.label }}
        </van-tabbar-item>
    </van-tabbar>
</template>
