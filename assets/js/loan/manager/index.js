/**

 * Page User List

 */



"use strict";



// Datatable (jquery)

$(function () {

	let borderColor, bodyBg, headingColor;



	if (isDarkStyle) {

		borderColor = config.colors_dark.borderColor;

		bodyBg = config.colors_dark.bodyBg;

		headingColor = config.colors_dark.headingColor;

	} else {

		borderColor = config.colors.borderColor;

		bodyBg = config.colors.bodyBg;

		headingColor = config.colors.headingColor;

	}



	// Variable declaration for table

	var table = $(".datatables-users"),

		select2 = $(".select2");



	const payment_term = document.getElementById("paymentTerm");

	const loan_id = document.getElementById("loanId");

	const amount_due = document.getElementById("loanAmount");



	if (table.length) {

		var dt = table.DataTable({

			lengthMenu: [

				[10, 25, 50, -1],

				[10, 25, 50, "All"],

			],

			processing: true,

			serverSide: true,

			ajax: {

				url: `${BASE_URL}Loans/Loan/loan_dt_list`,

				type: "POST",

				data: function (d) {

					d.status = "Pending Manager Approval";

				},

			},



			columns: [

				{ data: null },

				{ data: "id" },

				{ data: "first_name" },

				{ data: "last_name" },

				{ data: "loan_amount" },

				{ data: "loan_status" },

				{ data: "loan_term" },

				{ data: "actions" },

			],

			columnDefs: [

				{

					targets: 0,

					className: "control",

					searchable: false,

					orderable: false,

					responsivePriority: 2,

					render: function (data, type, full, meta) {

						return "";

					},

				},

				{

					targets: 1,

					render: function (data, type, full, meta) {

						var $id = full["id"];

						return "<span>" + $id + "</span>";

					},

				},

				{

					targets: 2,

					responsivePriority: 4,

					render: function (data, type, full, meta) {

						var $name = full["first_name"] + " " + full["last_name"];

						// For Avatar badge

						var states = [

							"success",

							"danger",

							"warning",

							"info",

							"dark",

							"primary",

							"secondary",

						];

						var $state = states[full["id"] % states.length], // ensure id fits in states array

							$initials = $name.match(/\b\w/g) || [];

						$initials = (

							($initials.shift() || "") + ($initials.pop() || "")

						).toUpperCase();

						var $output =

							'<span class="avatar-initial rounded-circle bg-label-' +

							$state +

							'">' +

							$initials +

							"</span>";

						// Creates full output for row

						var $row_output = `

              <div class="d-flex justify-content-start align-items-center user-name">

                <div class="avatar-wrapper">

                  <div class="avatar avatar-sm me-3">

                    ${$output}

                  </div>

                </div>

                <div class="d-flex flex-column">

                  <a href="${BASE_URL}Applicant/view/${full["id"]}" class="text-body text-truncate"><span class="fw-medium name">${$name}</span></a>

              

                </div>

              </div>

              `;

						return $row_output;

					},

				},

				{

					targets: 3,

					render: function (data, type, full, meta) {

						var $loan_amount = full["loan_amount"];

						var formattedLoanAmount = new Intl.NumberFormat().format(

							$loan_amount

						);

						return (

							"<span class='text-truncate d-flex align-items-center'>" +

							"PHP " +

							formattedLoanAmount +

							"</span>"

						);

					},

				},

				{

					targets: 4,

					render: function (data, type, full, meta) {

						var $type = full["loan_type"];

						return "<span>" + $type + "</span>";

					},

				},

				{

					targets: 5,

					render: function (data, type, full, meta) {

						var $loan_term = full["loan_term"];

						return "<span>" + $loan_term + " months" + "</span>";

					},

				},

				{

					targets: 6,

					render: function (data, type, full, meta) {

						var $status = full["loan_status"];

						return "<span>" + $status + "</span>";

					},

				},

				{

					targets: -1,

					title: "Actions",

					searchable: false,

					orderable: false,

					render: function (data, type, full, meta) {

						return `

              <a href="${BASE_URL}Loan/view/${full["user_id"]}" class="btn btn-sm btn-primary" data-id="${full["user_id"]}" title="View Applicant"><i class="bx bx-show me-1"></i><span class="d-md-inline-block">View</span></a>

            `;

					},

				},

			],

			order: [[1, "desc"]],

			dom:

				'<"row mx-1"' +

				'<"col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-start gap-3"l<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start mt-md-0 mt-3"B>>' +

				'<"col-12 col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row pe-3 gap-md-3"f<"invoice_status mb-3 mb-md-0">>' +

				">t" +

				'<"row mx-2"' +

				'<"col-sm-12 col-md-6"i>' +

				'<"col-sm-12 col-md-6"p>' +

				">",

			language: {

				sLengthMenu: "_MENU_",

				search: "",

				searchPlaceholder: "Search..",

			},

			buttons: [

				{

					extend: "collection",

					className: "btn btn-label-secondary dropdown-toggle mx-3",

					text: '<i class="bx bx-export me-1"></i><span class="d-md-inline-block d-none">Export</span>',

					buttons: [

						{

							extend: "print",

							title: "Applicants",

							text: '<i class="bx bx-printer me-2" ></i>Print',

							className: "dropdown-item",

							exportOptions: {

								columns: [1, 2, 3, 4, 5],

								format: {

									body: function (inner, coldex, rowdex) {

										if (inner.length <= 0) return inner;

										var el = $.parseHTML(inner);

										var result = "";

										$.each(el, function (index, item) {

											if (

												item.classList !== undefined &&

												item.classList.contains("user-name")

											) {

												var name = $(item).find(".fw-medium").text();

												var email = $(item).find("small").text();

												result = result + name + " (" + email + ")";

											} else if (item.classList === undefined) {

												result = result + "";

											} else {

												result = result + item.innerText;

											}

										});

										return result.trim();

									},

								},

							},

						},

						{

							extend: "csv",

							title: "Applicants",

							text: '<i class="bx bx-file me-2" ></i>Csv',

							className: "dropdown-item",

							exportOptions: {

								columns: [1, 2, 3, 4, 5],

								format: {

									body: function (inner, coldex, rowdex) {

										if (inner.length <= 0) return inner;

										var el = $.parseHTML(inner);

										var result = "";

										$.each(el, function (index, item) {

											if (

												item.classList !== undefined &&

												item.classList.contains("user-name")

											) {

												var name = $(item).find(".fw-medium").text();

												var email = $(item).find("small").text();

												result = result + name + " (" + email + ")";

											} else if (item.classList === undefined) {

												result = result + "";

											} else {

												result = result + item.innerText;

											}

										});

										return result.trim();

									},

								},

							},

						},

						{

							extend: "excel",

							title: "Applicants",

							text: '<i class="bx bxs-file-export me-1"></i>Excel',

							className: "dropdown-item",

							exportOptions: {

								columns: [1, 2, 3, 4, 5],

								format: {

									body: function (inner, coldex, rowdex) {

										if (inner.length <= 0) return inner;

										var el = $.parseHTML(inner);

										var result = "";

										$.each(el, function (index, item) {

											if (

												item.classList !== undefined &&

												item.classList.contains("user-name")

											) {

												var name = $(item).find(".fw-medium").text();

												var email = $(item).find("small").text();

												result = result + name + " (" + email + ")";

											} else if (item.classList === undefined) {

												result = result + "";

											} else {

												result = result + item.innerText;

											}

										});

										return result.trim();

									},

								},

							},

						},

						{

							extend: "pdf",

							title: "Applicants",

							text: '<i class="bx bxs-file-pdf me-2"></i>Pdf',

							className: "dropdown-item",

							exportOptions: {

								columns: [1, 2, 3, 4, 5],

								format: {

									body: function (inner, coldex, rowdex) {

										if (inner.length <= 0) return inner;

										var el = $.parseHTML(inner);

										var result = "";

										$.each(el, function (index, item) {

											if (

												item.classList !== undefined &&

												item.classList.contains("user-name")

											) {

												var name = $(item).find(".fw-medium").text();

												var email = $(item).find("small").text();

												result = result + name + " (" + email + ")";

											} else if (item.classList === undefined) {

												result = result + "";

											} else {

												result = result + item.innerText;

											}

										});

										return result.trim();

									},

								},

							},

						},

						{

							extend: "copy",

							title: "Applicants",

							text: '<i class="bx bx-copy me-2" ></i>Copy',

							className: "dropdown-item",

							exportOptions: {

								columns: [1, 2, 3, 4, 5],

								format: {

									body: function (inner, coldex, rowdex) {

										if (inner.length <= 0) return inner;

										var el = $.parseHTML(inner);

										var result = "";

										$.each(el, function (index, item) {

											if (

												item.classList !== undefined &&

												item.classList.contains("user-name")

											) {

												var name = $(item).find(".fw-medium").text();

												var email = $(item).find("small").text();

												result = result + name + " (" + email + ")";

											} else if (item.classList === undefined) {

												result = result + "";

											} else {

												result = result + item.innerText;

											}

										});

										return result.trim();

									},

								},

							},

						},

					],

				},

			],

			responsive: {

				details: {

					display: $.fn.dataTable.Responsive.display.modal({

						header: function (row) {

							var data = row.data();

							var $name = data["first_name"] + " " + data["last_name"];

							return "Details of " + $name;

						},

					}),

					type: "column",

					renderer: function (api, rowIdx, columns) {

						var data = $.map(columns, function (col, i) {

							return col.title !== "" // ? Do not show row in modal popup if title is blank (for check box)

								? '<tr data-dt-row="' +

										col.rowIndex +

										'" data-dt-column="' +

										col.columnIndex +

										'">' +

										"<td>" +

										col.title +

										":" +

										"</td> " +

										"<td>" +

										col.data +

										"</td>" +

										"</tr>"

								: "";

						}).join("");



						return data

							? $('<table class="table"/><tbody />').append(data)

							: false;

					},

				},

			},

		});

	}



	const approve_application = document.querySelector(".button-approve");



	approve_application.addEventListener("click", function (e) {

		e.preventDefault();

		Swal.fire({

			text: "Are you sure you want to Disburse the user's application?",

			icon: "warning",

			showCancelButton: true,

			buttonsStyling: false,

			confirmButtonText: "Yes, Disburse!",

			cancelButtonText: "No, cancel",

			customClass: {

				confirmButton: "btn btn-primary me-2",

				cancelButton: "btn btn-label-secondary",

			},

		}).then(function (result) {

			if (result.value) {

				// Assuming you get the id from the form or a hidden input

				const member_id = approve_application.getAttribute(

					"data-application-id"

				);

				$.ajax({

					url: `${BASE_URL}Loans/Loan/disburse`,

					type: "POST",

					async: true,

					data: {

						member_id: member_id,

						loan_id: loan_id.value,

						amount_due: amount_due.value,

            payment_term:payment_term.value

					},

					dataType: "json",

					success: function (response) {

						if (response.status) {

							Swal.fire({

								text: "You have successfully approved the user application",

								icon: "success",

								buttonsStyling: false,

								confirmButtonText: "Ok, got it!",

								customClass: {

									confirmButton: "btn fw-bold btn-primary",

								},

							}).then(function () {

								window.location.href = BASE_URL + "Loans/Loan/manager_index";

								dt.draw();

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

					},

					error: function (error) {

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

			} else if (result.dismiss === "cancel") {

				Swal.fire({

					text: "The application was not approved.",

					icon: "error",

					buttonsStyling: false,

					confirmButtonText: "Ok, got it!",

					customClass: {

						confirmButton: "btn fw-bold btn-primary",

					},

				});

			}

		});

	});



	setTimeout(() => {

		$(".dataTables_filter .form-control").removeClass("form-control-sm");

		$(".dataTables_length .form-select").removeClass("form-select-sm");

	}, 300);

});

// // Validation & Phone mask

(function () {

	const phoneMaskList = document.querySelectorAll(".phone-mask"),

		addNewUserForm = document.getElementById("addNewUserForm");



	// Phone Number

	if (phoneMaskList) {

		phoneMaskList.forEach(function (phoneMask) {

			new Cleave(phoneMask, {

				phone: true,

				phoneRegionCode: "US",

			});

		});

	}

})();



updateCalculations();