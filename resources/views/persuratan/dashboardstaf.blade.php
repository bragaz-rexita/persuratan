@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Dasboard</h1>
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
					<div id="loading">
						<img width="50%" src="{{ asset('dist/img/loading.gif') }}" alt="Loading On Duidev">
					</div>
                    <div id="divkalender">
                        <div class="card card-success direct-chat direct-chat-warning shadow">
                            <div id='calendar'></div>
                        </div>
                    </div>
                    <div id="divdisposisi">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Mailbox</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool btnkembali">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-footer divisidisposisi">
                                <input type="hidden" id="buka_idne" name="buka_idne">
								<input type="hidden" id="buka_kelompok" name="buka_kelompok">
								<label id="judulloading"></label>
								<div id="pdfRenderer"></div>
                            </div>
							<div class="card-body divisidisposisi">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3">
                                            <label for="buka_noagenda">No.Agenda</label>
                                            <input type="text" class="form-control" id="buka_noagenda" name="buka_noagenda" disabled="disable">
                                        </div>
                                        <div class="col-lg-9 col-md-9">
                                            <label for="buka_perihal">Perihal</label>
                                            <input type="text" class="form-control" id="buka_perihal" name="buka_perihal" disabled="disable">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea id="buka_disposisi" name="buka_disposisi" rows="10" cols="80" disabled="disable"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Catatan</label>
                                    <textarea id="buka_catatan" name="buka_catatan" rows="10" cols="80"></textarea>
                                </div>
								<div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4">
											<button type="button" class="btn btn-danger" id="btnkembalikedispo">Kembali</button>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
											<button type="button" class="btn btn-success" id="btnsimpancatatn">SIMPAN CATATAN</button>
								        </div>
                                    </div>
                                </div>
                            </div>
                            
							<div class="card-footer divawaldisposisi">
								<div class="row divgridsendiri">
									<div class="col-lg-4">
										<div class="form-group">
                                            <button type="button" class="btn btn-danger" id="btnopenmailarsip">
                                                <i class="fa fa-envelope-open"></i> Open Arsip
                                            </button>
										</div>
									</div>
									<div class="col-lg-8">
										<div class="small-box bg-blue">
											<div class="inner">
												<div class="form-group">
                                                    <label for="r_jenis">Pencarian Surat Berdasarkan.?</label>
                                                    <div class="row">
                                                        <div class="col-lg-5">
                                                            <input type="text" class="form-control" id="r_value" placeholder="Ketik Value Pencarian">
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <select id="r_jenis" class="form-control">
                                                                <option value="agenda">Cari Berdasarkan No. Agenda</option>
                                                                <option value="nomer">Cari Berdasarkan No. Surat</option>
                                                                <option value="tglmasuk">Cari Berdasarkan TGL. Masuk</option>
                                                                <option value="tglsurat">Cari Berdasarkan TGL. Surat</option>
                                                                <option value="perihal">Cari Berdasarkan Perihal</option>
                                                                <option value="ringkasan">Cari Berdasarkan Disposisi</option>
                                                                <option value="pengirim">Cari Berdasarkan Pengirim</option>
                                                                <option value="tahun">Cari Berdasarkan Tahun</option>
                                                                <option value="internal">Open Mail From Internal</option>
                                                                <option value="external">Open Mail From Internal</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <button class="btn btn-success" id="btnviewcustommailbox">Cari</button>
                                                        </div>
                                                    </div>
												</div>	
											</div>
										</div>
									</div>
								</div>
								<div class="form-group divgridsendiri">
                                    <div class="form-group">
										<h5>Disposisi Masuk</h5>
										<div id="gridsendiri"></div>
									</div>
									<div class="form-group">
										<h5>Directly Send</h5>
										<div id="gridsendiripenerimasurat"></div>
									</div>
                                </div>
								<div class="row divgridsendiricari">
									<div class="col-lg-4">
										<button type="button" class="btn btn-danger" id="btntutupgridsendiricari">
											<i class="fa fa-close"></i>
										</button>
									</div>
									<div class="col-lg-8">
									
									</div>
								</div>
                            	<div class="form-group divgridsendiricari">
									<label id="judulloadingcari"></label>
									<div id="pdfRenderercari"></div>
                                </div>
								<div class="form-group divgridsendiricari">
									<div id="gridsendiricari"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="divsuratkeluar">
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Surat Keluar</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool btnkembali">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
								<div class="form-group">
									<div class="row">
										<div class="col-md-3">
											<a href="#" id="btntambahnomormaju" class="btn btn-block btn-primary">
												<i class="fa fa-paper-plane-o"></i> Tambah Nomor Maju
											</a>
										</div>
										<div class="col-md-6">
											<div id="message"></div>
										</div>
									</div>
								</div>
                            </div>
                            <div class="card-footer">
								<div id="gridsuratkeluar"></div>
                            </div>
                        </div>
					</div>
                    <div id="divinputsuratkeluarmaju">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Permohonan Nomor Baru</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool btnkembali">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
								<div class="form-group">
									<label for="nom_ubahnama">Pemohon</label>
									<input type="text" class="form-control" id="nom_ubahnama" name="nom_ubahnama" value="{!! Session('nama') !!}" readonly />
								</div>
								<div class="form-group">
									<label for="nom_kelompok">Unit Pemohon</label>
									<input type="text" class="form-control" id="nom_kelompok" name="nom_kelompok" value="{{ Session('previlage') }}" readonly />
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3">
											<label for="nom_jumlah">Jumlah Nomor.? *)</label>
											<input type="number" class="form-control" id="nom_jumlah" name="nom_jumlah" value="1" readonly />
										</div>
										<div class="col-lg-3">
											<label for="nom_jenissrt">Jenis Surat</label>
											<select id="nom_jenissrt" name="nom_jenissrt" size="1" class="form-control">
												<option value="BIASA">Surat Biasa (TTD)</option>
												<option value="Nota Dinas">Nota Dinas (TTD)</option>
												<option value="UPLOAD">Surat dengan TTE</option>
												<option value="UPLQRMAN">Surat dengan Tanda Tangan Elektronik (Dengan QrCode Manual)</option>
												<option value="SERTIFIKATTTE">Sertifikat dengan TTE</option>
											</select>	
										</div>
										<div class="col-lg-6">
											<label for="nom_kodepjbt">Penandatangan</label>
											<select id="nom_kodepjbt" name="nom_kodepjbt" size="1" class="form-control">
												<option value="">Pilih Salah Satu</option>
													@foreach($pejabats as $rpejabats)
														<option value="{{ $rpejabats['kode'] }}">{{ $rpejabats['pejabat'] }}</option>
													@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="nom_perihal">Perihal</label>
									<input type="text" class="form-control" id="nom_perihal" name="nom_perihal" value="">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3 col-md-3">
											<label for="nom_sifat">Urgensi</label>
											<select id="nom_sifat" name="nom_sifat" size="1" class="form-control">
												<option value="4">Biasa</option>
												<option value="3">Segera</option>
												<option value="2">Sangat Segera</option>
												<option value="1">Kilat</option>
												<option value="5">Lainnya</option>
											</select>
										</div>
										<div class="col-lg-3 col-md-3">
											<label for="nom_klasifikasi">Klasifikasi</label>
											<select id="nom_klasifikasi" name="nom_klasifikasi" size="1" class="form-control">
												<option value="Biasa">Biasa</option>
												<option value="Rahasia">Rahasia</option>
												<option value="Sangat Rahasia">Sangat Rahasia</option>
												<option value="Terbatas">Terbatas</option>
												<option value="Lainnya">Lainnya</option>
											</select>
										</div>
										<div class="col-lg-6 col-md-6">
											<label>Klasifikasi Arsip *)</label>
											<input type="text" class="form-control" placeholder="Klik Tombol Cari" id="nom_klasifikasiarsip" name="nom_klasifikasiarsip">
										</div>
									</div>
								</div>
                            </div>
                            <div class="card-footer">
								<input type="hidden"  id="nom_nama" name="nom_nama" value="{{ Session('email') }}">
								<button type="button" class="btn btn-danger pull-left btnkembali">Cancel</button>
								<button type="button" class="btn btn-success pull-right" id="btngetnomor">Simpan</button>
                            </div>
                        </div>
                    </div>
                    <div id="divtambahpenerima">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Kirim Surat</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool btnkembalikelamansuratkeluar">
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
											<select id="kirim_idpeserta" size="1" class="form-control select2">
												<option value="">Pilih Penerima</option>
												@foreach($arrallpeg as $rows)
													<option value="{{$rows->id}}">{!! $rows->nama_lengkap !!} ( {!! $rows->jabatan !!} - {!! $rows->unit !!} )</option>
												@endforeach
											</select>
										</div>
										<div class="col-md-2">
											<div class="btn btn-primary" id="btnkirimsurat">
												<i class="fa fa-user-plus"></i>
											</div>
										</div>
										<div class="col-md-2">
											<input type="hidden" id="kirim_id" name="kirim_id" class="form-control">
											<input type="hidden" id="kirim_kelompok" name="kirim_kelompok" class="form-control">
											<div class="btn btn-danger btn-lg btnkembalikelamansuratkeluar">
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
                    <div id="divkegiatan">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Event Organizer</h3>
                                <div class="card-tools">
                                	<button class="btn btn-tool" id="btntambahdatakegiatan"><i class="fa fa-plus"></i> Tambah Kegiatan / Event</button>
						            <button type="button" class="btn btn-tool btnkembali"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
							<div class="card-body divtambahkegiatan">
								<div class="form-group">
									<label for="id_namaefent">Nama Event</label>
									<input type="text" id="id_namaefent" name="id_namaefent" class="form-control">
								</div>
								<div class="form-group">
									<label for="id_tempat">Tempat</label>
									<input type="text" id="id_tempat" name="id_tempat" class="form-control">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-lg-6">
											<label for="id_kapasitas">Batas Peserta (0 For Unlimit)</label>
											<input type="text" id="id_kapasitas" value="0" class="form-control">
										</div>
										<div class="col-lg-6">
											<label for="id_biaya">Biaya (0 For Free)</label>
											<input type="text" id="id_biaya" value="0" class="form-control">
										</div>
									</div>
								</div>
								<p>Rentang Pelaksanaan Event</p>
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3">
											<label for="id_tglmulaiefent">Tgl. Mulai</label>
											<input type="text" id="id_tglmulaiefent" name="id_tglmulaiefent" class="form-control"  data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
										</div>
										<div class="col-lg-3">
											<label for="id_jammulaiefent">Jam Mulai</label>
											<input type="text" id="id_jammulaiefent" name="id_jammulaiefent" class="form-control timepicker">
										</div>
										<div class="col-lg-3">
											<label for="id_tglselesaiefent">Tgl. Selesai</label>
											<input type="text" id="id_tglselesaiefent" name="id_tglselesaiefent" class="form-control"  data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
										</div>
										<div class="col-lg-3">
											<label for="id_jamselesaiefent">Jam Selesai</label>
											<input type="text" id="id_jamselesaiefent" name="id_jamselesaiefent" class="form-control timepicker">
										</div>
									</div>
								</div>
								<p>Rentang dibuka pendaftaran peserta</p>
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3">
											<label for="id_tglmulaidaftar">Tgl. Mulai</label>
											<input type="text" id="id_tglmulaidaftar" name="id_tglmulaidaftar" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
										</div>
										<div class="col-lg-3">
											<label for="id_jammulaidaftar">Jam Mulai</label>
											<input type="text" id="id_jammulaidaftar" name="id_jammulaidaftar" class="form-control timepicker">
										</div>
										<div class="col-lg-3">
											<label for="id_tglselesaidaftar">Tgl. Selesai</label>
											<input type="text" id="id_tglselesaidaftar" name="id_tglselesaidaftar" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
										</div>
										<div class="col-lg-3">
											<label for="id_jamselesaidaftar">Jam Selesai</label>
											<input type="text" id="id_jamselesaidaftar" name="id_jamselesaidaftar" class="form-control timepicker">
										</div>
									</div>
								</div>
								<p>Rentang dibuka presensi peserta</p>
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3">
											<label for="id_tglmulaiabsen">Tgl. Mulai</label>
											<input type="text" id="id_tglmulaiabsen" name="id_tglmulaiabsen" class="form-control"  data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
										</div>
										<div class="col-lg-3">
											<label for="id_jammulaiabsen">Jam Mulai</label>
											<input type="text" id="id_jammulaiabsen" name="id_jammulaiabsen" class="form-control timepicker">
										</div>
										<div class="col-lg-3">
											<label for="id_tglselesaiabsen">Tgl. Selesai</label>
											<input type="text" id="id_tglselesaiabsen" name="id_tglselesaiabsen" class="form-control"  data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
										</div>
										<div class="col-lg-3">
											<label for="id_jamselesaiabsen">Jam Selesai</label>
											<input type="text" id="id_jamselesaiabsen" name="id_jamselesaiabsen" class="form-control timepicker">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="id_kontak">Kontak / PJ Event</label>
									<textarea id="id_kontak" name="id_kontak" style="width: 100%; height: 100px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd;"></textarea>
								</div>
								<div class="form-group">
									<label for="id_pembicara">Pembicara / Narasumber</label>
									<textarea id="id_pembicara" name="id_pembicara" style="width: 100%; height: 100px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd;"></textarea>
								</div>
								<div class="form-group">
									<label for="id_linkwebinar">Link Webinar dan Password</label>
									<textarea id="id_linkwebinar" name="id_linkwebinar" style="width: 100%; height: 100px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd;"></textarea>
								</div>
								<div class="form-group">
									<label for="id_linkmateri">Pemimpin Rapat</label>
									<input type="text" id="id_linkmateri" name="id_linkmateri" class="form-control">
								</div>
                            </div>
							<div class="card-footer divtambahkegiatan">
								<div class="row">
									<div class="col-lg-6">
										<a href="#" class="btn btn-block btn-danger" id="btnklosetambahbaru">
											<i class="fa fa-arrow-left"></i><span class="pull-right">Cancel</span>
										</a>
									</div>
									<div class="col-lg-6">
										<a href="#" class="btn btn-block btn-success" id="btnsimpan">
											<i class="fa fa-calendar-check-o"></i><span class="pull-right">Save Event</span>
										</a>
									</div>
								</div>
                            </div>
							<div class="card-body divdetailkegiatan">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-2">
											<a href="#" class="btn btn-block btn-info" id="downexcell">
												<i class="fa fa-file-excel-o"></i><span class="pull-right">Export</span>
											</a>
										</div>								
									</div>
								</div>
                            </div>
							<div class="card-footer divdetailkegiatan">
                                <div id="grideventdetail"></div>
                            </div>
							<div class="card-body divawalnotulensi">
								<div class="callout callout-info">
									<h5><i class="fa fa-info"></i> Untuk Membuat Notulensi Terdapat 2 Form. Form Pertama Melekat pada Form Daftar Hadir Kehadiran; Sedangkan Form Kedua dengan Click Tombol Notulensi pada Kegiatan Yang Telah dibuat dan Bapak/Ibu Termasuk dalam Daftar Hadir / Daftar Undangan.</h5>
								</div>
                            </div>
							<div class="card-body divawalnotulensi" id="divisinotulensi">
								<div class="card card-widget widget-user-2">
									<div class="widget-user-header bg-success">
										<div class="widget-user-image">
											@if (Session('avatar') != '')
											<img class="img-circle elevation-2" src="{!! Session('avatar') !!}" alt="User Avatar">
											@else 
											<img class="img-circle elevation-2" src="{{ asset('mascot.png') }}" alt="User Avatar">
											@endif
										</div>
										<h3 class="widget-user-username" id="judulnotulensi">{{Session('nama')}}</h3>
										<h5 class="widget-user-desc" id="subjudulnotulensi">{{Session('fakpanjang')}}</h5>
									</div>
								</div>
								
								<div class="form-group"> 
									<textarea id="notulensi_isi" name="notulensi_isi" style="width: 100%; height: 480px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
								</div>
								<p>Bukti Dukung Berupa Foto Kegiatan</p>
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
								<p>Form di Bawah ini Diisi apabila ingin di tandatangani secara elektronik</p>
								<div class="form-group">
									<label for="notulensi_namapenandatangan">Pemimpin Rapat:</label>
									<select id="notulensi_namapenandatangan" name="notulensi_namapenandatangan" size="1" class="form-control select2">
										<option value="">Pilih Salah Satu</option>
										@foreach($pejabats as $rpejabats)
											<option value="{{ $rpejabats['id'] }}">{{ $rpejabats['pejabat'] }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-lg-6 col-md-6">
											<label for="notulensi_paraf1">Notulis Oleh:</label>
											<input type="text" class="form-control" id="notulensi_paraf1" name="notulensi_paraf1" value="{{ Session('nama') }}" readonly>
										</div>
										<div class="col-lg-6 col-md-6">
											<label for="notulensi_paraf2">Mengetahui Oleh:</label>
											<select id="notulensi_paraf2" name="notulensi_paraf2" size="1" class="form-control select2">
												<option value="">Pilih Salah Satu</option>
												@foreach($pejabats as $rpejabats)
													<option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-lg-4">
											<a href="#" class="btn btn-block btn-danger" id="btnklosetambahnotulensi">
												<i class="fa fa-arrow-left"></i><span class="pull-right">Cancel</span>
											</a>
										</div>
                                        <div class="col-lg-4">
                                            <input type="hidden" id="notulensi_idevent" name="notulensi_idevent" />
											<a href="#" class="btn btn-block btn-warning" id="btnnotulensimodelkomitemedik">
												<i class="fa fa-star"></i> Mode Komite Medik <i class="fa fa-star"></i>
											</a>
										</div>
										<div class="col-lg-4">
											<input type="hidden" id="notulensi_idne" name="notulensi_idne" />
											<a href="#" class="btn btn-block btn-success" id="btnsimpannotulensi">
												<i class="fa fa-calendar-check-o"></i><span class="pull-right">Simpan</span>
											</a>
										</div>
									</div>
								</div>
                            </div>
							<div class="card-footer divawalnotulensi">
								<div id="gridnotulensi"></div>
                            </div>
                            <div class="card-footer divawalkegiatan">
                                <div id="gridevent"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3" id="divtiga">
                    <div class="card card-widget widget-user">
                        <div class="widget-user-header bg-info">
                            <h3 class="widget-user-username">Menu Utama</h3>
							<div class="card-tools">
                                <button type="button" class="btn btn-tool" id="btntutuptiga">
                                    <i class="fa fa-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="widget-user-image">
							<img class="img-circle elevation-2" src="{{ asset('dist/img/wasimonghead.png') }}" alt="CV Swandhana">
                        </div>
                        <div class="card-footer">
							<ul class="nav nav-pills flex-column">
								<li class="nav-item"><a href="#" class="nav-link btnopenmailbox"><i class="fa fa-book"></i> Mailbox<span class="badge badge-primary float-right countmailbox">0</span></a></li>
								<li class="nav-item"><a href="#" class="nav-link btnopensuratkeluar"><i class="fa fa-calendar-plus-o"></i> Permohonan Nomor<span class="badge badge-primary float-right countsuratkeluar">0</span></a></li>
								<li class="nav-item"><a href="#" class="nav-link btnopendatanotulensi"><i class="fa fa-edit"></i> Notulensi<span class="badge badge-primary float-right countnotulensi">0</span></a></li>
							</ul>
                        </div>
                    </div>
                    <div class="card card-warning direct-chat direct-chat-warning shadow">
                        <div class="card-header">
                            <h3 class="card-title">Kopi Darat</h3>
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
    <div class="form-group">
        <label>Lampiran</label>
        <input type="file" id="filelampiran" name="filelampiran" class="btn-light">
    </div>
</div>
<div class="modal fade" id="modalsendwa">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title">Modal Send Email/WA</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</div>
		<div class="modal-body">
			<div class="form-group">
				<label class="col-form-label">Email<span class="text-danger">*</span></label>
				<input type="text" class="form-control" id="send_email" name="send_email">
			</div>
			<div class="form-group">
				<label class="col-form-label">Phone (Use +62 Format)</label>
				<input type="text" class="form-control" id="send_hp" name="send_hp">
			</div>			
		</div>
		<div class="modal-footer justify-content-between">
        	<input type="hidden" class="form-control" id="send_idne" name="send_idne">
			<button type="button" class="btn btn-warning pull-right" id="btnsendeditemail">Send</button>
			<button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Close</button>	
		</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="mjenis" id="mjenis" value="Ruang">
<input type="hidden" name="mlokasi" id="mlokasi" value="All">
<input type="hidden" name="mnama" id="mnama" value="All">
<input type="hidden" name="mmulai" id="mmulai" value="now">
<input type="hidden" name="makhir" id="makhir" value="now">
<input type="hidden" name="makhir" id="makhir" value="now">
<input type="hidden" name="mnama" id="mnama" value="{{ Session('email') }}">
<input type="hidden" name="set_idevent" id="set_idevent" value="0">
@endsection
@push('script')
<script>
    $(function () {
		CKEDITOR.env.isCompatible = true;
		CKEDITOR.replace( 'buka_catatan', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90	
		});
		CKEDITOR.replace( 'buka_disposisi', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90	
		});
        CKEDITOR.replace( 'notulensi_isi' );
	});
	function openedpage( jQuery ){
		var sourcekalender = {
            datatype: "json",
            datafields: [
                { name: 'id', type: 'string' },
                { name: 'description', type: 'string' },
                { name: 'location', type: 'string' },
                { name: 'subject', type: 'string' },
                { name: 'calendar', type: 'string' },
                { name: 'start', type: 'date', format: "yyyy-mm-dd HH:ii:ss" },
                { name: 'end', type: 'date', format: "yyyy-mm-dd HH:ii:ss" }
            ],
            id	: 'id',
            type: 'POST',
            data: {val01:'{{Session("previlage")}}', val02:'all', val03: '', val04: '', _token: '{{ csrf_token() }}'},
            url	: '{{ route("getkalenderlist") }}'
        };      
        var datajsonawal = new $.jqx.dataAdapter(sourcekalender);
        $("#calendar").jqxScheduler({
            date			: new $.jqx.date('todayDate'),
            width			: '100%',
            height			: 600,
            source			: datajsonawal,
            showLegend		: true,
            dayNameFormat	: "abbr",
            view			: 'agendaView',
            ready: function () {
                $("#calendar").jqxScheduler('ensureAppointmentVisible', 'id1');
            },
            resources:
            {
                colorScheme	: "scheme05",
                orientation	: "vertical",
                dataField	: "calendar",
                source		:  new $.jqx.dataAdapter(sourcekalender)
            },
            appointmentDataFields:
            {
                from		: "start",
                to			: "end",
                id			: "id",
                description	: "description",
                location	: "place",
                subject		: "subject",
                resourceId	: "calendar",
                readOnly	: "readOnly",
                style		: "style",
                status		: "status",
                tooltip		: "tooltip",
                timeZone	: "UTC+07:00"
            },
            views	:
            [
                { type: "agendaView", timeRuler :
                    {
                        formatString : "HH:mm",
                        timeZones  :  [{ id: "UTC+07:00", text: "UTC+07:00" }],
                    }
                }
            ]
        });
		var token=document.getElementById('token').value;
		$.post('surat/chatgetlist', { _token: token},
		function(data){
			$('#chatbody').html(data);
		});
	}
    function openmailbox( jQuery ){
		var set01=document.getElementById('r_value').value;
        var set02=document.getElementById('r_jenis').value;
        var sumberdisposisisendiricari = {
			datatype: "json",
			datafields: [
				{ name: 'id'},
				{ name: 'marking'},
				{ name: 'pengirim', type: 'text'},
				{ name: 'penerima', type: 'text'},
				{ name: 'email', type: 'text'},
				{ name: 'status', type: 'text'},
				{ name: 'sifat', type: 'text'},
				{ name: 'idsurat', type: 'text'},
				{ name: 'noagenda', type: 'text'},
				{ name: 'tglsurat', type: 'text'},
				{ name: 'jenissrt', type: 'text'},
				{ name: 'nosurat', type: 'text'},
				{ name: 'kepada', type: 'text'},
				{ name: 'perihal', type: 'text'},
				{ name: 'footnote', type: 'text'},
				{ name: 'asalsurat', type: 'text'},
				{ name: 'kelompok', type: 'text'},
				{ name: 'created_at', type: 'text'},
			],
			updaterow: function (rowid, rowdata, commit) {commit(true);},
			data		: {dari:set01, jenis:set02, _token: '{{ csrf_token() }}'},
			url			: '{{ route("inboxUserpaginated") }}',
			root		: 'data',
			totalrecords: 'total',
			cache		: false,
			filter		: function () {
				$("#gridsendiri").jqxGrid('updatebounddata', 'filter');
			},
			sort: function () {
				$("#gridsendiri").jqxGrid('updatebounddata', 'sort');
			},
			beforeprocessing: function (data) {
				if (data != null) {
					sumberdisposisisendiricari.totalrecords = data.total;
				}
			}
		};
		var datajMailCari 		= new $.jqx.dataAdapter(sumberdisposisisendiricari);
		var filerendercari 		= function (row, column, value) {
			var nosurat 		= $('#gridsendiri').jqxGrid('getrowdata', row).nosurat;
			var pengirim 		= $('#gridsendiri').jqxGrid('getrowdata', row).pengirim;
			var footnote 		= $('#gridsendiri').jqxGrid('getrowdata', row).footnote;
			var perihal 		= $('#gridsendiri').jqxGrid('getrowdata', row).perihal;
			var noagenda 		= $('#gridsendiri').jqxGrid('getrowdata', row).noagenda;
			var created_at 		= $('#gridsendiri').jqxGrid('getrowdata', row).created_at;
			var linkbukti 		= '<div style="background: white;"><table width="100%"><tr><td width="20%">No. Agenda / No. Surat</td><td width="5%">:</td><td width="75%"><span class="badge badge-primary">'+noagenda+'</span> / '+nosurat+'</td></tr><tr><td>Tanggal Masuk</td><td>:</td><td>'+created_at+'</td></tr><tr><td>Dari</td><td>:</td><td>'+pengirim+'</td></tr><tr><td>Perihal</td><td>:</td><td>'+perihal+'</td></tr><tr><td>Disposisi</td><td>:</td><td>'+footnote+'</td></tr></div>';
			return linkbukti;
		}
		$("#gridsendiri").jqxGrid({
			width			: '100%',
			filterable		: true,
			sortable		: true,
			autorowheight	: true,
			autoheight		: true,
			source			: datajMailCari,
			virtualmode		: true,
			pageable		: true,
			rendergridrows	: function(obj) {
				return obj.data;
			},
			columnsresize	: true,
			theme			: "energyblue",
			rowsheight      : 100,
			selectionmode	: 'multiplecellsextended',
			columns			: [
				{ text: 'Surat', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
					return "Preview";
					}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridsendiri").offset();		
						var dataRecord 	= $("#gridsendiri").jqxGrid('getrowdata', editrow);
						var valid		= dataRecord.id;
						var noagenda	= dataRecord.noagenda;
						var kelompok	= dataRecord.kelompok;
						var perihal		= dataRecord.perihal;
						var disposisi	= dataRecord.footnote;
						var idsurat		= dataRecord.idsurat;
						$("#buka_kepada").val('');
						$("#buka_sifatdiposisi").val('Biasa');
						$("#buka_idne").val(valid);
						$("#buka_kelompok").val(kelompok);
						$("#buka_noagenda").val(noagenda);
						$("#buka_perihal").val(perihal);
						CKEDITOR.instances['buka_disposisi'].setData(disposisi)
						CKEDITOR.instances['buka_catatan'].setData('')
						$("#filelampiran").val('');
						$('.divisidisposisi').show();
						$('.divawaldisposisi').hide();
						$('#loadingimage').show();
						$('#judulloading').html('Trying Loading File From URL : <a href="'+idsurat+'" target="_blank">'+idsurat+'</a><br />If This Process Longer than usually, please use download button instead');
						var iframe = '<iframe src="'+idsurat+'" width="100%" height="780" style="border: none;" id="document-preview"></iframe>';
						$('#pdfRenderer').html(iframe);
						$("html, body").animate({ scrollTop: 0 }, "slow");
					}
				},
				{ text: 'Identitas Surat', cellsrenderer: filerendercari, width: '95%', cellsalign: 'left', align: 'center'  },
			],
		});
		var sumberdisposisisendiri = {
			datatype: "json",
			datafields: [
				{ name: 'id'},
				{ name: 'marking'},
				{ name: 'pengirim', type: 'text'},
				{ name: 'penerima', type: 'text'},
				{ name: 'email', type: 'text'},
				{ name: 'status', type: 'text'},
				{ name: 'sifat', type: 'text'},
				{ name: 'idsurat', type: 'text'},
				{ name: 'noagenda', type: 'text'},
				{ name: 'tglsurat', type: 'text'},
				{ name: 'jenissrt', type: 'text'},
				{ name: 'nosurat', type: 'text'},
				{ name: 'kepada', type: 'text'},
				{ name: 'perihal', type: 'text'},
				{ name: 'footnote', type: 'text'},
				{ name: 'asalsurat', type: 'text'},
				{ name: 'kelompok', type: 'text'},
				{ name: 'created_at', type: 'text'},
			],
			updaterow: function (rowid, rowdata, commit) {commit(true);},
			data		: {dari:set01, jenis:'penerimasurat', _token: '{{ csrf_token() }}'},
			url			: '{{ route("inboxUserpaginated") }}',
			root		: 'data',
			totalrecords: 'total',
			cache		: false,
			filter		: function () {
				$("#gridsendiripenerimasurat").jqxGrid('updatebounddata', 'filter');
			},
			sort: function () {
				$("#gridsendiripenerimasurat").jqxGrid('updatebounddata', 'sort');
			},
			beforeprocessing: function (data) {
				if (data != null) {
					sumberdisposisisendiri.totalrecords = data.total;
				}
			}
		};
		var datajMailSendiri 	= new $.jqx.dataAdapter(sumberdisposisisendiri);
		var filerendersurat 	= function (row, column, value) {
			var nosurat 		= $('#gridsendiripenerimasurat').jqxGrid('getrowdata', row).nosurat;
			var pengirim 		= $('#gridsendiripenerimasurat').jqxGrid('getrowdata', row).pengirim;
			var footnote 		= $('#gridsendiripenerimasurat').jqxGrid('getrowdata', row).footnote;
			var perihal 		= $('#gridsendiripenerimasurat').jqxGrid('getrowdata', row).perihal;
			var noagenda 		= $('#gridsendiripenerimasurat').jqxGrid('getrowdata', row).noagenda;
			var created_at 		= $('#gridsendiripenerimasurat').jqxGrid('getrowdata', row).created_at;
			var linkbukti 		= '<div style="background: white;"><table width="100%"><tr><td width="20%">No. Agenda / No. Surat</td><td width="5%">:</td><td width="75%"><span class="badge badge-primary">'+noagenda+'</span> / '+nosurat+'</td></tr><tr><td>Tanggal Masuk</td><td>:</td><td>'+created_at+'</td></tr><tr><td>Dari</td><td>:</td><td>'+pengirim+'</td></tr><tr><td>Perihal</td><td>:</td><td>'+perihal+'</td></tr><tr><td>Disposisi</td><td>:</td><td>'+footnote+'</td></tr></div>';
			return linkbukti;
		}
		$("#gridsendiripenerimasurat").jqxGrid({
			width			: '100%',
			filterable		: true,
			sortable		: true,
			autorowheight	: true,
			autoheight		: true,
			source			: datajMailSendiri,
			virtualmode		: true,
			pageable		: true,
			rendergridrows	: function(obj) {
				return obj.data;
			},
			columnsresize	: true,
			theme			: "energyblue",
			rowsheight      : 100,
			selectionmode	: 'multiplecellsextended',
			columns			: [
				{ text: 'Surat', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
					return "Preview";
					}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridsendiripenerimasurat").offset();		
						var dataRecord 	= $("#gridsendiripenerimasurat").jqxGrid('getrowdata', editrow);
						var valid		= dataRecord.id;
						var noagenda	= dataRecord.noagenda;
						var kelompok	= dataRecord.kelompok;
						var perihal		= dataRecord.perihal;
						var disposisi	= dataRecord.footnote;
						var idsurat		= dataRecord.idsurat;
						$("#buka_kepada").val('');
						$("#buka_sifatdiposisi").val('Biasa');
						$("#buka_idne").val(valid);
						$("#buka_kelompok").val(kelompok);
						$("#buka_noagenda").val(noagenda);
						$("#buka_perihal").val(perihal);
						CKEDITOR.instances['buka_disposisi'].setData(disposisi)
						CKEDITOR.instances['buka_catatan'].setData('')
						$("#filelampiran").val('');
						$('.divisidisposisi').show();
						$('.divawaldisposisi').hide();
						$('#loadingimage').show();
						$('#judulloading').html('Trying Loading File From URL : <a href="'+idsurat+'" target="_blank">'+idsurat+'</a><br />If This Process Longer than usually, please use download button instead');
						var iframe = '<iframe src="'+idsurat+'" width="100%" height="780" style="border: none;" id="document-preview"></iframe>';
						$('#pdfRenderer').html(iframe);
						$("html, body").animate({ scrollTop: 0 }, "slow");
					}
				},
				{ text: 'Identitas Surat', cellsrenderer: filerendersurat, width: '95%', cellsalign: 'left', align: 'center'  },
			],
		});
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
				openedpage();
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
    openedpage();
	$('.select2').select2({width: '100%'});
    $('#loading').hide();
	$('#divdisposisi').hide();
    $('#divkalender').show();
    $('#divinputsuratkeluarmaju').hide();
    $('#divtambahpenerima').hide();
    $('#divuploadersurat').hide();
    $('#divsuratkeluar').hide();
    $('#divkegiatan').hide();
    $('#btnkirimpesan').on('click', function (){
        $('#btnkirimpesan').hide();
        var kirim=document.getElementById('kirimpsn').value;
        var nama='';
        var foto='';
        $.post('{{ route("cattingSurat") }}', { val01: kirim, val02: nama, val03: foto, _token: '{{ csrf_token() }}' },
        function(data){
            $('#btnkirimpesan').show();
            $('#chatbody').html(data);
        });
    });
    $('#btntutuptiga').click(function () {
        $('#divtiga').hide();
        $('#divsembilan').removeClass('col-lg-9').addClass('col-lg-12');
    });
    $('.btnkembali').click(function () {
        $('#loading').hide();
        $('#divdisposisi').hide();
        $('#divkalender').show();
        $('#divinputsuratkeluarmaju').hide();
        $('#divtambahpenerima').hide();
        $('#divuploadersurat').hide();
        $('#divsuratkeluar').hide();
    });
    $('.btnopenmailbox').click(function () {
        $('.divgridsendiricari').hide();
        $('.divgridsendiri').show();
        $('#divkalender').hide();
        $('#divkegiatan').hide();
        $('#divtambahpenerima').hide();
        $('#divskdanperaturan').hide();
        $('#loading').hide();
        $('#divsuratmasuk').hide();
        $('#divsuratkeluar').hide();
        $('#divdirisendiri').hide();
        $('#divinputsuratmasuk').hide();
        $('#divinputsuratkeluarmaju').hide();
        $('#divinputsuratkeluarmundur').hide();
        $('#divuploadersurat').hide();
        $('#divdisposisi').show();
        $('.divisidisposisi').hide();
        $('.divawaldisposisi').show();
        openmailbox();
    });
    $('#btntutupgridsendiricari').click(function () {
        $('.divgridsendiricari').hide();
        $('.divgridsendiri').show();
    });
    $("#btnopenmailarsip").click(function(){
        $("#judulloadingcari").html('');
        $("#pdfRenderercari").html('');
        $('.divgridsendiri').hide();
        $('.divgridsendiricari').show();
        var sumbersuratmasukcari = {
            datatype: "json",
            datafields: [
                { name: 'id'},
                { name: 'idmarking'},
                { name: 'tanggal', type: 'text'},
                { name: 'nosurat', type: 'text'},
                { name: 'asalsurat', type: 'text'},
                { name: 'perihal', type: 'text'},
                { name: 'ringkasan', type: 'text'},
                { name: 'scansurat', type: 'text'},
                { name: 'klasifikasi', type: 'text'},
                { name: 'jenis', type: 'text'},
                { name: 'kerja', type: 'text'},
                { name: 'pengirim', type: 'text'},
                { name: 'penerima', type: 'text'},
                { name: 'marking', type: 'text'},
                { name: 'tglsurat', type: 'text'},
                { name: 'kepada', type: 'text'},
                { name: 'jenisurat', type: 'text'},
                { name: 'lampiran', type: 'text'},
                { name: 'sifat', type: 'text'},
                { name: 'tlssifat', type: 'text'},
                { name: 'bentuk', type: 'text'},
                { name: 'pembuat', type: 'text'},
                { name: 'status', type: 'text'},
                { name: 'noagenda', type: 'text'},
                { name: 'tglmasuk', type: 'text'},
                { name: 'subyek', type: 'text'},
                { name: 'tlsagenda', type: 'text'},
                { name: 'tlsnosurat', type: 'text'},
                { name: 'tlspengirim', type: 'text'},
                { name: 'tlspenerima', type: 'text'},
                { name: 'tlsperihal', type: 'text'},
                { name: 'tlswaktu', type: 'text'},
                { name: 'tlsringkasan', type: 'text'},
                { name: 'tulistatus', type: 'text'},
                { name: 'nmfile', type: 'text'},
                { name: 'faskode', type: 'text'},
                { name: 'subkode', type: 'text'},
            ],
            data		: {dari:'', jenis:'arsip', surat:'KELUAR', _token: '{{ csrf_token() }}'},
            type		: 'POST',
            url			: '{{ route("inboxSuratmasukPaged") }}',
            root		: 'data',
            totalrecords: 'total',
            cache		: false,
            filter		: function () {
                $("#tabelcari").jqxGrid('updatebounddata', 'filter');
            },
            sort: function () {
                $("#tabelcari").jqxGrid('updatebounddata', 'sort');
            },
            beforeprocessing: function (data) {
                if (data != null) {
                    sumbersuratmasukcari.totalrecords = data.total;
                }
            }
        };
        var datajsrtmasukcari = new $.jqx.dataAdapter(sumbersuratmasukcari);
        var rendergridrows = $('#gridsendiricari').jqxGrid('rendergridrows');
        $("#gridsendiricari").jqxGrid({
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
            source			: datajsrtmasukcari,
            pagesizeoptions	: ['10', '20'],
            theme			: "energyblue",
            altrows			: true,
            columns			: [
                { text: 'Surat', editable: false, sortable: false, filterable: false, columntype: 'button', width: 70, cellsrenderer: function () {
                    return "Preview";
                    }, buttonclick: function (row) {
                        editrow = row;	
                        var offset 		= $("#gridsendiricari").offset();		
                        var dataRecord 	= $("#gridsendiricari").jqxGrid('getrowdata', editrow);
                        var set03		= '{{URL::to("/")}}/viewsurat/7a07275b47504815818abc970da769fc-'+dataRecord.id;
                        $('#judulloadingcari').html('Trying Loading File From URL : <a href="'+set03+'" target="_blank">'+set03+'</a><br />If This Process Longer than usually, please use download button instead');
                        var iframe = '<iframe src="'+set03+'" width="100%" height="780" style="border: none;" id="document-preview"></iframe>';
                        $('#pdfRenderercari').html(iframe);
                        $("html, body").animate({ scrollTop: 100 }, "slow");
                    }
                },
                { text: 'No.Surat', datafield: 'nosurat', width: 180, cellsalign: 'left', align: 'center'  },
                { text: 'Asal Surat', datafield: 'asalsurat', width: 200, cellsalign: 'left', align: 'center'  },
                { text: 'Perihal', datafield: 'perihal', width: 250, cellsalign: 'left', align: 'center'  },
                { text: 'Agenda', datafield: 'noagenda', width: 80, cellsalign: 'center', align: 'center'  },
                { text: 'Tgl.Masuk', datafield: 'tglmasuk', width: 90, cellsalign: 'center', align: 'center'  },
                { text: 'Tgl.Surat', datafield: 'tglsurat', width: 90, cellsalign: 'center', align: 'center'  },
                { text: 'Undo', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', align: 'center', cellsrenderer: function () {
                    return "Undo";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var offset 		= $("#gridsendiricari").offset();
                        var dataRecord 	= $("#gridsendiricari").jqxGrid('getrowdata', editrow);
                        swal({
                            title: 'Apakah Anda Yakin.?',
                            text: "Surat Ini akan kami kembalikan ke tabel diatas untuk disposisi ulang. Apakah Anda Yakin.?",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonClass: 'btn btn-confirm mt-2',
                            cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                            confirmButtonText: 'Yes!'
                        }).then(function () {
                            var set01		= dataRecord.id;
                            $.post('{{ route("deletesrtmasuk") }}', { val01: set01, val02: 'undo', _token: '{{ csrf_token() }}' }, function(data){					
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
                                $('.divgridsendiri').show();
                                $('.divgridsendiricari').hide();
                                $("#gridsendiri").jqxGrid('updatebounddata', 'filter');
                                return false;
                            });
                        });
                    }
                },
            ],
        });
    });
    $('#btnviewcustommailbox').click(function () {
        var set01=document.getElementById('r_value').value;
        var set02=document.getElementById('r_jenis').value;
        if (set01 == ''){
            $('.divgridsendiricari').hide();
            $('.divgridsendiri').show();
            $("#gridsendiri").jqxGrid('updatebounddata', 'filter');
        } else {
            $('.divgridsendiricari').show();
            $('.divgridsendiri').hide();
            var sumberdisposisisendiricari = {
                datatype: "json",
                datafields: [
                    { name: 'id'},
                    { name: 'marking'},
                    { name: 'pengirim', type: 'text'},
                    { name: 'penerima', type: 'text'},
                    { name: 'email', type: 'text'},
                    { name: 'status', type: 'text'},
                    { name: 'sifat', type: 'text'},
                    { name: 'idsurat', type: 'text'},
                    { name: 'noagenda', type: 'text'},
                    { name: 'tglsurat', type: 'text'},
                    { name: 'jenissrt', type: 'text'},
                    { name: 'nosurat', type: 'text'},
                    { name: 'kepada', type: 'text'},
                    { name: 'perihal', type: 'text'},
                    { name: 'footnote', type: 'text'},
                    { name: 'asalsurat', type: 'text'},
                    { name: 'kelompok', type: 'text'},
                    { name: 'created_at', type: 'text'},
                ],
                updaterow: function (rowid, rowdata, commit) {commit(true);},
                data		: {dari:set01, jenis:set02, _token: '{{ csrf_token() }}'},
                url			: '{{ route("inboxUserpaginated") }}',
                root		: 'data',
                totalrecords: 'total',
                cache		: false,
                filter		: function () {
                    $("#gridsendiricari").jqxGrid('updatebounddata', 'filter');
                },
                sort: function () {
                    $("#gridsendiricari").jqxGrid('updatebounddata', 'sort');
                },
                beforeprocessing: function (data) {
                    if (data != null) {
                        sumberdisposisisendiricari.totalrecords = data.total;
                    }
                }
            };
            var datajMailCari 		= new $.jqx.dataAdapter(sumberdisposisisendiricari);
            var filerendercari 		= function (row, column, value) {
                var nosurat 		= $('#gridsendiricari').jqxGrid('getrowdata', row).nosurat;
                var pengirim 		= $('#gridsendiricari').jqxGrid('getrowdata', row).pengirim;
                var footnote 		= $('#gridsendiricari').jqxGrid('getrowdata', row).footnote;
                var perihal 		= $('#gridsendiricari').jqxGrid('getrowdata', row).perihal;
                var noagenda 		= $('#gridsendiricari').jqxGrid('getrowdata', row).noagenda;
                var created_at 		= $('#gridsendiricari').jqxGrid('getrowdata', row).created_at;
                var linkbukti 		= '<div style="background: white;"><table width="100%"><tr><td width="20%">No. Agenda / No. Surat</td><td width="5%">:</td><td width="75%"><span class="badge badge-primary">'+noagenda+'</span> / '+nosurat+'</td></tr><tr><td>Tanggal Masuk</td><td>:</td><td>'+created_at+'</td></tr><tr><td>Dari</td><td>:</td><td>'+pengirim+'</td></tr><tr><td>Perihal</td><td>:</td><td>'+perihal+'</td></tr><tr><td>Disposisi</td><td>:</td><td>'+footnote+'</td></tr></div>';
                return linkbukti;
            }
            $("#gridsendiricari").jqxGrid({
                width			: '100%',
                filterable		: true,
                sortable		: true,
                autorowheight	: true,
                autoheight		: true,
                source			: datajMailCari,
                virtualmode		: true,
                pageable		: true,
                rendergridrows	: function(obj) {
                    return obj.data;
                },
                columnsresize	: true,
                theme			: "energyblue",
                rowsheight      : 100,
                selectionmode	: 'multiplecellsextended',
                columns			: [
                    { text: 'Surat', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
                        return "Preview";
                        }, buttonclick: function (row) {
                            editrow = row;	
                            var offset 		= $("#gridsendiricari").offset();		
                            var dataRecord 	= $("#gridsendiricari").jqxGrid('getrowdata', editrow);
                            var valid		= dataRecord.id;
                            var noagenda	= dataRecord.noagenda;
                            var kelompok	= dataRecord.kelompok;
                            var perihal		= dataRecord.perihal;
                            var disposisi	= dataRecord.footnote;
                            var idsurat		= dataRecord.idsurat;
                            $("#buka_kepada").val('');
                            $("#buka_sifatdiposisi").val('Biasa');
                            $("#buka_idne").val(valid);
                            $("#buka_kelompok").val(kelompok);
                            $("#buka_noagenda").val(noagenda);
                            $("#buka_perihal").val(perihal);
                            CKEDITOR.instances['buka_disposisi'].setData(disposisi)
                            CKEDITOR.instances['buka_catatan'].setData('')
                            $("#filelampiran").val('');
                            $('.divisidisposisi').show();
                            $('.divawaldisposisi').hide();
                            $('#loadingimage').show();
                            $('#judulloading').html('Trying Loading File From URL : <a href="'+idsurat+'" target="_blank">'+idsurat+'</a><br />If This Process Longer than usually, please use download button instead');
                            var iframe = '<iframe src="'+idsurat+'" width="100%" height="780" style="border: none;" id="document-preview"></iframe>';
                            $('#pdfRenderer').html(iframe);
                            $("html, body").animate({ scrollTop: 0 }, "slow");
                        }
                    },
                    { text: 'Identitas Surat', cellsrenderer: filerendercari, width: '95%', cellsalign: 'left', align: 'center'  },
                ],
            });
        }
    });
    $("#btnkembalikedispo").click(function(){
        $('.divisidisposisi').hide();
        $('.divawaldisposisi').show();
    });
    $("#btnsimpancatatn").click(function(){
        $('.divisidisposisi').hide();
        $('#loading').show();
        var set01 		= document.getElementById('buka_idne').value;
        var set02		= 'Arsiparis Umum';
        var set03		= CKEDITOR.instances['buka_catatan'].getData();
        if (set03 == '') {var set03	= 'Kirim ke Arsiparis';}
        var set04 		= document.getElementById('buka_kelompok').value;
        var set05 		= document.getElementById('filelampiran');
        var form_data = new FormData();
            form_data.append('kerja_idsurat', set01);
            form_data.append('tanggal', set02);
            form_data.append('id_catatan', set03);
            form_data.append('kelompok', set04);
            form_data.append('file', set05.files[0]);
            form_data.append('_token', '{{csrf_token()}}');
        $.ajax({
            url	: '{{ route("arsipfokerja") }}',
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
                $('#loading').hide();
                $('.divawaldisposisi').show();
                $("#gridsendiri").jqxGrid('updatebounddata', 'filter');
                return false;
            },
            error: function (xhr, status, error) {
                $('.divawaldisposisi').show();
                swal({
                    title	: 'Stop',
                    text	: xhr.responseText,
                    type	: 'error',
                })
            }
        });
    });
    $('.btnopensuratkeluar').click(function () {
        $('#divkegiatan').hide();
        $('#divskdanperaturan').hide();
        $('#divsuratmasuk').hide();
        $('#divsuratkeluar').show();
        $('#divuploadersurat').hide();
        $('#divdirisendiri').hide();
        $('#divinputsuratmasuk').hide();
        $('#divinputsuratkeluarmaju').hide();
        $('#divinputsuratkeluarmundur').hide();
        $('#divdisposisi').hide();
        $('#divkalender').hide();
        $('#divtambahpenerima').hide();
        var tahun 		        = "{{ date('Y') }}";
        var sumbersuratkeluar   = {
            datatype: "json",
            datafields: [
                { name: 'id'},
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
                { name: 'marking', type: 'text'},
            ],
            updaterow: function (rowid, rowdata, commit) {commit(true);},
            type		: 'GET',
            data		: {	val01:tahun,tahun:tahun, _token: '{{ csrf_token() }}' },
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
                { text: 'Edit/Replace', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
                    return "Edit";
                    }, buttonclick: function (row) {
                        editrow 		= row;
                        var offset 		= $("#gridsuratkeluar").offset();
                        var dataRecord 	= $("#gridsuratkeluar").jqxGrid('getrowdata', editrow);
                        var jenissrt    = dataRecord.jenissrt;
                        if (jenissrt == 'REQUEST'){
                            swal({
                                title	: 'Stop',
                                text	: 'Nomor Anda Belum di Approve Sekretaris Pimpinan',
                                type	: 'warning',
                            })
                        } else {
                            $("#upload_file").val('');
                            $("#upload_idne").val(dataRecord.id);
                            $("#upload_marking").val(dataRecord.marking);
                            $("#upload_nomor").val(dataRecord.nomor);
                            $("#upload_tanggal").val(dataRecord.plaintglsurat);
                            $("#upload_perihal").val(dataRecord.plainperihal);
                            $("#upload_tahunagenda").val(dataRecord.yersrt);
                            $("#upload_jenissrt").val(dataRecord.jenissrt);
                            $("#upload_noagenda").val('');
                            $("#idparaf1").val('SELF').trigger('change');
                            $("#idparaf2").val('').trigger('change');
                            $("#idparaf3").val('').trigger('change');
                            $("#idparaf4").val('').trigger('change');
                            $("#id_namapenandatangan").val(dataRecord.idpejabat).trigger('change');
                            $("#id_kepada").val('').trigger('change');
                            $('#divsuratkeluar').hide();
                            $('#divuploadersurat').show();
                        }
                        
                    }
                },
                { text: 'Send', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
                    return "Send";
                    }, buttonclick: function (row) {		
                        editrow = row;	
                        var offset 		= $("#gridsuratkeluar").offset();		
                        var dataRecord 	= $("#gridsuratkeluar").jqxGrid('getrowdata', editrow);
                        var jenissrt    = dataRecord.jenissrt;
                        if (jenissrt == 'REQUEST'){
                            swal({
                                title	: 'Stop',
                                text	: 'Nomor Anda Belum di Approve Sekretaris Pimpinan',
                                type	: 'warning',
                            })
                        } else {
                            $("#kirim_id").val(dataRecord.id);
                            $("#kirim_nomor").val(dataRecord.nomor);
                            $("#kirim_perihal").val(dataRecord.plainperihal);
                            $("#kirim_kegiatan").val(dataRecord.plainperihal);
                            $("#kirim_tglmulai").val(dataRecord.plaintglsurat);
                            $("#kirim_tglselesai").val(dataRecord.plaintglsurat);
                            $("#kirim_kelompok").val('KELUAR');
                            CKEDITOR.instances['kirim_keterangan'].setData('')
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
                    }
                },
                { text: 'QrCode', editable: false, sortable: false, filterable: false,columntype: 'button', width: '5%', align: 'center', cellsrenderer: function () {
                    return "Get";
                    }, buttonclick: function (row) {
                        editrow         = row;
                        var offset 		= $("#gridsuratkeluar").offset();
                        var dataRecord 	= $("#gridsuratkeluar").jqxGrid('getrowdata', editrow);
                        window.open("{{URL::to("/")}}/downloadqr/"+dataRecord.marking, "_blank");
                    }
                },
                { text: 'Nomor', datafield: 'tlsnomor', width: '6%', cellsalign: 'center', align: 'center'},
                { text: 'Tanggal', datafield: 'tglsurat', width: '12%', cellsalign: 'center', align: 'center'  },
                { text: 'Perihal', datafield: 'perihal', width: '20%', cellsalign: 'left', align: 'center'  },
                { text: 'Pemohon', datafield: 'tulisorg', width: '20%', cellsalign: 'left', align: 'center'  },
                { text: 'Keterangan', datafield: 'status', width: '20%', cellsalign: 'left', align: 'center'  },
                { text: 'Hapus', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', align: 'center', cellsrenderer: function () {
                    return "Hapus";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var offset 		= $("#gridsuratkeluar").offset();
                        var dataRecord 	= $("#gridsuratkeluar").jqxGrid('getrowdata', editrow);
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
                            $.post('{{ route("hapussrtkeluar") }}', { val01: dataRecord.id, val02: 'MANUAL', val03: 'KELUAR', _token: '{{ csrf_token() }}' }, function(data){					
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
    });
    $('#btntambahnomormaju').click(function () {
        var set01="{!! Session('nama') !!}";
        var set02="{!! Session('previlage') !!}";
        $("#nom_kelompok").val(set02);
        $('#nom_ubahnama').val(set01).trigger('change');
        $("#nom_klasifikasiarsip").val('TU.00.1');
        $("#nom_perihal").val('');
        $('#divinputsuratkeluarmaju').show();
        $('#divsuratkeluar').hide();
    });
    $('.btnkembalikelamansuratkeluar').click(function () {
        var val10=document.getElementById('kirim_kelompok').value;
        $('#divtambahpenerima').hide();
        $('#divsuratkeluar').show();
    });
    $("#btngetnomor").click(function(){
        var val01=document.getElementById('nom_jumlah').value;
        var val02=document.getElementById('nom_klasifikasi').value;
        var val03=document.getElementById('nom_klasifikasiarsip').value;
        var val04=document.getElementById('nom_kodepjbt').value;
        var val05=document.getElementById('nom_sifat').value;
        var val06=document.getElementById('nom_nama').value;
        var val07=document.getElementById('nom_kelompok').value;
        var val08=document.getElementById('nom_perihal').value;
        var val09='REQUEST';
        if (val03 == ''){ var val03 = 'TU.00.1';}
        if (val01 == '' || val02 == '' || val03 == '' || val04 == '' || val05 == '' || val06 == '' || val08 == '' || val09 == ''){
            swal({
                title	: 'Stop',
                text	: 'Semua Form Wajib di isi terlebih dahulu, apabila ada yg tidak diketahui mohon di isi dengan tanda dash (-)',
                type	: 'warning',
            })
        } else {
            if (val01 >= 5){
                swal({
                    title	: 'Stop',
                    text	: 'Maksimal Nomor Yang Bisa di Mohonkan 5',
                    type	: 'warning',
                })
            } else {
                $('#loading').show();
                $('#divinputsuratkeluarmaju').hide();
                $.post('{{ route("exrekuesnomor") }}', { set01: val01, set02: val02, set03: val03, set04: val04, set05: val05, set06: val06, set07: val07, set08: val08, set09: val09, set10: 'maju', _token: '{{ csrf_token() }}' },
                function(data){
                    $('#loading').hide();
                    $('#divinputsuratkeluarmaju').hide();
                    $('#divsuratkeluar').show();
                    $("#message").html(data);
                    $("#gridsuratkeluar").jqxGrid('updatebounddata', 'filter');
                    return false;
                });
            }
        }
    });
    //START_NOTULENSI
		$('.btnopendatanotulensi').click(function () {
			$('#divskdanperaturan').hide();
			$('#divsuratmasuk').hide();
			$('#divsuratkeluar').hide();
			$('#divuploadersurat').hide();
			$('#divdirisendiri').hide();
			$('#divinputsuratmasuk').hide();
			$('#divinputsuratkeluarmaju').hide();
			$('#divinputsuratkeluarmundur').hide();
			$('#divdisposisi').hide();
			$('#divkalender').hide();
			$('#divtambahpenerima').hide();
			$('#divkegiatan').show();
			$('.divawalkegiatan').hide();
			$('.divdetailkegiatan').hide();
			$('.divtambahkegiatan').hide();
			$('.divawalnotulensi').show();
			$('#divisinotulensi').hide();
			var source 	= {
				datatype: "json",
				datafields: [
					{ name: 'id'},
					{ name: 'namaevent', type: 'text'},
					{ name: 'tempatevent', type: 'text'},
					{ name: 'tglevent', type: 'text'},
					{ name: 'startevent', type: 'text'},
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
					{ name: 'notulensi', type: 'text'},
					{ name: 'foto', type: 'text'},
				],
				type: 'POST',
				data: {val01:'{{Session("email")}}', val02:'notulensi', _token: '{{ csrf_token() }}'},
				url	: '{{ route("getList5partisipan") }}'
			};
			var dataAdapter = new $.jqx.dataAdapter(source);
			$("#gridnotulensi").jqxGrid({
				width			: '100%',
				pageable		: true,
				autoheight		: true,
				filterable		: true,
				source			: dataAdapter,
				columnsresize	: true,
				showfilterrow	: true,
				theme			: "energyblue",
				altrows			: true,
				selectionmode	: 'multiplecellsextended',
				columns			: [
					{ text: 'Tanggal', datafield: 'tglevent', width: '10%', cellsalign: 'left', align: 'center'  },
					{ text: 'Nama Event', datafield: 'namaevent', width: '30%', cellsalign: 'left', align: 'center'  },
					{ text: 'Lokasi', datafield: 'tempatevent', width: '25%', cellsalign: 'left', align: 'center'  },					
					{ text: 'Start', datafield: 'startevent', width: '15%', cellsalign: 'left', align: 'center'  },
					{ text: 'Surat', datafield: 'instansi', width: '10%', cellsalign: 'left', align: 'center'  },
					{ text: 'Notulensi', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', cellsrenderer: function () {
						return "Input";
						}, buttonclick: function (row) {		
							editrow = row;	
							var offset 		= $("#gridnotulensi").offset();		
							var dataRecord 	= $("#gridnotulensi").jqxGrid('getrowdata', editrow);
							var imagesarr  	= dataRecord.negara;
							if (imagesarr == 'Indonesia' || imagesarr == '' || imagesarr == null){
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
							} else {
								var arrgambar	= imagesarr.split(";");
								if (arrgambar[5] == null){
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
								} else {
									$('#preview').attr('src', '/images/notulensi/'+arrgambar[0]);
									$('#preview2').attr('src', '/images/notulensi/'+arrgambar[1]);
									$('#preview3').attr('src', '/images/notulensi/'+arrgambar[2]);
									$('#preview4').attr('src', '/images/notulensi/'+arrgambar[3]);
									$('#preview5').attr('src', '/images/notulensi/'+arrgambar[4]);
									$('#preview6').attr('src', '/images/notulensi/'+arrgambar[5]);
									$('#imagenumber1').attr('href', '/images/notulensi/'+arrgambar[0]);
									$('#imagenumber2').attr('href', '/images/notulensi/'+arrgambar[1]);
									$('#imagenumber3').attr('href', '/images/notulensi/'+arrgambar[2]);
									$('#imagenumber4').attr('href', '/images/notulensi/'+arrgambar[3]);
									$('#imagenumber5').attr('href', '/images/notulensi/'+arrgambar[4]);
									$('#imagenumber6').attr('href', '/images/notulensi/'+arrgambar[5]);
								}
							}
							CKEDITOR.instances['notulensi_isi'].setData(dataRecord.notulensi)
							$("#judulnotulensi").html(dataRecord.namaevent);
							$("#subjudulnotulensi").html(dataRecord.tempatevent);
							$('.divtambahkegiatan').hide();
							$('.divdetailkegiatan').hide();
							$('.divawalnotulensi').hide();
							$('.divawalkegiatan').hide();
							$('#divisinotulensi').show();
                            $("#notulensi_idevent").val(dataRecord.idevent);
							$("#notulensi_idne").val(dataRecord.id);
						}
					},
				]
			});
		});
        $("#btnnotulensimodelkomitemedik").click(function(){
			var val01=document.getElementById('notulensi_idevent').value;
            laman = 'komitemedik/'+val01;
			window.location.href = laman;
		});
		$("#btnsimpannotulensi").click(function(){
			var val01=document.getElementById('notulensi_idne').value;
			var val02=CKEDITOR.instances['notulensi_isi'].getData()
			var val03=document.getElementById('notulensi_namapenandatangan').value;
			var val04=document.getElementById('notulensi_paraf1').value;
			var val05=document.getElementById('notulensi_paraf2').value;
			var val06=document.getElementById('id_fotoprofile');
			var val07=document.getElementById('id_fotoprofile2');
			var val08=document.getElementById('id_fotoprofile3');
			var val09=document.getElementById('id_fotoprofile4');
			var val10=document.getElementById('id_fotoprofile5');
			var val11=document.getElementById('id_fotoprofile6');
			if (val01 == '' || val02 == ''){
				swal({
					title	: 'Stop',
					text	: 'Teks Notulen Wajib di Isi',
					type	: 'warning',
				})
			} else {
				var form_data = new FormData();
					form_data.append('val01', val01);
					form_data.append('val02', val02);
					form_data.append('val03', val03);
					form_data.append('val04', val04);
					form_data.append('val05', val05);
					form_data.append('val09', 'notulensi');
					form_data.append('file1', val06.files[0]);
					form_data.append('file2', val07.files[0]);
					form_data.append('file3', val08.files[0]);
					form_data.append('file4', val09.files[0]);
					form_data.append('file5', val10.files[0]);
					form_data.append('file6', val11.files[0]);
					form_data.append('_token', '{{csrf_token()}}');
				$('#divisinotulensi').hide();
				$.ajax({
					url         : '{{ route("exKuisionerwebinar") }}',
					data        : form_data,
					type        : 'POST',
					contentType : false,
					processData : false,
					success     : function (data) {
						$('.divawalnotulensi').show();
						$('#divisinotulensi').hide();
						var status  = data.status;
						var message = data.message;
						var warna 	= data.warna;
						var icon 	= data.icon;
						$.toast({
							heading		: status,
							text		: message,
							position	: 'top-right',
							loaderBg	: warna,
							icon		: icon,
							hideAfter	: 3000,
							stack		: 1
						});
						$("#gridnotulensi").jqxGrid('updatebounddata', 'filter');
						$("html, body").animate({ scrollTop: 0 }, "slow");
						return false;
					},
					error: function (xhr, status, error) {
						$('#divisinotulensi').show();
						swal({
							title	: 'Stop',
							text	: xhr.responseText,
							type	: 'error',
						})
					}
				});
			}
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
		$('#btnremoveimage1').on('click', function (){
			$('#preview').attr('src', 'boxed-bg.png');
			$("#id_fotoprofile").val('');
		});
		$('#btnremoveimage2').on('click', function (){
			$('#preview2').attr('src', 'boxed-bg.png');
			$("#id_fotoprofile2").val('');
		});
		$('#btnremoveimage3').on('click', function (){
			$('#preview3').attr('src', 'boxed-bg.png');
			$("#id_fotoprofile3").val('');
		});
		$('#btnremoveimage4').on('click', function (){
			$('#preview4').attr('src', 'boxed-bg.png');
			$("#id_fotoprofile4").val('');
		});
		$('#btnremoveimage5').on('click', function (){
			$('#preview5').attr('src', 'boxed-bg.png');
			$("#id_fotoprofile5").val('');
		});
		$('#btnremoveimage6').on('click', function (){
			$('#preview6').attr('src', 'boxed-bg.png');
			$("#id_fotoprofile6").val('');
		});
		$('#id_fotoprofile').change(function () {
			if(this.files[0].size > 3000000){
				this.value = "";
				$('#preview').attr('src', 'boxed-bg.png');
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
				$('#preview2').attr('src', 'boxed-bg.png');
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
				$('#preview3').attr('src', 'boxed-bg.png');
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
				$('#preview4').attr('src', 'boxed-bg.png');
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
				$('#preview5').attr('src', 'boxed-bg.png');
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
				$('#preview6').attr('src', 'boxed-bg.png');
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
		$('#btnklosetambahnotulensi').click(function () {
			$('.divawalkegiatan').hide();
			$('.divdetailkegiatan').hide();
			$('.divtambahkegiatan').hide();
			$('.divawalnotulensi').show();
			$('#divisinotulensi').hide();
		});
	//END_NOTULENSI
});
</script>
@endpush