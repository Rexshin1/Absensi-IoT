<aside class="fixed left-0 top-0 z-30 h-screen w-[270px] border-r border-defaultBorder/40 bg-background dark:bg-darkgray xl:block" :class="mobileSidebarOpen ? 'block' : 'hidden'" @click.outside="mobileSidebarOpen = false">
    <div class="flex h-[72px] items-center overflow-hidden px-5">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <img src="{{ asset('images/logos/ukm-pagar-nusa.jpeg') }}" alt="Logo UKM Pencak Silat NU Pagar Nusa" width="42" height="42" class="h-10 w-10 rounded-xl object-cover shadow-sm ring-2 ring-primary/20">
            <div class="flex flex-col">
                <span class="text-sm font-bold leading-tight text-dark dark:text-white">UKM Pagar Nusa</span>
                <span class="text-[11px] font-semibold text-primary">Absensi berbasis IoT</span>
            </div>
        </a>
        <button type="button" class="ml-auto flex h-9 w-9 items-center justify-center rounded-lg hover:bg-lightprimary hover:text-primary xl:hidden" @click="mobileSidebarOpen = false" aria-label="Close menu">
            <x-icon name="solar:close-circle-linear" size="20" />
        </button>
    </div>

    <nav class="h-[calc(100vh-72px)] overflow-y-auto px-4 py-4 space-y-5">
        <div>
            <p class="mb-2 px-3 text-[11px] font-bold uppercase tracking-wider text-charcoal/70 dark:text-darkcharcoal">Menu Utama</p>
            <div class="space-y-1.5">
                <a href="{{ route('dashboard') }}" class="group flex items-center gap-3 rounded-xl px-3 py-2.5 transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-primary text-white font-semibold shadow-md shadow-primary/20' : 'text-link hover:bg-lightprimary hover:text-primary dark:text-darklink' }}">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-white/20 text-white' : 'bg-gray-100/80 text-gray-600 group-hover:bg-primary/15 group-hover:text-primary dark:bg-white/5 dark:text-gray-300' }}">
                        <x-icon name="solar:home-angle-linear" size="18" />
                    </div>
                    <span class="text-sm">Dashboard</span>
                </a>

                <a href="{{ route('attendance.recap') }}" class="group flex items-center gap-3 rounded-xl px-3 py-2.5 transition-all duration-200 {{ request()->routeIs('attendance.*') ? 'bg-primary text-white font-semibold shadow-md shadow-primary/20' : 'text-link hover:bg-lightprimary hover:text-primary dark:text-darklink' }}">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg transition-colors {{ request()->routeIs('attendance.*') ? 'bg-white/20 text-white' : 'bg-gray-100/80 text-gray-600 group-hover:bg-primary/15 group-hover:text-primary dark:bg-white/5 dark:text-gray-300' }}">
                        <x-icon name="solar:checklist-linear" size="18" />
                    </div>
                    <span class="text-sm">Rekap Data Absensi</span>
                </a>
            </div>
        </div>

        <div>
            <p class="mb-2 px-3 text-[11px] font-bold uppercase tracking-wider text-charcoal/70 dark:text-darkcharcoal">Master Data</p>
            <div class="space-y-1.5">
                <a href="{{ route('students.index') }}" class="group flex items-center gap-3 rounded-xl px-3 py-2.5 transition-all duration-200 {{ request()->routeIs('students.index') ? 'bg-primary text-white font-semibold shadow-md shadow-primary/20' : 'text-link hover:bg-lightprimary hover:text-primary dark:text-darklink' }}">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg transition-colors {{ request()->routeIs('students.index') ? 'bg-white/20 text-white' : 'bg-gray-100/80 text-gray-600 group-hover:bg-primary/15 group-hover:text-primary dark:bg-white/5 dark:text-gray-300' }}">
                        <x-icon name="solar:server-linear" size="18" />
                    </div>
                    <span class="text-sm">Data Murid</span>
                </a>

                <a href="{{ route('students.create') }}" class="group flex items-center gap-3 rounded-xl px-3 py-2.5 transition-all duration-200 {{ request()->routeIs('students.create') ? 'bg-primary text-white font-semibold shadow-md shadow-primary/20' : 'text-link hover:bg-lightprimary hover:text-primary dark:text-darklink' }}">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg transition-colors {{ request()->routeIs('students.create') ? 'bg-white/20 text-white' : 'bg-gray-100/80 text-gray-600 group-hover:bg-primary/15 group-hover:text-primary dark:bg-white/5 dark:text-gray-300' }}">
                        <x-icon name="solar:user-plus-linear" size="18" />
                    </div>
                    <span class="text-sm">Daftar Murid Baru</span>
                </a>
            </div>
        </div>
    </nav>
</aside>
