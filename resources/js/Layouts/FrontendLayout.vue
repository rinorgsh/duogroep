<script setup>
import Header from '@/Components/Frontend/Header.vue';
import Footer from '@/Components/Frontend/Footer.vue';
import MobileCTA from '@/Components/Frontend/MobileCTA.vue';
</script>

<template>
    <div class="min-h-screen flex flex-col overflow-x-hidden">
        <Header />
        <main class="flex-1">
            <slot />
        </main>
        <Footer />
        <MobileCTA />
        <!-- Spacer for mobile CTA bar -->
        <div class="h-20 lg:hidden"></div>
    </div>
</template>
