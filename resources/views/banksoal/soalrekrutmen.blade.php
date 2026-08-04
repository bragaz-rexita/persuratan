@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>@if (isset($namaapps01)){{ $namaapps01 }}@else{{ config('global.Title') }}@endif</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-3 divawal">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Control</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item"><a href="#" class="nav-link" id="btnviewskdonly"><i class="fa fa-pencil"></i> Kompetensi Dasar <span class="badge badge-primary float-right">{{$skd}}</span></a></li>
                            <li class="nav-item"><a href="#" class="nav-link" id="btnviewskbonly"><i class="fa fa-check-square-o"></i> Kompetensi Bidang<span class="badge badge-primary float-right">{{$skb}}</span></a></li>
                            <li class="nav-item"><a href="#" class="nav-link" id="btnarsip"><i class="fa fa-clone"></i> Arsip<span class="badge badge-primary float-right">{{$arsip}}</span></a></li>
                            <li class="nav-item"><a href="#" class="nav-link" id="btnexport"><i class="fa fa-print"></i> Export</a></li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        Rekapitulasi Kelompok
                        @if(isset($rekap) AND !empty($rekap))
                            <ul class="nav nav-pills flex-column">
                            @foreach ($rekap as $rows)
                                <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-pencil"></i> {{$rows->ceel}} <span class="badge badge-primary float-right">{{$rows->jumlah}}</span></a></li>
                            @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-9 divawal">
                <div id="enteni">
                    <img src="{{ asset('dist/img/loading.gif') }}" class="img-responsive" alt="Photo">
                </div>
                <div class="card card-success card-outline" id="diveditsoal">
                    <div class="card-header">
                        <h3 class="card-title">Add/Edit/Remove</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool btnkembali"><i class="fa fa-close"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <label>Status</label>
                                    <select id="id_ceel" class="form-control">
                                        <option value="KD">Kompetensi Dasar</option>
                                        <option value="KB">Kompetensi Bidang</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <label>Kelompok Soal</label>
                                    <input type="text" class="form-control" id="id_code" placeholder="Kelompok Soal">
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <label for="id_tipe">Type Soal</label>
                                    <select id="id_tipe" class="form-control">
                                        <option value="choice">Multiple Choice</option>
                                        <option value="esay">Esay (Option A as Key)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="id_deskripsi">Case Deskription</label>
                            <textarea id="id_deskripsi" rows="15" cols="20"></textarea>
                        </div>
                        <div class="form-group choice">
                            <div class="row">
                                <div class="col-lg-4 col-md-4" id="divopsia">
                                    <label for="id_optiona" id="labelopsia">Option A</label>
                                    <textarea id="id_optiona" rows="5" cols="20"></textarea>
                                </div>
                                <div class="col-lg-4 col-md-4 esay">
                                    <label for="id_optionb">Option B</label>
                                    <textarea id="id_optionb" rows="5" cols="20"></textarea>
                                </div>
                                <div class="col-lg-4 col-md-4 esay">
                                    <label for="id_optionc">Option C</label>
                                    <textarea id="id_optionc" rows="5" cols="20"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group choice">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 esay">
                                    <label for="id_optiond">Option D</label>
                                    <textarea id="id_optiond" rows="5" cols="20"></textarea>
                                </div>
                                <div class="col-lg-4 col-md-4 esay">
                                    <label for="id_optione">Option E</label>
                                    <textarea id="id_optione" rows="5" cols="20"></textarea>
                                </div>
                                <div class="col-lg-4 col-md-4 esay">
                                    <label for="id_keys">Keys</label>
                                    <select id="id_keys" class="form-control">
                                        <option value="">Please Select</option>
                                        <option value="A">Option A</option>
                                        <option value="B">Option B</option>
                                        <option value="C">Option C</option>
                                        <option value="D">Option D</option>
                                        <option value="E">Option E</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2" >
                                    <button class="btn btn-success pull-right" type="button" id="btnopenimage1"><i class="fa fa-instagram"></i></button>
                                    <button class="btn btn-warning pull-left" type="button" id="btnremoveimage1"><i class="fa fa-close"></i></button>
                                    <a href="{{ url('/') }}/boxed-bg.png" id="imagenumber1" data-toggle="lightbox" data-title="Picture 01" data-gallery="gallery">
                                        <img id="preview" src="{{ url('/') }}/boxed-bg.png?text=Pic1" class="img-fluid mb-2" alt="white sample" />
                                    </a>
                                </div>
                                <div class="col-sm-2" >
                                    <button class="btn btn-success pull-right" type="button" id="btnopenimage2"><i class="fa fa-instagram"></i></button>
                                    <button class="btn btn-warning pull-left" type="button" id="btnremoveimage2"><i class="fa fa-close"></i></button>
                                    <a href="{{ url('/') }}/boxed-bg.png" id="imagenumber2" data-toggle="lightbox" data-title="Picture 02" data-gallery="gallery">
                                        <img id="preview2" src="{{ url('/') }}/boxed-bg.png?text=Pic2" class="img-fluid mb-2" alt="white sample" />
                                    </a>
                                </div>
                                <div class="col-sm-2" >
                                    <button class="btn btn-success pull-right" type="button" id="btnopenimage3"><i class="fa fa-instagram"></i></button>
                                    <button class="btn btn-warning pull-left" type="button" id="btnremoveimage3"><i class="fa fa-close"></i></button>
                                    <a href="{{ url('/') }}/boxed-bg.png" id="imagenumber3" data-toggle="lightbox" data-title="Picture 03" data-gallery="gallery">
                                        <img id="preview3" src="{{ url('/') }}/boxed-bg.png?text=Pic3" class="img-fluid mb-2" alt="white sample" />
                                    </a>
                                </div>
                                <div class="col-sm-2" >
                                    <button class="btn btn-success pull-right" type="button" id="btnopenimage4"><i class="fa fa-instagram"></i></button>
                                    <button class="btn btn-warning pull-left" type="button" id="btnremoveimage4"><i class="fa fa-close"></i></button>
                                    <a href="{{ url('/') }}/boxed-bg.png" id="imagenumber4" data-toggle="lightbox" data-title="Picture 04" data-gallery="gallery">
                                        <img id="preview4" src="{{ url('/') }}/boxed-bg.png?text=Pic4" class="img-fluid mb-2" alt="white sample" />
                                    </a>
                                </div>
                                <div class="col-sm-2" >
                                    <button class="btn btn-success pull-right" type="button" id="btnopenimage5"><i class="fa fa-instagram"></i></button>
                                    <button class="btn btn-warning pull-left" type="button" id="btnremoveimage5"><i class="fa fa-close"></i></button>
                                    <a href="{{ url('/') }}/boxed-bg.png" id="imagenumber5" data-toggle="lightbox" data-title="Picture 05" data-gallery="gallery">
                                        <img id="preview5" src="{{ url('/') }}/boxed-bg.png?text=Pic5" class="img-fluid mb-2" alt="white sample" />
                                    </a>
                                </div>
                                <div class="col-sm-2" >
                                    <button class="btn btn-success pull-right" type="button" id="btnopenimage6"><i class="fa fa-instagram"></i></button>
                                    <button class="btn btn-warning pull-left" type="button" id="btnremoveimage6"><i class="fa fa-close"></i></button>
                                    <a href="{{ url('/') }}/boxed-bg.png" id="imagenumber6" data-toggle="lightbox" data-title="Picture 06" data-gallery="gallery">
                                        <img id="preview6" src="{{ url('/') }}/boxed-bg.png?text=Pic6" class="img-fluid mb-2" alt="white sample" />
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6 col-md-6" >
                                    <input type="hidden" id="edit_idne">
                                    <button class="btn btn-success pull-right" type="button" id="btnupdatedataps">Simpan</button>
                                    <button class="btn btn-warning pull-left btnkembali" type="button">Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline" id="divbanksoal">
                    <div class="card-header">
                        <h3 class="card-title">Bank Soal</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" placeholder="Enter an Keyword and Press Search Buttom" id="main_valcari">
                                        <div class="input-group-append">
                                            <div class="btn btn-primary" id="btn-search">
                                                <i class="fa fa-search"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 btn-group">
                                    <a href="#" id="btntambahsoal" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                                    <a href="#" id="btnuploadsoal" class="btn btn-warning"><i class="fa fa-file-excel-o"></i> Upload</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mailbox-messages">
                            <table class="table products-list" id="table_list">
                                <thead><tr><th class="text-center">Case List (click description to edit)</th></tr></thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card card-danger card-outline" id="divlistujian">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Ujian</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" id="btnarsipujian"><i class="fa fa-database"></i> View Arsip</button>
                            <button type="button" class="btn btn-tool" id="btntambahujian"><i class="fa fa-plus"></i> Tambah Ujian</button>
                            <button type="button" class="btn btn-tool btnkembali"><i class="fa fa-close"></i></button>
                        </div>
                    </div>
                    <div class="card-body" id="diveditorujian">
                        <div class="form-group">
                            <label for="ujian_nama">Nama Ujian</label>
                            <input type="text" id="ujian_nama" class="form-control">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="ujian_tglmulai">Tgl. Mulai</label>
                                    <input type="text" id="ujian_tglmulai" name="ujian_tglmulai" class="form-control"  data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                                </div>
                                <div class="col-lg-3">
                                    <label for="ujian_jammulai">Jam Mulai</label>
                                    <input type="text" id="ujian_jammulai" name="ujian_jammulai" class="form-control timepicker">
                                </div>
                                <div class="col-lg-3">
                                    <label for="ujian_tglselesai">Tgl. Selesai</label>
                                    <input type="text" id="ujian_tglselesai" name="ujian_tglselesai" class="form-control"  data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                                </div>
                                <div class="col-lg-3">
                                    <label for="ujian_jamselesai">Jam Selesai</label>
                                    <input type="text" id="ujian_jamselesai" name="ujian_jamselesai" class="form-control timepicker">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-2">
                                    <label for="ujian_status">Status Ujian</label>
                                    <select id="ujian_status" size="1" class="form-control">
                                        <option value="1">Aktif</option>
                                        <option value="0">Non Aktif</option>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <label for="ujian_timer">Timer (Menit)</label>
                                    <input type="text" id="ujian_timer" name="ujian_timer" class="form-control">
                                </div>
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-success" id="btnsimpanujian"><i class="fa fa-thumbs-up"></i> Simpan</button>
                                </div>
                                <div class="col-lg-6">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info" id="btnopencaselistview"><i class="fa fa-tasks"></i> Case List</button>
                                        <button type="button" class="btn btn-warning" id="btnopencaselistadd"><i class="fa fa-plus-circle"></i> Add Case</button>
                                        <button type="button" class="btn btn-success" id="btnopencaselistesai"><i class="fa fa-user-md"></i> Supervisor</button>
                                        <button type="button" class="btn btn-danger" id="btnkembalidariinputtes"><i class="fa fa-reply"></i> Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" id="daftarujian">
                        <div id="gridtest"></div>
                    </div>
                    <div class="card-footer" id="daftarpeserta">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <select id="ujian_idpeserta" size="1" class="form-control select2">
                                        <option value="">Pilih Peserta</option>
                                        <option value="all">Semua Peserta Tahun Ini</option>
                                        @if (isset($pesertas) AND !empty($pesertas))
                                            @foreach($pesertas as $rows)
                                            <option value="{{$rows->id}}">{!! $rows->nama !!} ( {!! $rows->nip_baru !!} - {!! $rows->unit_kerja !!} )</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <div class="btn btn-primary btn-block" id="btninputpeserta">
                                        <i class="fa fa-user-plus"></i>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="btn btn-info btn-block" id="btneksportpeserta">
                                        <i class="fa fa-file-excel-o"></i>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="btn btn-warning btn-block" id="btnkembalidariinputpeserta">
                                        <i class="fa fa-close"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gridpeserta">Daftar Peserta</label>
                            <div id="gridpeserta"></div>
                        </div>
                    </div>
                    <div class="card-footer" id="diveditorujiancaselist">
                        <input type="hidden" class="form-control" id="ujian_id">
                        <div id="messagetest"></div>
                        <div id="gridlistcase"></div>
                    </div>
                    <div class="card-footer" id="diveditorpewancara">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-7">
                                    <select id="pewancara_nama" size="1" class="form-control select2">
                                        <option value="">Pilih SPV</option>
                                        @if (isset($kelompokspv) AND !empty($kelompokspv))
                                            @foreach($kelompokspv as $rows)
                                            <option value="{{$rows->email}}">{!! $rows->nama !!} ( {!! $rows->email !!} )</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-lg-5">
                                    <div class="btn btn-primary btn-block" id="btninputpewancara">
                                        <i class="fa fa-user-plus"></i> Set Sebagai Pewancara
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="gridpewancara"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12" id="divverifikasisoal">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Unverified Case</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool btnkembali"><i class="fa fa-close"></i></button>
                        </div>
                    </div>
                    <div class="card-body tampilanverifikasiawal">
                        <div class="form-group">
                            <div class="row">
                                @if (Session('previlage') == 'administarator' OR Session('previlage') == 'verifikator')
                                    <div class="col-lg-6">
                                        <select id="unverif_valcari" size="1" class="form-control select2">
                                            <option value="">Pilih SPV</option>
                                            @if (isset($kelompokspv) AND !empty($kelompokspv))
                                                @foreach($kelompokspv as $rows)
                                                    <option value="{{$rows->id}}">{!! $rows->nama !!} ( {!! $rows->unit_kerja !!} )</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="btn btn-primary" id="btn-searchunverif">
                                            <i class="fa fa-pencil"></i> Set As Verifikator (Check First)
                                        </div>
                                    </div>
                                @endif
                                <div class="col-lg-3">
                                    <a href="#" id="btnmultiverifikasi" class="btn btn-info btn-app"><i class="fa fa-upload"></i> Multi Approval</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer tampilanverifikasiawal">
                        <div id="gridsoalunverif"></div>
                    </div>
                    <div class="card-body tampilanverifikasi">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-4">
                                    <strong><i class="fa fa-users mr-1"></i> Type Soal</strong>
                                    <p class="text-muted" id="verifikasi_tipesoal"></p>
                                    <hr>
                                    <strong><i class="fa fa-bank mr-1"></i> Fakultas</strong>
                                    <p class="text-muted" id="verifikasi_fakultas"></p>
                                    <hr>
                                    <strong><i class="fa fa-phone mr-1"></i> Universitas</strong>
                                    <p class="text-muted" id="verifikasi_universitas"></p>
                                    <hr>
                                    <strong><i class="fa fa-envelope mr-1"></i> Email</strong>
                                    <p class="text-muted" id="verifikasi_email"></p>
                                </div>
                                <div class="col-lg-8">
                                    <div id="verifikasi_tlssoal"></div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-2" >
                                                <a href="{{ url('/') }}/boxed-bg.png" id="verimagenumber1" data-toggle="lightbox" data-title="Picture 01" data-gallery="gallery">
                                                    <img id="verpreview" src="{{ url('/') }}/boxed-bg.png?text=Pic1" class="img-fluid mb-2" alt="white sample" />
                                                </a>
                                            </div>
                                            <div class="col-sm-2" >
                                                <a href="{{ url('/') }}/boxed-bg.png" id="verimagenumber2" data-toggle="lightbox" data-title="Picture 02" data-gallery="gallery">
                                                    <img id="verpreview2" src="{{ url('/') }}/boxed-bg.png?text=Pic2" class="img-fluid mb-2" alt="white sample" />
                                                </a>
                                            </div>
                                            <div class="col-sm-2" >
                                                <a href="{{ url('/') }}/boxed-bg.png" id="verimagenumber3" data-toggle="lightbox" data-title="Picture 03" data-gallery="gallery">
                                                    <img id="verpreview3" src="{{ url('/') }}/boxed-bg.png?text=Pic3" class="img-fluid mb-2" alt="white sample" />
                                                </a>
                                            </div>
                                            <div class="col-sm-2" >
                                                <a href="{{ url('/') }}/boxed-bg.png" id="verimagenumber4" data-toggle="lightbox" data-title="Picture 04" data-gallery="gallery">
                                                    <img id="verpreview4" src="{{ url('/') }}/boxed-bg.png?text=Pic4" class="img-fluid mb-2" alt="white sample" />
                                                </a>
                                            </div>
                                            <div class="col-sm-2" >
                                                <a href="{{ url('/') }}/boxed-bg.png" id="verimagenumber5" data-toggle="lightbox" data-title="Picture 05" data-gallery="gallery">
                                                    <img id="verpreview5" src="{{ url('/') }}/boxed-bg.png?text=Pic5" class="img-fluid mb-2" alt="white sample" />
                                                </a>
                                            </div>
                                            <div class="col-sm-2" >
                                                <a href="{{ url('/') }}/boxed-bg.png" id="verimagenumber6" data-toggle="lightbox" data-title="Picture 06" data-gallery="gallery">
                                                    <img id="verpreview6" src="{{ url('/') }}/boxed-bg.png?text=Pic6" class="img-fluid mb-2" alt="white sample" />
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer tampilanverifikasi">
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="verifikasi_komentar">Komentar</label>
                                <textarea id="verifikasi_komentar" rows="5" cols="20"></textarea>
                            </div>
                            <div class="col-lg-5 btn-group">
                                <a href="#" id="btntolak" class="btn btn-danger btn-app"><i class="fa fa-times-circle-o"></i> Reject With Comment</a>
                                <input type="hidden" id="verifikasi_id">
                                <a href="#" id="btnapprove" class="btn btn-info btn-app"><i class="fa fa-check-square-o"></i> Approve</a>
                                <a href="#" id="btncloseapproval" class="btn btn-warning btn-app"><i class="fa fa-power-off"></i> Close</a>
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
    <input type="hidden" id="namafile1">
    <input type="hidden" id="namafile2">
    <input type="hidden" id="namafile3">
    <input type="hidden" id="namafile4">
    <input type="hidden" id="namafile5">
    <input type="hidden" id="namafile6">
    <input type="file" id="id_fotoprofile">
    <input type="file" id="id_fotoprofile2">
    <input type="file" id="id_fotoprofile3">
    <input type="file" id="id_fotoprofile4">
    <input type="file" id="id_fotoprofile5">
    <input type="file" id="id_fotoprofile6">
    <div class="form-group">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <label for="id_kace">Pemeriksaan</label>
                <select id="id_kace" class="form-control">
                    <option value="Konvensional">Konvensional</option>
                    <option value="Canggih">Canggih</option>
                </select>
            </div>
            <div class="col-lg-3 col-md-3" id="ketikkategori">
                <label for="id_code2">Divisi</label>
                <input type="text" class="form-control" placeholder="Write The Category Name" id="id_code2">
            </div>
        </div>
    </div>
    <input type="hidden" id="set_jenis">
