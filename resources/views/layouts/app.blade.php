<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Swedish Laravel Association - Laravel Sweden</title>
    <meta name="description" content="Föreningens syfte är att sprida kännedom om PHP-ramverket Laravel genom möten, konferenser och andra aktiviteter.">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://laravelsweden.org/">
    <meta property="og:title" content="Swedish Laravel Association - Laravel Sweden">
    <meta property="og:description" content="Föreningens syfte är att sprida kännedom om PHP-ramverket Laravel genom möten, konferenser och andra aktiviteter.">
    <meta property="og:image" content="{{ asset('banner-1500x500.jpeg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://laravelsweden.org/">
    <meta property="twitter:title" content="Swedish Laravel Association - Laravel Sweden">
    <meta property="twitter:description" content="Föreningens syfte är att sprida kännedom om PHP-ramverket Laravel genom möten, konferenser och andra aktiviteter.">
    <meta property="twitter:image" content="{{ asset('banner-1500x500.jpeg') }}">

    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    @livewireStyles
    @vite('resources/css/app.css')

</head>
<body>
    <a href="#main-content" class="skip-nav">Hoppa till huvudinnehåll</a>

    {{ $slot }}

    @livewireScripts
</body>
</html>
