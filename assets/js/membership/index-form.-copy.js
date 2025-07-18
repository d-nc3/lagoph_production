/**
 * App Invoice List (jquery)
 */

'use strict';

$(function () {

    // Variable declaration for table
    var table = $('.datatables-transactions');


  //populate data in the data tables
    if (table.length) {
        var dt = table.DataTable({
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            processing: true,
            serverSide: true,
            ajax: { 
                url: `${BASE_URL}Cashiering/dt_list`,
                type: "POST",
                data: function(d) {
                }
            },
            columns: [
            
                { data: 'cashiering_invoice_id' },
                { data: 'invoice_number' },
                { data: 'date_issued'},
                { data: 'transaction_name'},
                { data: 'status'},
            ],
            columnDefs: [
                {
                    // For Responsive
                    className: 'control',
                    responsivePriority: 2,
                    searchable: false,
                    targets: 0,
                    render: function (data, type, full, meta) {
                        var invoiceId = full['cashiering_invoice_id'];
                        var invoiceNumber = full['invoice_number'];
                        // Creates a link to view the invoice
                        return `<a href="${BASE_URL}Cashiering/view/${invoiceId}">${invoiceNumber}</a>`;
                    }
                },
            
                {
                    // Quantity
                    targets: 1,
                    render: function (data, type, full, meta) {
                        var date_issued = full['date_issued'];
                        return `<span>${date_issued}</span>`;
                    }
                },
                {
                    // Status
                    targets: 2,
                    render: function (data, type, full, meta) {
                        var status = full['status'];
        
                        // Determine status color
                        var statusColor = '';
                        switch (status) {
                            case 'payment-initiated':
                                statusColor = 'badge bg-label-warning';
                                break;
                            case 'completed':
                                statusColor = 'badge bg-label-success';
                                break;
                            case 'failed':
                                statusColor = 'badge bg-label-danger';
                                break;
                            default:
                                statusColor = 'badge bg-label-secondary';
                                break;
                        }
        
                        return `<span class="${statusColor}">${status}</span>`;
                    }
                },
                {
                    // Total Amount
                    targets: 3,
                    render: function (data, type, full, meta) {
                        var invoice_type = full['transaction_name'];
                        return `<span>${invoice_type}</span>`;
                    }
                },
                
                {
                    targets: -1,
                    title: 'Actions',
                    searchable: false,
                    orderable: false,
                    render: function (data, type, full, meta) {
                        // Determine the URL based on the invoice type
                        const invoiceType =  full['transaction_name']; // Adjust this depending on how invoice_type is passed in `full`
                        const invoiceUrl = invoiceType === 'membership_fee'
                            ? `${BASE_URL}Transaction/view_transaction/${full['user_id']}"`
                            : `${BASE_URL}Transaction/view_transaction/${full['user_id']}"`;
                    
                        return (
                            '<div class="d-flex align-items-center">' +
                            '<div class="dropdown">' +
                            `<a href="${invoiceUrl}" data-bs-toggle="tooltip" class="btn btn-primary d-grid ml-2" style="margin-left: 2px;" data-bs-placement="top" title="Preview Invoice"><i class="bx bx-show mx-1"></i></a>` +
                            '</div>' +
                            '</div>'
                        );
                    }
                }
            ],
            order: [[0, 'asc']]
        });

        $('#status-filter').on('change', function() {
            dt.ajax.reload();
        });
    }


    // Delete Record
    $('.invoice-list-table tbody').on('click', '.delete-record', function () {
      dt_invoice.row($(this).parents('tr')).remove().draw();
    });

    // Filter form control to default size
    // ? setTimeout used for multilingual table initialization
    setTimeout(() => {
      $('.dataTables_filter .form-control').removeClass('form-control-sm');
      $('.dataTables_length .form-select').removeClass('form-select-sm');
    }, 300);


 
})