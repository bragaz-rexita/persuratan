@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Ujian Kompetensi</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active">{!! $tlsprodi !!}</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="callout callout-info">
        <h5 id="timeremaining"><i class="fa fa-info"></i> Note:</h5>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pilih Soal</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body" id="listsoal">
                    @if(isset($listsoalkb) && !empty($listsoalkb))
                        @foreach($listsoalkb as $row)
                            <a href="#" id="{{$row['id']}}" class="btnpill">
                            @php
                                if ($row['sudah'] == ''){
                            @endphp
                            <span class="bs-stepper-circle" id="step-{{$row['id']}}">{!! $row['urutan'] !!}</span>
                            @php 
                                } else {
                            @endphp
                            <span class="bs-stepper-circle btn-success" id="step-{{$row['id']}}">{!! $row['urutan'] !!}</span>
                            @php 
                                }
                            @endphp
                            </a>
                        @endforeach
                    @endif
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary btn-block mb-3" id="btnlogout"> <i class="fa fa-sign-out"></i>  Akhiri Ujian</a>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card card-primary card-outline" id="divawal">
                <div class="card-header">
                    <h3 class="card-title">Workarea</h3>
                </div>
                <div class="card-body">
                    <table width="100%" border="0" class="table table-striped" cellpadding="0" cellspacing="0">
                        <tr>
                            <td colspan="5" valign="top">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-2" >
                                            <a href="https://inabr.or.id/boxed-bg.png" id="verimagenumber1" data-toggle="lightbox" data-title="Picture 01" data-gallery="gallery">
                                                <img id="verpreview" src="https://inabr.or.id/boxed-bg.png?text=Pic1" class="img-fluid mb-2" alt="white sample" />
                                            </a>
                                        </div>
                                        <div class="col-sm-2" >
                                            <a href="https://inabr.or.id/boxed-bg.png" id="verimagenumber2" data-toggle="lightbox" data-title="Picture 02" data-gallery="gallery">
                                                <img id="verpreview2" src="https://inabr.or.id/boxed-bg.png?text=Pic2" class="img-fluid mb-2" alt="white sample" />
                                            </a>
                                        </div>
                                        <div class="col-sm-2" >
                                            <a href="https://inabr.or.id/boxed-bg.png" id="verimagenumber3" data-toggle="lightbox" data-title="Picture 03" data-gallery="gallery">
                                                <img id="verpreview3" src="https://inabr.or.id/boxed-bg.png?text=Pic3" class="img-fluid mb-2" alt="white sample" />
                                            </a>
                                        </div>
                                        <div class="col-sm-2" >
                                            <a href="https://inabr.or.id/boxed-bg.png" id="verimagenumber4" data-toggle="lightbox" data-title="Picture 04" data-gallery="gallery">
                                                <img id="verpreview4" src="https://inabr.or.id/boxed-bg.png?text=Pic4" class="img-fluid mb-2" alt="white sample" />
                                            </a>
                                        </div>
                                        <div class="col-sm-2" >
                                            <a href="https://inabr.or.id/boxed-bg.png" id="verimagenumber5" data-toggle="lightbox" data-title="Picture 05" data-gallery="gallery">
                                                <img id="verpreview5" src="https://inabr.or.id/boxed-bg.png?text=Pic5" class="img-fluid mb-2" alt="white sample" />
                                            </a>
                                        </div>
                                        <div class="col-sm-2" >
                                            <a href="https://inabr.or.id/boxed-bg.png" id="verimagenumber6" data-toggle="lightbox" data-title="Picture 06" data-gallery="gallery">
                                                <img id="verpreview6" src="https://inabr.or.id/boxed-bg.png?text=Pic6" class="img-fluid mb-2" alt="white sample" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" valign="top"><p id="deskripsi"></p></td>
                        </tr>
                        <tr>
                            <td width="5%" valign="top" align="center">A</td>
                            <td width="30%" valign="top"><p id="opsia"></p></td>
                            <td width="3%">&nbsp;</td>
                            <td width="5%" valign="top" align="center">B</td>
                            <td width="30%" valign="top"><p id="opsib"></p></td>
                        </tr>
                        <tr>
                            <td colspan="5">&nbsp;</td>
                        </tr>
                        <tr>
                            <td valign="top" align="center">C</td>
                            <td valign="top"><p id="opsic"></p></td>
                            <td>&nbsp;</td>
                            <td valign="top" align="center">D</td>
                            <td valign="top"><p id="opsid"></p></td>
                        </tr>
                        <tr>
                            <td colspan="5">&nbsp;</td>
                        </tr>
                        <tr>
                            <td valign="top" align="center">E</td>
                            <td valign="top"><p id="opsie"></p></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-lg">
                                    <select id="id_jawaban" class="form-control-lg">
                                        <option value="">Jawaban Anda .?</option>
                                        <option value="A">Option A</option>
                                        <option value="B">Option B</option>
                                        <option value="C">Option C</option>
                                        <option value="D">Option D</option>
                                        <option value="E">Option E</option>
                                    </select>
                                    <input type="hidden" id="idne">
                                    <div class="input-group-append">
                                    <div class="btn btn-primary btn-lg" id="btn-simpan">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-success card-outline" id="divesay">
                <div class="card-header">
                    <h3 class="card-title">Workarea</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2" >
                                        <a href="https://inabr.or.id/boxed-bg.png" id="esayimagenumber1" data-toggle="lightbox" data-title="Picture 01" data-gallery="gallery">
                                            <img id="esaypreview" src="https://inabr.or.id/boxed-bg.png?text=Pic1" class="img-fluid mb-2" alt="white sample" />
                                        </a>
                                    </div>
                                    <div class="col-sm-2" >
                                        <a href="https://inabr.or.id/boxed-bg.png" id="esayimagenumber2" data-toggle="lightbox" data-title="Picture 02" data-gallery="gallery">
                                            <img id="esaypreview2" src="https://inabr.or.id/boxed-bg.png?text=Pic2" class="img-fluid mb-2" alt="white sample" />
                                        </a>
                                    </div>
                                    <div class="col-sm-2" >
                                        <a href="https://inabr.or.id/boxed-bg.png" id="esayimagenumber3" data-toggle="lightbox" data-title="Picture 03" data-gallery="gallery">
                                            <img id="esaypreview3" src="https://inabr.or.id/boxed-bg.png?text=Pic3" class="img-fluid mb-2" alt="white sample" />
                                        </a>
                                    </div>
                                    <div class="col-sm-2" >
                                        <a href="https://inabr.or.id/boxed-bg.png" id="esayimagenumber4" data-toggle="lightbox" data-title="Picture 04" data-gallery="gallery">
                                            <img id="esaypreview4" src="https://inabr.or.id/boxed-bg.png?text=Pic4" class="img-fluid mb-2" alt="white sample" />
                                        </a>
                                    </div>
                                    <div class="col-sm-2" >
                                        <a href="https://inabr.or.id/boxed-bg.png" id="esayimagenumber5" data-toggle="lightbox" data-title="Picture 05" data-gallery="gallery">
                                            <img id="esaypreview5" src="https://inabr.or.id/boxed-bg.png?text=Pic5" class="img-fluid mb-2" alt="white sample" />
                                        </a>
                                    </div>
                                    <div class="col-sm-2" >
                                        <a href="https://inabr.or.id/boxed-bg.png" id="esayimagenumber6" data-toggle="lightbox" data-title="Picture 06" data-gallery="gallery">
                                            <img id="esaypreview6" src="https://inabr.or.id/boxed-bg.png?text=Pic6" class="img-fluid mb-2" alt="white sample" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="esay_jawaban" id="esay_deskripsi">Case Deskription</label>
                                <textarea id="esay_jawaban" rows="5" cols="20"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success pull-right" type="button" id="btnupdatedataps">Simpan</button>
                </div>
            </div>
            <div class="error-page" id="divselesai">
                <h2 class="headline text-danger"><i class="fa fa-warning"></i></h2>
                <div class="error-content">
                    <h3><strong>Waktu Habis</strong></h3>
                    <p></p>
                    Ujian Ini Hanya Bisa di Kerjakan di Rentang {{$mulai}} s/d {{$akhir}} dengan Durasi {{$timer}} menit sejak pertama kali laman ini dibuka
                </div>
            </div>
        </div>
    </div>
  </section>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
  <input type="text" class="form-control" id="id_mahasiswa" value="{{$idmahasiswa}}">
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="set_jenis" id="set_jenis" value="1">
@endsection
@push('script')
<script type="text/javascript">
    $(function () {
        $('#listsoal').on('click', '.btnpill', function () {
            var set01 = $(this).attr('id');	
            $("#id_jawaban").val('');
            $("#idne").val(set01);
            $('#opsia').html('');
            $('#opsib').html('');
            $('#opsic').html('');
            $('#opsid').html('');
            $('#opsie').html('');
            $('#preview').attr('src', 'boxed-bg.png');
            $('#deskripsi').html('');
            var token = document.getElementById('token').value;
            $.post('{{ route("getFirstDataUjian") }}', { val01: set01, _token: token },function(data){
                var deskripsi = data.deskripsi;
                var opsia     = data.opsia;
                var opsib     = data.opsib;
                var opsic     = data.opsic;
                var opsid     = data.opsid;
                var opsie     = data.opsie;
                var lampiran  = data.lampiran;
                var jenissoal = data.jenissoal;
                var lampiran  = data.lampiran;
                var lampiran2 = data.lampiran2;
                var lampiran3 = data.lampiran3;
                var lampiran4 = data.lampiran4;
                var lampiran5 = data.lampiran5;
                var lampiran6 = data.lampiran6;
                
                if (jenissoal == 'esay'){
                    $('#divesay').show();
                    $('#divawal').hide();
                    $('#esay_deskripsi').html(deskripsi);
                    $('#esay_jawaban').summernote('code', opsia);
                    if (lampiran == ''){
                        $('#esayimagenumber1').attr('href', 'boxed-bg.png');
                        $('#esaypreview').attr('src', 'boxed-bg.png');
                    } else {
                        $('#esayimagenumber1').attr('href', lampiran);
                        $('#esaypreview').attr('src', lampiran);
                    }
                    if (lampiran2 == ''){
                        $('#esayimagenumber2').attr('href', 'boxed-bg.png');
                        $('#esaypreview2').attr('src', 'boxed-bg.png');
                    } else {
                        $('#esayimagenumber2').attr('href', lampiran2);
                        $('#esaypreview2').attr('src', lampiran2);
                    }
                    if (lampiran3 == ''){
                        $('#esayimagenumber3').attr('href', 'boxed-bg.png');
                        $('#esaypreview3').attr('src', 'boxed-bg.png');
                    } else {
                        $('#esayimagenumber3').attr('href', lampiran3);
                        $('#esaypreview3').attr('src', lampiran3);
                    }
                    if (lampiran4 == ''){
                        $('#esayimagenumber4').attr('href', 'boxed-bg.png');
                        $('#esaypreview4').attr('src', 'boxed-bg.png');
                    } else {
                        $('#esayimagenumber4').attr('href', lampiran4);
                        $('#esaypreview4').attr('src', lampiran4);
                    }
                    if (lampiran5 == ''){
                        $('#esayimagenumber5').attr('href', 'boxed-bg.png');
                        $('#esaypreview5').attr('src', 'boxed-bg.png');
                    } else {
                        $('#esaypreview5').attr('src', lampiran5);
                        $('#esayimagenumber5').attr('href', lampiran5);
                    }
                    if (lampiran6 == ''){
                        $('#esayimagenumber6').attr('href', 'boxed-bg.png');
                        $('#esaypreview6').attr('src', 'boxed-bg.png');
                    } else {
                        $('#esaypreview6').attr('src', lampiran6);
                        $('#esayimagenumber6').attr('href', lampiran6);
                    }
                } else {
                    $('#divesay').hide();
                    $('#divawal').show();
                    if (lampiran == ''){
                        $('#preview').attr('src', 'boxed-bg.png');
                    } else {
                        $('#preview').attr('src', lampiran);
                    }
                    $('#deskripsi').html(deskripsi);
                    $('#opsia').html(opsia);
                    $('#opsib').html(opsib);
                    $('#opsic').html(opsic);
                    $('#opsid').html(opsid);
                    $('#opsie').html(opsie);
                    if (lampiran == ''){
                        $('#verimagenumber1').attr('href', 'boxed-bg.png');
                        $('#verpreview').attr('src', 'boxed-bg.png');
                    } else {
                        $('#verimagenumber1').attr('href', lampiran);
                        $('#verpreview').attr('src', lampiran);
                    }
                    if (lampiran2 == ''){
                        $('#verimagenumber2').attr('href', 'boxed-bg.png');
                        $('#verpreview2').attr('src', 'boxed-bg.png');
                    } else {
                        $('#verimagenumber2').attr('href', lampiran2);
                        $('#verpreview2').attr('src', lampiran2);
                    }
                    if (lampiran3 == ''){
                        $('#verimagenumber3').attr('href', 'boxed-bg.png');
                        $('#verpreview3').attr('src', 'boxed-bg.png');
                    } else {
                        $('#verimagenumber3').attr('href', lampiran3);
                        $('#verpreview3').attr('src', lampiran3);
                    }
                    if (lampiran4 == ''){
                        $('#verimagenumber4').attr('href', 'boxed-bg.png');
                        $('#verpreview4').attr('src', 'boxed-bg.png');
                    } else {
                        $('#verimagenumber4').attr('href', lampiran4);
                        $('#verpreview4').attr('src', lampiran4);
                    }
                    if (lampiran5 == ''){
                        $('#verimagenumber5').attr('href', 'boxed-bg.png');
                        $('#verpreview5').attr('src', 'boxed-bg.png');
                    } else {
                        $('#verpreview5').attr('src', lampiran5);
                        $('#verimagenumber5').attr('href', lampiran5);
                    }
                    if (lampiran6 == ''){
                        $('#verimagenumber6').attr('href', 'boxed-bg.png');
                        $('#verpreview6').attr('src', 'boxed-bg.png');
                    } else {
                        $('#verpreview6').attr('src', lampiran6);
                        $('#verimagenumber6').attr('href', lampiran6);
                    }
                }
            });
        });
        $('.select2').select2({width: '100%'});
    });
    const mulai = '{{$mulai}}';
    let dateTimeParts= mulai.split(/[- :]/);
    dateTimeParts[1]--;
    var start = new Date(...dateTimeParts);

    CountDownTimer(start, 'timeremaining');
    function CountDownTimer(dt, id)
    {
        //var end 	= new Date(dt.getTime() + 60000);
        var _second = 1000;
        var _minute = _second * 60;
        var _hour 	= _minute * 60;
        var _day 	= _hour * 24;
        var waktu	= '{{$timer}}';
        var total   = waktu * 1000 * 60;
        var end 	= new Date(dt.getTime() + total);
        
        var timer;
        function showRemaining() {
            var now = new Date();
            var distance = end - now;
            if (distance < 0) {
                var username = "{{ $jenisujian }}";
                if (username == 'tryout'){
                    $('#divselesai').hide();
                } else {
                    $('#divawal').hide();
                    $('#listsoal').hide();
                    $('#divselesai').show();
                    return;
                }
            }
            var days = Math.floor(distance / _day);
            var hours = Math.floor((distance % _day) / _hour);
            var minutes = Math.floor((distance % _hour) / _minute);
            var seconds = Math.floor((distance % _minute) / _second);
            document.getElementById(id).innerHTML =' Test Ended in ';
            document.getElementById(id).innerHTML += hours + ' hours, '+ minutes + ' minutes, '+ seconds + ' secs';
        }
        timer = setInterval(showRemaining, 1000);
    }
    $(document).ready(function() {
        $('#verimagenumber1').click(function (e) {
            e.preventDefault();
            $(this).ekkoLightbox();
        });
        $('#verimagenumber2').click(function (e) {
            e.preventDefault();
            $(this).ekkoLightbox();
        });
        $('#verimagenumber3').click(function (e) {
            e.preventDefault();
            $(this).ekkoLightbox();
        });
        $('#verimagenumber4').click(function (e) {
            e.preventDefault();
            $(this).ekkoLightbox();
        });
        $('#verimagenumber5').click(function (e) {
            e.preventDefault();
            $(this).ekkoLightbox();
        });
        $('#verimagenumber6').click(function (e) {
            e.preventDefault();
            $(this).ekkoLightbox();
        });
        $('#esay_jawaban').summernote()
        $('#esayimagenumber1').click(function (e) {
            e.preventDefault();
            $(this).ekkoLightbox();
        });
        $('#esayimagenumber2').click(function (e) {
            e.preventDefault();
            $(this).ekkoLightbox();
        });
        $('#esayimagenumber3').click(function (e) {
            e.preventDefault();
            $(this).ekkoLightbox();
        });
        $('#esayimagenumber4').click(function (e) {
            e.preventDefault();
            $(this).ekkoLightbox();
        });
        $('#esayimagenumber5').click(function (e) {
            e.preventDefault();
            $(this).ekkoLightbox();
        });
        $('#esayimagenumber6').click(function (e) {
            e.preventDefault();
            $(this).ekkoLightbox();
        });
        $('#divselesai').hide();
        $('#divesay').hide();
        $("#id_jawaban").val('');
        $("#idne").val('');
        $('#opsia').html('');
        $('#opsib').html('');
        $('#opsic').html('');
        $('#opsid').html('');
        $('#opsie').html('');
        $('#preview').attr('src', 'boxed-bg.png');
        $('#deskripsi').html('');
        $("#btn-simpan").click(function(){
            var val01=document.getElementById('idne').value;
            var val02=document.getElementById('id_mahasiswa').value;
            var val03=document.getElementById('id_jawaban').value;
            if (val01 == '' || val02 == '' || val03 == ''){
                swal({
                title	: 'Stop',
                text	: 'Mohon Lengkapi Isian Bapak/Ibu, Apabila Melewati Waktu Idle, maka Laman ini perlu di Refresh',
                type	: 'warning',
                })
            } else {
                $.post('{{ route("exSimpanJawaban") }}', { set01: val01, set02: val02, set03: val03, _token: '{{ csrf_token() }}' },function(data){
                    var status = data.status;
                    if (status == 'Gagal'){
                    swal({
                        title	: status,
                        text	: data.message,
                        type	: data.icon,
                    })
                    } else if (status == 'Close'){
                    swal({
                        title	: status,
                        text	: data.message,
                        type	: data.icon,
                    })
                    } else {
                    $('#step-'+val01).removeClass('bs-stepper-circle').addClass('bs-stepper-circle btn-success');
                    $.post('{{ route("getFirstDataUjian") }}', { val01: val01, _token: '{{ csrf_token() }}' },function(data){
                        var deskripsi = data.deskripsi;
                        var opsia     = data.opsia;
                        var opsib     = data.opsib;
                        var opsic     = data.opsic;
                        var opsid     = data.opsid;
                        var opsie     = data.opsie;
                        var lampiran  = data.lampiran;
                        if (lampiran == ''){
                        $('#preview').attr('src', 'boxed-bg.png');
                        } else {
                        $('#preview').attr('src', lampiran);
                        }
                        $('#deskripsi').html(deskripsi);
                        $('#opsia').html(opsia);
                        $('#opsib').html(opsib);
                        $('#opsic').html(opsic);
                        $('#opsid').html(opsid);
                        $('#opsie').html(opsie);
                    });
                    $.toast({
                        heading: status,
                        text: data.message,
                        position: 'top-right',
                        loaderBg: data.warna,
                        icon: data.icon,
                        hideAfter: 3000,
                        stack: 1
                    });
                    }
                });
            }
        });
        $("#btnupdatedataps").click(function(){
            var val01=document.getElementById('idne').value;
            var val02=document.getElementById('id_mahasiswa').value;
            var val03=$('#esay_jawaban').summernote('code');
            if (val01 == '' || val02 == '' || val03 == ''){
                swal({
                    title	: 'Stop',
                    text	: 'Mohon Lengkapi Isian Bapak/Ibu, Apabila Melewati Waktu Idle, maka Laman ini perlu di Refresh',
                    type	: 'warning',
                })
            } else {
                $.post('{{ route("exSimpanJawaban") }}', { set01: val01, set02: val02, set03: val03, _token: '{{ csrf_token() }}' },function(data){
                    var status = data.status;
                    if (status == 'Gagal'){
                        swal({
                            title	: status,
                            text	: data.message,
                            type	: data.icon,
                        })
                    } else if (status == 'Close'){
                        swal({
                            title	: status,
                            text	: data.message,
                            type	: data.icon,
                        })
                    } else {
                        $('#step-'+val01).removeClass('bs-stepper-circle').addClass('bs-stepper-circle btn-success');
                        $.toast({
                            heading     : status,
                            text        : data.message,
                            position    : 'top-right',
                            loaderBg    : data.warna,
                            icon        : data.icon,
                            hideAfter   : 3000,
                            stack       : 1
                        });
                    }
                });
            }
        });
        $('#btnlogout').click(function () {
            var token = '{{ csrf_token() }}';
            $.post('{{ route("exInputBankSoal") }}', { set01: 'akhiriujian', set02: 'akhiriujian', _token: token },
            function(data){
                $.toast({
                    heading     : 'Info',
                    text        : data,
                    position    : 'top-right',
                    loaderBg    : '#5ba035',
                    icon        : 'info',
                    hideAfter   : 3000,
                    stack       : 1
                });
                setTimeout(function () { 
                    window.location.href = '/';
                }, 3000);
                return false;
            });	
        });
    });
</script>
@endpush