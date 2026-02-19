<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @inertiaHead

    <link rel="icon" href="/favicon.ico" sizes="48x48">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="theme-color" content="#1e3a8a">
    <meta name="msapplication-TileColor" content="#1e3a8a">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">

    @verbatim
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "CleaningService",
        "name": "Duogroep",
        "description": "Professioneel schoonmaakbedrijf in Antwerpen. Clean, Fresh and Shiny. Kantoren, gebouwen, industrieel en meer.",
        "telephone": "+32470726137",
        "email": "duogroep@gmail.com",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Middelmolenlaan 20",
            "addressLocality": "Deurne",
            "addressRegion": "Antwerpen",
            "postalCode": "2100",
            "addressCountry": "BE"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": "51.2194",
            "longitude": "4.4025"
        },
        "areaServed": {
            "@type": "City",
            "name": "Antwerpen"
        },
        "priceRange": "€€",
        "openingHoursSpecification": {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],
            "opens": "00:00",
            "closes": "23:59"
        },
        "sameAs": []
    }
    </script>
    @endverbatim

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white">
    @inertia
</body>
</html>
