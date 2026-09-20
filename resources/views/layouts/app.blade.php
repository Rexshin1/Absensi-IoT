<!DOCTYPE html>
<html lang="id" x-data="matdash" x-bind:class="{ 'dark': isDark }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'MatDash Laravel' }}</title>
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
<body class="text-sm overflow-x-hidden bg-background text-link dark:bg-dark dark:text-darklink">
    <div class="flex w-full min-h-screen">
        @include('partials.sidebar')

        <div class="page-wrapper flex w-full xl:ml-[270px]">
            <div class="body-wrapper w-full">
                @include('partials.header')
                <main class="bg-lightgray dark:bg-dark mr-3 rounded-3xl min-h-[90vh]">
                    <div class="container mx-auto px-6 py-30">
                        @yield('content')
                    </div>
                </main>
            </div>
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
