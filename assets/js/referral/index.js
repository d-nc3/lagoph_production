/**
 * Page eCommerce Referral
 */

"use strict";

// Datatable (jquery)
$(document).ready(function () {
	// Constants
	const button = $(".qrButton"),
		linkButton = $(".linkButton"),
		input = $("#referralLink").val(),
		qrContainer = $("#qrCodeContainer");

	var userId = document.getElementById("#userId");

	// Check if input value exists
	if (input) {
		generateQrButton(input, qrContainer); // Generate the QR code if input is available
	} else {
		console.log("Referral link is empty, cannot generate QR code.");
	}

	// Variable declaration for table
	var dt_user_table = $(".datatables-referral"); // Users datatable
	if (dt_user_table.length) {
		var dt = dt_user_table.DataTable({
			lengthMenu: [
				[10, 25, 50, -1],
				[10, 25, 50, "All"],
			],
			processing: true,
			serverSide: true,
			ajax: {
				url: `${BASE_URL}Referral_member/dt_list_users`,
				type: "POST",
				data: function(d) {
                    d.status = 'available';
                  
                }
			},
			columns: [
				// columns according to JSON
				{ data: "" },
				{ data: "id" },
				{ data: "first_name" },
				{ data: "code" },
				{ data: "status" },
				{ data: "actions" },
			],
			columnDefs: [
				{
					// For Responsive
					className: "control",
					searchable: false,
					orderable: false,
					responsivePriority: 2,
					targets: 0,
					render: function (data, type, full, meta) {
						return "";
					},
				},
				{
					// For Checkboxes
					targets: 1,
					orderable: false,
					searchable: false,
					responsivePriority: 3,
					checkboxes: true,
					render: function () {
						return '<input type="checkbox" class="dt-checkboxes form-check-input">';
					},
					checkboxes: {
						selectAllRender: '<input type="checkbox" class="form-check-input">',
					},
				},
				{
					// eCommerce full name and email
					targets: 2,
					responsivePriority: 1,
					render: function (data, type, full, meta) {
						var $name = full["first_name"] + " " + full["last_name"],
							$email = full["email"],
							$initials = $name.match(/\b\w/g) || [],
							$initials = (
								($initials.shift() || "") + ($initials.pop() || "")
							).toUpperCase(),
							$output =
								'<span class="avatar-initial rounded-circle bg-label-' +
								'">' +
								$initials +
								"</span>";

						if ($name === "null null") {
							$name = "Anonymous";
						} else {
							$name = $name;
						}
						var $row_output =
							'<div class="d-flex justify-content-start align-items-center customer-name">' +
							'<div class="avatar-wrapper">' +
							'<div class="avatar me-2">' +
							$output +
							"</div>" +
							"</div>" +
							'<div class="d-flex flex-column">' +
							'<a href="' +
							'"><span class="fw-medium">' +
							$name +
							"</span></a>" +
							'<small class="text-muted text-nowrap">' +
							$email +
							"</small>" +
							"</div>" +
							"</div>";
						return $row_output;
					},
				},
				{
					// eCommerce Role
					targets: 3,
					render: function (data, type, full, meta) {
						var $role = full["code"];

						return "<span>" + $role + "</span>";
					},
				},

				{
					// eCommerce Status
					targets: 4,
					render: function (data, type, full, meta) {
						var $status = full["status"];
						var $badgeClass = "";

						// Assign badge color based on status
						if ($status === "available") {
							$badgeClass = "badge bg-success"; // Green badge
						} else if ($status === "processing") {
							$badgeClass = "badge bg-warning "; // Yellow badge
						} else if ($status === "Rejected") {
							$badgeClass = "badge bg-danger"; // Red badge
						} else {
							$badgeClass = "badge bg-secondary"; // Grey badge for unknown statuses
						}

						// Use a span element styled like a badge
						var $output =
							'<span class="' + $badgeClass + '">' + $status + "</span>";
						return $output;
					},
				},
				{
					targets: -1,
					title: "Actions",
					searchable: false,
					orderable: false,
					className: "text-center",
					render: function (data, type, full, meta) {
						const dynamicUrl = `${BASE_URL}Register/index?ref=${full["code"]}`;
						return (
							'<div class="d-inline-block text-nowrap">' +
							'<button class="btn btn-primary view-details-btn" ' +
							'data-url="' +
							dynamicUrl +
							'" ' +
							'data-id="' +
							full["id"] +
							'" title="Generate QR Code">' +
							'<i class="bx bx-qr"></i> View Qr</button>' +
							"</div>" +
							'<div id="qrCodeContainer_' +
							full["id"] +
							'" class="qr-code-container"></div>'
						);
					},
				},
			],

			order: [[2, "desc"]],
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
			// Buttons with Dropdown
			buttons: [
				{
					extend: "collection",
					className: "btn btn-label-secondary dropdown-toggle me-3",
					text: '<i class="bx bx-export me-1"></i>Export',
					buttons: [
						{
							extend: "print",
							text: '<i class="bx bx-printer me-2" ></i>Print',
							className: "dropdown-item",
							exportOptions: {
								columns: [1, 2, 3, 4, 5],
								// prevent avatar to be print
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
												result = result + item.lastChild.firstChild.textContent;
											} else if (item.innerText === undefined) {
												result = result + item.textContent;
											} else result = result + item.innerText;
										});
										return result;
									},
								},
							},
							customize: function (win) {
								//customize print view for dark
								$(win.document.body)
									.css("color", headingColor)
									.css("border-color", borderColor)
									.css("background-color", bodyBg);
								$(win.document.body)
									.find("table")
									.addClass("compact")
									.css("color", "inherit")
									.css("border-color", "inherit")
									.css("background-color", "inherit");
							},
						},
						{
							extend: "csv",
							text: '<i class="bx bx-file me-2" ></i>Csv',
							className: "dropdown-item",
							exportOptions: {
								columns: [1, 2, 3, 4, 5],
								// prevent avatar to be display
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
												result = result + item.lastChild.firstChild.textContent;
											} else if (item.innerText === undefined) {
												result = result + item.textContent;
											} else result = result + item.innerText;
										});
										return result;
									},
								},
							},
						},
						{
							extend: "excel",
							text: '<i class="bx bxs-file-export me-2"></i>Excel',
							className: "dropdown-item",
							exportOptions: {
								columns: [1, 2, 3, 4, 5],
								// prevent avatar to be display
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
												result = result + item.lastChild.firstChild.textContent;
											} else if (item.innerText === undefined) {
												result = result + item.textContent;
											} else result = result + item.innerText;
										});
										return result;
									},
								},
							},
						},
						{
							extend: "pdf",
							text: '<i class="bx bxs-file-pdf me-2"></i>Pdf',
							className: "dropdown-item",
							exportOptions: {
								columns: [1, 2, 3, 4, 5],
								// prevent avatar to be display
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
												result = result + item.lastChild.firstChild.textContent;
											} else if (item.innerText === undefined) {
												result = result + item.textContent;
											} else result = result + item.innerText;
										});
										return result;
									},
								},
							},
						},

						{
							extend: "copy",
							text: '<i class="bx bx-copy me-2" ></i>Copy',
							className: "dropdown-item",
							exportOptions: {
								columns: [1, 2, 3, 4, 5],
								// prevent avatar to be display
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
												result = result + item.lastChild.firstChild.textContent;
											} else if (item.innerText === undefined) {
												result = result + item.textContent;
											} else result = result + item.innerText;
										});
										return result;
									},
								},
							},
						},
					],
				},
			],
		});
		$("div.head-label").html(
			'<h5 class="card-title text-nowrap mb-2 mb-sm-0">Referred users</h5>'
		);
		$(".dataTables_length").addClass("mt-0 mt-md-3 me-3");
		$(".dt-action-buttons").addClass("pt-0");
		// To remove default btn-secondary in export buttons
		$(".dt-buttons > .btn-group > button").removeClass("btn-secondary");
	}

	setTimeout(() => {
		$(".dataTables_filter .form-control").removeClass("form-control-sm");
		$(".dataTables_length .form-select").removeClass("form-select-sm");
	}, 300);

	// Event handler for the link button
	linkButton.on("click", function (event) {
		event.preventDefault();
		generateReferralLink(userId);
	});

	// Event handler for viewing QR code
	$("#referralTable").on("click", ".view-details-btn", function () {
		const button = $(this);
		const dynamicUrl = button.data("url");
		const recordId = button.data("id");

		$("#qrCodeModalLabel").text(`QR Code for Record #${recordId}`);
		$("#qr_code_display").html("");

		generateQrButton(dynamicUrl, "#qr_code_display", function () {
			$("#qrCodeModal").modal("show");
		});
	});

	// Function to generate referral link
	function generateReferralLink(userId) {
		$.ajax({
			url: `${BASE_URL}Referral_member/generate_link`,
			type: "POST",
			data: { data: userId },
			success: function (response) {
				const res = JSON.parse(response);
				if (res.status) {
					// Update the input field with the generated referral code
					$("#referralLink").val(
						`${BASE_URL}Register/index?ref=${res.referral_code}`
					);
				} else {
					alert(res.message);
				}
			},
			error: function () {
				alert(
					"An error occurred in generating the link. Please try again later."
				);
			},
		});
	}

	// Function to generate QR code and display it in a container
	function generateQrButton(data, container, callback) {
		if (!data) {
			alert("Invalid data for QR code generation!");
			return;
		}
		$.ajax({
			url: `${BASE_URL}Referral_member/generate`,
			type: "GET",
			data: { data: data },
			success: function (response) {
				if (response) {
					$(container).html(
						'<img src="data:image/png;base64,' + response + '" alt="QR Code">'
					);
					if (callback) {
						callback();
					}
				} else {
					alert("Failed to generate QR code.");
				}
			},
			error: function () {
				alert("An error occurred while generating the QR code.");
			},
		});
	}

	generateQrButton(input, qrContainer);
});
