(function () {
	const paymentForm = document.getElementById("paymentForm");
	var select2 = $(".select2-search");
	if (select2.length) {
		select2.each(function () {
			var $this = $(this);
			$this.wrap('<div class="position-relative"></div>').select2({
				placeholder: "Select value",
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
					eleValidClass: "is-valid",
					rowSelector: function () {
						return ".mb-3";
					},
				}),
				autoFocus: new FormValidation.plugins.AutoFocus(),
			},
		});
	}

	// Common function for AJAX requests
	function handleFormSubmission(formValidationInstance, formElement, url) {
		formValidationInstance.validate().then(function (status) {
			if (status === "Valid") {
				showBlockUI();
				$.ajax({
					url: url,
					type: "POST",
					data: new FormData(formElement),
					contentType: false,
					cache: false,
					processData: false,
					dataType: "json",
					success: handleAjaxSuccess,
					error: handleAjaxError,
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
				customClass: { confirmButton: "btn fw-bold btn-primary" },
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
			customClass: { confirmButton: "btn btn-primary" },
		});
	}

	// Common function to handle validation errors
	function handleErrors(response) {
		if (Object.keys(response.validation_errors).length > 0) {
			let html =
				'<div class="text-start">Please check the following fields:</br><ol>';
			$.each(response.validation_errors, function (key, value) {
				html += `<li><b>${value.label}</b> : ${value.message}</li>`;
			});
			html += "</ol></div>";
			Swal.fire({
				title: response.message,
				icon: "error",
				html: html,
				showCloseButton: true,
				focusConfirm: true,
				confirmButtonText: "Ok, got it!",
				customClass: { confirmButton: "btn fw-bold btn-primary" },
				buttonsStyling: false,
			});
		} else {
			Swal.fire({
				text: response.message,
				icon: "error",
				buttonsStyling: false,
				confirmButtonText: "Ok, got it!",
				customClass: { confirmButton: "btn btn-primary" },
			});
		}
	}
	function initializeValidation() {
		const fields = {
			"attachments[payment-receipt]": {
				validators: {
					notEmpty: { message: "This field is required" },
					file: {
						extension: "jpg,jpeg",
						type: "image/jpeg,image/jpg",
						message: "Please choose a jpg or jpeg file",
					},
				},
			},
			payment_details: {
				validators: {
					notEmpty: { message: "This field is required" },
				},
			},
			payment_date: {
				validators: {
					notEmpty: { message: "This field is required" },
				},
			},
			total_payment: {
				validators: {
					notEmpty: { message: "This field is required" },
				},
			},
			payment_mode: {
				validators: {
					notEmpty: { message: "This field is required" },
				},
			},
			payment_method: {
				validators: {
					notEmpty: { message: "This field is required" },
				},
			},
		};

		return FormValidation.formValidation(paymentForm, {
			fields: fields,
			plugins: {
				trigger: new FormValidation.plugins.Trigger(),
				bootstrap5: new FormValidation.plugins.Bootstrap5({
					eleValidClass: "is-valid",
					rowSelector: function (field, ele) {
						return ".mb-3";
					},
				}),
				autoFocus: new FormValidation.plugins.AutoFocus(),
			},
		});
	}

	// Initialize form validation on load
	function updateValidation(selectedOption) {
		// Dynamically add fields based on the selected payment method
		switch (selectedOption) {
			case "2": // Bank Transfer
				updateFormValidation.addField("account_number", {
					validators: {
						notEmpty: {
							message: "Account number is required",
						},
					},
				});
				updateFormValidation.addField("reference_number", {
					validators: {
						notEmpty: {
							message: "Reference number is required",
						},
					},
				});
				updateFormValidation.addField("account_name", {
					validators: {
						notEmpty: {
							message: "Reference number is required",
						},
					},
				});
				break;
			case "11": // Bank Transfer
				updateFormValidation.addField("account_number", {
					validators: {
						notEmpty: {
							message: "Account number is requiredr",
						},
					},
				});
				updateFormValidation.addField("reference_number", {
					validators: {
						notEmpty: {
							message: "Reference number is required ",
						},
					},
				});
				updateFormValidation.addField("account_name", {
					validators: {
						notEmpty: {
							message: "Reference number is required",
						},
					},
				});
				break;

			default:
				break;
		}
	}

	if (paymentForm) {
		// Initialize validation
		updateFormValidation = initializeValidation();

		// Handle payment method change dynamically
		$("#paymentMethod").on("change", function () {
			const selectedOption = $(this).val();
			console.log(selectedOption); // Log for debugging
			updateValidation(selectedOption);
		});

		// Attach submit event listener to the form
		paymentForm.addEventListener("submit", function (event) {
			event.preventDefault();

			// Validate the form
			updateFormValidation.validate().then(function (status) {
				if (status === "Valid") {
					// Form is valid, handle the submission
					handleFormSubmission(
						updateFormValidation,
						paymentForm,
						`${BASE_URL}Loans/Loan/payment`
					);
				} else {
					// Form is not valid, handle accordingly (e.g., show an error message)
					console.error("Form validation failed");
				}
			});
		});
	}
})();
