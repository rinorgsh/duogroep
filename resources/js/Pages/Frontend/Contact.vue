<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import { useTranslations } from '@/Composables/useTranslations';

const { t, localePath } = useTranslations();

const props = defineProps({
    meta: Object,
});

const form = useForm({
    name: '',
    email: '',
    phone: '',
    company: '',
    service: '',
    message: '',
    type: 'contact',
});

function submitForm() {
    form.post(localePath('/contact'), {
        preserveScroll: true,
    });
}

const contactInfo = [
    {
        key: 'contact_address',
        value: 'Middelmolenlaan 20, 2100 Deurne',
        icon: 'location',
    },
    {
        key: 'contact_phone',
        value: '0460 97 71 23',
        link: 'tel:+32460977123',
        icon: 'phone',
    },
    {
        key: 'contact_email',
        value: 'duogroep@gmail.com',
        link: 'mailto:duogroep@gmail.com',
        icon: 'email',
    },
    {
        key: 'contact_hours',
        value_key: 'contact_hours_value',
        icon: 'clock',
    },
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
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold mb-3 md:mb-4">{{ t('contact_title') }}</h1>
                <p class="text-base md:text-xl text-primary-100 max-w-2xl mx-auto">{{ t('contact_subtitle') }}</p>
            </div>
        </section>

        <section class="section-padding">
            <div class="container-narrow">
                <div class="grid lg:grid-cols-3 gap-8 md:gap-12">
                    <!-- Contact Info -->
                    <div class="space-y-4 md:space-y-6 order-2 lg:order-1">
                        <div v-for="info in contactInfo" :key="info.key" class="card flex items-start space-x-3 md:space-x-4">
                            <div class="w-10 h-10 md:w-12 md:h-12 bg-primary-100 rounded-lg md:rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 md:w-6 md:h-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 text-sm md:text-base">{{ t(info.key) }}</h3>
                                <a v-if="info.link" :href="info.link" class="text-primary-500 hover:text-primary-600 transition-colors text-sm md:text-base">
                                    {{ info.value }}
                                </a>
                                <p v-else class="text-gray-600 text-sm md:text-base">{{ info.value_key ? t(info.value_key) : info.value }}</p>
                            </div>
                        </div>

                        <!-- Map Placeholder -->
                        <div class="bg-gray-100 rounded-2xl h-48 md:h-64 flex items-center justify-center">
                            <div class="text-center text-gray-500">
                                <svg class="w-10 h-10 md:w-12 md:h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <p class="text-sm md:text-base">Middelmolenlaan 20, 2100 Deurne</p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="lg:col-span-2 order-1 lg:order-2">
                        <form @submit.prevent="submitForm" class="bg-white rounded-2xl md:rounded-3xl shadow-xl p-5 md:p-8 border border-gray-100">
                            <h2 class="text-xl md:text-2xl font-heading font-bold text-gray-900 mb-5 md:mb-6">{{ t('form_title') }}</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1.5 md:mb-2">{{ t('form_name') }} *</label>
                                    <input v-model="form.name" type="text" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-3" :placeholder="t('form_name')">
                                    <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">{{ form.errors.name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1.5 md:mb-2">{{ t('form_email') }} *</label>
                                    <input v-model="form.email" type="email" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-3" :placeholder="t('form_email')">
                                    <p v-if="form.errors.email" class="mt-1 text-sm text-red-600">{{ form.errors.email }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1.5 md:mb-2">{{ t('form_phone') }} *</label>
                                    <input v-model="form.phone" type="tel" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-3" :placeholder="t('form_phone')">
                                    <p v-if="form.errors.phone" class="mt-1 text-sm text-red-600">{{ form.errors.phone }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1.5 md:mb-2">{{ t('form_company') }}</label>
                                    <input v-model="form.company" type="text" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-3" :placeholder="t('form_company')">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1.5 md:mb-2">{{ t('form_message') }} *</label>
                                    <textarea v-model="form.message" rows="4" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-3" :placeholder="t('form_message')"></textarea>
                                    <p v-if="form.errors.message" class="mt-1 text-sm text-red-600">{{ form.errors.message }}</p>
                                </div>
                            </div>
                            <div class="mt-5 md:mt-6">
                                <p class="text-xs text-gray-500 mb-3 md:mb-4">
                                    <svg class="w-4 h-4 inline mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                    {{ t('form_gdpr') }}
                                </p>
                                <button type="submit" :disabled="form.processing"
                                    class="w-full md:w-auto inline-flex items-center justify-center px-8 py-4 md:px-10 md:py-5 bg-accent-500 text-white text-base md:text-lg font-bold rounded-2xl active:bg-accent-600 md:hover:bg-accent-600 transition-all shadow-xl active:scale-95">
                                    <span v-if="!form.processing">{{ t('form_submit') }}</span>
                                    <span v-else>Verzenden...</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </FrontendLayout>
</template>
