/**
 * Page User List
 */

'use strict';

// Datatable (jquery)
$(function () {
  let borderColor, bodyBg, headingColor;

  if (isDarkStyle) {
    borderColor = config.colors_dark.borderColor;
    bodyBg = config.colors_dark.bodyBg;
    headingColor = config.colors_dark.headingColor;
  } else {
    borderColor = config.colors.borderColor;
    bodyBg = config.colors.bodyBg;
    headingColor = config.colors.headingColor;
  }

  // Variable declaration for table
  var table = $('.datatables-employees'),
    select2 = $('.select2');

  // Select2
    if (select2.length) {
      select2.each(function () {
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

    
  
    if (table.length) {
        var dt = table.DataTable({
            lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
            processing: true,
            serverSide: true,
            ajax: {
                url: `${BASE_URL}Admin/Member/dt_list`,
                type: "POST",
                data: function(d) {
                    d.status = $("#status").val();
                    d.civil_status = $("#civil_status").val();
                }
            },
            column : [
                { data: null },
                { data: "last_name" },
                { data: "created_at" },
                { data: "status" },
                { data: null }
            ],
        columnDefs: [
          {
            targets: 0,
            className: 'control',
            searchable: false,
            orderable: false,
            responsivePriority: 2,
            render: function (data, type, full, meta) {
              return '';
            }
          },
          {
            targets: 1,
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
                  <a href="${BASE_URL}Employee/view/${full['id']}" class="text-body text-truncate"><span class="fw-medium name">${$name}</span></a>
                  <small class="text-muted email">${$email}</small>
                </div>
              </div>
              `;
              return $row_output;
          }
          },
          {
            targets: 2,
            render: function (data, type, full, meta) {
              var $created_at = full['created_at'];
              return '<span>' + $created_at + '</span>';
            }
          },
          {
            targets: 3,
            responsivePriority: 4,
            render: function (data, type, full, meta) {
                var $status = full['status'];
                var style = "";
        
                switch ($status) {
                    case "Approved":
                        style = "background-color: #e6f4ea; color: #34a853;"; // Soft green
                        break;
                    case "Processing":
                        style = "background-color: #e9eafb; color: #5c6ac4;"; // Soft violet-blue
                        break;
                    case "Completed":
                        style = "background-color: #fff4e5; color: #e67e22;"; // Soft orange
                        break;
                    default:
                        style = "background-color: #f1f1f1; color: #555;"; // Neutral grey
                }
        
                return '<span style="padding: 6px 12px; border-radius: 6px; font-weight: 500; font-size: 0.9rem; display: inline-block; ' + style + '">' + $status + '</span>';
            }
        },        
       
        
          {
            targets: -1,
            title: 'Actions',
            searchable: false,
            orderable: false,
            className: "text-center",
            render: function (data, type, full, meta) {
              return (
                '<div class="d-inline-block text-nowrap">' +
                  '<a href="' + BASE_URL + 'member/view/' + full['user_id'] + '" class="btn btn-sm btn-icon" title="View item details"><i class="bx bx-show"></i></a>' +
                  '<a href="javascript:;" class="btn btn-sm btn-icon delete-record" data-id="' + full['id'] + '" title="Delete this item"><i class="bx bx-trash"></i></a>' +
                '</div>'
              );
            }
          }
        ],
        order: [[1, 'desc']],
        dom:
          '<"row mx-1"' +
          '<"col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-start gap-3"l<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start mt-md-0 mt-3"B>>' +
          '<"col-12 col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row pe-3 gap-md-3"f<"invoice_status mb-3 mb-md-0">>' +
          '>t' +
          '<"row mx-2"' +
          '<"col-sm-12 col-md-6"i>' +
          '<"col-sm-12 col-md-6"p>' +
          '>',
        language: {
          sLengthMenu: '_MENU_',
          search: '',
          searchPlaceholder: 'Search..'
        },
        buttons: [
          {
            extend: "collection",
            className: "btn btn-label-secondary dropdown-toggle mx-3",
            text: '<i class="bx bx-export me-1"></i><span class="d-md-inline-block d-none">Export</span>',
            buttons: [
              {
                extend: "print",
                title: "Member",
                text: '<i class="bx bx-printer me-2" ></i>Print',
                className: "dropdown-item",
                exportOptions: {
                  columns: [1, 2, 3,4,5],
                  format: {
                    body: function (inner, coldex, rowdex) {
                      return $(inner).text().trim();
                    }
                  }
                }
              },
              {
                extend: "csv",
                title: "Member",
                text: '<i class="bx bx-file me-2" ></i>Csv',
                className: "dropdown-item",
                exportOptions: {
                  columns: [1, 2, 3 ,4,5],
                  format: {
                    body: function (inner, coldex, rowdex) {
                      return $(inner).text().trim();
                    }
                  }
                }
              },
              {
                extend: "excel",
                title: "Member",
                text: '<i class="bx bxs-file-export me-1"></i>Excel',
                className: "dropdown-item",
                exportOptions: {
                  columns: [1, 2, 3, 4,5],
                  format: { 
                    body: function (inner, coldex, rowdex) {
                      return $(inner).text().trim();
                    }
                  }
                }
              },
              {
                extend: "pdf",
                title: "Member",    
                text: '<i class="bx bxs-file-pdf me-2"></i>Pdf',
                className: "dropdown-item",
                exportOptions: {
                  columns: [1, 2, 3, 4,5],
                  format: {
                    body: function (inner, coldex, rowdex) {
                      return $(inner).text().trim();
                    }
                  }
                },
              },
              {
                extend: "copy",
                title: "Member",
                text: '<i class="bx bx-copy me-2" ></i>Copy',
                className: "dropdown-item",
                exportOptions: {
                  columns: [1, 2, 3, 4,5],
                  format: {
                    body: function (inner, coldex, rowdex) {
                      return $(inner).text().trim();
                    }
                  }
                }
              },

            ],
          },
        
        ],
        responsive: {
          details: {
            display: $.fn.dataTable.Responsive.display.modal({
              header: function (row) {
                var data = row.data();
                var $name =  data ['first_name'] + data['last_name'] ;
                return 'Details of ' + $name;
              }
            }),
            type: 'column',
            renderer: function (api, rowIdx, columns) {
              var data = $.map(columns, function (col, i) {
                return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                  ? '<tr data-dt-row="' +
                      col.rowIndex +
                      '" data-dt-column="' +
                      col.columnIndex +
                      '">' +
                      '<td>' +
                      col.title +
                      ':' +
                      '</td> ' +
                      '<td>' +
                      col.data +
                      '</td>' +
                      '</tr>'
                  : '';
              }).join('');

              return data ? $('<table class="table"/><tbody />').append(data) : false;
            }
          }
        }
      }); 

      dt.on('draw', function () {
       
        handleDeleteRows();
      });

      dt.on('responsive-display', function () {
       
        handleDeleteRows();
      });
    }

    // Delete routine
    var handleDeleteRows = function () {
      // Select all delete buttons
      const deleteButtons = document.querySelectorAll('.delete-record');
      deleteButtons.forEach(d => {
          // Delete button on click
          d.addEventListener('click', function (e) {
              e.preventDefault();
  
              // Select parent row
              const parent = e.target.closest('tr');
              const name = parent.querySelectorAll('td')[1].innerText;
  
              // Retrieve data-id
              const id = $(this).data('id');
              
              Swal.fire({
                text: "Are you sure you want to delete " + name + "?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then(function (result) {
              if (result.value) {
                  $.ajax({
                      url: `${BASE_URL}Employee/delete`,
                      type: "POST",
                      async: true,
                      data: { id : id},
                      dataType: 'json',
                      success: function(response) {
                          if(response.status) {
                              Swal.fire({
                                  text: "You have deleted " + name + "!.",
                                  icon: "success",
                                  buttonsStyling: false,
                                  confirmButtonText: "Ok, got it!",
                                  customClass: {
                                      confirmButton: "btn fw-bold btn-primary",
                                  }
                              }).then(function () {
                                  dt.draw();
                              });
                          } else {
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
                      },
                      error: function(error) {
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
              } else if (result.dismiss === 'cancel') {
                  Swal.fire({
                      text: name + " was not deleted.",
                      icon: "error",
                      buttonsStyling: false,
                      confirmButtonText: "Ok, got it!",
                      customClass: {
                          confirmButton: "btn fw-bold btn-primary",
                      }
                  });
              }
            });
          })
      });
    }

    const form = document.getElementById('addForm')
    const fv = FormValidation.formValidation(form, {
        fields: {
            modal_first_name: {
                validators: {
                    notEmpty: {
                        message: 'First Name field is required'
                    }
                }
            },
            modal_last_name: {
                validators: {
                    notEmpty: {
                        message: 'Last Name field is required'
                    }
                }
            },
            modal_middle_name: {
                validators: {
                    notEmpty: {
                        message: 'Middle Name field is required'
                    }
                }
            },
            modal_date_of_birth: {
                validators: {
                    notEmpty: {
                        message: 'Date of Birth field is required'
                    }
                }
            },
            modal_place_of_birth: {
                validators: {
                    notEmpty: {
                        message: 'Place of Birth field is required'
                    }
                }
            },
            modal_mobile_number: {
                validators: {
                    notEmpty: {
                        message: 'Mobile Number field is required'
                    },
                  
                }
            },
            modal_date_hired: {
                validators: {
                    notEmpty: {
                        message: 'Date Hired field is required'
                    }
                }
            },
            position_id: {
                validators: {
                    notEmpty: {
                        message: 'Position field is required'
                    }
                }
            },
            modal_email: {
                validators: {
                    notEmpty: {
                        message: 'Email field is required'
                    },
                    emailAddress: {
                        message: 'Input is not a valid email address'
                    }
                }
            },
            employment_status: {
                validators: {
                    notEmpty: {
                        message: 'Field is required'
                    }
                }
            }

        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                eleValidClass: '',
                // rowSelector: '.col-sm-6'
            }),
            autoFocus: new FormValidation.plugins.AutoFocus(),
            submitButton: new FormValidation.plugins.SubmitButton()
        },
        init: instance => {
            instance.on('plugins.message.placed', function (e) {
                if (e.element.parentElement.classList.contains('input-group')) {
                    e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                }
            });
        }
    }).on('core.form.valid', function (){ 
                showBlockUI();
                
                $.ajax({
                    url: `${BASE_URL}Employee/index`, // Ensure the correct URL for form submission
                    type: "POST",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                    hideBlockUI(); 
                    if(response.status) {
                      Swal.fire({
                      text: response.message,
                      icon: "success",
                      buttonsStyling: false,
                      confirmButtonText: "Ok, got it!",
                      customClass: {
                          confirmButton: "btn fw-bold btn-primary",
                      }
                      }).then(() => {
                      // Redirect to dashboard if needed
                  window.location.href = BASE_URL + 'Employee/index';
                      addForm.modal("hide");
                      dt.draw();
                      });
                  } else {
                      if(response.validation_errors) {
                      let html = '<div class="text-start">Please check the following fields:</br>';
                      html += '<ol>';
                      $.each(response.validation_errors, function(key, value) {
                          html += '<li><b>' + value['label'] + '</b> : ' + value['message'] + '</li>'
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
                  hideBlockUI();
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




  
    
    setTimeout(() => {
      $('.dataTables_filter .form-control').removeClass('form-control-sm');
      $('.dataTables_length .form-select').removeClass('form-select-sm');
    }, 300);
  });



