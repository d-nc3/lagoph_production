/**
 *  Page auth register multi-steps
 */

'use strict';

// Multi Steps Validation
// --------------------------------------------------------------------
document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    const stepsValidation = document.querySelector('#multiStepsValidation');

    if (typeof stepsValidation !== undefined && stepsValidation !== null) {
      const stepsValidationForm = stepsValidation.querySelector('#multiStepsForm');
      const stepsValidationFormStep1 = stepsValidationForm.querySelector('#accountValidation');
      const stepsValidationFormStep2 = stepsValidationForm.querySelector('#codeValidation');
      const stepsValidationNext = [].slice.call(stepsValidationForm.querySelectorAll('.btn-next'));
      const multiStepsCode = document.querySelector('.multi-steps-code');
      const btnResendCode = stepsValidation.querySelector('#multiStepsResendCode');

      // Code
      if (multiStepsCode) {
        new Cleave(multiStepsCode, {
          delimiter: '',
          numeral: true
        });
      }

      let validationStepper = new Stepper(stepsValidation, {
        linear: true
      });
    
      // Account details
      const multiSteps1 = FormValidation.formValidation(stepsValidationFormStep1, {
        fields: {
            multiStepsEmail: {
                validators: {
                notEmpty: {
                    message: 'This field is required'
                },
                emailAddress: {
                    message: 'The enter a valid email address'
                }
                }
            },
            multiStepsFirstname: {
                validators: {
                notEmpty:{
                  message: 'This Field is required'
                },
              },
            },
            multiStepsLastname: {
              validators: {
              notEmpty:{
                message: 'This Field is required'
              },
            },
          },
            multiStepsPass: {
                validators: {
                    notEmpty: {
                        message: 'This field is required'
                    },
                    stringLength: {
                        min: 6,
                        message: 'Password must be at least 6 characters long'
                    },
                    regexp: {
                        regexp: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+}{"':;?/>.<,])(?=.*[a-zA-Z]).{6,}$/,
                        message: 'Password must contain at least one uppercase letter, one lowercase letter, one number, one special character.'
                    }
                }
            },
            multiStepsConfirmPass: {
                validators: {
                    notEmpty: {
                        message: 'This field is required'
                    },
                    identical: {
                        compare: function () {
                            return stepsValidationForm.querySelector('[name="multiStepsPass"]').value;
                        },
                        message: 'The password and its confirm are not the same'
                    }
                }
            },
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            eleValidClass: '',
            rowSelector: function (field, ele) {
                switch (field) {
                  case 'multiStepsEmail':
                    return '.col-md-12';
                  case 'multiStepsPass':
                    return '.col-sm-6';
                  case 'multiStepsConfirmPass':
                    return '.col-sm-6';
                  default:
                    return '.row';
                }
              }
          }),
          autoFocus: new FormValidation.plugins.AutoFocus(),
        },
        init: instance => {
          instance.on('plugins.message.placed', function (e) {
            if (e.element.parentElement.classList.contains('input-group')) {
              e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
            }
          });
        }
      }).on('core.form.valid', function () {
        showBlockUI();
        $.ajax({
          url: `${BASE_URL}Register`,
          type: "POST",
          async: true,
          data: new FormData(stepsValidationForm),
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
                  console.log(response);
                  validationStepper.next();
  window.open(`${BASE_URL}Register/verification_link`, '_blank');

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
                    showCancelButton: true,
                    focusConfirm: true,
                    showCancelButton: false,
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

      // Personal info
      const multiSteps2 = FormValidation.formValidation(stepsValidationFormStep2, {
        fields: {
          multiStepsCode: {
            validators: {
              notEmpty: {
                  message: 'This field is required'
              },
              regexp: {
                regexp: /^\d{6}$/,
                message: 'Please enter a 6-digit code consisting of numbers only'
              }
            }
          },
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            eleValidClass: '',
            rowSelector: '.col-md-12'
          }),
          autoFocus: new FormValidation.plugins.AutoFocus(),
          submitButton: new FormValidation.plugins.SubmitButton()
        }
      }).on('core.form.valid', function () {
        showBlockUI();
        $.ajax({
          url: `${BASE_URL}Email/verify`,
          type: "POST",
          async: true,
          data: new FormData(stepsValidationForm),
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
                    window.location.href = BASE_URL + 'Auth/logout';
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
                    showCancelButton: true,
                    focusConfirm: true,
                    showCancelButton: false,
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
          error: function(error) {
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

      btnResendCode.addEventListener('click', event => {
        event.preventDefault();
        hideBlockUI(); 
        $.ajax({
          url: `${BASE_URL}Email/resend`,
          type: "POST",
          async: true,
          data: new FormData(stepsValidationForm),
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
                    showCancelButton: true,
                    focusConfirm: true,
                    showCancelButton: false,
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
          error: function(error) {
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

      stepsValidationNext.forEach(item => {
        item.addEventListener('click', event => {
          switch (validationStepper._currentIndex) {
            case 0:
              multiSteps1.validate();
              break;

            case 1:
              multiSteps2.validate();
              break;

            default:
              break;
          }
        });
      });
    }
  })();
});
