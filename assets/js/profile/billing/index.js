// function to fetch the cards existing in the database



const select2 = $(".select2-search");



// select2

if (select2.length) {

	select2.each(function () {

		var $this = $(this);

		$this.select2({

			placeholder: "Select Option",

			dropdownParent: $this.parent(),

			allowClear: true,

		});

	});

}

    let addressInput, cityInput, provinceInput;

    function initAutocomplete() {
      addressInput = document.getElementById('address');
      cityInput = document.getElementById('city');
      provinceInput = document.getElementById('province');


      const autocomplete = new google.maps.places.Autocomplete(addressInput, {
        types: ['address'],
        componentRestrictions: { country: 'ph' }
      });

      autocomplete.addListener('place_changed', function () {
        const place = autocomplete.getPlace();

        if (!place.address_components) return;

        fillAddressFields(place.address_components);
      });
    }

    function getComponent(components, type) {
      const comp = components.find(c => c.types.includes(type));
      return comp ? comp.long_name : '';
    }

    function fillAddressFields(components) {
      cityInput.value = getComponent(components, 'locality') ||
                        getComponent(components, 'administrative_area_level_2');
      provinceInput.value = getComponent(components, 'administrative_area_level_1');
      postalInput.value = getComponent(components, 'postal_code');
    }

    function useCurrentLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
          const latlng = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };

          const geocoder = new google.maps.Geocoder();
          geocoder.geocode({ location: latlng }, function(results, status) {
            if (status === 'OK' && results[0]) {
              addressInput.value = results[0].formatted_address;
              fillAddressFields(results[0].address_components);
            } else {
              alert('Unable to get address from location.');
            }
          });
        }, function(error) {
          alert('Error getting location: ' + error.message);
        });
      } else {
        alert('Geolocation is not supported by this browser.');
      }
    }

    google.maps.event.addDomListener(window, 'load', initAutocomplete);


//function to fetch the cards from the backend

function fetchData(controller, method, callback) {

	$.ajax({

		url: `${BASE_URL}${controller}/${method}`,

		type: "GET",

		dataType: "json",

		success: function (data) {

			if (typeof callback === "function") {

				callback(data);

			}

		},

		error: function (xhr, status, error) {

			console.error(`Error fetching data from ${controller}/${method}:`, error);

		}

	});

}





// For fetching cards

fetchData("Profile", "getCards", renderCards);



// For fetching billing address

fetchData("Profile", "getBillingAddress", renderBilling);





function fetchCards() {

	$.ajax({

		url: `${BASE_URL}Profile/getCards`, // create a function in the controller to get the data

		type: "GET",

		dataType: "json",

		success: function (cards) {

			renderCards(cards); // call the function and pass the data.

		},

		error: function (xhr, status, error) {

			console.error("Error Fetching Data: ", error);

		},

	});

}







function fetchBillingAddress() {

	$.ajax({

		url: `${BASE_URL}Profile/getBillingAddress`, // create a function in the controller to get the data

		type: "GET",

		dataType: "json",

		success: function (billings) {

			renderBilling(billings); // call the function and pass the data.

		},

		error: function (xhr, status, error) {

			console.error("Error Fetching Data: ", error);

		},

	});

}





// function to render the cards in the front-end

