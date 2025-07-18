
	// Function to initialize validation for currently visible fields
	function initializeValidation() {
		const fields = {
			payment_mode: {
				validators: {
					notEmpty: {
						message: "This field is required",
					},
				},
			},
			payment_status: {
				validators: {
					notEmpty: {
						message: "This field is required",
					},
				},
			},
			total_payment: {
				validators: {
					notEmpty: {
						message: "This field is required",
					},
				},
			},
		};

		// Add additional fields based on visibility
		if ($("#paymentMethod").is(":visible")) {
			fields.payment_method = {
				validators: {
					notEmpty: {
						message: "E-wallet field is required",
					},
				},
			};
		}
        if ($("#endDate").is(":visible")) {
			fields.endDate = {
				validators: {
					notEmpty: {
						message: "field is required",
					},
				},
			};
		}
        if ($("#startDate").is(":visible")) {
			fields.start_date = {
				validators: {
					notEmpty: {
						message: "field is required",
					},
				},
			};
		}
		// Add additional fields based on visibility
		if ($("#referenceNo").is(":visible")) {
			fields.reference_no = {
				validators: {
					notEmpty: {
						message: "Reference number is required",
					},
				},
			};
		}

		if ($("#accountNum").is(":visible")) {
			fields.account_num = {
				validators: {
					notEmpty: {
						message: "Account number is required",
					},
				},
			};
		}

		if ($("#accNameContainer").is(":visible")) {
			fields.account_name = {
				validators: {
					notEmpty: {
						message: "Account name is required",
					},
				},
			};
		}

		return FormValidation.formValidation(form, {
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

	let updateFormValidation = initializeValidation();

	function updateValidation(selectedOption) {
		// Reset validation for dynamic fields
		updateFormValidation.destroy(); // Destroy previous instance
		updateFormValidation = initializeValidation(); // Re-initialize validation

		switch (selectedOption) {
			case "2": // Bank Transfer
				// Ensure account_num and reference_no are validated for Bank Transfer
				updateFormValidation.update("account_num", {
					validators: {
						notEmpty: {
							message: "Account number is required for Bank Transfer",
						},
					},
				});
				updateFormValidation.update("reference_no", {
					validators: {
						notEmpty: {
							message: "Reference number is required for Gcash",
						},
					},
				});
				break;

			default:
				break;
		}
	}

	document.querySelector(".save").addEventListener("click", function (event) {
        event.preventDefault();
        console.log("Submit button clicked");
    

		Promise.all([
			updateFormValidation.validate(),
		]).then(function (results) {
			const status2 = results;

			if (status1 === "Valid" && status2 === "Valid") {
				// Create a new FormData object to hold combined data
				const formData = new FormData();

				new FormData(form).forEach((value, key) => {
					formData.append(key, value);
				});

				// Send the combined FormData via AJAX
				$.ajax({
					url: `${BASE_URL}Transaction/payment`,
					type: "POST",
					data: formData,
					contentType: false,
					cache: false,
					processData: false,
					dataType: "json",
					success: function (response) {
						hideBlockUI();
						if (response.status) {
							Swal.fire({
								text: response.message,
								icon: "success",
								buttonsStyling: false,
								confirmButtonText: "Ok, got it!",
								customClass: {
									confirmButton: "btn fw-bold btn-primary",
								},
							}).then(() => {
								window.location.reload();

							});
						} else {
							if (Object.keys(response.validation_errors).length > 0) {
								let html =
									'<div class="text-start">Please check the following fields:</br><ol>';
								$.each(response.validation_errors, function (key, value) {
									html +=
										"<li><b>" +
										value["label"] +
										"</b> : " +
										value["message"] +
										"</li>";
								});
								html += "</ol></div>";
								Swal.fire({
									title: response.message,
									icon: "error",
									html: html,
									showCloseButton: true,
									confirmButtonText: "Ok, got it!",
									customClass: {
										confirmButton: "btn fw-bold btn-primary",
									},
									buttonsStyling: false,
								});
							} else {
								Swal.fire({
									text: response.message,
									icon: "error",
									buttonsStyling: false,
									confirmButtonText: "Ok, got it!",
									customClass: {
										confirmButton: "btn btn-primary",
									},
								});
							}
						}
					},
					error: function (error) {
						hideBlockUI();
						Swal.fire({
							text: "Sorry, looks like there are some errors detected, please try again.",
							icon: "error",
							buttonsStyling: false,
							confirmButtonText: "Ok, got it!",
							customClass: {
								confirmButton: "btn btn-primary",
							},
						});
					},
				});
			}
		});
	});
