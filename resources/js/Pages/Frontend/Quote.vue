<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import { useTranslations } from '@/Composables/useTranslations';
import { ref, computed } from 'vue';

const { t, localePath } = useTranslations();

const props = defineProps({
    services: Array,
    meta: Object,
});

const currentStep = ref(1);
const totalSteps = 4;

const form = useForm({
    service: '',
    surface: '',
    frequency: '',
    location: '',
    urgency: 'normal',
    name: '',
    email: '',
    phone: '',
    company: '',
    message: '',
});

const progressPercentage = computed(() => (currentStep.value / totalSteps) * 100);

const stepLabels = computed(() => [
    t('quote_step_service'),
    t('quote_step_details'),
    t('quote_step_frequency'),
    t('quote_step_contact'),
]);

const frequencies = computed(() => [
    { value: 'once', label: t('quote_frequency_once') },
    { value: 'weekly', label: t('quote_frequency_weekly') },
    { value: 'biweekly', label: t('quote_frequency_biweekly') },
    { value: 'monthly', label: t('quote_frequency_monthly') },
]);

const urgencies = computed(() => [
    { value: 'normal', label: t('quote_urgency_normal') },
    { value: 'fast', label: t('quote_urgency_fast') },
    { value: 'urgent', label: t('quote_urgency_urgent') },
]);

const canProceed = computed(() => {
    switch (currentStep.value) {
        case 1: return form.service !== '';
        case 2: return form.surface !== '' && form.location !== '';
        case 3: return form.frequency !== '';
        case 4: return form.name !== '' && form.email !== '' && form.phone !== '';
        default: return false;
    }
});

function nextStep() {
    if (currentStep.value < totalSteps && canProceed.value) {
        currentStep.value++;
    }
}

function prevStep() {
    if (currentStep.value > 1) {
        currentStep.value--;
    }
}

function submitForm() {
    form.post(localePath('/offerte'), {
        preserveScroll: true,
    });
}
</script>

