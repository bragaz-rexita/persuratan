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
                        <div class="card card-warning direct-chat direct-chat-warning shadow">
                            <div class="card-header">
                                <h3 class="card-title">Kopi Darat</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
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
                    <div id="divsuratmasuk">
						<div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Surat Masuk</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool btnkembali">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
								<div class="row">
									<div class="col-lg-2">
										<button type="button" class="btn w-lg btn-info waves-effect waves-light" id="btntambahdata">Add New Surat</button>
									</div>
									<div class="col-lg-4">

									</div>
									<div class="col-lg-6">
									<div class="small-box bg-blue">
										<div class="inner">
											<div class="form-group">
											<label for="cari_jenis">Pencarian Surat Berdasarkan.?</label>
											<div class="row">
												<div class="col-lg-5">
													<input type="text" class="form-control" id="cari_dari" placeholder="Ketik Value Pencarian">
												</div>
												<div class="col-lg-5">
													<select id="cari_jenis" class="form-control">
														<option value="agenda">Cari Berdasarkan No. Agenda</option>
														<option value="koreksi">Cari Yang Harus di Koreksi</option>
														<option value="nomer">Cari Berdasarkan No. Surat</option>
														<option value="tglmasuk">Cari Berdasarkan TGL. Masuk</option>
														<option value="tglsurat">Cari Berdasarkan TGL. Surat</option>
														<option value="perihal">Cari Berdasarkan Perihal</option>
														<option value="ringkasan">Cari Berdasarkan Ringkasan</option>
														<option value="pengirim">Cari Berdasarkan Pengirim</option>
														<option value="tahun">Cari Berdasarkan Tahun</option>
													</select>
												</div>
												<div class="col-lg-2">
													<button class="btn btn-success" id="btnviewtracking">Cari</button>
												</div>
											</div>
											</div>	
										</div>
									</div>
									</div>
								</div>
                            </div>
                            <div class="card-footer" id="divmasukawal">
								<div id="tabelsuratmasuk"></div>
                            </div>
							<div class="card-footer" id="divmasukcari">
								<div id="tabelcari"></div>
                            </div>
                        </div>
					</div>
					<div id="divinputsuratmasuk">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Input Surat Masuk</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool btnkembali">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-2 col-md-2">
											<label for="id_noagenda">No. Agenda</label>
											<input type="text" class="form-control" id="id_noagenda" name="id_noagenda">
											<p class="help-block">Isi Angka Saja</p>
										</div>
										<div class="col-lg-2 col-md-2">
											<label for="id_tglmasuk">Tgl.Masuk</label>
											<div class="input-group date" data-target-input="nearest">
												<input value="{{date('Y-m-d')}}" type="text" class="form-control" id="id_tglmasuk" name="id_tglmasuk" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
												<div class="input-group-append">
													<div class="input-group-text"><i class="fa fa-calendar"></i></div>
												</div>
											</div>
										</div>
										<div class="col-lg-2 col-md-2">
											<label for="id_tglsurat">Tgl.Surat</label>
											<div class="input-group date" data-target-input="nearest">
												<input value="{{date('Y-m-d')}}" type="text" class="form-control" id="id_tglsurat" name="id_tglsurat" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
												<div class="input-group-append">
													<div class="input-group-text"><i class="fa fa-calendar"></i></div>
												</div>
											</div>
										</div>
										<div class="col-lg-2 col-md-2">
											<label for="id_nosurat">No. Surat</label>
											<input type="text" class="form-control" id="id_nosurat" name="id_nosurat">
										</div>
										<div class="col-lg-4 col-md-4">
											<label for="id_jenissurat">Jenis Surat</label>
											<select id="id_jenissurat" name="id_jenissurat" size="1" class="form-control select2">
												<option value="">Pilih Salah Satu</option>
												<optgroup label="Surat Dinas">
													<option value="S">Surat Dinas</option>
													<option value="ND">Nota Dinas</option>
													<option value="MO">Memo</option>
													<option value="SK">Surat Keterangan</option>
													<option value="SPY">Surat Pernyataan</option>
													<option value="SPO">Surat Purchase Order</option>
													<option value="PERM">Surat Permohonan</option>
													<option value="NK">Nota Kesepahaman</option>
													<option value="NR">Notula Rapat</option>
													<option value="LL">Lain-lain</option>
													<option value="PEMB">Pemberitahuan</option>
													<option value="USUL">Usulan</option>
													<option value="IJIN">Surat Ijin</option>
													<option value="PENGJ">Surat Pengajuan</option>
												</optgroup>
												<optgroup label="Laporan dan Formulir">
													<option value="LAP">Laporan</option>
													<option value="LHA">Laporan Hasil Audit</option>
													<option value="LHAI">Laporan Hasil Audit Investigatif</option>
													<option value="LHE">Laporan Hasil Evaluasi</option>
													<option value="LA">Laporan Asistensi</option>
													<option value="LAA">Laporan Analisis Hasil Audit</option>
													<option value="LHT">Laporan Hasil Penelitian</option>
													<option value="TS">Telaahan Staf</option>
													<option value="LD">Lembar Disposisi</option>
													<option value="SPB">Surat Permintaan Barang</option>
													<option value="SPMB">Surat Perintah Mengeluarkan Barang</option>
													<option value="SPBI">Surat Permintaan Barang Inventaris</option>
													<option value="SPMI">Surat Perintah Mengeluarkan Barang Inventaris</option>
												</optgroup>
												<optgroup label="Naskah Dinas Bimbingan">
													<option value="PDM">Pedoman</option>
													<option value="JUK">Petunjuk</option>
													<option value="PEM">Pemberitahuan</option>
												</optgroup>
												<optgroup label="Naskah Dinas Elektronik">
													<option value="FAKS">Faksimile</option>
													<option value="TLP">Telepon</option>
													<option value="ETR">E-Mail</option>
													<option value="TLG">Telegram</option>
													<option value="TLK">Teleks</option>
												</optgroup>
												<optgroup label="Naskah Dinas Khusus">
													<option value="SKU">Surat Kuasa</option>
													<option value="KET">Surat Keterangan</option>
													<option value="MoU">Memorandum of Understanding</option>
													<option value="PRJ">Surat Perjanjian</option>
													<option value="BA">Berita Acara</option>
													<option value="BAPS">Berita Acara Pengangkatan Sumpah</option>
													<option value="UND">Surat Undangan</option>
													<option value="SP">Surat Pengantar</option>
													<option value="PRT">Surat Peringatan</option>
													<option value="SKP">Surat Keterangan Perjalanan</option>
													<option value="SI">Surat Ijin</option>
													<option value="SPMT">Surat Pernyataan Melaksanakan Tugas</option>
													<option value="SPMJ">Surat Pernyataan Menduduki Jabatan</option>
													<option value="SPL">Surat Pernyataan Pelantikan</option>
													<option value="NST">Naskah Serah Terima Jabatan</option>
												</optgroup>
												<optgroup label="Naskah Dinas Pengaturan">
													<option value="NS">Instruksi</option>
													<option value="KEP">Keputusan</option>
													<option value="SE">Surat Edaran </option>
													<option value="JLK">Petunjuk Pelaksanaan</option>
													<option value="PROT">Prosedur Operasional Standar</option>
													<option value="PENG">Pengumuman</option>
													<option value="HK">Peraturan</option>
												</optgroup>
												<optgroup label="Naskah Dinas Penugasan">
													<option value="ST">Surat Tugas</option>
													<option value="PRIN">Surat Perintah</option>
													<option value="SPPL">Surat Pengukuhan Perintah Lisan</option>
													<option value="SPPD">Surat Perintah Perjalanan Dinas</option>
												</optgroup>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-lg-4 col-md-4">
											<label for="id_asalsurat">Asal Surat</label>
											<input type="text" class="form-control" id="id_asalsurat" name="id_asalsurat">
										</div>
										<div class="col-lg-4 col-md-4">
											<label for="id_lampiran">Lampiran</label>
											<input type="text" class="form-control" id="id_lampiran" name="id_lampiran">
										</div>
										<div class="col-lg-4 col-md-4">
											<label for="id_subyek">Subyek</label>
											<select id="id_subyek" name="id_subyek" size="1" class="form-control">
												<option value="TU">KETATAUSAHAAN</option>
												<option value="PP">PENDIDIKAN DAN PENGAJARAN</option>
												<option value="DL">DIKLAT DOSEN DAN PEGAWAI</option>
												<option value="HM">HUBUNGAN MASYARAKAT</option>
												<option value="HK">HUKUM DAN ORGANISASI</option>
												<option value="TI">INFORMATIKA/SIM/TIK</option>
												<option value="RT">KERUMAHTANGGAAN</option>
												<option value="KU">KEUANGAN</option>
												<option value="KP">KEPEGAWAIAN</option>
												<option value="KM">KEMAHASISWAAN</option>
												<option value="KS">MoU, KONTRAK, KERJASAMA</option>
												<option value="PR">PERENCANAAN DAN PROGRAM</option>
												<option value="LK">PERLENGKAPAN</option>
												<option value="WS">PENGAWASAN</option>
												<option value="PN">PENELITIAN</option>
												<option value="PM">PENGABDIAN KEPADA MASYARAKAT</option>
												<option value="DT">TATA PAMONG PERGURUAN TINGGI</option>
												<option value="AK">AKADEMIK</option>
												<option value="PD">PENGADAAN</option>
												<option value="JP">JOB PLACEMENT</option>
												<option value="KR">KURIKULUM</option>
												<option value="PB">PEMBINAAN DAN PENGEMBANGAN BAHASA</option>
												<option value="PS">SARANA DAN PRASARANA</option>
												<option value="UM">UMUM</option>
												<option value="PI">PERTEMUAN ILMIAH</option>
											</select>
										</div>
										<div class="col-lg-8 col-md-8">
											<label>Perihal</label>
											<input type="text" class="form-control" id="id_perihal" name="id_perihal">
										</div>
										<div class="col-md-4">
											<label>Klasifikasi Arsip *)</label>
											<input type="text" class="form-control" placeholder="Klik Tombol Cari" id="id_klasifikasiarsip" name="id_klasifikasiarsip" value="TU.00.1">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="set_kepada">Kepada</label>
									<select id="set_kepada" name="set_kepada[]" class="form-control select2" multiple="multiple" data-placeholder="Boleh pilih lebih dari satu" style="width: 100%;">
										@foreach($pejabats as $rpejabats)
											<option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['nama'] }} ( {{ $rpejabats['pejabat'] }} )</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label for="id_ringkasan">Ringkasan Surat</label>
									<input type="text" class="form-control" id="id_ringkasan" name="id_ringkasan">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3 col-md-3">
											<label for="id_sifat">Sifat</label>
											<select id="id_sifat" name="id_sifat" size="1" class="form-control">
												<option value="4">Biasa</option>
												<option value="3">Segera</option>
												<option value="2">Sangat Segera</option>
												<option value="1">Kilat</option>
												<option value="5">Lainnya</option>
											</select>
										</div>
										<div class="col-lg-3 col-md-3">
											<label for="id_bentuk">Bentuk</label>
											<select id="id_bentuk" name="id_bentuk" size="1" class="form-control">
												<option value="Surat Asli">Surat Asli</option>
												<option value="Fotocopy">Fotocopy</option>
												<option value="Facsimile">Facsimile</option>
												<option value="Email">Email</option>
												<option value="Lainnya">Lainnya</option>
											</select>
										</div>
										<div class="col-lg-3 col-md-3">
											<label for="id_klasifikasi">Klasifikasi</label>
											<select id="id_klasifikasi" name="id_klasifikasi" size="1" class="form-control">
												<option value="Biasa">Biasa</option>
												<option value="Rahasia">Rahasia</option>
												<option value="Sangat Rahasia">Sangat Rahasia</option>
												<option value="Terbatas">Terbatas</option>
												<option value="Lainnya">Lainnya</option>
											</select>
										</div>
										<div class="col-lg-3 col-md-3">
											<label for="file" class="col-form-label">File Upload</label><br />
											<input type="file" id="file" name="file" class="btn-light">
										</div>
									</div>
								</div>
							</div>
                            <div class="card-footer">
								<input type="hidden" class="form-control" id="id_idsurat" name="id_idsurat">
								<button type="button" class="btn btn-danger pull-left btnkembali">Cancel</button>
								<button type="button" class="btn btn-success pull-right" id="simpansuratmsk">Simpan</button>
                            </div>
                        </div>
                    </div>
					<div id="divskdanperaturan">
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">SK dan Peraturan</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool btnkembali">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body divskawal">
								<div class="form-group">
									<div class="row">
										<div class="col-md-3">
											<a href="#" id="btntambahnomorsk" class="btn btn-block btn-primary">
												<i class="fa fa-paper-plane-o"></i> Tambah SK
											</a>
										</div>
										<div class="col-md-4">
											<div id="messagesk"></div>
										</div>
									</div>
								</div>
                            </div>
                            <div class="card-footer divskawal">
								<div id="gridskdaperaturan"></div>
                            </div>
							<div class="card-body divinputsk">
								<div class="form-group"> 
									<div class="row">
										<div class="col-lg-3">
                                            <label for="sk_nomor">No. SK (Angka Saja)</label>
                                            <input type="number" class="form-control" id="sk_nomor" name="sk_nomor" value="1">
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="sk_tanggal">Tgl. di Tetapkan</label>
											<div class="input-group date" data-target-input="nearest">
												<input value="{{date('Y-m-d')}}" type="text" class="form-control" id="sk_tanggal" name="sk_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
												<div class="input-group-append">
													<div class="input-group-text"><i class="fa fa-calendar"></i></div>
												</div>
											</div>
                                        </div>
                                        <div class="col-md-3">
											<label>Dasar Tahun Agenda</label>
											<input type="text" class="form-control" id="sk_tahunagenda" name="sk_tahunagenda" value="{{date('Y')}}">
										</div>
										<div class="col-md-3">
											<label>Dasar No.Agenda</label>
											<input type="text" class="form-control" id="sk_noagenda" name="sk_noagenda" placeholder="No. Agenda">
										</div>
									</div>
								</div>
								<div class="form-group">
                                    <div class="row">
										<div class="col-lg-4">
                                            <label for="sk_jenis">Jenis</label>
                                            <select id="sk_jenis" name="sk_jenis" size="1" class="form-control">
                                                <option value="SKDANPERATURAN">Keputusan TTD Manual / Basah</option>
                                                <option value="PERATURAN">Peraturan TTD Manual / Basah</option>
                                                <option value="INSTRUKSI">Instruksi TTD Manual / Basah</option>
                                                <option value="SKDANPERATURANTTE">Keputusan Tanda Tangan elektronik</option>
                                                <option value="PERATURANTTE">Peraturan Tanda Tangan elektronik</option>
                                                <option value="INSTRUKSITTE">Instruksi Tanda Tangan elektronik</option>
												<option value="SKDANPERATURANTTEMAN">Keputusan Tanda Tangan elektronik (Dengan QrCode Manual)</option>
                                                <option value="PERATURANTTEMAN">Peraturan Tanda Tangan elektronik (Dengan QrCode Manual)</option>
                                                <option value="INSTRUKSITTEMAN">Instruksi Tanda Tangan elektronik (Dengan QrCode Manual)</option>
											
                                            </select>	
                                        </div>
                                        <div class="col-lg-8">
                                            <label for="sk_kodepjbt">Penandatangan</label>
                                            <select id="sk_kodepjbt" name="sk_kodepjbt" size="1" class="form-control">
                                                <option value="">Pilih Salah Satu</option>
												@foreach($pejabats as $rpejabats)
													<option value="{{ $rpejabats['id'] }}">{{ $rpejabats['pejabat'] }}</option>
												@endforeach
											</select>
                                        </div>
                                    </div>
                                </div>
								<div class="form-group">
                                    <div class="row">
										<div class="col-lg-4">
                                            <label for="sk_tanggalundang">Tgl. di Undangkan</label>
											<div class="input-group date" data-target-input="nearest">
												<input type="text" class="form-control" id="sk_tanggalundang" name="sk_tanggalundang" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
												<div class="input-group-append">
													<div class="input-group-text"><i class="fa fa-calendar"></i></div>
												</div>
											</div>
                                        </div>
                                        <div class="col-lg-8">
                                            <label for="sk_kodepjbtundang">Pejabat yang mengundangkan</label>
                                            <select id="sk_kodepjbtundang" name="sk_kodepjbtundang" size="1" class="form-control">
                                                <option value="">Pilih Salah Satu</option>
                                                    @foreach($pejabats as $rpejabats)
														<option value="{{ $rpejabats['id'] }}">{{ $rpejabats['pejabat'] }}</option>
													@endforeach
											</select>	
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"> 			
									<label for="sk_judul">SK/Peraturan Tentang</label>
                                    <input type="text" class="form-control" id="sk_judul" name="sk_judul">
                                </div>
								<p>Untuk SK Yang di Tandatangani dengan Tandatangan Elektronik, Mohon Mengisi data Pemaraf di Bawah Ini</p>
								<div class="form-group">
									<div class="row">
										<div class="col-lg-6 col-md-6">
											<label for="sk_idparaf1">Paraf 1 Oleh:</label>
											<select id="sk_idparaf1" name="sk_idparaf1" size="1" class="form-control select2">
												<option value="">Pilih Salah Satu</option>
												<option value="SELF">Di Paraf Sendiri</option>
												@foreach($pejabats as $rpejabats)
													<option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
												@endforeach
											</select>
										</div>
										<div class="col-lg-6 col-md-6">
											<label for="sk_idparaf2">Paraf 2 Oleh:</label>
											<select id="sk_idparaf2" name="sk_idparaf2" size="1" class="form-control select2">
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
										<div class="col-lg-6 col-md-6">
											<label for="sk_idparaf3">Paraf 3 Oleh:</label>
											<select id="sk_idparaf3" name="sk_idparaf3" size="1" class="form-control select2">
												<option value="">Pilih Salah Satu</option>
												@foreach($pejabats as $rpejabats)
													<option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
												@endforeach
											</select>
										</div>
										<div class="col-lg-6 col-md-6">
											<label for="sk_idparaf4">Paraf 4 Oleh:</label>
											<select id="sk_idparaf4" name="sk_idparaf4" size="1" class="form-control select2">
												<option value="">Pilih Salah Satu</option>
												@foreach($pejabats as $rpejabats)
													<option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<input type="file" id="upload_filesk" name="upload_filesk">
									<p class="help-block">File PDF Langsung dari Softfile (Print To PDF)</p>
								</div>
                            </div>
                            <div class="card-footer divinputsk">
								<input type="hidden" id="sk_marking" name="sk_marking">
								<input type="hidden" id="sk_idne" name="sk_idne">
								<button type="button" class="btn btn-success pull-right" id="btnuploadfilesk">Simpan</button>
								<button type="button" class="btn btn-danger pull-left btnkembalikelamansk">Close</button>
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
										<div class="col-md-3">
											<a href="#" id="btntambahnomormundur" class="btn btn-block btn-danger">
												<i class="fa fa-reply-all"></i> Tambah Nomor Mundur
											</a>
										</div>
									</div>
								</div>
                            </div>
                            <div class="card-footer">
								<div id="gridsuratkeluar"></div>
                            </div>
                        </div>
					</div>
					<div id="divsuratkeluartnpnomor">
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Surat Keluar Tanpa Nomor</h3>
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
											<a href="#" id="btntambahnotulensi" class="btn btn-block btn-primary">
												<i class="fa fa-paper-plane-o"></i> Notulensi
											</a>
										</div>
										<div class="col-md-6">
											<div id="messagetnpnomor"></div>
										</div>
										<div class="col-md-3">
											
										</div>
									</div>
								</div>
                            </div>
                            <div class="card-footer">
								<div id="gridsuratkeluartanpanomor"></div>
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
									<select id="nom_ubahnama" name="nom_ubahnama" size="1" class="form-control select2">
										<option value="">Pilih Salah Satu</option>
										@foreach($pemohon as $rpemohon)
											<option value="{{ $rpemohon['nama'] }}" title="{{ $rpemohon['previlage'] }}">{{ $rpemohon['nama'] }} ( {{ $rpemohon['previlage'] }} )</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label for="nom_kelompok">Unit Pemohon</label>
									<input type="text" class="form-control" id="nom_kelompok" name="nom_kelompok" value="{{ Session('previlage') }}">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3">
											<label for="nom_jumlah">Jumlah Nomor.? *)</label>
											<input type="number" class="form-control" id="nom_jumlah" name="nom_jumlah" value="1">
											<p class="help-block">Isi Angka Saja</p>
										</div>
										<div class="col-lg-3">
											<label for="nom_jenissrt">Jenis Surat</label>
											<select id="nom_jenissrt" name="nom_jenissrt" size="1" class="form-control">
												<option value="BIASA">Surat Biasa (TTD)</option>
												<option value="Nota Dinas">Nota Dinas (TTD)</option>
												<option value="UPLOAD">Surat dengan TTE</option>
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
                    <div id="divinputsuratkeluarmundur">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Permohonan Nomor Mundur</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool btnkembali">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
								<div class="form-group">
									<label for="man_ubahnama">Pemohon</label>
									<select id="man_ubahnama" name="man_ubahnama" size="1" class="form-control select2">
										<option value="">Pilih Salah Satu</option>
										@foreach($pemohon as $rpemohon)
											<option value="{{ $rpemohon['nama'] }}" title="{{ $rpemohon['previlage'] }}">{{ $rpemohon['nama'] }} ( {{ $rpemohon['previlage'] }} )</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label for="man_kelompok">Unit Pemohon</label>
									<input type="text" class="form-control" id="man_kelompok" name="man_kelompok" value="{{ Session('previlage') }}">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3">
											<label for="man_tanggal">Tgl.Surat</label>
											<div class="input-group date" data-target-input="nearest">
												<input value="{{date('Y-m-d')}}" type="text" class="form-control" id="man_tanggal" name="man_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
												<div class="input-group-append">
													<div class="input-group-text"><i class="fa fa-calendar"></i></div>
												</div>
											</div>
										</div>
										<div class="col-lg-3">
											<label for="man_jenissrt">Jenis Surat</label>
											<select id="man_jenissrt" name="man_jenissrt" size="1" class="form-control">
												<option value="BIASA">Surat Biasa (TTD)</option>
												<option value="Nota Dinas">Nota Dinas (TTD)</option>
												<option value="UPLOAD">Surat dengan TTE</option>
												<option value="SERTIFIKATTTE">Sertifikat dengan TTE</option>
											</select>	
										</div>
										<div class="col-lg-6">
											<label for="man_kodepjbt">Penandatangan</label>
											<select id="man_kodepjbt" name="man_kodepjbt" size="1" class="form-control">
												<option value="">Pilih Salah Satu</option>
													@foreach($pejabats as $rpejabats)
														<option value="{{ $rpejabats['kode'] }}">{{ $rpejabats['pejabat'] }}</option>
													@endforeach
											</select>	
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3 col-md-3">
											<label for="man_sifat">Urgensi</label>
											<select id="man_sifat" name="man_sifat" size="1" class="form-control">
												<option value="4">Biasa</option>
												<option value="3">Segera</option>
												<option value="2">Sangat Segera</option>
												<option value="1">Kilat</option>
												<option value="5">Lainnya</option>
											</select>
										</div>
										<div class="col-lg-3 col-md-3">
											<label for="man_klasifikasi">Klasifikasi</label>
											<select id="man_klasifikasi" name="man_klasifikasi" size="1" class="form-control">
												<option value="Biasa">Biasa</option>
												<option value="Rahasia">Rahasia</option>
												<option value="Sangat Rahasia">Sangat Rahasia</option>
												<option value="Terbatas">Terbatas</option>
												<option value="Lainnya">Lainnya</option>
											</select>
										</div>
									</div>
								</div>
                            </div>
                            <div class="card-footer">
								<input type="hidden"  id="man_nama" name="man_nama" value="{{ Session('email') }}">
								<button type="button" class="btn btn-danger pull-left btnkembali">Cancel</button>
								<button type="button" class="btn btn-success pull-right" id="btngetnomormundur">Simpan</button>
                            </div>
                        </div>
                    </div>
                    <div id="divuploadersurat">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Edit / Upload Surat</h3>
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
											<label>Nomor</label>
											<input type="text" class="form-control" id="upload_nomor" name="upload_nomor" disabled="disable">
										</div>
										<div class="col-md-3">
											<label>Tgl. Surat</label>
											<input type="text" class="form-control" id="upload_tanggal" disabled="disable" />
										</div>
										<div class="col-md-3">
											<label>Dasar Tahun Agenda</label>
											<input type="text" class="form-control" id="upload_tahunagenda" name="upload_tahunagenda" value="{{date('Y')}}">
										</div>
										<div class="col-md-3">
											<label>Dasar No.Agenda</label>
											<input type="text" class="form-control" id="upload_noagenda" name="upload_noagenda" placeholder="No. Agenda">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="upload_perihal">Perihal</label>
									<input type="text" class="form-control" id="upload_perihal" name="upload_perihal">
								</div>
								<div class="form-group"> 
									<label for="upload_jenissrt">Jenis Surat</label>
									<select id="upload_jenissrt" name="upload_jenissrt" size="1" class="form-control">
										<option value="BIASA">Surat dengan TTD Basah</option>
										<option value="UPLOAD">Surat dengan Tanda Tangan Elektronik (Dengan QrCode Otomatis)</option>
										<option value="UPLQRMAN">Surat dengan Tanda Tangan Elektronik (Dengan QrCode Manual)</option>
										<option value="SERTIFIKATTTE">Sertifikat dengan TTE</option>
									</select>
								</div>
								<p>Form di Bawah ini (Penandatangan dan Paraf) wajib di isi bila jenis surat ditandatangani secara elektronik. Apabila menggunakan QrCode Manual, mohon download QrCode di tabel sebelumnya, kemudian tempel di draft surat anda</p>
								<div class="form-group">
									<label for="id_namapenandatangan">Nama Penanda Tangan:</label>
									<select id="id_namapenandatangan" name="id_namapenandatangan" size="1" class="form-control select2">
										<option value="">Pilih Salah Satu</option>
										@foreach($pejabats as $rpejabats)
											<option value="{{ $rpejabats['id'] }}">{{ $rpejabats['pejabat'] }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-lg-6 col-md-6">
											<label for="idparaf1">Paraf 1 Oleh:</label>
											<select id="idparaf1" name="idparaf1" size="1" class="form-control select2">
												<option value="">Pilih Salah Satu</option>
												<option value="SELF">Di Paraf Sendiri</option>
												@foreach($pejabats as $rpejabats)
													<option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
												@endforeach
											</select>
										</div>
										<div class="col-lg-6 col-md-6">
											<label for="idparaf2">Paraf 2 Oleh:</label>
											<select id="idparaf2" name="idparaf2" size="1" class="form-control select2">
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
										<div class="col-lg-6 col-md-6">
											<label for="idparaf3">Paraf 3 Oleh:</label>
											<select id="idparaf3" name="idparaf3" size="1" class="form-control select2">
												<option value="">Pilih Salah Satu</option>
												@foreach($pejabats as $rpejabats)
													<option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
												@endforeach
											</select>
										</div>
										<div class="col-lg-6 col-md-6">
											<label for="idparaf4">Paraf 4 Oleh:</label>
											<select id="idparaf4" name="idparaf4" size="1" class="form-control select2">
												<option value="">Pilih Salah Satu</option>
												@foreach($pejabats as $rpejabats)
													<option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<input type="file" id="upload_file" name="upload_file">
									<p class="help-block">File PDF Langsung dari Softfile (Print To PDF)</p>
								</div>
                            </div>
                            <div class="card-footer">
								<input type="hidden" id="upload_marking" name="upload_marking">
								<input type="hidden" id="upload_idne" name="upload_idne">
								<button type="button" class="btn btn-success pull-right" id="btnuploadfile">Upload</button>
								<button type="button" class="btn btn-danger pull-left btnkembali">Close</button>
                            </div>
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
											<label>Lampiran</label>
											<input type="file" id="filelampiran" name="filelampiran" class="btn-light">
                                        </div>
                                        <div class="col-lg-8 col-md-8">
                                            <label for="buka_kepada">Tembusan Ke:</label>
											<select id="buka_kepada" name="kepada[]" class="form-control select2" multiple="multiple" data-placeholder="Boleh pilih lebih dari satu" style="width: 100%;">
												@if(isset($sekpimonly) AND !empty($sekpimonly))
                                                    @foreach($sekpimonly as $rsekpim)
                                                        <option value="{{ $rsekpim['email'] }}">{{ $rsekpim['nama'] }}</option>
                                                    @endforeach
                                                @endif
												@if(isset($pejabats) AND !empty($pejabats))
                                                    @foreach($pejabats as $rpejabat)
                                                        <option value="{{ $rpejabat['kode'] }}">{{ $rpejabat['pejabat'] }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
										</div>
                                    </div>
                                </div>
								<div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4">
											<button type="button" class="btn btn-danger" id="btnkembalikedispo">Kembali</button>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
											<button type="button" class="btn btn-info" id="btnarsipkan">ARSIPKAN SAJA</button>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
											<button type="button" class="btn btn-success" id="btnsimpancatatn">SIMPAN CATATAN PENGERJAAN</button>
								        </div>
                                    </div>
                                </div>
                            </div>
                            
							<div class="card-footer divawaldisposisi">
								<div class="row">
									<div class="col-lg-4">
										<div class="row">
											<div class="col-lg-4 col-md-4">
												<button type="button" class="btn btn-primary" id="btnopenmailinternal">
													<i class="fa fa-envelope"></i> Internal Only
												</button>
											</div>
											<div class="col-lg-4 col-md-4">
												<button type="button" class="btn btn-warning" id="btnopenmailexternal">
													<i class="fa fa-envelope"></i> External Only
												</button>
											</div>
											<div class="col-lg-4 col-md-4">
												<button type="button" class="btn btn-danger" id="btnopenmailarsip">
													<i class="fa fa-envelope-open"></i> Open Arsip
												</button>
											</div>
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
								<div class="form-group">
									<h5>Disposisi Masuk</h5>
									<div id="gridsendiri"></div>
								</div>
								<div class="form-group">
									<h5>Directly Send</h5>
									<div id="gridsendiripenerimasurat"></div>
								</div>
                            </div>
							<div class="card-body divgridsendiricari">
                           		<div class="row">
									<div class="col-lg-4">
										<button type="button" class="btn btn-danger" id="btntutupgridsendiricari">
											<i class="fa fa-close"></i>
										</button>
									</div>
									<div class="col-lg-8">
									
									</div>
								</div>
								<div class="form-group">
									<label id="judulloadingcari"></label>
									<div id="pdfRenderercari"></div>
                                </div>
                            	<div class="form-group">
									<div id="gridsendiricari"></div>
                                </div>
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
						        	<button class="btn btn-tool" id="btnviewallkegiatan"><i class="fa fa-search"></i> View All Event</button>
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
										<div class="col-lg-6">
											<a href="#" class="btn btn-block btn-danger" id="btnklosetambahnotulensi">
												<i class="fa fa-arrow-left"></i><span class="pull-right">Cancel</span>
											</a>
										</div>
										<div class="col-lg-6">
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
								<li class="nav-item"><a href="#" class="nav-link btnopensuratkeluar"><i class="fa fa-paper-plane-o"></i> Tambah Surat Keluar<span class="badge badge-primary float-right countsuratkeluar">0</span></a></li>
								<li class="nav-item"><a href="#" class="nav-link btnopenskdanperaturan"><i class="fa fa-clone"></i> Tambah SK dan Peraturan<span class="badge badge-primary float-right countsk">0</span></a></li>
								<li class="nav-item"><a href="#" class="nav-link btnopendataevent"><i class="fa fa-calendar-plus-o"></i> Event / Organizer<span class="badge badge-primary float-right countevent">0</span></a></li>
								<li class="nav-item"><a href="#" class="nav-link btnopendatanotulensi"><i class="fa fa-edit"></i> Notulensi<span class="badge badge-primary float-right countnotulensi">0</span></a></li>
							</ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
    <div id="tabel_cetak"></div>
	<div class="col-md-2">
			<div class="input-group date" data-target-input="nearest">
			<input value="{{date('Y')}}" type="text" class="form-control" id="tahunsuratkeluar" name="tahunsuratkeluar"/>
			<div class="input-group-append">
				<div class="input-group-text"><i class="fa fa-calendar"></i></div>
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6">
		<label>Klasifikasi Arsip *)</label>
		<input type="text" class="form-control" placeholder="Klik Tombol Cari" id="man_klasifikasiarsip" name="man_klasifikasiarsip">
	</div>
	<div id="timeremaining" class="pull-right"></div>
	<div class="col-lg-4 col-md-4">
		<label>Kode Arsip *)</label>
		<input type="text" class="form-control" placeholder="Klik Tombol Cari" id="nom_klasifikasiarsip" name="nom_klasifikasiarsip">
	</div>
	<div class="form-group">
		<div class="row">
			<div class="col-lg-6">
				<label for="id_filedepan">File Sertifikat Depan (1028 x 720)</label><br />
				<input id="id_filedepan" name="id_filedepan" type="file"/>
			</div>
			<div class="col-lg-6">
				<label for="id_filebelakang">File Sertifikat Belakang (1100 x 800)</label><br />
				<input id="id_filebelakang" name="id_filebelakang" type="file"/>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<div class="col-lg-6">
				<img id="previewdepan" src="{{asset('dist/img/boxed-bg.jpg')}}" width="150px" height="150px"/>
			</div>
			<div class="col-lg-6">
				<img id="previewbelakang" src="{{asset('dist/img/boxed-bg.jpg')}}" width="150px" height="150px"/>
			</div>
		</div>
	</div>
	<input type="file" id="id_fotoprofile">
    <input type="file" id="id_fotoprofile2">
    <input type="file" id="id_fotoprofile3">
    <input type="file" id="id_fotoprofile4">
    <input type="file" id="id_fotoprofile5">
    <input type="file" id="id_fotoprofile6">
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
</div><!-- /.modal -->
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
		CKEDITOR.replace( 'notulensi_isi' );
		CKEDITOR.replace( 'buka_catatan', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles", "list"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90	
		});
		CKEDITOR.replace( 'buka_disposisi', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles", "list"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90	
		});
		CKEDITOR.replace( 'kirim_keterangan', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles", "list"]}],
			removeButtons: '',
			width: '100%',
			height: 50	
		});
		CKEDITOR.replace( 'id_kontak', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles", "list"]}],
			removeButtons: '',
			width: '100%',
			height: 70	
		});
		CKEDITOR.replace( 'id_pembicara', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles", "list"]}],
			removeButtons: '',
			width: '100%',
			height: 70	
		});
		CKEDITOR.replace( 'id_linkwebinar', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles", "list"]}],
			removeButtons: '',
			width: '100%',
			height: 70	
		});
		$('#sk_tanggalundang').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#sk_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#kirim_tglmulai').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#kirim_tglselesai').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$("#kirim_jammulai").timepicker({format: 'HH:mm:ss'});
		$("#kirim_jamselesai").timepicker({format: 'HH:mm:ss'});
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
		$('#man_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#id_tglsurat').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#id_tglmasuk').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
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
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.readAsDataURL(input.files[0]);
			reader.onload = function (e) {
				$('#preview').attr('src', e.target.result);
			};
		}
	}
	function readURLBack(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.readAsDataURL(input.files[0]);
			reader.onload = function (e) {
				$('#previewbelakang').attr('src', e.target.result);
			};
		}
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
	function CountDownTimer(dt, id){
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
	function readURLAddmhs(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#imagenumber1').attr('href', e.target.result);
                $('#preview').attr('src', e.target.result);
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
            };
        }
    }
