<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import { useTranslations } from '@/Composables/useTranslations';
import LanguageSwitcher from './LanguageSwitcher.vue';

const { t, localePath } = useTranslations();
const mobileMenuOpen = ref(false);
const scrolled = ref(false);

const navigation = [
    { key: 'nav_home', path: '/' },
    { key: 'nav_services', path: '/diensten' },
    { key: 'nav_contact', path: '/contact' },
];

function handleScroll() {
    scrolled.value = window.scrollY > 50;
}

onMounted(() => {
    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll();
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>

<template>
    <header
        :class="[
            'fixed top-0 left-0 right-0 z-50 transition-all duration-300',
            scrolled ? 'bg-primary-900/95 backdrop-blur-md shadow-lg' : 'bg-transparent'
        ]"
        style="padding-top: env(safe-area-inset-top, 0px);"
    >
        <!-- Top Bar - Desktop only, hidden when transparent for cleaner look -->
        <div :class="['overflow-hidden transition-all duration-300 hidden lg:block', scrolled ? 'max-h-0 opacity-0' : 'max-h-10 opacity-100']">
            <div class="text-white py-2">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center text-sm">
                    <div class="flex items-center space-x-6">
                        <a href="tel:+32470726137" class="flex items-center hover:text-primary-200 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            0470 72 61 37
                        </a>
                        <a href="mailto:duogroep@gmail.com" class="flex items-center hover:text-primary-200 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            duogroep@gmail.com
                        </a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <LanguageSwitcher />
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Navigation -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 lg:h-20">
                <!-- Logo -->
                <Link :href="localePath('/')" class="flex items-center flex-shrink-0">
                    <img src="/images/logo.png" alt="Duogroep" class="h-5 lg:h-7 w-auto block">
                </Link>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center space-x-8">
                    <Link
                        v-for="item in navigation"
                        :key="item.key"
                        :href="localePath(item.path)"
                        class="text-white/80 hover:text-white font-medium uppercase tracking-wide text-sm transition-colors duration-200 relative group"
                    >
                        {{ t(item.key) }}
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"></span>
                    </Link>
                </nav>

                <!-- Desktop CTA -->
                <div class="hidden lg:flex items-center space-x-4">
                    <a href="tel:+32470726137" class="text-white/80 hover:text-white font-semibold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </a>
                    <Link :href="localePath('/offerte')" class="bg-white text-primary-900 hover:bg-primary-50 font-bold text-sm px-6 py-3 rounded-xl transition-colors duration-200">
                        {{ t('hero_cta_quote') }}
                    </Link>
                </div>

                <!-- Mobile: Language + Menu -->
                <div class="flex items-center space-x-2 lg:hidden">
                    <LanguageSwitcher />
                    <button
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        class="p-2.5 rounded-xl text-white hover:bg-white/10 transition-colors active:bg-white/20"
                        aria-label="Menu"
                    >
                        <svg v-if="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu - Fullscreen overlay -->
        <Transition
            enter-active-class="transition duration-300 ease-out"
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="transition duration-200 ease-in"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div v-show="mobileMenuOpen" class="lg:hidden fixed inset-0 bg-primary-900 z-40 overflow-y-auto" style="top: calc(4rem + env(safe-area-inset-top, 0px));">
                <div class="px-6 py-8 space-y-2">
                    <Link
                        v-for="item in navigation"
                        :key="item.key"
                        :href="localePath(item.path)"
                        class="flex items-center py-4 px-5 text-white text-lg font-medium uppercase tracking-wide rounded-2xl hover:bg-white/10 active:bg-white/20 transition-colors"
                        @click="mobileMenuOpen = false"
                    >
                        {{ t(item.key) }}
                        <svg class="w-5 h-5 ml-auto text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </Link>

                    <div class="pt-6 space-y-4">
                        <Link
                            :href="localePath('/offerte')"
                            class="flex items-center justify-center w-full py-4 px-6 bg-accent-500 text-white text-lg font-bold rounded-2xl active:bg-accent-600 shadow-lg shadow-accent-500/25"
                            @click="mobileMenuOpen = false"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            {{ t('hero_cta_quote') }}
                        </Link>
                        <a
                            href="tel:+32470726137"
                            class="flex items-center justify-center w-full py-4 px-6 bg-white/10 text-white text-lg font-bold rounded-2xl active:bg-white/20 border border-white/20"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            {{ t('hero_cta_call') }}
                        </a>
                    </div>
                </div>
            </div>
        </Transition>
    </header>
</template>