function renderCards(cards) {

	const cardsContainer = document.getElementById("added-cards");

	cardsContainer.innerHTML = "";



	if (cards.length === 0) {

		cardsContainer.innerHTML = "<p class='text-muted'>No cards available.</p>";

		return;

	}

	// loop to the array of cards fetched on the fetchCards function

	cards.forEach((card) => {

		const cardHTML = `

		  <div class="cardMaster bg-lighter rounded-2 p-3 mb-3">

			<div class="d-flex justify-content-between flex-sm-row flex-column">

			<div class="card-information me-2">

			  <div class="avatar mb-3">

				<div

				  class="avatar-initial rounded-circle border d-flex align-items-center justify-content-center"

				  style="width: 50px; height: 50px; border: 2px solid #ADD8E6; background-color: #ffffff;">

				  <img

					class="img-fluid"

					style="max-width: 80%; max-height: 80%; object-fit: contain; border-radius: 50%;"

					src="./../assets/img/icons/payments/${card.financial_service_provider}.png"

					alt="${card.financial_service_provider}" />

				</div>

			  </div>

			  <!-- Card Details -->

			  <div class="p-2">

				<h6 class="mb-1 me-2">${card.account_name}</h6>

				<span class="card-number d-block text-muted">${card.account_number}</span>



			  </div>

			</div>

			  <div class="d-flex flex-column text-start text-sm-end">

					<div class="d-flex order-sm-0 order-1 mt-sm-0 mt-3">

					<button

						class="btn btn-label-primary me-2 edit-card"

						data-bs-toggle="modal"

						data-bs-target="#editCard"

						data-id="${card.id}">

						Edit

					</button>

					<button class="btn btn-label-secondary delete-card" data-id="${card.id}">Delete</button>

					</div>

					<small class="mt-sm-auto mt-2 order-sm-1 order-0">Card added last ${card.created_at}</small>

				</div>

				</div>

			</div>

		  </div>

		</div>

	  `;



		cardsContainer.innerHTML += cardHTML; // Append card HTML

	});

}

function renderBilling(billings) {

	const billingContainer = document.getElementById("billing-address");



	if (billings.length === 0) {

		cardsContainer.innerHTML = "<p class='text-muted'>No Billing available.</p>";

		return;

	}

	billingContainer.innerHTML = "";

	billings.forEach((billing) => {

		const billingHTML = `

          <div class="cardMaster bg-lighter rounded-2 p-3 mb-3">

            <div class="d-flex justify-content-between flex-sm-row flex-column">

                <div class="card-information me-2">

                    <div class="d-flex align-items-center mb-1 flex-wrap gap-2">

                    <h6 class="mb-0 me-2">Email</h6>



                    </div>

                    <span class="card-number mb-">${billing.billing_email}</span>

                    <div class="d-flex align-items-center mb-1 flex-wrap gap-2">

                    <h6 class="mb-0 mt-2">Mobile Number</h6>

                    </div>

                    <span class="card-number mb-2">${billing.mobile_number}</span>



                    <div class="d-flex align-items-center mb-1 flex-wrap gap-2">

                    <h6 class="mb-0 mt-2">Address</h6>

                    </div>

                    <span class="card-number mb-2">${billing.street_address}</span>

                    <div class="d-flex align-items-center mb-1 flex-wrap gap-2">

                    <h6 class="mb-0 mt-2">Province</h6>

                    </div>

                <span class="card-number">${billing.municipality}</span>

                </div>

                <div class="d-flex flex-column text-start text-sm-end">

                    <div class="d-flex order-sm-0 order-1 mt-sm-0 mt-3">

						<button

						class="btn btn-label-primary me-2 edit-record"

						data-bs-toggle="modal"

						data-bs-target="#editBillingAddress"

						data-id="${billing.id}">

						<i class="bx bx-edit"></i>

						</button>



                        <button class="btn btn-label-secondary delete-record" data-id="${billing.id}"><i class="bx bx-trash"></i></button>

                    </div>

                </div>

            </div>

        </div>`;

		billingContainer.innerHTML += billingHTML;

	});

}



const form = document.getElementById("addNewAccForm");

