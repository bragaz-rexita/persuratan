@extends('adminlte3.layout')
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
                <div class="col-md-12">
                    <div class="card card-solid">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-5">
                                    @if (isset($jenis) AND $jenis == 'MASUK')
                                        <h3>Surat Masuk ID {{$idinbox}}</h3>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-10 col-md-9">
                                                    <label for="buka_kepada">Disposisi Kepada *</label>
                                                    <select id="buka_kepada" name="kepada[]" class="form-control select2" multiple="multiple" data-placeholder="Boleh pilih lebih dari satu" style="width: 100%;">
                                                        @if(isset($listpenerimadisposisi) AND !empty($listpenerimadisposisi))
                                                            @foreach($listpenerimadisposisi as $rpejabat)
                                                                <option value="{{ $rpejabat['kode'] }}">{{ $rpejabat['nama'] }}</option>
                                                            @endforeach
                                                        @else
                                                            <option value="Arsiparis Umum">Arsiparis Umum</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 col-md-3">
                                                    <label for="buka_sifatdiposisi">Sifat</label>
                                                    <select id="buka_sifatdiposisi" name="buka_sifatdiposisi" class="form-control" >
                                                        <option value="Biasa">Biasa</option>
                                                        <option value="Segera">Segera</option>
                                                        <option value="Sangat Segera">Sangat Segera</option>
                                                        <option value="Rahasia">Rahasia</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                @foreach($mcmdispo as $id => $name)
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="checkbox checkbox-success">
                                                            <label for="{{$name['id']}}">
                                                                {!! Form::checkbox("formDoor[]", $name['disposisi'], null, array('id'=>$name['id'])) !!}
                                                                {{$name['disposisi']}}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Disposisi Untuk {{$nama}} ( {{$email}} )</h5>
                                            <p>{!! $footnote !!}</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Catatan</label>
                                            <textarea id="buka_catatan" name="buka_catatan" rows="10" cols="80"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Lampiran</label>
                                            <input type="file" id="filelampiran" name="filelampiran" class="btn-light">
                                        </div>
                                        <div style="overflow: hidden; display: none;">
                                            <textarea id="id_footnote" rows="10" cols="80"></textarea>
                                        </div>
                                        @if ($status == 'send' OR $status == 'read')
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4">
                                                        <button type="button" class="btn btn-info" id="btnarsipkan">Arsipkan</button>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4">
                                                    </div>
                                                    <div class="col-lg-4 col-md-4">
                                                        <button type="button" class="btn btn-success" id="btnsimpancatatn">Simpan Catatan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        <h3>Surat Keluar ID {{$idinbox}}</h3>
                                        <div class="form-group">
                                            <h5>Yth. {{$nama}} ( {{$email}} )</h5>
                                            <p>Berikut Surat yang memerlukan Persetujuan, Click Tombol "Setujui dan dapat diproses lanjut" apabila surat ini disetujui untuk proses selanjutnya. Dan apabila surat ini memerlukan revisi / perbaikan mohon menuliskan catatan terkait apa yang perlu diperbaiki kemudian tekan tombol "Kembalikan ke Pengirim"</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-xs-12 bg-green">
                                                <div class="form-group">
                                                    <br />
                                                    <div class="lockscreen-item">
                                                        <div class="lockscreen-image">
                                                            <img src="{{ asset('dist/img/avatar.png') }}" alt="User Image">
                                                        </div>
                                                        <div class="input-group">
                                                            <div class="input-group-btn">
                                                                <button type="button" class="btn" id="btnshowpassword">Pasword <i class="fa fa-eye text-muted"></i></button>
                                                            </div>
                                                            <input type="password" class="form-control" placeholder="Passphare" id="id_password" name="id_password" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-xs-12" id="catatanawal">
                                                <b><font color=red>Mohon Memberikan Catatan Kaki, Bila Surat di Atas Salah / Perlu di Perbaiki</font></b>
                                                <select class="form-control" id="id_catatan" name="id_catatan">
                                                    <option value="">Pilih Salah Satu</option>
                                                    <option value="Mohon di Review Sekali Lagi Sebelum dokumen diedarkan, agar dokumen sudah tidak mengandung kesalahan substantif, dan tipografi, terimakasih.">Mohon di Review Sekali Lagi Sebelum dokumen diedarkan, agar dokumen sudah tidak mengandung kesalahan substantif, dan tipografi, terimakasih.</option>
                                                    <option value="Mohon dilengkapi lampirannya">Mohon di lengkapi lampirannya.</option>
                                                    <option value="Isi Catatan Sendiri">Lainnya (Isi Catatan Sendiri)</option>                               
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-xs-12" id="catatantulis">
                                                <b><font color=red>Mohon Memberikan Catatan Kaki, Bila Surat di Atas Salah / Perlu di Perbaiki</font></b>
                                                <textarea id="id_footnote" rows="10" cols="80"></textarea>
                                            </div>
                                        </div>
                                        @if ($status == 'send' OR $status == 'read')
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4">
                                                    <button type="button" class="btn btn-danger" id="btnbatal">Kembalikan ke Pengirim</button>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4">
                                                    </div>
                                                    <div class="col-lg-4 col-md-4">
                                                    <button type="button" class="btn btn-primary" id="save">Setujui dan dapat diproses lanjut</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div style="overflow: hidden; display: none;">
                                            <textarea id="buka_catatan" name="buka_catatan" rows="10" cols="80"></textarea>
                                        </div>
                                    @endif
                                    <div class="mt-4">
                                        <div class="btn btn-success btn-lg btn-flat">
                                            <a href="{{$berkas}}"><i class="fa fa-heart fa-lg mr-2"></i> Download</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-7">
                                    <h3 class="my-3">OPENING DATA SURAT {{ $jenis }}</h3>
                                    <hr>
                                    <div class="form-group">
                                    <iframe src="{!! $berkas !!}" width="100%" height="780" style="border: none;" id="document-preview"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="buka_idne" id="buka_idne" value="{{ $idinbox }}">
