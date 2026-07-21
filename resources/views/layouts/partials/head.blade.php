<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="csrf-token" content="{{ csrf_token() }}">

@php
    $pageSeo = $seo ?? null;
    $pageTitle = $pageSeo['title'] ?? trim($__env->yieldContent('title', config('site.name').' | '.config('site.name_ar')));
    $pageDescription = $pageSeo['description'] ?? trim($__env->yieldContent('meta_description', config('site.hero.description')));
    $canonicalUrl = $pageSeo['canonical'] ?? url()->current();
    $ogImage = $pageSeo['image'] ?? ($defaultSeoImage ?? asset(config('seo.organization.logo')));
    $ogType = $pageSeo['type'] ?? 'website';
    $locale = $pageSeo['locale'] ?? config('seo.defaults.locale');
    $keywords = $pageSeo['keywords'] ?? config('seo.defaults.keywords');
    $author = $pageSeo['author'] ?? config('seo.defaults.author');
    $twitterCard = $pageSeo['twitter_card'] ?? config('seo.defaults.twitter_card');
    $organization = $pageSeo['organization'] ?? config('seo.organization');
@endphp

<title>{{ $pageTitle }}</title>
<link rel="icon" href="{{ asset(config('seo.organization.logo')) }}" type="image/png">
<link rel="apple-touch-icon" href="{{ asset(config('seo.organization.logo')) }}">
<meta name="description" content="{{ $pageDescription }}">
<meta name="keywords" content="{{ $keywords }}">
<meta name="author" content="{{ $author }}">
<meta name="robots" content="index, follow, max-image-preview:large">
<meta name="geo.region" content="{{ config('seo.defaults.region') }}">
<link rel="canonical" href="{{ $canonicalUrl }}">

<meta property="og:locale" content="{{ str_replace('_', '-', $locale) }}">
<meta property="og:type" content="{{ $ogType }}">
<meta property="og:title" content="{{ $pageTitle }}">
<meta property="og:description" content="{{ $pageDescription }}">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:site_name" content="{{ $organization['name'] }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:image:alt" content="{{ $organization['name'] }}">

<meta name="twitter:card" content="{{ $twitterCard }}">
<meta name="twitter:title" content="{{ $pageTitle }}">
<meta name="twitter:description" content="{{ $pageDescription }}">
<meta name="twitter:image" content="{{ $ogImage }}">

<link rel="alternate" hreflang="ar-SY" href="{{ $canonicalUrl }}">
<link rel="sitemap" type="application/xml" href="{{ route('sitemap') }}">

<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => $organization['name'],
    'url' => $organization['url'],
    'logo' => asset($organization['logo']),
    'areaServed' => $organization['area_served'],
    'address' => [
        '@type' => 'PostalAddress',
        'addressLocality' => $organization['address_locality'],
        'addressCountry' => $organization['address_country'],
    ],
    'contactPoint' => [
        '@type' => 'ContactPoint',
        'telephone' => config('site.contact.phone'),
        'email' => config('site.contact.email'),
        'contactType' => 'customer service',
        'areaServed' => 'SY',
        'availableLanguage' => ['ar'],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
</script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
@vite(['resources/css/app.css', 'resources/js/app.js'])

<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

@stack('styles')