const fv = FormValidation.formValidation(form, {

	fields: {

		modal_add_name: {

			validators: {

				notEmpty: {

					message: "Field is required",

				},

			},

		},

		modal_add_card_num: {

			validators: {

				notEmpty: {

					message: "Field is required",

				},

			},

		},

		account_type: {

			validators: {

				notEmpty: {

					message: "Field is required",

				},

			},

		},

		account_institution: {

			validators: {

				notEmpty: {

					message: "Field is required",

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

}).on("core.form.valid", function () {

	showBlockUI();

	$.ajax({

		url: `${BASE_URL}Profile/add_account`, // Ensure the correct URL for form submission

		type: "POST",

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

					// Redirect to dashboard if needed

					window.location.href = BASE_URL + "Profile/Billing";

					addForm.modal("hide");

					dt.draw();

				});

			} else {

				if (response.validation_errors) {

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

						focusConfirm: true,

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

		error: function (xhr) {

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



// insert data in billing address:

const form_billing = document.getElementById("billing_settings");

const billing_fv = FormValidation.formValidation(form_billing, {

	fields: {

		billing_email: {

			validators: {

				notEmpty: {

					message: "Field is required",

				},

				emailAddress: {

					message: "The value is not a valid email address",

				},

			},

		},

		mobile_number: {

			validators: {

				notEmpty: {

					message: "Field is required",

				},

				regexp: {

					regexp: /^9\d{9}$/,

					message: "Enter a valid mobile number (e.g. 9123456789)",

				},

			},

		},

		address: {

			validators: {

				dnotEmpty: {

					message: "Field is required",

				},

			},

		},

		province: {

			validators: {

				notEmpty: {

					message: "Field is required",

				},

			},

		},

		address: {

			validators: {

				notEmpty: {

					message: "Field is required",

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

}).on("core.form.valid", function () {

	showBlockUI();

	$.ajax({

		url: `${BASE_URL}Profile/addBilling`, // Ensure the correct URL for form submission

		type: "POST",

		data: new FormData(form_billing),

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

					// Redirect to dashboard if needed

					window.location.href = BASE_URL + "Settings/Billing";

					addForm.modal("hide");

					dt.draw();

				});

			} else {

				if (response.validation_errors) {

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

						focusConfirm: true,

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

		error: function (xhr) {

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



function handleEditRows() {

	const billingContainer = document.getElementById("billing-address");



	if (!billingContainer) {

		console.warn("Billing container not found");

		return;

	}



	// Event delegation: listen on container, react to .edit-record

	billingContainer.addEventListener("click", function (e) {

		const editBtn = e.target.closest(".edit-record");

		if (editBtn) {

			const id = editBtn.dataset.id;

			showBlockUI();

			$.ajax({

				url: `${BASE_URL}Settings/get`,

				type: "POST",

				async: true,

				data: { id: id },

				dataType: "json",

				success: function (response) {

					hideBlockUI();



					if (response) {

						$("#edit-id").val(response.id);

						$("#edit-email-address").val(response.billing_email);

						$("#edit-province").val(response.municipality).trigger("change");

						$("#edit-address").val(response.street_address);

						$("#edit-mobile-number").val(response.mobile_number);

					} else {

						Swal.fire({

							text: "No billing data found. Please try again.",

							icon: "error",

							confirmButtonText: "OK",

							customClass: { confirmButton: "btn btn-primary" },

						});

					}

				},

				error: function (xhr, status, error) {

					hideBlockUI();

					console.error("AJAX error:", status, error);

					Swal.fire({

						text: "An error occurred. Please try again.",

						icon: "error",

						confirmButtonText: "OK",

						customClass: { confirmButton: "btn btn-primary" },

					});

				},

			});

		}

	});

}



const editForm = document.getElementById("editForm");

// Edit Form Validation

const editFormValidation = FormValidation.formValidation(editForm, {

	fields: {

		edit_email: {

			validators: {

				notEmpty: {

					message: "This field is required",

				},

			},

		},

		edit_number: {

			validators: {

				notEmpty: {

					message: "This field is required",

				},

			},

		},

		edit_address: {

			validators: {

				notEmpty: {

					message: "This field is required",

				},

			},

		},

		edit_province: {

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

}).on("core.form.valid", function () {

	showBlockUI();

	$.ajax({

		url: `${BASE_URL}Settings/edit_billing`, // Ensure the correct URL for form submission

		type: "POST",

		data: new FormData(editForm),

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

					// Redirect to dashboard if needed

					window.location.href = BASE_URL + "Settings/Billing";

					addForm.modal("hide");

					dt.draw();

				});

			} else {

				if (response.validation_errors) {

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

						focusConfirm: true,

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

		error: function (xhr) {

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



// Delete routine

var handleDeleteRows = function () {

	const billingContainer = document.getElementById("billing-address");

	billingContainer.addEventListener("click", function (e) {

		const deleteBtn = e.target.closest(".delete-record");

		if (deleteBtn) {

			const id = deleteBtn.dataset.id;

			Swal.fire({

				text: `Are you sure you want to delete?`,

				icon: "warning",

				showCancelButton: true,

				buttonsStyling: false,

				confirmButtonText: "Yes, delete!",

				cancelButtonText: "No, cancel",

				customClass: {

					confirmButton: "btn fw-bold btn-danger",

					cancelButton: "btn fw-bold btn-active-light-primary",

				},

			}).then(function (result) {

				if (result.value) {

					$.ajax({

						url: `${BASE_URL}Settings/delete_billing`,

						type: "POST",

						async: true,

						data: { id: id },

						dataType: "json",

						success: function (response) {

							hideBlockUI();

							if (response.status) {

								Swal.fire({

									text: `Successfuly deleted!`,

									icon: "success",

									buttonsStyling: false,

									confirmButtonText: "Ok, got it!",

									customClass: {

										confirmButton: "btn fw-bold btn-primary",

									},

								}).then(function () {

									window.location.reload();



								});

							} else {

								Swal.fire({

									text: response.message || "Something went wrong.",

									icon: "error",

									buttonsStyling: false,

									confirmButtonText: "Ok, got it!",

									customClass: {

										confirmButton: "btn btn-primary",

									},

								});

							}

						},

						error: function () {

							hideBlockUI();

							Swal.fire({

								text: "Sorry, an error occurred. Please try again.",

								icon: "error",

								buttonsStyling: false,

								confirmButtonText: "Ok, got it!",

								customClass: {

									confirmButton: "btn btn-primary",

								},

							});

						},

					});

				} else if (result.dismiss === "cancel") {

					hideBlockUI();

					Swal.fire({

						text: `Billing address was not deleted.`,

						icon: "info",

						buttonsStyling: false,

						confirmButtonText: "Ok, got it!",

						customClass: {

							confirmButton: "btn fw-bold btn-primary",

						},

					});

				}

			});

		}

	});

};



var editCardRows = function() {

	const cardContainer = document.querySelector(".added-cards");

	cardContainer.addEventListener("click", function (e) {

		const editCard = e.target.closest(".edit-card");

		if (editCard) {

			const id = editCard.dataset.id;

			showBlockUI();

			$.ajax({

				url: `${BASE_URL}Settings/get_edit_cards`,

				type: "POST",

				async: true,

				data: { id: id },

				dataType: "json",

				success: function (response) {

					hideBlockUI();

					console.log(response);

					if (response) {

						$("#edit-card-id").val(response.id);

						$("#edit-financial-provider").val(response.method_id).trigger("change");

						$("#edit-account-type").val(response.account_type).trigger("change");

						$("#edit-account-name").val(response.account_name);

						$("#edit-account-number").val(response.account_number);

					} else {

						Swal.fire({

							text: "No Card data found. Please try again.",

							icon: "error",

							confirmButtonText: "OK",

							customClass: { confirmButton: "btn btn-primary" },

						});

					}

				},

				error: function (xhr, status, error) {

					hideBlockUI();

					console.error("AJAX error:", status, error);

					Swal.fire({

						text: "An error occurred. Please try again.",

						icon: "error",

						confirmButtonText: "OK",

						customClass: { confirmButton: "btn btn-primary" },

					});

				},

			});

		}

	});

};



const editCard = document.getElementById("editCardForm");



const editCardValidation = FormValidation.formValidation(editCard, {

    fields: {

        edit_account_type: {

            validators: {

                notEmpty: {

                    message: "This field is required",

                },

            },

        },

        edit_financial_account: {

            validators: {

                notEmpty: {

                    message: "This field is required",

                },

            },

        },

        edit_account_name: {

            validators: {

                notEmpty: {

                    message: "This field is required",

                },

            },

        },

        edit_account_number: {

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

}).on("core.form.valid", function () {

    showBlockUI();

    $.ajax({

        url: `${BASE_URL}Settings/edit_card`, // Ensure the correct URL for form submission

        type: "POST",

        data: new FormData(editCard),

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

                    // Redirect to dashboard if needed

                    window.location.href = BASE_URL + "Profile/Billing";

                    const modal = new bootstrap.Modal(document.getElementById("editCard"));

                    modal.hide();  // Hide modal if successful

                });

            } else {

                if (response.validation_errors) {

                    let html = '<div class="text-start">Please check the following fields:</br>';

                    html += "<ol>";

                    $.each(response.validation_errors, function (key, value) {

                        html += "<li><b>" + value["label"] + "</b> : " + value["message"] + "</li>";

                    });

                    html += "</ol></div>";

                    Swal.fire({

                        title: response.message,

                        icon: "error",

                        html: html,

                        showCloseButton: true,

                        focusConfirm: true,

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

        error: function (xhr) {

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



const handleDeleteCard = function () {

	deleteCard = document.querySelector(".added-cards");

	deleteCard.addEventListener("click", function (e) {

		const deleteBtn = e.target.closest(".delete-card");

		if (deleteBtn) {

			const id = deleteBtn.dataset.id;

			Swal.fire({

				text: `Are you sure you want to delete?`,

				icon: "warning",

				showCancelButton: true,

				buttonsStyling: false,

				confirmButtonText: "Yes, delete!",

				cancelButtonText: "No, cancel",

				customClass: {

					confirmButton: "btn fw-bold btn-danger",

					cancelButton: "btn fw-bold btn-active-light-primary",

				},

			}).then(function (result) {

				if (result.value) {

					$.ajax({

						url: `${BASE_URL}Settings/delete_card`,

						type: "POST",

						async: true,

						data: { id: id },

						dataType: "json",

						success: function (response) {

							hideBlockUI();

							if (response.status) {

								Swal.fire({

									text: `Successfuly deleted!`,

									icon: "success",

									buttonsStyling: false,

									confirmButtonText: "Ok, got it!",

									customClass: {

										confirmButton: "btn fw-bold btn-primary",

									},

								}).then(function () {

									window.location.reload();



								});

							} else {

								Swal.fire({

									text: response.message || "Something went wrong.",

									icon: "error",

									buttonsStyling: false,

									confirmButtonText: "Ok, got it!",

									customClass: {

										confirmButton: "btn btn-primary",

									},

								});

							}

						},

						error: function () {

							hideBlockUI();

							Swal.fire({

								text: "Sorry, an error occurred. Please try again.",

								icon: "error",

								buttonsStyling: false,

								confirmButtonText: "Ok, got it!",

								customClass: {

									confirmButton: "btn btn-primary",

								},

							});

						},

					});

				} else if (result.dismiss === "cancel") {

					hideBlockUI();

					Swal.fire({

						text: `Billing address was not deleted.`,

						icon: "info",

						buttonsStyling: false,

						confirmButtonText: "Ok, got it!",

						customClass: {

							confirmButton: "btn fw-bold btn-primary",

						},

					});

				}

			});

		}

	});

}

document.addEventListener("DOMContentLoaded", () => {

	console.log("Page loaded, initializing...");
	fetchCards();
	fetchBillingAddress();
	handleEditRows();
	handleDeleteRows();
	editCardRows();
	handleDeleteCard();
});

