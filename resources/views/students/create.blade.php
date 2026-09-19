@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-4xl">

    {{-- Header --}}
    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-dark dark:text-white">Daftarkan Murid Baru</h1>
            <p class="mt-1 text-sm text-darklink">Lengkapi data akademik dan sidik jari sensor IoT untuk registrasi murid.</p>
        </div>
        <a href="{{ route('students.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-defaultBorder bg-white px-4 py-2.5 text-sm font-medium text-darklink transition hover:bg-gray-50 dark:bg-darkgray dark:text-white dark:hover:bg-white/5">
            <x-icon name="solar:server-linear" size="18" />
            <span>Lihat Data Murid</span>
        </a>
    </div>

    {{-- Success Alert --}}
    @if (session('success'))
        <div class="mb-6 flex items-center gap-3 rounded-xl border border-success/30 bg-lightsuccess px-5 py-4 text-sm text-success">
            <x-icon name="tabler:check" size="20" />
            {{ session('success') }}
        </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="mb-6 rounded-xl border border-error/30 bg-lighterror px-5 py-4 text-sm text-error">
            <p class="mb-2 font-semibold">Terjadi kesalahan:</p>
            <ul class="list-disc space-y-1 pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Card --}}
    <div class="rounded-2xl bg-white p-6 sm:p-8 shadow-sm border border-gray-100 dark:border-white/5 dark:bg-darkgray">
        <form method="POST" action="{{ route('students.store') }}" id="enrollForm">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Nama Lengkap --}}
                <div class="md:col-span-1">
                    <label class="mb-2 block text-sm font-semibold text-dark dark:text-white" for="name">
                        Nama Lengkap <span class="text-error">*</span>
                    </label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}"
                        placeholder="Contoh: Budi Santoso"
                        class="w-full rounded-xl border border-defaultBorder/80 bg-transparent px-4 py-3 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20 dark:text-white @error('name') border-error @enderror">
                </div>

                {{-- NIM --}}
                <div class="md:col-span-1">
                    <label class="mb-2 block text-sm font-semibold text-dark dark:text-white" for="nim">
                        NIM <span class="text-error">*</span>
                    </label>
                    <input id="nim" type="text" name="nim" value="{{ old('nim') }}"
                        placeholder="Nomor Induk Mahasiswa"
                        class="w-full rounded-xl border border-defaultBorder/80 bg-transparent px-4 py-3 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20 dark:text-white @error('nim') border-error @enderror">
                </div>

                {{-- Jenis Kelamin --}}
                <div class="md:col-span-1">
                    <label class="mb-2 block text-sm font-semibold text-dark dark:text-white" for="gender">
                        Jenis Kelamin <span class="text-error">*</span>
                    </label>
                    <select id="gender" name="gender"
                        class="w-full rounded-xl border border-defaultBorder/80 bg-transparent px-4 py-3 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20 dark:text-white dark:bg-darkgray @error('gender') border-error @enderror">
                        <option value="" disabled {{ old('gender') ? '' : 'selected' }}>-- Pilih jenis kelamin --</option>
                        <option value="Laki-laki" {{ old('gender') === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('gender') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                {{-- Fakultas --}}
                <div class="md:col-span-1">
                    <label class="mb-2 block text-sm font-semibold text-dark dark:text-white" for="fakultas">
                        Fakultas <span class="text-error">*</span>
                    </label>
                    <input id="fakultas" type="text" name="fakultas" value="{{ old('fakultas') }}"
                        placeholder="Contoh: Sains dan Teknologi"
                        class="w-full rounded-xl border border-defaultBorder/80 bg-transparent px-4 py-3 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20 dark:text-white @error('fakultas') border-error @enderror">
                </div>

                {{-- Program Studi --}}
                <div class="md:col-span-1">
                    <label class="mb-2 block text-sm font-semibold text-dark dark:text-white" for="prodi">
                        Program Studi <span class="text-error">*</span>
                    </label>
                    <input id="prodi" type="text" name="prodi" value="{{ old('prodi') }}"
                        placeholder="Contoh: Teknik Informatika"
                        class="w-full rounded-xl border border-defaultBorder/80 bg-transparent px-4 py-3 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20 dark:text-white @error('prodi') border-error @enderror">
                </div>

                {{-- ID Sidik Jari --}}
                <div class="md:col-span-1">
                    <label class="mb-2 block text-sm font-semibold text-dark dark:text-white" for="fingerprint_id">
                        ID Sidik Jari IoT <span class="text-error">*</span>
                    </label>
                    <input id="fingerprint_id" type="number" name="fingerprint_id"
                        value="{{ old('fingerprint_id') }}"
                        placeholder="Menunggu sidik jari dari sensor..."
                        min="1" max="127" readonly
                        class="w-full rounded-xl border border-defaultBorder/80 bg-gray-50/80 px-4 py-3 text-sm font-medium text-darklink outline-none transition dark:bg-dark dark:text-darklink @error('fingerprint_id') border-error @enderror">
                    {{-- Status WebSocket --}}
                    <div id="wsStatus" class="mt-2 flex items-center gap-2 text-xs font-medium text-darklink">
                        <span id="wsStatusDot" class="inline-block h-2.5 w-2.5 rounded-full bg-gray-300"></span>
                        <span id="wsStatusText">Belum terhubung ke server</span>
                    </div>
                </div>
            </div>

            {{-- Divider --}}
            <div class="my-6 border-t border-gray-100 dark:border-white/5"></div>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('students.index') }}"
                    class="rounded-xl border border-defaultBorder px-5 py-2.5 text-sm font-medium text-link transition hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-white/5">
                    Batal
                </a>
                <button type="submit" id="btnSubmit"
                    class="flex items-center gap-2 rounded-xl bg-primary px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:opacity-90 disabled:cursor-not-allowed disabled:opacity-50">
                    <x-icon name="solar:user-plus-linear" size="18" />
                    Simpan & Daftarkan Murid
                </button>
            </div>
        </form>
    </div>

    {{-- Panduan IoT --}}
    <div class="mt-6 rounded-2xl border border-primary/20 bg-lightprimary/40 p-5 text-sm text-primary dark:bg-primary/10 dark:border-primary/30">
        <div class="flex items-center gap-2 font-bold text-base mb-1">
            <x-icon name="solar:database-linear" size="20" />
            <span>Petunjuk Pendaftaran Sidik Jari IoT:</span>
        </div>
        <ol class="mt-2 list-decimal space-y-1 pl-5 font-medium text-primary/90">
            <li>Tempelkan jari calon murid pada sensor sidik jari <strong>R307</strong> pada modul alat ESP32.</li>
            <li>Nomor <strong>ID Sidik Jari</strong> akan terisi secara otomatis via WebSocket Pusher pada form di atas.</li>
            <li>Isi data akademik (Nama, NIM, Jenis Kelamin, Fakultas, Prodi) lalu klik <strong>Simpan & Daftarkan Murid</strong>.</li>
        </ol>
    </div>

