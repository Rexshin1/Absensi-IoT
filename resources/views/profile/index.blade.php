@extends('layouts.app')

@section('content')
<x-breadcrumb title="My Profile" />

<div class="flex flex-col gap-6" x-data="{ isEditing: false }">
    @if(session('success'))
        <div class="flex items-center justify-between rounded-xl bg-green-50 p-4 border border-green-200 text-green-800 dark:bg-green-900/30 dark:border-green-800 dark:text-green-300">
            <div class="flex items-center gap-3">
                <x-icon name="solar:check-circle-bold" size="24" class="text-green-600 dark:text-green-400" />
                <span class="font-medium">{{ session('success') }}</span>
            </div>
            <button type="button" @click="$el.parentElement.remove()" class="text-green-600 hover:text-green-800 dark:text-green-400">
                <x-icon name="solar:close-circle-linear" size="20" />
            </button>
        </div>
    @endif

    <!-- Profile Header Card -->
    <section class="relative w-full overflow-hidden rounded-xl bg-background p-6 shadow-xs dark:bg-darkgray">
        <div class="flex flex-col items-center gap-6 sm:flex-row">
            <div class="relative">
                <img src="{{ asset('images/profile/user-1.jpg') }}" alt="{{ $adminProfile['name'] }}" width="90" height="90" class="rounded-full ring-4 ring-primary/20">
                <span class="absolute bottom-0 right-0 h-4 w-4 rounded-full border-2 border-white bg-green-500"></span>
            </div>
            <div class="flex w-full flex-wrap items-center justify-center gap-4 sm:justify-between">
                <div class="flex flex-col gap-1 text-center sm:text-left">
                    <div class="flex items-center justify-center gap-2 sm:justify-start">
                        <h4 class="text-xl font-bold text-gray-800 dark:text-white">{{ $adminProfile['name'] }}</h4>
                        <span class="rounded-full bg-primary/10 px-3 py-0.5 text-xs font-semibold text-primary">
                            {{ $adminProfile['position'] }}
                        </span>
                    </div>
                    <p class="text-sm text-gray-500 font-mono">{{ '@' . $adminProfile['username'] }} • {{ $adminProfile['email'] }}</p>
                    <p class="text-xs text-gray-400 mt-1">No. Telp: {{ $adminProfile['phone'] }}</p>
                </div>
                <div class="flex items-center gap-3">
                    <button type="button" @click="isEditing = !isEditing" class="flex items-center gap-2 rounded-lg bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary/90 transition-all">
                        <x-icon name="solar:pen-bold" size="18" />
                        <span x-text="isEditing ? 'Batal Edit' : 'Edit Profil & Akun'"></span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Display Cards / Edit Form -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- Card 1: Informasi Admin -->
        <section class="relative w-full space-y-6 rounded-xl bg-background p-6 shadow-xs dark:bg-darkgray">
            <div class="flex items-center justify-between border-b border-gray-100 dark:border-gray-800 pb-4">
                <div class="flex items-center gap-2">
                    <x-icon name="solar:user-bold-duotone" size="24" class="text-primary" />
                    <h5 class="text-lg font-semibold text-gray-800 dark:text-white">Informasi Admin</h5>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider text-gray-400">Nama Admin</p>
                    <p class="text-base font-semibold text-gray-800 dark:text-white mt-1">{{ $adminProfile['name'] }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider text-gray-400">Jabatan / Posisi</p>
                    <p class="text-base font-semibold text-gray-800 dark:text-white mt-1">{{ $adminProfile['position'] }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider text-gray-400">Email Admin</p>
                    <p class="text-base font-semibold text-gray-800 dark:text-white mt-1">{{ $adminProfile['email'] }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider text-gray-400">No. Telepon / Whatsapp</p>
                    <p class="text-base font-semibold text-gray-800 dark:text-white mt-1">{{ $adminProfile['phone'] }}</p>
                </div>
            </div>
        </section>

        <!-- Card 2: Detail Akun Login -->
        <section class="relative w-full space-y-6 rounded-xl bg-background p-6 shadow-xs dark:bg-darkgray">
            <div class="flex items-center justify-between border-b border-gray-100 dark:border-gray-800 pb-4">
                <div class="flex items-center gap-2">
                    <x-icon name="solar:shield-keyhole-bold-duotone" size="24" class="text-primary" />
                    <h5 class="text-lg font-semibold text-gray-800 dark:text-white">Pengaturan Akun System</h5>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider text-gray-400">Username Akun</p>
                    <p class="text-base font-semibold text-gray-800 dark:text-white mt-1 font-mono">{{ $adminProfile['username'] }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider text-gray-400">Status Akun</p>
                    <span class="inline-flex items-center gap-1.5 mt-1 rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300">
                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span> Aktif (Super Admin)
                    </span>
                </div>
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider text-gray-400">Keamanan Password</p>
                    <p class="text-base font-semibold text-gray-800 dark:text-white mt-1">••••••••••••</p>
                </div>
            </div>
        </section>
    </div>

    <!-- Form Edit Profil & Akun (Muncul saat tombol Edit diklik) -->
    <section x-show="isEditing" x-transition class="relative w-full space-y-6 rounded-xl bg-background p-6 shadow-md border-2 border-primary/20 dark:bg-darkgray">
        <div class="flex items-center justify-between border-b border-gray-100 dark:border-gray-800 pb-4">
            <div>
                <h5 class="text-lg font-bold text-gray-800 dark:text-white">Edit Profil Admin & Akun</h5>
                <p class="text-xs text-gray-400">Ubah nama admin, kontak, serta username/password login akun.</p>
            </div>
            <button type="button" @click="isEditing = false" class="text-gray-400 hover:text-gray-600">
                <x-icon name="solar:close-circle-linear" size="24" />
            </button>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- Nama Admin -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">Nama Admin <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name', $adminProfile['name']) }}" required class="w-full rounded-lg border border-defaultBorder bg-transparent p-3 text-sm outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                </div>

                <!-- Username Akun -->
                <div>
                    <label for="username" class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">Username Akun <span class="text-red-500">*</span></label>
                    <input type="text" id="username" name="username" value="{{ old('username', $adminProfile['username']) }}" required class="w-full rounded-lg border border-defaultBorder bg-transparent p-3 text-sm outline-none focus:border-primary focus:ring-1 focus:ring-primary font-mono">
                </div>

                <!-- Email Admin -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">Email Admin <span class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email', $adminProfile['email']) }}" required class="w-full rounded-lg border border-defaultBorder bg-transparent p-3 text-sm outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                </div>

                <!-- No Telepon -->
                <div>
                    <label for="phone" class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">No. Telepon / WA</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $adminProfile['phone']) }}" class="w-full rounded-lg border border-defaultBorder bg-transparent p-3 text-sm outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                </div>

                <!-- Jabatan / Posisi -->
                <div>
                    <label for="position" class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">Jabatan / Role Admin</label>
                    <input type="text" id="position" name="position" value="{{ old('position', $adminProfile['position']) }}" class="w-full rounded-lg border border-defaultBorder bg-transparent p-3 text-sm outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                </div>

                <!-- Password Baru (Opsional) -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">Password Baru <span class="text-xs font-normal text-gray-400">(Kosongkan jika tidak diganti)</span></label>
                    <input type="password" id="password" name="password" placeholder="••••••••" class="w-full rounded-lg border border-defaultBorder bg-transparent p-3 text-sm outline-none focus:border-primary focus:ring-1 focus:ring-primary">
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-800">
                <button type="button" @click="isEditing = false" class="rounded-lg bg-gray-100 px-5 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                    Batal
                </button>
                <button type="submit" class="flex items-center gap-2 rounded-lg bg-primary px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary/90">
                    <x-icon name="solar:diskette-bold" size="18" />
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </section>
</div>
@endsection