</div>
<div class="modal fade" id="modaluploadsoal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Input Excel </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="soal_fileexcel">File Excel</label>
                    <div class="input-group input-group-sm">
                        <input type="file" class="form-control" id="soal_fileexcel">
                        <div class="input-group-append">
                            <div class="btn btn-primary">
                                <i class="fa fa-file-excel-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    Catatan : Mohon Download Format File Berikut <a href="/format/soal.xlsx">Format Soal</a><br />File Tersebut telah kami beri petunjuk pengisian, mohon mengikuti petunjuk pengisian dan pastikan format kolom sudah "text"
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-success pull-left" id="btnsimpanuploadsoal">Upload</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalubahspv">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Change SPV</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="spv_peserta">Deskription</label>
                            <textarea id="spv_peserta" rows="5" cols="20"></textarea>
                        </div>
                        <div class="col-lg-6">
                            <label for="spv_nomor">Category</label>
                            <input type="text" id="spv_nomor" name="spv_nomor" class="form-control" disabled="disable" />
                        </div>
                        <div class="col-lg-6">
                            <label for="spv_asalpeserta">Code</label>
                            <input type="text" id="spv_asalpeserta" name="spv_asalpeserta" class="form-control" disabled="disable" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="spv_nama">Pilih SPV Sebagai Korektor Ujian</label>
                    <select id="spv_nama" size="1" class="form-control select2">
                        <option value="">Pilih SPV</option>
                        @if (isset($kelompokspv) AND !empty($kelompokspv))
                            @foreach($kelompokspv as $rows)
                            <option value="{{$rows->id}}">{!! $rows->nama !!} ( {!! $rows->unit_kerja !!} )</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" id="spv_idtes" name="spv_idtes" />
                <input type="hidden" id="spv_idsoal" name="spv_idsoal" />
                <button type="button" class="btn btn-success pull-left" id="btnubahspv">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalujianlisan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nilai Ujian Lisan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-7">
                            <label for="wawancara_nama">Nama</label>
                            <input type="text" id="wawancara_nama" name="wawancara_nama" class="form-control" disabled="disable" />
                        </div>
                        <div class="col-lg-5">
                            <label for="wawancara_nilai">Nilai (Angka Bulat)</label>
                            <input type="text" id="wawancara_nilai" name="wawancara_nilai" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <p> Catatan : Nilai 0 Tidak dihitung sebagai pembagi rata-rata dan mohon menggunakan angka bulat (tanpa desimal), namun apabila diperlukan desimal penulisannya menggunakan titik sebagai pemisah desimal contoh : xx.xx</p>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" id="wawancara_id" name="wawancara_id" />
                <button type="button" class="btn btn-success pull-left" id="btnisihasilwawancara">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>	
            </div>
        </div>
    </div>
