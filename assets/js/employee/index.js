"use strict";
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
	var table = $(".datatables-employees"),
		select2 = $(".select2");
	if (select2.length) {
		select2.each(function () {
			var $this = $(this);
			$this
				.wrap('<div class="position-relative"></div>')
				.select2({ placeholder: "Select All", dropdownParent: $this.parent() });
			$this.on("change", function (e) {
				e.preventDefault();
				dt.draw();
			});
		});
	}
	if (table.length) {
		var dt = table.DataTable({
			lengthMenu: [
				[10, 25, 50, -1],
				[10, 25, 50, "All"],
			],
			processing: !0,
			serverSide: !0,
			ajax: {
				url: `${BASE_URL}Admin/Employee/dt_list`,
				type: "POST",
				data: function (d) {
					d.department_id = $("#department_id").val();
					d.unit_id = $("#unit_id").val();
				},
			},
			column: [
				{ data: null },
				{ data: "last_name" },
				{ data: "position_title" },
				{ data: "sex" },
				{ data: "date_hired" },
				{ data: "middle_name" },
				{ data: "date_of_birth" },
				{ data: "birth_place" },
				{ data: "email" },
				{ data: "status" },
				{ data: null },
			],
			columnDefs: [
				{
					targets: 0,
					className: "control",
					searchable: !1,
					orderable: !1,
					responsivePriority: 2,
					render: function (data, type, full, meta) {
						return "";
					},
				},
				{
					targets: 1,
					responsivePriority: 4,
					render: function (data, type, full, meta) {
						var $name = full.first_name + " " + full.last_name,
							$email = full.email;
						var states = [
							"success",
							"danger",
							"warning",
							"info",
							"dark",
							"primary",
							"secondary",
						];
						var $state = states[full.id % states.length],
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
						var $row_output = `
              <div class="d-flex justify-content-start align-items-center user-name">
                <div class="avatar-wrapper">
                  <div class="avatar avatar-sm me-3">
                    ${$output}
                  </div>
                </div>
                <div class="d-flex flex-column">
                  <a href="${BASE_URL}Admin/Employee/view/${full["id"]}" class="text-body text-truncate"><span class="fw-medium name">${$name}</span></a>
                  <small class="text-muted email">${$email}</small>
                </div>
              </div>
              `;
						return $row_output;
					},
				},
				{
					targets: 2,
					render: function (data, type, full, meta) {
						var $position_title = full.position_title;
						return "<span>" + $position_title + "</span>";
					},
				},
				{
					targets: 3,
					responsivePriority: 4,
					render: function (data, type, full, meta) {
						var $department_name = full.department_name;
						return "<span>" + $department_name + "</span>";
					},
				},
				{
					targets: 4,
					render: function (data, type, full, meta) {
						var $sex = full.sex;
						var sexBadgeObj = {
							male: '<span class="badge badge-center rounded-pill bg-label-primary w-px-30 h-px-30 me-2"><i class="bx bx-male bx-xs"></i></span>',
							female:
								'<span class="badge badge-center rounded-pill bg-label-danger w-px-30 h-px-30 me-2"><i class="bx bx-female bx-xs"></i></span>',
						};
						return (
							"<span class='text-truncate d-flex align-items-center'>" +
							sexBadgeObj[$sex] +
							$sex +
							"</span>"
						);
					},
				},
				{
					targets: 5,
					render: function (data, type, full, meta) {
						var $date_hired = full.date_hired;
						return "<span>" + $date_hired + "</span>";
					},
				},
				{
					targets: 6,
					render: function (data, type, full, meta) {
						var $status = full.status;
						return "<span>" + $status + "</span>";
					},
				},
				{
					targets: -1,
					title: "Actions",
					searchable: !1,
					orderable: !1,
					className: "text-center",
					render: function (data, type, full, meta) {
						return (
							'<div class="d-inline-block text-nowrap">' +
							'<a href="' + BASE_URL + "Admin/Employee/view/" + full['id'] +
							'" class="btn btn-sm btn-icon" title="View item details"><i class="bx bx-show"></i></a>' +
							'<a href="javascript:;" class="btn btn-sm btn-icon delete-record" data-id="' +
							full['id'] +
							'" title="Delete this item"><i class="bx bx-trash"></i></a>' +
							"</div>"
						);
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
							title: "Employees",
							text: '<i class="bx bx-printer me-2" ></i>Print',
							className: "dropdown-item",
							exportOptions: {
								columns: [1, 2, 3, 4, 5],
								format: {
									body: function (inner, coldex, rowdex) {
										return $(inner).text().trim();
									},
								},
							},
						},
						{
							extend: "csv",
							title: "Employees",
							text: '<i class="bx bx-file me-2" ></i>Csv',
							className: "dropdown-item",
							exportOptions: {
								columns: [1, 2, 3, 4, 5],
								format: {
									body: function (inner, coldex, rowdex) {
										return $(inner).text().trim();
									},
								},
							},
						},
						{
							extend: "excel",
							title: "Employees",
							text: '<i class="bx bxs-file-export me-1"></i>Excel',
							className: "dropdown-item",
							exportOptions: {
								columns: [1, 2, 3, 4, 5],
								format: {
									body: function (inner, coldex, rowdex) {
										return $(inner).text().trim();
									},
								},
							},
						},
						{
							extend: "pdf",
							title: "Employees",
							text: '<i class="bx bxs-file-pdf me-2"></i>Pdf',
							className: "dropdown-item",
							exportOptions: {
								columns: [1, 2, 3, 4, 5],
								format: {
									body: function (inner, coldex, rowdex) {
										return $(inner).text().trim();
									},
								},
							},
						},
						{
							extend: "copy",
							title: "Employees",
							text: '<i class="bx bx-copy me-2" ></i>Copy',
							className: "dropdown-item",
							exportOptions: {
								columns: [1, 2, 3, 4, 5],
								format: {
									body: function (inner, coldex, rowdex) {
										return $(inner).text().trim();
									},
								},
							},
						},
					],
				},
				{
					text: '<i class="bx bx-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Add New</span>',
					className: "add-new btn btn-primary",
					attr: {
						"data-bs-toggle": "modal",
						"data-bs-target": "#data_table_modal",
					},
				},
			],
			responsive: {
				details: {
					display: $.fn.dataTable.Responsive.display.modal({
						header: function (row) {
							var data = row.data();
							var $name = data["first_name"] + data.last_name;
							return "Details of " + $name;
						},
					}),
					type: "column",
					renderer: function (api, rowIdx, columns) {
						var data = $.map(columns, function (col, i) {
							return col.title !== ""
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
							: !1;
					},
				},
			},
		});
		dt.on("draw", function () {
			handleDeleteRows();
		});
		dt.on("responsive-display", function () {
			handleDeleteRows();
		});
	}
	var handleDeleteRows = function () {
		const deleteButtons = document.querySelectorAll(".delete-record");
		deleteButtons.forEach((d) => {
			d.addEventListener("click", function (e) {
				e.preventDefault();
				const parent = e.target.closest("tr");
				const name = parent.querySelectorAll("td")[1].innerText;
				const id = $(this).data("id");
				Swal.fire({
					text: "Are you sure you want to delete " + name + "?",
					icon: "warning",
					showCancelButton: !0,
					buttonsStyling: !1,
					confirmButtonText: "Yes, delete!",
					cancelButtonText: "No, cancel",
					customClass: {
						confirmButton: "btn fw-bold btn-danger",
						cancelButton: "btn fw-bold btn-active-light-primary",
					},
				}).then(function (result) {
					if (result.value) {
						$.ajax({
							url: `${BASE_URL}Employee/delete`,
							type: "POST",
							async: !0,
							data: { id: id },
							dataType: "json",
							success: function (response) {
								if (response.status) {
									Swal.fire({
										text: "You have deleted " + name + "!.",
										icon: "success",
										buttonsStyling: !1,
										confirmButtonText: "Ok, got it!",
										customClass: { confirmButton: "btn fw-bold btn-primary" },
									}).then(function () {
										dt.draw();
									});
								} else {
									Swal.fire({
										text: response.message,
										icon: "error",
										buttonsStyling: !1,
										confirmButtonText: "Ok, got it!",
										customClass: { confirmButton: "btn btn-primary" },
									});
								}
							},
							error: function (error) {
								Swal.fire({
									text: "Sorry, looks like there are some errors detected, please try again.",
									icon: "error",
									buttonsStyling: !1,
									confirmButtonText: "Ok, got it!",
									customClass: { confirmButton: "btn btn-primary" },
								});
							},
						});
					} else if (result.dismiss === "cancel") {
						Swal.fire({
							text: name + " was not deleted.",
							icon: "error",
							buttonsStyling: !1,
							confirmButtonText: "Ok, got it!",
							customClass: { confirmButton: "btn fw-bold btn-primary" },
						});
					}
				});
			});
		});
	};
	const form = document.getElementById("addForm");
	const fv = FormValidation.formValidation(form, {
		fields: {
			modal_first_name: {
				validators: { notEmpty: { message: "First Name field is required" } },
			},
			modal_last_name: {
				validators: { notEmpty: { message: "Last Name field is required" } },
			},
			modal_middle_name: {
				validators: { notEmpty: { message: "Middle Name field is required" } },
			},
			modal_date_of_birth: {
				validators: {
					notEmpty: { message: "Date of Birth field is required" },
				},
			},
			modal_place_of_birth: {
				validators: {
					notEmpty: { message: "Place of Birth field is required" },
				},
			},
			modal_mobile_number: {
				validators: {
					notEmpty: { message: "Mobile Number field is required" },
				},
			},
			modal_date_hired: {
				validators: { notEmpty: { message: "Date Hired field is required" } },
			},
			position_id: {
				validators: { notEmpty: { message: "Position field is required" } },
			},
			modal_email: {
				validators: {
					notEmpty: { message: "Email field is required" },
					emailAddress: { message: "Input is not a valid email address" },
				},
			},
			employment_status: {
				validators: { notEmpty: { message: "Field is required" } },
			},
		},
		plugins: {
			trigger: new FormValidation.plugins.Trigger(),
			bootstrap5: new FormValidation.plugins.Bootstrap5({ eleValidClass: "" }),
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
			url: `${BASE_URL}Admin/Employee/index`,
			type: "POST",
			data: new FormData(form),
			contentType: !1,
			cache: !1,
			processData: !1,
			dataType: "json",
			success: function (response) {
				hideBlockUI();
				if (response.status) {
					Swal.fire({
						text: response.message,
						icon: "success",
						buttonsStyling: !1,
						confirmButtonText: "Ok, got it!",
						customClass: { confirmButton: "btn fw-bold btn-primary" },
					}).then(() => {
						window.location.href = BASE_URL + "Admin/Employee/index";
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
								"<li><b>" + value.label + "</b> : " + value.message + "</li>";
						});
						html += "</ol></div>";
						Swal.fire({
							title: response.message,
							icon: "error",
							html: html,
							showCloseButton: !0,
							focusConfirm: !0,
							confirmButtonText: "Ok, got it!",
							customClass: { confirmButton: "btn fw-bold btn-primary" },
							buttonsStyling: !1,
						});
					} else {
						Swal.fire({
							text: response.message,
							icon: "error",
							buttonsStyling: !1,
							confirmButtonText: "Ok, got it!",
							customClass: { confirmButton: "btn btn-primary" },
						});
					}
				}
			},
			error: function (xhr) {
				hideBlockUI();
				Swal.fire({
					text: "Sorry, looks like there are some errors detected, please try again.",
					icon: "error",
					buttonsStyling: !1,
					confirmButtonText: "Ok, got it!",
					customClass: { confirmButton: "btn btn-primary" },
				});
			},
		});
	});
	setTimeout(() => {
		$(".dataTables_filter .form-control").removeClass("form-control-sm");
		$(".dataTables_length .form-select").removeClass("form-select-sm");
	}, 300);
});
