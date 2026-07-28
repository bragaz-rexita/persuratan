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
                                    <td colspan="8">Jadwal</td>
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
                                    <td colspan="8">{!! $jadwal !!}</td>
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
                                    <td colspan="8">Pe Wawancara</td>
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
                                    <td colspan="8" style="border-bottom:double">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="9" align="center">
                                        <table width="800" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000">
                                            <tr>
                                                <td align="center" valign="top">NO</td>
                                                <td align="center" valign="top">Deskrispi</td>
                                                <td align="center" valign="top">Nilai Sikap</td>
                                                <td align="center" valign="top">Nilai Jawaban</td>
                                                <td align="center" valign="top">Nilai Diskusi</td>
                                            </tr>
                                            <tr>
                                                <td align="center" valign="top">1</td>
                                                <td align="center" valign="top">2</td>
                                                <td align="center" valign="top">3</td>
                                                <td align="center" valign="top">4</td>
                                                <td align="center" valign="top">5</td>
                                            </tr>
                                            <tr>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                                <td valign="top">&nbsp;</td>
                                            </tr>
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