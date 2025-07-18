/**
 * Add Permission Modal JS
 */

"use strict";

document.addEventListener("DOMContentLoaded", function () {
	const modal = document.getElementById("addRoleModal");
	const addForm = document.getElementById("addRolePermissionModal"); // Assuming this is a Bootstrap modal
  const editForm = document.getElementById('editUserForm'); // Assuming this is a Bootstrap modal

	FormValidation.formValidation(addForm, {
		fields: {
        modalRoleName: {
        validators: {
          notEmpty: {
            message: 'Please enter Role name'
          }
        }
      },
      modalRoleName: {
				validators: {
					notEmpty: {
						message: "Please enter description for name",
					},
				},
			},
		},
		plugins: {
			trigger: new FormValidation.plugins.Trigger(),
			bootstrap5: new FormValidation.plugins.Bootstrap5({
				eleValidClass: "",
				rowSelector: ".col-md-12",
			}),
			submitButton: new FormValidation.plugins.SubmitButton(),
			autoFocus: new FormValidation.plugins.AutoFocus(),
		},
  }).on('core.form.valid', function () {
    showBlockUI();
    $.ajax({
      url: `${BASE_URL}Admin/User_roles/create`,
      type: "POST",
      data: new FormData(addForm),
      contentType: false,
      cache: false,
      processData: false,
      dataType: 'json',
      success: function (response) {
        hideBlockUI();
        if (response.status) {
          Swal.fire({
            text: response.message,
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
              confirmButton: "btn fw-bold btn-primary"
            }
          }).then(() => {
            window.location.href = BASE_URL + 'User_roles/index';
            addForm.modal("hide");
            dt.draw(); // Refresh DataTable if needed
          });
        } else {
          if (response.validation_errors) {
            let html = '<div class="text-start">Please check the following fields:</br><ol>';
            $.each(response.validation_errors, function (key, value) {
              html += `<li><b>${value.label}</b> : ${value.message}</li>`;
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
                confirmButton: "btn fw-bold btn-primary"
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
      error: function (xhr) {
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

  
// for edit function
    // Initialize form validation
   
	FormValidation.formValidation(editForm, {
		fields: {
        modalRoleName: {
        validators: {
          notEmpty: {
            message: 'Please enter Role name'
          }
        }
      },
      modalRoleName: {
				validators: {
					notEmpty: {
						message: "Please enter description for name",
					},
				},
			},
		},
		plugins: {
			trigger: new FormValidation.plugins.Trigger(),
			bootstrap5: new FormValidation.plugins.Bootstrap5({
				eleValidClass: "",
				rowSelector: ".col-md-12",
			}),
			submitButton: new FormValidation.plugins.SubmitButton(),
			autoFocus: new FormValidation.plugins.AutoFocus(),
		},
  }).on('core.form.valid', function () {
    showBlockUI();
    $.ajax({
      url: `${BASE_URL}User_roles/edit`,
      type: "POST",
      data: new FormData(editForm),
      contentType: false,
      cache: false,
      processData: false,
      dataType: 'json',
      success: function (response) {
        hideBlockUI();
        if (response.status) {
          Swal.fire({
            text: response.message,
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
              confirmButton: "btn fw-bold btn-primary"
            }
          }).then(() => {
            window.location.href = BASE_URL + 'User_roles/index';
      
          });
        } else {
          if (response.validation_errors) {
            let html = '<div class="text-start">Please check the following fields:</br><ol>';
            $.each(response.validation_errors, function (key, value) {
              html += `<li><b>${value.label}</b> : ${value.message}</li>`;
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
                confirmButton: "btn fw-bold btn-primary"
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
      error: function (xhr) {
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
});



var permissionsList = () => {
  return $.ajax({
      url: `${BASE_URL}User_roles_permissions/get_all`, 
      type: "GET",
      dataType: 'json'
  }).then(response => {
      hideBlockUI();
      return response || [];
  }).catch(xhr => {
      hideBlockUI();
      return [];
  });
};

permissionsList().then(permissionsList => {
  const permissions = document.querySelector('#modalPermission');
  
  let tagifyPermissions = new Tagify(permissions, {
    whitelist: permissionsList.map(permission => ({
      value: permission.permission_name,         // The actual value (id)
      // Displayed option
    })),
    maxTags: 10,
    dropdown: {
      maxItems: 20,
      classname: 'tags-inline',
      enabled: 0,
      closeOnSelect: false
    },
   
  });
});
