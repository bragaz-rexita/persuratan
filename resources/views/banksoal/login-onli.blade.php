<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>@if (isset($namaapps01)){{ $namaapps01 }}@else{{ config('global.Title') }}@endif</title>
		<meta content="@if (isset($domainapps01)){{ $domainapps01 }}@else{{ config('global.swandhananama') }}@endif" name="description" />
        <meta content="@if (isset($subdomainapps01)){{ $subdomainapps01 }}@else{{ config('global.swandhanauniv') }}@endif" name="author" />
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="icon" href="{{ asset('logo-ub.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('logo-ub.png') }}">
        <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
		<link href="{{ asset('dist/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('plugins/iCheck/all.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('adminlte3/plugins/sweet-alert/sweetalert2.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('plugins/iCheck/square/blue.css') }}" rel="stylesheet" type="text/css" />
    </head>
    <body class="login-page" style="background-image: url('{{asset('dist/img/mrin/bgimage.png')}}'); background-repeat: no-repeat; background-position: center;">
		<div class="login-box">
			<div class="login-logo" id="divlogo">
				<img src="{{ asset('duidev-softwarehouse.png') }}" alt="IMG" width="200" height="200"><br />
			</div><!-- /.login-logo -->
			<div id="loading" class="login-logo">
				<img width="100%" src="{{ asset('dist/img/loading.gif') }}" class="img-responsive" alt="Photo">
			</div>
			
			<div class="login-box-body" id="formisitelemedi">
				<p class="login-box-msg">
				@if(Session::has('message'))
					<font color="red">{{ Session('message') }}</font>
				@else
					<marquee direction="left" scrollamount="3" align="center"><font color="white">Selamat Datang di @if (isset($namaapps01)){{ $namaapps01 }}@else{{ config('global.Title') }}@endif, Silahkan Login Untuk Melanjutkan</font></marquee>
				@endif
				</p>
				
				<form action="{{ url('authenticate') }}" method="POST">
					{{ csrf_field() }}
				<div class="form-group has-feedback">
					<input class="form-control" type="text" name="email" id="email" placeholder="Enter your username">
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="password" name="password"  id="password" class="form-control" placeholder="Password" onkeyup="submitForm(event)"/>
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<div class="row">
					<div class="col-xs-2"> </div>
					<div class="col-xs-6">    
					<div class="checkbox icheck">
						<label>
						<input type="checkbox" name="remember" id="remember"><font color="white"> Remember Me</font>
						</label>
					</div>                        
					</div><!-- /.col -->
					<div class="col-xs-4">
					<button id="btnlogin" type="button" class="btn btn-primary btn-block">Sign In</button>
					</div><!-- /.col -->
				</div>
				</form>
                <div class="social-auth-links text-center">
                    <p class="mb-1">
                        <a href="#" id="btnlupapassword">I forgot my password</a>
                    </p>
                    <p class="mb-0">
                        <a href="#" id="btnregister" class="text-center">Register a new membership</a>
                    </p>
                </div>
			</div><!-- /.login-box-body -->
			<div class="login-box-body" id="divlupapassword">
				<p class="login-box-msg">Tuliskan Email Yang Telah di Daftarkan</p>
                <form action="" method="POST">
                    <div class="form-group has-feedback">
                        <input class="form-control" type="text" name="email" id="lupa_email" placeholder="Enter your username">
                        <span class="fa fa-envelope form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <a href="#" class="btn btn-app bg-red pull-left btnkelogin">
                                <i class="fa fa-refresh"></i> Kembali ke laman login
                            </a>
                        </div>
                        <div class="col-6">
                            <a id="btnkirimemail" href="#" class="btn btn-app bg-green btn-primary pull-right">
                                <i class="fa fa-unlock-alt"></i> Kirim Password ke Email
                            </a>
                        </div>
                    </div>
                </form>
			</div>
			<div class="login-box-body" id="formonline">
				<div class="form-horizontal" id="divisian">
					<p class="login-box-msg">Lengkapi formulir berikut untuk mendaftar</p>
                    <form action="" method="POST">
                        <div class="form-group has-feedback">
                            <input type="text" name="id_nama" id="id_nama" class="form-control" placeholder="Nama Lengkap"/>
                            <span class="fa fa-user form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="text" name="id_ktp" id="id_ktp" class="form-control" placeholder="Instansi Asal"/>
                            <span class="fa fa-credit-card form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="email" name="id_email" id="id_email" class="form-control" placeholder="Email"/>
                            <span class="fa fa-envelope form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="number" name="id_hape" id="id_hape" class="form-control" placeholder="No. HP(WA)"/>
                            <span class="fa fa-mobile-phone form-control-feedback"></span>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <a href="#" class="btn btn-app bg-red pull-left btnkelogin">
                                    <i class="fa fa-refresh"></i> Kembali ke laman login
                                </a>
                            </div>
                            <div class="col-6">
                                <a id="btnsimpan" href="#" class="btn btn-app bg-green btn-primary pull-right">
                                    <i class="fa fa-unlock-alt"></i> Daftarkan
                                </a>
                            </div>
                        </div>
                        <div class="social-auth-links text-center">
                            <input type="hidden" id="id_idne" value="new">
                            <input type="hidden" id="id_firebase" value="{!!$firebaseid!!}">
                            <input type="hidden" id="id_fakultas" value="{!!$subdomainapps01!!}">
                            <input type="hidden" id="id_fakpanjang" value="{!!$subsubdomainapps01!!}">
                        </div>
                    </form>
				</div>
				<div class="form-horizontal" id="divterimakasih">
					<div class="card card-danger">
						<div class="card-header">
							<h3 class="card-title" id="status"><font color="white">Terkini</font></h3>
						</div>
						<div class="card-footer text-center">
							<font color="white" id="pesan">Silahkan Melanjutkan ke Email Anda Untuk Aktivasi</font>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.login-box -->
        <!-- Begin page -->
		<script src="{{ asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
		<!-- Bootstrap 3.3.2 JS -->
		<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
		<!-- iCheck -->
		<script src="{{ asset('plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('adminlte3/plugins/sweet-alert/sweetalert2.min.js') }}"></script>
        <script>
			$(function () {
				$('input').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%' // optional
				});
			});
			function submitForm(e) {
                var keyCode = e.keyCode ? e.keyCode : e.which;
                if (keyCode == 13){
                    $('#btnlogin').click();
                }
            }
            $(document).ready(function() {
                $('#loading').hide();
                $('#divlupapassword').hide();
                $('#formonline').hide();
                $('.btnkelogin').click(function () {
                    $('#formisitelemedi').show();
                    $('#formonline').hide();
                    $('#divlupapassword').hide();
                });
                $('#btnregister').click(function () {
                    $('#formisitelemedi').hide();
                    $('#divterimakasih').hide();
                    $('#divisian').show();
                    $('#formonline').show();
                    $('#divlupapassword').hide();
                });
                $('#btnlupapassword').click(function () {
                    $('#formisitelemedi').hide();
                    $('#divlupapassword').show();
                });
                $('#btnsimpan').click(function () {
                    var set01=document.getElementById('id_nama').value;
                    var set02=document.getElementById('id_ktp').value;
                    var set03=document.getElementById('id_email').value;
                    var set04=document.getElementById('id_hape').value;
                    var set05=document.getElementById('id_fakultas').value;
                    var set06=document.getElementById('id_fakpanjang').value;
                    var set07=document.getElementById('id_firebase').value;
                    if (set01 == ''){ 
                        swal({
                            title: 'Mohon lengkapi',
                            text: 'Nama Lengkap Wajib di Isi',
                            type: 'info',
                        });
                    } else if (set02 == ''){ 
                        swal({
                            title: 'Mohon lengkapi',
                            text: 'KTP Belum Terisi',
                            type: 'info',
                        });
                    } else if (set03 == ''){
                        swal({
                            title: 'Mohon lengkapi',
                            text: 'Email Aktif Wajib di Isi',
                            type: 'info',
                        });
                    } else if (set04 == ''){ 
                        swal({
                            title: 'Mohon lengkapi',
                            text: 'No. HP Wajib di Isi',
                            type: 'info',
                        });
                    } else {
                        $('#loading').show();
                        $('#divlogo').hide();
                        $('#divawal').hide();
                        var formdata = new FormData();
                            formdata.set('val01',set01);
                            formdata.set('val02',set02);
                            formdata.set('val03',set03);
                            formdata.set('val04',set04);
                            formdata.set('val05',set05);
                            formdata.set('val06',set06);
                            formdata.set('val07',set07);
                            formdata.set('_token','{{ csrf_token() }}');
                        url='{{ route("exDaftarBaru") }}';
                        $.ajax({
                            type        : 'ajax',
                            url         : url,
                            method      : 'post',
                            data        : formdata,
                            cache       : false,
                            contentType : false,
                            processData : false,
                            dataType    : 'json',
                            success: function(response, status, xhr) {
                                $('#status').html(response.status);
                                $('#pesan').html(response.message);
                                $('#divisian').hide();
                                $('#divterimakasih').show();
                                $('#divlogo').show();
                                $('#loading').hide();
                                $('#divawal').show();
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                $('#loading').hide();
                                $('#divlogo').show();
                                $('#divawal').show();
                                swal({
                                    title: textStatus,
                                    text:  jqXHR.responseText,
                                    type: 'info',
                                });
                            }
                        });
                    }
                });
                $('#btnkirimemail').click(function () {
                    var set01=document.getElementById('lupa_email').value;
                    if (set01 == ''){
                        swal({
                            title: 'Mohon lengkapi',
                            text: 'Email Aktif Wajib di Isi',
                            type: 'info',
                        });
                    } else {
                        $('#loading').show();
                        $('#divawal').hide();
                        $('#divlogo').hide();
                        
                        var formdata = new FormData();
                            formdata.set('val01',set01);
                            formdata.set('val02','resetpassword');
                            formdata.set('val03','');
                            formdata.set('val04','');
                            formdata.set('_token','{{ csrf_token() }}');
                        url='{{ route("exResetPassword") }}';
                        $.ajax({
                            type        : 'ajax',
                            url         : url,
                            method      : 'post',
                            data        : formdata,
                            cache       : false,
                            contentType : false,
                            processData : false,
                            dataType    : 'json',
                            success: function(response, status, xhr) {
                                $('#loading').hide();
                                $('#divlogo').show();
                                $('#divawal').show();
                                swal({
                                    title: response.status,
                                    text:  'Welcome '+response.message,
                                    type: 'info',
                                });
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                $('#loading').hide();
                                $('#divlogo').show();
                                $('#divawal').show();
                                swal({
                                    title: textStatus,
                                    text:  jqXHR.responseText,
                                    type: 'info',
                                });
                            }
                        });
                    }
                });
                $('#btnlogin').click(function () {
                    var set01=document.getElementById('email').value;
                    var set02=document.getElementById('password').value;
                    var set03=document.getElementById('remember').value;
                    var set04=document.getElementById('id_fakultas').value;
                    var set05=document.getElementById('id_firebase').value;
                    if (set01 == ''){
                        swal({
                            title: 'Mohon lengkapi',
                            text: 'Email Aktif Wajib di Isi',
                            type: 'info',
                        });
                    } else if (set02 == ''){
                        swal({
                            title: 'Mohon lengkapi',
                            text: 'Password Wajib di Isi',
                            type: 'info',
                        });
                    } else {
                        $('#loading').show();
                        $('#divlogo').hide();
                        $('#formisitelemedi').hide();
                        var formdata = new FormData();
                            formdata.set('email',set01);
                            formdata.set('password',set02);
                            formdata.set('remember',set03);
                            formdata.set('fakultas',set04);
                            formdata.set('firebase',set05);
                            formdata.set('_token','{{ csrf_token() }}');
                        url='{{ route("exLogin") }}';
                        $.ajax({
                            type        : 'ajax',
                            url         : url,
                            method      : 'post',
                            data        : formdata,
                            cache       : false,
                            contentType : false,
                            processData : false,
                            dataType    : 'json',
                            success: function(response, status, xhr) {
                                $('#loading').hide();
                                $('#divlogo').show();
                                $('#formisitelemedi').show();
                                swal({
                                    title: 'Success',
                                    text:  'Welcome '+response.user.nama,
                                    type: 'info',
                                });
                                location.reload();
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                $('#loading').hide();
                                $('#divlogo').show();
                                $('#formisitelemedi').show();
                                swal({
                                    title: textStatus,
                                    text:  'Cek User dan Password Anda',
                                    type: 'info',
                                });
                            }
                        });
                    }
                });
            });
		</script>
    </body>
</html>