<script setup>
import { Head, Link } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import { useTranslations } from '@/Composables/useTranslations';

const { t, localePath } = useTranslations();

const props = defineProps({
    service: Object,
    services: Array,
    meta: Object,
});

const advantages = [
    'Professioneel opgeleid team',
    'Milieuvriendelijke producten',
    'Flexibele planning',
    'Scherpe tarieven',
    'Volledig verzekerd',
    'Kwaliteitsgarantie',
];

const otherServices = props.services.filter(s => s.slug !== props.service.slug).slice(0, 4);
</script>

<template>
    <Head>
        <title>{{ meta.title }}</title>
        <meta name="description" :content="meta.description">
    </Head>

    <FrontendLayout>
        <!-- Hero with service image -->
        <section class="relative pt-28 md:pt-40 pb-20 md:pb-32 overflow-hidden">
            <div class="absolute inset-0">
                <img :src="service.image" :alt="t(service.name_key)" class="w-full h-full object-cover" loading="eager">
                <div class="absolute inset-0 bg-gradient-to-b md:bg-gradient-to-r from-primary-950/90 via-primary-900/80 to-primary-800/50"></div>
            </div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white">
                <nav class="text-xs md:text-sm text-blue-200 mb-4 md:mb-6">
                    <Link :href="localePath('/')" class="hover:text-white transition-colors">Home</Link>
                    <span class="mx-1.5 md:mx-2">/</span>
                    <Link :href="localePath('/diensten')" class="hover:text-white transition-colors">{{ t('nav_services') }}</Link>
                    <span class="mx-1.5 md:mx-2">/</span>
                    <span class="text-white font-medium">{{ t(service.name_key) }}</span>
                </nav>
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-heading font-extrabold mb-3 md:mb-4">{{ t(service.name_key) }}</h1>
                <p class="text-base md:text-xl text-blue-100/80 max-w-2xl">{{ t(service.desc_key) }}</p>
            </div>
        </section>

        <!-- Content -->
        <section class="py-12 md:py-20 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="grid lg:grid-cols-3 gap-8 md:gap-12">
                    <!-- Main Content -->
                    <div class="lg:col-span-2">
                        <!-- Service image card -->
                        <div class="rounded-2xl md:rounded-3xl overflow-hidden shadow-xl mb-8 md:mb-10">
                            <img :src="service.image" :alt="t(service.name_key)" class="w-full h-48 md:h-72 object-cover" loading="lazy">
                        </div>

                        <div class="prose prose-lg max-w-none">
                            <h2 class="text-2xl md:text-3xl font-heading font-bold text-gray-900 mb-3 md:mb-4">{{ t(service.name_key) }} in Antwerpen</h2>
                            <p class="text-base md:text-lg text-gray-600 leading-relaxed mb-5 md:mb-6">
                                {{ t(service.desc_key) }}
                                Duogroep biedt professionele {{ t(service.name_key).toLowerCase() }} diensten aan in Antwerpen en omgeving.
                                Met jarenlange ervaring en een team van gekwalificeerde vakmensen zorgen wij voor een onberispelijk resultaat.
                            </p>

                            <h3 class="text-xl md:text-2xl font-heading font-bold text-gray-900 mb-4 md:mb-6 mt-8 md:mt-10">Voordelen</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 md:gap-4 mb-6 md:mb-8">
                                <div v-for="advantage in advantages" :key="advantage" class="flex items-center space-x-3 bg-green-50 rounded-xl p-3 md:p-4">
                                    <div class="w-8 h-8 md:w-10 md:h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 md:w-6 md:h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <span class="text-sm md:text-base text-gray-700 font-semibold">{{ advantage }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- CTA Box -->
                        <div class="relative rounded-2xl md:rounded-3xl overflow-hidden mt-8 md:mt-10">
                            <img src="/images/misc/cta-bg.jpg" alt="" class="w-full h-full object-cover absolute inset-0" loading="lazy">
                            <div class="absolute inset-0 bg-primary-900/85"></div>
                            <div class="relative p-6 md:p-10">
                                <h3 class="text-2xl md:text-3xl font-heading font-bold text-white mb-2 md:mb-3">{{ t('cta_title') }}</h3>
                                <p class="text-sm md:text-lg text-blue-100/80 mb-6 md:mb-8">{{ t('cta_subtitle') }}</p>
                                <div class="flex flex-col sm:flex-row gap-3 md:gap-4">
                                    <Link :href="localePath('/offerte')" class="inline-flex items-center justify-center px-7 py-4 md:px-10 md:py-5 bg-accent-500 text-white font-bold text-base md:text-lg rounded-2xl active:bg-accent-600 md:hover:bg-accent-600 transition-all shadow-xl md:hover:scale-105 active:scale-95">
                                        {{ t('hero_cta_quote') }}
                                    </Link>
                                    <a href="tel:+32470726137" class="inline-flex items-center justify-center px-7 py-4 md:px-10 md:py-5 border-2 border-white/30 text-white font-bold text-base md:text-lg rounded-2xl active:bg-white/20 md:hover:bg-white/10 transition-all">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        {{ t('hero_cta_call') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-5 md:space-y-6">
                        <!-- Quick Quote Box -->
                        <div class="bg-gradient-to-br from-primary-500 to-primary-700 rounded-2xl md:rounded-3xl p-6 md:p-8 text-white shadow-xl">
                            <h3 class="text-xl md:text-2xl font-heading font-bold mb-2 md:mb-3">{{ t('form_title') }}</h3>
                            <p class="text-primary-100 text-sm md:text-base mb-5 md:mb-6">{{ t('form_subtitle') }}</p>
                            <Link :href="localePath('/offerte')" class="block w-full text-center py-3.5 md:py-4 bg-white text-primary-600 font-bold rounded-xl hover:bg-gray-100 active:bg-gray-200 transition-colors shadow-lg text-base md:text-lg">
                                {{ t('hero_cta_quote') }} →
                            </Link>
                            <div class="mt-5 md:mt-6 text-center">
                                <p class="text-primary-200 text-xs md:text-sm mb-1">Of bel direct:</p>
                                <a href="tel:+32470726137" class="text-white hover:text-primary-100 transition-colors font-bold text-lg md:text-xl">
                                    0470 72 61 37
                                </a>
                            </div>
                        </div>

                        <!-- Other Services with images -->
                        <div class="bg-white rounded-2xl md:rounded-3xl shadow-lg p-5 md:p-6 border border-gray-100">
                            <h3 class="text-base md:text-lg font-heading font-bold text-gray-900 mb-3 md:mb-4">{{ t('footer_services') }}</h3>
                            <div class="space-y-2 md:space-y-3">
                                <Link v-for="s in otherServices" :key="s.slug"
                                    :href="localePath(`/diensten/${s.slug}`)"
                                    class="group flex items-center space-x-3 p-2 rounded-xl hover:bg-gray-50 active:bg-gray-100 transition-colors">
                                    <img :src="s.image" :alt="t(s.name_key)" class="w-12 h-12 md:w-14 md:h-14 object-cover rounded-lg flex-shrink-0" loading="lazy">
                                    <span class="text-sm md:text-base text-gray-700 font-medium group-hover:text-primary-500 transition-colors">
                                        {{ t(s.name_key) }}
                                    </span>
                                </Link>
                            </div>
                            <Link :href="localePath('/diensten')" class="block mt-3 md:mt-4 text-center text-primary-500 font-bold hover:text-primary-600 transition-colors text-sm md:text-base">
                                {{ t('services_view_all') }} →
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </FrontendLayout>
</template>
