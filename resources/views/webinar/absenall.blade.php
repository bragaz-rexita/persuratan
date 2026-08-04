@extends('adminlte3.layout')

@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Welcome</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content" >
        <div class="container-fluid">
            <div class="row" >
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                    <div class="card card-widget widget-user-2">
                        <div class="widget-user-header bg-success">
                            <div class="widget-user-image">
                            <img class="img-circle elevation-2" src="{{asset('agenda.webp')}}" alt="User Avatar">
                            </div>
                            <h3 class="widget-user-username">Agenda : {!! $datane->nama !!}</h3>
                            <h5 class="widget-user-desc">Tempat, Waktu : {!! $datane->tempat !!}, {!! $datane->mulai !!}</h5>
                        </div>
                    </div>
                    <div id="divisian">
                        <div class="card card-body">
                            <p class="login-box-msg">
                                <b><font color="blue" size="+2">Form Presensi Online</font></b>
                            </p>
                            <p class="login-box-msg">
                                <marquee direction="left" scrollamount="3" align="center"><font color="blue">Mohon melengkapai form presensi berikut :</font></marquee>
                            </p>
                            <div class="form-group">
                                <label for="id_email">Email </label><span class="pull-right"><font color="red"> * </font></span>
                                <input type="text" id="id_email" name="id_email" class="form-control"  value="{!! $email_ub !!}">
                            </div>
                            <div class="form-group">
                                <label for="id_nama">Nama Lengkap (Dengan Title)</label> <span class="pull-right"><font color="red"> * </font></span>
                                <input type="text" id="id_nama" name="id_nama" class="form-control"  value="{!! $nama_lengkap !!}">
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label for="id_pekerjaan">Jabatan</label>
                                        <input type="text" id="id_pekerjaan" name="id_pekerjaan" class="form-control" value="PESERTA">
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8">
                                    <div class="form-group">
                                        <label for="id_instansi">Unit Kerja</label>
                                        <input type="text" id="id_instansi" name="id_instansi" class="form-control" value="{!! $fakpanjang !!}">
                                    </div>
                                </div>
                            </div>
                            @if(isset($pengumumans) && $pengumumans == 'REKENING')
                                <div class="form-group row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="id_bank">Nama Bank:</label>
                                            <input type="text" id="id_bank" name="id_bank" class="form-control" value="{!! $bank !!}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="id_norek">No. Rekening</label>
                                            <input type="text" id="id_norek" name="id_norek" class="form-control" value="{!! $norek !!}">
                                        </div>
                                    </div>
                                </div>
							@else
                                <input type="hidden" id="id_bank" name="id_bank" class="form-control" value="{!! $bank !!}">
                                <input type="hidden" id="id_norek" name="id_norek" class="form-control" value="{!! $norek !!}">
                            @endif
                            <div class="small-box bg-green-gradient" id="previewttd">
                                <div class="inner">
                                    <img src="{{ $tandatangan }}" width="80" height="80" id="imagettd" />
                                </div>
                                <div class="social-auth-links text-center">
                                    <a href="#" class="btn btn-danger" id="btnchangesig">Ubah Tandatangan</a>
                                    <a href="#" class="btn btn-success" id="btnisinotulensi">Isi Notulensi</a>
                                </div>
                            </div>
                            <div class="btn-group" id="divpilihan">
                                <a id="btnsigwithimg" href="#" class="btn btn-block btn-primary">
                                    <i class="fa fa-file-image-o"></i> Upload
                                </a>
                                <a id="btnsigwithdraw" href="#" class="btn btn-block btn-warning">
                                    <i class="fa fa-openid"></i> Buat Tandatangan
                                </a>
                            </div>
                            <div class="card-box bg-primary widget-flat border-primary text-white" id="ttddgngambar">
                                <div class="form-row text-center">
                                    Gunakan Nama Sebagai Tandatangan
                                    <div class="col-lg-8 col-xs-6">
                                        <input type="text" id="id_namabiasa" name="id_namabiasa" class="form-control"  value="{!! $namasaja !!}">
                                    </div>
                                    <div class="col-lg-2 col-xs-6">
                                        <button id="btnsigwithname" class="btn btn-success">Draw</button>
                                    </div>
                                </div>
                                <div class="form-row kotakttd">
                                    <div class="col-lg-4 col-md-4">
                                        
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <canvas id="signature-pad" class="signature-pad" width=320 height=200></canvas>
                                        <canvas id="signature-blank" width=320 height=200 style='display:none'></canvas>
                                        <img src="{{ asset('boxed-bg.png') }}" width=320 height=200 />
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button id="clearttd" class="btn btn-danger pull-left">Bersihkan Kotak TTD</button>
                                    <button id="closettd" class="btn btn-info pull-right">Kembali</button>
                                </div>
                                
                            </div>
                            <div class="form-group" id="ttddgnupload">
                                <div class="btn-group">
                                    <a href="javascript:addFile()" class="btn btn-xs btn-primary">
                                        <i class="glyphicon glyphicon-edit"></i> Pilih File TTD
                                    </a>
                                    <a></a>
                                    <!--
                                    <a href="javascript:removeImage()" class="btn btn-xs btn-warning">
                                        <i class="glyphicon glyphicon-trash"></i> Change
                                    </a>
                                    -->
                                    <a></a>
                                    <a href="javascript:backtochoos()" class="btn btn-xs btn-danger">
                                        <i class="fa fa-close"></i> Close
                                    </a>
                                </div>
                                <div style="width:200px;height: 200px; border: 1px solid whitesmoke ;text-align: center;position: relative" id="image" class="center">
                                    <img id="preview" src="{{asset('logogrey.png')}}" width="150px" height="150px"/><br/>
                                    <input type="file" id="addfile" style="display: none;"/>
                                    <i id="loading" class="fa fa-spinner fa-spin fa-3x fa-fw" style="position: absolute;left: 40%;top: 40%;display: none"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card card-footer">
                            <div id="foooternotulensi">
                                <div class="form-group">
                                    <label for="id_satu">Informasi tentang Rapat mudah didapatkan</label>
                                    <select class="form-control" name="id_satu" id="id_satu">
                                        <option value="0"> Choose </option>
                                        <option value="1"> Sangat Tidak Setuju </option>
                                        <option value="2"> Tidak Setuju </option>
                                        <option value="3"> Netral </option>
                                        <option value="4"> Setuju </option>
                                        <option value="5"> Sangat Setuju </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_dua">Proses registrasi mudah dilakukan</label>
                                    <select class="form-control" name="id_dua" id="id_dua">
                                        <option value="0"> Choose </option>
                                        <option value="1"> Sangat Tidak Setuju </option>
                                        <option value="2"> Tidak Setuju </option>
                                        <option value="3"> Netral </option>
                                        <option value="4"> Setuju </option>
                                        <option value="5"> Sangat Setuju </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_tiga">Materi bermanfaat dan sesuai dengan kebutuhan saya</label>
                                    <select class="form-control" name="id_tiga" id="id_tiga">
                                        <option value="0"> Choose </option>
                                        <option value="1"> Sangat Tidak Setuju </option>
                                        <option value="2"> Tidak Setuju </option>
                                        <option value="3"> Netral </option>
                                        <option value="4"> Setuju </option>
                                        <option value="5"> Sangat Setuju </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_empat">Waktu penyelenggaraan cukup</label>
                                    <select class="form-control" name="id_empat" id="id_empat">
                                        <option value="0"> Choose </option>
                                        <option value="1"> Sangat Tidak Setuju </option>
                                        <option value="2"> Tidak Setuju </option>
                                        <option value="3"> Netral </option>
                                        <option value="4"> Setuju </option>
                                        <option value="5"> Sangat Setuju </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_lima">Narasumber menguasai materi dengan baik</label>
                                    <select class="form-control" name="id_lima" id="id_lima">
                                        <option value="0"> Choose </option>
                                        <option value="1"> Sangat Tidak Setuju </option>
                                        <option value="2"> Tidak Setuju </option>
                                        <option value="3"> Netral </option>
                                        <option value="4"> Setuju </option>
                                        <option value="5"> Sangat Setuju </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_enam">Materi Yang di Sampaikan</label>
                                    <textarea id="id_enam" name="id_enam" style="width: 100%; height: 100px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd;"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="id_saran">Kesimpulan / Saran / Kritik</label>
                                    <textarea id="id_saran" name="id_saran" style="width: 100%; height: 100px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd;"></textarea>
                                </div>
                            </div>
                            <div id="footerbiasa">
                                <input type="hidden" id="idne" value="{{ $idne }}">
                                <input type="hidden" id="idevent" value="{{ $idevent }}">
                            </div>
                            <div class="social-auth-links text-center">
                                <a id="btnsimpan" href="#" class="btn btn-block btn-social btn-primary">
                                    <i class="fa fa-calendar-plus-o"></i> Simpan Presensi
                                </a>
                            </div>
                        </div>
                        
                    </div>
                    <div id="divterimakasih">
                        <p class="login-box-msg">
                            <b><font color="blue" size="+2">Terimakasih Atas Kehadirannya<br /></font>{!! $nama !!}</b>
                        </p>
                        <p class="login-box-msg">
                            <marquee direction="left" scrollamount="3" align="center"><font color="blue">Selamat Melanjutkan Agenda Rapat Berikutnya</font></marquee>
                        </p>
                        <div id='gridlatest'></div>
                    </div>
                </div>
                <div class="col-md-3">
                </div>
            </div>
		</div>
	</div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="idsurat" id="idsurat" value="{{ $datane->id }}">
