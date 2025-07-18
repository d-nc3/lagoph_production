var table = $('#accountTransactionsTable');

var loadTransactionsTable = function () {
  if (table.length) {
    var dt = table.DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: BASE_URL + 'Transaction_controller/transaction_list',
        type: 'POST'
      },
      columns: [
        { data: 'date' },
        { data: 'type' },
        { data: 'description' },
        {
          data: 'amount',
          render: function (data, type, row) {
            return `<span class="${data < 0 ? 'text-danger' : 'text-success'}">${parseFloat(data).toFixed(2)}</span>`;
          }
        },
        { data: 'currency' },
        {
          data: null,
          orderable: false,
          searchable: false,
          render: function (data, type, full) {
            return `
              <button class="btn btn-sm btn-primary" data-id="${full.id}">View</button>
              <button class="btn btn-sm btn-danger delete-transaction" data-id="${full.id}">Delete</button>
            `;
          }
        }
      ],
      order: [[0, 'desc']]
    });

    dt.on('draw', function () {
      // You can attach custom logic here if needed
    });
  }
};
