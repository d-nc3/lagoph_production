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
            lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
            processing: true,
            serverSide: true,
            ajax: { 
                url: `${BASE_URL}Transaction/Transaction_history/dt_list`,
                type: "POST",
                data: function(d) {
                
                }
            },
            columns: [
                { data: '' },
                { data: 'Name'},
                {data:  'transaction_name'},
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
                    // For Responsive
                    className: 'control',
                    responsivePriority: 2,
                    searchable: false,
                    targets: 1,
                    render: function (data, type, full, meta) {
                        var invoiceId = full['transaction_name'];
                        return `
                            <a href="#" style="display: flex; align-items: center; text-decoration: none; color: #4CAF50;">
                                <i class="fas fa-receipt" style="background-color: #4CAF50; color: white; border-radius: 50%; padding: 10px; font-size: 18px; margin-right: 8px;"></i>
                                <span style="font-size: 16px; font-weight: 500;">${invoiceId}</span>
                            </a>
                        `;
                    }
                    
                    
                    
                    
                },
                {
                    targets: 2,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $name = full['first_name'] + ' ' + full['last_name'],
                            $email = full['email'];
                        // For Avatar badge
                        var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                        var $state = states[full['id'] % states.length], // ensure id fits in states array
                            $initials = $name.match(/\b\w/g) || [];
                        $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
                        var $output = '<span class="avatar-initial rounded-circle bg-label-' + $state + '">' + $initials + '</span>';
                        // Creates full output for row
                        var $row_output = `
                        <div class="d-flex justify-content-start align-items-center user-name">
                          <div class="avatar-wrapper">
                            <div class="avatar avatar-sm me-3">
                              ${$output}
                            </div>
                          </div>
                          <div class="d-flex flex-column">
                            <a href="${BASE_URL}Cashiering/view/${full['id']}" class="text-body text-truncate"><span class="fw-medium name">${$name}</span></a>
                            <small class="text-muted email">${$email}</small>
                          </div>
                        </div>
                        `;
                        return $row_output;
                    }
                  },
                {
                    // Official Receipt Number with Link
                    className: 'control',
                    responsivePriority: 2,
                    searchable: false,
                    targets: 3,
                    render: function (data, type, full, meta) {
                        var invoiceId = full['official_receipt_number'];
                        const or_id = full['receipt_id'];
                     return `<a href="${BASE_URL}transaction-history/view/${or_id}">${invoiceId}</a>`;

                        
                    }
                },
                {
                    // Payment Date
                    targets: 4,
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
                        const or_id = full['receipt_id'];
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