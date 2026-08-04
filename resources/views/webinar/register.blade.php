@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Registration Form</h1>
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
				<div class="col-md-6">
                    <div id="status">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="fa fa-calendar-check-o "></i></span>
                            <div class="info-box-content">
                            <span class="info-box-text">Registration Approved</span>
                            <span class="info-box-number">Please Cek Your Email For Detail</span>
                            </div>
                        </div>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url('/') }}/register/{{$revent->id}}"  class="btn btn-block btn-social btn-primary">
                            <i class="fa fa-facebook"></i><span class="pull-right">Share to Facebook</span>
                        </a>
                    </div>
                    <div id="divloading">
                        <img src="{{asset('dist/img/mrin/loading.gif')}}" width="100%"/>
                    </div>
                    <div id="pendaftaran">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>Register</h3>
                                <p>&nbsp;</p>
                            </div>
                            <div class="icon">
                            <i class="fa fa-mouse-pointer"></i>
                            </div>
                        </div>
						<div class="card card-primary shadow">
							<div class="card-header">
								<h3 class="card-title"></h3>
								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse">
										<i class="fa fa-minus"></i>
									</button>
								</div>
							</div>
							<div class="card-body">
								<div class="form-group">
									<label for="id_nama">Full Name (Include Your Title) will be written in the certificate</label> <span class="pull-right"><font color="red"> * </font></span>
									<input type="text" id="id_nama" name="id_nama" class="form-control">
								</div>
								<div class="form-group">
									<label for="id_instansi">Institution/company</label>
									<input type="text" id="id_instansi" name="id_instansi" class="form-control">
								</div>
								<div class="form-group">
									<label for="id_pekerjaan">Position</label>
									<select class="form-control" name="id_pekerjaan" id="id_pekerjaan">
										<option value="Students"> Students </option>
										<option value="Lecturer"> Lecturer </option>
										<option value="Clinical practice"> Clinical practice </option>
										<option value="Ethics Committee member "> Ethics Committee member  </option>
										<option value="other"> other </option>
									</select>
								</div>									
								<div class="form-group">
									<label for="id_alamat">Full Address </label><span class="pull-right"><font color="red"> * </font></span>
									<input type="text" id="id_alamat" name="id_alamat" class="form-control">
								</div>
								<div class="form-group">
									<label for="id_negara">Country</label>
									<select class="form-control" name="id_negara" id="id_negara">
										<option value="Indonesia"> Indonesia </option>
										<option value="United States"> United States </option>
										<option value="Afghanistan"> Afghanistan </option>
										<option value="Albania"> Albania </option>
										<option value="Algeria"> Algeria </option>
										<option value="American Samoa"> American Samoa </option>
										<option value="Andorra"> Andorra </option>
										<option value="Angola"> Angola </option>
										<option value="Anguilla"> Anguilla </option>
										<option value="Antigua and Barbuda"> Antigua and Barbuda </option>
										<option value="Argentina"> Argentina </option>
										<option value="Armenia"> Armenia </option>
										<option value="Aruba"> Aruba </option>
										<option value="Australia"> Australia </option>
										<option value="Austria"> Austria </option>
										<option value="Azerbaijan"> Azerbaijan </option>
										<option value="The Bahamas"> The Bahamas </option>
										<option value="Bahrain"> Bahrain </option>
										<option value="Bangladesh"> Bangladesh </option>
										<option value="Barbados"> Barbados </option>
										<option value="Belarus"> Belarus </option>
										<option value="Belgium"> Belgium </option>
										<option value="Belize"> Belize </option>
										<option value="Benin"> Benin </option>
										<option value="Bermuda"> Bermuda </option>
										<option value="Bhutan"> Bhutan </option>
										<option value="Bolivia"> Bolivia </option>
										<option value="Bosnia and Herzegovina"> Bosnia and Herzegovina </option>
										<option value="Botswana"> Botswana </option>
										<option value="Brazil"> Brazil </option>
										<option value="Brunei"> Brunei </option>
										<option value="Bulgaria"> Bulgaria </option>
										<option value="Burkina Faso"> Burkina Faso </option>
										<option value="Burundi"> Burundi </option>
										<option value="Cambodia"> Cambodia </option>
										<option value="Cameroon"> Cameroon </option>
										<option value="Canada"> Canada </option>
										<option value="Cape Verde"> Cape Verde </option>
										<option value="Cayman Islands"> Cayman Islands </option>
										<option value="Central African Republic"> Central African Republic </option>
										<option value="Chad"> Chad </option>
										<option value="Chile"> Chile </option>
										<option value="China"> China </option>
										<option value="Christmas Island"> Christmas Island </option>
										<option value="Cocos (Keeling) Islands"> Cocos (Keeling) Islands </option>
										<option value="Colombia"> Colombia </option>
										<option value="Comoros"> Comoros </option>
										<option value="Congo"> Congo </option>
										<option value="Cook Islands"> Cook Islands </option>
										<option value="Costa Rica"> Costa Rica </option>
										<option value="Cote d&#x27;Ivoire"> Cote d&#x27;Ivoire </option>
										<option value="Croatia"> Croatia </option>
										<option value="Cuba"> Cuba </option>
										<option value="Curacao"> Curacao </option>
										<option value="Cyprus"> Cyprus </option>
										<option value="Czech Republic"> Czech Republic </option>
										<option value="Democratic Republic of the Congo"> Democratic Republic of the Congo </option>
										<option value="Denmark"> Denmark </option>
										<option value="Djibouti"> Djibouti </option>
										<option value="Dominica"> Dominica </option>
										<option value="Dominican Republic"> Dominican Republic </option>
										<option value="Ecuador"> Ecuador </option>
										<option value="Egypt"> Egypt </option>
										<option value="El Salvador"> El Salvador </option>
										<option value="Equatorial Guinea"> Equatorial Guinea </option>
										<option value="Eritrea"> Eritrea </option>
										<option value="Estonia"> Estonia </option>
										<option value="Ethiopia"> Ethiopia </option>
										<option value="Falkland Islands"> Falkland Islands </option>
										<option value="Faroe Islands"> Faroe Islands </option>
										<option value="Fiji"> Fiji </option>
										<option value="Finland"> Finland </option>
										<option value="France"> France </option>
										<option value="French Polynesia"> French Polynesia </option>
										<option value="Gabon"> Gabon </option>
										<option value="The Gambia"> The Gambia </option>
										<option value="Georgia"> Georgia </option>
										<option value="Germany"> Germany </option>
										<option value="Ghana"> Ghana </option>
										<option value="Gibraltar"> Gibraltar </option>
										<option value="Greece"> Greece </option>
										<option value="Greenland"> Greenland </option>
										<option value="Grenada"> Grenada </option>
										<option value="Guadeloupe"> Guadeloupe </option>
										<option value="Guam"> Guam </option>
										<option value="Guatemala"> Guatemala </option>
										<option value="Guernsey"> Guernsey </option>
										<option value="Guinea"> Guinea </option>
										<option value="Guinea-Bissau"> Guinea-Bissau </option>
										<option value="Guyana"> Guyana </option>
										<option value="Haiti"> Haiti </option>
										<option value="Honduras"> Honduras </option>
										<option value="Hong Kong"> Hong Kong </option>
										<option value="Hungary"> Hungary </option>
										<option value="Iceland"> Iceland </option>
										<option value="India"> India </option>
										<option value="Iran"> Iran </option>
										<option value="Iraq"> Iraq </option>
										<option value="Ireland"> Ireland </option>
										<option value="Israel"> Israel </option>
										<option value="Italy"> Italy </option>
										<option value="Jamaica"> Jamaica </option>
										<option value="Japan"> Japan </option>
										<option value="Jersey"> Jersey </option>
										<option value="Jordan"> Jordan </option>
										<option value="Kazakhstan"> Kazakhstan </option>
										<option value="Kenya"> Kenya </option>
										<option value="Kiribati"> Kiribati </option>
										<option value="North Korea"> North Korea </option>
										<option value="South Korea"> South Korea </option>
										<option value="Kosovo"> Kosovo </option>
										<option value="Kuwait"> Kuwait </option>
										<option value="Kyrgyzstan"> Kyrgyzstan </option>
										<option value="Laos"> Laos </option>
										<option value="Latvia"> Latvia </option>
										<option value="Lebanon"> Lebanon </option>
										<option value="Lesotho"> Lesotho </option>
										<option value="Liberia"> Liberia </option>
										<option value="Libya"> Libya </option>
										<option value="Liechtenstein"> Liechtenstein </option>
										<option value="Lithuania"> Lithuania </option>
										<option value="Luxembourg"> Luxembourg </option>
										<option value="Macau"> Macau </option>
										<option value="Macedonia"> Macedonia </option>
										<option value="Madagascar"> Madagascar </option>
										<option value="Malawi"> Malawi </option>
										<option value="Malaysia"> Malaysia </option>
										<option value="Maldives"> Maldives </option>
										<option value="Mali"> Mali </option>
										<option value="Malta"> Malta </option>
										<option value="Marshall Islands"> Marshall Islands </option>
										<option value="Martinique"> Martinique </option>
										<option value="Mauritania"> Mauritania </option>
										<option value="Mauritius"> Mauritius </option>
										<option value="Mayotte"> Mayotte </option>
										<option value="Mexico"> Mexico </option>
										<option value="Micronesia"> Micronesia </option>
										<option value="Moldova"> Moldova </option>
										<option value="Monaco"> Monaco </option>
										<option value="Mongolia"> Mongolia </option>
										<option value="Montenegro"> Montenegro </option>
										<option value="Montserrat"> Montserrat </option>
										<option value="Morocco"> Morocco </option>
										<option value="Mozambique"> Mozambique </option>
										<option value="Myanmar"> Myanmar </option>
										<option value="Nagorno-Karabakh"> Nagorno-Karabakh </option>
										<option value="Namibia"> Namibia </option>
										<option value="Nauru"> Nauru </option>
										<option value="Nepal"> Nepal </option>
										<option value="Netherlands"> Netherlands </option>
										<option value="Netherlands Antilles"> Netherlands Antilles </option>
										<option value="New Caledonia"> New Caledonia </option>
										<option value="New Zealand"> New Zealand </option>
										<option value="Nicaragua"> Nicaragua </option>
										<option value="Niger"> Niger </option>
										<option value="Nigeria"> Nigeria </option>
										<option value="Niue"> Niue </option>
										<option value="Norfolk Island"> Norfolk Island </option>
										<option value="Turkish Republic of Northern Cyprus"> Turkish Republic of Northern Cyprus </option>
										<option value="Northern Mariana"> Northern Mariana </option>
										<option value="Norway"> Norway </option>
										<option value="Oman"> Oman </option>
										<option value="Pakistan"> Pakistan </option>
										<option value="Palau"> Palau </option>
										<option value="Palestine"> Palestine </option>
										<option value="Panama"> Panama </option>
										<option value="Papua New Guinea"> Papua New Guinea </option>
										<option value="Paraguay"> Paraguay </option>
										<option value="Peru"> Peru </option>
										<option value="Philippines"> Philippines </option>
										<option value="Pitcairn Islands"> Pitcairn Islands </option>
										<option value="Poland"> Poland </option>
										<option value="Portugal"> Portugal </option>
										<option value="Puerto Rico"> Puerto Rico </option>
										<option value="Qatar"> Qatar </option>
										<option value="Republic of the Congo"> Republic of the Congo </option>
										<option value="Romania"> Romania </option>
										<option value="Russia"> Russia </option>
										<option value="Rwanda"> Rwanda </option>
										<option value="Saint Barthelemy"> Saint Barthelemy </option>
										<option value="Saint Helena"> Saint Helena </option>
										<option value="Saint Kitts and Nevis"> Saint Kitts and Nevis </option>
										<option value="Saint Lucia"> Saint Lucia </option>
										<option value="Saint Martin"> Saint Martin </option>
										<option value="Saint Pierre and Miquelon"> Saint Pierre and Miquelon </option>
										<option value="Saint Vincent and the Grenadines"> Saint Vincent and the Grenadines </option>
										<option value="Samoa"> Samoa </option>
										<option value="San Marino"> San Marino </option>
										<option value="Sao Tome and Principe"> Sao Tome and Principe </option>
										<option value="Saudi Arabia"> Saudi Arabia </option>
										<option value="Senegal"> Senegal </option>
										<option value="Serbia"> Serbia </option>
										<option value="Seychelles"> Seychelles </option>
										<option value="Sierra Leone"> Sierra Leone </option>
										<option value="Singapore"> Singapore </option>
										<option value="Slovakia"> Slovakia </option>
										<option value="Slovenia"> Slovenia </option>
										<option value="Solomon Islands"> Solomon Islands </option>
										<option value="Somalia"> Somalia </option>
										<option value="Somaliland"> Somaliland </option>
										<option value="South Africa"> South Africa </option>
										<option value="South Ossetia"> South Ossetia </option>
										<option value="South Sudan"> South Sudan </option>
										<option value="Spain"> Spain </option>
										<option value="Sri Lanka"> Sri Lanka </option>
										<option value="Sudan"> Sudan </option>
										<option value="Suriname"> Suriname </option>
										<option value="Svalbard"> Svalbard </option>
										<option value="eSwatini"> eSwatini </option>
										<option value="Sweden"> Sweden </option>
										<option value="Switzerland"> Switzerland </option>
										<option value="Syria"> Syria </option>
										<option value="Taiwan"> Taiwan </option>
										<option value="Tajikistan"> Tajikistan </option>
										<option value="Tanzania"> Tanzania </option>
										<option value="Thailand"> Thailand </option>
										<option value="Timor-Leste"> Timor-Leste </option>
										<option value="Togo"> Togo </option>
										<option value="Tokelau"> Tokelau </option>
										<option value="Tonga"> Tonga </option>
										<option value="Transnistria Pridnestrovie"> Transnistria Pridnestrovie </option>
										<option value="Trinidad and Tobago"> Trinidad and Tobago </option>
										<option value="Tristan da Cunha"> Tristan da Cunha </option>
										<option value="Tunisia"> Tunisia </option>
										<option value="Turkey"> Turkey </option>
										<option value="Turkmenistan"> Turkmenistan </option>
										<option value="Turks and Caicos Islands"> Turks and Caicos Islands </option>
										<option value="Tuvalu"> Tuvalu </option>
										<option value="Uganda"> Uganda </option>
										<option value="Ukraine"> Ukraine </option>
										<option value="United Arab Emirates"> United Arab Emirates </option>
										<option value="United Kingdom"> United Kingdom </option>
										<option value="Uruguay"> Uruguay </option>
										<option value="Uzbekistan"> Uzbekistan </option>
										<option value="Vanuatu"> Vanuatu </option>
										<option value="Vatican City"> Vatican City </option>
										<option value="Venezuela"> Venezuela </option>
										<option value="Vietnam"> Vietnam </option>
										<option value="British Virgin Islands"> British Virgin Islands </option>
										<option value="Isle of Man"> Isle of Man </option>
										<option value="US Virgin Islands"> US Virgin Islands </option>
										<option value="Wallis and Futuna"> Wallis and Futuna </option>
										<option value="Western Sahara"> Western Sahara </option>
										<option value="Yemen"> Yemen </option>
										<option value="Zambia"> Zambia </option>
										<option value="Zimbabwe"> Zimbabwe </option>
										<option value="other"> Other </option>
									</select>
								</div>
								<div class="form-group">
									<label for="id_email">Email </label><span class="pull-right"><font color="red"> * </font></span>
									<input type="text" id="id_email" name="id_email" class="form-control">
								</div>
								<div class="form-group">
									<label for="id_hape">Handphone </label><span class="pull-right"><font color="red"> * </font></span>
									<input type="text" id="id_hape" name="id_hape" class="form-control" placeholder="+62xxxx">
								</div>
								<div class="form-group m-b-0">
									<label for="upload_file">Pic. Profile (optional)</label>
									<input type="file" class="filestyle" data-placeholder="No file" data-btnClass="btn-light" id="upload_file" name="upload_file">
								</div>
								<div class="form-group">
									<img id="preview" src="{{asset('dist/img/boxed-bg.jpg')}}" width="100%"/>
								</div>
							</div>
							<div class="card-footer">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-6">
											<a href="{{ url('/') }}"  class="btn btn-block btn-social btn-danger">
												<i class="fa fa-arrow-left"></i><span class="pull-right">Back Home</span>
											</a>
										</div>
										<div class="col-lg-6">
											<a href="#" class="btn btn-block btn-social btn-warning" id="btnsimpan">
												<i class="fa fa-calendar-check-o"></i><span class="pull-right">Register</span>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-widget widget-user-2">
                        <div class="widget-user-header bg-success">
                            <div class="widget-user-image">
							@if (Session('avatar') != '')
							<img class="img-circle elevation-2" src="{!! Session('avatar') !!}" alt="User Avatar">
                            @else 
							<img class="img-circle elevation-2" src="{{ asset('mascot.png') }}" alt="User Avatar">
                            @endif
                            </div>
                            <h3 class="widget-user-username">{!! $revent->nama !!}</h3>
                            <h5 class="widget-user-desc">Event Schedule</h5>
                        </div>
                    </div>
                    <div class="card card-warning shadow">
						<div class="card-header">
							<h3 class="card-title"></h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse">
									<i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-tool" data-card-widget="remove">
									<i class="fa fa-times"></i>
								</button>
							</div>
						</div>
						<div class="card-body">
							<strong><i class="fa fa-map-marker mr-1"></i> Start</strong>
							<p class="text-muted">{!! $revent->mulai !!}</p>
							<hr>
							<strong><i class="fa fa-map-marker mr-1"></i> Until</strong>
							<p class="text-muted">{!! $revent->akhir !!}</p>
							<hr>
							<strong><i class="fa fa-map-marker mr-1"></i> Open Register </strong>
							<p class="text-muted">{!! $revent->daftarmulai !!}</p>
							<hr>
							<strong><i class="fa fa-map-marker mr-1"></i> Close Register </strong>
							<p class="text-muted">{!! $revent->daftarakhir !!}</p>
							<hr>
							@if ($revent->bayar == 0)
								<strong><i class="fa fa-map-marker mr-1"></i> It's Free Tickets</strong>
							@else 
							<strong><i class="fa fa-map-marker mr-1"></i> IDR {!! $revent->bayar !!}</strong>
								<li><a href="#">Fee : <span class="pull-right badge bg-yellow">IDR {!! $revent->bayar !!}</span></a></li>
							@endif
						</div>
						<div class="card-footer">
							<div class="form-group">
								{!! $revent->pembicara !!}
							</div>
							<div class="form-group">
								<p><strong>Contact Person</strong></p>
								{!! $revent->kontak !!}
							</div>		 
							<div class="form-group">
								<div class="row">
									<div class="col-lg-4">
										{!! $qrcode !!}
									</div>
									<div class="col-lg-8">
										<img id="preview" src="{{asset('dist/img/mrin/science.jpg')}}" width="100%"/>
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
<input type="hidden" name="midne" id="midne" value=" {{$revent->id}}">
@endsection
@push('script')
	<script>
		$('#upload_file').change(function () {
			if(this.files[0].size > 100000000){
				alert("File is too big!");
				this.value = "";
			} else {
				var imgPath = this.value;
				var ukfile 	= this.files[0].size;
				var ext 	= imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
				if(ext == "jpg" || ext == "jpeg" || ext == "png") {
					$('#preview').show();
					readURL(this);
				} else {
					$('#preview').hide();
					swal({
						title: 'Stop',
						text: 'Pic. Profile Only Use JPG / PNG File Format',
						type: 'warning',
					})
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
		$(document).ready(function() {
			$('#status').hide();
			$('#preview').hide();
			$('#divloading').hide();
			$("#btnsimpan").click(function(){
				$('#divloading').show();
				$('#pendaftaran').hide();
				var val01=document.getElementById('id_nama').value;
				var val02=document.getElementById('id_pekerjaan').value;
				var val03=document.getElementById('id_alamat').value;
				var val04=document.getElementById('id_negara').value;
				var val05=document.getElementById('id_instansi').value;
				var val06=document.getElementById('id_email').value;
				var val07=document.getElementById('midne').value;
				var val08=document.getElementById('upload_file');
				var val09=document.getElementById('id_hape').value;
				var token=document.getElementById('token').value;
				if (val01 == ''){
					swal({
						title: 'Stop',
						text: 'Name Cannot Empty',
						type: 'warning',
					})
				} else if (val06 == ''){
					swal({
						title: 'Stop',
						text: 'Email Cannot Empty',
						type: 'warning',
					})
				} else {
					var form_data = new FormData();
						form_data.append('file', val08.files[0]);
						form_data.append('set01', val01);
						form_data.append('set02', val02);
						form_data.append('set03', val03);
						form_data.append('set04', val04);
						form_data.append('set05', val05);
						form_data.append('set06', val06);
						form_data.append('set07', val07);
						form_data.append('set08', val09);
						form_data.append('_token', token);
					$.ajax({
						url: '{{route("exRegisterevent")}}',
						data: form_data,
						type: 'POST',
						contentType: false,
						processData: false,
						success: function (data) {
							$('#divloading').hide();
							var status  = data.status;
							var message = data.message;
							var warna 	= data.warna;
							var icon 	= data.icon;
							$('#status').show();
							$('#pendaftaran').hide();
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
							var pesan = xhr.responseText;
							swal({
								title: 'Stop',
								text: pesan,
								type: 'warning',
							})
						}
					});
				}
			});
		});
	</script>
@endpush