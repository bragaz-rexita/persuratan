@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Setting Pejabat</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
				<div class="col-md-12">
                    <div class="card card-widget widget-user-2">
                        <div class="widget-user-header bg-success">
                            <div class="widget-user-image">
							@if (Session('avatar') != '')
							<img class="img-circle elevation-2" src="{!! Session('avatar') !!}" alt="User Avatar">
                            @else 
							<img class="img-circle elevation-2" src="{{ asset('mascot.png') }}" alt="User Avatar">
                            @endif
                            </div>
                            <h3 class="widget-user-username">{{Session('nama')}}</h3>
                            <h5 class="widget-user-desc">{{Session('fakpanjang')}}
								@if (Session('username') == 'admin')
									<button type="button" class="btn btn-primary pull-right btnsettingunit"><i class="fa fa-bank"></i> Setting Unit</button>
								@endif
								<a href="/dashboarddokar"><button type="button" class="btn btn-danger pull-right"><i class="fa fa-users"></i> All Staf</button></a>
								<a href="/usersadmin"><button type="button" class="btn btn-info pull-right"><i class="fa fa-gear"></i> Login Management</button></a>
							</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5" id="divsettingpejabat">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Edit Data Pejabat</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" id="btncloseeditpejabat">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                              	<label for="pejabat_nama">Nama Lengkap (Dengan Title)</label>
                                <input type="text" class="form-control" id="pejabat_nama">
                            </div>
                            <div class="form-group">
                                <label for="pejabat_namabiasa">Nama Tanpa Title</label>
                                <input type="text" class="form-control" id="pejabat_namabiasa">
                            </div>
                            <div class="form-group">
                                <label for="pejabat_nip">NIP/NIK</label>
                                <input type="text" id="pejabat_nip" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="pejabat_email">Email</label>
                                <input type="email" id="pejabat_email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="pejabat_jabatan">Jabatan</label>
                                <input type="text" id="pejabat_jabatan" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="pejabat_keterangan">Keterangan</label>
                                <textarea id="pejabat_keterangan" name="pejabat_keterangan" rows="10" cols="80"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="hidden" id="pejabat_idne" class="form-control">
                            <button type="button" class="btn btn-success pull-left" id="btnkosongkan">Kosongkan Nama</button>
                            <button type="button" class="btn btn-success pull-right" id="btnsimpanpejabat">Simpan</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12" id="divlistpejabat">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Data Pejabat</h3>
                            <div class="card-tools">
                                <button class="btn btn-tool" id="btntambahdatabaru"><i class="fa fa-plus"></i></button>
						        <button class="btn btn-tool" id="btnexport"><i class="fa fa-file-excel-o"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                        <div id='gridpejabat'></div>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
				<div class="col-lg-12" id="divlistunit">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Data Unit</h3>
                            <div class="card-tools">
                                <button class="btn btn-tool" id="btntambahunitbaru"><i class="fa fa-plus"></i></button>
						    </div>
                        </div>
                        <div class="card-body">
                        	<div id='gridunit'></div>
                        </div>
                    </div>
                </div>
				<div class="col-lg-5" id="divsettingunit">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Edit Data Unit</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" id="btncloseeditunit">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                              	<label for="unit_nama">Nama</label>
                                <input type="text" class="form-control" id="unit_nama">
                            </div>
                            <div class="form-group">
                                <label for="unit_namabiasa">Nama Tanpa Title</label>
                                <input type="text" class="form-control" id="unit_namabiasa">
                            </div>
                            <div class="form-group">
                                <label for="unit_nip">NIP/NIK</label>
                                <input type="text" id="unit_nip" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="unit_email">Email</label>
                                <input type="email" id="unit_email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="unit_jabatan">Jabatan</label>
                                <input type="text" id="unit_jabatan" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="unit_keterangan">Keterangan</label>
                                <textarea id="unit_keterangan" name="unit_keterangan" rows="10" cols="80"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="hidden" id="unit_idne" class="form-control">
                            <button type="button" class="btn btn-success pull-right" id="btnsimpanunit">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
    <div id="tabel_cetak"></div>
    <div class="form-group"> 
        <div class="row">
            <div class="col-lg-7 col-md-7">
                <label for="pejabat_pangkat">Pangkat/Gol.</label>
                <select id="pejabat_pangkat" size="1" class="form-control">
                    <option value="00">Tidak/Belum Punya</option>
                </select>
            </div>
            <div class="col-lg-5 col-md-5">
                <label for="pejabat_kode">Kode Unit</label>
                <input type="text" id="pejabat_kode" class="form-control" value="{{time()}}">
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <label for="pejabat_jabfung">Jabatan Fungsional</label>
        <select id="pejabat_jabfung" size="1" class="form-control select2" style="width: 100%;">
            <option value="-">Tidak/Belum Punya</option>
        </select>
    </div>
    <div class="form-group">
        <label for="pejabat_penandatangan">Penandatangan SK Pengangkatan</label>
        <input type="text" id="pejabat_penandatangan" class="form-control" value="Pimpinan">
    </div>
    <div class="form-group"> 
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <label for="pejabat_nomorsk">No. SK Pengangkatan</label>
                <input type="text" id="pejabat_nomorsk" class="form-control" value="-">
            </div>
            <div class="col-lg-4 col-md-4">
                <label for="pejabat_tglsk">Tgl. SK</label>
                <input type="text" id="pejabat_tglsk" class="form-control" value="{{date('Y-m-d')}}">
            </div>
        </div>
    </div>
    <div class="form-group"> 
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <label for="pejabat_periode">Periode</label>
                <input type="text" id="pejabat_periode" class="form-control" value="-">
            </div>
            <div class="col-lg-8 col-md-8">
                <label for="pejabat_tglpelantikan">Tgl. Pelantikan</label>
                <input type="text" id="pejabat_tglpelantikan" class="form-control" value="Tidak di Lantik">
            </div>
        </div>
    </div>
    <div class="form-group"> 
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <label for="pejabat_awalberlaku">Awal Berlaku</label>
                <input type="text" id="pejabat_awalberlaku" class="form-control" value="{{date('Y-m-d')}}">
            </div>
            <div class="col-lg-8 col-md-8">
                <label for="pejabat_akhirberlaku">Akhir Berlaku</label>
                <input type="text" id="pejabat_akhirberlaku" class="form-control" value="{{date('Y-m-d')}}">
            </div>
        </div>
    </div>
    <div class="form-group"> 
        <div class="row">
            <div class="col-lg-7 col-md-7">
                <label for="pejabat_nomorfile">Nomor File </label>
                <input type="text" id="pejabat_nomorfile" class="form-control" value="-">
            </div>
            <div class="col-lg-5 col-md-5">
                <label for="pejabat_statmenjabat">Jenis</label>
                <select id="pejabat_statmenjabat" size="1" class="form-control">
                    <option value="">Normal</option>
                    <option value="PLT">PLT</option>
                    <option value="PLW">PLW</option>
                </select>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@push('script')
