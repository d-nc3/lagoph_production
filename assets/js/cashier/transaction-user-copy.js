$(function(){var table=$('.datatables-user');if(table.length){var dt=table.DataTable({lengthMenu:[[10,25,50,-1],[10,25,50,"All"]],processing:!0,serverSide:!0,ajax:{url:`${BASE_URL}User/user_dt_list`,type:"POST",data:function(d){}},columns:[{data:'name'},{data:'role'},{data:'actions'}],columnDefs:[{targets:0,responsivePriority:4,render:function(data,type,full,meta){var $name=full.first_name+' '+full.last_name,$email=full.email;var states=['success','danger','warning','info','dark','primary','secondary'];var $state=states[full.id%states.length],$initials=$name.match(/\b\w/g)||[];$initials=(($initials.shift()||'')+($initials.pop()||'')).toUpperCase();var $output='<span class="avatar-initial rounded-circle bg-label-'+$state+'">'+$initials+'</span>';var $row_output=`
                        <div class="d-flex justify-content-start align-items-center user-name">
                          <div class="avatar-wrapper">
                            <div class="avatar avatar-sm me-3">
                              ${$output}
                            </div>
                          </div>
                          <div class="d-flex flex-column">
                            <a href="${BASE_URL}Cashiering/view/${full['id']}" class="text-body text-truncate"><span class="fw-medium name">${$name}</span></a>
                            <small class="text-muted email">${$email}</small>
                          </div>
                        </div>
                        `;return $row_output}},{className:'control',responsivePriority:2,searchable:!1,targets:1,render:function(data,type,full,meta){const role=full.role;function getRoleBadge(role){switch(role.toLowerCase()){case 'admin':return `<span class="badge badge-center rounded-pill bg-label-danger w-px-30 h-px-30 me-2">
                                                <i class="bx bx-shield-quarter bx-xs"></i>
                                            </span>
                                            <span>Admin</span>`;case 'user':return `<span class="badge badge-center rounded-pill bg-label-primary w-px-30 h-px-30 me-2">
                                                <i class="bx bx-user bx-xs"></i>
                                            </span>
                                            <span>User</span>`;case 'moderator':return `<span class="badge badge-center rounded-pill bg-label-warning w-px-30 h-px-30 me-2">
                                                <i class="bx bx-gavel bx-xs"></i>
                                            </span>
                                            <span>Moderator</span>`;case 'guest':return `<span class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30 me-2">
                                                <i class="bx bx-user-plus bx-xs"></i>
                                            </span>
                                            <span>Guest</span>`;default:return `<span class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30 me-2">
                                                <i class="bx bx-help-circle bx-xs"></i>
                                            </span>
                                            <span>Unknown</span>`}}
return getRoleBadge(role)}},{targets:-1,title:'Actions',searchable:!1,orderable:!1,render:function(data,type,full,meta){const id=full.id;const invoiceUrl=`${BASE_URL}Transaction/view/${id}`;return('<div class="d-flex align-items-center">'+'<div class="dropdown">'+`<a href="${invoiceUrl}" data-bs-toggle="tooltip" class="btn btn-primary d-grid ml-2" style="margin-left: 2px;" data-bs-placement="top" title="Invoice"><i class="bx bx-pen mx-1"></i></a>`+'</div>'+'</div>')}}],order:[[0,'asc']]});$('#status-filter').on('change',function(){dt.ajax.reload()})}
$('.invoice-list-table tbody').on('click','.delete-record',function(){dt_invoice.row($(this).parents('tr')).remove().draw()});setTimeout(()=>{$('.dataTables_filter .form-control').removeClass('form-control-sm');$('.dataTables_length .form-select').removeClass('form-select-sm')},300)})