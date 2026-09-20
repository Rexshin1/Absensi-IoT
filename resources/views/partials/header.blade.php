<header class="sticky top-0 z-20 border-b border-defaultBorder/50 bg-background/95 backdrop-blur dark:bg-darkgray/95">
    <nav class="flex h-[72px] items-center justify-between gap-3 px-4 sm:px-6 lg:px-8">
        <button type="button" @click="mobileSidebarOpen = true" class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl text-link transition hover:bg-lightprimary hover:text-primary dark:text-darklink dark:hover:text-primary xl:hidden" aria-label="Buka menu">
            <x-icon name="tabler:menu-2" size="20" />
        </button>
        <a href="{{ route('dashboard') }}" class="flex min-w-0 items-center gap-2 xl:hidden">
            <img src="{{ asset('images/logos/ukm-pagar-nusa.jpeg') }}" alt="Logo UKM Pagar Nusa" class="h-9 w-9 rounded-lg object-cover">
            <span class="truncate text-sm font-bold text-dark dark:text-white">Absensi IoT</span>
        </a>

        <div class="hidden min-w-0 xl:block">
            <p class="text-xs font-medium text-darklink">UKM Pagar Nusa</p>
            <h1 class="truncate text-base font-bold text-dark dark:text-white">Sistem Absensi IoT</h1>
        </div>

        <div class="ml-auto flex items-center gap-1 sm:gap-2">
            <button type="button" @click="toggleTheme" class="flex h-10 w-10 items-center justify-center rounded-xl text-link transition hover:bg-lightprimary hover:text-primary dark:text-darklink" aria-label="Ubah tema">
                <template x-if="isDark"><x-icon name="solar:sun-bold-duotone" size="20" /></template>
                <template x-if="!isDark"><x-icon name="tabler:moon" size="20" /></template>
            </button>
            @include('partials.profile-menu')
        </div>
    </nav>
</header>
