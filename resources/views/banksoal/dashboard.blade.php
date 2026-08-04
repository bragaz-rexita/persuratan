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
                            @if (Session('previlage') == 'verifikator')
                                <li class="nav-item"><a href="#" class="nav-link" id="btnverifikasisoal"><i class="fa fa-clone"></i> Permohonan Verifikasi<span class="badge badge-primary float-right">{{$mohonverifikasi}}</span></a></li>
                                <li class="nav-item"><a href="#" class="nav-link" id="btnopenstatistik"><i class="fa fa-pencil"></i> Statistik</span></a></li>
                            @elseif (Session('previlage') == 'administarator')
                                <li class="nav-item"><a href="#" class="nav-link" id="btnbanksoal"><i class="fa fa-clone"></i> Verified / UnVerified <span class="badge badge-primary float-right">{{$soalterverifikasi}} / {{$soaltidakterverikasi}}</span></a></li>
                                <li class="nav-item"><a href="#" class="nav-link" id="btnverifikasisoal"><i class="fa fa-clone"></i> Permohonan Verifikasi<span class="badge badge-primary float-right">{{$mohonverifikasi}}</span></a></li>
                                <li class="nav-item"><a href="#" class="nav-link" id="btnopenkoreksi"><i class="fa fa-pencil"></i> Permohonan Koreksi<span class="badge badge-primary float-right">{{$koreksi}}</span></a></li>
                                <li class="nav-item"><a href="#" class="nav-link" id="btnopenstatistik"><i class="fa fa-pencil"></i> Statistik</span></a></li>
                                <li class="nav-item"><a href="#" class="nav-link" id="btntestlist"><i class="fa fa-check-square-o"></i> Ujian<span class="badge badge-primary float-right">{{$ujian}}</span></a></li>
                            @else
                                <li class="nav-item"><a href="#" class="nav-link" id="btnbanksoal"><i class="fa fa-clone"></i> Verified / UnVerified <span class="badge badge-primary float-right">{{$soalterverifikasi}} / {{$soaltidakterverikasi}}</span></a></li>
                                <li class="nav-item"><a href="#" class="nav-link" id="btnverifikasisoal"><i class="fa fa-clone"></i> Permohonan Verifikasi<span class="badge badge-primary float-right">{{$mohonverifikasi}}</span></a></li>
                                <li class="nav-item"><a href="#" class="nav-link" id="btnopenkoreksi"><i class="fa fa-pencil"></i> Permohonan Koreksi<span class="badge badge-primary float-right">{{$koreksi}}</span></a></li>
                            @endif
                            <li class="nav-item"><a href="#" class="nav-link" id="btnopenujianlisan"><i class="fa fa-users"></i> Penguji Ujian Lisan
                            @if (isset($merangkap) AND $merangkap == 'Penguji Lisan')
                            <span class="badge badge-success float-right"><i class="fa fa-check"></i></span>
                            @else 
                            <span class="badge badge-danger float-right"><i class="fa fa-ban"></i></span>
                            @endif
                            </a></li>
                        </ul>
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
                                <div class="col-lg-3 col-md-3">
                                    <label for="id_ceel">Kelainan</label>
                                    <select id="id_ceel" class="form-control">
                                        <option value="C">Congenital</option>
                                        <option value="I">Infeksi</option>
                                        <option value="N">Neoplasma</option>
                                        <option value="T">Trauma</option>
                                        <option value="A">Another</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <label for="id_kace">Pemeriksaan</label>
                                    <select id="id_kace" class="form-control">
                                        <option value="Konvensional">Konvensional</option>
                                        <option value="Canggih">Canggih</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-3" id="pilihankategori">
                                    <label for="id_code">Divisi</label>
                                    <select id="id_code" class="form-control">
                                        <option value="">Pilih Salah Satu</option>
                                        <option value="Neuroradiologi dan Head &amp; Neck">Neuroradiologi dan Head &amp; Neck</option>
                                        <option value="Toraks">Toraks</option>
                                        <option value="Abdomen (Gastro dan Urogenital)">Abdomen (Gastro dan Urogenital)</option>
                                        <option value="Pediatrik">Pediatrik</option>
                                        <option value="Muskuloskeletal">Muskuloskeletal</option>
                                        <option value="Payudara dan Reproduksi Perempuan">Payudara dan Reproduksi Perempuan</option>
                                        <option value="Radiologi Intervensi">Radiologi Intervensi</option>
                                        <option value="Kedokteran Nuklir">Kedokteran Nuklir</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-3" id="ketikkategori">
                                    <label for="id_code2">Divisi</label>
                                    <input type="text" class="form-control" placeholder="Write The Category Name" id="id_code2">
                                </div>
                                <div class="col-lg-3 col-md-3">
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
                                    <a href="https://inabr.or.id/boxed-bg.png" id="imagenumber1" data-toggle="lightbox" data-title="Picture 01" data-gallery="gallery">
                                        <img id="preview" src="https://inabr.or.id/boxed-bg.png?text=Pic1" class="img-fluid mb-2" alt="white sample" />
                                    </a>
                                </div>
                                <div class="col-sm-2" >
                                    <button class="btn btn-success pull-right" type="button" id="btnopenimage2"><i class="fa fa-instagram"></i></button>
                                    <button class="btn btn-warning pull-left" type="button" id="btnremoveimage2"><i class="fa fa-close"></i></button>
                                    <a href="https://inabr.or.id/boxed-bg.png" id="imagenumber2" data-toggle="lightbox" data-title="Picture 02" data-gallery="gallery">
                                        <img id="preview2" src="https://inabr.or.id/boxed-bg.png?text=Pic2" class="img-fluid mb-2" alt="white sample" />
                                    </a>
                                </div>
                                <div class="col-sm-2" >
                                    <button class="btn btn-success pull-right" type="button" id="btnopenimage3"><i class="fa fa-instagram"></i></button>
                                    <button class="btn btn-warning pull-left" type="button" id="btnremoveimage3"><i class="fa fa-close"></i></button>
                                    <a href="https://inabr.or.id/boxed-bg.png" id="imagenumber3" data-toggle="lightbox" data-title="Picture 03" data-gallery="gallery">
                                        <img id="preview3" src="https://inabr.or.id/boxed-bg.png?text=Pic3" class="img-fluid mb-2" alt="white sample" />
                                    </a>
                                </div>
                                <div class="col-sm-2" >
                                    <button class="btn btn-success pull-right" type="button" id="btnopenimage4"><i class="fa fa-instagram"></i></button>
                                    <button class="btn btn-warning pull-left" type="button" id="btnremoveimage4"><i class="fa fa-close"></i></button>
                                    <a href="https://inabr.or.id/boxed-bg.png" id="imagenumber4" data-toggle="lightbox" data-title="Picture 04" data-gallery="gallery">
                                        <img id="preview4" src="https://inabr.or.id/boxed-bg.png?text=Pic4" class="img-fluid mb-2" alt="white sample" />
                                    </a>
                                </div>
                                <div class="col-sm-2" >
                                    <button class="btn btn-success pull-right" type="button" id="btnopenimage5"><i class="fa fa-instagram"></i></button>
                                    <button class="btn btn-warning pull-left" type="button" id="btnremoveimage5"><i class="fa fa-close"></i></button>
                                    <a href="https://inabr.or.id/boxed-bg.png" id="imagenumber5" data-toggle="lightbox" data-title="Picture 05" data-gallery="gallery">
                                        <img id="preview5" src="https://inabr.or.id/boxed-bg.png?text=Pic5" class="img-fluid mb-2" alt="white sample" />
                                    </a>
                                </div>
                                <div class="col-sm-2" >
                                    <button class="btn btn-success pull-right" type="button" id="btnopenimage6"><i class="fa fa-instagram"></i></button>
                                    <button class="btn btn-warning pull-left" type="button" id="btnremoveimage6"><i class="fa fa-close"></i></button>
                                    <a href="https://inabr.or.id/boxed-bg.png" id="imagenumber6" data-toggle="lightbox" data-title="Picture 06" data-gallery="gallery">
                                        <img id="preview6" src="https://inabr.or.id/boxed-bg.png?text=Pic6" class="img-fluid mb-2" alt="white sample" />
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
                                <div class="col-lg-2">
                                    <select id="set_jenis" class="form-control">
                                        <option value="1">Semua Soal Aktif</option>
                                        <option value="2">Soal Un Verified</option>
                                        <option value="0">Soal Inaktif</option>
                                        <option value="Neuroradiologi dan Head &amp; Neck">Neuroradiologi dan Head &amp; Neck</option>
                                        <option value="Toraks">Toraks</option>
                                        <option value="Abdomen (Gastro dan Urogenital)">Abdomen (Gastro dan Urogenital)</option>
                                        <option value="Pediatrik">Pediatrik</option>
                                        <option value="Muskuloskeletal">Muskuloskeletal</option>
                                        <option value="Payudara dan Reproduksi Perempuan">Payudara dan Reproduksi Perempuan</option>
                                        <option value="Radiologi Intervensi">Radiologi Intervensi</option>
                                        <option value="Kedokteran Nuklir">Kedokteran Nuklir</option>
                                    </select>
                                </div>
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
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-info" id="btnopencaselistview"><i class="fa fa-tasks"></i> Case List</button>
                                </div>
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-info" id="btnopencaselistadd"><i class="fa fa-plus-circle"></i> Add Case</button>
                                </div>
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-danger" id="btnkembalidariinputtes"><i class="fa fa-reply"></i> Close</button>
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
                </div>
                <div class="card card-info card-outline" id="divkoreksi">
                    <div class="card-header">
                        <h3 class="card-title">Koreksi Ujian</h3>
                        <div class="card-tools" id="tombolkoreksiawal">
                            <button type="button" class="btn btn-tool" id="btnexportkoreksilist"><i class="fa fa-print"></i></button>
                            <button type="button" class="btn btn-tool btnkembali"><i class="fa fa-close"></i></button>
                        </div>
                        <div class="card-tools" id="tombolkoreksisoal">
                            <button type="button" class="btn btn-tool" id="btnexportkoreksisoal"><i class="fa fa-print"></i></button>
                            <button type="button" class="btn btn-tool" id="btnkembalikekoreksilist"><i class="fa fa-close"></i></button>
                        </div>
                    </div>
                    <div class="card-body" id="divkoreksilistpeserta">
                        <div class="form-group">
                            <div id="gridkoreksilistpeserta"></div>
                        </div>
                    </div>
                    <div class="card-body" id="divkoreksieditnilai">
                        <div class="form-group divesay">
                            <div class="row">
                                <div class="col-md-3"><img src="boxed-bg.png" alt="image" id="previewesay" width="100%"></div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="esay_jawaban" id="esay_deskripsi">Case Deskription</label>
                                        <textarea id="esay_jawaban" rows="5" cols="20"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group divchoice">
                            <table width="100%" border="0" class="table table-striped" cellpadding="0" cellspacing="0">
                                <tr>
                                <td rowspan="5"><img src="boxed-bg.png" alt="image" id="previewchoice" width="100%"></td>
                                <td colspan="5" valign="top"><p id="choice_deskripsi"></p></td>
                                </tr>
                                <tr>
                                    <td width="5%" valign="top" align="center">A</td>
                                    <td width="30%" valign="top"><p id="choice_opsia"></p></td>
                                    <td width="3%">&nbsp;</td>
                                    <td width="5%" valign="top" align="center">B</td>
                                    <td width="30%" valign="top"><p id="choice_opsib"></p></td>
                                </tr>
                                <tr>
                                    <td colspan="5">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="top" align="center">C</td>
                                    <td valign="top"><p id="choice_opsic"></p></td>
                                    <td>&nbsp;</td>
                                    <td valign="top" align="center">D</td>
                                    <td valign="top"><p id="choice_opsid"></p></td>
                                </tr>
                                <tr>
                                    <td colspan="5">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td valign="top" align="center">E</td>
                                    <td valign="top"><p id="choice_opsie"></p></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="input-group input-group-lg">
                                        <input type="text" id="koreksi_nilai" name="koreksi_nilai" class="form-control">
                                        <div class="input-group-append">
                                            <div class="btn btn-primary btn-lg" id="btnsavekoreksi">
                                                <i class="fa fa-pencil"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <input type="hidden" id="koreksi_id" name="koreksi_id" class="form-control">
                                    <div class="btn btn-danger btn-lg" id="btntutupkoreksinilai">
                                        <i class="fa fa-close"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" id="divkoreksilistsoal">
                        <div class="form-group">
                            <div id="gridkoreksilistsoal"></div>    
                        </div>
                    </div>
                </div>
                <div class="card card-info card-outline" id="divstatistik">
                    <div class="card-header">
                        <h3 class="card-title">Statistik</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool btnkembali"><i class="fa fa-close"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (Session('previlage') == 'administarator' OR Session('previlage') == 'verifikator')
                            <div class="col-lg-12">
                                <div class="input-group input-group-sm">
                                    <select id="statistik_nama" size="1" class="form-control select2">
                                        <option value="">Pilih SPV</option>
                                        @if (isset($kelompokspv) AND !empty($kelompokspv))
                                            @foreach($kelompokspv as $rows)
                                                <option value="{{$rows->email}}">{!! $rows->nama !!} ( {!! $rows->unit_kerja !!} )</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="input-group-append">
                                        <div class="btn btn-primary" id="btncaristatistik">
                                            <i class="fa fa-search"></i> View Statistik
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer">
                        <table class="table table-striped">
                            <thead>
                                <tr><th colspan="6" align="center"><p id="nama"></p></th></tr>
                                <tr>
                                    <th rowspan="2">TOPIK</th>
                                    <th colspan="2">MCQ</th>
                                    <th colspan="2">ESSAY</th>
                                </tr>
                                <tr>
                                    <th>Canggih</th>
                                    <th>Konven</th>
                                    <th>Canggih</th>
                                    <th>Konven</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>Neuroradiologi dan Head &amp; Neck</td><td  align="center"><p id="counta1"></td><td align="center"><p id="counta2"></p></td><td align="center"><p id="counta3"></p></td><td align="center"><p id="counta4"></p></td></tr>
                                <tr><td>Toraks</td><td align="center"><p id="countb1"></td><td align="center"><p id="countb2"></p></td><td align="center"><p id="countb3"></p></td><td align="center"><p id="countb4"></p></td></tr>
                                <tr><td>Abdomen (Gastro dan Urogenital)</td><td align="center"><p id="countc1"></td><td align="center"><p id="countc2"></p></td><td align="center"><p id="countc3"></p></td><td align="center"><p id="countc4"></p></td></tr>
                                <tr><td>Pediatrik</td><td align="center"><p id="countd1"></td><td align="center"><p id="countd2"></p></td><td align="center"><p id="countd3"></p></td><td align="center"><p id="countd4"></p></td></tr>
                                <tr><td>Muskuloskeletal</td><td align="center"><p id="counte1"></td><td align="center"><p id="counte2"></p></td><td align="center"><p id="counte3"></p></td><td align="center"><p id="counte4"></p></td></tr>
                                <tr><td>Payudara dan Reproduksi Perempuan</td><td align="center"><p id="countf1"></td><td align="center"><p id="countf2"></p></td><td align="center"><p id="countf3"></p></td><td align="center"><p id="countf4"></p></td></tr>
                                <tr><td>Radiologi Intervensi</td><td align="center"><p id="countg1"></td><td align="center"><p id="countg2"></p></td><td align="center"><p id="countg3"></p></td><td align="center"><p id="countg4"></p></td></tr>
                                <tr><td>Kedokteran Nuklir</td><td align="center"><p id="counth1"></td><td align="center"><p id="counth2"></p></td><td align="center"><p id="counth3"></p></td><td align="center"><p id="counth4"></p></td></tr>
                            </tbody>
                            <tfoot>
                                <tr><td align="center">TOTAL</td><td align="center" colspan="2"><p id="total12"></p></td><td align="center" colspan="2"><p id="total34"></p></td></tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12"  id="divverifikasisoal">
                <div class="card card-info card-outline">
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
                                        <div class="input-group input-group-sm">
                                            <select id="unverif_valcari" size="1" class="form-control select2">
                                                <option value="">Pilih SPV</option>
                                                @if (isset($kelompokspv) AND !empty($kelompokspv))
                                                    @foreach($kelompokspv as $rows)
                                                        <option value="{{$rows->id}}">{!! $rows->nama !!} ( {!! $rows->unit_kerja !!} )</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div class="input-group-append">
                                                <div class="btn btn-primary" id="btn-searchunverif">
                                                    <i class="fa fa-pencil"></i> Set As Verifikator (Check First)
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-lg-5 btn-group">
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
                        <div class="col-lg-5">
                            <label for="spv_peserta">Nama Peserta</label>
                            <input type="text" id="spv_peserta" name="spv_peserta" class="form-control" disabled="disable"/>
                        </div>
                        <div class="col-lg-3">
                            <label for="spv_nomor">No. Ujian</label>
                            <input type="text" id="spv_nomor" name="spv_nomor" class="form-control" disabled="disable" />
                        </div>
                        <div class="col-lg-4">
                            <label for="spv_asalpeserta">Asal</label>
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
                <input type="hidden" id="spv_id" name="spv_id" />
                <button type="button" class="btn btn-success pull-left" id="btnubahspv">Simpan</button>
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
    $(document).ready(function() {
        let summernoteOptions = {
            height: 300
        }
        $('#divstatistik').hide();
        $('#divkoreksi').hide();
        $('#divlistujian').hide();
        $("#divverifikasisoal").hide();
        $('#enteni').hide();
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
                $('#divlistujian').hide();
                $('#diveditsoal').hide();
                $('#divriwayat').hide();
                $('#divbanksoal').show();
                $('#diveditpeserta').hide();
                $('#divupload').hide();
                $('#divkoreksi').hide();
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
                var val02=val02+'-'+val13;
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
                        text	: 'Form Wajib di Lengkapi, Apabila ada data yg kosong / tidak diketahui, maka diberi tanda (-) / strip',
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
            $('#btnmultiverifikasi').click(function () {
                var rows = $("#gridsoalunverif").jqxGrid('selectedrowindexes');
                var selectedRecords = new Array();
                for (var m = 0; m < rows.length; m++) {
                    var row = $("#gridsoalunverif").jqxGrid('getrowdata', rows[m]);
                    if (row){
                        selectedRecords.push(row.idsoal);
                    }
                }
                if (m == 0){
                    swal({
                        title	: 'Stop',
                        text	: 'Soal Belum di Pilih',
                        type	: 'warning',
                    })
                } else {
                    $.post('{{ route("exInputBankSoal") }}', {  set01: 'verifikasimulti', set02: selectedRecords, set03: '', _token: '{{ csrf_token() }}' },
                        function(data){
                        $("#gridsoalunverif").jqxGrid('updatebounddata', 'filter');
                        swal({
                            title	: 'Info',
                            text	: data,
                            type	: 'warning',
                        })
                        return false;
                    });
                }
            });
            $('#btn-searchunverif').click(function () {
                var val01=document.getElementById('unverif_valcari').value;
                var rows = $("#gridsoalunverif").jqxGrid('selectedrowindexes');
                var selectedRecords = new Array();
                for (var m = 0; m < rows.length; m++) {
                    var row = $("#gridsoalunverif").jqxGrid('getrowdata', rows[m]);
                    if (row){
                        selectedRecords.push(row.idsoal);
                    }
                }
                if (m == 0){
                    swal({
                        title	: 'Stop',
                        text	: 'Soal Belum di Pilih',
                        type	: 'warning',
                    })
                } else {
                    $.post('{{ route("exInputBankSoal") }}', {  set01: 'setverifikator', set02: selectedRecords, set03: val01, _token: '{{ csrf_token() }}' },
                        function(data){
                        $("#gridsoalunverif").jqxGrid('updatebounddata', 'filter');
                        swal({
                            title	: 'Info',
                            text	: data,
                            type	: 'warning',
                        })
                        return false;
                    });
                }
            });
            $('#btnverifikasisoal').on('click', function (){
                $("#divverifikasisoal").show();
                $('.divawal').hide();
                $('.tampilanverifikasiawal').show();
                $('.tampilanverifikasi').hide();
                var previlage   = "{{Session('previlage')}}";
                var source      = {
                    datatype: "json",
                    datafields: [
                        { name: 'idsoal'},
                        { name: 'tipesoal', type: 'text'},
                        { name: 'jawaban', type: 'text'},
                        { name: 'deskripsi', type: 'text'},
                        { name: 'tlssoale', type: 'text'},
                        { name: 'kode', type: 'text'},
                        { name: 'fullkode', type: 'text'},
                        { name: 'ceel', type: 'text'},
                        { name: 'aktif', type: 'text'},
                        { name: 'inputor', type: 'text'},
                        { name: 'jawaba', type: 'text'},
                        { name: 'jawabb', type: 'text'},
                        { name: 'jawabc', type: 'text'},
                        { name: 'jawabd', type: 'text'},
                        { name: 'jawabe', type: 'text'},
                        { name: 'jawabf', type: 'text'},
                        { name: 'jawabg', type: 'text'},
                        { name: 'jawabh', type: 'text'},
                        { name: 'jawabi', type: 'text'},
                        { name: 'jawabj', type: 'text'},
                        { name: 'jawabk', type: 'text'},
                        { name: 'jawabl', type: 'text'},
                        { name: 'jawabm', type: 'text'},
                        { name: 'jawabn', type: 'text'},
                        { name: 'jawabo', type: 'text'},
                        { name: 'jawabp', type: 'text'},
                        { name: 'jawabq', type: 'text'},
                        { name: 'jawabr', type: 'text'},
                        { name: 'jawabs', type: 'text'},
                        { name: 'jawabt', type: 'text'},
                        { name: 'kuncie', type: 'text'},
                        { name: 'keterangan', type: 'text'},
                        { name: 'aktifview', type: 'text'},
                        { name: 'lampiran', type: 'text'},
                        { name: 'lampiran2', type: 'text'},
                        { name: 'lampiran3', type: 'text'},
                        { name: 'lampiran4', type: 'text'},
                        { name: 'lampiran5', type: 'text'},
                        { name: 'lampiran6', type: 'text'},
                        { name: 'deskripsitambahan', type: 'text'},
                        { name: 'tahun', type: 'text'},
                        { name: 'created_by', type: 'text'},
                        { name: 'fakultas', type: 'text'},
                        { name: 'fakpanjang', type: 'text'},
                        { name: 'verified_by', type: 'text'},
                    ],
                    type: 'POST',
                    data: {set01:'unverfied', set02:'', set03:'', _token: '{{ csrf_token() }}'},
                    url: '{{ route("jsonallcase") }}'
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                var statugenerator = function (row, column, value) {
                    var inputor     	= $('#gridsoalunverif').jqxGrid('getrowdata', row).inputor;
                    var verified_by     = $('#gridsoalunverif').jqxGrid('getrowdata', row).verified_by;
                    if (inputor == '' || inputor == null){
                        if (inputor == '' || inputor == null){
                            var renderlink 	= '<div style="background: white;"><button class="btn btn-danger btn-xs">New input</button></div>';
                        } else {
                            var renderlink 	= '<div style="background: white;"><button class="btn btn-success btn-xs">Assigned to kps '+verified_by+'</button></div>';
                        }
                    } else {
                        var renderlink 	= '<div style="background: white;"><button class="btn btn-warning btn-xs">Revisi, Verifikator : '+verified_by+'</button></div>';
                    }
                    return renderlink;
                }
                if (previlage == 'verifikator'){
                    $("#gridsoalunverif").jqxGrid({
                        width           : '100%',
                        pageable        : true,
                        filterable      : true,
                        showfilterrow   : true,
                        autoheight      : true,
                        source          : dataAdapter,
                        columnsresize   : true,
                        theme           : "energyblue",
                        selectionmode   : 'checkbox',
                        altrows         : true,
                        columns: [
                            { text: 'Edit', columntype: 'button', width: '7%', align: 'center', editable: false, sortable: false, filterable: false, cellsrenderer: function () {
                                return "Edit";
                                }, buttonclick: function (row) {
                                    editrow = row;	
                                    var offset 		= $("#gridsoalunverif").offset();
                                    var dataRecord 	= $("#gridsoalunverif").jqxGrid('getrowdata', editrow);
                                    if (dataRecord.jawaban == 'choice'){
                                        $('#divopsia').removeClass('col-lg-12 col-md-12').addClass('col-lg-4 col-md-4');
                                        $("#labelopsia").html('Option A');
                                        $('#id_optiona').summernote('destroy');
                                        $('.colkeys').show();
                                        $('.esay').show();
                                        $("#id_keys").val(dataRecord.kunci);
                                        $('.choice').show();
                                    } else if (dataRecord.jawaban == 'esay'){
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
                                    $("#id_fotoprofile").val('');
                                    $("#namafile1").val(dataRecord.lampiran);
                                    if (dataRecord.lampiran == ''){
                                        $('#imagenumber1').attr('href', 'boxed-bg.png');
                                        $('#preview').attr('src', 'boxed-bg.png');
                                    } else {
                                        $('#imagenumber1').attr('href', dataRecord.lampiran);
                                        $('#preview').attr('src', dataRecord.lampiran);
                                    }
                                    $("#id_fotoprofile2").val('');
                                    $("#namafile2").val(dataRecord.lampiran2);
                                    if (dataRecord.lampiran2 == ''){
                                        $('#imagenumber2').attr('href', 'boxed-bg.png');
                                        $('#preview2').attr('src', 'boxed-bg.png');
                                    } else {
                                        $('#imagenumber2').attr('href', dataRecord.lampiran2);
                                        $('#preview2').attr('src', dataRecord.lampiran2);
                                    }
                                    $("#id_fotoprofile3").val('');
                                    $("#namafile3").val(dataRecord.lampiran3);
                                    if (dataRecord.lampiran3 == ''){
                                        $('#imagenumber3').attr('href', 'boxed-bg.png');
                                        $('#preview3').attr('src', 'boxed-bg.png');
                                    } else {
                                        $('#imagenumber3').attr('href', dataRecord.lampiran3);
                                        $('#preview3').attr('src', dataRecord.lampiran3);
                                    }
                                    $("#id_fotoprofile4").val('');
                                    $("#namafile4").val(dataRecord.lampiran4);
                                    if (dataRecord.lampiran4 == ''){
                                        $('#imagenumber4').attr('href', 'boxed-bg.png');
                                        $('#preview4').attr('src', 'boxed-bg.png');
                                    } else {
                                        $('#imagenumber4').attr('href', dataRecord.lampiran4);
                                        $('#preview4').attr('src', dataRecord.lampiran4);
                                    }
                                    $("#id_fotoprofile5").val('');
                                    $("#namafile5").val(dataRecord.lampiran5);
                                    if (dataRecord.lampiran5 == ''){
                                        $('#imagenumber5').attr('href', 'boxed-bg.png');
                                        $('#preview5').attr('src', 'boxed-bg.png');
                                    } else {
                                        $('#preview5').attr('src', dataRecord.lampiran5);
                                        $('#imagenumber5').attr('href', dataRecord.lampiran5);
                                    }
                                    $("#id_fotoprofile6").val('');
                                    $("#namafile6").val(dataRecord.lampiran6);
                                    if (dataRecord.lampiran6 == ''){
                                        $('#imagenumber6').attr('href', 'boxed-bg.png');
                                        $('#preview6').attr('src', 'boxed-bg.png');
                                    } else {
                                        $('#preview6').attr('src', dataRecord.lampiran6);
                                        $('#imagenumber6').attr('href', dataRecord.lampiran6);
                                    }
                                    $('#ketikkategori').hide();
                                    $('#pilihankategori').show();
                                    const getmulai  = dataRecord.kode.split("-");
                                    var ceel        = getmulai[0];
                                    if(typeof(getmulai[1]) != "undefined" && getmulai[1] !== null) {
                                        var kace    = getmulai[1];
                                        $("#id_code").val(dataRecord.ceel);
                                    } else {
                                        const getmulai  = ceel.split("-");
                                        var ceel    = getmulai[0];
                                        if(typeof(getmulai[1]) != "undefined" && getmulai[1] !== null) {
                                            var kace    = getmulai[1];
                                        } else {
                                            var kace    = '';
                                        }
                                        $("#id_code").val(dataRecord.kode);
                                    }
                                    $("#id_ceel").val(ceel);
                                    $("#id_kace").val(kace);
                                    $("#id_tipe").val(dataRecord.jawaban);
                                    $("#edit_idne").val(dataRecord.idsoal);
                                    $('#id_deskripsi').summernote('code', dataRecord.deskripsi);
                                    $('#id_optiona').summernote('code', dataRecord.jawaba);
                                    $('#id_optionb').summernote('code', dataRecord.jawabb);
                                    $('#id_optionc').summernote('code', dataRecord.jawabc);
                                    $('#id_optiond').summernote('code', dataRecord.jawabd);
                                    $('#id_optione').summernote('code', dataRecord.jawabe);
                                    
                                    $('#divlistujian').hide();
                                    $('#diveditsoal').show();
                                    $('#divriwayat').hide();
                                    $('#divbanksoal').hide();
                                    $('#diveditpeserta').hide();
                                    $('#divupload').hide();
                                    $("#divverifikasisoal").hide();
                                    $('#divkoreksi').hide();
                                    $('.divawal').show();
                                }
                            },
                            { text: 'Instant Approval', editable: false, sortable: false, filterable: false, columntype: 'button', width: '12%', cellsrenderer: function () {
                                return "Approve";
                                }, buttonclick: function (row) {		
                                    editrow = row;	
                                    var offset 		= $("#gridsoalunverif").offset();		
                                    var dataRecord 	= $("#gridsoalunverif").jqxGrid('getrowdata', editrow);
                                    swal({
                                        title               : 'Apakah anda yakin ?',
                                        text                : "Soal Ini Akan Kami Aktifkan",
                                        type                : 'warning',
                                        showCancelButton    : true,
                                        confirmButtonClass  : 'btn btn-confirm mt-2',
                                        cancelButtonClass   : 'btn btn-cancel ml-2 mt-2',
                                        confirmButtonText   : 'Yes, Aktifkan'
                                    }).then(function () {
                                        $.post('{{ route("exInputBankSoal") }}', { set01: 'verifikasi', set02: dataRecord.idsoal, set03: '', _token: '{{ csrf_token() }}' },	
                                        function(data){
                                            swal({
                                                title	: 'Info',
                                                text	: data,
                                                type	: 'warning',
                                            })
                                            $("#gridsoalunverif").jqxGrid('updatebounddata', 'filter');
                                            return false;
                                        });
                                    });
                                }
                            },
                            { text: 'Approval', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', align: 'center', cellsrenderer: function () {
                                return "View";
                                }, buttonclick: function (row) {		
                                    editrow = row;	
                                    var offset 		= $("#gridsoalunverif").offset();		
                                    var dataRecord 	= $("#gridsoalunverif").jqxGrid('getrowdata', editrow);
                                    var kode        = dataRecord.kode;
                                    var ceel        = dataRecord.ceel;
                                    var tipesoal    = kode+' / '+ceel;
                                    if (dataRecord.lampiran == ''){
                                        $('#verimagenumber1').attr('href', 'boxed-bg.png');
                                        $('#verpreview').attr('src', 'boxed-bg.png');
                                    } else {
                                        $('#verimagenumber1').attr('href', dataRecord.lampiran);
                                        $('#verpreview').attr('src', dataRecord.lampiran);
                                    }
                                    if (dataRecord.lampiran2 == ''){
                                        $('#verimagenumber2').attr('href', 'boxed-bg.png');
                                        $('#verpreview2').attr('src', 'boxed-bg.png');
                                    } else {
                                        $('#verimagenumber2').attr('href', dataRecord.lampiran2);
                                        $('#verpreview2').attr('src', dataRecord.lampiran2);
                                    }
                                    if (dataRecord.lampiran3 == ''){
                                        $('#verimagenumber3').attr('href', 'boxed-bg.png');
                                        $('#verpreview3').attr('src', 'boxed-bg.png');
                                    } else {
                                        $('#verimagenumber3').attr('href', dataRecord.lampiran3);
                                        $('#verpreview3').attr('src', dataRecord.lampiran3);
                                    }
                                    if (dataRecord.lampiran4 == ''){
                                        $('#verimagenumber4').attr('href', 'boxed-bg.png');
                                        $('#verpreview4').attr('src', 'boxed-bg.png');
                                    } else {
                                        $('#verimagenumber4').attr('href', dataRecord.lampiran4);
                                        $('#verpreview4').attr('src', dataRecord.lampiran4);
                                    }
                                    if (dataRecord.lampiran5 == ''){
                                        $('#verimagenumber5').attr('href', 'boxed-bg.png');
                                        $('#verpreview5').attr('src', 'boxed-bg.png');
                                    } else {
                                        $('#verpreview5').attr('src', dataRecord.lampiran5);
                                        $('#verimagenumber5').attr('href', dataRecord.lampiran5);
                                    }
                                    if (dataRecord.lampiran6 == ''){
                                        $('#verimagenumber6').attr('href', 'boxed-bg.png');
                                        $('#verpreview6').attr('src', 'boxed-bg.png');
                                    } else {
                                        $('#verpreview6').attr('src', dataRecord.lampiran6);
                                        $('#verimagenumber6').attr('href', dataRecord.lampiran6);
                                    }
                                    $("#verifikasi_fakultas").html('hidden');
                                    $("#verifikasi_universitas").html('hidden');
                                    $("#verifikasi_email").html('hidden');
                                    $("#verifikasi_tlssoal").html(dataRecord.tlssoale);
                                    $("#verifikasi_tipesoal").html(tipesoal);
                                    $('#verifikasi_komentar').summernote('code', '');
                                    $("#verifikasi_id").val(dataRecord.idsoal);
                                    $('.tampilanverifikasiawal').hide();
                                    $('.tampilanverifikasi').show();
                                }
                            },
                            { text: 'Similarity', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsrenderer: function () {
                                return "Check";
                                }, buttonclick: function (row) {		
                                    editrow = row;	
                                    var offset 		= $("#gridsoalunverif").offset();		
                                    var dataRecord 	= $("#gridsoalunverif").jqxGrid('getrowdata', editrow);
                                    $.post('{{ route("exCeksoalkembar") }}', {  set01: dataRecord.deskripsi, _token: '{{ csrf_token() }}' },
                                    function(data){			
                                        var newWindow = window.open('', '', 'width=800, height=500'),
                                            document = newWindow.document.open(),
                                            pageContent =
                                                '<!DOCTYPE html>\n' +
                                                '<html>\n' +
                                                '<head>\n' +
                                                '<meta charset="utf-8" />\n' +
                                                '<title>Cek Result</title>\n' +
                                                '</head>\n' +
                                                '<body>' + data + '\n</body>\n</html>';
                                            document.write(pageContent);
                                            document.close();
                                    });
                                }
                            },
                            { text: 'Status', cellsrenderer: statugenerator, width: '14%', cellsalign: 'left', align: 'center'  },
                            { text: 'Description', datafield: 'tlssoale', width: '18%', cellsalign: 'left', align: 'center'  },
                            { text: 'Divisi', datafield: 'kode', width: '12%', cellsalign: 'left', align: 'center'  },
                            { text: 'Kelainan - Pemeriksaan', datafield: 'ceel', width: '12%', filtertype: 'checkedlist', cellsalign: 'left', align: 'center'  },
                            { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '6%', cellsrenderer: function () {
                                return "Del";
                                }, buttonclick: function (row) {		
                                    editrow = row;	
                                    var offset 		= $("#gridsoalunverif").offset();		
                                    var dataRecord 	= $("#gridsoalunverif").jqxGrid('getrowdata', editrow);
                                    swal({
                                        title               : 'Apakah anda yakin ?',
                                        text                : "Soal Ini Akan Kami Non Aktifkan, dan Bisa di Kembalikan ke Aktif apabila di Edit Kembali",
                                        type                : 'warning',
                                        showCancelButton    : true,
                                        confirmButtonClass  : 'btn btn-confirm mt-2',
                                        cancelButtonClass   : 'btn btn-cancel ml-2 mt-2',
                                        confirmButtonText   : 'Yes, Remove It'
                                    }).then(function () {
                                        $.post('{{ route("exInputBankSoal") }}', { set01: 'hapus', set02: dataRecord.idsoal, _token: '{{ csrf_token() }}' },	
                                        function(data){
                                            swal({
                                                title	: 'Info',
                                                text	: data,
                                                type	: 'warning',
                                            })
                                            $("#gridsoalunverif").jqxGrid('updatebounddata', 'filter');
                                            return false;
                                        });
                                    });
                                }
                            },
                        ]
                    });
                
                } 
                else {
                    $("#gridsoalunverif").jqxGrid({
                        width           : '100%',
                        pageable        : true,
                        filterable      : true,
                        showfilterrow   : true,
                        autoheight      : true,
                        source          : dataAdapter,
                        columnsresize   : true,
                        theme           : "energyblue",
                        selectionmode   : 'checkbox',
                        altrows         : true,
                        columns: [
                            { text: 'Edit', columntype: 'button', width: 60, align: 'center', editable: false, sortable: false, filterable: false, cellsrenderer: function () {
                                return "Edit";
                                }, buttonclick: function (row) {
                                    editrow = row;	
                                    var offset 		= $("#gridsoalunverif").offset();
                                    var dataRecord 	= $("#gridsoalunverif").jqxGrid('getrowdata', editrow);
                                    if (dataRecord.jawaban == 'choice'){
                                        $('#divopsia').removeClass('col-lg-12 col-md-12').addClass('col-lg-4 col-md-4');
                                        $("#labelopsia").html('Option A');
                                        $('#id_optiona').summernote('destroy');
                                        $('.colkeys').show();
                                        $('.esay').show();
                                        $("#id_keys").val(dataRecord.kunci);
                                        $('.choice').show();
                                    } else if (dataRecord.jawaban == 'esay'){
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
                                    $("#id_fotoprofile").val('');
                                    $("#namafile1").val(dataRecord.lampiran);
                                    if (dataRecord.lampiran == ''){
                                        $('#imagenumber1').attr('href', 'boxed-bg.png');
                                        $('#preview').attr('src', 'boxed-bg.png');
                                    } else {
                                        $('#imagenumber1').attr('href', dataRecord.lampiran);
                                        $('#preview').attr('src', dataRecord.lampiran);
                                    }
                                    $("#id_fotoprofile2").val('');
                                    $("#namafile2").val(dataRecord.lampiran2);
                                    if (dataRecord.lampiran2 == ''){
                                        $('#imagenumber2').attr('href', 'boxed-bg.png');
                                        $('#preview2').attr('src', 'boxed-bg.png');
                                    } else {
                                        $('#imagenumber2').attr('href', dataRecord.lampiran2);
                                        $('#preview2').attr('src', dataRecord.lampiran2);
                                    }
                                    $("#id_fotoprofile3").val('');
                                    $("#namafile3").val(dataRecord.lampiran3);
                                    if (dataRecord.lampiran3 == ''){
                                        $('#imagenumber3').attr('href', 'boxed-bg.png');
                                        $('#preview3').attr('src', 'boxed-bg.png');
                                    } else {
                                        $('#imagenumber3').attr('href', dataRecord.lampiran3);
                                        $('#preview3').attr('src', dataRecord.lampiran3);
                                    }
                                    $("#id_fotoprofile4").val('');
                                    $("#namafile4").val(dataRecord.lampiran4);
                                    if (dataRecord.lampiran4 == ''){
                                        $('#imagenumber4').attr('href', 'boxed-bg.png');
                                        $('#preview4').attr('src', 'boxed-bg.png');
                                    } else {
                                        $('#imagenumber4').attr('href', dataRecord.lampiran4);
                                        $('#preview4').attr('src', dataRecord.lampiran4);
                                    }
                                    $("#id_fotoprofile5").val('');
                                    $("#namafile5").val(dataRecord.lampiran5);
                                    if (dataRecord.lampiran5 == ''){
                                        $('#imagenumber5').attr('href', 'boxed-bg.png');
                                        $('#preview5').attr('src', 'boxed-bg.png');
                                    } else {
                                        $('#preview5').attr('src', dataRecord.lampiran5);
                                        $('#imagenumber5').attr('href', dataRecord.lampiran5);
                                    }
                                    $("#id_fotoprofile6").val('');
                                    $("#namafile6").val(dataRecord.lampiran6);
                                    if (dataRecord.lampiran6 == ''){
                                        $('#imagenumber6').attr('href', 'boxed-bg.png');
                                        $('#preview6').attr('src', 'boxed-bg.png');
                                    } else {
                                        $('#preview6').attr('src', dataRecord.lampiran6);
                                        $('#imagenumber6').attr('href', dataRecord.lampiran6);
                                    }
                                    $('#ketikkategori').hide();
                                    $('#pilihankategori').show();
                                    const getmulai  = dataRecord.kode.split("-");
                                    var ceel        = getmulai[0];
                                    if(typeof(getmulai[1]) != "undefined" && getmulai[1] !== null) {
                                        var kace    = getmulai[1];
                                        $("#id_code").val(dataRecord.ceel);
                                    } else {
                                        const getmulai  = ceel.split("-");
                                        var ceel    = getmulai[0];
                                        if(typeof(getmulai[1]) != "undefined" && getmulai[1] !== null) {
                                            var kace    = getmulai[1];
                                        } else {
                                            var kace    = '';
                                        }
                                        $("#id_code").val(dataRecord.kode);
                                    }
                                    $("#id_ceel").val(ceel);
                                    $("#id_kace").val(kace);
                                    $("#id_tipe").val(dataRecord.jawaban);
                                    $("#edit_idne").val(dataRecord.idsoal);
                                    $('#id_deskripsi').summernote('code', dataRecord.deskripsi);
                                    $('#id_optiona').summernote('code', dataRecord.jawaba);
                                    $('#id_optionb').summernote('code', dataRecord.jawabb);
                                    $('#id_optionc').summernote('code', dataRecord.jawabc);
                                    $('#id_optiond').summernote('code', dataRecord.jawabd);
                                    $('#id_optione').summernote('code', dataRecord.jawabe);
                                    
                                    $('#divlistujian').hide();
                                    $('#diveditsoal').show();
                                    $('#divriwayat').hide();
                                    $('#divbanksoal').hide();
                                    $('#diveditpeserta').hide();
                                    $('#divupload').hide();
                                    $("#divverifikasisoal").hide();
                                    $('#divkoreksi').hide();
                                    $('.divawal').show();
                                }
                            },
                            { text: 'Instant Approval', editable: false, sortable: false, filterable: false, columntype: 'button', width: 120, cellsrenderer: function () {
                                return "Approve";
                                }, buttonclick: function (row) {		
                                    editrow = row;	
                                    var offset 		= $("#gridsoalunverif").offset();		
                                    var dataRecord 	= $("#gridsoalunverif").jqxGrid('getrowdata', editrow);
                                    swal({
                                        title               : 'Apakah anda yakin ?',
                                        text                : "Soal Ini Akan Kami Aktifkan",
                                        type                : 'warning',
                                        showCancelButton    : true,
                                        confirmButtonClass  : 'btn btn-confirm mt-2',
                                        cancelButtonClass   : 'btn btn-cancel ml-2 mt-2',
                                        confirmButtonText   : 'Yes, Aktifkan'
                                    }).then(function () {
                                        $.post('{{ route("exInputBankSoal") }}', { set01: 'verifikasi', set02: dataRecord.idsoal, set03: '', _token: '{{ csrf_token() }}' },	
                                        function(data){
                                            swal({
                                                title	: 'Info',
                                                text	: data,
                                                type	: 'warning',
                                            })
                                            $("#gridsoalunverif").jqxGrid('updatebounddata', 'filter');
                                            return false;
                                        });
                                    });
                                }
                            },
                            { text: 'Approval', editable: false, sortable: false, filterable: false, columntype: 'button', width: 80, align: 'center', cellsrenderer: function () {
                                return "View";
                                }, buttonclick: function (row) {		
                                    editrow = row;	
                                    var offset 		= $("#gridsoalunverif").offset();		
                                    var dataRecord 	= $("#gridsoalunverif").jqxGrid('getrowdata', editrow);
                                    var kode        = dataRecord.kode;
                                    var ceel        = dataRecord.ceel;
                                    var tipesoal    = kode+' / '+ceel;
                                    if (dataRecord.lampiran == ''){
                                        $('#verimagenumber1').attr('href', 'boxed-bg.png');
                                        $('#verpreview').attr('src', 'boxed-bg.png');
                                    } else {
                                        $('#verimagenumber1').attr('href', dataRecord.lampiran);
                                        $('#verpreview').attr('src', dataRecord.lampiran);
                                    }
                                    if (dataRecord.lampiran2 == ''){
                                        $('#verimagenumber2').attr('href', 'boxed-bg.png');
                                        $('#verpreview2').attr('src', 'boxed-bg.png');
                                    } else {
                                        $('#verimagenumber2').attr('href', dataRecord.lampiran2);
                                        $('#verpreview2').attr('src', dataRecord.lampiran2);
                                    }
                                    if (dataRecord.lampiran3 == ''){
                                        $('#verimagenumber3').attr('href', 'boxed-bg.png');
                                        $('#verpreview3').attr('src', 'boxed-bg.png');
                                    } else {
                                        $('#verimagenumber3').attr('href', dataRecord.lampiran3);
                                        $('#verpreview3').attr('src', dataRecord.lampiran3);
                                    }
                                    if (dataRecord.lampiran4 == ''){
                                        $('#verimagenumber4').attr('href', 'boxed-bg.png');
                                        $('#verpreview4').attr('src', 'boxed-bg.png');
                                    } else {
                                        $('#verimagenumber4').attr('href', dataRecord.lampiran4);
                                        $('#verpreview4').attr('src', dataRecord.lampiran4);
                                    }
                                    if (dataRecord.lampiran5 == ''){
                                        $('#verimagenumber5').attr('href', 'boxed-bg.png');
                                        $('#verpreview5').attr('src', 'boxed-bg.png');
                                    } else {
                                        $('#verpreview5').attr('src', dataRecord.lampiran5);
                                        $('#verimagenumber5').attr('href', dataRecord.lampiran5);
                                    }
                                    if (dataRecord.lampiran6 == ''){
                                        $('#verimagenumber6').attr('href', 'boxed-bg.png');
                                        $('#verpreview6').attr('src', 'boxed-bg.png');
                                    } else {
                                        $('#verpreview6').attr('src', dataRecord.lampiran6);
                                        $('#verimagenumber6').attr('href', dataRecord.lampiran6);
                                    }
                                    $("#verifikasi_fakultas").html(dataRecord.fakultas);
                                    $("#verifikasi_universitas").html(dataRecord.fakpanjang);
                                    $("#verifikasi_email").html(dataRecord.created_by);
                                    $("#verifikasi_tlssoal").html(dataRecord.tlssoale);
                                    $("#verifikasi_tlssoal").html(dataRecord.tlssoale);
                                    $("#verifikasi_tlssoal").html(dataRecord.tlssoale);
                                    $("#verifikasi_tipesoal").html(tipesoal);
                                    $('#verifikasi_komentar').summernote('code', '');
                                    $("#verifikasi_id").val(dataRecord.idsoal);
                                    $('.tampilanverifikasiawal').hide();
                                    $('.tampilanverifikasi').show();
                                }
                            },
                            { text: 'Similarity', editable: false, sortable: false, filterable: false, columntype: 'button', width: 60, cellsrenderer: function () {
                                return "Check";
                                }, buttonclick: function (row) {		
                                    editrow = row;	
                                    var offset 		= $("#gridsoalunverif").offset();		
                                    var dataRecord 	= $("#gridsoalunverif").jqxGrid('getrowdata', editrow);
                                    $.post('{{ route("exCeksoalkembar") }}', {  set01: dataRecord.deskripsi, _token: '{{ csrf_token() }}' },
                                    function(data){			
                                        var newWindow = window.open('', '', 'width=800, height=500'),
                                            document = newWindow.document.open(),
                                            pageContent =
                                                '<!DOCTYPE html>\n' +
                                                '<html>\n' +
                                                '<head>\n' +
                                                '<meta charset="utf-8" />\n' +
                                                '<title>Cek Result</title>\n' +
                                                '</head>\n' +
                                                '<body>' + data + '\n</body>\n</html>';
                                            document.write(pageContent);
                                            document.close();
                                    });
                                }
                            },
                            { text: 'Status', cellsrenderer: statugenerator, width: 180, cellsalign: 'left', align: 'center'  },
                            { text: 'Description', datafield: 'tlssoale', width: 350, cellsalign: 'left', align: 'center'  },
                            { text: 'Divisi', datafield: 'kode', width: 150, cellsalign: 'left', align: 'center'  },
                            { text: 'Kelainan - Pemeriksaan', datafield: 'ceel', width: 150, filtertype: 'checkedlist', cellsalign: 'left', align: 'center'  },
                            { text: 'Inputor', datafield: 'created_by', width: 180, cellsalign: 'left', align: 'center'  },
                            { text: 'Universitas', datafield: 'fakpanjang', width: 180, cellsalign: 'left', align: 'center'  },
                            { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: 60, cellsrenderer: function () {
                                return "Del";
                                }, buttonclick: function (row) {		
                                    editrow = row;	
                                    var offset 		= $("#gridsoalunverif").offset();		
                                    var dataRecord 	= $("#gridsoalunverif").jqxGrid('getrowdata', editrow);
                                    swal({
                                        title               : 'Apakah anda yakin ?',
                                        text                : "Soal Ini Akan Kami Non Aktifkan, dan Bisa di Kembalikan ke Aktif apabila di Edit Kembali",
                                        type                : 'warning',
                                        showCancelButton    : true,
                                        confirmButtonClass  : 'btn btn-confirm mt-2',
                                        cancelButtonClass   : 'btn btn-cancel ml-2 mt-2',
                                        confirmButtonText   : 'Yes, Remove It'
                                    }).then(function () {
                                        $.post('{{ route("exInputBankSoal") }}', { set01: 'hapus', set02: dataRecord.idsoal, _token: '{{ csrf_token() }}' },	
                                        function(data){
                                            swal({
                                                title	: 'Info',
                                                text	: data,
                                                type	: 'warning',
                                            })
                                            $("#gridsoalunverif").jqxGrid('updatebounddata', 'filter');
                                            return false;
                                        });
                                    });
                                }
                            },
                        ]
                    });
                }
            });
            $("#btncloseapproval").click(function(){
                $('.tampilanverifikasiawal').show();
                $('.tampilanverifikasi').hide();
            });
            $("#btnapprove").click(function(){
                var val01 = document.getElementById('verifikasi_id').value;
                var val02 = $('#verifikasi_komentar').summernote('code');
                $.post('{{ route("exInputBankSoal") }}', { set01: 'verifikasi', set02: val01, set03: val02, _token: '{{ csrf_token() }}' }, function(data){
                    swal({
                        title	: 'Info',
                        text	: data,
                        type	: 'warning',
                    })
                    $("#gridsoalunverif").jqxGrid('updatebounddata', 'filter');
                    $('.tampilanverifikasiawal').show();
                    $('.tampilanverifikasi').hide();
                    return false;
                });
            });
            $("#btntolak").click(function(){
                var val01 = document.getElementById('verifikasi_id').value;
                var val02 = $('#verifikasi_komentar').summernote('code');
                if (val02 == ''){
                    swal({
                        title	: 'Mohon di Lengkapi',
                        text	: 'Mohon melengkapai komentar anda, atas penolakan soal ini',
                        type	: 'danger',
                    })
                } else {
                    $.post('{{ route("exInputBankSoal") }}', { set01: 'tolakverifikasi', set02: val01, set03: val02, _token: '{{ csrf_token() }}' }, function(data){
                        swal({
                            title	: 'Info',
                            text	: data,
                            type	: 'warning',
                        })
                        $("#gridsoalunverif").jqxGrid('updatebounddata', 'filter');
                        $('.tampilanverifikasiawal').show();
                        $('.tampilanverifikasi').hide();
                        return false;
                    });
                }
            });
        //END_BLOK_SOAL
        //START_BLOK_UJIAN
            $('#btntestlist').on('click', function (){
                $('#divkoreksi').hide();
                $('#daftarpeserta').hide();
                $('#diveditorujiancaselist').hide();
                $('#diveditorujian').hide();
                $('#daftarujian').show();
                $('#divlistujian').show();
                $('#diveditsoal').hide();
                $('#divriwayat').hide();
                $('#divbanksoal').hide();
                $('#diveditpeserta').hide();
                $('#divupload').hide();
                var sourcedetail = {
                    datatype: "json",
                    datafields: [
                        { name: 'id'},
                        { name: 'ceel', type: 'text'},
                        { name: 'kode', type: 'text'},
                        { name: 'mulai', type: 'text'},
                        { name: 'selesai', type: 'text'},
                        { name: 'tglmulai', type: 'text'},
                        { name: 'jammulai', type: 'text'},
                        { name: 'tglselesai', type: 'text'},
                        { name: 'jamselesai', type: 'text'},
                        { name: 'namaujian', type: 'text'},
                        { name: 'supervisor', type: 'text'},
                        { name: 'tlssupervisor', type: 'text'},
                        { name: 'tipe', type: 'text'},
                        { name: 'status', type: 'text'},
                        { name: 'marking', type: 'text'},
                        { name: 'timer', type: 'text'},
                        { name: 'jumlah', type: 'text'},
                        { name: 'peserta', type: 'text'},
                        { name: 'pengumuman', type: 'text'},
                    ],
                    type: 'POST',
                    data: {	set01: 'Master', set02:'Aktif', _token: '{{ csrf_token() }}' },
                    url:  '{{ route("jsonaktiftest") }}',
                };
                var datadetail = new $.jqx.dataAdapter(sourcedetail);
                $("#gridtest").jqxGrid({
                    width: '100%',
                    filterable: true,
                    columnsresize: true,
                    theme: "energyblue",
                    sortable: true,
                    autoheight: true,
                    pageable: true,
                    source: datadetail,
                    columns: [
                        { text: 'Edit', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', cellsrenderer: function () {
                            return "Edit";
                            }, buttonclick: function (row) {
                                editrow         = row;
                                var offset      = $("#gridtest").offset();
                                var dataRecord 	= $("#gridtest").jqxGrid('getrowdata', editrow);
                                var status      = dataRecord.status;
                                if (status == ''){
                                    var status  = 0;
                                }
                                $("#ujian_id").val(dataRecord.marking);
                                $("#ujian_nama").val(dataRecord.namaujian);
                                $("#ujian_tglmulai").val(dataRecord.tglmulai);
                                $("#ujian_jammulai").val(dataRecord.jammulai);
                                $("#ujian_tglselesai").val(dataRecord.tglselesai);
                                $("#ujian_jamselesai").val(dataRecord.jamselesai);
                                $("#ujian_status").val(status);
                                $("#ujian_timer").val(dataRecord.timer);
                                $('#daftarujian').hide();
                                $('#diveditorujiancaselist').show();
                                $('#diveditorujian').show();
                            }
                        },
                        { text: 'Try Out', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsrenderer: function () {
                            return "Start";
                            }, buttonclick: function (row) {
                                editrow = row;	
                                var offset 		= $("#gridtest").offset();		
                                var dataRecord 	= $("#gridtest").jqxGrid('getrowdata', editrow);
                                var cekpeserta  = dataRecord.peserta;
                                if (cekpeserta == 0){
                                    swal({
                                        title: 'Siapkah Memulai Ujian ?',
                                        text: "Timer Akan Aktif Apabila Telah Melewati Waktu Start Dan Soal Sudah di Buka",
                                        type: 'warning',
                                        showCancelButton: true,
                                        confirmButtonClass: 'btn btn-confirm mt-2',
                                        cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                                        confirmButtonText: 'Yes'
                                    }).then(function () {
                                        var set01		= dataRecord.marking;
                                        $.post('{{ route("exInputBankSoal") }}', { set01: 'tryout', set02: set01, _token: '{{ csrf_token() }}' },	function(data){
                                            var set03	= 'tryout';
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
                                                window.location.href = set03;
                                            }, 2000);
                                            return false;
                                        });	
                                    });
                                } else {
                                    swal({
                                        title : 'Stop',
                                        text  : 'Mohon maaf, tryout tidak bisa dilakukan apabila ujian telah memiliki peserta ujian',
                                        type  : 'warning',
                                    })
                                }
                            }
                        },
                        { text: 'Peserta', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', cellsrenderer: function () {
                            return "List";
                            }, buttonclick: function (row) {
                                editrow         = row;
                                var offset 		= $("#gridtest").offset();
                                var dataRecord 	= $("#gridtest").jqxGrid('getrowdata', editrow);
                                $('#daftarujian').hide();
                                $('#daftarpeserta').show();
                                $("#ujian_id").val(dataRecord.marking);
                                var sumberpeserta = {
                                    datatype: "json",
                                    datafields: [
                                        { name: 'id', type: 'text'},
                                        { name: 'marking', type: 'text'},
                                        { name: 'namapeserta', type: 'text'},
                                        { name: 'nomorpeserta', type: 'text'},
                                        { name: 'asalpeserta', type: 'text'},
                                        { name: 'supervisor', type: 'text'},
                                        { name: 'idmahasiswa', type: 'text'},
                                        { name: 'nilai', type: 'text'},
                                    ],
                                    type: 'POST',
                                    data: {	set01:'caripeserta', set02:'', set03:dataRecord.marking, _token: '{{ csrf_token() }}' },
                                    url: '{{ route("jsonallcase") }}',
                                };
                                var datadetail = new $.jqx.dataAdapter(sumberpeserta);
                                $("#gridpeserta").jqxGrid({
                                    width: '100%',
                                    filterable: true,
                                    columnsresize: true,
                                    showfilterrow: true,
                                    theme: "energyblue",
                                    sortable: true,
                                    autoheight: true,
                                    pageable: true,
                                    source: datadetail,
                                    altrows: true,
                                    columns: [
                                        { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', align: 'center', cellsrenderer: function () {
                                            return "Del";
                                            }, buttonclick: function (row) {
                                                editrow 		= row;	
                                                var offset 		= $("#gridpeserta").offset();		
                                                var dataRecord 	= $("#gridpeserta").jqxGrid('getrowdata', editrow);
                                                swal({
                                                    title: 'Apakah anda yakin ?',
                                                    text: "Peserta Ini Akan Kami Hapus Dari Peserta Ujian Ini, Apakah yakin ingin menghapus.?",
                                                    type: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonClass: 'btn btn-confirm mt-2',
                                                    cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                                                    confirmButtonText: 'Yes'
                                                }).then(function () {
                                                    $.post('{{ route("exInputBankSoal") }}', { set01: 'removepeserta', set02: dataRecord.idmahasiswa, set03: dataRecord.marking, _token: '{{ csrf_token() }}' },	
                                                        function(data){
                                                        swal({
                                                            title	: 'Info',
                                                            text	: data,
                                                            type	: 'warning',
                                                        })
                                                        $("#gridpeserta").jqxGrid('updatebounddata');
                                                        return false;
                                                    });
                                                });
                                            }
                                        },
                                        { text: 'Nama', datafield: 'namapeserta', width: '20%', cellsalign: 'left', align: 'center'  },
                                        { text: 'Nomor Urut', datafield: 'nomorpeserta', width: '14%', cellsalign: 'left', align: 'center'  },
                                        { text: 'Universitas', filtertype: 'checkedlist', datafield: 'asalpeserta', width: '20%', cellsalign: 'left', align: 'center'  },
                                        { text: 'Supervisor', filtertype: 'checkedlist', datafield: 'supervisor', width: '20%', cellsalign: 'left', align: 'center'  },
                                        { text: 'Nilai', filtertype: 'checkedlist', datafield: 'nilai', width: '8%', cellsalign: 'center', align: 'center'  },
                                        { text: 'Change SPV', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
                                            return "Change";
                                            }, buttonclick: function (row) {
                                                editrow 		= row;	
                                                var offset 		= $("#gridpeserta").offset();		
                                                var dataRecord 	= $("#gridpeserta").jqxGrid('getrowdata', editrow);
                                                $("#spv_peserta").val(dataRecord.namapeserta);
                                                $("#spv_nomor").val(dataRecord.nomorpeserta);
                                                $("#spv_asalpeserta").val(dataRecord.asalpeserta);
                                                $("#spv_peserta").val(dataRecord.namapeserta);
                                                $("#spv_nama").val(dataRecord.supervisor);
                                                $("#spv_id").val(dataRecord.id);
                                                $("#modalubahspv").modal('show');
                                            }
                                        },
                                    ]
                                });
                            }
                        },
                        { text: 'Pengumuman', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', cellsrenderer: function () {
                            return "On / Off";
                            }, buttonclick: function (row) {
                                editrow			= row;	
                                var offset		= $("#gridtest").offset();		
                                var dataRecord	= $("#gridtest").jqxGrid('getrowdata', editrow);
                                swal({
                                    title: 'Apakah anda yakin ?',
                                    text: "Data ujian ini akan dibuka, sehingga peserta ujian nantinya bisa melihat hasil ujiannya di laman ujian masing-masing peserta",
                                    type: 'warning',
                                    showCancelButton: true,
                                    confirmButtonClass: 'btn btn-confirm mt-2',
                                    cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                                    confirmButtonText: 'Yes'
                                }).then(function () {
                                    $.post('{{ route("exInputBankSoal") }}', { set01: 'onofpengumuman', set02: dataRecord.marking, set03: '', _token: '{{ csrf_token() }}' },	
                                        function(data){
                                        swal({
                                            title	: 'Info',
                                            text	: data,
                                            type	: 'warning',
                                        })
                                        $("#gridtest").jqxGrid('updatebounddata');
                                        return false;
                                    });
                                });
                            }
                        },
                        { text: 'Moodle', editable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '8%', cellsrenderer: function () { return "Export"; }, 
                            buttonclick: function (row) {
                                editrow = row;	
                                var offset 		= $("#gridtest").offset();
                                var dataRecord 	= $("#gridtest").jqxGrid('getrowdata', editrow);
                                $.post('{{ route("exaddtotxt") }}', {  set01: dataRecord.marking, _token: '{{ csrf_token() }}' },
                                function(data){			
                                    var newWindow = window.open('', '', 'width=800, height=500'),
                                        document = newWindow.document.open(),
                                        pageContent =
                                            '<!DOCTYPE html>\n' +
                                            '<html>\n' +
                                            '<head>\n' +
                                            '<meta charset="utf-8" />\n' +
                                            '<title>Moodle Format</title>\n' +
                                            '</head>\n' +
                                            '<body>' + data + '\n</body>\n</html>';
                                        document.write(pageContent);
                                        document.close();
                                });
                            }
                        },
                        { text: 'Exam Name', datafield: 'namaujian', width: '16%', align: 'center', cellsalign: 'left' },
                        { text: 'Start', datafield: 'mulai', width: '17%', align: 'center', cellsalign: 'left' },
                        { text: 'Finish', datafield: 'selesai', width: '17%', align: 'center', cellsalign: 'left' },
                        { text: 'Timer', datafield: 'timer', width: '6%', cellsalign: 'center', align: 'center' },
                        { text: 'Case', datafield: 'jumlah', width: '6%', cellsalign: 'center', align: 'center' },
                        { text: 'Participant', datafield: 'peserta', width: '9%', cellsalign: 'center', align: 'center' },
					    { text: 'Pengumuman', datafield: 'pengumuman', width: '10%', cellsalign: 'center', align: 'center' },
                    ]
                });
            });
            $('#btnarsipujian').on('click', function (){	
                $('#daftarpeserta').hide();
                $('#diveditorujiancaselist').hide();
                $('#diveditorujian').hide();
                $('#daftarujian').show();
                $('#divlistujian').show();
                $('#diveditsoal').hide();
                $('#divriwayat').hide();
                $('#divbanksoal').hide();
                $('#diveditpeserta').hide();
                $('#divupload').hide();
                var sourcedetail = {
                    datatype: "json",
                    datafields: [
                        { name: 'id'},
                        { name: 'ceel', type: 'text'},
                        { name: 'kode', type: 'text'},
                        { name: 'mulai', type: 'text'},
                        { name: 'selesai', type: 'text'},
                        { name: 'tglmulai', type: 'text'},
                        { name: 'jammulai', type: 'text'},
                        { name: 'tglselesai', type: 'text'},
                        { name: 'jamselesai', type: 'text'},
                        { name: 'namaujian', type: 'text'},
                        { name: 'supervisor', type: 'text'},
                        { name: 'tlssupervisor', type: 'text'},
                        { name: 'tipe', type: 'text'},
                        { name: 'status', type: 'text'},
                        { name: 'marking', type: 'text'},
                        { name: 'timer', type: 'text'},
                        { name: 'jumlah', type: 'text'},
                        { name: 'peserta', type: 'text'},
                        { name: 'aktif', type: 'text'},
                    ],
                    type: 'POST',
                    data: {	set01: 'Master', set02:'Arsip', _token: '{{ csrf_token() }}' },
                    url:  '{{ route("jsonaktiftest") }}',
                };
                var datadetail = new $.jqx.dataAdapter(sourcedetail);
                $("#gridtest").jqxGrid({
                    width: '100%',
                    filterable: true,
                    columnsresize: true,
                    theme: "energyblue",
                    sortable: true,
                    autoheight: true,
                    pageable: true,
                    source: datadetail,
                    columns: [
                        { text: 'Peserta', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', cellsrenderer: function () {
                            return "List";
                            }, buttonclick: function (row) {
                                editrow         = row;
                                var offset 		= $("#gridtest").offset();
                                var dataRecord 	= $("#gridtest").jqxGrid('getrowdata', editrow);
                                $('#daftarujian').hide();
                                $('#daftarpeserta').show();
                                $("#ujian_id").val(dataRecord.marking);
                                var sumberpeserta = {
                                    datatype: "json",
                                    datafields: [
                                        { name: 'idne', type: 'text'},
                                        { name: 'markingujian', type: 'text'},
                                        { name: 'nama', type: 'text'},
                                        { name: 'nip', type: 'text'},
                                        { name: 'tempatlahir', type: 'text'},
                                        { name: 'tanggallahir', type: 'text'},
                                        { name: 'jabatan', type: 'text'},
                                        { name: 'pangkat', type: 'text'},
                                        { name: 'golongan', type: 'text'},
                                        { name: 'jenis', type: 'text'},
                                        { name: 'unit', type: 'text'},
                                    ],
                                    type: 'POST',
                                    data: {	val01:'caripeserta', val02:'', val03:dataRecord.marking, _token: '{{ csrf_token() }}' },
                                    url: '{{ route("jgetdetailPeserta") }}',
                                };
                                var datadetail = new $.jqx.dataAdapter(sumberpeserta);
                                $("#gridpeserta").jqxGrid({
                                    width: '100%',
                                    filterable: true,
                                    columnsresize: true,
                                    showfilterrow: true,
                                    theme: "energyblue",
                                    sortable: true,
                                    autoheight: true,
                                    pageable: true,
                                    source: datadetail,
                                    altrows: true,
                                    columns: [
                                        { text: 'Nama', datafield: 'nama', width: '40%', cellsalign: 'left', align: 'center'  },
                                        { text: 'Nomor Peserta', datafield: 'nip', width: '30%', cellsalign: 'left', align: 'center'  },
                                        { text: 'Universitas', filtertype: 'checkedlist', datafield: 'unit', width: '30%', cellsalign: 'left', align: 'center'  },
                                    ]
                                });
                            }
                        },
                        { text: 'Exam Name', datafield: 'namaujian', width: '16%', align: 'center', cellsalign: 'left' },
                        { text: 'Start', datafield: 'mulai', width: '17%', align: 'center', cellsalign: 'left' },
                        { text: 'Finish', datafield: 'selesai', width: '17%', align: 'center', cellsalign: 'left' },
                        { text: 'Timer', datafield: 'timer', width: '6%', cellsalign: 'center', align: 'center' },
                        { text: 'Case', datafield: 'jumlah', width: '6%', cellsalign: 'center', align: 'center' },
                        { text: 'Participant', datafield: 'peserta', width: '9%', cellsalign: 'center', align: 'center' },
					    { text: 'Pengumuman', datafield: 'status', width: '10%', cellsalign: 'center', align: 'center' },
                    ]
                });
            });
            $('#btntambahujian').on('click', function (){
                $("#ujian_id").val('new');
                $('#daftarpeserta').hide();
                $('#daftarujian').hide();
                $('#diveditorujiancaselist').show();
                $('#diveditorujian').show();
            });
            $('#btnopencaselistview').on('click', function (){
                var val01=document.getElementById('ujian_id').value;
                if (val01 == 'new' || val01 == ''){
                    swal({
                        title	: 'Mohon di Lengkapi',
                        text	: 'Simpan Terlebih dahulu Ujian Ini',
                        type	: 'danger',
                    })
                } else {
                    var source = {
                        datatype: "json",
                        datafields: [
                            { name: 'idsoal'},
                            { name: 'tipesoal', type: 'text'},
                            { name: 'jawaban', type: 'text'},
                            { name: 'deskripsi', type: 'text'},
                            { name: 'tlssoale', type: 'text'},
                            { name: 'kode', type: 'text'},
                            { name: 'ceel', type: 'text'},
                            { name: 'aktif', type: 'text'},
                            { name: 'markingtes', type: 'text'},
                            { name: 'created_by', type: 'text'},
                            { name: 'aktifview', type: 'text'},
                            { name: 'lampiran', type: 'text'},
                            { name: 'tahun', type: 'text'},
                        ],
                        type: 'POST',
                        data: {set01:'soalaktif', set02:'all', set03:val01, _token: '{{ csrf_token() }}'},
                        url: '{{ route("jsonallcase") }}'
                    };
                    var dataAdapter = new $.jqx.dataAdapter(source);
                    $("#gridlistcase").jqxGrid({
                        width           : '100%',
                        pageable        : true,
                        filterable      : true,
                        showfilterrow   : true,
                        autoheight      : true,
                        source          : dataAdapter,
                        columnsresize   : true,
                        theme           : "energyblue",
                        selectionmode   : 'multiplecellsextended',
                        columns: [
                            { text: 'Description', datafield: 'deskripsi', width: '35%', cellsalign: 'left', align: 'center'  },
                            { text: 'Contributor', datafield: 'created_by', width: '13%', cellsalign: 'left', align: 'center'  },
                            { text: 'Type', filtertype: 'checkedlist', datafield: 'tipesoal', width: '10%', cellsalign: 'left', align: 'center'  },
                            { text: 'Code', filtertype: 'checkedlist', datafield: 'kode', width: '15%', cellsalign: 'left', align: 'center'  },
                            { text: 'Category', filtertype: 'checkedlist', datafield: 'ceel', width: '15%', cellsalign: 'left', align: 'center'  },
                            { text: 'Year', datafield: 'tahun', width: '5%', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  },
                            { text: 'Remove', columntype: 'button', width: '7%', editable: false, sortable: false, filterable: false, cellsrenderer: function () { return "Del";
                                }, buttonclick: function (row) {
                                    editrow             = row;
                                    var offset 		    = $("#gridlistcase").offset();
                                    var dataRecord 	    = $("#gridlistcase").jqxGrid('getrowdata', editrow);
                                    var set01		    = dataRecord.idsoal;
                                    $.post('{{ route("aktifet") }}', { val01: set01, val02: 'remove', val03: dataRecord.markingtes, _token: '{{ csrf_token() }}' },
                                    function(data){
                                        $("#messagetest").html(data);
                                        $("#gridlistcase").jqxGrid('updatebounddata','filter');
                                        return false;
                                    });
                                }
                            },
                        ]
                    });
                }
            });
            $('#btnopencaselistadd').on('click', function (){
                var val01=document.getElementById('ujian_id').value;
                if (val01 == 'new' || val01 == ''){
                    swal({
                        title	: 'Mohon di Lengkapi',
                        text	: 'Simpan Terlebih dahulu Ujian Ini',
                        type	: 'danger',
                    })
                } else {
                    var source = {
                        datatype: "json",
                        datafields: [
                            { name: 'idsoal'},
                            { name: 'tipesoal', type: 'text'},
                            { name: 'jawaban', type: 'text'},
                            { name: 'deskripsi', type: 'text'},
                            { name: 'tlssoale', type: 'text'},
                            { name: 'kode', type: 'text'},
                            { name: 'ceel', type: 'text'},
                            { name: 'aktif', type: 'text'},
                            { name: 'markingtes', type: 'text'},
                            { name: 'created_by', type: 'text'},
                            { name: 'aktifview', type: 'text'},
                            { name: 'lampiran', type: 'text'},
                            { name: 'tahun', type: 'text'},
                        ],
                        type: 'POST',
                        data: {set01:'carisoal', set02:'all', set03:val01, _token: '{{ csrf_token() }}'},
                        url: '{{ route("jsonallcase") }}'
                    };
                    var dataAdapter = new $.jqx.dataAdapter(source);
                    $("#gridlistcase").jqxGrid({
                        width           : '100%',
                        pageable        : true,
                        filterable      : true,
                        showfilterrow   : true,
                        autoheight      : true,
                        source          : dataAdapter,
                        columnsresize   : true,
                        theme           : "energyblue",
                        selectionmode   : 'multiplecellsextended',
                        columns: [
                            { text: 'Select', columntype: 'button', width: '7%', editable: false, sortable: false, filterable: false, cellsrenderer: function () { return "Select";
                                }, buttonclick: function (row) {
                                    editrow             = row;
                                    var offset 		    = $("#gridlistcase").offset();
                                    var dataRecord 	    = $("#gridlistcase").jqxGrid('getrowdata', editrow);
                                    var set01		    = dataRecord.idsoal;
                                    $.post('{{ route("aktifet") }}', { val01: set01, val02: 'input', val03: dataRecord.markingtes, _token: '{{ csrf_token() }}' },
                                    function(data){
                                        $("#messagetest").html(data);
                                        $("#gridlistcase").jqxGrid('updatebounddata','filter');
                                        return false;
                                    });
                                }
                            },
                            { text: 'Description', datafield: 'deskripsi', width: '35%', cellsalign: 'left', align: 'center'  },
                            { text: 'Contributor', datafield: 'created_by', width: '13%', cellsalign: 'left', align: 'center'  },
                            { text: 'Type', filtertype: 'checkedlist', datafield: 'tipesoal', width: '10%', cellsalign: 'left', align: 'center'  },
                            { text: 'Code', filtertype: 'checkedlist', datafield: 'kode', width: '15%', cellsalign: 'left', align: 'center'  },
                            { text: 'Category', filtertype: 'checkedlist', datafield: 'ceel', width: '15%', cellsalign: 'left', align: 'center'  },
                            { text: 'Year', datafield: 'tahun', width: '5%', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  },
                        ]
                    });
                }
            });
            $('#btnkembalidariinputpeserta').click(function () {
                $('#daftarujian').show();
                $('#daftarpeserta').hide();
                $("#gridtest").jqxGrid('updatebounddata');
            });
            $('#btnkembalidariinputtes').click(function () {
                $('#daftarujian').show();
                $('#diveditorujian').hide();
                $('#diveditorujiancaselist').hide();
                $("#gridtest").jqxGrid('updatebounddata');
            });
            $('#btnsimpanujian').click(function () {
                $('#diveditorujiancaselist').hide();
                $('#diveditorujian').hide();
                $('#enteni').show();
                var set01 = document.getElementById('ujian_nama').value;
                var set02 = document.getElementById('ujian_tglmulai').value;
                var set03 = document.getElementById('ujian_jammulai').value;
                var set04 = document.getElementById('ujian_tglselesai').value;
                var set05 = document.getElementById('ujian_jamselesai').value;
                var set06 = document.getElementById('ujian_status').value;
                var set07 = document.getElementById('ujian_id').value;
                var set08 = document.getElementById('ujian_timer').value;
                var set09 = document.getElementById('id_code').value;
                $.post('{{ route("exAddTest") }}', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, lists: null, _token: '{{ csrf_token() }}' },function(data){
                    var status  = data.status;
                    var message = data.message;
                    var warna 	= data.warna;
                    var icon 	= data.icon;
                    $("#ujian_id").val(data.marking);
                                
                    $.toast({
                        heading: status,
                        text: message,
                        position: 'top-right',
                        loaderBg: warna,
                        icon: icon,
                        hideAfter: 5000,
                        stack: 1
                    });
                    $('#enteni').hide();
                    $('#diveditorujiancaselist').show();
                    $('#diveditorujian').show();
                    return false;
                });
            });
            $('#btninputpeserta').click(function () {
                var set01 = document.getElementById('ujian_idpeserta').value;
                var set02 = document.getElementById('ujian_id').value;
                $.post('{{ route("exAddPesertaTest") }}', { val01: set01, val02: set02, val03: 'any', _token: '{{ csrf_token() }}' },
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
                    
                    $("#gridpeserta").jqxGrid('updatebounddata', 'filter');
                    return false;
                });
            });
            $("#btnubahspv").click(function(){
                var set01 = document.getElementById('spv_nama').value;
                var set02 = document.getElementById('spv_id').value;
                if (set01 == ''){
                    swal({
                        title	: 'Stop',
                        text	: 'Mohon Tentukan SPV Pengganti',
                        type	: 'warning',
                    })
                } else {
                    var form_data = new FormData();
                        form_data.append('set01', 'ubahspv');
                        form_data.append('set02', set01);
                        form_data.append('set03', set02);
                        form_data.append('file', null);
                        form_data.append('_token', '{{csrf_token()}}');
                    $("#modalubahspv").modal('hide');
                    $.ajax({
                        url         : '{{ route("exInputBankSoal") }}',
                        data        : form_data,
                        type        : 'POST',
                        contentType : false,
                        processData : false,
                        success     : function (data) {
                            $.toast({
                                heading: 'Info',
                                text: data,
                                position: 'top-right',
                                loaderBg: '#bf441d',
                                icon: 'success',
                                hideAfter: 5000,
                                stack: 1
                            });
                            $("#gridpeserta").jqxGrid('updatebounddata', 'filter');
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
            $('#btneksportpeserta').click(function(){
                var gridContent = $("#gridpeserta").jqxGrid('exportdata', 'json');
                data = $.parseJSON(gridContent);
                var noOfContacts = data.length;
                if(noOfContacts>0){
                    var table = document.createElement("table");
                        table.style.width = '100%';
                        table.setAttribute('border', '1');
                        table.setAttribute('cellspacing', '0');
                        table.setAttribute('cellpadding', '5');
                        table.setAttribute('id', 'tabelcetak');
                        table.setAttribute('class', 'text');
                    var col = [];
                    for (var i = 0; i < noOfContacts; i++) {
                        for (var key in data[i]) {
                            if (col.indexOf(key) === -1) {
                                col.push(key);
                            }
                        }
                    }
                    var tHead = document.createElement("thead");
                    var hRow = document.createElement("tr");
                    for (var i = 0; i < col.length; i++) {
                            var th = document.createElement("th");
                            th.innerHTML = col[i];
                            hRow.appendChild(th);
                    }
                    tHead.appendChild(hRow);
                    table.appendChild(tHead);
                    var tBody = document.createElement("tbody");
                    for (var i = 0; i < noOfContacts; i++) {
                        var bRow = document.createElement("tr");
                        for (var j = 0; j < col.length; j++) {
                            var td 		= document.createElement("td");
                            var isi 	= data[i][col[j]];
                            var isi2 	= isi.toString();
                            var pjg 	= isi2.length;
                            if (pjg > 8){
                                if (pjg == 9 || pjg == 10){
                                    if( isi2.indexOf(',') != -1 ){
                                        var res = isi2.replace(/,/g, "");
                                        td.innerHTML = res;
                                    }
                                    else {
                                        var res = isi2;
                                        td.setAttribute('style', 'mso-number-format: "\@";');
                                        td.innerHTML = res;
                                    }
                                }
                                else { 
                                    var res = isi2;
                                    td.setAttribute('style', 'mso-number-format: "\@";');
                                    td.innerHTML = res;
                                }						
                            }
                            else {
                                var res = isi2.replace(/,/g, "");
                                td.innerHTML = res;
                            }
                                
                            bRow.appendChild(td);
                        }
                        tBody.appendChild(bRow)
                    }
                    table.appendChild(tBody);
                    var divContainer = document.getElementById("tabel_cetak");
                        divContainer.innerHTML = "";
                        divContainer.appendChild(table);
                }
                
                $("#tabel_cetak").btechco_excelexport({
                    containerid: "tabel_cetak"
                    , datatype: $datatype.Table
                });
                return false;
            });
        //END_BLOK_UJIAN
        //START_BLOK_KOREKSI
            $('#btnopenkoreksi').on('click', function (){
                $('#divkoreksi').show();
                $('#divkoreksilistpeserta').show();
                $('#divkoreksieditnilai').hide();
                $('#tombolkoreksiawal').show();
                $('#tombolkoreksisoal').hide();
                $('#divkoreksilistsoal').hide();
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
                var sumberpeserta = {
                    datatype: "json",
                    datafields: [
                        { name: 'id', type: 'text'},
                        { name: 'marking', type: 'text'},
                        { name: 'namapeserta', type: 'text'},
                        { name: 'nomorpeserta', type: 'text'},
                        { name: 'asalpeserta', type: 'text'},
                        { name: 'supervisor', type: 'text'},
                        { name: 'idmahasiswa', type: 'text'},
                        { name: 'nilai', type: 'text'},
                        { name: 'tanggal', type: 'text'},
                        { name: 'namaujian', type: 'text'},
                        { name: 'nilai', type: 'text'},
                    ],
                    type: 'POST',
                    data: {	set01:'koreksipeserta', set02:'', set03:'', _token: '{{ csrf_token() }}' },
                    url: '{{ route("jsonallcase") }}',
                };
                var datadetail = new $.jqx.dataAdapter(sumberpeserta);
                $("#gridkoreksilistpeserta").jqxGrid({
                    width: '100%',
                    filterable: true,
                    columnsresize: true,
                    showfilterrow: true,
                    theme: "energyblue",
                    sortable: true,
                    autoheight: true,
                    pageable: true,
                    source: datadetail,
                    altrows: true,
                    columns: [
                        { text: 'Nomor Urut', datafield: 'nomorpeserta', width: '15%', cellsalign: 'left', align: 'center'  },
                        { text: 'Nama Ujian', datafield: 'namaujian', width: '35%', cellsalign: 'left', align: 'center'  },
                        { text: 'Tanggal', datafield: 'tanggal', width: '30%', cellsalign: 'left', align: 'center'  },
                        { text: 'Nilai', filtertype: 'checkedlist', datafield: 'nilai', width: '10%', cellsalign: 'center', align: 'center'  },
                        { text: 'Detail', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
                            return "View";
                            }, buttonclick: function (row) {
                                editrow 		= row;	
                                var offset 		= $("#gridkoreksilistpeserta").offset();		
                                var dataRecord 	= $("#gridkoreksilistpeserta").jqxGrid('getrowdata', editrow);
                                $('#divkoreksilistpeserta').hide();
                                $('#divkoreksieditnilai').hide();
                                $('#divkoreksilistsoal').show();
                                $('#tombolkoreksiawal').hide();
                                $('#tombolkoreksisoal').show();
                                var sourcehasilperpeserta = {
                                    datatype: "json",
                                    datafields: [
                                        { name: 'id', type: 'text'},
                                        { name: 'ceel', type: 'text'},
                                        { name: 'kode', type: 'text'},
                                        { name: 'tanggal', type: 'text'},
                                        { name: 'namaujian', type: 'text'},
                                        { name: 'supervisor', type: 'text'},
                                        { name: 'namapeserta', type: 'text'},
                                        { name: 'nomorpeserta', type: 'text'},
                                        { name: 'asalpeserta', type: 'text'},
                                        { name: 'idmahasiswa', type: 'text'},
                                        { name: 'idtest', type: 'text'},
                                        { name: 'idsoal', type: 'text'},
                                        { name: 'urutan', type: 'text'},
                                        { name: 'jawaban', type: 'text'},
                                        { name: 'kunci', type: 'text'},
                                        { name: 'skore', type: 'text'},
                                        { name: 'marking', type: 'text'},
                                        { name: 'pengumuman', type: 'text'},
                                        { name: 'status', type: 'text'},
                                        { name: 'updated_at', type: 'text'},
                                    ],
                                    type: 'POST',
                                    data: {	set01:'koreksilist', set02:dataRecord.idmahasiswa, set03:dataRecord.marking, _token: '{{ csrf_token() }}' },
                                    url: '{{ route("jsonallcase") }}',
                                };
                                var djsonhasilujian = new $.jqx.dataAdapter(sourcehasilperpeserta);
                                $("#gridkoreksilistsoal").jqxGrid({
                                    width: '100%',
                                    filterable: true,
                                    columnsresize: true,
                                    sortable: true,
                                    autoheight: true,
                                    pageable: true,
                                    source: djsonhasilujian,
                                    altrows: true,
                                    columns: [
                                        { text: 'Nomor Urut', datafield: 'nomorpeserta', width: '15%', cellsalign: 'left', align: 'center'  },
                                        { text: 'Nama Ujian', datafield: 'namaujian', width: '20%', cellsalign: 'left', align: 'center'  },
                                        { text: 'Tanggal', datafield: 'tanggal', width: '15%', cellsalign: 'left', align: 'center'  },
                                        { text: 'ID Soal', datafield: 'idsoal', width: '10%', cellsalign: 'center', align: 'center'  },
                                        { text: 'Jawaban', datafield: 'jawaban', width: '10%', cellsalign: 'center', align: 'center'  },
                                        { text: 'Kunci Jawaban', datafield: 'kunci', width: '10%', cellsalign: 'center', align: 'center'  },
                                        { text: 'Nilai', datafield: 'skore', width: '10%', cellsalign: 'center', align: 'center'  },
                                        { text: 'Edit', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
                                            return "Edit";
                                            }, buttonclick: function (row) {
                                                editrow 		= row;	
                                                var offset 		= $("#gridkoreksilistsoal").offset();		
                                                var dataRecord 	= $("#gridkoreksilistsoal").jqxGrid('getrowdata', editrow);
                                                $('#koreksi_id').val(dataRecord.id);
                                                $('#koreksi_nilai').val(dataRecord.skore);
                                                $.post('{{ route("getFirstDataUjian") }}', { val01: dataRecord.id, _token: '{{ csrf_token() }}' },function(data){
                                                    var deskripsi = data.deskripsi;
                                                    var opsia     = data.opsia;
                                                    var opsib     = data.opsib;
                                                    var opsic     = data.opsic;
                                                    var opsid     = data.opsid;
                                                    var opsie     = data.opsie;
                                                    var lampiran  = data.lampiran;
                                                    var jenissoal = data.jenissoal;
                                                    if (jenissoal == 'esay'){
                                                        $('.divesay').show();
                                                        $('.divchoice').hide();
                                                        if (lampiran == ''){
                                                            $('#previewesay').attr('src', 'boxed-bg.png');
                                                        } else {
                                                            $('#previewesay').attr('src', lampiran);
                                                        }
                                                        $('#esay_deskripsi').html(deskripsi);
                                                        $('#esay_jawaban').summernote('code', opsia);
                                                    } else {
                                                        $('.divesay').hide();
                                                        $('.divchoice').show();
                                                        if (lampiran == ''){
                                                            $('#previewchoice').attr('src', 'boxed-bg.png');
                                                        } else {
                                                            $('#previewchoice').attr('src', lampiran);
                                                        }
                                                        $('#choice_deskripsi').html(deskripsi);
                                                        $('#choice_opsia').html(opsia);
                                                        $('#choice_opsib').html(opsib);
                                                        $('#choice_opsic').html(opsic);
                                                        $('#choice_opsid').html(opsid);
                                                        $('#choice_opsie').html(opsie);
                                                    }
                                                    $("html, body").animate({ scrollTop: 0 }, "slow");
                                                    $('#divkoreksilistpeserta').hide();
                                                    $('#divkoreksieditnilai').show();
                                                    $('#divkoreksilistsoal').hide();
                                                });
                                            }
                                        },
                                    ]
                                });
                            }
                        },
                    ]
                });
            });
            $("#btntutupkoreksinilai").click(function(){
                $('#divkoreksilistsoal').show();
                $('#divkoreksieditnilai').hide();
            });
            $("#btnkembalikekoreksilist").click(function(){
                $('#divkoreksilistsoal').hide();
                $('#divkoreksilistpeserta').show();
                $('#tombolkoreksiawal').show();
                $('#tombolkoreksisoal').hide();
                $("#gridkoreksilistpeserta").jqxGrid('updatebounddata', 'filter');
                    
            });
            $('#btnexportkoreksilist').click(function(){			
                var gridContent = $("#gridkoreksilistpeserta").jqxGrid('exportdata', 'json');
                data = $.parseJSON(gridContent);
                var noOfContacts = data.length;
                if(noOfContacts>0){
                    var table = document.createElement("table");
                        table.style.width = '100%';
                        table.setAttribute('border', '1');
                        table.setAttribute('cellspacing', '0');
                        table.setAttribute('cellpadding', '5');
                        table.setAttribute('id', 'tabelcetak');
                        table.setAttribute('class', 'text');
                    var col = [];
                    for (var i = 0; i < noOfContacts; i++) {
                        for (var key in data[i]) {
                            if (col.indexOf(key) === -1) {
                                col.push(key);
                            }
                        }
                    }
                    var tHead = document.createElement("thead");
                    var hRow = document.createElement("tr");
                    for (var i = 0; i < col.length; i++) {
                            var th = document.createElement("th");
                            th.innerHTML = col[i];
                            hRow.appendChild(th);
                    }
                    tHead.appendChild(hRow);
                    table.appendChild(tHead);
                    var tBody = document.createElement("tbody");
                    for (var i = 0; i < noOfContacts; i++) {
                        var bRow = document.createElement("tr");
                        for (var j = 0; j < col.length; j++) {
                            var td 		= document.createElement("td");
                            var isi 	= data[i][col[j]];
                            var isi2 	= isi.toString();
                            var pjg 	= isi2.length;
                            if (pjg > 8){
                                if (pjg == 9 || pjg == 10){
                                    if( isi2.indexOf(',') != -1 ){
                                        var res = isi2.replace(/,/g, "");
                                        td.innerHTML = res;
                                    }
                                    else {
                                        var res = isi2;
                                        td.setAttribute('style', 'mso-number-format: "\@";');
                                        td.innerHTML = res;
                                    }
                                }
                                else { 
                                    var res = isi2;
                                    td.setAttribute('style', 'mso-number-format: "\@";');
                                    td.innerHTML = res;
                                }						
                            }
                            else {
                                var res = isi2.replace(/,/g, "");
                                td.innerHTML = res;
                            }
                                
                            bRow.appendChild(td);
                        }
                        tBody.appendChild(bRow)
                    }
                    table.appendChild(tBody);
                    var divContainer = document.getElementById("tabel_cetak");
                        divContainer.innerHTML = "";
                        divContainer.appendChild(table);
                }
                
                $("#tabel_cetak").btechco_excelexport({
                    containerid: "tabel_cetak"
                    , datatype: $datatype.Table
                });
                return false;
            });
            $('#btnexportkoreksisoal').click(function(){			
                var gridContent = $("#gridkoreksilistsoal").jqxGrid('exportdata', 'json');
                data = $.parseJSON(gridContent);
                var noOfContacts = data.length;
                if(noOfContacts>0){
                    var table = document.createElement("table");
                        table.style.width = '100%';
                        table.setAttribute('border', '1');
                        table.setAttribute('cellspacing', '0');
                        table.setAttribute('cellpadding', '5');
                        table.setAttribute('id', 'tabelcetak');
                        table.setAttribute('class', 'text');
                    var col = [];
                    for (var i = 0; i < noOfContacts; i++) {
                        for (var key in data[i]) {
                            if (col.indexOf(key) === -1) {
                                col.push(key);
                            }
                        }
                    }
                    var tHead = document.createElement("thead");
                    var hRow = document.createElement("tr");
                    for (var i = 0; i < col.length; i++) {
                            var th = document.createElement("th");
                            th.innerHTML = col[i];
                            hRow.appendChild(th);
                    }
                    tHead.appendChild(hRow);
                    table.appendChild(tHead);
                    var tBody = document.createElement("tbody");
                    for (var i = 0; i < noOfContacts; i++) {
                        var bRow = document.createElement("tr");
                        for (var j = 0; j < col.length; j++) {
                            var td 		= document.createElement("td");
                            var isi 	= data[i][col[j]];
                            var isi2 	= isi.toString();
                            var pjg 	= isi2.length;
                            if (pjg > 8){
                                if (pjg == 9 || pjg == 10){
                                    if( isi2.indexOf(',') != -1 ){
                                        var res = isi2.replace(/,/g, "");
                                        td.innerHTML = res;
                                    }
                                    else {
                                        var res = isi2;
                                        td.setAttribute('style', 'mso-number-format: "\@";');
                                        td.innerHTML = res;
                                    }
                                }
                                else { 
                                    var res = isi2;
                                    td.setAttribute('style', 'mso-number-format: "\@";');
                                    td.innerHTML = res;
                                }						
                            }
                            else {
                                var res = isi2.replace(/,/g, "");
                                td.innerHTML = res;
                            }
                                
                            bRow.appendChild(td);
                        }
                        tBody.appendChild(bRow)
                    }
                    table.appendChild(tBody);
                    var divContainer = document.getElementById("tabel_cetak");
                        divContainer.innerHTML = "";
                        divContainer.appendChild(table);
                }
                
                $("#tabel_cetak").btechco_excelexport({
                    containerid: "tabel_cetak"
                    , datatype: $datatype.Table
                });
                return false;
            });
            $("#btnsavekoreksi").click(function(){
                var val01 = document.getElementById('koreksi_id').value;
                var val02 = document.getElementById('koreksi_nilai').value;
                $.post('{{ route("exInputBankSoal") }}', { set01: 'editnilai', set02: val01, set03: val02, _token: '{{ csrf_token() }}' }, function(data){
                    $.toast({
                        heading: 'Info',
                        text: data,
                        position: 'top-right',
                        loaderBg: '#bf441d',
                        icon: 'success',
                        hideAfter: 5000,
                        stack: 1
                    });
                    $("#gridkoreksilistsoal").jqxGrid('updatebounddata', 'filter');
                    $('#divkoreksilistsoal').show();
                    $('#divkoreksieditnilai').hide();
                    return false;
                });
            });
        //END_BLOK_KOREKSI
        $('.btnkembali').click(function () {
            window.location.href = 'welcometobanksoal';
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
                    if (lampiran == ''){
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