<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Business') }}</title>
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
