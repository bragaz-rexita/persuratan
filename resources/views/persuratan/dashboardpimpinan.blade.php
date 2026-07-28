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
                    <div id="divdisposisi">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Mailbox</h3>
                                <div class="card-tools">
                                	<button type="button" class="btn btn-tool btnkembali"><i class="fa fa-times"></i></button>
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
                                        <div class="col-lg-10 col-md-9">
                                            <label for="buka_kepada">Disposisi Kepada *</label>
                                            <select id="buka_kepada" name="kepada[]" class="form-control select2" multiple="multiple" data-placeholder="Boleh pilih lebih dari satu" style="width: 100%;">
												@if (Session('fakultas') != 'DPM')
												<option value="mahesayudistiranti@gmail.com">Sekre PT ( Mahesa Yudistiranti, S.A.P )</option>
												@endif
												@if(isset($pejabats) AND !empty($pejabats))
                                                    @foreach($pejabats as $rpejabat)
                                                        <option value="{{ $rpejabat->pejabat }}">{{ $rpejabat->pejabat }} </option>
                                                    @endforeach
                                                @endif    
												@if(isset($listpenerimadisposisi) AND !empty($listpenerimadisposisi))
                                                    @foreach($listpenerimadisposisi as $rpejabat)
                                                        <option value="{{ $rpejabat['kode'] }}">{{ $rpejabat['nama'] }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="Arsiparis Umum">Arsiparis Umum</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-3">
                                            <label for="buka_sifatdiposisi">Sifat</label>
                                            <select id="buka_sifatdiposisi" name="buka_sifatdiposisi" class="form-control" >
                                                <option value="Biasa">Biasa</option>
                                                <option value="Segera">Segera</option>
                                                <option value="Sangat Segera">Sangat Segera</option>
                                                <option value="Rahasia">Rahasia</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"> 			
                                    <div class="row">
                                        @foreach($mcmdispo as $id => $name)
                                            <div class="col-lg-6 col-md-6">
                                                <div class="checkbox checkbox-success">
                                                    <label for="{{$name['id']}}">
                                                        {!! Form::checkbox("formDoor[]", $name['disposisi'], null, array('id'=>$name['id'])) !!}
                                                        {{$name['disposisi']}}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
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
                                    <label>Lampiran</label>
                                    <input type="file" id="filelampiran" name="filelampiran" class="btn-light">
                                </div>
								<div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4">
											<button type="button" class="btn btn-danger" id="btnkembalikedispo">Kembali</button>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
											<button type="button" class="btn btn-success" id="btnsimpancatatn">Kirim Disposisi</button>
								        </div>
                                    </div>
                                </div>
                            </div>
                            
							<div class="card-body divawaldisposisi">
								<div class="row">
									<div class="col-lg-2"></div>
									<div class="col-lg-4"></div>
									<div class="col-lg-6">
										<div class="small-box bg-blue">
											<div class="inner">
												<div class="form-group">
												<label for="cari_dari">Pencarian Surat Berdasarkan.?</label>
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
															<option value="internal">Open Mail From Internal</option>
															<option value="external">Open Mail From Internal</option>
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
							<div class="card-footer divawaldisposisi">
								<div class="form-group">
									<h5>Disposisi Masuk</h5>
									<div id="gridsendiri"></div>
								</div>
								<div class="form-group">
									<h5>Directly Send</h5>
									<div id="gridsendiripenerimasurat"></div>
								</div>	
                            </div>
							<div class="card-footer divmasukcari">
								<div id="tabelcari"></div>
                            </div>
							<div class="card-footer divmasukcari">
								<div id="judulpreviewsuratmasuk"></div>
                            	<div id="previesuratmasuk"></div>
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
					<div id="divsuratkeluar">
						<div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Permohonan Paraf/Tandatangan Elektronik</h3>
                                <div class="card-tools">
                                	<button type="button" class="btn btn-tool btnkembali"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="card-body divawalkeluar">
								<div class="row">
									<div class="col-lg-2">
										<button class="btn btn-info" id="btnttdmulti">Setujui Surat Jamak</button>
									</div>
									<div class="col-lg-2">
									</div>
									<div class="col-lg-2">
										<button class="btn btn-danger pull-right" id="btntolakmulti">Tolak Surat Jamak</button>
									</div>
									<div class="col-lg-6">
										<div class="small-box bg-blue">
											<div class="inner">
												<div class="form-group">
												<label for="cariklr_dari">Pencarian Surat Berdasarkan.?</label>
												<div class="row">
													<div class="col-lg-5">
														<input type="text" class="form-control" id="cariklr_dari" placeholder="Ketik Value Pencarian">
													</div>
													<div class="col-lg-5">
														<select id="cariklr_jenis" class="form-control">
															<option value="nomer">Cari Berdasarkan No. Surat</option>
															<option value="tglsurat">Cari Berdasarkan TGL. Surat</option>
															<option value="perihal">Cari Berdasarkan Perihal</option>
															<option value="tahun">Cari Berdasarkan Tahun</option>
														</select>
													</div>
													<div class="col-lg-2">
														<button class="btn btn-success" id="btncariarsipsrtkeluar">Cari</button>
													</div>
												</div>
												</div>	
											</div>
										</div>
									</div>
								</div>
                            </div>
                            <div class="card-footer divawalkeluar">
								<div id="tabelsuratkeluar"></div>
                            </div>
							<div class="card-body divtindakan">
								<div style="overflow-y: auto; height:460px; ">
									<label id="judulloadingsrtkeluar"></label>
									<div id="surate"></div>
								</div>
								<div class="row">
									<div class="col-lg-6 col-md-6 col-xs-12 bg-green">
										<div class="form-group">
											<br />
											<div class="lockscreen-item">
												<div class="lockscreen-image">
													<img src="{{ asset('dist/img/avatar.png') }}" alt="User Image">
												</div>
												<div class="input-group">
													<div class="input-group-btn">
														<button type="button" class="btn" id="btnshowpassword">Pasword <i class="fa fa-eye text-muted"></i></button>
													</div>
													<input type="password" class="form-control" placeholder="Passphare" id="id_password" name="id_password" autocomplete="off">
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-xs-12" id="catatanawal">
										<b><font color=red>Mohon Memberikan Catatan Kaki, Bila Surat di Atas Salah / Perlu di Perbaiki</font></b>
										<select class="form-control" id="id_catatan" name="id_catatan">
											<option value="">Pilih Salah Satu</option>
											<option value="Mohon di Review Sekali Lagi Sebelum dokumen diedarkan, agar dokumen sudah tidak mengandung kesalahan substantif, dan tipografi, terimakasih.">Mohon di Review Sekali Lagi Sebelum dokumen diedarkan, agar dokumen sudah tidak mengandung kesalahan substantif, dan tipografi, terimakasih.</option>
											<option value="Mohon dilengkapi lampirannya">Mohon di lengkapi lampirannya.</option>
											<option value="Isi Catatan Sendiri">Lainnya (Isi Catatan Sendiri)</option>                               
										</select>
									</div>
									<div class="col-lg-6 col-md-6 col-xs-12" id="catatantulis">
										<b><font color=red>Mohon Memberikan Catatan Kaki, Bila Surat di Atas Salah / Perlu di Perbaiki</font></b>
										<textarea id="id_footnote" rows="10" cols="80"></textarea>
									</div>
								</div>
                            </div>
                            <div class="card-footer divtindakan">
								<input type="hidden" id="id_surat" name="id_surat">
								<button id="save" class="btn btn-success pull-right">Setujui dan dapat diproses lanjut</button>
								<button id="btnbatal" class="btn btn-info pull-left">Kembalikan ke Pengirim</button>
								<button id="clear" class="btn btn-danger pull-left">Kembali</button>
							</div>
							<div class="card-footer divcarikeluar">
								<div id="tabelcarikeluar"></div>
                            </div>
							<div class="card-footer divcarikeluar">
								<div id="judulpreviewsuratkeluar"></div>
                            	<div id="previesuratkeluar"></div>
                            </div>
                        </div>
					</div>
					<div id="divnotadinas">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Nota Dinas</h3>
                                <div class="card-tools">
                                	<button class="btn btn-tool" id="btntambahnotadinas"><i class="fa fa-plus"></i> Tambah Nota Dinas</button>
						            <button type="button" class="btn btn-tool btnkembali"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
							<div class="card-body divtambahnotadinas">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-5">
											<div class="form-group">
												<label for="nodin_hal">Perihal :</label>
												<input type="text" id="nodin_hal" name="nodin_hal" class="form-control" value="">
											</div>
											<div class="form-group">
												<label for="nodin_kepada">Kepada :</label>
												<select id="nodin_kepada" name="nodin_kepada" size="1" class="form-control select2">
													<option value="">Pilih Salah Satu</option>
													@foreach($pejabats as $rpejabats)
														<option value="{{ $rpejabats->id }}">{{ $rpejabats->nama }} ( {{ $rpejabats->pejabat }} )</option>
													@endforeach
												</select>
											</div>
											<div class="form-group">
												<label for="nodin_tembusan">Tembusan</label>
												<select id="nodin_tembusan" name="nodin_tembusan" size="1" class="form-control select2">
													<option value="">Pilih Salah Satu</option>
													@foreach($pejabats as $rpejabats)
														<option value="{{ $rpejabats->id }}">{{ $rpejabats->nama }} ( {{ $rpejabats->pejabat }} )</option>
													@endforeach
												</select>
											</div>
											<div class="form-group">
												<label for="nodin_filelampiran">Upload Lampiran (PDF, Bila ada)</label>
												<input type="file" id="nodin_filelampiran" name="nodin_filelampiran" class="btn-light">
											</div>
										</div>
										<div class="col-lg-7">
											<div class="form-group"> 
												<textarea id="nodin_isi" name="nodin_isi" style="width: 100%; height: 480px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-lg-12">
														<label for="nodin_sebagai">Penandatangan</label>
														<select id="nodin_sebagai" name="nodin_sebagai" size="1" class="form-control select2">
															<option value="PEJABAT">{!! Session('jabatan') !!}</option>
															<option value="NAMA">{!! Session('nama') !!}</option>
														</select>
													</div>
													<div class="col-lg-12">
														<label for="nodin_password">Passphare eSign</label>
														<input type="password" id="nodin_password" name="nodin_password" class="form-control" autocomplete="chrome-off">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
                            </div>
							<div class="card-footer divtambahnotadinas">
								<input type="hidden" id="nodin_id" name="nodin_id" value="new">
								<button type="button" class="btn btn-warning pull-right" id="btnsimpannotadinas">Simpan</button>
								<button type="button" class="btn btn-danger" id="btnbataladdnodin">Batal</button>
                            </div>
							<div class="card-body divtrackingnotadinas">
								<div id="divtrackingnotadinas"></div>
                            </div>
							<div class="card-footer divawalnotadinas">
                                <div id="gridnotadinas"></div>
                            </div>
                        </div>
                    </div>
					<div id="divmemo">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Memo</h3>
                                <div class="card-tools">
                                	<button class="btn btn-tool" id="btntambahmemo"><i class="fa fa-plus"></i> Tambah Memo</button>
						            <button type="button" class="btn btn-tool btnkembali"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
							<div class="card-body divtambahmemo">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-5">
											<div class="form-group">
												<label for="memo_hal">Perihal :</label>
												<input type="text" id="memo_hal" name="memo_hal" class="form-control" value="">
											</div>
											<div class="form-group">
												<label for="memo_kepada">Kepada :</label>
												<select id="memo_kepada" name="memo_kepada" size="1" class="form-control select2">
													<option value="">Pilih Salah Satu</option>
													@foreach($arrallpeg as $rpejabats)
														<option value="{{ $rpejabats->id }}">{{ $rpejabats->nama_lengkap }} ( {{ $rpejabats->jabatan }} )</option>
													@endforeach
												</select>
											</div>
											<div class="form-group">
												<label for="memo_filelampiran">Upload Lampiran (PDF, Bila ada, Maks 2Mb)</label>
												<input type="file" id="memo_filelampiran" name="memo_filelampiran" class="btn-light" accept="application/pdf">
											</div>
										</div>
										<div class="col-lg-7">
											<div class="form-group"> 
												<textarea id="memo_isi" name="memo_isi" style="width: 100%; height: 480px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-lg-6">
													</div>
													<div class="col-lg-6">
														<label for="memo_password">Passphare eSign</label>
														<input type="password" id="memo_password" name="memo_password" class="form-control" autocomplete="chrome-off">
													</div>
												</div>
											</div>
										</div>
									</div>			  
								</div>
                            </div>
							<div class="card-footer divtambahmemo">
								<input type="hidden" id="memo_id" name="memo_id" value="new">
								<button type="button" class="btn btn-warning  pull-right" id="btnsimpanmemo">Buat Memo</button>
								<button type="button" class="btn btn-danger" id="btnbataladdmemo">Batal</button>
                            </div>
							<div class="card-body divtrackingmemo">
								
                            </div>
							<div class="card-footer divawalmemo">
                                <div id="gridmemo"></div>
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
								<li class="nav-item"><a href="#" class="nav-link btnopentandatangan"><i class="fa fa-envelope"></i> Mohon Paraf/TTE<span class="badge badge-primary float-right countmohonttd">0</span></a></li>
								<li class="nav-item"><a href="#" class="nav-link btnnotadinas"><i class="fa fa-pencil-square-o"></i> Nota Dinas<span class="badge badge-primary float-right countnotadinas">0</span></a></li>
								<li class="nav-item"><a href="#" class="nav-link btnmemo"><i class="fa fa-sticky-note-o"></i> Memo<span class="badge badge-primary float-right countmemo">0</span></a></li>
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
		</div>
	</div>
</div>
<div class="modal modal-info fade" id="modalmultittd">
  <div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title">Check First.!</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</div>
		<div class="modal-body bg-primary">
			<div class="box-body">
				<div class="form-group">
					<div class="lockscreen-item">
						<div class="lockscreen-image">
						<img src="{{ asset('dist/img/avatar.png') }}" alt="User Image">
						</div>
						<div class="input-group">
							<div class="input-group-btn">
							<button type="button" class="btn" id="btnshowpassword2">Pasword <i class="fa fa-eye text-muted"></i></button>
							</div>
							<input type="password" class="form-control" placeholder="Passphare" id="multi_password" name="multi_password" autocomplete="off">
						</div>
					</div>
				</div>
				<div class="form-group" id="catatanawalmulti">
					<label for="multi_footnote">Catatan (Bila diperlukan)</label>
					<select class="form-control" id="multi_footnote" name="multi_footnote">
						<option value="">Pilih Salah Satu</option>
						<option value="Mohon di Review Sekali Lagi Sebelum dokumen diedarkan, agar dokumen sudah tidak mengandung kesalahan substantif, dan tipografi, terimakasih.">Mohon di Review Sekali Lagi Sebelum dokumen diedarkan, agar dokumen sudah tidak mengandung kesalahan substantif, dan tipografi, terimakasih.</option>
						<option value="Mohon dilengkapi lampirannya">Mohon di lengkapi lampirannya.</option>
						<option value="Isi Catatan Sendiri">Lainnya (Isi Catatan Sendiri)</option>                               
					</select>
				</div>
				<div class="form-group " id="catatantulismulti">
					<label for="multi_footnotebebas">Catatan (Bila diperlukan)</label>
					<textarea id="multi_footnotebebas" rows="10" cols="80"></textarea>
				</div>
			</div>
		</div>
		<div class="modal-footer justify-content-between">
        	<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Tutup</button>
			<button type="button" class="btn btn-success pull-right" id="btnbubuhkanmulti">Setujui dan dapat diproses lanjut</button>
		</div>
	</div>
  </div>
</div>
<div class="modal modal-info fade" id="modalmultitolak">
  <div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title">Pemeriksaan Surat</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</div>
		<div class="modal-body">
			<div class="box-body">
				<div class="form-group " id="catatanawalmultitolak">
					<label for="tolak_footnote">Catatan (Bila diperlukan)</label>
					<select class="form-control" id="tolak_footnote" name="tolak_footnote">
						<option value="">Pilih Salah Satu</option>
						<option value="Mohon di Review Sekali Lagi Sebelum dokumen diedarkan, agar dokumen sudah tidak mengandung kesalahan substantif, dan tipografi, terimakasih.">Mohon di Review Sekali Lagi Sebelum dokumen diedarkan, agar dokumen sudah tidak mengandung kesalahan substantif, dan tipografi, terimakasih.</option>
						<option value="Mohon dilengkapi lampirannya">Mohon di lengkapi lampirannya.</option>
						<option value="Isi Catatan Sendiri">Lainnya (Isi Catatan Sendiri)</option>                               
					</select>
				</div>
				<div class="form-group " id="catatantulismultitolak">
					<label for="tolak_footnotebebas">Catatan (Bila diperlukan)</label>
					<textarea id="tolak_footnotebebas" rows="10" cols="80"></textarea>
				</div>
			</div>
		</div>
		<div class="modal-footer justify-content-between">
        	<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Tutup</button>
			<button type="button" class="btn btn-success pull-right" id="btnbubuhkanmultitolak">Kembalikan ke Konseptor</button>
		</div>
	</div>
  </div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="qrname" class="qrname" value="">
<input type="hidden" name="mjenis" id="mjenis" value="Ruang">
<input type="hidden" name="mlokasi" id="mlokasi" value="All">
<input type="hidden" name="mnama" id="mnama" value="All">
<input type="hidden" name="mmulai" id="mmulai" value="now">
<input type="hidden" name="makhir" id="makhir" value="now">
<input type="hidden" name="tabele" id="tabele" value="now">
<input type="hidden" name="mnama" id="mnama" value="{{ Session('email') }}">
<input type="hidden" name="emailsekpim" id="emailsekpim" value="{{ $getsekretaris }}">
<input type="hidden" name="set_idevent" id="set_idevent" value="0">
@endsection
@push('script')
<script>
    $(function () {
		CKEDITOR.env.isCompatible = true;
		CKEDITOR.replace( 'nodin_isi' );
		CKEDITOR.replace( 'memo_isi' );
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
		CKEDITOR.replace( 'id_kontak', {
			toolbarGroups: [{"name":"paragraph","groups":["list"]}],
			removeButtons: '',
			width: '100%',
			height: 70	
		});
		CKEDITOR.replace( 'id_pembicara', {
			toolbarGroups: [{"name":"paragraph","groups":["list"]}],
			removeButtons: '',
			width: '100%',
			height: 70	
		});
		CKEDITOR.replace( 'id_linkwebinar', {
			toolbarGroups: [{"name":"paragraph","groups":["list"]}],
			removeButtons: '',
			width: '100%',
			height: 70	
		});
		CKEDITOR.replace( 'id_footnote', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90	
		});
		CKEDITOR.replace( 'multi_footnotebebas', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90	
		});
		CKEDITOR.replace( 'tolak_footnotebebas', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90	
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
	}
	function openmailbox( jQuery ){
		var set01='';
		var set02='agenda';
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
						var email		= "{{Session('email')}}";
						var emailsekpim	= document.getElementById('emailsekpim').value;
						if (email == 'endangsadimlg@gmail.com' || email == 'endangsadimlg@yahoo.co.id'){
							$("#buka_kepada").val(emailsekpim).trigger('change');
						} else {
							$("#buka_kepada").val('');
						}
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
						var directlink 	=  '{{URL::to("/")}}/viewdocbyname/'+dataRecord.marking+'.pdf';
						$('#judulloading').html('Trying Loading File From URL : <a href="'+directlink+'" target="_blank">'+idsurat+'</a><br />If This Process Longer than usually, please use download button instead');
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
						var directlink 	=  '{{URL::to("/")}}/viewdocbyname/'+dataRecord.marking+'.pdf';
						$('#judulloading').html('Trying Loading File From URL : <a href="'+directlink+'" target="_blank">'+idsurat+'</a><br />If This Process Longer than usually, please use download button instead');
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
	$('.select2').select2({width: '100%'});
    $('.divmasukcari').hide();
	$('#divnotadinas').hide();
	$('#divmemo').hide();
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
	//KELOMPOK_TANDATANGAN
		$('.btnopentandatangan').click(function () {
			$('#divkegiatan').hide();
			$('#divnotadinas').hide();
			$('#divmemo').hide();
			$('#divsuratkeluar').show();
			$('#divkalender').hide();
			$('#divdisposisi').hide();
			$('.divisidisposisi').hide();
			$('.divawalkeluar').show();
			$('.divtindakan').hide();
			$('.divcarikeluar').hide();
			var set01="{{Session('jabatan')}}";
			var set02='tandatangan';
			var token=document.getElementById('token').value;
			var sumbersuratkeluar = {
				datatype: "json",
				datafields: [
					{ name: 'id'},
					{ name: 'idinbox'},
					{ name: 'kerja', type: 'text'},
					{ name: 'jenissrt', type: 'text'},
					{ name: 'tglsurat', type: 'text'},
					{ name: 'nosurat', type: 'text'},
					{ name: 'status', type: 'text'},
					{ name: 'perihal', type: 'text'},
					{ name: 'pembuat', type: 'text'},
					{ name: 'penerima', type: 'text'},
					{ name: 'pemberi', type: 'text'},
					{ name: 'kerja', type: 'text'},
					{ name: 'sifat', type: 'text'},
					{ name: 'klasifikasi', type: 'text'},
					{ name: 'tabel', type: 'text'},
					{ name: 'marking', type: 'text'},
					{ name: 'catatan', type: 'text'},
				],
				updaterow: function (rowid, rowdata, commit) {commit(true);},
				type		: 'GET',
				data		: {val01:set01, val02:set02, _token: token},
				url			: '{{ route("inboxOutuserPaged") }}',
				root		: 'data',
				totalrecords: 'total',
				cache		: false,
				filter		: function () {
					$("#tabelsuratkeluar").jqxGrid('updatebounddata', 'filter');
				},
				sort: function () {
					$("#tabelsuratkeluar").jqxGrid('updatebounddata', 'sort');
				},
				beforeprocessing: function (data) {
					if (data != null) {
						sumbersuratkeluar.totalrecords = data.total;
					}
				}
			};
			var dataanalis 		= new $.jqx.dataAdapter(sumbersuratkeluar);
			var rendergridrows 	= $('#tabelsuratkeluar').jqxGrid('rendergridrows');
			$("#tabelsuratkeluar").jqxGrid({
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
				source			: dataanalis,
				pagesizeoptions	: ['10', '20'],
				selectionmode	: 'checkbox',
				altrows			: true,
				theme			: "energyblue",
				columns: [
					{ text: 'Action',  editable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '7%', cellsrenderer: function () {
						return "Click";
						}, buttonclick: function (row) {
							editrow 		= row;	
							var offset 		= $("#tabelsuratkeluar").offset();
							var dataRecord 	= $("#tabelsuratkeluar").jqxGrid('getrowdata', editrow);
							var set01		= dataRecord.idinbox;
							var set02		= dataRecord.tabel;
							var set03		= dataRecord.idinbox;
							var catatan		= dataRecord.catatan;
							var jenissrt	= dataRecord.jenissrt;
							var directlink 	= '';
							if (set02 == 'ALIHSTATUS'){
								var set03		= '{{URL::to("/")}}/verfikasialihstatus/'+dataRecord.idinbox;
								window.location.href = set03;
							} else {
								if (catatan == 'KONTRAK'){
									var url			= '{{URL::to("/")}}/viewsurat/1b8a4d4791bd4b1b030db52b115e99b0-formc='+dataRecord.id;
									var directlink 	= url;
								} else {
									if (jenissrt == 'Jadwal Sif'){
										var url			= '{{URL::to("/")}}/viewsurat/siapiket-'+dataRecord.marking;
										var directlink 	= url;
									} else {
										var url			= '{{URL::to("/")}}/viewsurat/srtklr-'+dataRecord.marking;
										var directlink 	=  '{{URL::to("/")}}/viewdocbyname/'+dataRecord.marking+'.pdf';
									}
								}
								$('.divtindakan').show();
								$('#catatanawal').show();
								$('.divawalkeluar').hide();
								$('#catatantulis').hide();
								$('#loadingimage').show();
								$('#judulloadingsrtkeluar').html('Trying Loading File From URL : <a href="'+directlink+'" target="_blank">'+url+'</a><br />If This Process Longer than usually, please use download button instead');
								$("#id_catatan").val('');
								CKEDITOR.instances['id_footnote'].setData('')
								$("#id_surat").val(set01);
								$("#tabele").val(set02);
								var iframe = '<iframe src="'+url+'" width="100%" height="780" style="border: none;" id="document-preview"></iframe>';
								$('#surate').html(iframe);
							}
						}
					},
					{ text: 'Status',  editable: false, sortable: false, filterable: false,  datafield: 'status', width: '8%', cellsalign: 'left', align: 'center'  },
					{ text: 'Pengirim', datafield: 'pemberi', width: '33%', cellsalign: 'left', align: 'center'  },
					{ text: 'Perihal', datafield: 'perihal', width: '38%', cellsalign: 'left', align: 'center'  },
					{ text: 'Tindakan', editable: false, sortable: false, filterable: false, datafield: 'kerja', width: '10%', cellsalign: 'center', align: 'center'},
				],
			});
		});
		$('#btncariarsipsrtkeluar').click(function () {
			$('.divawalkeluar').hide();
			$('.divtindakan').hide();
			$('.divcarikeluar').show();
			$("#judulpreviewsuratkeluar").html('');
			$("#previesuratkeluar").html('');
			var set01=document.getElementById('cariklr_dari').value;
			var set02=document.getElementById('cariklr_jenis').value;
			var token=document.getElementById('token').value;
			var carisumbersuratkeluar = {
				datatype: "json",
				datafields: [
					{ name: 'id'},
					{ name: 'idinbox'},
					{ name: 'kerja', type: 'text'},
					{ name: 'jenissrt', type: 'text'},
					{ name: 'tglsurat', type: 'text'},
					{ name: 'nosurat', type: 'text'},
					{ name: 'status', type: 'text'},
					{ name: 'perihal', type: 'text'},
					{ name: 'pembuat', type: 'text'},
					{ name: 'penerima', type: 'text'},
					{ name: 'pemberi', type: 'text'},
					{ name: 'kerja', type: 'text'},
					{ name: 'sifat', type: 'text'},
					{ name: 'klasifikasi', type: 'text'},
					{ name: 'tabel', type: 'text'},
					{ name: 'marking', type: 'text'},
					{ name: 'catatan', type: 'text'},
				],
				updaterow: function (rowid, rowdata, commit) {commit(true);},
				type		: 'GET',
				data		: {val01:set01, val02:set02, _token: token},
				url			: '{{ route("inboxOutuserPaged") }}',
				root		: 'data',
				totalrecords: 'total',
				cache		: false,
				filter		: function () {
					$("#tabelcarikeluar").jqxGrid('updatebounddata', 'filter');
				},
				sort: function () {
					$("#tabelcarikeluar").jqxGrid('updatebounddata', 'sort');
				},
				beforeprocessing: function (data) {
					if (data != null) {
						carisumbersuratkeluar.totalrecords = data.total;
					}
				}
			};
			var datasrtklrcari 	= new $.jqx.dataAdapter(carisumbersuratkeluar);
			var rendergridrows 	= $('#tabelcarikeluar').jqxGrid('rendergridrows');
			$("#tabelcarikeluar").jqxGrid({
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
				source			: datasrtklrcari,
				pagesizeoptions	: ['10', '20'],
				altrows			: true,
				theme			: "energyblue",
				columns: [
					{ text: 'Open',  editable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '7%', cellsrenderer: function () {
						return "Open";
						}, buttonclick: function (row) {
							editrow 		= row;	
							var offset 		= $("#tabelcarikeluar").offset();
							var dataRecord 	= $("#tabelcarikeluar").jqxGrid('getrowdata', editrow);
							var set01		= dataRecord.id;
							var url			= '{{URL::to("/")}}/downloaddocbyname/'+dataRecord.marking+'.pdf';
							$('#judulpreviewsuratkeluar').html('Trying Loading File From URL : <a href="'+url+'" target="_blank">'+dataRecord.perihal+'</a><br />If This Process Longer than usually, please use download button instead');
							var iframe = '<iframe src="'+url+'" width="100%" height="780" style="border: none;" id="document-preview"></iframe>';
							$('#previesuratkeluar').html(iframe);
							$("html, body").animate({ scrollTop: 100 }, "slow");
						}
					},
					{ text: 'Status',  editable: false, sortable: false, filterable: false,  datafield: 'status', width: '8%', cellsalign: 'left', align: 'center'  },
					{ text: 'Pengirim', datafield: 'pemberi', width: '35%', cellsalign: 'left', align: 'center'  },
					{ text: 'Perihal', datafield: 'perihal', width: '40%', cellsalign: 'left', align: 'center'  },
					{ text: 'Undo', editable: false, sortable: false, filterable: false, columntype: 'button', width: '9%', align: 'center', cellsrenderer: function () {
						return "Undo";
						}, buttonclick: function (row) {
							editrow = row;
							var offset 		= $("#tabelcarikeluar").offset();
							var dataRecord 	= $("#tabelcarikeluar").jqxGrid('getrowdata', editrow);
							swal({
								title: 'Apakah Anda Yakin.?',
								text: "Surat Ini Akan Kami Kembalikan ke Laman Permohonan TTD/Paraf untuk diulang kembali. Apakah Anda Yakin.?",
								type: 'warning',
								showCancelButton: true,
								confirmButtonClass: 'btn btn-confirm mt-2',
								cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
								confirmButtonText: 'Yes.!'
							}).then(function () {
								$.post('{{ route("undodisposisi") }}', { val01: dataRecord.id, val02: dataRecord.idinbox, val03: dataRecord.tabel, _token: '{{ csrf_token() }}' }, function(data){					
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
									$('.divawalkeluar').show();
									$('.divtindakan').hide();
									$('.divcarikeluar').hide();
									$("#tabelsuratkeluar").jqxGrid('updatebounddata', 'filter');
									return false;
								});
							});
						}
					},
				],
			});
		});
		$('#btnshowpassword').on('click', function (){
			var x = document.getElementById('id_password');
			if (x.type === "password") {
				x.type = "text";
			} else {
				x.type = "password";
			}
		});
		$("#id_catatan").on('change', function () {
			var val01	= $(this).find('option:selected').attr('value');
			if (val01 == 'Isi Catatan Sendiri'){
				$('#catatanawal').hide();
				$('#catatantulis').show();
			} else {
				CKEDITOR.instances['id_footnote'].setData(val01)
			}
		});	
		$("#multi_footnote").on('change', function () {
			var val01	= $(this).find('option:selected').attr('value');
			if (val01 == 'Isi Catatan Sendiri'){
				$('#catatanawalmulti').hide();
				$('#catatantulismulti').show();
			} else {
				CKEDITOR.instances['multi_footnotebebas'].setData(val01)
			}
		});	
		$("#tolak_footnote").on('change', function () {
			var val01	= $(this).find('option:selected').attr('value');
			if (val01 == 'Isi Catatan Sendiri'){
				$('#catatanawalmultitolak').hide();
				$('#catatantulismultitolak').show();
			} else {
				CKEDITOR.instances['tolak_footnotebebas'].setData(val01)
			}
		});	
		$('#btnttdmulti').on('click', function (){
			$("#modalmultittd").modal('show');
			$('#catatanawalmulti').show();
			$('#catatantulismulti').hide();
			$("#multi_footnote").val('');
			
		});
		$('#btntolakmulti').on('click', function (){
			$("#modalmultitolak").modal('show');
			$('#catatanawalmultitolak').show();
			$('#catatantulismultitolak').hide();
			$("#tolak_footnote").val('');
		});
		$('#btnbubuhkanmultitolak').click(function () {
			var set01 = 'PENOLAKAN';
			var set02 = document.getElementById('tolak_footnote').value;
			if (set02 == 'Isi Catatan Sendiri') { var set02 = CKEDITOR.instances['tolak_footnotebebas'].getData(); }
			var rows = $("#tabelsuratkeluar").jqxGrid('selectedrowindexes');
			var selectedRecords = new Array();
			for (var m = 0; m < rows.length; m++) {
				var row = $("#tabelsuratkeluar").jqxGrid('getrowdata', rows[m]);
				if (row){
					selectedRecords.push(row.idinbox);
				}
			}
			if (m == 0){
				swal({
					title: 'Stop',
					text: 'Mohon maaf, mohon centang surat yang ingin anda tanda tangani.',
					type: 'warning',
				})
			} else if (set02 == ''){
				swal({
					title: 'Stop',
					text: 'Mohon maaf, catatan wajib di isi untuk dapat diperhatikan konseptor awal.',
					type: 'warning',
				})
			} else {
				$("#modalmultitolak").modal('hide');
				$("#loading").show();
				$('.divawalkeluar').hide();
				var token = document.getElementById('token').value;
				$.post('{{ route("exsimpanttdmulti") }}', { val01: set01, val02: set02, val03: selectedRecords, val04: "", _token: token },
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
					$("#tabelsuratkeluar").jqxGrid('clearselection');
					$("#tabelsuratkeluar").jqxGrid('updatebounddata', 'filter');
					$('#loading').hide();
					$('.divawalkeluar').show();
					return false;
				});
			}
		});
		$('#btnbubuhkanmulti').click(function () {
			var set01 = document.getElementById('multi_password').value;
			var set02 = document.getElementById('multi_footnote').value;
			if (set02 == 'Isi Catatan Sendiri') { var set02 = CKEDITOR.instances['multi_footnotebebas'].getData(); }
			var rows = $("#tabelsuratkeluar").jqxGrid('selectedrowindexes');
			var selectedRecords = new Array();
			for (var m = 0; m < rows.length; m++) {
				var row = $("#tabelsuratkeluar").jqxGrid('getrowdata', rows[m]);
				if (row){
					selectedRecords.push(row.idinbox);
				}
			}
			if (m == 0){
				swal({
					title: 'Stop',
					text: 'Mohon maaf, mohon centang surat yang ingin anda tanda tangani.',
					type: 'warning',
				})
			} else {
				$("#loading").show();
				$("#modalmultittd").modal('hide');
				$('.divawalkeluar').hide();
				var token = document.getElementById('token').value;
				$.post('{{ route("exsimpanttdmulti") }}', { val01: set01, val02: set02, val03: selectedRecords, val04: "", _token: token },
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
					$("#tabelsuratkeluar").jqxGrid('clearselection');
					$("#tabelsuratkeluar").jqxGrid('updatebounddata', 'filter');
					$('#loading').hide();
					$('.divawalkeluar').show();
					return false;
				});
			}
		});
		$('#save').click(function () {
			var set01 = document.getElementById('id_password').value;
			var set02 = document.getElementById('id_surat').value;
			var set03 = document.getElementById('id_catatan').value;
			var set04 = document.getElementById('tabele').value;
			var token = document.getElementById('token').value;
			if (set03 == 'Isi Catatan Sendiri') { var set03 = CKEDITOR.instances['id_footnote'].getData(); }
			if (set01 == ''){
				swal({
					title	: 'Stop',
					text	: 'Passphare Tidak Boleh Kosong',
					type	: 'warning',
				})
			} else {
				$("#loading").show();
				$('.divtindakan').hide();
				$.post('{{ route("exsimpanttd") }}', { val01: set01, val02: set02, val03: set03, val04: set04, val05: "", _token: token },
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
					$("#tabelsuratkeluar").jqxGrid('clearselection');
					$("#tabelsuratkeluar").jqxGrid('updatebounddata', 'filter');
					$('#loading').hide();
					$('.divawalkeluar').show();
					return false;
				});	
			}
		});
		$('#btnbatal').click(function () {
			var set01 = 'kembalikan';
			var set02 = document.getElementById('id_surat').value;
			var set03 = document.getElementById('id_catatan').value;
			var set04 = document.getElementById('tabele').value;
			var token = document.getElementById('token').value;
			if (set03 == 'Isi Catatan Sendiri') { var set03 = CKEDITOR.instances['id_footnote'].getData(); }
			if (set03 == ''){
				swal({
					title	: 'Stop',
					text	: 'Mohon isi catatan, agar konseptor membaca dan memperbaiki surat ini sesuai saran',
					type	: 'warning',
				})
			} else {
				$("#loading").show();
				$('.divtindakan').hide();
				$.post('{{ route("exsimpanttd") }}', { val01: set01, val02: set02, val03: set03, val04: set04, _token: token },
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
					$("#tabelsuratkeluar").jqxGrid('clearselection');
					$("#tabelsuratkeluar").jqxGrid('updatebounddata', 'filter');
					$('#loading').hide();
					$('.divawalkeluar').show();
					return false;
				});
			}
		});
		$('#clear').click(function () {
			$('.divtindakan').hide();
			$('.divawalkeluar').show();
		});
	//END_KELOMPOK_TANDATANGAN
	//KELOMPOK_NOTADINAS
		$('.btnnotadinas').click(function () {
			$('#divkegiatan').hide();
			$('#divnotadinas').show();
			$('#divmemo').hide();
			$('#divsuratkeluar').hide();
			$('#divkalender').hide();
			$('#divdisposisi').hide();
			$('.divisidisposisi').hide();
			$('.divtambahnotadinas').hide();
			$('.divtrackingnotadinas').hide();
			$('.divawalnotadinas').show();
			var set01="{{Session('jabatan')}}";
			var set02='notadinas';
			var token=document.getElementById('token').value;
			var sumbernotadinas = {
				datatype: "json",
				datafields: [
					{ name: 'id'},
					{ name: 'idinbox'},
					{ name: 'kerja', type: 'text'},
					{ name: 'jenissrt', type: 'text'},
					{ name: 'tglsurat', type: 'text'},
					{ name: 'nosurat', type: 'text'},
					{ name: 'status', type: 'text'},
					{ name: 'perihal', type: 'text'},
					{ name: 'pembuat', type: 'text'},
					{ name: 'kepada', type: 'text'},
					{ name: 'pemberi', type: 'text'},
					{ name: 'kerja', type: 'text'},
					{ name: 'sifat', type: 'text'},
					{ name: 'klasifikasi', type: 'text'},
					{ name: 'tabel', type: 'text'},
					{ name: 'marking', type: 'text'},
					{ name: 'catatan', type: 'text'},
				],
				updaterow: function (rowid, rowdata, commit) {commit(true);},
				type		: 'GET',
				data		: {val01:set01, val02:set02, _token: token},
				url			: '{{ route("inboxOutuserPaged") }}',
				root		: 'data',
				totalrecords: 'total',
				cache		: false,
				filter		: function () {
					$("#gridnotadinas").jqxGrid('updatebounddata', 'filter');
				},
				sort: function () {
					$("#gridnotadinas").jqxGrid('updatebounddata', 'sort');
				},
				beforeprocessing: function (data) {
					if (data != null) {
						sumbernotadinas.totalrecords = data.total;
					}
				}
			};
			var datajsonnd 		= new $.jqx.dataAdapter(sumbernotadinas);
			var rendergridrows 	= $('#gridnotadinas').jqxGrid('rendergridrows');
			$("#gridnotadinas").jqxGrid({
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
				source			: datajsonnd,
				pagesizeoptions	: ['10', '20'],
				altrows			: true,
				theme			: "energyblue",
				columns: [
					{ text: 'Status',  editable: false, sortable: false, filterable: false,  datafield: 'status', width: '8%', cellsalign: 'left', align: 'center'  },
					{ text: 'Tracking', editable: false, sortable: false, filterable: false, datafield: 'kerja', width: '10%', cellsalign: 'center', align: 'center'},
					{ text: 'Penerima', datafield: 'kepada', width: '35%', cellsalign: 'left', align: 'center'  },
					{ text: 'Perihal', datafield: 'perihal', width: '40%', cellsalign: 'left', align: 'center'  },
					{ text: 'Hapus', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', align: 'center', cellsrenderer: function () {
						return "Hapus";
						}, buttonclick: function (row) {
							editrow = row;
							var offset 		= $("#gridnotadinas").offset();
							var dataRecord 	= $("#gridnotadinas").jqxGrid('getrowdata', editrow);
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
									$("#gridnotadinas").jqxGrid('updatebounddata', 'filter');
									return false;
								});
							});
						}
					},
				],
			});
		});
		$('#btnsimpannotadinas').click(function () {
			var set01 = '4';
			var set02 = 'Biasa';
			var set03 = 'TU.01';
			var set04 = "{{date('Y-m-d')}}";
			var set05 = '-';
			var set06 = '-';
			var set07 = "{{ Session('nama') }}";
			var set08 = "{{ Session('jabatan') }}";
			var set09 = "{{ Session('jabatan') }}";
			var set10 = "ARL";
			var set11 = "16";
			var set12 = "50";
			var set13 = "SELF";
			var set14 = "";
			var set15 = "";
			var set16 = "";
			var set17 = CKEDITOR.instances['nodin_isi'].getData()
			var set18 = "-";
			var set19 = "TU";
			var set20 = document.getElementById('nodin_hal').value;
			var set21 = document.getElementById('nodin_kepada').value;
			var set22 = document.getElementById('nodin_tembusan').value;
			var set23 = document.getElementById('nodin_filelampiran');
			var set24 = document.getElementById('nodin_id').value;
			var set25 = "";
			var set26 = document.getElementById('nodin_password').value;
			var set27 = document.getElementById('nodin_sebagai').value;
			var token = document.getElementById('token').value;
			if (set17 == ''){ 
				swal({
					title	: 'Stop',
					text	: 'Mohon Tulis Isi Surat Dinas',
					type	: 'warning',
				})
			} else if (set20 == ''){
				swal({
					title	: 'Stop',
					text	: 'Mohon Tulis Isi Perihal',
					type	: 'warning',
				})
			} else if (set21 == ''){
				swal({
					title	: 'Stop',
					text	: 'Mohon Pilih Penerima Suratnya',
					type	: 'warning',
				})
			} else {
				$("#loading").show();
				$('.divtambahnotadinas').hide();
				var form_data = new FormData();
					form_data.append('id_filelampiran', set23.files[0]);
					form_data.append('id_klasifikasiarsip', set03);
					form_data.append('id_tanggal', set04);
					form_data.append('id_jenissurat', set19);
					form_data.append('id_lampiran', set05);
					form_data.append('id_hal', set20);
					form_data.append('id_tertuju', set21);
					form_data.append('id_alamat', '');
					form_data.append('isi_surat', set17);
					form_data.append('id_namapenandatangan', set08);
					form_data.append('id_konseptor', set07);
					form_data.append('id_tembusan', set22);
					form_data.append('id_penandatangan', set09);
					form_data.append('id_sifat', set01);
					form_data.append('id_klasifikasi', set02);
					form_data.append('id_surat', set24);
					form_data.append('id_kodepjbt', set18);
					form_data.append('id_dasartahun', '');
					form_data.append('id_dasar', set06);
					form_data.append('idparaf1', set13);
					form_data.append('idparaf2', set14);
					form_data.append('idparaf3', set15);
					form_data.append('idparaf4', set16);
					form_data.append('id_font', set10);
					form_data.append('id_ukuran', set11);
					form_data.append('id_lebar', 'NOTA DINAS');
					form_data.append('username', set25);
					form_data.append('password', set26);
					form_data.append('sebagai', set27);
					form_data.append('_token', '{{csrf_token()}}');
				$.ajax({
					url			: '{{ route("exAddmemo") }}',
					data		: form_data,
					type		: 'POST',
					contentType	: false,
					processData	: false,
					success		: function (data) {
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
						$("#loading").hide();
						$('.divawalnotadinas').show();
						$("html, body").animate({ scrollTop: 0 }, "slow");
						$("#gridnotadinas").jqxGrid('updatebounddata', 'filter');	
						return false;
					},
					error: function (xhr, status, error) {
						$("#loading").hide();
						$('.divtambahnotadinas').show();
						swal({
							title: 'Stop',
							text: xhr.responseText,
							type: 'warning',
						})
					}
				});
			}
		});
		$('#btntambahnotadinas').click(function () {
			$('.divtambahnotadinas').show();
			$('.divtrackingnotadinas').hide();
			$('.divawalnotadinas').hide();
			$('#nodin_id').val('new');
			$('#nodin_filelampiran').val('');
		});
		$('#btnbataladdnodin').click(function () {
			$('.divtambahnotadinas').hide();
			$('.divtrackingnotadinas').hide();
			$('.divawalnotadinas').show();
			$('#nodin_id').val('new');
		});
	//END_KELOMPOK_NOTADINAS
	//KELOMPOK_MEMO
		$('.btnmemo').click(function () {
			$('#divkegiatan').hide();
			$('#divnotadinas').hide();
			$('#divmemo').show();
			$('#divsuratkeluar').hide();
			$('#divkalender').hide();
			$('#divdisposisi').hide();
			$('.divtambahmemo').hide();
			$('.divtrackingmemo').hide();
			$('.divawalmemo').show();
			var set01="{{Session('jabatan')}}";
			var set02='memo';
			var token=document.getElementById('token').value;
			var sumbermemo = {
				datatype: "json",
				datafields: [
					{ name: 'id'},
					{ name: 'idinbox'},
					{ name: 'kerja', type: 'text'},
					{ name: 'jenissrt', type: 'text'},
					{ name: 'tglsurat', type: 'text'},
					{ name: 'nosurat', type: 'text'},
					{ name: 'status', type: 'text'},
					{ name: 'perihal', type: 'text'},
					{ name: 'pembuat', type: 'text'},
					{ name: 'kepada', type: 'text'},
					{ name: 'pemberi', type: 'text'},
					{ name: 'kerja', type: 'text'},
					{ name: 'sifat', type: 'text'},
					{ name: 'klasifikasi', type: 'text'},
					{ name: 'tabel', type: 'text'},
					{ name: 'marking', type: 'text'},
					{ name: 'catatan', type: 'text'},
				],
				updaterow: function (rowid, rowdata, commit) {commit(true);},
				type		: 'GET',
				data		: {val01:set01, val02:set02, _token: token},
				url			: '{{ route("inboxOutuserPaged") }}',
				root		: 'data',
				totalrecords: 'total',
				cache		: false,
				filter		: function () {
					$("#gridmemo").jqxGrid('updatebounddata', 'filter');
				},
				sort: function () {
					$("#gridmemo").jqxGrid('updatebounddata', 'sort');
				},
				beforeprocessing: function (data) {
					if (data != null) {
						sumbermemo.totalrecords = data.total;
					}
				}
			};
			var datajsonmemo 	= new $.jqx.dataAdapter(sumbermemo);
			var rendergridrows 	= $('#gridmemo').jqxGrid('rendergridrows');
			$("#gridmemo").jqxGrid({
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
				source			: datajsonmemo,
				pagesizeoptions	: ['10', '20'],
				altrows			: true,
				theme			: "energyblue",
				columns: [
					{ text: 'Status',  editable: false, sortable: false, filterable: false,  datafield: 'status', width: '8%', cellsalign: 'left', align: 'center'  },
					{ text: 'Tracking', editable: false, sortable: false, filterable: false, datafield: 'kerja', width: '10%', cellsalign: 'center', align: 'center'},
					{ text: 'Penerima', datafield: 'kepada', width: '35%', cellsalign: 'left', align: 'center'  },
					{ text: 'Perihal', datafield: 'perihal', width: '40%', cellsalign: 'left', align: 'center'  },
					{ text: 'Hapus', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', align: 'center', cellsrenderer: function () {
						return "Hapus";
						}, buttonclick: function (row) {
							editrow = row;
							var offset 		= $("#gridmemo").offset();
							var dataRecord 	= $("#gridmemo").jqxGrid('getrowdata', editrow);
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
									$("#gridmemo").jqxGrid('updatebounddata', 'filter');
									return false;
								});
							});
						}
					},
				],
			});
		});
		$('#btnsimpanmemo').click(function () {
			var set01 = "4";
			var set02 = "Biasa";
			var set03 = "TU.01";
			var set04 = "{{date('Y-m-d')}}";
			var set05 = "-";
			var set06 = "-";
			var set07 = "{{ Session('nama') }}";
			var set08 = "{{ Session('jabatan') }}";
			var set09 = "{{ Session('idjabatan') }}";
			var set10 = "ARL";
			var set11 = "16";
			var set12 = "50";
			var set13 = "SELF";
			var set14 = "";
			var set15 = "";
			var set16 = "";
			var set17 = CKEDITOR.instances['memo_isi'].getData()
			var set18 = "-";
			var set19 = "TU";
			var set20 = document.getElementById('memo_hal').value;
			var set21 = document.getElementById('memo_kepada').value;
			var set22 = "";
			var set23 = document.getElementById('memo_filelampiran');
			var set24 = document.getElementById('memo_id').value;
			var set25 = "";
			var set26 = document.getElementById('memo_password').value;
			var set27 = "";
			var token = document.getElementById('token').value;
			if (set17 == ''){ 
				swal({
					title	: 'Stop',
					text	: 'Mohon Tulis Isi Surat Dinas',
					type	: 'warning',
				})
			} else if (set20 == ''){
				swal({
					title	: 'Stop',
					text	: 'Mohon Tulis Isi Perihal',
					type	: 'warning',
				})
			} else if (set21 == ''){
				swal({
					title	: 'Stop',
					text	: 'Mohon Pilih Penerima Suratnya',
					type	: 'warning',
				})
			} else {
				$("#loading").show();
				$('.divtambahmemo').hide();
				var form_data 	= new FormData();
					form_data.append('id_filelampiran', set23.files[0]);
					form_data.append('id_klasifikasiarsip', set03);
					form_data.append('id_tanggal', set04);
					form_data.append('id_jenissurat', set19);
					form_data.append('id_lampiran', set05);
					form_data.append('id_hal', set20);
					form_data.append('id_tertuju', set21);
					form_data.append('id_alamat', '');
					form_data.append('isi_surat', set17);
					form_data.append('id_namapenandatangan', set08);
					form_data.append('id_konseptor', set07);
					form_data.append('id_tembusan', set22);
					form_data.append('id_penandatangan', set09);
					form_data.append('id_sifat', set01);
					form_data.append('id_klasifikasi', set02);
					form_data.append('id_surat', set24);
					form_data.append('id_kodepjbt', set18);
					form_data.append('id_dasartahun', '');
					form_data.append('id_dasar', set06);
					form_data.append('idparaf1', set13);
					form_data.append('idparaf2', set14);
					form_data.append('idparaf3', set15);
					form_data.append('idparaf4', set16);
					form_data.append('id_font', set10);
					form_data.append('id_ukuran', set11);
					form_data.append('id_lebar', 'MEMO');
					form_data.append('username', set25);
					form_data.append('password', set26);
					form_data.append('sebagai', set27);
					form_data.append('_token', '{{csrf_token()}}');
				$.ajax({
					url			: '{{ route("exAddmemo") }}',
					data		: form_data,
					type		: 'POST',
					contentType	: false,
					processData	: false,
					success		: function (data) {
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
						$("#loading").hide();
						$('.divawalmemo').show();
						$("html, body").animate({ scrollTop: 0 }, "slow");
						$("#gridmemo").jqxGrid('updatebounddata', 'filter');	
						return false;
					},
					error: function (xhr, status, error) {
						$("#loading").hide();
						$('.divtambahmemo').show();
						swal({
							title: 'Stop',
							text: xhr.responseText,
							type: 'warning',
						})
					}
				});
			}
		});
		$('#btntambahmemo').click(function () {
			$('.divtambahmemo').show();
			$('.divtrackingmemo').hide();
			$('.divawalmemo').hide();
			$('#memo_filelampiran').val('');
			$('#memo_id').val('new');
		});
		$('#btnbataladdmemo').click(function () {
			$('.divtambahmemo').hide();
			$('.divtrackingmemo').hide();
			$('.divawalmemo').show();
			$('#memo_id').val('new');
		});
	//END_KELOMPOK_MEMO
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
							$('#notulensi_isi').summernote('code', dataRecord.notulensi);
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
			var val02=$('#notulensi_isi').summernote('code');
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
		$('#notulensi_isi').summernote()
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
	//KELOMPOK_EVENT
		$('.btnopendataevent').click(function () {
			$('#divnotadinas').hide();
			$('#divmemo').hide();
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
					{ text: 'Kuota', datafield: 'kapasitas', width: '10%', cellsalign: 'left', align: 'center'  },
					{ text: 'Pendaftar', datafield: 'peserta', width: '10%', cellsalign: 'left', align: 'center'  },
					{ text: 'Presensi', cellsalign: 'center', align: 'center', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
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
			$("#gridsendiri").jqxGrid('updatebounddata', 'filter');
		});
		$('.btnopenmailbox').click(function () {
			$('#divkegiatan').hide();
			$('#divnotadinas').hide();
			$('#divmemo').hide();
			$('#divsuratkeluar').hide();
			$('#divkalender').hide();
			$('#divdisposisi').show();
			$('.divisidisposisi').hide();
			$('.divawaldisposisi').show();
			$('.divmasukcari').hide();
			$('#judulpreviewsuratmasuk').html('');
			$('#previesuratmasuk').html('');
			openmailbox();
		});
		$("#btnkembalikedispo").click(function(){
			$('.divisidisposisi').hide();
			$('.divawaldisposisi').show();
		});
		$("#btnsimpancatatn").click(function(){
			var set01 		= document.getElementById('buka_idne').value;
			var set02		= $('#buka_kepada').select2().val();
			var set03		= CKEDITOR.instances['buka_catatan'].getData();
			var set04 		= document.getElementById('buka_kelompok').value;
			var set05 		= document.getElementById('filelampiran');
            var set06 		= document.getElementById('buka_sifatdiposisi').value;
			var email		= "{{Session('email')}}";
			var emailsekpim	= document.getElementById('emailsekpim').value;
			var CHEKED 	    = new Array();
			var m 			= 0;
			$("input[name='formDoor[]']:checked").each(function(){
				CHEKED.push($(this).val());
				m++;
			});
				
			if (email == 'endangsadimlg@gmail.com' || email == 'endangsadimlg@yahoo.co.id'){
				if (set02 == '') { var set02 = emailsekpim; }
			}
			if (set03 == '') {
				if (m == 0){

				} else {
					var set03 = '-';
				}
			}
			if (set02 == '' || set03 == ''){
				swal({
					title	: 'Stop',
					text	: 'Penerima Disposisi dan Isi Disposisi Wajib Terisi!',
					type	: 'warning',
				})
			} else {
				$('.divisidisposisi').hide();
				$('#loading').show();
				var form_data = new FormData();
					form_data.append('kerja_idsurat', set01);
					form_data.append('tanggal', 'Pimpinan');
					form_data.append('id_disposisi', set03);
					form_data.append('kelompok', set04);
					form_data.append('file', set05.files[0]);
					form_data.append('formDoor', CHEKED);
					form_data.append('id_sifatdiposisi', set06);
					form_data.append('kepada', set02);
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
		$('#btnviewtracking').click(function () {
			var set01=document.getElementById('cari_dari').value;
			var set02=document.getElementById('cari_jenis').value;
			if (set01 == ''){
				$('.divawaldisposisi').show();
				$('.divmasukcari').hide();
			} else {
				$('.divawaldisposisi').show();
				$('.divmasukcari').show();
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
					data		: {dari:set01, jenis:set02, surat:'KELUAR', _token: '{{ csrf_token() }}'},
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
						{ text: 'Surat', editable: false, sortable: false, filterable: false, columntype: 'button', width: 70, cellsrenderer: function () {
							return "Preview";
							}, buttonclick: function (row) {
								editrow = row;	
								var offset 		= $("#tabelcari").offset();		
								var dataRecord 	= $("#tabelcari").jqxGrid('getrowdata', editrow);
								var set03		= '{{URL::to("/")}}/viewsurat/7a07275b47504815818abc970da769fc-'+dataRecord.id;
								$('#judulpreviewsuratmasuk').html('Trying Loading File From URL : <a href="'+set03+'" target="_blank">'+set03+'</a><br />If This Process Longer than usually, please use download button instead');
								var iframe = '<iframe src="'+set03+'" width="100%" height="780" style="border: none;" id="document-preview"></iframe>';
								$('#previesuratmasuk').html(iframe);
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
								var offset 		= $("#tabelcari").offset();
								var dataRecord 	= $("#tabelcari").jqxGrid('getrowdata', editrow);
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
										$('.divawaldisposisi').show();
										$('.divmasukcari').hide();
										$("#gridsendiri").jqxGrid('updatebounddata', 'filter');
										return false;
									});
								});
							}
						},
					],
				});
			}
		});
	//END_KELOMPOK_KALENDER
});
</script>
@endpush