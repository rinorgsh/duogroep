<script setup>
import { Head } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import { useTranslations } from '@/Composables/useTranslations';

const { t } = useTranslations();
</script>

<template>
    <Head>
        <title>{{ t('terms_title') }}</title>
    </Head>

    <FrontendLayout>
        <section class="gradient-hero pt-28 md:pt-32 pb-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
                <h1 class="text-4xl font-heading font-bold">{{ t('terms_title') }}</h1>
            </div>
        </section>

        <section class="section-padding">
            <div class="max-w-3xl mx-auto px-4 prose prose-lg">
                <h2>1. Algemeen</h2>
                <p>Deze algemene voorwaarden zijn van toepassing op alle offertes, overeenkomsten en leveringen van diensten door Duogroep, gevestigd te Deurne (Antwerpen), België.</p>

                <h2>2. Offertes</h2>
                <p>Alle offertes zijn vrijblijvend en geldig gedurende 30 dagen na datum van uitgifte, tenzij anders vermeld.</p>

                <h2>3. Uitvoering van diensten</h2>
                <p>Duogroep zal de overeengekomen diensten naar beste inzicht en vermogen uitvoeren, in overeenstemming met de eisen van goed vakmanschap.</p>

                <h2>4. Prijzen en betaling</h2>
                <p>Alle prijzen zijn exclusief BTW tenzij anders vermeld. Betaling dient te geschieden binnen 30 dagen na factuurdatum.</p>

                <h2>5. Annulering</h2>
                <p>Annulering van een overeenkomst dient schriftelijk te gebeuren, minstens 48 uur voor de geplande uitvoering.</p>

                <h2>6. Aansprakelijkheid</h2>
                <p>Duogroep is verzekerd tegen beroepsaansprakelijkheid. Onze aansprakelijkheid is beperkt tot het bedrag dat door onze verzekeraar wordt uitgekeerd.</p>

                <h2>7. Klachten</h2>
                <p>Klachten over de uitgevoerde diensten dienen binnen 48 uur na uitvoering schriftelijk te worden gemeld.</p>

                <h2>8. Toepasselijk recht</h2>
                <p>Op alle overeenkomsten is het Belgisch recht van toepassing. Geschillen worden voorgelegd aan de bevoegde rechtbank in Antwerpen.</p>
            </div>
        </section>
    </FrontendLayout>
</template>
