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
                url: `${BASE_URL}Statement/receipt_dt_list`,
                type: "POST",
                data: function(d) {
                
                }
            },
            columns: [
                { data: '' },
                { data: 'Name'},
                { data: 'official_receipt_number' },
                { data: 'payment_date'},
                { data: 'actions'}
                
                
                
            ],columnDefs: [
                {
                    // For Responsive
                    className: 'control',
                    responsivePriority: 2,
                    searchable: false,
                    targets: 0,
                    render: function (data, type, full, meta) {
                        return '';
                    }
                },
                {
                    // Name Column with Background
                    targets: 1,
                    render: function (data, type, full, meta) {
                        var name = full['first_name'] + " " + full['last_name'];
                        return `<span style="background-color: #f0f0f0; padding: 5px; border-radius: 3px;">${name}</span>`;
                    }
                },
                {
                    // Official Receipt Number with Link
                    className: 'control',
                    responsivePriority: 2,
                    searchable: false,
                    targets: 2,
                    render: function (data, type, full, meta) {
                        var invoiceId = full['official_receipt_number'];
                      
                        return `<a href="${BASE_URL}Official_receipt/official_transaction_receipt/${invoiceId}">${invoiceId}</a>`;
                    }
                },
                {
                    // Payment Date
                    targets: 3,
                    render: function (data, type, full, meta) {
                        const formattedDate = moment(full.payment_date).format('MMMM D, YYYY');
                        return `<span>${formattedDate}</span>`;
                      }
                },
                {
                    // Actions Column
                    targets: -1,
                    title: 'Actions',
                    searchable: false,
                    orderable: false,
                    render: function (data, type, full, meta) {
                        const invoiceType = full['invoice_type'];
                        const or_id = full['id'];
           
                        const invoiceUrl = `${BASE_URL}transaction-history/view/${or_id}`;
            
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