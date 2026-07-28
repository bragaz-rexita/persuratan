@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Persuratan PT</h1>
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
                <div id="loading"><img width="50%" src="{{ asset('dist/img/loading.gif') }}" alt="Loading On Duidev"></div>
                <div class="col-md-12 divawal">
                    <div class="card card-widget widget-user-2">
                        <div class="widget-user-header bg-success">
                            <div class="widget-user-image">
							@if (Session('avatar') != '')
							<img class="img-circle elevation-2" src="{!! Session('avatar') !!}" alt="User Avatar">
                            @else 
							<img class="img-circle elevation-2" src="{{ asset('mascot.png') }}" alt="User Avatar">
                            @endif
                            </div>
                            <h3 class="widget-user-username">{{Session('nama')}}</h3>
                            <h5 class="widget-user-desc">{{Session('fakpanjang')}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 divawal">
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title">Form</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenforma1"><span class="badge bg-warning notifcutitahunan">0</span><i class="fa fa-calculator"></i> Cuti Tahunan</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenforma2"><span class="badge bg-warning notifcutiagama">0</span><i class="fa fa-star-o"></i> Cuti Keagamaan</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenforma3"><span class="badge bg-warning notifijinplgcepat">0</span><i class="fa fa-truck"></i> Ijin Pulang Cepat</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenforma4"><span class="badge bg-warning notifijinkeluarkantor">0</span><i class="fa fa-toggle-off"></i> Ijin Keluar Kantor</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenforma5"><span class="badge bg-warning notifpermintaanpegawai">0</span><i class="fa fa-user-plus"></i> Permintaan Pegawai</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenforma6"><span class="badge bg-warning notifmutasirotasi">0</span><i class="fa fa-street-view"></i> Mutasi Rotasi</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenforma7"><span class="badge bg-warning notifkomunikasi">0</span><i class="fa fa-microphone"></i> Komunikasi</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 divawal">
                    <div class="card card-success shadow">
                        <div class="card-header">
                            <h3 class="card-title">Keputusan Direktur</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformb1"><span class="badge bg-warning notifpengangkatanjabatan">0</span><i class="fa fa-legal"></i> Pengangkatan Jabatan</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformb2"><span class="badge bg-warning notifpemberhentianjabatan">0</span><i class="fa fa-level-down"></i> Pemberhentian Jabatan</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformb3"><span class="badge bg-warning notifpegawaitetap">0</span><i class="fa fa-male"></i> Pegawai Tetap</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformb4"><span class="badge bg-warning notifdoktertetap">0</span><i class="fa fa-user-md"></i> Dokter Tetap</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformb5"><span class="badge bg-warning notifpenerimaanstaf">0</span><i class="fa fa-plus-square"></i> Penerimaan Staf</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformb6"><span class="badge bg-warning notifpenonaktifanstaf">0</span><i class="fa fa-minus-square"></i> Penonaktifan Staf</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformb7"><span class="badge bg-warning notifpengaktifanstaf">0</span><i class="fa fa-check-square-o"></i> Pengaktifan / Penempatan</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformb8"><span class="badge bg-warning notifmutasi">0</span><i class="fa fa-compress"></i> Mutasi</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformb9"><span class="badge bg-warning notifpenonaktifandokter">0</span><i class="fa fa-eraser"></i> Penonaktifan Dokter Tetap</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformb10"><span class="badge bg-warning notifpemutusanhubungan">0</span><i class="fa fa-legal"></i> Pemutusan Hubungan Kerja (PHK)</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 divawal">
                    <div class="card card-info shadow">
                        <div class="card-header">
                            <h3 class="card-title">Kontrak Kerja</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformc1"><span class="badge bg-warning notiforientasikerja">0</span><i class="fa fa-rocket"></i> Perjanjian Orientasi Kerja</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformc2"><span class="badge bg-warning notifpkwt">0</span><i class="fa fa-subway"></i> PKWT</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformc3"><span class="badge bg-warning notifpkwtt">0</span><i class="fa fa-train"></i> PKWTT</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 divawal">
                    <div class="card card-warning shadow">
                        <div class="card-header">
                            <h3 class="card-title">Surat Surat</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformd1"><span class="badge bg-warning notifspo">0</span><i class="fa fa-sitemap"></i> SPO</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenforme1"><span class="badge bg-warning notifedaran">0</span><i class="fa fa-legal"></i> Edaran</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenforme2"><span class="badge bg-warning notifperingatan">0</span><i class="fa fa-level-down"></i> Peringatan</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenforme3"><span class="badge bg-warning notifbalasanpenambahanstaf">0</span><i class="fa fa-male"></i> Balasan Penambahan Staf</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenforme4"><span class="badge bg-warning notifpermohonan">0</span><i class="fa fa-user-md"></i> Permohonan</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenforme5"><span class="badge bg-warning notiftugas">0</span><i class="fa fa-plus-square"></i> Tugas</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenforme6"><span class="badge bg-warning notifpemberitahuan">0</span><i class="fa fa-minus-square"></i> Pemberitahuan</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenforme7"><span class="badge bg-warning notiftanggapanresign">0</span><i class="fa fa-check-square-o"></i> Tanggapan Resign</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenforme8"><span class="badge bg-warning notifreferensikerja">0</span><i class="fa fa-compress"></i> Referensi Kerja</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenforme9"><span class="badge bg-warning notifketeranganaktif">0</span><i class="fa fa-eraser"></i> Keterangan Aktif Bekerja</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenforme11"><span class="badge bg-warning notifpemanggilancalonkaryawan">0</span><i class="fa fa-child"></i> Pemanggilan Calon Karyawan</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenforme12"><span class="badge bg-warning notiflolosseleksi">0</span><i class="fa fa-check-square-o"></i> Pemberitahuan Lolos Seleksi</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenforme13"><span class="badge bg-warning notifpemberitahuanmcu">0</span><i class="fa fa-bell"></i> Pemberitahuan MCU</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenforme14"><span class="badge bg-warning notifundangan">0</span><i class="fa fa-calendar-plus-o"></i> Undangan</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenforme15"><span class="badge bg-warning notifpemanggilankie">0</span><i class="fa fa-balance-scale"></i> Pemanggilan KIE Staf</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenforme16"><span class="badge bg-warning notifketerangantidakbekerja">0</span><i class="fa fa-user-times"></i> Keterangan Tidak Bekerja</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 divawal">
                    <div class="card card-warning shadow">
                        <div class="card-header">
                            <h3 class="card-title">Template SK</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" id="btntambahdatatemplate"><i class="fa fa-plus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2">
                                        <button class="btn btn-danger" id="btnviewtemplatesk"><i class="fa fa-search" ></i></button>
                                    </div>
                                    <div class="col-md-8">
                                        <select id="template_nama" name="template_nama" class="form-control select2" 
                                        @if($hakaksess == '0') 
                                            disabled="disable" 
                                        @endif
                                        />
                                            <option value=""></option>
                                            <optgroup label="Form">
                                                <option value="Cuti Tahunan">Cuti Tahunan</option>
                                                <option value="Cuti Keagamaan">Cuti Keagamaan</option>
                                                <option value="Ijin Pulang Cepat">Ijin Pulang Cepat</option>
                                                <option value="Ijin Keluar Kantor">Ijin Keluar Kantor</option>
                                                <option value="Permintaan Pegawai">Permintaan Pegawai</option>
                                                <option value="Mutasi Rotasi">Mutasi Rotasi</option>
                                                <option value="Komunikasi">Komunikasi</option>
                                            </optgroup>
                                            <optgroup label="Keputusan Direktur">
                                                <option value="Pengangkatan Jabatan">Pengangkatan Jabatan</option>
                                                <option value="Pemberhentian Jabatan">Pemberhentian Jabatan</option>
                                                <option value="Pegawai Tetap">Pegawai Tetap</option>
                                                <option value="Dokter Tetap">Dokter Tetap</option>
                                                <option value="Penerimaan Staf">Penerimaan Staf</option>
                                                <option value="Penonaktifan Staf">Penonaktifan Staf</option>
                                                <option value="Pengaktifan Staf">Pengaktifan Staf</option>
                                                <option value="Mutasi">Mutasi</option>
                                                <option value="Penempatan Administrasi Pendaftaran">Penempatan Administrasi Pendaftaran</option>
                                                <option value="Penempatan Analis Kesehatan">Penempatan Analis Kesehatan</option>
                                                <option value="Penempatan Perawat">Penempatan Perawat</option>
                                                <option value="Penempatan Perekam Medik">Penempatan Perekam Medik</option>
                                                <option value="Penempatan Security">Penempatan Security</option>
                                                <option value="Penonaktifan Dokter Tetap">Penonaktifan Dokter Tetap</option>
                                                <option value="Pemutusan Hubungan Kerja">Pemutusan Hubungan Kerja</option>
                                            </optgroup>
                                            <optgroup label="Kontrak Kerja">
                                                <option value="Perjanjian Orientasi Kerja NAKES">Perjanjian Orientasi Kerja Staf Klinis</option>
                                                <option value="Perjanjian Orientasi Kerja NON-NAKES">Perjanjian Orientasi Kerja Staf Non Klinis</option>
                                                <option value="PKWT Staf Klinis Baru">PKWT Staf Klinis Baru</option>
                                                <option value="PKWT Staf Klinis Lain dan Non Klinis Baru">PKWT Staf Non Klinis Baru</option>
                                                <option value="PKWT Dokter Spesialis">PKWT Dokter Spesialis</option>
                                                <option value="PKWT Dokter Klinik">PKWT Dokter Klinik</option>
                                                <option value="PKWT Dokter Umum (PART TIME)">PKWT Dokter Umum (dr umum part time)</option>
                                                <option value="PKWT Dokter Manajemen Baru">PKWT Dokter Manajemen</option>
                                                <option value="PKWT Staf Klinis Perpanjangan">PKWT Staf Klinis Perpanjangan</option>
                                                <option value="PKWT Staf Klinis Lain dan Non Klinis Perpanjangan">PKWT Staf Non Klinis perpanjangan</option>
                                                <option value="PKWT Dokter Manajemen Perpanjangan">PKWT Dokter Manajemen Perpanjangan</option>
                                                <option value="PKWTT">PKWTT</option>
                                            </optgroup>
                                            <optgroup label="Surat">
                                                <option value="Edaran">Edaran</option>
                                                <option value="Peringatan">Peringatan</option>
                                                <option value="Balasan Penambahan Staf">Balasan Penambahan Staf</option>
                                                <option value="Permohonan">Permohonan</option>
                                                <option value="Tugas">Tugas</option>
                                                <option value="Pemberitahuan Mutasi">Pemberitahuan Mutasi</option>
                                                <option value="Pemberitahuan Tidak Memperpanjang Kontrak">Pemberitahuan Tidak Memperpanjang Kontrak</option>
                                                <option value="Tanggapan Pengunduran Diri Sebelum Berakhir Masa Orientasi">Tanggapan Pengunduran Diri Sebelum Berakhir Masa Orientasi</option>
                                                <option value="Tanggapan Pengunduran Diri Masa Orientasi">Tanggapan Pengunduran Diri Masa Orientasi</option>
                                                <option value="Tanggapan Permohonan Tidak Memperpanjang Kontrak">Tanggapan Permohonan Tidak Memperpanjang Kontrak</option>
                                                <option value="Tanggapan Pengunduran Diri Pegawai Tetap">Tanggapan Pengunduran Diri Pegawai Tetap</option>
                                                <option value="Tanggapan Pengunduran Diri Sebelum Berakhir Masa Kontrak">Tanggapan Pengunduran Diri Sebelum Berakhir Masa Kontrak</option>
                                                <!-- <option value="Tanggapan Pengunduran Diri">Tanggapan Pengunduran Diri</option> -->
                                                <option value="Tanggapan Pengunduran Diri Dokter Umum/Spesialis">Tanggapan Pengunduran Diri Dokter Umum/Spesialis</option>
                                                <option value="Referensi Kerja">Referensi Kerja</option>
                                                <option value="Keterangan Aktif Bekerja">Keterangan Aktif Bekerja</option>
                                                <option value="Pemanggilan Calon Karyawan">Pemanggilan Calon Karyawan</option>
                                                <option value="Pemberitahuan Lolos Seleksi">Pemberitahuan Lolos Seleksi</option>
                                                <option value="Pemberitahuan MCU">Pemberitahuan MCU</option>
                                                <option value="Pemberitahuan Sekretaris">Pemberitahuan Sekretaris</option>
                                                <option value="Undangan">Undangan</option>
                                                <option value="Pemanggilan KIE Staf">Pemanggilan KIE Staf</option>
                                                <option value="Keterangan Tidak Bekerja">Keterangan Tidak Bekerja</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-info" id="btnsimulasitemplatesk"><i class="fa fa-file-text-o" ></i> Preview</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12" id="templatekanan">
                                        <div id="gridtemplate"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
                <div class="col-md-12 divsuratproses">
                    <div id="divtambahpenerima">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Kirim Surat</h3>
                                <div class="card-tools">
                                    <a href="{{ url('persuratanpt') }}"><button type="button" class="btn btn-tool">
                                        <i class="fa fa-globe"></i>
                                    </button></a>
                                    <button type="button" class="btn btn-tool btnkembali">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
							<div class="card-body">
								<div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3">
                                            <label for="kirim_nomor">Nomor</label>
                                            <input type="text" class="form-control" id="kirim_nomor" name="kirim_nomor" disabled="disable">
                                        </div>
                                        <div class="col-lg-5 col-md-5">
                                            <label for="kirim_perihal">Perihal</label>
                                            <input type="text" class="form-control" id="kirim_perihal" name="kirim_perihal" disabled="disable">
                                        </div>
										<div class="col-lg-4 col-md-4">
                                            <label for="kirim_undangan">Apakah ini Undangan.?</label>
                                            <select id="kirim_undangan" size="1" class="form-control select2">
												<option value="Tidak">Bukan Undangan</option>
												<option value="Ya">Undangan</option>
											</select>
                                        </div>
                                    </div>
                                </div>
								<p><strong>Apabila Surat ini Merupakan Surat Undangan Mohon Lengkapi Data di Bawah Ini</strong></p>
								<div class="form-group">
									<label for="kirim_kegiatan">Nama Kegiatan </label>
								    <input type="text" class="form-control" id="kirim_kegiatan" name="kirim_kegiatan">
                                </div>
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3">
											<label for="kirim_tglmulai">Tgl. Mulai</label>
											<input type="text" id="kirim_tglmulai" name="kirim_tglmulai" class="form-control"  data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
										</div>
										<div class="col-lg-3">
											<label for="kirim_jammulai">Jam Mulai</label>
											<input type="text" id="kirim_jammulai" name="kirim_jammulai" class="form-control timepicker">
										</div>
										<div class="col-lg-3">
											<label for="kirim_tglselesai">Tgl. Selesai</label>
											<input type="text" id="kirim_tglselesai" name="kirim_tglselesai" class="form-control"  data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
										</div>
										<div class="col-lg-3">
											<label for="kirim_jamselesai">Jam Selesai</label>
											<input type="text" id="kirim_jamselesai" name="kirim_jamselesai" class="form-control timepicker">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="kirim_keterangan">Keterangan (zoom Meeting id / lokasi Kegiatan / seragam yang dipakai / dll)</label>
									<textarea id="kirim_keterangan" name="kirim_keterangan" rows="10" cols="80"></textarea>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-8">
											<select id="kirim_email" size="1" class="form-control select2">
												<option value="">Pilih Penerima</option>
												@foreach($arrallpeg as $rows)
													<option value="{{$rows->email_ub}}" idpeg="{{$rows->id}}">{!! $rows->nama_lengkap !!} ( {!! $rows->jabatan !!} - {!! $rows->unit !!} )</option>
												@endforeach
                                                @if(isset($arrallnonpeg) AND !empty($arrallnonpeg))
                                                    @foreach($arrallnonpeg as $rows)
                                                        <option value="{{$rows->email_ub}}" idpeg="{{$rows->id}}">{!! $rows->nama_lengkap !!} ( {!! $rows->jabatan !!} - {!! $rows->unit !!} )</option>
                                                    @endforeach
                                                @endif
											</select>
										</div>
										<div class="col-md-2">
											<div class="btn btn-primary" id="btnkirimsurat">
												<i class="fa fa-user-plus"></i>
											</div>
										</div>
										<div class="col-md-2">
											<input type="hidden" id="kirim_id" name="kirim_id" class="form-control">
											<input type="hidden" id="kirim_idpeserta" name="kirim_idpeserta" class="form-control">
											<input type="hidden" id="kirim_kelompok" name="kirim_kelompok" class="form-control">
											<div class="btn btn-danger btn-lg btnkembali">
												<i class="fa fa-close"></i>
											</div>
										</div>
									</div>
								</div>
                            </div>
                            <div class="card-footer">
                                <div id="griddetail"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title" id="judul">Proses</h3>
                            <div class="card-tools">
                                <a href="{{ url('persuratanpt') }}"><button type="button" class="btn btn-tool">
                                    <i class="fa fa-globe"></i>
                                </button></a>
                                <button type="button" class="btn btn-tool divinputbtngroup divcuti" id="btntambahdatacuti"><i class="fa fa-plus"></i> Tambah Data Baru</button>
                                <button type="button" class="btn btn-tool divinputbtngroup divkontrakkerja" id="btntambahdatakontrakkerja"><i class="fa fa-plus"></i> Tambah Data Baru</button>
                                <button type="button" class="btn btn-tool btnkembali"><i class="fa fa-close"></i></button>
                            </div>
                        </div>
                        <form class="kt-form" id="form-data-upload" enctype="multipart/form-data">
							{{ csrf_field() }}
                            <div class="card-body divisian" id="divisicuti">
                                <div class="form-group">
									<div class="row">
										<div class="col-lg-8">
											<label for="cuti_pegawai">Nama Pegawai</label>
											<select id="cuti_pegawai" name="idpegawai" class="collectoridpeg form-control select2" @if($hakaksess == 0) disabled="disable" @endif>
												<option value=""></option>
												@foreach($arrallpeg as $pegawai)
													@if (Session('idpeg') == $pegawai['id'])
														<option value="{{ $pegawai['id'] }}" selected>{{ $pegawai['nama_lengkap'] }} ( {{ $pegawai['unit_kerja'] }} )</option>
													@else
														<option value="{{ $pegawai['id'] }}">{{ $pegawai['nama_lengkap'] }} ( {{ $pegawai['unit_kerja'] }} )</option>
													@endif
												@endforeach
                                                @if(isset($arrallnonpeg) AND !empty($arrallnonpeg))
                                                    @foreach($arrallnonpeg as $rows)
                                                        <option value="{{$rows->email_ub}}" idpeg="{{$rows->id}}">{!! $rows->nama_lengkap !!} ( {!! $rows->jabatan !!} - {!! $rows->unit !!} )</option>
                                                    @endforeach
                                                @endif
											</select>
										</div>
										<div class="col-lg-4">
											<label for="cuti_nip">ID Pegawai</label>
											<input type="text" class="form-control masternip" id="cuti_nip" name="nipbaru" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-lg-4">
											<label for="cuti_jabatan">Jabatan</label>
											<input type="text" class="form-control masterjabatan" id="cuti_jabatan" name="jabatan" />
										</div>
										<div class="col-lg-4">
											<label for="cuti_unitkerja">Unit Kerja</label>
											<input type="text" class="form-control masterunitkerja" id="cuti_unitkerja" name="unitkerja" />
										</div>
										<div class="col-lg-4">
											<label for="cuti_nohape">No.HP</label>
											<input type="text" class="form-control masternohape" id="cuti_nohape" name="nohape" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="cuti_alamat">Alamat Selama Menjalan Cuti</label>
									<input type="text" class="form-control masteralamat" id="cuti_alamat" name="alamat" />
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-lg-6">
											<label for="cuti_jenis">Jenis Cuti</label>
											<select id="cuti_jenis" name="cuti_jenis" class="form-control">
												<option value="Cuti Tahunan">Cuti Tahunan</option>
												<option value="Cuti Besar">Cuti Besar</option>
												<option value="Cuti Sakit">Cuti Sakit</option>
												<option value="Cuti Keagamaan">Cuti Keagamaan</option>
												<option value="Cuti Melahirkan">Cuti Melahirkan</option>
												<option value="Cuti Karena Alasan Penting">Cuti Karena Alasan Penting</option>
												<option value="Cuti di Luar Tanggungan Negara">Cuti di Luar Tanggungan Negara</option>
											</select>	
										</div>
										<div class="col-lg-2">
											<label for="cuti_hari">Cuti Sebanyak (hari)</label>
											<select id="cuti_hari" name="cuti_hari" class="form-control" >
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
												<option value="10">10</option>
												<option value="11">11</option>
												<option value="12">12</option>
												<option value="13">13</option>
												<option value="14">14</option>
												<option value="15">15</option>
												<option value="16">16</option>
												<option value="17">17</option>
												<option value="18">18</option>
												<option value="19">19</option>
												<option value="20">20</option>
												<option value="21">21</option>
												<option value="22">22</option>
												<option value="23">23</option>
												<option value="24">24</option>
												<option value="25">25</option>
												<option value="26">26</option>
												<option value="27">27</option>
												<option value="28">28</option>
												<option value="29">29</option>
												<option value="30">30</option>
												<option value="60">60</option>
												<option value="90">90</option>
											</select>
										</div>
										<div class="col-lg-2">
                                            <label>Mulai:</label>
                                        	<input type="text" id="cuti_mulai" name="cuti_mulai" class="form-control"  data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
										</div>
										<div class="col-lg-2">
                                            <label>Sampai:</label>
                                        	<input type="text" id="cuti_akhir" name="cuti_akhir" class="form-control"  data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
										</div> 
									</div>		
								</div>
								<div class="form-group">
									<label for="cuti_alasan">Alasan Cuti</label>
									<input type="text" class="form-control" id="cuti_alasan"  name="cuti_alasan" />
								</div>
                            </div>
                            <div class="card-body divisian" id="divisikontrakkerja">
                                <div class="form-group">
									<div class="row">
										<div class="col-lg-4">
											<label for="kontrak_pegawai">Nama Pegawai</label>
											<select id="kontrak_pegawai" name="idpegawai" class="collectoridpeg form-control select2" @if($hakaksess == 0) disabled="disable" @endif>
												<option value=""></option>
												@foreach($arrallpeg as $pegawai)
													@if (Session('idpeg') == $pegawai['id'])
														<option value="{{ $pegawai['id'] }}" selected>{{ $pegawai['nama_lengkap'] }} ( {{ $pegawai['unit_kerja'] }} )</option>
													@else
														<option value="{{ $pegawai['id'] }}">{{ $pegawai['nama_lengkap'] }} ( {{ $pegawai['unit_kerja'] }} )</option>
													@endif
												@endforeach
											</select>
										</div>
										<div class="col-lg-4">
											<label for="kontrak_ppabp">Penempatan</label>
											<select id="kontrak_ppabp" name="ppabp" class="masterppabp form-control">
												<option value=""></option>
                                                @if(isset($arrsdomain) AND !empty($arrsdomain))
                                                    @foreach($arrsdomain as $rdomain)
                                                        <option value="{{ $rdomain->subsubdomainapps }}">{{ $rdomain->subsubdomainapps }}</option>
                                                    @endforeach
                                                @endif
											</select>
										</div>
                                        <div class="col-md-4">
                                            <label for="kontrak_alamatpenempatan">Alamat Penempatan</label>
                                            <input type="text" class="form-control" id="kontrak_alamatpenempatan" name="alamatpenempatan" />
										</div>
									</div>
								</div>
                                <div class="form-group">
									<div class="row">
										<div class="col-md-2">
											<label for="kontrak_tmpt_lahir">Tempat Lahir</label>
											<input type="text" class="form-control mastertmpt_lahir" id="kontrak_tmpt_lahir" name="tmpt_lahir" />
										</div>
										<div class="form-group col-md-2">
                                            <label>Tgl. Lahir</label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control mastertgl_lahir" id="kontrak_tgl_lahir" name="tgl_lahir" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
										    <label for="kontrak_kelamin">Kelamin</label>
                                            <select id="kontrak_kelamin" name="kelamin" class="form-control masterkelamin">
												<option value="Laki-laki">Laki-Laki</option>
												<option value="Perempuan">Perempuan</option>
											</select>
										</div>
                                        <div class="col-md-2">
										    <label for="kontrak_nik">No. KTP</label>
											<input type="text" class="form-control masternik" id="kontrak_nik" name="nik" />
										</div>
                                        <div class="col-md-4">
											<label for="kontrak_alamat">Alamat Pegawai</label>
											<input type="text" class="form-control masteralamat" id="kontrak_alamat" name="alamat" />
										</div>
									</div>
								</div>
                                <div class="form-group">
									<div class="row">
                                        <div class="col-md-2">
										    <label for="kontrak_jenispeg">Nakes/Non Nakes/PEJABAT</label>
                                            <select id="kontrak_jenispeg" name="jenispeg" class="form-control masterjenispeg">
												<option value="NAKES">Dokter / Nakes</option>
												<option value="NON NAKES">Staf Non Medis</option>
												<option value="PEJABAT">PEJABAT</option>
											</select>
										</div>
                                        <div class="col-md-3">
										    <label for="kontrak_jenis">Jenis Kontrak</label>
                                            <select id="kontrak_jenis" name="kontrak_jenis" class="form-control">
                                                <option value="Perjanjian Orientasi Kerja NAKES">Perjanjian Orientasi Kerja Staf Klinis</option>
                                                <option value="Perjanjian Orientasi Kerja NON-NAKES">Perjanjian Orientasi Kerja Staf Non Klinis</option>
                                                <option value="PKWT Staf Klinis Baru">PKWT Staf Klinis Baru</option>
                                                <option value="PKWT Staf Klinis Lain dan Non Klinis Baru">PKWT Staf Non Klinis Baru</option>
                                                <option value="PKWT Dokter Spesialis">PKWT Dokter Spesialis</option>
                                                <option value="PKWT Dokter Umum (PART TIME)">PKWT Dokter Umum (dr umum part time)</option>
                                                <option value="PKWT Dokter Manajemen Baru">PKWT Dokter Manajemen</option>
                                                <option value="PKWT Staf Klinis Perpanjangan">PKWT Staf Klinis Perpanjangan</option>
                                                <option value="PKWT Staf Klinis Lain dan Non Klinis Perpanjangan">PKWT Staf Non Klinis perpanjangan</option>
                                                <option value="PKWT Dokter Manajemen Perpanjangan">PKWT Dokter Manajemen Perpanjangan</option>
                                                <option value="PKWTT">PKWTT</option>
											</select>
										</div>
										<div class="col-md-2">
											<label for="kontrak_str">STR (Khusus NAKES)</label>
											<input type="text" class="form-control mastercpns" id="kontrak_str" name="cpns" />
										</div>
										<div class="col-md-2">
											<label for="kontrak_unitkerja">Unit Penempatan</label>
											<input type="text" class="form-control masterunitkerja" id="kontrak_unitkerja" name="unitkerja" />
										</div>
										<div class="col-md-3">
										    <label for="kontrak_jabatan">Jabatan</label>
											<input type="text" class="form-control masterjabatan" id="kontrak_jabatan" name="jabatan" />
										</div>
									</div>
								</div>
                                <div class="form-group">
									<div class="row">
										<div class="col-md-2">
											<label for="kontrak_lamanya">Kontrak</label>
											<select id="kontrak_lamanya" name="kontrak_lamanya" class="form-control" >
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
												<option value="10">10</option>
												<option value="11">11</option>
											</select>
										</div>
										<div class="col-md-2">
											<label for="kontrak_satuan">Satuan</label>
										    <select id="kontrak_satuan" name="satuan" class="form-control">
												<option value="Bulan">Bulan</option>
												<option value="Tahun">Tahun</option>
											</select>
										</div>
                                        <div class="form-group col-md-2">
                                            <label>Mulai</label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control mastertmt_jabatan" id="kontrak_mulai" name="tmt_jabatan" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
									    <div class="form-group col-md-2">
                                            <label>Akhir</label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control mastertmt_pensiun" id="kontrak_akhir" name="tmt_pensiun" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
										<div class="form-group col-md-2">
                                            <label>Honorarium</label>
                                            <div class="input-group date">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">Rp</div>
                                                </div>
                                                <input type="text" class="form-control mastergajisesuaisk" id="kontrak_gaji" name="gajisesuaisk"/>
                                            </div>
                                        </div>
									    <div class="form-group col-md-2">
                                            <label>Tanggal Surat Perjanjian</label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control" id="kontrak_tanggal" name="tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
									</div>
								</div>
                            </div>
                            <div class="card-body divisian" id="divisikeputusandirektur">
                                <div class="form-group">
									<div class="row">
										<div class="col-lg-5">
											<label for="kepdir_nama">Nama Pegawai</label>
											<input type="text" class="form-control" id="kepdir_nama" name="kepdir_nama" />
										</div>
                                        <div class="col-lg-2">
											<label for="kepdir_email">Email Pegawai</label>
											<input type="text" class="form-control" id="kepdir_email" name="kepdir_email" />
										</div>
                                        <div class="col-lg-2">
											<label for="kepdir_nip">Nomor Induk Pegawai</label>
											<input type="text" class="form-control masternip" id="kepdir_nip" name="kepdir_nip" />
										</div>
										<div class="col-lg-3">
											<label for="kepdir_ppabp">Kirim Ke</label>
											<select id="kepdir_ppabp" name="kepdir_ppabp" class="masterppabp form-control">
												<option value=""></option>
                                                @if(isset($arrsdomain) AND !empty($arrsdomain))
                                                    @foreach($arrsdomain as $rdomain)
                                                        <option value="{{ $rdomain->subsubdomainapps }}">{{ $rdomain->subsubdomainapps }}</option>
                                                    @endforeach
                                                @endif
											</select>
										</div>
                                    </div>
								</div>
                                <div class="form-group">
									<div class="row">
                                        <div class="col-md-3">
										    <label for="kepdir_jenispeg">Nakes/Non Nakes/PEJABAT</label>
                                            <select id="kepdir_jenispeg" name="kepdir_jenispeg" class="form-control masterjenispeg">
												<option value="NAKES">Dokter / Nakes</option>
												<option value="NON NAKES">Staf Non Medis</option>
												<option value="PEJABAT">PEJABAT</option>
											</select>
										</div>
										<div class="col-md-3">
											<label for="kepdir_tmpt_lahir">Tempat Lahir</label>
											<input type="text" class="form-control mastertmpt_lahir" id="kepdir_tmpt_lahir" name="kepdir_tmpt_lahir" />
										</div>
										<div class="form-group col-md-2">
                                            <label>Tgl. Lahir</label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control mastertgl_lahir" id="kepdir_tgl_lahir" name="kepdir_tgl_lahir" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
										    <label for="kepdir_kelamin">Kelamin</label>
                                            <select id="kepdir_kelamin" name="kepdir_kelamin" class="form-control masterkelamin">
												<option value="Laki-laki">Laki-Laki</option>
												<option value="Perempuan">Perempuan</option>
											</select>
										</div>
                                        <div class="col-md-2">
										    <label for="kepdir_nik">No. KTP *)</label>
											<input type="text" class="form-control masternik" id="kepdir_nik" name="kepdir_nik" />
										</div>
									</div>
								</div>
                                <div class="form-group">
									<div class="row">
                                        <div class="col-md-3">
										    <label for="kepdir_jabatan">Jabatan</label>
                                        	<input type="text" class="form-control masterjabatan" id="kepdir_jabatan" name="kepdir_jabatan" />
										</div>
                                        <div class="col-md-3">
										    <label for="kepdir_unitkerja">Unit Kerja</label>
                                        	<input type="text" class="form-control masterunitkerja" id="kepdir_unitkerja" name="kepdir_unitkerja" />
										</div>
                                        <div class="col-md-2 col-lg-2">
											<label>Jenjang</label>
											<select id="kepdir_pend_akhir" name="kepdir_pend_akhir" size="1" class="form-control masterpend_akhir">
												<option value="">Pilih Salah Satu</option>
												<option value="SD">SD/Sederajat</option>
												<option value="SMP">SMP/Sederajat</option>
												<option value="SMA">SMA/Sederajat</option>
												<option value="D1">D1</option>
												<option value="D2">D2</option>
												<option value="D3">D3</option>
												<option value="D4">D4</option>
												<option value="S1">S1</option>
												<option value="Profesi">Profesi</option>
												<option value="Spesialis 1">Spesialis 1</option>
												<option value="Spesialis 2">Spesialis 2</option>
												<option value="S2">Magister / S2</option>
												<option value="S3">Doktor / S3</option>						
											</select>
										</div>		
										<div class="col-md-4 col-lg-4">
											<label>Bidang Ilmu</label>
											<input type="text" class="form-control masterbidang_ilmu" id="kepdir_bidang_ilmu" name="kepdir_bidang_ilmu">
										</div>
									</div>
								</div>
                                <div class="form-group">
									<div class="row">
										<div class="col-md-2">
                                            <label for="kepdir_nomor">Nomor</label>
											<input type="text" class="form-control" id="kepdir_nomor" name="kepdir_nomor" placeholder="angka saja" />
										</div>
										<div class="form-group col-md-2">
                                            <label>TMT Diterima</label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control mastertmt_golongan" id="kepdir_tmt_golongan" name="kepdir_tmt_golongan" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
									    <div class="form-group col-md-2">
                                            <label>Tanggak SK</label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control mastertmt_fungsional" id="kepdir_tmt_fungsional" name="kepdir_tmt_fungsional" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Pemeriksa Draft</label>
                                            <select id="kepdir_pemeriksa" name="kepdir_pemeriksa" size="1" class="form-control">
                                                <option value="SELF">Tidak di Periksa Kembali</option>
                                                @foreach($pejabats as $rpejabats)
                                                    <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Penandatangan</label>
                                            <select id="kepdir_penandatangan" name="kepdir_penandatangan" size="1" class="form-control">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($pejabats as $rpejabats)
                                                    <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
									</div>
								</div>
                                <div class="form-group">
                                    <label for="kepdir_uraiantugas">Uraian Tugas</label>
                                    <textarea id="kepdir_uraiantugas" name="kepdir_uraiantugas" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="kepdir_uraiantugas2">Opsional Uraian Tugas Halaman Ke 2</label>
                                    <textarea id="kepdir_uraiantugas2" name="kepdir_uraiantugas2" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="kepdir_uraiantugas3">Opsional Uraian Tugas Halaman Ke 3</label>
                                    <textarea id="kepdir_uraiantugas3" name="kepdir_uraiantugas3" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="card-body divisian" id="divisikdpengangkatan">
                                <div class="form-group">
									<div class="row">
										<div class="col-lg-2">
											<label for="kepdirangkat_nama">Nama Pegawai</label>
											<input type="text" class="form-control" id="kepdirangkat_nama" name="kepdirangkat_nama" />
										</div>
										<div class="col-md-2">
										    <label for="kepdirangkat_jabatan">Diangkat Menjadi</label>
                                        	<select id="kepdirangkat_jabatan" name="kepdirangkat_jabatan" size="1" class="form-control">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($pejabats as $rpejabats)
                                                    <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                @endforeach
                                            </select>
										</div>
                                        <div class="col-lg-2">
											<label for="kepdirangkat_ppabp">Penempatan</label>
											<select id="kepdirangkat_ppabp" name="kepdirangkat_ppabp" class="masterppabp form-control">
												<option value=""></option>
                                                @if(isset($arrsdomain) AND !empty($arrsdomain))
                                                    @foreach($arrsdomain as $rdomain)
                                                        <option value="{{ $rdomain->subsubdomainapps }}">{{ $rdomain->subsubdomainapps }}</option>
                                                    @endforeach
                                                @endif
											</select>
										</div>
                                        <div class="col-md-2">
										    <label for="kepdirangkat_sifat">Sifat</label>
                                        	<select id="kepdirangkat_sifat" name="kepdirangkat_sifat" size="1" class="form-control">
                                                <option value="Normal">Normal</option>
                                                <option value="PLT">PLT</option>
                                            </select>
										</div>
                                        <div class="form-group col-md-2">
                                            <label for="kepdirangkat_nomor">Nomor</label>
											<input type="text" class="form-control" id="kepdirangkat_nomor" name="kepdirangkat_nomor" placeholder="angka saja" />
										</div>
                                        <div class="form-group col-md-2">
                                            <label>Tanggal SK</label>
                                            <input type="text" class="form-control" id="kepdirangkat_tanggal" name="kepdirangkat_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                        </div>
                                    </div>
								</div>
                                <div class="form-group">
									<div class="row">
										<div class="form-group col-md-2">
                                            <label>TMT</label>
                                            <input type="text" class="form-control" id="kepdirangkat_tmt" name="kepdirangkat_tmt" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Mulai</label>
                                            <input type="text" class="form-control" id="kepdirangkat_mulai" name="kepdirangkat_mulai" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                        </div>
									    <div class="form-group col-md-2">
                                            <label>Akhir</label>
                                            <input type="text" class="form-control" id="kepdirangkat_akhir" name="kepdirangkat_akhir" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                        </div>
									    <div class="form-group col-md-3">
                                            <label>Pemeriksa Draft</label>
                                            <select id="kepdirangkat_pemeriksa" name="kepdirangkat_pemeriksa" size="1" class="form-control">
                                                <option value="SELF">Tidak di Periksa Kembali</option>
                                                @foreach($pejabats as $rpejabats)
                                                    <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Penandatangan</label>
                                            <select id="kepdirangkat_penandatangan" name="kepdirangkat_penandatangan" size="1" class="form-control">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($pejabats as $rpejabats)
                                                    <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
									</div>
								</div>
                                <div class="form-group">
                                    <label for="kepdirangkat_uraiantugas">Uraian Tugas</label>
                                    <textarea id="kepdirangkat_uraiantugas" name="kepdirangkat_uraiantugas" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="card-body divisian" id="divisikdmutasi">
                                <div class="form-group">
									<div class="row">
										<div class="col-lg-3">
											<label for="kepdirmutasi_nama">Nama Pegawai</label>
											<input type="text" class="form-control" id="kepdirmutasi_nama" name="kepdirmutasi_nama" />
										</div>
										<div class="col-md-3">
										    <label for="kepdirmutasi_jabatan">Jabatan</label>
                                        	<input type="text" class="form-control masterjabatan" id="kepdirmutasi_jabatan" name="kepdirmutasi_jabatan" />
										</div>
                                        <div class="col-lg-3">
											<label for="kepdirmutasi_ppabp">Mutasi Dari</label>
											<select id="kepdirmutasi_ppabp" name="kepdirmutasi_ppabp" class="masterppabp form-control">
												<option value=""></option>
                                                @if(isset($arrsdomain) AND !empty($arrsdomain))
                                                    @foreach($arrsdomain as $rdomain)
                                                        <option value="{{ $rdomain->subsubdomainapps }}">{{ $rdomain->subsubdomainapps }}</option>
                                                    @endforeach
                                                @endif
											</select>
										</div>
                                        <div class="col-lg-3">
											<label for="kepdirmutasi_ppabptujuan">Mutasi Ke</label>
											<select id="kepdirmutasi_ppabptujuan" name="kepdirmutasi_ppabptujuan" class="masterppabp form-control">
												<option value=""></option>
                                                @if(isset($arrsdomain) AND !empty($arrsdomain))
                                                    @foreach($arrsdomain as $rdomain)
                                                        <option value="{{ $rdomain->subsubdomainapps }}">{{ $rdomain->subsubdomainapps }}</option>
                                                    @endforeach
                                                @endif
											</select>
										</div>
                                    </div>
								</div>
                                <div class="form-group">
									<div class="row">
										<div class="form-group col-md-2">
                                            <label for="kepdirmutasi_nomor">Nomor</label>
											<input type="text" class="form-control" id="kepdirmutasi_nomor" name="kepdirmutasi_nomor" placeholder="angka saja" />
										</div>
										<div class="form-group col-md-2">
                                            <label>TMT</label>
                                            <input type="text" class="form-control" id="kepdirmutasi_tmt" name="kepdirmutasi_tmt" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                        </div>
									    <div class="form-group col-md-2">
                                            <label>Tanggal SK</label>
                                            <input type="text" class="form-control" id="kepdirmutasi_tanggal" name="kepdirmutasi_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                        </div>
									    <div class="form-group col-md-3">
                                            <label>Pemeriksa Draft</label>
                                            <select id="kepdirmutasi_pemeriksa" name="kepdirmutasi_pemeriksa" size="1" class="form-control">
                                                <option value="SELF">Tidak di Periksa Kembali</option>
                                                @foreach($pejabats as $rpejabats)
                                                    <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Penandatangan</label>
                                            <select id="kepdirmutasi_penandatangan" name="kepdirmutasi_penandatangan" size="1" class="form-control">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($pejabats as $rpejabats)
                                                    <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
									</div>
								</div>
                            </div>
                            <div class="card-body divisian" id="divisikdpemberhentianjabatan">
                                <div class="form-group">
									<div class="row">
										<div class="col-lg-3">
											<label for="kepdirpemberhentian_nama">Nama Pegawai</label>
											<input type="text" class="form-control" id="kepdirpemberhentian_nama" name="kepdirpemberhentian_nama" />
										</div>
										<div class="col-md-3">
										    <label for="kepdirpemberhentian_jabatan">Jabatan</label>
                                        	<input type="text" class="form-control masterjabatan" id="kepdirpemberhentian_jabatan" name="kepdirpemberhentian_jabatan" />
										</div>
                                        <div class="col-lg-3">
											<label for="kepdirpemberhentian_ppabp">Penempatan</label>
											<select id="kepdirpemberhentian_ppabp" name="kepdirpemberhentian_ppabp" class="masterppabp form-control">
												<option value=""></option>
                                                @if(isset($arrsdomain) AND !empty($arrsdomain))
                                                    @foreach($arrsdomain as $rdomain)
                                                        <option value="{{ $rdomain->subsubdomainapps }}">{{ $rdomain->subsubdomainapps }}</option>
                                                    @endforeach
                                                @endif
											</select>
										</div>
                                    </div>
								</div>
                                <div class="form-group">
									<div class="row">
										<div class="form-group col-md-2">
                                            <label for="kepdirpemberhentian_nomor">Nomor</label>
											<input type="text" class="form-control" id="kepdirpemberhentian_nomor" name="kepdirpemberhentian_nomor" placeholder="angka saja" />
										</div>
										<div class="form-group col-md-2">
                                            <label>TMT</label>
                                            <input type="text" class="form-control" id="kepdirpemberhentian_tmt" name="kepdirpemberhentian_tmt" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                        </div>
									    <div class="form-group col-md-2">
                                            <label>Tanggal SK</label>
                                            <input type="text" class="form-control" id="kepdirpemberhentian_tanggal" name="kepdirpemberhentian_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                        </div>
									    <div class="form-group col-md-3">
                                            <label>Pemeriksa Draft</label>
                                            <select id="kepdirpemberhentian_pemeriksa" name="kepdirpemberhentian_pemeriksa" size="1" class="form-control">
                                                <option value="SELF">Tidak di Periksa Kembali</option>
                                                @foreach($pejabats as $rpejabats)
                                                    <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Penandatangan</label>
                                            <select id="kepdirpemberhentian_penandatangan" name="kepdirpemberhentian_penandatangan" size="1" class="form-control">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($pejabats as $rpejabats)
                                                    <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
									</div>
								</div>
                            </div>
                            <div class="card-body divisian" id="divisikdpegawaitetap">
                                <div class="form-group">
									<div class="row">
										<div class="col-lg-3">
											<label for="kepdirpegtetap_nama">Nama Pegawai</label>
											<input type="text" class="form-control" id="kepdirpegtetap_nama" name="kepdirpegtetap_nama" />
										</div>
										<div class="col-md-3">
										    <label for="kepdirpegtetap_jabatan">Jabatan</label>
                                        	<input type="text" class="form-control masterjabatan" id="kepdirpegtetap_jabatan" name="kepdirpegtetap_jabatan" />
										</div>
                                        <div class="col-lg-3">
											<label for="kepdirpegtetap_ppabp">Penempatan</label>
											<select id="kepdirpegtetap_ppabp" name="kepdirpegtetap_ppabp" class="masterppabp form-control">
												<option value=""></option>
                                                @if(isset($arrsdomain) AND !empty($arrsdomain))
                                                    @foreach($arrsdomain as $rdomain)
                                                        <option value="{{ $rdomain->subsubdomainapps }}">{{ $rdomain->subsubdomainapps }}</option>
                                                    @endforeach
                                                @endif
											</select>
										</div>
                                        <div class="col-lg-3">
											<label for="kepdirpegtetap_status_jabatan">Sebagai</label>
											<select id="kepdirpegtetap_status_jabatan" name="kepdirpegtetap_status_jabatan" class="form-control masterstatus_jabatan">
												<option value="Pegawai Tetap">Pegawai Tetap</option>
                                                <option value="Dokter Tetap">Dokter Tetap</option>
											</select>
										</div>
                                    </div>
								</div>
                                <div class="form-group">
									<div class="row">
										<div class="form-group col-md-2">
                                            <label for="kepdirpegtetap_nomor">Nomor</label>
											<input type="text" class="form-control" id="kepdirpegtetap_nomor" name="kepdirpegtetap_nomor" placeholder="angka saja" />
										</div>
										<div class="form-group col-md-2">
                                            <label>TMT</label>
                                            <input type="text" class="form-control" id="kepdirpegtetap_tmt" name="kepdirpegtetap_tmt" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                        </div>
									    <div class="form-group col-md-2">
                                            <label>Tanggal SK</label>
                                            <input type="text" class="form-control" id="kepdirpegtetap_tanggal" name="kepdirpegtetap_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                        </div>
									    <div class="form-group col-md-3">
                                            <label>Pemeriksa Draft</label>
                                            <select id="kepdirpegtetap_pemeriksa" name="kepdirpegtetap_pemeriksa" size="1" class="form-control">
                                                <option value="SELF">Tidak di Periksa Kembali</option>
                                                @foreach($pejabats as $rpejabats)
                                                    <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Penandatangan</label>
                                            <select id="kepdirpegtetap_penandatangan" name="kepdirpegtetap_penandatangan" size="1" class="form-control">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($pejabats as $rpejabats)
                                                    <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
									</div>
								</div>
                            </div>
                            <div class="card-body divisian" id="divisikdaktivasi">
                                <div class="form-group">
									<div class="row">
										<div class="col-lg-3">
											<label for="kepdiraktivasi_nama">Nama Pegawai</label>
											<input type="text" class="form-control" id="kepdiraktivasi_nama" name="kepdiraktivasi_nama" />
										</div>
										<div class="col-md-3">
										    <label for="kepdiraktivasi_jabatan">Jabatan</label>
                                        	<input type="text" class="form-control masterjabatan" id="kepdiraktivasi_jabatan" name="kepdiraktivasi_jabatan" />
										</div>
                                        <div class="col-lg-3">
											<label for="kepdiraktivasi_ppabp">Penempatan</label>
											<select id="kepdiraktivasi_ppabp" name="kepdiraktivasi_ppabp" class="masterppabp form-control">
												<option value=""></option>
                                                @if(isset($arrsdomain) AND !empty($arrsdomain))
                                                    @foreach($arrsdomain as $rdomain)
                                                        <option value="{{ $rdomain->subsubdomainapps }}">{{ $rdomain->subsubdomainapps }}</option>
                                                    @endforeach
                                                @endif
											</select>
										</div>
                                        <div class="col-lg-3">
											<label for="kepdiraktivas_status_jabatan">Jenis SK</label>
											<select id="kepdiraktivas_status_jabatan" name="kepdiraktivas_status_jabatan" class="form-control masterstatus_jabatan">
                                                <option value="Pengaktifan Staf">Pengaktifan Staf</option>
                                                <option value="Penempatan Administrasi Pendaftaran">Penempatan Administrasi Pendaftaran</option>
                                                <option value="Penempatan Analis Kesehatan">Penempatan Analis Kesehatan</option>
                                                <option value="Penempatan Perawat">Penempatan Perawat</option>
                                                <option value="Penempatan Perekam Medik">Penempatan Perekam Medik</option>
                                                <option value="Penempatan Security">Penempatan Security</option>
                                                <option value="Penonaktifan Staf">Penonaktifan Staf</option>
                                                <option value="Penonaktifan Dokter Tetap">Penonaktifan Dokter Tetap</option>
											</select>
										</div>
                                    </div>
								</div>
                                <div class="form-group">
									<div class="row">
										<div class="form-group col-md-2">
                                            <label for="kepdiraktivasi_nomor">Nomor</label>
											<input type="text" class="form-control" id="kepdiraktivasi_nomor" name="kepdiraktivasi_nomor" placeholder="angka saja" />
										</div>
										<div class="form-group col-md-2">
                                            <label>TMT</label>
                                            <input type="text" class="form-control" id="kepdiraktivasi_tmt" name="kepdiraktivasi_tmt" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                        </div>
									    <div class="form-group col-md-2">
                                            <label>Tanggal SK</label>
                                            <input type="text" class="form-control" id="kepdiraktivasi_tanggal" name="kepdiraktivasi_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                        </div>
									    <div class="form-group col-md-3">
                                            <label>Pemeriksa Draft</label>
                                            <select id="kepdiraktivasi_pemeriksa" name="kepdiraktivasi_pemeriksa" size="1" class="form-control">
                                                <option value="SELF">Tidak di Periksa Kembali</option>
                                                @foreach($pejabats as $rpejabats)
                                                    <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Penandatangan</label>
                                            <select id="kepdiraktivasi_penandatangan" name="kepdiraktivasi_penandatangan" size="1" class="form-control">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($pejabats as $rpejabats)
                                                    <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
									</div>
								</div>
                            </div>
                            <!-- Default -->
                            <div class="card-footer divinputbtngroup">
                                <input type="hidden" id="cuti_id" name="cuti_id" value="{{ Session('email') }}">
								<input type="hidden" id="kontrak_id" name="kontrak_id" value="{{ Session('email') }}">
								<input type="hidden" id="keputusandirektur_id" name="keputusandirektur_id" value="{{ Session('email') }}">
								<input type="hidden" id="keputusandirektur_idpeg" name="keputusandirektur_idpeg" value="{{ Session('idpeg') }}">
								<input type="hidden" id="konseptor" name="konseptor" value="{{ Session('email') }}">
								<button type="button" class="btn btn-danger pull-left btnkembali">Cancel</button>
								<button type="button" class="btn btn-success pull-right" id="btnsimpansuratpertemplate">Simpan</button>
                            </div>
                        </form>
                        <div class="card-footer divtabelsuratkeluar">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <button class="btn btn-primary divinputbtngroup divcuti" id="btneditsettingcutitahunan"><i class="fa fa-plus"></i> Tambah Setting Cuti</button>
                                        <div id="gridsettingcuti" class="divinputbtngroup divcuti"></div>
                                        <div id="gridpensiunonly" class="divinputbtngroup divkontrakkerja"></div>
                                        <div class="divinputbtngroup divreferensikerja">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="referensi_nama">Nama Pegawai</label>
                                                    <select id="referensi_nama" name="referensi_nama" class="collectoridpeg form-control select2" @if($hakaksess == 0) disabled="disable" @endif>
                                                        <option value=""></option>
                                                        @foreach($arrallpeg as $pegawai)
                                                            @if (Session('idpeg') == $pegawai['id'])
                                                                <option value="{{ $pegawai['id'] }}" selected>{{ $pegawai['nama_lengkap'] }} ( {{ $pegawai['unit_kerja'] }} )</option>
                                                            @else
                                                                <option value="{{ $pegawai['id'] }}">{{ $pegawai['nama_lengkap'] }} ( {{ $pegawai['unit_kerja'] }} )</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="referensi_ppabp">Unit Kerja</label>
                                                    <input type="text" class="form-control masterunitkerja" id="referensi_ppabp" name="referensi_ppabp" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="referensi_alamat">Alamat</label>
                                                    <input type="text" class="form-control masteralamat" id="referensi_alamat"  name="referensi_alamat" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="referensi_jabatan">Jabatan</label>
                                                    <textarea id="referensi_jabatan"  name="referensi_jabatan" rows="5" cols="20"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <label for="referensi_mulai">Tanggal Mulai Bekerja</label>
                                                            <input type="text" class="form-control mastertmt_golongan" id="referensi_mulai" name="referensi_mulai" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label for="referensi_akhir">Tanggal Akhir Bekerja</label>
                                                            <input type="text" class="form-control" id="referensi_akhir" name="referensi_akhir" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{date('Y-m-d')}}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Pemeriksa Draft</label>
                                                    <select id="referensi_pemeriksa" name="referensi_pemeriksa" size="1" class="form-control select2">
                                                        <option value="">Tidak di Periksa Kembali</option>
                                                        @foreach($pejabats as $rpejabats)
                                                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Penandatangan Pihak Pertama</label>
                                                    <select id="referensi_penandatangan" name="referensi_penandatangan" size="1" class="form-control select2">
                                                        <option value="">Pilih Salah Satu</option>
                                                        @foreach($pejabats as $rpejabats)
                                                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <a id="btnsimpansuratreferensi" href="#" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Simpan</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divinputbtngroup divedaran">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="edaran_kepada">Ditujukan Kepada :</label>
                                                    <select id="edaran_kepada" name="edaran_kepada[]" class="form-control select2" multiple="multiple" data-placeholder="Boleh pilih lebih dari satu" style="width: 100%;">
                                                        @foreach($pejabats as $rpejabats)
                                                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['nama'] }} ( {{ $rpejabats['pejabat'] }} )</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="edaran_judul">Judul</label>
                                                    <input type="text" class="form-control" id="edaran_judul" name="edaran_judul" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="edaran_isi">Isi Surat</label>
                                                    <textarea id="edaran_isi" name="edaran_isi" rows="5" cols="20"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Pemeriksa Draft</label>
                                                    <select id="edaran_pemeriksa" name="edaran_pemeriksa" size="1" class="form-control select2">
                                                        <option value="">Tidak di Periksa Kembali</option>
                                                        @foreach($pejabats as $rpejabats)
                                                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Penandatangan Pihak Pertama</label>
                                                    <select id="edaran_penandatangan" name="edaran_penandatangan" size="1" class="form-control select2">
                                                        <option value="">Pilih Salah Satu</option>
                                                        @foreach($pejabats as $rpejabats)
                                                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="edaran_file">File Lampiran</label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="file" class="form-control" id="edaran_file">
                                                        <div class="input-group-append">
                                                            <div class="btn btn-primary">
                                                                <i class="fa fa-file-pdf-o"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <a id="btnsimpansuratedaran" href="#" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Simpan</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divinputbtngroup divkettidakbekerja">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="tidakbekerja_nama">Nama Pegawai</label>
                                                    <select id="tidakbekerja_nama" name="tidakbekerja_nama" class="collectoridpeg form-control select2" @if($hakaksess == 0) disabled="disable" @endif>
                                                        <option value=""></option>
                                                        @foreach($arrallpeg as $pegawai)
                                                            @if (Session('idpeg') == $pegawai['id'])
                                                                <option value="{{ $pegawai['id'] }}" selected>{{ $pegawai['nama_lengkap'] }} ( {{ $pegawai['unit_kerja'] }} )</option>
                                                            @else
                                                                <option value="{{ $pegawai['id'] }}">{{ $pegawai['nama_lengkap'] }} ( {{ $pegawai['unit_kerja'] }} )</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tidakbekerja_unitkerja">Unit Kerja</label>
                                                    <input type="text" class="form-control masterunitkerja" id="tidakbekerja_unitkerja" name="tidakbekerja_unitkerja" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="tidakbekerja_jabatan">Jabatan</label>
                                                    <input type="text" class="form-control masterjabatan" id="tidakbekerja_jabatan" name="tidakbekerja_jabatan" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="tidakbekerja_mulai">Tidak Bekerja Sejak</label>
                                                    <input type="text" class="form-control" id="tidakbekerja_mulai" name="tidakbekerja_mulai" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Pemeriksa Draft</label>
                                                    <select id="tidakbekerja_pemeriksa" name="tidakbekerja_pemeriksa" size="1" class="form-control select2">
                                                        <option value="">Tidak di Periksa Kembali</option>
                                                        @foreach($pejabats as $rpejabats)
                                                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Penandatangan Pihak Pertama</label>
                                                    <select id="tidakbekerja_penandatangan" name="tidakbekerja_penandatangan" size="1" class="form-control select2">
                                                        <option value="">Pilih Salah Satu</option>
                                                        @foreach($pejabats as $rpejabats)
                                                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <a id="btnsimpansurattidakbekerja" href="#" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Simpan</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divinputbtngroup divperingatan">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="peringatan_nama">Nama Pegawai</label>
                                                    <select id="peringatan_nama" name="peringatan_nama" class="collectoridpeg form-control select2" @if($hakaksess == 0) disabled="disable" @endif>
                                                        <option value=""></option>
                                                        @foreach($arrallpeg as $pegawai)
                                                            @if (Session('idpeg') == $pegawai['id'])
                                                                <option value="{{ $pegawai['id'] }}" selected>{{ $pegawai['nama_lengkap'] }} ( {{ $pegawai['unit_kerja'] }} )</option>
                                                            @else
                                                                <option value="{{ $pegawai['id'] }}">{{ $pegawai['nama_lengkap'] }} ( {{ $pegawai['unit_kerja'] }} )</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="peringatan_ppabp">Penempatan</label>
                                                    <input type="text" class="form-control masterppabp" id="peringatan_ppabp" name="peringatan_ppabp" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="peringatan_jabatan">Jabatan</label>
                                                    <input type="text" class="form-control masterjabatan" id="peringatan_jabatan" name="peringatan_jabatan" />
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-5">
                                                            <label for="peringatan_mulai">Tanggal Pelanggaran</label>
                                                            <input type="text" class="form-control" id="peringatan_mulai" name="peringatan_mulai" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <label for="peringatan_tempat">Tempat Kejadian</label>
                                                            <input type="text" class="form-control" id="peringatan_tempat" name="peringatan_tempat" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="peringatan_isi">Penjelasan Singkat Kejadian Pelanggaran</label>
                                                    <textarea id="peringatan_isi" name="peringatan_isi" rows="5" cols="20"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-5">
                                                            <label for="peringatan_jenis">Jenis</label>
                                                            <select id="peringatan_jenis" name="peringatan_jenis" class="form-control" />
                                                                <option value="">Pilih salah satu</option>
                                                                <option value="Teguran Tertulis">Teguran Tertulis</option>
                                                                <option value="SP I">SP I</option>
                                                                <option value="SP II">SP II</option>
                                                                <option value="SP III">SP III</option>
                                                                <option value="PHK">PHK</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <label for="peringatan_sanksi">Sanksi</label>
                                                            <input type="text" class="form-control" id="peringatan_sanksi" name="peringatan_sanksi" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Pemeriksa Draft</label>
                                                    <select id="peringatan_pemeriksa" name="peringatan_pemeriksa" size="1" class="form-control select2">
                                                        <option value="">Tidak di Periksa Kembali</option>
                                                        @foreach($pejabats as $rpejabats)
                                                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Penandatangan Pihak Pertama</label>
                                                    <select id="peringatan_penandatangan" name="peringatan_penandatangan" size="1" class="form-control select2">
                                                        <option value="">Pilih Salah Satu</option>
                                                        @foreach($pejabats as $rpejabats)
                                                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <a id="btnsimpansuratperingatan" href="#" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Simpan</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divinputbtngroup divpenambahanstaf">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="penambahanstaf_nama">Kepada</label>
                                                    <select id="penambahanstaf_nama" name="penambahanstaf_nama" class="form-control">
                                                        <option value=""></option>
                                                        @if(isset($arrsdomain) AND !empty($arrsdomain))
                                                            @foreach($arrsdomain as $rdomain)
                                                                <option value="{{ $rdomain->subsubdomainapps }}">{{ $rdomain->subsubdomainapps }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-7">
                                                            <label for="penambahanstaf_nomor">Nomor Surat</label>
                                                            <input type="text" class="form-control" id="penambahanstaf_nomor" name="penambahanstaf_nomor" />
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <label for="penambahanstaf_tanggal">Tanggal</label>
                                                            <input type="text" class="form-control" id="penambahanstaf_tanggal" name="penambahanstaf_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="penambahanstaf_isi">Lampiran</label>
                                                    <textarea id="penambahanstaf_isi" name="penambahanstaf_isi" rows="5" cols="20"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Pemeriksa Draft</label>
                                                    <select id="penambahanstaf_pemeriksa" name="penambahanstaf_pemeriksa" size="1" class="form-control select2">
                                                        <option value="">Tidak di Periksa Kembali</option>
                                                        @foreach($pejabats as $rpejabats)
                                                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Penandatangan Pihak Pertama</label>
                                                    <select id="penambahanstaf_penandatangan" name="penambahanstaf_penandatangan" size="1" class="form-control select2">
                                                        <option value="">Pilih Salah Satu</option>
                                                        @foreach($pejabats as $rpejabats)
                                                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <a id="btnsimpanpenambahanstaf" href="#" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Simpan</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divinputbtngroup divtugas">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="tugas_kepada">Ditujukan Kepada :</label>
                                                    <select id="tugas_kepada" name="tugas_kepada" class="form-control select2" style="width: 100%;">
                                                        @foreach($arrallpeg as $rpeg)
                                                            <option pejabat="{{ $rpeg['jabatan'] }}" nama="{{ $rpeg['nama_lengkap'] }}" value="{{ $rpeg['id'] }}">{{ $rpeg['nama_lengkap'] }} ( {{ $rpeg['jabatan'] }} )</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tugas_tekskepada">Text Tujuan</label>
                                                    <textarea id="tugas_tekskepada" name="tugas_tekskepada" rows="5" cols="20"></textarea>
                                                    <input type="hidden" class="form-control" id="tugas_hiddenkepada" name="tugas_hiddenkepada" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="tugas_judul">Acara</label>
                                                    <input type="text" class="form-control" id="tugas_judul" name="tugas_judul" />
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <label for="tugas_mulai">Tanggal</label>
                                                            <input type="text" class="form-control" id="tugas_mulai" name="tugas_mulai" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label for="tugas_waktu">Waktu</label>
                                                            <input type="text" class="form-control" id="tugas_waktu" name="tugas_waktu" />
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label for="tugas_tempat">Tempat</label>
                                                            <input type="text" class="form-control" id="tugas_tempat" name="tugas_tempat" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Pemeriksa Draft</label>
                                                    <select id="tugas_pemeriksa" name="tugas_pemeriksa" size="1" class="form-control select2">
                                                        <option value="">Tidak di Periksa Kembali</option>
                                                        @foreach($pejabats as $rpejabats)
                                                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Penandatangan Pihak Pertama</label>
                                                    <select id="tugas_penandatangan" name="tugas_penandatangan" size="1" class="form-control select2">
                                                        <option value="">Pilih Salah Satu</option>
                                                        @foreach($pejabats as $rpejabats)
                                                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <a id="btnsimpansurattugas" href="#" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Simpan</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divinputbtngroup divpermohonan">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="permohonan_kepada">Ditujukan Kepada :</label>
                                                    <select id="permohonan_kepada" name="permohonan_kepada" class="form-control select2" style="width: 100%;">
                                                        @foreach($pejabats as $rpejabats)
                                                            <option idjabatan="{{ $rpejabats['id'] }}" nama="{{ $rpejabats['nama'] }}" value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="permohonan_tekskepada">Text Tujuan</label>
                                                    <textarea id="permohonan_tekskepada" name="permohonan_tekskepada" rows="5" cols="20"></textarea>
                                                    <input type="hidden" class="form-control" id="permohonan_hiddenkepada" name="permohonan_hiddenkepada" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="permohonan_judul">Perihal</label>
                                                    <input type="text" class="form-control" id="permohonan_judul" name="permohonan_judul" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="permohonan_isi">Isi Surat</label>
                                                    <textarea id="permohonan_isi" name="permohonan_isi" rows="5" cols="20"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mengetahui : </label>
                                                    <select id="permohonan_pemeriksa" name="permohonan_pemeriksa" size="1" class="form-control select2">
                                                        <option value="">Tidak di Periksa Kembali</option>
                                                        @foreach($pejabats as $rpejabats)
                                                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Menyetujui</label>
                                                    <select id="permohonan_penandatangan" name="permohonan_penandatangan" size="1" class="form-control select2">
                                                        <option value="">Pilih Salah Satu</option>
                                                        @foreach($pejabats as $rpejabats)
                                                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <a id="btnsimpansuratpermohonan" href="#" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Simpan</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divinputbtngroup divpemberitahuanmutasi">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="pemberitahuan_kepada">Ditujukan Kepada :</label>
                                                    <select id="pemberitahuan_kepada" name="pemberitahuan_kepada[]" class="form-control select2" multiple="multiple" data-placeholder="Boleh pilih lebih dari satu" style="width: 100%;">
                                                        @foreach($pejabats as $rpejabats)
                                                            <option idjabatan="{{ $rpejabats['id'] }}" nama="{{ $rpejabats['nama'] }}" value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="pemberitahuan_isi">Berdasarkan :</label>
                                                    <textarea id="pemberitahuan_isi" name="pemberitahuan_isi" rows="5" cols="20"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="pemberitahuan_pegawai">Pegawai yang dimaksud :</label>
                                                    <select id="pemberitahuan_pegawai" name="pemberitahuan_pegawai[]" class="form-control select2" multiple="multiple" data-placeholder="Boleh pilih lebih dari satu" style="width: 100%;">
                                                        @foreach($arrallpeg as $rpeg)
                                                            <option value="{{ $rpeg['id'] }}">{{ $rpeg['nama_lengkap'] }} ( {{ $rpeg['jabatan'] }} )</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="pemberitahuan_asal">Asal Unit</label>
                                                    <select id="pemberitahuan_asal" name="pemberitahuan_asal" class="form-control">
                                                        <option value=""></option>
                                                        @if(isset($arrsdomain) AND !empty($arrsdomain))
                                                            @foreach($arrsdomain as $rdomain)
                                                                <option value="{{ $rdomain->subsubdomainapps }}">{{ $rdomain->subsubdomainapps }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="pemberitahuan_tujuan">Mutasi Ke Unit</label>
                                                    <select id="pemberitahuan_tujuan" name="pemberitahuan_tujuan" class="form-control">
                                                        <option value=""></option>
                                                        @if(isset($arrsdomain) AND !empty($arrsdomain))
                                                            @foreach($arrsdomain as $rdomain)
                                                                <option value="{{ $rdomain->subsubdomainapps }}">{{ $rdomain->subsubdomainapps }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="pemberitahuan_tanggal">Tanggal Efektif</label>
                                                    <input type="text" class="form-control" id="pemberitahuan_tanggal" name="pemberitahuan_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Pemeriksa Draft</label>
                                                    <select id="pemberitahuan_pemeriksa" name="pemberitahuan_pemeriksa" size="1" class="form-control select2">
                                                        <option value="">Tidak di Periksa Kembali</option>
                                                        @foreach($pejabats as $rpejabats)
                                                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Penandatangan</label>
                                                    <select id="pemberitahuan_penandatangan" name="pemberitahuan_penandatangan" size="1" class="form-control select2">
                                                        <option value="">Pilih Salah Satu</option>
                                                        @foreach($pejabats as $rpejabats)
                                                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <a id="btnsimpanpemberitahuanmutasi" href="#" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Simpan</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divinputbtngroup divpemberitahuantdkmemperpanjangkontrak">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="tdkmemperpanjangkontrak_nama">Nama Pegawai</label>
                                                    <select id="tdkmemperpanjangkontrak_nama" name="tdkmemperpanjangkontrak_nama" class="collectoridpeg form-control select2" @if($hakaksess == 0) disabled="disable" @endif>
                                                        <option value=""></option>
                                                        @foreach($arrallpeg as $pegawai)
                                                            @if (Session('idpeg') == $pegawai['id'])
                                                                <option value="{{ $pegawai['id'] }}" selected>{{ $pegawai['nama_lengkap'] }} ( {{ $pegawai['unit_kerja'] }} )</option>
                                                            @else
                                                                <option value="{{ $pegawai['id'] }}">{{ $pegawai['nama_lengkap'] }} ( {{ $pegawai['unit_kerja'] }} )</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tdkmemperpanjangkontrak_ppabp">Penempatan</label>
                                                    <input type="text" class="form-control masterppabp" id="tdkmemperpanjangkontrak_ppabp" name="tdkmemperpanjangkontrak_ppabp" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="tdkmemperpanjangkontrak_jabatan">Jabatan</label>
                                                    <input type="text" class="form-control masterjabatan" id="tdkmemperpanjangkontrak_jabatan"  name="tdkmemperpanjangkontrak_jabatan" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="tdkmemperpanjangkontrak_tmtpensiun">Tanggal Akhir Kontrak</label>
                                                    <input type="text" class="form-control mastertmt_pensiun" id="tdkmemperpanjangkontrak_tmtpensiun" name="tdkmemperpanjangkontrak_tmtpensiun" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Pemeriksa Draft</label>
                                                    <select id="tdkmemperpanjangkontrak_pemeriksa" name="tdkmemperpanjangkontrak_pemeriksa" size="1" class="form-control select2">
                                                        <option value="">Tidak di Periksa Kembali</option>
                                                        @foreach($pejabats as $rpejabats)
                                                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Penandatangan Pihak Pertama</label>
                                                    <select id="tdkmemperpanjangkontrak_penandatangan" name="tdkmemperpanjangkontrak_penandatangan" size="1" class="form-control select2">
                                                        <option value="">Pilih Salah Satu</option>
                                                        @foreach($pejabats as $rpejabats)
                                                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <a id="btnsimpansurattdkmemperpanjangkontrak" href="#" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Simpan</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divinputbtngroup divtanggapanresign">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="tanggapanresign_jenis">Jenis</label>
                                                    <select id="tanggapanresign_jenis" name="tanggapanresign_jenis" class="form-control" >
                                                        <option value="Tanggapan Pengunduran Diri Masa Orientasi">Tanggapan Pengunduran Diri Masa Orientasi</option>
                                                        <option value="Tanggapan Pengunduran Diri Sebelum Berakhir Masa Orientasi">Tanggapan Pengunduran Diri Sebelum Berakhir Masa Orientasi</option>
                                                        <option value="Tanggapan Permohonan Tidak Memperpanjang Kontrak">Tanggapan Permohonan Tidak Memperpanjang Kontrak</option>
                                                        <option value="Tanggapan Pengunduran Diri Pegawai Tetap">Tanggapan Pengunduran Diri Pegawai Tetap</option>
                                                        <option value="Tanggapan Pengunduran Diri Sebelum Berakhir Masa Kontrak">Tanggapan Pengunduran Diri Sebelum Berakhir Masa Kontrak</option>
                                                        <!-- <option value="Tanggapan Pengunduran Diri">Tanggapan Pengunduran Diri</option> -->
                                                        <option value="Tanggapan Pengunduran Diri Dokter Umum/Spesialis">Tanggapan Pengunduran Diri Dokter Umum/Spesialis</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggapanresign_nama">Nama Pegawai</label>
                                                    <select id="tanggapanresign_nama" name="tanggapanresign_nama" class="collectoridpeg form-control select2" @if($hakaksess == 0) disabled="disable" @endif>
                                                        <option value=""></option>
                                                        @foreach($arrallpeg as $pegawai)
                                                            @if (Session('idpeg') == $pegawai['id'])
                                                                <option value="{{ $pegawai['id'] }}" selected>{{ $pegawai['nama_lengkap'] }} ( {{ $pegawai['unit_kerja'] }} )</option>
                                                            @else
                                                                <option value="{{ $pegawai['id'] }}">{{ $pegawai['nama_lengkap'] }} ( {{ $pegawai['unit_kerja'] }} )</option>
                                                            @endif
                                                        @endforeach
                                                        @if(isset($arrallnonpeg) AND !empty($arrallnonpeg))
                                                            @foreach($arrallnonpeg as $rows)
                                                                <option value="{{$rows->email_ub}}" idpeg="{{$rows->id}}">{!! $rows->nama_lengkap !!} ( {!! $rows->jabatan !!} - {!! $rows->unit !!} )</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggapanresign_ppabp">Penempatan</label>
                                                    <input type="text" class="form-control masterppabp" id="tanggapanresign_ppabp" name="tanggapanresign_ppabp" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggapanresign_jabatan">Jabatan</label>
                                                    <input type="text" class="form-control masterjabatan" id="tanggapanresign_jabatan"  name="tanggapanresign_jabatan" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggapanresign_tanggal">Tanggal Permohonan</label>
                                                    <input type="text" class="form-control" id="tanggapanresign_tanggal" name="tanggapanresign_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggapanresign_tmtpensiun">Tanggal Akhir Kontrak</label>
                                                    <input type="text" class="form-control mastertmt_pensiun" id="tanggapanresign_tmtpensiun" name="tanggapanresign_tmtpensiun" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggapanresign_keputusan">Keputusan</label>
                                                    <select id="tanggapanresign_keputusan" name="tanggapanresign_keputusan" class="form-control" >
                                                        <option value="setujui">setujui</option>
                                                        <option value="tidak setujui">tidak setujui</option>
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Pemeriksa Draft</label>
                                                    <select id="tanggapanresign_pemeriksa" name="tanggapanresign_pemeriksa" size="1" class="form-control select2">
                                                        <option value="">Tidak di Periksa Kembali</option>
                                                        @foreach($pejabats as $rpejabats)
                                                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Penandatangan Pihak Pertama</label>
                                                    <select id="tanggapanresign_penandatangan" name="tanggapanresign_penandatangan" size="1" class="form-control select2">
                                                        <option value="">Pilih Salah Satu</option>
                                                        @foreach($pejabats as $rpejabats)
                                                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <a id="btnsimpansurattanggapanresign" href="#" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Simpan</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divinputbtngroup divketbekerja">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="ketbekerja_nama">Nama Pegawai</label>
                                                    <select id="ketbekerja_nama" name="ketbekerja_nama" class="collectoridpeg form-control select2" @if($hakaksess == 0) disabled="disable" @endif>
                                                        <option value=""></option>
                                                        @foreach($arrallpeg as $pegawai)
                                                            @if (Session('idpeg') == $pegawai['id'])
                                                                <option value="{{ $pegawai['id'] }}" selected>{{ $pegawai['nama_lengkap'] }} ( {{ $pegawai['unit_kerja'] }} )</option>
                                                            @else
                                                                <option value="{{ $pegawai['id'] }}">{{ $pegawai['nama_lengkap'] }} ( {{ $pegawai['unit_kerja'] }} )</option>
                                                            @endif
                                                        @endforeach
                                                        @if(isset($arrallnonpeg) AND !empty($arrallnonpeg))
                                                            @foreach($arrallnonpeg as $rows)
                                                                <option value="{{$rows->email_ub}}" idpeg="{{$rows->id}}">{!! $rows->nama_lengkap !!} ( {!! $rows->jabatan !!} - {!! $rows->unit !!} )</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="ketbekerja_ppabp">Penempatan</label>
                                                    <input type="text" class="form-control masterppabp" id="ketbekerja_ppabp" name="ketbekerja_ppabp" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="ketbekerja_jabatan">Jabatan</label>
                                                    <input type="text" class="form-control masterjabatan" id="ketbekerja_jabatan" name="ketbekerja_jabatan" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="ketbekerja_unitkerja">Unit Kerja</label>
                                                    <input type="text" class="form-control masterunitkerja" id="ketbekerja_unitkerja" name="ketbekerja_unitkerja" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="ketbekerja_mulai">Bekerja Sejak</label>
                                                    <input type="text" class="form-control mastertmt_golongan" id="ketbekerja_mulai" name="ketbekerja_mulai" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Pemeriksa Draft</label>
                                                    <select id="ketbekerja_pemeriksa" name="ketbekerja_pemeriksa" size="1" class="form-control select2">
                                                        <option value="">Tidak di Periksa Kembali</option>
                                                        @foreach($pejabats as $rpejabats)
                                                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Penandatangan Pihak Pertama</label>
                                                    <select id="ketbekerja_penandatangan" name="ketbekerja_penandatangan" size="1" class="form-control select2">
                                                        <option value="">Pilih Salah Satu</option>
                                                        @foreach($pejabats as $rpejabats)
                                                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <a id="btnsimpansuratbekerja" href="#" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Simpan</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divinputbtngroup divundangan">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="undangan_kepada">Undangan Kepada :</label>
                                                    <select id="undangan_kepada" name="undangan_kepada[]" class="form-control select2" multiple="multiple" data-placeholder="Boleh pilih lebih dari satu" style="width: 100%;">
                                                        @foreach($arrallpeg as $rpeg)
                                                            <option value="{{ $rpeg['id'] }}">{{ $rpeg['nama_lengkap'] }} ( {{ $rpeg['jabatan'] }} )</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="undangan_kepada2">Undangan Kepada (Penerima di Luar PT) Pisah dengan tanda titik koma (;) setiap barisnya</label>
                                                    <textarea id="undangan_kepada2" name="undangan_kepada2" class="form-control"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="undangan_judul">Acara</label>
                                                    <input type="text" class="form-control" id="undangan_judul" name="undangan_judul" />
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <label for="undangan_mulai">Tanggal</label>
                                                            <input type="text" class="form-control" id="undangan_mulai" name="undangan_mulai" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label for="undangan_waktu">Waktu</label>
                                                            <input type="text" class="form-control" id="undangan_waktu" name="undangan_waktu" />
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label for="undangan_tempat">Tempat</label>
                                                            <input type="text" class="form-control" id="undangan_tempat" name="undangan_tempat" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Pemeriksa Draft</label>
                                                    <select id="undangan_pemeriksa" name="undangan_pemeriksa" size="1" class="form-control select2">
                                                        <option value="">Tidak di Periksa Kembali</option>
                                                        @foreach($pejabats as $rpejabats)
                                                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Penandatangan Pihak Pertama</label>
                                                    <select id="undangan_penandatangan" name="undangan_penandatangan" size="1" class="form-control select2">
                                                        <option value="">Pilih Salah Satu</option>
                                                        @foreach($pejabats as $rpejabats)
                                                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <a id="btnsimpansuratundangan" href="#" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Simpan</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="divinputbtngroup divpanggilankie">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="panggilankie_nama">Nama Pegawai Yang diPanggil</label>
                                                    <select id="panggilankie_nama" name="panggilankie_nama" class="collectoridpeg form-control select2" @if($hakaksess == 0) disabled="disable" @endif>
                                                        <option value=""></option>
                                                        @foreach($arrallpeg as $pegawai)
                                                            <option value="{{ $pegawai['email_ub'] }}"  idpeg="{{$rows->id}}">{{ $pegawai['nama_lengkap'] }} ( {{ $pegawai['unit_kerja'] }} )</option>
                                                        @endforeach
                                                        @if(isset($arrallnonpeg) AND !empty($arrallnonpeg))
                                                            @foreach($arrallnonpeg as $rows)
                                                                <option value="{{$rows->email_ub}}" idpeg="{{$rows->id}}">{!! $rows->nama_lengkap !!} ( {!! $rows->jabatan !!} - {!! $rows->unit !!} )</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <label for="panggilankie_mulai">Tanggal</label>
                                                            <input type="text" class="form-control" id="panggilankie_mulai" name="panggilankie_mulai" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label for="panggilankie_waktu">Waktu</label>
                                                            <input type="text" class="form-control" id="panggilankie_waktu" name="panggilankie_waktu" />
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label for="panggilankie_tempat">Tempat</label>
                                                            <input type="text" class="form-control" id="panggilankie_tempat" name="panggilankie_tempat" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="panggilankie_hasil">Hasil Konseling</label>
                                                    <textarea id="panggilankie_hasil" name="panggilankie_hasil" class="form-control"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Pemeriksa Draft</label>
                                                    <select id="panggilankie_pemeriksa" name="panggilankie_pemeriksa" size="1" class="form-control select2">
                                                        <option value="">Tidak di Periksa Kembali</option>
                                                        @foreach($pejabats as $rpejabats)
                                                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Penandatangan Pihak Pertama</label>
                                                    <select id="panggilankie_penandatangan" name="panggilankie_penandatangan" size="1" class="form-control select2">
                                                        <option value="">Pilih Salah Satu</option>
                                                        @foreach($pejabats as $rpejabats)
                                                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                        <input type="hidden" id="panggilankie_idne" name="panggilankie_idne" />
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <a id="btnsimpanpanggilankie" href="#" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Simpan</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divinputbtngroup divspo">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="spo_judul">Judul</label>
                                                    <input type="text" class="form-control" id="spo_judul" name="spo_judul" />
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <label for="spo_nomordokumen">No. Dokumen</label>
                                                            <input type="text" class="form-control" id="spo_nomordokumen" name="spo_nomordokumen" placeholder="Ketik Nomor Saja" />
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label for="spo_nomorrevisi">No. Revisi</label>
                                                            <input type="text" class="form-control" id="spo_nomorrevisi" name="spo_nomorrevisi" placeholder="Ketik Nomor Saja" />
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label for="spo_tanggal">Tanggal</label>
                                                            <input type="text" class="form-control" id="spo_tanggal" name="spo_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Penandatangan</label>
                                                    <select id="spo_penandatangan" name="spo_penandatangan" size="1" class="form-control select2">
                                                        <option value="">Pilih Salah Satu</option>
                                                        @foreach($pejabats as $rpejabats)
                                                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <a id="btnsimpanspo" href="#" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Simpan</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div id="gridsuratkeluar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer divinputbtngroup divtabelkeputusandirektur">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a id="btntambahstafmanual" href="#" class="btn btn-primary btnviewtambahstafmanual"><i class="fa fa-plus"></i> Click Bila Tidak ada di Tabel</a>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="form-group col-md-7">
                                                    <label for="ppabp">Unit Kerja</label>
                                                    <select id="ppabp" name="ppabp" class="form-control">
                                                        <option value="ALLPPABP">ALL</option>
                                                        @if (Session('fakultas') == 'DPM')
                                                            <option value="PT Disa Prima Medika" selected>PT Disa Prima Medika</option>
                                                        @else
                                                            <option value="PT Disa Prima Medika">PT Disa Prima Medika</option>
                                                        @endif
                                                        @if (Session('fakultas') == 'RSPHMLG')
                                                            <option value="RS Prima Husada Malang" selected>RS Prima Husada Malang</option>
                                                        @else
                                                            <option value="RS Prima Husada Malang">RS Prima Husada Malang</option>
                                                        @endif
                                                        @if (Session('fakultas') == 'RSPHSKR')
                                                            <option value="RS Prima Husada Sukorejo" selected>RS Prima Husada Sukorejo</option>
                                                        @else
                                                            <option value="RS Prima Husada Sukorejo">RS Prima Husada Sukorejo</option>
                                                        @endif
                                                        @if (Session('fakultas') == 'PDP')
                                                            <option value="CV Putra Disa Prima" selected>CV Putra Disa Prima</option>
                                                        @else
                                                            <option value="CV Putra Disa Prima">CV Putra Disa Prima</option>
                                                        @endif
                                                        <option value="REKRUTMEN PT DISA PRIMA MEDIKA">REKRUTMEN PT DISA PRIMA MEDIKA</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label>Status Pegawai</label>
                                                    <div class="input-group margin">
                                                        <select id="aktiftidaknya" name="aktiftidaknya" class="form-control">
                                                            <option value="1">Aktif</option>
                                                            <option value="0">Non Aktif</option>
                                                        </select>
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-info btn-flat topbtnopenpegawai" type="button">View</button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <select id="keputusandirektur_jenis" name="keputusandirektur_jenis" class="form-control">
                                                <option value="Pengangkatan Jabatan">Pengangkatan Jabatan</option>
                                                <option value="Pemberhentian Jabatan">Pemberhentian Jabatan</option>
                                                <option value="Pegawai Tetap">Pegawai Tetap</option>
                                                <option value="Dokter Tetap">Dokter Tetap</option>
                                                <option value="Penerimaan Staf">Penerimaan Staf</option>
                                                <option value="Penonaktifan Staf">Penonaktifan Staf</option>
                                                <option value="Pengaktifan Staf">Pengaktifan Staf</option>
                                                <option value="Mutasi">Mutasi</option>
                                                <option value="Penonaktifan Dokter Tetap">Penonaktifan Dokter Tetap</option>
                                                <option value="Pemutusan Hubungan Kerja">Pemutusan Hubungan Kerja</option>
                                                <option value="Penempatan Administrasi Pendaftaran">Penempatan Administrasi Pendaftaran</option>
                                                <option value="Penempatan Analis Kesehatan">Penempatan Analis Kesehatan</option>
                                                <option value="Penempatan Perawat">Penempatan Perawat</option>
                                                <option value="Penempatan Perekam Medik">Penempatan Perekam Medik</option>
                                                <option value="Penempatan Security">Penempatan Security</option>
                                            </select>
                                        </div>
                                        <div id="gridpelamar" class="divinputbtngroup divkeputusandirektur"></div>
                                    </div>
                                    <div class="col-md-8">
                                        <div id="gridskeputusandirektur"></div>
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
	<div id="timeremaining" class="pull-right"></div>
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <input type="hidden" name="set_prodi" id="set_prodi">
    <input type="hidden" name="jenissurat" id="jenissurat">
    <input type="hidden" name="petugas" id="petugas" value="{{ Session('id') }}">
    <input type="hidden" name="kelompok" id="kelompok">
</div>
<div class="modal fade" id="modalsettingcuti">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Setting Cuti</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Tahun</label>
                    <input type="text" id="setting_tahun" name="setting_tahun" class="form-control">
                </div>
                <div class="form-group">
                    <label>Jumlah Cuti</label>
                    <input type="text" id="setting_jumlah" name="setting_jumlah" class="form-control">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="setting_id">
                <button type="button" class="btn btn-success pull-right" id="btnsimpansetting">Simpan</button>
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalsettingtemplate">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Setting Template</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="templateedit_nama" class="col-form-label">Jenis Template <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="templateedit_nama" name="templateedit_nama" disabled="disable">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="templateedit_posisi" class="col-form-label">Posisi</label>
                        <select size="1" class="form-control" id="templateedit_posisi" name="templateedit_posisi">
                            <option value="0">Tanpa Tab</option>
                            <option value="1">Tab Pertama</option>
                            <option value="2">Tab Kedua</option>
                            <option value="3">Tab Ketiga</option>
                            <option value="4">Tab 1 Tanpa titik dua</option>
                            <option value="5">Menimbang Tab 1</option>
                            <option value="6">Menimbang Tab 2</option>
                            <option value="7">PenandaTangan Kanan</option>
                            <option value="10">Nama : (Tab 1)</option>
                            <option value="8">Nama : (Tab 2)</option>
                            <option value="9">Menimbang Tab 1 (tanpa titik dua)</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="templateedit_baris" class="col-form-label">Rows</label>
                        <input type="text" class="form-control" id="templateedit_baris" name="templateedit_baris">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="templateedit_letter" class="col-form-label">Letter</label>
                        <input type="text" class="form-control" id="templateedit_letter" name="templateedit_letter">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="templateedit_menimbang" class="col-form-label">Chlid1</label>
                        <input type="text" class="form-control" id="templateedit_menimbang" name="templateedit_menimbang">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="templateedit_mengingat" class="col-form-label">Child2</label>
                        <input type="text" class="form-control" id="templateedit_mengingat" name="templateedit_mengingat">
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="templateedit_text" name="templateedit_text">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="templateedit_idne" name="templateedit_idne">
                <button type="button" class="btn btn-warning pull-right" id="btnpagebreak">Add Page Break</button>
                <button type="button" class="btn btn-info pull-right" id="btnspasi">Add Space</button>
                <button type="button" class="btn btn-primary pull-left" id="btnsimpandrattemplate">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalsettingpenandatangankontrak">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Setting Penandatangan Kontrak</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Pemeriksa Draft</label>
                    <select id="kirimkontrak_pemeriksa" size="1" class="form-control select2">
                        <option value="">Tidak di Periksa Kembali</option>
                        @foreach($pejabats as $rpejabats)
                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Penandatangan Pihak Pertama</label>
                    <select id="kirimkontrak_penandatangan" size="1" class="form-control select2">
                        <option value="">Tidak di Periksa Kembali</option>
                        @foreach($pejabats as $rpejabats)
                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="kirimkontrak_marking">
                <input type="hidden" class="form-control" id="kirimkontrak_jenis">
                <button type="button" class="btn btn-success pull-right" id="btnkirimdraftkontrak">Simpan</button>
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaluploadsuratmaterai">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">File bermeterai </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="uploadmet_file">File PDF Yang Telah dibubuhi e-meterai</label>
                    <div class="input-group input-group-sm">
                        <input type="file" class="form-control" id="uploadmet_file">
                        <div class="input-group-append">
                            <div class="btn btn-primary">
                                <i class="fa fa-file-pdf-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    Catatan : Pastikan Surat Sudah Memiliki TTE dan Telah di Bubuhkan e-Meterai (tidak boleh menggunakan meterai tempel / cetak) Sebelum meng unggah.
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" name="uploadmet_marking" id="uploadmet_marking">
                <button type="button" class="btn btn-success pull-left" id="btnuploadfilebermeterai">Upload</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalpilihan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pemberitahuan Apa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="btn-group">
                    <button type="button" class="btn btn-success btn-block" id="btnpilihpemberitahuanmutasi">Pemberitahuan Mutasi</button>
                    <button type="button" class="btn btn-warning  btn-block" id="btnpilihtidakmempanjangkontrak">Pemberitahuan Tidak Diperpanjang Kontrak</button>
                    <button type="button" class="btn btn-info btn-block" id="btnpilihpemberitahuansekre">Pemberitahuan Sekretaris</button>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalpilihanpenempatanataupengaktifan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pilih Jenis SK</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="pilih_jenissk">Jenis SK</label>
                    <select id="pilih_jenissk" name="pilih_jenissk" class="form-control masterstatus_jabatan">
                        <option value="Pengaktifan Staf">Pengaktifan Staf</option>
                        <option value="Penempatan Administrasi Pendaftaran">Penempatan Administrasi Pendaftaran</option>
                        <option value="Penempatan Analis Kesehatan">Penempatan Analis Kesehatan</option>
                        <option value="Penempatan Perawat">Penempatan Perawat</option>
                        <option value="Penempatan Perekam Medik">Penempatan Perekam Medik</option>
                        <option value="Penempatan Security">Penempatan Security</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-success" id="btnsetpilihansk">Open</button>	
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaluploadsuratcustom">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload Dokumen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Pemeriksa Draft</label>
                    <select id="srtcustom_pemeriksa" size="1" class="form-control select2">
                        <option value="">Tidak di Periksa Kembali</option>
                        @foreach($pejabats as $rpejabats)
                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Penandatangan Pihak Pertama</label>
                    <select id="srtcustom_penandatangan" size="1" class="form-control select2">
                        <option value="">Tidak di Periksa Kembali</option>
                        @foreach($pejabats as $rpejabats)
                            <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="srtcustom_file">File PDF</label>
                    <div class="input-group input-group-sm">
                        <input type="file" class="form-control" id="srtcustom_file">
                        <div class="input-group-append">
                            <div class="btn btn-primary">
                                <i class="fa fa-file-pdf-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    Catatan : Mohon file yang diupload telah disematkan qrcode yang digenerate di tabel ini
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="srtcustom_marking">
                <input type="hidden" class="form-control" id="srtcustom_jenis">
                <button type="button" class="btn btn-success pull-right" id="btnsimpansuratcustom">Simpan</button>
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>	
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(function () {
        let summernoteOptions = {
            height: 300
        }
		CKEDITOR.env.isCompatible = true;
        CKEDITOR.replace( 'kirim_keterangan', {
			toolbarGroups: [{"name":"paragraph","groups":["list"]}],
			removeButtons: '',
			width: '100%',
			height: 50
		});
        CKEDITOR.replace( 'panggilankie_hasil', {
			toolbarGroups: [{"name":"paragraph","groups":["list"]}],
			removeButtons: '',
			width: '100%',
			height: 50
		});
        CKEDITOR.replace('kepdirangkat_uraiantugas');
        CKEDITOR.replace('kepdir_uraiantugas');
        CKEDITOR.replace('kepdir_uraiantugas2');
        CKEDITOR.replace('kepdir_uraiantugas3');
        
        $('#spo_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#kepdirangkat_tmt').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#kepdirangkat_mulai').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#kepdirangkat_akhir').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#kepdirangkat_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#kepdirpemberhentian_tmt').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#kepdirpemberhentian_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#kepdiraktivasi_tmt').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#kepdiraktivasi_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#kepdirpegtetap_tmt').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#kepdirpegtetap_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#kepdirmutasi_tmt').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#kepdirmutasi_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#ketbekerja_mulai').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#tanggapanresign_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#tdkmemperpanjangkontrak_tmtpensiun').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#pemberitahuan_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#tugas_mulai').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#undangan_mulai').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#panggilankie_mulai').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#penambahanstaf_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#referensi_mulai').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#referensi_akhir').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#peringatan_mulai').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#tidakbekerja_mulai').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#kepdir_tmt_golongan').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#kepdir_tmt_fungsional').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#cuti_mulai').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#cuti_akhir').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#kontrak_tgl_lahir').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#kontrak_mulai').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#kontrak_akhir').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#kontrak_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#kirim_tglmulai').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#kirim_tglselesai').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$("#kirim_jammulai").timepicker({format: 'HH:mm:ss'});
		$("#kirim_jamselesai").timepicker({format: 'HH:mm:ss'});
	});
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
    function openpegawai( jQuery ){
        var set01   = document.getElementById('jenissurat').value;
        var set02   = document.getElementById('kelompok').value;
        var set03   = document.getElementById('petugas').value;
        var set04   = document.getElementById('aktiftidaknya').value;
        var set05   = document.getElementById('ppabp').value;
        var sourceinterviewer   = {
            datatype: "json",
            datafields: [
                { name: 'id'},
                { name: 'idpeg', type: 'text'},
                { name: 'jenispeg', type: 'text'},
                { name: 'fungsional', type: 'text'},
                { name: 'nik', type: 'text'},
                { name: 'nokk', type: 'text'},
                { name: 'nama_lengkap', type: 'text'},
                { name: 'nama', type: 'text'},
                { name: 'depan', type: 'text'},
                { name: 'belakang', type: 'text'},
                { name: 'depan2', type: 'text'},
                { name: 'belakang2', type: 'text'},
                { name: 'jenisnip', type: 'text'},
                { name: 'niplama', type: 'text'},
                { name: 'nip_baru', type: 'text'},
                { name: 'nidn', type: 'text'},
                { name: 'jenis_kelamin', type: 'text'},
                { name: 'tmpt_lahir', type: 'text'}, 
                { name: 'tgl_lahir', type: 'text'},
                { name: 'pangkat', type: 'text'},
                { name: 'golongan', type: 'text'},
                { name: 'namabank', type: 'text'},
                { name: 'norek', type: 'text'},
                { name: 'namapdrekening', type: 'text'},
                { name: 'gajisesuaisk', type: 'text'},
                { name: 'gajibarublmmsk', type: 'text'},
                { name: 'kategorigaji', type: 'text'},
                { name: 'tjistri', type: 'text'},
                { name: 'tjanak', type: 'text'},
                { name: 'tjupns', type: 'text'},
                { name: 'tjstruk', type: 'text'},
                { name: 'tjfungs', type: 'text'},
                { name: 'tjdaerah', type: 'text'},
                { name: 'tjpencil', type: 'text'},
                { name: 'tjlain', type: 'text'},
                { name: 'tjkompen', type: 'text'},
                { name: 'pembul', type: 'text'},
                { name: 'tjberas', type: 'text'},
                { name: 'tjpph', type: 'text'},
                { name: 'potpfkbul', type: 'text'},
                { name: 'potpfk2', type: 'text'},
                { name: 'potpfk10', type: 'text'},
                { name: 'potpph', type: 'text'},
                { name: 'potswrum', type: 'text'},
                { name: 'potkelbtj', type: 'text'},
                { name: 'potlain', type: 'text'},
                { name: 'pottabrum', type: 'text'},
                { name: 'npwp', type: 'text'},
                { name: 'statusnpwp', type: 'text'},
                { name: 'status', type: 'text'},
                { name: 'keterangan', type: 'text'},
                { name: 'tmt_golongan', type: 'text'},
                { name: 'jab_fungsional', type: 'text'},
                { name: 'tmt_fungsional', type: 'text'},
                { name: 'tmt_pensiun', type: 'text'},
                { name: 'thn_pensiun', type: 'text'},
                { name: 'cpns', type: 'text'},
                { name: 'tmt_cpns', type: 'text'},
                { name: 'pns', type: 'text'},
                { name: 'tmt_pns', type: 'text'},
                { name: 'thn_masuk', type: 'text'},
                { name: 'unit_kerja', type: 'text'},
                { name: 'bidang_ilmu', type: 'text'},
                { name: 'bidang_ilmu3', type: 'text'},
                { name: 'lab', type: 'text'},
                { name: 'program_studi', type: 'text'},
                { name: 'sertifikasi', type: 'text'},
                { name: 'pend_akhir', type: 'text'},
                { name: 'ijasah_diakui', type: 'text'},
                { name: 'status_pegawai', type: 'text'},
                { name: 'masa_kerja', type: 'text'},
                { name: 'status_jabatan', type: 'text'},
                { name: 'karpeg', type: 'text'},
                { name: 'agama', type: 'text'},
                { name: 'alamat', type: 'text'},
                { name: 'no_hp', type: 'text'},
                { name: 'kode', type: 'text'},
                { name: 'foto', type: 'text'},
                { name: 'tmtgaji', type: 'text'},
                { name: 'tmtpangkat', type: 'text'},
                { name: 'ppabp', type: 'text'},
                { name: 'jabatan', type: 'text'},
                { name: 'proses_pangkat', type: 'text'},
                { name: 'angka_kredit', type: 'text'},
                { name: 'email_ub', type: 'text'},
                { name: 'email', type: 'text'},
                { name: 'lama_tubel', type: 'text'},
                { name: 'jenjanghomebase', type: 'text'},
                { name: 'tmt_tubel', type: 'text'},
                { name: 'tinggibdn', type: 'text'},
                { name: 'beratbdn', type: 'text'},
                { name: 'rambut', type: 'text'},
                { name: 'muka', type: 'text'},
                { name: 'warnakulit', type: 'text'},
                { name: 'cirikusus', type: 'text'},
                { name: 'cacattubuh', type: 'text'},
                { name: 'hobi', type: 'text'},
                { name: 'kelasjabatan', type: 'text'},
            ],
            type: 'POST',
            data: {_token: "{{ csrf_token() }}", val01:set05, val02:set04 },
            url : '{{ route("jgetallpegawai") }}'
        };
        var djsoninterviewer   = new $.jqx.dataAdapter(sourceinterviewer);
        var photorender = function (row, column, value) {
            var filebukti = $('#gridpelamar').jqxGrid('getrowdata', row).foto;
            var idpegawai = $('#gridpelamar').jqxGrid('getrowdata', row).id;
            if (filebukti != ''){
                var linkbukti = '<div style="background: white;" class="pull-right"><a href="viewbiodata/'+idpegawai+'" target="_blank"><img src="/images/pegawai/'+filebukti+'" height="40" width="40" /></a></div>';
            }
            else {
                var linkbukti = '<div style="background: white;"><a href="viewbiodata/'+idpegawai+'" target="_blank"><img src="mascot.png" height="40"  width="100%"/></a></div>';
            }
            return linkbukti;
        }
        $("#gridpelamar").jqxGrid({
            width               : '100%',
            showfilterrow       : true,
            rowsheight          : 40,
            autoheight          : true,
            filterable          : true,
            columnsresize       : true,
            autoshowfiltericon  : true,
            pageable            : true,
            source              : djsoninterviewer,
            theme               : "energyblue",
            selectionmode       : 'multiplecellsextended',
            columns             : [
                { text: 'Pilih', columntype: 'button', width: '8%', cellsalign: 'center', align: 'center', editable: false, sortable: false, filterable: false, cellsrenderer: function () { return "Pilih";
                    }, buttonclick: function (row) {
                        editrow         = row;	
                        var offset      = $("#gridpelamar").offset();
                        var dataRecord 	= $("#gridpelamar").jqxGrid('getrowdata', editrow);
                        var set01       = document.getElementById('keputusandirektur_jenis').value;
                        var jabatan     = dataRecord.jabatan;
                        if (jabatan == '' || jabatan == 'warga'){ var jabatan = dataRecord.jenjanghomebase; }
                        if (set01 == 'Penempatan Administrasi Pendaftaran'){
                            $(".masterjabatan").val('Administrasi Pendaftaran');
                        } else if (set01 == 'Penempatan Analis Kesehatan'){
                            $(".masterjabatan").val('Analis Kesehatan');
                        } else if (set01 == 'Penempatan Perawat'){
                            $(".masterjabatan").val('Perawat');
                        } else if (set01 == 'Penempatan Perekam Medik'){
                            $(".masterjabatan").val('Perekam Medik');
                        } else if (set01 == 'Penempatan Security'){
                            $(".masterjabatan").val('Security');
                        } else {
                            $(".masterjabatan").val(jabatan);
                        }
                        $("#keputusandirektur_id").val('new');
                        $("#keputusandirektur_idpeg").val(dataRecord.id);
                        $(".masterpend_akhir").val(dataRecord.pend_akhir);
                        $(".masterbidang_ilmu").val(dataRecord.bidang_ilmu);
                        $(".mastertgl_lahir").val(dataRecord.tgl_lahir);
                        $(".mastertmpt_lahir").val(dataRecord.tmpt_lahir);
                        $(".masterppabp").val(dataRecord.ppabp);
                        $(".masternip").val(dataRecord.nip_baru);
                        $(".masterunitkerja").val(dataRecord.unit_kerja);
                        $(".masternohape").val(dataRecord.no_hp);
                        $(".masteralamat").val(dataRecord.alamat);
                        $(".masternik").val(dataRecord.nik);
                        $(".mastercpns").val(dataRecord.cpns);
                        $(".mastertmt_jabatan").val(dataRecord.tmt_jabatan);
                        $(".mastertmt_pensiun").val(dataRecord.tmt_pensiun);
                        $(".masterstatus_jabatan").val(dataRecord.status_jabatan);
                        $(".masterkelamin").val(dataRecord.jenis_kelamin);
                        $(".masterjenispeg").val(dataRecord.jenispeg);
                        $("#kepdirmutasi_nama").val(dataRecord.nama_lengkap);
                        $("#kepdirpemberhentian_nama").val(dataRecord.nama_lengkap);
                        $("#kepdir_nama").val(dataRecord.nama_lengkap);
                        $("#kepdirpegtetap_nama").val(dataRecord.nama_lengkap);
                        $("#kepdir_email").val(dataRecord.email);
                        $("#kepdir_nip").val(dataRecord.nip_baru);
                        if (set01 == 'Penerimaan Staf'){
                            $('.divinputbtngroup').show();
                            $('.divisian').hide();
                            $('.divtabelsuratkeluar').hide();
                            $('.divtabelkeputusandirektur').hide();
                            $('.divkontrakkerja').hide();
                            $('.divcuti').hide();
                            $('#divisikeputusandirektur').show();
                        } else if (set01 == 'Pengangkatan Jabatan'){
                            $('.divinputbtngroup').show();
                            $('.divisian').hide();
                            $('.divtabelsuratkeluar').hide();
                            $('.divtabelkeputusandirektur').hide();
                            $('.divkontrakkerja').hide();
                            $('.divcuti').hide();
                            $('#divisikdpengangkatan').show();
                        } else if (set01 == 'Mutasi'){
                            $('.divinputbtngroup').show();
                            $('.divisian').hide();
                            $('.divtabelsuratkeluar').hide();
                            $('.divtabelkeputusandirektur').hide();
                            $('.divkontrakkerja').hide();
                            $('.divcuti').hide();
                            $('#divisikdmutasi').show();
                        } else if (set01 == 'Pemberhentian Jabatan'){
                            $('.divinputbtngroup').show();
                            $('.divisian').hide();
                            $('.divtabelsuratkeluar').hide();
                            $('.divtabelkeputusandirektur').hide();
                            $('.divkontrakkerja').hide();
                            $('.divcuti').hide();
                            $('#divisikdpemberhentianjabatan').show();
                        } else if (set01 == 'Penonaktifan Staf' || set01 == 'Pengaktifan Staf' || set01 == 'Penonaktifan Dokter Tetap' || set01 == 'Penempatan Administrasi Pendaftaran' || set01 == 'Penempatan Analis Kesehatan' || set01 == 'Penempatan Perawat' || set01 == 'Penempatan Perekam Medik' || set01 == 'Penempatan Security'){
                            $('.divinputbtngroup').show();
                            $('.divisian').hide();
                            $('.divtabelsuratkeluar').hide();
                            $('.divtabelkeputusandirektur').hide();
                            $('.divkontrakkerja').hide();
                            $('.divcuti').hide();
                            $('#divisikdaktivasi').show();
                            $("#kepdiraktivasi_nomor").val(data.nomorsk);
                            $("#kepdiraktivasi_nama").val(dataRecord.nama_lengkap);
                        } else if (set01 == 'Pegawai Tetap' || set01 == 'Dokter Tetap'){
                            $('.divinputbtngroup').show();
                            $('.divisian').hide();
                            $('.divtabelsuratkeluar').hide();
                            $('.divtabelkeputusandirektur').hide();
                            $('.divkontrakkerja').hide();
                            $('.divcuti').hide();
                            $('#divisikdpegawaitetap').show();
                        } else {
                            
                        }
                        $.post('{{ route("getvalpeg") }}', { val01: dataRecord.id, _token: '{{ csrf_token() }}' },function(data){
                            var statpencarian = data.statpencarian;
                            if (statpencarian == 'gagal'){
                                swal({
                                    title	: 'Stop',
                                    text	: 'ID '+dataRecord.id+' Tidak di Temukan',
                                    type	: 'warning',
                                })
                            } else {
                                $("#kepdir_nomor").val(data.nomorsk);
                                $("#kepdirangkat_nomor").val(data.nomorsk);
                                $("#kepdirmutasi_nomor").val(data.nomorsk);
                                $("#kepdirpemberhentian_nomor").val(data.nomorsk);
                                $("#kepdirpegtetap_nomor").val(data.nomorsk);
                            }
                        });
                    }
                },
                { text: 'Foto', width: '7%', cellsrenderer: photorender, editable: false, sortable: false, filterable: false },
                { text: 'Nama', datafield: 'nama_lengkap', width: '35%', align: 'center' },
                { text: 'Email', datafield: 'email', width: '25%', cellsalign: 'center', align: 'center' },
                { text: 'Alamat', datafield: 'alamat', width: '25%', cellsalign: 'left', align: 'center' },
            ],
        });
    }
    function openedpage( jQuery ){
        $("html, body").animate({ scrollTop: 0 }, "slow");
        var set01 		= document.getElementById('jenissurat').value;
        var set02 		= document.getElementById('kelompok').value;
        var set03 		= document.getElementById('petugas').value;
        $('.divisian').hide();
	    $('.divinputbtngroup').hide();
	    $('.divtabelsuratkeluar').hide();
	    $('.divtabelkeputusandirektur').hide();
        $('#loading').hide();
        $("#cuti_jenis").val(set01);
        $("#kontrak_jenis").val(set01);
        $("#keputusandirektur_jenis").val(set01);
        $('#sisikiri').show();
        $('#gridsuratkeluar').val();
        $('#gridsuratkeluar').val();
        $('.divsuratproses').show();
        $('.btnviewtambahstafmanual').hide();
        if (set01 == 'Cuti Tahunan' || set01 == 'Cuti Keagamaan'){
            $('.divcuti').show();
        }
        if (set01 == 'Referensi Kerja'){
            $('.divreferensikerja').show();
        }
        if (set01 == 'Keterangan Tidak Bekerja'){
            $('.divkettidakbekerja').show();
        }
        if (set01 == 'Keterangan Aktif Bekerja'){
            $('.divketbekerja').show();
        }
        if (set01 == 'Edaran'){
            $('.divedaran').show();
        }
        if (set01 == 'Balasan Penambahan Staf'){
            $('.divpenambahanstaf').show();
        }
        if (set01 == 'Peringatan'){
            $('.divperingatan').show();
        }
        if (set01 == 'Tugas'){
            $('.divtugas').show();
        }
        if (set01 == 'Permohonan'){
            $('.divpermohonan').show();
        }
        if (set01 == 'Tanggapan Resign'){
            $('.divtanggapanresign').show();
        }
        if (set01 == 'Pemberitahuan Mutasi'){
            $('.divpemberitahuanmutasi').show();
        }
        if (set01 == 'Pemberitahuan Sekretaris'){
            $('.divpermohonan').show();
        }
        if (set01 == 'Pemberitahuan Tidak Memperpanjang Kontrak'){
            $('.divpemberitahuantdkmemperpanjangkontrak').show();
        }
        if (set01 == 'Undangan'){
            $('.divundangan').show();
        }
        if (set01 == 'Pemanggilan KIE Staf'){
            $('.divpanggilankie').show();
        }
        if (set01 == 'SPO'){
            $('.divspo').show();
        }
        if (set01 == 'Perjanjian Orientasi Kerja' || set01 == 'PKWT' || set01 == 'PKWTT'){
            $('.divtabelsuratkeluar').show();
            $('.divkontrakkerja').show();
            var sumberpegawaikontrakonly = {
                datatype: "json",
                datafields: [
                    { name: 'id'},
                    { name: 'nama_lengkap', type: 'text'},
                    { name: 'unit_kerja', type: 'text'},
                    { name: 'ppabp', type: 'text'},
                    { name: 'tmt_pensiun', type: 'text'},
                ],
                updaterow: function (rowid, rowdata, commit) {commit(true);},
                type		: 'GET',
                data		: {	jenis:'kontrak', _token: '{{ csrf_token() }}' },
                url			: '{{ route("jstatpensiun") }}',
                root		: 'data',
                totalrecords: 'total',
                cache		: false,
                filter		: function () {
                    $("#gridpensiunonly").jqxGrid('updatebounddata', 'filter');
                },
                sort: function () {
                    $("#gridpensiunonly").jqxGrid('updatebounddata', 'sort');
                },
                beforeprocessing: function (data) {
                    if (data != null) {
                        sumberpegawaikontrakonly.totalrecords = data.total;
                    }
                }
            };
            var datajpensiun = new $.jqx.dataAdapter(sumberpegawaikontrakonly);
            $("#gridpensiunonly").jqxGrid({
                width			: '100%',
                sortable		: true,
                filterable		: true,
                columnsresize	: true,
                showfilterrow	: true,
                autoheight		: true,
                virtualmode		: true,
                pageable		: true,
                rendergridrows	: function(obj) {
                    return obj.data;
                },
                source			: datajpensiun,
                pagesizeoptions	: ['10', '20', '30'],
                theme			: "energyblue",
                altrows			: true,
                columns         : [
                    { text: 'Nama', datafield: 'nama_lengkap', width: '35%', cellsalign: 'left', align: 'center'  },
                    { text: 'Unit Kerja', filtertype: 'checkedlist', datafield: 'unit_kerja', width: '35%', cellsalign: 'left', align: 'center'  },
                    { text: 'Akhir Kontrak', datafield: 'tmt_pensiun', width: '30%', cellsalign: 'left', align: 'center'  },
                    { text: 'Penempatan', filtertype: 'checkedlist', datafield: 'ppabp', width: '35%', cellsalign: 'left', align: 'center'  },
                ],
            });
        }
        if (set02 == 'Suratkeluarnonomer' || set02 == 'Suratkeluar'){
            $('.divtabelsuratkeluar').show();
            var sumbersuratkeluar = {
                datatype: "json",
                datafields: [
                    { name: 'id'},
                    { name: 'marking', type: 'text'},
                    { name: 'nomor', type: 'text'},
                    { name: 'yersrt', type: 'text'},
                    { name: 'nomorasli', type: 'text'},
                    { name: 'anakno', type: 'text'},
                    { name: 'tlsnomor', type: 'text'},
                    { name: 'plaintglsurat', type: 'text'},
                    { name: 'kodefak', type: 'text'},
                    { name: 'unit', type: 'text'},
                    { name: 'tglsurat', type: 'text'},
                    { name: 'kepada', type: 'text'},
                    { name: 'alamat', type: 'text'},
                    { name: 'perihal', type: 'text'},
                    { name: 'plainperihal', type: 'text'},
                    { name: 'lampiran', type: 'text'},
                    { name: 'paraf1', type: 'text'},
                    { name: 'pejabat', type: 'text'},
                    { name: 'tembusan', type: 'text'},
                    { name: 'sifat', type: 'text'},
                    { name: 'tlssifat', type: 'text'},
                    { name: 'klasifikasi', type: 'text'},
                    { name: 'pembuat', type: 'text'},
                    { name: 'isisurat', type: 'text'},
                    { name: 'namapejabat', type: 'text'},
                    { name: 'idpejabat', type: 'text'},
                    { name: 'tembusan', type: 'text'},
                    { name: 'status', type: 'text'},
                    { name: 'footnote', type: 'text'},
                    { name: 'jenissrt', type: 'text'},
                    { name: 'selesai', type: 'text'},
                    { name: 'dsrsrt', type: 'text'},
                    { name: 'faskode', type: 'text'},
                    { name: 'tulisorg', type: 'text'},
                    { name: 'setval01', type: 'text'},
                    { name: 'setval02', type: 'text'},
                    { name: 'setval03', type: 'text'},
                    { name: 'setval04', type: 'text'},
                    { name: 'setval05', type: 'text'},
                    { name: 'setval06', type: 'text'},
                    { name: 'setval07', type: 'text'},
                    { name: 'setval08', type: 'text'},
                    { name: 'setval09', type: 'text'},
                    { name: 'setval10', type: 'text'},
                    { name: 'setval11', type: 'text'},
                    { name: 'setval12', type: 'text'},
                    { name: 'setval13', type: 'text'},
                    { name: 'setval14', type: 'text'},
                    { name: 'setval15', type: 'text'},
                    { name: 'setval16', type: 'text'},
                    { name: 'setval17', type: 'text'},
                    { name: 'setval18', type: 'text'},
                ],
                updaterow: function (rowid, rowdata, commit) {commit(true);},
                type		: 'GET',
                data		: {	jenissurat:set01, petugas:set03, kelompok:set02, tahun:"{{date('Y')}}", _token: '{{ csrf_token() }}' },
                url			: '{{ route("datapermohonanNomorPaged") }}',
                root		: 'data',
                totalrecords: 'total',
                cache		: false,
                filter		: function () {
                    $("#gridsuratkeluar").jqxGrid('updatebounddata', 'filter');
                },
                sort: function () {
                    $("#gridsuratkeluar").jqxGrid('updatebounddata', 'sort');
                },
                beforeprocessing: function (data) {
                    if (data != null) {
                        sumbersuratkeluar.totalrecords = data.total;
                    }
                }
            };
            var datajsrtkeluar = new $.jqx.dataAdapter(sumbersuratkeluar);
            var rendergridrows = $('#gridsuratkeluar').jqxGrid('rendergridrows');
            if (set01 == 'Perjanjian Orientasi Kerja' || set01 == 'PKWT' || set01 == 'PKWTT'){
                $("#gridsuratkeluar").jqxGrid({
                    width			: '100%',
                    filterable		: true,
                    columnsresize	: true,
                    showfilterrow	: true,
                    sortable		: true,
                    autoheight		: true,
                    virtualmode		: true,
                    pageable		: true,
                    rendergridrows	: function(obj) {
                        return obj.data;
                    },
                    source			: datajsrtkeluar,
                    pagesizeoptions	: ['10', '20', '30'],
                    theme			: "energyblue",
                    altrows			: true,
                    columns: [
                        { text: 'Edit', editable: false, sortable: false, filterable: false, columntype: 'button', width: 70, align: 'center', cellsrenderer: function () {
                            return "Edit";
                            }, buttonclick: function (row) {		
                                editrow = row;	
                                var offset 		= $("#gridsuratkeluar").offset();		
                                var dataRecord 	= $("#gridsuratkeluar").jqxGrid('getrowdata', editrow);
                                var jenispeg    = dataRecord.jenispegawai;
                                var jeniskontrak= dataRecord.kontrak;
                                var jenis       = jenispeg+' '+jeniskontrak;
                                $("#kontrak_pegawai").val(dataRecord.setval01).trigger('change');
                                $("#kontrak_ppabp").val(dataRecord.setval02);
                                $('#kontrak_alamatpenempatan').val(dataRecord.setval03);
                                $('#kontrak_unitkerja').val(dataRecord.setval04);
                                $("#kontrak_jabatan").val(dataRecord.setval05);
                                $("#kontrak_tmpt_lahir").val(dataRecord.setval06);
                                $("#kontrak_tgl_lahir").val(dataRecord.setval07);
                                $("#kontrak_str").val(dataRecord.setval08);
                                $("#kontrak_alamat").val(dataRecord.setval09);
                                $("#kontrak_nik").val(dataRecord.setval10);
                                $("#kontrak_kelamin").val(dataRecord.setval11);
                                $("#kontrak_lamanya").val(dataRecord.setval12);
                                $("#kontrak_satuan").val(dataRecord.setval13);
                                $("#kontrak_mulai").val(dataRecord.setval14);
                                $("#kontrak_akhir").val(dataRecord.setval15);
                                $("#kontrak_gaji").val(dataRecord.setval16);
                                $("#kontrak_tanggal").val(dataRecord.setval17);
                                $("#kontrak_jenis").val(dataRecord.setval18);
                                $("#kontrak_status_jabatan").val(dataRecord.setval19);
                                $("#kontrak_id").val(dataRecord.id);
                                $('.divisian').hide();
                                $('.divtabelsuratkeluar').hide();
                                $('#divisikontrakkerja').show();
                                $('.divinputbtngroup').show();
                                $('.divcuti').hide();
                                $('.divtabelkeputusandirektur').hide();
                            }
                        },
                        { text: '1. Preview', editable: false, sortable: false, filterable: false,columntype: 'button', width: 80, align: 'center', cellsrenderer: function () {
                            return "Preview";
                            }, buttonclick: function (row) {
                                editrow         = row;
                                var offset 		= $("#gridsuratkeluar").offset();
                                var dataRecord 	= $("#gridsuratkeluar").jqxGrid('getrowdata', editrow);
                                window.open("{{URL::to("/")}}/viewsurat/1b8a4d4791bd4b1b030db52b115e99b0-formc="+dataRecord.id, '_blank');
                            }
                        },
                        { text: '2. Proses Surat', editable: false, sortable: false, filterable: false,columntype: 'button', width: 120, align: 'center', cellsrenderer: function () {
                            return "Proses";
                            }, buttonclick: function (row) {
                                editrow         = row;
                                var offset 		= $("#gridsuratkeluar").offset();
                                var dataRecord 	= $("#gridsuratkeluar").jqxGrid('getrowdata', editrow);
                                var statuse 	= dataRecord.status;
                                $("#kirimkontrak_marking").val(dataRecord.id);
                                $("#kirimkontrak_jenis").val('kontrakfromsuratkeluar');
                                $("#kirimkontrak_pemeriksa").val(dataRecord.lampiran).select2().trigger('change');
                                $("#kirimkontrak_penandatangan").val(dataRecord.pejabat).select2().trigger('change');
                                $("#modalsettingpenandatangankontrak").modal('show');
                            }
                        },
                        { text: '3. Upload Surat', editable: false, sortable: false, filterable: false,columntype: 'button', width: 120, align: 'center', cellsrenderer: function () {
                            return "Ber e-Materai";
                            }, buttonclick: function (row) {
                                editrow         = row;
                                var offset 		= $("#gridsuratkeluar").offset();
                                var dataRecord 	= $("#gridsuratkeluar").jqxGrid('getrowdata', editrow);
                                var marking 	= dataRecord.marking;
                                if (marking == ''){
                                    swal({
                                        title	: 'Stop',
                                        text	: 'Pastikan Proses Penandatangan TTE sudah selesai',
                                        type	: 'warning',
                                    })
                                } else {
                                    $("#uploadmet_marking").val(dataRecord.marking);
                                    $("#uploadmet_file").val('');
                                    $("#modaluploadsuratmaterai").modal('show');
                                }
                            }
                        },
                        { text: 'Status', datafield: 'status', filtertype: 'checkedlist',  width: 100, cellsalign: 'left', align: 'center'  },
                        { text: 'Nama Pegawai', datafield: 'kepada', width: 200, cellsalign: 'left', align: 'center'  },
                        { text: 'Email Pegawai', datafield: 'alamat', width: 100, cellsalign: 'left', align: 'center'  },
                        { text: 'Unit Kerja', filtertype: 'checkedlist', datafield: 'setval02', width: 180, cellsalign: 'left', align: 'center'  },
                        { text: 'Alamat Unit Kerja', datafield: 'setval03', width: 200, cellsalign: 'left', align: 'center'  },
                        { text: 'Penempatan', datafield: 'setval04', width: 200, cellsalign: 'left', align: 'center'  },
                        { text: 'Jabatan', filtertype: 'checkedlist', datafield: 'setval05', width: 200, cellsalign: 'left', align: 'center'  },
                        { text: 'Tempat Lahir', datafield: 'setval06', width: 150, cellsalign: 'left', align: 'center'  },
                        { text: 'Tgl. Lahir', datafield: 'setval07', width: 100, cellsalign: 'left', align: 'center'  },
                        { text: 'STR', datafield: 'setval08', width: 150, cellsalign: 'left', align: 'center'  },
                        { text: 'Alamat Pegawai', datafield: 'setval09', width: 200, cellsalign: 'left', align: 'center'  },
                        { text: 'No.KTP', datafield: 'setval10', width: 120, cellsalign: 'left', align: 'center'  },
                        { text: 'Jenis Kelamin', filtertype: 'checkedlist', datafield: 'setval11', width: 120, cellsalign: 'left', align: 'center'  },
                        { text: 'Kontrak', filtertype: 'checkedlist', datafield: 'setval12', width: 120, cellsalign: 'left', align: 'center'  },
                        { text: 'Satuan', filtertype: 'checkedlist', datafield: 'setval13', width: 120, cellsalign: 'left', align: 'center'  },
                        { text: 'Mulai', datafield: 'setval14', width: 120, cellsalign: 'left', align: 'center'  },
                        { text: 'Akhir', datafield: 'setval15', width: 120, cellsalign: 'left', align: 'center'  },
                        { text: 'Honorarium', datafield: 'setval16', width: 120, cellsalign: 'left', align: 'center'  },
                        { text: 'Tgl. SP', datafield: 'setval17', width: 120, cellsalign: 'left', align: 'center'  },
                        { text: 'Jenis Kontrak', filtertype: 'checkedlist', datafield: 'setval18', width: 120, cellsalign: 'left', align: 'center'  },
                        { text: 'Uploader', datafield: 'pembuat', filtertype: 'checkedlist',  width: 150, cellsalign: 'left', align: 'center'  },
                        { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: 80, cellsrenderer: function () {
                            return "Del";
                            }, buttonclick: function (row) {
                                editrow = row;	
                                var offset 		= $("#gridsuratkeluar").offset();		
                                var dataRecord 	= $("#gridsuratkeluar").jqxGrid('getrowdata', editrow);
                                swal({
                                    title: 'Apakah anda yakin ?',
                                    text: "Surat ini Akan di Hapus, apakah anda yakin ?",
                                    type: 'warning',
                                    showCancelButton: true,
                                    confirmButtonClass: 'btn btn-confirm mt-2',
                                    cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                                    confirmButtonText: 'Yes'
                                }).then(function () {
                                    var set01		= dataRecord.id;
                                    var token   	= document.getElementById('token').value;		
                                    $.post('{{ route("hapussrtkeluar") }}', { val01: set01, val02: 'MANUAL', val03: 'KELUAR', _token: token },	
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
                                            $("#gridsuratkeluar").jqxGrid('updatebounddata');
                                            return false;
                                    });
                                });
                                
                            }
                        },
                    ]
                });
            } else if (set01 == 'SPO'){
                $("#gridsuratkeluar").jqxGrid({
                    width			: '100%',
                    filterable		: true,
                    columnsresize	: true,
                    showfilterrow	: true,
                    sortable		: true,
                    autoheight		: true,
                    virtualmode		: true,
                    pageable		: true,
                    rendergridrows	: function(obj) {
                        return obj.data;
                    },
                    source			: datajsrtkeluar,
                    pagesizeoptions	: ['10', '20', '30'],
                    theme			: "energyblue",
                    altrows			: true,
                    columns: [
                        { text: '1. Generate', editable: false, sortable: false, filterable: false,columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
                            return "QrCode";
                            }, buttonclick: function (row) {
                                editrow         = row;
                                var offset 		= $("#gridsuratkeluar").offset();
                                var dataRecord 	= $("#gridsuratkeluar").jqxGrid('getrowdata', editrow);
                                window.open("{{URL::to("/")}}/downloadqr/"+dataRecord.marking, "_blank");
                            }
                        },
                        { text: '2. Proses', editable: false, sortable: false, filterable: false,columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
                            return "Proses";
                            }, buttonclick: function (row) {
                                editrow         = row;
                                var offset 		= $("#gridsuratkeluar").offset();
                                var dataRecord 	= $("#gridsuratkeluar").jqxGrid('getrowdata', editrow);
                                var statuse 	= dataRecord.status;
                                $("#srtcustom_file").val('');
                                $("#srtcustom_marking").val(dataRecord.marking);
                                $("#srtcustom_jenis").val('KELUARNONOMER');
                                $("#srtcustom_pemeriksa").val(dataRecord.lampiran).select2().trigger('change');
                                $("#srtcustom_penandatangan").val(dataRecord.pejabat).select2().trigger('change');
                                $("#modaluploadsuratcustom").modal('show');
                            }
                        },
                        { text: 'Status', datafield: 'status', filtertype: 'checkedlist',  width: '15%', cellsalign: 'left', align: 'center'  },
                        { text: 'No. Dokumen', datafield: 'kepada', width: '10%', cellsalign: 'left', align: 'center'  },
                        { text: 'No. Revisi', datafield: 'alamat', width: '10%', cellsalign: 'left', align: 'center'  },
                        { text: 'Judul', datafield: 'perihal', width: '35%', cellsalign: 'left', align: 'center'  },
                        { text: 'Archive', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', cellsrenderer: function () {
                            return "Archive";
                            }, buttonclick: function (row) {
                                editrow = row;	
                                var offset 		= $("#gridsuratkeluar").offset();		
                                var dataRecord 	= $("#gridsuratkeluar").jqxGrid('getrowdata', editrow);
                                swal({
                                    title: 'Apakah anda yakin ?',
                                    text: "Surat ini Akan di Hapus apabila belum selesai. dan akan di arsipkan apabila telah ditandatangani (surat yang telah ditandatangani tidak bisa dihapus), apakah anda yakin ?",
                                    type: 'warning',
                                    showCancelButton: true,
                                    confirmButtonClass: 'btn btn-confirm mt-2',
                                    cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                                    confirmButtonText: 'Yes'
                                }).then(function () {
                                    var set01		= dataRecord.id;
                                    var token   	= document.getElementById('token').value;		
                                    $.post('{{ route("hapussrtkeluar") }}', { val01: set01, val02: 'TTE', val03: 'KELUARNONOMER', _token: token }, function(data){
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
                                        $("#gridsuratkeluar").jqxGrid('updatebounddata');
                                        return false;
                                    });
                                });
                                
                            }
                        },
                    ]
                });
            } else if (set01 == 'Pemanggilan KIE Staf') {
                $("#gridsuratkeluar").jqxGrid({
                    width			: '100%',
                    filterable		: true,
                    columnsresize	: true,
                    showfilterrow	: true,
                    sortable		: true,
                    autoheight		: true,
                    autorowheight	: true,
                    virtualmode		: true,
                    pageable		: true,
                    rendergridrows	: function(obj) {
                        return obj.data;
                    },
                    source			: datajsrtkeluar,
                    pagesizeoptions	: ['10', '20', '30'],
                    theme			: "energyblue",
                    altrows			: true,
                    columns			: [
                        { text: 'Edit', editable: false, sortable: false, filterable: false, columntype: 'button', width: 70, align: 'center', cellsrenderer: function () {
                            return "Edit";
                            }, buttonclick: function (row) {		
                                editrow = row;	
                                var offset 		= $("#gridsuratkeluar").offset();		
                                var dataRecord 	= $("#gridsuratkeluar").jqxGrid('getrowdata', editrow);
                                $('#panggilankie_idne').val(dataRecord.id);
                                $('#panggilankie_nama').val(dataRecord.setval01);
                                $("#panggilankie_mulai").val(dataRecord.setval02);
                                $("#panggilankie_waktu").val(dataRecord.setval03);
                                $("#panggilankie_tempat").val(dataRecord.setval04);
                                $("#panggilankie_hasil").val(dataRecord.setval05);
                                $("#panggilankie_pemeriksa").val(dataRecord.paraf1);
                                $("#panggilankie_penandatangan").val(dataRecord.pejabat);
                            }
                        },
                        { text: 'TTE Pegawai', editable: false, sortable: false, filterable: false,columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
                            return "Open";
                            }, buttonclick: function (row) {
                                editrow         = row;
                                var offset 		= $("#gridsuratkeluar").offset();
                                var dataRecord 	= $("#gridsuratkeluar").jqxGrid('getrowdata', editrow);
                                window.open("{{URL::to("/")}}/ttdberkas/keluar-"+dataRecord.id, "_blank");
                            }
                        },
                        { text: 'Nomor', datafield: 'tlsnomor', width: '6%', cellsalign: 'center', align: 'center'},
                        { text: 'Tanggal', datafield: 'tglsurat', width: '14%', cellsalign: 'center', align: 'center'  },
                        { text: 'Perihal', datafield: 'perihal', width: '25%', cellsalign: 'left', align: 'center'  },
                        { text: 'Pemohon', datafield: 'tulisorg', width: '20%', cellsalign: 'left', align: 'center'  },
                        { text: 'Keterangan', datafield: 'status', width: '20%', cellsalign: 'left', align: 'center'  },
                        { text: 'Archieved', editable: false, sortable: false, filterable: false, columntype: 'button', width: '9%', align: 'center', cellsrenderer: function () {
                            return "Archieve";
                            }, buttonclick: function (row) {
                                editrow = row;
                                var offset 		= $("#gridsuratkeluar").offset();
                                var dataRecord 	= $("#gridsuratkeluar").jqxGrid('getrowdata', editrow);
                                swal({
                                    title: 'Apakah Anda Yakin.?',
                                    text: "Surat yang belum di TTE akan di hapus, dan bila sudah di TTE akan masuk dalam Arsip. Apakah Anda Yakin.?",
                                    type: 'warning',
                                    showCancelButton: true,
                                    confirmButtonClass: 'btn btn-confirm mt-2',
                                    cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                                    confirmButtonText: 'Yes.!'
                                }).then(function () {
                                    var set01		= dataRecord.id;
                                    $.post('{{ route("hapussrtkeluar") }}', { val01: dataRecord.id, val02: 'TTE', val03: 'KELUAR', _token: '{{ csrf_token() }}' }, function(data){					
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
                                        $("#gridsuratkeluar").jqxGrid('updatebounddata', 'filter');
                                        return false;
                                    });
                                });
                            }
                        },
                    ],
                });
            } else {
                $("#gridsuratkeluar").jqxGrid({
                    width			: '100%',
                    filterable		: true,
                    columnsresize	: true,
                    showfilterrow	: true,
                    sortable		: true,
                    autoheight		: true,
                    autorowheight	: true,
                    virtualmode		: true,
                    pageable		: true,
                    rendergridrows	: function(obj) {
                        return obj.data;
                    },
                    source			: datajsrtkeluar,
                    pagesizeoptions	: ['10', '20', '30'],
                    theme			: "energyblue",
                    altrows			: true,
                    columns			: [
                        { text: 'Send', editable: false, sortable: false, filterable: false, columntype: 'button', width: '6%', cellsrenderer: function () {
                            return "Send";
                            }, buttonclick: function (row) {		
                                editrow = row;	
                                var offset 		= $("#gridsuratkeluar").offset();		
                                var dataRecord 	= $("#gridsuratkeluar").jqxGrid('getrowdata', editrow);
                                $("#kirim_id").val(dataRecord.id);
                                $("#kirim_nomor").val(dataRecord.nomor);
                                $("#kirim_perihal").val(dataRecord.plainperihal);
                                $("#kirim_kegiatan").val(dataRecord.plainperihal);
                                $("#kirim_tglmulai").val(dataRecord.plaintglsurat);
                                $("#kirim_tglselesai").val(dataRecord.plaintglsurat);
                                $("#kirim_email").val(dataRecord.alamat).select2().trigger('change');
                                $("#kirim_idpeserta").val('');
                                
                                $("#kirim_kelompok").val('KELUAR');
                                CKEDITOR.instances['kirim_keterangan'].setData('')
                                $('#divmainmenu').hide();
                                $('#formsurat').hide();
                                $('#formsuratmodelsk').hide();
                                $('#formsuratmodelsp').hide();
                                $('#divtambahpenerima').show();
                                $('#divsuratkeluar').hide();
                                var sourcedetail = {
                                    datatype: "json",
                                    datafields: [
                                        { name: 'idne',type: 'text'},
                                        { name: 'idsurat',type: 'text'},
                                        { name: 'pejabat',type: 'text'},
                                        { name: 'jabatan',type: 'text'},
                                        { name: 'fakultas',type: 'text'},
                                        { name: 'status',type: 'text'},
                                        { name: 'keterangan',type: 'text'},
                                    ],
                                    type: 'POST',
                                    data: {	val01:dataRecord.id, val02:'KELUAR', val03:'',  _token: '{{ csrf_token() }}' },
                                    url: '{{ route("detailpenerimasurat") }}',
                                };
                                var datadetail = new $.jqx.dataAdapter(sourcedetail);
                                $("#griddetail").jqxGrid({
                                    width			: '100%',
                                    filterable		: true,
                                    columnsresize	: true,
                                    filtermode		: 'excel',
                                    theme			: "orange",
                                    sortable		: true,
                                    autoheight		: true,
                                    source			: datadetail,
                                    selectionmode	: 'multiplecellsextended',
                                    columns			: [
                                        { text: 'Nama Pejabat Penerima', datafield: 'pejabat', width: '30%', cellsalign: 'left', align: 'center' },
                                        { text: 'Jabatan', datafield: 'jabatan', width: '20%', cellsalign: 'left', align: 'center' },
                                        { text: 'Unit', datafield: 'fakultas', width: '20%', cellsalign: 'left', align: 'center' },
                                        { text: 'Keterangan', datafield: 'keterangan', width: '20%', cellsalign: 'left', align: 'center' },
                                        { text: 'Hapus', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
                                            return "Hapus";
                                            }, buttonclick: function (row) {
                                                editrow = row;
                                                var offset 		= $("#griddetail").offset();
                                                var dataRecord 	= $("#griddetail").jqxGrid('getrowdata', editrow);
                                                swal({
                                                    title: 'Apakah Anda Yakin.?',
                                                    text: "Arsip yang telah dihapus tidak bisa di recovery. Apakah Anda Yakin.?",
                                                    type: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonClass: 'btn btn-confirm mt-2',
                                                    cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                                                    confirmButtonText: 'Yes, Delete It.!'
                                                }).then(function () {
                                                    $.post('{{ route("extbhpenerimasurat") }}', { set01: dataRecord.idne, set02: 'HAPUS', set03: 'SAYA YAKIN', _token: '{{ csrf_token() }}' }, function(data){					
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
                                                        $("#griddetail").jqxGrid('updatebounddata', 'filter');
                                                        return false;
                                                    });
                                                });
                                            }
                                        },
                                    ],
                                });
                            }
                        },
                        { text: 'Nomor', datafield: 'tlsnomor', width: '6%', cellsalign: 'center', align: 'center'},
                        { text: 'Tanggal', datafield: 'tglsurat', width: '14%', cellsalign: 'center', align: 'center'  },
                        { text: 'Perihal', datafield: 'perihal', width: '25%', cellsalign: 'left', align: 'center'  },
                        { text: 'Pemohon', datafield: 'tulisorg', width: '20%', cellsalign: 'left', align: 'center'  },
                        { text: 'Keterangan', datafield: 'status', width: '20%', cellsalign: 'left', align: 'center'  },
                        { text: 'Archieved', editable: false, sortable: false, filterable: false, columntype: 'button', width: '9%', align: 'center', cellsrenderer: function () {
                            return "Archieve";
                            }, buttonclick: function (row) {
                                editrow = row;
                                var offset 		= $("#gridsuratkeluar").offset();
                                var dataRecord 	= $("#gridsuratkeluar").jqxGrid('getrowdata', editrow);
                                swal({
                                    title: 'Apakah Anda Yakin.?',
                                    text: "Surat yang belum di TTE akan di hapus, dan bila sudah di TTE akan masuk dalam Arsip. Apakah Anda Yakin.?",
                                    type: 'warning',
                                    showCancelButton: true,
                                    confirmButtonClass: 'btn btn-confirm mt-2',
                                    cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                                    confirmButtonText: 'Yes.!'
                                }).then(function () {
                                    var set01		= dataRecord.id;
                                    $.post('{{ route("hapussrtkeluar") }}', { val01: dataRecord.id, val02: 'TTE', val03: 'KELUAR', _token: '{{ csrf_token() }}' }, function(data){					
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
                                        $("#gridsuratkeluar").jqxGrid('updatebounddata', 'filter');
                                        return false;
                                    });
                                });
                            }
                        },
                    ],
                });
            }
        }
        if (set01 == 'Pegawai Tetap' || set01 == 'Pengangkatan Jabatan' || set01 == 'Pemberhentian Jabatan' || set01 == 'Dokter Tetap' || set01 == 'Penerimaan Staf' || set01 == 'Penonaktifan Staf' || set01 == 'Pengaktifan Staf' || set01 == 'Mutasi' || set01 == 'Penonaktifan Dokter Tetap' || set01 == 'Pemutusan Hubungan Kerja' || set01 == 'Penempatan Administrasi Pendaftaran' || set01 == 'Penempatan Analis Kesehatan' || set01 == 'Penempatan Perawat' || set01 == 'Penempatan Perekam Medik' || set01 == 'Penempatan Security'){
            $('.divkeputusandirektur').show();
            $('.divtabelkeputusandirektur').show();
            var sumbersuratkeluar = {
                datatype: "json",
                datafields: [
                    { name: 'id'},
					{ name: 'kelompok', type: 'text'},
					{ name: 'marking', type: 'text'},
					{ name: 'nomor', type: 'text'},
					{ name: 'tahun', type: 'text'},
					{ name: 'tanggal', type: 'text'},
					{ name: 'penandatangan', type: 'text'},
					{ name: 'idpejabat', type: 'text'},
					{ name: 'nmpejabat', type: 'text'},
					{ name: 'nippejabat', type: 'text'},
					{ name: 'pjbtperundang', type: 'text'},
					{ name: 'idpjbperundang', type: 'text'},
					{ name: 'nmpjbtperundang', type: 'text'},
					{ name: 'nippjbperundang', type: 'text'},
					{ name: 'tglpjbperundang', type: 'text'},
					{ name: 'judul', type: 'text'},
					{ name: 'scansurat', type: 'text'},
                    { name: 'uraian1', type: 'text'},
                    { name: 'uraian2', type: 'text'},
                    { name: 'uraian3', type: 'text'},
					{ name: 'dasarsurat', type: 'text'},
					{ name: 'dasarsuratno', type: 'text'},
					{ name: 'dasarsuratyy', type: 'text'},
					{ name: 'kodefas', type: 'text'},
					{ name: 'kodesub', type: 'text'},
					{ name: 'paraf1', type: 'text'},
					{ name: 'paraf2', type: 'text'},
					{ name: 'paraf3', type: 'text'},
					{ name: 'paraf4', type: 'text'},
					{ name: 'catatan', type: 'text'},
					{ name: 'inputor', type: 'text'},
					{ name: 'status', type: 'text'},
					{ name: 'tlsnomor', type: 'text'},
					{ name: 'tlstanggal', type: 'text'},
					{ name: 'tlsjudul', type: 'text'},
					{ name: 'tlskelompok', type: 'text'},
                    { name: 'setval01', type: 'text'},
                    { name: 'setval02', type: 'text'},
                    { name: 'setval03', type: 'text'},
                    { name: 'setval04', type: 'text'},
                    { name: 'setval05', type: 'text'},
                    { name: 'setval06', type: 'text'},
                    { name: 'setval07', type: 'text'},
                    { name: 'setval08', type: 'text'},
                    { name: 'setval09', type: 'text'},
                    { name: 'setval10', type: 'text'},
                    { name: 'setval11', type: 'text'},
                    { name: 'setval12', type: 'text'},
                    { name: 'setval13', type: 'text'},
                    { name: 'setval14', type: 'text'},
                    { name: 'setval15', type: 'text'},
                    { name: 'setval16', type: 'text'},
                    { name: 'setval17', type: 'text'},
                    { name: 'setval18', type: 'text'},
                ],
                updaterow: function (rowid, rowdata, commit) {commit(true);},
                type		: 'POST',
                data		: {	jenissurat:set01, petugas:set03, kelompok:set02, tahun:"{{date('Y')}}", _token: '{{ csrf_token() }}' },
                url			: '{{ route("getskdanperaturan") }}',
                root		: 'data',
                totalrecords: 'total',
                cache		: false,
                filter		: function () {
                    $("#gridskeputusandirektur").jqxGrid('updatebounddata', 'filter');
                },
                sort: function () {
                    $("#gridskeputusandirektur").jqxGrid('updatebounddata', 'sort');
                },
                beforeprocessing: function (data) {
                    if (data != null) {
                        sumbersuratkeluar.totalrecords = data.total;
                    }
                }
            };
            var datajskeputusan = new $.jqx.dataAdapter(sumbersuratkeluar);
            var rendergridrows  = $('#gridskeputusandirektur').jqxGrid('rendergridrows');
            if (set01 == 'Penerimaan Staf'){
                $('.btnviewtambahstafmanual').show();
                $("#gridskeputusandirektur").jqxGrid({
                    width			: '100%',
                    filterable		: true,
                    columnsresize	: true,
                    showfilterrow	: true,
                    sortable		: true,
                    autoheight		: true,
                    virtualmode		: true,
                    pageable		: true,
                    rendergridrows	: function(obj) {
                        return obj.data;
                    },
                    source			: datajskeputusan,
                    pagesizeoptions	: ['10', '20', '30'],
                    theme			: "energyblue",
                    altrows			: true,
                    columns			: [
                        { text: 'Edit/Replace', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', cellsrenderer: function () {
                            return "Edit";
                            }, buttonclick: function (row) {
                                editrow 		= row;
                                var offset 		= $("#gridskeputusandirektur").offset();
                                var dataRecord 	= $("#gridskeputusandirektur").jqxGrid('getrowdata', editrow);
                                $('.divinputbtngroup').show();
                                $('.divisian').hide();
                                $('.divtabelsuratkeluar').hide();
                                $('.divtabelkeputusandirektur').hide();
                                $('.divkontrakkerja').hide();
                                $('.divcuti').hide();
                                $('#divisikeputusandirektur').show();
                                $("#kepdir_nomor").val(dataRecord.nomor);
                                $("#kepdir_nama").val(dataRecord.setval01);
                                $("#kepdir_nip").val(dataRecord.setval19);
                                $("#kepdir_email").val(dataRecord.setval20);
                                $("#kepdir_ppabp").val(dataRecord.setval02);
                                $('#kepdir_tmpt_lahir').val(dataRecord.setval03);
                                $('#kepdir_tgl_lahir').val(dataRecord.setval04);
                                $("#kepdir_kelamin").val(dataRecord.setval05);
                                $("#kepdir_nik").val(dataRecord.setval06);
                                $("#kepdir_nomor").val(dataRecord.setval07);
                                $("#kepdir_tmt_golongan").val(dataRecord.setval08);
                                $("#kepdir_tmt_fungsional").val(dataRecord.setval09);
                                $("#kepdir_pemeriksa").val(dataRecord.setval10);
                                $("#kepdir_penandatangan").val(dataRecord.setval11);
                                $("#kepdir_jenispeg").val(dataRecord.setval13);
                                $("#kepdir_jabatan").val(dataRecord.setval14);
                                $("#kepdir_pend_akhir").val(dataRecord.setval15);
                                $("#kepdir_bidang_ilmu").val(dataRecord.setval16);
                                $("#kepdir_unitkerja").val(dataRecord.setval17);
                                CKEDITOR.instances['kepdir_uraiantugas'].setData(dataRecord.setval18)
                                CKEDITOR.instances['kepdir_uraiantugas2'].setData(dataRecord.uraian2)
                                CKEDITOR.instances['kepdir_uraiantugas3'].setData(dataRecord.uraian3)
                                $("#keputusandirektur_jenis").val(dataRecord.kelompok);
                                $("#keputusandirektur_id").val(dataRecord.id);
                            }
                        },
                        { text: '1. Preview', editable: false, sortable: false, filterable: false,columntype: 'button', width: 80, align: 'center', cellsrenderer: function () {
                            return "Preview";
                            }, buttonclick: function (row) {
                                editrow         = row;
                                var offset 		= $("#gridskeputusandirektur").offset();
                                var dataRecord 	= $("#gridskeputusandirektur").jqxGrid('getrowdata', editrow);
                                window.open("{{URL::to("/")}}/viewsurat/1b8a4d4791bd4b1b030db52b115e99b0-formb="+dataRecord.id, '_blank');
                            }
                        },
                        { text: '2. Proses Surat', editable: false, sortable: false, filterable: false,columntype: 'button', width: 120, align: 'center', cellsrenderer: function () {
                            return "Proses";
                            }, buttonclick: function (row) {
                                editrow         = row;
                                var offset 		= $("#gridskeputusandirektur").offset();
                                var dataRecord 	= $("#gridskeputusandirektur").jqxGrid('getrowdata', editrow);
                                var statuse 	= dataRecord.status;
                                $("#kirimkontrak_marking").val(dataRecord.id);
                                $("#kirimkontrak_jenis").val('skeputusandirektur');
                                $("#kirimkontrak_pemeriksa").val(dataRecord.paraf1).select2().trigger('change');
                                $("#kirimkontrak_penandatangan").val(dataRecord.penandatangan).select2().trigger('change');
                                $("#modalsettingpenandatangankontrak").modal('show');
                            }
                        },
                        { text: 'Kelompok', datafield: 'tlskelompok', width: '10%', cellsalign: 'center', align: 'center'},
                        { text: 'Nomor', datafield: 'tlsnomor', width: '10%', cellsalign: 'center', align: 'center'},
                        { text: 'Tanggal', datafield: 'tlstanggal', width: '10%', cellsalign: 'center', align: 'center'  },
                        { text: 'SK Tentang', datafield: 'tlsjudul', width: '25%', cellsalign: 'left', align: 'center'  },
                        { text: 'Keterangan', datafield: 'status', width: '25%', cellsalign: 'left', align: 'center'  },
                        { text: 'Archieve', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', align: 'center', cellsrenderer: function () {
                            return "Archieve";
                            }, buttonclick: function (row) {
                                editrow = row;
                                var offset 		= $("#gridskeputusandirektur").offset();
                                var dataRecord 	= $("#gridskeputusandirektur").jqxGrid('getrowdata', editrow);
                                swal({
                                    title: 'Apakah Anda Yakin.?',
                                    text: "Arsip yang telah dihapus tidak bisa di recovery. Apakah Anda Yakin.?",
                                    type: 'warning',
                                    showCancelButton: true,
                                    confirmButtonClass: 'btn btn-confirm mt-2',
                                    cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                                    confirmButtonText: 'Yes, Delete It.!'
                                }).then(function () {
                                    var set01		= dataRecord.id;
                                    $.post('{{ route("hapussrtkeluar") }}', { val01: dataRecord.id, val02: 'TTE', val03: 'SKDANPERATURAN', _token: '{{ csrf_token() }}' }, function(data){					
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
                                        $("#gridskdaperaturan").jqxGrid('updatebounddata', 'filter');
                                        return false;
                                    });
                                });
                            }
                        },
                    ],
                });
            } else {
                $('.btnviewtambahstafmanual').hide();
                $("#gridskeputusandirektur").jqxGrid({
                    width			: '100%',
                    filterable		: true,
                    columnsresize	: true,
                    showfilterrow	: true,
                    sortable		: true,
                    autoheight		: true,
                    virtualmode		: true,
                    pageable		: true,
                    rendergridrows	: function(obj) {
                        return obj.data;
                    },
                    source			: datajskeputusan,
                    pagesizeoptions	: ['10', '20', '30'],
                    theme			: "energyblue",
                    altrows			: true,
                    columns			: [
                        { text: 'Edit/Replace', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', cellsrenderer: function () {
                            return "Edit";
                            }, buttonclick: function (row) {
                                editrow 		= row;
                                var offset 		= $("#gridskeputusandirektur").offset();
                                var dataRecord 	= $("#gridskeputusandirektur").jqxGrid('getrowdata', editrow);
                                $('.divinputbtngroup').show();
                                $('.divisian').hide();
                                $('.divtabelsuratkeluar').hide();
                                $('.divtabelkeputusandirektur').hide();
                                $('.divkontrakkerja').hide();
                                $('.divcuti').hide();
                                $("#keputusandirektur_id").val(dataRecord.id);
                                if (set01 == 'Mutasi'){
                                    $('#divisikdmutasi').show();
                                    $("#kepdirmutasi_nama").val(dataRecord.setval01);
                                    $("#kepdirmutasi_jabatan").val(dataRecord.setval02);
                                    $("#kepdirmutasi_ppabp").val(dataRecord.setval03);
                                    $("#kepdirmutasi_ppabptujuan").val(dataRecord.setval04);
                                    $('#kepdirmutasi_nomor').val(dataRecord.setval05);
                                    $('#kepdirmutasi_tmt').val(dataRecord.setval06);
                                    $("#kepdirmutasi_tanggal").val(dataRecord.setval07);
                                    $("#keputusandirektur_idpeg").val(dataRecord.setval08);
                                    $("#keputusandirektur_jenis").val(dataRecord.kelompok);
                                } else if (set01 == 'Pemberhentian Jabatan'){
                                    $('#divisikdpemberhentianjabatan').show();
                                    $("#kepdirpemberhentian_nama").val(dataRecord.setval01);
                                    $("#kepdirpemberhentian_jabatan").val(dataRecord.setval02);
                                    $("#kepdirpemberhentian_ppabp").val(dataRecord.setval03);
                                    $('#kepdirpemberhentian_nomor').val(dataRecord.setval04);
                                    $('#kepdirpemberhentian_tmt').val(dataRecord.setval05);
                                    $("#kepdirpemberhentian_tanggal").val(dataRecord.setval06);
                                    $("#keputusandirektur_idpeg").val(dataRecord.setval07);
                                    $("#keputusandirektur_jenis").val(dataRecord.kelompok);
                                } else if (set01 == 'Penonaktifan Staf' || set01 == 'Pengaktifan Staf' || set01 == 'Penonaktifan Dokter Tetap' || set01 == 'Penempatan Administrasi Pendaftaran' || set01 == 'Penempatan Analis Kesehatan' || set01 == 'Penempatan Perawat' || set01 == 'Penempatan Perekam Medik' || set01 == 'Penempatan Security'){
                                    $('.divinputbtngroup').show();
                                    $('.divisian').hide();
                                    $('.divtabelsuratkeluar').hide();
                                    $('.divtabelkeputusandirektur').hide();
                                    $('.divkontrakkerja').hide();
                                    $('.divcuti').hide();
                                    $('#divisikdaktivasi').show();
                                    $("#kepdiraktivasi_nomor").val(data.nomorsk);
                                    $("#kepdiraktivasi_nama").val(dataRecord.nama);
                                } else if (set01 == 'Pegawai Tetap' || set01  == 'Dokter Tetap'){
                                    $('#divisikdpegawaitetap').show();
                                    $("#kepdirpegtetap_nama").val(dataRecord.setval01);
                                    $("#kepdirpegtetap_jabatan").val(dataRecord.setval02);
                                    $("#kepdirpegtetap_ppabp").val(dataRecord.setval03);
                                    $('#kepdirpegtetap_nomor').val(dataRecord.setval04);
                                    $('#kepdirpegtetap_tmt').val(dataRecord.setval05);
                                    $("#kepdirpegtetap_tanggal").val(dataRecord.setval06);
                                    $("#keputusandirektur_idpeg").val(dataRecord.setval07);
                                    $("#keputusandirektur_jenis").val(dataRecord.kelompok);
                                } else {
                                    $('#divisikdpengangkatan').show();
                                    $("#kepdirangkat_nama").val(dataRecord.setval01);
                                    $("#kepdirangkat_jabatan").val(dataRecord.setval02);
                                    $("#kepdirangkat_ppabp").val(dataRecord.setval03);
                                    $("#kepdirangkat_sifat").val(dataRecord.setval04);
                                    $('#kepdirangkat_nomor').val(dataRecord.setval05);
                                    $('#kepdirangkat_tmt').val(dataRecord.setval06);
                                    $("#kepdirangkat_mulai").val(dataRecord.setval07);
                                    $("#kepdirangkat_akhir").val(dataRecord.setval08);
                                    $("#kepdirangkat_tanggal").val(dataRecord.setval09);
                                    CKEDITOR.instances['kepdirangkat_uraiantugas'].setData(dataRecord.setval12)
                                    $("#keputusandirektur_idpeg").val(dataRecord.setval10);
                                    $("#keputusandirektur_jenis").val(dataRecord.kelompok);
                                }
                            }
                        },
                        { text: 'Send', editable: false, sortable: false, filterable: false, columntype: 'button', width: '6%', cellsrenderer: function () {
                            return "Send";
                            }, buttonclick: function (row) {
                                editrow         = row;
                                var offset 		= $("#gridskeputusandirektur").offset();
                                var dataRecord 	= $("#gridskeputusandirektur").jqxGrid('getrowdata', editrow);
                                $("#kirim_id").val(dataRecord.id);
                                $("#kirim_nomor").val(dataRecord.nomor);
                                $("#kirim_perihal").val(dataRecord.judul);
                                $("#kirim_kegiatan").val('');
                                $("#kirim_tglmulai").val('');
                                $("#kirim_tglselesai").val('');
                                $("#kirim_email").val(dataRecord.sparaf4).select2().trigger('change');
                                $("#kirim_idpeserta").val('');
                                $("#kirim_kelompok").val('SKDANPERATURAN');
                                CKEDITOR.instances['kirim_keterangan'].setData('')
                                $('#divmainmenu').hide();
                                $('#formsurat').hide();
                                $('#formsuratmodelsk').hide();
                                $('#formsuratmodelsp').hide();
                                $('#divtambahpenerima').show();
                                $('#divisikdpengangkatan').hide();
                                var sourcedetail = {
                                    datatype: "json",
                                    datafields: [
                                        { name: 'idne',type: 'text'},
                                        { name: 'idsurat',type: 'text'},
                                        { name: 'pejabat',type: 'text'},
                                        { name: 'jabatan',type: 'text'},
                                        { name: 'fakultas',type: 'text'},
                                        { name: 'status',type: 'text'},
                                        { name: 'keterangan',type: 'text'},
                                    ],
                                    type: 'POST',
                                    data: {	val01:dataRecord.id, val02:'SKDANPERATURAN', val03:'',  _token: '{{ csrf_token() }}' },
                                    url: '{{ route("detailpenerimasurat") }}',
                                };
                                var datadetail = new $.jqx.dataAdapter(sourcedetail);
                                $("#griddetail").jqxGrid({
                                    width			: '100%',
                                    filterable		: true,
                                    columnsresize	: true,
                                    filtermode		: 'excel',
                                    theme			: "orange",
                                    sortable		: true,
                                    autoheight		: true,
                                    source			: datadetail,
                                    selectionmode	: 'multiplecellsextended',
                                    columns			: [
                                        { text: 'Nama Pejabat Penerima', datafield: 'pejabat', width: '30%', cellsalign: 'left', align: 'center' },
                                        { text: 'Jabatan', datafield: 'jabatan', width: '20%', cellsalign: 'left', align: 'center' },
                                        { text: 'Email', datafield: 'fakultas', width: '20%', cellsalign: 'left', align: 'center' },
                                        { text: 'Keterangan', datafield: 'keterangan', width: '20%', cellsalign: 'left', align: 'center' },
                                        { text: 'Hapus', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
                                            return "Hapus";
                                            }, buttonclick: function (row) {
                                                editrow = row;
                                                var offset 		= $("#griddetail").offset();
                                                var dataRecord 	= $("#griddetail").jqxGrid('getrowdata', editrow);
                                                swal({
                                                    title: 'Apakah Anda Yakin.?',
                                                    text: "Arsip yang telah dihapus tidak bisa di recovery. Apakah Anda Yakin.?",
                                                    type: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonClass: 'btn btn-confirm mt-2',
                                                    cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                                                    confirmButtonText: 'Yes, Delete It.!'
                                                }).then(function () {
                                                    $.post('{{ route("extbhpenerimasurat") }}', { set01: dataRecord.idne, set02: 'HAPUS', set03: 'SAYA YAKIN', _token: '{{ csrf_token() }}' }, function(data){					
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
                                                        $("#griddetail").jqxGrid('updatebounddata', 'filter');
                                                        return false;
                                                    });
                                                });
                                            }
                                        },
                                    ],
                                });
                            }
                        },
                        { text: 'Kelompok', datafield: 'tlskelompok', width: '10%', cellsalign: 'center', align: 'center'},
                        { text: 'Nomor', datafield: 'tlsnomor', width: '10%', cellsalign: 'center', align: 'center'},
                        { text: 'Tanggal', datafield: 'tlstanggal', width: '10%', cellsalign: 'center', align: 'center'  },
                        { text: 'SK Tentang', datafield: 'tlsjudul', width: '25%', cellsalign: 'left', align: 'center'  },
                        { text: 'Keterangan', datafield: 'status', width: '25%', cellsalign: 'left', align: 'center'  },
                        { text: 'Archieve', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', align: 'center', cellsrenderer: function () {
                            return "Archieve";
                            }, buttonclick: function (row) {
                                editrow = row;
                                var offset 		= $("#gridskeputusandirektur").offset();
                                var dataRecord 	= $("#gridskeputusandirektur").jqxGrid('getrowdata', editrow);
                                swal({
                                    title: 'Apakah Anda Yakin.?',
                                    text: "Arsip yang telah dihapus tidak bisa di recovery. Apakah Anda Yakin.?",
                                    type: 'warning',
                                    showCancelButton: true,
                                    confirmButtonClass: 'btn btn-confirm mt-2',
                                    cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                                    confirmButtonText: 'Yes, Delete It.!'
                                }).then(function () {
                                    var set01		= dataRecord.id;
                                    $.post('{{ route("hapussrtkeluar") }}', { val01: dataRecord.id, val02: 'TTE', val03: 'SKDANPERATURAN', _token: '{{ csrf_token() }}' }, function(data){					
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
                                        $("#gridskeputusandirektur").jqxGrid('updatebounddata', 'filter');
                                        return false;
                                    });
                                });
                            }
                        },
                    ],
                });
            }
            if (set01 == 'Penerimaan Staf'){
                $("#ppabp").val('REKRUTMEN PT DISA PRIMA MEDIKA');
                $("#aktiftidaknya").val('1');
            } else {
                $("#aktiftidaknya").val('1');
            }
            openpegawai();
        }
	}
