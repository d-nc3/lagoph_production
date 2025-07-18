"use strict";

(function () {
	// Utility function to add event listeners
	const addEventListeners = (element, events, handler) => {
		events.forEach((event) => element.addEventListener(event, handler));
	};

	function formatNumberWithCommas(number) {
		return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}

	// Function to calculate and update capital contributions
	const updateCalculations = () => {
		const paymentSchedule = document.getElementById("paymentSchedule").value;
		const amount =
			parseInt(document.getElementById("loanAmount").value, 10) || 0;

		const fixedInterest = amount * 0.0225 * paymentSchedule;

		const serviceCharge = amount * 0.025;

		const tableBody = document.getElementById("tableBody");
		if (!tableBody) return;

		tableBody.innerHTML = "";

		let remainingBalance;

		for (let i = 0; i < paymentSchedule; i++) {
			remainingBalance = Math.round(
				(amount + fixedInterest + serviceCharge) / paymentSchedule
			).toFixed(3);

			const row = document.createElement("tr");
			row.innerHTML = `
                <td><p>${i + 1}</p></td>
                <td> PHP ${formatNumberWithCommas(remainingBalance)}</td>`;

			tableBody.appendChild(row);
		}
		updateDOM(fixedInterest, amount, serviceCharge, remainingBalance);
	};

	const getAccounts = () => {
		$.ajax({
			url: `${BASE_URL}Profile/getCards`, // create a function in the controller to get the data
			type: "GET",
			dataType: "json",
			success: function (accounts) {
				fetchAccounts(accounts);
			},
			error: function (xhr, status, error) {
				console.error("Error Fetching Data: ", error);
			},
		});
	};

	// Fetch accounts from the backend and populate the modal
	function fetchAccounts(accounts) {
		const accountList = document.getElementById("accountList");
		accountList.innerHTML = ""; // Clear previous entries

		accounts.forEach((account) => {
			const li = document.createElement("li");
			li.className =
				"list-group-item d-flex justify-content-between align-items-center";
			li.style.cursor = "pointer";
			li.dataset.id = account.id;

			// Set innerHTML properly
			li.innerHTML = `
				
					<div class="p-3 d-flex align-items-center">
						<!-- Avatar -->
						<div class="avatar me-3">
							<div class="avatar-initial rounded-circle border d-flex align-items-center justify-content-center" 
								style="width: 50px; height: 50px; border: 2px solid #ADD8E6; background-color: #ffffff;">
								<img class="img-fluid"
									style="max-width: 80%; max-height: 80%; object-fit: contain; border-radius: 50%;"
									src="assets/img/icons/payments/${account.financial_service_provider}.png"
									alt="${account.financial_service_provider}" />
							</div>
						</div>
						<!-- Account Information -->
						<div>
							<div class="fw-bold">${account.account_name}</div>
							<small class="text-muted">${account.account_number}</small>
				
						</div>
					</div>
				`;

			// Add click event to select account
			li.addEventListener("click", () => {
				document.getElementById("selectAccount").innerHTML = `
				<div class="p-3 d-flex align-items-center">
        <div class="avatar-initial rounded-circle border d-flex align-items-center justify-content-center"
            style="width: 50px; height: 50px; border: 2px solid #ADD8E6; background-color: #ffffff;">
            <img class="img-fluid"
                style="width: 80%; height: 80%; object-fit: contain; border-radius: 50%;"
                src="assets/img/icons/payments/${account.financial_service_provider}.png"
                alt="${account.financial_service_provider}" />
        </div>
  
    <!-- Account Information -->
    <div class="p-2 d-flex flex-column align-items-start">
        <div class="fw-bold">${account.account_name}</div>
        <small class="text-muted">${account.account_number}</small>
    </div>
</div>`;

				// Set selected account ID
				const selectedAccountElement =
					document.getElementById("disbursmentAccount");
				selectedAccountElement.value = account.id;

				// Close modal
				const modal = bootstrap.Modal.getInstance(
					document.getElementById("accountModal")
				);
				modal.hide();
			});

			accountList.appendChild(li);
		});
	}

	// Trigger fetch when modal is shown
 const modal = document.getElementById("accountModal");
 modal.addEventListener("show.bs.modal", function (event) {
  getAccounts(); // or just pass getAccounts directly if no arguments needed
 });
	const updateDOM = (
		fixedInterest,
		amount,
		serviceCharge,
		remainingBalance
	) => {
		const totalAmount = amount + fixedInterest + serviceCharge;
		document.getElementById("loanTotal").textContent =
			"PHP " + formatNumberWithCommas(amount.toFixed(2));
		document.getElementById("totalInterest").textContent =
			"PHP " + formatNumberWithCommas(fixedInterest.toFixed(2));
		document.getElementById("totalAmount").textContent =
			"PHP " + formatNumberWithCommas(amount + fixedInterest + serviceCharge);
		document.getElementById("serviceCharge").textContent =
			"PHP " + formatNumberWithCommas(serviceCharge.toFixed(2));
		document.getElementById("monthlyPayment").textContent =
			"PHP " + formatNumberWithCommas(remainingBalance);
	};

	// Initialize input listeners for calculations
	const initCalculationListeners = () => {
		const elements = [
			document.getElementById("paymentSchedule"),
			document.getElementById("loanAmount"),
		];

		elements.forEach((element) => {
			if (element) {
				addEventListeners(element, ["input", "change"], updateCalculations);
			}
		});
	};

	const wizardCheckout = document.querySelector("#wizard-checkout");
	if (typeof wizardCheckout !== undefined && wizardCheckout !== null) {
		// Wizard form
		const wizardCheckoutForm = wizardCheckout.querySelector(
			"#wizard-checkout-form"
		);
		// Wizard steps
		const wizardCheckoutFormStep1 =
			wizardCheckoutForm.querySelector("#checkout-cart");

		// Wizard next prev button
		const wizardCheckoutNext = [].slice.call(
			wizardCheckoutForm.querySelectorAll(".btn-next")
		);
		const wizardCheckoutPrev = [].slice.call(
			wizardCheckoutForm.querySelectorAll(".btn-prev")
		);

		let validationStepper = new Stepper(wizardCheckout, {
			linear: true,
		});

		// validation of the form
		const FormValidation1 = FormValidation.formValidation(
			wizardCheckoutFormStep1,
			{
				fields: {
					loan_amount: {
						validators: {
							notEmpty: {
								message: "This field is required",
							},
							numeric: {
								message: "Loan amount must be a number",
							},
							callback: {
								message: "Loan amount cannot exceed your available credit",
								callback: function (value, validator) {
									// Get available credit and remove "PHP" and formatting
									let incomeText =
										document.getElementById("creditAvailable").innerText;
									let loanCredit = parseFloat(
										incomeText.replace(/[^0-9.]/g, "")
									); // Extract numeric value

									let loanAmount = document.getElementById("loanAmount").value;
									return loanAmount <= loanCredit; // Validation passes if loanAmount is within the limit
								},
							},
						},
					},
					payment_schedule: {
						validators: {
							notEmpty: {
								message: "This field is required",
							},
						},
					},
					disbursment_account: {
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
			console.log(wizardCheckoutForm);
			$.ajax({
				url: `${BASE_URL}Loan/loan_application`,
				type: "POST",
				async: true,
				data: new FormData(wizardCheckoutForm),
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
							buttonStyling: false,
							confirmButtonText: "Ok, Got it!",
							customClass: {
								confirmButton: "btn fw-bold btn-primary",
							},
						}).then(() => {
							window.location.reload();
						});
					} else {
						if (Object.keys(response.validation_errors).length > 0) {
							let html =
								'<div class="text-start"> Please check the following fields: <br/>';
							html += "<ol>";

							$.each(response.validation_errors, function (key, value) {
								html +=
									"<li><b>" +
									value["label"] +
									"</b> : " +
									value["message"] +
									"</li>";
							});

							html += "</ol> </div>";
							Swal.fire({
								title: response.message,
								icon: "error",
								html: html,
								showCloseButton: true,
								showCancelButton: true,
								focusConfirm: true,
								showCancelButton: false,
								confirmButtonText: "Ok,got it!",
								customClass: {
									confirmButton: "btn fw-bold btn-primary",
								},
								buttonStyling: false,
							});
						} else {
							Swal.fire({
								text: response.message,
								icon: "error",
								buttonStyling: false,
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
						text: "Sorry Looks like there are some errors detected. Please Contact Admin Support",
						icon: "error",

						confirmButtonText: "Ok, Got it!",
						customClass: {
							confirmButton: "btn btn-primary",
						},
					});
				},
			});
		});

		wizardCheckoutNext.forEach((item) => {
			item.addEventListener("click", (event) => {
				FormValidation1.validate();
			});
		});

  
		wizardCheckoutPrev.forEach((item) => {
			item.addEventListener("click", (event) => {
				switch (validationStepper._currentIndex) {
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

	initCalculationListeners();
	getAccounts();
})();