$(document).ready(function () {
	getnotifcount();
	$('.select2').select2({width: '100%'});
    $('#divsuratkeluartnpnomor').hide();
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
	$('#divdisposisi').hide();
    $('#divkalender').show();
	//KELOMPOK_SURAT_MASUK
		$('.btnopensuratmasuk').click(function () {
			$('#divsuratkeluartnpnomor').hide();
			$('#divkegiatan').hide();
			$('#divskdanperaturan').hide();
			$('#divsuratmasuk').show();
			$('#divsuratkeluar').hide();
			$('#divdirisendiri').hide();
			$('#divinputsuratmasuk').hide();
			$('#divinputsuratkeluarmaju').hide();
			$('#divinputsuratkeluarmundur').hide();
			$('#divuploadersurat').hide();
			$('#divdisposisi').hide();
			$('#divkalender').hide();
			var sumbersuratmasuk = {
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
				data		: {dari:'', jenis:'', _token: '{{ csrf_token() }}'},
				type		: 'POST',
				url			: '{{ route("inboxSuratmasukPaged") }}',
				root		: 'data',
				totalrecords: 'total',
				cache		: false,
				filter		: function () {
					$("#tabelsuratmasuk").jqxGrid('updatebounddata', 'filter');
				},
				sort: function () {
					$("#tabelsuratmasuk").jqxGrid('updatebounddata', 'sort');
				},
				beforeprocessing: function (data) {
					if (data != null) {
						sumbersuratmasuk.totalrecords = data.total;
					}
				}
			};
			var datajsrtmasuk = new $.jqx.dataAdapter(sumbersuratmasuk);
			var rendergridrows = $('#tabelsuratmasuk').jqxGrid('rendergridrows');
			$("#tabelsuratmasuk").jqxGrid({
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
				source			: datajsrtmasuk,
				pagesizeoptions	: ['10', '20', '30', '50'],
				theme			: "darkblue",
				altrows			: true,
				columns			: [
					{ text: 'Surat', editable: false, sortable: false, filterable: false, columntype: 'button', width: 50, cellsrenderer: function () {
						return "Preview";
						}, buttonclick: function (row) {
							editrow = row;	
							var offset 		= $("#tabelsuratmasuk").offset();		
							var dataRecord 	= $("#tabelsuratmasuk").jqxGrid('getrowdata', editrow);
							var set02		= dataRecord.klasifikasi;
							var cekasal 	= dataRecord.subkode;
							var set03		= '{{URL::to("/")}}/viewdocbyname/'+dataRecord.scansurat;
							var newWindow 	= window.open('', '', 'width=800, height=500'),
								document 	= newWindow.document.open(),
								pageContent =
									'<!DOCTYPE html>\n' +
									'<html>\n' +
									'<head>\n' +
									'<meta charset="utf-8" />\n' +
									'<title>Preview Surat</title>\n' +
									'</head>\n' +
									'<body><iframe width="100%" height="500" src="'+set03+'"></iframe></body>\n</html>';
								document.write(pageContent);
								document.close();
							return false;
						}
					},
					{ text: 'Disposisi', editable: false, sortable: false, filterable: false, columntype: 'button', width: 50, cellsrenderer: function () {
						return "Cetak";
						}, buttonclick: function (row) {		
							editrow = row;	
							var offset 		= $("#tabelsuratmasuk").offset();		
							var dataRecord 	= $("#tabelsuratmasuk").jqxGrid('getrowdata', editrow);						
							var set01		= dataRecord.id;
							var url 		= '{{URL::to("/")}}/viewsurat/disposisi-' + set01;
							var newWindow 	= window.open('', '', 'width=800, height=500'),
								document 	= newWindow.document.open(),
								pageContent =
									'<!DOCTYPE html>\n' +
									'<html>\n' +
									'<head>\n' +
									'<meta charset="utf-8" />\n' +
									'<title>Preview Surat</title>\n' +
									'</head>\n' +
									'<body><iframe width="100%" height="500" src="'+url+'"></iframe></body>\n</html>';
								document.write(pageContent);
								document.close();
							return false;
						}
					},
					{ text: 'Edit', editable: false, sortable: false, filterable: false, columntype: 'button', width: 50, cellsrenderer: function () {
						return "Edit";
						}, buttonclick: function (row) {
							editrow 		= row;	
							var offset 		= $("#tabelsuratmasuk").offset();		
							var dataRecord 	= $("#tabelsuratmasuk").jqxGrid('getrowdata', editrow);
							$("#id_klasifikasiarsip").val(dataRecord.faskode);
							$("#id_noagenda").val(dataRecord.noagenda);
							$("#id_tglmasuk").val(dataRecord.tglmasuk);
							$("#id_tglsurat").val(dataRecord.tglsurat);
							$("#id_nosurat").val(dataRecord.nosurat);
							$("#id_jenissurat").val(dataRecord.jenis).select2().trigger('change');
							$("#id_asalsurat").val(dataRecord.asalsurat);
							$("#set_kepada").val(dataRecord.kepada).select2().trigger('change');
							$("#id_lampiran").val(dataRecord.lampiran);
							$("#id_perihal").val(dataRecord.perihal);
							$("#id_subyek").val(dataRecord.subyek);
							$("#id_sifat").val(dataRecord.sifat);
							$("#id_bentuk").val(dataRecord.bentuk);
							$("#id_klasifikasi").val(dataRecord.klasifikasi);
							$("#id_idsurat").val(dataRecord.id);
							$("#id_ringkasan").val(dataRecord.ringkasan);
							$("#file").val('');
							$('#divinputsuratmasuk').show();
							$('#divsuratmasuk').hide();
						}
					},
					{ text: 'Inputor', datafield: 'pembuat', filtertype: 'checkedlist', width: 120, cellsalign: 'center', align: 'center'  },
					{ text: 'Status', filtertype: 'checkedlist', datafield: 'tulistatus', width: 80, cellsalign: 'center', align: 'center'  },
					{ text: 'Tujuan', filtertype: 'checkedlist', datafield: 'kepada', width: 100, cellsalign: 'left', align: 'center'  },
					{ text: 'Agenda', datafield: 'noagenda', width: 60, cellsalign: 'center', align: 'center'  },
					{ text: 'No.Surat', datafield: 'nosurat', width: 120, cellsalign: 'left', align: 'center'  },
					{ text: 'Asal Surat', datafield: 'asalsurat', width: 120, cellsalign: 'left', align: 'center'  },
					{ text: 'Perihal', datafield: 'perihal', width: 150, cellsalign: 'left', align: 'center'  },
					{ text: 'Tgl.Masuk', datafield: 'tglmasuk', width: 90, cellsalign: 'center', align: 'center'  },
					{ text: 'Tgl.Surat', datafield: 'tglsurat', width: 90, cellsalign: 'center', align: 'center'  },		
					{ text: 'Hapus', editable: false, sortable: false, filterable: false, columntype: 'button', width: '9%', align: 'center', cellsrenderer: function () {
						return "Hapus";
						}, buttonclick: function (row) {
							editrow = row;
							var offset 		= $("#tabelsuratmasuk").offset();
							var dataRecord 	= $("#tabelsuratmasuk").jqxGrid('getrowdata', editrow);
							swal({
								title: 'Apakah Anda Yakin.?',
								text: "Surat Ini Apabila Belum di Disposisi akan kami hapus dan tidak bisa di recover kembali. Apakah Anda Yakin.?",
								type: 'warning',
								showCancelButton: true,
								confirmButtonClass: 'btn btn-confirm mt-2',
								cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
								confirmButtonText: 'Yes, Delete It.!'
							}).then(function () {
								var set01		= dataRecord.id;
								$.post('{{ route("deletesrtmasuk") }}', { val01: set01, _token: '{{ csrf_token() }}' }, function(data){					
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
									$("#tabelsuratmasuk").jqxGrid('updatebounddata', 'filter');
									return false;
								});
							});
						}
					},
				],
			});
		});
		$('#btntambahdata').on('click', function (){
			var kirim = 'getnumber';
			$.post('{{ route("getnoagenda") }}', { val01: kirim, _token: '{{ csrf_token() }}' },
			function(data){
				var status  = data.status;
				var message = data.message;
				$('#divinputsuratmasuk').show();
				$('#divsuratmasuk').hide();
				$("#id_noagenda").val(message);
				$("#id_tglmasuk").val('{{date("Y-m-d")}}');
				$("#id_tglsurat").val('{{date("Y-m-d")}}');
				$("#id_nosurat").val('');
				$("#id_jenissurat").val('S').select2().trigger('change');
				$("#id_subyek").val('TU');
				$("#id_lampiran").val('-');
				$("#id_asalsurat").val('');
				$("#id_perihal").val('');
				$("#id_idsurat").val('baru');
				$("#file").val('');
				$("#id_ringkasan").val('');
				$("#id_klasifikasiarsip").val('TU.00.1');
				return false;
			});		
		});
		$("#simpansuratmsk").click(function(){
			var set01 	= document.getElementById('file');
			var set02	= document.getElementById('id_noagenda').value;
			var set03	= document.getElementById('id_tglmasuk').value;
			var set04	= document.getElementById('id_tglsurat').value;
			var set05	= document.getElementById('id_nosurat').value;
			var set06	= document.getElementById('id_jenissurat').value;
			var set07	= document.getElementById('id_asalsurat').value;
			var set08	= document.getElementById('id_lampiran').value;
			var set09	= document.getElementById('id_perihal').value;
			var set10	= document.getElementById('id_subyek').value;
			var set11	= document.getElementById('id_klasifikasiarsip').value;
			var set13	= document.getElementById('id_ringkasan').value;
			var set14	= document.getElementById('id_sifat').value;
			var set15	= document.getElementById('id_bentuk').value;
			var set16	= document.getElementById('id_klasifikasi').value;
			var set17	= document.getElementById('id_idsurat').value;
			var token 	= document.getElementById('token').value;
			var set12	= $('#set_kepada').select2('data');
			var kepada 	= new Array();
			var keys = Object.keys(set12),
				len = keys.length,
				i = 0,
				prop,
				value;
			while (i < len) {
				prop 	= keys[i];
				value 	= set12[prop];
				kepada.push({
					"id" : value.id
				});
				i += 1;
			}
			var jsonkepada = JSON.stringify(kepada);
			if ($('#file').val() == '' && set17 == 'baru'){
				swal({
					title	: 'Stop',
					text	: 'Mohon Pilih File Scannya terlebih dahulu '+set17,
					type	: 'warning',
				})
			} else if (set02 == ''){
				swal({
					title	: 'Stop',
					text	: 'Mohon Tulis No. Agenda Anda',
					type	: 'warning',
				})
			} else if (set03 == ''){
				swal({
					title	: 'Stop',
					text	: 'Mohon Tulis Tanggal Surat Masuknya',
					type	: 'warning',
				})
			} else if (set04 == ''){
				swal({
					title	: 'Stop',
					text	: 'Mohon Tulis Tanggal Suratnya',
					type	: 'warning',
				})
			} else if (set06 == ''){
				swal({
					title	: 'Stop',
					text	: 'Mohon Pilih Jenis Suratnya',
					type	: 'warning',
				})
			} else if (set07 == ''){
				swal({
					title	: 'Stop',
					text	: 'Mohon Tulis Asal Suratnya / Pengirim',
					type	: 'warning',
				})
			} else if (set10 == ''){
				swal({
					title	: 'Stop',
					text	: 'Mohon Pilih Subyek Suratnya',
					type	: 'warning',
				})
			} else if (i == 0){ 
				swal({
					title	: 'Stop',
					text	: 'Mohon Pilih Penerima Surat ini',
					type	: 'warning',
				})
			} else {
				$('#loading').show();
				$('#divinputsuratmasuk').hide();
				var form_data = new FormData();
					form_data.append('file', set01.files[0]);
					form_data.append('id_noagenda', set02);
					form_data.append('id_tglmasuk', set03);
					form_data.append('id_tglsurat', set04);
					form_data.append('id_nosurat', set05);
					form_data.append('id_jenissurat', set06);
					form_data.append('id_asalsurat', set07);
					form_data.append('id_perihal', set09);
					form_data.append('id_ringkasan', set13);
					form_data.append('id_sifat', set14);
					form_data.append('id_bentuk', set15);
					form_data.append('id_klasifikasi', set16);
					form_data.append('id_idsurat', set17);
					form_data.append('id_subyek', set10);
					form_data.append('id_lampiran', set08);
					form_data.append('set_kepada[]', jsonkepada);
					form_data.append('id_klasifikasiarsip', set11);
					form_data.append('_token', '{{csrf_token()}}');
				$.ajax({
					url: '{{ route("exUpdsuratMasuk") }}',
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
						$('#divsuratmasuk').show();
						$("html, body").animate({ scrollTop: 0 }, "slow");
						$("#tabelsuratmasuk").jqxGrid('updatebounddata', 'filter');	
						return false;
					},
					error: function (xhr, status, error) {
						alert(xhr.responseText);
					}
				});
			}
		});
		$('#btnviewtracking').click(function () {
			var set01=document.getElementById('cari_dari').value;
			var set02=document.getElementById('cari_jenis').value;
			if (set01 == ''){
				$('#divmasukawal').show();
				$('#divmasukcari').hide();
			} else {
				$('#divmasukawal').hide();
				$('#divmasukcari').show();
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
					data		: {dari:set01, jenis:set02, _token: '{{ csrf_token() }}'},
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
				var rendergridrows = $('#tabelcari').jqxGrid('rendergridrows');
				$("#tabelcari").jqxGrid({
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
						{ text: 'Surat', editable: false, sortable: false, filterable: false, columntype: 'button', width: 50, cellsrenderer: function () {
							return "Preview";
							}, buttonclick: function (row) {
								editrow = row;	
								var offset 		= $("#tabelsuratmasuk").offset();		
								var dataRecord 	= $("#tabelsuratmasuk").jqxGrid('getrowdata', editrow);
								var set02		= dataRecord.klasifikasi;
								var cekasal 	= dataRecord.subkode;
								var set03		= '{{URL::to("/")}}/viewdocbyname/'+dataRecord.scansurat;
								var newWindow 	= window.open('', '', 'width=800, height=500'),
									document 	= newWindow.document.open(),
									pageContent =
										'<!DOCTYPE html>\n' +
										'<html>\n' +
										'<head>\n' +
										'<meta charset="utf-8" />\n' +
										'<title>Preview Surat</title>\n' +
										'</head>\n' +
										'<body><iframe width="100%" height="500" src="'+set03+'"></iframe></body>\n</html>';
									document.write(pageContent);
									document.close();
								return false;
							}
						},
						{ text: 'Disposisi', editable: false, sortable: false, filterable: false, columntype: 'button', width: 50, cellsrenderer: function () {
							return "Cetak";
							}, buttonclick: function (row) {		
								editrow = row;	
								var offset 		= $("#tabelsuratmasuk").offset();		
								var dataRecord 	= $("#tabelsuratmasuk").jqxGrid('getrowdata', editrow);						
								var set01		= dataRecord.id;
								var url 		= '{{URL::to("/")}}/viewsurat/disposisi-' + set01;
								var newWindow 	= window.open('', '', 'width=800, height=500'),
									document 	= newWindow.document.open(),
									pageContent =
										'<!DOCTYPE html>\n' +
										'<html>\n' +
										'<head>\n' +
										'<meta charset="utf-8" />\n' +
										'<title>Preview Surat</title>\n' +
										'</head>\n' +
										'<body><iframe width="100%" height="500" src="'+url+'"></iframe></body>\n</html>';
									document.write(pageContent);
									document.close();
								return false;
							}
						},
						{ text: 'Edit', editable: false, sortable: false, filterable: false, columntype: 'button', width: 50, cellsrenderer: function () {
							return "Edit";
							}, buttonclick: function (row) {
								editrow 		= row;	
								var offset 		= $("#tabelsuratmasuk").offset();		
								var dataRecord 	= $("#tabelsuratmasuk").jqxGrid('getrowdata', editrow);
								$("#id_klasifikasiarsip").val(dataRecord.faskode);
								$("#id_noagenda").val(dataRecord.noagenda);
								$("#id_tglmasuk").val(dataRecord.tglmasuk);
								$("#id_tglsurat").val(dataRecord.tglsurat);
								$("#id_nosurat").val(dataRecord.nosurat);
								$("#id_jenissurat").val(dataRecord.jenis).select2().trigger('change');
								$("#id_asalsurat").val(dataRecord.asalsurat);
								$("#set_kepada").val(dataRecord.kepada).select2().trigger('change');
								$("#id_lampiran").val(dataRecord.lampiran);
								$("#id_perihal").val(dataRecord.perihal);
								$("#id_subyek").val(dataRecord.subyek);
								$("#id_sifat").val(dataRecord.sifat);
								$("#id_bentuk").val(dataRecord.bentuk);
								$("#id_klasifikasi").val(dataRecord.klasifikasi);
								$("#id_idsurat").val(dataRecord.id);
								$("#id_ringkasan").val(dataRecord.ringkasan);
								$("#file").val('');
								$('#divinputsuratmasuk').show();
								$('#divsuratmasuk').hide();
							}
						},
						{ text: 'Inputor', datafield: 'pembuat', filtertype: 'checkedlist', width: 120, cellsalign: 'center', align: 'center'  },
						{ text: 'Status', filtertype: 'checkedlist', datafield: 'tulistatus', width: 80, cellsalign: 'center', align: 'center'  },
						{ text: 'Tujuan', filtertype: 'checkedlist', datafield: 'kepada', width: 100, cellsalign: 'left', align: 'center'  },
						{ text: 'Agenda', datafield: 'noagenda', width: 60, cellsalign: 'center', align: 'center'  },
						{ text: 'No.Surat', datafield: 'nosurat', width: 120, cellsalign: 'left', align: 'center'  },
						{ text: 'Asal Surat', datafield: 'asalsurat', width: 120, cellsalign: 'left', align: 'center'  },
						{ text: 'Perihal', datafield: 'perihal', width: 150, cellsalign: 'left', align: 'center'  },
						{ text: 'Tgl.Masuk', datafield: 'tglmasuk', width: 90, cellsalign: 'center', align: 'center'  },
						{ text: 'Tgl.Surat', datafield: 'tglsurat', width: 90, cellsalign: 'center', align: 'center'  },		
						{ text: 'Hapus', editable: false, sortable: false, filterable: false, columntype: 'button', width: '9%', align: 'center', cellsrenderer: function () {
							return "Hapus";
							}, buttonclick: function (row) {
								editrow = row;
								var offset 		= $("#tabelsuratmasuk").offset();
								var dataRecord 	= $("#tabelsuratmasuk").jqxGrid('getrowdata', editrow);
								swal({
									title: 'Apakah Anda Yakin.?',
									text: "Surat Ini Apabila Belum di Disposisi akan kami hapus dan tidak bisa di recover kembali. Apakah Anda Yakin.?",
									type: 'warning',
									showCancelButton: true,
									confirmButtonClass: 'btn btn-confirm mt-2',
									cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
									confirmButtonText: 'Yes, Delete It.!'
								}).then(function () {
									var set01		= dataRecord.id;
									$.post('{{ route("deletesrtmasuk") }}', { val01: set01, _token: '{{ csrf_token() }}' }, function(data){					
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
										$("#tabelsuratmasuk").jqxGrid('updatebounddata', 'filter');
										return false;
									});
								});
							}
						},
					],
				});
			}
		});
	//END_KELOMPOK_SURAT_MASUK
	//KELOMPOK_SURAT_KELUAR
		$('.btnopensuratkeluar').click(function () {
			$('#divsuratkeluartnpnomor').hide();
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
			var tahun 		= document.getElementById('tahunsuratkeluar').value;
			var sumbersuratkeluar = {
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
					},
					{ text: 'Send', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
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
			if (val03 == 'Ya' && val04 == ''){
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
		$('#btntambahnomormaju').click(function () {
			var set01="{!! Session('nama') !!}";
			var set02="{!! Session('previlage') !!}";
			$("#nom_kelompok").val(set02);
			$('#nom_ubahnama').val(set01).trigger('change');
			$("#nom_klasifikasiarsip").val('TU.00.1');
			$("#nom_jumlah").val('1');
			$("#nom_perihal").val('');
			$('#divinputsuratkeluarmaju').show();
			$('#divsuratkeluar').hide();
		});
		$('#btntambahnomormundur').click(function () {
			var set01="{!! Session('nama') !!}";
			var set02="{!! Session('previlage') !!}";
			$("#man_kelompok").val(set02);
			$('#man_ubahnama').val(set01).trigger('change');
			$("#man_klasifikasiarsip").val('TU.00.1');
			$('#divinputsuratkeluarmundur').show();
			$('#divsuratkeluar').hide();
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
			var val09=document.getElementById('nom_jenissrt').value;
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
		$("#btngetnomormundur").click(function(){
			var val01=document.getElementById('man_tanggal').value;
			var val02=document.getElementById('man_klasifikasi').value;
			var val03=document.getElementById('man_klasifikasiarsip').value;
			var val04=document.getElementById('man_kodepjbt').value;
			var val05=document.getElementById('man_sifat').value;
			var val06=document.getElementById('man_nama').value;
			var val07=document.getElementById('man_kelompok').value;
			var val08=document.getElementById('man_jenissrt').value;
			if (val02 == ''){ var val02 = 'TU.00.1';}
			if (val01 == '' || val02 == '' || val03 == '' || val04 == '' || val05 == '' || val06 == '' || val08 == ''){
				swal({
					title	: 'Stop',
					text	: 'Semua Form Wajib di isi terlebih dahulu, apabila ada yg tidak diketahui mohon di isi dengan tanda dash (-)',
					type	: 'warning',
				})
			} else {
				$('#loading').show();
				$('#divinputsuratkeluarmundur').hide();
				$.post('{{ route("exmanualsrtklrmundur") }}', { set01: val01, set02: val02, set03: val03, set04: val04, set05: val05, set06: val06, set07: val07, set08: val08, set09: '', set10: 'mundur', _token: '{{ csrf_token() }}' },
				function(data){
					$('#loading').hide();
					$('#divsuratkeluar').show();
					$("#message").html(data);
					$("#gridsuratkeluar").jqxGrid('updatebounddata', 'filter');
					return false;
				});
			}
		});
		$("#btnuploadfile").click(function(){
			var set01 	= document.getElementById('upload_file');
			var set02	= document.getElementById('upload_jenissrt').value;
			var set03	= document.getElementById('upload_tanggal').value;
			var set04	= '';
			var set05	= document.getElementById('id_namapenandatangan').value;
			var set06	= document.getElementById('idparaf1').value;
			var set07	= document.getElementById('idparaf2').value;
			var set08	= document.getElementById('idparaf3').value;
			var set09	= document.getElementById('idparaf4').value;
			var set10	= document.getElementById('upload_marking').value;
			var set11	= document.getElementById('upload_idne').value;
			var set12	= document.getElementById('upload_perihal').value;
			var set13	= document.getElementById('upload_tahunagenda').value;
			var set14	= document.getElementById('upload_noagenda').value;
			if (set02 == 'BIASA'){
				var jenissrt = 'BIASA';
			} else {
				var jenissrt = 'TTE';
			}
			if ($('#upload_file').val() == ''){
				swal({
					title	: 'Stop',
					text	: 'Mohon Upload Filenya terlebih dahulu',
					type	: 'warning',
				})
			} else if (set05 == '' && jenissrt == 'TTE'){
				swal({
					title	: 'Stop',
					text	: 'Penandatangan Wajib dipilih terlebih dahulu',
					type	: 'warning',
				})
			} else if (set06 == ''  && jenissrt == 'TTE'){
				swal({
					title	: 'Stop',
					text	: 'Pemaraf 1 Minimal Wajib dipilih terlebih dahulu',
					type	: 'warning',
				})
			} else {
				$('#loading').show();
				$('#divuploadersurat').hide();
				var form_data = new FormData();
					form_data.append('file', set01.files[0]);
					form_data.append('val02', set02);
					form_data.append('val03', set03);
					form_data.append('val04', set04);
					form_data.append('val05', set05);
					form_data.append('val06', set06);
					form_data.append('val07', set07);
					form_data.append('val08', set08);
					form_data.append('val09', set09);
					form_data.append('val10', set10);
					form_data.append('val11', set11);
					form_data.append('val12', set12);
					form_data.append('val13', set13);
					form_data.append('val14', set14);
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
							heading: status,
							text: message,
							position: 'top-right',
							loaderBg: warna,
							icon: icon,
							hideAfter: 5000,
							stack: 1
						});
						$('#loading').hide();
						$('#divsuratkeluar').show();
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
		$('.btnkembalikelamansuratkeluar').click(function () {
			var val10=document.getElementById('kirim_kelompok').value;
			if (val10 == 'KELUAR'){
				$('#divtambahpenerima').hide();
				$('#divsuratkeluar').show();
			} else {
				$('#divtambahpenerima').hide();
				$('#divskdanperaturan').show();
			}
		});
	//END_KELOMPOK_SURAT_KELUAR
	//STAR_SKDANPERATURAN
		$('#btntambahnomorsk').click(function () {
			$("#sk_idne").val('new');
			$("#upload_filesk").val('');
			$('.divinputsk').show();
			$('.divskawal').hide();
		});
		$('.btnopenskdanperaturan').click(function () {
			$('#divsuratkeluartnpnomor').hide();
			$('#divkegiatan').hide();
			$('#divskdanperaturan').show();
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
			$('.divinputsk').hide();
			$('.divskawal').show();
			var tahun 		= document.getElementById('tahunsuratkeluar').value;
			var sumbersuratsk = {
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
				],
				updaterow: function (rowid, rowdata, commit) {commit(true);},
				type		: 'POST',
				data		: {	val01:tahun,tahun:tahun, _token: '{{ csrf_token() }}' },
				url			: '{{ route("getskdanperaturan") }}',
				root		: 'data',
				totalrecords: 'total',
				cache		: false,
				filter		: function () {
					$("#gridskdaperaturan").jqxGrid('updatebounddata', 'filter');
				},
				sort: function () {
					$("#gridskdaperaturan").jqxGrid('updatebounddata', 'sort');
				},
				beforeprocessing: function (data) {
					if (data != null) {
						sumbersuratsk.totalrecords = data.total;
					}
				}
			};
			var datajsrtsk = new $.jqx.dataAdapter(sumbersuratsk);
			var rendergridrows = $('#gridskdaperaturan').jqxGrid('rendergridrows');
			$("#gridskdaperaturan").jqxGrid({
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
				source			: datajsrtsk,
				pagesizeoptions	: ['10', '20', '30'],
				theme			: "energyblue",
				altrows			: true,
				columns			: [
					{ text: 'Edit/Replace', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
						return "Edit";
						}, buttonclick: function (row) {
							editrow 		= row;
							var offset 		= $("#gridskdaperaturan").offset();
							var dataRecord 	= $("#gridskdaperaturan").jqxGrid('getrowdata', editrow);
							$("#upload_filesk").val('');
							$("#sk_nomor").val(dataRecord.nomor);
							$("#sk_tanggal").val(dataRecord.tanggal);
							$("#sk_tahunagenda").val(dataRecord.dasarsuratyy);
							$("#sk_noagenda").val(dataRecord.dasarsuratno);
							$("#sk_jenis").val(dataRecord.kelompok);
							$("#sk_kodepjbt").val(dataRecord.idpejabat).trigger('change');
							$("#sk_tanggalundang").val(dataRecord.tglpjbperundang);
							$("#sk_kodepjbtundang").val(dataRecord.idpjbperundang).trigger('change');
							$("#sk_judul").val(dataRecord.judul);
							$("#sk_idparaf1").val(dataRecord.paraf1).trigger('change');
							$("#sk_idparaf2").val(dataRecord.paraf2).trigger('change');
							$("#sk_idparaf3").val(dataRecord.paraf3).trigger('change');
							$("#sk_idparaf4").val(dataRecord.paraf4).trigger('change');
							$("#sk_idne").val(dataRecord.id);
							$('.divinputsk').show();
							$('.divskawal').hide();
						}
					},
					{ text: 'Send', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
						return "Send";
						}, buttonclick: function (row) {		
							editrow = row;	
							var offset 		= $("#gridskdaperaturan").offset();		
							var dataRecord 	= $("#gridskdaperaturan").jqxGrid('getrowdata', editrow);
							$("#kirim_id").val(dataRecord.id);
							$("#kirim_nomor").val(dataRecord.nomor);
							$("#kirim_perihal").val(dataRecord.judul);
							$("#kirim_kegiatan").val(dataRecord.judul);
							$("#kirim_tglmulai").val(dataRecord.tanggal);
							$("#kirim_tglselesai").val(dataRecord.tanggal);
							$("#kirim_kelompok").val('SKDANPERATURAN');
							CKEDITOR.instances['kirim_keterangan'].setData('')
							$('#divskdanperaturan').hide();
							$('#divtambahpenerima').show();
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
								data: {	val01:dataRecord.id, val02:'SKDANPERATURAN', val03:'SKDANPERATURAN',  _token: '{{ csrf_token() }}' },
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
					{ text: 'QrCode', editable: false, sortable: false, filterable: false,columntype: 'button', width: '5%', align: 'center', cellsrenderer: function () {
						return "Get";
						}, buttonclick: function (row) {
							editrow         = row;
							var offset 		= $("#gridskdaperaturan").offset();
							var dataRecord 	= $("#gridskdaperaturan").jqxGrid('getrowdata', editrow);
							window.open("{{URL::to("/")}}/downloadqr/"+dataRecord.marking, "_blank");
						}
					},
					{ text: 'Kelompok', datafield: 'tlskelompok', width: '10%', cellsalign: 'center', align: 'center'},
					{ text: 'Nomor', datafield: 'tlsnomor', width: '10%', cellsalign: 'center', align: 'center'},
					{ text: 'Tanggal', datafield: 'tlstanggal', width: '10%', cellsalign: 'center', align: 'center'  },
					{ text: 'SK Tentang', datafield: 'tlsjudul', width: '25%', cellsalign: 'left', align: 'center'  },
					{ text: 'Keterangan', datafield: 'status', width: '23%', cellsalign: 'left', align: 'center'  },
					{ text: 'Hapus', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', align: 'center', cellsrenderer: function () {
						return "Hapus";
						}, buttonclick: function (row) {
							editrow = row;
							var offset 		= $("#gridskdaperaturan").offset();
							var dataRecord 	= $("#gridskdaperaturan").jqxGrid('getrowdata', editrow);
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
								$.post('{{ route("hapussrtkeluar") }}', { val01: dataRecord.id, val02: 'MANUAL', val03: 'SKDANPERATURAN', _token: '{{ csrf_token() }}' }, function(data){					
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
		});
		$("#btnuploadfilesk").click(function(){
			var set01 	= document.getElementById('upload_filesk');
			var set02	= document.getElementById('sk_jenis').value;
			var set03	= document.getElementById('sk_tanggal').value;
			var set04	= 'SKDANPERATURAN';
			var set05	= document.getElementById('sk_kodepjbt').value;
			var set06	= document.getElementById('sk_idparaf1').value;
			var set07	= document.getElementById('sk_idparaf2').value;
			var set08	= document.getElementById('sk_idparaf3').value;
			var set09	= document.getElementById('sk_idparaf4').value;
			var set10	= document.getElementById('sk_tahunagenda').value;
			var set11	= document.getElementById('sk_idne').value;
			var set12	= document.getElementById('sk_judul').value;
			var set13	= document.getElementById('sk_tanggalundang').value;
			var set14	= document.getElementById('sk_kodepjbtundang').value;
			var set15	= document.getElementById('sk_nomor').value;
			var set16	= document.getElementById('sk_noagenda').value;
			if (set02 == 'SKDANPERATURAN' || set02 == 'PERATURAN' || set02 == 'INSTRUKSI'){
				var jenissrt = 'BIASA';
			} else {
				var jenissrt = 'TTE';
			}
			if (set05 == '' && jenissrt == 'TTE'){
				swal({
					title	: 'Stop',
					text	: 'Penandatangan Wajib dipilih terlebih dahulu',
					type	: 'warning',
				})
			} else if (set06 == ''  && jenissrt == 'TTE'){
				swal({
					title	: 'Stop',
					text	: 'Pemaraf 1 Minimal Wajib dipilih terlebih dahulu',
					type	: 'warning',
				})
			} else {
				$('#loading').show();
				$('#divskdanperaturan').hide();
				var form_data = new FormData();
					form_data.append('file', set01.files[0]);
					form_data.append('val02', set02);
					form_data.append('val03', set03);
					form_data.append('val04', set04);
					form_data.append('val05', set05);
					form_data.append('val06', set06);
					form_data.append('val07', set07);
					form_data.append('val08', set08);
					form_data.append('val09', set09);
					form_data.append('val10', set10);
					form_data.append('val11', set11);
					form_data.append('val12', set12);
					form_data.append('val13', set13);
					form_data.append('val14', set14);
					form_data.append('val15', set15);
					form_data.append('val16', set16);
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
							heading: status,
							text: message,
							position: 'top-right',
							loaderBg: warna,
							icon: icon,
							hideAfter: 5000,
							stack: 1
						});
						$('#loading').hide();
						$('#divskdanperaturan').show();
						$('.divinputsk').hide();
						$('.divskawal').show();
						$("#gridskdaperaturan").jqxGrid('updatebounddata', 'filter');
						return false;
					},
					error: function (xhr, status, error) {
						$('#loading').hide();
						$('#divskdanperaturan').show();
						swal({
							title	: 'Stop',
							text	: xhr.responseText,
							type	: 'error',
						})
					}
				});
			}
		});
	//END_SKDANPERATURAN
	//KELOMPOK_EVENT
		$('.btnopendataevent').click(function () {
			$('#divsuratkeluartnpnomor').hide();
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
			$('.divawalkegiatan').show();
			$('.divdetailkegiatan').hide();
			$('.divtambahkegiatan').hide();
			var token=document.getElementById('token').value;
			var source = {
				datatype: "json",
				datafields: [
					{ name: 'idne'},
					{ name: 'peserta', type: 'text'},
					{ name: 'tlskegiatan', type: 'text'},
					{ name: 'nama', type: 'text'},
					{ name: 'tempat', type: 'text'},
					{ name: 'kapasitas', type: 'text'},
					{ name: 'tanggal', type: 'text'},
					{ name: 'mulai', type: 'text'},
					{ name: 'akhir', type: 'text'},
					{ name: 'bayar', type: 'text'},
					{ name: 'kontak', type: 'text'},
					{ name: 'pembicara', type: 'text'},
					{ name: 'daftarmulai', type: 'text'},
					{ name: 'daftarakhir', type: 'text'},
					{ name: 'absenmulai', type: 'text'},
					{ name: 'absenakhir', type: 'text'},
					{ name: 'created_by', type: 'text'},
					{ name: 'linkwebniar', type: 'text'},
				],
				type: 'POST',
				data: {val01: "Session('email')", _token: token},
				url: 'webinar/eventlist',
			};
			var dataAdapter = new $.jqx.dataAdapter(source);
			$("#gridevent").jqxGrid({
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
					{ text: 'Detail', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', align: 'center', cellsrenderer: function () {
						return "Detail";
						}, buttonclick: function (row) {
							editrow = row;	
							var offset 		= $("#gridevent").offset();
							var dataRecord 	= $("#gridevent").jqxGrid('getrowdata', editrow);
							var set01		= dataRecord.idne;
							$("#mnama").val(set01);
							$("#set_idevent").val(set01);
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
								data: {val01: set01, _token: token},
								url: 'webinar/listpartisipan',
							};
							$('.divawalkegiatan').hide();
							$('.divdetailkegiatan').show();
							
							var dataAdapter = new $.jqx.dataAdapter(source);
							$("#grideventdetail").jqxGrid({
								width: '100%',
								pageable: true,
								autoheight: true,
								filterable: true,
								source: dataAdapter,
								columnsresize: true,
								showfilterrow: true,
								theme: "energyblue",
								selectionmode: 'checkbox',
								altrows: true,
								columns: [
									{ text: 'Status ', filtertype: 'checkedlist', datafield: 'status', width: 150, cellsalign: 'left', align: 'center'  },
									{ text: 'Nama', datafield: 'nama', width: 150, cellsalign: 'left', align: 'center'  },
									{ text: 'Position', filtertype: 'checkedlist', datafield: 'pekerjaan', width: 100, cellsalign: 'left', align: 'center'  },
									{ text: 'Institution/company.', datafield: 'instansi', width: 150, cellsalign: 'left', align: 'center'  },
									{ text: 'Full Address ', datafield: 'alamat', width: 150, cellsalign: 'left', align: 'center'  },
									{ text: 'Country ', filtertype: 'checkedlist', datafield: 'negara', width: 90, cellsalign: 'left', align: 'center'  },
									{ text: 'Email ', datafield: 'email', width: 90, cellsalign: 'left', align: 'center'  },
									{ text: 'Phone ', datafield: 'hape', width: 90, cellsalign: 'left', align: 'center'  },
									{ text: 'Register ', filtertype: 'checkedlist', datafield: 'daftar', width: 120, cellsalign: 'left', align: 'center'  },
									{ text: 'Present ', filtertype: 'checkedlist', datafield: 'presensi', width: 120, cellsalign: 'left', align: 'center'  },
									{ text: 'Quizioner ', filtertype: 'checkedlist', datafield: 'quiz', width: 120, cellsalign: 'left', align: 'center'  },
									{ text: 'Fee ', filtertype: 'checkedlist', datafield: 'bayar', width: 70, cellsalign: 'left', align: 'center'  },
								]
							});
						}
					},
					{ text: 'Lembar', cellsalign: 'center', align: 'center', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
						return "Cetak";
						}, buttonclick: function (row) {
							editrow = row;	
							var offset 		= $("#gridevent").offset();		
							var dataRecord 	= $("#gridevent").jqxGrid('getrowdata', editrow);
							var url 		= "{{URL::to("/")}}/cetaklinkpresensi/"+dataRecord.idne;
							var windowName 	= dataRecord.nama+" Tanggal "+dataRecord.tanggal;
							var windowSize 	= "width=700,height=800";
							window.open(url, windowName, windowSize);
							event.preventDefault();
							return false;
						}
					},
					{ text: 'Mode', editable: false, sortable: false, filterable: false,columntype: 'button', width: '5%', align: 'center', cellsrenderer: function () {
						return "EO";
						}, buttonclick: function (row) {
							editrow         = row;
							var offset 		= $("#gridevent").offset();
							var dataRecord 	= $("#gridevent").jqxGrid('getrowdata', editrow);
							window.open("{{URL::to("/")}}/eomode/"+dataRecord.idne, "_blank");
						}
					},
					{ text: 'Tanggal', datafield: 'tanggal', width: '10%', cellsalign: 'left', align: 'center'  },
					{ text: 'Nama Event', datafield: 'tlskegiatan', width: '30%', cellsalign: 'left', align: 'center'  },
					{ text: 'Lokasi', datafield: 'tempat', width: '15%', cellsalign: 'left', align: 'center'  },					
					{ text: 'Kuota', datafield: 'kapasitas', width: '5%', cellsalign: 'left', align: 'center'  },
					{ text: 'Pendaftar', datafield: 'peserta', width: '5%', cellsalign: 'left', align: 'center'  },
					{ text: 'Presensi', cellsalign: 'center', align: 'center', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsrenderer: function () {
						return "Cetak";
						}, buttonclick: function (row) {
							editrow = row;	
							var offset 		= $("#gridevent").offset();		
							var dataRecord 	= $("#gridevent").jqxGrid('getrowdata', editrow);
							var url 		= "{{URL::to("/")}}/cetakpresensi/"+dataRecord.idne;
							var windowName 	= dataRecord.nama+" Tanggal "+dataRecord.tanggal;
							var windowSize 	= "width=700,height=800";
							window.open(url, windowName, windowSize);
							event.preventDefault();
							return false;
						}
					},
					{ text: 'Edit', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
						return "Edit";
						}, buttonclick: function (row) {		
							editrow = row;	
							var offset 		= $("#gridevent").offset();		
							var dataRecord 	= $("#gridevent").jqxGrid('getrowdata', editrow);
							var daterange1  =   dataRecord.mulai;
							var arrmulai    =   daterange1.split(" ");
							var daterange2  =   dataRecord.akhir;
							var arrakhir    =   daterange2.split(" ");
							var daterange3  =   dataRecord.daftarmulai;
							var arrdatarm   =   daterange3.split(" ");
							var daterange4  =   dataRecord.daftarakhir;
							var arrdatara   =   daterange4.split(" ");
							var daterange5  =   dataRecord.absenmulai;
							var arrabsenm   =   daterange5.split(" ");
							var daterange6  =   dataRecord.absenakhir;
							var arrabsena   =   daterange6.split(" ");
							$("#id_namaefent").val(dataRecord.nama);
							$("#id_tempat").val(dataRecord.tempat);
							$("#id_kapasitas").val(dataRecord.kapasitas);
							$("#id_biaya").val(dataRecord.bayar);
							$("#id_tglmulaiefent").val(arrmulai[0]);
							$("#id_jammulaiefent").val(arrmulai[1]);
							$("#id_tglselesaiefent").val(arrakhir[0]);
							$("#id_jamselesaiefent").val(arrakhir[1]);
							$("#id_tglmulaidaftar").val(arrdatarm[0]);
							$("#id_jammulaidaftar").val(arrdatarm[1]);
							$("#id_tglselesaidaftar").val(arrdatara[0]);
							$("#id_jamselesaidaftar").val(arrdatara[1]);
							$("#id_tglmulaiabsen").val(arrabsenm[0]);
							$("#id_jammulaiabsen").val(arrabsenm[1]);
							$("#id_tglselesaiabsen").val(arrabsena[0]);
							$("#id_jamselesaiabsen").val(arrabsena[1]);
							CKEDITOR.instances['id_kontak'].setData(dataRecord.kontak)
							CKEDITOR.instances['id_pembicara'].setData(dataRecord.pembicara)
							CKEDITOR.instances['id_linkwebinar'].setData(dataRecord.linkwebniar)
							$('.divawalkegiatan').hide();
							$('.divdetailkegiatan').hide();
							$('.divtambahkegiatan').show();
							$("#mnama").val(dataRecord.idne);
						}
					},
					{ text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
						return "Del";
						}, buttonclick: function (row) {
							editrow = row;	
							var offset 		= $("#gridevent").offset();		
							var dataRecord 	= $("#gridevent").jqxGrid('getrowdata', editrow);
							var token   	= document.getElementById('token').value;
							var cekstatus	= dataRecord.peserta;
							if (cekstatus == '0'){
								swal({
									title: 'Are you sure?',
									text: "You won't be able to revert this!",
									type: 'warning',
									showCancelButton: true,
									confirmButtonClass: 'btn btn-confirm mt-2',
									cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
									confirmButtonText: 'Yes, delete it!'
								}).then(function () {
									var val01=dataRecord.nama;
									var val02=dataRecord.idne;
									var val03='';
									var val04='';;
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
									var val20='hapus';
									var token=document.getElementById('token').value;		
									$.post('webinar/saveevent', { set01: val01, set02: val02, set03: val03, set04: val04, set05: val05, set06: val06, set07: val07, set08: val08, set09: val09, set10: val10, set11: val11, set12: val12, set13: val13, set14: val14, set15: val15, set16: val16, set17: val17, set18: val18, set19: val19, set20: val20, _token: token },	
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
											$("#gridevent").jqxGrid('updatebounddata', 'filter');
											return false;
									});
								});
							} else {
								swal({
									title: 'Stop',
									text: 'Cannot Delete, Sudah Ada Pendaftar di Event ini',
									type: 'warning',
								})
							}
						}
					},
				]
			});
		});
		$('#btnviewallkegiatan').click(function () {
			$('#divsuratkeluartnpnomor').hide();
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
			$('.divawalkegiatan').show();
			$('.divdetailkegiatan').hide();
			$('.divtambahkegiatan').hide();
			var token=document.getElementById('token').value;
			var source = {
				datatype: "json",
				datafields: [
					{ name: 'idne'},
					{ name: 'peserta', type: 'text'},
					{ name: 'tlskegiatan', type: 'text'},
					{ name: 'nama', type: 'text'},
					{ name: 'tempat', type: 'text'},
					{ name: 'kapasitas', type: 'text'},
					{ name: 'tanggal', type: 'text'},
					{ name: 'mulai', type: 'text'},
					{ name: 'akhir', type: 'text'},
					{ name: 'bayar', type: 'text'},
					{ name: 'kontak', type: 'text'},
					{ name: 'pembicara', type: 'text'},
					{ name: 'daftarmulai', type: 'text'},
					{ name: 'daftarakhir', type: 'text'},
					{ name: 'absenmulai', type: 'text'},
					{ name: 'absenakhir', type: 'text'},
					{ name: 'created_by', type: 'text'},
					{ name: 'linkwebniar', type: 'text'},
				],
				type: 'POST',
				data: {val01: 'all', _token: token},
				url: 'webinar/eventlist',
			};
			var dataAdapter = new $.jqx.dataAdapter(source);
			$("#gridevent").jqxGrid({
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
					{ text: 'Detail', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', align: 'center', cellsrenderer: function () {
						return "Detail";
						}, buttonclick: function (row) {
							editrow = row;	
							var offset 		= $("#gridevent").offset();
							var dataRecord 	= $("#gridevent").jqxGrid('getrowdata', editrow);
							var set01		= dataRecord.idne;
							$("#mnama").val(set01);
							$("#set_idevent").val(set01);
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
								data: {val01: set01, _token: token},
								url: 'webinar/listpartisipan',
							};
							$('.divawalkegiatan').hide();
							$('.divdetailkegiatan').show();
							
							var dataAdapter = new $.jqx.dataAdapter(source);
							$("#grideventdetail").jqxGrid({
								width: '100%',
								pageable: true,
								autoheight: true,
								filterable: true,
								source: dataAdapter,
								columnsresize: true,
								showfilterrow: true,
								theme: "energyblue",
								selectionmode: 'checkbox',
								altrows: true,
								columns: [
									{ text: 'Status ', filtertype: 'checkedlist', datafield: 'status', width: 150, cellsalign: 'left', align: 'center'  },
									{ text: 'Nama', datafield: 'nama', width: 150, cellsalign: 'left', align: 'center'  },
									{ text: 'Position', filtertype: 'checkedlist', datafield: 'pekerjaan', width: 100, cellsalign: 'left', align: 'center'  },
									{ text: 'Institution/company.', datafield: 'instansi', width: 150, cellsalign: 'left', align: 'center'  },
									{ text: 'Full Address ', datafield: 'alamat', width: 150, cellsalign: 'left', align: 'center'  },
									{ text: 'Country ', filtertype: 'checkedlist', datafield: 'negara', width: 90, cellsalign: 'left', align: 'center'  },
									{ text: 'Email ', datafield: 'email', width: 90, cellsalign: 'left', align: 'center'  },
									{ text: 'Phone ', datafield: 'hape', width: 90, cellsalign: 'left', align: 'center'  },
									{ text: 'Register ', filtertype: 'checkedlist', datafield: 'daftar', width: 120, cellsalign: 'left', align: 'center'  },
									{ text: 'Present ', filtertype: 'checkedlist', datafield: 'presensi', width: 120, cellsalign: 'left', align: 'center'  },
									{ text: 'Quizioner ', filtertype: 'checkedlist', datafield: 'quiz', width: 120, cellsalign: 'left', align: 'center'  },
									{ text: 'Fee ', filtertype: 'checkedlist', datafield: 'bayar', width: 70, cellsalign: 'left', align: 'center'  },
								]
							});
						}
					},
					{ text: 'Lembar', cellsalign: 'center', align: 'center', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
						return "Cetak";
						}, buttonclick: function (row) {
							editrow = row;	
							var offset 		= $("#gridevent").offset();		
							var dataRecord 	= $("#gridevent").jqxGrid('getrowdata', editrow);
							var url 		= "{{URL::to("/")}}/cetaklinkpresensi/"+dataRecord.idne;
							var windowName 	= dataRecord.nama+" Tanggal "+dataRecord.tanggal;
							var windowSize 	= "width=700,height=800";
							window.open(url, windowName, windowSize);
							event.preventDefault();
							return false;
						}
					},
					{ text: 'Mode', editable: false, sortable: false, filterable: false,columntype: 'button', width: '5%', align: 'center', cellsrenderer: function () {
						return "EO";
						}, buttonclick: function (row) {
							editrow         = row;
							var offset 		= $("#gridevent").offset();
							var dataRecord 	= $("#gridevent").jqxGrid('getrowdata', editrow);
							window.open("{{URL::to("/")}}/eomode/"+dataRecord.idne, "_blank");
						}
					},
					{ text: 'Tanggal', datafield: 'tanggal', width: '10%', cellsalign: 'left', align: 'center'  },
					{ text: 'Nama Event', datafield: 'tlskegiatan', width: '30%', cellsalign: 'left', align: 'center'  },
					{ text: 'Lokasi', datafield: 'tempat', width: '20%', cellsalign: 'left', align: 'center'  },					
					{ text: 'Kuota', datafield: 'kapasitas', width: '5%', cellsalign: 'left', align: 'center'  },
					{ text: 'Pendaftar', datafield: 'peserta', width: '5%', cellsalign: 'left', align: 'center'  },
					{ text: 'Presensi', cellsalign: 'center', align: 'center', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsrenderer: function () {
						return "Cetak";
						}, buttonclick: function (row) {
							editrow = row;	
							var offset 		= $("#gridevent").offset();		
							var dataRecord 	= $("#gridevent").jqxGrid('getrowdata', editrow);
							var url 		= "{{URL::to("/")}}/cetakpresensi/"+dataRecord.idne;
							var windowName 	= dataRecord.nama+" Tanggal "+dataRecord.tanggal;
							var windowSize 	= "width=700,height=800";
							window.open(url, windowName, windowSize);
							event.preventDefault();
							return false;
						}
					},
					{ text: 'Edit', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
						return "Edit";
						}, buttonclick: function (row) {		
							editrow = row;	
							var offset 		= $("#gridevent").offset();		
							var dataRecord 	= $("#gridevent").jqxGrid('getrowdata', editrow);
							var daterange1  =   dataRecord.mulai;
							var arrmulai    =   daterange1.split(" ");
							var daterange2  =   dataRecord.akhir;
							var arrakhir    =   daterange2.split(" ");
							var daterange3  =   dataRecord.daftarmulai;
							var arrdatarm   =   daterange3.split(" ");
							var daterange4  =   dataRecord.daftarakhir;
							var arrdatara   =   daterange4.split(" ");
							var daterange5  =   dataRecord.absenmulai;
							var arrabsenm   =   daterange5.split(" ");
							var daterange6  =   dataRecord.absenakhir;
							var arrabsena   =   daterange6.split(" ");
							$("#id_namaefent").val(dataRecord.nama);
							$("#id_tempat").val(dataRecord.tempat);
							$("#id_kapasitas").val(dataRecord.kapasitas);
							$("#id_biaya").val(dataRecord.bayar);
							$("#id_tglmulaiefent").val(arrmulai[0]);
							$("#id_jammulaiefent").val(arrmulai[1]);
							$("#id_tglselesaiefent").val(arrakhir[0]);
							$("#id_jamselesaiefent").val(arrakhir[1]);
							$("#id_tglmulaidaftar").val(arrdatarm[0]);
							$("#id_jammulaidaftar").val(arrdatarm[1]);
							$("#id_tglselesaidaftar").val(arrdatara[0]);
							$("#id_jamselesaidaftar").val(arrdatara[1]);
							$("#id_tglmulaiabsen").val(arrabsenm[0]);
							$("#id_jammulaiabsen").val(arrabsenm[1]);
							$("#id_tglselesaiabsen").val(arrabsena[0]);
							$("#id_jamselesaiabsen").val(arrabsena[1]);
							CKEDITOR.instances['id_kontak'].setData(dataRecord.kontak)
							CKEDITOR.instances['id_pembicara'].setData(dataRecord.pembicara)
							CKEDITOR.instances['id_linkwebinar'].setData(dataRecord.linkwebniar)
							$('.divawalkegiatan').hide();
							$('.divdetailkegiatan').hide();
							$('.divtambahkegiatan').show();
							$("#mnama").val(dataRecord.idne);
						}
					},
				]
			});
		});
		$('#btntambahdatakegiatan').click(function () {
			$('.divawalkegiatan').hide();
			$('.divdetailkegiatan').hide();
			$('.divtambahkegiatan').show();
			$("#mnama").val('new');
		});
		$('#btnklosetambahbaru').click(function () {
			$('.divawalkegiatan').show();
			$('.divdetailkegiatan').hide();
			$('.divtambahkegiatan').hide();
		});
		$("#id_tglmulaiefent").on('change', function () {
			var isi=document.getElementById('id_tglmulaiefent').value;
			if (isi != ''){
				$("#id_tglselesaidaftar").val(isi);
				$("#id_tglselesaiefent").val(isi);
				$("#id_tglselesaiabsen").val(isi);
				$("#id_tglmulaiabsen").val(isi);
			}
		});
		$("#id_jammulaiefent").on('change', function () {
			var isi=document.getElementById('id_jammulaiefent').value;
			if (isi != ''){
				$("#id_jammulaidaftar").val(isi);
				$("#id_jammulaiabsen").val(isi);
			}
		});
		$("#id_jamselesaiefent").on('change', function () {
			var isi=document.getElementById('id_jamselesaiefent').value;
			if (isi != ''){
				$("#id_jamselesaiabsen").val(isi);
				$("#id_jamselesaidaftar").val(isi);
			}
		});
		$('#id_filedepan').change(function () {
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
		$('#id_filebelakang').change(function () {
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
					readURLBack(this);
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
		$('#btnkirimundangan').click(function () {
			$('#divloading').show();
			$('#diveventlistdetail').hide();
			var set01 = document.getElementById('mnama').value;
			var rows = $("#grideventdetail").jqxGrid('selectedrowindexes');
			var selectedRecords = new Array();
			for (var m = 0; m < rows.length; m++) {
				var row = $("#grideventdetail").jqxGrid('getrowdata', rows[m]);
				selectedRecords.push(row.idne);
			}
			var token = document.getElementById('token').value;
			$.post('webinar/exmailer', { val01: set01, val02: 'undangan', val03: selectedRecords, _token: token },
			function(data){
				$('#divloading').hide();
				$('#diveventlistdetail').show();
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
				$("#grideventdetail").jqxGrid('clearselection');
				$("#grideventdetail").jqxGrid('updatebounddata', 'filter');
				return false;
			});
		});
		$('#btnkirimreminder').click(function () {
			$('#divloading').show();
			$('#diveventlistdetail').hide();
			var set01 = document.getElementById('mnama').value;
			var rows = $("#grideventdetail").jqxGrid('selectedrowindexes');
			var selectedRecords = new Array();
			for (var m = 0; m < rows.length; m++) {
				var row = $("#grideventdetail").jqxGrid('getrowdata', rows[m]);
				selectedRecords.push(row.idne);
			}
			var token = document.getElementById('token').value;
			$.post('webinar/exmailer', { val01: set01, val02: 'reminder', val03: selectedRecords, _token: token },
			function(data){
				$('#divloading').hide();
				$('#diveventlistdetail').show();
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
				$("#grideventdetail").jqxGrid('clearselection');
				$("#grideventdetail").jqxGrid('updatebounddata', 'filter');
				return false;
			});
		});
		$('#btnsendkuis').click(function () {
			$('#divloading').show();
			$('#diveventlistdetail').hide();
			var set01 = document.getElementById('mnama').value;
			var rows = $("#grideventdetail").jqxGrid('selectedrowindexes');
			var selectedRecords = new Array();
			for (var m = 0; m < rows.length; m++) {
				var row = $("#grideventdetail").jqxGrid('getrowdata', rows[m]);
				selectedRecords.push(row.idne);
			}
			var token = document.getElementById('token').value;
			$.post('webinar/exmailer', { val01: set01, val02: 'evaluasi', val03: selectedRecords, _token: token },
			function(data){
				$('#divloading').hide();
				$('#diveventlistdetail').show();
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
				$("#grideventdetail").jqxGrid('clearselection');
				$("#grideventdetail").jqxGrid('updatebounddata', 'filter');
				return false;
			});
		});
		$('#btnsendsertifikat').click(function () {
			$('#divloading').show();
			$('#diveventlistdetail').hide();
			var set01 = document.getElementById('mnama').value;
			var rows = $("#grideventdetail").jqxGrid('selectedrowindexes');
			var selectedRecords = new Array();
			for (var m = 0; m < rows.length; m++) {
				var row = $("#grideventdetail").jqxGrid('getrowdata', rows[m]);
				selectedRecords.push(row.idne);
			}
			var token = document.getElementById('token').value;
			$.post('webinar/exmailer', { val01: set01, val02: 'sertifikat', val03: selectedRecords, _token: token },
			function(data){
				$('#divloading').hide();
				$('#diveventlistdetail').show();
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
				$("#grideventdetail").jqxGrid('clearselection');
				$("#grideventdetail").jqxGrid('updatebounddata', 'filter');
				return false;
			});
		});
		$('#downexcell').click(function(){
			var gridContent = $("#grideventdetail").jqxGrid('exportdata', 'json');
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
							if (pjg == 9 || pjg == 10 || pjg == 11 || pjg == 12 || pjg == 13){
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
		$("#btnsendeditemail").click(function(){
			var val01=document.getElementById('send_idne').value;
			var val02=document.getElementById('send_email').value;
			var val03=document.getElementById('send_hp').value;
			var token=document.getElementById('token').value;
			$("#modalsendwa").modal('hide');
			$.post('webinar/saveeditemail', { set01: val01, set02: val02, set03: val03, _token: token },
			function(data){
				$("#grideventdetail").jqxGrid('updatebounddata', 'filter');
				var windowName 	= 'Send WA';
				var windowSize 	= "width=800,height=800";
				window.open(data, windowName, windowSize);
				return false;
			});	
		});
		$("#btnsimpan").click(function(){
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
			var val20=document.getElementById('mnama').value;
			var val21=document.getElementById('id_filedepan');
			var val22=document.getElementById('id_filebelakang');
			var val23=document.getElementById('id_linkmateri').value;
			var token=document.getElementById('token').value;
			var form_data = new FormData();
				form_data.append('depan', val21.files[0]);
				form_data.append('belakang', val22.files[0]);
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
				url: 'webinar/saveevent',
				data: form_data,
				type: 'POST',
				contentType: false,
				processData: false,
				success: function (data) {
					var status  = data.status;
					var message = data.message;
					var warna 	= data.warna;
					var icon 	= data.icon;
					$('#previewdepan').attr('src', 'dist/img/boxed-bg.jpg');
					$('#previewbelakang').attr('src', 'dist/img/boxed-bg.jpg');
					$("#id_filebelakang").val('');
					$("#id_filedepan").val('');
					$('.divawalkegiatan').show();
					$('.divdetailkegiatan').hide();
					$('.divtambahkegiatan').hide();
					$.toast({
						heading: status,
						text: message,
						position: 'top-right',
						loaderBg: warna,
						icon: icon,
						hideAfter: 3000,
						stack: 1
					});
					$("html, body").animate({ scrollTop: 0 }, "slow");
					$("#gridevent").jqxGrid('updatebounddata', 'filter');
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
		});
	//END_KELOMPOK_EVENT
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
							$("#notulensi_idne").val(dataRecord.id);
						}
					},
				]
			});
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
		let summernoteOptions = {
            height: 300
        }
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
	//KELOMPOK_AWAL_KALENDER
		openedpage();
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
			$('#divsuratkeluartnpnomor').hide();
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
			$('#divdisposisi').hide();
			$('#divkalender').show();
		});
		$('.btnopenmailbox').click(function () {
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
			$('.divgridsendiricari').hide();
			$('.divisidisposisi').hide();
			$('.divawaldisposisi').show();
			openmailbox();
		});
		$('#btnviewcustommailbox').click(function () {
			var set01=document.getElementById('r_value').value;
			var set02=document.getElementById('r_jenis').value;
			$('.divawaldisposisi').show();
			$('.divmasukcari').hide();
			openmailbox();
		});
		$("#btnopenmailinternal").click(function(){
			$("#r_value").val('');
			$("#r_jenis").val('internal');
			openmailbox();
		});
		$("#btnopenmailexternal").click(function(){
			$("#r_value").val('');
			$("#r_jenis").val('external');
			openmailbox();
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
		$("#btntutupgridsendiricari").click(function(){
			$('.divgridsendiricari').hide();
			$('.divawaldisposisi').show();
		});
		$("#btnkembalikedispo").click(function(){
			$('.divisidisposisi').hide();
			$('.divawaldisposisi').show();
		});
		$("#btnsimpancatatn").click(function(){
			$('.divisidisposisi').hide();
			$('#loading').show();
			var set01 		= document.getElementById('buka_idne').value;
			var set02		= $('#buka_kepada').select2().val();
			var set03		= CKEDITOR.instances['buka_catatan'].getData();
			var set04 		= document.getElementById('buka_kelompok').value;
			var set05 		= document.getElementById('filelampiran');
			if (set02 == '' || set03 == ''){
				swal({
					title	: 'Stop',
					text	: 'Penerima Disposisi dan Isi Disposisi Wajib Terisi!',
					type	: 'warning',
				})
			} else {
				var form_data = new FormData();
					form_data.append('kerja_idsurat', set01);
					form_data.append('tanggal', '{{date("Y-m-d")}}');
					form_data.append('id_catatan', set03);
					form_data.append('kelompok', set04);
					form_data.append('kepada', set02);
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
			}
		});
		$("#btnarsipkan").click(function(){
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
				form_data.append('tanggal', '{{date("Y-m-d")}}');
				form_data.append('id_catatan', set03);
				form_data.append('kelompok', set04);
				form_data.append('kepada', set02);
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
	//END_KELOMPOK_KALENDER
});
</script>
@endpush