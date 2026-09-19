@extends('layouts.app')

@section('content')
<div class="grid grid-cols-12 gap-30">
    <div class="col-span-12">
        <div class="mb-6 flex flex-wrap items-end justify-between gap-3">
            <div>
                <p class="mb-1 text-sm text-darklink">{{ now()->translatedFormat('l, d F Y') }}</p>
                <h1 class="text-2xl font-semibold text-dark dark:text-white">Ringkasan absensi hari ini</h1>
            </div>
            <a href="{{ route('attendance.recap') }}" class="rounded-md bg-primary px-4 py-2 text-sm font-medium text-white hover:opacity-90">Lihat rekap</a>
        </div>
        <div class="flex gap-30 overflow-x-auto pb-2">
            @foreach ([
                ['label' => 'Total murid', 'value' => $attendanceStats['totalStudents'], 'icon' => 'solar:user-circle-outline', 'color' => 'primary'],
                ['label' => 'Hadir', 'value' => $attendanceStats['present'], 'icon' => 'tabler:check', 'color' => 'success'],
                ['label' => 'Belum absen', 'value' => $attendanceStats['absent'], 'icon' => 'solar:clock-circle-linear', 'color' => 'secondary'],
            ] as $stat)
            <div class="min-w-[220px] flex-1">
                <div class="h-full rounded-xl bg-white p-5 shadow-xs dark:bg-darkgray">
                    <div class="flex items-center gap-4">
                        <div class="rounded-md bg-light{{ $stat['color'] }} p-3 text-{{ $stat['color'] }}"><x-icon name="{{ $stat['icon'] }}" size="24" /></div>
                        <div><p class="text-sm text-darklink">{{ $stat['label'] }}</p><p class="mt-1 text-2xl font-semibold text-dark dark:text-white">{{ $stat['value'] }}</p></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="col-span-12">
        <div class="rounded-xl bg-white p-6 shadow-xs dark:bg-darkgray">
            <div class="mb-5 flex items-center justify-between"><h5 class="card-title">Absensi hari ini</h5><a href="{{ route('attendance.recap') }}" class="text-sm text-primary hover:underline">Lihat semua</a></div>
            <div class="overflow-x-auto">
                <table class="js-data-table w-full text-left text-sm">
                    <thead class="border-y border-defaultBorder text-darklink">
                        <tr>
                            <th class="whitespace-nowrap p-4 font-medium">Nama</th>
                            <th class="whitespace-nowrap p-4 font-medium">NIM</th>
                            <th class="whitespace-nowrap p-4 font-medium">Prodi</th>
                            <th class="whitespace-nowrap p-4 font-medium">Fakultas</th>
                            <th class="whitespace-nowrap p-4 font-medium">Kategori</th>
                            <th class="whitespace-nowrap p-4 font-medium">Detak jantung</th>
                            <th class="whitespace-nowrap p-4 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($todayAttendances->take(8) as $attendance)
                            @php($statusLabels = ['present' => ['Hadir', 'success'], 'permission' => ['Izin', 'warning'], 'sick' => ['Sakit', 'error'], 'absent' => ['Alpa', 'secondary']])
                            @php([$statusLabel, $statusColor] = $statusLabels[$attendance->status] ?? [ucfirst($attendance->status), 'secondary'])
                            <tr class="border-b border-defaultBorder hover:bg-gray-50 dark:hover:bg-white/5">
                                <td class="whitespace-nowrap p-4 font-medium text-dark dark:text-white">
                                    {{ $attendance->athlete?->name ?? $attendance->user?->name ?? 'Murid dihapus' }}
                                </td>
                                <td class="whitespace-nowrap p-4 text-darklink">
                                    {{ $attendance->user?->nim ?? '-' }}
                                </td>
                                <td class="whitespace-nowrap p-4 text-darklink">
                                    {{ $attendance->user?->prodi ?? '-' }}
                                </td>
                                <td class="whitespace-nowrap p-4 text-darklink">
                                    {{ $attendance->user?->fakultas ?? '-' }}
                                </td>
                                <td class="whitespace-nowrap p-4 text-darklink">
                                    {{ $attendance->athlete?->class_category ?? '-' }}
                                </td>
                                <td class="whitespace-nowrap p-4 text-darklink">
                                    {{ $attendance->heart_rate ? $attendance->heart_rate . ' BPM' : '-' }}
                                </td>
                                <td class="whitespace-nowrap p-4">
                                    <span class="rounded-md bg-light{{ $statusColor }} px-2 py-1 text-xs font-medium text-{{ $statusColor }}">
                                        {{ $statusLabel }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</div>
@endsection
