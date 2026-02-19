<script setup>
import { Head, Link } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import { useTranslations } from '@/Composables/useTranslations';

const { t, localePath } = useTranslations();

const props = defineProps({
    meta: Object,
});

const values = [
    { icon: 'quality', title: 'Kwaliteit', desc: 'Wij streven naar perfectie in alles wat we doen.' },
    { icon: 'trust', title: 'Betrouwbaarheid', desc: 'U kunt altijd op ons rekenen, dag en nacht.' },
    { icon: 'team', title: 'Teamwerk', desc: 'Onze kracht zit in ons hecht team van professionals.' },
    { icon: 'green', title: 'Duurzaamheid', desc: 'Wij kiezen bewust voor milieuvriendelijke oplossingen.' },
];

const milestones = [
    { year: '2014', event: 'Duogroep opgericht in Antwerpen' },
    { year: '2016', event: 'Eerste 100 klanten bereikt' },
    { year: '2018', event: 'Team uitgebreid naar 25 medewerkers' },
    { year: '2020', event: 'ISO 9001 certificering behaald' },
    { year: '2023', event: '500+ actieve klanten in heel Antwerpen' },
    { year: '2024', event: 'Uitbreiding naar provincie Antwerpen' },
];
</script>

<template>
    <Head>
        <title>{{ meta.title }}</title>
        <meta name="description" :content="meta.description">
    </Head>

    <FrontendLayout>
        <!-- Header -->
        <section class="gradient-hero pt-28 md:pt-32 pb-14 md:pb-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold mb-3 md:mb-4">{{ t('about_title') }}</h1>
                <p class="text-base md:text-xl text-primary-100 max-w-2xl mx-auto">{{ t('about_subtitle') }}</p>
            </div>
        </section>

        <!-- Intro -->
        <section class="section-padding">
            <div class="container-narrow">
                <div class="grid lg:grid-cols-2 gap-8 md:gap-12 items-center">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-heading font-bold text-gray-900 mb-4 md:mb-6">{{ t('about_title') }}</h2>
                        <p class="text-base md:text-lg text-gray-600 leading-relaxed mb-5 md:mb-6">{{ t('about_intro') }}</p>
                        <div class="grid grid-cols-2 gap-4 md:gap-6">
                            <div class="text-center p-3 md:p-4 bg-primary-50 rounded-xl">
                                <div class="text-2xl md:text-3xl font-bold text-primary-500">10+</div>
                                <div class="text-xs md:text-sm text-gray-600 mt-1">{{ t('stats_years') }}</div>
                            </div>
                            <div class="text-center p-3 md:p-4 bg-primary-50 rounded-xl">
                                <div class="text-2xl md:text-3xl font-bold text-primary-500">500+</div>
                                <div class="text-xs md:text-sm text-gray-600 mt-1">{{ t('stats_clients') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-primary-100 rounded-2xl p-8 md:p-12 flex items-center justify-center">
                        <div class="text-center">
                            <div class="w-24 h-24 md:w-32 md:h-32 bg-primary-500 rounded-2xl md:rounded-3xl flex items-center justify-center mx-auto mb-4 md:mb-6">
                                <span class="text-white font-bold text-4xl md:text-5xl">DG</span>
                            </div>
                            <h3 class="text-xl md:text-2xl font-heading font-bold text-primary-900">Duogroep</h3>
                            <p class="text-primary-600 mt-2 text-sm md:text-base">Since 2014</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mission -->
        <section class="section-padding bg-gray-50">
            <div class="container-narrow">
                <div class="max-w-3xl mx-auto text-center">
                    <h2 class="text-2xl md:text-3xl font-heading font-bold text-gray-900 mb-4 md:mb-6">{{ t('about_mission_title') }}</h2>
                    <p class="text-base md:text-xl text-gray-600 leading-relaxed">{{ t('about_mission') }}</p>
                </div>
            </div>
        </section>

        <!-- Values -->
        <section class="section-padding">
            <div class="container-narrow">
                <h2 class="text-2xl md:text-3xl font-heading font-bold text-gray-900 mb-8 md:mb-12 text-center">{{ t('about_values_title') }}</h2>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-8">
                    <div v-for="value in values" :key="value.title" class="card text-center">
                        <div class="w-11 h-11 md:w-14 md:h-14 bg-primary-100 rounded-xl flex items-center justify-center mx-auto mb-3 md:mb-4">
                            <svg class="w-5 h-5 md:w-7 md:h-7 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <h3 class="text-base md:text-lg font-semibold text-gray-900 mb-1.5 md:mb-2">{{ value.title }}</h3>
                        <p class="text-sm md:text-base text-gray-600">{{ value.desc }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Timeline -->
        <section class="section-padding bg-gray-50">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl md:text-3xl font-heading font-bold text-gray-900 mb-8 md:mb-12 text-center">Onze Geschiedenis</h2>
                <div class="space-y-6 md:space-y-8">
                    <div v-for="milestone in milestones" :key="milestone.year" class="flex items-start">
                        <div class="w-16 md:w-20 flex-shrink-0">
                            <span class="text-xl md:text-2xl font-bold text-primary-500">{{ milestone.year }}</span>
                        </div>
                        <div class="flex-1 ml-4 md:ml-6 pb-6 md:pb-8 border-l-2 border-primary-200 pl-4 md:pl-6 relative">
                            <div class="absolute left-0 top-0 w-3 h-3 md:w-4 md:h-4 bg-primary-500 rounded-full -translate-x-1/2"></div>
                            <p class="text-sm md:text-base text-gray-700 font-medium">{{ milestone.event }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="gradient-primary py-12 md:py-16">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-2xl md:text-3xl font-heading font-bold text-white mb-3 md:mb-4">{{ t('cta_title') }}</h2>
                <p class="text-base md:text-xl text-primary-100 mb-6 md:mb-8">{{ t('cta_subtitle') }}</p>
                <Link :href="localePath('/offerte')" class="inline-flex items-center justify-center px-8 py-4 md:px-10 md:py-5 bg-white text-primary-600 text-base md:text-lg font-bold rounded-2xl hover:bg-gray-100 active:bg-gray-200 transition-all active:scale-95 shadow-xl">
                    {{ t('cta_button') }}
                </Link>
            </div>
        </section>
    </FrontendLayout>
</template>
