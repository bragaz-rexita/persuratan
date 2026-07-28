@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Sertifikat dengan TTE</h1>
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
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title">Setting Sertifikat</h3>
                            <div class="card-tools">
                                <a href="{{ url('/') }}"><button class="btn btn-tool"><i class="fa fa-close"></i></button></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-5 col-md-5">
                                    <div class="form-group">
                                        <label for="id_namapenandatangan">Nama Penanda Tangan:</label>
                                        <select id="id_namapenandatangan" name="id_namapenandatangan" size="1" class="form-control select2">
                                            <option value="">Pilih Salah Satu</option>
                                            @if (Session('fakultas') == 'KP')
                                                @foreach($pejabats as $rpejabats)
                                                    <option value="{{ $rpejabats['id'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                @endforeach
                                            @else
                                                @foreach($pejabats as $rpejabats)
                                                    <option value="{{ $rpejabats['id'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                @endforeach
                                                <option value="1">Rektor</option>
                                                <option value="2">Wakil Rektor Bidang Akademik</option>
                                                <option value="3">Wakil Rektor Bidang Umum dan Keuangan</option>
                                                <option value="4">Wakil Rektor Bidang Kemahasiswaan</option>
                                                <option value="5">Wakil Rektor Bidang Perencanaan dan Kerja Sama</option>
                                            @endif
                                        </select>
                                        <p class="help-block">NB : Pejabat yang TTE Belum Aktif, Tidak Bisa Menggunakan Fasilitas Ini</p>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <label for="idparaf1">Paraf 1 Oleh:</label>
                                                <select id="idparaf1" name="idparaf1" size="1" class="form-control select2">
                                                    <option value="">Pilih Salah Satu</option>
                                                    <option value="SELF">Di Paraf Sendiri</option>
                                                    @foreach($pejabats as $rpejabats)
                                                        <option value="{{ $rpejabats['id'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                    @endforeach
                                                    @if (Session('fakultas') == 'KP')
                                                        <option value="67">Ketua Pusat Informasi, Dokumentasi dan Keluhan (PIDK)</option>
                                                    @endif
                                                    
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <label for="idparaf2">Paraf 2 Oleh:</label>
                                                <select id="idparaf2" name="idparaf2" size="1" class="form-control select2">
                                                    <option value="">Pilih Salah Satu</option>
                                                    @foreach($pejabats as $rpejabats)
                                                        <option value="{{ $rpejabats['id'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                    @endforeach
                                                    @if (Session('fakultas') == 'KP')
                                                        <option value="67">Ketua Pusat Informasi, Dokumentasi dan Keluhan (PIDK)</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <label for="idparaf3">Paraf 3 Oleh:</label>
                                                <select id="idparaf3" name="idparaf3" size="1" class="form-control select2">
                                                    <option value="">Pilih Salah Satu</option>
                                                    @foreach($pejabats as $rpejabats)
                                                        <option value="{{ $rpejabats['id'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                    @endforeach
                                                    @if (Session('fakultas') == 'KP')
                                                        <option value="67">Ketua Pusat Informasi, Dokumentasi dan Keluhan (PIDK)</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <label for="idparaf4">Paraf 4 Oleh:</label>
                                                <select id="idparaf4" name="idparaf4" size="1" class="form-control select2">
                                                    <option value="">Pilih Salah Satu</option>
                                                    @foreach($pejabats as $rpejabats)
                                                        <option value="{{ $rpejabats['id'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                    @endforeach
                                                    @if (Session('fakultas') == 'KP')
                                                        <option value="67">Ketua Pusat Informasi, Dokumentasi dan Keluhan (PIDK)</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-7">
                                    <div class="form-group">
                                        <label for="upload_perihal">Judul Kegiatan</label>
                                        <textarea id="upload_perihal" name="upload_perihal" rows="10" cols="80">{!! $getsurat->perihal !!}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4">
                                                <label for="id_kolom">Jumlah Kolom:</label>
                                                <input type="number" class="form-control" id="id_kolom" value="{{$kolom}}">
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <label for="id_baris">Jumlah Baris:</label>
                                                <input type="number" class="form-control" id="id_baris" value="{{$baris}}">
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <label for="id_lebar">Lebar Kolom (0 = auto):</label>
                                                <input type="number" class="form-control" id="id_lebar" value="{{$lebar}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3">
                                                <label for="id_posnama">Posisi Nama:</label>
                                                <input type="number" class="form-control" id="id_posnama" value="{{$posnama}}">
                                            </div>
                                            <div class="col-lg-3 col-md-3">
                                                <label for="id_mergenama">Merge Nama:</label>
                                                <input type="number" class="form-control" id="id_mergenama" value="{{$mergenama}}">
                                            </div>
                                            <div class="col-lg-3 col-md-3">
                                                <label for="id_status">Posisi Status:</label>
                                                <input type="number" class="form-control" id="id_status" value="{{$posstatus}}">
                                            </div>
                                            <div class="col-lg-3 col-md-3">
                                                <label for="id_mergestatus">Merge Status:</label>
                                                <input type="number" class="form-control" id="id_mergestatus" value="{{$mergestatus}}">
                                            </div>
                                            <div class="col-lg-3 col-md-3">
                                                <label for="id_posqrcode">Posisi QrCode:</label>
                                                <input type="number" class="form-control" id="id_posqrcode" value="{{$posqrcode}}">
                                            </div>
                                            <div class="col-lg-3 col-md-3">
                                                <label for="id_mergeqrcode">Merge QrCode:</label>
                                                <input type="number" class="form-control" id="id_mergeqrcode" value="{{$mergeqrcode}}">
                                            </div>
                                            <div class="col-lg-3 col-md-3">
                                                <label for="id_layout">Layout:</label>
                                                <select id="id_layout" name="id_layout" size="1" class="form-control">
                                                    @if ($layout == 'P')
                                                        <option value="P" selected>Portrait</option>
                                                        <option value="L">Lanscape</option>
                                                    @else
                                                        <option value="P">Portrait</option>
                                                        <option value="L" selected>Lanscape</option>
                                                    @endif
                                                </select>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="btn-group">
                                        <button class="btn btn-success" id="btnpreview">Preview Setting</button>
                                        <button class="btn btn-info" id="btnupload">Upload Background Image</button>
                                        @if ($getsurat->tandatangan != 'Signed Using TTE')
                                            <button class="btn btn-warning" id="btnsavesetting">Simpan dan Kirim ke Pemaraf 1</button>
                                        @endif
                                        <button class="btn btn-danger" id="btnopenpenerima">Penerima Sertifikat</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-lg-12 col-md-12" id="divtampilan">
                                <iframe src="{{ url('/') }}/sertifikat/{{$idne}}" width="100%" height="780" style="border: none;"></iframe>
                            </div>
                            <div class="col-lg-12 col-md-12" id="divpenerima">
                                <div class="box box-danger">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Penerima Sertifikat</h3>
                                        <div class="box-tools pull-right">
                                            <button class="btn bg-green btn-sm" id="downexcell"><i class="fa fa-file-excel-o"></i> </button>
                                            <button class="btn bg-red btn-sm" id="btntutuppenerima"><i class="fa fa-close"></i> </button>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <button class="btn btn-primary btn-block" id="btnsendsertifikat"><i class="fa fa-flag"></i> Send Certificate To Email</button>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <a href='{{URL::to("/")}}/register/{!! $getsurat->id !!}' class="btn btn-block btn-social btn-info"><i class="fa fa-calendar-check-o"></i>Registar</a>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <a href='{{URL::to("/")}}/webinarrekaponline/{!! $getsurat->id !!}' class="btn btn-block btn-social btn-warning"><i class="fa fa-calendar-check-o"></i>Presensi</a>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <button class="btn btn-danger btn-block" id="btnuploadpeserta"><i class="fa fa-file-excel-o"></i> Upload Peserta</button>
                                                        <p class="help-block"><a href='{{URL::to("/")}}/download/listpenerimasertifikat.xlsx'> Format File</a></p>
                                                    </div>								
                                                </div>
                                            </div>
                                            <div id="grideventdetail"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="id_bgdepan" id="id_bgdepan" value="{!! $filedepan !!}">
