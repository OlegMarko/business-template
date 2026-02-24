<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $siteName = config('app.name');
        $metaTitle = '';
        $metaDescription = '';
        $faviconPath = '';
        $ogImagePath = '';
        if (\Illuminate\Support\Facades\Schema::hasTable('site_settings')) {
            $siteName = \App\Models\SiteSetting::get('site_name', config('app.name'));
            $metaTitle = \App\Models\SiteSetting::get('meta_title', '');
            $metaDescription = \App\Models\SiteSetting::get('meta_description', '');
            $faviconPath = \App\Models\SiteSetting::get('favicon', '');
            $ogImagePath = \App\Models\SiteSetting::get('og_image', '');
        }
        $pageTitle = $metaTitle !== '' ? $metaTitle : $siteName;
        $faviconUrl = $faviconPath !== '' ? asset('storage/' . $faviconPath) : null;
        $ogImageUrl = $ogImagePath !== '' ? asset('storage/' . $ogImagePath) : null;
    @endphp
    <title>{{ $pageTitle }}</title>
    @if($faviconUrl)
    <link rel="icon" href="{{ $faviconUrl }}">
    @endif
    @if($metaDescription !== '')
    <meta name="description" content="{{ $metaDescription }}">
    @endif
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $pageTitle }}">
    @if($metaDescription !== '')
    <meta property="og:description" content="{{ $metaDescription }}">
    @endif
    @if($ogImageUrl)
    <meta property="og:image" content="{{ $ogImageUrl }}">
    @endif
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta name="twitter:card" content="{{ $ogImageUrl ? 'summary_large_image' : 'summary' }}">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    @if($metaDescription !== '')
    <meta name="twitter:description" content="{{ $metaDescription }}">
    @endif
    @if($ogImageUrl)
    <meta name="twitter:image" content="{{ $ogImageUrl }}">
    @endif
    @php
        $primaryHex = '#0d9488';
        if (\Illuminate\Support\Facades\Schema::hasTable('site_settings')) {
            $stored = \App\Models\SiteSetting::get('primary_color', '');
            if ($stored !== '' && str_starts_with($stored, '#')) {
                $primaryHex = $stored;
            }
        }
        try {
            $primaryShades = \App\Support\ColorHelper::shadesFromHex($primaryHex);
        } catch (\Throwable $e) {
            $primaryShades = \App\Support\ColorHelper::shadesFromHex('#0d9488');
        }
    @endphp
    <style>
        :root {
            --color-primary: {{ $primaryHex }};
            @foreach($primaryShades as $key => $hex)
            --color-primary-{{ $key }}: {{ $hex }};
            @endforeach
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @inertiaHead
</head>
<body class="antialiased">
    @inertia
</body>
</html>
