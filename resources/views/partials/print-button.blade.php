<!-- Print Button -->
<button onclick="printTable(this)" 
        data-print-url="{{ 
            request()->routeIs('dashboard.users.*') ? route('dashboard.users.print') :
            (request()->routeIs('dashboard.comics.*') ? route('dashboard.comics.print') :
            (request()->routeIs('dashboard.chapters.*') ? route('dashboard.chapters.print') :
            (request()->routeIs('dashboard.comments.*') ? route('dashboard.comments.print') :
            (request()->routeIs('dashboard.global-chats.*') ? route('dashboard.global-chats.print') : ''))))
        }}"
        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2 no-print">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
    </svg>
    Print
</button>

<style>
    @media print {
        /* Hide everything except the table */
        body * {
            visibility: hidden;
        }
        
        .print-table-container,
        .print-table-container * {
            visibility: visible;
        }
        
        .print-table-container {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        
        /* Hide non-printable elements */
        .no-print,
        .no-print * {
            display: none !important;
        }
        
        /* Print header */
        .print-header {
            display: block;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #000;
        }
        
        .print-header h1 {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
            color: #000;
        }
        
        .print-header p {
            font-size: 12px;
            color: #666;
            margin: 5px 0 0 0;
        }
        
        /* Table styling for print */
        .print-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .print-table thead {
            background-color: #f3f4f6 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        
        .print-table th {
            background-color: #f3f4f6 !important;
            color: #000 !important;
            font-weight: bold;
            padding: 12px 8px;
            border: 1px solid #000;
            text-align: left;
            font-size: 12px;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        
        .print-table td {
            padding: 10px 8px;
            border: 1px solid #000;
            color: #000 !important;
            font-size: 11px;
        }
        
        .print-table tbody tr {
            border-bottom: 1px solid #000;
        }
        
        .print-table tbody tr:nth-child(even) {
            background-color: #f9fafb !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        
        /* Print footer */
        .print-footer {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #000;
            font-size: 10px;
            color: #666;
            text-align: center;
        }
        
        /* Remove background colors and borders from badges */
        .print-table .badge,
        .print-table span[class*="bg-"] {
            background-color: transparent !important;
            color: #000 !important;
            border: 1px solid #000;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 10px;
        }
        
        /* Hide action buttons */
        .print-table .no-print,
        .print-table a[href*="edit"],
        .print-table a[href*="destroy"],
        .print-table form,
        .print-table button,
        .print-table svg {
            display: none !important;
        }
        
        /* Page break */
        @page {
            size: A4 portrait;
            margin: 1cm;
        }
        
        /* Ensure table doesn't break across pages */
        .print-table {
            table-layout: auto;
        }
        
        .print-table thead {
            display: table-header-group;
        }
        
        .print-table thead tr {
            display: table-row;
        }
        
        .print-table thead th {
            display: table-cell;
            vertical-align: middle;
        }
        
        .print-table tbody {
            display: table-row-group;
        }
        
        .print-table tbody tr {
            display: table-row;
            page-break-inside: avoid;
        }
        
        .print-table tbody td {
            display: table-cell;
            vertical-align: middle;
        }
    }
</style>

<script>
    function printTable(button) {
        // Get print URL from data attribute
        const printUrl = button.getAttribute('data-print-url');
        
        if (!printUrl) {
            alert('Print tidak tersedia untuk halaman ini!');
            return;
        }
        
        // Show loading
        const printButton = button;
        const originalText = printButton.innerHTML;
        printButton.disabled = true;
        printButton.innerHTML = '<svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Loading...';
        
        // Fetch all data from server
        fetch(printUrl)
            .then(response => response.json())
            .then(data => {
                printButton.disabled = false;
                printButton.innerHTML = originalText;
                
                // Create print window
                const printWindow = window.open('', '_blank');
                const pageTitle = data.title || document.querySelector('h2')?.textContent || 'Data Table';
                const currentDate = new Date().toLocaleString('id-ID', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
                
                // Build table HTML
                let tableHTML = '<table class="print-table">';
                
                // Table header
                tableHTML += '<thead><tr>';
                data.headers.forEach(header => {
                    tableHTML += `<th>${header}</th>`;
                });
                tableHTML += '</tr></thead>';
                
                // Table body
                tableHTML += '<tbody>';
                if (data.data && data.data.length > 0) {
                    data.data.forEach(row => {
                        tableHTML += '<tr>';
                        row.forEach(cell => {
                            tableHTML += `<td>${cell || '-'}</td>`;
                        });
                        tableHTML += '</tr>';
                    });
                } else {
                    tableHTML += `<tr><td colspan="${data.headers.length}" style="text-align: center; padding: 20px;">No data available</td></tr>`;
                }
                tableHTML += '</tbody></table>';
        
                // Create print document
                printWindow.document.write(`
                    <!DOCTYPE html>
                    <html>
                    <head>
                        <title>Print - ${pageTitle}</title>
                        <style>
                    @page {
                        size: A4 portrait;
                        margin: 1cm;
                    }
                    
                    body {
                        font-family: Arial, sans-serif;
                        margin: 0;
                        padding: 20px;
                        color: #000;
                        background: #fff;
                    }
                    
                    .print-header {
                        margin-bottom: 20px;
                        padding-bottom: 10px;
                        border-bottom: 2px solid #000;
                    }
                    
                    .print-header h1 {
                        font-size: 24px;
                        font-weight: bold;
                        margin: 0;
                        color: #000;
                    }
                    
                    .print-header p {
                        font-size: 12px;
                        color: #666;
                        margin: 5px 0 0 0;
                    }
                    
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-top: 20px;
                        table-layout: auto;
                    }
                    
                    thead {
                        background-color: #f3f4f6 !important;
                        -webkit-print-color-adjust: exact;
                        print-color-adjust: exact;
                        display: table-header-group;
                    }
                    
                    thead tr {
                        display: table-row;
                    }
                    
                    th {
                        background-color: #f3f4f6 !important;
                        color: #000 !important;
                        font-weight: bold;
                        padding: 12px 8px;
                        border: 1px solid #000;
                        text-align: left;
                        font-size: 12px;
                        display: table-cell;
                        vertical-align: middle;
                    }
                    
                    td {
                        padding: 10px 8px;
                        border: 1px solid #000;
                        color: #000 !important;
                        font-size: 11px;
                    }
                    
                    tbody {
                        display: table-row-group;
                    }
                    
                    tbody tr {
                        display: table-row;
                        border-bottom: 1px solid #000;
                    }
                    
                    tbody td {
                        display: table-cell;
                        vertical-align: middle;
                    }
                    
                    tbody tr:nth-child(even) {
                        background-color: #f9fafb !important;
                        -webkit-print-color-adjust: exact;
                        print-color-adjust: exact;
                    }
                    
                    .badge,
                    span[class*="bg-"] {
                        background-color: transparent !important;
                        color: #000 !important;
                        border: 1px solid #000;
                        padding: 2px 6px;
                        border-radius: 3px;
                        font-size: 10px;
                        display: inline-block;
                    }
                    
                    /* Hide action buttons and forms */
                    a[href*="edit"],
                    a[href*="destroy"],
                    form,
                    button,
                    svg {
                        display: none !important;
                    }
                    
                    /* Show only text content in action cells */
                    td:last-child {
                        text-align: center;
                        color: #999;
                        font-size: 10px;
                    }
                    
                    .print-footer {
                        margin-top: 30px;
                        padding-top: 10px;
                        border-top: 1px solid #000;
                        font-size: 10px;
                        color: #666;
                        text-align: center;
                    }
                    
                    @media print {
                        @page {
                            size: A4 portrait;
                            margin: 1cm;
                        }
                        
                        body {
                            margin: 0;
                            padding: 0;
                        }
                        
                        table {
                            page-break-inside: auto;
                        }
                        
                        thead {
                            display: table-header-group;
                        }
                        
                        tbody {
                            display: table-row-group;
                        }
                        
                        tr {
                            page-break-inside: avoid;
                            page-break-after: auto;
                        }
                        
                        thead tr {
                            page-break-after: avoid;
                        }
                    }
                </style>
            </head>
            <body>
                        <div class="print-header">
                            <h1>${pageTitle}</h1>
                            <p>Printed on: ${currentDate}</p>
                            <p>Total Records: ${data.data.length}</p>
                        </div>
                        ${tableHTML}
                        <div class="print-footer">
                            <p>Readr Dashboard - Generated Report</p>
                        </div>
                    </body>
                    </html>
                `);
                
                printWindow.document.close();
                
                // Wait for content to load, then print
                printWindow.onload = function() {
                    printWindow.focus();
                    printWindow.print();
                    printWindow.close();
                };
            })
            .catch(error => {
                printButton.disabled = false;
                printButton.innerHTML = originalText;
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengambil data. Silakan coba lagi.');
            });
    }
</script>

