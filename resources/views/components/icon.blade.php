@props(['name' => 'dashboard', 'size' => 22, 'class' => ''])
@php
    $iconMap = [
        'tabler:menu-2' => 'M4 7h16M4 12h16M4 17h16',
        'tabler:moon' => 'M19 14.5A7 7 0 1 1 11.5 4a5 5 0 0 0 7.5 10.5Z',
        'tabler:search' => 'M11 19a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm10 2-4-4',
        'tabler:check' => 'M5 12l4 4L19 0',
        'tabler:bell-ringing' => 'M18 8a6 6 0 0 0-12 0c0 7-3 7.5 0 10h12c3-2.5 0-3 0-10Z M10 21h4',
        'tabler:trash' => 'M4 7h16M10 11v5M14 11v5M7 7l1 14h8l1-14',
        'solar:magnifer-linear' => 'M11 19a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm8 2-4-4',
        'solar:close-circle-linear' => 'M4 4l16 16M20 4L4 20',
        'solar:widget-add-line-duotone' => 'M4 4h7v7H4zM13 4h7v7h-7zM4 13h7v7H4zM13 13h7v7h-7z',
        'solar:home-angle-linear' => 'M4 4h6v8H4zm10 0h6v5h-6zM4 16h6v4H4zm10-3h6v7h-6z',
        'solar:user-plus-linear' => 'M9 7a4 4 0 1 0 0 8 4 4 0 0 0 0-8z M3 19a6 6 0 0 1 12 0 M16 11h6 M19 8v6',
        'solar:server-linear' => 'M9 7a4 4 0 1 0 0 8 4 4 0 0 0 0-8z M3 19a6 6 0 0 1 12 0 M17 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6z M15 19a5 5 0 0 0 5-5v-1',
        'solar:checklist-linear' => 'M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2 M9 5a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2 M9 5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2 M9 14l2 2 4-4',
        'solar:database-linear' => 'M4 6c0-1.7 3.6-3 8-3s8 1.3 8 3v12c0 1.7-3.6 3-8 3s-8-1.3-8-3V6zm0 6c0 1.7 3.6 3 8 3s8-1.3 8-3m-16 6c0 1.7 3.6 3 8 3s8-1.3 8-3',
        'solar:user-circle-outline' => 'M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8z M4 20a8 8 0 0 1 16 0',
        'solar:user-circle-linear' => 'M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8z M4 20a8 8 0 0 1 16 0',
        'solar:clock-circle-linear' => 'M12 3a9 9 0 1 0 0 18 9 9 0 0 0 0-18z M12 7v5l4 2',
        'solar:menu-dots-bold' => 'M12 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4zM12 16a2 2 0 1 0 0-4 2 2 0 0 0 0 4zM12 24a2 2 0 1 0 0-4 2 2 0 0 0 0 4z',
        'solar:search' => 'M11 19a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm10 2-4-4',
        'solar:sun-bold-duotone' => 'M12 3v2M12 19v2M4.6 4.6l1.4 1.4M18 18l1.4 1.4M3 12h2M19 12h2M4.6 19.4l1.4-1.4M18 6l1.4-1.4M12 7a5 5 0 1 0 0 10 5 5 0 0 0 0-10z',
        'ic:outline-edit' => 'M4 20h7l13-13a2.8 2.8 0 0 0-4-4L7 16l-3 3zM14 6l4 4',
        'ri:checkbox-blank-circle-line' => 'M12 3a9 9 0 1 0 9 9a9 9 0 0 0-9-9z',
    ];
    $key = strtolower($name);
    $path = $iconMap[$key] ?? $iconMap['solar:widget-add-line-duotone'];
    $size = (int) $size;
    $classes = trim($class);
@endphp
<svg xmlns="http://www.w3.org/2000/svg" width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="iconify-icon {{ $classes }}">
    <path d="{{ $path }}" />
</svg>
