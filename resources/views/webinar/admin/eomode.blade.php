@extends('adminlte3.layout')
@section('content')
@php
    $tglmulai   = $datane->mulai;
    $getjam1    = explode(' ', $tglmulai);
    $tglmulai   = $getjam1[0];
    $jammulai   = $getjam1[1];

    $tglakhir   = $datane->akhir;
    $getjam2    = explode(' ', $tglakhir);
    $tglakhir   = $getjam2[0];
    $jamakhir   = $getjam2[1];

    $tglmulai2  = $datane->daftarmulai;
    $getjam3    = explode(' ', $tglmulai2);
    $tglmulai2  = $getjam3[0];
    $jammulai2  = $getjam3[1];

    $tglakhir2  = $datane->daftarakhir;
    $getjam4    = explode(' ', $tglakhir2);
    $tglakhir2  = $getjam4[0];
    $jamakhir2  = $getjam4[1];

    $tglmulai3  = $datane->absenmulai;
    $getjam5    = explode(' ', $tglmulai3);
    $tglmulai3  = $getjam5[0];
    $jammulai3  = $getjam5[1];

    $tglakhir3  = $datane->absenakhir;
    $getjam6    = explode(' ', $tglakhir3);
    $tglakhir3  = $getjam6[0];
    $jamakhir3  = $getjam6[1];
