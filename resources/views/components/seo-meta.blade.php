@props([
    'title' => null,
    'description' => null,
    'keywords' => null,
    'image' => null,
    'url' => null,
    'type' => 'website'
])

@php
    $locale = app()->getLocale();
    $defaultTitle = $locale == 'ar' ? __('messages.seo_title') : __('messages.seo_title');
    $defaultDescription = __('messages.seo_description');
    $defaultKeywords = __('messages.seo_keywords');
    
    $pageTitle = $title ?? $defaultTitle;
    $pageDescription = $description ?? $defaultDescription;
    $pageKeywords = $keywords ?? $defaultKeywords;
    $pageUrl = $url ?? request()->url();
    $pageImage = $image ?? asset('images/talib-og-image.png');
@endphp

<!-- Primary Meta Tags -->
<meta name="title" content="{{ $pageTitle }}">
<meta name="description" content="{{ $pageDescription }}">
<meta name="keywords" content="{{ $pageKeywords }}">
<meta name="author" content="Talib Platform">
<meta name="robots" content="index, follow">
<meta name="language" content="{{ $locale == 'ar' ? 'Arabic' : 'English' }}">
<meta name="revisit-after" content="7 days">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="{{ $type }}">
<meta property="og:url" content="{{ $pageUrl }}">
<meta property="og:title" content="{{ $pageTitle }}">
<meta property="og:description" content="{{ $pageDescription }}">
<meta property="og:image" content="{{ $pageImage }}">
<meta property="og:locale" content="{{ $locale == 'ar' ? 'ar_SA' : 'en_US' }}">
<meta property="og:locale:alternate" content="{{ $locale == 'ar' ? 'en_US' : 'ar_SA' }}">
<meta property="og:site_name" content="Talib - طالب">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="{{ $pageUrl }}">
<meta name="twitter:title" content="{{ $pageTitle }}">
<meta name="twitter:description" content="{{ $pageDescription }}">
<meta name="twitter:image" content="{{ $pageImage }}">

<!-- Canonical URL -->
<link rel="canonical" href="{{ $pageUrl }}">

<!-- Alternate Language URLs -->
<link rel="alternate" hreflang="ar" href="{{ url('/') }}?lang=ar">
<link rel="alternate" hreflang="en" href="{{ url('/') }}?lang=en">
<link rel="alternate" hreflang="x-default" href="{{ url('/') }}">

<!-- Structured Data (JSON-LD) -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "EducationalOrganization",
    "name": "Talib - طالب",
    "alternateName": "منصة طالب التعليمية",
    "url": "{{ url('/') }}",
    "logo": "{{ asset('images/logo.png') }}",
    "description": "{{ $pageDescription }}",
    "address": {
        "@type": "PostalAddress",
        "addressLocality": "Amman",
        "addressCountry": "JO"
    },
    "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "+962-6-123-4567",
        "contactType": "customer service",
        "availableLanguage": ["Arabic", "English"]
    },
    "sameAs": [
        "https://facebook.com/talibplatform",
        "https://twitter.com/talibplatform",
        "https://instagram.com/talibplatform",
        "https://linkedin.com/company/talibplatform"
    ]
}
</script>
