@extends('base.layout')

@section('content')
<div class="content-wrapper">
	<section class="content-header">
      <h1>
        Kotak Surat
        <small>{{ Session('nama') }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kotak Surat</li>
      </ol>
    </section>
	<section class="content">
		<div id="divawal">
			<div class="row">
				<div class="col-md-12" id="divboxsend">
					<div class="box box-success">
						<div class="box-body">
						<button class="btn btn-danger" id="btndispomulti">Multi Disposisi</button>
						<div id="tabeldata"></div>
						</div>
					</div>
				</div>
				<div class="col-md-12" id="divcari">
					<div class="box box-danger">
						<div class="box-header with-border">
							<h3 class="box-title">Box List</h3>
							<div class="box-tools pull-right">		
								<button class="btn btn-box-tool" id="btnclose"><i class="fa fa-times"></i></button>
							</div>
						</div><!-- /.box-header -->
						<div class="box-body">
							<div id="tabelcari"></div>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
				<div class="col-md-3">
					<div class="box box-danger">
						<div class="box-header with-border">
							<i class="fa fa-users"></i>
							<h3 class="box-title">Folder</h3>			  
						</div><!-- /.box-header -->
						<div class="box-body">
							<div id="gridfolder"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="divviewsurat">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box-header with-border">
							<i class="fa fa-chrome"></i>
							<h3 class="box-title">View Surat</h3>
							<div class="box-tools pull-right">
								<a href="#" id="btnopennewwindow" target="_blank"><button class="btn bg-green btn-sm"><i class="fa fa-download"></i> Download File</button></a>
								<button class="btn bg-red btn-sm" id="btntutup"><i class="fa fa-close"></i></button>						
							</div>
						</div><!-- /.box-header -->
						<div class="box-body no-padding">
							<div class="box-body">
								<div id="loadingviewimage">
									<img src="{{ asset('dist/img/loading.gif') }}" class="img-responsive">
									<label id="judulloading"></label>
								</div>
								<div id="divsurat"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="formadddisposisi">
			<div class="row">
			<section class="col-lg-12">
			  <div class="box box-success">
				<div class="box-header with-border">
				  <h3 class="box-title">Kirim Disposisi</h3>				   
				</div><!-- /.box-header -->	
				<div class="box-body">
					<div class="box-body">
					<form class="form-horizontal" action="{{ url('surat/excreatedisposisi') }}" method="POST" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group"> 			
						  <div class="row">
							  <div class="col-lg-10 col-md-9">
								 <label for="id_kepada">Disposisi Kepada *</label>
								 <select id="id_kepada" name="kepada[]" class="form-control select2" multiple="multiple" data-placeholder="Boleh pilih lebih dari satu" style="width: 100%;">
									@foreach($pejabat as $rpejabat)
										<option value="{{ $rpejabat['kode'] }}">{{ $rpejabat['nama'] }}</option>
									@endforeach
								</select>
								<div id="wajibdiisi"><p class="help-block"><font color="red">Wajib Di ISI</font></p></div>
							  </div>
							  <div class="col-lg-2 col-md-3">
								 <label for="id_sifatdiposisi">Sifat</label>
								 <select id="id_sifatdiposisi" name="id_sifatdiposisi" class="form-control" >
									<option value="Biasa">Biasa</option>
									<option value="Segera">Segera</option>
									<option value="Amat Segera">Amat Segera</option>
									<option value="Rahasia">Rahasia</option>
								</select>
							  </div>
						  </div>			  	  
						</div>
						<div class="form-group"> 			
							<div class="row">
								@foreach($mcmdispo as $id => $name)
									@if($name['id'] == '16' OR $name['id'] == '17')
										<div class="col-lg-6 col-md-6">
											<div class="checkbox checkbox-success">
												<label for="{{$name['id']}}">
													{!! Form::checkbox("formDoor[]", $name['disposisi'], null, array('id'=>$name['id'])) !!}
													<font color="blue">{{$name['disposisi']}}</font>
												</label>
										   </div>
										</div><!-- /.col-lg-6 -->
									@else
										<div class="col-lg-6 col-md-6">
											<div class="checkbox checkbox-success">
												<label for="{{$name['id']}}">
													{!! Form::checkbox("formDoor[]", $name['disposisi'], null, array('id'=>$name['id'])) !!}
													{{$name['disposisi']}}
												</label>
										   </div>
										</div><!-- /.col-lg-6 -->
									@endif
								@endforeach
							</div><!-- /.row -->
						</div>
						<div class="form-group"> 			
							<label for="id_disposisi">Isi Disposisi</label>
							<textarea id="id_disposisi" name="id_disposisi" style="width: 100%; height: 200px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>			  	  
						</div>
						<div class="form-group">
							<input type="hidden" id="id_surid" name="id_surid">
							<input type="hidden" id="id_marking" name="id_marking">
							<input type="hidden" id="id_pemberi" name="id_pemberi" value="{{ Session('jabatan') }}">
							<button type="submit" class="btn btn-success pull-left" id="sampaikandisosisi">Kirim</button>
							<button type="button" class="btn btn-danger pull-right" id="btnkembali">Cancel</button>
						</div>
					</form>
					</div><!-- /.box-body -->
				</div><!-- /.box-body -->
				<div id="loadingimage">
					<img src="{{ asset('dist/img/loading.gif') }}" class="img-responsive">
					<label id="judulloading2"></label>
				</div>
				
				<div id="pdfRenderer"></div>
			  </div><!-- /.box -->
			</section>
			</div>
		</div>
	</section> <!-- end container -->
</div>
<div class="modal modal-info fade" id="modalkelompokkan">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Control Grouping</h4>
	  </div>
	  <div class="modal-body">
		<div class="box-body">
			<div class="form-group">
			  <div class="row">
				  <div class="col-lg-4 col-md-4">
					<label for="set_tanggal">Tanggal</label>
					<input type="text" class="form-control" id="set_tanggal" name="set_tanggal" disabled="disable">
				  </div>
				  <div class="col-lg-8 col-md-8">
					 <label for="set_perihal">Perihal</label>
					 <input type="text" class="form-control" id="set_perihal" name="set_perihal" disabled="disable">
				  </div>
			  </div>
			</div>
			<div class="form-group">
				<label for="set_kelompok">Nama Folder</label>
				<input type="text" class="form-control" id="set_kelompok" name="set_kelompok">
				
			</div>
		</div>
	  </div>
	  <div class="modal-footer">
		<input type="hidden" class="form-control" id="set_idne">
		<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Tutup</button>
		<button type="button" class="btn btn-success pull-right" id="btnsimpan">Save</button>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<div class="modal modal-info fade" id="modaldispomulti">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Multi Disposisi</h4>
	  </div>
	  <div class="modal-body">
		<div class="box-body">
			<div class="form-group">
				<label for="multi_kepada">Disposisi Kepada</label>
				<select id="multi_kepada" name="multi_kepada[]" class="form-control select2" multiple="multiple" data-placeholder="Boleh pilih lebih dari satu" style="width: 100%;">
					@foreach($pejabat as $rpejabat)
						<option value="{{ $rpejabat['kode'] }}">{{ $rpejabat['nama'] }}</option>
					@endforeach
				</select>		  	  
			</div>
			<div class="form-group">
				<label for="multi_sifatdiposisi">Sifat</label>
				<select id="multi_sifatdiposisi" name="multi_sifatdiposisi" class="form-control" >
					<option value="Biasa">Biasa</option>
					<option value="Segera">Segera</option>
					<option value="Sangat Segera">Sangat Segera</option>
					<option value="Rahasia">Rahasia</option>
				</select>
			</div>
			<div class="form-group"> 			
			  <div class="row">
				@foreach($mcmdispo as $id => $name)
					@if($name['id'] == '16' OR $name['id'] == '17')
						<div class="col-xs-6">
							<div class="checkbox checkbox-success">
								<label for="{{$name['id']}}">
									{!! Form::checkbox("formMultidoor[]", $name['disposisi'], null, array('id'=>$name['id'])) !!}
									<font color="blue">{{$name['disposisi']}}</font>
								</label>
						   </div>
						</div><!-- /.col-lg-6 -->
					@else
						<div class="col-xs-6">
							<div class="checkbox checkbox-success">
								<label for="{{$name['id']}}">
									{!! Form::checkbox("formMultidoor[]", $name['disposisi'], null, array('id'=>$name['id'])) !!}
									{{$name['disposisi']}}
								</label>
						   </div>
						</div><!-- /.col-lg-6 -->
					@endif
				@endforeach
			  </div><!-- /.row -->
			</div>
			<div class="form-group"> 			
				<label for="multi_disposisi">Isi Disposisi</label>
				<textarea id="multi_disposisi" name="multi_disposisi" style="width: 100%; height: 200px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
			</div>
		</div>
	  </div>
	  <div class="modal-footer">
		<button class="btn w-lg btn-danger waves-effect waves-light" data-dismiss="modal">Tutup</button>
		<button class="btn w-lg btn-success waves-effect waves-light" id="btnsampaikanmulti">Kirim</button>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@push('script')
<script>
$(function () {
	$('.select2').select2()
	CKEDITOR.env.isCompatible = true;
	CKEDITOR.replace('id_disposisi');
	CKEDITOR.replace('multi_disposisi');
});
$(document).ready(function () {
	$('#formadddisposisi').hide();
	$('#divviewsurat').hide();
	$('#divcari').hide();
	$('#btndispomulti').click(function () {
		$("#multi_kepada").select2("val", "");
		$('input:checkbox').removeAttr('checked');
		CKEDITOR.instances['multi_disposisi'].setData('')
		$("#modaldispomulti").modal('show');
	});
	$('#btnsampaikanmulti').on('click', function (){
		var set01 	= $('#multi_kepada').select2().val();
		var set02 	= CKEDITOR.instances['multi_disposisi'].getData();
		var CHEKED 	= new Array();
		$("input[name='formMultidoor[]']:checked").each(function(){CHEKED.push($(this).val());});
		var rows = $("#tabeldata").jqxGrid('selectedrowindexes');
		var selectedRecords = new Array();
		for (var m = 0; m < rows.length; m++) {
			var row = $("#tabeldata").jqxGrid('getrowdata', rows[m]);
			selectedRecords.push(row.idne);
		}
		var set05 = document.getElementById('multi_sifatdiposisi').value;
		var token = document.getElementById('token').value;
		if (m == 0){
			swal({
				title: 'Surat Belum di Pilih',
				text: 'Centang Surat Yang ingin di Disposisikan Sebelumnya',
				type: 'info',
			});
		} else {
			$.post('surat/excreatedisposisimulti', { val01: set01, val02: set02, val03: CHEKED, val04: selectedRecords, val05: set05, _token: token },
			function(data){
				$("#tabeldata").jqxGrid('updatebounddata', 'filter');
				$("#gridfolder").jqxGrid('updatebounddata', 'filter');
				$("html, body").animate({ scrollTop: 0 }, "slow");
				var status  = data.status;
				var message = data.message;
				$.toast({
					heading: status,
					text: message,
					position: 'top-right',
					loaderBg: '#bf441d',
					icon: 'info',
					hideAfter: 5000,
					stack: 1
				});
				$("#modaldispomulti").modal('hide');
				return false;
			});	
		}
	});
	$('#btnkembali').on('click', function (){		
		$('#divviewsurat').hide();
		$('#formadddisposisi').hide();
		$('#divawal').show();
	});
	$('#btntutup').on('click', function (){		
		$('#divviewsurat').hide();
		$('#formadddisposisi').hide();
		$('#divawal').show();
	});
	$('#btnclose').on('click', function (){		
		$('#divcari').hide();
		$('#divboxsend').show();
	});
	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
		Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
		Windows: function() {
			return navigator.userAgent.match(/IEMobile/i) || navigator.userAgent.match(/WPDesktop/i);
		},
		any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};
	$('#btnsimpan').on('click', function (){		
		var set01 = document.getElementById('set_idne').value;
		var set02 = document.getElementById('set_kelompok').value;
		var token = document.getElementById('token').value;
		$.post('surat/setfolder', { val01: set01, val02: set02, _token: token },
		function(data){
			$("#modalkelompokkan").modal('hide');
			var status  = data.status;
			var message = data.message;
			var warna 	= data.warna;
			var icon 	= data.icon;
			$.toast({
				heading: status,
				text: message,
				position: 'top-right',
				loaderBg: warna,
				icon: icon,
				hideAfter: 5000,
				stack: 1
			});
			$("#tabeldata").jqxGrid('updatebounddata', 'filter');
			$("#gridfolder").jqxGrid('updatebounddata', 'filter');
			return false;
		});		
	});
	var sumbersuratthnini = {
		datatype: "json",
		datafields: [
			{ name: 'kelompok', type: 'text'},
			{ name: 'jumlah', type: 'text'},
			{ name: 'idpegawai', type: 'text'},
		],
		updaterow: function (rowid, rowdata, commit) {commit(true);},
		url: 'surat/mailboxrekap',
		cache: false
	};
	var dataanalis = new $.jqx.dataAdapter(sumbersuratthnini);
	$("#gridfolder").jqxGrid({
		width: '100%',
		filterable: true,
		columnsresize: true,
		autoheight: true,
		pageable: true,
		source: dataanalis,
		theme: "darkblue",
		columns: [
			{ text: 'Detail', columntype: 'button', width: '25%', align: 'center', cellsrenderer: function () {
				return "Detail";
				}, buttonclick: function (row) {
					editrow = row;	
					var offset 		= $("#gridfolder").offset();
					var dataRecord 	= $("#gridfolder").jqxGrid('getrowdata', editrow);
					var set01		= dataRecord.kelompok;
					var set02		= dataRecord.idpegawai;
					$('#divcari').show();
					$('#divboxsend').hide();
					var token 		= document.getElementById('token').value;
					var source = {
						datatype: "json",
						datafields: [
							{ name: 'idne'},
							{ name: 'idsurat', type: 'text'},
							{ name: 'idpegawai', type: 'text'},
							{ name: 'tabel', type: 'text'},
							{ name: 'perihal', type: 'text'},
							{ name: 'pejabat', type: 'text'},
							{ name: 'jabatan', type: 'text'},
							{ name: 'tanggal', type: 'text'},
							{ name: 'asalsurat', type: 'text'},
							{ name: 'fakultas', type: 'text'},
							{ name: 'keterangan', type: 'text'},
							{ name: 'status', type: 'text'},
							{ name: 'isisurat', type: 'text'},
							{ name: 'marking', type: 'text'},
						],
						type: 'POST',
						data: {val01: set01, val02: set02, _token: token},
						url: 'surat/mailbox',
					};
					var dataAdapter = new $.jqx.dataAdapter(source);
					$("#tabelcari").jqxGrid({
						width: '100%',
						pageable: true,
						autoheight: true,
						filterable: true,
						source: dataAdapter,
						columnsresize: true,
						showfilterrow: true,
						theme: "energyblue",
						selectionmode: 'multiplecellsextended',
						columns: [
							{ text: 'Tanggal', datafield: 'tanggal', width: '15%', cellsalign: 'left', align: 'center'  },
							{ text: 'Perihal', datafield: 'perihal', width: '35%', cellsalign: 'left', align: 'center'  },
							{ text: 'Asal Surat.', datafield: 'asalsurat', width: '20%', cellsalign: 'left', align: 'center'  },
							{ text: 'Keterangan', datafield: 'keterangan', width: '15%', cellsalign: 'left', align: 'center'  },
							{ text: 'View', columntype: 'button', width: '7%', cellsrenderer: function () {
								return "View";
								}, buttonclick: function (row) {		
									editrow = row;	
									var offset 		= $("#tabelcari").offset();		
									var dataRecord 	= $("#tabelcari").jqxGrid('getrowdata', editrow);
									var windowSize 	= "width=680,height=800";
									var iframe 		= '<iframe src="'+dataRecord.marking+'" width="100%" height="780" style="border: none;" id="document-preview"></iframe>';
									document.getElementById('btnopennewwindow').href = dataRecord.marking;
									$('#judulloading').html('Trying Loading File From URL : <a href="'+dataRecord.marking+'" target="_blank">'+dataRecord.perihal+'</a><br />If This Process Longer than usually, please use download button instead');
									$('#loadingviewimage').show();
									$('#divviewsurat').show();
									$('#formadddisposisi').hide();
									$('#divawal').hide();
									$('#divsurat').html(iframe);
									$('#divsurat iframe').on('load', function(){$('#loadingviewimage').hide();});
									return false;
								}
							},
							{ text: 'Reset', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsrenderer: function () {
								return "Reset";
								}, buttonclick: function (row) {
									editrow 		= row;	
									var offset 		= $("#tabelcari").offset();		
									var dataRecord 	= $("#tabelcari").jqxGrid('getrowdata', editrow);
									swal({
										title				: 'Apakah anda yakin ?',
										text				: "Data ini akan kami kirim kembali ke tabel awal.",
										type				: 'warning',
										showCancelButton	: true,
										confirmButtonClass	: 'btn btn-confirm mt-2',
										cancelButtonClass	: 'btn btn-cancel ml-2 mt-2',
										confirmButtonText	: 'Yes'
									}).then(function () {
										var set01 = dataRecord.idne;
										var set02 = 'SEND';
										var token = document.getElementById('token').value;
										$.post('surat/setfolder', { val01: set01, val02: set02, _token: token },
										function(data){
											var status  = data.status;
											var message = data.message;
											var warna 	= data.warna;
											var icon 	= data.icon;
											$.toast({
												heading: status,
												text: message,
												position: 'top-right',
												loaderBg: warna,
												icon: icon,
												hideAfter: 5000,
												stack: 1
											});
											$("#tabeldata").jqxGrid('updatebounddata', 'filter');
											$("#tabelcari").jqxGrid('updatebounddata', 'filter');
											$("#gridfolder").jqxGrid('updatebounddata', 'filter');
											return false;
										});	
									});
								}
							},
						]
					});
				}
			},
			{ text: 'Groups', datafield: 'kelompok', filtertype: 'checkedlist', width: '50%', cellsalign: 'left', align: 'center'  },
			{ text: 'Count', datafield: 'jumlah', width: '25%', cellsalign: 'center', align: 'center'  },
		],
	});
	var sumbersurat = {
		datatype: "json",
		datafields: [
			{ name: 'idne'},
			{ name: 'idsurat', type: 'text'},
			{ name: 'idpegawai', type: 'text'},
			{ name: 'tabel', type: 'text'},
			{ name: 'perihal', type: 'text'},
			{ name: 'pejabat', type: 'text'},
			{ name: 'jabatan', type: 'text'},
			{ name: 'tanggal', type: 'text'},
			{ name: 'asalsurat', type: 'text'},
			{ name: 'fakultas', type: 'text'},
			{ name: 'keterangan', type: 'text'},
			{ name: 'status', type: 'text'},
			{ name: 'isisurat', type: 'text'},
			{ name: 'marking', type: 'text'},
		],
		updaterow: function (rowid, rowdata, commit) {commit(true);},
		url: '{{ route("mailBoxPaged") }}',
		root: 'data',
        totalrecords: 'total',
    	cache: false,
	    filter: function () {
            $("#tabeldata").jqxGrid('updatebounddata', 'filter');
        },
        sort: function () {
            $("#tabeldata").jqxGrid('updatebounddata', 'sort');
        },
        beforeprocessing: function (data) {
            if (data != null) {
                sumbersurat.totalrecords = data.total;
            }
        }
	};
	var dataanalis = new $.jqx.dataAdapter(sumbersurat);
	var rendergridrows = $('#tabeldata').jqxGrid('rendergridrows');
	$("#tabeldata").jqxGrid({
		width: '100%',
		filterable: true,
		columnsresize: true,
		showfilterrow: true,
		sortable: true,
		autoheight: true,
		virtualmode: true,
        pageable: true,
        rendergridrows: function(obj) {
            return obj.data;
        },
		source: dataanalis,
		pagesizeoptions: ['10', '20', '30', '50', '100'],
		selectionmode: 'checkbox',
		altrows: true,
        theme: "energyblue",
		columns: [
			{ text: 'View', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsrenderer: function () {
				return "View";
				}, buttonclick: function (row) {		
					editrow = row;	
					var offset 		= $("#tabeldata").offset();		
					var dataRecord 	= $("#tabeldata").jqxGrid('getrowdata', editrow);
					var set01		= dataRecord.idne;
					var isisurat	= dataRecord.isisurat;
					document.getElementById('btnopennewwindow').href = dataRecord.marking;
					var iframe 		= '<iframe src="'+dataRecord.marking+'" width="100%" height="780" style="border: none;" id="document-preview"></iframe>';
					$('#loadingviewimage').show();
					$('#divsurat').html(iframe);
					$('#judulloading').html('Trying Loading File From URL : <a href="'+dataRecord.marking+'" target="_blank">'+dataRecord.perihal+'</a><br />If This Process Longer than usually, please use download button instead');
					$('#divsurat iframe').on('load', function(){$('#loadingviewimage').hide();});
					var token 		= document.getElementById('token').value;
					$.post('surat/markingmailbox', { val01: set01, _token: token },
					function(data){
						$('#divviewsurat').show();
						$('#formadddisposisi').hide();
						$('#divawal').hide();
						return false;
					});
				}
			},
			{ text: 'Tanggal', filterable: false, sortable: false, datafield: 'tanggal', width: '10%', cellsalign: 'left', align: 'center'  },
			{ text: 'Perihal', datafield: 'perihal', width: '45%', cellsalign: 'left', align: 'center'  },
			{ text: 'Asal Surat.', datafield: 'asalsurat', width: '15%', cellsalign: 'left', align: 'center'  },
			{ text: 'Arsipkan', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', align: 'center', cellsrenderer: function () {
				return "Set";
				}, buttonclick: function (row) {
				editrow = row;	
				var offset 		= $("#tabeldata").offset();		
				var dataRecord 	= $("#tabeldata").jqxGrid('getrowdata', editrow);
				$("#set_perihal").val(dataRecord.perihal);
				$("#set_tanggal").val(dataRecord.tanggal);
				$("#set_idne").val(dataRecord.idne);
				$("#modalkelompokkan").modal('show');
				}
			},
			{ text: 'Action', columntype: 'button', width: '11%', editable: false, sortable: false, filterable: false, align: 'center', cellsrenderer: function () {
				return "Disposisikan";
				}, buttonclick: function (row) {		
					editrow = row;	
					var offset 		= $("#tabeldata").offset();
					var dataRecord 	= $("#tabeldata").jqxGrid('getrowdata', editrow);
					var set01		= dataRecord.id;
					var set02		= dataRecord.idinbox;
					var isisurat	= dataRecord.isisurat;
					var iframe 		= '<iframe src="'+dataRecord.marking+'" width="100%" height="780" style="border: none;" id="document-preview"></iframe>';
					$('#judulloading2').html('Trying Loading File From URL : <a href="'+dataRecord.marking+'" target="_blank">'+dataRecord.perihal+'</a><br />If This Process Longer than usually, please use download button instead');
					$('#loadingimage').show();
					$("#pdfRenderer").empty();
					$('#pdfRenderer').html(iframe);
					$('#pdfRenderer iframe').on('load', function(){$('#loadingimage').hide();});
					$("#id_surid").val(dataRecord.idne);
					$("#id_marking").val(dataRecord.idsurat);
					$("#id_kepada").select2("val", "");
					$('input:checkbox').removeAttr('checked');
					CKEDITOR.instances['id_disposisi'].setData('')
					var token 	= document.getElementById('token').value;
					$('#formadddisposisi').show();
					$('#divawal').hide();
				}
			},
		],
	});
});
</script>
@endpush