<!-- Table Search Row -->
<tr class="bg-[#161b22] search-row">
    @foreach($searchColumns as $col)
        <td class="py-2 px-6">
            <div class="flex items-center gap-2 relative">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8" stroke-width="2"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65" stroke-width="2"></line>
                </svg>
                <input type="text" name="search_{{ strtolower($col) }}" placeholder="Search {{ $col }}"
                    class="search-input bg-[#0d1117] border border-[#21262d] rounded-lg px-3 py-1 text-sm text-gray-200 w-full focus:outline-none focus:border-blue-500"
                    oninput="filterTable(this)" autocomplete="off" />
            </div>
        </td>
    @endforeach
    @if($hasActions)
        <td class="py-2 px-6"></td>
    @endif
</tr>

<script>
function filterTable(input) {
    const table = input.closest('table');
    const tbody = table.querySelector('tbody');
    const allRows = Array.from(tbody.querySelectorAll('tr'));
    // Data rows: exclude empty message
    const dataRows = allRows.filter(row => {
        const firstCell = row.querySelector('td');
        if (!firstCell) return false;
        const text = firstCell.textContent.trim().toLowerCase();
        return !text.includes('no ') && !text.includes('found');
    });
    const searchInputs = table.querySelectorAll('.search-input');
    // Get all filter values
    const filters = [];
    searchInputs.forEach((searchInput, index) => {
        const value = searchInput.value.toLowerCase().trim();
        if (value) {
            filters.push({ column: index, value: value });
        }
    });
    // Hide original empty rows first (only if we have data rows)
    if (dataRows.length > 0) {
        allRows.forEach(row => {
            const firstCell = row.querySelector('td');
            if (firstCell) {
                const text = firstCell.textContent.trim().toLowerCase();
                if (text.includes('no ') || text.includes('found')) {
                    row.style.display = 'none';
                }
            }
        });
    }
    // Filter rows based on all active filters (AND logic)
    let visibleCount = 0;
    dataRows.forEach(row => {
        let shouldShow = true;
        if (filters.length > 0) {
            filters.forEach(filter => {
                const cell = row.querySelectorAll('td')[filter.column];
                if (cell) {
                    const cellText = cell.textContent.toLowerCase();
                    if (!cellText.includes(filter.value)) {
                        shouldShow = false;
                    }
                } else {
                    shouldShow = false;
                }
            });
        }
        if (filters.length === 0) {
            shouldShow = true;
        }
        if (shouldShow) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    // If no filters and no data rows, show original empty message
    if (filters.length === 0 && dataRows.length === 0) {
        allRows.forEach(row => {
            const firstCell = row.querySelector('td');
            if (firstCell) {
                const text = firstCell.textContent.trim().toLowerCase();
                if (text.includes('no ') || text.includes('found')) {
                    row.style.display = '';
                }
            }
        });
    }
    // Handle empty message
    const existingFilterEmpty = tbody.querySelector('tr[data-filter-empty]');
    if (visibleCount === 0 && dataRows.length > 0) {
        if (!existingFilterEmpty) {
            const emptyTr = document.createElement('tr');
            emptyTr.setAttribute('data-empty', 'true');
            emptyTr.setAttribute('data-filter-empty', 'true');
            const colCount = table.querySelectorAll('thead tr:first-child th').length;
            emptyTr.innerHTML = `<td colspan="${colCount}" class="py-8 text-center text-gray-400">No data found matching your search</td>`;
            tbody.appendChild(emptyTr);
        }
    } else {
        if (existingFilterEmpty) {
            existingFilterEmpty.remove();
        }
    }
}

function clearAllFilters() {
    const table = document.querySelector('.print-table');
    if (!table) return;
    const searchInputs = table.querySelectorAll('.search-input');
    searchInputs.forEach(input => {
        input.value = '';
        filterTable(input);
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const searchInputs = document.querySelectorAll('.search-input');
    searchInputs.forEach(input => {
        input.addEventListener('focus', function() {
            if (!this.parentElement.querySelector('.clear-search')) {
                const clearBtn = document.createElement('button');
                clearBtn.className = 'clear-search absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-300';
                clearBtn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';
                clearBtn.onclick = function(e) {
                    e.stopPropagation();
                    input.value = '';
                    filterTable(input);
                    this.remove();
                };
                this.parentElement.style.position = 'relative';
                this.parentElement.appendChild(clearBtn);
            }
        });
    });
});
</script>

<style>
    .search-row input:focus {
        background-color: #1c2128;
    }
    .search-row input::placeholder {
        color: #6b7280;
    }
    .search-row .clear-search {
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
        outline: none;
    }
</style>

<script>
    function filterTable(input) {
        const table = input.closest('table');
        const tbody = table.querySelector('tbody');
        const allRows = Array.from(tbody.querySelectorAll('tr'));
        
        // Separate data rows from empty message rows
        const dataRows = allRows.filter(row => {
            const firstCell = row.querySelector('td');
            if (!firstCell) return false;
            const text = firstCell.textContent.trim().toLowerCase();
            return !text.includes('no ') && !text.includes('found');
        });
        
        const searchInputs = table.querySelectorAll('.search-input');
        
        // Get all filter values
        const filters = [];
        searchInputs.forEach((searchInput, index) => {
            const value = searchInput.value.toLowerCase().trim();
            if (value) {
                filters.push({ column: index, value: value });
            }
        });
        
        // Hide original empty rows first (only if we have data rows)
        if (dataRows.length > 0) {
            allRows.forEach(row => {
                const firstCell = row.querySelector('td');
                if (firstCell) {
                    const text = firstCell.textContent.trim().toLowerCase();
                    if (text.includes('no ') || text.includes('found')) {
                        row.style.display = 'none';
                    }
                }
            });
        }
        
        // Filter rows based on all active filters (AND logic)
        let visibleCount = 0;
        dataRows.forEach(row => {
            let shouldShow = true;
            
            // If there are filters, check all of them
            if (filters.length > 0) {
                filters.forEach(filter => {
                    const cell = row.querySelectorAll('td')[filter.column];
                    if (cell) {
                        const cellText = cell.textContent.toLowerCase();
                        if (!cellText.includes(filter.value)) {
                            shouldShow = false;
                        }
                    } else {
                        shouldShow = false;
                    }
                });
            }
            
            // If no filters, show all data rows
            if (filters.length === 0) {
                shouldShow = true;
            }
            
            if (shouldShow) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });
        
        // If no filters and no data rows, show original empty message
        if (filters.length === 0 && dataRows.length === 0) {
            allRows.forEach(row => {
                const firstCell = row.querySelector('td');
                if (firstCell) {
                    const text = firstCell.textContent.trim().toLowerCase();
                    if (text.includes('no ') || text.includes('found')) {
                        row.style.display = '';
                    }
                }
            });
        }
        
        // Handle empty message
        const existingFilterEmpty = tbody.querySelector('tr[data-filter-empty]');
        
        if (visibleCount === 0 && dataRows.length > 0) {
            // Show filtered empty message
            if (!existingFilterEmpty) {
                const emptyTr = document.createElement('tr');
                emptyTr.setAttribute('data-empty', 'true');
                emptyTr.setAttribute('data-filter-empty', 'true');
                const colCount = table.querySelectorAll('thead tr:first-child th').length;
                emptyTr.innerHTML = `<td colspan="${colCount}" class="py-8 text-center text-gray-400">No data found matching your search</td>`;
                tbody.appendChild(emptyTr);
            }
        } else {
            // Remove filtered empty message
            if (existingFilterEmpty) {
                existingFilterEmpty.remove();
            }
        }
    }
    
    // Clear all filters
    function clearAllFilters() {
        const table = document.querySelector('.print-table');
        if (!table) return;
        
        const searchInputs = table.querySelectorAll('.search-input');
        searchInputs.forEach(input => {
            input.value = '';
            filterTable(input);
        });
    }
    
    // Add clear button functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInputs = document.querySelectorAll('.search-input');
        searchInputs.forEach(input => {
            // Add clear button on focus
            input.addEventListener('focus', function() {
                if (!this.parentElement.querySelector('.clear-search')) {
                    const clearBtn = document.createElement('button');
                    clearBtn.className = 'clear-search absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-300';
                    clearBtn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';
                    clearBtn.onclick = function(e) {
                        e.stopPropagation();
                        input.value = '';
                        filterTable(input);
                        this.remove();
                    };
                    this.parentElement.style.position = 'relative';
                    this.parentElement.appendChild(clearBtn);
                }
            });
        });
    });
</script>

<style>
    .search-row input:focus {
        background-color: #1c2128;
    }
    
    .search-row input::placeholder {
        color: #6b7280;
    }
</style>

