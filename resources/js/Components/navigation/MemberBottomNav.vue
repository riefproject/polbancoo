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

const resolveIcon = (link, active) => {
    if (!active) {
        return link.icon;
    }

    if (link.iconFilled) {
        return link.iconFilled;
    }

    if (typeof link.icon === "string" && link.icon.endsWith("-o")) {
        return link.icon.slice(0, -2);
    }

    return link.icon;
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
            :icon="resolveIcon(link, index === modelValue)"
        >
            <template #icon="{ active }">
                <van-icon
                    :name="resolveIcon(link, active)"
                    class="tw-text-xl"
                />
            </template>
            {{ link.label }}
        </van-tabbar-item>
    </van-tabbar>
</template>
