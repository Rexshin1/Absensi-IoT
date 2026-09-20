<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - UKM Absensi IoT</title>
    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}" type="image/x-icon">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-primary/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-blue-600/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-md relative z-10">
        <!-- Main Card -->
        <div class="bg-slate-800/80 backdrop-blur-xl border border-slate-700/60 rounded-2xl p-8 shadow-2xl">
            <!-- UKM Logo Header -->
            <div class="flex flex-col items-center text-center mb-8">
                <div class="relative mb-4">
                    <div class="absolute -inset-1 rounded-full bg-gradient-to-r from-primary to-blue-500 opacity-75 blur"></div>
                    <img src="{{ asset('images/logos/ukm-pagar-nusa.jpeg') }}" 
                         alt="Logo UKM" 
                         class="relative w-24 h-24 rounded-full object-cover border-4 border-slate-800 shadow-xl">
                </div>
                <h2 class="text-2xl font-bold text-white tracking-tight">Absensi IoT UKM</h2>
                <p class="text-xs text-slate-400 mt-1 uppercase tracking-wider font-semibold">Portal Login Admin</p>
            </div>

            <!-- Notifications -->
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm flex items-center gap-2">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-400 text-sm space-y-1">
                    @foreach($errors->all() as $error)
                        <p class="flex items-center gap-2">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>{{ $error }}</span>
                        </p>
                    @endforeach
                </div>
            @endif

            <!-- Form Login -->
            <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label for="username" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">Username / Email Admin</label>
                    <div class="relative">
                        <input type="text" 
                               id="username" 
                               name="username" 
                               value="{{ old('username', 'admin_absensi') }}" 
                               required 
                               placeholder="Masukkan username atau email" 
                               class="w-full bg-slate-900/80 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-300">Password</label>
                    </div>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           required 
                           placeholder="••••••••" 
                           class="w-full bg-slate-900/80 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                </div>

                <div class="flex items-center justify-between text-xs text-slate-400">
                    <label class="flex items-center gap-2 cursor-pointer select-none">
                        <input type="checkbox" name="remember" class="rounded border-slate-700 bg-slate-900 text-primary focus:ring-0 focus:ring-offset-0">
                        <span>Ingat saya</span>
                    </label>
                </div>

                <button type="submit" 
                        class="w-full py-3.5 px-4 bg-primary hover:bg-primary/90 active:scale-[0.99] text-white font-semibold rounded-xl text-sm transition-all shadow-lg shadow-primary/25 flex items-center justify-center gap-2">
                    <span>Masuk ke Dashboard</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </form>
        </div>

        <p class="text-center text-xs text-slate-500 mt-6">
            &copy; {{ date('Y') }} Sistem Absensi IoT UKM. All rights reserved.
        </p>
    </div>
</body>
</html>
