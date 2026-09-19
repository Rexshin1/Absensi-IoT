<div class="relative px-15" @click.outside="notificationsOpen = false">
    <button type="button" @click="notificationsOpen = !notificationsOpen" class="relative flex items-center justify-center rounded-full hover:text-primary" aria-label="Notifications"><x-icon name="tabler:bell-ringing" size="20" /><span class="absolute -end-[6px] -top-[5px] h-2 w-2 rounded-full bg-primary"></span></button>
    <div x-cloak x-show="notificationsOpen" x-transition class="absolute right-0 z-50 mt-4 w-[300px] rounded-sm bg-background py-4 shadow-md dark:bg-darkgray">
        <div class="flex items-center justify-between px-6"><h3 class="text-lg font-semibold text-ld">Notification</h3></div>
        <div class="mt-3 max-h-80 overflow-y-auto">
            @foreach ([['Roman Joined the Team!', 'Congratulate him'], ['New message received', 'Salma sent you new message'], ['New Payment received', 'Check your earnings'], ['Jolly completed tasks', 'Assign her new tasks']] as [$title, $subtitle])
                <a href="#" class="flex w-full items-center px-6 py-3 hover:bg-lightprimary hover:text-primary"><div><h5 class="mb-1 text-sm">{{ $title }}</h5><span class="block text-xs text-darklink">{{ $subtitle }}</span></div></a>
            @endforeach
        </div>
    </div>
</div>