</div>
@endsection

@push('scripts')
{{-- Pusher JS & Laravel Echo via CDN --}}
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
(function () {
    const PUSHER_KEY    = '{{ config('broadcasting.connections.pusher.key') }}';
    const PUSHER_CLUSTER = '{{ config('broadcasting.connections.pusher.options.cluster') }}';

    const fingerprintInput = document.getElementById('fingerprint_id');
    const statusDot        = document.getElementById('wsStatusDot');
    const statusText       = document.getElementById('wsStatusText');

    /**
     * Update status indicator
     */
    function setStatus(state) {
        const states = {
            connecting: { color: 'bg-warning',   text: 'Menghubungkan ke server...' },
            connected:  { color: 'bg-success',   text: 'Terhubung — tempelkan jari pada sensor' },
            error:      { color: 'bg-error',     text: 'Gagal terhubung. Cek konfigurasi Pusher.' },
            received:   { color: 'bg-primary',   text: 'ID sidik jari diterima!' },
        };
        const s = states[state] || states.error;
        statusDot.className  = `inline-block h-2 w-2 rounded-full ${s.color}`;
        statusText.textContent = s.text;
    }

    if (!PUSHER_KEY) {
        setStatus('error');
        statusText.textContent = 'Pusher belum dikonfigurasi. Isi PUSHER_APP_KEY di .env';
        return;
    }

    // Inisialisasi Pusher
    const pusher = new Pusher(PUSHER_KEY, {
        cluster: PUSHER_CLUSTER,
    });

    setStatus('connecting');

    const channel = pusher.subscribe('enrollment-channel');

    pusher.connection.bind('connected', () => setStatus('connected'));
    pusher.connection.bind('error', () => setStatus('error'));

    // ID otomatis terisi saat ESP32 mengirim data sidik jari
    channel.bind('fingerprint.scanned', function (data) {
        fingerprintInput.value = data.finger_id;
        setStatus('received');

        // Flash border hijau sebentar biar keliatan berubah
        fingerprintInput.classList.add('border-primary', 'bg-lightprimary');
        setTimeout(() => {
            fingerprintInput.classList.remove('border-primary', 'bg-lightprimary');
        }, 2000);
    });
})();
</script>
@endpush