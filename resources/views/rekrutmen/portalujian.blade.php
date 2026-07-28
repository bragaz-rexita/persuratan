@extends('adminlte3.layoutstandart')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Pengumuman Terkait Ujian Kompetensi</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active">Pengumuman Terkait Ujian Kompetensi</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="row">
        <div class="col-5">
            <div class="invoice p-3 mb-3">
                <table class="dark-mode" width="100%" border="0" cellpadding="0" cellspacing="0" id="printiki">
                    <tr><td colspan="3">&nbsp;</td></tr>
                    <tr>
                        <td width="10%">&nbsp;</td>
                        <td width="80%">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td colspan="10" align="left" valign="middle"><font size="+3">{!! Session('namaapps01') !!}</font></td>
                                </tr>
                                <tr>
                                    <td colspan="8" align="left" valign="middle"><font size="+2"><b>{!! Session('subsubdomainapps01') !!}</b></font></td>
                                    <td align="center">&nbsp;</td>
                                    <td rowspan="5" align="left" valign="middle"><img src="{!!$foto!!}" width="100"/></td>
                                </tr>
                                <tr>
                                    <td colspan="8" align="left" valign="middle"><font size="+1"><b>{!! $biodata->prodihomebase !!}</b></font></td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="8" align="left" valign="middle" style="border-bottom:double" ><strong>&nbsp;</strong></td>
                                    <td align="center">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="9" align="left" valign="middle"><b>{!! $biodata->nama_lengkap !!}</b></td>
                                </tr>
                                <tr>
                                    <td colspan="9" align="left" valign="middle"><b>No. Peserta : {!! $biodata->kode !!}</b></td>
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
                            </table>
                        </td>
                        <td width="10%">&nbsp;</td>
                    </tr>
                    <tr><td colspan="3">&nbsp;</td></tr>
                </table>
            </div>
        </div>
        <div class="col-7">
            <div class="callout callout-info">
                <h5><i class="fa fa-info"></i> Perhatian:</h5>
                Pastikan Bapak Ibu Sudah Membaca Tata Cara Penggunaan Ujian Online Ini, Jika belum mohon dibaca petunjuk dibawah ini dengan cermat.!!
            </div>
            <div class="card card-widget">
                <div class="card-header">
                    <div class="user-block">
                        <img class="img-circle" src="mascot.png" alt="User Image">
                        <span class="username"><a href="#">Petunjuk</a></span>
                        <span class="description"> Pengerjaan Ujian</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="attachment-block clearfix">
                        <ul>
                            <li>Klik Tombol Mulai Ujian di Bawah Ini</li>
                            <li>Waktu Pengerjaan 30 Menit dari Saat Bapak/Ibu Memulai Ujian</li>
                            <li>Timer Akan Berjalan Otomatis dan tidak Bisa di hentikan (pause) atau di mundurkan</li>
                            <li>Saat Waktu Habis Laman Ujian akan terkunci secara otomatis, dan Bapak/Ibu Tidak Bisa Lagi Membukan Kembali Laman Ujian Tersebut</li>
                            <li>Pastikan Perangkat yang digunakan untuk ujian stabil dan menggunakan provider internet yang lancar</li>
                            <li>Untuk Mengerjakan Soal perhatikan gambar dibawah ini :
                                <ol>
                                    <li>Tekan Nomor Yang Akan di Kerjakan, Soal Akan Tampil di Sisi Kanan</li>
                                    <li>Pilih Jawaban Bapak/Ibu di Baris terakhir kemudian Tekan Icon Berlogo Pencil <strong><i class="fa pencil"></i></strong></li>
                                    <li>Jawaban Yang Terpilih akan berwarna Hijau (bila tidak berubah warna berarti jawaban Bapak/Ibu belum tersimpan)</li>
                                </ol>
                            </li>
                        </ul>
                        <img src="images/ujian.png" width="100%">
                    </div>
                </div>
                <div class="card-footer">
                    <h1 class="m-0"><a href="{{ url('/') }}/startujianrekrutmen" class="btn btn-primary pull-right"><i class="fa fa-pencil"></i> Mulai Ujian</a></h1>
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