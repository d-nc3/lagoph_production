"use strict";

(function () {
	// Init custom option check
	window.Helpers.initCustomOptionCheck();

	const phoneMask = $(".mobile-number-mask"),
		telMask = document.querySelector(".tel-number-mask"),
		select2 = $(".select2"),
		select2Search = $(".select2-search");

	// Phone Number Input Mask
	if (phoneMask.length) {
		phoneMask.each(function () {
			var $this = $(this);
			new Cleave($this, {
				phone: true,
				phoneRegionCode: "US",
			});
		});
	}

	if (telMask) {
		new Cleave(telMask, {
			phone: true,
		});
	}

	// Select2 No Search
	if (select2.length) {
		select2.each(function () {
			var $this = $(this);
			$this.wrap('<div class="position-relative"></div>').select2({
				placeholder: "Select value",
				dropdownParent: $this.parent(),
				minimumResultsForSearch: -1,
			});
		});
	}

	// Select2 Search
	if (select2Search.length) {
		select2Search.each(function () {
			var $this = $(this);
			$this.wrap('<div class="position-relative"></div>').select2({
				placeholder: "Select value",
				dropdownParent: $this.parent(),
			});
		});
	}

	const multiStepsValidation = document.querySelector("#multiStepsValidation");
	if (
		typeof multiStepsValidation !== undefined &&
		multiStepsValidation !== null
	) {
		// Wizard form
		const form = multiStepsValidation.querySelector("#form");
		// Wizard steps
		const multiStepsValidationFormStep1 =
				multiStepsValidation.querySelector("#personal-details"),
			multiStepsValidationFormStep2 = multiStepsValidation.querySelector(
				"#beneficiary-details"
			),
			multiStepsValidationFormStep3 = multiStepsValidation.querySelector(
				"#educational-details"
			),
			multiStepsValidationFormStep4 = multiStepsValidation.querySelector(
				"#employment-details"
			),
			multiStepsValidationFormStep5 =
				multiStepsValidation.querySelector("#other-details"),
			multiStepsValidationFormStep6 = multiStepsValidation.querySelector(
				"#attachment-details"
			),
			multiStepsValidationFormStep7 = multiStepsValidation.querySelector(
				"#oath-of-membership"
			),
			multiStepsValidationFormStep8 = multiStepsValidation.querySelector(
				"#oath-of-contribution"
			),
			multiStepsValidationFormStep9 = multiStepsValidation.querySelector(
				"#membership-details"
			),
			multiStepsValidationFormStep10 =
				multiStepsValidation.querySelector("#review-details");

		// Wizard next prev button
		const multiStepsValidationNext = [].slice.call(
				form.querySelectorAll(".btn-next")
			),
			multiStepsValidationPrev = [].slice.call(
				form.querySelectorAll(".btn-prev")
			);

		const validationStepper = new Stepper(multiStepsValidation, {
			linear: false,
		});

		// Personal Details
		const FormValidation1 = FormValidation.formValidation(
			multiStepsValidationFormStep1,
			{
				fields: {
					first_name: {
						validators: {
							notEmpty: {
								message: "This field is required",
							},
						},
					},
					last_name: {
						validators: {
							notEmpty: {
								message: "This field is required",
							},
						},
					},
					sex: {
						validators: {
							notEmpty: {
								message: "This field is required",
							},
						},
					},
					date_of_birth: {
						callback: {
							message: "You must be at least 18 years old",
							callback: function (value, validator, $field) {
								if (!value) {
									return false; // Not valid if empty
								}
								const dob = new Date(value);
								const age = calculateAge(dob);
								return age >= 18; // Returns true if age is 18 or older
							},
						},
					},
					civil_status: {
						validators: {
							notEmpty: {
								message: "This field is required",
							},
						},
					},
					place_of_birth: {
						validators: {
							notEmpty: {
								message: "This field is required",
							},
						},
					},
					mobile_number: {
						validators: {
							notEmpty: {
								message: "This field is required",
							},
							stringLength: {
								min: 12,
								max: 12,
								message: "The value is not a valid mobile number",
							},
						},
					},
					address: {
						validators: {
							notEmpty: {
								message: "This field is required",
							},
						},
					},
					tel_number: {
						validators: {
							stringLength: {
								min: 8,
								max: 8,
								message: "The value is not a valid telephone number",
							},
						},
					},
					email: {
						validators: {
							notEmpty: {
								message: "This field is required",
							},
							emailAddress: {
								message: "The value is not a valid email address",
							},
						},
					},
					spouse_mobile_number: {
						validators: {
							stringLength: {
								min: 12,
								max: 12,
								message: "The value is not a valid mobile number",
							},
						},
					},
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap5: new FormValidation.plugins.Bootstrap5({
						// Use this for enabling/changing valid/invalid class
						// eleInvalidClass: '',
						eleValidClass: "",
						rowSelector: ".col-sm-6",
					}),
					autoFocus: new FormValidation.plugins.AutoFocus(),
					submitButton: new FormValidation.plugins.SubmitButton(),
				},
				init: (instance) => {
					instance.on("plugins.message.placed", function (e) {
						//* Move the error message out of the `input-group` element
						if (e.element.parentElement.classList.contains("input-group")) {
							e.element.parentElement.insertAdjacentElement(
								"afterend",
								e.messageElement
							);
						}
					});
				},
			}
		).on("core.form.valid", function () {
			showBlockUI();
			$.ajax({
				url: `${BASE_URL}Membership/personal-data`,
				type: "POST",
				async: true,
				data: new FormData(form),
				contentType: false,
				cache: false,
				processData: false,
				dataType: "json",
				success: function (response) {
					hideBlockUI();
					if (response.status) {
						validationStepper.next();
					} else {
						if (Object.keys(response.validation_errors).length > 0) {
							let html =
								'<div class="text-start">Please check the following fields:</br>';
							html += "<ol>";
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
								showCancelButton: true,
								focusConfirm: true,
								showCancelButton: false,
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
		});

		// Beneficiary Details
		const FormValidation2 = FormValidation.formValidation(
			multiStepsValidationFormStep2,
			{
				fields: {},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap5: new FormValidation.plugins.Bootstrap5({
						eleValidClass: "",
						// rowSelector: '.col-sm-6'
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
			}
		).on("core.form.valid", function () {
			showBlockUI();
			$.ajax({
				url: `${BASE_URL}Membership/beneficiaries`,
				type: "POST",
				async: true,
				data: new FormData(form),
				contentType: false,
				cache: false,
				processData: false,
				dataType: "json",
				success: function (response) {
					hideBlockUI();
					if (response.status) {
						validationStepper.next();
					} else {
						if (Object.keys(response.validation_errors).length > 0) {
							let html =
								'<div class="text-start">Please check the following fields:</br>';
							html += "<ol>";
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
								showCancelButton: true,
								focusConfirm: true,
								showCancelButton: false,
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
		});

		const beneficiariesFormRepeater = $(".beneficiaries-form-repeater");
		const beneficiariesRptr = document.querySelector(
			".beneficiaries-form-repeater"
		);
		const beneficiariesList = document.getElementById("beneficiaries-list");
		if (beneficiariesFormRepeater.length) {
			var row = 2;
			var col = 1;

			beneficiariesFormRepeater.repeater({
				show: function () {
					const repeaterList = beneficiariesRptr.querySelector(
						'[data-repeater-list="beneficiaries"]'
					);
					const repeaterItems = repeaterList.querySelectorAll(
						"[data-repeater-item]"
					);
					const itemCount = repeaterItems.length;
					if (itemCount > 3) {
						alert("You can only add up to 3 entries.");
						return;
					}
					var fromControl = $(this).find(".form-control, .form-select");
					var formLabel = $(this).find(".form-label");

					fromControl.each(function (i) {
						var id = "beneficiaries-form-repeater-" + row + "-" + col;
						$(fromControl[i]).attr("id", id);
						$(formLabel[i]).attr("for", id);
						col++;
					});

					row++;
					$(this).slideDown();
					checkRepeaterEntries();
					const name = $(this).find(".name").attr("name");
					const dob = $(this).find(".dob").attr("name");
					const rel = $(this).find(".rel").attr("name");
					addBeneficiaryFields(name);
					addBeneficiaryFields(dob);
					addBeneficiaryFields(rel);
					populateBeneficiariesReview();
				},
				hide: function (e) {
					confirm("Are you sure you want to delete this element?") &&
						$(this).slideUp(e, function () {
							const name = $(this).find(".name").attr("name");
							const dob = $(this).find(".dob").attr("name");
							const rel = $(this).find(".rel").attr("name");
							removeBeneficiaryFields(name);
							removeBeneficiaryFields(dob);
							removeBeneficiaryFields(rel);
							$(this).remove();
							checkRepeaterEntries();
							FormValidation2.resetForm(); // Reset form validation to update the fields
							populateBeneficiariesReview();
						});
				},
			});

			function checkRepeaterEntries() {
				const repeaterList = beneficiariesRptr.querySelector(
					'[data-repeater-list="beneficiaries"]'
				);
				const entryCount = repeaterList.querySelectorAll(
					"[data-repeater-item]"
				).length;
				if (entryCount >= 3) {
					$("[data-repeater-create]").prop("disabled", true);
					$("[data-repeater-create]").prop("hidden", true);
				} else {
					$("[data-repeater-create]").prop("disabled", false);
					$("[data-repeater-create]").prop("hidden", false);
				}
			}

			const addBeneficiaryFields = function (field) {
				FormValidation2.addField(field, {
					validators: {
						notEmpty: {
							message: "This field is required",
						},
					},
				});
			};

			const removeBeneficiaryFields = function (field) {
				FormValidation2.removeField(field);
			};

			checkRepeaterEntries();
			addBeneficiaryFields("beneficiaries[0][name]");
			addBeneficiaryFields("beneficiaries[0][date_of_birth]");
			addBeneficiaryFields("beneficiaries[0][relationship_type]");
		}

		// Educational Details
		const FormValidation3 = FormValidation.formValidation(
			multiStepsValidationFormStep3,
			{
				fields: {},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap5: new FormValidation.plugins.Bootstrap5({
						// Use this for enabling/changing valid/invalid class
						// eleInvalidClass: '',
						eleValidClass: "",
						rowSelector: ".col-sm-6",
					}),
					autoFocus: new FormValidation.plugins.AutoFocus(),
					submitButton: new FormValidation.plugins.SubmitButton(),
				},
				init: (instance) => {
					instance.on("plugins.message.placed", function (e) {
						//* Move the error message out of the `input-group` element
						if (e.element.parentElement.classList.contains("input-group")) {
							e.element.parentElement.insertAdjacentElement(
								"afterend",
								e.messageElement
							);
						}
					});
				},
			}
		).on("core.form.valid", function () {
			showBlockUI();
			$.ajax({
				url: `${BASE_URL}Membership/educational_background`,
				type: "POST",
				async: true,
				data: new FormData(form),
				contentType: false,
				cache: false,
				processData: false,
				dataType: "json",
				success: function (response) {
					hideBlockUI();
					if (response.status) {
						validationStepper.next();
					} else {
						if (Object.keys(response.validation_errors).length > 0) {
							let html =
								'<div class="text-start">Please check the following fields:</br>';
							html += "<ol>";
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
								showCancelButton: true,
								focusConfirm: true,
								showCancelButton: false,
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
		});

		// Employment Details
		const FormValidation4 = FormValidation.formValidation(
			multiStepsValidationFormStep4,
			{
				fields: {
					"work_experience[0][employment_status]": {
						validators: {
							notEmpty: {
								message: "This field is required",
							},
						},
					},
					"work_experience[0][office_company]": {
						validators: {
							notEmpty: {
								message: "This field is required",
							},
						},
					},
					"work_experience[0][occupation_designation]": {
						validators: {
							notEmpty: {
								message: "This field is required",
							},
						},
					},
					"work_experience[0][salary_income]": {
						validators: {
							notEmpty: {
								message: "This field is required",
							},
						},
					},
					"work_experience[0][tel_number]": {
						validators: {
							notEmpty: {
								message: "This field is required",
							},
						},
					},
					"work_experience[0][address]": {
						validators: {
							notEmpty: {
								message: "This field is required",
							},
						},
					},
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap5: new FormValidation.plugins.Bootstrap5({
						// Use this for enabling/changing valid/invalid class
						// eleInvalidClass: '',
						eleValidClass: "",
						// rowSelector: '.col-sm-6'
					}),
					autoFocus: new FormValidation.plugins.AutoFocus(),
					submitButton: new FormValidation.plugins.SubmitButton(),
				},
				init: (instance) => {
					instance.on("plugins.message.placed", function (e) {
						//* Move the error message out of the `input-group` element
						if (e.element.parentElement.classList.contains("input-group")) {
							e.element.parentElement.insertAdjacentElement(
								"afterend",
								e.messageElement
							);
						}
					});
				},
			}
		).on("core.form.valid", function () {
			showBlockUI();
			$.ajax({
				url: `${BASE_URL}Membership/work_experience`,
				type: "POST",
				async: true,
				data: new FormData(form),
				contentType: false,
				cache: false,
				processData: false,
				dataType: "json",
				success: function (response) {
					hideBlockUI();
					if (response.status) {
							validationStepper.next();
					} else {
						if (Object.keys(response.validation_errors).length > 0) {
							let html =
								'<div class="text-start">Please check the following fields:</br>';
							html += "<ol>";
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
								showCancelButton: true,
								focusConfirm: true,
								showCancelButton: false,
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
		});

		// Other Details
		const FormValidation5 = FormValidation.formValidation(
			multiStepsValidationFormStep5,
			{
				fields: {
					has_admin_offense: {
						validators: {
							notEmpty: {
								message: "This field is required",
							},
						},
					},
					admin_offense: {
						validators: {
							callback: {
								message: "This field is required",
								callback: function (input) {
									const selectedOption = form.querySelector(
										'[name="has_admin_offense"]:checked'
									);
									const has_admin_offense = selectedOption
										? selectedOption.value
										: "";
									return has_admin_offense !== "Yes"
										? true
										: input.value !== "";
								},
							},
						},
					},
					is_convicted: {
						validators: {
							notEmpty: {
								message: "This field is required",
							},
						},
					},
					convicted: {
						validators: {
							callback: {
								message: "This field is required",
								callback: function (input) {
									const selectedOption = form.querySelector(
										'[name="is_convicted"]:checked'
									);
									const is_convicted = selectedOption
										? selectedOption.value
										: "";
									return is_convicted !== "Yes" ? true : input.value !== "";
								},
							},
						},
					},
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap5: new FormValidation.plugins.Bootstrap5({
						// Use this for enabling/changing valid/invalid class
						// eleInvalidClass: '',
						eleValidClass: "",
						// rowSelector: '.col-sm-6'
					}),
					autoFocus: new FormValidation.plugins.AutoFocus(),
					submitButton: new FormValidation.plugins.SubmitButton(),
				},
				init: (instance) => {
					instance.on("plugins.message.placed", function (e) {
						//* Move the error message out of the `input-group` element
						if (e.element.parentElement.classList.contains("input-group")) {
							e.element.parentElement.insertAdjacentElement(
								"afterend",
								e.messageElement
							);
						}
					});
				},
			}
		).on("core.form.valid", function () {
			showBlockUI();
			$.ajax({
				url: `${BASE_URL}Membership/administrative_offense`,
				type: "POST",
				async: true,
				data: new FormData(form),
				contentType: false,
				cache: false,
				processData: false,
				dataType: "json",
				success: function (response) {
					hideBlockUI();
					if (response.status) {
						validationStepper.next();
					} else {
						if (Object.keys(response.validation_errors).length > 0) {
							let html =
								'<div class="text-start">Please check the following fields:</br>';
							html += "<ol>";
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
								showCancelButton: true,
								focusConfirm: true,
								showCancelButton: false,
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
		});

		const otherDetails = document.querySelector("#other-details");
		const hasAdminOffense = [].slice.call(
			otherDetails.querySelectorAll('[name="has_admin_offense"]')
		);
		hasAdminOffense.map(function (option) {
			option.addEventListener("click", function (e) {
				let value = this.value;
				toggleHasOffenseBox(value);
			});
		});

		function toggleHasOffenseBox(value) {
			const hasOffenseBox = document.querySelector(".has-offense");
			if (value === "Yes") {
				document.getElementById("review-has-admin-offense").innerText = "Yes. ";
				hasOffenseBox.classList.remove("d-none");
			} else {
				document.getElementById("review-has-admin-offense").innerText = "No. ";
				hasOffenseBox.classList.add("d-none");
			}
		}

		const isConvicted = [].slice.call(
			otherDetails.querySelectorAll('[name="is_convicted"]')
		);
		isConvicted.map(function (option) {
			option.addEventListener("click", function (e) {
				let value = this.value;
				toggleIsConvictedBox(value);
			});
		});

		function toggleIsConvictedBox(value) {
			const isConvictedBox = document.querySelector(".is-convicted");
			if (value === "Yes") {
				document.getElementById("review-is-convicted").innerText = "Yes. ";
				isConvictedBox.classList.remove("d-none");
			} else {
				document.getElementById("review-is-convicted").innerText = "No. ";
				isConvictedBox.classList.add("d-none");
			}
		}

		// Attachment Details
		const FormValidation6 = FormValidation.formValidation(
			multiStepsValidationFormStep6,
			{
				fields: {
					"attachments[proof_of_identity]": {
						validators: {
							notEmpty: {
								message: "This field is required",
							},
							file: {
								extension: "jpg,jpeg", // Allow both jpg and jpeg files
								type: "image/jpeg,image/jpg",
								message: "Please choose a jpg or jpeg file",
							},
						},
					},
					"attachments[proof_of_dob]": {
						validators: {
							notEmpty: {
								message: "This field is required",
							},
							file: {
								extension: "jpg,jpeg,pdf", // Allow jpg, jpeg, and pdf files
								type: "image/jpeg,application/pdf",
								maxSize: 5 * 1024 * 1024, // Optional: set max file size to 5MB
								message: "Please choose a valid file (jpg, jpeg, or pdf)",
							},
						},
					},
					"attachments[proof_of_addr]": {
						validators: {
							notEmpty: {
								message: "This field is required",
							},
							file: {
								extension: "jpg,jpeg,pdf", // Allow jpg, jpeg, and pdf files
								type: "image/jpeg,application/pdf",
								maxSize: 5 * 1024 * 1024, // Optional: set max file size to 5MB
								message: "Please choose a valid file (jpg, jpeg, or pdf)",
							},
						},
					},
					"attachments[profile_pic]": {
						validators: {
							notEmpty: {
								message: "This field is required",
							},
							file: {
								extension: "jpg,jpeg", // Allow both jpg and jpeg files
								type: "image/jpeg,image/jpg",
								message: "Please choose a jpg or jpeg file",
							},
						},
					},
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap5: new FormValidation.plugins.Bootstrap5({
						// Use this for enabling/changing valid/invalid class
						// eleInvalidClass: '',
						eleValidClass: "",
						rowSelector: ".col-12",
					}),
					autoFocus: new FormValidation.plugins.AutoFocus(),
					submitButton: new FormValidation.plugins.SubmitButton(),
				},
				init: (instance) => {
					instance.on("plugins.message.placed", function (e) {
						//* Move the error message out of the `input-group` element
						if (e.element.parentElement.classList.contains("input-group")) {
							e.element.parentElement.insertAdjacentElement(
								"afterend",
								e.messageElement
							);
						}
					});
				},
			}
		).on("core.form.valid", function () {
			
			validationStepper.next();
		});

		const FormValidation7 = FormValidation.formValidation(
			multiStepsValidationFormStep7,
			{
				fields: {
					terms_checkbox: {
						validators: {
							notEmpty: {
								message: "This field is required",
							},
						},
					},
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap5: new FormValidation.plugins.Bootstrap5({
						// Use this for enabling/changing valid/invalid class
						// eleInvalidClass: '',
						eleValidClass: "",
						// rowSelector: '.col-sm-6'
					}),
					autoFocus: new FormValidation.plugins.AutoFocus(),
					submitButton: new FormValidation.plugins.SubmitButton(),
				},
				init: (instance) => {
					instance.on("plugins.message.placed", function (e) {
						//* Move the error message out of the `input-group` element
						if (e.element.parentElement.classList.contains("input-group")) {
							e.element.parentElement.insertAdjacentElement(
								"afterend",
								e.messageElement
							);
						}
					});
				},
			}
		).on("core.form.valid", function () {
			// Jump to the next step when all fields in the current step are valid
			validationStepper.next();
		});

		// Utility function to add event listeners
		const addEventListeners = (element, events, handler) => {	
			events.forEach((event) => element.addEventListener(event, handler));
		};

		const updateCalculations = () => {
			const shareFrequency =
				parseInt(document.getElementById("shareFrequency").value, 10) || 0;
			const amount =
				parseInt(document.getElementById("shareAmount").value, 10) || 0;
			const contributionAmount =
				parseInt(document.getElementById("contributionAmount").value, 10) || 0;
			console.log(shareFrequency);
			console.log(amount);
			console.log(contributionAmount);
			const totalCapitalContribution = shareFrequency * amount; //total
			console.log(totalCapitalContribution);
			const remainingBalance = totalCapitalContribution - contributionAmount;

			updateDOM(totalCapitalContribution);
		};

		const updateDOM = (totalCapitalContribution) => {
			console.log(document.getElementById("total_capital_contribution"));
			console.log(document.getElementById("total_conteibution_display"));
			document.getElementById("total_capital_contribution_display").innerText =
				totalCapitalContribution.toFixed(2);
			document.getElementById("total_capital_contribution").value =
				totalCapitalContribution.toFixed(2);
		};

		// Initialize input listeners for calculations
		const initCalculationListeners = () => {
			const elements = [
				document.getElementById("shareFrequency"),
				document.getElementById("shareAmount"),
				document.getElementById("contributionAmount"),
			];

			elements.forEach((element) => {
				if (element) {
					addEventListeners(element, ["input", "change"], updateCalculations);
				}
			});
		};
		initCalculationListeners();

		const FormValidation8 = FormValidation.formValidation(
			multiStepsValidationFormStep8,
			{
				fields: {
					terms_checkbox: {
						validators: {
							notEmpty: {
								message: "This field is required",
							},
						},
					},
					share_frequency: {
						validators: {
							notEmpty: {},
						},
					},
					share_amount: {
						validators: {
							notEmpty: {},
						},
					},
					subscribed_amount: {
						validators: {
							notEmpty: {},
						},
					},
					contribution_amount: {
						validators: {
							callback: {
								message: "Invalid Amount",
								callback: function (input) {
									const value = input.value;
									if (value >= 1000) {
										return true;
									}
									return false;
								},
							},
						},
					},
				},

				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap5: new FormValidation.plugins.Bootstrap5({
						// Use this for enabling/changing valid/invalid class
						// eleInvalidClass: '',
						eleValidClass: "",
						// rowSelector: '.col-sm-6'
					}),
					autoFocus: new FormValidation.plugins.AutoFocus(),
					submitButton: new FormValidation.plugins.SubmitButton(),
				},
				init: (instance) => {
					instance.on("plugins.message.placed", function (e) {
						e.messageElement.remove();
					});
				},
			}
		).on("core.form.valid", function () {
			// Jump to the next step when all fields in the current step are valid
			validationStepper.next();
		});

		const FormValidation9 = FormValidation.formValidation(
			multiStepsValidationFormStep9,
			{
				fields: {
					"attachments[pmes]": {
						validators: {
							notEmpty: {
								message: "This field is required",
							},
							file: {
								extension: "jpg,jpeg,pdf", // Allow jpg, jpeg, and pdf files
								type: "image/jpeg,application/pdf",
								maxSize: 5 * 1024 * 1024, // Optional: set max file size to 5MB
								message: "Please choose a valid file (jpg, jpeg, or pdf)",
							},
						},
					},
					c_payment_method: {
						validators: {
							notEmpty: {
								message: "This field is required",
							},
						},
					},
					m_payment_method: {
						validators: {
							notEmpty: {
								message: "This field is required",
							},
						},
					},
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap5: new FormValidation.plugins.Bootstrap5({
						// Use this for enabling/changing valid/invalid class
						// eleInvalidClass: '',
						eleValidClass: "",
						rowSelector: ".col-12",
					}),
					autoFocus: new FormValidation.plugins.AutoFocus(),
					submitButton: new FormValidation.plugins.SubmitButton(),
				},
				init: (instance) => {
					instance.on("plugins.message.placed", function (e) {
						//* Move the error message out of the `input-group` element
						if (e.element.parentElement.classList.contains("input-group")) {
							e.element.parentElement.insertAdjacentElement(
								"afterend",
								e.messageElement
							);
						}
					});
				},
			}
		).on("core.form.valid", function () {
			validationStepper.next();
		});

		let updateFormValidation;
		function updateValidation(selectedOption) {
			// Add or update fields based on the selected option
			switch (selectedOption) {
				case "11":
				case "22":
				case "2":
					updateFormValidation.addField("c_payment_amount", {
						validators: {
							notEmpty: {
								message: "Field is required",
							},
						},
					});
					updateFormValidation.addField("attachments[membership_receipt]", {
						validators: {
							notEmpty: {
								message: "Field is required",
							},
						},
					});
					updateFormValidation.addField("attachments[contribution-receipt]", {
						validators: {
							notEmpty: {
								message: "Field is required",
							},
						},
					});
					updateFormValidation.addField("m_payment_amount", {
						validators: {
							notEmpty: {
								message: "Field is required",
							},
						},
					});
					updateFormValidation.addField("m_payment_amount", {
						validators: {
							notEmpty: {
								message: "Field is required",
							},
						},
					});
					updateFormValidation.addField("m_reference_number", {
						validators: {
							notEmpty: {
								message: "Field is required",
							},
						},
					});
					updateFormValidation.addField("c_reference_number", {
						validators: {
							notEmpty: {
								message: "Field is required",
							},
						},
					});
					break;

				default:
					break;
			}
		}

		if (multiStepsValidationFormStep9) {
			updateFormValidation = FormValidation9;

			// Monitor the payment method selection
			$("#m_payment_method").on("change", function () {
				const selectedPaymentMethod = $(this).val();
				updateValidation(selectedPaymentMethod);
			});

			$("#contributionPaymentMethod").on("change", function () {
				const selectedPaymentMethod = $(this).val();
				updateValidation(selectedPaymentMethod);
			});
		}

		// Attachment Details
		const FormValidation10 = FormValidation.formValidation(
			multiStepsValidationFormStep10,
			{
				fields: {
					terms: {
						validators: {
							notEmpty: {
								message: "This field is required",
							},
						},
					},
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap5: new FormValidation.plugins.Bootstrap5({
						// Use this for enabling/changing valid/invalid class
						// eleInvalidClass: '',
						eleValidClass: "",
						// rowSelector: '.col-sm-6'
					}),
					autoFocus: new FormValidation.plugins.AutoFocus(),
					submitButton: new FormValidation.plugins.SubmitButton(),
				},
				init: (instance) => {
					instance.on("plugins.message.placed", function (e) {
						//* Move the error message out of the `input-group` element
						if (e.element.parentElement.classList.contains("input-group")) {
							e.element.parentElement.insertAdjacentElement(
								"afterend",
								e.messageElement
							);
						}
					});
				},
			}
		).on("core.form.valid", function () {
			showBlockUI();
			$.ajax({
				url: `${BASE_URL}Membership/form`,
				type: "POST",
				async: true,
				data: new FormData(form),
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
							window.location.href = BASE_URL + "Membership";
						});
					} else {
						if (Object.keys(response.validation_errors).length > 0) {
							let html =
								'<div class="text-start">Please check the following fields:</br>';
							html += "<ol>";
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
								showCancelButton: true,
								focusConfirm: true,
								showCancelButton: false,
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
		});

		const email = document.getElementById("review-email");
		email.value = $("#email").val() ? $("#email").val() : "";

		function updateReviewField(
			inputId,
			reviewId,
			formatter = (value) => value
		) {
			document.getElementById(inputId).addEventListener("blur", function () {
				const reviewField = document.getElementById(reviewId);
				reviewField.value = this.value ? formatter(this.value) : "";
			});
		}

		// Update fields directly
		const fieldMappings = [
			{ inputId: "firstName", reviewId: "review-fname" },
			{ inputId: "lastName", reviewId: "review-lname" },
			{ inputId: "middleName", reviewId: "review-mname" },
			{
				inputId: "mobileNo",
				reviewId: "review-mobile-no",
				formatter: (value) => `+63 ${value}`,
			},
			{ inputId: "address", reviewId: "review-address" },
			{ inputId: "telNo", reviewId: "review-tel-no" },
			{ inputId: "spouseName", reviewId: "review-spouse-name" },
			{
				inputId: "spouseMobileNo",
				reviewId: "review-spouse-tel-no",
				formatter: (value) => `+63 ${value}`,
			},
			{ inputId: "spouseOccupation", reviewId: "review-spouse-occupation" },
			{ inputId: "educ-background-1-course", reviewId: "review-1-course" },
			{ inputId: "educ-background-1-school", reviewId: "review-1-school" },
			{ inputId: "educ-background-2-course", reviewId: "review-2-course" },
			{ inputId: "educ-background-2-school", reviewId: "review-2-school" },
			{ inputId: "educ-background-3-course", reviewId: "review-3-course" },
			{ inputId: "educ-background-3-school", reviewId: "review-3-school" },
			{ inputId: "educ-background-4-course", reviewId: "review-4-course" },
			{ inputId: "educ-background-4-school", reviewId: "review-4-school" },
			{ inputId: "educ-background-5-course", reviewId: "review-5-course" },
			{ inputId: "educ-background-5-school", reviewId: "review-5-school" },
			{ inputId: "work-exp-1-office", reviewId: "review-work-current" },
			{
				inputId: "work-exp-1-occupation",
				reviewId: "review-work-current-occupation",
			},
			{ inputId: "work-exp-1-income", reviewId: "review-work-current-salary" },
			{ inputId: "work-exp-1-tel-no", reviewId: "review-work-current-tel-no" },
			{ inputId: "work-exp-1-addr", reviewId: "review-work-current-addr" },
			{ inputId: "work-exp-2-office", reviewId: "review-work-prev" },
			{
				inputId: "work-exp-2-occupation",
				reviewId: "review-work-prev-occupation",
			},
			{ inputId: "work-exp-2-income", reviewId: "review-work-prev-salary" },
			{ inputId: "work-exp-2-tel-no", reviewId: "review-work-prev-tel-no" },
			{ inputId: "work-exp-2-addr", reviewId: "review-work-prev-addr" },
		];

		fieldMappings.forEach((mapping) => {
			updateReviewField(mapping.inputId, mapping.reviewId, mapping.formatter);
		});

		// Special case for birth date
		document.getElementById("birthDate").addEventListener("blur", function () {
			const monthNames = [
				"January",
				"February",
				"March",
				"April",
				"May",
				"June",
				"July",
				"August",
				"September",
				"October",
				"November",
				"December",
			];
			const birthDate = document.getElementById("review-dob");
			if (this.value) {
				const convertedDate = new Date(this.value);
				birthDate.value = `${
					monthNames[convertedDate.getMonth()]
				} ${convertedDate.getDate()}, ${convertedDate.getFullYear()}`;
			} else {
				birthDate.value = "";
			}
		});

		// Event listeners for select2 elements
		$("#civilStatus").on("select2:select", function (e) {
			const selectedValue = e.params.data.id;
			const civilStatus = document.getElementById("review-civil-status");
			civilStatus.value = selectedValue;

			FormValidation1.revalidateField("civil_status");
		});

		$("#birthPlace").on("select2:select", function (e) {
			const selectedValue = e.params.data.id;
			const birthPlace = document.getElementById("review-pob");
			birthPlace.value = selectedValue;

			FormValidation1.revalidateField("place_of_birth");
		});

		// Event listener for sex options
		document.querySelectorAll('[name="sex"]').forEach((option) => {
			option.addEventListener("click", function () {
				const sex = document.getElementById("review-sex");
				sex.value = this.value ? this.value : "";
			});
		});

		// Event listener for administrative offense and convicted fields
		document
			.getElementById("admin_offense")
			.addEventListener("blur", function () {
				const offense = document.getElementById("review-admin-offense");
				offense.innerText = this.value ? this.value : "";
			});

		document.getElementById("convicted").addEventListener("blur", function () {
			const convicted = document.getElementById("review-covicted");
			convicted.innerText = this.value ? this.value : "";
		});

		// Listen for changes in form repeater
		document.addEventListener("input", function (event) {
			if (event.target.closest('[data-repeater-list="beneficiaries"]')) {
				populateBeneficiariesReview();
			}
		});

		const sexOptions = [].slice.call(document.querySelectorAll('[name="sex"]'));
		sexOptions.map(function (option) {
			option.addEventListener("click", function (e) {
				const sex = document.getElementById("review-sex");
				sex.value = this.value ? this.value : "";
			});
		});

		document.getElementById("birthDate").addEventListener("blur", function () {
			const monthNames = [
				"January",
				"February",
				"March",
				"April",
				"May",
				"June",
				"July",
				"August",
				"September",
				"October",
				"November",
				"December",
			];
			const birthDate = document.getElementById("review-dob");
			if (this.value) {
				const convertedDate = new Date(this.value);
				birthDate.value = `${
					monthNames[convertedDate.getMonth()]
				} ${convertedDate.getDate()}, ${convertedDate.getFullYear()}`;
			} else {
				birthDate.value = "";
			}
		});

		const populateBeneficiariesReview = function () {
			beneficiariesList.innerHTML = "";
			const repeaterList = beneficiariesRptr.querySelector(
				'[data-repeater-list="beneficiaries"]'
			);
			const repeaterItems = repeaterList.querySelectorAll(
				"[data-repeater-item]"
			);
			repeaterItems.forEach(function (repeaterItem) {
				const name = $(repeaterItem).find(".name").val();
				const dateOfBirth = $(repeaterItem).find(".dob").val();
				const relationshipType = $(repeaterItem).find(".rel").val();

				if (name && dateOfBirth && relationshipType) {
					const listItem = document.createElement("li");
					listItem.innerHTML = `<div class="row g-1 mb-2">
                        <div class="col-md-5">
                            <div class="input-group input-group-sm">
                            <span class="input-group-text"><b>Name</b></span>
                            <input type="text" id="review-spouse-name" class="form-control" value="${name}" disabled />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group input-group-sm">
                            <span class="input-group-text"><b>Date of Birth</b></span>
                            <input type="text" id="review-spouse-occupation" class="form-control" value="${dateOfBirth}" disabled />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group input-group-sm">
                            <span class="input-group-text"><b>Relationship</b></span>
                            <input type="text" id="review-spouse-tel-no" class="form-control" value="${relationshipType}" disabled />
                            </div>
                        </div>
                    </div>`;
					beneficiariesList.appendChild(listItem);
				}
			});
		};

		multiStepsValidationNext.forEach((item) => {
			item.addEventListener("click", (event) => {
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
					case 7:
						FormValidation8.validate();
					case 8:
						FormValidation9.validate();
					case 9:
						FormValidation10.validate();
					default:
						break;
				}
			});
		});

		multiStepsValidationPrev.forEach((item) => {
			item.addEventListener("click", (event) => {
				switch (validationStepper._currentIndex) {
					case 9:
						validationStepper.previous();
						break;
					case 8:
						validationStepper.previous();
						break;
					case 7:
						validationStepper.previous();
						break;
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

		// Helper function to calculate age
		function calculateAge(dob) {
			var today = new Date();
			var birthDate = new Date(dob);
			var age = today.getFullYear() - birthDate.getFullYear();
			var m = today.getMonth() - birthDate.getMonth();
			if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
				age--;
			}
			return age;
		}
	}
})();
