<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import { useTranslations } from '@/Composables/useTranslations';
import { ref } from 'vue';

const { t, localePath } = useTranslations();

const props = defineProps({
    service: Object,
    services: Array,
    otherServices: Array,
    meta: Object,
});

const form = useForm({
    name: '',
    email: '',
    phone: '',
    company: '',
    service: t(props.service.name_key),
    message: '',
    type: 'quote',
});

function submitForm() {
    form.post(localePath('/contact'), {
        preserveScroll: true,
    });
}

const formRef = ref(null);

function scrollToForm() {
    formRef.value?.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

const stats = [
    { value: '10+', key: 'stats_years' },
    { value: '500+', key: 'stats_clients' },
    { value: '24/7', key: 'stats_available' },
    { value: '100%', key: 'hero_badge_satisfaction' },
];

const advantages = [
    { key: 'why_experience', descKey: 'why_experience_desc', icon: 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z' },
    { key: 'why_quality', descKey: 'why_quality_desc', icon: 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z' },
    { key: 'why_flexible', descKey: 'why_flexible_desc', icon: 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z' },
    { key: 'why_green', descKey: 'why_green_desc', icon: 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z' },
    { key: 'why_insured', descKey: 'why_insured_desc', icon: 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z' },
    { key: 'why_price', descKey: 'why_price_desc', icon: 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z' },
];

const processSteps = [
    { num: 1, titleKey: 'process_step_1_title', descKey: 'process_step_1_desc', icon: 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z' },
    { num: 2, titleKey: 'process_step_2_title', descKey: 'process_step_2_desc', icon: 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z' },
    { num: 3, titleKey: 'process_step_3_title', descKey: 'process_step_3_desc', icon: 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z' },
    { num: 4, titleKey: 'process_step_4_title', descKey: 'process_step_4_desc', icon: 'M5 13l4 4L19 7' },
];

const testimonials = [
    { name: 'Jan De Smet', company: 'TechCorp NV', textKey: 'testimonial_1_text', rating: 5 },
    { name: 'Sophie Willems', company: 'CleanLiving BV', textKey: 'testimonial_2_text', rating: 5 },
];
</script>

<template>
    <Head>
        <title>{{ meta.title }}</title>
        <meta name="description" :content="meta.description">
    </Head>

    <FrontendLayout>
        <!-- 1. Hero -->
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
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-heading font-extrabold mb-3 md:mb-4">
                    {{ t(service.name_key) }}
                </h1>
                <p class="text-base md:text-xl text-blue-100/80 max-w-2xl mb-8 md:mb-10">
                    {{ t(service.desc_key) }}
                </p>
                <div class="flex flex-col sm:flex-row gap-3 md:gap-4">
                    <button @click="scrollToForm"
                        class="inline-flex items-center justify-center px-7 py-4 md:px-10 md:py-5 bg-accent-500 text-white font-bold text-base md:text-lg rounded-2xl active:bg-accent-600 md:hover:bg-accent-600 transition-all shadow-xl md:hover:scale-105 active:scale-95">
                        {{ t('hero_cta_quote') }}
                    </button>
                    <a href="tel:+32460977123"
                        class="inline-flex items-center justify-center px-7 py-4 md:px-10 md:py-5 border-2 border-white/30 text-white font-bold text-base md:text-lg rounded-2xl active:bg-white/20 md:hover:bg-white/10 transition-all">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        {{ t('hero_cta_call') }}
                    </a>
                </div>
            </div>
        </section>

        <!-- 2. Trust Bar -->
        <section class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
                    <div v-for="stat in stats" :key="stat.key" class="text-center">
                        <div class="text-2xl md:text-3xl font-heading font-extrabold text-primary-600">{{ stat.value }}</div>
                        <div class="text-xs md:text-sm text-gray-500 mt-1">{{ t(stat.key) }}</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. Description + Sidebar -->
        <section class="py-12 md:py-20 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="grid lg:grid-cols-3 gap-8 md:gap-12">
                    <!-- Main Content -->
                    <div class="lg:col-span-2">
                        <div class="rounded-2xl md:rounded-3xl overflow-hidden shadow-xl mb-8 md:mb-10">
                            <img :src="service.image" :alt="t(service.name_key)" class="w-full h-48 md:h-72 object-cover" loading="lazy">
                        </div>

                        <h2 class="text-2xl md:text-3xl font-heading font-bold text-gray-900 mb-3 md:mb-4">
                            {{ t(service.name_key) }} {{ t('sd_in_antwerp') }}
                        </h2>
                        <p class="text-base md:text-lg text-gray-600 leading-relaxed">
                            {{ t(service.long_desc_key) }}
                        </p>
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-5 md:space-y-6 lg:sticky lg:top-28 lg:self-start">
                        <!-- Quick Quote Box -->
                        <div class="bg-gradient-to-br from-primary-500 to-primary-700 rounded-2xl md:rounded-3xl p-6 md:p-8 text-white shadow-xl">
                            <h3 class="text-xl md:text-2xl font-heading font-bold mb-2 md:mb-3">{{ t('form_title') }}</h3>
                            <p class="text-primary-100 text-sm md:text-base mb-5 md:mb-6">{{ t('form_subtitle') }}</p>
                            <button @click="scrollToForm" class="block w-full text-center py-3.5 md:py-4 bg-white text-primary-600 font-bold rounded-xl hover:bg-gray-100 active:bg-gray-200 transition-colors shadow-lg text-base md:text-lg">
                                {{ t('hero_cta_quote') }} &rarr;
                            </button>
                            <div class="mt-5 md:mt-6 space-y-3">
                                <div class="text-center">
                                    <p class="text-primary-200 text-xs md:text-sm mb-1">{{ t('sd_or_call') }}</p>
                                    <a href="tel:+32460977123" class="text-white hover:text-primary-100 transition-colors font-bold text-lg md:text-xl">
                                        0460 97 71 23
                                    </a>
                                </div>
                                <div class="text-center">
                                    <p class="text-primary-200 text-xs md:text-sm mb-1">{{ t('sd_or_email') }}</p>
                                    <a href="mailto:duogroep@gmail.com" class="text-white hover:text-primary-100 transition-colors font-bold text-sm md:text-base">
                                        duogroep@gmail.com
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Other Services -->
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
                                {{ t('services_view_all') }} &rarr;
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. Advantages -->
        <section class="py-12 md:py-20 bg-gray-50 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-10 md:mb-14">
                    <h2 class="text-2xl md:text-4xl font-heading font-bold text-gray-900 mb-3 md:mb-4">{{ t('sd_advantages_title') }}</h2>
                    <p class="text-base md:text-lg text-gray-500 max-w-2xl mx-auto">{{ t('sd_advantages_subtitle') }}</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6">
                    <div v-for="adv in advantages" :key="adv.key"
                        class="bg-white rounded-2xl p-5 md:p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="adv.icon"/>
                            </svg>
                        </div>
                        <h3 class="text-base md:text-lg font-heading font-bold text-gray-900 mb-1.5">{{ t(adv.key) }}</h3>
                        <p class="text-sm md:text-base text-gray-500">{{ t(adv.descKey) }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. Process -->
        <section class="py-12 md:py-20 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-10 md:mb-14">
                    <h2 class="text-2xl md:text-4xl font-heading font-bold text-gray-900 mb-3 md:mb-4">{{ t('process_title') }}</h2>
                    <p class="text-base md:text-lg text-gray-500 max-w-2xl mx-auto">{{ t('process_subtitle') }}</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
                    <div v-for="step in processSteps" :key="step.num" class="relative text-center">
                        <div class="w-16 h-16 md:w-20 md:h-20 bg-primary-500 rounded-full flex items-center justify-center mx-auto mb-4 md:mb-5 shadow-lg">
                            <svg class="w-7 h-7 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="step.icon"/>
                            </svg>
                        </div>
                        <div class="absolute -top-2 -right-2 md:top-0 md:right-4 lg:right-2 w-7 h-7 md:w-8 md:h-8 bg-accent-500 rounded-full flex items-center justify-center text-white font-bold text-sm md:text-base shadow">
                            {{ step.num }}
                        </div>
                        <h3 class="text-base md:text-lg font-heading font-bold text-gray-900 mb-1.5 md:mb-2">{{ t(step.titleKey) }}</h3>
                        <p class="text-sm md:text-base text-gray-500">{{ t(step.descKey) }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 6. Inline Form -->
        <section ref="formRef" class="py-12 md:py-20 bg-gray-50 px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto">
                <form @submit.prevent="submitForm" class="bg-white rounded-2xl md:rounded-3xl shadow-xl p-5 md:p-8 border border-gray-100">
                    <h2 class="text-xl md:text-2xl font-heading font-bold text-gray-900 mb-2 md:mb-3">{{ t('form_title') }}</h2>
                    <p class="text-sm md:text-base text-gray-500 mb-5 md:mb-6">{{ t('form_subtitle') }}</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5 md:mb-2">{{ t('form_name') }} *</label>
                            <input v-model="form.name" type="text" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-3"
                                :placeholder="t('form_name')">
                            <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">{{ form.errors.name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5 md:mb-2">{{ t('form_email') }} *</label>
                            <input v-model="form.email" type="email" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-3"
                                :placeholder="t('form_email')">
                            <p v-if="form.errors.email" class="mt-1 text-sm text-red-600">{{ form.errors.email }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5 md:mb-2">{{ t('form_phone') }} *</label>
                            <input v-model="form.phone" type="tel" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-3"
                                :placeholder="t('form_phone')">
                            <p v-if="form.errors.phone" class="mt-1 text-sm text-red-600">{{ form.errors.phone }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5 md:mb-2">{{ t('form_company') }}</label>
                            <input v-model="form.company" type="text"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-3"
                                :placeholder="t('form_company')">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1.5 md:mb-2">{{ t('form_service') }}</label>
                            <input v-model="form.service" type="text" readonly
                                class="w-full rounded-lg border-gray-300 bg-gray-50 shadow-sm py-3 text-gray-600 cursor-not-allowed">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1.5 md:mb-2">{{ t('form_message') }} *</label>
                            <textarea v-model="form.message" rows="4" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-3"
                                :placeholder="t('form_message')"></textarea>
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
                            class="w-full md:w-auto inline-flex items-center justify-center px-8 py-4 md:px-10 md:py-5 bg-accent-500 text-white text-base md:text-lg font-bold rounded-2xl active:bg-accent-600 md:hover:bg-accent-600 transition-all shadow-xl active:scale-95 disabled:opacity-50">
                            <span v-if="!form.processing">{{ t('form_submit') }}</span>
                            <span v-else>{{ t('form_sending') }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <!-- 7. Testimonials -->
        <section class="py-12 md:py-20 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-10 md:mb-14">
                    <h2 class="text-2xl md:text-4xl font-heading font-bold text-gray-900 mb-3 md:mb-4">{{ t('testimonials_title') }}</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 max-w-4xl mx-auto">
                    <div v-for="testimonial in testimonials" :key="testimonial.name"
                        class="bg-white rounded-2xl p-5 md:p-6 shadow-lg border border-gray-100">
                        <div class="flex items-center mb-3 md:mb-4">
                            <div class="flex text-yellow-400">
                                <svg v-for="i in testimonial.rating" :key="i" class="w-4 h-4 md:w-5 md:h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </div>
                        </div>
                        <p class="text-sm md:text-base text-gray-600 italic mb-4 md:mb-5">"{{ t(testimonial.textKey) }}"</p>
                        <div>
                            <p class="font-bold text-gray-900 text-sm md:text-base">{{ testimonial.name }}</p>
                            <p class="text-xs md:text-sm text-gray-400">{{ testimonial.company }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 8. Other Services Grid -->
        <section class="py-12 md:py-20 bg-gray-50 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-10 md:mb-14">
                    <h2 class="text-2xl md:text-4xl font-heading font-bold text-gray-900 mb-3 md:mb-4">{{ t('sd_other_services_title') }}</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 md:gap-6">
                    <Link v-for="s in otherServices" :key="s.slug"
                        :href="localePath(`/diensten/${s.slug}`)"
                        class="group bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-lg transition-all">
                        <div class="h-40 md:h-48 overflow-hidden">
                            <img :src="s.image" :alt="t(s.name_key)" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                        </div>
                        <div class="p-4 md:p-5">
                            <h3 class="font-heading font-bold text-gray-900 mb-1 text-sm md:text-base group-hover:text-primary-500 transition-colors">{{ t(s.name_key) }}</h3>
                            <p class="text-xs md:text-sm text-gray-500 line-clamp-2">{{ t(s.desc_key) }}</p>
                            <span class="inline-block mt-2 md:mt-3 text-primary-500 font-bold text-xs md:text-sm group-hover:translate-x-1 transition-transform">
                                {{ t('service_learn_more') }} &rarr;
                            </span>
                        </div>
                    </Link>
                </div>
            </div>
        </section>

        <!-- 9. Final CTA -->
        <section class="relative overflow-hidden">
            <img src="/images/misc/cta-bg.jpg" alt="" class="w-full h-full object-cover absolute inset-0" loading="lazy">
            <div class="absolute inset-0 bg-primary-900/85"></div>
            <div class="relative py-16 md:py-24 px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl mx-auto text-center text-white">
                    <h2 class="text-2xl md:text-4xl font-heading font-bold mb-3 md:mb-4">{{ t('cta_title') }}</h2>
                    <p class="text-sm md:text-lg text-blue-100/80 mb-8 md:mb-10">{{ t('cta_subtitle') }}</p>
                    <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center">
                        <button @click="scrollToForm"
                            class="inline-flex items-center justify-center px-7 py-4 md:px-10 md:py-5 bg-accent-500 text-white font-bold text-base md:text-lg rounded-2xl active:bg-accent-600 md:hover:bg-accent-600 transition-all shadow-xl md:hover:scale-105 active:scale-95">
                            {{ t('cta_button') }}
                        </button>
                        <a href="tel:+32460977123"
                            class="inline-flex items-center justify-center px-7 py-4 md:px-10 md:py-5 border-2 border-white/30 text-white font-bold text-base md:text-lg rounded-2xl active:bg-white/20 md:hover:bg-white/10 transition-all">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            {{ t('hero_cta_call') }}
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </FrontendLayout>
</template>
