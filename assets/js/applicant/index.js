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
	var table = $(".datatables-member-officer"),
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
				url: `${BASE_URL}Membership/Applicant/dt_list`,
				type: "POST",
				data: function (d) {
					d.sex = $("#sex").val();
					d.civil_status = $("#civilStatus").val();
					d.place_of_birth = $("#birthPlace").val();
					d.status = "Processing";
				},
			},
			columns: [
				{ data: null },
				{ data: "reference_number" },
				{ data: "last_name" },
				{ data: "sex" },
				{ data: "civil_status" },
				{ data: "mobile_number" },
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
					render: function (data, type, full, meta) {
						var $reference_number = full.reference_number;
						return "<span>" + $reference_number + "</span>";
					},
				},
				{
					targets: 2,
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
                  <a href="${BASE_URL}Membership/Applicant/view/${full["id"]}" class="text-body text-truncate"><span class="fw-medium name">${$name}</span></a>
                  <small class="text-muted email">${$email}</small>
                </div>
              </div>
              `;
						return $row_output;
					},
				},
				{
					targets: 3,
					render: function (data, type, full, meta) {
						var $sex = full.sex;
						var sexBadgeObj = {
							Male: '<span class="badge badge-center rounded-pill bg-label-primary w-px-30 h-px-30 me-2"><i class="bx bx-male bx-xs"></i></span>',
							Female:
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
					targets: 4,
					render: function (data, type, full, meta) {
						var $status = full.civil_status;
						return "<span>" + $status + "</span>";
					},
				},
				{
					targets: 5,
					render: function (data, type, full, meta) {
						var $mobile_number = full.mobile_number;
						return "<span> +63 " + $mobile_number + "</span>";
					},
				},
				{
					targets: -1,
					title: "Actions",
					searchable: !1,
					orderable: !1,
					render: function (data, type, full, meta) {
						return `
              <a href="${BASE_URL}applicant/view/${full["id"]}" class="btn btn-sm btn-primary" data-id="${full["id"]}" title="View Applicant"><i class="bx bx-show me-1"></i><span class="d-md-inline-block">View</span></a>
            `;
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
							var $name = data.first_name + " " + data.last_name;
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
	}
	setTimeout(() => {
		$(".dataTables_filter .form-control").removeClass("form-control-sm");
		$(".dataTables_length .form-select").removeClass("form-select-sm");
	}, 300);
});
(function () {
	const phoneMaskList = document.querySelectorAll(".phone-mask"),
		addNewUserForm = document.getElementById("addNewUserForm");
	if (phoneMaskList) {
		phoneMaskList.forEach(function (phoneMask) {
			new Cleave(phoneMask, { phone: !0, phoneRegionCode: "US" });
		});
	}
})();
