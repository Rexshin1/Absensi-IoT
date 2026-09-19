@extends('layouts.app')

@section('content')
    <x-breadcrumb title="Typography" />
    <div class="relative w-full rounded-xl bg-background p-6 shadow-xs">
        <div class="flex flex-col gap-6">
            @foreach ([['h1', 'text-4xl', '36 | line-height: 40 | font weight: 600'], ['h2', 'text-3xl', '30 | line-height: 36 | font weight: 600'], ['h3', 'text-2xl', '24 | line-height: 32 | font weight: 600'], ['h4', 'text-xl', '20 | line-height: 28 | font weight: 600'], ['h5', 'text-lg', '20 | line-height: 28 | font weight: 600'], ['h6', 'text-base', '16 | line-height: 24 | font weight: 600']] as [$tag, $size, $description])
                <div class="rounded-3xl border border-ld px-6 py-4"><{{ $tag }} class="{{ $size }} font-semibold">{{ $tag }}.Heading</{{ $tag }}><p class="mt-2">font size: {{ $description }}</p></div>
            @endforeach
        </div>
    </div>
@endsection
