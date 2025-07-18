

(function () {
   
const paymentForm = document.getElementById('payment-form');
var select2 = $('.select2-search');
if (select2.length) {
    select2.each(function () {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>').select2({
            placeholder: 'Select value',
            dropdownParent: $this.parent(),
            allowClear: true,
        }); 
    });
}

function initializeFormValidation(form, fields) {
    return FormValidation.formValidation(form, {
        fields: fields,
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                eleValidClass: 'is-valid',
                rowSelector: function () { return '.mb-3'; }
            }),
            autoFocus: new FormValidation.plugins.AutoFocus()
        }
    });
}

    // Common function for AJAX requests
    function handleFormSubmission(formValidationInstance, formElement, url) {
        formValidationInstance.validate().then(function(status) {
            if (status === 'Valid') {
                showBlockUI();
    
                $.ajax({
                    url: url,
                    type: "POST",
                    data: new FormData(formElement),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        hideBlockUI();
    
                        Swal.fire({
                            title: 'Payment Confirmation',
                            text: "Please confirm that you want to complete this payment.",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, Confirm Payment',
                            cancelButtonText: 'Cancel',
                            customClass: {
                                confirmButton: 'btn btn-primary me-2',
                                cancelButton: 'btn btn-label-secondary'
                            },
                            buttonsStyling: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                handleAjaxSuccess(response);
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        hideBlockUI();
                        handleAjaxError(xhr.responseJSON || { message: "Something went wrong." });
                    }
                });
            }
        });
    }
    

// Handle success response
function handleAjaxSuccess(response) {
    hideBlockUI();
    if (response.status) {
        Swal.fire({
            text: response.message,
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: { confirmButton: "btn fw-bold btn-primary" }
        }).then(() => {
            window.location.reload();
        });
    } else {
        handleErrors(response);
    }
}

// Handle general AJAX error
function handleAjaxError() {
    hideBlockUI();
    Swal.fire({
        text: "Sorry, looks like there are some errors detected, please try again.",
        icon: "error",
        buttonsStyling: false,
        confirmButtonText: "Ok, got it!",
        customClass: { confirmButton: "btn btn-primary" }
    });
}

// Common function to handle validation errors
function handleErrors(response) {
    if (Object.keys(response.validation_errors).length > 0) {
        let html = '<div class="text-start">Please check the following fields:</br><ol>';
        $.each(response.validation_errors, function(key, value) {
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
            customClass: { confirmButton: "btn fw-bold btn-primary" },
            buttonsStyling: false
        });
    } else {
        Swal.fire({
            text: response.message,
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: { confirmButton: "btn btn-primary" }
        });
    }
}

function initializeValidation() {
    const fields = {
        'attachments[membership_receipt]': {
            validators: {
                notEmpty: { message: 'This field is required' },
                file: {
                    extension: 'jpg,jpeg',
                    type: 'image/jpeg,image/jpg',
                    message: 'Please choose a jpg or jpeg file'
                }
            }
        },
        details: {
            validators: {
                notEmpty: { message: 'This field is required' }
            }
        },
        payment_date: {
            validators: {
                notEmpty: { message: 'This field is required' }
            }
        },
        total_payment: {
            validators: {
                notEmpty: { message: 'This field is required' }
            }
        },
        payment_options: {
            validators: {
                notEmpty: { message: 'This field is required' }
            }
        }
    };

    // Dynamically add validators based on visibility
    if ($("#paymentMethod").is(":visible")) {
        fields.payment_method = {
            validators: {
                notEmpty: { message: "E-wallet field is required" }
            }
        };
    }
    if ($("#referenceNo").is(":visible")) {
        fields.reference_no = {
            validators: {
                notEmpty: { message: "Reference number is required" }
            }
        };
    }
    if ($("#accountNum").is(":visible")) {
        fields.account_num = {
            validators: {
                notEmpty: { message: "Account number is required" }
            }
        };
    }
    if ($("#accNameContainer").is(":visible")) {
        fields.account_name = {
            validators: {
                notEmpty: { message: "Account name is required" }
            }
        };
    }

    return FormValidation.formValidation(paymentForm, {
        fields: fields,
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                eleValidClass: "is-valid",
                rowSelector: function (field, ele) { return ".mb-3"; }
            }),
            autoFocus: new FormValidation.plugins.AutoFocus()
        }
    });
}

// Initialize validation
let formValidation = initializeValidation();

function updateValidation(selectedOption) {
    // Dynamically add/remove validators based on the selected option
    switch (selectedOption) {
        case "2": // Bank Transfer
            formValidation.addField("account_num", {
                validators: {
                    notEmpty: {
                        message: "Account number is required for Bank Transfer"
                    }
                }
            });
            formValidation.addField("reference_no", {
                validators: {
                    notEmpty: {
                        message: "Reference number is required for Bank Transfer"
                    }
                }
            });
            break;

        default:
            formValidation.removeField("account_num");
            formValidation.removeField("reference_no");
            break;
    }
}

// Attach event listener to payment method select (assuming it has ID 'paymentMethod')
document.getElementById('paymentMethod').addEventListener('change', function() {
    const selectedOption = this.value;
    updateValidation(selectedOption);
});

// Attach submit event listener
document.getElementById('submitPayment').addEventListener('click', function(event) {
    event.preventDefault();
    handleFormSubmission(formValidation, paymentForm, `${BASE_URL}Payment/upload_receipt`);
});

})();