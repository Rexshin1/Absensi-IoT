@extends('layouts.app')

@section('content')

    <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
        <div><h1 class="text-2xl font-semibold text-dark dark:text-white">Murid terdaftar</h1><p class="mt-1 text-sm text-darklink">{{ $students->count() }} murid tersimpan di sistem.</p></div>
        <a href="{{ route('students.create') }}" class="rounded-md bg-primary px-4 py-3 text-sm font-medium text-white hover:opacity-90"><x-icon name="solar:user-plus-linear" size="18" class="mr-1 inline-block" />Tambah murid</a>
    </div>

    <div class="rounded-xl bg-background p-6 shadow-xs">

        <div class="overflow-x-auto">
            <table class="js-data-table w-full text-left">
                <thead class="border-y border-defaultBorder text-sm text-darklink"><tr><th class="p-4 font-medium">No.</th><th class="p-4 font-medium">Nama</th><th class="p-4 font-medium">NIM</th><th class="p-4 font-medium">Program studi</th><th class="p-4 font-medium">Fakultas</th></tr></thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr class="border-b border-defaultBorder"><td class="p-4 text-darklink">{{ $loop->iteration }}</td><td class="whitespace-nowrap p-4 font-medium text-dark dark:text-white">{{ $student->name }}</td><td class="p-4">{{ $student->nim ?: '-' }}</td><td class="p-4">{{ $student->prodi ?: '-' }}</td><td class="p-4">{{ $student->fakultas ?: '-' }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection