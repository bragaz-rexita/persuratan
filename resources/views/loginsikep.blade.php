
<html lang="en">

	<!-- begin::Head -->
	<head>
		<base href="../../../">
		<meta charset="utf-8" />
		<title>SIKEP | FK-UB</title>
		<meta name="description" content="Login page example">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!--begin::Fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

		<!--end::Fonts -->

		<!--begin::Page Custom Styles(used by this page) -->
		{!!HTML::style('dist/assets/css/pages/login/login-1.css') !!}

		<!--end::Page Custom Styles -->

		<!--begin::Global Theme Styles(used by all pages) -->
		{!!HTML::style('dist/assets/plugins/global/plugins.bundle.css') !!}
		{!!HTML::style('dist/assets/css/style.bundle.css') !!}

		{!!HTML::script('dist/assets/plugins/jquery/jquery-1.12.1.js') !!}
		{!!HTML::script('dist/assets/plugins/custom/jquery-ui/jquery-ui.bundle.js') !!}
		{!!HTML::style('dist/assets/plugins/custom/jquery-ui/jquery-ui.bundle.css') !!}
		<!--end::Global Theme Styles -->

		<!--begin::Layout Skins(used by all pages) -->

		<!--end::Layout Skins -->
		<link rel="shortcut icon" href="<?php echo url('dist/assets/media/logos/logo-ub.png') ?>" />
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body style="background-image: url(<?php echo url('dist/assets/media/demos/demo4/header.jpg') ?>); background-position: center top; background-size: 100% 350px;" class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">

		<!-- begin::Page loader -->

		<!-- end::Page Loader -->

		<!-- begin:: Page -->
		<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
			<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1" id="kt_login">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">

					<!--begin::Aside-->
					<div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside" style="background-image: url(<?php echo url('dist/assets/media/bg/bg-2.jpg') ?>);">
						<div class="kt-grid__item">
							<a href="#" class="kt-login__logo">
								<img src="<?php echo url('dist/assets/media/logos/logo-ub.png') ?>" width="128px" height="128px">
							</a>
						</div>
						<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">
							<div class="kt-grid__item kt-grid__item--middle">
								<h3 class="kt-login__title">SIKEPK <span class="kt-font-success">FK-UB</span></h3>
								<h4 class="kt-login__subtitle">Sistem Informasi Komisi Etik Penelitian Kesehatan<br> Fakultas Kedokteran Universitas Brawijaya Malang</h4>
							</div>
						</div>
						<div class="kt-grid__item">
							<div class="kt-login__info">
								<div class="kt-login__copyright">
									&copy <script>document.write(new Date().getFullYear());</script> FKUB - Universitas Brawijaya Malang
								</div>
							</div>
						</div>
					</div>

					<!--begin::Aside-->

					<!--begin::Content-->
					<div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">

						<!--begin::Head-->
						<div class="kt-login__head">
							<span class="kt-login__signup-label">
								<img src="<?php echo url('dist/assets/media/logos/logo-sikep.png') ?>">
							</span>
						</div>

						<!--end::Head-->

						<!--begin::Body-->
						<div class="kt-login__body" style="margin-top: -30px">

							<!--begin::Signin-->
							<div class="kt-login__form">
								<div class="kt-login__title">
									 <h3>This Is Website is Moving</h3>
								</div>

								<!--begin::Form-->
								<form class="kt-form" action="" novalidate="novalidate" id="kt_login_form">
									{{ csrf_field() }}
			  						<div class="form-group">
										<input class="form-control" type="text" placeholder="Username / Email" name="username" id="username" autocomplete="off">
									</div>
									<div class="form-group">
										<input class="form-control" type="password" placeholder="Password" name="password" id="password" autocomplete="off">
									</div>

									<!--begin::Action-->
									<div class="kt-login__actions">
									<!--
										<a href="{{ route('landing') }}" class="btn btn-label-brand">
											Back To Landing Page
										</a>
										<button id="kt_login_signin_submit" class="btn btn-primary btn-elevate kt-login__btn-primary">Login</button>
									-->
										<a href="https://insitu.fk.ub.ac.id/situ" class="btn btn-label-brand">
											Back To Landing Page
										</a>
										<a href="https://insitu.fk.ub.ac.id/loginsikep" class="btn btn-label-brand">
											Login
										</a>
									</div>

									<!--end::Action-->
								</form>

								<!--end::Form-->

								<!--begin::Divider-->
								<div class="kt-login__divider">
									<div class="kt-divider">
										<span></span>
										<span></span>
										<span></span>
									</div>
								</div>

								<!--end::Divider-->

								<!--begin::Options-->
								<div class="kt-login__options">
									<a href="https://insitu.fk.ub.ac.id/forgotpass" class="btn btn-warning kt-btn">
										Forgot Password
									</a>
									<a href="https://insitu.fk.ub.ac.id/registersikep" class="btn btn-info kt-btn">
										Register
									</a>
									{{-- 
										<a href="{{route('forgotpass')}}" class="btn btn-warning kt-btn">
										<i class="fab fa-facebook-f"></i>
										Forgot Password
									</a>
									<a href="{{route('register')}}" class="btn btn-info kt-btn">
										<i class="fab fa-twitter"></i>
										Register
									</a>
									<a href="#" class="btn btn-success kt-btn">
										<i class="fab fa-google"></i>
										Activation
									</a> 
									--}}
								</div>

								<!--end::Options-->
							</div>

							<!--end::Signin-->
						</div>

						<!--end::Body-->
					</div>

					<!--end::Content-->
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#366cf3",
						"light": "#ffffff",
						"dark": "#282a3c",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
						"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
					}
				}
			};
		</script>

		<!-- end::Global Config -->




		<script type="text/javascript">
		    var KTLoginGeneral = function() {

				var login = $('#kt_login');

				var showErrorMsg = function(form, type, msg) {
					var alert = $('<div class="alert alert-' + type + ' alert-dismissible" role="alert">\
						<div class="alert-text">'+msg+'</div>\
						<div class="alert-close">\
							<i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i>\
						</div>\
					</div>');

					form.find('.alert').remove();
					alert.prependTo(form);
					//alert.animateClass('fadeIn animated');
					KTUtil.animateClass(alert[0], 'fadeIn animated');
					alert.find('span').html(msg);
				}

				

				var handleSignInFormSubmit = function() {
					$('#kt_login_signin_submit').click(function(e) {
						e.preventDefault();
						var btn = $(this);
						var form = $(this).closest('form');

						form.validate({
							rules: {
								username: {
									required: true
								},
								password: {
									required: true
								}
							}
						});

						if (!form.valid()) {
							return;
						}

						btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);

						// $.ajax({
						form.ajaxSubmit({
							url: "<?php echo URL::to('/login_app'); ?>",
							method      : 'post',
							dataType    : 'json',
							// headers: {
							// 	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							// },
							// data 		: { username: $('#username').val(), password: $('#password').val()},
							success: function(response, status, xhr, $form) {
								
								location.reload();

								btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
							},
							error: function(jqXHR, textStatus, errorThrown) {
								btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
								if (jqXHR.status == 404) {
									showErrorMsg(form, 'danger', jqXHR.responseJSON.message);
								}else if(jqXHR.status == 422){
									var response = JSON.parse(jqXHR.responseText);
									var errorString = '<ul>';
									$.each(response.errors, function(key, value) {
										errorString += '<li>' + value + '</li>';
									});
									errorString += '</ul>';
									showErrorMsg(form, 'danger', errorString);
								}else{
									showErrorMsg(form, 'danger', 'Error Proses');									
								}
							}
						});
					});
				}

				
				// Public Functions
				return {
					// public functions
					init: function() {
						handleSignInFormSubmit();
					}
				};
			}();

			// Class Initialization
			jQuery(document).ready(function() {
				KTLoginGeneral.init();
			});

		</script>

		<!--begin::Global Theme Bundle(used by all pages) -->
		{!!HTML::script('dist/assets/plugins/global/plugins.bundle.js') !!}
		{!!HTML::script('dist/assets/js/scripts.bundle.js') !!}

		<!--end::Global Theme Bundle -->
		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>