</div>
<style>
	table.dataTable tbody td {
        word-break: break-word;
        vertical-align: top;
    }
</style>
<input type="hidden" value="Upload" id="master_set01">

<input type="hidden" value="{{Session('previlage')}}" id="master_set02">
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@push('script')
<script type="text/javascript">
    $(function () {
      	$('.select2').select2({width: '100%'});
        let summernoteOptions = {
            height: 300
        }
        bsCustomFileInput.init();
        $('#edit_mulai').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#edit_akhir').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#ujian_tglmulai').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#ujian_tglselesai').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $("#ujian_jammulai").timepicker({format: 'HH:mm:ss'});
        $("#ujian_jamselesai").timepicker({format: 'HH:mm:ss'});
        $('#table_list tbody').on('click', '.btnubah', function () {
            id = $(this).data("id");
            $("#edit_idne").val(id);
            $.post('{{ route("getFirstSoal") }}', { val01: id, _token: '{{ csrf_token() }}' },function(data){
                var idsoal    = data.idsoal;
                var kode      = data.kode;
                var kunci     = data.kunci;
                var jawaban   = data.tipesoal;
                var deskripsi = data.deskripsi;
                var opsia     = data.opsia;
                var opsib     = data.opsib;
                var opsic     = data.opsic;
                var opsid     = data.opsid;
                var opsie     = data.opsie;
                var ceel      = data.ceel;
                var lampiran  = data.lampiran;
                var lampiran2 = data.lampiran2;
                var lampiran3 = data.lampiran3;
                var lampiran4 = data.lampiran4;
                var lampiran5 = data.lampiran5;
                var lampiran6 = data.lampiran6;
                if (jawaban == 'choice'){
                    $('#divopsia').removeClass('col-lg-12 col-md-12').addClass('col-lg-4 col-md-4');
                    $("#labelopsia").html('Option A');
                    $('#id_optiona').summernote('destroy');
                    $('#id_optiona').summernote()
                    $('.colkeys').show();
                    $('.esay').show();
                    $("#id_keys").val(kunci);
                    $('.choice').show();
                } else if (jawaban == 'esay'){
                    $('#divopsia').removeClass('col-lg-4 col-md-4').addClass('col-lg-12 col-md-12');
					$("#labelopsia").html('Rubrik dan Skore Maksimal');
                    $('#id_optiona').summernote('destroy');
                    $('#id_optiona').summernote(summernoteOptions);
                    $('.colkeys').hide();
                    $('.esay').hide();
                    $('.choice').show();
                    $("#id_keys").val('A');
                } else {
                    $('.colkeys').hide();
                    $("#id_keys").val('LABEL');
                    $('.esay').show();
                    $('.choice').show();
                }
                $('#ketikkategori').hide();
                $('#pilihankategori').show();
                const getmulai  = kode.split("-");
			    var ceel        = getmulai[0];
                if(typeof(getmulai[1]) != "undefined" && getmulai[1] !== null) {
                    var kace    = getmulai[1];
                    $("#id_code").val(data.ceel);
                } else {
                    const getmulai  = ceel.split("-");
			        var ceel    = getmulai[0];
                    if(typeof(getmulai[1]) != "undefined" && getmulai[1] !== null) {
                        var kace    = getmulai[1];
                    } else {
                        var kace    = '';
                    }
                    $("#id_code").val(data.kode);
                }
                $("#id_ceel").val(ceel);
                $("#id_kace").val(kace);
                $("#id_tipe").val(jawaban);
                $("#edit_idne").val(idsoal);
                $('#id_deskripsi').summernote('code', deskripsi);
                $('#id_optiona').summernote('code', opsia);
                $('#id_optionb').summernote('code', opsib);
                $('#id_optionc').summernote('code', opsic);
                $('#id_optiond').summernote('code', opsid);
                $('#id_optione').summernote('code', opsie);
                
                $("#id_fotoprofile").val('');
                $("#namafile1").val(lampiran);
                if (lampiran == ''){
                    $('#imagenumber1').attr('href', 'boxed-bg.png');
                    $('#preview').attr('src', 'boxed-bg.png');
                } else {
                    $('#imagenumber1').attr('href', lampiran);
                    $('#preview').attr('src', lampiran);
                }
                $("#id_fotoprofile2").val('');
                $("#namafile2").val(lampiran2);
                if (lampiran2 == ''){
                    $('#imagenumber2').attr('href', 'boxed-bg.png');
                    $('#preview2').attr('src', 'boxed-bg.png');
                } else {
                    $('#imagenumber2').attr('href', lampiran2);
                    $('#preview2').attr('src', lampiran2);
                }
                $("#id_fotoprofile3").val('');
                $("#namafile3").val(lampiran3);
                if (lampiran3 == ''){
                    $('#imagenumber3').attr('href', 'boxed-bg.png');
                    $('#preview3').attr('src', 'boxed-bg.png');
                } else {
                    $('#imagenumber3').attr('href', lampiran3);
                    $('#preview3').attr('src', lampiran3);
                }
                $("#id_fotoprofile4").val('');
                $("#namafile4").val(lampiran4);
                if (lampiran4 == ''){
                    $('#imagenumber4').attr('href', 'boxed-bg.png');
                    $('#preview4').attr('src', 'boxed-bg.png');
                } else {
                    $('#imagenumber4').attr('href', lampiran4);
                    $('#preview4').attr('src', lampiran4);
                }
                $("#id_fotoprofile5").val('');
                $("#namafile5").val(lampiran5);
                if (lampiran5 == ''){
                    $('#imagenumber5').attr('href', 'boxed-bg.png');
                    $('#preview5').attr('src', 'boxed-bg.png');
                } else {
                    $('#preview5').attr('src', lampiran5);
                    $('#imagenumber5').attr('href', lampiran5);
                }
                $("#id_fotoprofile6").val('');
                $("#namafile6").val(lampiran6);
                if (lampiran6 == ''){
                    $('#imagenumber6').attr('href', 'boxed-bg.png');
                    $('#preview6').attr('src', 'boxed-bg.png');
                } else {
                    $('#preview6').attr('src', lampiran6);
                    $('#imagenumber6').attr('href', lampiran6);
                }
                $('.divawal').show();
                $('#diveditsoal').show();
                $('#divkoreksi').hide();
                $('#divlistujian').hide();
                $('#divriwayat').hide();
                $('#divbanksoal').hide();
                $('#diveditpeserta').hide();
                $('#divupload').hide();
                $("#divverifikasisoal").hide();
            
            });
        });
        $('#table_list tbody').on('click', '.btndeletesoal', function () {
            id = $(this).data("id");
            swal({
                title: 'Apakah anda yakin ?',
                text: "Soal Ini Akan Kami Non Aktifkan, dan Bisa di Kembalikan ke Aktif apabila di Edit Kembali",
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-confirm mt-2',
                cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                confirmButtonText: 'Yes, Remove It'
            }).then(function () {
                $.post('{{ route("exInputBankSoal") }}', { set01: 'hapus', set02: id, _token: '{{ csrf_token() }}' },	
                function(data){
                    swal({
                        title	: 'Info',
                        text	: data,
                        type	: 'warning',
                    })
                    $('#table_list').dataTable().fnDraw();
                    return false;
                });
            });
        });
    });
    $('#id_fotoprofile').change(function () {
        if(this.files[0].size > 3000000){
            this.value = "";
            swal({
                title	: 'Stop',
                text	: 'Maksimum file adalah 3Mb',
                type	: 'warning',
            })
        } else {
            var imgPath = this.value;
            var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "PNG" || ext == "png" || ext == "JPG" || ext == "JPEG" || ext == "jpg" || ext == "jpeg") {
                readURLAddmhs(this);
            } else {
                $('#preview').attr('src', 'boxed-bg.png');
                swal({
                    title	: 'Stop',
                    text	: 'Please select image file (jpg, jpeg, png).',
                    type	: 'warning',
                })
            }
        }
    });
    $('#id_fotoprofile2').change(function () {
        if(this.files[0].size > 3000000){
            this.value = "";
            swal({
                title	: 'Stop',
                text	: 'Maksimum file adalah 3Mb',
                type	: 'warning',
            })
        } else {
            var imgPath = this.value;
            var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "PNG" || ext == "png" || ext == "JPG" || ext == "JPEG" || ext == "jpg" || ext == "jpeg") {
                readURLPic2(this);
            } else {
                $('#preview2').attr('src', 'boxed-bg.png');
                swal({
                    title	: 'Stop',
                    text	: 'Please select image file (jpg, jpeg, png).',
                    type	: 'warning',
                })
            }
        }
    });
    $('#id_fotoprofile3').change(function () {
        if(this.files[0].size > 3000000){
            this.value = "";
            swal({
                title	: 'Stop',
                text	: 'Maksimum file adalah 3Mb',
                type	: 'warning',
            })
        } else {
            var imgPath = this.value;
            var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "PNG" || ext == "png" || ext == "JPG" || ext == "JPEG" || ext == "jpg" || ext == "jpeg") {
                readURLPic3(this);
            } else {
                $('#preview3').attr('src', 'boxed-bg.png');
                swal({
                    title	: 'Stop',
                    text	: 'Please select image file (jpg, jpeg, png).',
                    type	: 'warning',
                })
            }
        }
    });
    $('#id_fotoprofile4').change(function () {
        if(this.files[0].size > 3000000){
            this.value = "";
            swal({
                title	: 'Stop',
                text	: 'Maksimum file adalah 3Mb',
                type	: 'warning',
            })
        } else {
            var imgPath = this.value;
            var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "PNG" || ext == "png" || ext == "JPG" || ext == "JPEG" || ext == "jpg" || ext == "jpeg") {
                readURLPic4(this);
            } else {
                $('#preview4').attr('src', 'boxed-bg.png');
                swal({
                    title	: 'Stop',
                    text	: 'Please select image file (jpg, jpeg, png).',
                    type	: 'warning',
                })
            }
        }
    });
    $('#id_fotoprofile5').change(function () {
        if(this.files[0].size > 3000000){
            this.value = "";
            swal({
                title	: 'Stop',
                text	: 'Maksimum file adalah 3Mb',
                type	: 'warning',
            })
        } else {
            var imgPath = this.value;
            var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "PNG" || ext == "png" || ext == "JPG" || ext == "JPEG" || ext == "jpg" || ext == "jpeg") {
                readURLPic5(this);
            } else {
                $('#preview5').attr('src', 'boxed-bg.png');
                swal({
                    title	: 'Stop',
                    text	: 'Please select image file (jpg, jpeg, png).',
                    type	: 'warning',
                })
            }
        }
    });
    $('#id_fotoprofile6').change(function () {
        if(this.files[0].size > 3000000){
            this.value = "";
            swal({
                title	: 'Stop',
                text	: 'Maksimum file adalah 3Mb',
                type	: 'warning',
            })
        } else {
            var imgPath = this.value;
            var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "PNG" || ext == "png" || ext == "JPG" || ext == "JPEG" || ext == "jpg" || ext == "jpeg") {
                readURLPic6(this);
            } else {
                $('#preview6').attr('src', 'boxed-bg.png');
                swal({
                    title	: 'Stop',
                    text	: 'Please select image file (jpg, jpeg, png).',
                    type	: 'warning',
                })
            }
        }
    });
    function readURLAddmhs(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#imagenumber1').attr('href', e.target.result);
                $('#preview').attr('src', e.target.result);
                $("#namafile1").val('ada');
            };
        }
    }
    function readURLPic2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#imagenumber2').attr('href', e.target.result);
                $('#preview2').attr('src', e.target.result);
                $("#namafile2").val('ada');
            };
        }
    }
    function readURLPic3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#imagenumber3').attr('href', e.target.result);
                $('#preview3').attr('src', e.target.result);
                $("#namafile3").val('ada');
            };
        }
    }
    function readURLPic4(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#imagenumber4').attr('href', e.target.result);
                $('#preview4').attr('src', e.target.result);
                $("#namafile4").val('ada');
            };
        }
    }
    function readURLPic5(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#imagenumber5').attr('href', e.target.result);
                $('#preview5').attr('src', e.target.result);
                $("#namafile5").val('ada');
            };
        }
    }
    function readURLPic6(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#imagenumber6').attr('href', e.target.result);
                $('#preview6').attr('src', e.target.result);
                $("#namafile6").val('ada');
            };
        }
    }
    function openpeserta( jQuery ){
        var tahun 		    = document.getElementById('tahunujian').value;
        var sumberpegawai   = {
            datatype: "json",
            datafields: [
                { name: 'id'},
				{ name: 'nama_lengkap', type: 'text'},
				{ name: 'fotourl', type: 'text'},
				{ name: 'foto', type: 'text'},
				{ name: 'status', type: 'text'},
				{ name: 'keterangan', type: 'text'},
			],
            updaterow: function (rowid, rowdata, commit) {commit(true);},
            type		: 'POST',
            data        : {	tahun:tahun, tabel:'Simpegpegawai', marking:'', _token: '{{ csrf_token() }}' },
            url			: '{{ route("jsonallinterviewer") }}',
            root		: 'data',
            totalrecords: 'total',
            cache		: false,
            filter		: function () {
                $("#gridlistinterviewer").jqxGrid('updatebounddata', 'filter');
            },
            sort: function () {
                $("#gridlistinterviewer").jqxGrid('updatebounddata', 'sort');
            },
            beforeprocessing: function (data) {
                if (data != null) {
                    sumberpegawai.totalrecords = data.total;
                }
            }
        };
        var datajsonPeserta = new $.jqx.dataAdapter(sumberpegawai);
        var rendergridrows = $('#gridlistinterviewer').jqxGrid('rendergridrows');
        $("#gridlistinterviewer").jqxGrid({
            width			: '100%',
            filterable		: true,
            columnsresize	: true,
            showfilterrow	: true,
            sortable		: true,
            autoheight		: true,
            virtualmode		: true,
            pageable		: true,
            rowsheight      : 35,
            rendergridrows	: function(obj) {
                return obj.data;
            },
            source			: datajsonPeserta,
            pagesizeoptions	: ['10', '20'],
            theme			: "energyblue",
            altrows			: true,
            columns			: [
                { text: 'Nilai', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', align: 'center', cellsalign: 'center', cellsrenderer: function () {
                    return "Input";
                    }, buttonclick: function (row) {
                        editrow 		= row;
                        var offset 		= $("#gridlistinterviewer").offset();
                        var dataRecord 	= $("#gridlistinterviewer").jqxGrid('getrowdata', editrow);
                        $('#wawancara_nama').val(dataRecord.nama_lengkap);
                        $('#wawancara_nilai').val(dataRecord.status);
                        $('#wawancara_id').val(dataRecord.id);
                        $("#modalujianlisan").modal('show');
                    }
                },
                { text: 'Foto', editable: false, sortable: false, filterable: false, datafield: 'fotourl', width: '7%', align: 'center', cellsalign: 'center' },
                { text: 'Nama', datafield: 'nama_lengkap', width: '35%', cellsalign: 'left', align: 'center'},
                { text: 'Nilai', datafield: 'status', width: '10%', cellsalign: 'center', align: 'center'  },
                { text: 'Keterangan', datafield: 'keterangan', width: '40%', cellsalign: 'left', align: 'center'  },
            ],
        });
    }
    $(document).ready(function() {
        let summernoteOptions = {
            height: 300
        }
        $('#divwawancara').hide();
        $('#diveditorpewancara').hide();
        $('#divstatistik').hide();
        $('#divkoreksi').hide();
        $('#divlistujian').hide();
        $("#divverifikasisoal").hide();
        $('#enteni').hide();
        $('#spv_peserta').summernote()
        $('#koreksi_jawaban').summernote()
        $('#verifikasi_komentar').summernote()
        $('#id_deskripsi').summernote()
        $('#id_optiona').summernote()
        $('#id_optionb').summernote()
        $('#id_optionc').summernote()
        $('#id_optiond').summernote()
        $('#id_optione').summernote()
        $('#diveditsoal').hide();
        $('#divbanksoal').show();
        $('#divupload').hide();
        //START_BLOK_SOAL
            $("#id_tipe").on('change', function () {
                var pilihan 	      = $(this).find('option:selected').attr('value');
                if (pilihan == 'choice'){
                    $('#divopsia').removeClass('col-lg-12 col-md-12').addClass('col-lg-4 col-md-4');
                    $("#labelopsia").html('Option A');
                    $('#id_optiona').summernote('destroy');
                    $('#id_optiona').summernote()
                    $('.colkeys').show();
                    $('.esay').show();
                    $("#id_keys").val('');
                    $('.choice').show();
                } else if (pilihan == 'esay'){
                    $('#divopsia').removeClass('col-lg-4 col-md-4').addClass('col-lg-12 col-md-12');
					$("#labelopsia").html('Rubrik dan Skore Maksimal');
                    $('#id_optiona').summernote('destroy');
                    $('#id_optiona').summernote(summernoteOptions);
                    $('.colkeys').hide();
                    $('.esay').hide();
                    $('.choice').show();
                    $("#id_keys").val('A');
                } else {
                    $('.colkeys').hide();
                    $("#id_keys").val('LABEL');
                    $('.esay').show();
                    $('.choice').show();
                }
            });
            $("#id_code").on('change', function () {
                var pilihan 	  = $(this).find('option:selected').attr('value');
                if (pilihan == 'new'){
                    $('#ketikkategori').show();
                    $('#pilihankategori').hide();
                } else {
                    $('#ketikkategori').hide();
                    $('#pilihankategori').show();
                    $("#id_code2").val('');
                }
            });
            $('#btnbanksoal').on('click', function (){
                $('.card-outline').hide();
                $('#divbanksoal').show();
            });
            $('#btntambahsoal').click(function () {
                $("#edit_idne").val('new');
                $('#preview').attr('src', 'boxed-bg.png');
                $('#preview2').attr('src', 'boxed-bg.png');
                $('#preview3').attr('src', 'boxed-bg.png');
                $('#preview4').attr('src', 'boxed-bg.png');
                $('#preview5').attr('src', 'boxed-bg.png');
                $('#preview6').attr('src', 'boxed-bg.png');
                $('#imagenumber1').attr('href', 'boxed-bg.png');
                $('#imagenumber2').attr('href', 'boxed-bg.png');
                $('#imagenumber3').attr('href', 'boxed-bg.png');
                $('#imagenumber4').attr('href', 'boxed-bg.png');
                $('#imagenumber5').attr('href', 'boxed-bg.png');
                $('#imagenumber6').attr('href', 'boxed-bg.png');
                $("#id_tipe").val('choice');
                $('#ketikkategori').hide();
                $('#pilihankategori').show();
                $('.esay').show();
                $('.choice').show();
                $("#id_code").val('');
                $("#id_code2").val('');
                $('#id_deskripsi').summernote('code', '');
                $('#id_optiona').summernote('code', '');
                $('#id_optionb').summernote('code', '');
                $('#id_optionc').summernote('code', '');
                $('#id_optiond').summernote('code', '');
                $('#id_optione').summernote('code', '');
                $("#id_keys").val('');
                $("#id_fotoprofile").val('');
                $("#id_fotoprofile2").val('');
                $("#id_fotoprofile3").val('');
                $("#id_fotoprofile4").val('');
                $("#id_fotoprofile5").val('');
                $("#id_fotoprofile6").val('');
                $("#namafile1").val('');
                $("#namafile2").val('');
                $("#namafile3").val('');
                $("#namafile4").val('');
                $("#namafile5").val('');
                $("#namafile6").val('');
                $('#diveditsoal').show();
                $('#divriwayat').hide();
                $('#divbanksoal').hide();
                $('#diveditpeserta').hide();
                $('#divupload').hide();
                $('#divkoreksi').hide();
                $('#divlampiran').hide();
            });
            $("#btnupdatedataps").click(function(){
                var val01=document.getElementById('edit_idne').value;
                var val02=document.getElementById('id_ceel').value;
                var val03=document.getElementById('id_code').value;
                var val04=$('#id_deskripsi').summernote('code');
                var val05=$('#id_optiona').summernote('code');
                var val06=$('#id_optionb').summernote('code');
                var val07=$('#id_optionc').summernote('code');
                var val08=$('#id_optiond').summernote('code');
                var val09=$('#id_optione').summernote('code');
                var val10=document.getElementById('id_keys').value;
                var val11=document.getElementById('id_fotoprofile');
                var val12=document.getElementById('id_tipe').value;
                var val13=document.getElementById('id_kace').value;
                var val14=document.getElementById('id_fotoprofile2');
                var val15=document.getElementById('id_fotoprofile3');
                var val16=document.getElementById('id_fotoprofile4');
                var val17=document.getElementById('id_fotoprofile5');
                var val18=document.getElementById('id_fotoprofile6');
                var val19=document.getElementById('namafile1').value;
                var val20=document.getElementById('namafile2').value;
                var val21=document.getElementById('namafile3').value;
                var val22=document.getElementById('namafile4').value;
                var val23=document.getElementById('namafile5').value;
                var val24=document.getElementById('namafile6').value;
                if (val12 == 'Labelled Case'){ var val10 = 'Labelled Case'; }
                if ($('#id_fotoprofile').val() == '' && val12 == 'Labelled Case'){
                    swal({
                        title	: 'Stop',
                        text	: 'Labelled Case Must Have an Images',
                        type	: 'warning',
                    })
                } else if (val01 == '' || val02 == '' || val03 == '' ||  val04 == '' || val05 == '' || val10 == '' || val12 == ''){
                    swal({
                        title	: 'Stop',
                        text	: 'Form Wajib di Lengkapi, Apabila ada data yg kosong / tidak diketahui, maka diberi tanda (-) / strip : '+val01+' / '+val02+' / '+val03+' / '+val04+' / '+' / '+val05+' / '+val10+' / '+val12,
                        type	: 'warning',
                    })
                } else {
                    var form_data = new FormData();
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
                        form_data.append('set11', val12);
                        form_data.append('file', val11.files[0]);
                        form_data.append('file2', val14.files[0]);
                        form_data.append('file3', val15.files[0]);
                        form_data.append('file4', val16.files[0]);
                        form_data.append('file5', val17.files[0]);
                        form_data.append('file6', val18.files[0]);
                        form_data.append('set19', val19);
                        form_data.append('set20', val20);
                        form_data.append('set21', val21);
                        form_data.append('set22', val22);
                        form_data.append('set23', val23);
                        form_data.append('set24', val24);
                        form_data.append('_token', '{{csrf_token()}}');
                    $('#diveditsoal').hide();
                    $("#set_jenis").val('2');
                    $.ajax({
                        url         : '{{ route("exInputBankSoal") }}',
                        data        : form_data,
                        type        : 'POST',
                        contentType : false,
                        processData : false,
                        success     : function (data) {
                            $('#divbanksoal').show();
                            $.toast({
                                heading: 'Info',
                                text: data,
                                position: 'top-right',
                                loaderBg: '#bf441d',
                                icon: 'success',
                                hideAfter: 5000,
                                stack: 1
                            });
                            $('#table_list').dataTable().fnDraw();
                            $("html, body").animate({ scrollTop: 0 }, "slow");
                            return false;
                        },
                        error: function (xhr, status, error) {
                            $('#diveditsoal').show();
                            swal({
                                title	: 'Stop',
                                text	: xhr.responseText,
                                type	: 'error',
                            })
                        }
                    });
                }
            });
            $("#btnsimpanuploadsoal").click(function(){
                var val01=document.getElementById('soal_fileexcel');
                if ($('#soal_fileexcel').val() == ''){
                    swal({
                        title	: 'Stop',
                        text	: 'File Kosong',
                        type	: 'warning',
                    })
                } else {
                    var form_data = new FormData();
                        form_data.append('set01', 'upload');
                        form_data.append('set02', '');
                        form_data.append('set03', '');
                        form_data.append('file', val01.files[0]);
                        form_data.append('_token', '{{csrf_token()}}');
                    $("#modaluploadsoal").modal('hide');
                    $('#enteni').show();
                    $.ajax({
                        url         : '{{ route("exInputBankSoal") }}',
                        data        : form_data,
                        type        : 'POST',
                        contentType : false,
                        processData : false,
                        success     : function (data) {
                            $("#set_jenis").val('0');
                            $.toast({
                                heading: 'Info',
                                text: data,
                                position: 'top-right',
                                loaderBg: '#bf441d',
                                icon: 'success',
                                hideAfter: 5000,
                                stack: 1
                            });
                            $('#enteni').hide();
                            $('#table_list').dataTable().fnDraw();
                            $("html, body").animate({ scrollTop: 0 }, "slow");
                            return false;
                        },
                        error: function (xhr, status, error) {
                            swal({
                                title	: 'Stop',
                                text	: xhr.responseText,
                                type	: 'error',
                            })
                        }
                    });
                }
            });
            $('#btnuploadsoal').on('click', function (){
                $("#modaluploadsoal").modal('show');
            });
            $('#btnremoveimage1').on('click', function (){
                $('#preview').attr('src', 'boxed-bg.png');
                $("#id_fotoprofile").val('');
                $("#namafile1").val('');
            });
            $('#btnremoveimage2').on('click', function (){
                $('#preview2').attr('src', 'boxed-bg.png');
                $("#id_fotoprofile2").val('');
                $("#namafile2").val('');
            });
            $('#btnremoveimage3').on('click', function (){
                $('#preview3').attr('src', 'boxed-bg.png');
                $("#id_fotoprofile3").val('');
                $("#namafile3").val('');
            });
            $('#btnremoveimage4').on('click', function (){
                $('#preview4').attr('src', 'boxed-bg.png');
                $("#id_fotoprofile4").val('');
                $("#namafile4").val('');
            });
            $('#btnremoveimage5').on('click', function (){
                $('#preview5').attr('src', 'boxed-bg.png');
                $("#id_fotoprofile5").val('');
                $("#namafile5").val('');
            });
            $('#btnremoveimage6').on('click', function (){
                $('#preview6').attr('src', 'boxed-bg.png');
                $("#id_fotoprofile6").val('');
                $("#namafile6").val('');
            });
            $('#btnopenimage1').on('click', function (){
                $('#id_fotoprofile').click();
            });
            $('#btnopenimage2').on('click', function (){
                $('#id_fotoprofile2').click();
            });
            $('#btnopenimage3').on('click', function (){
                $('#id_fotoprofile3').click();
            });
            $('#btnopenimage4').on('click', function (){
                $('#id_fotoprofile4').click();
            });
            $('#btnopenimage5').on('click', function (){
                $('#id_fotoprofile5').click();
            });
            $('#btnopenimage6').on('click', function (){
                $('#id_fotoprofile6').click();
            });
            $('#imagenumber1').click(function (e) {
                e.preventDefault();
                $(this).ekkoLightbox();
            });
            $('#imagenumber2').click(function (e) {
                e.preventDefault();
                $(this).ekkoLightbox();
            });
            $('#imagenumber3').click(function (e) {
                e.preventDefault();
                $(this).ekkoLightbox();
            });
            $('#imagenumber4').click(function (e) {
                e.preventDefault();
                $(this).ekkoLightbox();
            });
            $('#imagenumber5').click(function (e) {
                e.preventDefault();
                $(this).ekkoLightbox();
            });
            $('#imagenumber6').click(function (e) {
                e.preventDefault();
                $(this).ekkoLightbox();
            });
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
            $("#btndelete").click(function(){
                var val01=document.getElementById('edit_idne').value;
                var val02=document.getElementById('id_code').value;
                var val03=document.getElementById('id_ceel').value;
                var val04=$('#id_deskripsi').summernote('code');
                var val05=$('#id_optiona').summernote('code');
                var val06=$('#id_optionb').summernote('code');
                var val07=$('#id_optionc').summernote('code');
                var val08=$('#id_optiond').summernote('code');
                var val09=$('#id_optione').summernote('code');
                var val10=document.getElementById('id_keys').value;
                var val11=document.getElementById('id_fotoprofile');
                swal({
                    title				: 'Apakah anda yakin ?',
                    text				: "Perhatian, data yang sudah di hapus tidak bisa di Undo, apakah anda yakin ingin menghapus",
                    type				: 'warning',
                    showCancelButton	: true,
                    confirmButtonClass	: 'btn btn-confirm mt-2',
                    cancelButtonClass	: 'btn btn-cancel ml-2 mt-2',
                    confirmButtonText	: 'Yes'
                }).then(function () {
                    $('#diveditor').hide();
                    var form_data = new FormData();
                        form_data.append('set01', 'hapus');
                        form_data.append('set02', val01);
                        form_data.append('set03', val03);
                        form_data.append('set04', null);
                        form_data.append('set05', null);
                        form_data.append('set06', val06);
                        form_data.append('set07', val07);
                        form_data.append('set08', val08);
                        form_data.append('set09', val09);
                        form_data.append('set10', val10);
                        form_data.append('file', null);
                        form_data.append('_token', '{{csrf_token()}}');
                    $.ajax({
                        url         : '{{ route("exInputBankSoal") }}',
                        data        : form_data,
                        type        : 'POST',
                        contentType : false,
                        processData : false,
                        success     : function (data) {
                            $('#divbanksoal').show();
                            $.toast({
                                heading: 'Info',
                                text: data,
                                position: 'top-right',
                                loaderBg: '#bf441d',
                                icon: 'success',
                                hideAfter: 5000,
                                stack: 1
                            });
                            $('#table_list').dataTable().fnDraw();
                            $("html, body").animate({ scrollTop: 0 }, "slow");
                            return false;
                        },
                        error: function (xhr, status, error) {
                            swal({
                                title	: 'Stop',
                                text	: xhr.responseText,
                                type	: 'warning',
                            })
                        }
                    });
                });
            });
            $('#btnviewskdonly').click(function () {
                $("#set_jenis").val('KD');
                $('#table_list').dataTable().fnDraw();
            });
            $('#btnviewskbonly').click(function () {
                $("#set_jenis").val('KB');
                $('#table_list').dataTable().fnDraw();
            });
            $('#btnarsip').click(function () {
                $("#set_jenis").val('0');
                $('#table_list').dataTable().fnDraw();
            });
            $("#btnexport").click(function(){
                var val01=document.getElementById('set_jenis').value;
                $.post('{{ route("exaddtotxt") }}', {  set01: val01, _token: '{{ csrf_token() }}' },
                function(data){			
                    var newWindow = window.open('', '', 'width=800, height=500'),
                        document = newWindow.document.open(),
                        pageContent =
                            '<!DOCTYPE html>\n' +
                            '<html>\n' +
                            '<head>\n' +
                            '<meta charset="utf-8" />\n' +
                            '<title>Exported Files</title>\n' +
                            '</head>\n' +
                            '<body>' + data + '\n</body>\n</html>';
                        document.write(pageContent);
                        document.close();
                });
            });
        //END_BLOK_SOAL
        $('.btnkembali').click(function () {
            $('.card-outline').hide();
            $('.divawal').show();
            $('#divbanksoal').show();
            $('#divverifikasisoal').hide();
        });
        $('#btn-clear').click(function(){
            $('.form-filter').val('');
        });
        $('#btn-search').click(function(){
            $('#table_list').dataTable().fnDraw();
        });
        var col_order   = ["deskripsi", "tahun"];
        $('#table_list').DataTable({
            responsive  : true, 
            dom         : "<'row'<'col-sm-12'tr>>\
                            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
            lengthMenu  : [10, 25, 50],
            pageLength  : 10,
            ordering    : true,
            processing  : true,
            serverSide  : true,
            autoWidth   : false,
            columns     : [
                { width : '450px' },
            ],
            ajax        : function(data, callback, settings) {
                $.ajax({
                url     : '{{ route("getBankSoal") }}',
                data    : {
                    limit   : settings._iDisplayLength,
                    page    : Math.ceil(settings._iDisplayStart / settings._iDisplayLength) + 1,
                    jenis   : $('#set_jenis').val(),
                    valcari : $('#main_valcari').val(),
                    view    : '1',
                    order   : col_order[settings.aaSorting[0][0]]+' '+settings.aaSorting[0][1],
                },
                type        : "GET",
                beforeSend  : function(request) {
                    request.setRequestHeader('Authorization', 'Bearer ' + token);
                },
                success: function(res) {
                    callback({
                        recordsTotal    : res.total,
                        recordsFiltered : res.total,
                        data            : res.data
                    });
                },
                })
            },
            columns: [	
                {
                "data"      : {
                    idsoal      : "idsoal",
                    kode        : "kode",
                    tipesoal    : "tipesoal",
                    deskripsi   : "deskripsi",
                    jawaba      : "jawaba",
                    jawabb      : "jawabb",
                    jawabc      : "jawabc",
                    jawabd      : "jawabd",
                    jawabe      : "jawabe",
                    lampiran    : "lampiran",
                    kuncie      : "kuncie",
                    showjawab   : "showjawab",
                    created_by  : "created_by",
                    fakultas    : "fakultas",
                    fakpanjang  : "fakpanjang",
                    inputor     : "inputor",
                },
                "orderable" : true,
                render      : function (data, type, row, meta) {
                    nomor = meta.row + meta.settings._iDisplayStart + 1;
                    var aktif     = data.aktif;
                    var lampiran  = data.lampiran;
                    if (aktif == 1){
                        var aktif = '<span class="badge badge-success float-right">'+data.ceel+'</span>'
                    } else {
                        var aktif = '<span class="badge badge-danger float-right">'+data.ceel+'</span>'
                    }
                    if (lampiran == '' || lampiran == null){
                        var lampiran = '<img src="boxed-bg.png" alt="Product Image" class="img-size-50">'
                    } else {
                        var lampiran = '<img src="'+data.lampiran+'" alt="Product Image" class="img-size-50">'
                    }
                    str   = '<div class="item"><div class="product-img">'+lampiran+'</div>'+
                                '<div class="product-info">'+
                                    nomor+'. <a href="javascript:void(0)" class="product-title btnubah" data-id="'+data.idsoal+'">'+data.deskripsi+
                                    '</a><a href="javascript:void(0)" class="badge badge-danger btndeletesoal float-right" data-id="'+data.idsoal+'"><i class="fa fa-remove fa-2x"></i></a><br />'+
                                    '<span class="product-description">'+data.showjawab+'</span>'+
                                    '<span class="product-description">Created By '+data.created_by+' '+data.fakultas+' '+data.fakpanjang+'</span>'+
                                    '<span class="product-description">'+data.inputor+'</span>'+
                            '</div></div>';
                    return str;
                }
                },
            ],
            "initComplete"  : function(settings, json) {
            }
        });
        $('#btnopenstatistik').on('click', function (){
            $('#divwawancara').hide();
            $('#divstatistik').show();
            $('#divkoreksi').hide();
            $('#daftarpeserta').hide();
            $('#diveditorujiancaselist').hide();
            $('#diveditorujian').hide();
            $('#daftarujian').hide();
            $('#divlistujian').hide();
            $('#diveditsoal').hide();
            $('#divriwayat').hide();
            $('#divbanksoal').hide();
            $('#diveditpeserta').hide();
            $('#divupload').hide();
            $.post('{{ route("getFirstSoal") }}', { val01: '{{Session("email")}}', _token: '{{ csrf_token() }}' },function(data){
                $("#nama").html(data.nama);
                $("#total12").html(data.total12);
                $("#total34").html(data.total34);
                $("#counta1").html(data.counta1);
                $("#counta2").html(data.counta2);
                $("#counta3").html(data.counta3);
                $("#counta4").html(data.counta4);
                $("#countb1").html(data.countb1);
                $("#countb2").html(data.countb2);
                $("#countb3").html(data.countb3);
                $("#countb4").html(data.countb4);
                $("#countc1").html(data.countc1);
                $("#countc2").html(data.countc2);
                $("#countc3").html(data.countc3);
                $("#countc4").html(data.countc4);
                $("#countd1").html(data.countd1);
                $("#countd2").html(data.countd2);
                $("#countd3").html(data.countd3);
                $("#countd4").html(data.countd4);
                $("#counte1").html(data.counte1);
                $("#counte2").html(data.counte2);
                $("#counte3").html(data.counte3);
                $("#counte4").html(data.counte4);
                $("#countf1").html(data.countf1);
                $("#countf2").html(data.countf2);
                $("#countf3").html(data.countf3);
                $("#countf4").html(data.countf4);
                $("#countg1").html(data.countg1);
                $("#countg2").html(data.countg2);
                $("#countg3").html(data.countg3);
                $("#countg4").html(data.countg4);
                $("#counth1").html(data.counth1);
                $("#counth2").html(data.counth2);
                $("#counth3").html(data.counth3);
                $("#counth4").html(data.counth4);
                    
            });
        });
        $('#btncaristatistik').on('click', function (){
            var email=document.getElementById('statistik_nama').value;
            $.post('{{ route("getFirstSoal") }}', { val01: email, _token: '{{ csrf_token() }}' },function(data){
                $("#nama").html(data.nama);
                $("#total12").html(data.total12);
                $("#total34").html(data.total34);
                $("#counta1").html(data.counta1);
                $("#counta2").html(data.counta2);
                $("#counta3").html(data.counta3);
                $("#counta4").html(data.counta4);
                $("#countb1").html(data.countb1);
                $("#countb2").html(data.countb2);
                $("#countb3").html(data.countb3);
                $("#countb4").html(data.countb4);
                $("#countc1").html(data.countc1);
                $("#countc2").html(data.countc2);
                $("#countc3").html(data.countc3);
                $("#countc4").html(data.countc4);
                $("#countd1").html(data.countd1);
                $("#countd2").html(data.countd2);
                $("#countd3").html(data.countd3);
                $("#countd4").html(data.countd4);
                $("#counte1").html(data.counte1);
                $("#counte2").html(data.counte2);
                $("#counte3").html(data.counte3);
                $("#counte4").html(data.counte4);
                $("#countf1").html(data.countf1);
                $("#countf2").html(data.countf2);
                $("#countf3").html(data.countf3);
                $("#countf4").html(data.countf4);
                $("#countg1").html(data.countg1);
                $("#countg2").html(data.countg2);
                $("#countg3").html(data.countg3);
                $("#countg4").html(data.countg4);
                $("#counth1").html(data.counth1);
                $("#counth2").html(data.counth2);
                $("#counth3").html(data.counth3);
                $("#counth4").html(data.counth4);
                
            
            });
        });
        $("#statistik_nama").on('change', function () {
            var email = $(this).find('option:selected').attr('value');
            $.post('{{ route("getFirstSoal") }}', { val01: email, _token: '{{ csrf_token() }}' },function(data){
                $("#nama").html(data.nama);
                $("#total12").html(data.total12);
                $("#total34").html(data.total34);
                $("#counta1").html(data.counta1);
                $("#counta2").html(data.counta2);
                $("#counta3").html(data.counta3);
                $("#counta4").html(data.counta4);
                $("#countb1").html(data.countb1);
                $("#countb2").html(data.countb2);
                $("#countb3").html(data.countb3);
                $("#countb4").html(data.countb4);
                $("#countc1").html(data.countc1);
                $("#countc2").html(data.countc2);
                $("#countc3").html(data.countc3);
                $("#countc4").html(data.countc4);
                $("#countd1").html(data.countd1);
                $("#countd2").html(data.countd2);
                $("#countd3").html(data.countd3);
                $("#countd4").html(data.countd4);
                $("#counte1").html(data.counte1);
                $("#counte2").html(data.counte2);
                $("#counte3").html(data.counte3);
                $("#counte4").html(data.counte4);
                $("#countf1").html(data.countf1);
                $("#countf2").html(data.countf2);
                $("#countf3").html(data.countf3);
                $("#countf4").html(data.countf4);
                $("#countg1").html(data.countg1);
                $("#countg2").html(data.countg2);
                $("#countg3").html(data.countg3);
                $("#countg4").html(data.countg4);
                $("#counth1").html(data.counth1);
                $("#counth2").html(data.counth2);
                $("#counth3").html(data.counth3);
                $("#counth4").html(data.counth4);
            });
        });
    });
</script>
@endpush