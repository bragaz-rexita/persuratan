@extends('base.layout')

@section('content')
<div class="content-wrapper">
	<section class="content-header">
      <h1>
        Welcome
        <small>Please Update Your Data</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>
	<section class="content">
		<div class="row">
			<div class="col-lg-4">
				<div class="box box-success">
					<div class="box-header with-border">
						<i class="fa fa-users"></i>
						<h3 class="box-title">Open Full Profile</h3>			  
					</div>
					<div class="box-body">
						<div class="box-body">
						 	<div class="box-body">
								<div class="form-group">
									<label for="pilih_jabatan">Jenis Pegawai</label>
									<select id="pilih_jabatan" name="pilih_jabatan" size="1" class="form-control">
										<option value="">Pilih Salah Satu</option>
										<option value="Dosen">Dosen</option>
										<option value="AnalisKepegawaian">Tendik</option>
									</select>
								</div>
							</div>
							<div class="box-footer">                 
								<button type="button" class="btn btn-success" id="btnviewriwayat">Open Full Profile</button>
							</div><!-- /.box-footer-->
						</div><!--/.direct-chat -->  
					</div>
				</div>
				<div class="box box-danger">
					<div class="box-header with-border">
						<i class="fa fa-users"></i>
						<h3 class="box-title">Renew Data </h3>			  
					</div>
					<div class="box-body">
						<div class="box-body">
						 	<div class="box-body">
								<div class="form-group">
								  <label>Nama Lengkap</label>
								  <input type="text" id="id_nama" name="id_nama" class="form-control" value="{{ Session('nama') }}" disabled="disable">
								</div>
								<div class="form-group">
								  <label>NIP/NIK</label>
								  @if(isset($nip))
								  <input type="text" id="id_nip" name="id_nip" class="form-control" value="{{$nip}}">
								  @else 
								  <input type="text" id="id_nip" name="id_nip" class="form-control">
								  @endif

								</div>
								<div class="form-group">
								  <label>Email UB Anda</label>
								  <input type="text" id="id_email" name="id_email" class="form-control">
								</div>
								<div class="form-group">
									<label>Pangkat dan Golongan</label>
									<select id="id_golongan" class="form-control">
										<option value="">Tidak/Belum Punya</option>
										@foreach($golongan as $row)
											<option value="{{$row->kode}}">{{$row->pangkat}}, {{$row->golongan}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label>Unit Kerja (Untuk Peg. Kantor Pusat Mohon di Kosongkan)</label>
									<select id="id_satker" class="form-control">
										<option value="">Pilih Salah Satu</option>
										@foreach($fakultass as $rfakultas)
											<option value="{{$rfakultas->fakultas}}">{{$rfakultas->fakpanjang}} ( {{$rfakultas->fakultas}} )</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="box-footer">                 
								<button type="button" class="btn btn-success" id="btnsimpandata">Simpan</button>
							</div><!-- /.box-footer-->
						</div><!--/.direct-chat -->  
					</div>
				</div>
			</div>
			<div class="col-lg-8">
				<div class="box box-info">
					<div class="box-header with-border">
						<i class="fa fa-users"></i>
						<h3 class="box-title">Welcome</h3>
					</div><!-- /.box-header -->
					<div class="box-body">
						<div class="box-body">
						  <!-- Conversations are loaded here -->
							<div class="box-body">
								Selamat Datang di Collaborative Office, Untuk mengaksess ke Kantor Digital lain yang ada di SCO ini dimohon untuk mengupdate data anda terlebih dahulu. Data anda hanya diminta input 1x saja untuk dapat menggunakan seluruh layanan kantor digital yang telah tergabung dalam SCO.
								<p>Terima Kasih</p>
								<button class="btn btn-danger btn-round btn-block" onclick="javascript:window.history.back();">
									<i class="fa fa-arrow-left bigger-120 red"></i>
									Kembali ke Halaman Semula
								</button>
							</div>
						</div>  
					</div>
					<div class="box-body">
						<div class="box-body">
							<div class="box-body">
								<div class="row">
									<div class="col-lg-6">
										<label>Format Paraf Anda</label>
										<img src="{{ asset('dist/img/boxed-bg.jpg') }}" width="280" height="200" />	
										<canvas id="paraf-pad" class="signature-pad" width="280" height="200"></canvas>
										<canvas id="signature-blank" class="signature-pad" width="280" height="200" style='display:none'></canvas>
										<button id="clearparaf" class="btn btn-danger">Clear</button>
									</div>
									<div class="col-lg-6">
										<label>Format Tanda Tangan Anda</label>
										<img src="{{ asset('dist/img/boxed-bg.jpg') }}" width="280" height="200" />
										<canvas id="signature-pad" class="signature-pad" width="280" height="200"></canvas>
										<button id="clearttd" class="btn btn-danger">Clear</button>
									</div>
								</div>
								<div class="row">
									<p class="text-block">Bila anda kesulitan untuk membuat template tanda tangan / paraf anda. anda bisa mengupload scan tanda tangan dan paraf anda di sini. Dengan format PNG berukuran 280x200 transparant background</p>
									<div class="col-lg-6">
										<div class="form-group">
											<a href="javascript:addFile()" class="btn btn-xs btn-google pull-left">
												<i class="glyphicon glyphicon-edit"></i> Pilih File Paraf
											</a>
											<a href="javascript:removeImage()" class="btn btn-xs btn-facebook pull-right">
												<i class="glyphicon glyphicon-trash"></i> Ubah Paraf
											</a>
										</div>
										<p class="center">------------------------</p>
										<div style="width:200px;height: 200px; border: 1px solid whitesmoke ;text-align: center;position: relative" id="image" class="center">
											<img id="preview" src="{{asset('dist/img/takadagambar.jpg')}}" width="150px" height="150px"/><br/>
											<input type="file" id="addfile" style="display: none;"/>
											<i id="loading" class="fa fa-spinner fa-spin fa-3x fa-fw" style="position: absolute;left: 40%;top: 40%;display: none"></i>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<a href="javascript:addFilettd()" class="btn btn-xs btn-google pull-left">
												<i class="glyphicon glyphicon-edit"></i> Pilih File Tandatangan
											</a>
											<a href="javascript:removeImagettd()" class="btn btn-xs btn-facebook pull-right">
												<i class="glyphicon glyphicon-trash"></i> Ubah Tandatangan
											</a>
										</div>
										<p class="center">------------------------</p>
										<div style="width:200px;height: 200px; border: 1px solid whitesmoke ;text-align: center;position: relative" id="image" class="center">
											<img id="previewttd" src="{{asset('dist/img/takadagambar.jpg')}}" width="150px" height="150px"/><br/>
											<input type="file" id="addfilettd" style="display: none;"/>
											<i id="loading" class="fa fa-spinner fa-spin fa-3x fa-fw" style="position: absolute;left: 40%;top: 40%;display: none"></i>
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
<style>
	.kotakttd {
		position: relative;
		width: 280px;
		height: 200px;
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}
	.signature-pad {
		position: absolute;
		left: 0;
		top: 0;
		width:280px;
		height:200px;
	}
</style>
<!-- TOKEN -->
<div class="modal fade" id="modalerror">
  <div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Error..!!!</h4>
		</div>
		<div class="modal-body">
			<div class="form-group">
				<input type="text" class="form-control" readonly="readonly" id="err_text">
			</div><!-- /input-group -->
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>	
		</div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="id_nmfile" id="id_nmfile">
<input type="hidden" name="id_ukfile" id="id_ukfile">
<input type="hidden" name="id_jnfile" id="id_jnfile">
<input type="hidden" name="id_nmfilettd" id="id_nmfilettd">
<input type="hidden" name="id_ukfilettd" id="id_ukfilettd">
<input type="hidden" name="id_jnfilettd" id="id_jnfilettd">
<input type="hidden" name="pilih_idne" id="pilih_idne" value="
@php
	if (isset($idpeg)) {
		echo $idpeg;
	} else {
		echo 0;
	}
@endphp
">
@endsection
@push('script')
<script type="text/javascript">
	function addFile() {
        $('#addfile').click();
    }
	function addFilettd() {
        $('#addfilettd').click();
    }
	$('#addfile').change(function () {
        if(this.files[0].size > 700000){
            alert("File is too big!");
            this.value = "";
        } else {
            var imgPath = this.value;
			var ukfile 	= this.files[0].size;
            var ext 	= imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
			$("#id_jnfile").val(ext);
			$("#id_ukfile").val(ukfile);
            if(ext == 'pdf') {
                $('#preview').attr('src', 'dist/img/pdf.png');
            } else if(ext == "jpg" || ext == "jpeg" || ext == "png") {
                readURL(this);
            } else {
                alert("Please select image file (jpg, jpeg, pdf).");
            }
        }
    });
	$('#addfilettd').change(function () {
        if(this.files[0].size > 700000){
            alert("File is too big!");
            this.value = "";
        } else {
            var imgPath = this.value;
			var ukfile 	= this.files[0].size;
            var ext 	= imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
			$("#id_jnfilettd").val(ext);
			$("#id_ukfilettd").val(ukfile);
            if(ext == 'pdf') {
                $('#previewttd').attr('src', 'dist/img/pdf.png');
            } else if(ext == "jpg" || ext == "jpeg" || ext == "png") {
                readURLttd(this);
            } else {
                alert("Please select image file (jpg, jpeg, pdf).");
            }
        }
    });
	function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
            };
        }
    }
	function readURLttd(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#previewttd').attr('src', e.target.result);
            };
        }
    }
	function removeImage() {
        $('#preview').attr('src', 'dist/img/takadagambar.jpg');
    }
	function removeImagettd() {
        $('#previewttd').attr('src', 'dist/img/takadagambar.jpg');
    }
