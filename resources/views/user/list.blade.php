@extends('layout.master')

@section('subheader')
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class=" kt-container  d-flex align-items-stretch justify-content-between ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Users </h3>
				<div class="kt-subheader__breadcrumbs">
					<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon-users"></i></a>
					<span class="kt-subheader__breadcrumbs-separator"></span>
					<a href="" class="kt-subheader__breadcrumbs-link">
						Master Users</a>
					
				</div>
			</div>
			<div class="kt-subheader__toolbar">
				<div class="kt-subheader__wrapper">
					<a href="{{ route('formuser') }}" class="btn kt-subheader__btn-secondary">
						Tambah User
					</a>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('content')

{{-- 	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-light alert-elevate" role="alert">
				<div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
				<div class="alert-text">
					Each column has an optional rendering control called columns.render which can be used to process the content of each cell before the data is used.
					See official documentation <a class="kt-link kt-font-bold" href="" >here</a>.
				</div>
			</div>		
		</div>
	</div>
 --}}
	<div class="row">
		<div class="col">
			<div class="kt-portlet kt-portlet--mobile">
				<div class="kt-portlet__head kt-portlet__head--lg">
					<div class="kt-portlet__head-label">
						<span class="kt-portlet__head-icon">
							<i class="kt-font-brand flaticon-users-1"></i>
						</span>
						<h3 class="kt-portlet__head-title">
							Master Users
						</h3>
					</div>
					<div class="kt-portlet__head-toolbar">
						<div class="kt-portlet__head-wrapper">
						
						</div>
					</div>
				</div>
				<div class="kt-portlet__body">

							<!--begin: Datatable -->
							<table class="table table-striped- table-hover table-checkable" id="table_list">
								<thead>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th><input type="text" class="form-control form-control-sm form-filter kt-input" placeholder="Username" id="s_username" name="s_username"/></th>
                                        <th><input type="text" class="form-control form-control-sm form-filter kt-input" placeholder="Nama Lengkap" id="s_nama" name="s_nama"/></th>
                                        <th><input type="text" class="form-control form-control-sm form-filter kt-input" placeholder="Email" id="s_email" name="s_email"/></th>
                                        <th><input type="text" class="form-control form-control-sm form-filter kt-input" placeholder="Jenis User" id="s_jenis_user" name="s_jenis_user"/></th>
                                        <th><input type="text" class="form-control form-control-sm form-filter kt-input" placeholder="Nama Role" id="s_rolename" name="s_rolename"/></th>
                                        <th>
                                            <select class="form-control form-control-sm form-filter kt-input" title="Select" id="s_status" name="s_status">
                                                <option value="">--all--</option>
                                                <option value="1">Aktif</option>
                                                <option value="0">Non Aktif</option>
                                                <option value="3">Block</option>
                                            </select>
                                        </th>
                                        <th style="min-width:100px">
											<button type="button" class="btn btn-brand btn-icon btn-sm" id="btn-search"><i class="fa flaticon2-search"></i></button>
											<button type="button" class="btn btn-outline-brand btn-icon btn-sm" id="btn-clear"><i class="fa flaticon2-delete"></i></button>
										</th>
                                    </tr>
									<tr>
										<th>No</th>
										<th>Username</th>
										<th>Nama Lengkap</th>
										<th>Email</th>
										<th>Jenis User</th>
										<th>Nama Role</th>
										<th>Status</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
							<!--end: Datatable -->
						
				</div>
			</div>
		</div>
	</div>



