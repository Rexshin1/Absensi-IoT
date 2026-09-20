<!DOCTYPE html>
<html lang="id" x-data="matdash" x-bind:class="{ 'dark': isDark }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Sistem Absensi IoT' }}</title>
    <link rel="icon" href="{{ asset('images/logos/ukm-pagar-nusa.jpeg') }}" type="image/jpeg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.dataTables.min.css') }}?v=1">
    <link rel="stylesheet" href="{{ asset('vendor/datatables/buttons.dataTables.min.css') }}?v=1">
    <style>[x-cloak] { display: none !important; } body { font-family: 'Manrope', sans-serif; }</style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --color-primary: #159447;
            --color-secondary: #22b14c;
            --primary: #159447;
            --secondary: #22b14c;
            --accent: color-mix(in oklab, #159447 12%, transparent);
            --color-lightprimary: color-mix(in oklab, #159447 12%, transparent);
        }
        .dark {
            --color-lightprimary: color-mix(in oklab, #159447 22%, transparent);
        }
    </style>
    @stack('head')
</head>
<body class="overflow-x-hidden bg-lightgray text-sm text-link dark:bg-dark dark:text-darklink">
    <div class="min-h-screen">
        @include('partials.sidebar')

        <div class="min-h-screen xl:pl-[280px]">
            @include('partials.header')
            <main class="min-h-[calc(100vh-72px)] bg-lightgray py-4 dark:bg-dark sm:py-6">
                <div class="mx-auto w-full max-w-[1600px] px-4 sm:px-6 lg:px-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    <script src="{{ asset('vendor/datatables/jquery-3.7.1.min.js') }}?v=1" defer></script>
    <script src="{{ asset('vendor/datatables/dataTables.min.js') }}?v=1" defer></script>
    <script src="{{ asset('vendor/datatables/pdfmake.min.js') }}?v=1" defer></script>
    <script src="{{ asset('vendor/datatables/vfs_fonts.js') }}?v=1" defer></script>
    <script src="{{ asset('vendor/datatables/dataTables.buttons.min.js') }}?v=1" defer></script>
    <script src="{{ asset('vendor/datatables/buttons.html5.min.js') }}?v=1" defer></script>
    <script src="{{ asset('js/datatables-init.js') }}?v=2" defer></script>
    @stack('scripts')
</body>
</html>
