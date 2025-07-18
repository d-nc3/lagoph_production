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

  var table = $(".datatables-view-loan"),
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
      processing: !0,
      serverSide: !0,
      ajax: {
        url: `${BASE_URL}Loans/Loan/loan_dt_list`,
        type: "POST",
        data: function (d) {
          d.user_id = $("#user_id").val();
        },
      },
      columns: [
        { data: null },
        { data: "id" },
        { data: "status" },
        { data: "loan_reference_number" },
        { data: "loan_amount" },
        { data: "actions" },
      ],
      columnDefs: [
        {
          targets: 0,
          className: "dt-control",
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
            var $loan_amount = full.loan_amount;
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
          targets: 2,
          render: function (data, type, full, meta) {
            var loan_type = full.loan_type;
            return (
              "<span class='text-truncate d-flex align-items-center'>" +
              loan_type +
              "</span>"
            );
          },
        },
        {
          targets: 3,
          render: function (data, type, full, meta) {
            var $status = full.loan_status;
            var $badgeClass = "";
            if ($status === "paid") {
              $badgeClass = "badge bg-success";
            } else if ($status === "pending") {
              $badgeClass = "badge bg-warning ";
            } else if ($status === "Rejected") {
              $badgeClass = "badge bg-danger";
            } else {
              $badgeClass = "badge bg-secondary";
            }

            var $output =
              '<span class="' + $badgeClass + '">' + $status + "</span>";
            return $output;
          },
        },
        {
          targets: -1,
          title: "Actions",
          searchable: !1,
          orderable: !1,
          render: function (data, type, full, meta) {
            console.log(full.due_date);
            return `

					<a href="#"

					class="btn btn-sm btn-primary view_modal"

					data-bs-toggle="modal"

					data-bs-target="#data_table_modal"

					data-date-due="${full["due_date"]}"

					data-amount-due="${full["amount_due"]}">

					<i class="bx bx-show me-1"></i> <span class="d-md-inline-block">View</span>

					</a>`;
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
    });
    table.on("click", "td.dt-control", function () {
      var tr = $(this).closest("tr");
      var row = dt.row(tr);
      if (row.child.isShown()) {
        row.child.hide();
      } else {
        var data = row.data();
        row
          .child(
            `

					<div class="child-content">

						<div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">

							<div><strong>Due Date:</strong></div>

							<div></div>

						</div>

						<div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">

							<div><strong>Amount Due:</strong></div>

							<div></div>

						</div>

						<div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">

							<div><strong>Remaining Balance:</strong></div>

							<div></div>

						</div>

						<div style="display: flex; justify-content: space-between;">

							<div><strong>Status:</strong></div>

							<div></div>

						</div>

					</div>

				`
          )
          .show();
        row.child().css("background-color", "#f8f9fa");
      }
    });
    table.on("draw", function () {
      table.rows().every(function () {
        this.child.show();
        this.nodes().to$().addClass("parent");
      });
    });
    setTimeout(() => {
      $(".dataTables_filter .form-control").removeClass("form-control-sm");
      $(".dataTables_length .form-select").removeClass("form-select-sm");
    }, 300);
  }
});
document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".view_modal").forEach((btn) => {
    btn.addEventListener("click", function () {
      const dateDue = "emenets";
      const amountDue = parseFloat(this.dataset.amount_due).toLocaleString();
      const row = `<tr>

					  <td>1</td>

					  <td>${dateDue}</td>

					  <td>PHP ${amountDue}</td>

					 </tr>`;
      document.getElementById("tableBody").innerHTML = row;
      document.getElementById("due_date").textContent = dateDue;
      document.getElementById("amount_due").textContent = "PHP " + amountDue;
    });
  });
});
