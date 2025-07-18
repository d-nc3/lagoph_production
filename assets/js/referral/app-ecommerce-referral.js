/**
 * Page eCommerce Referral
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
	var dt_user_table = $(".datatables-referral");

	// Users datatable
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
			},
			columns: [
				// columns according to JSON
				{ data: "" },
				{ data: "id" },
				{ data: "first_name" },
				{ data: "code" },
				{ data: "status" },
				{ data: "earning" },
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

						// Creates full output for row
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

						return "<span>" + $status + "</span>";
					},
				},
				{
					// value
					targets: 5,
					render: function (data, type, full, meta) {
						var $plan = full["value"];

						return "<span>" + $plan + "</span>";
					},
				},
				{
					// earning
					targets: 6,
					render: function (data, type, full, meta) {
						var $earn = full["earning"];

						return '<span class="fw-medium">' + $earn + "</span > ";
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




	// Filter form control to default size
	// ? setTimeout used for multilingual table initialization
	setTimeout(() => {
		$(".dataTables_filter .form-control").removeClass("form-control-sm");
		$(".dataTables_length .form-select").removeClass("form-select-sm");
	}, 300);
});
