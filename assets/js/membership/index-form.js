'use strict';

(function () {
  // Init custom option check
  window.Helpers.initCustomOptionCheck();

  const flatpickrRange = document.querySelector('.flatpickr'),
    phoneMask = document.querySelector('.contact-number-mask'),
    p1Status = $('#civil_status'),
    plFurnishingDetailsSuggestionEl = document.querySelector('#plFurnishingDetails');

  // Phone Number Input Mask
  if (phoneMask) {
    new Cleave(phoneMask, {
      phone: true,
      phoneRegionCode: 'US'
    });
  }

  // select2 (Country)

  if (p1Status) {
    p1Status.wrap('<div class="position-relative"></div>');
    p1Status.select2({
      dropdownParent: p1Status.parent(),
      allowSearch: false,
    });
  }

  if (flatpickrRange) {
    flatpickrRange.flatpickr();
  }

  // Tagify (Furnishing details)
  const furnishingList = [
    'Fridge',
    'TV',
    'AC',
    'WiFi',
    'RO',
    'Washing Machine',
    'Sofa',
    'Bed',
    'Dining Table',
    'Microwave',
    'Cupboard'
  ];
  if (plFurnishingDetailsSuggestionEl) {
    const plFurnishingDetailsSuggestion = new Tagify(plFurnishingDetailsSuggestionEl, {
      whitelist: furnishingList,
      maxTags: 10,
      dropdown: {
        maxItems: 20,
        classname: 'tags-inline',
        enabled: 0,
        closeOnSelect: false
      }
    });
  }

  // Vertical Wizard
  // --------------------------------------------------------------------

  const wizardPropertyListing = document.querySelector('#wizard-property-listing');
  if (typeof wizardPropertyListing !== undefined && wizardPropertyListing !== null) {
    // Wizard form
    const wizardPropertyListingForm = wizardPropertyListing.querySelector('#wizard-property-listing-form');
    // Wizard steps
    const wizardPropertyListingFormStep1 = wizardPropertyListingForm.querySelector('#personal-details');
    const wizardPropertyListingFormStep2 = wizardPropertyListingForm.querySelector('#property-details');
    const wizardPropertyListingFormStep3 = wizardPropertyListingForm.querySelector('#property-features');
    const wizardPropertyListingFormStep4 = wizardPropertyListingForm.querySelector('#property-area');
    const wizardPropertyListingFormStep5 = wizardPropertyListingForm.querySelector('#price-details');
    // Wizard next prev button
    const wizardPropertyListingNext = [].slice.call(wizardPropertyListingForm.querySelectorAll('.btn-next'));
    const wizardPropertyListingPrev = [].slice.call(wizardPropertyListingForm.querySelectorAll('.btn-prev'));
    const wizardPropertyListingComment = [].slice.call(wizardPropertyListingForm.querySelectorAll('.yes_response'));

    const validationStepper = new Stepper(wizardPropertyListing, {
      linear: true
    });

    // Personal Details
    const FormValidation1 = FormValidation.formValidation(wizardPropertyListingFormStep1, {
      fields: {
        // * Validate the fields here based on your requirements
        first_name: {
          validators: {
            notEmpty: {
              message:'The first name field is required'
            }
          }
        },
        last_name: {
          validators: {
            notEmpty: {
              message: 'The last name field is required'
            }
          }
        },
        p1Contact: {
          validators: {
            notEmpty: {
              message: 'The Mobile Number field is required'
            }
          }
        },
        date_of_birth: {
          validators: {
            notEmpty: {
              message: 'Please select your date of birth'
            },
          } 
        },
       
        civil_status: {
          validators: {
              notEmpty: {
                  message: 'The civil status field is required'
              }
          }
      },
       place_of_birth: {
            validators: {
                notEmpty: {
                    message: 'The place of birth is required'
                }
            }
        },
        mobile_number: {
            validators: {
                notEmpty: {
                    message: 'The mobile number field is required'
                },
                numeric: {
                    message: 'The input must be a number'
                },
                stringLength: {
                    min: 11,
                    max: 11,
                    message: 'The mobile number must be exactly 11 digits'
                }
            }
        },
        address: {
          validators: {
            notEmpty: {
                message: 'The Address Field is required'
            },
        }
      },
      email_address: {
        validators: {
          notEmpty: {
              message: 'The email address field is required'
          },
          emailAddress: {
            message: 'The value is not a valid email address'
          }
        }
      }
    },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          // Use this for enabling/changing valid/invalid class
          // eleInvalidClass: '',
          eleValidClass: '',
          rowSelector: '.col-sm-6'
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()
      },
      init: instance => {
        instance.on('plugins.message.placed', function (e) {
          //* Move the error message out of the `input-group` element
          if (e.element.parentElement.classList.contains('input-group')) {
            e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
          }
        });
      }
    }).on('core.form.valid', function () {
      // Jump to the next step when all fields in the current step are valid
      validationStepper.next();
    });

    // Property Details
    const FormValidation2 = FormValidation.formValidation(wizardPropertyListingFormStep2, {
      fields: {
      
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          // Use this for enabling/changing valid/invalid class
          // eleInvalidClass: '',
          eleValidClass: '',
          rowSelector: function (field, ele) {
            // field is the field name & ele is the field element
            switch (field) {
              case 'plAddress':
                return '.col-lg-12';
              default:
                return '.col-sm-6';
            }
          }
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()
      }
    }).on('core.form.valid', function () {
      // Jump to the next step when all fields in the current step are valid
      validationStepper.next();
    });

    // select2 (Property type)
    const plPropertyType = $('#plPropertyType');
    if (plPropertyType.length) {
      plPropertyType.wrap('<div class="position-relative"></div>');
      plPropertyType
        .select2({
          placeholder: 'Select property type',
          dropdownParent: plPropertyType.parent()
        })
        .on('change', function () {
          // Revalidate the color field when an option is chosen
          FormValidation2.revalidateField('plPropertyType');
        });
    }

    // Property Features
    const FormValidation3 = FormValidation.formValidation(wizardPropertyListingFormStep3, {
      fields: {
       
        current_company: {
          validators: {
            notEmpty: {
              message: 'The current company field is required'
            }
          }
        },
       monthly_income:{
          validators: {
            notEmpty: {
              message: 'The monthly income field is required'
            }
          }
        }
      },
 
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          // Use this for enabling/changing valid/invalid class
          // eleInvalidClass: '',
          eleValidClass: '',
          rowSelector: '.col-sm-6'
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()
      }
    }).on('core.form.valid', function () {
      validationStepper.next();
    });

    // Property Area
    const FormValidation4 = FormValidation.formValidation(wizardPropertyListingFormStep4, {
      fields: {
        // * Validate the fields here based on your requirements
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          // Use this for enabling/changing valid/invalid class
          // eleInvalidClass: '',
          eleValidClass: '',
          rowSelector: '.col-md-12'
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()
      }
    }).on('core.form.valid', function () {
      // Jump to the next step when all fields in the current step are valid
      validationStepper.next();
    });

    
    // Price Details
    const FormValidation5 = FormValidation.formValidation(wizardPropertyListingFormStep5, {
      fields: {
        // * Validate the fields here based on your requirements
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          // Use this for enabling/changing valid/invalid class
          // eleInvalidClass: '',
          eleValidClass: '',
          rowSelector: '.col-md-12'
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()
      }
    }).on('core.form.valid', function () {
    });

    wizardPropertyListingNext.forEach(item => {
      item.addEventListener('click', event => {
        // When click the Next button, we will validate the current step
        switch (validationStepper._currentIndex) {
          case 0:
            FormValidation1.validate();
            break;

          case 1:
            FormValidation2.validate();
            break;

          case 2:
            FormValidation3.validate();
            break;

          case 3:
            FormValidation4.validate();
            break;

          case 4:
            FormValidation5.validate();
            break;

          default:
            break;
        }
      });
    });

    wizardPropertyListingPrev.forEach(item => {
      item.addEventListener('click', event => {
        switch (validationStepper._currentIndex) {
          case 4:
            validationStepper.previous();
            break;

          case 3:
            validationStepper.previous();
            break;

          case 2:
            validationStepper.previous();
            break;

          case 1:
            validationStepper.previous();
            break;

          case 0:

          default:
            break;
        }
      });
    });
  }
})();
