<script setup>
import { Link } from '@inertiajs/vue3';
import { useTranslations } from '@/Composables/useTranslations';

const { t, localePath } = useTranslations();

const serviceLinks = [
    { key: 'service_offices', slug: 'kantoren-schoonmaken' },
    { key: 'service_construction', slug: 'schoonmaak-na-verbouwing' },
    { key: 'service_windows', slug: 'glazenwasserij' },
    { key: 'service_industrial', slug: 'industriele-schoonmaak' },
    { key: 'service_buildings', slug: 'schoonmaak-gebouwen' },
];
</script>

<template>
    <footer class="bg-primary-900 text-white">
        <!-- Main Footer -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-16">
            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-12">
                <!-- Company Info -->
                <div class="col-span-2 md:col-span-1">
                    <div class="mb-4 md:mb-6">
                        <img src="/images/logo.png" alt="Duogroep" class="h-8 md:h-12 w-auto">
                    </div>
                    <p class="text-primary-200 mb-5 md:mb-6 leading-relaxed text-sm md:text-base">
                        {{ t('footer_description') }}
                    </p>
                    <div class="flex space-x-3 md:space-x-4">
                        <a href="#" class="w-9 h-9 md:w-10 md:h-10 bg-primary-800 rounded-lg flex items-center justify-center hover:bg-primary-700 active:bg-primary-600 transition-colors">
                            <svg class="w-4 h-4 md:w-5 md:h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 md:w-10 md:h-10 bg-primary-800 rounded-lg flex items-center justify-center hover:bg-primary-700 active:bg-primary-600 transition-colors">
                            <svg class="w-4 h-4 md:w-5 md:h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 md:w-10 md:h-10 bg-primary-800 rounded-lg flex items-center justify-center hover:bg-primary-700 active:bg-primary-600 transition-colors">
                            <svg class="w-4 h-4 md:w-5 md:h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667h-3.554v-11.452h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zm-15.11-13.019c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019h-3.564v-11.452h3.564v11.452zm15.106-20.452h-20.454c-.979 0-1.771.774-1.771 1.729v20.542c0 .956.792 1.729 1.771 1.729h20.451c.978 0 1.778-.773 1.778-1.729v-20.542c0-.955-.8-1.729-1.778-1.729z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Services -->
                <div>
                    <h3 class="text-base md:text-lg font-heading font-semibold mb-4 md:mb-6">{{ t('footer_services') }}</h3>
                    <ul class="space-y-2.5 md:space-y-3">
                        <li v-for="link in serviceLinks" :key="link.slug">
                            <Link :href="localePath(`/diensten/${link.slug}`)" class="text-primary-200 hover:text-white active:text-white/80 transition-colors text-sm md:text-base">
                                {{ t(link.key) }}
                            </Link>
                        </li>
                        <li>
                            <Link :href="localePath('/diensten')" class="text-primary-300 hover:text-white font-semibold transition-colors text-sm md:text-base">
                                {{ t('services_view_all') }} →
                            </Link>
                        </li>
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h3 class="text-base md:text-lg font-heading font-semibold mb-4 md:mb-6">{{ t('footer_company') }}</h3>
                    <ul class="space-y-2.5 md:space-y-3">
                        <li>
                            <Link :href="localePath('/over-ons')" class="text-primary-200 hover:text-white active:text-white/80 transition-colors text-sm md:text-base">
                                {{ t('nav_about') }}
                            </Link>
                        </li>
                        <li>
                            <Link :href="localePath('/contact')" class="text-primary-200 hover:text-white active:text-white/80 transition-colors text-sm md:text-base">
                                {{ t('nav_contact') }}
                            </Link>
                        </li>
                        <li>
                            <Link :href="localePath('/offerte')" class="text-primary-200 hover:text-white active:text-white/80 transition-colors text-sm md:text-base">
                                {{ t('nav_quote') }}
                            </Link>
                        </li>
                        <li>
                            <Link :href="localePath('/privacy')" class="text-primary-200 hover:text-white active:text-white/80 transition-colors text-sm md:text-base">
                                {{ t('footer_privacy') }}
                            </Link>
                        </li>
                        <li>
                            <Link :href="localePath('/voorwaarden')" class="text-primary-200 hover:text-white active:text-white/80 transition-colors text-sm md:text-base">
                                {{ t('footer_terms') }}
                            </Link>
                        </li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-base md:text-lg font-heading font-semibold mb-4 md:mb-6">{{ t('footer_contact') }}</h3>
                    <ul class="space-y-3 md:space-y-4">
                        <li class="flex items-start">
                            <svg class="w-4 h-4 md:w-5 md:h-5 mr-2.5 md:mr-3 mt-0.5 text-primary-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="text-primary-200 text-sm md:text-base">Middelmolenlaan 20, 2100 Deurne</span>
                        </li>
                        <li>
                            <a href="tel:+32460977123" class="flex items-start text-primary-200 hover:text-white active:text-white/80 transition-colors">
                                <svg class="w-4 h-4 md:w-5 md:h-5 mr-2.5 md:mr-3 mt-0.5 text-primary-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span class="text-sm md:text-base">0460 97 71 23</span>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:duogroep@gmail.com" class="flex items-start text-primary-200 hover:text-white active:text-white/80 transition-colors">
                                <svg class="w-4 h-4 md:w-5 md:h-5 mr-2.5 md:mr-3 mt-0.5 text-primary-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-sm md:text-base">duogroep@gmail.com</span>
                            </a>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 md:w-5 md:h-5 mr-2.5 md:mr-3 mt-0.5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-green-400 font-semibold text-sm md:text-base">{{ t('hero_badge_247') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-primary-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 md:py-6">
                <div class="flex flex-col md:flex-row justify-between items-center text-xs md:text-sm text-primary-300">
                    <p>&copy; {{ new Date().getFullYear() }} Duogroep. {{ t('footer_rights') }}</p>
                    <div class="flex space-x-4 md:space-x-6 mt-3 md:mt-0">
                        <Link :href="localePath('/privacy')" class="hover:text-white active:text-white/80 transition-colors">{{ t('footer_privacy') }}</Link>
                        <Link :href="localePath('/voorwaarden')" class="hover:text-white active:text-white/80 transition-colors">{{ t('footer_terms') }}</Link>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>
