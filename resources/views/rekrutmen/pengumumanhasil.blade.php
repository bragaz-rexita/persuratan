@extends('adminlte3.layoutstandart')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Pengumuman Verifikasi Berkas</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active">Pengumuman Verifikasi Berkas</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="row">
        <div class="col-12">
            <div class="invoice p-3 mb-3">
              <div class="row">
                <div class="col-12 table-responsive">
                    <table class="dark-mode" width="820" border="0" cellpadding="0" cellspacing="0" id="printiki">
                        <tr><td colspan="3">&nbsp;</td></tr>
                        <tr>
                            <td width="10%">&nbsp;</td>
                            <td width="80%">
                                <table width="800" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td colspan="8" align="left" valign="middle"><font size="+3">E-CARD / KARTU ELEKTRONIK</font></td>
                                        <td>&nbsp;</td>
                                        <td align="left" valign="middle">&nbsp;</td>
                                        <td rowspan="5" align="left" valign="middle"><img src="/images/pegawai/{!!$foto!!}" width="100%"/></td>
                                    </tr>
                                    <tr>
                                        <td colspan="8" align="left" valign="middle"><font size="+2">Peserta Ujian Seleksi Pegawai Baru</font></td>
                                        <td>&nbsp;</td>
                                        <td align="left" valign="middle">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="8" align="left" valign="middle"><font size="+2"><b>{!! $namaapps01 !!}</b></font></td>
                                        <td align="center">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="8" align="left" valign="middle"><font size="+1"><b>{!! $subsubdomainapps01 !!}</b></font></td>
                                        <td align="center">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="8" align="left" valign="middle" style="border-bottom:double" ><strong>{!! $biodata->prodihomebase !!}</strong></td>
                                        <td align="center">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" rowspan="3" align="center" valign="middle"><img src="{!! $logofrontapps01 !!}" height="70" /></td>
                                        <td colspan="5" align="center"><strong><font size="+3">{!! $biodata->nama_lengkap !!}</font></strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" align="center">No. Peserta</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" align="center"><strong><font size="+3">&nbsp;{!! $biodata->kode !!}</font></strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" align="center" valign="middle"><strong>{!! $biodata->alamat !!}</strong></td>
                                        <td align="left" valign="middle">&nbsp;</td>
                                        <td align="left" valign="middle">&nbsp;</td>
                                        <td align="left" valign="middle">&nbsp;</td>
                                        <td colspan="4" align="center" valign="middle">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" align="center" valign="middle">{!! $biodata->no_hp !!}</td>
                                        <td align="left" valign="middle">&nbsp;</td>
                                        <td align="left" valign="middle">&nbsp;</td>
                                        <td align="left" valign="middle">&nbsp;</td>
                                        <td colspan="4" align="center" valign="middle">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" rowspan="4" align="center" valign="middle"><img src="data:image/png;base64,{!! $qrcode !!}" width="100" /></td>
                                        <td align="center">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td colspan="4" align="center" valign="middle">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" rowspan="3" align="center"style="border-bottom:double; border-top:double; border-left:double; border-right:double; background-image: url('{{asset('boxed-bg.png')}}'); background-repeat: repeat; background-position: center;"><font color="#999999">ttd<br />Penguji</font></td>
                                        <td align="center">&nbsp;</td>
                                        <td colspan="2" rowspan="3" align="center"style="border-bottom:double; border-top:double; border-left:double; border-right:double; background-image: url('{{asset('boxed-bg.png')}}'); background-repeat: repeat; background-position: center;"><font color="#999999">ttd<br />Peserta</font></td>
                                    </tr>
                                    <tr>
                                        <td align="center">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" align="center" valign="middle" style="border-bottom:double">&nbsp;</td>
                                        <td width="21" style="border-bottom:double">&nbsp;</td>
                                        <td width="33" style="border-bottom:double">&nbsp;</td>
                                        <td width="17" style="border-bottom:double">&nbsp;</td>
                                        <td width="61" style="border-bottom:double">&nbsp;</td>
                                        <td width="60" style="border-bottom:double">&nbsp;</td>
                                        <td width="92" style="border-bottom:double">&nbsp;</td>
                                        <td width="79" style="border-bottom:double">&nbsp;</td>
                                        <td width="160" style="border-bottom:double">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="11" style="border-bottom:double" align="center"><strong>JADWAL UJIAN</strong></td>
                                    </tr>
                                </table>
                            </td>
                            <td width="10%">&nbsp;</td>
                        </tr>
                        <tr><td colspan="3">&nbsp;</td></tr>
                    </table>
                    <table width="820" border="0" cellpadding="0" cellspacing="0" id="printiki">
                        <tr><td>
                        {!! $jadwalujian !!}
                        </td></tr>
                    </table>
                </div>
              </div>
            </div>
        </div>
    </div>
  </section>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
    <input type="text" id="edit_jenjang" class="form-control"  disabled="disable"/>
</div>
            
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="set_jenis" id="set_jenis" value="aktif">
@endsection