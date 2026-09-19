@extends('layouts.app')

@section('content')
<div class="mb-6 flex flex-wrap items-center justify-between gap-3">
    <div>
        <h1 class="text-2xl font-bold text-dark dark:text-white">Master Data</h1>
        <p class="text-sm text-darklink">Pusat pengelolaan data utama sistem absensi UKM Pagar Nusa</p>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('students.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:opacity-90 transition-opacity">
            <x-icon name="solar:user-plus-linear" size="18" />
            <span>+ Registrasi Murid Baru</span>
        </a>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100 dark:border-white/5 dark:bg-darkgray transition-all hover:shadow-md">
        <div class="flex items-center justify-between mb-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-400">
                <x-icon name="solar:server-linear" size="24" />
            </div>
            <span class="rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300">Aktif</span>
        </div>
        <h3 class="text-2xl font-bold text-dark dark:text-white">{{ $totalStudents }}</h3>
        <p class="text-sm font-medium text-darklink">Total Murid Terdaftar</p>
        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-white/5 flex items-center justify-between">
            <span class="text-xs text-darklink">Data Akademik (NIM & Prodi)</span>
            <a href="{{ route('students.index') }}" class="text-xs font-semibold text-primary hover:underline">Kelola Data &rarr;</a>
        </div>
    </div>

    <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100 dark:border-white/5 dark:bg-darkgray transition-all hover:shadow-md">
        <div class="flex items-center justify-between mb-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-950/40 dark:text-blue-400">
                <x-icon name="solar:database-linear" size="24" />
            </div>
            <span class="rounded-full bg-blue-100 px-2.5 py-1 text-xs font-semibold text-blue-700 dark:bg-blue-900/40 dark:text-blue-300">Sensor ESP32</span>
        </div>
        <h3 class="text-2xl font-bold text-dark dark:text-white">{{ $totalAthletes }}</h3>
        <p class="text-sm font-medium text-darklink">Data Sidik Jari Terdaftar</p>
        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-white/5 flex items-center justify-between">
            <span class="text-xs text-darklink">Mapping Fingerprint ID</span>
            <a href="{{ route('students.create') }}" class="text-xs font-semibold text-primary hover:underline">Tambah Jari &rarr;</a>
        </div>
    </div>

    <div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100 dark:border-white/5 dark:bg-darkgray transition-all hover:shadow-md">
        <div class="flex items-center justify-between mb-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-purple-50 text-purple-600 dark:bg-purple-950/40 dark:text-purple-400">
                <x-icon name="solar:home-angle-linear" size="24" />
            </div>
            <span class="rounded-full bg-purple-100 px-2.5 py-1 text-xs font-semibold text-purple-700 dark:bg-purple-900/40 dark:text-purple-300">Fakultas & Prodi</span>
        </div>
        <h3 class="text-2xl font-bold text-dark dark:text-white">{{ $facultiesCount }} <span class="text-sm font-normal text-darklink">Fakultas</span> / {{ $prodiCount }} <span class="text-sm font-normal text-darklink">Prodi</span></h3>
        <p class="text-sm font-medium text-darklink">Program Studi Terdata</p>
        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-white/5 flex items-center justify-between">
            <span class="text-xs text-darklink">Fakultas & Program Studi</span>
            <a href="{{ route('students.index') }}" class="text-xs font-semibold text-primary hover:underline">Lihat Semua &rarr;</a>
        </div>
    </div>
</div>

<div class="rounded-2xl bg-white p-6 shadow-sm border border-gray-100 dark:border-white/5 dark:bg-darkgray">
    <div class="mb-4 flex items-center justify-between">
        <div>
            <h2 class="text-lg font-bold text-dark dark:text-white">Akses Cepat Master Data</h2>
            <p class="text-xs text-darklink">Pilih modul master data yang ingin dikelola</p>
        </div>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <a href="{{ route('students.index') }}" class="group flex items-center gap-4 rounded-xl border border-gray-100 p-4 transition-all hover:border-primary/30 hover:bg-lightprimary/20 dark:border-white/5">
            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary/10 text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                <x-icon name="solar:server-linear" size="20" />
            </div>
            <div>
                <h4 class="text-sm font-bold text-dark dark:text-white group-hover:text-primary transition-colors">Data Murid (Tabel Lengkap)</h4>
                <p class="text-xs text-darklink">Daftar seluruh murid, NIM, Fakultas, Prodi, dan Kategori</p>
            </div>
        </a>

        <a href="{{ route('students.create') }}" class="group flex items-center gap-4 rounded-xl border border-gray-100 p-4 transition-all hover:border-primary/30 hover:bg-lightprimary/20 dark:border-white/5">
            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary/10 text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                <x-icon name="solar:user-plus-linear" size="20" />
            </div>
            <div>
                <h4 class="text-sm font-bold text-dark dark:text-white group-hover:text-primary transition-colors">Registrasi Murid Baru</h4>
                <p class="text-xs text-darklink">Form pendaftaran murid baru & auto-enroll sidik jari ESP32</p>
            </div>
        </a>
    </div>
</div>
@endsection
