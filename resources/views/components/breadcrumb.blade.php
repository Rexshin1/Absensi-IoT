@props(['title'])
<div class="relative mb-6 overflow-hidden rounded-xl bg-lightprimary py-4 shadow-none dark:bg-darkinfo">
    <div class="grid grid-cols-12 items-center gap-6 px-6">
        <div class="col-span-10"><h4 class="mb-3 text-xl font-semibold text-customdark">{{ $title }}</h4><ol class="flex items-center whitespace-nowrap"><li><a class="text-sm leading-none text-charcoal opacity-80" href="{{ route('dashboard') }}">Home</a></li><li><span class="mx-2.5 flex h-1 w-1 rounded-full bg-dark dark:bg-darklink"></span></li><li class="text-sm leading-none text-charcoal">{{ $title }}</li></ol></div>
        <div class="col-span-2 -mb-10 flex justify-center"><img src="{{ asset('images/breadcrumb/ChatBc.png') }}" alt="" width="140" height="150" class="-mb-4 md:-mb-[31px]"></div>
    </div>
</div>