<input type="hidden" name="setttd" id="setttd" value="{{ $tandatangan }}">
<input type="hidden" name="setttdview" id="setttdview" value="{{ $setttd }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
<style>
    .kotakttd {
        position: relative;
        width: 320px;
        height: 200px;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border: solid 1px #ddd;
        margin: 10px 0px;
    }
    .signature-pad {
        position: absolute;
        left: 0;
        top: 0;
        width:320px;
        height:200px;
    }
</style>
@endsection
@push('script')
<!-- SIGNATURE PAD -->
<script src="{{ asset('plugins/signature_pad/signature_pad.js') }}"></script>
<script type="text/javascript">
    function opendatapegawai( jQuery ){
		var set01=document.getElementById('idevent').value;
		var token=document.getElementById('token').value;
		var source = {
			datatype: "json",
			datafields: [
				{ name: 'nama', type: 'text'},
				{ name: 'foto', type: 'text'}
			],
			type: 'POST',
			data: {val01: set01, _token: token},
			url: '{{ route("getListpartisipanok") }}',
		};
		var photorenderer = function (row, column, value) {
            var name = $('#gridlatest').jqxGrid('getrowdata', row).foto;
            if (name == ''){ imgurl = 'logogrey.png'; }
            else { imgurl = name; }
            var img = '<div style="background: white;"><img style="margin:2px; margin-left: 10px;" width="50" height="50" src="' + imgurl + '"></div>';
            return img;
        }
		var dataAdapter = new $.jqx.dataAdapter(source);
		$("#gridlatest").jqxGrid({
			width: '100%',
			height: 50,
			sortable: true,
			autoheight: true,
			autorowheight: true,
			pageable: true,
			source: dataAdapter,
			altrows: true,
			theme: "energyblue",
			columns: [
                { text: 'Picture', width: '20%', cellsrenderer: photorenderer, editable: false, sortable: false, filterable: false },
                { text: 'Name', datafield: 'nama', width: '80%', cellsalign: 'left', align: 'center' },
            ]  
		});
	}
    function addFile() {
        $('#addfile').click();
    }
    $('#addfile').change(function () {
        if(this.files[0].size > 7000000){
            alert("File is too big!");
            this.value = "";
        } else {
            var imgPath = this.value;
            var ukfile 	= this.files[0].size;
            var ext 	= imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            $("#id_jnfile").val(ext);
            $("#id_ukfile").val(ukfile);
            if(ext == "jpg" || ext == "jpeg" || ext == "png") {
                readURL(this);
            } else {
                alert("Please select image file (jpg, jpeg, png).");
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
    function removeImage() {
        $('#preview').attr('src', '../logogrey.png');
    }
    function backtochoos() {
        $('#divpilihan').show();
        $('#previewttd').hide();
        $('#ttddgngambar').hide();
        $('#ttddgnupload').hide();
    }
    $(function () {
        CKEDITOR.env.isCompatible = true;
        CKEDITOR.replace( 'id_saran', {
            toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],
            removeButtons: 'Strike',
            width: '100%',
            height: 90	
        });
        CKEDITOR.replace( 'id_enam', {
            toolbarGroups: [{"name":"paragraph","groups":["list"]}],
            removeButtons: 'Strike',
            width: '100%',
            height: 90	
        });
    });	
$(document).ready(function () {
    let myFont = new FontFace(
        "Tangerine",
        "url(https://fonts.gstatic.com/s/tangerine/v15/IurY6Y5j_oScZZow4VOxCZZMprNA4A.woff2)"
    );
    $('#id_email').on('change', function (){		
		var x = document.getElementById('id_email').value;
		$.post('{{ route("getPegawaiWebinar") }}', { set01: x, _token: '{{ csrf_token() }}' },
		function(data){
            var tandatangan = data.tandatangan;
            $("#id_namabiasa").val(data.namasaja);
            $("#id_nama").val(data.nama);
            $("#id_instansi").val(data.unitkerja);
            $("#id_bank").val(data.bank);
            $("#id_norek").val(data.norek);
            $("#id_pekerjaan").val(data.jabatan);
            $('#divpilihan').hide();
            $('#previewttd').hide();
            $('#ttddgngambar').show();
            $('#ttddgnupload').hide();
			if (tandatangan == ''){
                const canvas            = document.getElementById("signature-pad");
                const context           = canvas.getContext("2d");
                    context.fillStyle   = "blue";
                    context.font        = "bold 60px Tangerine";
                    context.fillText(data.namasaja, 20, 90, 270);
            } else {
                signaturePad.fromDataURL(tandatangan);
            }
			
            return false;
		});
	});
    $('#id_nama').on('change', function (){		
		var x = document.getElementById('id_nama').value;
		var y = document.getElementById('id_namabiasa').value;
        if (y == ''){
            $("#id_namabiasa").val(x);
        }
	});
	$('#divterimakasih').hide();
    $('#divpilihan').hide();
    $('#ttddgngambar').hide();
    $('#ttddgnupload').hide();
    $('#divterimakasih').hide();
    $('#foooternotulensi').hide();
    $('#footerbiasa').show();
    var gambar          = document.getElementById('setttd').value;
    var setgambar       = document.getElementById('setttdview').value;
    var signaturePad    = new SignaturePad(document.getElementById('signature-pad'), {
        backgroundColor: 'rgba(0, 0, 0, 0)',
        penColor: 'rgb(0, 0, 0)'
    });
    if (setgambar == 'ada'){
        signaturePad.fromDataURL(gambar);
    }
    $('#clearttd').click(function () {
        signaturePad.clear();
    });
    $('#closettd').click(function () {
        $('#divpilihan').show();
        $('#previewttd').hide();
        $('#ttddgngambar').hide();
        $('#ttddgnupload').hide();
    });
    $('#btnisinotulensi').click(function () {
        $('#foooternotulensi').show();
        $('#footerbiasa').hide();
    });
    $('#btnsimpan').click(function () {
        var set01=document.getElementById('idne').value;
        var set02='';
        var set03=document.getElementById('idevent').value;
        var set04=document.getElementById('id_nama').value;
        var set05=document.getElementById('id_instansi').value;
        var set06=document.getElementById('id_email').value;
        var set07=document.getElementById('id_pekerjaan').value;
        var set10=document.getElementById('id_bank').value;
        var set11=document.getElementById('id_norek').value;
        var set08=signaturePad.toDataURL('image/png');
        var set12=document.getElementById('id_satu').value;
        var set13=document.getElementById('id_dua').value;
        var set14=document.getElementById('id_tiga').value;
        var set15=document.getElementById('id_empat').value;
        var set16=document.getElementById('id_lima').value;
        var set17=CKEDITOR.instances['id_enam'].getData()
        var set18=CKEDITOR.instances['id_saran'].getData()
        
        var gagal='';
        var jenis='';
        if (set08 == document.getElementById('signature-blank').toDataURL()){
            if ($('#addfile').val() == ''){
                var gagal = 'Mohon Menggambarkan Tandatangan Bapak/Ibu Menggunakana Tombol Change Signature';
            } else {
                var set08 = document.getElementById('addfile');
                var set08 = set08.files[0];
                var jenis = 'gambar';
                var gagal = 'tidak';
            }
        } else {
            var gagal = 'tidak';
        }
        if (gagal == 'tidak'){
            var form_data = new FormData();
                form_data.append('val01', set01);
                form_data.append('val02', set02);
                form_data.append('val03', set03);
                form_data.append('val04', set04);
                form_data.append('val05', set05);
                form_data.append('val06', set06);
                form_data.append('val07', set07);
                form_data.append('val08', set08);
                form_data.append('val09', jenis);
                form_data.append('val10', set10);
                form_data.append('val11', set11);
                form_data.append('val12', set12);
                form_data.append('val13', set13);
                form_data.append('val14', set14);
                form_data.append('val15', set15);
                form_data.append('val16', set16);
                form_data.append('val17', set17);
                form_data.append('val18', set18);
                form_data.append('_token', '{{csrf_token()}}');
            $.ajax({
                url: '{{ route("exPresensiwebinar") }}',
                data: form_data,
                type: 'POST',
                contentType: false,
                processData: false,
                success: function (data) {
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
                        hideAfter: 3000,
                        stack: 1
                    });
                    $('#divisian').hide();
                    $('#divterimakasih').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    opendatapegawai();
                    return false; 
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        } else {
            swal({
                title: 'Mohon lengkapi',
                text: gagal,
                type: 'info',
            });
        }
    });
    $('#btnchangesig').click(function () {
        $('#divpilihan').show();
        $('#previewttd').hide();
        $('#ttddgngambar').hide();
        $('#ttddgnupload').hide();
    });
    $('#btnsigwithname').click(function () {
        var text                = document.getElementById('id_namabiasa').value;
        if (text == ''){
            swal({
                title: 'Mohon lengkapi',
                text: 'Nama Lengkap Wajib di Isi',
                type: 'info',
            });
        } else {
            const canvas            = document.getElementById("signature-pad");
            const context           = canvas.getContext("2d");
                context.fillStyle   = "blue";
                context.font        = "bold 60px Tangerine";
                context.fillText(text, 20, 90, 270);
        }
    });
    $('#btnsigwithimg').click(function () {
        $('#divpilihan').hide();
        $('#previewttd').hide();
        $('#ttddgngambar').hide();
        $('#ttddgnupload').show();
    });
    $('#btnsigwithdraw').click(function () {
        $('#divpilihan').hide();
        $('#previewttd').hide();
        $('#ttddgngambar').show();
        $('#ttddgnupload').hide();
    });
});	
</script>
@endpush