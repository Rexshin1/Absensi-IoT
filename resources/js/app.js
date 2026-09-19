import './bootstrap';
import Alpine from 'alpinejs';
import ApexCharts from 'apexcharts';

window.Alpine = Alpine;
window.ApexCharts = ApexCharts;

const iconMap = {
    'tabler:menu-2': 'M4 7h16M4 12h16M4 17h16',
    'tabler:moon': 'M19 14.5A7 7 0 1 1 11.5 4a5 5 0 0 0 7.5 10.5Z',
    'tabler:search': 'M11 19a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm10 2-4-4',
    'tabler:check': 'M5 12l4 4L19 0',
    'tabler:bell-ringing': 'M18 8a6 6 0 0 0-12 0c0 7-3 7.5 0 10h12c3-2.5 0-3 0-10Z M10 21h4',
    'tabler:trash': 'M4 7h16M10 11v5M14 11v5M7 7l1 14h8l1-14',
    'solar:magnifer-linear': 'M11 19a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm8 2-4-4',
    'solar:close-circle-linear': 'M4 4l16 16M20 4L4 20',
    'solar:widget-add-line-duotone': 'M4 4h7v7H4zM13 4h7v7h-7zM4 13h7v7H4zM13 13h7v7h-7z',
    'solar:home-angle-linear': 'M4 4h6v8H4zm10 0h6v5h-6zM4 16h6v4H4zm10-3h6v7h-6z',
    'solar:user-plus-linear': 'M9 7a4 4 0 1 0 0 8 4 4 0 0 0 0-8z M3 19a6 6 0 0 1 12 0 M16 11h6 M19 8v6',
    'solar:server-linear': 'M9 7a4 4 0 1 0 0 8 4 4 0 0 0 0-8z M3 19a6 6 0 0 1 12 0 M17 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6z M15 19a5 5 0 0 0 5-5v-1',
    'solar:checklist-linear': 'M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2 M9 5a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2 M9 5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2 M9 14l2 2 4-4',
    'solar:database-linear': 'M4 6c0-1.7 3.6-3 8-3s8 1.3 8 3v12c0 1.7-3.6 3-8 3s-8-1.3-8-3V6zm0 6c0 1.7 3.6 3 8 3s8-1.3 8-3m-16 6c0 1.7 3.6 3 8 3s8-1.3 8-3',
    'solar:user-circle-outline': 'M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8z M4 20a8 8 0 0 1 16 0',
    'solar:user-circle-linear': 'M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8z M4 20a8 8 0 0 1 16 0',
    'solar:clock-circle-linear': 'M12 3a9 9 0 1 0 0 18 9 9 0 0 0 0-18z M12 7v5l4 2',
    'solar:menu-dots-bold': 'M12 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4zM12 16a2 2 0 1 0 0-4 2 2 0 0 0 0 4zM12 24a2 2 0 1 0 0-4 2 2 0 0 0 0 4z',
    'solar:search': 'M11 19a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm10 2-4-4',
    'solar:sun-bold-duotone': 'M12 3v2M12 19v2M4.6 4.6l1.4 1.4M18 18l1.4 1.4M3 12h2M19 12h2M4.6 19.4l1.4-1.4M18 6l1.4-1.4M12 7a5 5 0 1 0 0 10 5 5 0 0 0 0-10z',
    'ic:outline-edit': 'M4 20h7l13-13a2.8 2.8 0 0 0-4-4L7 16l-3 3zM14 6l4 4',
    'ri:checkbox-blank-circle-line': 'M12 3a9 9 0 1 0 9 9a9 9 0 0 0-9-9z',
};

