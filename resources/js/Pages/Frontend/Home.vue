<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import { useTranslations } from '@/Composables/useTranslations';
import { ref, onMounted, onUnmounted } from 'vue';

const { t, localePath } = useTranslations();

const props = defineProps({
    services: Array,
    meta: Object,
});

// Animated counters
const countersVisible = ref(false);
const counterValues = ref({ years: 0, clients: 0, projects: 0 });

function animateCounter(target, key, duration = 2000) {
    const start = 0;
    const step = (target / duration) * 16;
    let current = start;
    const timer = setInterval(() => {
        current += step;
        if (current >= target) {
            counterValues.value[key] = target;
            clearInterval(timer);
        } else {
            counterValues.value[key] = Math.floor(current);
        }
    }, 16);
}

onMounted(() => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !countersVisible.value) {
                countersVisible.value = true;
                animateCounter(10, 'years', 1500);
                animateCounter(500, 'clients', 2000);
                animateCounter(2000, 'projects', 2500);
            }
        });
    }, { threshold: 0.3 });

    const el = document.getElementById('stats-section');
    if (el) observer.observe(el);
});

// Carousel auto-scroll with requestAnimationFrame
const servicesCarousel = ref(null);
const testimonialsCarousel = ref(null);
const carousels = {};

function initCarousel(name, el) {
    if (!el) return;
    const state = { el, raf: null, paused: false, speed: 0.5, resumeTimer: null };
    carousels[name] = state;

    function tick() {
        if (!state.paused) {
            const max = state.el.scrollWidth - state.el.clientWidth;
            if (state.el.scrollLeft >= max - 1) {
                state.el.scrollLeft = 0;
            } else {
                state.el.scrollLeft += state.speed;
            }
        }
        state.raf = requestAnimationFrame(tick);
    }
    state.raf = requestAnimationFrame(tick);
}

function onCarouselTouch(name, type) {
    const state = carousels[name];
    if (!state) return;
    if (type === 'start') {
        state.paused = true;
        clearTimeout(state.resumeTimer);
    } else {
        state.resumeTimer = setTimeout(() => { state.paused = false; }, 3000);
    }
}

onMounted(() => {
    setTimeout(() => {
        // Only auto-scroll if the element is actually scrollable (mobile)
        if (servicesCarousel.value && servicesCarousel.value.scrollWidth > servicesCarousel.value.clientWidth) {
            initCarousel('services', servicesCarousel.value);
        }
        if (testimonialsCarousel.value && testimonialsCarousel.value.scrollWidth > testimonialsCarousel.value.clientWidth) {
            initCarousel('testimonials', testimonialsCarousel.value);
        }
    }, 500);
});

onUnmounted(() => {
    Object.values(carousels).forEach(s => cancelAnimationFrame(s.raf));
});

const quickForm = useForm({
    name: '',
    email: '',
    phone: '',
    company: '',
    service: '',
    message: '',
    type: 'contact',
});

function submitQuickForm() {
    quickForm.post(localePath('/contact'), { preserveScroll: true });
}

const stats = [
    { value: '10+', key: 'stats_years' },
    { value: '500+', key: 'stats_clients' },
    { value: '2000+', key: 'stats_projects' },
    { value: '24/7', key: 'stats_available' },
];

