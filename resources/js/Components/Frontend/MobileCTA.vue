<script setup>
import { Link } from '@inertiajs/vue3';
import { useTranslations } from '@/Composables/useTranslations';
import { ref, onMounted, onUnmounted } from 'vue';

const { t, localePath } = useTranslations();
const visible = ref(false);

function handleScroll() {
    visible.value = window.scrollY > 400;
}

onMounted(() => {
    window.addEventListener('scroll', handleScroll, { passive: true });
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>

<template>
    <!-- Sticky Mobile CTA Bar -->
    <Transition
        enter-active-class="transition duration-300 ease-out"
        enter-from-class="translate-y-full"
        enter-to-class="translate-y-0"
        leave-active-class="transition duration-200 ease-in"
        leave-from-class="translate-y-0"
        leave-to-class="translate-y-full"
    >
        <div
            v-show="visible"
            class="lg:hidden fixed bottom-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md border-t border-gray-200 shadow-[0_-4px_20px_rgba(0,0,0,0.1)] safe-bottom"
        >
            <div class="flex items-center gap-3 px-4 py-3">
                <a
                    href="tel:+32460977123"
                    class="flex-1 flex items-center justify-center py-3.5 bg-primary-500 text-white font-bold rounded-xl active:bg-primary-600 text-sm"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    {{ t('hero_cta_call') }}
                </a>
                <Link
                    :href="localePath('/offerte')"
                    class="flex-1 flex items-center justify-center py-3.5 bg-accent-500 text-white font-bold rounded-xl active:bg-accent-600 shadow-lg shadow-accent-500/25 text-sm"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    {{ t('hero_cta_quote') }}
                </Link>
            </div>
        </div>
    </Transition>
</template>
