<script setup>
import { Head, Link } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import { useTranslations } from '@/Composables/useTranslations';

const { t, localePath } = useTranslations();
</script>

<template>
    <Head>
        <title>{{ t('thanks_title') }}</title>
    </Head>

    <FrontendLayout>
        <section class="section-padding pt-28 md:pt-32">
            <div class="max-w-2xl mx-auto text-center px-4">
                <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-8">
                    <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h1 class="text-4xl font-heading font-bold text-gray-900 mb-4">{{ t('thanks_title') }}</h1>
                <p class="text-xl text-gray-600 mb-8">{{ t('thanks_subtitle') }}</p>
                <Link :href="localePath('/')" class="btn-primary">
                    {{ t('thanks_back') }}
                </Link>
            </div>
        </section>
    </FrontendLayout>
</template>