const whyReasons = [
    { key: 'why_experience', descKey: 'why_experience_desc', icon: 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z' },
    { key: 'why_quality', descKey: 'why_quality_desc', icon: 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z' },
    { key: 'why_flexible', descKey: 'why_flexible_desc', icon: 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z' },
    { key: 'why_green', descKey: 'why_green_desc', icon: 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z' },
    { key: 'why_insured', descKey: 'why_insured_desc', icon: 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z' },
    { key: 'why_price', descKey: 'why_price_desc', icon: 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z' },
];

const testimonials = [
    { name: 'Jan De Smet', company: 'TechCorp NV', text: 'Duogroep levert uitstekend werk. Ons kantoor is altijd brandschoon. Zeer aanbevolen!', rating: 5 },
    { name: 'Marie Peeters', company: 'Café Central', text: 'Professioneel en betrouwbaar. Ze begrijpen de HACCP-normen perfect en leveren altijd top kwaliteit.', rating: 5 },
    { name: 'Peter Janssens', company: 'Immo Plus', text: 'Al jaren onze vaste partner voor het onderhoud van onze appartementsgebouwen. Stipt en grondig.', rating: 5 },
];
</script>

<template>
    <Head>
        <title>{{ meta.title }}</title>
        <meta name="description" :content="meta.description">
        <meta property="og:title" :content="meta.title + ' | Duogroep'">
        <meta property="og:description" :content="meta.description">
        <meta property="og:type" content="website">
        <meta property="og:image" content="/images/hero/hero-bg.jpg">
    </Head>

    <FrontendLayout>

        <!-- ============================================ -->
        <!-- HERO SECTION - Full Image Background         -->
        <!-- ============================================ -->
        <section class="relative min-h-[80vh] md:min-h-[90vh] flex items-center overflow-hidden">
            <!-- Background Image -->
            <div class="absolute inset-0">
                <img
                    src="/images/hero/hero-bg.jpg"
                    alt="Professionele schoonmaak"
                    class="w-full h-full object-cover"
                    loading="eager"
                >
                <div class="absolute inset-0 bg-gradient-to-b md:bg-gradient-to-r from-primary-950/95 via-primary-900/85 to-primary-800/70"></div>
            </div>

            <!-- Animated particles - hidden on mobile for performance -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none hidden md:block">
                <div class="absolute top-20 left-10 w-72 h-72 bg-primary-400/10 rounded-full blur-3xl animate-pulse-slow"></div>
                <div class="absolute bottom-20 right-10 w-96 h-96 bg-secondary-400/10 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1s;"></div>
            </div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20 lg:py-32 w-full">
                <div class="grid lg:grid-cols-5 gap-8 lg:gap-12 items-center">
                    <!-- Left Content -->
                    <div class="lg:col-span-3 text-white">
                        <!-- Badge -->
                        <div class="inline-flex items-center px-3 py-1.5 md:px-4 md:py-2 bg-white/10 border border-white/20 rounded-full text-xs md:text-sm font-semibold text-white mb-5 md:mb-8 backdrop-blur-sm">
                            {{ t('hero_badge_free') }}
                        </div>

                        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-heading font-extrabold leading-[1.1] mb-4 md:mb-6">
                            {{ t('hero_title') }}
                        </h1>

                        <p class="text-base md:text-lg lg:text-xl text-blue-100/90 mb-8 md:mb-10 leading-relaxed max-w-xl">
                            {{ t('hero_subtitle') }}
                        </p>

                        <!-- CTA Buttons - Stack on mobile, row on desktop -->
                        <div class="flex flex-col sm:flex-row gap-3 md:gap-4 mb-8 md:mb-12">
                            <Link :href="localePath('/offerte')" class="group inline-flex items-center justify-center px-7 py-4 md:px-10 md:py-5 bg-accent-500 text-white text-base md:text-lg font-bold rounded-2xl active:bg-accent-600 md:hover:bg-accent-600 transition-all duration-300 md:hover:scale-105 shadow-2xl shadow-accent-500/30">
                                <svg class="w-5 h-5 md:w-6 md:h-6 mr-2 md:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                {{ t('hero_cta_quote') }}
                            </Link>
                            <a href="tel:+32470726137" class="group inline-flex items-center justify-center px-7 py-4 md:px-10 md:py-5 bg-white/10 backdrop-blur-md text-white text-base md:text-lg font-bold rounded-2xl border border-white/20 active:bg-white/20 md:hover:bg-white/20 transition-all duration-300">
                                <svg class="w-5 h-5 md:w-6 md:h-6 mr-2 md:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                {{ t('hero_cta_call') }}
                            </a>
                        </div>

                        <!-- Trust Indicators -->
                        <div class="flex flex-wrap items-center gap-4 md:gap-6">
                            <div class="flex items-center">
                                <div class="flex -space-x-2">
                                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-blue-400 border-2 border-white flex items-center justify-center text-white font-bold text-[10px] md:text-xs">JS</div>
                                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-green-400 border-2 border-white flex items-center justify-center text-white font-bold text-[10px] md:text-xs">MP</div>
                                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-purple-400 border-2 border-white flex items-center justify-center text-white font-bold text-[10px] md:text-xs">PJ</div>
                                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-primary-400 border-2 border-white flex items-center justify-center text-white font-bold text-[10px] md:text-xs">+</div>
                                </div>
                                <div class="ml-3">
                                    <div class="flex text-yellow-400">
                                        <svg v-for="i in 5" :key="i" class="w-3.5 h-3.5 md:w-4 md:h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs md:text-sm text-blue-200">500+ tevreden klanten</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Floating Card (2 cols) -->
                    <div class="lg:col-span-2 hidden lg:block animate-slide-up" style="animation-delay: 0.3s;">
                        <div class="relative">
                            <!-- Glow effect behind card -->
                            <div class="absolute -inset-4 bg-gradient-to-r from-primary-400/20 to-accent-400/20 rounded-3xl blur-2xl"></div>
                            <div class="relative bg-white/10 backdrop-blur-xl rounded-3xl p-8 border border-white/20 shadow-2xl">
                                <div class="text-center mb-6">
                                    <img src="/images/hero/hero-team.jpg" alt="Duogroep Team" class="w-full h-48 object-cover rounded-2xl mb-4">
                                    <h3 class="text-2xl font-heading font-bold text-white">Duogroep</h3>
                                    <p class="text-blue-200 text-sm mt-1">Professioneel Schoonmaakbedrijf</p>
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div v-for="stat in stats" :key="stat.key" class="bg-white/10 rounded-xl p-3 text-center border border-white/10">
                                        <div class="text-2xl font-bold text-white">{{ stat.value }}</div>
                                        <div class="text-xs text-blue-200 mt-1">{{ t(stat.key) }}</div>
                                    </div>
                                </div>
                                <Link :href="localePath('/offerte')" class="mt-6 block w-full text-center py-4 bg-accent-500 text-white font-bold rounded-xl hover:bg-accent-600 transition-all shadow-lg shadow-accent-500/30">
                                    {{ t('hero_cta_quote') }} →
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- STATS BAR - Animated Counters                -->
        <!-- ============================================ -->
        <section id="stats-section" class="bg-white py-6 md:py-10 border-b relative -mt-6 md:-mt-8 z-10">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-2xl shadow-xl -mt-10 md:-mt-16 p-5 md:p-8 grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8 border border-gray-100">
                    <div class="text-center">
                        <div class="text-3xl md:text-5xl font-heading font-extrabold text-primary-500">{{ counterValues.years }}+</div>
                        <div class="text-gray-500 mt-1 text-xs md:text-base font-medium">{{ t('stats_years') }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-5xl font-heading font-extrabold text-primary-500">{{ counterValues.clients }}+</div>
                        <div class="text-gray-500 mt-1 text-xs md:text-base font-medium">{{ t('stats_clients') }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-5xl font-heading font-extrabold text-primary-500">{{ counterValues.projects }}+</div>
                        <div class="text-gray-500 mt-1 text-xs md:text-base font-medium">{{ t('stats_projects') }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-5xl font-heading font-extrabold text-green-500">24/7</div>
                        <div class="text-gray-500 mt-1 text-xs md:text-base font-medium">{{ t('stats_available') }}</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- SERVICES SECTION - Image Cards               -->
        <!-- ============================================ -->
        <section class="py-14 md:py-20 lg:py-28 px-4 sm:px-6 lg:px-8 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-10 md:mb-16">
                    <span class="inline-block px-3 py-1.5 md:px-4 md:py-2 bg-primary-100 text-primary-600 font-semibold text-xs md:text-sm rounded-full mb-3 md:mb-4">{{ t('nav_services') }}</span>
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-heading font-extrabold text-gray-900 mb-3 md:mb-4">
                        {{ t('services_title') }}
                    </h2>
                    <p class="text-base md:text-lg text-gray-500 max-w-2xl mx-auto">
                        {{ t('services_subtitle') }}
                    </p>
                </div>

                <!-- Service Cards - Carousel on mobile, Grid on desktop -->
                <div ref="servicesCarousel"
                     @touchstart="onCarouselTouch('services', 'start')"
                     @touchend="onCarouselTouch('services', 'end')"
                     class="flex md:grid md:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-8 overflow-x-auto md:overflow-visible scrollbar-hide pb-4 md:pb-0 -mx-4 px-4 md:mx-0 md:px-0">
                    <Link
                        v-for="(service, index) in services.slice(0, 6)"
                        :key="service.slug"
                        :href="localePath(`/diensten/${service.slug}`)"
                        class="group relative bg-white rounded-2xl md:rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 md:hover:-translate-y-2 active:scale-[0.98] flex-shrink-0 w-[75vw] md:w-auto"
                    >
                        <!-- Service Image -->
                        <div class="relative h-44 md:h-56 overflow-hidden">
                            <img
                                :src="service.image"
                                :alt="t(service.name_key)"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                loading="lazy"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>

                            <!-- Floating badge -->
                            <div class="absolute top-3 left-3 md:top-4 md:left-4 px-2.5 py-1 md:px-3 bg-white/90 backdrop-blur-sm rounded-full text-[10px] md:text-xs font-bold text-primary-600">
                                Duogroep
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-4 md:p-6">
                            <h3 class="text-lg md:text-xl font-heading font-bold text-gray-900 mb-1.5 md:mb-2 group-hover:text-primary-500 transition-colors">
                                {{ t(service.name_key) }}
                            </h3>
                            <p class="text-sm md:text-base text-gray-500 leading-relaxed mb-3 md:mb-4 line-clamp-2">
                                {{ t(service.desc_key) }}
                            </p>
                            <div class="flex items-center text-primary-500 font-semibold text-sm md:text-base">
                                <span>{{ t('service_learn_more') }}</span>
                                <svg class="w-4 h-4 md:w-5 md:h-5 ml-2 transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </div>
                        </div>
                    </Link>
                </div>

                <!-- View All Button -->
                <div class="text-center mt-10 md:mt-14">
                    <Link :href="localePath('/diensten')" class="group inline-flex items-center px-7 py-4 md:px-10 md:py-5 bg-primary-500 text-white font-bold text-base md:text-lg rounded-2xl hover:bg-primary-600 transition-all duration-300 shadow-xl shadow-primary-500/25 md:hover:shadow-primary-500/40 md:hover:scale-105 active:scale-95">
                        {{ t('services_view_all') }}
                        <svg class="w-5 h-5 md:w-6 md:h-6 ml-2 md:ml-3 transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </Link>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- WHY CHOOSE US                                -->
        <!-- ============================================ -->
        <section class="py-14 md:py-20 lg:py-28 px-4 sm:px-6 lg:px-8 bg-white overflow-hidden">
            <div class="max-w-7xl mx-auto">
                <!-- Header -->
                <div class="text-center mb-8 md:mb-16">
                    <span class="inline-block px-3 py-1.5 md:px-4 md:py-2 bg-primary-100 text-primary-600 font-semibold text-xs md:text-sm rounded-full mb-3 md:mb-4">Duogroep</span>
                    <h2 class="text-2xl md:text-4xl lg:text-5xl font-heading font-extrabold text-gray-900 leading-tight">
                        {{ t('why_title') }}
                    </h2>
                    <p class="text-sm md:text-lg text-gray-500 mt-2 md:mt-4 max-w-2xl mx-auto hidden md:block">{{ t('why_subtitle') }}</p>
                </div>

                <!-- Mobile: Image + 3-column grid -->
                <div class="md:hidden">
                    <div class="relative mb-6 rounded-2xl overflow-hidden">
                        <img src="/images/hero/why.jpg" alt="Professionele schoonmaak team" class="w-full h-44 object-cover" loading="lazy">
                        <div class="absolute bottom-3 right-3 bg-white/90 backdrop-blur-sm rounded-xl px-3 py-1.5 flex items-center gap-2">
                            <div class="w-6 h-6 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-gray-900">100% {{ t('hero_badge_satisfaction') }}</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-3">
                        <div v-for="reason in whyReasons" :key="reason.key"
                             class="flex flex-col items-center text-center p-3 rounded-2xl bg-gray-50">
                            <div class="w-10 h-10 rounded-xl bg-primary-500 flex items-center justify-center mb-2.5">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="reason.icon"/>
                                </svg>
                            </div>
                            <h3 class="text-[11px] font-bold text-gray-900 leading-tight">{{ t(reason.key) }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Desktop: Image + list layout -->
                <div class="hidden md:grid md:grid-cols-2 gap-16 items-center">
                    <div class="relative">
                        <div class="absolute -inset-4 bg-primary-100 rounded-3xl -rotate-3"></div>
                        <img src="/images/hero/why.jpg" alt="Professionele schoonmaak team" class="relative rounded-3xl shadow-2xl w-full h-[400px] lg:h-[500px] object-cover" loading="lazy">
                        <div class="absolute -bottom-6 -right-6 bg-white rounded-2xl shadow-xl p-6 border border-gray-100">
                            <div class="flex items-center space-x-4">
                                <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-2xl font-bold text-gray-900">100%</div>
                                    <div class="text-sm text-gray-500">{{ t('hero_badge_satisfaction') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="grid grid-cols-1 gap-5">
                            <div v-for="reason in whyReasons" :key="reason.key"
                                 class="flex items-start gap-4 group rounded-xl p-3 hover:bg-primary-50 transition-colors duration-300">
                                <div class="w-12 h-12 rounded-xl bg-primary-50 group-hover:bg-primary-500 flex items-center justify-center flex-shrink-0 transition-colors duration-300">
                                    <svg class="w-6 h-6 text-primary-500 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="reason.icon"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 leading-tight">{{ t(reason.key) }}</h3>
                                    <p class="text-sm text-gray-500 leading-snug mt-0.5">{{ t(reason.descKey) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- CTA BANNER - Full Image Background           -->
        <!-- ============================================ -->
        <section class="relative py-14 md:py-24 overflow-hidden">
            <div class="absolute inset-0">
                <img src="/images/misc/cta-bg.jpg" alt="" class="w-full h-full object-cover" loading="lazy">
                <div class="absolute inset-0 bg-primary-900/85"></div>
            </div>
            <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-heading font-extrabold text-white mb-4 md:mb-6">
                    {{ t('cta_title') }}
                </h2>
                <p class="text-base md:text-xl text-blue-100/80 mb-8 md:mb-10 max-w-2xl mx-auto">
                    {{ t('cta_subtitle') }}
                </p>
                <div class="flex flex-col sm:flex-row gap-3 md:gap-5 justify-center">
                    <Link :href="localePath('/offerte')" class="group inline-flex items-center justify-center px-8 py-4 md:px-12 md:py-6 bg-accent-500 text-white text-base md:text-xl font-bold rounded-2xl active:bg-accent-600 md:hover:bg-accent-600 transition-all duration-300 shadow-2xl shadow-accent-500/30 md:hover:scale-105 active:scale-95">
                        {{ t('cta_button') }}
                        <svg class="w-5 h-5 md:w-6 md:h-6 ml-2 md:ml-3 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </Link>
                    <a href="tel:+32470726137" class="inline-flex items-center justify-center px-8 py-4 md:px-12 md:py-6 border-2 border-white/30 text-white text-base md:text-xl font-bold rounded-2xl active:bg-white/20 md:hover:bg-white/10 backdrop-blur-sm transition-all duration-300">
                        <svg class="w-5 h-5 md:w-6 md:h-6 mr-2 md:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        {{ t('hero_cta_call') }}
                    </a>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- TESTIMONIALS - Cards with avatars             -->
        <!-- ============================================ -->
        <section class="py-14 md:py-20 lg:py-28 px-4 sm:px-6 lg:px-8 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-10 md:mb-16">
                    <span class="inline-block px-3 py-1.5 md:px-4 md:py-2 bg-yellow-100 text-yellow-700 font-semibold text-xs md:text-sm rounded-full mb-3 md:mb-4">★★★★★</span>
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-heading font-extrabold text-gray-900 mb-3 md:mb-4">
                        {{ t('testimonials_title') }}
                    </h2>
                </div>

                <div ref="testimonialsCarousel"
                     @touchstart="onCarouselTouch('testimonials', 'start')"
                     @touchend="onCarouselTouch('testimonials', 'end')"
                     class="flex md:grid md:grid-cols-3 gap-5 md:gap-8 overflow-x-auto md:overflow-visible scrollbar-hide pb-4 md:pb-0 -mx-4 px-4 md:mx-0 md:px-0">
                    <div v-for="(testimonial, index) in testimonials" :key="testimonial.name"
                         class="bg-white rounded-2xl md:rounded-3xl p-5 md:p-8 shadow-lg hover:shadow-xl transition-all duration-300 md:hover:-translate-y-1 relative flex-shrink-0 w-[80vw] md:w-auto">
                        <!-- Quote mark -->
                        <div class="absolute top-4 right-4 md:top-6 md:right-6 text-5xl md:text-6xl font-serif text-primary-100 leading-none">"</div>

                        <div class="flex items-center space-x-1 mb-4 md:mb-6">
                            <svg v-for="i in testimonial.rating" :key="i" class="w-4 h-4 md:w-5 md:h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>

                        <p class="text-gray-600 leading-relaxed mb-6 md:mb-8 text-base md:text-lg italic relative z-10">"{{ testimonial.text }}"</p>

                        <div class="flex items-center">
                            <div class="w-11 h-11 md:w-14 md:h-14 rounded-full flex items-center justify-center mr-3 md:mr-4 text-white font-bold text-sm md:text-lg"
                                 :class="index === 0 ? 'bg-blue-500' : index === 1 ? 'bg-green-500' : 'bg-purple-500'">
                                {{ testimonial.name.split(' ').map(n => n[0]).join('') }}
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 text-sm md:text-base">{{ testimonial.name }}</p>
                                <p class="text-xs md:text-sm text-gray-500">{{ testimonial.company }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- ZONE SECTION - Google Maps                   -->
        <!-- ============================================ -->
        <section class="py-14 md:py-20 lg:py-28 px-4 sm:px-6 lg:px-8 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                    <!-- Map -->
                    <div class="relative rounded-2xl md:rounded-3xl overflow-hidden shadow-xl order-2 lg:order-1">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d80192.77!2d4.3517!3d51.2194!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c3f68683bbb1c1%3A0x40099ab2f4d6970!2sAntwerpen!5e0!3m2!1snl!2sbe!4v1"
                            class="w-full h-[280px] md:h-[420px] lg:h-[460px] border-0"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                        ></iframe>
                    </div>

                    <!-- Content -->
                    <div class="order-1 lg:order-2">
                        <span class="inline-flex items-center px-3 py-1.5 md:px-4 md:py-2 bg-primary-100 text-primary-600 font-semibold text-xs md:text-sm rounded-full mb-3 md:mb-4">
                            <svg class="w-3.5 h-3.5 md:w-4 md:h-4 mr-1.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                            Antwerpen
                        </span>
                        <h2 class="text-2xl md:text-4xl lg:text-5xl font-heading font-extrabold text-gray-900 mb-3 md:mb-4 leading-tight">
                            {{ t('zone_title') }}
                        </h2>
                        <p class="text-sm md:text-lg text-primary-500 font-semibold mb-2 md:mb-3">
                            {{ t('zone_subtitle') }}
                        </p>
                        <p class="text-sm md:text-base text-gray-500 leading-relaxed mb-6 md:mb-8">
                            {{ t('zone_description') }}
                        </p>

                        <!-- City pills -->
                        <div class="flex flex-wrap gap-2 mb-6 md:mb-8">
                            <span v-for="(city, i) in ['Antwerpen', 'Berchem', 'Borgerhout', 'Deurne', 'Merksem', 'Hoboken', 'Wilrijk', 'Mortsel', 'Edegem', 'Kontich', 'Schoten', 'Brasschaat']"
                                  :key="city"
                                  :class="[
                                      'px-3 py-1.5 rounded-full text-xs font-semibold',
                                      i === 0 ? 'bg-primary-500 text-white' : 'bg-white text-gray-600 border border-gray-200'
                                  ]">
                                {{ city }}
                            </span>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3">
                            <Link :href="localePath('/offerte')" class="btn-primary">
                                {{ t('hero_cta_quote') }}
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </Link>
                            <a href="tel:+32470726137" class="btn-secondary">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                {{ t('hero_cta_call') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================ -->
        <!-- QUICK CONTACT FORM                           -->
        <!-- ============================================ -->
        <section class="py-14 md:py-20 lg:py-28 px-4 sm:px-6 lg:px-8 bg-gray-50">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-8 md:mb-12">
                    <span class="inline-block px-3 py-1.5 md:px-4 md:py-2 bg-accent-100 text-accent-600 font-semibold text-xs md:text-sm rounded-full mb-3 md:mb-4">Contact</span>
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-heading font-extrabold text-gray-900 mb-3 md:mb-4">
                        {{ t('form_title') }}
                    </h2>
                    <p class="text-base md:text-lg text-gray-500">
                        {{ t('form_subtitle') }}
                    </p>
                </div>

                <form @submit.prevent="submitQuickForm" class="bg-white rounded-2xl md:rounded-3xl shadow-xl p-5 md:p-8 lg:p-12 border border-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">{{ t('form_name') }} *</label>
                            <input v-model="quickForm.name" type="text" required
                                class="w-full rounded-xl border-gray-200 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-3 px-4"
                                :placeholder="t('form_name')">
                            <p v-if="quickForm.errors.name" class="mt-1 text-sm text-red-600">{{ quickForm.errors.name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">{{ t('form_email') }} *</label>
                            <input v-model="quickForm.email" type="email" required
                                class="w-full rounded-xl border-gray-200 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-3 px-4"
                                :placeholder="t('form_email')">
                            <p v-if="quickForm.errors.email" class="mt-1 text-sm text-red-600">{{ quickForm.errors.email }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">{{ t('form_phone') }} *</label>
                            <input v-model="quickForm.phone" type="tel" required
                                class="w-full rounded-xl border-gray-200 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-3 px-4"
                                :placeholder="t('form_phone')">
                            <p v-if="quickForm.errors.phone" class="mt-1 text-sm text-red-600">{{ quickForm.errors.phone }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">{{ t('form_company') }}</label>
                            <input v-model="quickForm.company" type="text"
                                class="w-full rounded-xl border-gray-200 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-3 px-4"
                                :placeholder="t('form_company')">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">{{ t('form_service') }}</label>
                            <select v-model="quickForm.service"
                                class="w-full rounded-xl border-gray-200 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-3 px-4">
                                <option value="">{{ t('form_select_service') }}</option>
                                <option v-for="service in services" :key="service.slug" :value="service.slug">
                                    {{ t(service.name_key) }}
                                </option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">{{ t('form_message') }} *</label>
                            <textarea v-model="quickForm.message" rows="4" required
                                class="w-full rounded-xl border-gray-200 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-3 px-4"
                                :placeholder="t('form_message')"></textarea>
                            <p v-if="quickForm.errors.message" class="mt-1 text-sm text-red-600">{{ quickForm.errors.message }}</p>
                        </div>
                    </div>

                    <div class="mt-6 md:mt-8">
                        <p class="text-xs md:text-sm text-gray-400 mb-4 md:mb-6 flex items-center">
                            <svg class="w-4 h-4 md:w-5 md:h-5 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            {{ t('form_gdpr') }}
                        </p>
                        <button type="submit" :disabled="quickForm.processing"
                            class="w-full md:w-auto inline-flex items-center justify-center px-8 py-4 md:px-14 md:py-5 bg-accent-500 text-white text-base md:text-xl font-bold rounded-2xl active:bg-accent-600 md:hover:bg-accent-600 transition-all duration-300 shadow-xl shadow-accent-500/25 md:hover:shadow-accent-500/40 md:hover:scale-105 active:scale-95">
                            <span v-if="!quickForm.processing">
                                {{ t('form_submit') }}
                                <svg class="w-5 h-5 md:w-6 md:h-6 ml-2 md:ml-3 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </span>
                            <span v-else class="flex items-center">
                                <svg class="animate-spin w-5 h-5 md:w-6 md:h-6 mr-2 md:mr-3" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Verzenden...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </section>

    </FrontendLayout>
</template>