<input type="hidden" name="id_bgbelakang" id="id_bgbelakang" value="{!! $filebelakang !!}">
<input type="hidden" name="id_surat" id="id_surat" value="{!! $getsurat->id !!}">
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
    <div class="form-group"> 
        <label>Dasar Surat (bila dari agenda surat masuk, ketik tahun dan nomor agendanya)</label>
        <div class="row">
            <div class="col-md-6">
                <label>Tahun</label>
                <input type="text" class="form-control" id="upload_tahunagenda" name="upload_tahunagenda" placeholder="Thn. Agenda (YYYY)">
            </div>
            <div class="col-md-6">
                <label>No.Agenda</label>
                <input type="text" class="form-control" id="upload_noagenda" name="upload_noagenda" placeholder="No. Agenda">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="id_kepada">Tujuan Surat (Kosongkan bila tidak masuk dalam jajaran pejabat)</label>
        <select id="id_kepada" name="id_kepada" size="1" class="form-control select2">
            <option value="">Pilih Salah Satu</option>
            @if (Session('fakultas') == 'KP')
                @foreach($pejabats as $rpejabats)
                    <option value="{{ $rpejabats['id'] }}">{{ $rpejabats['pejabat'] }}</option>
                @endforeach
            @else
                @foreach($pejabats as $rpejabats)
                    <option value="{{ $rpejabats['id'] }}">{{ $rpejabats['pejabat'] }}</option>
                @endforeach
                <option value="1">Rektor</option>
                <option value="2">Wakil Rektor Bidang Akademik</option>
                <option value="3">Wakil Rektor Bidang Umum dan Keuangan</option>
                <option value="4">Wakil Rektor Bidang Kemahasiswaan</option>
                <option value="5">Wakil Rektor Bidang Perencanaan dan Kerja Sama</option>
            @endif
        </select>
    </div>
