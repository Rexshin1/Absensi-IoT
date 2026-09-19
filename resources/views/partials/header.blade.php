<header class="sticky top-0 z-20 bg-transparent" x-data="{ sticky: false }" @scroll.window="sticky = window.scrollY > 50" :class="sticky && 'fixed w-full bg-background shadow-md dark:bg-dark'">
    <nav class="max-w-full rounded-none px-6 py-4 sm:ps-6 sm:pe-10 dark:bg-dark flex items-center justify-between">
        <button type="button" @click="mobileSidebarOpen = true" class="relative flex items-center justify-center rounded-full px-3.5 text-link hover:text-primary dark:text-darklink dark:hover:text-primary xl:hidden" aria-label="Open menu">
            <x-icon name="tabler:menu-2" size="20" />
        </button>
        <a href="{{ route('dashboard') }}" class="block xl:hidden"><img src="{{ asset('images/logos/dark-logo.svg') }}" alt="MatDash" width="135" height="40"></a>

        <div class="hidden w-full items-center justify-between xl:flex">
            <div class="relative">
                <x-icon name="solar:magnifer-linear" size="18" class="absolute left-3 top-1/2 -translate-y-1/2" />
                <input type="search" placeholder="Search..." class="w-64 rounded-xl border border-defaultBorder bg-transparent py-2 pl-10 pr-3 text-sm outline-none focus:border-primary">
            </div>
            <div class="flex items-center">
                <a target="_blank" rel="noopener" href="https://themewagon.com/themes/matdash-nextjs/" class="hidden items-center gap-2.5 rounded-full bg-background px-3 py-1.5 lg:flex"><span class="text-base font-semibold">Download now</span></a>
                <button type="button" @click="toggleTheme" class="group relative flex items-center justify-center rounded-full px-15 hover:text-primary" aria-label="Toggle dark mode">
                    <template x-if="isDark"><x-icon name="solar:sun-bold-duotone" size="20" /></template>
                    <template x-if="!isDark"><x-icon name="tabler:moon" size="20" /></template>
                </button>
                @include('partials.notifications')
                @include('partials.profile-menu')
            </div>
        </div>
        <div class="flex items-center xl:hidden">
            <button type="button" @click="toggleTheme" class="flex items-center justify-center rounded-full px-2 text-link hover:text-primary dark:text-darklink">
                <template x-if="isDark"><x-icon name="solar:sun-bold-duotone" size="20" /></template>
                <template x-if="!isDark"><x-icon name="tabler:moon" size="20" /></template>
            </button>
            @include('partials.notifications')
            @include('partials.profile-menu')
        </div>
    </nav>
</header>
