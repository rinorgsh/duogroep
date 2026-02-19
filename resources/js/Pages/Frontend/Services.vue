<script setup>
import { Head, Link } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import { useTranslations } from '@/Composables/useTranslations';

const { t, localePath } = useTranslations();

const props = defineProps({
    services: Array,
    meta: Object,
});
</script>

<template>
    <Head>
        <title>{{ meta.title }}</title>
        <meta name="description" :content="meta.description">
    </Head>

    <FrontendLayout>
        <!-- Page Header with Image -->
        <section class="relative pt-28 md:pt-36 pb-16 md:pb-24 overflow-hidden">
            <div class="absolute inset-0">
                <img src="/images/hero/hero-bg.jpg" alt="" class="w-full h-full object-cover" loading="eager">
                <div class="absolute inset-0 bg-primary-900/80"></div>
            </div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
                <span class="inline-block px-3 py-1.5 md:px-4 md:py-2 bg-white/10 backdrop-blur-sm text-white font-semibold text-xs md:text-sm rounded-full mb-4 md:mb-6">Duogroep</span>
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-heading font-extrabold mb-3 md:mb-4">{{ t('services_title') }}</h1>
                <p class="text-base md:text-xl text-blue-100/80 max-w-2xl mx-auto">{{ t('services_subtitle') }}</p>
            </div>
        </section>

        <!-- Services Grid with Images -->
        <section class="py-14 md:py-20 lg:py-28 px-4 sm:px-6 lg:px-8 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <!-- Featured first 2 services (large cards) -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 md:gap-8 mb-5 md:mb-8">
                    <Link
                        v-for="service in services.slice(0, 2)"
                        :key="service.slug"
                        :href="localePath(`/diensten/${service.slug}`)"
                        class="group relative rounded-2xl md:rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 h-60 md:h-80 active:scale-[0.98]"
                    >
                        <img :src="service.image" :alt="t(service.name_key)" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-5 md:p-8">
                            <h3 class="text-xl md:text-2xl font-heading font-bold text-white mb-1.5 md:mb-2 group-hover:text-accent-300 transition-colors">
                                {{ t(service.name_key) }}
                            </h3>
                            <p class="text-sm md:text-base text-white/80 mb-3 md:mb-4 line-clamp-2">{{ t(service.desc_key) }}</p>
                            <span class="inline-flex items-center text-accent-400 font-semibold text-sm md:text-base group-hover:translate-x-2 transition-transform">
                                {{ t('service_learn_more') }}
                                <svg class="w-4 h-4 md:w-5 md:h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </span>
                        </div>
                    </Link>
                </div>

                <!-- Remaining services (3-column grid) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-8">
                    <Link
                        v-for="service in services.slice(2)"
                        :key="service.slug"
                        :href="localePath(`/diensten/${service.slug}`)"
                        class="group bg-white rounded-2xl md:rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 md:hover:-translate-y-2 active:scale-[0.98]"
                    >
                        <div class="relative h-40 md:h-52 overflow-hidden">
                            <img :src="service.image" :alt="t(service.name_key)" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                        </div>
                        <div class="p-4 md:p-6">
                            <h3 class="text-lg md:text-xl font-heading font-bold text-gray-900 mb-1.5 md:mb-2 group-hover:text-primary-500 transition-colors">
                                {{ t(service.name_key) }}
                            </h3>
                            <p class="text-sm md:text-base text-gray-500 leading-relaxed mb-3 md:mb-4 line-clamp-2">{{ t(service.desc_key) }}</p>
                            <span class="inline-flex items-center text-primary-500 font-semibold text-sm md:text-base group-hover:translate-x-2 transition-transform">
                                {{ t('service_learn_more') }}
                                <svg class="w-4 h-4 md:w-5 md:h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </span>
                        </div>
                    </Link>
                </div>
            </div>
        </section>

        <!-- CTA with Image -->
        <section class="relative py-14 md:py-24 overflow-hidden">
            <div class="absolute inset-0">
                <img src="/images/misc/cta-bg.jpg" alt="" class="w-full h-full object-cover" loading="lazy">
                <div class="absolute inset-0 bg-primary-900/85"></div>
            </div>
            <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-heading font-extrabold text-white mb-4 md:mb-6">{{ t('cta_title') }}</h2>
                <p class="text-base md:text-xl text-blue-100/80 mb-8 md:mb-10">{{ t('cta_subtitle') }}</p>
                <Link :href="localePath('/offerte')" class="inline-flex items-center px-8 py-4 md:px-12 md:py-6 bg-accent-500 text-white text-base md:text-xl font-bold rounded-2xl active:bg-accent-600 md:hover:bg-accent-600 transition-all duration-300 shadow-2xl md:hover:scale-105 active:scale-95">
                    {{ t('cta_button') }}
                    <svg class="w-5 h-5 md:w-6 md:h-6 ml-2 md:ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </Link>
            </div>
        </section>
    </FrontendLayout>
</template>
