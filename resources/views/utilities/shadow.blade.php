@extends('layouts.app')

@section('content')
    <x-breadcrumb title="Shadow" />
    <div class="relative w-full rounded-xl bg-white p-6 shadow-xs dark:bg-darkgray"><div class="mt-6 grid grid-cols-12 gap-30">
        @foreach (['shadow-none', 'shadow-xs', 'shadow-sm', 'shadow-md', 'shadow-lg', 'shadow-xl', 'shadow-2xl', 'shadow-inner'] as $index => $shadow)
            <div class="col-span-12 md:col-span-6 lg:col-span-3"><div class="{{ $shadow }} flex h-32 items-center justify-center rounded-xl bg-primary text-center text-xl text-white">{{ $index + 1 }}</div></div>
        @endforeach
    </div></div>
@endsection
