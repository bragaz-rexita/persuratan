<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<title>{!! config('global.Title') !!}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta content="Smart and Collaborative UB" name="description" />
        <meta content="Universitas Brawijaya" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2, user-scalable=yes">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('logo-ub.png') }}">
		
        <!-- App css -->
 @include('adminlte3.css')        

    </head>
	<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">      
		<header class="main-header">
			<nav class="navbar navbar-static-top">
			  <div class="container">
				<div class="navbar-header">
				  <a href="index.php" class="navbar-brand">Scan Surat Preview</a>
				</div>
				<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
				  <ul class="nav navbar-nav">
				 </ul>
				</div>
				<!-- /.navbar-custom-menu -->
			  </div>
			  <!-- /.container-fluid -->
			</nav>
		</header>
		<div class="content-wrapper">
			<section class="content">
				<div class="row" style="overflow-y: auto; height:600px;">
					<div class="col-md-12">
					{!! $filespdf !!}
					</div>
				</div>
			</section>
		</div>
       <footer class="main-footer">
			<div class="pull-right hidden-xs">
			  <b>{!! config('global.swandhananama') !!}</b>
			</div>
			<strong>Copyright &copy; 2019 <a href="http://ub.ac.id">Universitas Brawijaya</a>.</strong> All rights reserved.
		</footer>
    </div><!-- ./wrapper -->
  </body>
</html>