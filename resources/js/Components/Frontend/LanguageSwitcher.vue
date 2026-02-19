<script setup>
import { usePage, router } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const currentLocale = computed(() => page.props.locale || 'nl');
const locales = [
    { code: 'nl', label: 'NL' },
    { code: 'fr', label: 'FR' },
    { code: 'en', label: 'EN' },
];

function switchLocale(locale) {
    if (locale === currentLocale.value) return;
    const currentPath = window.location.pathname;
    const newPath = currentPath.replace(/^\/(nl|fr|en)/, `/${locale}`);
    router.visit(newPath, { preserveState: false });
}
</script>

<template>
    <div class="flex items-center space-x-1">
        <button
            v-for="loc in locales"
            :key="loc.code"
            @click="switchLocale(loc.code)"
            :class="[
                'px-2 py-1 text-xs font-bold rounded transition-all duration-200',
                currentLocale === loc.code
                    ? 'bg-white text-primary-900'
                    : 'text-white/70 hover:text-white hover:bg-white/10'
            ]"
        >
            {{ loc.label }}
        </button>
    </div>
</template>
