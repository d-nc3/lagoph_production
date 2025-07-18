
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
	var table = $(".datatables-loan"),
		select2 = $(".select2");

	if (table.length) {
		var dt = table.DataTable({
			lengthMenu: [
				[5,10, 25, 50, -1],
				[5,10, 25, 50, "All"],
			],
			processing: true,
			serverSide: true,
			ajax: {
				url: `${BASE_URL}Loans/Loan/repayment_dt_list`,
				type: "POST",
				data: function (d) {
					d.status = $("#filter-status-id").val();
				},
			},
			columns: [
				// columns according to JSO
				{ data: '' },
				{ data: 'due_date' },
				{ data: 'amount_due' },
				{ data: 'status' },
				{ data: 'actions' },
				{ data: '' }
			  ],
			
			columnDefs: [
                {
                  // For Responsive
                  className: 'control',
                  searchable: false,
                  orderable: false,
                  responsivePriority: 2,
                  targets: 0,
                  render: function (data, type, full, meta) {
                    return '';
                  }
                },
                {
                  // For Checkboxes
                  targets: 1,
                  orderable: false,
                  checkboxes: {
                    selectAllRender: '<input type="checkbox" class="form-check-input">'
                  },
                  render: function () {
                    return '<input type="checkbox" class="dt-checkboxes form-check-input" >';
                  },
                  searchable: false
                },
                {
                  // Product name and product info
                  targets: 2,
                  responsivePriority: 1,
                  searchable: false,
                  orderable: false,
				  render: function (data, type, full, meta) {
					const formattedDate = moment(full.due_date).format('MMMM D, YYYY');
					return `<span>${formattedDate}</span>`;
				  }
				},
                {
                  // For per_share
                  targets: 3,
                  searchable: false,
                  orderable: false,
                  render: function (data, type, full, meta) {
                    var $per_share = full['amount_due'];
                    var $output = '<span class="text-body">' +"PHP" +" "+ $per_share + '</span>';
                    return $output;
                  }
                },
                {
                  // Total
                  targets: 4,
                  searchable: false,
                  orderable: false,
                  render: function (data, type, full, meta) {
                    var $status = full['status']; // Example statuses: 'Approved', 'Pending', 'Rejected'
                    var $badgeClass = '';
                
                    // Assign badge color based on status
                    if ($status === 'paid') {
                      $badgeClass = 'badge bg-success'; // Green badge
                    } else if ($status === 'pending') {
                      $badgeClass = 'badge bg-warning '; // Yellow badge
                    } else if ($status === 'Rejected') {
                      $badgeClass = 'badge bg-danger'; // Red badge
                    } else {
                      $badgeClass = 'badge bg-secondary'; // Grey badge for unknown statuses
                    }
                
                    // Use a span element styled like a badge
                    var $output = '<span class="' + $badgeClass + '">' + $status + '</span>';
                    return $output;
                  }
                },
				{
					targets: -1,
					title: 'Actions',
					searchable: false,
					orderable: false,
					className: "text-center",
					render: function (data, type, full, meta) {
					  return (
						'<div class="d-inline-block text-nowrap">' +
						  '<a href="' + BASE_URL + 'Loans/Loan/view_invoice/' + full['id'] + '" class="btn btn-primary">View & Pay</a>' +

						'</div>'
					  );
					}
				  }
                
                  
              ],
			order: [[3, "desc"]],
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
