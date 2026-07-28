@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Manual Book </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content" >
        <div class="container-fluid">
            <div class="row">
                <section class="col-lg-12">
                    <div class="card direct-chat direct-chat-success" id="divawal">
                        <div class="card-header">
                            <h3 class="card-title">{!! Session('namaapps01') !!} </h3>
                            <div class="card-tools">
								<button type="button" class="btn btn-tool" id="btnviewtambah">
                                    <i class="fa fa-plus"></i> 
                                </button>
								<button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                        	<div id="tabeldata"></div>
						</div>
                    </div>
                </section>
            </div>
		</div>
	</div>
</div>
<div class="modal fade" id="modaluploadsuratcustom">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload Template</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Template</label>
					<input type="text" class="form-control" id="srtcustom_nama" name="srtcustom_nama" />
                </div>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="srtcustom_file">File PDF</label>
                    <div class="input-group input-group-sm">
                        <input type="file" class="form-control" id="srtcustom_file">
                        <div class="input-group-append">
                            <div class="btn btn-primary">
                                <i class="fa fa-file-pdf-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-success pull-right" id="btnsimpansuratcustom">Simpan</button>
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>	
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="id_nmfile" id="id_nmfile">
<input type="hidden" name="id_ukfile" id="id_ukfile">
<input type="hidden" name="id_jnfile" id="id_jnfile">
<input type="hidden" name="set_idupload" id="set_idupload">
<input type="hidden" name="set_nmuploader" id="set_nmuploader" value="{{Session('nama')}}">
<input type="hidden" name="set_jabuploader" id="set_jabuploader" value="{{Session('previlage')}}">

