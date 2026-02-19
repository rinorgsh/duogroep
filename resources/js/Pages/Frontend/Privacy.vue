<script setup>
import { Head } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import { useTranslations } from '@/Composables/useTranslations';

const { t } = useTranslations();
</script>

<template>
    <Head>
        <title>{{ t('privacy_title') }}</title>
    </Head>

    <FrontendLayout>
        <section class="gradient-hero pt-28 md:pt-32 pb-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
                <h1 class="text-4xl font-heading font-bold">{{ t('privacy_title') }}</h1>
            </div>
        </section>

        <section class="section-padding">
            <div class="max-w-3xl mx-auto px-4 prose prose-lg">
                <h2>1. Verantwoordelijke</h2>
                <p>Duogroep, gevestigd te Deurne (Antwerpen), België, is verantwoordelijk voor de verwerking van persoonsgegevens zoals beschreven in dit privacybeleid.</p>

                <h2>2. Welke gegevens verzamelen wij?</h2>
                <p>Wij verzamelen de volgende persoonsgegevens:</p>
                <ul>
                    <li>Naam en voornaam</li>
                    <li>E-mailadres</li>
                    <li>Telefoonnummer</li>
                    <li>Bedrijfsnaam (optioneel)</li>
                    <li>Berichten die u via contactformulieren verstuurt</li>
                </ul>

                <h2>3. Doel van de verwerking</h2>
                <p>Uw persoonsgegevens worden verwerkt voor:</p>
                <ul>
                    <li>Het beantwoorden van uw vragen en verzoeken</li>
                    <li>Het opstellen en verzenden van offertes</li>
                    <li>Het uitvoeren van overeenkomsten</li>
                    <li>Het verbeteren van onze dienstverlening</li>
                </ul>

                <h2>4. Bewaartermijn</h2>
                <p>Wij bewaren uw persoonsgegevens niet langer dan strikt noodzakelijk voor de doeleinden waarvoor ze zijn verzameld, met een maximum van 2 jaar.</p>

                <h2>5. Delen met derden</h2>
                <p>Wij delen uw persoonsgegevens niet met derden, tenzij dit noodzakelijk is voor de uitvoering van een overeenkomst of wettelijk verplicht is.</p>

                <h2>6. Uw rechten</h2>
                <p>U heeft het recht om uw persoonsgegevens in te zien, te corrigeren of te verwijderen. Neem contact met ons op via duogroep@gmail.com.</p>

                <h2>7. Cookies</h2>
                <p>Onze website maakt gebruik van technische en analytische cookies om de website goed te laten functioneren en het gebruik te analyseren.</p>

                <h2>8. Contact</h2>
                <p>Voor vragen over dit privacybeleid kunt u contact opnemen via duogroep@gmail.com.</p>
            </div>
        </section>
    </FrontendLayout>
</template>
