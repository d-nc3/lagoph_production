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
  var table = $('.datatables-roles'),
    select2 = $('.select2');

  // Select2

  
    if (table.length) {
        var dt = table.DataTable({
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            processing: true,
            serverSide: true,
            ajax: {
                url: `${BASE_URL}Admin/Role/dt_list`,
                type: "POST",
                data: function(d) {
                 
                }
            },
            column : [
                { data: null },
                { data: "role_name" },
                { data: "description" },
                { data: "created_at" },
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
              var $name = full['role_name'];
               
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
                  <div class="avatar avatar-sm me-2">
                    ${$output}
                  </div>
                </div>
                <div class="d-flex flex-column">
                  <a href="${BASE_URL}Employee/view/${full['id']}" class="text-body text-truncate"><span class="fw-medium name">${$name}</span></a>
                
                </div>
              </div>
              `;
              return $row_output;
          }
          },
          {
            targets: 2,
            render: function (data, type, full, meta) {
              var $position_title = full['description'];
              return '<span>' + $position_title + '</span>';
            }
          },
          {
            targets: 3,
            responsivePriority: 4,
            render: function (data, type, full, meta) {
                const formattedDate = moment(full.created_at).format('MMMM D, YYYY');
          
              return '<span>' + formattedDate + '</span>';
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
                '<span class="text-nowrap"><button class="btn btn-sm btn-icon me-2" data-id="' + full['id'] + '" data-bs-target="#editPermissionModal" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="bx bx-edit"></i></button>' +
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
              text: 'Add New User',
              
              className: 'add-new btn btn-primary mb-3 mb-md-0',
              attr: {
                'data-bs-toggle': 'modal',
                'data-bs-target': '#addPermissionModal'
              },
              init: function (api, node, config) {
                $(node).removeClass('btn-secondary');
              }
            }
          ],
        responsive: {
          details: {
            display: $.fn.dataTable.Responsive.display.modal({
              header: function (row) {
                var data = row.data();
                var $name =  data ['permission_name'];
                return 'Details of ' + $description;
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
        handleEditRows();
      });

      dt.on('responsive-display', function () {
       
        handleDeleteRows();
        handleEditRows();
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
                      url: `${BASE_URL}Admin/Role/delete`,
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

    //// Edit routine
  var handleEditRows = function () {
    // Select all delete buttons
    const editButtons = document.querySelectorAll('.edit-record');
    editButtons.forEach(d => {
        // Delete button on click
        d.addEventListener('click', function (e) {
            e.preventDefault();
            // Retrieve data-id
            const id = $(this).data('id');
            showBlockUI();
            $.ajax({
              url: `${BASE_URL}User_permissions/edit`, // Ensure the correct URL for form submission
              type: "POST",
              async: true,
              data: { id : id},
              dataType: 'json',
              success: function(response) {
                hideBlockUI(); 
                if(response) {
                  $('#edit-id').val(response.id);
                  $('#edit-name').val(response.permission_name);
                } else {
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
        })
    });
  }
  


  
    
    setTimeout(() => {
      $('.dataTables_filter .form-control').removeClass('form-control-sm');
      $('.dataTables_length .form-select').removeClass('form-select-sm');
    }, 300);
  });