</div>
<div class="modal modal-danger fade" id="modalupload">
  <div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Uploader</h4>
		</div>
		<div class="modal-body">
			<div class="form-group">
				<label for="id_jenisfile">Jenis File :</label>
				<select id="id_jenisfile" name="id_jenisfile" size="1" class="form-control">
					<option value="bgdepan">Background Depan</option>
					<option value="bgbelakang">Background Belakang</option>
					<option value="peserta">Peserta</option>
				</select>
			</div>
			<div class="form-group">
				<label for="id_filelampiran">Upload File</label>
				<input type="file" id="id_filelampiran" name="id_filelampiran" class="btn-light">
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-info pull-left" data-dismiss="modal">Close</button>	
			<button type="button" class="btn btn-info pull-right" id="btnuploadbg">Simpan</button>	
		</div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="modalsendwa">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Modal Send Email/WA</h4>
		</div>
		<div class="modal-body">
			<div class="form-group">
				<label class="col-form-label">Email<span class="text-danger">*</span></label>
				<input type="text" class="form-control" id="send_email" name="send_email">
			</div>
			<div class="form-group">
				<label class="col-form-label">Phone (Use +62 Format)</label>
				<input type="text" class="form-control" id="send_hp" name="send_hp">
			</div>			
		</div>
		<div class="modal-footer">
			<input type="hidden" class="form-control" id="send_idne" name="send_idne">
			<button type="button" class="btn btn-warning pull-right" id="btnsendeditemail">Send</button>
			<button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Close</button>	
		</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection
