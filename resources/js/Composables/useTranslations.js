import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

export function useTranslations() {
    const page = usePage();

    const locale = computed(() => page.props.locale || 'nl');
    const translations = computed(() => page.props.translations?.messages || {});

    function t(key, replacements = {}) {
        let translation = translations.value[key] || key;

        Object.keys(replacements).forEach((replacement) => {
            translation = translation.replace(`:${replacement}`, replacements[replacement]);
        });

        return translation;
    }

    function localePath(path) {
        const loc = locale.value;
        if (path === '/') return `/${loc}`;
        return `/${loc}${path}`;
    }

    return {
        t,
        locale,
        localePath,
    };
}
