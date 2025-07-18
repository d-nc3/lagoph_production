
function initUserDataTable() {
  var table = $(".datatables-user");

  if (!table.length) return;

  window.dt = table.DataTable({
    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
    processing: true,
    serverSide: true,
    ajax: {
      url: `${BASE_URL}Transaction/Transaction/user_dt_list`,
      type: "POST",
      data: function (d) {
        d.status = $("#status-filter").val();
       
      },
    },
    columns: [
      { data: "" },
      { data: "name" },
      { data: "date_issued" },
      { data: "status" },
      { data: "actions" },
    ],
    columnDefs: [ 
      {
        targets: 0,
        className: "control",
        searchable: false,
        orderable: false,
        responsivePriority: 2,
        render: () => "",
      },
      {
        targets: 1,
        responsivePriority: 2,
        render: function (data, type, full) {
          var $name = full.first_name + " " + full.last_name,
              $email = full.email,
              $initials = ($name.match(/\b\w/g) || []).join("").toUpperCase().substring(0, 2),
              $state = ["success", "danger", "warning", "info", "dark", "primary", "secondary"][full.id % 7],
              $avatar = `<span class="avatar-initial rounded-circle bg-label-${$state}">${$initials}</span>`;

          return `
            <div class="d-flex justify-content-start align-items-center user-name">
              <div class="avatar-wrapper">
                <div class="avatar avatar-sm me-3">${$avatar}</div>
              </div>
              <div class="d-flex flex-column">
                <a href="${BASE_URL}Cashiering/view/${full.id}" class="text-body text-truncate"><span class="fw-medium name">${$name}</span></a>
                <small class="text-muted email">${$email}</small>
              </div>
            </div>`;
        },
      },
      {
        targets: 2,
        render: (data, type, full) =>
          `<span>${full.date_issued || "-"}</span>`,
      },
      {
        targets: 3,
        render: (data, type, full) => {
          let statusClass = "badge bg-secondary";
          if (full.status === "Completed") statusClass = "badge bg-success";
          else if (full.status === "Payment Initiated") statusClass = "badge bg-warning";
          return `<span class="${statusClass}">${full.status}</span>`;
        },
      },
      {
        targets: -1,
        title: "Actions",
        searchable: false,
        orderable: false,
        render: function (data, type, full) {
          const invoiceUrl = `${BASE_URL}Transaction/Transaction/view/${full.id}`;
          return `
            <div class="d-flex align-items-center">
              <div class="dropdown">
                <a href="${invoiceUrl}" class="btn btn-primary d-grid ml-2" style="margin-left: 2px;" data-bs-toggle="tooltip" title="Invoice">
                  <i class="bx bx-pen mx-1"></i>
                </a>
              </div>
            </div>`;
        },
      },
    ],
    order: [[0, "asc"]],
  });
}

function initFilterEvents() {
  $("#status-filter").on("change", function () {
    if (window.dt) window.dt.ajax.reload();
  });

  $("#search").on("input", debounce(function () {
    if (window.dt) window.dt.ajax.reload();
  }, 500));
}

function initDeleteButton() {
  $(".invoice-list-table tbody").on("click", ".delete-record", function () {
    if (typeof dt_invoice !== "undefined") {
      dt_invoice.row($(this).parents("tr")).remove().draw();
    }
  });
}

function debounce(func, delay) {
  let timeout;
  return function () {
    const context = this;
    const args = arguments;
    clearTimeout(timeout);
    timeout = setTimeout(() => func.apply(context, args), delay);
  };
}


function customizeDataTableStyles() {
  setTimeout(() => {
    $(".dataTables_filter .form-control").removeClass("form-control-sm");
    $(".dataTables_length .form-select").removeClass("form-select-sm");
  }, 300);
}

$(function () {
  initUserDataTable();
  initFilterEvents();
  initDeleteButton();
  customizeDataTableStyles();
});
