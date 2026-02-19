<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { useTranslations } from '@/Composables/useTranslations';

const { t, localePath } = useTranslations();

const props = defineProps({
    services: Array,
    meta: Object,
});

const form = useForm({
    name: '',
    email: '',
    phone: '',
    company: '',
    service: '',
    message: 'Via Google Ads landing page',
    type: 'contact',
});

function submitForm() {
    form.post(localePath('/contact'), {
        preserveScroll: true,
    });
}
</script>

<template>
    <Head>
        <title>{{ t('hero_title') }} | Duogroep</title>
        <meta name="description" :content="t('meta_home_description')">
        <meta name="robots" content="noindex, nofollow">
    </Head>

    <div class="min-h-screen bg-white">
        <!-- Minimal Header -->
        <header class="bg-primary-900 shadow-sm py-4">
            <div class="max-w-5xl mx-auto px-4 flex justify-between items-center">
                <img src="/images/logo.png" alt="Duogroep" class="h-5 w-auto">
                <a href="tel:+32460977123" class="bg-white text-primary-900 hover:bg-primary-50 font-bold px-6 py-3 rounded-xl text-sm inline-flex items-center transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    {{ t('hero_cta_call') }}
                </a>
            </div>
        </header>

        <!-- Hero + Form -->
        <section class="gradient-hero py-16">
            <div class="max-w-5xl mx-auto px-4">
                <div class="grid lg:grid-cols-2 gap-12 items-start">
                    <!-- Left: Value proposition -->
                    <div class="text-white">
                        <div class="flex items-center space-x-2 mb-4">
                            <span class="px-3 py-1 bg-green-500 text-white text-sm font-bold rounded-full">{{ t('hero_badge_247') }}</span>
                            <span class="px-3 py-1 bg-white/20 text-white text-sm font-bold rounded-full">{{ t('hero_badge_free') }}</span>
                        </div>
                        <h1 class="text-4xl md:text-5xl font-heading font-bold mb-4 leading-tight">
                            {{ t('hero_title') }}
                        </h1>
                        <p class="text-lg text-primary-100 mb-8">{{ t('hero_subtitle') }}</p>

                        <!-- Benefits -->
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <svg class="w-6 h-6 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-primary-100">{{ t('why_experience') }} — {{ t('why_experience_desc') }}</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <svg class="w-6 h-6 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-primary-100">{{ t('why_quality') }} — {{ t('why_quality_desc') }}</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <svg class="w-6 h-6 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-primary-100">{{ t('why_price') }} — {{ t('why_price_desc') }}</span>
                            </div>
                        </div>

                        <!-- Stars -->
                        <div class="mt-8 flex items-center space-x-2">
                            <div class="flex">
                                <svg v-for="i in 5" :key="i" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </div>
                            <span class="text-white font-semibold">5.0/5</span>
                            <span class="text-primary-200">— 500+ klanten</span>
                        </div>
                    </div>

                    <!-- Right: Form -->
                    <div class="bg-white rounded-2xl shadow-2xl p-8">
                        <h2 class="text-2xl font-heading font-bold text-gray-900 mb-2">{{ t('form_title') }}</h2>
                        <p class="text-gray-600 mb-6">{{ t('form_subtitle') }}</p>

                        <form @submit.prevent="submitForm" class="space-y-4">
                            <div>
                                <input v-model="form.name" type="text" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500" :placeholder="t('form_name') + ' *'">
                            </div>
                            <div>
                                <input v-model="form.phone" type="tel" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500" :placeholder="t('form_phone') + ' *'">
                            </div>
                            <div>
                                <input v-model="form.email" type="email" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500" :placeholder="t('form_email') + ' *'">
                            </div>
                            <div>
                                <select v-model="form.service" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                                    <option value="">{{ t('form_select_service') }}</option>
                                    <option v-for="service in services" :key="service.slug" :value="service.slug">
                                        {{ t(service.name_key) }}
                                    </option>
                                </select>
                            </div>
                            <button type="submit" :disabled="form.processing" class="btn-cta w-full">
                                {{ t('hero_cta_quote') }}
                            </button>
                        </form>

                        <p class="text-xs text-gray-400 mt-4 text-center">
                            <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            {{ t('form_gdpr') }}
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
