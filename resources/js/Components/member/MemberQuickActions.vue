<script setup>
import { Link } from "@inertiajs/vue3";
import * as LucideIcons from "lucide-vue-next";

const props = defineProps({
    actions: {
        type: Array,
        default: () => [],
    },
});

const emit = defineEmits(["select"]);

const fallbackIcon = LucideIcons.LayoutGrid ?? null;

const isDisabled = (action) => !!action?.comingSoon;

const resolveComponent = (action) => {
    if (!isDisabled(action) && action?.href) {
        return Link;
    }

    return "button";
};

const handleClick = (event, action) => {
    if (isDisabled(action)) {
        event?.preventDefault();
        return;
    }

    emit("select", action);
};

const resolveIcon = (icon) => {
    if (!icon) {
        return fallbackIcon;
    }

    if (typeof icon === "string") {
        return LucideIcons[icon] ?? fallbackIcon;
    }

    return icon;
};
</script>

<template>
    <section
        class="tw-rounded-2xl tw-border tw-border-slate-200 tw-bg-white tw-px-1 md:tw-px-6 tw-py-1 md:tw-py-5 tw-shadow-sm"
    >
        <div
            class="wrapper tw-grid tw-grid-rows-1 lg:tw-grid-rows-1 tw-grid-flow-col tw-gap-1 lg:tw-gap-5 tw-overflow-x-auto tw-pb-2 tw-pr-1"
        >
            <component
                v-for="action in actions"
                :is="resolveComponent(action)"
                :key="action.label"
                :href="action.href || undefined"
                :aria-disabled="isDisabled(action)"
                class="tw-flex tw-w-28 tw-min-w-[7rem] tw-flex-col tw-items-center tw-gap-1 tw-rounded-xl tw-p-3 tw-text-center tw-transition"
                :class="{
                    'tw-cursor-not-allowed tw-opacity-60 hover:tw-bg-slate-50':
                        isDisabled(action),
                }"
                @click="(event) => handleClick(event, action)"
            >
                <span
                    class="tw-flex tw-h-8 tw-w-8 md:tw-h-16 md:tw-w-16 tw-items-center tw-justify-center tw-rounded-3xl tw-bg-white tw-text-primary tw-shadow"
                >
                    <component
                        :is="resolveIcon(action.icon)"
                        class="tw-h-4 tw-w-4 md:tw-h-8 md:tw-w-8"
                    />
                </span>
                <div
                    class="tw-text-xs md:tw-text-sm tw-font-semibold tw-text-slate-700"
                >
                    <p>{{ action.label }}</p>
                </div>
            </component>
        </div>
    </section>
</template>

<style scoped>
/* x-Scrollbar custom */
.wrapper::-webkit-scrollbar {
    height: 3px;
    border-radius: 999px;
}
.wrapper::-webkit-scrollbar-track {
    background: transparent;
    width: 10px;
    border-radius: 999px;
}
.wrapper::-webkit-scrollbar-thumb {
    background-color: var(--color-primary);
    border-radius: 3px;
    width: 10px;
}
</style>
