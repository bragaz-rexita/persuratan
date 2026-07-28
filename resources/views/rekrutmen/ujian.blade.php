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
        <h5><i class="fa fa-info"></i> Note:</h5>
        Waktu Start dan Stop Ujian di Kendalikan Secara Manual Oleh Admin {!! $tlsprodi !!}
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
                <div class="card-body">
                  <div id="accordion">
                    <div class="card card-danger">
                      <div class="card-header">
                        <h4 class="card-title w-100">
                          <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                            Kompetensi Bidang
                          </a>
                        </h4>
                      </div>
                      <div id="collapseTwo" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
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
                      </div>
                    </div>
                    <div class="card card-primary">
                      <div class="card-header">
                        <h4 class="card-title w-100">
                          <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                            Kompetensi Dasar
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                          @if(isset($listsoalkd) && !empty($listsoalkd))
                            @foreach($listsoalkd as $row)
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
                      </div>
                    </div>
                    
                  </div>
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
                          <td rowspan="5"><img src="boxed-bg.png" alt="image" id="preview" width="100%"></td>
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
                            <td>&nbsp;</td>
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
      $('#accordion').on('click', '.btnpill', function () {
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
      });
      $('.select2').select2({width: '100%'});
  });
  $(document).ready(function() {
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
  });
</script>
@endpush