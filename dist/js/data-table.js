document.addEventListener('alpine:init', () => {
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
});
