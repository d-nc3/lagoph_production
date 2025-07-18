'use strict';

(function () {

    // Utility function to add event listeners
    const addEventListeners = (element, events, handler) => {
        events.forEach(event => element.addEventListener(event, handler));
    };

    const creditAmount = 10000;

    // Function to calculate and update capital contributions
    const updateCalculations = () => {
        const paymentFrequency = parseInt(document.getElementById('paymentSchedule').value, 10 || 0);
        const loanAmount = parseInt(document.getElementById('loanAmount').value, 10  || 0);
       
        const fixedInterest = 225;
        const serviceFee = 250;
        const tableBody = document.getElementById('tableBody');
        if (!tableBody) {
         console.log("No table body")
            return;
        }
        console.log("Table Body!")
        tableBody.innerHTML = '';

        const totalCredit = creditAmount + fixedInterest + serviceFee;
        let remainingBalance;

        for (let i = 0; i < paymentFrequency; i++) {
            const currentAmount = creditAmount / paymentFrequency;
            remainingBalance = Math.max(0, totalCredit - currentAmount);

            const row = document.createElement('tr');
            row.innerHTML = `
                <td><p>${i + 1}</p></td>
                <td>${currentAmount}</td>
                <td><p>${currentAmount.toFixed(2)}</p></td>`;
            tableBody.appendChild(row);

            if (remainingBalance === 0) break;
        }

        // updateDOM(totalCapitalContribution, remainingBalance, contributionAmount);
    };

    // Function to update DOM elements with calculated values
    const updateDOM = (totalCapitalContribution, remainingBalance, contributionAmount) => {
        const balance = totalCapitalContribution - contributionAmount;
        document.getElementById('totalContribution').value = totalCapitalContribution.toFixed(2);
        document.getElementById('total_capital_contribution').textContent = totalCapitalContribution.toFixed(2);
        document.getElementById('balance').textContent = balance.toFixed(2);
        document.getElementById('total').textContent = balance.toFixed(2);
        document.getElementById('total-1').textContent = balance.toFixed(2);
        document.getElementById('total-2').textContent = balance.toFixed(2);
   
    };

    // Initialize input listeners for calculations
    const initCalculationListeners = () => {
        const elements = [
            document.getElementById('payment_schedule'),
            document.getElementById('loan_amount'),
           
        ];

        elements.forEach(element => {
            if (element) {
                addEventListeners(element, ['input', 'change'], updateCalculations);
            }
        });
    };

   

        const quotationValidation = document.querySelector('#quotation-checkout');
        if (typeof quotationValidation !== 'undefined' && quotationValidation !== null) {
          
            const form = quotationValidation.querySelector('#quotation-checkout-form');
            
            const quotationValidationFormStep1 = form.querySelector('#quotation-details'),
            quotationValidationFormStep2 = form.querySelector('#quotation-payment');            
            const quotationValidationNext = [].slice.call(form.querySelectorAll('.btn-next')),
            quotationValidationPrev = [].slice.call(form.querySelectorAll('.btn-prev'));

            const validationStepper = new Stepper(quotationValidation, {
                linear: true,
                animation: true
            });
            
      
            const FormValidation1 = FormValidation.formValidation(quotationValidationFormStep1, {
                fields: {
                    shareAmount: {
                        validators: {
                            notEmpty: {
                                message:'This field is required'
                            }
                        }
                    },
                    shareFrequency: {
                        validators: {
                            notEmpty: {
                                message:'This field is required'
                            }
                        }
                    },
                    contributionAmount: {
                        validators: {
                            notEmpty: {
                        message:'This field is required'
                    }
                }
            },
        },plugins: {
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

        // Beneficiary Details
        const FormValidation2 = FormValidation.formValidation(quotationValidationFormStep2, {
          fields: {
            terms_checkbox: {
              validators: { 
                isEmpty: {
                  message:'This field is required'
                }
              }
            }
        }, plugins: {
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
        }).on('core.form.valid', function () {
        showBlockUI();
        $.ajax({
        url: `${BASE_URL}Invoice_capital_contribution/generate_billing_capital`,
        type: "POST",
        async: true,
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
                    window.location.reload();
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
  
        quotationValidationNext.forEach(item => {
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
                    case 5:
                        FormValidation6.validate();
                        break;
                    case 6:
                        FormValidation7.validate();
                        break;
                    default:
                        break;
                }
            });
        });
      
        quotationValidationPrev.forEach(item => {
            item.addEventListener('click', event => {
                switch (validationStepper._currentIndex) {
                    case 6:
                        validationStepper.previous();
                        break;
                    case 5:
                        validationStepper.previous();
                        break;
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
                    default:
                        break;
                }
            });
        });



    }

    
    initCalculationListeners();
})();