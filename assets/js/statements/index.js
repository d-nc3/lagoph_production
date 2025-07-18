/**
 * App Invoice List (jquery)
 */

'use strict';

$(function () {

    // Variable declaration for table
    var table = $('.datatables-transactions'),
    select2Filters = $('.select2-filters'),
    select2 = $('.select2');

  // Select2FIlters
    if (select2Filters.length) {
        select2Filters.each(function () {   
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>').select2({
                placeholder: 'Select All',
                dropdownParent: $this.parent(),
            }); 

            $this.on('change', function(e) {
                e.preventDefault();
                dt.draw();
            });
        });
    }

    //for search and filtering functionality
    if (select2.length) {
        select2.each(function () {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>').select2({
                placeholder: 'Select Value',
                dropdownParent: $this.parent(),
            }); 
        });
    }

  //populate data in the data tables
  if (table.length) {
    var dt = table.DataTable({
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        processing: true,
        serverSide: true,
        ajax: { 
            url: `${BASE_URL}Statement/dt_list`,
            type: "POST",
            data: function(d) {
            }
        },
        columns: [
        
            { data: 'cashiering_invoice_id' },
            { data: 'invoice_number' },
            { data: 'date_issued'},
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
                targets: -1,
                title: 'Actions',
                searchable: false,
                orderable: false,
                render: function (data, type, full, meta) {
                    // Determine the URL based on the invoice type
                    const invoiceType =  full['transaction_name']; // Adjust this depending on how invoice_type is passed in `full`
                    const invoiceUrl = `${BASE_URL}Statement/view/${full['cashiering_invoice_id']}"`
        
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


const billing_address_form = document.querySelector('#billing_settings')
    const bv = FormValidation.formValidation( billing_address_form , 
    { 
        fields: {
        'billing_email' : {
            validators: { 
            
            notEmpty: {
                message: 'This filed is required'
            }, 
             emailAddress: {
                message: 'The enter a valid email address'
            }
            }
        }, 
        'mobile_number' : {
            validators: {
            maxlength: 10,
            notEmpty: {
                message: 'This field is required'
            }
            }
        },
        'address' : {
            validators: {
            notEmpty: {
                message: 'This field is required'
            }
            }
        }, 
        'province' : { 
            validators: {
            notEmpty: { 
                message: 'This field is required'
            }
            }
        },
        }, plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
            // Use this for enabling/changing valid/invalid class
            // eleInvalidClass: '',
            eleValidClass: '',
            rowSelector: function (field, ele) {
                // Generalize the row selector based on the grid classes used in the form
                return '.col-sm-12, .col-sm-6, .col-lg-6'; // Adjust this based on your grid classes
            }
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()
        }
    }).on('core.form.valid', function () {
       // Add event listener to the submit button   
    })

    document.querySelector('.submit-billing').addEventListener('click', function(e) {
        e.preventDefault(); // Prevent default form submission

        // Show a loading indicator or block UI while the request is processing
        showBlockUI();
        $.ajax({
            url: `${BASE_URL}Statement/billing_address`, // Ensure the correct URL for form submission
            type: "POST",
            data: new FormData(billing_address_form),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                // Hide the loading indicator or unblock UI
                hideBlockUI(); 
                
                if(response.status) {
                    // Show success message
                    Swal.fire({
                        text: response.message,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    }).then(() => {
                        // Hide the off-canvas form
                        window.location.reload();
                        // Refresh or redraw the DataTable to reflect the updated data
                        dt.draw();
                    });
                } else {
                    // Handle validation errors
                    if (Object.keys(response.validation_errors).length > 0) {
                        let html = '<div class="text-start">Please check the following fields:</br>';
                        html += '<ol>';
                        $.each(response.validation_errors, function(key, value) {
                            html += '<li><b>' + value['label'] + '</b> : ' + value['message'] + '</li>';
                        });
                        html += '</ol></div>';
                        Swal.fire({
                            title: response.message,
                            icon: 'error',
                            html: html,
                            showCloseButton: true,
                            focusConfirm: true,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            },
                            buttonsStyling: false
                        });
                    } else {
                        // Show general error message
                        Swal.fire({
                            text: response.message,
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                }
            },
            error: function(xhr) {
                // Hide the loading indicator or unblock UI
                hideBlockUI();
                // Show a general error message in case of failure
                Swal.fire({
                    text: "Sorry, looks like there are some errors detected, please try again.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            }
        });
    });
})