<script>
    $(function () {
		CKEDITOR.env.isCompatible = true;
		CKEDITOR.replace( 'pejabat_keterangan', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90	
		});
	});
$(document).ready(function () {
	var token = document.getElementById('token').value;
	$('#divsettingpejabat').hide();
	$('#divlistunit').hide();
	$('#divsettingunit').hide();
	$("#btnsettingunit").click(function(){ 
		$('#divsettingpejabat').hide();
		$('#divlistpejabat').hide();
		$('#divsettingunit').hide();
		$('#divlistunit').show();
	});
	$("#btntambahdatabaru").click(function(){ 
		$("#pejabat_nama").val('');
		$("#pejabat_namabiasa").val('');
		$("#pejabat_nip").val('');
		//$("#pejabat_pangkat").val('');
		//$("#pejabat_kode").val('');
		$("#pejabat_jabatan").val('');
		$("#pejabat_email").val('');
		//$("#pejabat_penandatangan").val('');
		//$("#pejabat_nomorsk").val('');
		//$("#pejabat_jabfung").val('').select2().trigger('change');
		//$("#pejabat_tglsk").val('');
		//$("#pejabat_periode").val('');
		//$("#pejabat_tglpelantikan").val('');
		//$("#pejabat_awalberlaku").val('');
		//$("#pejabat_akhirberlaku").val('');
		//$("#pejabat_nomorfile").val('');
		//$("#pejabat_statmenjabat").val('');
		CKEDITOR.instances['pejabat_keterangan'].setData('')
		$("#pejabat_idne").val('new');
		$('#divsettingpejabat').show();
		$('#divlistpejabat').removeClass('col-lg-12').addClass('col-lg-7');
	});
	$("#btncloseeditpejabat").click(function(){ 
		$('#divsettingpejabat').hide();
		$('#divlistpejabat').removeClass('col-lg-7').addClass('col-lg-12');
	});
	var sourcetblpejabat = {
		datatype: "json",
		datafields: [
			{ name: 'idne'},
			{ name: 'pejabat',type: 'text'},
			{ name: 'kode',type: 'text'},
			{ name: 'nama',type: 'text'},
			{ name: 'namalengkap',type: 'text'},
			{ name: 'jenis',type: 'text'},
			{ name: 'nip',type: 'text'},
			{ name: 'golongan',type: 'text'},
			{ name: 'pangkat',type: 'text'},
			{ name: 'email',type: 'text'},
			{ name: 'nik',type: 'text'},
			{ name: 'no_hp',type: 'text'},
			{ name: 'npwp',type: 'text'},
			{ name: 'penandatangan',type: 'text'},
			{ name: 'nomersk',type: 'text'},
			{ name: 'tglsk',type: 'text'},
			{ name: 'fungsional',type: 'text'},
			{ name: 'periode',type: 'text'},
			{ name: 'awalberlaku',type: 'text'},
			{ name: 'akhirberlaku',type: 'text'},
			{ name: 'tglpelantikan',type: 'text'},
			{ name: 'nomorfile',type: 'text'},
			{ name: 'keterangan',type: 'text'},
			{ name: 'statmenjabat',type: 'text'},
			{ name: 'fakreal',type: 'text'},
		],
		url: '{{route("getpejabat")}}',
		cache: false,
	};
	var datajpejabat = new $.jqx.dataAdapter(sourcetblpejabat);
	$("#gridpejabat").jqxGrid({
		width: '100%',
		showfilterrow: true,
		filterable: true,
		columnsresize: true,
		autoshowfiltericon: true,
		pageable: true,
		autoheight: true,
		theme: "energyblue",
		source: datajpejabat,
		selectionmode: 'multiplecellsextended',
		columns: [
			{ text: 'Edit', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', align: 'center', cellsrenderer: function () {
				return "Edit";
				}, buttonclick: function (row) {
					editrow = row;	
					var offset 		= $("#gridpejabat").offset();		
					var dataRecord 	= $("#gridpejabat").jqxGrid('getrowdata', editrow);
					$("#pejabat_nama").val(dataRecord.namalengkap);
					$("#pejabat_namabiasa").val(dataRecord.nama);
					$("#pejabat_nip").val(dataRecord.nip);
					$("#pejabat_pangkat").val(dataRecord.golongan);
					$("#pejabat_kode").val(dataRecord.kode);
					$("#pejabat_jabatan").val(dataRecord.pejabat);
					$("#pejabat_email").val(dataRecord.email);
					$("#pejabat_penandatangan").val(dataRecord.penandatangan);
					$("#pejabat_nomorsk").val(dataRecord.nomersk);
					$("#pejabat_jabfung").val(dataRecord.fungsional).select2().trigger('change');
					$("#pejabat_tglsk").val(dataRecord.tglsk);
					$("#pejabat_periode").val(dataRecord.periode);
					$("#pejabat_tglpelantikan").val(dataRecord.tglpelantikan);
					$("#pejabat_awalberlaku").val(dataRecord.awalberlaku);
					$("#pejabat_akhirberlaku").val(dataRecord.akhirberlaku);
					$("#pejabat_nomorfile").val(dataRecord.nomorfile);
					$("#pejabat_statmenjabat").val(dataRecord.statmenjabat);
					CKEDITOR.instances['pejabat_keterangan'].setData(dataRecord.keterangan)
					$("#pejabat_idne").val(dataRecord.idne);
					$('#divsettingpejabat').show();
					$('#divlistpejabat').removeClass('col-lg-12').addClass('col-lg-7');
				}
			},
			{ text: 'Jabatan', datafield: 'pejabat', width: '18%', cellsalign: 'left', align: 'center' },
			{ text: 'Nama', datafield: 'namalengkap', width: '25%', cellsalign: 'left', align: 'center' },
			{ text: 'NIP/NIK', datafield: 'nip', width: '15%', cellsalign: 'left', align: 'center' },
			{ text: 'Email', datafield: 'email', width: '15%', cellsalign: 'left', align: 'center' },
			{ text: 'Keterangan', datafield: 'keterangan',width: '20%', cellsalign: 'center', align: 'center' },
		]            
	});
	$('#divberkas').hide();
	$('#formcarinama').hide();
	$('#formcarinamapejabat').hide();
	$('#divriwyaat').hide();
	$('#btncloseriwayat').click(function () {
		$('#divriwyaat').hide();
		$('#divuploader').show();
	});
    $('#btnviewpegawai').click(function () {
		$('#formcarinama').show();
	});
    $('#btnviewpejabat').click(function () {
		$('#formcarinamapejabat').show();
	});
    $('#btnclosepejabat').click(function () {
		$('#formcarinamapejabat').hide();
	});
    $('#btntambahdata').click(function () {
		$("#modaleditdata").modal('show');
        $('#edit_id').val('new');
	});
	$('#btnsimpanpejabat').click(function () {
		var set01=document.getElementById('pejabat_nama').value;
		var set02=document.getElementById('pejabat_namabiasa').value;
		var set03=document.getElementById('pejabat_nip').value;
		var set04=document.getElementById('pejabat_pangkat').value;
		var set05=document.getElementById('pejabat_kode').value;
		var set06=document.getElementById('pejabat_jabatan').value;
		var set07=document.getElementById('pejabat_penandatangan').value;
		var set08=document.getElementById('pejabat_nomorsk').value;
		var set09='alldata';
		var set10=document.getElementById('pejabat_jabfung').value;
		var set11=document.getElementById('pejabat_tglsk').value;
		var set12=document.getElementById('pejabat_periode').value;
		var set13=document.getElementById('pejabat_tglpelantikan').value;
		var set14=document.getElementById('pejabat_awalberlaku').value;
		var set15=document.getElementById('pejabat_akhirberlaku').value;
		var set16=document.getElementById('pejabat_nomorfile').value;
		var set17=CKEDITOR.instances['pejabat_keterangan'].getData()
		var set18=document.getElementById('pejabat_idne').value;
		var set19=document.getElementById('pejabat_email').value;
		var set20=document.getElementById('pejabat_statmenjabat').value;
		var token=document.getElementById('token').value;
		if (set01 == '' || set02 == '' || set03 == '' || set19 == '' || set06 == ''){
			swal({
				title	: 'Stop',
				text	: 'Data Wajib di Isi Semua',
				type	: 'warning',
			})
		} else {
			$.post('{{route("exPejabatSK")}}', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, val11: set11, val12: set12, val13: set13, val14: set14, val15: set15, val16: set16, val17: set17, val18: set18, val19: set19, val20: set20, _token: token }, function(data){
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
				$("html, body").animate({ scrollTop: 0 }, "slow");
				$('#divsettingpejabat').hide();
				$('#divlistpejabat').removeClass('col-lg-7').addClass('col-lg-12');
				$("#gridpejabat").jqxGrid('updatebounddata', 'filter'); 
				return false;
			});
		}
	});
	$('#btnkosongkan').click(function () {
		var set01=document.getElementById('pejabat_nama').value;
		var set02=document.getElementById('pejabat_namabiasa').value;
		var set03=document.getElementById('pejabat_nip').value;
		var set04=document.getElementById('pejabat_pangkat').value;
		var set05=document.getElementById('pejabat_kode').value;
		var set06=document.getElementById('pejabat_jabatan').value;
		var set07=document.getElementById('pejabat_penandatangan').value;
		var set08=document.getElementById('pejabat_nomorsk').value;
		var set09='hapusdata';
		var set10=document.getElementById('pejabat_jabfung').value;
		var set11=document.getElementById('pejabat_tglsk').value;
		var set12=document.getElementById('pejabat_periode').value;
		var set13=document.getElementById('pejabat_tglpelantikan').value;
		var set14=document.getElementById('pejabat_awalberlaku').value;
		var set15=document.getElementById('pejabat_akhirberlaku').value;
		var set16=document.getElementById('pejabat_nomorfile').value;
		var set17=CKEDITOR.instances['pejabat_keterangan'].getData()
		var set18=document.getElementById('pejabat_idne').value;
		var set19=document.getElementById('pejabat_email').value;
		var set20=document.getElementById('pejabat_statmenjabat').value;
		var token=document.getElementById('token').value;
		$.post('{{route("exPejabatSK")}}', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, val11: set11, val12: set12, val13: set13, val14: set14, val15: set15, val16: set16, val17: set17, val18: set18, val19: set19, val20: set20, _token: token }, function(data){
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
			$("html, body").animate({ scrollTop: 0 }, "slow");
            $('#divsettingpejabat').hide();
			$('#divlistpejabat').removeClass('col-lg-7').addClass('col-lg-12');
			$("#gridpejabat").jqxGrid('updatebounddata', 'filter'); 
			return false;
		});
	});
    $("#btnexport").click(function(){
		var gridContent = $("#gridpejabat").jqxGrid('exportdata', 'json');
		data = $.parseJSON(gridContent);
		var noOfContacts = data.length;
		if(noOfContacts>0){
			var table = document.createElement("table");
				table.style.width = '100%';
				table.setAttribute('border', '1');
				table.setAttribute('cellspacing', '0');
				table.setAttribute('cellpadding', '5');
				table.setAttribute('id', 'tabelcetak');
				table.setAttribute('class', 'text');
			var col = [];
			for (var i = 0; i < noOfContacts; i++) {
				for (var key in data[i]) {
					if (col.indexOf(key) === -1) {
						col.push(key);
					}
				}
			}
			var tHead = document.createElement("thead");
			var hRow = document.createElement("tr");
			for (var i = 0; i < col.length; i++) {
					var th = document.createElement("th");
					th.innerHTML = col[i];
					hRow.appendChild(th);
			}
			tHead.appendChild(hRow);
			table.appendChild(tHead);
			var tBody = document.createElement("tbody");
			for (var i = 0; i < noOfContacts; i++) {
				var bRow = document.createElement("tr");
				for (var j = 0; j < col.length; j++) {
					var td = document.createElement("td");
						td.setAttribute('style', 'mso-number-format: "\@";');
						td.innerHTML = data[i][col[j]];
					bRow.appendChild(td);
				}
				tBody.appendChild(bRow)
			}
			table.appendChild(tBody);
			var divContainer = document.getElementById("tabel_cetak");
				divContainer.innerHTML = "";
				divContainer.appendChild(table);
		}
		
		$("#tabel_cetak").btechco_excelexport({
			containerid: "tabel_cetak"
			, datatype: $datatype.Table
		});
		
		return false;
	});
	getnotifcount();
});
</script>
@endpush