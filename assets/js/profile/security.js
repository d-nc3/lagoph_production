$(function () {

    const form = document.getElementById('invoice_form');
    const button = document.querySelector('.data-submit');
   
    const update_calculations = function() {
   
    const no_of_shares = parseInt(document.getElementById('no_of_shares').value, 10) || 0;
    // Calculate the capital contribution and balance
    const amount = parseInt(document.getElementById('amount_per_share').value, 10) || 0;
    const capital_contribution = no_of_shares * amount;
    const contribution_amount = parseInt(document.getElementById('contribution_amount').value, 10) || 0;
  
  
    // Get the table body element
    const tableBody = document.getElementById('tableBody');
    tableBody.innerHTML = '';
  
  
   // Initialize the total capital contribution (this is the initial balance)
   let totalCapitalContribution = no_of_shares * amount;
   let remainingBalance = totalCapitalContribution  - contribution_amount;
  
   for (let i = 0; i < no_of_shares; i++) {
    
       const currentAmount = amount;
       const newBalance = remainingBalance - currentAmount;
       const difference = remainingBalance - newBalance;
       remainingBalance = newBalance;
  
       if (remainingBalance < 0) {
           remainingBalance = 0;
       }
  
       // Create and append the new row
       const row = document.createElement('tr');
       row.innerHTML = `
           <td>${currentAmount}</td>
           <td><p>${i + 2}</p></td>
           <td><p>${remainingBalance}</p></td>
       `;
       tableBody.appendChild(row);
       
       if (remainingBalance === 0) {
           break;
       }
   }
  
   const balance = totalCapitalContribution - contribution_amount;
  
   // Update the total capital contribution and balance in the DOM
   document.getElementById('total_capital_contribution').textContent = totalCapitalContribution;
   document.getElementById('balance').textContent = balance;
   document.getElementById('total').textContent = balance;
  }
    // Attach the event listener to both 'input' and 'change' events
    const noOfSharesElement = document.getElementById('no_of_shares');
    noOfSharesElement.addEventListener('input', update_calculations);
    noOfSharesElement.addEventListener('change', update_calculations);
  
    // Optionally, if 'amount_per_share' and 'contribution_amount' should also trigger updates, attach listeners to them as well
    const amountPerShareElement = document.getElementById('amount_per_share');
    const contributionAmountElement = document.getElementById('contribution_amount');
  
    
    amountPerShareElement.addEventListener('input', update_calculations);
    amountPerShareElement.addEventListener('change', update_calculations);
  
  
    contributionAmountElement.addEventListener('input', update_calculations);
    contributionAmountElement.addEventListener('change', update_calculations);
  
    const fv = FormValidation.formValidation(form, {
        fields: {
            contirbution_amount: {
                validators: {
                    notEmpty: {
                        message: 'Field  is required'
                    }
                }
            },
            no_of_share : {
                validators: {
                    notEmpty: {
                        message: 'Field  is required'
                    }
                }
            },
            amount_per_share: {
                validators: {
                    notEmpty: {
                        message: 'Field  is required'
                    }
                }
            }
            
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                eleValidClass: ''
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
    }); 
    
        button.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default button behavior
    
        fv.validate().then(function (status) {
            if (status === 'Valid') {
                // Form is valid, proceed with AJAX submission
                showBlockUI();
                
                $.ajax({
                    url: `${BASE_URL}Cashiering/invoice_add`, // Ensure the correct URL for form submission
                    type: "POST",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        hideBlockUI();
                        if (response.status) {
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
                                window.location.href = BASE_URL + 'capital_invoice';
                                
                            });
                        } else {
                            let html = '<div class="text-start">Please check the following fields:</br>';
                            html += '<ol>';
                            if (response.validation_errors) {
                                $.each(response.validation_errors, function(key, value) {
                                    html += '<li><b>' + value['label'] + '</b> : ' + value['message'] + '</li>';
                                });
                            }
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
            } else {
                // Form is invalid
                Swal.fire({
                    text: "Please correct the errors in the form and try again.",
                    icon: "warning",
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
  
    // This function serves as then display for the modal of terms and agreement
    
  