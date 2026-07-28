<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>{!! config('global.Title') !!} | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="icon" type="image/ico" href="{{ asset('favicon.ico') }}">
		<link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
		<link href="{{ asset('dist/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('plugins/iCheck/all.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('plugins/iCheck/square/blue.css') }}" rel="stylesheet" type="text/css" />
    </head>
    <body class="login-page" style="background-image: url('{{asset('dist/img/boxed-bg.jpg')}}'); background-repeat: no-repeat; background-position: center;">
		<div class="login-box">
		  <div class="login-logo">
			<img src="{{ url('').'/'.$frontpage }}" alt="IMG" width="100%"><br />
		  </div><!-- /.login-logo -->
		  <div class="login-box-body">
			<p class="login-box-msg">
			@if(Session::has('message'))
				<font color="red">{{ Session('message') }}</font>
			@else
				<marquee direction="left" scrollamount="3" align="center"><font color="white">Selamat Datang di {{ $kode_sekolah }}, Silahkan Login Untuk Melanjutkan</font></marquee>
			@endif
			</p>
			
			<form action="{{ url('authenticate') }}" method="POST">
                {{ csrf_field() }}
			  <div class="form-group has-feedback">
				<input class="form-control" type="text" name="username" id="username" placeholder="Enter your username">
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			  </div>
			  <div class="form-group has-feedback">
				<input type="password" name="password"  id="password" class="form-control" placeholder="Password"/>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			  </div>
			  <div class="form-group has-feedback">
				<input type="hidden" name="firebaseid"  class="form-control" value="{!! $firebaseid !!}"/>
				<input type="hidden" name="id_sekolah"  class="form-control" value="{{ $id_sekolah }}"/>
			  </div>
			  <div class="row">
				<div class="col-xs-2"> </div>
				<div class="col-xs-6">    
				  <div class="checkbox icheck">
					<label>
					  <input type="checkbox" name="rememberMe"><font color="white"> Remember Me</font>
					</label>
				  </div>                        
				</div><!-- /.col -->
				<div class="col-xs-4">
				  <input type="submit" name="submit" value="Login" class="btn btn-warning btn-block btn-flat"> 
				</div><!-- /.col -->
			  </div>
			</form>
		  </div><!-- /.login-box-body -->
		</div><!-- /.login-box -->
        <!-- Begin page -->
		<script src="{{ asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
		<!-- Bootstrap 3.3.2 JS -->
		<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
		<!-- iCheck -->
		<script src="{{ asset('plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
		<script>
		  $(function () {
			$('input').iCheck({
			  checkboxClass: 'icheckbox_square-blue',
			  radioClass: 'iradio_square-blue',
			  increaseArea: '20%' // optional
			});
		  });
		</script>
    </body>
</html>