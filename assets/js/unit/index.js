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

  var offCanvassAdd = $('#offCanvassAdd')
    , offCanvassEdit = $('#offCanvassEdit');

  // Variable declaration for table
  var table = $('.datatables-unit'),
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

  if (select2.length) {
    select2.each(function () {
          var $this = $(this);
          $this.wrap('<div class="position-relative"></div>').select2({
              placeholder: 'Select Value',
              dropdownParent: $this.parent(),
          }); 
      });
  }

  if (table.length) {
    var dt = table.DataTable({
      lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]], 
      processing: true,
      serverSide: true,
      ajax: { 
        url: `${BASE_URL}Admin/Unit/dt_list`,
        type: "POST",
        data: function(d) {
          d.department_id = $("#filter-department-id").val();
        }
      },
      columns: [
        { data: null },
        { data: "department_name" },
        { data: "unit_name" },
        { data: "unit_head" },
        { data: "description" },
        { data: null },
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
          render: function (data, type, full, meta) {
            var $department_name = full['department_name'];
            return '<span>' + $department_name + '</span>';
          }
        },
        {
          targets: 2,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $unit_name = full['unit_name'];
            return '<span>' + $unit_name + '</span>';
          }
        },
        {
          targets: 3,
          render: function (data, type, full, meta) {
            var $unit_head = full['unit_head'];
            return '<span>' + $unit_head + '</span>';
          }
        },
        {
          targets: 4,
          render: function (data, type, full, meta) {
            var $description = full['description'];
            return '<span>' + $description + '</span>';
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
                '<a href="' + BASE_URL + 'Unit/view/' + full['id'] + '" class="btn btn-sm btn-icon" title="View item details"><i class="bx bx-show"></i></a>' +
                '<a href="javascript:;" class="btn btn-sm btn-icon edit-record" data-id="' + full['id'] + '" data-bs-toggle="offcanvas" data-bs-target="#offCanvassEdit" title="Edit item details"><i class="bx bx-edit"></i></a>' +
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
              title: "Departments",
              text: '<i class="bx bx-printer me-2" ></i>Print',
              className: "dropdown-item",
              exportOptions: {
                columns: [1, 2, 3, 4],
                format: {
                  body: function (inner, coldex, rowdex) {
                    return $(inner).text().trim();
                  }
                }
              }
            },
            {
              extend: "csv",
              title: "Departments",
              text: '<i class="bx bx-file me-2" ></i>Csv',
              className: "dropdown-item",
              exportOptions: {
                columns: [1, 2, 3, 4],
                format: {
                  body: function (inner, coldex, rowdex) {
                    return $(inner).text().trim();
                  }
                }
              }
            },
            {
              extend: "excel",
              title: "Departments",
              text: '<i class="bx bxs-file-export me-1"></i>Excel',
              className: "dropdown-item",
              exportOptions: {
                columns: [1, 2, 3, 4],
                format: {
                  body: function (inner, coldex, rowdex) {
                    return $(inner).text().trim();
                  }
                }
              }
            },
            {
              extend: "pdf",
              title: "Departments",    
              text: '<i class="bx bxs-file-pdf me-2"></i>Pdf',
              className: "dropdown-item",
              exportOptions: {
                columns: [1, 2, 3, 4],
                format: {
                  body: function (inner, coldex, rowdex) {
                    return $(inner).text().trim();
                  }
                }
              },
            },
            {
              extend: "copy",
              title: "Departments",
              text: '<i class="bx bx-copy me-2" ></i>Copy',
              className: "dropdown-item",
              exportOptions: {
                columns: [1, 2, 3, 4],
                format: {
                  body: function (inner, coldex, rowdex) {
                    return $(inner).text().trim();
                  }
                }
              }
            },

          ],
        },
        {
          text: '<i class="bx bx-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Add New</span>',
          className: 'add-new btn btn-primary',
          attr: {
            'data-bs-toggle': 'offcanvas',
            'data-bs-target': '#offCanvassAdd'
          }
        }
      ],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              var $name = data['unit_name'] ;
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
      handleEditRows();
      handleDeleteRows();
    });

    dt.on('responsive-display', function () {
      handleEditRows();
      handleDeleteRows();
    });
  }

  // Edit routine
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
              url: `${BASE_URL}Admin/Unit/get`, // Ensure the correct URL for form submission
              type: "POST",
              async: true,
              data: { id : id},
              dataType: 'json',
              success: function(response) {
                hideBlockUI(); 
                if(response) {
                  $('#edit-id').val(response.id);
                  $('#edit-department-id').val(response.department_id).trigger('change');
                  $('#edit-unit-name').val(response.unit_name);
                  $('#edit-unit-head').val(response.unit_head);
                  $('#edit-description').val(response.description);
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

  const editForm = document.getElementById('editForm');
  // Edit Form Validation
  const editFormValidation = FormValidation.formValidation(editForm, {
    fields: {
      department_id: {
        validators: {
          notEmpty: {
            message: 'This field is required'
          }
        }
      },
      unit_name: {
        validators: {
          notEmpty: {
            message: 'This field is required'
          }
        }
      },
      unit_head: {
        validators: {
          notEmpty: {
            message: 'This field is required'
          }
        }
      }
    },
    plugins: {
      trigger: new FormValidation.plugins.Trigger(),
      bootstrap5: new FormValidation.plugins.Bootstrap5({
        // Use this for enabling/changing valid/invalid class
        eleValidClass: 'is-valid',
        rowSelector: function (field, ele) {
          // field is the field name & ele is the field element
          return '.mb-3';
        }
      }),
      autoFocus: new FormValidation.plugins.AutoFocus()
    }
  });

  // Edit form event listener
  editForm.addEventListener('submit', function(event) {
    event.preventDefault();
    editFormValidation.validate().then(function(status) {
      if (status === 'Valid') {
        showBlockUI();
        $.ajax({
          url: `${BASE_URL}Admin/Unit/edit`, // Ensure the correct URL for form submission
          type: "POST",
          data: new FormData(editForm),
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
                offCanvassEdit.offcanvas("hide");
                dt.draw();
              });
            } else {
              if (Object.keys(response.validation_errors).length > 0) {
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
      }
    });
  });

  // Add routine
  const addform = document.getElementById('addForm');
  // Add New Form Validation
  const addFormValidation = FormValidation.formValidation(addform, {
    fields: {
      department_id: {
        validators: {
          notEmpty: {
            message: 'This field is required'
          }
        }
      },
      unit_name: {
        validators: {
          notEmpty: {
            message: 'This field is required'
          }
        }
      },
      unit_head: {
        validators: {
          notEmpty: {
            message: 'This field is required'
          }
        }
      }
    },
    plugins: {
      trigger: new FormValidation.plugins.Trigger(),
      bootstrap5: new FormValidation.plugins.Bootstrap5({
        // Use this for enabling/changing valid/invalid class
        eleValidClass: 'is-valid',
        rowSelector: function (field, ele) {
          // field is the field name & ele is the field element
          return '.mb-3';
        }
      }),
      autoFocus: new FormValidation.plugins.AutoFocus()
    }
  });
  // Add form event listener
  addform.addEventListener('submit', function(event) {
    event.preventDefault();
    addFormValidation.validate().then(function(status) {
      if (status === 'Valid') {
        showBlockUI();
        $.ajax({
          url: `${BASE_URL}Admin/Unit`, // Ensure the correct URL for form submission
          type: "POST",
          data: new FormData(addform),
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
                offCanvassAdd.offcanvas("hide");
                dt.draw();
              });
            } else {
              if (Object.keys(response.validation_errors).length > 0) {
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
      }
    });
  });

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
            const name = parent.querySelectorAll('td')[2].innerText;

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
                    url: `${BASE_URL}Unit/delete`,
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

  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);
});
