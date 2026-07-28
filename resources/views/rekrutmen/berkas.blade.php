@extends('adminlte3.layout')
<style type="text/css">
    .judul {
        font-weight: bold;
        text-align: center;
        vertical-align: middle;
    }
    .fullkotak {
        border: thin solid #000;
    }
    .kotaklanjut {
        border-top-width: thin;
        border-right-width: thin;
        border-bottom-width: thin;
        border-top-style: solid;
        border-right-style: solid;
        border-bottom-style: solid;	
        border-top-color: #000;
        border-right-color: #000;
        border-bottom-color: #000;
    }
    .kiri {
        border-left-width: thin;	
        border-left-style: solid;	
        border-left-color: #000;
    }
    .kanan {
        border-right-width: thin;	
        border-right-style: solid;	
        border-right-color: #000;
    }
    .atas {
        border-top-width: thin;	
        border-top-style: solid;	
        border-top-color: #000;
    }
    .bawah {
        border-bottom-width: thin;	
        border-bottom-style: solid;	
        border-bottom-color: #000;
    }
</style>
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Berkas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content" >
        <div class="container-fluid">
            <div class="row" >
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Curiculum Vitae</h3>
                            <div class="card-tools">
                            <a href="{{ url('/') }}/profiluser"><button type="button" class="btn btn-tool"><i class="fa fa-close"></i></button></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table width="800" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="30">&nbsp;</td>
                                    <td width="76">&nbsp;</td>
                                    <td width="13">&nbsp;</td>
                                    <td width="167">&nbsp;</td>
                                    <td width="105">&nbsp;</td>
                                    <td width="119">&nbsp;</td>
                                    <td width="81">&nbsp;</td>
                                    <td width="77">&nbsp;</td>
                                    <td width="116">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="9"><strong><u>DAFTAR RIWAYAT HIDUP</u></strong></td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td colspan="2" rowspan="6" align="center" valign="top" class="fullkotak"><img src="{!!$foto!!}" alt="image" width="100%" id="preview"></td>
                                    <td valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center">I.</td>
                                    <td colspan="8">KETERANGAN PERORANGAN</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center" class="atas kanan kiri" valign="top">1.</td>
                                    <td colspan="3" class="atas kanan" valign="top">Nama Lengkap</td>
                                    <td colspan="5" class="atas kanan">{!! $biodata->nama_lengkap !!}</td>
                                </tr>
                                <tr>
                                    <td align="center" class="atas kanan kiri" valign="top">2.</td>
                                    <td colspan="3" class="atas kanan" valign="top">Tempat Lahir / Tgl. Lahir
                                    </td>
                                    <td colspan="5" class="atas kanan">{!! $biodata->tmpt_lahir !!} / {!! $biodata->tgl_lahir !!}</td>
                                </tr>
                                <tr>
                                    <td align="center" class="atas kanan kiri" valign="top">3.</td>
                                    <td colspan="3" class="atas kanan" valign="top">Jenis Kelamin</td>
                                    <td colspan="5" class="atas kanan">{!! $biodata->jenis_kelamin !!}</td>
                                </tr>
                                <tr>
                                    <td align="center" class="atas kanan kiri" valign="top">4.</td>
                                    <td colspan="3" class="atas kanan" valign="top">Agama</td>
                                    <td colspan="5" class="atas kanan">{!! $biodata->agama !!}</td>
                                </tr>
                                <tr>
                                    <td align="center" class="atas kanan kiri" valign="top">5.</td>
                                    <td colspan="3" class="atas kanan" valign="top">Status perkawinan</td>
                                    <td colspan="5" class="atas kanan">{!! $biodata->kawin !!}</td>
                                </tr>
                                <tr>
                                    <td rowspan="5" class="atas kanan kiri" align="center" valign="top">6.</td>
                                    <td rowspan="5"  class="atas kanan">Alamat Rumah</td>
                                    <td align="center"  class="atas kanan">a.</td>
                                    <td class="atas kanan" valign="top">Jalan</td>
                                    <td colspan="5" class="atas kanan">{!! $biodata->alamat !!}</td>
                                </tr>
                                <tr>
                                    <td align="center" class="atas kanan">b.</td>
                                    <td class="atas kanan" valign="top">Kelurahan</td>
                                    <td colspan="5" class="atas kanan">{!! $biodata->kelurahan !!}</td>
                                </tr>
                                <tr>
                                    <td align="center" class="atas kanan">c.</td>
                                    <td class="atas kanan" valign="top">Kecamatan</td>
                                    <td colspan="5" class="atas kanan">{!! $biodata->kecamatan !!}</td>
                                </tr>
                                <tr>
                                    <td align="center" class="atas kanan">d.</td>
                                    <td class="atas kanan" valign="top">Kabupaten / Kota</td>
                                    <td colspan="5" class="atas kanan">{!! $biodata->kota !!}</td>
                                </tr>
                                <tr>
                                    <td align="center" class="atas kanan">e.</td>
                                    <td class="atas kanan" valign="top">Propinsi</td>
                                    <td colspan="5" class="atas kanan">{!! $biodata->propinsi !!}</td>
                                </tr>
                                <tr>
                                    <td rowspan="7" class="atas kanan kiri" align="center" valign="top">7.</td>
                                    <td rowspan="7" class="atas kanan">Keterangan Badan</td>
                                    <td align="center" class="atas kanan">a.</td>
                                    <td class="atas kanan" valign="top">Tinggi (Cm)</td>
                                    <td colspan="5" class="atas kanan">{!! $biodata->tinggibdn !!}</td>
                                </tr>
                                <tr>
                                    <td align="center" class="atas kanan">b.</td>
                                    <td class="atas kanan" valign="top">Berat Badan (Kg)</td>
                                    <td colspan="5" class="atas kanan">{!! $biodata->beratbdn !!}</td>
                                </tr>
                                <tr>
                                    <td align="center" class="atas kanan">c.</td>
                                    <td class="atas kanan" valign="top">Rambut</td>
                                    <td colspan="5" class="atas kanan">{!! $biodata->bentukrambut !!}</td>
                                </tr>
                                <tr>
                                    <td align="center" class="atas kanan">d.</td>
                                    <td class="atas kanan" valign="top">Bentuk muka</td>
                                    <td colspan="5" class="atas kanan">{!! $biodata->bentukmuka !!}</td>
                                </tr>
                                <tr>
                                    <td align="center" class="atas kanan">e.</td>
                                    <td class="atas kanan" valign="top">Warna kulit</td>
                                    <td colspan="5" class="atas kanan">{!! $biodata->warnakulit !!}</td>
                                </tr>
                                <tr>
                                    <td align="center" class="atas kanan">f.</td>
                                    <td class="atas kanan" valign="top">Ciri-ciri khas</td>
                                    <td colspan="5" class="atas kanan">{!! $biodata->cirikusus !!}</td>
                                </tr>
                                <tr>
                                    <td align="center" class="atas kanan">g.</td>
                                    <td class="atas kanan" valign="top">Cacat tubuh</td>
                                    <td colspan="5" class="atas kanan">{!! $biodata->cacattubuh !!}</td>
                                </tr>
                                <tr>
                                    <td align="center" class="atas kanan kiri bawah">8.</td>
                                    <td colspan="3" class="atas kanan bawah">Kegemaran (Hobby)</td>
                                    <td colspan="5" class="atas kanan bawah">{!! $biodata->hobi !!}</td>
                                </tr>
                                <tr>
                                    <td align="center" class="atas kanan kiri bawah">9.</td>
                                    <td colspan="3" class="atas kanan bawah">Bidang Ilmu</td>
                                    <td colspan="5" class="atas kanan bawah">{!! $biodata->bidang_ilmu3 !!}</td>
                                </tr>
                                <tr>
                                    <td align="center" class="atas kanan kiri bawah">10.</td>
                                    <td colspan="3" class="atas kanan bawah">Kepakaran</td>
                                    <td colspan="5" class="atas kanan bawah">{!! $kepakaran !!}</td>
                                </tr>
                                
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center">II.</td>
                                    <td colspan="8">PENDIDIKAN</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td colspan="8">1. Pendidikan di Dalam dan Luar Negeri</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center" valign="top" class="atas kanan kiri">NO</td>
                                    <td align="center" valign="top" class="atas kanan">TINGKAT</td>
                                    <td colspan="2" align="center" valign="top" class="atas kanan">NAMA<br />PENDIDIKAN</td>
                                    <td align="center" valign="top" class="atas kanan">JURUSAN</td>
                                    <td align="center" valign="top" class="atas kanan">STTB/TANDA LULUS/IJASAH TAHUN</td>
                                    <td align="center" valign="top" class="atas kanan">TEMPAT</td>
                                    <td colspan="2" align="center" valign="top" class="atas kanan">NAMA KEPALA SEKOLAH/ DIREKTUR/ DEKAN/ PROMOTOR</td>
                                </tr>
                                <tr>
                                    <td align="center" class="atas kanan kiri" valign="top">1</td>
                                    <td align="center" class="atas kanan">2</td>
                                    <td colspan="2" align="center" class="atas kanan">3</td>
                                    <td align="center" class="atas kanan">4</td>
                                    <td align="center" class="atas kanan">5</td>
                                    <td align="center" class="atas kanan">6</td>
                                    <td colspan="2" align="center" class="atas kanan">7</td>
                                </tr>
                                    @php $no = 1; @endphp
                                    @foreach($pendidikan as $row)
                                        <tr>
                                            <td align="center" class="atas kanan kiri" valign="top">{!! $row['nomer'] !!}</td>
                                            <td class="atas kanan" valign="top">{!! $row['tingkat'] !!}</td>
                                            <td colspan="2" class="atas kanan" valign="top">{!! $row['nama'] !!}</td>
                                            <td class="atas kanan" valign="top">{!! $row['jurusan'] !!}</td>
                                            <td class="atas kanan" valign="top">{!! $row['tgllulus'] !!}</td>
                                            <td class="atas kanan" valign="top">{!! $row['tempat'] !!}</td>
                                            <td colspan="2" class="atas kanan" valign="top">{!! $row['namakepalasekolah'] !!}</td>
                                        </tr>
                                    @endforeach
                                <tr>
                                    <td align="center" class="atas kanan kiri bawah">&nbsp;</td>
                                    <td class="atas kanan bawah">&nbsp;</td>
                                    <td colspan="2" align="center" class="atas kanan bawah">&nbsp;</td>
                                    <td class="atas kanan bawah">&nbsp;</td>
                                    <td class="atas kanan bawah">&nbsp;</td>
                                    <td class="atas kanan bawah">&nbsp;</td>
                                    <td colspan="2" class="atas kanan bawah">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td colspan="8">2. Kursus / Diklat / Pelatihan</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center" valign="top" class="atas kanan kiri">NO</td>
                                    <td colspan="3" align="center" valign="top" class="atas kanan">NAMA/ KURSUS/ LATIHAN</td>
                                    <td align="center" valign="top" class="atas kanan">LAMANYA TGL/BLN/THN s.d. TGL/BLN/THN</td>
                                    <td align="center" valign="top" class="atas kanan">IJASAH/ TANDA LULUS/ SURAT KETERANGAN TAHUN</td>
                                    <td align="center" valign="top" class="atas kanan">TEMPAT</td>
                                    <td colspan="2" align="center" valign="top" class="atas kanan">KETERANGAN</td>
                                </tr>
                                <tr>
                                    <td align="center" class="atas kanan kiri" valign="top">1</td>
                                    <td colspan="3" align="center" class="atas kanan">2</td>
                                    <td align="center" class="atas kanan">3</td>
                                    <td align="center" class="atas kanan">4</td>
                                    <td align="center" class="atas kanan">5</td>
                                    <td colspan="2" align="center" class="atas kanan">6</td>
                                </tr>
                                    @php $no = 1; @endphp
                                    @foreach($diklat as $row)
                                        <tr>
                                            <td align="center" class="atas kanan kiri" valign="top">{!! $row['nomer'] !!}</td>
                                            <td colspan="3" class="atas kanan" valign="top">{!! $row['namadiklat'] !!}</td>
                                            <td class="atas kanan" valign="top">{!! $row['tanggal'] !!}</td>
                                            <td class="atas kanan" valign="top">{!! $row['nodoc'] !!}</td>
                                            <td class="atas kanan" valign="top">{!! $row['tempat'] !!}</td>
                                            <td colspan="2" class="atas kanan" valign="top">{!! $row['keterangan'] !!}</td>
                                        </tr>
                                    @endforeach
                                <tr>
                                    <td align="center" class="atas kanan kiri bawah">&nbsp;</td>
                                    <td colspan="3" class="atas kanan bawah">&nbsp;</td>
                                    <td class="atas kanan bawah">&nbsp;</td>
                                    <td class="atas kanan bawah">&nbsp;</td>
                                    <td class="atas kanan bawah">&nbsp;</td>
                                    <td colspan="2" class="atas kanan bawah">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center">III.</td>
                                    <td colspan="8">RIWAYAT PEKERJAAN</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="9" align="center">
                                        <table width="800" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000">
                                            <tr>
                                                <td width="39" valign="top" align="center">NO</td>
                                                <td width="169" valign="top" align="center">NAMA ORGANISASI</td>
                                                <td width="185" valign="top" align="center">KEDUDUKAN DALAM ORGANISASI</td>
                                                <td width="103" valign="top" align="center">MULAI</td>
                                                <td width="119" valign="top" align="center">SAMPAI</td>
                                                <td width="171" valign="top" align="center">NAMA PIMPINAN ORGANISASI</td>
                                            </tr>
                                            <tr>
                                                <td valign="top" align="center">1</td>
                                                <td valign="top" align="center">2</td>
                                                <td valign="top" align="center">3</td>
                                                <td valign="top" align="center">4</td>
                                                <td valign="top" align="center">5</td>
                                                <td valign="top" align="center">6</td>
                                            </tr>
                                                @php $no = 1; @endphp
                                                @foreach($organisasi as $row)
                                                    <tr>
                                                        <td  align="center">{{$no++}}</td>
                                                        <td valign="top">{!! $row['nama'] !!}</td>
                                                        <td valign="top">{!! $row['kedudukan'] !!}</td>
                                                        <td valign="top" align="center">{!! $row['mulai'] !!}</td>
                                                        <td valign="top" align="center">{!! $row['selesai'] !!}</td>
                                                        <td valign="top">{!! $row['namapejabat'] !!}</td>
                                                    </tr>
                                                @endforeach
                                                
                                            <tr>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center">IV.</td>
                                    <td colspan="8">TANDA JASA / PENGHARGAAN</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center" valign="top" class="atas kanan kiri">NO</td>
                                    <td colspan="4" align="center" valign="top" class="atas kanan">NAMA BINTANG / SATYA LANCANA/ PENGHARGAAN</td>
                                    <td align="center" valign="top" class="atas kanan">TAHUN PEROLEHAN</td>
                                    <td colspan="3" align="center" valign="top" class="atas kanan">NAMA NEGARA / INSTANSI YANG MEMBERI</td>
                                </tr>
                                <tr>
                                    <td  align="center" valign="top" class="atas kanan kiri">1</td>
                                    <td colspan="4" align="center" valign="top" class="atas kanan">2</td>
                                    <td align="center" valign="top" class="atas kanan">3</td>
                                    <td colspan="3" align="center" valign="top" class="atas kanan">4</td>
                                </tr>
                                    @php $no = 1; @endphp
                                    @foreach($penghargaan as $row)
                                    <tr>
                                        <td align="center" class="atas kanan kiri" valign="top">{!! $row['nomer'] !!}</td>
                                        <td colspan="4" class="atas kanan" valign="top">{!! $row['penghargaan'] !!}</td>
                                        <td class="atas kanan" valign="top"  align="center">{!! $row['tanggal'] !!}</td>
                                        <td colspan="3" class="atas kanan" valign="top">{!! $row['pemberi'] !!}</td>
                                    </tr>
                                    @endforeach

                                <tr>
                                    <td align="center" class="atas kanan kiri bawah">&nbsp;</td>
                                    <td colspan="4" class="atas kanan bawah">&nbsp;</td>
                                    <td class="atas kanan bawah">&nbsp;</td>
                                    <td colspan="3" class="atas kanan bawah">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center">V.</td>
                                    <td colspan="8">KETERANGAN KELUARGA</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td colspan="8">1. ISTRI / SUAMI</td>
                                </tr>
                                <tr>
                                    <td colspan="9" align="center"><table width="800" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000">
                                    <tr>
                                        <td width="35" align="center" valign="top">NO</td>
                                        <td width="189" align="center" valign="top">NAMA</td>
                                        <td width="112" align="center" valign="top">TEMPAT<br />LAHIR</td>
                                        <td width="112" align="center" valign="top">TANGGAL<br />LAHIR</td>
                                        <td width="112" align="center" valign="top">TANGGAL<br />MENIKAH</td>
                                        <td width="112" align="center" valign="top">PEKERJAAN</td>
                                        <td width="112" align="center" valign="top">KETERANGAN</td>
                                    </tr>
                                    <tr>
                                        <td align="center" valign="top">1</td>
                                        <td align="center" valign="top">2</td>
                                        <td align="center" valign="top">3</td>
                                        <td align="center" valign="top">4</td>
                                        <td align="center" valign="top">5</td>
                                        <td align="center" valign="top">6</td>
                                        <td align="center" valign="top">7</td>
                                    </tr>
                                        @php $no = 1; @endphp
                                        @foreach($sutri as $row)
                                        <tr>
                                            <td  align="center">{!! $row['nomer'] !!}</td>
                                            <td valign="top">{!! $row['nama'] !!}</td>
                                            <td valign="top">{!! $row['tmplahir'] !!}</td>
                                            <td valign="top">{!! $row['tgllahir'] !!}</td>
                                            <td valign="top">{!! $row['tglnikah'] !!}</td>
                                            <td valign="top">{!! $row['pekerjaan'] !!}</td>
                                            <td valign="top">{!! $row['keterangan'] !!}</td>
                                        </tr>
                                        @endforeach

                                    <tr>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                    </tr>
                                    </table></td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td colspan="8">2. Anak</td>
                                </tr>
                                <tr>
                                    <td colspan="9" align="center"><table width="800" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000">
                                    <tr>
                                        <td width="35" align="center" valign="top">NO</td>
                                        <td width="189" align="center" valign="top">NAMA</td>
                                        <td width="112" align="center" valign="top">JENIS KELAMIN</td>
                                        <td width="112" align="center" valign="top">TEMPAT<br />LAHIR</td>
                                        <td width="112" align="center" valign="top">TANGGAL<br />LAHIR</td>
                                        <td width="112" align="center" valign="top">PEKERJAAN</td>
                                        <td width="112" align="center" valign="top">KETERANGAN</td>
                                    </tr>
                                    <tr>
                                        <td align="center" valign="top">1</td>
                                        <td align="center" valign="top">2</td>
                                        <td align="center" valign="top">3</td>
                                        <td align="center" valign="top">4</td>
                                        <td align="center" valign="top">5</td>
                                        <td align="center" valign="top">6</td>
                                        <td align="center" valign="top">7</td>
                                    </tr>
                                        @php $no = 1; @endphp
                                        @foreach($anak as $row)
                                        <tr>
                                        <td  align="center">{!! $row['nomer'] !!}</td>
                                        <td valign="top">{!! $row['nama'] !!}</td>
                                        <td valign="top">{!! $row['kelamin'] !!}</td>
                                        <td valign="top">{!! $row['tmplahir'] !!}</td>
                                        <td valign="top">{!! $row['tgllahir'] !!}</td>
                                        <td valign="top">{!! $row['pekerjaan'] !!}</td>
                                        <td valign="top">{!! $row['keterangan'] !!}</td>
                                        </tr>
                                        @endforeach
                                    <tr>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                    </tr>
                                    </table></td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td colspan="8">3. Bapak dan Ibu Kandung</td>
                                </tr>
                                <tr>
                                    <td colspan="9" align="center"><table width="800" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000">
                                    <tr>
                                        <td width="35" align="center" valign="top">NO</td>
                                        <td width="189" align="center" valign="top">NAMA</td>
                                        <td width="230" align="center" valign="top">TGL. LAHIR / UMUR</td>
                                        <td width="182" align="center" valign="top">PEKERJAAN</td>
                                        <td width="152" align="center" valign="top">KETERANGAN</td>
                                    </tr>
                                    <tr>
                                        <td align="center" valign="top">1</td>
                                        <td align="center" valign="top">2</td>
                                        <td align="center" valign="top">3</td>
                                        <td align="center" valign="top">4</td>
                                        <td align="center" valign="top">5</td>
                                    </tr>
                                        @php $no = 1; @endphp
                                        @foreach($ortu as $row)
                                        <tr>
                                        <td  align="center">{!! $row['nomer'] !!}</td>
                                        <td valign="top">{!! $row['nama'] !!}</td>
                                        <td valign="top">{!! $row['tgllahir'] !!}</td>
                                        <td valign="top">{!! $row['pekerjaan'] !!}</td>
                                        <td valign="top">{!! $row['keterangan'] !!}</td>
                                        </tr>
                                        @endforeach
                                    <tr>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                    </tr>
                                    </table></td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td colspan="8">4. Bapak dan Ibu Mertua</td>
                                </tr>
                                <tr>
                                    <td colspan="9" align="center"><table width="800" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000">
                                    <tr>
                                        <td width="35" align="center" valign="top">NO</td>
                                        <td width="189" align="center" valign="top">NAMA</td>
                                        <td width="230" align="center" valign="top">TGL. LAHIR / UMUR</td>
                                        <td width="182" align="center" valign="top">PEKERJAAN</td>
                                        <td width="152" align="center" valign="top">KETERANGAN</td>
                                    </tr>
                                    <tr>
                                        <td align="center" valign="top">1</td>
                                        <td align="center" valign="top">2</td>
                                        <td align="center" valign="top">3</td>
                                        <td align="center" valign="top">4</td>
                                        <td align="center" valign="top">5</td>
                                    </tr>
                                        @php $no = 1; @endphp
                                        @foreach($mertua as $row)
                                        <tr>
                                        <td  align="center">{!! $row['nomer'] !!}</td>
                                        <td valign="top">{!! $row['nama'] !!}</td>
                                        <td valign="top">{!! $row['tgllahir'] !!}</td>
                                        <td valign="top">{!! $row['pekerjaan'] !!}</td>
                                        <td valign="top">{!! $row['keterangan'] !!}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                    </tr>
                                    </table></td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td colspan="8">5. Saudara Kandung</td>
                                </tr>
                                <tr>
                                    <td colspan="9" align="center">
                                        <table width="800" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000">
                                            <tr>
                                                <td width="35" align="center" valign="top">NO</td>
                                                <td width="189" align="center" valign="top">NAMA</td>
                                                <td width="112" align="center" valign="top">JENIS KELAMIN</td>
                                                <td align="center" valign="top">TGL. LAHIR / UMUR</td>
                                                <td width="112" align="center" valign="top">PEKERJAAN</td>
                                                <td width="112" align="center" valign="top">KETERANGAN</td>
                                            </tr>
                                            <tr>
                                                <td align="center" valign="top">1</td>
                                                <td align="center" valign="top">2</td>
                                                <td align="center" valign="top">3</td>
                                                <td align="center" valign="top">4</td>
                                                <td align="center" valign="top">5</td>
                                                <td align="center" valign="top">6</td>
                                            </tr>
                                                @php $no = 1; @endphp
                                                @foreach($saudara as $row)
                                                <tr>
                                                <td  align="center">{!! $row['nomer'] !!}</td>
                                                <td valign="top">{!! $row['nama'] !!}</td>
                                                <td valign="top">{!! $row['kelamin'] !!}</td>
                                                <td valign="top">{!! $row['tgllahir'] !!}</td>
                                                <td valign="top">{!! $row['pekerjaan'] !!}</td>
                                                <td valign="top">{!! $row['keterangan'] !!}</td>
                                                </tr>
                                                @endforeach
                                            <tr>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center">VI.</td>
                                    <td colspan="8">BERKAS PERSYARATAN</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="9" align="center">
                                        <table width="800" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000">
                                            <tr>
                                                <td align="center" valign="top">NO</td>
                                                <td align="center" valign="top">Nama Berkas</td>
                                                <td align="center" valign="top">Kewajiban</td>
                                                <td align="center" valign="top">URL</td>
                                                <td align="center" valign="top">KETERANGAN</td>
                                            </tr>
                                            <tr>
                                                <td align="center" valign="top">1</td>
                                                <td align="center" valign="top">2</td>
                                                <td align="center" valign="top">3</td>
                                                <td align="center" valign="top">4</td>
                                                <td align="center" valign="top">5</td>
                                            </tr>
                                                @foreach($berkassyarat as $row)
                                                <tr>
                                                    <td valign="top" align="center">{!! $row['nomer'] !!}</td>
                                                    <td valign="top">{!! $row['name'] !!}</td>
                                                    <td valign="top" align="center">{!! $row['type'] !!}</td>
                                                    <td valign="top">{!! $row['description'] !!}</td>
                                                    <td valign="top">{!! $row['keterangan'] !!}</td>
                                                </tr>
                                                @endforeach
                                            <tr>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td colspan="5" align="center">Malang, {{$tglcetak}}</td>
                                </tr>
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td colspan="5"  align="center">Yang membuat,</td>
                                </tr>
                                @if ($tandatangan == '')
                                    <tr>
                                        <td align="center">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td align="center">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td valign="top">&nbsp;</td>
                                        <td colspan="5"  align="center"><img src="{!!$tandatangan!!}" alt="image" width="100" height="100"></td>
                                    </tr>
                                @endif
                                <tr>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td align="center">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td colspan="5"  align="center">{!! $biodata->nama_lengkap !!}</td>
                                </tr>
                            </table>
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
@endsection
@push('script')
<script type="text/javascript">
    
</script>
@endpush