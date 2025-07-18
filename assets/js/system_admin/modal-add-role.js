/**
 * Add Permission Modal JS
 */

'use strict';

document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('addPermissionForm');

 

  // Initialize form validation
  FormValidation.formValidation(form, {
    fields: {
        modalRoleName: {
        validators: {
          notEmpty: {
            message: 'Please enter Role name'
          }
        }
      },
      modalDescription: {
        validators: {
          notEmpty: {
            message: 'Please enter description for name'
          }
        }
      }
    },
    plugins: {
      trigger: new FormValidation.plugins.Trigger(),
      bootstrap5: new FormValidation.plugins.Bootstrap5({
        eleValidClass: '',
        rowSelector: '.col-12'
      }),
      submitButton: new FormValidation.plugins.SubmitButton(),
      autoFocus: new FormValidation.plugins.AutoFocus()
    }
  }).on('core.form.valid', function () {
    showBlockUI();
    $.ajax({
      url: `${BASE_URL}Role/create_role`,
      type: "POST",
      data: new FormData(form),
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
            window.location.href = BASE_URL + 'Role/index';
          
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