<input type="hidden" name="buka_kelompok" id="buka_kelompok" value="{{ $previlage }}">
<input type="hidden" name="id_surat" id="id_surat" value="{{ $idinbox }}">
<input type="hidden" name="tabele" id="tabele" value="{{ $tabel }}">

@endsection
@push('script')
<script>
    $(function () {
		CKEDITOR.env.isCompatible = true;
		CKEDITOR.replace( 'buka_catatan', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90	
		});
		CKEDITOR.replace( 'id_footnote', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90	
		});
    });
	$(document).ready(function () {
        $('#catatantulis').hide();
        getnotifcount();
        $('.select2').select2({width: '100%'});
        $('#btnshowpassword').on('click', function (){
            var x = document.getElementById('id_password');
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        });
        $("#id_catatan").on('change', function () {
            var val01	= $(this).find('option:selected').attr('value');
            if (val01 == 'Isi Catatan Sendiri'){
                $('#catatanawal').hide();
                $('#catatantulis').show();
            } else {
                CKEDITOR.instances['id_footnote'].setData(val01)
            }
        });	
        $('#save').click(function () {
            var set01 = document.getElementById('id_password').value;
            var set02 = document.getElementById('id_surat').value;
            var set03 = document.getElementById('id_catatan').value;
            var set04 = document.getElementById('tabele').value;
            var token = document.getElementById('token').value;
            if (set03 == 'Isi Catatan Sendiri') { var set03 = CKEDITOR.instances['id_footnote'].getData(); }
            if (set01 == ''){
                swal({
                    title	: 'Stop',
                    text	: 'Passphare Tidak Boleh Kosong',
                    type	: 'warning',
                })
            } else {
                $("#loading").show();
                $('.divtindakan').hide();
                $.post('{{ route("exsimpanttd") }}', { val01: set01, val02: set02, val03: set03, val04: set04, val05: "", _token: token },
                function(data){
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
                    $('#loading').hide();
                    return false;
                });	
            }
        });
        $('#btnbatal').click(function () {
            var set01 = 'kembalikan';
            var set02 = document.getElementById('id_surat').value;
            var set03 = document.getElementById('id_catatan').value;
            var set04 = document.getElementById('tabele').value;
            var token = document.getElementById('token').value;
            if (set03 == 'Isi Catatan Sendiri') { var set03 = CKEDITOR.instances['id_footnote'].getData(); }
            if (set03 == ''){
                swal({
                    title	: 'Stop',
                    text	: 'Mohon isi catatan, agar konseptor membaca dan memperbaiki surat ini sesuai saran',
                    type	: 'warning',
                })
            } else {
                $("#loading").show();
                $('.divtindakan').hide();
                $.post('{{ route("exsimpanttd") }}', { val01: set01, val02: set02, val03: set03, val04: set04, _token: token },
                function(data){
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
                    location.reload();
                    return false;
                });
            }
        });
        $("#btnsimpancatatn").click(function(){
            var set01 		= document.getElementById('buka_idne').value;
            var set02		= $('#buka_kepada').select2().val();
            var set03		= CKEDITOR.instances['buka_catatan'].getData();
            var set04 		= document.getElementById('buka_kelompok').value;
            var set05 		= document.getElementById('filelampiran');
            var set06 		= document.getElementById('buka_sifatdiposisi').value;
            var CHEKED 	    = new Array();
            $("input[name='formDoor[]']:checked").each(function(){
                CHEKED.push($(this).val());
                if (set03 == ''){ var set03 = $(this).val(); }
            });
            if (set03 == ''){ var set03 = CHEKED[0]; }
            if (set03 == '') {
                console.log(set03);
                console.log(CHEKED);
                swal({
                    title	: 'Stop',
                    text	: 'Isi Disposisi Wajib Terisi!',
                    type	: 'warning',
                })
            } else if (set02 == ''){
                swal({
                    title	: 'Stop',
                    text	: 'Penerima Wajib Terisi!',
                    type	: 'warning',
                })
            } else {
                $('.divisidisposisi').hide();
                $('#loading').show();
                var form_data = new FormData();
                    form_data.append('kerja_idsurat', set01);
                    form_data.append('tanggal', 'Pimpinan');
                    form_data.append('id_disposisi', set03);
                    form_data.append('kelompok', set04);
                    form_data.append('file', set05.files[0]);
                    form_data.append('formDoor', CHEKED);
                    form_data.append('id_sifatdiposisi', set06);
                    form_data.append('kepada', set02);
                    form_data.append('_token', '{{csrf_token()}}');
                $.ajax({
                    url	: '{{ route("arsipfokerja") }}',
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
                            hideAfter: 5000,
                            stack: 1
                        });
                        location.reload();
                        return false;
                    },
                    error: function (xhr, status, error) {
                        $('.divawaldisposisi').show();
                        swal({
                            title	: 'Stop',
                            text	: xhr.responseText,
                            type	: 'error',
                        })
                    }
                });
            }
        });
        $("#btnarsipkan").click(function(){
            $('.divisidisposisi').hide();
            $('#loading').show();
            var set01 		= document.getElementById('buka_idne').value;
            var set02		= 'Arsiparis Umum';
            var set03		= CKEDITOR.instances['buka_catatan'].getData();
            var CHEKED 	    = new Array();
            $("input[name='formDoor[]']:checked").each(function(){
                CHEKED.push($(this).val());
                if (set03 == ''){ var set03 = $(this).val(); }
            });
            if (set03 == '') {var set03	= 'Kirim ke Arsiparis';}
            var set04 		= document.getElementById('buka_kelompok').value;
            var set05 		= document.getElementById('filelampiran');
            var form_data = new FormData();
                form_data.append('kerja_idsurat', set01);
                form_data.append('tanggal', set02);
                form_data.append('id_catatan', set03);
                form_data.append('kelompok', set04);
                form_data.append('file', set05.files[0]);
                form_data.append('formDoor', CHEKED);
                form_data.append('_token', '{{csrf_token()}}');
            $.ajax({
                url	: '{{ route("arsipfokerja") }}',
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
                        hideAfter: 5000,
                        stack: 1
                    });
                    location.reload();
                    return false;
                },
                error: function (xhr, status, error) {
                    $('.divawaldisposisi').show();
                    swal({
                        title	: 'Stop',
                        text	: xhr.responseText,
                        type	: 'error',
                    })
                }
            });
        });
    });
</script>
@endpush