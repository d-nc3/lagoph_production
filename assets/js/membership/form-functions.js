"use strict";

// comment box toggled ----------------------------------------
function toggleCommentBox(option, elementId) {
	var element = document.getElementById(elementId);
	if (option === "yes") {
		element.style.display = "block";
	} else {
		element.style.display = "none";
	}
}

$(document).ready(function () {
	$("#m_payment_method").on("change", function () {
		const selectedPaymentMethod = $(this).val();
		displayBasedOnSelect(
			selectedPaymentMethod,
			"#proofOfPaymentContainer",
			"#accNameContainer",
			"#refNumberContainer"
		);
		updateValidation(selectedPaymentMethod);
	});

	$("#contributionPaymentMethod").on("change", function () {
		const selectedPaymentMethod = $(this).val();
		displayBasedOnSelect(
			selectedPaymentMethod,
			"#c_proof_payment_container",
			"#c_amount_container",
			"#c_ref_number_container"
		);
	});
});

function displayBasedOnSelect(
	paymentMethod,
	proofOfPaymentField,
	accNameField,
	refNumberField
) {
	const data = paymentMethod;
	proofOfPaymentField = $(proofOfPaymentField);
	accNameField = $(accNameField);
	refNumberField = $(refNumberField);
	switch (data) {
		case "11":
		case "22":
		case "2":
			proofOfPaymentField.removeClass("d-none");
			accNameField.removeClass("d-none");
			refNumberField.removeClass("d-none");
			break;

		case "23":
			break;

		default:
			console.log("No valid option selected");
	}
}

  

const toggleButton = document.getElementById("attendedSeminar");
const uploadBin = document.getElementById("uploadBin");
toggleButton.addEventListener("click", function () {
	if (uploadBin.classList.contains("d-none")) {
		uploadBin.classList.remove("d-none");
	} else {
		uploadBin.classList.add("d-none");
	}
});

function hideElementDOM(button, HideEntity) {
	const toggleButton = document.getElementById(button);
	const uploadBin = document.getElementById(HideEntity);
	toggleButton.addEventListener("click", function () {
		if (uploadBin.classList.contains("d-none")) {
			uploadBin.classList.remove("d-none");
		} else {
			uploadBin.classList.add("d-none");
		}
	});
}

// Hiding elements in DOM
hideElementDOM("contributionFeePaid", "upload_payment_contribution");
hideElementDOM("memberFeePaid", "uploadPayment");
hideElementDOM("attendSeminar", "uploadBin");



