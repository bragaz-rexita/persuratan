@extends('adminlte3.layoutstandart')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
        </div>
      </div>
    </div>
    <div class="content" >
        <div class="container-fluid">
            <div class="row" >
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#depan" data-toggle="tab">Latest News</a></li>
                                <li class="nav-item"><a class="nav-link" href="#formonline" data-toggle="tab">Pendaftaran</a></li>
                                <li class="nav-item"><a class="nav-link" href="#telemedicine" data-toggle="tab">Login</a></li>
                                <li class="nav-item"><a class="nav-link" href="#aboutme" data-toggle="tab">Contact Us</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div id="loading">
								<img src="{{ asset('dist/img/loading.gif') }}" class="img-responsive" alt="Photo">
							</div>
                            <div class="tab-content" id="divawal">
                                <div class="active tab-pane" id="depan">
                                    <div class="row">
                                    <div class="col-md-12">
                                        <div class="timeline">
                                            @foreach($pengumumans as $pengumuman)
                                                <div class="time-label">
                                                    <span class="bg-{{ $pengumuman['urutanwerno'] }}"> {!! $pengumuman['tanggal'] !!}</span>
                                                </div>
                                                <div>
                                                    <i class="{{ $pengumuman['jenis'] }} bg-{{ $pengumuman['urutanwerno'] }}"></i>
                                                    <div class="timeline-item">
                                                        <span class="time"><i class="fa fa-clock"></i> {{ $pengumuman['kapan'] }}</span>
                                                        <h3 class="timeline-header">{!! $pengumuman['siapa'] !!}</h3>
                                                        <div class="timeline-body">
                                                            {!! $pengumuman['pengumuman'] !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div>
                                                <i class="fa fa-clock-o bg-gray"></i>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="formonline">
                                    <div class="form-horizontal" id="divisian">
                                        <p class="login-box-msg">
                                            <b><font color="blue" size="+2"> Lengkapi formulir berikut untuk mendaftar</font></b>
                                        </p>
                                        <div class="form-group row">
                                            <label for="id_nama" class="col-sm-4 col-form-label">Nama <span class="text-danger">*</span>:</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="id_nama" name="id_nama">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="id_ktp" class="col-sm-4 col-form-label">No.Urut / NIM / Student ID / Employee ID<span class="text-danger">*</span>:</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="id_ktp" name="id_ktp">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="id_universitas" class="col-sm-4 col-form-label">Instansi Asal <span class="text-danger">*</span>:</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="id_universitas"  id="id_universitas" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="id_email" class="col-sm-4 col-form-label">Email <span class="text-danger">*</span>:</label>
                                            <div class="col-sm-8">
                                                <input type="email" name="id_email"  id="id_email" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="id_hape" class="col-sm-4 col-form-label">No Telp / HP (WA) <span class="text-danger">*</span>:</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="id_hape"  id="id_hape" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="social-auth-links text-center">
                                            <input type="hidden" id="id_idne" value="new">
                                            <input type="hidden" id="id_fakultas" value="{!!$subdomainapps01!!}">
                                            <input type="hidden" id="id_fakpanjang" value="{!!$subsubdomainapps01!!}">
                                            <a id="btnsimpan" href="#" class="btn btn-social btn-primary pull-right">
                                                <i class="fa fa-unlock-alt"></i> Daftarkan
                                            </a>
                                        </div>
                                    </div>
                                    <div class="form-horizontal" id="divterimakasih">
                                        <div class="card card-danger">
                                            <div class="card-header">
                                                <h3 class="card-title" id="status">Terkini</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" id="btncloseterimakasi">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                            <span id="pesan"><font color="blue">Silahkan Melanjutkan ke Email Anda Untuk Aktivasi</font></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="telemedicine">
                                    <form class="form-horizontal" id="formisitelemedi" action="{{ url('authenticate') }}" method="POST">
                                        {{ csrf_field() }}
			                            <div class="form-group row">
                                            <label for="login_email" class="col-sm-4 col-form-label">Email <span class="text-danger">*</span>:</label>
                                            <div class="col-sm-8">
                                                <input type="email" name="email" id="login_email" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="login_password"  class="col-md-4 col-lg-4 col-form-label">Password <span class="text-danger">*</span>:</label>
                                            <div class="col-lg-8 col-md-8">
                                                <input type="password" name="password" id="login_password" class="form-control" onkeyup="submitForm(event)" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <a id="btnlupapassword" href="#" class="btn btn-social btn-danger pull-left">
                                                <i class="fa fa-refresh"></i> I Forgot My Password
                                            </a>
                                            <a id="btnlogin" href="#" class="btn btn-social btn-primary pull-right">
                                                <i class="fa fa-unlock-alt"></i> Sign In
                                            </a>
                                        </div>
                                    </form>
                                    <div class="form-horizontal" id="divlupapassword">
                                        <div class="card card-danger">
                                            <div class="card-header">
                                                <h3 class="card-title">Tuliskan Email Yang Telah di Daftarkan</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <label for="lupa_email" class="col-sm-4 col-form-label">Email <span class="text-danger">*</span>:</label>
                                                    <div class="col-sm-8">
                                                        <input type="email" name="lupa_email" id="lupa_email" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a id="btnkelogin" href="#" class="btn btn-social btn-danger pull-left">
                                                    <i class="fa fa-refresh"></i> Kembali ke laman login
                                                </a>
                                                <a id="btnkirimemail" href="#" class="btn btn-social btn-primary pull-right">
                                                    <i class="fa fa-unlock-alt"></i> Kirim Password ke Email
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="aboutme">
                                    <div class="card card-widget widget-user-2">
                                        <div class="widget-user-header bg-primary">
                                            <div class="widget-user-image">
                                                <img class="img-circle elevation-2" src="mascot.png" alt="User Avatar">
                                            </div>
                                            <h3 class="widget-user-username">Profil</h3>
                                            <h5 class="widget-user-desc">{{ $subsubdomainapps01 }}</h5>
                                        </div>
                                    </div>
                                    <div class="card card-primary shadow">
                                        <div class="card-body">
                                            <strong><i class="fa fa-map-marker mr-1"></i> Alamat</strong>
                                            <p class="text-muted">{!! $addressapps01 !!}</p>
                                            <hr>
                                            <strong><i class="fa fa-file mr-1"></i> Notes</strong>
                                            <p class="text-muted">{!! $emailapps01 !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-primary card-outline" >
                        <div class="card-body box-profile bg-primary">
                            <div class="text-center">
                                <img src="{!! $logofrontapps01 !!}" alt="User profile picture" width="100%">
                            </div>
                        </div>
                        <div class="card-body">
                            <strong><i class="fa fa-book mr-1"></i> Website</strong>
                            <p class="text-muted"><a href="{!! $host !!}" target="_blank">{!! $host !!}</a></p>
                            <hr>
                            <strong><i class="fa fa-phone mr-1"></i> Alamat</strong>
                            <p class="text-muted"> {!! $addressapps01 !!}</p>
                            <hr>
                            <strong><i class="fa fa-envelope mr-1"></i> Email</strong>
                            <p class="text-muted">{!! $emailapps01 !!}</p>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
    <input type="text" name="id_fakultasasal"  id="id_fakultasasal" class="form-control" value="-"/>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@push('script')
<script type="text/javascript">
    $(function () {
        $('.select2').select2({width: '100%'});
        
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
        $('#divterimakasih').hide();
        $('.rujukan').hide();
        $('#btncloseterimakasi').click(function () {
            $('#divisian').show();
            $('#divterimakasih').hide();
        });
        $('#btnkelogin').click(function () {
            $('#formisitelemedi').show();
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
            var set07=document.getElementById('id_universitas').value;
            var set08=document.getElementById('id_fakultasasal').value;
            var token=document.getElementById('token').value;
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
            } else if (set07 == ''){ 
                swal({
                    title: 'Mohon lengkapi',
                    text: 'Universitas / Instansi Asal Wajib di Isi',
                    type: 'info',
                });
            } else if (set08 == ''){ 
                swal({
                    title: 'Mohon lengkapi',
                    text: 'Fakultas / Unit Kerja Wajib di Isi',
                    type: 'info',
                });
            } else {
                $('#loading').show();
                $('#divawal').hide();
                var formdata = new FormData();
                    formdata.set('val01',set01);
				    formdata.set('val02',set02);
				    formdata.set('val03',set03);
				    formdata.set('val04',set04);
					formdata.set('val05',set05);
					formdata.set('val06',set06);
					formdata.set('val07',set07);
					formdata.set('val08',set07);
					formdata.set('_token',token);
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
                        var pesan = response.message;
                        if (pesan == null || pesan == ''){
                            $('#pesan').html('Silahkan Melanjutkan ke Email Anda Untuk Aktivasi');
                        } else {
                            $('#pesan').html(response.message);
                        }
                        $('#status').html(response.status);
                        $('#divisian').hide();
                        $('#divterimakasih').show();
                        $('#loading').hide();
                        $('#divawal').show();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#loading').hide();
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
            var token=document.getElementById('token').value;
            if (set01 == ''){
                swal({
                    title: 'Mohon lengkapi',
                    text: 'Email Aktif Wajib di Isi',
                    type: 'info',
                });
            } else {
                $('#loading').show();
                $('#divawal').hide();
                
                var formdata = new FormData();
                    formdata.set('val01',set01);
				    formdata.set('val02','resetpassword');
				    formdata.set('val03','');
				    formdata.set('val04','');
					formdata.set('_token',token);
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
                        $('#divawal').show();
                        swal({
                            title: 'Info',
                            text:  response.message,
                            type: 'info',
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#loading').hide();
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
            var set01=document.getElementById('login_email').value;
            var set02=document.getElementById('login_password').value;
            var set04=document.getElementById('id_fakultas').value;
            var token=document.getElementById('token').value;
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
                $('#divawal').hide();
                var formdata = new FormData();
                    formdata.set('email',set01);
				    formdata.set('password',set02);
					formdata.set('remember',null);
                    formdata.set('fakultas',set04);
                    formdata.set('_token',token);
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
                        $('#divawal').show();
                        swal({
                            title: 'Success',
                            text:  'Welcome '+response.user.nama,
                            type: 'info',
                        });
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#loading').hide();
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
        
    });
</script>
@endpush