$(document).ready(function () {
	$('#btnviewriwayat').on('click', function (){
		$("#modalpilihjabatan").modal('hide');
		var jabatan = document.getElementById('pilih_jabatan').value;
		var idpeg 	= document.getElementById('pilih_idne').value;
		if (idpeg == '' || idpeg == null){
			swal({
				title: 'Data Not Found !',
				text: 'Isi Data Diri Anda Terlebih Dahulu di Kotak Di Bawah Ini',
				type: 'warning',
				timer: 2000
			}).then(
				function () {
				},
				function (dismiss) {
					if (dismiss === 'timer') {
						
					}
				}
			)
		} else {
			var url 	= "{{URL::to("/")}}/viewbiodata/"+jabatan+"-"+idpeg;
			$(location). attr('href',url);
			return false;
		}
	});
	var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
	  backgroundColor: 'rgba(0, 0, 0, 0)',
	  penColor: 'rgb(0, 0, 0)'
	});
	var parafPad = new SignaturePad(document.getElementById('paraf-pad'), {
	  backgroundColor: 'rgba(0, 0, 0, 0)',
	  penColor: 'rgb(0, 0, 0)'
	});
	$('#clearttd').click(function () {
		signaturePad.clear();
	});
	$('#clearparaf').click(function () {
		parafPad.clear();
	});
	$('#btnsimpandata').click(function () {
		var set01	= document.getElementById('id_nip').value;
		var set02	= document.getElementById('id_golongan').value;
		var set03	= document.getElementById('id_email').value;
		var set04 	= signaturePad.toDataURL('image/png');
		var set05 	= parafPad.toDataURL('image/png');
		if (set04 == document.getElementById('signature-blank').toDataURL()){ 
			var set04 = document.getElementById('addfilettd');
			var set04 = set04.files[0];
			var set06 = 'uploadttd';
		} else { var set06='create';}
		if (set05 == document.getElementById('signature-blank').toDataURL()){ 
			var set05 = document.getElementById('addfile');
			var set05 = set05.files[0];
			var set07 = 'uploadparaf'
		} else { var set07 = 'create'; }
		var set08	= document.getElementById('id_satker').value;
		var token   = document.getElementById('token').value;
		var form_data = new FormData();
			form_data.append('val01', set01);
			form_data.append('val02', set02);
			form_data.append('val03', set03);
			form_data.append('val04', set04);
			form_data.append('val05', set05);
			form_data.append('val06', set06);
			form_data.append('val07', set07);
			form_data.append('val08', set08);
			form_data.append('_token', token);
			$.ajax({
				url: 'user/anyaridata',
				data: form_data,
				type: 'POST',
				contentType: false,
				processData: false,
				success: function (data) {
					var status  = data.status;
					var message = data.message;
					var warna 	= data.warna;
					var icon 	= data.icon;
					if(data['status'] == 'error') {
						$.toast({
							heading: 'GAGAL',
							text: data['message'],
							position: 'top-right',
							loaderBg: '#bf441d',
							icon: 'error',
							hideAfter: 5000,
							stack: 1
						});
					} else {
						$.toast({
							heading: 'Berhasil',
							text: data['message'],
							position: 'top-right',
							loaderBg: '#5ba035',
							icon: 'success',
							hideAfter: 5000,
							stack: 1
						});
						setTimeout(function () {
						location.reload();
						}, 5000);
					}
					return false;
				},
				error: function (xhr, status, error) {
					var pesan = xhr.responseText;
					$('#addfile').val('');
					$('#addfilettd').val('');
					$("#err_text").val(pesan); 
					$("#modalerror").modal('show');
				}
			});
	});
});
</script>
@endpush