@endphp
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Welcome {{ $nama_lengkap }} </h1>
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
				<div class="col-md-9" id="divsembilan">
                    <div class="card card-widget widget-user-2">
                        @if($pembuat == 'YES')
                        <div class="widget-user-header bg-success">
                        @else
                        <div class="widget-user-header bg-warning">
                        @endif
                            <div class="widget-user-image">
                            @if (Session('avatar') != '')
                                <img class="img-circle elevation-2" src="{{ Session('avatar') }}" alt="User Avatar">
                                @php $foto = Session('avatar'); @endphp
                            @else 
                                @if (isset($logo01))
                                    <img class="img-circle elevation-2" src="{{ asset($logo01) }}" alt="User Avatar">
                                    @php $foto = $logo01; @endphp
                                @elseif (Session('logo01') !== null)
                                    <img class="img-circle elevation-2" src="{{ Session('logo01') }}" alt="User Avatar">
                                    @php $foto = Session('logo01'); @endphp
                                @else
                                    <img class="img-circle elevation-2" src="{{ asset('mascot.png') }}" alt="User Avatar">
                                    @php $foto = 'mascot.png'; @endphp
                                @endif
                            @endif
                            
                            </div>
                            <h3 class="widget-user-username">{{ $datane->nama }}</h3>
                            <h5 class="widget-user-desc">{{ $datane->tempat }} Date : {{ $datane->tanggal }}</h5>
                        </div>
                    </div>
					<div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#profil" data-toggle="tab">#</a></li>
                                <li class="nav-item"><a class="nav-link" href="#panitia" data-toggle="tab">Susunan Panitia</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tugas" data-toggle="tab">Tugas - Tugas </a></li>
                                <li class="nav-item"><a class="nav-link" href="#susunanacara" data-toggle="tab">Susunan Acara </a></li>
                                <li class="nav-item"><a class="nav-link" href="#konsumsi" data-toggle="tab">Konsumsi </a></li>
                                <li class="nav-item"><a class="nav-link" href="#undangan" data-toggle="tab">Undangan </a></li>
                                <li class="nav-item"><a class="nav-link" href="#anggaran" data-toggle="tab">Anggaran </a></li>
                                <li class="nav-item"><a class="nav-link" href="#layout" data-toggle="tab">Layout </a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div id="loading">
                                <img width="50%" src="{{ asset('dist/img/loading.gif') }}" alt="Loading On Duidev">
                            </div>
                            <div class="tab-content">
                                <div class="active tab-pane" id="profil">
                                    <div class="card card-danger">
                                        <div class="card-header">
                                            <h3 class="card-title">Event Organizer</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="id_namaefent">Nama Event</label>
                                                <input type="text" id="id_namaefent" name="id_namaefent" class="form-control" value="{!! $datane->nama !!}" />
                                            </div>
                                            <div class="form-group">
                                                <label for="id_tempat">Tempat</label>
                                                <input type="text" id="id_tempat" name="id_tempat" class="form-control" value="{!! $datane->tempat !!}" />
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="id_kapasitas">Batas Peserta (0 For Unlimit)</label>
                                                        <input type="text" id="id_kapasitas" value="0" class="form-control" value="{!! $datane->kapasitas !!}" />
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="id_biaya">Biaya (0 For Free)</label>
                                                        <input type="text" id="id_biaya" value="0" class="form-control" value="{!! $datane->bayar !!}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <p>Rentang Pelaksanaan Event</p>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label for="id_tglmulaiefent">Tgl. Mulai</label>
                                                        <input value="{{$tglmulai}}" type="text" id="id_tglmulaiefent" name="id_tglmulaiefent" class="form-control"  data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask />
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for="id_jammulaiefent">Jam Mulai</label>
                                                        <input value="{{$jammulai}}" type="text" id="id_jammulaiefent" name="id_jammulaiefent" class="form-control timepicker">
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for="id_tglselesaiefent">Tgl. Selesai</label>
                                                        <input value="{{$tglakhir}}" type="text" id="id_tglselesaiefent" name="id_tglselesaiefent" class="form-control"  data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for="id_jamselesaiefent">Jam Selesai</label>
                                                        <input value="{{$jamakhir}}" type="text" id="id_jamselesaiefent" name="id_jamselesaiefent" class="form-control timepicker">
                                                    </div>
                                                </div>
                                            </div>
                                            <p>Rentang dibuka pendaftaran peserta</p>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label for="id_tglmulaidaftar">Tgl. Daftar</label>
                                                        <input value="{{$tglmulai2}}" type="text" id="id_tglmulaidaftar" name="id_tglmulaidaftar" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for="id_jammulaidaftar">Jam Daftar</label>
                                                        <input value="{{$jammulai2}}" type="text" id="id_jammulaidaftar" name="id_jammulaidaftar" class="form-control timepicker">
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for="id_tglselesaidaftar">Tgl. Akhir Daftar</label>
                                                        <input value="{{$tglakhir2}}" type="text" id="id_tglselesaidaftar" name="id_tglselesaidaftar" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for="id_jamselesaidaftar">Jam Akhir Daftar</label>
                                                        <input value="{{$jamakhir2}}" type="text" id="id_jamselesaidaftar" name="id_jamselesaidaftar" class="form-control timepicker">
                                                    </div>
                                                </div>
                                            </div>
                                            <p>Rentang dibuka presensi peserta</p>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label for="id_tglmulaiabsen">Tgl. Presensi</label>
                                                        <input value="{{$tglmulai3}}" type="text" id="id_tglmulaiabsen" name="id_tglmulaiabsen" class="form-control"  data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for="id_jammulaiabsen">Jam Presensi Mulai</label>
                                                        <input value="{{$jammulai3}}" type="text" id="id_jammulaiabsen" name="id_jammulaiabsen" class="form-control timepicker">
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for="id_tglselesaiabsen">Tgl. Akhir Presensi</label>
                                                        <input value="{{$tglakhir3}}" type="text" id="id_tglselesaiabsen" name="id_tglselesaiabsen" class="form-control"  data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for="id_jamselesaiabsen">Jam Akhir Presensi</label>
                                                        <input value="{{$jamakhir3}}" type="text" id="id_jamselesaiabsen" name="id_jamselesaiabsen" class="form-control timepicker">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="id_linkmateri">Perlengkapan</label>
                                                <textarea id="id_linkmateri" name="id_linkmateri" style="width: 100%; height: 300px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd;">{!! $datane->linkmateri !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <a href="#" class="btn btn-success btnsimpan">
                                                <i class="fa fa-calendar-check-o"></i><span class="pull-right">Save Event</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="panitia">
                                    <div class="card card-warning shadow">
                                        <div class="card-header">
                                            <h3 class="card-title">Susunan Panitia</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <select id="panitia_nama" size="1" class="form-control select2">
                                                            <option value="">Pilih Pegawai</option>
                                                            @foreach($arrallpeg as $rows)
                                                                <option value="{{$rows->email_ub}}">{!! $rows->nama_lengkap !!} ( {!! $rows->jabatan !!} - {!! $rows->unit !!} )</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group" data-target-input="nearest">
                                                            <input type="text" class="form-control" id="panitia_sebagai" name="panitia_sebagai" placeholder="Posisi : Penanggung Jawab / Ketua / Sekretaris / Bendahara / dst" />
                                                            <div class="input-group-append">
                                                                <div class="input-group-text btn btn-primary" id="btnsimpanpanitia"><i class="fa fa-user-plus"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div id="gridpanitia"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tugas">
                                    <div class="card card-danger shadow">
                                        <div class="card-header">
                                            <h3 class="card-title">Tugas-Tugas</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" id="topbtntambahtugas"><i class="fa fa-plus"></i> Tambah Data</button>
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group tugasisi">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Nama Kelompok</label>
                                                        <input type="text" class="form-control" id="tugas_kelompok" name="tugas_kelompok" placeholder="Posisi : Penanggung Jawab / Ketua / Sekretaris / Bendahara / dst"/>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="tugas_file">File Pendukung (PDF)</label>
                                                            <div class="input-group input-group-sm">
                                                                <input type="file" class="form-control" id="tugas_file">
                                                                <div class="input-group-append">
                                                                    <div class="btn btn-primary">
                                                                        <i class="fa fa-file-pdf-o"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group tugasisi">
                                                <label for="tugas_deskripsi">Deskripsi Tugas</label>
                                                <textarea id="tugas_deskripsi" name="tugas_deskripsi" style="width: 100%; height: 100px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd;"></textarea>
                                            </div>
                                            <div class="form-group tugascatatan">
                                                <label for="tugas_catatan">Catatan</label>
                                                <textarea id="tugas_catatan" name="tugas_catatan" style="width: 100%; height: 100px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd;"></textarea>
                                            </div>
                                            <div class="form-group tugasisi">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <a href="#" class="btn btn-danger" id="btncancelisitugas">
                                                            <i class="fa fa-close"></i><span class="pull-left"> Cancel</span>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a href="#" class="btn btn-success" id="btnsimpanlistisitugas">
                                                            <i class="fa fa-save"></i><span class="pull-right"> Save</span>
                                                        </a>
                                                        <input type="hidden" id="tugas_idne" name="tugas_idne" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group tugascatatan">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <a href="#" class="btn btn-danger" id="btncancelisicatatan">
                                                            <i class="fa fa-close"></i><span class="pull-left"> Cancel</span>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a href="#" class="btn btn-success" id="btnsimpancatatantugas">
                                                            <i class="fa fa-save"></i><span class="pull-right"> Save</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div id="gridtugas"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="susunanacara">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card card-primary shadow">
                                                <div class="card-header">
                                                    <h3 class="card-title">Susunan Acara</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <textarea id="id_kontak" name="id_kontak" style="width: 100%; height: 300px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd;">{!! $datane->kontak !!}</textarea>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <a href="#" class="btn btn-primary btnsimpan">
                                                        <i class="fa fa-save"></i><span class="pull-left"> Save</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="card card-info shadow">
                                                <div class="card-header">
                                                    <h3 class="card-title"> Skenario Kegiatan</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <textarea id="id_pembicara" name="id_pembicara" style="width: 100%; height: 300px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd;">{!! $datane->pembicara !!}</textarea>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <a href="#" class="btn btn-info btnsimpan">
                                                        <i class="fa fa-save"></i><span class="pull-right"> Save</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="konsumsi">
                                    <div class="card card-danger shadow">
                                        <div class="card-header">
                                            <h3 class="card-title">Konsumsi</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <textarea id="id_linkwebinar" name="id_linkwebinar" style="width: 100%; height: 300px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd;">{!! $datane->linkwebniar !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <a href="#" class="btn btn-info btnsimpan">
                                                <i class="fa fa-save"></i><span class="pull-right"> Save</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="undangan">
                                    <div class="card card-danger shadow">
                                        <div class="card-header">
                                            <h3 class="card-title">Daftar Undangan</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" id="topbtntambahundangan"><i class="fa fa-plus"></i> Tambah Data</button>
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="card-body" id="divundanganadd">
                                            <div class="form-group">
                                                <label for="undangan_nama">Nama Lengkap</label>
                                                <input type="text" id="undangan_nama" name="undangan_nama" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="undangan_instansi">Unit Kerja / Instansi</label>
                                                <input type="text" id="undangan_instansi" name="undangan_instansi" class="form-control" value="{{ Session('fakpanjang') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="undangan_email">Email </label>
                                                <input type="text" id="undangan_email" name="undangan_email" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="undangan_hape">Handphone </label>
                                                <input type="text" id="undangan_hape" name="undangan_hape" class="form-control" placeholder="+62xxxx">
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <a href="#" class="btn btn-danger" id="btncancelisiundangan">
                                                            <i class="fa fa-close"></i><span class="pull-left"> Cancel</span>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a href="#" class="btn btn-success" id="btnsimpanundangan">
                                                            <i class="fa fa-save"></i><span class="pull-right"> Save</span>
                                                        </a>
                                                    </div>
                                                    <input type="hidden" id="undangan_idne" name="undangan_idne" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div id="gridundangan"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="anggaran">
                                    <div id="divawal">
                                        <div class="row">
                                            <div class="col-12 col-sm-6 col-md-6">
                                                <div class="info-box">
                                                    <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-download"></i></span>
                                                    <div class="info-box-content">
                                                        <a href="#" id="topbtnpemasukan"><span class="info-box-text">Input Penerimaan</span></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-6">
                                                <div class="info-box">
                                                    <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-external-link-square"></i></span>
                                                    <div class="info-box-content">
                                                        <a href="#" id="topbtnpengeluaran"><span class="info-box-text">Input Pengeluaran</span></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div id="gridreportblnini"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-success" id="modalpemasukan">
                                        <div class="card-header">
                                            <h3 class="card-title">Input Data Penerimaan</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool btnkembali" title="Close"><i class="fa fa-ban"></i></button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="in_tanggal">Tanggal</label>
                                                <div class="input-group date" data-target-input="nearest">
                                                    <input value="{{date('Y-m-d')}}" type="text" class="form-control" id="in_tanggal" name="in_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <input type="text" id="in_deskripsi" name="in_deskripsi" class="form-control">			  
                                            </div>
                                            <div class="form-group">
                                                <label>Total</label>
                                                <input type="text" id="in_total" name="in_total" class="form-control">			  
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="button" class="btn btn-danger pull-right btnkembali">Batalkan</button>
                                            <button type="button" class="btn btn-primary" id="btnsimpanpemasukan">SIMPAN</button>
                                        </div>
                                    </div>
                                    <div class="card card-success" id="modalpengeluaran">
                                        <div class="card-header">
                                            <h3 class="card-title">Input Data Pengeluaran</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool btnkembali" title="Close"><i class="fa fa-ban"></i></button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="out_tanggal">Tanggal</label>
                                                <div class="input-group date" data-target-input="nearest">
                                                    <input value="{{date('Y-m-d')}}" type="text" class="form-control" id="out_tanggal" name="out_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <input type="text" id="out_deskripsi" name="out_deskripsi" class="form-control">			  
                                            </div>
                                            <div class="form-group">
                                                <label>Total</label>
                                                <input type="text" id="out_total" name="out_total" class="form-control">			  
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="button" class="btn btn-danger pull-right btnkembali">Batalkan</button>
                                            <button type="button" class="btn btn-primary" id="btnsimpanpengeluaran">SIMPAN</button>
                                        </div>
                                    </div>
                                    <div class="card card-success" id="modaleditor">
                                        <div class="card-header">
                                            <h3 class="card-title">Editor Data</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool btnkembali" title="Close"><i class="fa fa-ban"></i></button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="edit_tanggal">Tanggal</label>
                                                <div class="input-group date" data-target-input="nearest">
                                                    <input value="{{date('Y-m-d')}}" type="text" class="form-control" id="edit_tanggal" name="edit_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <input type="text" id="edit_deskripsi" name="edit_deskripsi" class="form-control">			  
                                            </div>
                                            <div class="form-group">
                                                <label>Total</label>
                                                <input type="text" id="edit_total" name="edit_total" class="form-control">			  
                                            </div>
                                            <div class="form-group">
                                                <label>Alasan Di Edit / Di Hapus</label>
                                                <input type="text" id="edit_alasan" name="edit_alasan" class="form-control">			  
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <input type="hidden" id="edit_id" name="edit_id" class="form-control">
                                            <input type="hidden" id="edit_nama" name="edit_nama" class="form-control" value="{{ Session('email') }}">
                                            <button type="button" class="btn btn-danger pull-right btnkembali">Batalkan</button>
                                            <button type="button" class="btn btn-primary" id="btnsimpanedit">Simpan Perubahan</button>
                                            <button type="button" class="btn btn-danger" id="btnsimpanhapus">Hapus Data</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="layout">
                                    <div class="card card-danger shadow">
                                        <div class="card-header">
                                            <h3 class="card-title">Layout</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="layout_filelampiran">Upload File</label>
                                                            <input type="file" id="layout_filelampiran" name="layout_filelampiran" class="btn-light">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a href="#" class="btn btn-success" id="btnuploadlayout">
                                                            <i class="fa fa-save"></i><span class="pull-right"> Save</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            @if($datane->sertifikatdepan == '' OR $datane->sertifikatdepan == null)
                                                <img width="100%" src="{{ asset('boxed-bg.png') }}" alt="User Avatar" id="previewlayout">
                                            @else
                                                <img width="100%" src="{!! $datane->sertifikatdepan !!}" alt="User Avatar" id="previewlayout">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3" id="divtiga">
                    <div class="card card-warning direct-chat direct-chat-warning shadow">
                        <div class="card-header">
                            <h3 class="card-title">Catatan Khusus Event Ini</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" id="btntutuptiga">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="direct-chat-messages">
                                <div id="chatbody"></div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="input-group">
                                <input type="text" name="message" id="kirimpsn" placeholder="Type Message ..." class="form-control">
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-success" id="btnkirimpesan">Send</button>
                                </span>
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
    <div id="timeremaining" class="pull-right"></div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="id_nmfile" id="id_nmfile">
<input type="hidden" name="id_ukfile" id="id_ukfile">
<input type="hidden" name="id_jnfile" id="id_jnfile">
<input type="hidden" name="mnama" id="mnama" value="{{ Session('email') }}">
<input type="hidden" name="set_idevent" id="set_idevent" value="{{ $datane->id }}">
@endsection
@push('script')
<script>
    $(function () {
		CKEDITOR.env.isCompatible = true;
		CKEDITOR.replace('tugas_deskripsi', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles", "list"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90	
		});
        CKEDITOR.replace('id_kontak');
		CKEDITOR.replace('id_pembicara');
        CKEDITOR.replace('id_linkwebinar');
        CKEDITOR.replace('id_linkmateri');
        CKEDITOR.replace('tugas_catatan');
        $('#id_tglmulaiefent').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#id_tglselesaiefent').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$("#id_jammulaiefent").timepicker({format: 'HH:mm:ss'});
		$("#id_jamselesaiefent").timepicker({format: 'HH:mm:ss'});
		$('#id_tglmulaidaftar').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#id_tglselesaidaftar').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$("#id_jammulaidaftar").timepicker({format: 'HH:mm:ss'});
		$("#id_jamselesaidaftar").timepicker({format: 'HH:mm:ss'});
		$('#id_tglmulaiabsen').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#id_tglselesaiabsen').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$("#id_jammulaiabsen").timepicker({format: 'HH:mm:ss'});
		$("#id_jamselesaiabsen").timepicker({format: 'HH:mm:ss'});
	});
	function getchatlist( jQuery ){
		var token=document.getElementById('token').value;
		$.post('{{ route("chatGetlist") }}', { _token: token, val02: '{{ $datane->id }}', val03: 'eomode'},
		function(data){
			$('#chatbody').html(data);
		});
	}
    function openedpeserta( jQuery ){
		var set01		= '{{ $datane->id }}';
        var token 		= document.getElementById('token').value;
        var source = {
            datatype: "json",
            datafields: [
                { name: 'idne'},
                { name: 'linke', type: 'text'},
                { name: 'idevent', type: 'text'},
                { name: 'nama', type: 'text'},
                { name: 'pekerjaan', type: 'text'},
                { name: 'alamat', type: 'text'},
                { name: 'negara', type: 'text'},
                { name: 'instansi', type: 'text'},
                { name: 'email', type: 'text'},
                { name: 'hape', type: 'text'},
                { name: 'daftar', type: 'text'},
                { name: 'quiz', type: 'text'},
                { name: 'presensi', type: 'text'},
                { name: 'status', type: 'text'},
                { name: 'bayar', type: 'text'},
                { name: 'foto', type: 'text'},
            ],
            type: 'POST',
            data: {val01: set01, val02: 'PANITIA', _token: token},
            url: '{{ route("getList5partisipan") }}',
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#gridpanitia").jqxGrid({
            width           : '100%',
            pageable        : true,
            autoheight      : true,
            filterable      : true,
            source          : dataAdapter,
            columnsresize   : true,
            showfilterrow   : true,
            theme           : "energyblue",
            altrows         : true,
            columns         : [
                { text: 'Edit', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
                    return "Edit";
                    }, buttonclick: function (row) {
                        editrow         = row;	
                        var offset 		= $("#gridpanitia").offset();		
                        var dataRecord 	= $("#gridpanitia").jqxGrid('getrowdata', editrow);
                        $("#panitia_nama").val(dataRecord.email).select2().trigger('change');
                        $("#panitia_sebagai").val(dataRecord.pekerjaan);
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                    }
                },
                { text: 'Nama', datafield: 'nama', width: '50%', cellsalign: 'left', align: 'center'  },
                { text: 'Position', filtertype: 'checkedlist', datafield: 'pekerjaan', width: '40%', cellsalign: 'left', align: 'center'  },
                { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
                    return "Del";
                    }, buttonclick: function (row) {
                        editrow = row;	
                        var offset 		= $("#gridpanitia").offset();		
                        var dataRecord 	= $("#gridpanitia").jqxGrid('getrowdata', editrow);
                        swal({
                            title               : 'Are you sure?',
                            text                : "You won't be able to revert this!",
                            type                : 'warning',
                            showCancelButton    : true,
                            confirmButtonClass  : 'btn btn-confirm mt-2',
                            cancelButtonClass   : 'btn btn-cancel ml-2 mt-2',
                            confirmButtonText   : 'Yes, delete it!'
                        }).then(function () {
                            var val01=dataRecord.nama;
                            var val02=dataRecord.idne;
                            var val03='';
                            var val04='';
                            var val05='';
                            var val06='';
                            var val07='';
                            var val08='';
                            var val09='';
                            var val10='';
                            var val11='';
                            var val12='';
                            var val13='';
                            var val14='';
                            var val15='';
                            var val16='';
                            var val17='';
                            var val18='';
                            var val19='';
                            var val20='hapuspeserta';
                            var token=document.getElementById('token').value;		
                            $.post('{{ route("exSaveevent") }}', { set01: val01, set02: val02, set03: val03, set04: val04, set05: val05, set06: val06, set07: val07, set08: val08, set09: val09, set10: val10, set11: val11, set12: val12, set13: val13, set14: val14, set15: val15, set16: val16, set17: val17, set18: val18, set19: val19, set20: val20, _token: token },	
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
                                    $("#gridpanitia").jqxGrid('updatebounddata', 'filter');
                                    return false;
                            });
                        });
                    }
                },
            ]
        });
        var sourceundangan = {
            datatype: "json",
            datafields: [
                { name: 'idne'},
                { name: 'linke', type: 'text'},
                { name: 'idevent', type: 'text'},
                { name: 'nama', type: 'text'},
                { name: 'pekerjaan', type: 'text'},
                { name: 'alamat', type: 'text'},
                { name: 'negara', type: 'text'},
                { name: 'instansi', type: 'text'},
                { name: 'email', type: 'text'},
                { name: 'hape', type: 'text'},
                { name: 'daftar', type: 'text'},
                { name: 'quiz', type: 'text'},
                { name: 'presensi', type: 'text'},
                { name: 'status', type: 'text'},
                { name: 'bayar', type: 'text'},
                { name: 'foto', type: 'text'},
            ],
            type: 'POST',
            data: {val01: set01, val02: 'UNDANGAN', _token: token},
            url: '{{ route("getList5partisipan") }}',
        };
        var jsonUndangan = new $.jqx.dataAdapter(sourceundangan);
        $("#gridundangan").jqxGrid({
            width           : '100%',
            pageable        : true,
            autoheight      : true,
            filterable      : true,
            source          : jsonUndangan,
            columnsresize   : true,
            showfilterrow   : true,
            theme           : "energyblue",
            altrows         : true,
            columns         : [
                { text: 'Edit', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
                    return "Edit";
                    }, buttonclick: function (row) {
                        editrow         = row;	
                        var offset 		= $("#gridundangan").offset();		
                        var dataRecord 	= $("#gridundangan").jqxGrid('getrowdata', editrow);
                        $("#undangan_nama").val(dataRecord.nama);
                        $("#undangan_instansi").val(dataRecord.instansi);
                        $("#undangan_email").val(dataRecord.email);
                        $("#undangan_hape").val(dataRecord.hape);
                        $("#undangan_idne").val(dataRecord.idne);
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        $('#divundanganadd').show();
                    }
                },
                { text: 'Nama', datafield: 'nama', width: '30%', cellsalign: 'left', align: 'center'  },
                { text: 'Instansi', filtertype: 'checkedlist', datafield: 'pekerjaan', width: '30%', cellsalign: 'left', align: 'center'  },
                { text: 'Email', datafield: 'email', width: '15%', cellsalign: 'left', align: 'center'  },
                { text: 'No.HP', datafield: 'hape', width: '15%', cellsalign: 'left', align: 'center'  },
                { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
                    return "Del";
                    }, buttonclick: function (row) {
                        editrow = row;	
                        var offset 		= $("#gridundangan").offset();		
                        var dataRecord 	= $("#gridundangan").jqxGrid('getrowdata', editrow);
                        swal({
                            title               : 'Are you sure?',
                            text                : "You won't be able to revert this!",
                            type                : 'warning',
                            showCancelButton    : true,
                            confirmButtonClass  : 'btn btn-confirm mt-2',
                            cancelButtonClass   : 'btn btn-cancel ml-2 mt-2',
                            confirmButtonText   : 'Yes, delete it!'
                        }).then(function () {
                            var val01=dataRecord.nama;
                            var val02=dataRecord.idne;
                            var val03='';
                            var val04='';
                            var val05='';
                            var val06='';
                            var val07='';
                            var val08='';
                            var val09='';
                            var val10='';
                            var val11='';
                            var val12='';
                            var val13='';
                            var val14='';
                            var val15='';
                            var val16='';
                            var val17='';
                            var val18='';
                            var val19='';
                            var val20='hapuspeserta';
                            var token=document.getElementById('token').value;		
                            $.post('{{ route("exSaveevent") }}', { set01: val01, set02: val02, set03: val03, set04: val04, set05: val05, set06: val06, set07: val07, set08: val08, set09: val09, set10: val10, set11: val11, set12: val12, set13: val13, set14: val14, set15: val15, set16: val16, set17: val17, set18: val18, set19: val19, set20: val20, _token: token },	
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
                                    $("#gridundangan").jqxGrid('updatebounddata', 'filter');
                                    return false;
                            });
                        });
                    }
                },
            ]
        });
        var sourcetugas = {
			datatype: "json",
			datafields: [
				{ name: 'idne'},
				{ name: 'keterangan', type: 'text'},
                { name: 'deskripsi', type: 'text'},
				{ name: 'status', type: 'text'},
				{ name: 'datadukung', type: 'text'},
				{ name: 'created_by', type: 'text'},
				{ name: 'updated_by', type: 'text'},
				{ name: 'created_at', type: 'text'},
				{ name: 'updated_at', type: 'text'},
			],
			type: 'POST',
			data: {val01: 'EOMODE', val02: set01, _token: token},
			url: '{{ route("getTasklist") }}',
		};
		var dataTugas = new $.jqx.dataAdapter(sourcetugas);
		$("#gridtugas").jqxGrid({
			width           : '100%',
			pageable        : true,
			autoheight      : true,
            autorowheight   : true,
			filterable      : true,
			source          : dataTugas,
			sortable        : true,
			columnsresize   : true,
			showfilterrow   : true,
			theme           : "energyblue",
			selectionmode   : 'multiplecellsextended',
			columns         : [
                { text: 'Edit', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
                    return "Edit";
                    }, buttonclick: function (row) {
                        editrow         = row;	
                        var offset 		= $("#gridtugas").offset();		
                        var dataRecord 	= $("#gridtugas").jqxGrid('getrowdata', editrow);
                        var set18       = '{{ $pembuat }}';
                        if (set18 == 'YES'){
                            CKEDITOR.instances['tugas_deskripsi'].setData(dataRecord.deskripsi)
                            $("#tugas_kelompok").val(dataRecord.created_by);
                            $("#tugas_idne").val(dataRecord.idne);
                            $('.tugasisi').show();
                            $('.tugascatatan').hide();
                            $("#tugas_file").val('');
                            $("html, body").animate({ scrollTop: 0 }, "slow");
                        } else {
                            swal({
                                title   : 'Stop',
                                text    : 'Hanya Pembuat Kegiatan ini yang di ijinkan edit data kegiatan',
                                type    : 'error',
                            })
                        }
                    }
                },
                { text: 'Catatan', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', cellsrenderer: function () {
                    return "Catatan";
                    }, buttonclick: function (row) {
                        editrow         = row;	
                        var offset 		= $("#gridtugas").offset();		
                        var dataRecord 	= $("#gridtugas").jqxGrid('getrowdata', editrow);
                        CKEDITOR.instances['tugas_catatan'].setData(dataRecord.keterangan)
                        $("#tugas_idne").val(dataRecord.idne);
                        $('.tugascatatan').show();
                        $('.tugasisi').hide();
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                    }
                },
				{ text: 'Tugas', datafield: 'deskripsi', width: '37%', cellsalign: 'left', align: 'center'  },
				{ text: 'Kelompok', datafield: 'created_by', width: '13%', cellsalign: 'left', align: 'center'  },
				{ text: 'File Pendukung', editable: false, sortable: false, filterable: false, datafield: 'datadukung', width: '8%', cellsalign: 'left', align: 'center'  },
                { text: 'Catatan', datafield: 'keterangan', width: '25%', cellsalign: 'left', align: 'center'  },
                { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
                    return "Del";
                    }, buttonclick: function (row) {
                        editrow = row;	
                        var offset 		= $("#gridtugas").offset();		
                        var dataRecord 	= $("#gridtugas").jqxGrid('getrowdata', editrow);
                        var set18       = '{{ $pembuat }}';
                        if (set18 == 'YES'){
                            swal({
                                title               : 'Are you sure?',
                                text                : "You won't be able to revert this!",
                                type                : 'warning',
                                showCancelButton    : true,
                                confirmButtonClass  : 'btn btn-confirm mt-2',
                                cancelButtonClass   : 'btn btn-cancel ml-2 mt-2',
                                confirmButtonText   : 'Yes, delete it!'
                            }).then(function () {
                                var token=document.getElementById('token').value;		
                                $.post('{{ route("exTaskadd") }}', { val01: 'TASKEODEL', val02: dataRecord.idne,  _token: '{{csrf_token()}}' },	
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
                                        $("#gridtugas").jqxGrid('updatebounddata', 'filter');
                                        return false;
                                });
                            });
                        } else {
                            swal({
                                title   : 'Stop',
                                text    : 'Hanya Pembuat Kegiatan ini yang di ijinkan edit data kegiatan',
                                type    : 'error',
                            })
                        }
                    }
                },
			]
		});
        var sourceanggaran = {
			datatype: "json",
			datafields: [
				{ name: 'id',type: 'text'},	
                { name: 'tanggal',type: 'text'},
                { name: 'bulan',type: 'text'},
                { name: 'tahun',type: 'text'},
                { name: 'deskripsi',type: 'text'},
                { name: 'pemasukan',type: 'text'},
                { name: 'pengeluaran',type: 'text'},
                { name: 'jenis',type: 'text'},
                { name: 'keterangan',type: 'text'},
                { name: 'tgllengkap',type: 'text'},
                { name: 'total',type: 'text'},
                { name: 'kunci',type: 'text'},
			],
			type: 'POST',
			data: { val01: set01, _token: token},
			url : '{{ route("getDatakeuanganEO") }}',
		};
		var datakeuangan = new $.jqx.dataAdapter(sourceanggaran);
        $("#gridreportblnini").jqxGrid({
            width               : '100%',
            showfilterrow       : true,
            filterable          : true,
            columnsresize       : true,
            autoshowfiltericon  : true,
            pageable            : true,
            autoheight          : true,
            theme               : "energyblue",
            source              : datakeuangan,
            selectionmode       : 'multiplecellsextended',
            columns             : [
                { text: 'dd', columngroup: 'tglinput', filtertype: 'checkedlist', datafield: 'tanggal', width: '6%', cellsalign: 'center', align: 'center' },
                { text: 'mm', columngroup: 'tglinput', filtertype: 'checkedlist', datafield: 'bulan', width: '6%', cellsalign: 'center', align: 'center' },
                { text: 'yy', columngroup: 'tglinput', filtertype: 'checkedlist', datafield: 'tahun', width: '8%', cellsalign: 'center', align: 'center' },
                { text: 'Jenis', datafield: 'jenis', filtertype: 'checkedlist', width: '12%', cellsalign: 'center', align: 'center' },
                { text: 'Deskripsi', datafield: 'deskripsi', width: '15%', cellsalign: 'left', align: 'center' },
                { text: 'DEBET', datafield: 'pemasukan', width: '12%', cellsalign: 'right', align: 'center' },
                { text: 'KREDIT', datafield: 'pengeluaran', width: '12%', cellsalign: 'right', align: 'center' },
                { text: 'Keterangan', datafield: 'keterangan', width: '14%', cellsalign: 'right', align: 'center' },
                { text: 'Edit', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', cellsrenderer: function () {
                    return "Edit";
                    }, buttonclick: function (row) {	
                        editrow = row;	
                        var offset 		= $("#gridreportblnini").offset();		
                        var dataRecord 	= $("#gridreportblnini").jqxGrid('getrowdata', editrow);
                        var kunci       = dataRecord.kunci;
                        if (kunci == 'yes'){
                            swal({
                                title: 'Stop',
                                text: 'Data yang telah di validasi tidak bisa diubah kembali',
                                type: 'warning',
                            })
                        } else {
                            $("#edit_deskripsi").val(dataRecord.deskripsi);
                            $("#edit_id").val(dataRecord.id);
                            $("#edit_pos").val(dataRecord.jenis);
                            $("#edit_total").val(dataRecord.total);
                            $("#edit_tanggal").val(dataRecord.tgllengkap);
                            $("#modalvalidasi").hide();
                            $("#modalpemasukan").hide();
                            $("#modalpengeluaran").hide();
                            $("#modaleditor").show();
                            $("#modalpinjaman").hide();
                            $("#modalbyrhutang").hide();
                            $("#divawal").hide();
                        }
                    }
                },
                { text: 'Kwitansi', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', cellsrenderer: function () {
                    return "View";
                    }, buttonclick: function (row) {	
                        editrow = row;	
                        var offset 		= $("#gridreportblnini").offset();		
                        var dataRecord 	= $("#gridreportblnini").jqxGrid('getrowdata', editrow);
                        window.open("{{URL::to("/")}}/ctkkwt/"+dataRecord.id, '_blank');
                    }
                },
            ],
            columngroups:
            [
                { text: 'Tanggal', align: 'center', name: 'tglinput' },                
            ]
        });
	}
    function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.readAsDataURL(input.files[0]);
			reader.onload = function (e) {
				$('#previewlayout').attr('src', e.target.result);
			};
		}
	}
	var start = new Date();
	CountDownTimer(start, 'timeremaining');
	function CountDownTimer(dt, id) {
		var end 	= new Date(dt.getTime() + 60000);
		var _second = 1000;
		var _minute = _second * 60;
		var _hour 	= _minute * 60;
		var _day 	= _hour * 24;
		var timer;
		function showRemaining() {
			var now = new Date();
			var distance = end - now;
			if (distance < 0) {
				clearInterval(timer);
				var start = new Date();
				CountDownTimer(start, 'timeremaining');
				getchatlist();
				getnotifcount();
				return;
			}
			var days = Math.floor(distance / _day);
			var hours = Math.floor((distance % _day) / _hour);
			var minutes = Math.floor((distance % _hour) / _minute);
			var seconds = Math.floor((distance % _minute) / _second);
			document.getElementById(id).innerHTML ='Refresh in ';
			document.getElementById(id).innerHTML += seconds + 'secs';
		}
		timer = setInterval(showRemaining, 1000);
	}
