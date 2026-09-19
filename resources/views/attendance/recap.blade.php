@extends('layouts.app')

@section('content')

    <div class="rounded-2xl bg-white p-6 shadow-xs dark:bg-darkgray">

        {{-- Header + Filter Tanggal --}}
        <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-xl font-semibold text-dark dark:text-white">Rekap Absensi</h1>
                <p class="mt-0.5 text-sm text-darklink">{{ $date->translatedFormat('l, d F Y') }}</p>
            </div>
            <form method="GET" action="{{ route('attendance.recap') }}" class="flex items-center gap-2">
                <input type="date" name="date" value="{{ $date->format('Y-m-d') }}"
                    class="rounded-lg border border-defaultBorder bg-transparent px-3 py-2 text-sm outline-none transition focus:border-primary dark:text-white">
                <button type="submit"
                    class="rounded-lg bg-primary px-4 py-2 text-sm font-medium text-white transition hover:opacity-90">
                    Tampilkan
                </button>
            </form>
        </div>

        {{-- Tabel --}}
        <div class="overflow-x-auto">
            <table class="js-data-table w-full text-left text-sm">
                <thead class="border-y border-defaultBorder text-darklink">
                    <tr>
                        <th class="whitespace-nowrap p-4 font-medium">Nama</th>
                        <th class="whitespace-nowrap p-4 font-medium">NIM</th>
                        <th class="whitespace-nowrap p-4 font-medium">Prodi</th>
                        <th class="whitespace-nowrap p-4 font-medium">Fakultas</th>
                        <th class="whitespace-nowrap p-4 font-medium">Detak Jantung</th>
                        <th class="whitespace-nowrap p-4 font-medium">Status</th>
                        <th class="whitespace-nowrap p-4 font-medium">Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendances as $attendance)
                        @php
                            $bpm       = $attendance->heart_rate;
                            $isNormal  = $bpm !== null && $bpm >= 60 && $bpm <= 100;
                            $name      = $attendance->athlete?->name ?? $attendance->user?->name ?? 'Murid dihapus';
                            $nim       = $attendance->user?->nim ?? '-';
                            $prodi     = $attendance->user?->prodi ?? '-';
                            $fakultas  = $attendance->user?->fakultas ?? '-';
                        @endphp
                        <tr class="border-b border-defaultBorder hover:bg-gray-50 dark:hover:bg-white/5">

                            {{-- Nama --}}
                            <td class="whitespace-nowrap p-4 font-medium text-dark dark:text-white">
                                {{ $name }}
                            </td>

                            {{-- NIM --}}
                            <td class="whitespace-nowrap p-4 text-darklink">
                                {{ $nim }}
                            </td>

                            {{-- Prodi --}}
                            <td class="whitespace-nowrap p-4 text-darklink">
                                {{ $prodi }}
                            </td>

                            {{-- Fakultas --}}
                            <td class="whitespace-nowrap p-4 text-darklink">
                                {{ $fakultas }}
                            </td>

                            {{-- Detak Jantung --}}
                            <td class="whitespace-nowrap p-4">
                                @if ($bpm !== null)
                                    <span class="font-semibold {{ $isNormal ? 'text-success' : 'text-error' }}">
                                        {{ $bpm }} BPM
                                    </span>
                                @else
                                    <span class="text-darklink">-</span>
                                @endif
                            </td>

                            {{-- Status Detak Jantung --}}
                            <td class="whitespace-nowrap p-4">
                                @if ($bpm !== null)
                                    @if ($isNormal)
                                        <span class="inline-flex items-center gap-1 rounded-md bg-lightsuccess px-2.5 py-1 text-xs font-semibold text-success">
                                            <span class="h-1.5 w-1.5 rounded-full bg-success"></span>
                                            Normal
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-md bg-lighterror px-2.5 py-1 text-xs font-semibold text-error">
                                            <span class="h-1.5 w-1.5 rounded-full bg-error"></span>
                                            Perlu Dicek
                                        </span>
                                    @endif
                                @else
                                    <span class="text-darklink">-</span>
                                @endif
                            </td>

                            {{-- Waktu --}}
                            <td class="whitespace-nowrap p-4 text-darklink">
                                {{ $attendance->created_at?->format('H:i:s') ?? '-' }}
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection