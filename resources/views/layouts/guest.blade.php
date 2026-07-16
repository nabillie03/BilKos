{{--
  GANTI ISI file resources/views/layouts/guest.blade.php kamu dengan ini.
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'BilKos') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=fraunces:500,600,700|public-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-navy min-h-screen flex flex-col items-center justify-center px-4">
    <div class="mb-8 flex items-center gap-2">
        <span class="text-gold text-3xl">&#128273;</span>
        <span class="font-display font-semibold text-white text-2xl tracking-wide">BilKos</span>
    </div>

    <div class="w-full sm:max-w-md bg-white shadow-xl rounded-xl px-8 py-8 border-t-4 border-gold">
        {{ $slot }}
    </div>

    <p class="mt-6 text-white/50 text-xs">Sistem Informasi Manajemen Kos-Kosan</p>
</body>
</html>