<template>
    <Head>
        <title>{{ meta.title }}</title>
        <meta name="description" :content="meta.description">
    </Head>

    <FrontendLayout>
        <!-- Page Header -->
        <section class="gradient-hero pt-24 md:pt-32 pb-10 md:pb-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold mb-3 md:mb-4">{{ t('quote_title') }}</h1>
                <p class="text-base md:text-xl text-primary-100 max-w-2xl mx-auto">{{ t('quote_subtitle') }}</p>
            </div>
        </section>

        <!-- Quote Form -->
        <section class="py-10 md:py-16 lg:py-20 px-4 sm:px-6 lg:px-8 bg-gray-50">
            <div class="max-w-3xl mx-auto">
                <div class="bg-white rounded-2xl md:rounded-3xl shadow-xl overflow-hidden">
                    <!-- Progress Bar -->
                    <div class="bg-gray-100 px-4 md:px-8 pt-5 md:pt-8 pb-4 md:pb-6">
                        <div class="flex justify-between items-center mb-3 md:mb-4">
                            <span class="text-xs md:text-sm font-medium text-gray-500">
                                {{ t('quote_step') }} {{ currentStep }} {{ t('quote_of') }} {{ totalSteps }}
                            </span>
                            <span class="text-xs md:text-sm font-medium text-primary-500">{{ Math.round(progressPercentage) }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 md:h-3">
                            <div
                                class="bg-primary-500 h-2.5 md:h-3 rounded-full transition-all duration-500 ease-out"
                                :style="{ width: progressPercentage + '%' }"
                            ></div>
                        </div>
                        <!-- Step Labels -->
                        <div class="flex justify-between mt-3 md:mt-4">
                            <button
                                v-for="(label, index) in stepLabels"
                                :key="index"
                                @click="index + 1 < currentStep ? currentStep = index + 1 : null"
                                :class="[
                                    'text-[10px] md:text-xs font-medium transition-colors',
                                    currentStep > index ? 'text-primary-500 cursor-pointer' : 'text-gray-400',
                                    currentStep === index + 1 ? 'text-primary-600 font-semibold' : ''
                                ]"
                            >
                                {{ label }}
                            </button>
                        </div>
                    </div>

                    <form @submit.prevent="submitForm" class="p-4 md:p-8">
                        <!-- Step 1: Service Type -->
                        <div v-show="currentStep === 1" class="space-y-3 md:space-y-4">
                            <h2 class="text-xl md:text-2xl font-heading font-bold text-gray-900 mb-4 md:mb-6">{{ t('quote_step_service') }}</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 md:gap-3">
                                <button
                                    v-for="service in services"
                                    :key="service.slug"
                                    type="button"
                                    @click="form.service = service.slug"
                                    :class="[
                                        'p-3.5 md:p-4 rounded-xl border-2 text-left transition-all duration-200 active:scale-[0.98]',
                                        form.service === service.slug
                                            ? 'border-primary-500 bg-primary-50 shadow-md'
                                            : 'border-gray-200 hover:border-primary-300 hover:bg-gray-50'
                                    ]"
                                >
                                    <div class="flex items-center">
                                        <div :class="[
                                            'w-9 h-9 md:w-10 md:h-10 rounded-lg flex items-center justify-center mr-3 transition-colors',
                                            form.service === service.slug ? 'bg-primary-500' : 'bg-gray-100'
                                        ]">
                                            <svg :class="['w-4 h-4 md:w-5 md:h-5', form.service === service.slug ? 'text-white' : 'text-gray-400']" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </div>
                                        <span :class="['text-sm md:text-base font-medium', form.service === service.slug ? 'text-primary-700' : 'text-gray-700']">
                                            {{ t(service.name_key) }}
                                        </span>
                                    </div>
                                </button>
                            </div>
                        </div>

                        <!-- Step 2: Details -->
                        <div v-show="currentStep === 2" class="space-y-5 md:space-y-6">
                            <h2 class="text-xl md:text-2xl font-heading font-bold text-gray-900 mb-4 md:mb-6">{{ t('quote_step_details') }}</h2>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5 md:mb-2">{{ t('quote_surface') }} *</label>
                                <div class="relative">
                                    <input
                                        v-model="form.surface"
                                        type="number"
                                        min="1"
                                        required
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 pr-12 py-3"
                                        placeholder="150"
                                    >
                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 font-medium">m&sup2;</span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5 md:mb-2">{{ t('quote_location') }} *</label>
                                <input
                                    v-model="form.location"
                                    type="text"
                                    required
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-3"
                                    placeholder="Antwerpen"
                                >
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5 md:mb-2">{{ t('quote_urgency') }}</label>
                                <div class="space-y-2.5 md:space-y-3">
                                    <label
                                        v-for="urgency in urgencies"
                                        :key="urgency.value"
                                        :class="[
                                            'flex items-center p-3.5 md:p-4 rounded-lg border-2 cursor-pointer transition-all active:scale-[0.98]',
                                            form.urgency === urgency.value
                                                ? 'border-primary-500 bg-primary-50'
                                                : 'border-gray-200 hover:border-primary-300'
                                        ]"
                                    >
                                        <input
                                            v-model="form.urgency"
                                            type="radio"
                                            :value="urgency.value"
                                            class="text-primary-500 focus:ring-primary-500"
                                        >
                                        <span class="ml-3 text-sm md:text-base font-medium text-gray-700">{{ urgency.label }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Frequency -->
                        <div v-show="currentStep === 3" class="space-y-5 md:space-y-6">
                            <h2 class="text-xl md:text-2xl font-heading font-bold text-gray-900 mb-4 md:mb-6">{{ t('quote_step_frequency') }}</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 md:gap-4">
                                <button
                                    v-for="freq in frequencies"
                                    :key="freq.value"
                                    type="button"
                                    @click="form.frequency = freq.value"
                                    :class="[
                                        'p-5 md:p-6 rounded-xl border-2 text-center transition-all duration-200 active:scale-[0.98]',
                                        form.frequency === freq.value
                                            ? 'border-primary-500 bg-primary-50 shadow-md'
                                            : 'border-gray-200 hover:border-primary-300 hover:bg-gray-50'
                                    ]"
                                >
                                    <span :class="['text-base md:text-lg font-semibold', form.frequency === freq.value ? 'text-primary-700' : 'text-gray-700']">
                                        {{ freq.label }}
                                    </span>
                                </button>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5 md:mb-2">{{ t('form_message') }}</label>
                                <textarea
                                    v-model="form.message"
                                    rows="3"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-3"
                                    :placeholder="t('form_message')"
                                ></textarea>
                            </div>
                        </div>

                        <!-- Step 4: Contact Details -->
                        <div v-show="currentStep === 4" class="space-y-5 md:space-y-6">
                            <h2 class="text-xl md:text-2xl font-heading font-bold text-gray-900 mb-4 md:mb-6">{{ t('quote_step_contact') }}</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6">
                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1.5 md:mb-2">{{ t('form_name') }} *</label>
                                    <input
                                        v-model="form.name"
                                        type="text"
                                        required
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-3"
                                        :placeholder="t('form_name')"
                                    >
                                    <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">{{ form.errors.name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1.5 md:mb-2">{{ t('form_email') }} *</label>
                                    <input
                                        v-model="form.email"
                                        type="email"
                                        required
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-3"
                                        :placeholder="t('form_email')"
                                    >
                                    <p v-if="form.errors.email" class="mt-1 text-sm text-red-600">{{ form.errors.email }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1.5 md:mb-2">{{ t('form_phone') }} *</label>
                                    <input
                                        v-model="form.phone"
                                        type="tel"
                                        required
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-3"
                                        :placeholder="t('form_phone')"
                                    >
                                    <p v-if="form.errors.phone" class="mt-1 text-sm text-red-600">{{ form.errors.phone }}</p>
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1.5 md:mb-2">{{ t('form_company') }}</label>
                                    <input
                                        v-model="form.company"
                                        type="text"
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-3"
                                        :placeholder="t('form_company')"
                                    >
                                </div>
                            </div>

                            <p class="text-xs text-gray-500 flex items-start">
                                <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                {{ t('form_gdpr') }}
                            </p>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="flex justify-between mt-6 md:mt-8 pt-5 md:pt-6 border-t">
                            <button
                                v-if="currentStep > 1"
                                type="button"
                                @click="prevStep"
                                class="inline-flex items-center px-5 py-3 md:px-6 md:py-3 border-2 border-primary-500 text-primary-500 font-semibold rounded-xl active:scale-95 transition-all text-sm md:text-base"
                            >
                                <svg class="w-4 h-4 md:w-5 md:h-5 mr-1.5 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                                {{ t('quote_prev') }}
                            </button>
                            <div v-else></div>

                            <button
                                v-if="currentStep < totalSteps"
                                type="button"
                                @click="nextStep"
                                :disabled="!canProceed"
                                :class="[
                                    'inline-flex items-center px-6 py-3 md:px-8 md:py-3 bg-primary-500 text-white font-semibold rounded-xl transition-all text-sm md:text-base active:scale-95',
                                    !canProceed ? 'opacity-50 cursor-not-allowed !transform-none' : 'shadow-lg'
                                ]"
                            >
                                {{ t('quote_next') }}
                                <svg class="w-4 h-4 md:w-5 md:h-5 ml-1.5 md:ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>

                            <button
                                v-if="currentStep === totalSteps"
                                type="submit"
                                :disabled="!canProceed || form.processing"
                                :class="[
                                    'inline-flex items-center justify-center px-7 py-3.5 md:px-10 md:py-4 bg-accent-500 text-white text-base md:text-lg font-bold rounded-2xl transition-all active:scale-95',
                                    (!canProceed || form.processing) ? 'opacity-50 cursor-not-allowed !transform-none' : 'shadow-xl shadow-accent-500/25'
                                ]"
                            >
                                <span v-if="!form.processing">
                                    {{ t('quote_submit') }}
                                    <svg class="w-5 h-5 ml-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </span>
                                <span v-else class="flex items-center">
                                    <svg class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Verzenden...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Trust Elements -->
                <div class="mt-6 md:mt-8 flex flex-wrap justify-center gap-4 md:gap-6 text-xs md:text-sm text-gray-500">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 md:w-5 md:h-5 mr-1.5 md:mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        GDPR Compliant
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 md:w-5 md:h-5 mr-1.5 md:mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ t('form_subtitle') }}
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 md:w-5 md:h-5 mr-1.5 md:mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ t('hero_badge_free') }}
                    </div>
                </div>
            </div>
        </section>
    </FrontendLayout>
</template>