$(document).ready(function () {
	getnotifcount();
    $('#pemberitahuan_isi').summernote()
    $('#penambahanstaf_isi').summernote()
    $('#peringatan_isi').summernote()
    $('#edaran_isi').summernote()
    $('#permohonan_tekskepada').summernote()
    $('#tugas_tekskepada').summernote()
    $('#permohonan_isi').summernote()
    $('#referensi_jabatan').summernote()
    $('.divsuratproses').hide();
    $('.select2').select2({width: '100%'});
    $("#kontrak_gaji").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
    $('#divtambahpenerima').hide();
	$('#loading').hide();
    $("#btnsimpansuratpertemplate").click(function(){
        var kelompok    = document.getElementById('kelompok').value;
        var jenissurat  = document.getElementById('jenissurat').value;
        var petugas     = document.getElementById('petugas').value;
        var urgas       = CKEDITOR.instances['kepdirangkat_uraiantugas'].getData()
        var urgas2      = CKEDITOR.instances['kepdir_uraiantugas'].getData()
        var urgas3      = CKEDITOR.instances['kepdir_uraiantugas2'].getData()
        var urgas4      = CKEDITOR.instances['kepdir_uraiantugas3'].getData()
        $('#loading').show();
        $("html, body").animate({ scrollTop: 0 }, "slow");
        var formdata 	= new FormData($('#form-data-upload')[0]);
            formdata.append('keputusandirektur_jenis', document.getElementById('keputusandirektur_jenis').value);
            formdata.append('masterkelompok', kelompok);
            formdata.append('masterjenissurat', jenissurat);
            formdata.append('masterpetugas', petugas);
            formdata.append('kepdir_uraiantugas', urgas2);
            formdata.append('kepdir_uraiantugas2', urgas3);
            formdata.append('kepdir_uraiantugas3', urgas4);
            formdata.append('kepdirangkat_uraiantugas', urgas);
            formdata.append('_token', '{{csrf_token()}}');
        $.ajax({
            url	            : '{{ route("exSuratWithTemplate") }}',
            data            : formdata,
            type            : 'POST',
            contentType     : false,
            processData     : false,
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
                $('#loading').hide();
                
                if (kelompok == 'Suratkeluar' || kelompok == 'Suratkeluarnonomer'){
                    $("#gridsuratkeluar").jqxGrid('updatebounddata', 'filter');
                }
                if (kelompok == 'Tabelskdanperaturan' || kelompok == 'Pegawai Tetap' || kelompok == 'Pengangkatan Jabatan' || kelompok == 'Pemberhentian Jabatan' || kelompok == 'Dokter Tetap' || kelompok == 'Penerimaan Staf' || kelompok == 'Penonaktifan Staf' || kelompok == 'Pengaktifan Staf' || kelompok == 'Mutasi' || kelompok == 'Penonaktifan Dokter Tetap' || kelompok == 'Pemutusan Hubungan Kerja'){
                    $('.divisian').hide();
                    $('.divinputbtngroup').hide();
                    $('.divtabelsuratkeluar').hide();
                    $('.divtabelkeputusandirektur').hide();
                    $('#loading').hide();
                    $("#gridskeputusandirektur").jqxGrid('updatebounddata', 'filter');
                    $("#gridpelamar").jqxGrid('updatebounddata', 'filter');
                    $('.divkeputusandirektur').show();
                    $('.divtabelkeputusandirektur').show();
                }
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
    });
    $("#btnkirimsurat").click(function(){
        var val01=document.getElementById('kirim_id').value;
        var val02=document.getElementById('kirim_idpeserta').value;
        var val03=document.getElementById('kirim_undangan').value;
        var val04=document.getElementById('kirim_kegiatan').value;
        var val05=document.getElementById('kirim_tglmulai').value;
        var val06=document.getElementById('kirim_jammulai').value;
        var val07=document.getElementById('kirim_tglselesai').value;
        var val08=document.getElementById('kirim_jamselesai').value;
        var val09=CKEDITOR.instances['kirim_keterangan'].getData()
        var val10=document.getElementById('kirim_kelompok').value;
        var token=document.getElementById('token').value;
        if (val02 == ''){
            swal({
                title	: 'Stop',
                text	: 'Untuk Penerima Mohon di Pilih Terlebih Dahulu',
                type	: 'warning',
            })
        } else if (val03 == 'Ya' && val04 == ''){
            swal({
                title	: 'Stop',
                text	: 'Untuk Undangan Mohon dilengkapi Nama Kegiatan, Jam Mulai dan Akhir Sesuai dengan Roundown Acara / Kegiatan',
                type	: 'warning',
            })
        } else if (val03 == 'Ya' && val05 == ''){
            swal({
                title	: 'Stop',
                text	: 'Untuk Undangan Mohon dilengkapi Nama Kegiatan, Jam Mulai dan Akhir Sesuai dengan Roundown Acara / Kegiatan',
                type	: 'warning',
            })
        } else if (val03 == 'Ya' && val06 == ''){
            swal({
                title	: 'Stop',
                text	: 'Untuk Undangan Mohon dilengkapi Nama Kegiatan, Jam Mulai dan Akhir Sesuai dengan Roundown Acara / Kegiatan',
                type	: 'warning',
            })
        } else if (val03 == 'Ya' && val07 == ''){
            swal({
                title	: 'Stop',
                text	: 'Untuk Undangan Mohon dilengkapi Nama Kegiatan, Jam Mulai dan Akhir Sesuai dengan Roundown Acara / Kegiatan',
                type	: 'warning',
            })
        } else if (val03 == 'Ya' && val08 == ''){
            swal({
                title	: 'Stop',
                text	: 'Untuk Undangan Mohon dilengkapi Nama Kegiatan, Jam Mulai dan Akhir Sesuai dengan Roundown Acara / Kegiatan',
                type	: 'warning',
            })
        } else {
            $('#loading').show();
            $('#divtambahpenerima').hide();
            $.post('{{ route("extbhpenerimasurat") }}', { set01: val01, set02: val02, set03: val03, set04: val04, set05: val05, set06: val06, set07: val07, set08: val08, set09: val09, set10: val10, _token: token },
            function(data){
                $("#griddetail").jqxGrid('updatebounddata');
                var status  = data.status;
                var message = data.message;
                $.toast({
                    heading: status,
                    text: message,
                    position: 'top-right',
                    loaderBg: '#bf441d',
                    icon: 'info',
                    hideAfter: 5000,
                    stack: 1
                });
                $('#loading').hide();
                $('#divtambahpenerima').show();
                return false;
            });
        }
    });
    $(".collectoridpeg").on('change', function () {
        var set01       = document.getElementById('jenissurat').value;
        var idpeg 	      = $(this).find('option:selected').attr('value');
        if (idpeg == '' || idpeg == null){

        } else {
            $.post('{{ route("getvalpeg") }}', { val01: idpeg, _token: '{{ csrf_token() }}' },function(data){
				var statpencarian = data.statpencarian;
				if (statpencarian == 'gagal'){
					swal({
						title	: 'Stop',
						text	: 'ID '+id+' Tidak di Temukan',
						type	: 'warning',
					})
				} else {
                    var ppabp = data.getpegawai['ppabp'];
                    if (ppabp == 'RS Prima Husada Sukorejo'){
                        var alamatpenempatan = ' Jl. Raya Surabaya - Malang Km 54, Desa Lemahbang Kec. Sukorejo';
                    } else {
                        var alamatpenempatan = 'Banjararum Selatan 3 Mondoroko - Malang';
                    }
                    if (set01 == 'Referensi Kerja'){
                        $('#referensi_jabatan').summernote('code', data.getpegawai['jabatan']);
                    }
					$("#kontrak_alamatpenempatan").val(alamatpenempatan);
                    $(".masterkelamin").val(data.getpegawai['jenis_kelamin']);
					$(".mastertgl_lahir").val(data.getpegawai['tgl_lahir']);
					$(".mastertmpt_lahir").val(data.getpegawai['tmpt_lahir']);
					$(".masterppabp").val(data.getpegawai['ppabp']);
					$(".masternip").val(data.getpegawai['nip_baru']);
					$(".masterjabatan").val(data.getpegawai['jabatan']);
					$(".masterunitkerja").val(data.getpegawai['unit_kerja']);
					$(".masternohape").val(data.getpegawai['no_hp']);
					$(".masteralamat").val(data.getpegawai['alamat']);
					$(".masternik").val(data.getpegawai['nik']);
					$(".mastercpns").val(data.getpegawai['cpns']);
					$(".mastertmt_golongan").val(data.getpegawai['tmt_golongan']);
					$(".mastertmt_jabatan").val(data.getpegawai['tmt_jabatan']);
					$(".mastertmt_pensiun").val(data.getpegawai['tmt_pensiun']);
					$(".masterstatus_jabatan").val(data.getpegawai['status_jabatan']);
                    $(".masterjenispeg").val(data.getpegawai['jenispeg']);
                    $(".masteremail").val(data.getpegawai['email']);
					
					/*
                    $("#id_ppabp").val(data.getpegawai['ppabp']);
					$("#id_homebase").val(data.getpegawai['program_studi']);
					$("#id_keterangan").val(data.getpegawai['keterangan']);
					$("#id_kelas").val(data.getpegawai['idremun']);
					$("#id_niplama").val(data.getpegawai['nip_lama']);
					$("#id_npwp").val(data.getpegawai['npwp']);
					$("#id_nidn").val(data.getpegawai['nidn']);
					$("#id_karpeg").val(data.getpegawai['karpeg']);
					$("#id_nira").val(data.getpegawai['nira']);
					$("#id_idpeg").val(data.getpegawai['id']);
					$("#id_jenis").val(data.getpegawai['jenisnip']);
					$("#id_tahunmsk").val(data.getpegawai['thn_masuk']);
					$("#id_nama").val(data.getpegawai['nama']);
					$("#id_nokk").val(data.getpegawai['nokk']);
					$("#id_ktp").val(data.getpegawai['ktp']);
					$("#id_tmplhr").val(data.getpegawai['tmpt_lahir']);
					$("#id_tgllhr").val(data.getpegawai['tgl_lahir']);
					$("#id_kelamin").val(data.getpegawai['jenis_kelamin']);
					$("#id_kode").val(data.getpegawai['kode']);
					$("#id_glrdepan").val(data.getpegawai['depan']);
					$("#id_glrblakang").val(data.getpegawai['belakang']);
					$("#id_glrdepan2").val(data.getpegawai['depandinilai']);
					$("#id_glrblakang2").val(data.getpegawai['belakangdinilai']);
					$("#id_kepakaran").val(data.getpegawai['kepakaran']);
					$("#id_bidangilmu").val(data.getpegawai['bidang_ilmu']);
					$("#id_bidangilmu3").val(data.getpegawai['bidang_ilmu3']);
					$("#id_alamatmlg").val(data.getpegawai['alamatmlg']);
					$("#id_kelurahan").val(data.getpegawai['kelurahan']);
					$("#id_kecamatan").val(data.getpegawai['kecamatan']);
					$("#id_kota").val(data.getpegawai['kota']);
					$("#id_propinsi").val(data.getpegawai['propinsi']);
					$("#id_agama").val(data.getpegawai['agama']);
					$("#id_kawin").val(data.getpegawai['statusnpwp']);
					$("#id_laborat").val(data.getpegawai['lab']);
					$("#id_status_jbtn").val(data.getpegawai['status_jabatan']);
					$("#id_status").val(data.getpegawai['status']);
					$("#id_tmtjabatan").val(data.getpegawai['tmtpangkat']);
					$("#id_pangkat").val(data.getpegawai['pangkat']);
					$("#id_jabfungsional").val(data.getpegawai['jab_fungsional']);
					$("#id_tmtfungsional").val(data.getpegawai['tmt_fungsional']);
					$("#id_cpns").val(data.getpegawai['cpns']);
					$("#id_tmtcpns").val(data.getpegawai['tmt_cpns']);
					$("#id_pns").val(data.getpegawai['pns']);
					$("#id_tmtpns").val(data.getpegawai['tmt_pns']);
					$("#id_gaji").val(data.getpegawai['gajisesuaisk']);
					$("#id_tmtgaji").val(data.getpegawai['tmtgaji']);
					$("#id_tinggibdn").val(data.getpegawai['tinggibdn']);
					$("#id_beratbdn").val(data.getpegawai['beratbdn']);
					$("#id_rambut").val(data.getpegawai['bentukrambut']);
					$("#id_muka").val(data.getpegawai['bentukmuka']);
					$("#id_warnakulit").val(data.getpegawai['warnakulit']);
					$("#id_cirikusus").val(data.getpegawai['cirikusus']);
					$("#id_cacattubuh").val(data.getpegawai['cacattubuh']);
					$("#id_hobi").val(data.getpegawai['hobi']);
					$("#id_bpjs").val(data.getpegawai['bpjs']);
					$("#id_nomoridi").val(data.getpegawai['nomoridi']);
					$("#id_keanggotaanprofesi").val(data.getpegawai['keanggotaanprofesi']);
					$("#id_nomorstr").val(data.getpegawai['nomorstr']);
					$("#id_nomorsip1").val(data.getpegawai['nomorsip1']);
					$("#id_nomorsip2").val(data.getpegawai['nomorsip2']);
					$("#id_nomorsip3").val(data.getpegawai['nomorsip3']);
					$("#id_google").val(data.getpegawai['google']);
					$("#id_shinta").val(data.getpegawai['shinta']);
					$("#id_scopus").val(data.getpegawai['scopus']);
					$("#id_orcid").val(data.getpegawai['orcid']);
					var foto = data.getpegawai['foto']
					if (foto == null || foto == ''){
						$('#preview').attr('src', 'dist/img/takadagambar.jpg');
					} else {
						$('#preview').attr('src', 'images/pegawai/'+foto);
					}
                    */
				}
            });
        }
    });
    $("#kirim_email").on('change', function () {
        var idpeg = $(this).find('option:selected').attr('idpeg');
        $("#kirim_idpeserta").val(idpeg);
    });
    $("#btnuploadfilebermeterai").click(function(){
        var set01=document.getElementById('uploadmet_file');
        var set10=document.getElementById('uploadmet_marking').value;
        if ($('#uploadmet_file').val() == ''){
            swal({
                title	: 'Stop',
                text	: 'File Kosong',
                type	: 'warning',
            })
        } else {
            $("#modaluploadsuratmaterai").modal('hide');
            $('#loading').show();
            var form_data = new FormData();
                form_data.append('file', set01.files[0]);
                form_data.append('val02', '');
                form_data.append('val03', '');
                form_data.append('val04', '');
                form_data.append('val05', 'emeterai');
                form_data.append('val06', '');
                form_data.append('val07', '');
                form_data.append('val08', '');
                form_data.append('val09', '');
                form_data.append('val10', set10);
                form_data.append('val11', '');
                form_data.append('val12', '');
                form_data.append('val13', '');
                form_data.append('val14', '');
                form_data.append('_token', '{{csrf_token()}}');
            $.ajax({
                url	: '{{ route("exUploadSuratTTE") }}',
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
                        heading     : status,
                        text        : message,
                        position    : 'top-right',
                        loaderBg    : warna,
                        iconv       : icon,
                        hideAfter   : 5000,
                        stack       : 1
                    });
                    $('#loading').hide();
                    $("#gridsuratkeluar").jqxGrid('updatebounddata', 'filter');
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
    $("#btnsimpansuratcustom").click(function(){
        var set01=document.getElementById('srtcustom_file');
        var set11=document.getElementById('srtcustom_jenis').value;
        var set10=document.getElementById('srtcustom_marking').value;
        var set06=document.getElementById('srtcustom_pemeriksa').value;
        var set04=document.getElementById('srtcustom_penandatangan').value;
        if ($('#srtcustom_file').val() == ''){
            swal({
                title	: 'Stop',
                text	: 'File Kosong',
                type	: 'warning',
            })
        } else if (set04 == ''){
            swal({
                title	: 'Stop',
                text	: 'Penandatangan Tidak Boleh Kosong',
                type	: 'warning',
            })
        } else {
            $("#modaluploadsuratcustom").modal('hide');
            $('#loading').show();
            var form_data = new FormData();
                form_data.append('file', set01.files[0]);
                form_data.append('val02', '');
                form_data.append('val03', '');
                form_data.append('val04', set04);
                form_data.append('val05', 'custom');
                form_data.append('val06', set06);
                form_data.append('val07', '');
                form_data.append('val08', '');
                form_data.append('val09', '');
                form_data.append('val10', set10);
                form_data.append('val11', set11);
                form_data.append('val12', '');
                form_data.append('val13', '');
                form_data.append('val14', '');
                form_data.append('_token', '{{csrf_token()}}');
            $.ajax({
                url	: '{{ route("exUploadSuratTTE") }}',
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
                        heading     : status,
                        text        : message,
                        position    : 'top-right',
                        loaderBg    : warna,
                        iconv       : icon,
                        hideAfter   : 5000,
                        stack       : 1
                    });
                    $('#loading').hide();
                    $("#gridsuratkeluar").jqxGrid('updatebounddata', 'filter');
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
    $(".topbtnopenpegawai").click(function(){
        openpegawai();
    });
    //CUTI
        $('.btnopenforma1').on('click', function (){
            var judul       = 'Form Cuti Tahunan';
            var jenissurat  = 'Cuti Tahunan';
            var kelompok    = 'Suratkeluarnonomer';
            var petugas     = "{{Session('previlage')}}";
            $('.divawal').hide();
            $('.divsuratproses').show();
            $("#judul").html(judul);
            $("#jenissurat").val(jenissurat);
            $("#petugas").val(petugas);
            $("#kelompok").val(kelompok);
            $("#gridsuratkeluar").empty();
            openedpage();
        });
        $('.btnopenforma2').on('click', function (){
            var judul       = 'Form Cuti Keagamaan';
            var jenissurat  = 'Cuti Keagamaan';
            var kelompok    = 'Suratkeluarnonomer';
            var petugas     = "{{Session('previlage')}}";
            $('.divawal').hide();
            $('.divsuratproses').show();
            $("#judul").html(judul);
            $("#jenissurat").val(jenissurat);
            $("#petugas").val(petugas);
            $("#kelompok").val(kelompok);
            $("#gridsuratkeluar").empty();
            openedpage();
        });
        $('#btntambahdatacuti').on('click', function (){
            $('.divisian').hide();
            $('.divtabelsuratkeluar').hide();
            $('#divisicuti').show();
            $('.divinputbtngroup').show();
            $("#cuti_id").val('new');
        });
        var sourcejadwal = {
            datatype: "json",
            datafields: [
                { name: 'idne',type: 'text'},
                { name: 'tahun',type: 'text'},
                { name: 'jumlah',type: 'text'},
            ],
            url: '{{route("getlistkuotacuti")}}',
            cache: false
        };		
        var datajadwalpimpinan = new $.jqx.dataAdapter(sourcejadwal);
        $("#gridsettingcuti").jqxGrid({
            width: '100%',
            columnsresize: true,
            sortable: true,
            pageable: true,
            autoheight: true,
            filterable: true,
            source: datajadwalpimpinan,
            theme: "energyblue",
            selectionmode: 'multiplecellsextended',
            columns: [
                { text: 'Tahun', datafield: 'tahun', width: '50%', cellsalign: 'left', align: 'center' },
                { text: 'Cuti',  datafield: 'jumlah', width: '30%', cellsalign: 'left', align: 'center' },
                { text: 'Edit', columntype: 'button', align: 'center', width: '20%', cellsrenderer: function () {
                    return "Edit";
                    }, buttonclick: function (row) {
                        editrow = row;	
                        var offset 		= $("#gridsettingcuti").offset();		
                        var dataRecord 	= $("#gridsettingcuti").jqxGrid('getrowdata', editrow);
                        $("#setting_id").val(dataRecord.idne);
                        $("#setting_tahun").val(dataRecord.tahun);
                        $("#setting_jumlah").val(dataRecord.jumlah);
                        $("#modalsettingcuti").modal('show');
                    }
                }
            ]
        });
        $("#btnsimpansetting").click(function(){
            var set01=document.getElementById('setting_id').value;
            var set02=document.getElementById('setting_tahun').value;
            var set03=document.getElementById('setting_jumlah').value;
            var token=document.getElementById('token').value;
            if (set02 == ''){
                swal({
                    title: 'Perhatian',
                    text: 'Tahun Wajib Terisi',
                    type: 'error',
                })
            } else if (set03 == ''){
                swal({
                    title: 'Perhatian',
                    text: 'Jumlah Wajib di Isi',
                    type: 'error',
                })
            } else {
                $.post('{{ route("exsafeCuti") }}', { val01: set01, val02: set02, val03: set03, val04: '', val05: '', val06: '', val07: '', val08: '', val09: '', val10: '', val11: '', val12: '', val13: '', val14: '', val15: 'Setting', _token: token },
                function(data){
                    $("#gridsettingcuti").jqxGrid('updatebounddata');
                    $("#modalsettingcuti").modal('hide');
                    var status  = data.status;
                    var message = data.message;
                    $.toast({
                        heading: status,
                        text: message,
                        position: 'top-right',
                        loaderBg: '#bf441d',
                        icon: 'info',
                        hideAfter: 5000,
                        stack: 1
                    });
                    return false;
                });	
            }
        });
        $('#btneditsettingcutitahunan').on('click', function (){
            $("#modalsettingcuti").modal('show');
            $("#setting_id").val('new');
        });
    //END_CUTI
    $('.btnopenforma3').on('click', function (){
        var judul       = 'Form Ijin Pulang Cepat';
        var jenissurat  = 'Ijin Pulang Cepat';
        var kelompok    = 'Suratkeluarnonomer';
        var petugas     = "{{Session('previlage')}}";
        $('.divawal').hide();
		$('.divsuratproses').show();
		$("#judul").html(judul);
		$("#jenissurat").val(jenissurat);
		$("#petugas").val(petugas);
		$("#kelompok").val(kelompok);
        $("#gridsuratkeluar").empty();
	    openedpage();
    });
    $('.btnopenforma4').on('click', function (){
        var judul       = 'Form Ijin Keluar Kantor';
        var jenissurat  = 'Ijin Keluar Kantor';
        var kelompok    = 'Suratkeluarnonomer';
        var petugas     = "{{Session('previlage')}}";
        $('.divawal').hide();
		$('.divsuratproses').show();
		$("#judul").html(judul);
		$("#jenissurat").val(jenissurat);
		$("#petugas").val(petugas);
		$("#kelompok").val(kelompok);
        $("#gridsuratkeluar").empty();
        
	    openedpage();
    });
    $('.btnopenforma5').on('click', function (){
        var judul       = 'Form Permintaan Pegawai';
        var jenissurat  = 'Permintaan Pegawai';
        var kelompok    = 'Suratkeluarnonomer';
        var petugas     = "{{Session('previlage')}}";
        $('.divawal').hide();
		$('.divsuratproses').show();
		$("#judul").html(judul);
		$("#jenissurat").val(jenissurat);
		$("#petugas").val(petugas);
		$("#kelompok").val(kelompok);
	    openedpage();
    });
    $('.btnopenforma6').on('click', function (){
        var judul       = 'Form Mutasi Rotasi';
        var jenissurat  = 'Mutasi Rotasi';
        var kelompok    = 'Suratkeluarnonomer';
        var petugas     = "{{Session('previlage')}}";
        $('.divawal').hide();
		$('.divsuratproses').show();
		$("#judul").html(judul);
		$("#jenissurat").val(jenissurat);
		$("#petugas").val(petugas);
		$("#kelompok").val(kelompok);
	    openedpage();
    });
    $('.btnopenforma7').on('click', function (){
        var judul       = 'Form Komunikasi';
        var jenissurat  = 'Komunikasi';
        var kelompok    = 'Suratkeluarnonomer';
        var petugas     = "{{Session('previlage')}}";
        $('.divawal').hide();
		$('.divsuratproses').show();
		$("#judul").html(judul);
		$("#jenissurat").val(jenissurat);
		$("#petugas").val(petugas);
		$("#kelompok").val(kelompok);
	    openedpage();
    });
    //START_KEPUTUSAN_DIREKTUR
        $('.btnopenformb1').on('click', function (){
            var judul       = 'Keputusan Direktur tentang Pengangkatan Jabatan';
            var jenissurat  = 'Pengangkatan Jabatan';
            var kelompok    = 'Tabelskdanperaturan';
            var petugas     = "{{Session('previlage')}}";
            $('.divawal').hide();
            $('.divsuratproses').show();
            $("#judul").html(judul);
            $("#jenissurat").val(jenissurat);
            $("#petugas").val(petugas);
            $("#kelompok").val(kelompok);
            openedpage();
        });
        $('.btnopenformb2').on('click', function (){
            var judul       = 'Keputusan Direktur tentang Pemberhentian Jabatan';
            var jenissurat  = 'Pemberhentian Jabatan';
            var kelompok    = 'Tabelskdanperaturan';
            var petugas     = "{{Session('previlage')}}";
            $('.divawal').hide();
            $('.divsuratproses').show();
            $("#judul").html(judul);
            $("#jenissurat").val(jenissurat);
            $("#petugas").val(petugas);
            $("#kelompok").val(kelompok);
            openedpage();
        });
        $('.btnopenformb3').on('click', function (){
            var judul       = 'Keputusan Direktur tentang Pegawai Tetap';
            var jenissurat  = 'Pegawai Tetap';
            var kelompok    = 'Tabelskdanperaturan';
            var petugas     = "{{Session('previlage')}}";
            $('.divawal').hide();
            $('.divsuratproses').show();
            $("#judul").html(judul);
            $("#jenissurat").val(jenissurat);
            $("#petugas").val(petugas);
            $("#kelompok").val(kelompok);
            openedpage();
        });
        $('.btnopenformb4').on('click', function (){
            var judul       = 'Keputusan Direktur tentang Dokter Tetap';
            var jenissurat  = 'Dokter Tetap';
            var kelompok    = 'Tabelskdanperaturan';
            var petugas     = "{{Session('previlage')}}";
            $('.divawal').hide();
            $('.divsuratproses').show();
            $("#judul").html(judul);
            $("#jenissurat").val(jenissurat);
            $("#petugas").val(petugas);
            $("#kelompok").val(kelompok);
            openedpage();
        });
        $('.btnopenformb5').on('click', function (){
            var judul       = 'Keputusan Direktur tentang Penerimaan Staf';
            var jenissurat  = 'Penerimaan Staf';
            var kelompok    = 'Tabelskdanperaturan';
            var petugas     = "{{Session('previlage')}}";
            $('.divawal').hide();
            $('.divsuratproses').show();
            $("#judul").html(judul);
            $("#jenissurat").val(jenissurat);
            $("#petugas").val(petugas);
            $("#kelompok").val(kelompok);
            openedpage();
        });
        $('.btnopenformb6').on('click', function (){
            var judul       = 'Keputusan Direktur tentang Penonaktifan Staf';
            var jenissurat  = 'Penonaktifan Staf';
            var kelompok    = 'Tabelskdanperaturan';
            var petugas     = "{{Session('previlage')}}";
            $('.divawal').hide();
            $('.divsuratproses').show();
            $("#judul").html(judul);
            $("#jenissurat").val(jenissurat);
            $("#petugas").val(petugas);
            $("#kelompok").val(kelompok);
            openedpage();
        });
        $('.btnopenformb7').on('click', function (){
            $("#modalpilihanpenempatanataupengaktifan").modal('show');
        });
        $('#btnsetpilihansk').on('click', function (){
            var jenissurat  = document.getElementById('pilih_jenissk').value;
            var judul       = 'Keputusan Direktur tentang '+jenissurat;
            var kelompok    = 'Tabelskdanperaturan';
            var petugas     = "{{Session('previlage')}}";
            $('.divawal').hide();
            $('.divsuratproses').show();
            $("#judul").html(judul);
            $("#jenissurat").val(jenissurat);
            $("#petugas").val(petugas);
            $("#kelompok").val(kelompok);
            $("#kepdiraktivas_status_jabatan").val(jenissurat);
            openedpage();
            $("#modalpilihanpenempatanataupengaktifan").modal('hide');
        });
        $('.btnopenformb8').on('click', function (){
            var judul       = 'Keputusan Direktur tentang Mutasi';
            var jenissurat  = 'Mutasi';
            var kelompok    = 'Tabelskdanperaturan';
            var petugas     = "{{Session('previlage')}}";
            $('.divawal').hide();
            $('.divsuratproses').show();
            $("#judul").html(judul);
            $("#jenissurat").val(jenissurat);
            $("#petugas").val(petugas);
            $("#kelompok").val(kelompok);
            openedpage();
        });
        $('.btnopenformb9').on('click', function (){
            var judul       = 'Keputusan Direktur tentang Penonaktifan Dokter Tetap';
            var jenissurat  = 'Penonaktifan Dokter Tetap';
            var kelompok    = 'Tabelskdanperaturan';
            var petugas     = "{{Session('previlage')}}";
            $('.divawal').hide();
            $('.divsuratproses').show();
            $("#judul").html(judul);
            $("#jenissurat").val(jenissurat);
            $("#petugas").val(petugas);
            $("#kelompok").val(kelompok);
            openedpage();
        });
        $('.btnopenformb10').on('click', function (){
            var judul       = 'Keputusan Direktur tentang Pemutusan Hubungan Kerja';
            var jenissurat  = 'Pemutusan Hubungan Kerja';
            var kelompok    = 'Tabelskdanperaturan';
            var petugas     = "{{Session('previlage')}}";
            $('.divawal').hide();
            $('.divsuratproses').show();
            $("#judul").html(judul);
            $("#jenissurat").val(jenissurat);
            $("#petugas").val(petugas);
            $("#kelompok").val(kelompok);
            openedpage();
        });
        $("#btntambahstafmanual").click(function(){
            $('.divinputbtngroup').show();
            $('.divisian').hide();
            $('.divtabelsuratkeluar').hide();
            $('.divtabelkeputusandirektur').hide();
            $('.divkontrakkerja').hide();
            $('.divcuti').hide();
            $('#divisikeputusandirektur').show();
            $("#kepdir_nomor").val('');
            $("#kepdir_nama").val('');
            $("#kepdir_nip").val('');
            $("#kepdir_email").val('');
        }); 
    //END_KEPUTUSAN_DIREKTUR
    //START_KONTRAK_KERJA
        $('.btnopenformc1').on('click', function (){
            var judul       = 'Draft Perjanjian Orientasi Kerja';
            var jenissurat  = 'Perjanjian Orientasi Kerja';
            var kelompok    = 'Suratkeluar';
            var petugas     = "{{Session('previlage')}}";
            $('.divawal').hide();
            $('.divsuratproses').show();
            $("#judul").html(judul);
            $("#jenissurat").val(jenissurat);
            $("#petugas").val(petugas);
            $("#kelompok").val(kelompok);
            $("#gridsuratkeluar").val();
            openedpage();
        });
        $('.btnopenformc2').on('click', function (){
            var judul       = 'Draft Perjanjian PKWT';
            var jenissurat  = 'PKWT';
            var kelompok    = 'Suratkeluar';
            var petugas     = "{{Session('previlage')}}";
            $('.divawal').hide();
            $('.divsuratproses').show();
            $("#judul").html(judul);
            $("#jenissurat").val(jenissurat);
            $("#petugas").val(petugas);
            $("#kelompok").val(kelompok);
            openedpage();
        });
        $('.btnopenformc3').on('click', function (){
            var judul       = 'Draft Perjanjian PKWTT';
            var jenissurat  = 'PKWTT';
            var kelompok    = 'Suratkeluar';
            var petugas     = "{{Session('previlage')}}";
            $('.divawal').hide();
            $('.divsuratproses').show();
            $("#judul").html(judul);
            $("#jenissurat").val(jenissurat);
            $("#petugas").val(petugas);
            $("#kelompok").val(kelompok);
            openedpage();
        });
        $('#btntambahdatakontrakkerja').on('click', function (){
            $('.divisian').hide();
            $('.divtabelsuratkeluar').hide();
            $('#divisikontrakkerja').show();
            $('.divinputbtngroup').show();
            $('.divcuti').hide();
            $('.divtabelkeputusandirektur').hide();
            $("#kontrak_id").val('new');
        });
        $("#btnkirimdraftkontrak").click(function(){
            var set02=document.getElementById('kirimkontrak_marking').value;
            var set03=document.getElementById('kirimkontrak_pemeriksa').value;
            var set04=document.getElementById('kirimkontrak_penandatangan').value;
            var set01=document.getElementById('kirimkontrak_jenis').value;
            var token=document.getElementById('token').value;
            if (set03 == ''){
                swal({
                    title   : 'Perhatian',
                    text    : 'Penandatangan Wajib di Isi',
                    type    : 'error',
                })
            } else {
                $("#modalsettingpenandatangankontrak").modal('hide');
                $.post('{{ route("exKirimdraftSKkontrak") }}', { val01: set01, val02: set02, val03: set03, val04: set04, val05: '', val06: '', val07: '', val08: '', val09: '', val10: '', val11: '', val12: '', val13: '', val14: '', val15: 'Setting', _token: token },
                function(data){
                    $("#gridsuratkeluar").jqxGrid('updatebounddata');
                    $.toast({
                        heading: data.status,
                        text: data.message,
                        position: 'top-right',
                        loaderBg: data.warna,
                        icon: data.icon,
                        hideAfter: 5000,
                        stack: 1
                    });
                    return false;
                });	
            }
        });
    //END_KONTRAK_KERJA
    //KUMPULAN_SURAT_SURAT
        //START_SPO
            $('.btnopenformd1').on('click', function (){
                var judul       = 'STANDAR PROSEDUR OPERASIONAL';
                var jenissurat  = 'SPO';
                var kelompok    = 'Suratkeluarnonomer';
                var petugas     = "{{Session('previlage')}}";
                $('.divawal').hide();
                $('.divsuratproses').show();
                $("#judul").html(judul);
                $("#jenissurat").val(jenissurat);
                $("#petugas").val(petugas);
                $("#kelompok").val(kelompok);
                openedpage();
            });
            $("#btnsimpanspo").click(function(){
                var set01=document.getElementById('spo_nomordokumen').value;
                var set02=document.getElementById('spo_nomorrevisi').value;
                var set03=document.getElementById('spo_tanggal').value;
                var set04=document.getElementById('spo_judul').value;
                var set05='-';
                var set06='-';
                var set07='';
                var set08=document.getElementById('spo_penandatangan').value;
                var token=document.getElementById('token').value;
                if (set01 == '' || set02 == '' || set03 == '' || set04 == '' || set05 == '' || set06 == '' || set08 == ''){
                    swal({
                        title   : 'Perhatian',
                        text    : 'Semua Form (Kecuali Pemeriksa) Wajib di Isi',
                        type    : 'error',
                    })
                } else {
                    var kelompok    = document.getElementById('kelompok').value;
                    var jenissurat  = document.getElementById('jenissurat').value;
                    var petugas     = document.getElementById('petugas').value;
                    $('#loading').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    var formdata = new FormData();
                        formdata.append('masterkelompok', kelompok);
                        formdata.append('masterjenissurat', jenissurat);
                        formdata.append('masterpetugas', petugas);
                        formdata.append('val01', set01);
                        formdata.append('val02', set02);
                        formdata.append('val03', set03);
                        formdata.append('val04', set04);
                        formdata.append('val05', set05);
                        formdata.append('val06', set06);
                        formdata.append('val07', set07);
                        formdata.append('val08', set08);
                        formdata.append('_token', '{{csrf_token()}}');
                    $.ajax({
                        url	            : '{{ route("exSuratWithTemplate") }}',
                        data            : formdata,
                        type            : 'POST',
                        contentType     : false,
                        processData     : false,
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
                            $('#loading').hide();
                            $("#gridsuratkeluar").jqxGrid('updatebounddata', 'filter');
                            return false;
                        },
                        error: function (xhr, status, error) {
                            $('#loading').hide();
                            swal({
                                title	: 'Stop',
                                text	: xhr.responseText,
                                type	: 'error',
                            })
                        }
                    });
                }
            });
        //END_SPO
        //START_EDARAN
            $('.btnopenforme1').on('click', function (){
                var judul       = 'Drafting Surat Edaran';
                var jenissurat  = 'Edaran';
                var kelompok    = 'Suratkeluar';
                var petugas     = "{{Session('previlage')}}";
                $('.divawal').hide();
                $('.divsuratproses').show();
                $("#judul").html(judul);
                $("#jenissurat").val(jenissurat);
                $("#petugas").val(petugas);
                $("#kelompok").val(kelompok);
                openedpage();
            });
            $("#btnsimpansuratedaran").click(function(){
                var set01	= $('#edaran_kepada').select2('data');
                var kepada 	= new Array();
                var keys = Object.keys(set01),
                    len = keys.length,
                    i = 0,
                    prop,
                    value;
                while (i < len) {
                    prop 	= keys[i];
                    value 	= set01[prop];
                    kepada.push({
                        "id" : value.id
                    });
                    i += 1;
                }
                var jsonkepada = JSON.stringify(kepada);
                var set02 = $('#edaran_isi').summernote('code');
                var set03=document.getElementById('edaran_judul').value;
                var set04='-';
                var set05='-';
                var set06='-';
                var set07=document.getElementById('edaran_pemeriksa').value;
                var set08=document.getElementById('edaran_penandatangan').value;
                var set09=document.getElementById('edaran_file');
                var token=document.getElementById('token').value;
                if (i == 0 || set01 == '' || set02 == '' || set03 == '' || set04 == '' || set05 == '' || set06 == '' || set08 == ''){
                    swal({
                        title   : 'Perhatian',
                        text    : 'Semua Form (Kecuali Pemeriksa) Wajib di Isi',
                        type    : 'error',
                    })
                } else {
                    var kelompok    = document.getElementById('kelompok').value;
                    var jenissurat  = document.getElementById('jenissurat').value;
                    var petugas     = document.getElementById('petugas').value;
                    $('#loading').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    var formdata = new FormData();
                        formdata.append('masterkelompok', kelompok);
                        formdata.append('masterjenissurat', jenissurat);
                        formdata.append('masterpetugas', petugas);
                        formdata.append('set_kepada[]', jsonkepada);
                        formdata.append('val02', set02);
                        formdata.append('val03', set03);
                        formdata.append('val04', set04);
                        formdata.append('val05', set05);
                        formdata.append('val06', set06);
                        formdata.append('val07', set07);
                        formdata.append('val08', set08);
                        formdata.append('file', set09.files[0]);
                        formdata.append('_token', '{{csrf_token()}}');
                    $.ajax({
                        url	            : '{{ route("exSuratWithTemplate") }}',
                        data            : formdata,
                        type            : 'POST',
                        contentType     : false,
                        processData     : false,
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
                            $('#loading').hide();
                            $("#gridsuratkeluar").jqxGrid('updatebounddata', 'filter');
                            return false;
                        },
                        error: function (xhr, status, error) {
                            $('#loading').hide();
                            swal({
                                title	: 'Stop',
                                text	: xhr.responseText,
                                type	: 'error',
                            })
                        }
                    });
                }
            });
        //END_ENDARAN
        //START_PERINGATAN
            $('.btnopenforme2').on('click', function (){
                var judul       = 'Drafting Surat Peringatan';
                var jenissurat  = 'Peringatan';
                var kelompok    = 'Suratkeluar';
                var petugas     = "{{Session('previlage')}}";
                $('.divawal').hide();
                $('.divsuratproses').show();
                $("#judul").html(judul);
                $("#jenissurat").val(jenissurat);
                $("#petugas").val(petugas);
                $("#kelompok").val(kelompok);
                openedpage();
            });
            $("#btnsimpansuratperingatan").click(function(){
                var set01=document.getElementById('peringatan_nama').value;
                var set02=document.getElementById('peringatan_ppabp').value;
                var set03=document.getElementById('peringatan_jabatan').value;
                var set04=document.getElementById('peringatan_mulai').value;
                var set05=document.getElementById('peringatan_tempat').value;
                var set06=$('#peringatan_isi').summernote('code');
                var set07=document.getElementById('peringatan_jenis').value;
                var set08=document.getElementById('peringatan_sanksi').value;
                var set09=document.getElementById('peringatan_pemeriksa').value;
                var set10=document.getElementById('peringatan_penandatangan').value;
                var token=document.getElementById('token').value;
                if (set01 == '' || set02 == '' || set03 == '' || set04 == '' || set05 == '' || set06 == '' || set08 == '' || set09 == '' || set10 == ''){
                    swal({
                        title   : 'Perhatian',
                        text    : 'Semua Form (Kecuali Pemeriksa) Wajib di Isi',
                        type    : 'error',
                    })
                } else {
                    var kelompok    = document.getElementById('kelompok').value;
                    var jenissurat  = document.getElementById('jenissurat').value;
                    var petugas     = document.getElementById('petugas').value;
                    $('#loading').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    var formdata = new FormData();
                        formdata.append('masterkelompok', kelompok);
                        formdata.append('masterjenissurat', jenissurat);
                        formdata.append('masterpetugas', petugas);
                        formdata.append('val01', set01);
                        formdata.append('val02', set02);
                        formdata.append('val03', set03);
                        formdata.append('val04', set04);
                        formdata.append('val05', set05);
                        formdata.append('val06', set06);
                        formdata.append('val07', set07);
                        formdata.append('val08', set08);
                        formdata.append('val09', set09);
                        formdata.append('val10', set10);
                        formdata.append('_token', '{{csrf_token()}}');
                    $.ajax({
                        url	            : '{{ route("exSuratWithTemplate") }}',
                        data            : formdata,
                        type            : 'POST',
                        contentType     : false,
                        processData     : false,
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
                            $('#loading').hide();
                            $("#gridsuratkeluar").jqxGrid('updatebounddata', 'filter');
                            return false;
                        },
                        error: function (xhr, status, error) {
                            $('#loading').hide();
                            swal({
                                title	: 'Stop',
                                text	: xhr.responseText,
                                type	: 'error',
                            })
                        }
                    });
                }
            });
        //END_PERINGATAN
        //START_BALASAN_TAMBAH_STAF
            $('.btnopenforme3').on('click', function (){
                var judul       = 'Drafting Surat Balasan Penambahan Staf';
                var jenissurat  = 'Balasan Penambahan Staf';
                var kelompok    = 'Suratkeluar';
                var petugas     = "{{Session('previlage')}}";
                $('.divawal').hide();
                $('.divsuratproses').show();
                $("#judul").html(judul);
                $("#jenissurat").val(jenissurat);
                $("#petugas").val(petugas);
                $("#kelompok").val(kelompok);
                openedpage();
            });
            $("#btnsimpanpenambahanstaf").click(function(){
                var set01=document.getElementById('penambahanstaf_nama').value;
                var set02=document.getElementById('penambahanstaf_nomor').value;
                var set03=document.getElementById('penambahanstaf_tanggal').value;
                var set04='-';
                var set05='-';
                var set06=$('#penambahanstaf_isi').summernote('code');
                var set07=document.getElementById('penambahanstaf_pemeriksa').value;
                var set08=document.getElementById('penambahanstaf_penandatangan').value;
                var token=document.getElementById('token').value;
                if (set01 == '' || set02 == '' || set03 == '' || set04 == '' || set05 == '' || set06 == '' || set08 == ''){
                    swal({
                        title   : 'Perhatian',
                        text    : 'Semua Form (Kecuali Pemeriksa) Wajib di Isi',
                        type    : 'error',
                    })
                } else {
                    var kelompok    = document.getElementById('kelompok').value;
                    var jenissurat  = document.getElementById('jenissurat').value;
                    var petugas     = document.getElementById('petugas').value;
                    $('#loading').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    var formdata = new FormData();
                        formdata.append('masterkelompok', kelompok);
                        formdata.append('masterjenissurat', jenissurat);
                        formdata.append('masterpetugas', petugas);
                        formdata.append('val01', set01);
                        formdata.append('val02', set02);
                        formdata.append('val03', set03);
                        formdata.append('val04', set04);
                        formdata.append('val05', set05);
                        formdata.append('val06', set06);
                        formdata.append('val07', set07);
                        formdata.append('val08', set08);
                        formdata.append('_token', '{{csrf_token()}}');
                    $.ajax({
                        url	            : '{{ route("exSuratWithTemplate") }}',
                        data            : formdata,
                        type            : 'POST',
                        contentType     : false,
                        processData     : false,
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
                            $('#loading').hide();
                            $("#gridsuratkeluar").jqxGrid('updatebounddata', 'filter');
                            return false;
                        },
                        error: function (xhr, status, error) {
                            $('#loading').hide();
                            swal({
                                title	: 'Stop',
                                text	: xhr.responseText,
                                type	: 'error',
                            })
                        }
                    });
                }
            });
        //END_BALASAN_TAMBAH_STAF
        //START_PERMOHONAN
            $('.btnopenforme4').on('click', function (){
                var judul       = 'Drafting Surat Permohonan';
                var jenissurat  = 'Permohonan';
                var kelompok    = 'Suratkeluar';
                var petugas     = "{{Session('previlage')}}";
                $('.divawal').hide();
                $('.divsuratproses').show();
                $("#judul").html(judul);
                $("#jenissurat").val(jenissurat);
                $("#petugas").val(petugas);
                $("#kelompok").val(kelompok);
                $("#permohonan_hiddenkepada").val('');
                $('#permohonan_tekskepada').summernote('code', '');
                openedpage();
            });
            $("#btnsimpansuratpermohonan").click(function(){
                var set01=document.getElementById('permohonan_kepada').value;
                var set02=document.getElementById('permohonan_judul').value;
                var set03=$('#permohonan_tekskepada').summernote('code');
                var set04=document.getElementById('permohonan_hiddenkepada').value;
                var set05='-';
                var set06=$('#permohonan_isi').summernote('code');
                var set07=document.getElementById('permohonan_pemeriksa').value;
                var set08=document.getElementById('permohonan_penandatangan').value;
                var token=document.getElementById('token').value;
                if (set01 == '' || set02 == '' || set03 == '' || set04 == '' || set05 == '' || set06 == '' || set08 == ''){
                    swal({
                        title   : 'Perhatian',
                        text    : 'Semua Form (Kecuali Pemeriksa) Wajib di Isi',
                        type    : 'error',
                    })
                } else {
                    var kelompok    = document.getElementById('kelompok').value;
                    var jenissurat  = document.getElementById('jenissurat').value;
                    var petugas     = document.getElementById('petugas').value;
                    $('#loading').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    var formdata = new FormData();
                        formdata.append('masterkelompok', kelompok);
                        formdata.append('masterjenissurat', jenissurat);
                        formdata.append('masterpetugas', petugas);
                        formdata.append('val01', set01);
                        formdata.append('val02', set02);
                        formdata.append('val03', set03);
                        formdata.append('val04', set04);
                        formdata.append('val05', set05);
                        formdata.append('val06', set06);
                        formdata.append('val07', set07);
                        formdata.append('val08', set08);
                        formdata.append('_token', '{{csrf_token()}}');
                    $.ajax({
                        url	            : '{{ route("exSuratWithTemplate") }}',
                        data            : formdata,
                        type            : 'POST',
                        contentType     : false,
                        processData     : false,
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
                            $('#loading').hide();
                            $("#gridsuratkeluar").jqxGrid('updatebounddata', 'filter');
                            return false;
                        },
                        error: function (xhr, status, error) {
                            $('#loading').hide();
                            swal({
                                title	: 'Stop',
                                text	: xhr.responseText,
                                type	: 'error',
                            })
                        }
                    });
                }
            });
            $("#permohonan_kepada").on('change', function () {
                var pejabat     = $(this).find('option:selected').attr('value');
                var nama        = $(this).find('option:selected').attr('nama');
                var idjabatan   = $(this).find('option:selected').attr('idjabatan');
                var tulisnama   = '<li>'+nama+' ( '+pejabat+' )</li>';
                var set03       = $('#permohonan_tekskepada').summernote('code');
                var set04       = document.getElementById('permohonan_hiddenkepada').value;
                if (set04 == ''){
                    var isi     = idjabatan;
                    var judul   = '<ol>'+tulisnama+'</ol>';
                    $("#permohonan_hiddenkepada").val(isi);
                } else {
                    var isi     = set04+';'+idjabatan;
                    var judul   = set03.replace("</ol>", tulisnama);
                    $("#permohonan_hiddenkepada").val(isi);
                }
                $('#permohonan_tekskepada').summernote('code', judul);
            });
        //END_PERMOHONAN
        //START_SURAT_TUGAS
            $("#tugas_kepada").on('change', function () {
                var idjabatan   = $(this).find('option:selected').attr('value');
                var nama        = $(this).find('option:selected').attr('nama');
                var pejabat     = $(this).find('option:selected').attr('pejabat');
                var tulisnama   = '<tr><td>'+nama+'</td><td>'+pejabat+' </td></tr>';
                var set03       = $('#tugas_tekskepada').summernote('code');
                var set04       = document.getElementById('tugas_hiddenkepada').value;
                if (set04 == ''){
                    var isi     = idjabatan;
                    var judul   = '<table border="1" cellspacing="0" cellpadding="0">'+tulisnama+'</table>';
                    $("#tugas_hiddenkepada").val(isi);
                } else {
                    var isi     = set04+';'+idjabatan;
                    var judul   = set03.replace("</table>", tulisnama);
                    $("#tugas_hiddenkepada").val(isi);
                }
                $('#tugas_tekskepada').summernote('code', judul);
            });
            $('.btnopenforme5').on('click', function (){
                var judul       = 'Drafting Surat Tugas';
                var jenissurat  = 'Tugas';
                var kelompok    = 'Suratkeluar';
                var petugas     = "{{Session('previlage')}}";
                $('.divawal').hide();
                $('.divsuratproses').show();
                $("#judul").html(judul);
                $("#jenissurat").val(jenissurat);
                $("#petugas").val(petugas);
                $("#kelompok").val(kelompok);
                $("#tugas_kepada").val('').select2().trigger('change');
                $('#tugas_tekskepada').summernote('code', '');
                $("#tugas_hiddenkepada").val('');
                openedpage();
            });
            $("#btnsimpansurattugas").click(function(){
                var set01	= document.getElementById('tugas_hiddenkepada').value;
                var set02=document.getElementById('tugas_judul').value;
                var set03=document.getElementById('tugas_mulai').value;
                var set04=document.getElementById('tugas_waktu').value;
                var set05=document.getElementById('tugas_tempat').value;
                var set06=$('#tugas_tekskepada').summernote('code');
                var set07=document.getElementById('tugas_pemeriksa').value;
                var set08=document.getElementById('tugas_penandatangan').value;
                var token=document.getElementById('token').value;
                if (i == 0 || set01 == '' || set02 == '' || set03 == '' || set04 == '' || set05 == '' || set06 == '' || set08 == ''){
                    swal({
                        title   : 'Perhatian',
                        text    : 'Semua Form (Kecuali Pemeriksa) Wajib di Isi',
                        type    : 'error',
                    })
                } else {
                    var kelompok    = document.getElementById('kelompok').value;
                    var jenissurat  = document.getElementById('jenissurat').value;
                    var petugas     = document.getElementById('petugas').value;
                    $('#loading').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    var formdata = new FormData();
                        formdata.append('masterkelompok', kelompok);
                        formdata.append('masterjenissurat', jenissurat);
                        formdata.append('masterpetugas', petugas);
                        formdata.append('set_kepada', set01);
                        formdata.append('val02', set02);
                        formdata.append('val03', set03);
                        formdata.append('val04', set04); 
                        formdata.append('val05', set05);
                        formdata.append('val06', set06);
                        formdata.append('val07', set07);
                        formdata.append('val08', set08);
                        formdata.append('_token', '{{csrf_token()}}');
                    $.ajax({
                        url	            : '{{ route("exSuratWithTemplate") }}',
                        data            : formdata,
                        type            : 'POST',
                        contentType     : false,
                        processData     : false,
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
                            $('#loading').hide();
                            $("#gridsuratkeluar").jqxGrid('updatebounddata', 'filter');
                            return false;
                        },
                        error: function (xhr, status, error) {
                            $('#loading').hide();
                            swal({
                                title	: 'Stop',
                                text	: xhr.responseText,
                                type	: 'error',
                            })
                        }
                    });
                }
            });
        //END_SURAT_TUGAS
        //START_SURAT_PEMBERITAHUAN
            $('.btnopenforme6').on('click', function (){
                $("#modalpilihan").modal('show');
            });
            $('#btnpilihpemberitahuanmutasi').on('click', function (){
                var judul       = 'Drafting Surat Pemberitahuan';
                var jenissurat  = 'Pemberitahuan Mutasi';
                var kelompok    = 'Suratkeluar';
                var petugas     = "{{Session('previlage')}}";
                $('.divawal').hide();
                $('.divsuratproses').show();
                $("#judul").html(judul);
                $("#jenissurat").val(jenissurat);
                $("#petugas").val(petugas);
                $("#kelompok").val(kelompok);
                $("#modalpilihan").modal('hide');
                openedpage();
            });
            $('#btnpilihpemberitahuansekre').on('click', function (){
                var judul       = 'Drafting Surat Pemberitahuan';
                var jenissurat  = 'Pemberitahuan Sekretaris';
                var kelompok    = 'Suratkeluar';
                var petugas     = "{{Session('previlage')}}";
                $('.divawal').hide();
                $('.divsuratproses').show();
                $("#judul").html(judul);
                $("#jenissurat").val(jenissurat);
                $("#petugas").val(petugas);
                $("#kelompok").val(kelompok);
                $("#modalpilihan").modal('hide');
                openedpage();
            });
            $('#btnpilihtidakmempanjangkontrak').on('click', function (){
                var judul       = 'Drafting Surat Pemberitahuan';
                var jenissurat  = 'Pemberitahuan Tidak Memperpanjang Kontrak';
                var kelompok    = 'Suratkeluar';
                var petugas     = "{{Session('previlage')}}";
                $('.divawal').hide();
                $('.divsuratproses').show();
                $("#judul").html(judul);
                $("#jenissurat").val(jenissurat);
                $("#petugas").val(petugas);
                $("#kelompok").val(kelompok);
                $("#modalpilihan").modal('hide');
                openedpage();
            });
            $("#btnsimpanpemberitahuanmutasi").click(function(){
                var set01	= $('#pemberitahuan_kepada').select2('data');
                var kepada 	= new Array();
                var keys = Object.keys(set01),
                    len = keys.length,
                    i = 0,
                    prop,
                    value;
                while (i < len) {
                    prop 	= keys[i];
                    value 	= set01[prop];
                    kepada.push({
                        "id" : value.id
                    });
                    i += 1;
                }
                var jsonkepada  = JSON.stringify(kepada);
                var set02	    = $('#pemberitahuan_pegawai').select2('data');
                var arrpeg 	    = new Array();
                var key         = Object.keys(set02),
                    len = key.length,
                    j = 0,
                    prop,
                    value;
                while (j < len) {
                    prop 	= key[j];
                    value 	= set02[prop];
                    arrpeg.push({
                        "id" : value.id
                    });
                    j += 1;
                }
                var jsonpegawai = JSON.stringify(arrpeg);
                var set03=$('#pemberitahuan_isi').summernote('code');
                var set04=document.getElementById('pemberitahuan_asal').value;
                var set05=document.getElementById('pemberitahuan_tujuan').value;
                var set06=document.getElementById('pemberitahuan_tanggal').value;
                var set07=document.getElementById('pemberitahuan_pemeriksa').value;
                var set08=document.getElementById('pemberitahuan_penandatangan').value;
                var token=document.getElementById('token').value;
                if (j == 0 || i == 0 || set01 == '' || set02 == '' || set03 == '' || set04 == '' || set05 == '' || set06 == '' || set08 == ''){
                    swal({
                        title   : 'Perhatian',
                        text    : 'Semua Form (Kecuali Pemeriksa) Wajib di Isi',
                        type    : 'error',
                    })
                } else {
                    var kelompok    = document.getElementById('kelompok').value;
                    var jenissurat  = document.getElementById('jenissurat').value;
                    var petugas     = document.getElementById('petugas').value;
                    $('#loading').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    var formdata = new FormData();
                        formdata.append('masterkelompok', kelompok);
                        formdata.append('masterjenissurat', jenissurat);
                        formdata.append('masterpetugas', petugas);
                        formdata.append('set_kepada[]', jsonkepada);
                        formdata.append('set_pegawai[]', jsonpegawai);
                        formdata.append('val03', set03);
                        formdata.append('val04', set04);
                        formdata.append('val05', set05);
                        formdata.append('val06', set06);
                        formdata.append('val07', set07);
                        formdata.append('val08', set08);
                        formdata.append('_token', '{{csrf_token()}}');
                    $.ajax({
                        url	            : '{{ route("exSuratWithTemplate") }}',
                        data            : formdata,
                        type            : 'POST',
                        contentType     : false,
                        processData     : false,
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
                            $('#loading').hide();
                            $("#gridsuratkeluar").jqxGrid('updatebounddata', 'filter');
                            return false;
                        },
                        error: function (xhr, status, error) {
                            $('#loading').hide();
                            swal({
                                title	: 'Stop',
                                text	: xhr.responseText,
                                type	: 'error',
                            })
                        }
                    });
                }
            });
            $("#btnsimpansurattdkmemperpanjangkontrak").click(function(){
                var set01=document.getElementById('tdkmemperpanjangkontrak_nama').value;
                var set02=document.getElementById('tdkmemperpanjangkontrak_ppabp').value;
                var set03=document.getElementById('tdkmemperpanjangkontrak_jabatan').value;
                var set04=document.getElementById('tdkmemperpanjangkontrak_tmtpensiun').value;
                var set05='-';
                var set06='-';
                var set07=document.getElementById('tdkmemperpanjangkontrak_pemeriksa').value;
                var set08=document.getElementById('tdkmemperpanjangkontrak_penandatangan').value;
                var token=document.getElementById('token').value;
                if (set01 == '' || set02 == '' || set03 == '' || set04 == '' || set05 == '' || set06 == '' || set08 == ''){
                    swal({
                        title   : 'Perhatian',
                        text    : 'Semua Form (Kecuali Pemeriksa) Wajib di Isi',
                        type    : 'error',
                    })
                } else {
                    var kelompok    = document.getElementById('kelompok').value;
                    var jenissurat  = document.getElementById('jenissurat').value;
                    var petugas     = document.getElementById('petugas').value;
                    $('#loading').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    var formdata = new FormData();
                        formdata.append('masterkelompok', kelompok);
                        formdata.append('masterjenissurat', jenissurat);
                        formdata.append('masterpetugas', petugas);
                        formdata.append('val01', set01);
                        formdata.append('val02', set02);
                        formdata.append('val03', set03);
                        formdata.append('val04', set04);
                        formdata.append('val05', set05);
                        formdata.append('val06', set06);
                        formdata.append('val07', set07);
                        formdata.append('val08', set08);
                        formdata.append('_token', '{{csrf_token()}}');
                    $.ajax({
                        url	            : '{{ route("exSuratWithTemplate") }}',
                        data            : formdata,
                        type            : 'POST',
                        contentType     : false,
                        processData     : false,
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
                            $('#loading').hide();
                            $("#gridsuratkeluar").jqxGrid('updatebounddata', 'filter');
                            return false;
                        },
                        error: function (xhr, status, error) {
                            $('#loading').hide();
                            swal({
                                title	: 'Stop',
                                text	: xhr.responseText,
                                type	: 'error',
                            })
                        }
                    });
                }
            });
        //END_SURAT_PEMBERITAHUAN
        //START_SURAT_TANGGAPAN_RESIGN
            $('.btnopenforme7').on('click', function (){
                var judul       = 'Drafting Surat Tanggapan Resign';
                var jenissurat  = 'Tanggapan Resign';
                var kelompok    = 'Suratkeluar';
                var petugas     = "{{Session('previlage')}}";
                $('.divawal').hide();
                $('.divsuratproses').show();
                $("#judul").html(judul);
                $("#jenissurat").val(jenissurat);
                $("#petugas").val(petugas);
                $("#kelompok").val(kelompok);
                openedpage();
            });
            $("#btnsimpansurattanggapanresign").click(function(){
                var set01=document.getElementById('tanggapanresign_nama').value;
                var set02=document.getElementById('tanggapanresign_ppabp').value;
                var set03=document.getElementById('tanggapanresign_jabatan').value;
                var set04=document.getElementById('tanggapanresign_tanggal').value;
                var set05=document.getElementById('tanggapanresign_tmtpensiun').value;
                var set06=document.getElementById('tanggapanresign_keputusan').value;
                var set07=document.getElementById('tanggapanresign_pemeriksa').value;
                var set08=document.getElementById('tanggapanresign_penandatangan').value;
                var token=document.getElementById('token').value;
                if (set01 == '' || set02 == '' || set03 == '' || set04 == '' || set05 == '' || set06 == '' || set08 == ''){
                    swal({
                        title   : 'Perhatian',
                        text    : 'Semua Form (Kecuali Pemeriksa) Wajib di Isi',
                        type    : 'error',
                    })
                } else {
                    var kelompok    = document.getElementById('kelompok').value;
                    var jenissurat  = document.getElementById('tanggapanresign_jenis').value;
                    var petugas     = document.getElementById('petugas').value;
                    $('#loading').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    var formdata = new FormData();
                        formdata.append('masterkelompok', kelompok);
                        formdata.append('masterjenissurat', jenissurat);
                        formdata.append('masterpetugas', petugas);
                        formdata.append('val01', set01);
                        formdata.append('val02', set02);
                        formdata.append('val03', set03);
                        formdata.append('val04', set04);
                        formdata.append('val05', set05);
                        formdata.append('val06', set06);
                        formdata.append('val07', set07);
                        formdata.append('val08', set08);
                        formdata.append('_token', '{{csrf_token()}}');
                    $.ajax({
                        url	            : '{{ route("exSuratWithTemplate") }}',
                        data            : formdata,
                        type            : 'POST',
                        contentType     : false,
                        processData     : false,
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
                            $('#loading').hide();
                            $("#gridsuratkeluar").jqxGrid('updatebounddata', 'filter');
                            return false;
                        },
                        error: function (xhr, status, error) {
                            $('#loading').hide();
                            swal({
                                title	: 'Stop',
                                text	: xhr.responseText,
                                type	: 'error',
                            })
                        }
                    });
                }
            });
        //END_SURAT_TANGGAPAN_RESIGN
        //START_SURAT_REFERENSI_KERJA
            $('.btnopenforme8').on('click', function (){
                var judul       = 'Drafting Surat Referensi Kerja';
                var jenissurat  = 'Referensi Kerja';
                var kelompok    = 'Suratkeluar';
                var petugas     = "{{Session('previlage')}}";
                $('.divawal').hide();
                $('.divsuratproses').show();
                $("#judul").html(judul);
                $("#jenissurat").val(jenissurat);
                $("#petugas").val(petugas);
                $("#kelompok").val(kelompok);
                openedpage();
            });
            $("#btnsimpansuratreferensi").click(function(){
                var set01=document.getElementById('referensi_nama').value;
                var set02 = $('#referensi_jabatan').summernote('code');
                var set03=document.getElementById('referensi_ppabp').value;
                var set04=document.getElementById('referensi_alamat').value;
                var set05=document.getElementById('referensi_mulai').value;
                var set06=document.getElementById('referensi_akhir').value;
                var set07=document.getElementById('referensi_pemeriksa').value;
                var set08=document.getElementById('referensi_penandatangan').value;
                var token=document.getElementById('token').value;
                if (set01 == '' || set02 == '' || set03 == '' || set04 == '' || set05 == '' || set06 == '' || set08 == ''){
                    swal({
                        title   : 'Perhatian',
                        text    : 'Semua Form (Kecuali Pemeriksa) Wajib di Isi',
                        type    : 'error',
                    })
                } else {
                    var kelompok    = document.getElementById('kelompok').value;
                    var jenissurat  = document.getElementById('jenissurat').value;
                    var petugas     = document.getElementById('petugas').value;
                    $('#loading').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    var formdata = new FormData();
                        formdata.append('masterkelompok', kelompok);
                        formdata.append('masterjenissurat', jenissurat);
                        formdata.append('masterpetugas', petugas);
                        formdata.append('val01', set01);
                        formdata.append('val02', set02);
                        formdata.append('val03', set03);
                        formdata.append('val04', set04);
                        formdata.append('val05', set05);
                        formdata.append('val06', set06);
                        formdata.append('val07', set07);
                        formdata.append('val08', set08);
                        formdata.append('_token', '{{csrf_token()}}');
                    $.ajax({
                        url	            : '{{ route("exSuratWithTemplate") }}',
                        data            : formdata,
                        type            : 'POST',
                        contentType     : false,
                        processData     : false,
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
                            $('#loading').hide();
                            $("#gridsuratkeluar").jqxGrid('updatebounddata', 'filter');
                            return false;
                        },
                        error: function (xhr, status, error) {
                            $('#loading').hide();
                            swal({
                                title	: 'Stop',
                                text	: xhr.responseText,
                                type	: 'error',
                            })
                        }
                    });
                }
            });
        //END_SURAT_REFERENSI_KERJA
        //START_KET_AKTIF_BEKERJA
            $('.btnopenforme9').on('click', function (){
                var judul       = 'Drafting Surat Keterangan Aktif Bekerja';
                var jenissurat  = 'Keterangan Aktif Bekerja';
                var kelompok    = 'Suratkeluar';
                var petugas     = "{{Session('previlage')}}";
                $('.divawal').hide();
                $('.divsuratproses').show();
                $("#judul").html(judul);
                $("#jenissurat").val(jenissurat);
                $("#petugas").val(petugas);
                $("#kelompok").val(kelompok);
                openedpage();
            });
            $("#btnsimpansuratbekerja").click(function(){
                var set01=document.getElementById('ketbekerja_nama').value;
                var set02=document.getElementById('ketbekerja_ppabp').value;
                var set03=document.getElementById('ketbekerja_jabatan').value;
                var set04=document.getElementById('ketbekerja_unitkerja').value;
                var set05=document.getElementById('ketbekerja_mulai').value;
                var set06='-';
                var set07=document.getElementById('ketbekerja_pemeriksa').value;
                var set08=document.getElementById('ketbekerja_penandatangan').value;
                var token=document.getElementById('token').value;
                if (set01 == '' || set02 == '' || set03 == '' || set04 == '' || set05 == '' || set06 == '' || set08 == ''){
                    swal({
                        title   : 'Perhatian',
                        text    : 'Semua Form (Kecuali Pemeriksa) Wajib di Isi',
                        type    : 'error',
                    })
                } else {
                    var kelompok    = document.getElementById('kelompok').value;
                    var jenissurat  = document.getElementById('jenissurat').value;
                    var petugas     = document.getElementById('petugas').value;
                    $('#loading').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    var formdata = new FormData();
                        formdata.append('masterkelompok', kelompok);
                        formdata.append('masterjenissurat', jenissurat);
                        formdata.append('masterpetugas', petugas);
                        formdata.append('val01', set01);
                        formdata.append('val02', set02);
                        formdata.append('val03', set03);
                        formdata.append('val04', set04);
                        formdata.append('val05', set05);
                        formdata.append('val06', set06);
                        formdata.append('val07', set07);
                        formdata.append('val08', set08);
                        formdata.append('_token', '{{csrf_token()}}');
                    $.ajax({
                        url	            : '{{ route("exSuratWithTemplate") }}',
                        data            : formdata,
                        type            : 'POST',
                        contentType     : false,
                        processData     : false,
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
                            $('#loading').hide();
                            $("#gridsuratkeluar").jqxGrid('updatebounddata', 'filter');
                            return false;
                        },
                        error: function (xhr, status, error) {
                            $('#loading').hide();
                            swal({
                                title	: 'Stop',
                                text	: xhr.responseText,
                                type	: 'error',
                            })
                        }
                    });
                }
            });
        //END_KET_AKTIF_BEKERJA
        //START_PEMANGGILAN_KARYAWAN
            $('.btnopenforme11').on('click', function (){
                var judul       = 'Drafting Surat Pemanggilan Calon Karyawan';
                var jenissurat  = 'Pemanggilan Calon Karyawan';
                var kelompok    = 'Suratkeluar';
                var petugas     = "{{Session('previlage')}}";
                if (jenissurat == 'Pemanggilan Calon Karyawan'){
                    swal({
                        title   : 'Perhatian',
                        text    : 'Pembuatan Surat '+jenissurat+', digabung di Menu Rekrutmen',
                        type    : 'error',
                    })
                } else {
                    $('.divawal').hide();
                    $('.divsuratproses').show();
                    $("#judul").html(judul);
                    $("#jenissurat").val(jenissurat);
                    $("#petugas").val(petugas);
                    $("#kelompok").val(kelompok);
                    openedpage();
                }
            });
            $('.btnopenforme12').on('click', function (){
                var judul       = 'Drafting Surat Pemberitahuan Lolos Seleksi';
                var jenissurat  = 'Pemberitahuan Lolos Seleksi';
                var kelompok    = 'Suratkeluar';
                var petugas     = "{{Session('previlage')}}";
                if (jenissurat == 'Pemberitahuan Lolos Seleksi'){
                    swal({
                        title   : 'Perhatian',
                        text    : 'Pembuatan Surat '+jenissurat+', digabung di Menu Rekrutmen',
                        type    : 'error',
                    })
                } else {
                    $('.divawal').hide();
                    $('.divsuratproses').show();
                    $("#judul").html(judul);
                    $("#jenissurat").val(jenissurat);
                    $("#petugas").val(petugas);
                    $("#kelompok").val(kelompok);
                    openedpage();
                }
            });
            $('.btnopenforme13').on('click', function (){
                var judul       = 'Drafting Surat Pemberitahuan MCU';
                var jenissurat  = 'Pemberitahuan MCU';
                var kelompok    = 'Suratkeluar';
                var petugas     = "{{Session('previlage')}}";
                if (jenissurat == 'Pemberitahuan MCU'){
                    swal({
                        title   : 'Perhatian',
                        text    : 'Pembuatan Surat '+jenissurat+', digabung di Menu Rekrutmen',
                        type    : 'error',
                    })
                } else {
                    $('.divawal').hide();
                    $('.divsuratproses').show();
                    $("#judul").html(judul);
                    $("#jenissurat").val(jenissurat);
                    $("#petugas").val(petugas);
                    $("#kelompok").val(kelompok);
                    openedpage();
                }
            });
        //END_PEMANGGILAN_KARYAWAN
        //START_UNDANGAN
            $('.btnopenforme14').on('click', function (){
                var judul       = 'Drafting Surat Undangan';
                var jenissurat  = 'Undangan';
                var kelompok    = 'Suratkeluar';
                var petugas     = "{{Session('previlage')}}";
                $('.divawal').hide();
                $('.divsuratproses').show();
                $("#judul").html(judul);
                $("#jenissurat").val(jenissurat);
                $("#petugas").val(petugas);
                $("#kelompok").val(kelompok);
                openedpage();
            });
            $("#btnsimpansuratundangan").click(function(){
                var set01	= $('#undangan_kepada').select2('data');
                var kepada 	= new Array();
                var keys = Object.keys(set01),
                    len = keys.length,
                    i = 0,
                    prop,
                    value;
                while (i < len) {
                    prop 	= keys[i];
                    value 	= set01[prop];
                    kepada.push({
                        "id" : value.id
                    });
                    i += 1;
                }
                var jsonkepada = JSON.stringify(kepada);
                var set02=document.getElementById('undangan_judul').value;
                var set03=document.getElementById('undangan_mulai').value;
                var set04=document.getElementById('undangan_waktu').value;
                var set05=document.getElementById('undangan_tempat').value;
                var set06=document.getElementById('undangan_kepada2').value;
                var set07=document.getElementById('undangan_pemeriksa').value;
                var set08=document.getElementById('undangan_penandatangan').value;
                var token=document.getElementById('token').value;
                if (i == 0 || set01 == '' || set02 == '' || set03 == '' || set04 == '' || set05 == '' || set06 == '' || set08 == ''){
                    swal({
                        title   : 'Perhatian',
                        text    : 'Semua Form (Kecuali Pemeriksa) Wajib di Isi',
                        type    : 'error',
                    })
                } else {
                    var kelompok    = document.getElementById('kelompok').value;
                    var jenissurat  = document.getElementById('jenissurat').value;
                    var petugas     = document.getElementById('petugas').value;
                    $('#loading').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    var formdata = new FormData();
                        formdata.append('masterkelompok', kelompok);
                        formdata.append('masterjenissurat', jenissurat);
                        formdata.append('masterpetugas', petugas);
                        formdata.append('set_kepada[]', jsonkepada);
                        formdata.append('val02', set02);
                        formdata.append('val03', set03);
                        formdata.append('val04', set04);
                        formdata.append('val05', set05);
                        formdata.append('val06', set06);
                        formdata.append('val07', set07);
                        formdata.append('val08', set08);
                        formdata.append('_token', '{{csrf_token()}}');
                    $.ajax({
                        url	            : '{{ route("exSuratWithTemplate") }}',
                        data            : formdata,
                        type            : 'POST',
                        contentType     : false,
                        processData     : false,
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
                            $('#loading').hide();
                            $("#gridsuratkeluar").jqxGrid('updatebounddata', 'filter');
                            return false;
                        },
                        error: function (xhr, status, error) {
                            $('#loading').hide();
                            swal({
                                title	: 'Stop',
                                text	: xhr.responseText,
                                type	: 'error',
                            })
                        }
                    });
                }
            });
        //END_UNDANGAN
        //START_UNDANGAN_KIE
            $('.btnopenforme15').on('click', function (){
                var judul       = 'Drafting Surat Pemanggilan KIE Staf';
                var jenissurat  = 'Pemanggilan KIE Staf';
                var kelompok    = 'Suratkeluar';
                var petugas     = "{{Session('previlage')}}";
                $('.divawal').hide();
                $('.divsuratproses').show();
                $("#judul").html(judul);
                $("#jenissurat").val(jenissurat);
                $("#petugas").val(petugas);
                $("#kelompok").val(kelompok);
                openedpage();
                $('#panggilankie_idne').val('new');
            });
            $("#btnsimpanpanggilankie").click(function(){
                var set01=document.getElementById('panggilankie_nama').value;
                var set02=document.getElementById('panggilankie_mulai').value;
                var set03=document.getElementById('panggilankie_waktu').value;
                var set04=document.getElementById('panggilankie_tempat').value;
                var set05=CKEDITOR.instances['panggilankie_hasil'].getData()
                var set06=document.getElementById('panggilankie_idne').value;
                var set07=document.getElementById('panggilankie_pemeriksa').value;
                var set08=document.getElementById('panggilankie_penandatangan').value;
                var token=document.getElementById('token').value;
                if (set01 == '' || set02 == '' || set03 == '' || set04 == '' || set05 == '' || set06 == '' || set08 == ''){
                    swal({
                        title   : 'Perhatian',
                        text    : 'Semua Form (Kecuali Pemeriksa) Wajib di Isi',
                        type    : 'error',
                    })
                } else {
                    var kelompok    = document.getElementById('kelompok').value;
                    var jenissurat  = document.getElementById('jenissurat').value;
                    var petugas     = document.getElementById('petugas').value;
                    $('#loading').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    var formdata = new FormData();
                        formdata.append('masterkelompok', kelompok);
                        formdata.append('masterjenissurat', jenissurat);
                        formdata.append('masterpetugas', petugas);
                        formdata.append('val01', set01);
                        formdata.append('val02', set02);
                        formdata.append('val03', set03);
                        formdata.append('val04', set04);
                        formdata.append('val05', set05);
                        formdata.append('val06', set06);
                        formdata.append('val07', set07);
                        formdata.append('val08', set08);
                        formdata.append('_token', '{{csrf_token()}}');
                    $.ajax({
                        url	            : '{{ route("exSuratWithTemplate") }}',
                        data            : formdata,
                        type            : 'POST',
                        contentType     : false,
                        processData     : false,
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
                            $('#loading').hide();
                            $("#gridsuratkeluar").jqxGrid('updatebounddata', 'filter');
                            $('#panggilankie_idne').val('new');
                            return false;
                        },
                        error: function (xhr, status, error) {
                            $('#loading').hide();
                            swal({
                                title	: 'Stop',
                                text	: xhr.responseText,
                                type	: 'error',
                            })
                        }
                    });
                }
            });
        //END_UNDANGAN_KIE
        //START_KET_TIDAK_BEKERJA
            $('.btnopenforme16').on('click', function (){
                var judul       = 'Drafting Surat Keterangan Tidak Bekerja';
                var jenissurat  = 'Keterangan Tidak Bekerja';
                var kelompok    = 'Suratkeluar';
                var petugas     = "{{Session('previlage')}}";
                $('.divawal').hide();
                $('.divsuratproses').show();
                $("#judul").html(judul);
                $("#jenissurat").val(jenissurat);
                $("#petugas").val(petugas);
                $("#kelompok").val(kelompok);
                openedpage();
            });
            $("#btnsimpansurattidakbekerja").click(function(){
                var set01=document.getElementById('tidakbekerja_nama').value;
                var set02=document.getElementById('tidakbekerja_unitkerja').value;
                var set03=document.getElementById('tidakbekerja_jabatan').value;
                var set04=document.getElementById('tidakbekerja_mulai').value;
                var set05='-';
                var set06='-';
                var set07=document.getElementById('tidakbekerja_pemeriksa').value;
                var set08=document.getElementById('tidakbekerja_penandatangan').value;
                var token=document.getElementById('token').value;
                if (set01 == '' || set02 == '' || set03 == '' || set04 == '' || set05 == '' || set06 == '' || set08 == ''){
                    swal({
                        title   : 'Perhatian',
                        text    : 'Semua Form (Kecuali Pemeriksa) Wajib di Isi',
                        type    : 'error',
                    })
                } else {
                    var kelompok    = document.getElementById('kelompok').value;
                    var jenissurat  = document.getElementById('jenissurat').value;
                    var petugas     = document.getElementById('petugas').value;
                    $('#loading').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    var formdata = new FormData();
                        formdata.append('masterkelompok', kelompok);
                        formdata.append('masterjenissurat', jenissurat);
                        formdata.append('masterpetugas', petugas);
                        formdata.append('val01', set01);
                        formdata.append('val02', set02);
                        formdata.append('val03', set03);
                        formdata.append('val04', set04);
                        formdata.append('val05', set05);
                        formdata.append('val06', set06);
                        formdata.append('val07', set07);
                        formdata.append('val08', set08);
                        formdata.append('_token', '{{csrf_token()}}');
                    $.ajax({
                        url	            : '{{ route("exSuratWithTemplate") }}',
                        data            : formdata,
                        type            : 'POST',
                        contentType     : false,
                        processData     : false,
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
                            $('#loading').hide();
                            $("#gridsuratkeluar").jqxGrid('updatebounddata', 'filter');
                            return false;
                        },
                        error: function (xhr, status, error) {
                            $('#loading').hide();
                            swal({
                                title	: 'Stop',
                                text	: xhr.responseText,
                                type	: 'error',
                            })
                        }
                    });
                }
            });
        //END_KET_TIDAK_BEKERJA
    //END_KUMPULAN_SURAT_SURAT
    $('.btnkembali').on('click', function (){
        $('.divawal').show();
        $('.divsuratproses').hide();
        $('#divtambahpenerima').hide();
        $('#sisikiri').hide();
        $('#sisikanan').removeClass('col-md-8').addClass('col-md-12');
        var jenissurat=document.getElementById('jenissurat').value;
        if (jenissurat == 'Cuti Tahunan'){
            $('.btnopenforma1').click();
        } else if (jenissurat == 'Cuti Keagamaan'){
            $('.btnopenforma2').click();
        } else if (jenissurat == 'Ijin Pulang Cepat'){
            $('.btnopenforma3').click();
        } else if (jenissurat == 'Ijin Keluar Kantor'){
            $('.btnopenforma4').click();
        } else if (jenissurat == 'Permintaan Pegawai'){
            $('.btnopenforma5').click();
        } else if (jenissurat == 'Mutasi Rotasi'){
            $('.btnopenforma6').click();
        } else if (jenissurat == 'Komunikasi'){
            $('.btnopenforma7').click();
        } else if (jenissurat == 'Pengangkatan Jabatan'){
            $('.btnopenformb1').click();
        } else if (jenissurat == 'Pemberhentian Jabatan'){
            $('.btnopenformb2').click();
        } else if (jenissurat == 'Pegawai Tetap'){
            $('.btnopenformb3').click();
        } else if (jenissurat == 'Dokter Tetap'){
            $('.btnopenformb4').click();
        } else if (jenissurat == 'Penerimaan Staf'){
            $('.btnopenformb5').click();
        } else if (jenissurat == 'Penonaktifan Staf'){
            $('.btnopenformb6').click();
        } else if (jenissurat == 'Pengaktifan Staf'){
            $('.btnopenformb7').click();
        } else if (jenissurat == 'Mutasi'){
            $('.btnopenformb8').click();
        } else if (jenissurat == 'Penonaktifan Dokter Tetap'){
            $('.btnopenformb9').click();
        } else if (jenissurat == 'Pemutusan Hubungan Kerja'){
            $('.btnopenformb10').click();
        } else if (jenissurat == 'Perjanjian Orientasi Kerja'){
            $('.btnopenformc1').click();
        } else if (jenissurat == 'PKWT'){
            $('.btnopenformc2').click();
        } else if (jenissurat == 'PKWTT'){
            $('.btnopenformc3').click();
        } else if (jenissurat == 'SPO'){
            $('.btnopenformd1').click();
        } else if (jenissurat == 'Edaran'){
            $('.btnopenforme1').click();
        } else if (jenissurat == 'Peringatan'){
            $('.btnopenforme2').click();
        } else if (jenissurat == 'Balasan Penambahan Staf'){
            $('.btnopenforme3').click();
        } else if (jenissurat == 'Permohonan'){
            $('.btnopenforme4').click();
        } else if (jenissurat == 'Tugas'){
            $('.btnopenforme5').click();
        } else if (jenissurat == 'Pemberitahuan Mutasi'){
            $('#btnpilihpemberitahuanmutasi').click();
        } else if (jenissurat == 'Pemberitahuan Tidak Memperpanjang Kontrak'){
            $('#btnpilihtidakmempanjangkontrak').click();
        } else if (jenissurat == 'Tanggapan Resign'){
            $('.btnopenforme7').click();
        } else if (jenissurat == 'Referensi Kerja'){
            $('.btnopenforme8').click();
        } else if (jenissurat == 'Keterangan Aktif Bekerja'){
            $('.btnopenforme9').click();
        } else if (jenissurat == 'Pemanggilan Calon Karyawan'){
            $('.btnopenforme11').click();
        } else if (jenissurat == 'Pemberitahuan Lolos Seleksi'){
            $('.btnopenforme12').click();
        } else if (jenissurat == 'Pemberitahuan MCU'){
            $('.btnopenforme13').click();
        } else if (jenissurat == 'Undangan'){
            $('.btnopenforme14').click();
        } else if (jenissurat == 'Pemanggilan KIE Staf'){
            $('.btnopenforme15').click();
        } else if (jenissurat == 'Keterangan Tidak Bekerja'){
            $('.btnopenforme16').click();
        } else {
        }
        
        $("html, body").animate({ scrollTop: 0 }, "slow");
        getnotifcount();
	});
    //START_TEMPLATE
    $('#templatekiri').hide();
    $("#btnpagebreak").click(function(){
        var val01='new';
        var val02=document.getElementById('templateedit_nama').value;
        var val03='';
        var val04='0';
        var val06='-pagebreak-';
        var val07=document.getElementById('templateedit_baris').value;
        var val08='';
        var val09='';
        var token=document.getElementById('token').value;
        if (val02 == 'new' && val06 == ''){
            swal({
                title	: 'Stop',
                text	: 'Lengkapi Form Anda',
                type	: 'warning',
            })
        } else {
            $('#loading').show();
            $("#modalsettingtemplate").modal('hide');
            $.post('{{ route("exsettingkepeg") }}', { set01: val01, set02: val02, set03: val03, set04: val04, set05: 'skdirektur', set06: val06, set07: val07, set08: val08, set09: val09, _token: token },
            function(data){
                var paginginformation = $("#gridtemplate").jqxGrid('getpaginginformation');
                var PageNumber = paginginformation.pagenum;
                $("#gridtemplate").jqxGrid('updatebounddata');
                $("#gridtemplate").jqxGrid('gotopage', PageNumber);
                $.toast({
                    heading     : data.status,
                    text        : data.message,
                    position    : 'top-right',
                    loaderBg    : data.warna,
                    icon        : data.icon,
                    hideAfter   : 5000,
                    stack       : 1
                });
                $('#loading').hide();
                return false;
            });
        }
    });
    $("#btnspasi").click(function(){
        var val01='new';
        var val02=document.getElementById('templateedit_nama').value;
        var val03='';
        var val04='0';
        var val06='-space-';
        var val07=document.getElementById('templateedit_baris').value;
        var val08='';
        var val09='';
        var token=document.getElementById('token').value;
        if (val02 == 'new' && val06 == ''){
            swal({
                title	: 'Stop',
                text	: 'Lengkapi Form Anda',
                type	: 'warning',
            })
        } else {
            $('#loading').show();
            $("#modalsettingtemplate").modal('hide');
            $.post('{{ route("exsettingkepeg") }}', { set01: val01, set02: val02, set03: val03, set04: val04, set05: 'skdirektur', set06: val06, set07: val07, set08: val08, set09: val09, _token: token },
            function(data){
                var paginginformation = $("#gridtemplate").jqxGrid('getpaginginformation');
                var PageNumber = paginginformation.pagenum;
                $("#gridtemplate").jqxGrid('updatebounddata');
                $("#gridtemplate").jqxGrid('gotopage', PageNumber);
                $.toast({
                    heading     : data.status,
                    text        : data.message,
                    position    : 'top-right',
                    loaderBg    : data.warna,
                    icon        : data.icon,
                    hideAfter   : 5000,
                    stack       : 1
                });
                $('#loading').hide();
                return false;
            });
        }
    });
    $("#btnsimpandrattemplate").click(function(){
        var val01=document.getElementById('templateedit_idne').value;
        var val02=document.getElementById('templateedit_nama').value;
        var val03=document.getElementById('templateedit_letter').value;
        var val04=document.getElementById('templateedit_posisi').value;
        var val06=document.getElementById('templateedit_text').value;
        var val07=document.getElementById('templateedit_baris').value;
        var val08=document.getElementById('templateedit_menimbang').value;
        var val09=document.getElementById('templateedit_mengingat').value;
        var token=document.getElementById('token').value;
        if (val02 == 'new' && val06 == ''){
            swal({
                title	: 'Stop',
                text	: 'Lengkapi Form Anda',
                type	: 'warning',
            })
        } else {
            $('#loading').show();
            $("#modalsettingtemplate").modal('hide');
            $.post('{{ route("exsettingkepeg") }}', { set01: val01, set02: val02, set03: val03, set04: val04, set05: 'skdirektur', set06: val06, set07: val07, set08: val08, set09: val09, _token: token },
            function(data){
                var paginginformation = $("#gridtemplate").jqxGrid('getpaginginformation');
                var PageNumber = paginginformation.pagenum;
                $("#gridtemplate").jqxGrid('updatebounddata');
                $("#gridtemplate").jqxGrid('gotopage', PageNumber);
                $.toast({
                    heading     : data.status,
                    text        : data.message,
                    position    : 'top-right',
                    loaderBg    : data.warna,
                    icon        : data.icon,
                    hideAfter   : 5000,
                    stack       : 1
                });
                $('#loading').hide();
                return false;
            });
        }
    });
    $("#btnviewtemplatesk").click(function(){
        var set01 		= document.getElementById('template_nama').value;
        var token 		= document.getElementById('token').value;
        if (set01 == ''){
            swal({
                title	: 'Stop',
                text	: 'Pilih Template Terlebih Dahulu',
                type	: 'warning',
            })
        } else {
            var set01 		= document.getElementById('template_nama').value;
            var source = {
                datatype: "json",
                datafields: [
                    { name: 'id'},
                    { name: 'posisi', type: 'text'},
                    { name: 'urutan', type: 'text'},
                    { name: 'leter', type: 'text'},
                    { name: 'namask', type: 'text'},
                    { name: 'inputor', type: 'text'},
                    { name: 'judul', type: 'text'},
                    { name: 'menimbang', type: 'text'},
                    { name: 'mengingat', type: 'text'},
                    { name: 'menetapkan', type: 'text'},
                    { name: 'memutuskan', type: 'text'},
                    { name: 'tembusan', type: 'text'},
                    { name: 'fakultas', type: 'text'},
                ],
                type    : 'POST',
                data    : {jenis: set01, _token: token},
                url     : '{{ route("tblsettingdokar") }}',
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#gridtemplate").jqxGrid({
                width               : '100%',
                height              : '600',
                pageable            : true,
                filterable          : true,
                columnsresize       : true,
                autoshowfiltericon  : true,
                autorowheight       : true,
                autoheight          : true,
                theme               : "energyblue",
                source              : dataAdapter,
                columns: [
                    { text: 'ROW', datafield: 'urutan', width: '5%', cellsalign: 'center', align: 'center'  },
                    { text: 'TAB01', datafield: 'menimbang', width: '5%', cellsalign: 'left', align: 'center'  },
                    { text: 'TAB02', datafield: 'mengingat', width: '5%', cellsalign: 'left', align: 'center'  },
                    { text: 'TAB03', datafield: 'menetapkan', width: '5%', cellsalign: 'left', align: 'center'  },
                    { text: 'Text', datafield: 'judul', width: '72%', cellsalign: 'left', align: 'center'  },
                    { text: 'Ubah', columntype: 'button', width: '8%', align: 'center', cellsrenderer: function () {
                        return "Ubah";
                            }, buttonclick: function (row) {
                            editrow = row;	
                            var offset 		= $("#gridtemplate").offset();
                            var dataRecord 	= $("#gridtemplate").jqxGrid('getrowdata', editrow);
                            $("#templateedit_baris").val(dataRecord.urutan);
                            $("#templateedit_nama").val(dataRecord.namask);
                            $("#templateedit_idne").val(dataRecord.id);
                            $("#templateedit_letter").val(dataRecord.leter);
                            $("#templateedit_posisi").val(dataRecord.posisi);
                            $("#templateedit_mengingat").val(dataRecord.mengingat);
                            $("#templateedit_menimbang").val(dataRecord.menimbang);
                            $("#templateedit_text").val(dataRecord.judul);
                            $("#modalsettingtemplate").modal('show');
                        }
                    },
                ]
            });
        }
    });
    $("#btntambahdatatemplate").click(function(){
        var set01 		= document.getElementById('template_nama').value;
        if (set01 == ''){
            swal({
                title	: 'Stop',
                text	: 'Pilih Template Terlebih Dahulu',
                type	: 'warning',
            })
        } else {
            $("#modalsettingtemplate").modal('show');
            $("#templateedit_nama").val(set01);
            $("#templateedit_idne").val('new');
        }
    });
    $("#btncanceledittemplate").click(function(){
        $('#templatekanan').removeClass('col-md-6').addClass('col-md-12');
        $("#templatekiri").hide();
        $("#gridtemplate").jqxGrid('updatebounddata');
    });
    $("#btnsimulasitemplatesk").click(function(){
        var set01 = document.getElementById('template_nama').value;
        var token = document.getElementById('token').value;
        $.post('surat/viewsuratkeluar', { val01: set01, val02: 'SIMULASISK', _token: token },
        function(data){
            var newWindow 	= window.open('', '', 'width=800, height=500'),
            document = newWindow.document.open(),
                    pageContent =
                        '<!DOCTYPE html>\n' +
                        '<html>\n' +
                        '<head>\n' +
                        '<meta charset="utf-8" />\n' +
                        '<title>Preview Surat</title>\n' +
                        '</head>\n' +
                        '<body>'+data+'</body>\n</html>';
            document.write(pageContent);
            document.close();
        });
    });
});
</script>
@endpush