<script type="text/javascript">
	var token = '{{ Session::get('token') }}';

    var LoadPage = function() {
        function blockui(){
		    KTApp.blockPage({overlayColor: '#000000',type: 'v2',state: 'success',message: 'Please wait...'});
	    }
        var initTable1 = function() {
            $('#btn-clear').click(function(){
                $('.form-filter').val('');
            });

            $('#btn-search').click(function(){
                $('#table_list').dataTable().fnDraw();
            });

			var col_order = ["users.username","app_profile.nama", "users.email",  "app_profile.jenis_user", "app_roles.name","app_profile.status"];
            var table = $('#table_list').DataTable({
                
				responsive: true,

                // Pagination settings
                dom: "<'row'<'col-sm-12'tr>>\
                <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
                // read more: https://datatables.net/examples/basic_init/dom.html

                lengthMenu: [5, 10, 25, 50],

                pageLength: 10,

                language: {
                    'lengthMenu': 'Display _MENU_',
                },
                ordering:true,
                // order:[[1,"asc"]],
                searchDelay: 500,
                processing: true,
                serverSide: true,
		        ajax: function(data, callback, settings) {
		            $.ajax({
		                url: "<?php echo URL::to('api/auth/user_list'); ?>",
						data: {
							limit: settings._iDisplayLength,
							page: Math.ceil(settings._iDisplayStart / settings._iDisplayLength) + 1,
                            nama : $('#s_nama').val(),
                            username : $('#s_username').val(),
                            email : $('#s_email').val(),
                            jenis_user : $('#s_jenis_user').val(),
                            rolename : $('#s_rolename').val(),
                            status : $('#s_status').val(),
							order: col_order[settings.aaSorting[0][0]]+' '+settings.aaSorting[0][1],
							
						},
		                type: "GET",
		                beforeSend: function(request) {
		                	blockui();
		                    request.setRequestHeader('Authorization', 'Bearer ' + token);
		                },
		                success: function(res) {
							// KTApp.unblockPage();
		                    callback({
		                        recordsTotal: res.data.total,
		                        recordsFiltered: res.data.total,
		                        data: res.data.data
		                    });
		                },
		            })
		        },
		        columns: [	
		        	{
					    "data": "id",
                        "orderable": false,
					    render: function (data, type, row, meta) {
					        return meta.row + meta.settings._iDisplayStart + 1;
					    }
					},		
					{
		                "data": "username",
		            },
		            {
		                "data": "nama",
		            },
		            {
		                "data": "email",
		            },
		            {
		                "data": "jenis_user",
		            },
		            {
		                "data": "rolename",
		            },
		            {
						"data": {status:"status"},
						"render": function(data, type, full, meta) {
							
							var status = {
								0: {'title': 'Tidak Aktif', 'class': ' kt-badge--warning'},
								1: {'title': 'Aktif', 'class': 'kt-badge--primary'},
								2: {'title': 'Block', 'class': 'kt-badge--danger'},
							}
							var sts = data.status ? data.status : 0;
							return '<span class="kt-badge ' + status[sts].class + ' kt-badge--inline kt-badge--pill">' + status[sts].title + '</span>';
		                }
					},
		            {
						"data": {id:"id"},
		                "orderable": false,
						"render": function(data, type, full, meta) {
							
							str = '<div class="dropdown-menu dropdown-menu-right">'+
							   			'<a class="dropdown-item" href="<?php echo URL::to('/'); ?>'+'/formuser/'+data.id+'"><i class="la la-edit"></i> Edit</a>'+
										'<a class="dropdown-item reset_pass" href="javascript:;" data-id="'+data.id+'"><i class="la la-key"></i> Reset Password</a>'+
							   		'</div>';
						
							return '<span class="dropdown">'+
								   		'<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">'+
								   			'<i class="la la-ellipsis-h"></i>'+
								   		'</a>'+
								   		str+
								   	'</span>';
		                }
		            },
		            
		        ],

				"initComplete": function(settings, json) {
					$('.reset_pass').click(function(e){
						id = $(this).data("id"); 
						// console.log('ok '+id);
						swal.fire({
							title: 'Konfirmasi?',
							text: "Yakin akan reset password?",
							type: 'warning',
							showCancelButton: true,
							confirmButtonText: 'Ya, Reset Password!'
						}).then(function(result) {
							if (result.value) {
								blockui();
								url = "<?php echo URL::to('api/auth/reset_pass'); ?>";
								
								$.ajax({
									url         : url,
									method      : 'post',
									dataType    : 'json',
									beforeSend: function(request) {
											request.setRequestHeader('Authorization', 'Bearer ' + token);
										},
									data 		: {
										id : id,
									},success: function(data, status) {
										// KTApp.unblockPage();
										$('#alertvalidate').html('');
										// KTApp.unblockPage();
										// $('#tablemaster').dataTable().fnDraw();
										swal.fire("Sukses!", "Reset Password Berhasil!!", "success");
										
									},
									error: function(jqXHR, textStatus, errorThrown) {
										// console.log(data.responseJSON.errors)
										// alert(data);
										// KTApp.unblockPage();
										if (jqXHR.status == 404) {
											alert = '<div class="alert alert-warning" role="alert">'+
												'<div class="alert-icon"><i class="flaticon-warning"></i></div>'+
												'<div class="alert-text">' +jqXHR.responseJSON.message+
												'</div>'+
											'</div>';
											
											$('#alertvalidate').html(alert);
											swal.fire("Gagal!", "Data Gagal disimpan!!", "error");
											
										} else if (jqXHR.status == 422) {
											var response = JSON.parse(jqXHR.responseText);
											var errorString = '<ul>';
											$.each(response.errors, function(key, value) {
												errorString += '<li>' + value + '</li>';
											});
											errorString += '</ul>';

											alert = '<div class="alert alert-warning" role="alert">'+
												'<div class="alert-icon"><i class="flaticon-warning"></i></div>'+
												'<div class="alert-text">' +errorString+
												'</div>'+
											'</div>';

											$('#alertvalidate').html(alert);

											swal.fire("Gagal!", "Data Gagal disimpan, Periksa Inputan!!", "error");
										} else {
											swal.fire("Gagal!", "Kesalahan System / Network Error...!", "error");
											
										}
									}
								});    
							}
						});
					});
				}
		    });
        }

        return {

            //main function to initiate the module
            init: function() {
                initTable1();
            }
        };
    }();

    jQuery(document).ready(function() {
        LoadPage.init();
    });

	$(document).ajaxStop($.unblockUI); //unblockui jika setiap proses ajax selesai

</script>

@endsection


