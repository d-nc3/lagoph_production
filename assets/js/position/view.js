/**
 * Page User List
 */

'use strict';

// Datatable (jquery)
$(function () {
  // Variable declaration for table
  var table = $('.datatable-position');

  if (table.length) {
    var dt = table.DataTable({
      lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]], 
      processing: true,
      serverSide: true,
      ajax: { 
        url: `${BASE_URL}Position/dt_list`,
        type: "POST",
        data: function(d) {
          d.department_id = $("#department-id").val();
          d.unit_id = $("#id").val();
        }
      },
      columns: [
        { data: null },
        { data: "position_title" },
        { data: "description" }
      ],
      columnDefs: [
        {
          targets: 0,
          className: 'control',
          searchable: false,
          orderable: false,
          responsivePriority: 2,
          render: function (data, type, full, meta) {
            return '';
          }
        },
        {
          targets: 1,
          render: function (data, type, full, meta) {
            var $position_title = full['position_title'];
            return '<span>' + $position_title + '</span>';
          }
        },
        {
          targets: 2,
          render: function (data, type, full, meta) {
            var $description = full['description'];
            return '<span>' + $description + '</span>';
          }
        },
      ],
      order: [[1, 'desc']],
      language: {
        sLengthMenu: '_MENU_',
        search: '',
        searchPlaceholder: 'Search..'
      },
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              var $name = data['position_title'] ;
              return 'Details of ' + $name;
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                    col.rowIndex +
                    '" data-dt-column="' +
                    col.columnIndex +
                    '">' +
                    '<td>' +
                    col.title +
                    ':' +
                    '</td> ' +
                    '<td>' +
                    col.data +
                    '</td>' +
                    '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/><tbody />').append(data) : false;
          }
        }
      }
    }); 
  }

});