<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@push('script')
<script>
	$('#srtcustom_file').change(function () {
        var imgPath = this.value;
        var ukfile 	= this.files[0].size;
        var ext 	= imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        $("#id_jnfile").val(ext);
        $("#id_ukfile").val(ukfile);
    });	
	function openedpage( jQuery ){
		var set01='template';
		var token=document.getElementById('token').value;
		var source = {
			datatype: "json",
			datafields: [
				{ name: 'idne'},
				{ name: 'deskripsi', type: 'text'},
				{ name: 'status', type: 'text'},
				{ name: 'datadukung', type: 'text'},
				{ name: 'created_by', type: 'text'},
				{ name: 'updated_by', type: 'text'},
				{ name: 'created_at', type: 'text'},
				{ name: 'updated_at', type: 'text'},
			],
			type: 'POST',
			data: {val01: set01, _token: token},
			url: 'dev/tasklist',
		};
		var dataAdapter = new $.jqx.dataAdapter(source);
		$("#tabeldata").jqxGrid({
			width: '100%',
			pageable: true,
			autoheight: true,
			filterable: true,
			source: dataAdapter,
			sortable: true,
			columnsresize: true,
			showfilterrow: true,
			theme: "energyblue",
			selectionmode: 'multiplecellsextended',
			columns: [
                { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
                    return "Del";
                    }, buttonclick: function (row) {
                        editrow         = row;
                        var offset 		= $("#tabeldata").offset();		
                        var dataRecord 	= $("#tabeldata").jqxGrid('getrowdata', editrow);
                        var created_by	= dataRecord.created_by;
                        var nmuploader	= document.getElementById('set_nmuploader').value;
                        var token   	= document.getElementById('token').value;
                        if (nmuploader == created_by){
                            swal({
                                title: 'Are you sure?',
                                text: "You won't be able to revert this!",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonClass: 'btn btn-confirm mt-2',
                                cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                                confirmButtonText: 'Yes, delete it!'
                            }).then(function () {
                                var set02		= dataRecord.idne;
                                var form_data = new FormData();
                                    form_data.append('file', null);
                                    form_data.append('val01', 'delete');
                                    form_data.append('val02', set02);
                                    form_data.append('val03', 'template');
                                    form_data.append('_token', '{{csrf_token()}}');
                                $.ajax({
                                    url: '{{ route("exTaskadd") }}',
                                    data: form_data,
                                    type: 'POST',
                                    contentType: false,
                                    processData: false,
                                    success: function (data) {
                                        var status  = data.status;
                                        var message = data.message;
                                        var warna 	= data.warna;
                                        var icon 	= data.icon;
                                        $("#tabeldata").jqxGrid('updatebounddata');
                                        $.toast({
                                            heading: status,
                                            text: message,
                                            position: 'top-right',
                                            loaderBg: warna,
                                            icon: icon,
                                            hideAfter: 5000,
                                            stack: 1
                                        });	
                                        return false;
                                    },
                                    error: function (xhr, status, error) {
                                        swal({
                                            title: 'Error..!!!',
                                            text: xhr.responseText,
                                            type: 'info',
                                        });
                                    }
                                });
                            });
                        } else {
                            swal({
                                title   : 'Stop',
                                text    : 'Hanya Uploader yang boleh menghapus data ini',
                                type    : 'warning',
                            })
                        }
                    }
                },	
				{ text: 'Created At', datafield: 'created_at', width: '20%', cellsalign: 'left', align: 'center'  },
				{ text: 'Created By', datafield: 'created_by', width: '20%', cellsalign: 'left', align: 'center'  },
				{ text: 'Unit', datafield: 'updated_by', width: '10%', cellsalign: 'left', align: 'center'  },
				{ text: 'Description', datafield: 'deskripsi', width: '40%', cellsalign: 'left', align: 'center'  },
				{ text: 'File', datafield: 'datadukung', width: '5%', cellsalign: 'center', align: 'center'  },
			]
		});
	}
	$(document).ready(function () {
		$("#btnsimpansuratcustom").click(function(){
			var set01 	= document.getElementById('srtcustom_file');
			var set02	= document.getElementById('srtcustom_nama').value;
			var token 	= document.getElementById('token').value;
			if ($('#srtcustom_file').val() == ''){
				swal({
					title	: 'Stop',
					text	: 'File Kosong',
					type	: 'warning',
				})
			} else if (set02 == ''){ 
				swal({
					title: 'Mohon lengkapi',
					text: 'Deskrips Tugas Tidak Boleh Kosong',
					type: 'info',
				});
			}
			else {
				$('#loadingimage').hide();
				$('#modaluploadsuratcustom').modal('hide');
				var form_data = new FormData();
					form_data.append('file', set01.files[0]);
					form_data.append('val01', 'new');
					form_data.append('val02', set02);
					form_data.append('val03', 'template');
					form_data.append('_token', '{{csrf_token()}}');
				$.ajax({
					url: '{{ route("exTaskadd") }}',
					data: form_data,
					type: 'POST',
					contentType: false,
					processData: false,
					success: function (data) {
						var status  = data.status;
						var message = data.message;
						var warna 	= data.warna;
						var icon 	= data.icon;
						$("#tabeldata").jqxGrid('updatebounddata');
						$.toast({
							heading: status,
							text: message,
							position: 'top-right',
							loaderBg: warna,
							icon: icon,
							hideAfter: 5000,
							stack: 1
						});	
						return false;
					},
					error: function (xhr, status, error) {
						swal({
							title: 'Error..!!!',
							text: xhr.responseText,
							type: 'info',
						});
					}
				});
			}
		});
		$("#btnviewtambah").click(function(){
            var jabuploader	= document.getElementById('set_jabuploader').value;
			if (jabuploader == 'PEJABAT' || jabuploader == 'Admin SDM' || jabuploader == 'administrasi'){
                $('#modaluploadsuratcustom').modal('show');
                $("#srtcustom_file").val('');
                $("#srtcustom_nama").val('');
            } else {
                swal({
                    title   : 'Stop',
                    text    : 'Tidak cukup previlage',
                    type    : 'warning',
                })
            }
			
		});
		openedpage();
	});
</script>
@endpush