document.addEventListener("DOMContentLoaded", function () {
	window.Helpers.initCustomOptionCheck();

	const form = document.querySelector(".form-repeater");
	const save = document.querySelector(".btn-save");
	const paymentRecord = document.getElementById("payment");

	$(this).find(".select2-search").select2({
		placeholder: "Select an option",
		allowClear: true,
	});


	$("#paymentMode").on("change", function () {
		const selectedOption = $(this).val();
		updateValidation(selectedOption);
	});
	

	$("#paymentMethod").on("change", function () {
		const selectedOption = $(this).val();
		updateValidation(selectedOption);
	});
	
	
	const formValidation1 = FormValidation.formValidation(form, {
		fields: {
			// Add your validation rules for fields here
		},
		plugins: {
			trigger: new FormValidation.plugins.Trigger(),
			bootstrap5: new FormValidation.plugins.Bootstrap5({
				eleValidClass: "",
			}),
			autoFocus: new FormValidation.plugins.AutoFocus(),
			submitButton: new FormValidation.plugins.SubmitButton(),
		},
		init: (instance) => {
			instance.on("plugins.message.placed", function (e) {
				if (e.element.parentElement.classList.contains("input-group")) {
					e.element.parentElement.insertAdjacentElement(
						"afterend",
						e.messageElement
					);
				}
			});
		},
	}).on("core.form.valid", function () {});

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

		return FormValidation.formValidation(paymentRecord, {
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
				// // Ensure account_num and reference_no are validated for Bank Transfer
				// updateFormValidation.update("account_num", {
				// 	validators: {
				// 		notEmpty: {
				// 			message: "Account number is required for Bank Transfer",
				// 		},
				// 	},
				// });
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

	save.addEventListener("click", function (event) {
		event.preventDefault();
		console.log("button is clicked");

		Promise.all([
			formValidation1.validate(),
			updateFormValidation.validate(),
		]).then(function (results) {
			const [status1, status2] = results;

			if (status1 === "Valid" && status2 === "Valid") {
				// Create a new FormData object to hold combined data
				const formData = new FormData();

				new FormData(form).forEach((value, key) => {
					formData.append(key, value);
				});

				new FormData(paymentRecord).forEach((value, key) => {
					formData.append(key, value);
				});

				// Send the combined FormData via AJAX
				$.ajax({
					url: `${BASE_URL}Transaction/Transaction/payment`,
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

	const addItemDetailFields = function (field) {
		formValidation1.addField(field, {
			validators: {
				notEmpty: {
					message: "This field is required",
				},
			},
		});
	};
	addItemDetailFields("group-a[0][item_details]");
	addItemDetailFields("group-a[0][item_cost]");
	addItemDetailFields("group-a[0][item_quantiy]");
	addItemDetailFields("group-a[0][item_total]");
	addItemDetailFields("issued_by");


	var formRepeater = $(".form-repeater");
	var row = 2;
	var col = 1;

	formRepeater.repeater({
		// initEmpty: true,
		show: function () {
			var fromControl = $(this).find(".form-control, .form-select");
			var formLabel = $(this).find(".form-label");

			$(this).find(".form-select2").select2({
				placeholder: "Select an option",
				allowClear: true,
			});

			fromControl.each(function (i) {
				var id = "form-repeater-" + row + "-" + col;
				$(fromControl[i]).attr("id", id);
				$(formLabel[i]).attr("for", id);
				col++;
			});

			row++;

			$(this).slideDown();

			setTimeout(function () {
				$(".form-select2").select2();
			}, 0);

			const items = $(this).find(".items").attr("name");
			const price = $(this).find(".item-price").attr("name");
			const quantity = $(this).find(".item-qty").attr("name");
			const total = $(this).find(".total-price").attr("name");

			addItemDetailFields(items);
			addItemDetailFields(price);
			addItemDetailFields(quantity);
			addItemDetailFields(total);
		},
		ready: function () {
			$(".form-select2").select2();
		},
		hide: function (e) {
			confirm("Are you sure you want to delete this element?") &&
				$(this).slideUp(e);
		},
	});
});
