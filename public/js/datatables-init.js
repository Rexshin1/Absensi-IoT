(() => {
    const initDataTables = () => {
        if (typeof window.DataTable === 'undefined') return false;

        window.DataTable.ext.errMode = 'none';

        if (typeof window.pdfMake === 'undefined' || typeof window.DataTable.Buttons === 'undefined') return false;

        document.querySelectorAll('.js-data-table:not([data-dt-initialized])').forEach((table) => {
            new window.DataTable(table, {
                layout: {
                    topStart: { buttons: [{ extend: 'pdfHtml5', text: 'Export PDF', title: document.title, orientation: 'landscape', pageSize: 'A4' }] },
                    topEnd: 'search',
                },
            pageLength: 10,
            lengthMenu: [10, 25, 50],
            order: [],
            language: {
                search: 'Cari:',
                lengthMenu: 'Tampilkan _MENU_ data',
                info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                infoEmpty: 'Belum ada data',
                zeroRecords: 'Data tidak ditemukan',
                emptyTable: 'Belum ada data',
                paginate: { previous: 'Sebelumnya', next: 'Berikutnya' },
            },
            });
            table.dataset.dtInitialized = 'true';
        });

        return true;
    };

    const waitForDataTables = () => {
        if (initDataTables()) return;
        window.setTimeout(waitForDataTables, 100);
    };

    document.addEventListener('DOMContentLoaded', waitForDataTables, { once: true });
    window.addEventListener('load', waitForDataTables, { once: true });
})();