@push('script')
<!-- Page script -->
<script type="text/javascript">
$(function () {
	CKEDITOR.env.isCompatible = true;
	CKEDITOR.replace( 'upload_perihal', {
		toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],
		removeButtons: 'Strike',
		width: '100%',
		height: 90	
	});
});
$(document).ready(function () {
	var token=document.getElementById('token').value;
	$('.select2').select2({
		width: '100%'
	});
	$("#enteni").hide();
	$("#divpenerima").hide();
	$('#btnuploadpeserta').click(function () {
		$("#id_jenisfile").val('peserta');
		$("#id_filelampiran").val('');
		$("#modalupload").modal('show');
	});
	$('#btnupload').click(function () {
		$("#id_filelampiran").val('');
		$("#modalupload").modal('show');
	});
	$("#btnsendeditemail").click(function(){
			var val01=document.getElementById('send_idne').value;
			var val02=document.getElementById('send_email').value;
			var val03=document.getElementById('send_hp').value;
			var token=document.getElementById('token').value;
			$("#modalsendwa").modal('hide');
			$.post('{{ route("saveEditemail") }}', { set01: val01, set02: val02, set03: val03, _token: token },
			function(data){
				$("#grideventdetail").jqxGrid('updatebounddata', 'filter');
				var windowName 	= 'Send WA';
				var windowSize 	= "width=800,height=800";
				window.open(data, windowName, windowSize);
				return false;
			});	
		});
	$('#btnuploadbg').on('click', function (){
		$("#enteni").show();
		$("#modalupload").modal('hide');
		var set01=document.getElementById('id_kolom').value;
		var set02=document.getElementById('id_baris').value;
		var set03=document.getElementById('id_lebar').value;
		var set04=document.getElementById('id_posnama').value;
		var set05=document.getElementById('id_mergenama').value;
		var set06=document.getElementById('id_status').value;
		var set07=document.getElementById('id_mergestatus').value;
		var set08=document.getElementById('id_posqrcode').value;
		var set09=document.getElementById('id_mergeqrcode').value;
		var set10=document.getElementById('id_bgdepan').value;
		var set11=document.getElementById('id_bgbelakang').value;
		var set12=CKEDITOR.instances['upload_perihal'].getData();
		var set13=document.getElementById('id_namapenandatangan').value;
		var set14=document.getElementById('idparaf1').value;
		var set15=document.getElementById('idparaf2').value;
		var set16=document.getElementById('idparaf3').value;
		var set17=document.getElementById('idparaf4').value;
		var set18=document.getElementById('id_filelampiran');
		var set20=document.getElementById('id_surat').value;
		var set21=document.getElementById('id_jenisfile').value;
		var set22=document.getElementById('id_layout').value;
		var form_data = new FormData();
			form_data.append('val01', set01);
			form_data.append('val02', set02);
			form_data.append('val03', set03);
			form_data.append('val04', set04);
			form_data.append('val05', set05);
			form_data.append('val06', set06);
			form_data.append('val07', set07);
			form_data.append('val08', set08);
			form_data.append('val09', set09);
			form_data.append('val10', set10);
			form_data.append('val11', set11);
			form_data.append('val12', set12);
			form_data.append('val13', set13);
			form_data.append('val14', set14);
			form_data.append('val15', set15);
			form_data.append('val16', set16);
			form_data.append('val17', set17);
			form_data.append('val18', set18.files[0]);
			form_data.append('val19', 'draft');
			form_data.append('val20', set20);
			form_data.append('val21', set21);
			form_data.append('val22', set22);
			form_data.append('_token', '{{csrf_token()}}');
		$.ajax({
			url: '{{ route("exSetSertifikat") }}',
			data: form_data,
			type: 'POST',
			contentType: false,
			processData: false,
			success: function (data) {
				$("#id_filelampiran").val('');
				$("#enteni").hide();
				var status  = data.status;
				var message = data.message;
				var icon 	= data.icon;
				var warna 	= data.warna;
				$.toast({
					heading: status,
					text: message,
					position: 'top-right',
					loaderBg: warna,
					icon: icon,
					hideAfter: 2000,
					stack: 1
				});
				if (set21 == 'peserta'){
					$("#grideventdetail").jqxGrid('updatebounddata');
				} else {
					setTimeout(function () {location.reload();}, 2000);
				}
			},
			error: function (xhr, status, error) {
				swal({
					title	: 'Stop',
					text	: xhr.responseText,
					type	: 'warning',
				})
			}
		});
	});
	$('#btnsavesetting').on('click', function (){
		$("#enteni").show();
		var set01=document.getElementById('id_kolom').value;
		var set02=document.getElementById('id_baris').value;
		var set03=document.getElementById('id_lebar').value;
		var set04=document.getElementById('id_posnama').value;
		var set05=document.getElementById('id_mergenama').value;
		var set06=document.getElementById('id_status').value;
		var set07=document.getElementById('id_mergestatus').value;
		var set08=document.getElementById('id_posqrcode').value;
		var set09=document.getElementById('id_mergeqrcode').value;
		var set10=document.getElementById('id_bgdepan').value;
		var set11=document.getElementById('id_bgbelakang').value;
		var set12=CKEDITOR.instances['upload_perihal'].getData();
		var set13=document.getElementById('id_namapenandatangan').value;
		var set14=document.getElementById('idparaf1').value;
		var set15=document.getElementById('idparaf2').value;
		var set16=document.getElementById('idparaf3').value;
		var set17=document.getElementById('idparaf4').value;
		var set18=document.getElementById('id_filelampiran');
		var set20=document.getElementById('id_surat').value;
		var set21=document.getElementById('id_jenisfile').value;
		var set22=document.getElementById('id_layout').value;
		if (set12 == '' || set13 == '' || set14 == '' ){
			swal({
				title	: 'Stop',
				text	: 'Perihal, Penandatangan, Paraf 1 Surat Wajib di Isi',
				type	: 'warning',
			})
		} else {
			var form_data = new FormData();
				form_data.append('val01', set01);
				form_data.append('val02', set02);
				form_data.append('val03', set03);
				form_data.append('val04', set04);
				form_data.append('val05', set05);
				form_data.append('val06', set06);
				form_data.append('val07', set07);
				form_data.append('val08', set08);
				form_data.append('val09', set09);
				form_data.append('val10', set10);
				form_data.append('val11', set11);
				form_data.append('val12', set12);
				form_data.append('val13', set13);
				form_data.append('val14', set14);
				form_data.append('val15', set15);
				form_data.append('val16', set16);
				form_data.append('val17', set17);
				form_data.append('val18', set18);
				form_data.append('val19', 'send');
				form_data.append('val20', set20);
				form_data.append('val21', set21);
				form_data.append('val22', set22);
				form_data.append('_token', '{{csrf_token()}}');
			$.ajax({
				url: '{{ route("exSetSertifikat") }}',
				data: form_data,
				type: 'POST',
				contentType: false,
				processData: false,
				success: function (data) {
					$("#enteni").hide();
	
					$("#id_filelampiran").val('');
					var status  = data.status;
					var message = data.message;
					var icon 	= data.icon;
					var warna 	= data.warna;
					$.toast({
						heading: status,
						text: message,
						position: 'top-right',
						loaderBg: warna,
						icon: icon,
						hideAfter: 5000,
						stack: 1
					});
					if (set10 == '-' || set10 == ''){
						setTimeout(function () {location.reload();}, 5000);
					} else {
						setTimeout(function () {location.replace('/serfitikatwithtte');}, 5000);
					}
				},
				error: function (xhr, status, error) {
					swal({
						title	: 'Stop',
						text	: xhr.responseText,
						type	: 'warning',
					})
				}
			});
		}
	});
	$('#btnpreview').on('click', function (){
		$("#enteni").show();
		var set01=document.getElementById('id_kolom').value;
		var set02=document.getElementById('id_baris').value;
		var set03=document.getElementById('id_lebar').value;
		var set04=document.getElementById('id_posnama').value;
		var set05=document.getElementById('id_mergenama').value;
		var set06=document.getElementById('id_status').value;
		var set07=document.getElementById('id_mergestatus').value;
		var set08=document.getElementById('id_posqrcode').value;
		var set09=document.getElementById('id_mergeqrcode').value;
		var set10=document.getElementById('id_bgdepan').value;
		var set11=document.getElementById('id_bgbelakang').value;
		var set12=CKEDITOR.instances['upload_perihal'].getData();
		var set13=document.getElementById('id_namapenandatangan').value;
		var set14=document.getElementById('idparaf1').value;
		var set15=document.getElementById('idparaf2').value;
		var set16=document.getElementById('idparaf3').value;
		var set17=document.getElementById('idparaf4').value;
		var set18=document.getElementById('id_filelampiran');
		var set20=document.getElementById('id_surat').value;
		var set21=document.getElementById('id_jenisfile').value;
		var set22=document.getElementById('id_layout').value;
		var form_data = new FormData();
			form_data.append('val01', set01);
			form_data.append('val02', set02);
			form_data.append('val03', set03);
			form_data.append('val04', set04);
			form_data.append('val05', set05);
			form_data.append('val06', set06);
			form_data.append('val07', set07);
			form_data.append('val08', set08);
			form_data.append('val09', set09);
			form_data.append('val10', set10);
			form_data.append('val11', set11);
			form_data.append('val12', set12);
			form_data.append('val13', set13);
			form_data.append('val14', set14);
			form_data.append('val15', set15);
			form_data.append('val16', set16);
			form_data.append('val17', set17);
			form_data.append('val18', set18);
			form_data.append('val19', 'draft');
			form_data.append('val20', set20);
			form_data.append('val21', set21);
			form_data.append('val22', set22);
			form_data.append('_token', '{{csrf_token()}}');
		$.ajax({
			url: '{{ route("exSetSertifikat") }}',
			data: form_data,
			type: 'POST',
			contentType: false,
			processData: false,
			success: function (data) {
				$("#enteni").hide();

				$("#id_filelampiran").val('');
				var status  = data.status;
				var message = data.message;
				var icon 	= data.icon;
				var warna 	= data.warna;
				$.toast({
					heading: status,
					text: message,
					position: 'top-right',
					loaderBg: warna,
					icon: icon,
					hideAfter: 2000,
					stack: 1
				});
				setTimeout(function () {location.reload();}, 2000);
			},
			error: function (xhr, status, error) {
				swal({
					title	: 'Stop',
					text	: xhr.responseText,
					type	: 'warning',
				})
			}
		});
	
	});
	$('#btntutuppenerima').click(function () {
		$('#divtampilan').show();
		$('#divpenerima').hide();
	});
	$('#btnopenpenerima').on('click', function (){
		var set01=document.getElementById('id_surat').value;
		var token= document.getElementById('token').value;
		var source = {
			datatype: "json",
			datafields: [
				{ name: 'idne'},
				{ name: 'linke', type: 'text'},
				{ name: 'idevent', type: 'text'},
				{ name: 'nama', type: 'text'},
				{ name: 'pekerjaan', type: 'text'},
				{ name: 'alamat', type: 'text'},
				{ name: 'negara', type: 'text'},
				{ name: 'instansi', type: 'text'},
				{ name: 'email', type: 'text'},
				{ name: 'hape', type: 'text'},
				{ name: 'daftar', type: 'text'},
				{ name: 'quiz', type: 'text'},
				{ name: 'presensi', type: 'text'},
				{ name: 'status', type: 'text'},
				{ name: 'bayar', type: 'text'},
				{ name: 'foto', type: 'text'},
			],
			type: 'POST',
			data: {val01: set01, _token: token},
			url: '{{ route("getList5partisipan") }}',
		};
		$('#divtampilan').hide();
		$('#divpenerima').show();
		var dataAdapter = new $.jqx.dataAdapter(source);
		$("#grideventdetail").jqxGrid({
			width: '100%',
			pageable: true,
			autoheight: true,
			filterable: true,
			source: dataAdapter,
			columnsresize: true,
			showfilterrow: true,
			theme: "energyblue",
			selectionmode: 'checkbox',
			altrows: true,
			columns: [
				{ text: 'PRESENSI', editable: false, sortable: false, filterable: false,  columntype: 'button', width: '8%', cellsrenderer: function () {
					return "WA";
					}, buttonclick: function (row) {
						editrow			= row;
						var offset 		= $("#grideventdetail").offset();		
						var dataRecord 	= $("#grideventdetail").jqxGrid('getrowdata', editrow);
						var set01 		= "{{URL::to("/")}}/presentform/"+dataRecord.idne;
						var set02 		= dataRecord.hape;
						var emailbody 	= 'Dear%20participant%20,%20Hereby%20we%20send%20you%20the%20present%20link%20in%20the%20link%20below%0A'+ set01 + '%0AThank%20you%20very%20much.';
						var data 		= 'https://api.whatsapp.com/send?phone='+set02+'&text='+emailbody;
						var windowName 	= 'Send WA';
						var windowSize 	= "width=800,height=800";
						window.open(data, windowName, windowSize);
						event.preventDefault();
					}
				},
				{ text: 'EVALUASI', editable: false, sortable: false, filterable: false,  columntype: 'button', width: '8%', cellsrenderer: function () {
					return "WA";
					}, buttonclick: function (row) {
						editrow			= row;
						var offset 		= $("#grideventdetail").offset();		
						var dataRecord 	= $("#grideventdetail").jqxGrid('getrowdata', editrow);
						var set01 		= "{{URL::to("/")}}/evform/"+dataRecord.idne;
						var set02 		= dataRecord.hape;
						var emailbody 	= 'Dear%20participant%20,%20Hereby%20we%20send%20you%20the%20evaluation%20link%20in%20the%20link%20below%0A'+ set01 + '%0AThank%20you%20very%20much.';
						var data 		= 'https://api.whatsapp.com/send?phone='+set02+'&text='+emailbody;
						var windowName 	= 'Send WA';
						var windowSize 	= "width=800,height=800";
						window.open(data, windowName, windowSize);
						event.preventDefault();
					}
				},
				{ text: 'SERTIFIKAT', editable: false, sortable: false, filterable: false,  columntype: 'button', width: '8%', cellsrenderer: function () {
					return "WA";
					}, buttonclick: function (row) {
						editrow			= row;
						var offset 		= $("#grideventdetail").offset();		
						var dataRecord 	= $("#grideventdetail").jqxGrid('getrowdata', editrow);
						var set01 		= "{{URL::to("/")}}/certificate/"+dataRecord.idne;
						var set02 		= dataRecord.hape;
						var emailbody 	= 'Dear%20participant%20,%20Hereby%20we%20send%20you%20the%20certificate%20in%20the%20link%20below:%0A'+ set01 + '%0AThank%20you%20very%20much.';
						var data 		= 'https://api.whatsapp.com/send?phone='+set02+'&text='+emailbody;
						var windowName 	= 'Send WA';
						var windowSize 	= "width=800,height=800";
						window.open(data, windowName, windowSize);
						event.preventDefault();
					}
				},
				{ text: 'Nama', datafield: 'nama', width: '34%', cellsalign: 'left', align: 'center'  },
				{ text: 'Position', filtertype: 'checkedlist', datafield: 'pekerjaan', width: '30%', cellsalign: 'left', align: 'center'  },
				{ text: 'Email', datafield: 'email', width: '30%', cellsalign: 'left', align: 'center'  },
				{ text: 'No.HP', datafield: 'hape', width: '30%', cellsalign: 'left', align: 'center'  },
				{ text: 'URL Sertifikat', datafield: 'linke', width: '30%', cellsalign: 'left', align: 'center'  },
				{ text: 'Status', datafield: 'status', width: '30%', cellsalign: 'left', align: 'center'  },
				{ text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
					return "Del";
					}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#grideventdetail").offset();		
						var dataRecord 	= $("#grideventdetail").jqxGrid('getrowdata', editrow);
						var token   	= document.getElementById('token').value;
						swal({
							title: 'Are you sure?',
							text: "You won't be able to revert this!",
							type: 'warning',
							showCancelButton: true,
							confirmButtonClass: 'btn btn-confirm mt-2',
							cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
							confirmButtonText: 'Yes, delete it!'
						}).then(function () {
							var val01=dataRecord.nama;
							var val02=dataRecord.idne;
							var val03='';
							var val04='';;
							var val05='';
							var val06='';
							var val07='';
							var val08='';
							var val09='';
							var val10='';
							var val11='';
							var val12='';
							var val13='';
							var val14='';
							var val15='';
							var val16='';
							var val17='';
							var val18='';
							var val19='';
							var val20='hapuspeserta';
							var token=document.getElementById('token').value;		
							$.post('{{ route("exSaveevent") }}', { set01: val01, set02: val02, set03: val03, set04: val04, set05: val05, set06: val06, set07: val07, set08: val08, set09: val09, set10: val10, set11: val11, set12: val12, set13: val13, set14: val14, set15: val15, set16: val16, set17: val17, set18: val18, set19: val19, set20: val20, _token: token }, function(data){					
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
								$("#grideventdetail").jqxGrid('updatebounddata', 'filter');
								return false;
							});
						});
						
					}
				},
			]
		});
	});
	$('#btnsendsertifikat').click(function () {
		var set01 = document.getElementById('id_surat').value;
		var rows = $("#grideventdetail").jqxGrid('selectedrowindexes');
		var selectedRecords = new Array();
		for (var m = 0; m < rows.length; m++) {
			var row = $("#grideventdetail").jqxGrid('getrowdata', rows[m]);
			selectedRecords.push(row.idne);
		}
		var token = document.getElementById('token').value;
		if (m == 0){
			swal({
				title	: 'Stop',
				text	: 'Centang Peserta Yang Ingin di Kirim Email Sertifikat',
				type	: 'warning',
			})
		} else {
			$('#enteni').show();
			$.post('{{ route("exMailer") }}', { val01: set01, val02: 'sertifikat', val03: selectedRecords, _token: token },
			function(data){
				$('#enteni').hide();
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
				$("#grideventdetail").jqxGrid('clearselection');
				$("#grideventdetail").jqxGrid('updatebounddata', 'filter');
				return false;
			});
		}
	});
	$('#downexcell').click(function(){
		var gridContent = $("#grideventdetail").jqxGrid('exportdata', 'json');
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
					var td 		= document.createElement("td");
					var isi 	= data[i][col[j]];
					var isi2 	= isi.toString();
					var pjg 	= isi2.length;
					if (pjg > 8){
						if (pjg == 9 || pjg == 10 || pjg == 11 || pjg == 12 || pjg == 13){
							if( isi2.indexOf(',') != -1 ){
								var res = isi2.replace(/,/g, "");
								td.innerHTML = res;
							}
							else {
								var res = isi2;
								td.setAttribute('style', 'mso-number-format: "\@";');
								td.innerHTML = res;
							}
						}
						else { 
							var res = isi2;
							td.setAttribute('style', 'mso-number-format: "\@";');
							td.innerHTML = res;
						}						
					}
					else {
						var res = isi2.replace(/,/g, "");
						td.innerHTML = res;
					}
						
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
});
</script>
@endpush