function resolveOneIcon(name) {
    if (!name) return 'solar:widget-add-line-duotone';

    const source = String(name).trim();

    // Handles Alpine expression in the blade header:
    // :icon="isDark ? 'solar:sun-bold-duotone' : 'tabler:moon'"
    const ternary = source.match(/isDark\s*\?\s*'([^']+)'\s*:\s*'([^']+)'/);
    if (ternary) {
        return localStorage.getItem('matdash-theme') === 'dark' ? ternary[1] : ternary[2];
    }

    // Handles plain icon attribute strings like icon="solar:server-linear"
    const clean = source
        .replace(/^icon=/, '')
        .replace(/^:icon=/, '')
        .replace(/^x-bind:icon=/, '')
        .replace(/^['"]|['"]$/g, '')
        .replace(/\"/g, '')
        .trim();

    if (iconMap[clean]) return clean;
    if (iconMap[source]) return source;

    return 'solar:widget-add-line-duotone';
}

function iconSVG(name, size = 22, classes = '') {
    const iconName = resolveOneIcon(name);
    const path = iconMap[iconName] || iconMap['solar:widget-add-line-duotone'];
    return `<svg xmlns="http://www.w3.org/2000/svg" width="${size}" height="${size}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="iconify-icon ${classes}"><path d="${path}"/></svg>`;
}

if (!customElements.get('iconify-icon')) {
    customElements.define('iconify-icon', class extends HTMLElement {
        connectedCallback() {
            const icon = this.getAttribute('icon') || this.getAttribute(':icon') || this.getAttribute('x-bind:icon') || '';
            const width = this.getAttribute('width') || '22';
            const classes = this.getAttribute('class') || '';
            const size = Number.parseInt(width) || 22;
            this.innerHTML = iconSVG(icon, size, classes);
        }
    });
}

Alpine.data('matdash', () => ({
    mobileSidebarOpen: false,
    notificationsOpen: false,
    profileOpen: false,
    isDark: localStorage.getItem('matdash-theme') === 'dark',
    init() { this.applyTheme(); },
    toggleTheme() {
        this.isDark = !this.isDark;
        localStorage.setItem('matdash-theme', this.isDark ? 'dark' : 'light');
        this.applyTheme();
    },
    applyTheme() { document.documentElement.classList.toggle('dark', this.isDark); },
}));

Alpine.data('revenueForecast', () => ({
    period: 'This Week', chart: null,
    periods: {
        'This Week': [{ name: '2024', data: [1.2, 2.7, 1.0, 3.6, 2.1, 2.7, 2.2, 1.3, 2.5] }, { name: '2023', data: [-2.8, -1.1, -2.5, -1.5, -2.3, -1.9, -1.0, -2.1, -1.3] }],
        'April 2024': [{ name: '2024', data: [2.5, 3.0, 2.8, 3.2, 2.9, 3.1, 2.7, 2.8, 3.0] }, { name: '2023', data: [-1.5, -1.2, -1.8, -2.0, -1.7, -1.9, -2.1, -1.6, -1.8] }],
        'May 2024': [{ name: '2024', data: [2.7, 2.9, 2.6, 3.1, 3.0, 2.8, 2.9, 3.2, 3.1] }, { name: '2023', data: [-1.4, -1.3, -1.9, -1.7, -1.8, -2.0, -1.9, -1.8, -2.1] }],
        'June 2024': [{ name: '2024', data: [3.0, 3.2, 3.1, 3.5, 3.4, 3.3, 3.2, 3.4, 3.6] }, { name: '2023', data: [-1.6, -1.7, -1.8, -2.0, -1.9, -1.8, -1.7, -1.9, -2.0] }],
    },
    init() {
        this.chart = new ApexCharts(this.$refs.chart, {
            chart: { offsetX: 0, offsetY: 10, stacked: true, animations: { speed: 500 }, toolbar: { show: false } },
            series: this.periods[this.period], colors: ['var(--color-primary)', 'var(--color-error)'], dataLabels: { enabled: false },
            grid: { show: true, borderColor: '#90A4AE50', xaxis: { lines: { show: true } }, yaxis: { lines: { show: true } } }, stroke: { curve: 'smooth', width: 2 },
            plotOptions: { bar: { horizontal: false, barHeight: '60%', columnWidth: '15%', borderRadius: 5, borderRadiusApplication: 'end', borderRadiusWhenStacked: 'all' } },
            xaxis: { categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'], axisBorder: { show: false }, axisTicks: { show: false } },
            yaxis: { min: -4, max: 4, tickAmount: 4 }, legend: { show: false }, tooltip: { theme: 'dark' },
        });
        this.chart.render(); this.$watch('period', value => this.chart.updateSeries(this.periods[value]));
    },
}));

Alpine.data('heartRateChart', (readings = []) => ({
    init() {
        const hasReadings = readings.length > 0;
        new ApexCharts(this.$refs.chart, {
            chart: { type: 'area', height: 300, toolbar: { show: false }, fontFamily: 'inherit' },
            series: [{ name: 'Detak jantung', data: readings.map(reading => reading.heart_rate) }],
            colors: ['var(--color-primary)'],
            stroke: { curve: 'smooth', width: 3 },
            fill: { type: 'gradient', gradient: { opacityFrom: 0.35, opacityTo: 0.04, stops: [0, 100] } },
            markers: { size: 5, colors: ['var(--color-primary)'], strokeColors: '#fff', strokeWidth: 2 },
            xaxis: { categories: readings.map(reading => reading.time), labels: { style: { colors: 'var(--color-darklink)' } } },
            yaxis: { title: { text: 'BPM' }, min: hasReadings ? undefined : 40, max: hasReadings ? undefined : 180, labels: { style: { colors: 'var(--color-darklink)' } } },
            grid: { borderColor: '#90A4AE30' },
            dataLabels: { enabled: false },
            tooltip: { theme: 'dark', y: { formatter: value => `${value} BPM` }, x: { formatter: (_, index) => readings[index]?.athlete ?? '' } },
            noData: { text: 'Belum ada pembacaan detak jantung hari ini', style: { color: 'var(--color-darklink)', fontSize: '14px' } },
        }).render();
    },
}));

Alpine.data('totalIncome', () => ({
    init() {
        new ApexCharts(this.$refs.chart, {
            series: [{ name: 'monthly earnings', data: [30, 25, 35, 20, 30, 40] }],
            chart: { type: 'area', height: 60, sparkline: { enabled: true }, group: 'sparklines', fontFamily: 'inherit', foreColor: '#adb0bb' },
            colors: ['var(--color-error)'], stroke: { curve: 'smooth', width: 2 },
            fill: { type: 'gradient', gradient: { shadeIntensity: 0, inverseColors: false, opacityFrom: 0, opacityTo: 0, stops: [20, 180] } },
            markers: { size: 0 }, tooltip: { theme: 'dark', x: { show: false } },
        }).render();
    },
}));

Alpine.data('dataTable', (rows = []) => ({
    rows,
    search: '',
    page: 1,
    pageLength: 10,
    sortKey: '',
    sortDirection: 'asc',
    get filteredRows() {
        const term = this.search.trim().toLowerCase();
        const filtered = term === '' ? [...this.rows] : this.rows.filter(row => Object.values(row).some(value => String(value ?? '').toLowerCase().includes(term)));
        if (this.sortKey) {
            filtered.sort((first, second) => String(first[this.sortKey] ?? '').localeCompare(String(second[this.sortKey] ?? ''), undefined, { numeric: true, sensitivity: 'base' }) * (this.sortDirection === 'asc' ? 1 : -1));
        }
        return filtered;
    },
    get totalPages() { return Math.max(1, Math.ceil(this.filteredRows.length / this.pageLength)); },
    get pagedRows() {
        this.page = Math.min(this.page, this.totalPages);
        const start = (this.page - 1) * this.pageLength;
        return this.filteredRows.slice(start, start + Number(this.pageLength));
    },
    get firstRow() { return this.filteredRows.length === 0 ? 0 : (this.page - 1) * this.pageLength + 1; },
    get lastRow() { return Math.min(this.page * this.pageLength, this.filteredRows.length); },
    sortBy(key) {
        this.sortDirection = this.sortKey === key && this.sortDirection === 'asc' ? 'desc' : 'asc';
        this.sortKey = key;
        this.page = 1;
    },
    resetPage() { this.page = 1; },
}));

Alpine.start();