$(document).ready(function () {
	getnotifcount();
    getchatlist();
    openedpeserta();
	$('.select2').select2({width: '100%'});
    $('#loading').hide();
	$('#divundanganadd').hide();
    $('#divdisposisi').hide();
    $('#divkalender').show();
    $('.tugasisi').hide();
    $('.tugascatatan').hide();
    $("#modalpemasukan").hide();
	$("#modalpengeluaran").hide();
	$("#modaleditor").hide();
	$("#in_total").autoNumeric(
		'init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'}
	);
	$("#out_total").autoNumeric(
		'init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'}
	);
	$("#edit_total").autoNumeric(
		'init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'}
	);
    $("#topbtnpemasukan").click(function(){ 
        $("#loading").hide();
        $("#modalpemasukan").show();
        $("#modalpengeluaran").hide();
        $("#modaleditor").hide();
        $("#divawal").hide();
    });
	$("#topbtnpengeluaran").click(function(){ 
        $("#loading").hide();
        $("#modalpemasukan").hide();
        $("#modalpengeluaran").show();
        $("#modaleditor").hide();
        $("#divawal").hide();
    });
    $("#btnsimpanpemasukan").click(function(){
		$("#loading").show();
        $("#modalvalidasi").hide();
        $("#modalpemasukan").hide();
        $("#modalpengeluaran").hide();
        $("#modaleditor").hide();
        $("#modalpinjaman").hide();
        $("#modalbyrhutang").hide();
		var val01=document.getElementById('in_deskripsi').value;
		var val02='EO';	
		var val03=document.getElementById('in_tanggal').value;
		var val04=document.getElementById('in_total').value;
		var val05='pemasukan';
		var val06='';
		var val07='';
		var val08='';
        var val10='{{ $datane->id }}';
		var token=document.getElementById('token').value;
		$.post('{{ route("simpanTransaksi") }}', { _token: token, set01: val01, set02: val02, set03: val03, set04: val04, set05: val05, set06: val06, set07: val07, set08: val08, set10: val10 },
		function(data){
            $("#loading").hide();
			$("#divawal").show();
            $("#divawalpeminjaman").show();
			$("#message").html(data);	
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$("#gridreportblnini").jqxGrid('updatebounddata');
			return false;
		});	
	});
	$("#btnsimpanpengeluaran").click(function(){
		$("#loading").show();
        $("#modalvalidasi").hide();
        $("#modalpemasukan").hide();
        $("#modalpengeluaran").hide();
        $("#modaleditor").hide();
        $("#modalpinjaman").hide();
        $("#modalbyrhutang").hide();
		var val01=document.getElementById('out_deskripsi').value;
		var val02='EO';	
		var val03=document.getElementById('out_tanggal').value;
		var val04=document.getElementById('out_total').value;
		var val05='pengeluaran';
		var val06='';
		var val07='';
		var val08='';
		var val10='{{ $datane->id }}';
		var token=document.getElementById('token').value;
		$.post('{{ route("simpanTransaksi") }}', { _token: token, set01: val01, set02: val02, set03: val03, set04: val04, set05: val05, set06: val06, set07: val07, set08: val08, set10: val10 },
		function(data){
			$("#loading").hide();
			$("#divawal").show();
            $("#divawalpeminjaman").show();
			$("#message").html(data);
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$("#gridreportblnini").jqxGrid('updatebounddata');
			return false;
		});	
	});
    $("#btnsimpanedit").click(function(){
		$("#loading").show();
        $("#modalvalidasi").hide();
        $("#modalpemasukan").hide();
        $("#modalpengeluaran").hide();
        $("#modaleditor").hide();
        $("#modalpinjaman").hide();
        $("#modalbyrhutang").hide();
		var val01=document.getElementById('edit_deskripsi').value;
		var val02='EO';	
		var val03=document.getElementById('edit_tanggal').value;
		var val04=document.getElementById('edit_total').value;
		var val05='editor';
		var val06=document.getElementById('edit_id').value;
		var val07=document.getElementById('edit_alasan').value;
		var val08=document.getElementById('edit_nama').value;
		var val10='{{ $datane->id }}';
		var token=document.getElementById('token').value;
		$.post('{{ route("simpanTransaksi") }}', { _token: token, set01: val01, set02: val02, set03: val03, set04: val04, set05: val05, set06: val06, set07: val07, set08: val08, set10: val10 },
		function(data){
            $("#loading").hide();
			$("#divawal").show();
            $("#divawalpeminjaman").show();
			$("#message").html(data);
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$("#gridreportblnini").jqxGrid('updatebounddata');
			$("#gridsaldotiappos").jqxGrid('updatebounddata', 'filter');
			$("#gridpinjaman").jqxGrid('updatebounddata');
			return false;
		});	
	});
    $("#btnsimpanhapus").click(function(){
		$("#loading").show();
        $("#modalvalidasi").hide();
        $("#modalpemasukan").hide();
        $("#modalpengeluaran").hide();
        $("#modaleditor").hide();
        $("#modalpinjaman").hide();
        $("#modalbyrhutang").hide();
		var val01=document.getElementById('edit_deskripsi').value;
		var val02=document.getElementById('edit_pos').value;	
		var val03=document.getElementById('edit_tanggal').value;
		var val04=document.getElementById('edit_total').value;
		var val05='hapus';
		var val06=document.getElementById('edit_id').value;
		var val07=document.getElementById('edit_alasan').value;
		var val08=document.getElementById('edit_nama').value;
		var token=document.getElementById('token').value;
		$.post('{{ route("simpanTransaksi") }}', { _token: token, set01: val01, set02: val02, set03: val03, set04: val04, set05: val05, set06: val06, set07: val07, set08: val08 },
		function(data){
            $("#loading").hide();
			$("#divawal").show();
            $("#divawalpeminjaman").show();
			$("#message").html(data);
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$("#gridreportblnini").jqxGrid('updatebounddata');
			$("#gridsaldotiappos").jqxGrid('updatebounddata', 'filter');
			$("#gridpinjaman").jqxGrid('updatebounddata');
			return false;
		});	
	});
    $('#tugas_file').change(function () {
        var imgPath = this.value;
        var ukfile 	= this.files[0].size;
        var ext 	= imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        if(ext == "pdf" || ext == "PDF") {
			$("#id_jnfile").val(ext);
        	$("#id_ukfile").val(ukfile);
        } else {
			$("#tugas_file").val('');
        	swal({
				title	: 'Stop',
				text	: 'Extension '+ext+' Tidak di perkenankan',
				type	: 'warning',
			})
        }
    });
    $("#btnsimpanlistisitugas").click(function(){
        var set01 	= document.getElementById('tugas_file');
        var set02	= document.getElementById('tugas_kelompok').value;
        var set03	= CKEDITOR.instances['tugas_deskripsi'].getData()
        var token 	= document.getElementById('token').value;
        var set18   = '{{ $pembuat }}';
        if (set18 == 'YES'){
            if (set02 == '' || set03 == ''){ 
                swal({
                    title   : 'Mohon lengkapi',
                    text    : 'Deskrips Tugas Tidak Boleh Kosong',
                    type    : 'info',
                });
            } else {
                $('.tugasisi').hide();
                $('.tugascatatan').hide();
                var form_data = new FormData();
                    form_data.append('file', set01.files[0]);
                    form_data.append('val01', 'TASKEO');
                    form_data.append('val02', set03);
                    form_data.append('val03', set02);
                    form_data.append('val04', document.getElementById('tugas_idne').value);
                    form_data.append('val05', '{{ $datane->id }}');
                    form_data.append('_token', '{{csrf_token()}}');
                $.ajax({
                    url         : '{{ route("exTaskadd") }}',
                    data        : form_data,
                    type        : 'POST',
                    contentType : false,
                    processData : false,
                    success     : function (data) {
                        var status  = data.status;
                        var message = data.message;
                        var warna 	= data.warna;
                        var icon 	= data.icon;
                        $("#gridtugas").jqxGrid('updatebounddata');
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
                        swal({
                            title: 'Error..!!!',
                            text: xhr.responseText,
                            type: 'info',
                        });
                    }
                });
            }
        } else {
            swal({
                title   : 'Stop',
                text    : 'Hanya Pembuat Kegiatan ini yang di ijinkan edit data kegiatan',
                type    : 'error',
            })
        }
    });
    $("#btnsimpancatatantugas").click(function(){
        var set03	= CKEDITOR.instances['tugas_catatan'].getData()
        if (set03 == '') {
            swal({
                title   : 'Stop',
                text    : 'Catatan Tidak Boleh Kosong',
                type    : 'error',
            })
        } else {
            $('.tugasisi').hide();
            $('.tugascatatan').hide();
            var form_data = new FormData();
                form_data.append('file', null);
                form_data.append('val01', 'TASKEOCATATAN');
                form_data.append('val02', set03);
                form_data.append('val03', '');
                form_data.append('val04', document.getElementById('tugas_idne').value);
                form_data.append('val05', '{{ $datane->id }}');
                form_data.append('_token', '{{csrf_token()}}');
            $.ajax({
                url         : '{{ route("exTaskadd") }}',
                data        : form_data,
                type        : 'POST',
                contentType : false,
                processData : false,
                success     : function (data) {
                    var status  = data.status;
                    var message = data.message;
                    var warna 	= data.warna;
                    var icon 	= data.icon;
                    $("#gridtugas").jqxGrid('updatebounddata');
                    $.toast({
                        heading     : status,
                        text        : message,
                        position    : 'top-right',
                        loaderBg    : warna,
                        icon        : icon,
                        hideAfter   : 5000,
                        stack       : 1
                    });	
                    return false;
                },
                error: function (xhr, status, error) {
                    swal({
                        title: 'Error..!!!',
                        text: xhr.responseText,
                        type: 'error',
                    });
                }
            });
        }
    });
    $("#topbtntambahundangan").click(function(){
        $('#divundanganadd').show();
        $("#undangan_idne").val('new');
    });
    $("#btnsimpanundangan").click(function(){
        var form_data = new FormData();
            form_data.append('file', null);
            form_data.append('set01', document.getElementById('undangan_nama').value);
            form_data.append('set02', 'UNDANGAN');
            form_data.append('set03', "{{Session('addressapps01')}}");
            form_data.append('set04', 'INDONESIA');
            form_data.append('set05', document.getElementById('undangan_instansi').value);
            form_data.append('set06', document.getElementById('undangan_email').value);
            form_data.append('set07', '{{ $datane->id }}');
            form_data.append('set08', document.getElementById('undangan_hape').value);
            form_data.append('_token', '{{csrf_token()}}');
            $('#divundanganadd').hide();
        $.ajax({
            url: '{{route("exRegisterevent")}}',
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
                $("html, body").animate({ scrollTop: 0 }, "slow");
                $("#gridundangan").jqxGrid('updatebounddata', 'filter');
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
    });
    $("#btncancelisiundangan").click(function(){
        $('#divundanganadd').hide();
        $("#undangan_idne").val('new');
    });
    $("#topbtntambahtugas").click(function(){
        $('.tugasisi').show();
        $("#tugas_file").val('');
        $("#tugas_idne").val('new');
    });
    $("#btncancelisitugas").click(function(){
        $('.tugasisi').hide();
        $('.tugascatatan').hide();
        $("#tugas_file").val('');
        $("#tugas_idne").val('new');
    });
    $("#btncancelisicatatan").click(function(){
        $('.tugasisi').hide();
        $('.tugascatatan').hide();
        $("#tugas_file").val('');
        $("#tugas_idne").val('new');
    });
    $('#btnsimpanpanitia').click(function () {
        var set01='new';
        var set02='';
        var set03='{{ $datane->id }}';
        var set04='';
        var set05='';
        var set06=document.getElementById('panitia_nama').value;
        var set07=document.getElementById('panitia_sebagai').value;
        var set10='';
        var set11='';
        var set08='';
        var set12='';
        var set13='';
        var set14='';
        var set15='';
        var set16='';
        var set17='';
        var set18='{{ $pembuat }}';
        if (set18 == 'YES'){
            var form_data = new FormData();
                form_data.append('val01', set03);
                form_data.append('val02', set02);
                form_data.append('val03', 'PANITIA');
                form_data.append('val04', set04);
                form_data.append('val05', set05);
                form_data.append('val06', set06);
                form_data.append('val07', set07);
                form_data.append('val08', set08);
                form_data.append('val09', '');
                form_data.append('val10', set10);
                form_data.append('val11', set11);
                form_data.append('val12', set12);
                form_data.append('val13', set13);
                form_data.append('val14', set14);
                form_data.append('val15', set15);
                form_data.append('val16', set16);
                form_data.append('val17', set17);
                form_data.append('val18', '');
                form_data.append('_token', '{{csrf_token()}}');
            $.ajax({
                url         : '{{ route("exPresensiwebinar") }}',
                data        : form_data,
                type        : 'POST',
                contentType : false,
                processData : false,
                success     : function (data) {
                    var status  = data.status;
                    var message = data.message;
                    var warna 	= data.warna;
                    var icon 	= data.icon;
                    $.toast({
                        heading     : status,
                        text        : message,
                        position    : 'top-right',
                        loaderBg    : warna,
                        icon        : icon,
                        hideAfter   : 3000,
                        stack       : 1
                    });
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $("#gridpanitia").jqxGrid('updatebounddata', 'filter');
                    return false; 
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        } else {
            swal({
                title   : 'Stop',
                text    : 'Hanya Pembuat Kegiatan ini yang di ijinkan edit data kegiatan',
                type    : 'error',
            })
        }
    });
    $("#btnuploadlayout").click(function(){
        var set01 	= document.getElementById('layout_filelampiran');
        var set18   = '{{ $pembuat }}';
        if (set18 == 'YES'){
            if ($('#layout_filelampiran').val() == ''){
                swal({
                    title   : 'Mohon lengkapi',
                    text    : 'Mohon Pilih File Terlebih Dahulu',
                    type    : 'info',
                });
            } else {
                $('.tugasisi').hide();
                $('.tugascatatan').hide();
                var form_data = new FormData();
                    form_data.append('file', set01.files[0]);
                    form_data.append('val01', 'TASKEOLAYOUT');
                    form_data.append('val02', '');
                    form_data.append('val03', '');
                    form_data.append('val04', '');
                    form_data.append('val05', '{{ $datane->id }}');
                    form_data.append('_token', '{{csrf_token()}}');
                $.ajax({
                    url         : '{{ route("exTaskadd") }}',
                    data        : form_data,
                    type        : 'POST',
                    contentType : false,
                    processData : false,
                    success     : function (data) {
                        var status  = data.status;
                        var message = data.message;
                        var warna 	= data.warna;
                        var icon 	= data.icon;
                        $("#gridtugas").jqxGrid('updatebounddata');
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
                        swal({
                            title: 'Error..!!!',
                            text: xhr.responseText,
                            type: 'info',
                        });
                    }
                });
            }
        } else {
            swal({
                title   : 'Stop',
                text    : 'Hanya Pembuat Kegiatan ini yang di ijinkan edit data kegiatan',
                type    : 'error',
            })
        }
    });
    $('#layout_filelampiran').change(function () {
			if(this.files[0].size > 700000){
				this.value = "";
				swal({
					title	: 'Stop',
					text	: 'File is too big!',
					type	: 'warning',
				})
			} else {
				var imgPath = this.value;
				var ukfile 	= this.files[0].size;
				var ext 	= imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
				if(ext == "jpg" || ext == "jpeg" || ext == "png") {
					readURL(this);
				} else {
					this.value = "";
					swal({
						title	: 'Stop',
						text	: 'Please select image file (jpg, jpeg, png).',
						type	: 'warning',
					})
				}
			}
		});
    $('#btnkirimpesan').on('click', function (){
        $('#btnkirimpesan').hide();
        var kirim   = document.getElementById('kirimpsn').value;
        var nama    = "{{ Session('nama') }}";
        var idevent = '{{ $datane->id }}';
        var foto    = '{{ $foto }}';
        $.post('{{ route("cattingSurat") }}', { val01: kirim, val02: nama, val03: foto, idevent: idevent, _token: '{{ csrf_token() }}' }, function(data){
            $('#btnkirimpesan').show();
            $('#chatbody').html(data);
        });
    });
    $(".btnsimpan").click(function(){
        var val01=document.getElementById('id_namaefent').value;
        var val02=document.getElementById('id_tempat').value;
        var val03=document.getElementById('id_kapasitas').value;
        var val04=document.getElementById('id_biaya').value;
        var val05=document.getElementById('id_tglmulaiefent').value;
        var val06=document.getElementById('id_jammulaiefent').value;
        var val07=document.getElementById('id_tglselesaiefent').value;
        var val08=document.getElementById('id_jamselesaiefent').value;
        var val09=document.getElementById('id_tglmulaidaftar').value;
        var val10=document.getElementById('id_jammulaidaftar').value;
        var val11=document.getElementById('id_tglselesaidaftar').value;
        var val12=document.getElementById('id_jamselesaidaftar').value;
        var val13=document.getElementById('id_tglmulaiabsen').value;
        var val14=document.getElementById('id_jammulaiabsen').value;
        var val15=document.getElementById('id_tglselesaiabsen').value;
        var val16=document.getElementById('id_jamselesaiabsen').value;
        var val17=CKEDITOR.instances['id_kontak'].getData()
        var val18=CKEDITOR.instances['id_pembicara'].getData()
        var val19=CKEDITOR.instances['id_linkwebinar'].getData()
        var val20='{{ $datane->id }}';
        var val21=null;
        var val22=null;
        var val23=CKEDITOR.instances['id_linkmateri'].getData()
        var val24='{{ $pembuat }}';
        var token=document.getElementById('token').value;
        if (val24 == 'YES'){
            var form_data = new FormData();
                form_data.append('depan', null);
                form_data.append('belakang', null);
                form_data.append('set01', val01);
                form_data.append('set02', val02);
                form_data.append('set03', val03);
                form_data.append('set04', val04);
                form_data.append('set05', val05);
                form_data.append('set06', val06);
                form_data.append('set07', val07);
                form_data.append('set08', val08);
                form_data.append('set09', val09);
                form_data.append('set10', val10);
                form_data.append('set11', val11);
                form_data.append('set12', val12);
                form_data.append('set13', val13);
                form_data.append('set14', val14);
                form_data.append('set15', val15);
                form_data.append('set16', val16);
                form_data.append('set17', val17);
                form_data.append('set18', val18);
                form_data.append('set19', val19);
                form_data.append('set20', val20);
                form_data.append('set21', val23);
                form_data.append('_token', '{{csrf_token()}}');
            $.ajax({
                url         : '{{ route("exSaveevent") }}',
                data        : form_data,
                type        : 'POST',
                contentType : false,
                processData : false,
                success     : function (data) {
                    var status  = data.status;
                    var message = data.message;
                    var warna 	= data.warna;
                    var icon 	= data.icon;
                    $.toast({
                        heading     : status,
                        text        : message,
                        position    : 'top-right',
                        loaderBg    : warna,
                        icon        : icon,
                        hideAfter   : 3000,
                        stack       : 1
                    });
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    return false;
                },
                error: function (xhr, status, error) {
                    swal({
                        title: 'Stop',
                        text: xhr.responseText,
                        type: 'warning',
                    })
                }
            });
        } else {
            swal({
                title   : 'Stop',
                text    : 'Hanya Pembuat Kegiatan ini yang di ijinkan edit data kegiatan',
                type    : 'error',
            })
        }
    });
    $("#id_jammulaiefent").val('{{$jammulai}}');
    $("#id_jamselesaiefent").val('{{$jamakhir}}');
    $("#id_jammulaidaftar").val('{{$jammulai2}}');
    $("#id_jamselesaidaftar").val('{{$jamakhir2}}');
    $("#id_jammulaiabsen").val('{{$jammulai3}}');
    $("#id_jamselesaiabsen").val('{{$jamakhir3}}');
});
</script>
@endpush