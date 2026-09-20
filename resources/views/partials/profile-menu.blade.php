<div class="relative" @click.outside="profileOpen = false">
    <button type="button" @click="profileOpen = !profileOpen" class="flex h-10 w-10 items-center justify-center rounded-full hover:bg-lightprimary hover:text-primary" aria-label="Profile menu"><img src="{{ asset('images/profile/user-1.jpg') }}" alt="Profile" width="35" height="35" class="rounded-full"></button>
    <div x-cloak x-show="profileOpen" x-transition class="absolute right-0 z-50 mt-3 w-44 rounded-sm bg-background p-2 shadow-md dark:bg-darkgray">
        <a href="{{ route('profile') }}" class="flex items-center gap-3 px-3 py-2 hover:bg-lightprimary hover:text-primary"><x-icon name="solar:user-circle-outline" size="20" />My Profile</a>
        <div class="p-3 pt-0"><a href="{{ route('login') }}" class="mt-2 block w-full rounded-md border border-defaultBorder px-3 py-2 text-center text-sm hover:bg-lightprimary">Logout</a></div>
    </div>
</div>

