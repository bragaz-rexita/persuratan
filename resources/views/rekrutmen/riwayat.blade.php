@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1 class="m-0"> {!! $biodata->prodihomebase !!} => {!! $biodata->jenjanghomebase !!}</h1>
          </div>
		  <div class="col-sm-4">
          </div>
        </div>
      </div>
    </div>
    <div class="content" >
        <div class="container-fluid">
            <div class="row" >
				<div class="col-md-3">
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">Form List</h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse">
									<i class="fa fa-minus"></i>
								</button>
							</div>
						</div>
						<div class="card-body">
							<div class="form-group">
								<ul class="nav nav-pills flex-column">
									<li class="nav-item divcontrolpanel"><a href="#" id="btnshowdepan" class="nav-link"><i class="fa fa-user"></i> Biodata</a></li>
									<li class="nav-item divcontrolpanel"><a href="#" id="btnshowonline" class="nav-link"><i class="fa fa-newspaper-o"></i> Upload Persyaratan</a></li>
									<li class="nav-item divcontrolpanel"><a href="#" id="btnriwayatdiri" class="nav-link"><i class="fa fa-stethoscope"></i> Tes Kesehatan</a></li>
									<li class="nav-item divcontrolpanel"><a href="#" id="btnriwayatpendidikan" class="nav-link"><i class="fa fa-font"></i> Riwayat Pendidikan</a></li>
									<li class="nav-item divcontrolpanel"><a href="#" id="btnriwayatorganisasi" class="nav-link"><i class="fa fa-tag"></i> Riwayat Organisasi</a></li>
									<li class="nav-item divcontrolpanel"><a href="#" id="btnriwayatkeluarga" class="nav-link"><i class="fa fa-th-list"></i> Riwayat Keluarga</a></li>
									<li class="nav-item divcontrolpanel"><a href="#" id="btnriwayatdiklat" class="nav-link"><i class="fa fa-list"></i> Riwayat Diklat</a></li>
									<li class="nav-item divcontrolpanel"><a href="#" id="btnriwayatpenghargaan" class="nav-link"><i class="fa fa-list-alt"></i> Riwayat Penghargaan</a></li>
									<li class="nav-item"><a href="#" id="btnubahpassword" class="nav-link"><i class="fa fa-users"></i> Ubah Password</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="card card-success">
						<div class="card-header">
							<h3 class="card-title">Tahapan</h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse">
									<i class="fa fa-minus"></i>
								</button>
							</div>
						</div>
						<div class="card-body">
							<div class="btn-group-vertical">
									<a href="/profiluser" class="btn btn-app btn-block bg-primary"><i class="fa fa-user"></i> Update Curiculum Vitae</a>
									@if ($biodata->status_pegawai == '1' OR $biodata->status_pegawai == '' OR $biodata->status_pegawai == null)
										<a href="#" class="btn btn-app btn-block bg-grey" id="btnkirimberkasall"><i class="fa fa-arrow-circle-right"></i> Kirim Untuk Proses Verifikasi</a>
										<a href="#" class="btn btn-app btn-block bg-grey"><i class="fa fa-info"></i> Pengumuman - Pengumuman</a>
									@elseif ($biodata->status_pegawai == 'Terverifikasi')
										<a href="/teskompetensi" class="btn btn-app btn-block bg-grey"><i class="fa fa-pencil"></i> Ujian CBT</a>
										<a href="/wawancara" class="btn btn-app btn-block bg-grey"><i class="fa fa-users"></i> Ujian Wawancara</a>
										<a href="#" class="btn btn-app btn-block bg-grey"><i class="fa fa-info"></i> Pengumuman - Pengumuman</a>
									@else
										<a href="#" class="btn btn-app btn-block bg-grey"><i class="fa fa-arrow-circle-right"></i> Kirim Untuk Proses Verifikasi</a>
										<a href="#" class="btn btn-app btn-block bg-grey"><i class="fa fa-info"></i> Pengumuman - Pengumuman</a>
									@endif
							</div>
						</div>
					</div>
                </div>
                <div class="col-md-9">
					<div class="card card-widget widget-user-2">
						<div class="widget-user-header bg-success">
							<div class="widget-user-image">
								<img class="img-circle elevation-2" src="mascot.png" alt="User Avatar">
							</div>
							<h3 class="widget-user-username">Tahapan</h3>
							<h5 class="widget-user-desc">
									@if ($biodata->status_pegawai == '1' OR $biodata->status_pegawai == '' OR $biodata->status_pegawai == null)
										<a href="/profiluser" class="btn btn-primary"><i class="fa fa-user"></i> Update Curiculum Vitae</a>
										<a href="#" class="btn btn-warning" id="btnkirimberkasall"><i class="fa fa-arrow-circle-right"></i> Kirim Untuk Proses Verifikasi</a>
										<a href="#" class="btn btn-warning"><i class="fa fa-info"></i> Pengumuman - Pengumuman</a>
									@elseif ($biodata->status_pegawai == 'Terverifikasi')
										<a href="/teskompetensi" class="btn btn-warning"><i class="fa fa-pencil"></i> Ujian CBT</a>
										<a href="/wawancara" class="btn btn-warning"><i class="fa fa-users"></i> Ujian Wawancara</a>
										<a href="#" class="btn btn-primary"><i class="fa fa-info"></i> Pengumuman - Pengumuman</a>
									@else
										<a href="/profiluser" class="btn btn-primary"><i class="fa fa-user"></i> Update Curiculum Vitae</a>
										<a href="#" class="btn btn-warning"><i class="fa fa-arrow-circle-right"></i> Kirim Untuk Proses Verifikasi</a>
										<a href="#" class="btn btn-warning"><i class="fa fa-info"></i> Pengumuman - Pengumuman</a>
									@endif
									<a href="{{ url('/') }}/resetprodi" class="btn btn-danger"><i class="fa fa-sign-out"></i> Batalkan / Ubah Pilihan Formasi</a>
							</h5>
						</div>
					</div>
                    <div id="logprogram"></div>
					<div id="halamanonline">
                        <div class="card card-primary card-outline" >
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{!!$foto!!}" alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">Berkas Persyaratan</h3>
                                <p class="text-muted text-center">{!! $biodata->nama_lengkap !!}</p>
                            </div>
                            <div class="card-body" id="divtambahonline">
								<div class="form-group">
									<label>Nama Berkas</label>
									<input type="text" class="form-control" id="berkas_nama">
								</div>
								<div class="form-group">
									<label>Link Berkas</label>
									<input type="text" class="form-control" id="berkas_url">
									<p class="text-muted">Upload Berkas Bapak/Ibu Ke Google Drive Kemudian Share Link Berkas Tersebut menjadi Link Public, kemudian masukkan link tersebut ke input diatas.</p>
								</div>
								<div class="form-group">
									<input type="hidden" class="form-control" id="berkas_idne">
                                	<button type="button" class="btn btn-danger pull-left" id="btnkembalidrtambahonline">Cancel</button>
									<button type="button" class="btn btn-success pull-right" id="btnsimpanberkas">Simpan</button>
								</div>
							</div>
							<div class="card-footer">
								<div id="gridonline"></div>
                            </div>
                        </div>
                    </div><!-- /batas halaman Berkas Persyratan -->
                    <div id="halamanmuka" class="row">
						@if ($biodata->status_pegawai == 'Terverifikasi')
							<div class="col-lg-12">
								<div class="card card-primary card-outline" >
									<div class="card-body box-profile">
										<div class="text-center">
											<img class="profile-user-img img-fluid img-circle" src="{!!$foto!!}" alt="User profile picture">
										</div>
										<h3 class="profile-username text-center">Berkas Persyaratan</h3>
										<p class="text-muted text-center">Telah Terverifikasi</p>
									</div>
									<div class="card-body">
										<h1>Pengumuman</h1>
									</div>
									<div class="card-footer">
									{!! $biodata->keterangan !!}
									</div>
								</div>
							</div>
						@else
							<div class="col-lg-7 col-md-7">
								<div class="card card-warning">
									<div class="card-header">
										<h3 class="card-title">Biodata</h3>
										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-card-widget="collapse">
												<i class="fa fa-minus"></i>
											</button>
										</div>
									</div>
									<div class="card-body">
										<input type="hidden" class="form-control" id="id_masterno" value="{{$biodata->id}}">
										<div class="form-group">
											<label>Nama Lengkap (Tanpa Title)</label>
											<input type="text" class="form-control" id="id_nama" value="{{$biodata->nama}}">
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-5 col-lg-5">
													<label for="id_tmplhr">Tempat Lahir</label>
													<input type="text" class="form-control" id="id_tmplhr" placeholder="Tempat Lahir" value="{{$biodata->tmpt_lahir}}">
												</div>
												<div class="col-md-4 col-lg-4">
													<label for="id_tmplhr">Tgl.Lahir</label>
													<div class="input-group date" data-target-input="nearest">
														<input value="{{$biodata->tgl_lahir}}" type="text" class="form-control"id="id_tgllhr" name="id_tgllhr" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
														<div class="input-group-append">
															<div class="input-group-text"><i class="fa fa-calendar"></i></div>
														</div>
													</div>
												</div>
												<div class="col-md-3 col-lg-3">
													<label for="id_kelamin">Kelamin</label>
													<select id="id_kelamin" class="form-control">
													<option value=""></option>
														@php
															$lists   =   ['Laki-laki', 'Perempuan'];
															foreach($lists as $list) {
																if($list == $biodata->jenis_kelamin) {
																	echo "<option value='$list' selected>$list</option>";
																} else {
																	echo "<option value='$list'>$list</option>";
																}
															}
														@endphp
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">  
											<div class="row">
												<div class="col-md-6 col-lg-6">
													<label for="id_glrdepan">Gelar Depan</label>
													<input type="text" id="id_glrdepan" class="form-control" value="{{$biodata->depan}}">
												</div>
												<div class="col-md-6 col-lg-6">
													<label for="id_glrblakang">Gelar Belakang</label>
													<input type="text" id="id_glrblakang" class="form-control" value="{{$biodata->belakang}}">
												</div> 
											</div>
										</div>
										<div class="form-group">
											<label for="id_kepakaran">Kepakaran</label>
											<select id="id_kepakaran" class="form-control select2">
												<option value="">Pilih Salah Satu</option>
												@php
													$keys = array_keys($klasifkepakaran);
													for($i = 0; $i < count($klasifkepakaran); $i++) {
												@endphp
														<optgroup label="{{ $klasifikasikepakaran[$i] }}">
														@php
															foreach($klasifkepakaran[$keys[$i]] as $key => $value) {
														@endphp
															@if($biodata->kepakaran == $value['id'])
																<option value="{{ $value['id'] }}" selected>{{ $value['tulispak'] }}</option>
															@else
																<option value="{{ $value['id'] }}">{{ $value['tulispak'] }}</option>
															@endif
														@php
													}
														@endphp
														</optgroup>
												@php
												}
												@endphp
											</select>
										</div>
										<div class="form-group">
											<label for="id_bidangilmu3">Bidang Ilmu</label>
											<input type="text" class="form-control" id="id_bidangilmu3" value="{{$biodata->bidang_ilmu3}}">
											<p class="help-block">Boleh Menulis Lebih dari 1 Bidang Ilmu</p>
										</div>
										<div class="form-group">  
											<div class="row">
												<div class="col-md-6 col-lg-6">
													<label for="id_alamatmlg">Alamat di Malang</label>
													<input type="text" class="form-control" id="id_alamatmlg" value="{{$biodata->alamatmlg}}">
												</div>
												<div class="col-md-6 col-lg-6">
													<label for="id_alamatasal">Alamat di Asal (Sesuai KTP)</label>
													<input type="text" class="form-control" id="id_alamatasal" value="{{$biodata->alamat}}">
												</div> 
											</div>
										</div>
										<div class="form-group">  
											<div class="row">
												<div class="col-md-6 col-lg-6">
													<label for="id_kelurahan">Kelurahan/Desa (Sesuai KTP)</label>
													<input type="text" class="form-control" id="id_kelurahan" value="{{$biodata->kelurahan}}">
												</div>
												<div class="col-md-6 col-lg-6">
													<label for="id_kecamatan">Kecamatan (Sesuai KTP)</label>
													<input type="text" class="form-control" id="id_kecamatan" value="{{$biodata->kecamatan}}">
												</div>
											</div>
										</div>
										<div class="form-group">  
											<div class="row">
												<div class="col-md-6 col-lg-6">
													<label for="id_kota">Kota (Sesuai KTP)</label>
													<input type="text" class="form-control" id="id_kota" value="{{$biodata->kota}}">
												</div>
												<div class="col-md-6 col-lg-6">	
													<label for="id_propinsi">Propinsi (Sesuai KTP)</label>
													<input type="text" class="form-control" id="id_propinsi" value="{{$biodata->propinsi}}">
												</div>
											</div>
										</div>
										<div class="form-group">  
											<div class="row">
												<div class="col-md-6 col-lg-6">
													<label for="id_agama">Agama</label>
													<select id="id_agama" class="form-control">
														<option value=""></option>
														@php
															$lists   =   ['Islam', 'Kristen Protestan', 'Kristen Katholik', 'Hindu', 'Budha', 'Konghucu'];
															foreach($lists as $list) {
																if($list == $biodata->agama) {
																	echo "<option value='$list' selected>$list</option>";
																} else {
																	echo "<option value='$list'>$list</option>";
																}
															}
														@endphp
													</select>
												</div>
												<div class="col-md-6 col-lg-6">
													<label for="id_kawin">Status Kawin</label>
													<select id="id_kawin" class="form-control">
														@php
															$lists   =   ['Belum Kawin', 'Kawin'];
															foreach($lists as $list) {
																if($list == $biodata->kawin) {
																	echo "<option value='$list' selected>$list</option>";
																} else {
																	echo "<option value='$list'>$list</option>";
																}
															}
														@endphp
													</select>
												</div> 
											</div>
										</div>
										<div class="form-group">  
											<div class="row">
												<div class="col-md-4 col-lg-4">
													<label for="id_ktp">No.KTP</label>
													<input type="text" id="id_ktp" class="form-control" value="{{$biodata->nik}}">
													<input type="hidden" id="id_telpon" class="form-control" value="{{$biodata->no_telp}}">
												</div>
												<div class="col-md-4 col-lg-4">
													<label for="id_hape">No.HP</label>
													<input type="text" id="id_hape" class="form-control" value="{{$biodata->no_hp}}">
												</div> 
												<div class="col-md-4 col-lg-4">
													<label for="id_emaillain">Email</label>
													<input type="text" id="id_emaillain" class="form-control" value="{{$biodata->email}}">
												</div> 
											</div>
										</div>
										<div class="form-group">  
											<div class="row">
												<div class="col-md-6 col-lg-6">
													<label for="id_npwp">NPWP</label>
													<input type="text" class="form-control" id="id_npwp" value="{{$biodata->npwp}}">
												</div>
												<div class="col-md-6 col-lg-6">
													<label for="id_bpjs">BPJS Kesehatan</label>
													<input type="text" class="form-control" id="id_bpjs" value="{{$biodata->bpjs}}">
												</div> 
											</div>
										</div>
										<div class="form-group">  
											<div class="row">
												<div class="col-md-6 col-lg-6">
													<label for="id_tinggibdn">Tinggi Badan (Cm)</label>
													<input type="text" class="form-control" id="id_tinggibdn" value="{{$biodata->tinggibdn}}">
												</div>
												<div class="col-md-6 col-lg-6">
													<label for="id_beratbdn">Berat Badan (Kg)</label>
													<input type="text" class="form-control" id="id_beratbdn" value="{{$biodata->beratbdn}}">
												</div> 
											</div>
										</div>
										<div class="form-group">  
											<div class="row">
												<div class="col-md-6 col-lg-6">
													<label for="id_rambut">Bentuk Rambut</label>
													<input type="text" class="form-control" id="id_rambut" value="{{$biodata->bentukrambut}}">
												</div>
												<div class="col-md-6 col-lg-6">
													<label for="id_muka">Bentuk Muka</label>
													<input type="text" class="form-control" id="id_muka" value="{{$biodata->bentukmuka}}">
												</div> 
											</div>
										</div>
										<div class="form-group">  
											<div class="row">
												<div class="col-md-4 col-lg-4">
													<label for="id_warnakulit">Warna Kulit</label>
													<input type="text" class="form-control" id="id_warnakulit" value="{{$biodata->warnakulit}}">
												</div>
												<div class="col-md-4 col-lg-4">
													<label for="id_cirikusus">Ciri Khusus</label>
													<input type="text" class="form-control" id="id_cirikusus" value="{{$biodata->cirikusus}}">
												</div>
												<div class="col-md-4 col-lg-4">
													<label for="id_cacattubuh">Cacat Tubuh</label>
													<input type="text" class="form-control" id="id_cacattubuh" value="{{$biodata->cacattubuh}}">
												</div> 
											</div>
										</div>
										<div class="form-group">  
											<label for="id_hobi">Kegemaran / Hobi</label>
											<input type="text" class="form-control" id="id_hobi" value="{{$biodata->hobi}}">
										</div>
										
									</div>
									<div class="card-footer">
										<button type="button" class="btn btn-success" id="updatebiodata">Update</button>
									</div>
								</div>
							</div><!-- /kiri -->
							<div class="col-md-5 col-lg-5">
								<div class="card card-danger">
									<div class="card-header">
										<h3 class="card-title">Foto Terbaru</h3>
										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-card-widget="collapse">
												<i class="fa fa-minus"></i>
											</button>
										</div>
									</div>
									<div class="card-body">
										<div class="form-group">
											<img src="{!!$foto!!}" alt="image" width="100%" id="preview">
											<input type="file" id="id_fotoprofile" style="display: none;"/>
											<button type="button" class="btn btn-danger btn-block" id="btnuploadfoto">&nbsp;&nbsp;Upload Pas Foto&nbsp;&nbsp;</button></p>
										</div>
									</div>
								</div>
								<div class="card card-info">
									<div class="card-header">
										<h3 class="card-title">Tandatangan</h3>
										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-card-widget="collapse">
												<i class="fa fa-minus"></i>
											</button>
										</div>
									</div>
									<div class="card-body">
										<div class="form-group">
											<img src="{!!$tandatangan!!}" alt="image" width="100%" id="previewttd">
											<input type="file" id="id_tandatangan" style="display: none;"/>
											<button type="button" class="btn btn-info btn-block" id="btnuploadtandatangan">&nbsp;&nbsp;Upload Tandatangan&nbsp;&nbsp;</button></p>
										</div>
									</div>
								</div>
							</div><!-- /kanan -->
						@endif
                    </div><!-- /batas halaman muka -->
                    <div id="halamanmutasi">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Riwayat Status / Mutasi Pegawai</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <label>NIP/NIK/NIPK</label>
                                            <input type="text" class="form-control" value="{{$biodata->nip_baru}}" disabled="disable">
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" value="{{$biodata->nama_lengkap}}" disabled="disable">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <label>Homebase</label>
                                        <input type="text" class="form-control" value="{{$tlsprodi}}" disabled="disable">
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <label>Jenis Kerja</label>
                                        <input type="text" class="form-control" value="{{$tlsjabatan}}" disabled="disable">
                                    </div>
                                    </div>
                                </div>
                                <button class="btn btn-xs bg-maroon" id="btnnewmutasi">Tambah Data Baru</button>
                                <button class="btn btn-xs bg-purple" id="btnexportmutasi">Export Tabel di Bawah</button>
                                <div id="gridmutasi"></div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /batas halaman mutasi -->
                    <div id="halamanidentitas">
                        <div class="card card-primary card-outline" >
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{!!$foto!!}" alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">Riwayat Tes Kesehatan</h3>
                                <p class="text-muted text-center">{!! $biodata->nama_lengkap !!}</p>
                            </div>
                            <div class="card-body" id="divupdatependidikan">
                                <button class="btn bg-maroon" id="btnnewidentitas"> <i class="fa fa-plus"></i> Tambah Data Baru</button>
                                <button class="btn bg-purple" id="btnexportidentitas"><i class="fa fa-file-excel-o"></i> Export Tabel di Bawah</button>
                            </div>
							<div class="card-body" id="modaladddataidentitas">
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 col-lg-6">
											<label>Nama</label>
											<input type="text" class="form-control" disabled="disable" value="{{$biodata->nama_lengkap}}">
										</div>		
										<div class="col-md-6 col-lg-6">
											<label>NIK</label>
											<input type="text" class="form-control" disabled="disable" value="{{$biodata->ktp}}">
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 col-lg-6">
											<label>Jenis Identitas</label>
											<select id="identitas_jenis" size="1" class="form-control">
												<option value="">Pilih Salah Satu</option>
												<option value="Mepthapetamine">Mepthapetamine</option>
												<option value="HbsAg Kualitatif">HbsAg Kualitatif</option>
												<option value="HIV-Aids">HIV-Aids</option>
												<option value="Thorax">Thorax</option>
												<option value="Tes Buta Warna dan Pemeriksaan Fisik">Tes Buta Warna dan Pemeriksaan Fisik</option>
											</select>
										</div>
										<div class="col-md-6 col-lg-6">
											<label>Berlaku Hingga</label>
											<input type="text" class="form-control" id="identitas_aktif">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Keterangan Singkat Hasil Pemeriksaan</label>
									<input type="text" class="form-control" id="identitas_nomer">
								</div>
								<div class="form-group">
									<label>Link Berkas</label>
									<input type="text" class="form-control" id="identitas_url">
									<p class="text-muted">Upload Berkas Bapak/Ibu Ke Google Drive Kemudian Share Link Berkas Tersebut menjadi Link Public, kemudian masukkan link tersebut ke input diatas.</p>
								</div>
								<div class="form-group">
									<input type="hidden" class="form-control" id="identitas_idne">
									<button type="button" class="btn btn-danger pull-left" id="btnkembalidrtambahidentitas">Cancel</button>
									<button type="button" class="btn btn-success pull-right" id="btnsimpandataidentitas">Simpan</button>
								</div>
							</div>
							<div class="card-footer" id="divupdateidentitas">
                                <div id="grididentitas"></div>
                            </div>
                        </div>
                    </div><!-- /batas halaman Identitas -->
                    <div id="halamanpendidikan">
                        <div class="card card-primary card-outline" >
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{!!$foto!!}" alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">Riwayat Pendidikan</h3>
                                <p class="text-muted text-center">{!! $biodata->nama_lengkap !!}</p>
                            </div>
                            <div class="card-body" id="divupdatependidikan">
                                <button class="btn bg-maroon" id="btnnewpendidikan"> <i class="fa fa-plus"></i> Tambah Data Baru</button>
                                <button class="btn bg-purple" id="btnexportpendidikan"><i class="fa fa-file-excel-o"></i> Export Tabel di Bawah</button>
                            </div>
							<div class="card-body" id="divtambahpendidikan">
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 col-lg-6">
											<label>Nama</label>
											<input type="text" class="form-control" disabled="disable" value="{{$biodata->nama_lengkap}}">
										</div>		
										<div class="col-md-6 col-lg-6">
											<label>NIK</label>
											<input type="text" class="form-control" disabled="disable" value="{{$biodata->ktp}}">
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 col-lg-6">
											<label>Jenjang</label>
											<select id="pendidikan_jenjang" size="1" class="form-control select2">
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
												<option value="Spesialis">Spesialis 1</option>
												<option value="Subspesialis">Spesialis 2</option>
												<option value="S2">Magister / S2</option>
												<option value="S3">Doktor / S3</option>						
											</select>
										</div>		
										<div class="col-md-6 col-lg-6">
											<label>Perguruan Tinggi/Sekolah</label>
											<input type="text" class="form-control" id="pendidikan_sekolah">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Negara</label>
									<select class="form-control select2" name="pendidikan_negara" id="pendidikan_negara">
										<option value="Indonesia" selected> Indonesia </option>
										<option value="United States"> United States </option>
										<option value="Afghanistan"> Afghanistan </option>
										<option value="Albania"> Albania </option>
										<option value="Algeria"> Algeria </option>
										<option value="American Samoa"> American Samoa </option>
										<option value="Andorra"> Andorra </option>
										<option value="Angola"> Angola </option>
										<option value="Anguilla"> Anguilla </option>
										<option value="Antigua and Barbuda"> Antigua and Barbuda </option>
										<option value="Argentina"> Argentina </option>
										<option value="Armenia"> Armenia </option>
										<option value="Aruba"> Aruba </option>
										<option value="Australia"> Australia </option>
										<option value="Austria"> Austria </option>
										<option value="Azerbaijan"> Azerbaijan </option>
										<option value="The Bahamas"> The Bahamas </option>
										<option value="Bahrain"> Bahrain </option>
										<option value="Bangladesh"> Bangladesh </option>
										<option value="Barbados"> Barbados </option>
										<option value="Belarus"> Belarus </option>
										<option value="Belgium"> Belgium </option>
										<option value="Belize"> Belize </option>
										<option value="Benin"> Benin </option>
										<option value="Bermuda"> Bermuda </option>
										<option value="Bhutan"> Bhutan </option>
										<option value="Bolivia"> Bolivia </option>
										<option value="Bosnia and Herzegovina"> Bosnia and Herzegovina </option>
										<option value="Botswana"> Botswana </option>
										<option value="Brazil"> Brazil </option>
										<option value="Brunei"> Brunei </option>
										<option value="Bulgaria"> Bulgaria </option>
										<option value="Burkina Faso"> Burkina Faso </option>
										<option value="Burundi"> Burundi </option>
										<option value="Cambodia"> Cambodia </option>
										<option value="Cameroon"> Cameroon </option>
										<option value="Canada"> Canada </option>
										<option value="Cape Verde"> Cape Verde </option>
										<option value="Cayman Islands"> Cayman Islands </option>
										<option value="Central African Republic"> Central African Republic </option>
										<option value="Chad"> Chad </option>
										<option value="Chile"> Chile </option>
										<option value="China"> China </option>
										<option value="Christmas Island"> Christmas Island </option>
										<option value="Cocos (Keeling) Islands"> Cocos (Keeling) Islands </option>
										<option value="Colombia"> Colombia </option>
										<option value="Comoros"> Comoros </option>
										<option value="Congo"> Congo </option>
										<option value="Cook Islands"> Cook Islands </option>
										<option value="Costa Rica"> Costa Rica </option>
										<option value="Cote d&#x27;Ivoire"> Cote d&#x27;Ivoire </option>
										<option value="Croatia"> Croatia </option>
										<option value="Cuba"> Cuba </option>
										<option value="Curacao"> Curacao </option>
										<option value="Cyprus"> Cyprus </option>
										<option value="Czech Republic"> Czech Republic </option>
										<option value="Democratic Republic of the Congo"> Democratic Republic of the Congo </option>
										<option value="Denmark"> Denmark </option>
										<option value="Djibouti"> Djibouti </option>
										<option value="Dominica"> Dominica </option>
										<option value="Dominican Republic"> Dominican Republic </option>
										<option value="Ecuador"> Ecuador </option>
										<option value="Egypt"> Egypt </option>
										<option value="El Salvador"> El Salvador </option>
										<option value="Equatorial Guinea"> Equatorial Guinea </option>
										<option value="Eritrea"> Eritrea </option>
										<option value="Estonia"> Estonia </option>
										<option value="Ethiopia"> Ethiopia </option>
										<option value="Falkland Islands"> Falkland Islands </option>
										<option value="Faroe Islands"> Faroe Islands </option>
										<option value="Fiji"> Fiji </option>
										<option value="Finland"> Finland </option>
										<option value="France"> France </option>
										<option value="French Polynesia"> French Polynesia </option>
										<option value="Gabon"> Gabon </option>
										<option value="The Gambia"> The Gambia </option>
										<option value="Georgia"> Georgia </option>
										<option value="Germany"> Germany </option>
										<option value="Ghana"> Ghana </option>
										<option value="Gibraltar"> Gibraltar </option>
										<option value="Greece"> Greece </option>
										<option value="Greenland"> Greenland </option>
										<option value="Grenada"> Grenada </option>
										<option value="Guadeloupe"> Guadeloupe </option>
										<option value="Guam"> Guam </option>
										<option value="Guatemala"> Guatemala </option>
										<option value="Guernsey"> Guernsey </option>
										<option value="Guinea"> Guinea </option>
										<option value="Guinea-Bissau"> Guinea-Bissau </option>
										<option value="Guyana"> Guyana </option>
										<option value="Haiti"> Haiti </option>
										<option value="Honduras"> Honduras </option>
										<option value="Hong Kong"> Hong Kong </option>
										<option value="Hungary"> Hungary </option>
										<option value="Iceland"> Iceland </option>
										<option value="India"> India </option>
										<option value="Iran"> Iran </option>
										<option value="Iraq"> Iraq </option>
										<option value="Ireland"> Ireland </option>
										<option value="Israel"> Israel </option>
										<option value="Italy"> Italy </option>
										<option value="Jamaica"> Jamaica </option>
										<option value="Japan"> Japan </option>
										<option value="Jersey"> Jersey </option>
										<option value="Jordan"> Jordan </option>
										<option value="Kazakhstan"> Kazakhstan </option>
										<option value="Kenya"> Kenya </option>
										<option value="Kiribati"> Kiribati </option>
										<option value="North Korea"> North Korea </option>
										<option value="South Korea"> South Korea </option>
										<option value="Kosovo"> Kosovo </option>
										<option value="Kuwait"> Kuwait </option>
										<option value="Kyrgyzstan"> Kyrgyzstan </option>
										<option value="Laos"> Laos </option>
										<option value="Latvia"> Latvia </option>
										<option value="Lebanon"> Lebanon </option>
										<option value="Lesotho"> Lesotho </option>
										<option value="Liberia"> Liberia </option>
										<option value="Libya"> Libya </option>
										<option value="Liechtenstein"> Liechtenstein </option>
										<option value="Lithuania"> Lithuania </option>
										<option value="Luxembourg"> Luxembourg </option>
										<option value="Macau"> Macau </option>
										<option value="Macedonia"> Macedonia </option>
										<option value="Madagascar"> Madagascar </option>
										<option value="Malawi"> Malawi </option>
										<option value="Malaysia"> Malaysia </option>
										<option value="Maldives"> Maldives </option>
										<option value="Mali"> Mali </option>
										<option value="Malta"> Malta </option>
										<option value="Marshall Islands"> Marshall Islands </option>
										<option value="Martinique"> Martinique </option>
										<option value="Mauritania"> Mauritania </option>
										<option value="Mauritius"> Mauritius </option>
										<option value="Mayotte"> Mayotte </option>
										<option value="Mexico"> Mexico </option>
										<option value="Micronesia"> Micronesia </option>
										<option value="Moldova"> Moldova </option>
										<option value="Monaco"> Monaco </option>
										<option value="Mongolia"> Mongolia </option>
										<option value="Montenegro"> Montenegro </option>
										<option value="Montserrat"> Montserrat </option>
										<option value="Morocco"> Morocco </option>
										<option value="Mozambique"> Mozambique </option>
										<option value="Myanmar"> Myanmar </option>
										<option value="Nagorno-Karabakh"> Nagorno-Karabakh </option>
										<option value="Namibia"> Namibia </option>
										<option value="Nauru"> Nauru </option>
										<option value="Nepal"> Nepal </option>
										<option value="Netherlands"> Netherlands </option>
										<option value="Netherlands Antilles"> Netherlands Antilles </option>
										<option value="New Caledonia"> New Caledonia </option>
										<option value="New Zealand"> New Zealand </option>
										<option value="Nicaragua"> Nicaragua </option>
										<option value="Niger"> Niger </option>
										<option value="Nigeria"> Nigeria </option>
										<option value="Niue"> Niue </option>
										<option value="Norfolk Island"> Norfolk Island </option>
										<option value="Turkish Republic of Northern Cyprus"> Turkish Republic of Northern Cyprus </option>
										<option value="Northern Mariana"> Northern Mariana </option>
										<option value="Norway"> Norway </option>
										<option value="Oman"> Oman </option>
										<option value="Pakistan"> Pakistan </option>
										<option value="Palau"> Palau </option>
										<option value="Palestine"> Palestine </option>
										<option value="Panama"> Panama </option>
										<option value="Papua New Guinea"> Papua New Guinea </option>
										<option value="Paraguay"> Paraguay </option>
										<option value="Peru"> Peru </option>
										<option value="Philippines"> Philippines </option>
										<option value="Pitcairn Islands"> Pitcairn Islands </option>
										<option value="Poland"> Poland </option>
										<option value="Portugal"> Portugal </option>
										<option value="Puerto Rico"> Puerto Rico </option>
										<option value="Qatar"> Qatar </option>
										<option value="Republic of the Congo"> Republic of the Congo </option>
										<option value="Romania"> Romania </option>
										<option value="Russia"> Russia </option>
										<option value="Rwanda"> Rwanda </option>
										<option value="Saint Barthelemy"> Saint Barthelemy </option>
										<option value="Saint Helena"> Saint Helena </option>
										<option value="Saint Kitts and Nevis"> Saint Kitts and Nevis </option>
										<option value="Saint Lucia"> Saint Lucia </option>
										<option value="Saint Martin"> Saint Martin </option>
										<option value="Saint Pierre and Miquelon"> Saint Pierre and Miquelon </option>
										<option value="Saint Vincent and the Grenadines"> Saint Vincent and the Grenadines </option>
										<option value="Samoa"> Samoa </option>
										<option value="San Marino"> San Marino </option>
										<option value="Sao Tome and Principe"> Sao Tome and Principe </option>
										<option value="Saudi Arabia"> Saudi Arabia </option>
										<option value="Senegal"> Senegal </option>
										<option value="Serbia"> Serbia </option>
										<option value="Seychelles"> Seychelles </option>
										<option value="Sierra Leone"> Sierra Leone </option>
										<option value="Singapore"> Singapore </option>
										<option value="Slovakia"> Slovakia </option>
										<option value="Slovenia"> Slovenia </option>
										<option value="Solomon Islands"> Solomon Islands </option>
										<option value="Somalia"> Somalia </option>
										<option value="Somaliland"> Somaliland </option>
										<option value="South Africa"> South Africa </option>
										<option value="South Ossetia"> South Ossetia </option>
										<option value="South Sudan"> South Sudan </option>
										<option value="Spain"> Spain </option>
										<option value="Sri Lanka"> Sri Lanka </option>
										<option value="Sudan"> Sudan </option>
										<option value="Suriname"> Suriname </option>
										<option value="Svalbard"> Svalbard </option>
										<option value="eSwatini"> eSwatini </option>
										<option value="Sweden"> Sweden </option>
										<option value="Switzerland"> Switzerland </option>
										<option value="Syria"> Syria </option>
										<option value="Taiwan"> Taiwan </option>
										<option value="Tajikistan"> Tajikistan </option>
										<option value="Tanzania"> Tanzania </option>
										<option value="Thailand"> Thailand </option>
										<option value="Timor-Leste"> Timor-Leste </option>
										<option value="Togo"> Togo </option>
										<option value="Tokelau"> Tokelau </option>
										<option value="Tonga"> Tonga </option>
										<option value="Transnistria Pridnestrovie"> Transnistria Pridnestrovie </option>
										<option value="Trinidad and Tobago"> Trinidad and Tobago </option>
										<option value="Tristan da Cunha"> Tristan da Cunha </option>
										<option value="Tunisia"> Tunisia </option>
										<option value="Turkey"> Turkey </option>
										<option value="Turkmenistan"> Turkmenistan </option>
										<option value="Turks and Caicos Islands"> Turks and Caicos Islands </option>
										<option value="Tuvalu"> Tuvalu </option>
										<option value="Uganda"> Uganda </option>
										<option value="Ukraine"> Ukraine </option>
										<option value="United Arab Emirates"> United Arab Emirates </option>
										<option value="United Kingdom"> United Kingdom </option>
										<option value="Uruguay"> Uruguay </option>
										<option value="Uzbekistan"> Uzbekistan </option>
										<option value="Vanuatu"> Vanuatu </option>
										<option value="Vatican City"> Vatican City </option>
										<option value="Venezuela"> Venezuela </option>
										<option value="Vietnam"> Vietnam </option>
										<option value="British Virgin Islands"> British Virgin Islands </option>
										<option value="Isle of Man"> Isle of Man </option>
										<option value="US Virgin Islands"> US Virgin Islands </option>
										<option value="Wallis and Futuna"> Wallis and Futuna </option>
										<option value="Western Sahara"> Western Sahara </option>
										<option value="Yemen"> Yemen </option>
										<option value="Zambia"> Zambia </option>
										<option value="Zimbabwe"> Zimbabwe </option>
										<option value="other"> Other </option>
									</select>
								</div>
								<div class="form-group">
									<label>Bidang Ilmu / Peminatan</label>
									<input type="text" class="form-control" id="pendidikan_minat">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 col-lg-6">
											<label>Tahun Masuk</label>
											<input type="text" class="form-control" id="pendidikan_tahun">
										</div>		
										<div class="col-md-6 col-lg-6">
											<label>Status Kuliah / Kelulusan</label>
											<input type="text" class="form-control" id="pendidikan_status">
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-3">
											<label>TMT Lulus</label>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fa fa-calendar"></i></span>
												</div>
												<input type="text" id="pendidikan_lulus" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask />
											</div>
										</div>
										<div class="col-md-6 col-lg-6">
											<label>No.Ijasah</label>
											<input type="text" class="form-control" id="pendidikan_noijasah">
										</div>
										<div class="col-md-3">				  
											<label>Tgl Ijazah</label>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fa fa-calendar"></i></span>
												</div>
												<input type="text" id="pendidikan_tglijasah" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask />
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Nama Penandatangan Ijasah</label>
									<input type="text" class="form-control" id="pendidikan_keterangan">
								</div>
								<div class="form-group">
									<label>Link Berkas</label>
									<input type="text" class="form-control" id="pendidikan_url">
									<p class="text-muted">Upload Berkas Bapak/Ibu Ke Google Drive Kemudian Share Link Berkas Tersebut menjadi Link Public, kemudian masukkan link tersebut ke input diatas.</p>
								</div>
								<div class="form-group">
									<input type="hidden" class="form-control" id="pendidikan_idne">
									<button type="button" class="btn btn-danger pull-left" id="btnkembalidrtambahpendidikan">Cancel</button>
									<button type="button" class="btn btn-success pull-right" id="btnsimpandatapendidikan">Simpan</button>
								</div>
							</div>
							<div class="card-footer">
                                <div id="gridpendidikan"></div>
                            </div>
                        </div>
                    </div><!-- /batas halaman Pendidikan -->
                    <div id="halamanpangkat">
                        <div class="box box-success">
                            <div class="box-header with-border">
                            <h3 class="box-title">Riwayat Kepangkatan Pegawai</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <label>NIP/NIK/NIPK</label>
                                            <input type="text" class="form-control" value="{{$biodata->nip_baru}}" disabled="disable">
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" value="{{$biodata->nama_lengkap}}" disabled="disable">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <label>Homebase</label>
                                        <input type="text" class="form-control" value="{{$tlsprodi}}" disabled="disable">
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <label>Jenis Kerja</label>
                                        <input type="text" class="form-control" value="{{$tlsjabatan}}" disabled="disable">
                                    </div>
                                    </div>
                                </div>
                                <button class="btn btn-xs bg-maroon" id="btnnewpangkat">Tambah Data Baru</button>
                                <button class="btn btn-xs bg-purple" id="btnexportpangkat">Export Tabel di Bawah</button>
                                <div id="gridpangkat"></div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /batas halaman Kepangkatan -->
                    <div id="halamanfungsional">
                        <div class="box box-success">
                            <div class="box-header with-border">
                            <h3 class="box-title">Riwayat Fungsional Pegawai</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <label>NIP/NIK/NIPK</label>
                                            <input type="text" class="form-control" value="{{$biodata->nip_baru}}" disabled="disable">
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" value="{{$biodata->nama_lengkap}}" disabled="disable">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <label>Homebase</label>
                                        <input type="text" class="form-control" value="{{$tlsprodi}}" disabled="disable">
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <label>Jenis Kerja</label>
                                        <input type="text" class="form-control" value="{{$tlsjabatan}}" disabled="disable">
                                    </div>
                                    </div>
                                </div>
                                <button class="btn btn-xs bg-maroon" id="btnnewfungsional">Tambah Data Baru</button>
                                <button class="btn btn-xs bg-purple" id="btnexportfungsional">Export Tabel di Bawah</button>
                                <div id="gridfungsional"></div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /batas halaman Fungsional -->
                    <div id="halamansertifikasi">
                        <div class="box box-success">
                            <div class="box-header with-border">
                            <h3 class="box-title">Riwayat Sertifikasi Pegawai</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <label>NIP/NIK/NIPK</label>
                                            <input type="text" class="form-control" value="{{$biodata->nip_baru}}" disabled="disable">
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" value="{{$biodata->nama_lengkap}}" disabled="disable">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <label>Homebase</label>
                                        <input type="text" class="form-control" value="{{$tlsprodi}}" disabled="disable">
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <label>Jenis Kerja</label>
                                        <input type="text" class="form-control" value="{{$tlsjabatan}}" disabled="disable">
                                    </div>
                                    </div>
                                </div>
                                <button class="btn btn-xs bg-maroon" id="btnnewsertifikasi">Tambah Data Baru</button>
                                <button class="btn btn-xs bg-purple" id="btnexportsertifikasi">Export Tabel di Bawah</button>
                                <div id="gridsertifikasi"></div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /batas halaman Sertifikasi -->
                    <div id="halamangaji">
                        <div class="box box-success">
                            <div class="box-header with-border">
                            <h3 class="box-title">Riwayat Kenaikan Gaji Pegawai</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <label>NIP/NIK/NIPK</label>
                                            <input type="text" class="form-control" value="{{$biodata->nip_baru}}" disabled="disable">
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" value="{{$biodata->nama_lengkap}}" disabled="disable">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <label>Homebase</label>
                                        <input type="text" class="form-control" value="{{$tlsprodi}}" disabled="disable">
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <label>Jenis Kerja</label>
                                        <input type="text" class="form-control" value="{{$tlsjabatan}}" disabled="disable">
                                    </div>
                                    </div>
                                </div>
                                <button class="btn btn-xs bg-maroon" id="btnnewgaji">Tambah Data Baru</button>
                                <button class="btn btn-xs bg-purple" id="btnexportgaji">Export Tabel di Bawah</button>
                                <div id="gridgaji"></div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                        <div class="box box-success">
                            <div class="box-header with-border">
                            <h3 class="box-title">Riwayat KGB Online</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div id="gridriwayatgaji"></div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /batas halaman Kenaikan Gaji -->
                    <div id="halamandiklat">
                        <div class="card card-primary card-outline" >
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{!!$foto!!}" alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">Riwayat Diklat</h3>
                                <p class="text-muted text-center">{!! $biodata->nama_lengkap !!}</p>
                            </div>
                            <div class="card-body" id="divupdatediklat">
                                <button class="btn bg-maroon" id="btnnewdiklat">Tambah Data Baru</button>
                                <button class="btn bg-purple" id="btnexportdiklat">Export Tabel di Bawah</button>
                            </div>
							<div class="card-body" id="divtambahdiklat">
								<div class="form-group">
									<div class="row">
										<div class="col-md-8 col-lg-8">
											<label>No. Sertifikat Diklat / Kursus / Pelatihan</label>
											<input type="text" class="form-control" id="diklat_nodoc">					
										</div>		
										<div class="col-md-4">
											<label>Tgl. Dokumen</label>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fa fa-calendar"></i></span>
												</div>
												<input type="text" id="diklat_tgldok" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask />
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-5 col-lg-5">
											<label>Diklat</label>
											<select id="diklat_diklat" size="1" class="form-control">
												<option value="UMUM">UMUM</option>
												<option value="SPAMEN">SPAMEN</option>
											</select>				
										</div>		
										<div class="col-md-7 col-lg-7">
											<label>Penyelenggara</label>
											<input type="text" class="form-control" id="diklat_penyelenggara">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Nama Diklat</label>
									<input type="text" class="form-control" id="diklat_nama">
								</div>
								<div class="form-group">
									<label>Tempat Diklat</label>
									<input type="text" class="form-control" id="diklat_tempat">
								</div>
								<div class="form-group">
									<label>Angkatan</label>
									<input type="text" class="form-control" id="diklat_angkatan">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6">
											<label>Tgl. Mulai</label>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fa fa-calendar"></i></span>
												</div>
												<input type="text" id="diklat_mulai" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask />
											</div>
										</div>
										<div class="col-md-6">
											<label>Tgl. Lulus</label>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fa fa-calendar"></i></span>
												</div>
												<input type="text" id="diklat_lulus" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask />
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 col-lg-6">
											<label>Jumlah Jam</label>
											<input type="text" class="form-control" id="diklat_jam">					
										</div>		
										<div class="col-md-6 col-lg-6">
											<label>Predikat</label>
											<input type="text" id="diklat_predikat" class="form-control">
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-5 col-lg-5">
											<label>Domain</label>
											<select id="diklat_negeri" size="1" class="form-control">
												<option value="Dalam Negeri">Dalam Negeri</option>
												<option value="Luar Negeri">Luar Negeri</option>
											</select>				
										</div>		
										<div class="col-md-7 col-lg-7">
											<label>Keterangan</label>					
											<input type="text" class="form-control" id="diklat_keterangan">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Link Berkas</label>
									<input type="text" class="form-control" id="diklat_url">
									<p class="text-muted">Upload Berkas Bapak/Ibu Ke Google Drive Kemudian Share Link Berkas Tersebut menjadi Link Public, kemudian masukkan link tersebut ke input diatas.</p>
								</div>
								<div class="form-group">
									<input type="hidden" class="form-control" id="diklat_idne">
                                	<button type="button" class="btn btn-danger pull-left" id="btnkembalidrtambahdiklat">Cancel</button>
									<button type="button" class="btn btn-success pull-right" id="btnsimpandatadiklat">Simpan</button>
								</div>
							</div>
							<div class="card-footer">
                                <div id="griddiklat"></div>
                            </div>
                        </div>
                    </div><!-- /batas halaman Diklat -->
                    <div id="halamanpenghargaan">
                        <div class="card card-primary card-outline" >
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{!!$foto!!}" alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">Riwayat Penghargaan</h3>
                                <p class="text-muted text-center">{!! $biodata->nama_lengkap !!}</p>
                            </div>
							<div class="card-body" id="divupdatepenghargaan">
                                <button class="btn bg-maroon" id="btnnewpenghargaan">Tambah Data Baru</button>
                                <button class="btn bg-purple" id="btnexportpenghargaan">Export Tabel di Bawah</button>
                            </div>
                            <div class="card-body" id="divtambahpenghargaan">
								<div class="form-group">
									<div class="row">
										<div class="col-md-8 col-lg-8">
											<label>No.Dokumen Penghargaan</label>
											<input type="text" class="form-control" id="penghargaan_nodoc">					
										</div>		
										<div class="col-md-4">
											<label>Tgl. Dokumen</label>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fa fa-calendar"></i></span>
												</div>
												<input type="text" id="penghargaan_tgl" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask />
											</div>
										</div>
									</div>
								</div>			
								<div class="form-group">
									<label>Nama Penghargaan</label>
									<input type="text" class="form-control" id="penghargaan_nama">
								</div>
								<div class="form-group">
									<label>Instansi Pemberi Penghargaan</label>
									<input type="text" class="form-control" id="penghargaan_pemberi">
								</div>
								<div class="form-group">
									<label>Pejabat Pemberi</label>
									<input type="text" class="form-control" id="penghargaan_pejabat">
								</div>
								<div class="form-group">
									<label>Keterangan</label>
									<input type="text" class="form-control" id="penghargaan_keterangan">
								</div>
								<div class="form-group">
									<label>Link Berkas</label>
									<input type="text" class="form-control" id="penghargaan_url">
									<p class="text-muted">Upload Berkas Bapak/Ibu Ke Google Drive Kemudian Share Link Berkas Tersebut menjadi Link Public, kemudian masukkan link tersebut ke input diatas.</p>
								</div>
								<div class="form-group">
									<input type="hidden" class="form-control" id="penghargaan_idne">
                                	<button type="button" class="btn btn-danger pull-left" id="btnkembalidrtambahpenghargaan">Cancel</button>
									<button type="button" class="btn btn-success pull-right" id="btnsimpandatapenghargaan">Simpan</button>
								</div>
							
							</div>
							<div class="card-body">
                                <div id="gridpenghargaan"></div>
                            </div>
                        </div>
                    </div><!-- /batas halaman Penghargaan -->
                    <div id="halamankeluarga">
                        <div class="card card-primary card-outline" >
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{!!$foto!!}" alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">Riwayat Keluarga</h3>
                                <p class="text-muted text-center">{!! $biodata->nama_lengkap !!}</p>
                            </div>
                            <div class="card-body" id="divupdatekeluarga">
                                <button class="btn bg-maroon" id="btnnewkeluarga">Tambah Data Baru</button>
                                <button class="btn bg-purple" id="btnexportkeluarga">Export Tabel di Bawah</button>
                            </div>
							<div class="card-body" id="divtambahkeluarga">
								<div class="form-group">
									<label>Nama Anggota Keluarga</label>
									<input type="text" class="form-control" id="keluarga_nama">
								</div>
								<div class="form-group">
									<div class="row">				 	
										<div class="col-md-6">
											<label>Hubungan Dalam Keluarga</label>
											<select id="keluarga_hubklg" class="form-control">
												<option value="Suami">Suami</option>
												<option value="Isteri">Isteri</option>
												<option value="Anak">Anak</option>
												<option value="Ayah">Ayah</option>
												<option value="Ibu">Ibu</option>
												<option value="Ayah">Ayah</option>
												<option value="Cucu">Cucu</option>
												<option value="Saudara">Saudara</option>
												<option value="Menantu">Menantu</option>
												<option value="Mertua">Mertua</option>
												<option value="Famili">Famili</option>
												<option value="Orang Tua">Orang Tua</option>
											</select>
										</div>
										<div class="col-md-6">
											<label>TGL Pernikahan (Khusus Suami / Istri)</label>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fa fa-calendar"></i></span>
												</div>
												<input type="text" id="keluarga_tglmenikah" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask />
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">				 	
										<div class="col-md-3">
											<label>Kelamin</label>
											<select id="keluarga_kelamin" class="form-control">
												<option value="Laki-Laki">Laki-Laki</option>
												<option value="Perempuan">Perempuan</option>
											</select>
										</div>
										<div class="col-md-5">
											<label>Tempat Lahir</label>
											<input type="text" class="form-control" id="keluarga_tempatlahir">
										</div>
										<div class="col-md-4">
											<label>TGL Lahir</label>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fa fa-calendar"></i></span>
												</div>
												<input type="text" id="keluarga_tgllahir" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask />
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-3">
											<label>Pendidikan</label>
											<select id="keluarga_jenjang" size="1" class="form-control">
												<option value="Belum Bersekolah">Belum Bersekolah</option>
												<option value="SD">SD/Sederajat</option>
												<option value="SMP">SMP/Sederajat</option>
												<option value="SMA">SMA/Sederajat</option>
												<option value="D1">D1</option>
												<option value="D2">D2</option>
												<option value="D3">D3</option>
												<option value="S1">D4/S1</option>
												<option value="S2">S2</option>
												<option value="S3">S3</option>
												<option value="Spesialis 1">Spesialis 1</option>
												<option value="Spesialis 2">Spesialis 2</option>
											</select>
										</div>
										<div class="col-md-3">
											<label>Status</label>
											<select id="keluarga_status" size="1" class="form-control">
												<option value="">Pilih Salah Satu</option>
												<option value="Cerai">Cerai</option>
												<option value="Almarhum">Almarhum</option>
											</select>
										</div>
										<div class="col-md-6 col-lg-6">
											<label>Pekerjaan</label>
											<input type="text" class="form-control" id="keluarga_pekerjaan">
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">				 	
										<div class="col-md-6">
											<label>Alamat</label>
											<input type="text" class="form-control" id="keluarga_alamat" value="{{$biodata->alamat}}">
										</div>
										<div class="col-md-6">
											<label>NIK</label>
											<input type="text" class="form-control" id="keluarga_nik">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Link Berkas</label>
									<input type="text" class="form-control" id="keluarga_url">
									<p class="text-muted">Upload Berkas Bapak/Ibu Ke Google Drive Kemudian Share Link Berkas Tersebut menjadi Link Public, kemudian masukkan link tersebut ke input diatas.</p>
								</div>
								<div class="form-group">
									<input type="hidden" class="form-control" id="keluarga_idne">
                                	<button type="button" class="btn btn-danger pull-left" id="btnkembalidrtambahkeluarga">Cancel</button>
									<button type="button" class="btn btn-success pull-right" id="btnsimpandatakeluarga">Simpan</button>
								</div>
							</div>
							<div class="card-footer">
								<div id="gridkeluarga"></div>
                            </div>
                        </div>
                    </div><!-- /batas halaman Keluarga -->
                    <div id="halamanseminar">
                        <div class="card card-primary card-outline" >
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{!!$foto!!}" alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">Riwayat Seminar</h3>
                                <p class="text-muted text-center">{!! $biodata->nama_lengkap !!}</p>
                            </div>
                            <div class="card-body">
                                <button class="btn btn-xs bg-maroon" id="btnnewseminar">Tambah Data Baru</button>
                                <button class="btn btn-xs bg-purple" id="btnexportseminar">Export Tabel di Bawah</button>
                                <div id="gridseminar"></div>
                            </div>
                        </div>
                    </div><!-- /batas halaman Seminar -->
                    <div id="halamanorganisasi">
                        <div class="card card-primary card-outline" >
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{!!$foto!!}" alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">Riwayat Pengalaman Kerja</h3>
                                <p class="text-muted text-center">{!! $biodata->nama_lengkap !!}</p>
                            </div>
                            <div class="card-body" id="divupdateorganisasi">
                                <button class="btn bg-maroon" id="btnneworganisasi">Tambah Data Baru</button>
                                <button class="btn bg-purple" id="btnexportorganisasi">Export Tabel di Bawah</button>
                            </div>
							<div class="card-body" id="divtambahorganisasi">
								<div class="form-group">
									<label>Nama Organisasi</label>
									<input type="text" class="form-control" id="organisasi_nama">
								</div>
								<div class="form-group">
									<label>Kedudukan</label>
									<input type="text" class="form-control" id="organisasi_kedudukan">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 col-lg-6">
											<label>Mulai</label>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fa fa-calendar"></i></span>
												</div>
												<input type="text" id="organisasi_mulai" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask />
											</div>
										</div>
										<div class="col-md-6 col-lg-6">
											<label>Sampai</label>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fa fa-calendar"></i></span>
												</div>
												<input type="text" id="organisasi_selesai" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask />
											</div>
										</div>		
									</div>
								</div>
								<div class="form-group">
									<label>No. SK Pengangkatan</label>
									<input type="text" class="form-control" id="organisasi_nosk">
								</div>
								<div class="form-group">
									<label>Nama Pejabat Pembuat SK</label>
									<input type="text" class="form-control" id="organisasi_namapejabat">
								</div>
								<div class="form-group">
									<label>NIP Pejabat Pembuat SK</label>
									<input type="text" class="form-control" id="organisasi_nippejabat">
								</div>
								<div class="form-group">
									<label>Jabatan Pejabat Pembuat SK</label>
									<input type="text" class="form-control" id="organisasi_jabpejabat">
								</div>
								<div class="form-group">
									<label>Link Berkas</label>
									<input type="text" class="form-control" id="organisasi_url">
									<p class="text-muted">Upload Berkas Bapak/Ibu Ke Google Drive Kemudian Share Link Berkas Tersebut menjadi Link Public, kemudian masukkan link tersebut ke input diatas.</p>
								</div>
                            	<div class="form-group">
									<input type="hidden" class="form-control" id="organisasi_id">
									<button type="button" class="btn btn-danger pull-left" id="btnkembalidrtambahorganisasi">Cancel</button>
									<button type="button" class="btn btn-success pull-right" id="btnsimpandataorganisasi">Simpan</button>
								</div>
                            </div>
							<div class="card-footer">
                                <div id="gridorganisasi"></div>
                            </div>
                        </div>
                    </div><!-- /batas halaman Organisasi -->
                    <div id="halamandataasesor">
                        <div class="box box-success">
                            <div class="box-header with-border">
                            <h3 class="box-title">Data Asesor</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <label>NIP/NIK/NIPK</label>
                                            <input type="text" class="form-control" value="{{$biodata->nip_baru}}" disabled="disable">
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" value="{{$biodata->nama_lengkap}}" disabled="disable">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <label>Homebase</label>
                                        <input type="text" class="form-control" value="{{$tlsprodi}}" disabled="disable">
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <label>Jenis Kerja</label>
                                        <input type="text" class="form-control" value="{{$tlsjabatan}}" disabled="disable">
                                    </div>
                                    </div>
                                </div>
                                <button class="btn btn-xs bg-maroon" id="btnnewasesor">Tambah Data Baru</button>
                                <button class="btn btn-xs bg-purple" id="btnexportasesor">Export Tabel di Bawah</button>
                                <div id="gridasesor"></div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /batas halaman Data Asesor -->
                    <div id="halamandataajar">
                        <div class="box box-success">
                            <div class="box-header with-border">
                            <h3 class="box-title">Data Ajar Dosen</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <label>NIP/NIK/NIPK</label>
                                            <input type="text" class="form-control" value="{{$biodata->nip_baru}}" disabled="disable">
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" value="{{$biodata->nama_lengkap}}" disabled="disable">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <label>Homebase</label>
                                        <input type="text" class="form-control" value="{{$tlsprodi}}" disabled="disable">
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <label>Jenis Kerja</label>
                                        <input type="text" class="form-control" value="{{$tlsjabatan}}" disabled="disable">
                                    </div>
                                    </div>
                                </div>
                                <button class="btn btn-xs bg-maroon" id="btnnewdataajar">Tambah Data Baru</button>
                                <button class="btn btn-xs bg-purple" id="btnexportdataajar">Export Tabel di Bawah</button>
                                <div id="griddataajar"></div>
                            </div><!-- /.box-body -->
                            <div class="box-body">
                                <div class="form-group">
                                    <button class="btn btn-xs bg-maroon" id="btnnewdatasertifikat">Tambah Data Baru</button>
                                    <button class="btn btn-xs bg-purple" id="btnexportdatasertifikat">Export Tabel di Bawah</button>
                                    <div id="griddatasertifikat"></div>
                                </div>
                            </div>
                        </div><!-- /.box -->
                    </div><!-- /batas halaman Data Ajar -->
                    <div id="halamanremun">
                        <div class="box box-success">
                            <div class="box-header with-border">
                            <h3 class="box-title">Rekap Data</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <label>NIP/NIK/NIPK</label>
                                            <input type="text" class="form-control" value="{{$biodata->nip_baru}}" disabled="disable">
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" value="{{$biodata->nama_lengkap}}" disabled="disable">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <label>Homebase</label>
                                        <input type="text" class="form-control" value="{{$tlsprodi}}" disabled="disable">
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <label>Jenis Kerja</label>
                                        <input type="text" class="form-control" value="{{$tlsjabatan}}" disabled="disable">
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <label>Pilih Tahun</label>
                                            <input type="text" class="form-control" value="{{$thniki}}" id="remun_tahun">
                                        </div>
                                        <div class="col-md-3 col-lg-3">
                                            <button class="btn btn-md bg-maroon" id="btngeneratedata">Generate Data</button>
                                        </div>
                                        <div class="col-md-3 col-lg-3">
                                            <button class="btn btn-md bg-purple" id="btnexportdataremun">Export Tabel di Bawah</button>
                                        </div>
                                    </div>
                                </div>
                                <div id="griddataremun"></div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /batas halaman Remun-->
                    <div id="halamanskp">
                        <div class="box box-success">
                            <div class="box-header with-border">
                            <h3 class="box-title">SKP</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <label>NIP/NIK/NIPK</label>
                                            <input type="text" class="form-control" value="{{$biodata->nip_baru}}" disabled="disable">
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" value="{{$biodata->nama_lengkap}}" disabled="disable">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <label>Homebase</label>
                                        <input type="text" class="form-control" value="{{$tlsprodi}}" disabled="disable">
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <label>Jenis Kerja</label>
                                        <input type="text" class="form-control" value="{{$tlsjabatan}}" disabled="disable">
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <label>Pilih Tahun</label>
                                            <input type="text" class="form-control" value="{{$thniki}}" id="skp_tahun">
                                        </div>
                                        <div class="col-md-3 col-lg-3">
                                            <button class="btn btn-md bg-maroon" id="btngendataskp">Generate Data</button>
                                        </div>
                                        <div class="col-md-3 col-lg-3">
                                            <button class="btn btn-md bg-purple" id="btnexportdataskp">Export Tabel di Bawah</button>
                                        </div>
                                    </div>
                                </div>
                                <div id="griddataskp"></div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /batas halaman SKP-->
                    <div id="halamanangkakredit">
                        <div class="box box-success">
                            <div class="box-header with-border">
                            <h3 class="box-title">Angka Kredit</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <label>NIP/NIK/NIPK</label>
                                            <input type="text" class="form-control" value="{{$biodata->nip_baru}}" disabled="disable">
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" value="{{$biodata->nama_lengkap}}" disabled="disable">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <label>Homebase</label>
                                        <input type="text" class="form-control" value="{{$tlsprodi}}" disabled="disable">
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <label>Jenis Kerja</label>
                                        <input type="text" class="form-control" value="{{$tlsjabatan}}" disabled="disable">
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <a id="cetak" class="btn btn-warning" href="#">
                                                <i class="fa fa-edit icon-white"></i>
                                                Cetak
                                            </a>
                                        </div>
                                        <div class="col-xs-3">
                                            <a id="export" class="btn btn-danger" href="#">
                                                <i class="fa fa-edit icon-white"></i>
                                                Export
                                            </a>
                                        </div>
                                        <div class="col-xs-3">
                                            <a id="rekapak" class="btn btn-info" href="#">
                                                <i class="fa fa-edit icon-white"></i>
                                                Rekap
                                            </a>
                                        </div>
                                        <div class="col-xs-3">
                                            <a id="mukaak" class="btn btn-primary" href="#">
                                                <i class="fa fa-edit icon-white"></i>
                                                Halaman 1
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <a id="pendidikan" class="btn btn-danger" href="#">
                                                <i class="fa fa-edit icon-white"></i>
                                                Pendidikan
                                            </a>
                                        </div>
                                        <div class="col-xs-3">
                                            <a id="penelitian" class="btn btn-primary" href="#">
                                                <i class="fa fa-edit icon-white"></i>
                                                Penelitian
                                            </a>
                                        </div>
                                        <div class="col-xs-3">
                                            <a id="pengabdian" class="btn btn-warning" href="#">
                                                <i class="fa fa-edit icon-white"></i>
                                                Pengabdian
                                            </a>
                                        </div>
                                        <div class="col-xs-3">
                                            <a id="penunjang" class="btn btn-success" href="#">
                                                <i class="fa fa-edit icon-white"></i>
                                                Penunjang
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-content" style="width: 100%; height: 400px; overflow-y: scroll;">
                                    <div id="hasilcari"></div>
                                </div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /batas halaman SKP-->
                    <div id="halamanevaluasikinerja">
                        <div class="box box-success">
                            <div class="box-header with-border">
                            <h3 class="box-title">Evaluasi Kinerja Dosen</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <label>NIP/NIK/NIPK</label>
                                            <input type="text" class="form-control" value="{{$biodata->nip_baru}}" disabled="disable">
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" value="{{$biodata->nama_lengkap}}" disabled="disable">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <label>Homebase</label>
                                        <input type="text" class="form-control" value="{{$tlsprodi}}" disabled="disable">
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <label>Jenis Kerja</label>
                                        <input type="text" class="form-control" value="{{$tlsjabatan}}" disabled="disable">
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>Semester</label>
                                            <select id="ekd_semester" class="form-control">		
                                            <option value="Ganjil">Ganjil</option>
                                            <option value="Genap">Genap</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-3">
                                            <label>Tahun</label>
                                            <input type="text" class="form-control" value="{{$thniki}}" id="ekd_tahun">
                                        </div>
                                        <div class="col-xs-3">
                                            <a id="btngeneratedatakinerja" class="btn btn-warning" href="#">
                                                <i class="fa fa-edit icon-white"></i>
                                                Generate
                                            </a>
                                        </div>
                                        <div class="col-xs-3">
                                            <a id="btncetakdatakinerja" class="btn btn-warning" href="#">
                                                <i class="fa fa-print icon-white"></i>
                                                Cetak
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-content" style="width: 100%; height: 400px; overflow-y: scroll;">
                                    <div id="divviewekd"></div>
                                </div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /batas halaman Surat SCO-->
                    <div id="halamanubahpassword">
                        <div class="card card-primary card-outline" >
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{!!$foto!!}" alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">Ubah Password</h3>
                                <p class="text-muted text-center">{!! $biodata->nama_lengkap !!}</p>
                            </div>
                            <div class="card-footer">
								<div class="form-group row">
									<label for="lupa_password1" class="col-sm-4 col-form-label">Password <span class="text-danger">*</span>:</label>
									<div class="col-sm-8">
										<input type="password" name="lupa_password1" id="lupa_password1" class="form-control" />
									</div>
								</div>
								<div class="form-group row">
									<label for="lupa_password2" class="col-sm-4 col-form-label">Konfirmasi Password <span class="text-danger">*</span>:</label>
									<div class="col-sm-8">
										<input type="password" name="lupa_password2" id="lupa_password2" class="form-control" />
									</div>
								</div>
								<div class="form-group row">
									<a id="btnkirimpassword" href="#" class="btn btn-social btn-primary pull-right">
										<i class="fa fa-unlock-alt"></i> Set Password Baru
									</a>
								</div>
                            </div>
                        </div>
                    </div><!-- /batas halaman Pendidikan -->
                </div>
            </div>
		</div>
	</div>
</div>
<div class="modal modal-info" id="modaluploader"><!-- /.Modal Upload -->
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Form Uploader</h4>
	  </div>
	<div class="modal-body">
		<div class="box-body">
			<div class="form-group">
			 <div class="row">
				  <div class="col-md-6 col-lg-6">
					  <label>Nama</label>
					  <input type="text" class="form-control" disabled="disable" value="{{$biodata->nama_lengkap}}">
				  </div>		
				  <div class="col-md-6 col-lg-6">
					  <label>NIP</label>
					  <input type="text" class="form-control" disabled="disable" value="{{$biodata->nip_baru}}">
			      </div>
			 </div>
		    </div>
			<div class="form-group">
			 <div class="row">
				  <div class="col-md-6 col-lg-6">
					  <label>Tabel</label>
					  <input type="text" class="form-control" disabled="disable" id="upload_tabel">
				  </div>		
				  <div class="col-md-6 col-lg-6">
					  <label>Data</label>
					  <input type="text" class="form-control" disabled="disable" id="upload_data">
			      </div>
			 </div>
		    </div>
			<div class="form-group">
				<input type="file" id="upload_file" name="upload_file">
				<p class="help-block">File PDF / JPG / PNG</p>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<input type="hidden" id="master">
		<input type="hidden" id="upload_namafile">
		<input type="hidden" class="form-control" id="upload_id">
		<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
		<button type="button" class="btn btn-success" id="btnsimpandataupload">Simpan</button>
	</div>
  </div><!-- /.modal-content -->
 </div><!-- /.modal-body -->
</div><!-- /.modal-modal -->
<div class="modal modal-info" id="modaldatasertifikat"><!-- /.Modal Data Sertifikat -->
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Form Data Sertifikat</h4>
	  </div>
	<div class="modal-body">
		<div class="box-body">
			<div class="form-group">
			 <div class="row">
				  <div class="col-md-6 col-lg-6">
					  <label>Nama</label>
					  <input type="text" class="form-control" disabled="disable" value="{{$biodata->nama_lengkap}}">
				  </div>		
				  <div class="col-md-6 col-lg-6">
					  <label>NIP</label>
					  <input type="text" class="form-control" disabled="disable" value="{{$biodata->nip_baru}}">
			      </div>
			 </div>
		    </div>
			<div class="form-group">
				<label>Nama Sertifikat</label>
				<input type="text" class="form-control" id="sertifikat_nama">
			</div>
			<div class="form-group">
			 <div class="row">		
				  <div class="col-md-8 col-lg-8">
					<label>Jenis Sertifikat</label>
					<select id="sertifikat_jenis" class="form-control">		
					  <option value="SPP">Sertifikat Pendidikan Profesional</option>
					  <option value="SKPI">Sertifikat Kompetensi / Profesi / Industri</option>
					</select>
			      </div>
				  <div class="col-md-4 col-lg-4">
					<label>Tahun</label>
					<input type="text" class="form-control" id="sertifikat_tahun">
			      </div>
			 </div>
			</div>
			<div class="form-group">
			 <div class="row">		
				  <div class="col-md-8 col-lg-8">
					<label>Instansi Penerbit Sertifikat</label>
					<input type="text" class="form-control" id="sertifikat_pemberi">
			      </div>
				  <div class="col-md-4 col-lg-4">
					<label>Negara</label>
					<input type="text" class="form-control" id="sertifikat_negara">
			      </div>
			 </div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<input type="hidden" class="form-control" id="sertifikat_id">
		<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
		<div id="divtambahdatasertifikat">		
			<button type="button" class="btn btn-success" id="btnsimpandatasertifikat">Simpan</button>
		</div>
		<div id="divupdatedatasertifikat">
			<button type="button" class="btn btn-danger pull-left" id="btnhapusdatasertifikat">Hapus Data Ini</button>
			<button type="button" class="btn btn-warning" id="btnupdatedatasertifikat">Update</button>
		</div>
	</div>
  </div><!-- /.modal-content -->
 </div><!-- /.modal-body -->
</div><!-- /.modal-modal -->
<div class="modal modal-info" id="modaldataajar"><!-- /.Modal Data Ajar -->
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Form Data Ajar</h4>
	  </div>
	<div class="modal-body">
		<div class="box-body">
			<div class="form-group">
			 <div class="row">
				  <div class="col-md-6 col-lg-6">
					  <label>Nama</label>
					  <input type="text" class="form-control" disabled="disable" value="{{$biodata->nama_lengkap}}">
				  </div>		
				  <div class="col-md-6 col-lg-6">
					  <label>NIP</label>
					  <input type="text" class="form-control" disabled="disable" value="{{$biodata->nip_baru}}">
			      </div>
			 </div>
		    </div>
			<div class="form-group">
			 <div class="row">		
				  <div class="col-md-8 col-lg-8">
					<label>Lingkup</label>
					<select id="dataajar_lingkup" class="form-control">		
						<option value="1">Di Fakultas Homebase</option>
						<option value="1">Diluar Fakultas Homebase 1 Universitas</option>
						<option value="2">Diluar Fakultas Homebase Lain Universitas</option>
					</select>
			      </div>
			 </div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<input type="hidden" class="form-control" id="dataajar_id">
		<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
		<div id="divtambahdataajar">		
			<button type="button" class="btn btn-success" id="btnsimpandataajar">Simpan</button>
		</div>
		<div id="divupdatedataajar">
			<button type="button" class="btn btn-danger pull-left" id="btnhapusdataajar">Hapus Data Ini</button>
			<button type="button" class="btn btn-warning" id="btnupdatedataajar">Update</button>
		</div>
	</div>
  </div><!-- /.modal-content -->
 </div><!-- /.modal-body -->
</div><!-- /.modal-modal -->
<div class="modal modal-info" id="modaladddataasesor"><!-- /.Modal Seminar -->
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Form Riwayat Asessor</h4>
	  </div>
	<div class="modal-body">
		<div class="box-body">
			<div class="form-group">
			 <div class="row">
				  <div class="col-md-6 col-lg-6">
					  <label>Nama</label>
					  <input type="text" class="form-control" disabled="disable" value="{{$biodata->nama_lengkap}}">
				  </div>		
				  <div class="col-md-6 col-lg-6">
					  <label>NIP</label>
					  <input type="text" class="form-control" disabled="disable" value="{{$biodata->nip_baru}}">
			      </div>
			 </div>
		    </div>
			<div class="form-group">
			 <div class="row">
				  <div class="col-md-6 col-lg-6">
					<label>Tahun Akademik</label>
					<input type="text" class="form-control" id="asesor_tahunakad" Placeholder="{{ $thnakad }}">
				  </div>		
				  <div class="col-md-6 col-lg-6">
					<label>Semester</label>
					<select id="asesor_semester" class="form-control">		
					  <option value="Ganjil">Ganjil</option>
					  <option value="Genap">Genap</option>
					</select>
			      </div>
			 </div>
			</div>
			<div class="form-group">
				<label>Asessor 1</label>
				<input type="text" class="form-control" id="asesor_dosen1">
			</div>
			<div class="form-group">
				<label>Asessor 2</label>
				<input type="text" class="form-control" id="asesor_dosen2">
			</div>
			<div class="form-group">
			  <label>Keterangan</label>
			  <input type="text" class="form-control" id="asesor_keterangan">
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<input type="hidden" class="form-control" id="asesor_id">
		<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
		<div id="divtambahasesor">		
			<button type="button" class="btn btn-success" id="btnsimpandataasesor">Simpan</button>
		</div>
		<div id="divupdateasesor">
			<button type="button" class="btn btn-danger pull-left" id="btnhapusasesor">Hapus Data Ini</button>
			<button type="button" class="btn btn-warning" id="btnupdatedataasesor">Update</button>
		</div>
	</div>
  </div><!-- /.modal-content -->
 </div><!-- /.modal-body -->
</div><!-- /.modal-modal -->
<div class="modal modal-info" id="modaladddataseminar"><!-- /.Modal Seminar -->
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Form Riwayat Seminar Yang di Ikuti</h4>
	  </div>
	<div class="modal-body">
		<div class="box-body">
			<div class="form-group">
			 <div class="row">
				  <div class="col-md-6 col-lg-6">
					  <label>Nama</label>
					  <input type="text" class="form-control" disabled="disable" value="{{$biodata->nama_lengkap}}">
				  </div>		
				  <div class="col-md-6 col-lg-6">
					  <label>NIP</label>
					  <input type="text" class="form-control" disabled="disable" value="{{$biodata->nip_baru}}">
			      </div>
			 </div>
		    </div>
			<div class="form-group">
			 <div class="row">
				  <div class="col-md-5 col-lg-5">
					<label>Tahun</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<input type="text" class="form-control" id="seminar_tahun" value="{{$thniki}}">
					</div>
				  </div>		
				  <div class="col-md-7 col-lg-7">
					  <label>Nama Seminar</label>
					  <input type="text" class="form-control" id="seminar_nama">
			      </div>
			 </div>
			</div>
			<div class="form-group">
			 <div class="row">
				  <div class="col-md-5 col-lg-5">
					<label>Tingkat</label>
					<select id="seminar_tingkat" class="form-control">
					  <option value="Regional">Regional</option>
					  <option value="Nasional">Nasional</option>
					  <option value="Internasional">Internasional</option>
					</select>
				  </div>		
				  <div class="col-md-7 col-lg-7">
					<label>Lokasi</label>
					<input type="text" class="form-control" id="seminar_lokasi">
			      </div>
			 </div>
		    </div>
			<div class="form-group">
			 <div class="row">
				  <div class="col-md-7 col-lg-7">
					<label>Penyelenggara</label>
					<input type="text" class="form-control" id="seminar_penyelenggara">
				  </div>		
				  <div class="col-md-5 col-lg-5">
					<label>Kedudukan</label>
					<select id="seminar_kedudukan" class="form-control">
					  <option value=""></option>				
					  <option value="Pemateri">Pemateri</option>
					  <option value="Peserta">Peserta</option>
					  <option value="Panitia">Panitia</option>
					</select>
			      </div>
			 </div>
		    </div>
		</div>
	</div>
	<div class="modal-footer">
		<input type="hidden" class="form-control" id="seminar_id">
		<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
		<div id="divtambahseminar">		
			<button type="button" class="btn btn-success" id="btnsimpandataseminar">Simpan</button>
		</div>
		<div id="divupdateseminar">
			<button type="button" class="btn btn-danger pull-left" id="btnhapusseminar">Hapus Data Ini</button>
			<button type="button" class="btn btn-warning" id="btnupdatedataseminar">Update</button>
		</div>
	</div>
  </div><!-- /.modal-content -->
 </div><!-- /.modal-body -->
</div><!-- /.modal-modal -->
<div class="modal modal-info" id="modaladddatamutasi"><!-- /.Modal Mutasi -->
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Form Riwayat Perubahan Status / Mutasi</h4>
	  </div>
	<div class="modal-body">
		<div class="box-body">
			<div class="form-group">
			 <div class="row">
				  <div class="col-md-6 col-lg-6">
					  <label>Nama</label>
					  <input type="text" class="form-control" disabled="disable" value="{{$biodata->nama_lengkap}}">
				  </div>		
				  <div class="col-md-6 col-lg-6">
					  <label>NIP</label>
					  <input type="text" class="form-control" disabled="disable" value="{{$biodata->nip_baru}}">
			      </div>
			 </div>
		    </div>
			<div class="form-group">
			 <div class="row">
				  <div class="col-md-5 col-lg-5">
					<label>Status</label>
					<select id="mutasi_status" size="1" class="form-control">
						<option value="Aktif">Aktif</option>
						<option value="Ijin Belajar">Ijin Belajar</option>
						<option value="Tugas Belajar">Tugas Belajar</option>
						<option value="Pensiun">Pensiun</option>
						<option value="Pensiun Dini">Pensiun Dini</option>
						<option value="Mengundurkan Diri">Mengundurkan Diri</option>
						<option value="Meninggal Dunia">Meninggal Dunia</option>
						<option value="Mutasi">Mutasi</option>
						<option value="Tidak Aktif">Tidak Aktif</option>
					</select>
				  </div>		
				  <div class="col-md-7 col-lg-7">
					  <label>No. SK</label>
					  <input type="text" class="form-control" id="mutasi_nosk">
			      </div>
			 </div>
			</div>
			<div class="form-group">
			 <div class="row">
				  <div class="col-md-4">
					<label>Tanggal</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<input type="text" class="form-control" id="mutasi_tanggal">
					</div>
				  </div>		
				  <div class="col-md-8">
					<label>Keterangan</label>
					<input type="text" class="form-control" id="mutasi_keterangan">
			      </div>
			 </div>
		    </div>
		</div>
	</div>
	<div class="modal-footer">
		<input type="hidden" class="form-control" id="mutasi_idne">
		<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
		<div id="divtambahmutasi">		
			<button type="button" class="btn btn-success" id="btnsimpandatamutasi">Simpan</button>
		</div>
		<div id="divupdatemutasi">
			<button type="button" class="btn btn-danger pull-left" id="btnhapusmutasi">Hapus Data Ini</button>
			<button type="button" class="btn btn-warning" id="btnupdatedatamutasi">Update</button>
		</div>
	</div>
  </div><!-- /.modal-content -->
 </div><!-- /.modal-body -->
</div><!-- /.modal-modal -->
<div class="modal modal-info" id="modaladddatapangkat"><!-- /.Modal Kepangkatan -->
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Form Riwayat Kepangkatan</h4>
	  </div>
	<div class="modal-body">
		<div class="box-body">
			<div class="form-group">
			 <div class="row">
				  <div class="col-md-6 col-lg-6">
					  <label>Nama</label>
					  <input type="text" class="form-control" disabled="disable" value="{{$biodata->nama_lengkap}}">
				  </div>		
				  <div class="col-md-6 col-lg-6">
					  <label>NIP</label>
					  <input type="text" class="form-control" disabled="disable" value="{{$biodata->nip_baru}}">
			      </div>
			 </div>
		    </div>
			<div class="form-group">
			 <div class="row">
				  <div class="col-md-6 col-lg-6">
					<label>No.SK</label>
					<input type="text" class="form-control" id="pangkat_nosk">					
				  </div>		
				  <div class="col-md-6 col-lg-6">
					<label>Tgl. SK</label>
					<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					</div>
					<input type="text" id="pangkat_tglsk" class="form-control">
					</div>
			      </div>
			 </div>
			</div>
			<div class="form-group">
				<label>Asal SK</label>
				<select id="pangkat_asalsk" size="1" class="form-control">
					<option value="">Pilih Salah Satu</option>
					<option value="Presiden">Presiden</option>
					<option value="Menteri">Menteri</option>
					<option value="Rektor">Rektor</option>
				</select>
		    </div>
			<div class="form-group">
				<label>Penjelasan</label>
				<select id="pangkat_penjelasan" size="1" class="form-control">
					<option value="">Pilih Salah Satu</option>
					<option value="Dosen PNS">Dosen PNS</option>
					<option value="Dosen NON PNS">Dosen Non PNS</option>
					<option value="Dosen Pensiun - PK">Dosen Purna Perjanjian Kerja</option>
					<option value="Dosen Profesional - PK">Dosen Profesional Perjanjian Kerja</option>
					<option value="Dosen Tidak Tetap">Dosen Tidak Tetap</option>
					<option value="Dosen Kontrak">Dosen Kontrak</option>
					<option value="Tendik PNS">Tendik PNS</option>
					<option value="Tendik NON PNS">Tendik Non PNS</option>
					<option value="Tendik KONTRAK">Tendik Kontrak</option>
				</select>
		    </div>
			<div class="form-group">
				<label>Golongan</label>
				<select id="pangkat_golongan" size="1" class="form-control">
					<option value="">Pilih Salah Satu</option>
					<option value="IV/e">Pembina Utama, Gol. IVe</option>
					<option value="IV/d">Pembina Utama Madya, Gol. IVd</option>
					<option value="IV/c">Pembina Utama Muda, Gol. IVc</option>
					<option value="IV/b">Pembina Tk.I, Gol. IVb</option>
					<option value="IV/a">Pembina, Gol. IVa</option>
					<option value="III/d">Penata Tk. I, Gol. IIId</option>
					<option value="III/c">Penata, Gol. IIIc</option>
					<option value="III/b">Penata Muda Tk. I, Gol. IIIb</option>
					<option value="III/a">Penata Muda, Gol. IIIa</option>
					<option value="II/d">Pengatur Tk. I, Gol. IId</option>
					<option value="II/c">Pengatur, Gol. IIc</option>
					<option value="II/b">Pengatur Muda Tk. I, Gol. IIb</option>
					<option value="II/a">Pengatur Muda, Gol. IIa</option>
					<option value="I/d">Juru Tk.I, Gol. Id</option>
					<option value="I/c">Juru, Gol. Ic</option>
					<option value="I/b">Juru Muda Tk. I, Gol. Ib</option>
					<option value="I/a">Juru Muda, Gol. Ia</option>
				</select>
		    </div>
			<div class="form-group">
			 <div class="row">
				  <div class="col-md-6 col-lg-6">
					<label>TMT</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</div>
						<input type="text" class="form-control" id="pangkat_tmt">
					</div>
				  </div>		
				  <div class="col-md-6 col-lg-6">
					<label>Gaji Pokok</label>
					<input type="text" class="form-control" id="pangkat_gaji">
			      </div>
			 </div>
			</div>
			<div class="form-group">
			 <div class="row">
				  <div class="col-md-6 col-lg-6">
					<label>Masa Kerja Keseluruhan</label>					
					<input type="text" class="form-control" disabled="disable">
				  </div>		
				  <div class="col-md-6 col-lg-6">
					<label>Masa Kerja Golongan</label>
					<input type="text" class="form-control" disabled="disable">
			      </div>				  
			 </div>
			</div>
			<div class="form-group">
				<label>Penanda Tangan SK</label>
				<input type="text" class="form-control" id="pangkat_penandatangan">
		    </div>
			<div class="form-group">
			 <div class="row">
				  <div class="col-md-6 col-lg-6">
					<label>Masa Kerja Tambahan</label>
					<table border="0">
						<tr>
							<td><input type="text" class="form-control" id="pangkat_tahuntambah"></td>
							<td>Tahun</td>
							<td><input type="text" class="form-control" id="pangkat_bulantambah"></td>
							<td>Bulan</td>
						</tr>
					</table>					
				  </div>		
				  <div class="col-md-6 col-lg-6">
					<label>Masa Kerja Pengurangan</label>
					<table border="0">
						<tr>
							<td><input type="text" class="form-control" id="pangkat_tahunkurang"></td>
							<td>Tahun</td>
							<td><input type="text" class="form-control" id="pangkat_bulankurang"></td>
							<td>Bulan</td>
						</tr>
					</table>
			      </div>				  
			 </div>
			</div>
			<div class="form-group">
				<label>Keterangan</label>
				<input type="text" class="form-control" id="pangkat_keterangan">
		    </div>
		</div>
	  </div>
	  <div class="modal-footer">
		<input type="hidden" class="form-control" id="pangkat_idne">
		<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
		<div id="divtambahpangkat">		
			<button type="button" class="btn btn-success" id="btnsimpandatapangkat">Simpan</button>
		</div>
		<div id="divupdatepangkat">
			<button type="button" class="btn btn-danger pull-left" id="btnhapuspangkat">Hapus Data Ini</button>
			<button type="button" class="btn btn-warning" id="btnupdatedatapangkat">Update</button>
		</div>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal modal-info" id="modaladddatafungsional"><!-- /.Modal Fungsional -->
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Form Riwayat Fungsional</h4>
	  </div>
	<div class="modal-body">
		<div class="box-body">
			<div class="form-group">
			 <div class="row">
				  <div class="col-md-6 col-lg-6">
					  <label>Nama</label>
					  <input type="text" class="form-control" disabled="disable" value="{{$biodata->nama_lengkap}}">
				  </div>		
				  <div class="col-md-6 col-lg-6">
					  <label>NIP</label>
					  <input type="text" class="form-control" disabled="disable" value="{{$biodata->nip_baru}}">
			      </div>
			 </div>
		    </div>
			<div class="form-group">
			 <div class="row">
				  <div class="col-md-6 col-lg-6">
					<label>No.SK</label>
					<input type="text" class="form-control" id="fungsional_nosk">					
				  </div>		
				  <div class="col-md-6 col-lg-6">
					<label>Tgl. SK</label>
					<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					</div>
					<input type="text" id="fungsional_tglsk" class="form-control">
					</div>
			      </div>
			 </div>
			</div>
			<div class="form-group">
			 <div class="row">
				  <div class="col-md-6 col-lg-6">
					<label>Asal SK</label>
					<select id="fungsional_asalsk" size="1" class="form-control">
						<option value="">Pilih Salah Satu</option>
						<option value="Presiden">Presiden</option>
						<option value="Menteri">Menteri</option>
						<option value="Rektor">Rektor</option>
					</select>				
				  </div>		
				  <div class="col-md-6 col-lg-6">
					<label>TMT</label>
					<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					</div>
					<input type="text" class="form-control" id="fungsional_tmt">
					</div>
			      </div>
			 </div>
			</div>
			<div class="form-group">
			 <div class="row">
				  <div class="col-md-6 col-lg-6">
					<label>Unit Kerja</label>					
					<input type="text" class="form-control" id="fungsional_unitkerja">
				  </div>		
				  <div class="col-md-6 col-lg-6">
					<label>Nama Unit Kerja</label>
					<input type="text" class="form-control" id="fungsional_namaunitkerja">
			      </div>
			 </div>
			</div>			
			<div class="form-group">
				<label>Penandatangan SK</label>
				<input type="text" class="form-control" id="fungsional_penandatangan">
		    </div>
			<div class="form-group">
			 <div class="row">
				  <div class="col-md-8">
					<label>Tunjangan Fungsional</label>					
					<input type="text" class="form-control" id="fungsional_tunjangan">
				  </div>		
				  <div class="col-md-4">
					<label>Angka Kredit</label>
					<input type="text" class="form-control" id="fungsional_angkakredit">
			      </div>
			 </div>
			 Gunakan Tanda titik sebagai pengganti tanda koma
			</div>
			<div class="form-group">
				<label>Keterangan</label>
				<input type="text" class="form-control" id="fungsional_keterangan">
		    </div>
		</div>
	  </div>
	  <div class="modal-footer">
		<input type="hidden" class="form-control" id="fungsional_idne">
		<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
		<div id="divtambahfungsional">		
			<button type="button" class="btn btn-success" id="btnsimpandatafungsional">Simpan</button>
		</div>
		<div id="divupdatefungsional">
			<button type="button" class="btn btn-danger pull-left" id="btnhapusfungsional">Hapus Data Ini</button>
			<button type="button" class="btn btn-warning" id="btnupdatedatafungsional">Update</button>
		</div>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal modal-info" id="modaladddatasertifikasi"><!-- /.Modal Sertifikasi -->
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Form Riwayat Sertifikasi Dosen</h4>
	  </div>
	<div class="modal-body">
		<div class="box-body">
			<div class="form-group">
			 <div class="row">
				  <div class="col-md-6 col-lg-6">
					  <label>Nama</label>
					  <input type="text" class="form-control" disabled="disable" value="{{$biodata->nama_lengkap}}">
				  </div>		
				  <div class="col-md-6 col-lg-6">
					  <label>NIP</label>
					  <input type="text" class="form-control" disabled="disable" value="{{$biodata->nip_baru}}">
			      </div>
			 </div>
		    </div>
			<div class="form-group">
			 <div class="row">
				  <div class="col-md-6 col-lg-6">
					<label>No.Registrasi</label>
					<input type="text" class="form-control" id="sertifikasi_noreg">					
				  </div>		
				  <div class="col-md-6 col-lg-6">
					<label>Tgl. Sertifikasi</label>
					<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					</div>
					<input type="text" id="sertifikasi_tgl" class="form-control">
					</div>
			      </div>
			 </div>
			</div>
			<div class="form-group">
			 <div class="row">
				  <div class="col-md-6 col-lg-6">
					<label>PTP SERDOS</label>
					<select id="sertifikasi_ptp" size="1" class="form-control">
						<option value="">Pilih Salah Satu</option>
						<option value="Universitas Brawijaya">Universitas Brawijaya</option>
						<option value="Universitas Gadjah Mada">Universitas Gadjah Mada</option>
						<option value="Universitas Indonesia">Universitas Indonesia</option>
					</select>				
				  </div>		
				  <div class="col-md-6 col-lg-6">
					<label>No. Peserta</label>					
					<input type="text" class="form-control" id="sertifikasi_nopes">
			      </div>
			 </div>
			</div>
			<div class="form-group">
				<label>Nama Pejabat Penanda Tangan</label>
				<input type="text" class="form-control" id="sertifikasi_penandatangan">
		    </div>
			<div class="form-group">
				<label>Rumpun Bidang Ilmu</label>
				<input type="text" class="form-control" id="sertifikasi_bidang">
		    </div>
			<div class="form-group">
				<label>Keterangan</label>
				<input type="text" class="form-control" id="sertifikasi_keterangan">
		    </div>
		</div>
	  </div>
	  <div class="modal-footer">
		<input type="hidden" class="form-control" id="sertifikasi_idne">
		<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
		<div id="divtambahsertifikasi">		
			<button type="button" class="btn btn-success" id="btnsimpandatasertifikasi">Simpan</button>
		</div>
		<div id="divupdatesertifikasi">
			<button type="button" class="btn btn-danger pull-left" id="btnhapussertifikasi">Hapus Data Ini</button>
			<button type="button" class="btn btn-warning" id="btnupdatedatasertifikasi">Update</button>
		</div>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal modal-info" id="modaladddatagaji"><!-- /.Modal Gaji -->
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Form Riwayat Perubahan Gaji</h4>
	  </div>
	<div class="modal-body">
		<div class="box-body">
			<div class="form-group">
			 <div class="row">
				  <div class="col-md-6 col-lg-6">
					  <label>Nama</label>
					  <input type="text" class="form-control" disabled="disable" value="{{$biodata->nama_lengkap}}">
				  </div>		
				  <div class="col-md-6 col-lg-6">
					  <label>NIP</label>
					  <input type="text" class="form-control" disabled="disable" value="{{$biodata->nip_baru}}">
			      </div>
			 </div>
		    </div>
			<div class="form-group">
			 <div class="row">
				  <div class="col-md-6 col-lg-6">
					<label>No.SK</label>
					<input type="text" class="form-control" id="gaji_sk">
				  </div>		
				  <div class="col-md-6 col-lg-6">
					<label>TMT</label>
					<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					</div>
					<input type="text" id="gaji_tmt" class="form-control">
					</div>
			      </div>
			 </div>
			</div>
			<div class="form-group">
			 <div class="row">
				  <div class="col-md-6 col-lg-6">
					<label>Perubahan Gaji</label>
					<select id="gaji_perubahan" size="1" class="form-control">
						<option value="">Pilih Salah Satu</option>
						<option value="Kenaikan Gaji Karena Penyesuaian Pangkat">Kenaikan Gaji Karena Penyesuaian Pangkat</option>
						<option value="Kenaikan Gaji Karena Penyesuaian Jabatan">Kenaikan Gaji Karena Penyesuaian Jabatan</option>
						<option value="Kenaikan Gaji Karena Pensiun">Kenaikan Gaji Karena Pensiun</option>
					</select>				
				  </div>		
				  <div class="col-md-6 col-lg-6">
					<label>Gaji</label>					
					<input type="text" class="form-control" id="gaji_gaji">
			      </div>
			 </div>
			</div>
		</div>
	  </div>
	  <div class="modal-footer">
		<input type="hidden" class="form-control" id="gaji_idne">
		<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
		<div id="divtambahgaji">		
			<button type="button" class="btn btn-success" id="btnsimpandatagaji">Simpan</button>
		</div>
		<div id="divupdategaji">
			<button type="button" class="btn btn-danger pull-left" id="btnhapusgaji">Hapus Data Ini</button>
			<button type="button" class="btn btn-warning" id="btnupdatedatagaji">Update</button>
		</div>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal modal-info" id="modaladddatapenghargaan"><!-- /.Modal Penghargaan -->
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Form Riwayat Penghargaan</h4>
	  </div>
	<div class="modal-body">
		<div class="box-body">
		
		</div>
	  </div>
	  <div class="modal-footer">
		<input type="hidden" class="form-control" id="penghargaan_idne">
		<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
		<div id="divtambahpenghargaan">		
			<button type="button" class="btn btn-success" id="btnsimpandatapenghargaan">Simpan</button>
		</div>
		<div id="divupdatepenghargaan">
			<button type="button" class="btn btn-danger pull-left" id="btnhapuspenghargaan">Hapus Data Ini</button>
			<button type="button" class="btn btn-warning" id="btnupdatedatapenghargaan">Update</button>
		</div>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
    <div class="form-group">  
        <div class="row">
            <div class="col-md-4 col-lg-4">
                <label for="id_nip">NIP.</label>
                <input type="text" class="form-control" id="id_nip" value="{{$biodata->nip_baru}}">
            </div>
            <div class="col-md-4 col-lg-4">
                <label for="id_jenis">Jenis</label>
                <select id="id_jenis" name="id_jenis" size="1" class="form-control">
                @php
                    $lists   =   ['NIP', 'NIK', 'NIPK'];
                    foreach($lists as $list) {
                        if($list == $biodata->jenisnip) {
                            echo "<option value='$list' selected>$list</option>";
                        } else {
                            echo "<option value='$list'>$list</option>";
                        }
                    }
                @endphp
                </select>
            </div>
            <div class="col-md-4 col-lg-4">
                <label for="id_tahunmsk">TMT Pegawai</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" id="id_tahunmsk" class="form-control" value="{{$biodata->thn_masuk}}">
                </div>
            </div>
        </div>
    </div>	
    <p class="help-block">Kode Peg, di isi dengan inisial dari nama anda (3 digit karakter)</p>
    <div class="form-group">  
        <div class="row">
            <div class="col-md-4">
                <label for="id_kode">Kode Peg</label>
                <input type="text" id="id_kode" class="form-control" value="{{$biodata->kode}}">
            </div>
            <div class="col-md-4">
                <label for="id_glrdepan">Gelar Depan</label>
                <input type="text" id="id_glrdepan" class="form-control" value="{{$biodata->gelardepan}}">
            </div>
            <div class="col-md-4">
                <label for="id_glrblakang">Gelar Belakang</label>
                <input type="text" id="id_glrblakang" class="form-control" value="{{$biodata->gelarblakang}}">
            </div> 
        </div>
    </div>
	<div class="form-group">  
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <label for="id_emailub">Email</label>
                <input type="text" id="id_emailub" class="form-control" value="{{$biodata->emailub}}">
            </div>
        </div>
    </div>
    <div class="form-group">  
        <label for="id_nomoridi">Nomor IDI</label>
        <input type="text" class="form-control" id="id_nomoridi" value="{{$biodata->nomoridi}}">
    </div>
    <div class="form-group">  
        <label for="id_keanggotaanprofesi">Keanggotaan Profesi</label>
        <input type="text" class="form-control" id="id_keanggotaanprofesi" value="{{$biodata->keanggotaanprofesi}}">
    </div>
    <div class="form-group">  
        <label for="id_nomorstr">Nomor STR</label>
        <input type="text" class="form-control" id="id_nomorstr" value="{{$biodata->nomorstr}}">
    </div>
    <div class="form-group">  
        <label for="id_nomorsip1">Nomor SIP 1</label>
        <input type="text" class="form-control" id="id_nomorsip1" value="{{$biodata->nomorsip1}}">
    </div>
    <div class="form-group">  
        <label for="id_nomorsip2">Nomor SIP 2</label>
        <input type="text" class="form-control" id="id_nomorsip2" value="{{$biodata->nomorsip2}}">
    </div>
    <div class="form-group">  
        <label for="id_nomorsip3">Nomor SIP 3</label>
        <input type="text" class="form-control" id="id_nomorsip3" value="{{$biodata->nomorsip3}}">
    </div>
    <div class="form-group">  
        <label for="id_google">Alamat Google Scholar</label>
        <input type="text" class="form-control" id="id_google" value="{{$biodata->google}}">
    </div>
    <div class="form-group">  
        <label for="id_shinta">Alamat Shinta</label>
        <input type="text" class="form-control" id="id_shinta" value="{{$biodata->shinta}}">
    </div>
    <div class="form-group">  
        <label for="id_scopus">Scopus ID</label>
        <input type="text" class="form-control" id="id_scopus" value="{{$biodata->scopus}}">
    </div>
    <div class="form-group">  
        <label for="id_orcid">ORCID ID</label>
        <input type="text" class="form-control" id="id_orcid" value="{{$biodata->orcid}}">
    </div>
	<input type="text" class="form-control" id="id_prodi" value="{{$biodata->program_studi}}">
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@push('script')
<script>
	$(function () {
		bsCustomFileInput.init();
		$('#id_tgllhr').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#pendidikan_tglijasah').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#pendidikan_lulus').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#organisasi_mulai').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#organisasi_selesai').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#keluarga_tgllahir').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#keluarga_tglmenikah').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#diklat_lulus').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#diklat_mulai').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#diklat_tgldok').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#penghargaan_tgl').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        
		$("#id_tahunmsk").datepicker({format: 'yyyy-mm-dd'});
		$("#id_tmtcpns").datepicker({format: 'yyyy-mm-dd'});
		$("#id_tmtpns").datepicker({format: 'yyyy-mm-dd'});
		$("#id_tmtfungsional").datepicker({format: 'yyyy-mm-dd'});
		$("#id_tmtgolongan").datepicker({format: 'yyyy-mm-dd'});
		$("#id_tmtjabatan").datepicker({format: 'yyyy-mm-dd'});
		$("#mutasi_tanggal").datepicker({format: 'yyyy-mm-dd'});
		$("#pangkat_tmt").datepicker({format: 'yyyy-mm-dd'});
		$("#pangkat_tglsk").datepicker({format: 'yyyy-mm-dd'});
		$("#fungsional_tglsk").datepicker({format: 'yyyy-mm-dd'});
		$("#fungsional_tmt").datepicker({format: 'yyyy-mm-dd'});
		$("#sertifikasi_tgl").datepicker({format: 'yyyy-mm-dd'});
		$("#gaji_tmt").datepicker({format: 'yyyy-mm-dd'});
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
                $('#preview').attr('src', e.target.result);
            };
        }
    }
	$('#id_tandatangan').change(function () {
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
                readURLAddttd(this);
            } else {
				swal({
					title	: 'Stop',
					text	: 'Please select image file (jpg, jpeg, png).',
					type	: 'warning',
				})
            }
        }
    });
    function readURLAddttd(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#previewttd').attr('src', e.target.result);
            };
        }
    }
	
$(document).ready(function () {
	$('.select2').select2({width: '100%'});
	var statuspelamar = "{{$biodata->status_pegawai}}";
	var token = document.getElementById('token').value;
	$("#gaji_gaji").autoNumeric(
		'init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'}
	);
	if (statuspelamar == '1' || statuspelamar == '' || statuspelamar == null){
		$('#halamanubahpassword').hide();
		$('#halamandataajar').hide();
		$('#halamandataasesor').hide();
		$('#halamandiklat').hide();
		$('#halamanfungsional').hide();
		$('#halamangaji').hide();
		$('#halamanidentitas').hide();
		$('#halamankeluarga').hide();
		$('#halamanmutasi').hide();
		$('#halamanorganisasi').hide();
		$('#halamanpangkat').hide();
		$('#halamanpendidikan').hide();
		$('#halamanpenghargaan').hide();
		$('#halamanseminar').hide();
		$('#halamansertifikasi').hide();
		$('#halamanangkakredit').hide();
		$('#halamandatabkd').hide();
		$('#halamanremun').hide();
		$('#halamanskp').hide();
		$('#halamanevaluasikinerja').hide();
		$('#halamanonline').hide();
	} else {
		$('.divcontrolpanel').hide();
		$('#halamanmuka').show();
		$('#halamanubahpassword').hide();
		$('#halamandataajar').hide();
		$('#halamandataasesor').hide();
		$('#halamandiklat').hide();
		$('#halamanfungsional').hide();
		$('#halamangaji').hide();
		$('#halamanidentitas').hide();
		$('#halamankeluarga').hide();
		$('#halamanmutasi').hide();
		$('#halamanorganisasi').hide();
		$('#halamanpangkat').hide();
		$('#halamanpendidikan').hide();
		$('#halamanpenghargaan').hide();
		$('#halamanseminar').hide();
		$('#halamansertifikasi').hide();
		$('#halamanangkakredit').hide();
		$('#halamandatabkd').hide();
		$('#halamanremun').hide();
		$('#halamanskp').hide();
		$('#halamanevaluasikinerja').hide();
		$('#halamanonline').hide();
	}
	
	$('#btnuploadfoto').on('click', function (){
		$('#id_fotoprofile').click();
	});
	$('#btnuploadtandatangan').on('click', function (){	
		$('#id_tandatangan').click();
	});
	$('#btnshowdepan').on('click', function (){
		$('#halamandataasesor').hide();
		$('#halamandataajar').hide();
		$('#halamandiklat').hide();
		$('#halamanfungsional').hide();
		$('#halamangaji').hide();
		$('#halamanidentitas').hide();
		$('#halamankeluarga').hide();
		$('#halamanmutasi').hide();
		$('#halamanorganisasi').hide();
		$('#halamanpangkat').hide();
		$('#halamanpendidikan').hide();
		$('#halamanpenghargaan').hide();
		$('#halamanseminar').hide();
		$('#halamansertifikasi').hide();
		$('#halamanangkakredit').hide();
		$('#halamandatabkd').hide();
		$('#halamanremun').hide();
		$('#halamanskp').hide();
		$('#halamanmuka').show();
		$('#halamanubahpassword').hide();
		$('#halamanonline').hide();
		return false;
	});
	$('#btnshowonline').on('click', function (){
		$('#halamandataasesor').hide();
		$('#halamandataajar').hide();
		$('#halamandiklat').hide();
		$('#halamanfungsional').hide();
		$('#halamangaji').hide();
		$('#halamanidentitas').hide();
		$('#halamankeluarga').hide();
		$('#halamanmutasi').hide();
		$('#halamanorganisasi').hide();
		$('#halamanpangkat').hide();
		$('#halamanpendidikan').hide();
		$('#halamanpenghargaan').hide();
		$('#halamanseminar').hide();
		$('#halamansertifikasi').hide();
		$('#halamanangkakredit').hide();
		$('#halamandatabkd').hide();
		$('#halamanremun').hide();
		$('#halamanskp').hide();
		$('#halamanubahpassword').hide();
		$('#halamanmuka').hide();
		$('#halamanonline').show();
		$('#divtambahonline').hide();
		var set01=document.getElementById('id_prodi').value;
		var set02=document.getElementById('id_masterno').value;
		var token=document.getElementById('token').value;
		var sourcedetail = {
			datatype: "json",
			datafields: [
				{ name: 'id'},
				{ name: 'name',type: 'text'},
				{ name: 'size',type: 'text'},
				{ name: 'type',type: 'text'},
				{ name: 'url',type: 'text'},
				{ name: 'title',type: 'text'},
				{ name: 'description',type: 'text'},
				{ name: 'created_at',type: 'text'},
				{ name: 'updated_at',type: 'text'},
			],
			type: 'POST',
			data: {	val01:set01, val02:set02, _token: token },
			url:  '{{ route("jsonDataSyaratPelamar") }}',
		};
		var filerenderer = function (row, column, value) {
			var size      = $('#gridonline').jqxGrid('getrowdata', row).size;
			var filebukti = $('#gridonline').jqxGrid('getrowdata', row).title;
			var type      = $('#gridonline').jqxGrid('getrowdata', row).type;
			if (filebukti == ''){
				var linkbukti = '<div style="background: white;"></div>';
			} else {
				var linkbukti = '<div style="background: white;"><a href="/scan/files/'+filebukti+'" target="_blank" class="btn btn-primary btn-sm">Download</a></div>';
			}
			return linkbukti;
		}
        var fileterupload = function (row, column, value) {
			var filebukti = $('#gridonline').jqxGrid('getrowdata', row).description;
			if (filebukti == ''){
				var linkbukti = '<div style="background: white;"></div>';
			} else {
				var linkbukti = '<div style="background: white;"><a href="'+filebukti+'" target="_blank">'+filebukti+'</a></div>';
			}
			return linkbukti;
		}
		var datadetail = new $.jqx.dataAdapter(sourcedetail);
		$("#gridonline").jqxGrid({
			width: '100%',
			filterable: true,
			columnsresize: true,
			filtermode: 'excel',
			theme: "energyblue",
			sortable: true,
			autoheight: true,
			pageable: true,
			source: datadetail,
			selectionmode: 'multiplecellsextended',
			columns: [
				{ text: 'Nama Berkas Syarat', datafield: 'name', width: '50%', cellsalign: 'left', align: 'center'  },
				{ text: 'Kewajiban', datafield: 'type', width: '10%', align: 'center', cellsalign: 'center'},
				{ text: 'Template', cellsrenderer: filerenderer, width: '9%', align: 'center', cellsalign: 'center'},
				{ text: 'Status', cellsrenderer: fileterupload, width: '15%', align: 'center', cellsalign: 'center'},
				{ text: 'Upload', columntype: 'button', width: '8%', cellsalign: 'center', align: 'center', cellsrenderer: function () {
					return "Upload";
					}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridonline").offset();
						var dataRecord 	= $("#gridonline").jqxGrid('getrowdata', editrow);
						$("#berkas_nama").val(dataRecord.name);
						$("#berkas_idne").val(dataRecord.id);
						$("#berkas_file").val('');
						$('#berkas_file').next('label').html('Select a file');
						$('#divtambahonline').show();
					}
				},
				{ text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsalign: 'center', align: 'center', cellsrenderer: function () {
					return "Del";
					}, buttonclick: function (row) {
					editrow = row;	
					var offset 		= $("#gridonline").offset();		
					var dataRecord 	= $("#gridonline").jqxGrid('getrowdata', editrow);
					swal({
						title				: 'Apakah anda yakin ?',
						text				: "Perhatian, data yang sudah di hapus tidak bisa di Undo, apakah anda yakin ingin menghapus",
						type				: 'warning',
						showCancelButton	: true,
						confirmButtonClass	: 'btn btn-confirm mt-2',
						cancelButtonClass	: 'btn btn-cancel ml-2 mt-2',
						confirmButtonText	: 'Yes'
					}).then(function () {
						var val01		= dataRecord.url;
						var val02		= dataRecord.id;
						var token   	= document.getElementById('token').value;		
						$.post('{{ route("exInputBerkasPelamar") }}', { _token: token, set01: val01, set02: val02, set03: '', set04: '', set05: 'remove' },
						function(data){
							$.toast({
								heading: 'Info',
								text: data,
								position: 'top-right',
								loaderBg: '#bf441d',
								icon: 'success',
								hideAfter: 5000,
								stack: 1
							});
							$("#gridonline").jqxGrid('updatebounddata');
							return false;
						});
					});
					}
				},
			]
		});
	});
	$("#btnsimpanberkas").click(function(){
		var val01=document.getElementById('berkas_idne').value;
		var val05=document.getElementById('berkas_url').value;
		if (val05 == ''){
			swal({
				title	: 'Stop',
				text	: 'File URL Belum di isi',
				type	: 'warning',
			})
		} else {
			var form_data = new FormData();
				form_data.append('set01', val01);
				form_data.append('set02', val01);
				form_data.append('set03', val05);
				form_data.append('set04', '');
				form_data.append('set05', 'inputberkas');
				form_data.append('file', null);
				form_data.append('_token', '{{csrf_token()}}');
			$.ajax({
				url         : '{{ route("exInputBerkasPelamar") }}',
				data        : form_data,
				type        : 'POST',
				contentType : false,
				processData : false,
				success     : function (data) {
					$("#gridonline").jqxGrid('updatebounddata');
					$('#divtambahonline').hide(); 
					$.toast({
						heading: 'Info',
						text: data,
						position: 'top-right',
						loaderBg: '#bf441d',
						icon: 'success',
						hideAfter: 5000,
						stack: 1
					});
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
		}
    });
    $("#btnkembalidrtambahonline").click(function(){
		$('#divtambahonline').hide();
    });
	$("#updatebiodata").click(function(){
		var set01=document.getElementById('id_masterno').value;
		var set02=document.getElementById('id_nip').value;
		var set03=document.getElementById('id_nama').value;
		var set04=document.getElementById('id_tmplhr').value;
		var set05=document.getElementById('id_tgllhr').value;
		var set06=document.getElementById('id_ktp').value;
		var set07=document.getElementById('id_kelamin').value;
		var set08=document.getElementById('id_glrdepan').value;
		var set09=document.getElementById('id_glrblakang').value;
		var set10=document.getElementById('id_glrdepan').value;
		var set11=document.getElementById('id_glrblakang').value;
		var set12=document.getElementById('id_bidangilmu3').value;
		var set13=document.getElementById('id_alamatmlg').value;
		var set14=document.getElementById('id_alamatasal').value;
		var set15=document.getElementById('id_propinsi').value;
		var set16=document.getElementById('id_kota').value;
		var set17=document.getElementById('id_agama').value;
		var set18=document.getElementById('id_kawin').value;
		var set19='Pelamar'; //gantidaritelpon
		var set20=document.getElementById('id_hape').value;
		var set21="{{$biodata->email_ub}}";
		var set22=document.getElementById('id_emaillain').value; //gantidariemaillain
		var set23="{{$biodata->unit_kerja}}";
		var set24="{{$biodata->lab}}";
		var set25="{{$biodata->status}}";
		var set26='Pelamar';
		var set27="{{$biodata->nidn}}";
		var set28="{{$biodata->thn_masuk}}";
		var set29="{{$biodata->tmt_cpns}}";
		var set30="{{$biodata->cpns}}";
		var set31="{{$biodata->pns}}";
		var set32="{{$biodata->tmt_pns}}";
		var set33=document.getElementById('id_jenis').value;
		var set34="{{$biodata->nip_lama}}";
		var set35="{{$biodata->karpeg}}";
		var set36="{{$biodata->nira}}";
		var set37=document.getElementById('id_npwp').value;
		var set38=document.getElementById('id_bpjs').value;
		var set39="{{$biodata->program_studi}}";
		var set40=document.getElementById('id_kelurahan').value;
		var set41=document.getElementById('id_kecamatan').value;
		var set42="{{$biodata->jab_fungsional}}";
		var set43="{{$biodata->pangkat}}";
		var set44="{{$biodata->tmt_golongan}}";
		var set45="{{$biodata->tmt_jabatan}}";
		var set46="{{$biodata->jabatan}}";
		var set47="{{$biodata->tmt_fungsional}}";
		var set48="{{$biodata->kode}}";
		var set49=document.getElementById('id_tinggibdn').value;
		var set50=document.getElementById('id_beratbdn').value;
		var set51=document.getElementById('id_warnakulit').value;
		var set52=document.getElementById('id_rambut').value;
		var set53=document.getElementById('id_muka').value;
		var set54=document.getElementById('id_cirikusus').value;
		var set55=document.getElementById('id_cacattubuh').value;
		var set56=document.getElementById('id_hobi').value;
		var set57=document.getElementById('id_kepakaran').value; // Ganti dari kepakaran
		var set58="{{$biodata->nokk}}";
		var set59=document.getElementById('id_bidangilmu3').value;
		var set60=document.getElementById('id_fotoprofile');
		var set61="";
		var set62="{{$biodata->gajisesuaisk}}";
		var set63="{{$biodata->tmtgaji}}";
		var set64="{{$biodata->ppabp}}";
		var set65=document.getElementById('id_tandatangan');
		var token= document.getElementById('token').value;
		if (set03 == '' || set21 == ''){
			swal({
				title	: 'Stop',
				text	: 'Data Wajib Nama dan Email Minimal Terisi',
				type	: 'warning',
			})
		} else {
			var form_data 	= new FormData();
				form_data.append('file', set60.files[0]);
				form_data.append('filettd', set65.files[0]);
				form_data.append('val01', set01);
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
				form_data.append('val17', set17);
				form_data.append('val18', set18);
				form_data.append('val19', set19);
				form_data.append('val20', set20);
				form_data.append('val21', set21);
				form_data.append('val22', set22);
				form_data.append('val23', set23);
				form_data.append('val24', set24);
				form_data.append('val25', set25);
				form_data.append('val26', set26);
				form_data.append('val27', set27);
				form_data.append('val28', set28);
				form_data.append('val29', set29);
				form_data.append('val30', set30);
				form_data.append('val31', set31);
				form_data.append('val32', set32);
				form_data.append('val33', set33);
				form_data.append('val34', set34);
				form_data.append('val35', set35);
				form_data.append('val36', set36);
				form_data.append('val37', set37);
				form_data.append('val38', set38);
				form_data.append('val39', set39);
				form_data.append('val40', set40);
				form_data.append('val41', set41);
				form_data.append('val42', set42);
				form_data.append('val43', set43);
				form_data.append('val44', set44);
				form_data.append('val45', set45);
				form_data.append('val46', set46);
				form_data.append('val47', set47);
				form_data.append('val48', set48);
				form_data.append('val49', set49);
				form_data.append('val50', set50);
				form_data.append('val51', set51);
				form_data.append('val52', set52);
				form_data.append('val53', set53);
				form_data.append('val54', set54);
				form_data.append('val55', set55);
				form_data.append('val56', set56);
				form_data.append('val57', set57);
				form_data.append('val58', set58);
				form_data.append('val59', set59);
				form_data.append('val60', set60);
				form_data.append('val61', set61);
				form_data.append('val62', set62);
				form_data.append('val63', set63);
				form_data.append('val64', set64);
				form_data.append('val65', document.getElementById('id_nomoridi').value);
				form_data.append('val66', document.getElementById('id_keanggotaanprofesi').value);
				form_data.append('val67', document.getElementById('id_nomorstr').value);
				form_data.append('val68', document.getElementById('id_nomorsip1').value);
				form_data.append('val69', document.getElementById('id_nomorsip2').value);
				form_data.append('val70', document.getElementById('id_nomorsip3').value);
				form_data.append('val71', document.getElementById('id_google').value);
				form_data.append('val72', document.getElementById('id_shinta').value);
				form_data.append('val73', document.getElementById('id_scopus').value);
				form_data.append('val74', document.getElementById('id_orcid').value);
				form_data.append('_token', '{{csrf_token()}}');
			$.ajax({
				url: '{{ route("simpanDatadiri") }}',
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
					$('#divtambahpegawai').hide();
					$('.divgrafik').show();
					$('.divawal').show();
					$('.divtabel').show();
					$('#table_list').dataTable().fnDraw();
	
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
		}
	});
	$('#btnkirimpassword').click(function () {
        var set01=document.getElementById('lupa_password1').value;
        var set02=document.getElementById('lupa_password2').value;
        var set03=document.getElementById('id_emaillain').value;
        var token=document.getElementById('token').value;
        if (set01 == ''){
            swal({
                title: 'Mohon lengkapi',
                text: 'Email Aktif Wajib di Isi',
                type: 'info',
            });
        } else {
            var formdata = new FormData();
                formdata.set('email','setpassword');
                formdata.set('val02',set01);
                formdata.set('val03',set02);
                formdata.set('val04',set03);
                formdata.set('_token',token);
            url='{{ route("exResetPassword") }}';
            $.ajax({
                type        : 'ajax',
                url         : url,
                method      : 'post',
                data        : formdata,
                cache       : false,
                contentType : false,
                processData : false,
                dataType    : 'json',
                success: function(response, status, xhr) {
                    swal({
                        title: 'Info',
                        text: response.message,
                        type: 'info',
                    });
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal({
                        title: textStatus,
                        text:  errorThrown,
                        type: 'info',
                    });
                }
            });
        }
    });
	$('#btnubahpassword').click(function () {
		$('#halamanubahpassword').show();
		$('#halamandataajar').hide();
		$('#halamandataasesor').hide();
		$('#halamandatabkd').hide();
		$('#halamandiklat').hide();
		$('#halamanfungsional').hide();
		$('#halamangaji').hide();
		$('#halamanidentitas').hide();
		$('#halamankeluarga').hide();
		$('#halamanevaluasikinerja').hide();
		$('#halamanonline').hide();
		$('#halamanmuka').hide();
		$('#halamanmutasi').hide();
		$('#halamanorganisasi').hide();
		$('#halamanpangkat').hide();
		$('#halamanpendidikan').hide();
		$('#halamanpenghargaan').hide();
		$('#halamanseminar').hide();
		$('#halamansertifikasi').hide();
		$('#halamanangkakredit').hide();
		$('#halamandatabkd').hide();
		$('#halamanremun').hide();
		$('#halamanskp').hide();
	});
//tombol-tombol di modal identitas
	$("#btnnewidentitas").click(function(){ 
		$("#identitas_idne").val('tambah');
		$('#divupdateidentitas').hide(); 
		$('#modaladddataidentitas').show();
	});
	$("#btnexportidentitas").click(function () {
		var gridContent = $("#grididentitas").jqxGrid('exportdata', 'html');
		$('#tabel_cetak').html(gridContent);		
		$("#tabel_cetak").btechco_excelexport({
			containerid: "tabel_cetak"
			, datatype: $datatype.Table
		});
	});
	$('#btnsimpandataidentitas').on('click', function (){	
		var set01=document.getElementById('id_masterno').value;
		var set02=document.getElementById('identitas_jenis').value;
		var set03=document.getElementById('identitas_aktif').value;
		var set04=document.getElementById('identitas_nomer').value;
		var set05=document.getElementById('identitas_idne').value;
		var set06=document.getElementById('identitas_idne').value;
		var filee=document.getElementById('identitas_url').value;
		if (filee == ''){
			swal({
				title	: 'Stop',
				text	: 'Mohon Upload Filenya terlebih dahulu',
				type	: 'warning',
			})
        } else if (set02 == '' || set03 == '' || set04 == '' || set05 == '' || set06 == ''){ 
			swal({
				title	: 'Stop',
				text	: 'Semua Form Di Isi, Apabila tidak ada data diberi tanda strip (-) ',
				type	: 'warning',
			})
		} else {
			var form_data = new FormData();
				form_data.append('file', null);
				form_data.append('val01', set01);
				form_data.append('val02', set02);
				form_data.append('val03', set03);
				form_data.append('val04', set04);
				form_data.append('val05', set05);
				form_data.append('val06', set06);
				form_data.append('val07', filee);
				form_data.append('_token', '{{csrf_token()}}');
			$.ajax({
				url			: '{{ route("exdataIdentitas") }}',
				data		: form_data,
				type		: 'POST',
				contentType	: false,
				processData	: false,
				success		: function (data) {
					$.toast({
						heading		: 'Info',
						text		: data,
						position	: 'top-right',
						loaderBg	: '#bf441d',
						icon		: 'success',
						hideAfter	: 5000,
						stack		: 1
					});
					$('#divupdateidentitas').show();
					$('#modaladddataidentitas').hide();
					$("#grididentitas").jqxGrid('updatebounddata');
					return false;
				},
				error: function (xhr, status, error) {
					swal({
						title: status,
						text:  xhr.responseText,
						type: 'info',
					});
				}
			});
		}
	});
	$('#btnkembalidrtambahidentitas').on('click', function (){	
		$('#divupdateidentitas').show();
		$('#modaladddataidentitas').hide();
		$("#grididentitas").jqxGrid('updatebounddata');
	});
	$('#btnriwayatdiri').click(function () {
		$('#halamandataajar').hide();
		$('#halamandataasesor').hide();
		$('#halamandatabkd').hide();
		$('#halamandiklat').hide();
		$('#halamanfungsional').hide();
		$('#halamangaji').hide();
		$('#halamanidentitas').show();
		$('#divupdateidentitas').show();
		$('#modaladddataidentitas').hide();
		$('#halamankeluarga').hide();
		$('#halamanevaluasikinerja').hide();
		$('#halamanonline').hide();
		$('#halamanmuka').hide();
		$('#halamanubahpassword').hide();
		$('#halamanmutasi').hide();
		$('#halamanorganisasi').hide();
		$('#halamanpangkat').hide();
		$('#halamanpendidikan').hide();
		$('#halamanpenghargaan').hide();
		$('#halamanseminar').hide();
		$('#halamansertifikasi').hide();
		$('#halamanangkakredit').hide();
		$('#halamandatabkd').hide();
		$('#halamanremun').hide();
		$('#halamanskp').hide();
		$('#divupdateorganisasi').hide();
		$('#divtambahorganisasi').hide();
		var set01	= document.getElementById('id_masterno').value;	
		var source 	= {
			datatype: "json",
			datafields: [
				{ name: 'id'},
				{ name: 'no'},
				{ name: 'aktif',type: 'text'},
				{ name: 'jenisid',type: 'text'},
				{ name: 'nomer',type: 'text'},
				{ name: 'nama',type: 'text'},
				{ name: 'nip',type: 'text'},
				{ name: 'bukti',type: 'text'},
			],
			type: 'POST',
			data: {_token: '{{csrf_token()}}', val01:set01},
			url: '{{ route("jsondataIdentitas") }}'
		};
		var dataAdapter = new $.jqx.dataAdapter(source);
		$("#grididentitas").jqxGrid({
			width: '100%',
			source: dataAdapter,
			columnsresize: true,
			theme: "energyblue",
			autoheight: true,
			selectionmode: 'multiplecellsextended',
			columns: [
				{ text: 'Jenis', datafield: 'jenisid', width: '30%', align: 'center', cellsalign: 'left'},
				{ text: 'Aktif', datafield: 'aktif', width: '15%', cellsalign: 'left', align: 'center'  },
				{ text: 'Keterangan', datafield: 'nomer', width: '25%', cellsalign: 'left', align: 'center' },
				{ text: 'File Upload', align: 'center', cellsalign: 'center',  width: '15%', datafield: 'bukti' },
				{ text: 'Edit', columntype: 'button', width: '7%', align: 'center', cellsrenderer: function () {
					return "Edit";
					}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#grididentitas").offset();
						var dataRecord 	= $("#grididentitas").jqxGrid('getrowdata', editrow);
						$("#identitas_aktif").val(dataRecord.aktif);
						$("#identitas_jenis").val(dataRecord.jenisid);
						$("#identitas_nomer").val(dataRecord.nomer);
						$("#identitas_idne").val(dataRecord.id);
						$("#identitas_url").val(dataRecord.bukti);
						$('#divupdateidentitas').hide(); 
						$('#modaladddataidentitas').show();
					}
				},
				{ text: 'Del', editable: false, sortable: false, filterable: false, align: 'center', columntype: 'button', width: '8%', cellsrenderer: function () {
					return "Del";
					}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#grididentitas").offset();		
						var dataRecord 	= $("#grididentitas").jqxGrid('getrowdata', editrow);
						swal({
							title				: 'Apakah anda yakin ?',
							text				: "Perhatian, data yang sudah di hapus tidak bisa di Undo, apakah anda yakin ingin menghapus",
							type				: 'warning',
							showCancelButton	: true,
							confirmButtonClass	: 'btn btn-confirm mt-2',
							cancelButtonClass	: 'btn btn-cancel ml-2 mt-2',
							confirmButtonText	: 'Yes'
						}).then(function () {
							var form_data = new FormData();
								form_data.append('file', null);
								form_data.append('val01', dataRecord.no);
								form_data.append('val02', '');
								form_data.append('val03', '');
								form_data.append('val04', '');
								form_data.append('val05', 'hapus');
								form_data.append('val06', dataRecord.id);
								form_data.append('_token', '{{csrf_token()}}');
							$.ajax({
								url: '{{ route("exdataIdentitas") }}',
								data: form_data,
								type: 'POST',
								contentType: false,
								processData: false,
								success: function (data) {
									$.toast({
										heading: 'Info',
										text: data,
										position: 'top-right',
										loaderBg: '#bf441d',
										icon: 'success',
										hideAfter: 5000,
										stack: 1
									});
									$('#divupdateidentitas').show();
									$('#modaladddataidentitas').hide();
									$("#grididentitas").jqxGrid('updatebounddata');
									return false;
								},
								error: function (xhr, status, error) {
									swal({
										title: status,
										text:  xhr.responseText,
										type: 'info',
									});
								}
							});
						});
					}
				},
			],
		});
	});
//batas tombol di modal organisasi
//tombol-tombol di modal organisasi
	$("#btnneworganisasi").click(function(){ 
		$("#organisasi_id").val('tambah'); 
		$("#organisasi_url").val('');
		$('#divupdateorganisasi').hide(); 
		$('#divtambahorganisasi').show();
	});
	$("#btnexportorganisasi").click(function () {
		var gridContent = $("#gridorganisasi").jqxGrid('exportdata', 'html');
		$('#tabel_cetak').html(gridContent);		
		$("#tabel_cetak").btechco_excelexport({
			containerid: "tabel_cetak"
			, datatype: $datatype.Table
		});
	});
	$('#btnsimpandataorganisasi').on('click', function (){	
		var set01=document.getElementById('id_masterno').value;
		var set02=document.getElementById('organisasi_jabpejabat').value;
		var set03=document.getElementById('organisasi_kedudukan').value;
		var set04=document.getElementById('organisasi_mulai').value;
		var set05=document.getElementById('organisasi_nama').value;
		var set06=document.getElementById('organisasi_namapejabat').value;
		var set07=document.getElementById('organisasi_nippejabat').value;
		var set08=document.getElementById('organisasi_nosk').value;
		var set09=document.getElementById('organisasi_selesai').value;
		var set10=document.getElementById('organisasi_id').value;
		var filee=document.getElementById('organisasi_url').value;
		if (set02 == '' || set03 == '' || set04 == '' || set05 == '' || set05 == '' || set06 == '' || set07 == '' || set08 == '' || set09 == ''){ 
			swal({
				title	: 'Stop',
				text	: 'Semua Form Di Isi, Apabila tidak ada data diberi tanda strip (-) ',
				type	: 'warning',
			})
		} else {
			var form_data = new FormData();
				form_data.append('file', null);
				form_data.append('val01', set01);
				form_data.append('val02', set02);
				form_data.append('val03', set03);
				form_data.append('val04', set04);
				form_data.append('val05', set05);
				form_data.append('val06', set06);
				form_data.append('val07', set07);
				form_data.append('val08', set08);
				form_data.append('val09', set09);
				form_data.append('val10', set10);
				form_data.append('val11', set10);
				form_data.append('val12', filee);
				form_data.append('_token', '{{csrf_token()}}');
			$.ajax({
				url: '{{ route("exDataorganisasi") }}',
				data: form_data,
				type: 'POST',
				contentType: false,
				processData: false,
				success: function (data) {
					$.toast({
						heading: 'Info',
						text: data,
						position: 'top-right',
						loaderBg: '#bf441d',
						icon: 'success',
						hideAfter: 5000,
						stack: 1
					});
					$('#divupdateorganisasi').show();
					$('#divtambahorganisasi').hide();
					$("#gridorganisasi").jqxGrid('updatebounddata');
					return false;
				},
				error: function (xhr, status, error) {
					swal({
						title: status,
						text:  xhr.responseText,
						type: 'info',
					});
				}
			});
		}
	});
	$('#btnkembalidrtambahorganisasi').on('click', function (){	
		$('#divupdateorganisasi').show();
		$('#divtambahorganisasi').hide();
	});
	$('#btnriwayatorganisasi').click(function () {
		$('#halamandataajar').hide();
		$('#halamandataasesor').hide();
		$('#halamandatabkd').hide();
		$('#halamandiklat').hide();
		$('#halamanfungsional').hide();
		$('#halamangaji').hide();
		$('#halamanidentitas').hide();
		$('#halamankeluarga').hide();
		$('#halamanevaluasikinerja').hide();
		$('#halamanonline').hide();
		$('#halamanmuka').hide();
		$('#halamanubahpassword').hide();
		$('#halamanmutasi').hide();
		$('#halamanorganisasi').show();
		$('#halamanpangkat').hide();
		$('#halamanpendidikan').hide();
		$('#halamanpenghargaan').hide();
		$('#halamanseminar').hide();
		$('#halamansertifikasi').hide();
		$('#halamanangkakredit').hide();
		$('#halamandatabkd').hide();
		$('#halamanremun').hide();
		$('#halamanskp').hide();
		$('#divupdateorganisasi').show();
		$('#divtambahorganisasi').hide();
		var set01	= document.getElementById('id_masterno').value;	
		var source 	= {
			datatype: "json",
			datafields: [
				{ name: 'id'},
				{ name: 'no'},
				{ name: 'nama',type: 'text'},
				{ name: 'nip',type: 'text'},
				{ name: 'namaorganisasi',type: 'text'},
				{ name: 'kedudukan',type: 'text'},
				{ name: 'nosk',type: 'text'},
				{ name: 'mulai',type: 'text'},
				{ name: 'selesai',type: 'text'},
				{ name: 'namapejabat',type: 'text'},
				{ name: 'jabpejabat',type: 'text'},
				{ name: 'nippejabat',type: 'text'},
				{ name: 'bukti',type: 'text'},
			],
			type: 'POST',
			data: {_token: '{{csrf_token()}}', val01:set01},
			url: '{{ route("jsonDataorganisasi") }}'
		};
		var dataAdapter = new $.jqx.dataAdapter(source);
		$("#gridorganisasi").jqxGrid({
			width: '100%',
			source: dataAdapter,
			columnsresize: true,
			theme: "energyblue",
			autoheight: true,
			selectionmode: 'multiplecellsextended',
			columns: [
				{ text: 'Nama Organisasi', datafield: 'namaorganisasi', width: '15%', cellsalign: 'left', align: 'center'  },
				{ text: 'Kedudukan', datafield: 'kedudukan', width: '15%', cellsalign: 'left', align: 'center'  },
				{ text: 'No. SK', datafield: 'nosk', width: '15%', align: 'center', cellsalign: 'left'},
				{ text: 'Mulai', datafield: 'mulai', width: '10%', cellsalign: 'left', align: 'center' },
				{ text: 'Selesai', datafield: 'selesai', width: '10%', cellsalign: 'left', align: 'center' },
				{ text: 'Nama Pejabat', datafield: 'namapejabat', width: '10%', cellsalign: 'left', align: 'center'  },
				{ text: 'Jabatan', datafield: 'jabpejabat', width: '10%', cellsalign: 'left', align: 'center'  },
				{ text: 'NIP', datafield: 'nippejabat', width: '10%', cellsalign: 'left', align: 'center'  },
				{ text: 'File Upload', align: 'center', cellsalign: 'center',  width: '10%', datafield: 'bukti' },
				{ text: 'Edit', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
					return "Edit";
					}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridorganisasi").offset();
						var dataRecord 	= $("#gridorganisasi").jqxGrid('getrowdata', editrow);
						$("#organisasi_id").val(dataRecord.id);
						$("#organisasi_jabpejabat").val(dataRecord.jabpejabat);
						$("#organisasi_kedudukan").val(dataRecord.kedudukan);
						$("#organisasi_mulai").val(dataRecord.mulai);
						$("#organisasi_nama").val(dataRecord.namaorganisasi);
						$("#organisasi_namapejabat").val(dataRecord.namapejabat);
						$("#organisasi_nippejabat").val(dataRecord.nippejabat);
						$("#organisasi_nosk").val(dataRecord.nosk);
						$("#organisasi_selesai").val(dataRecord.selesai);
						$("#organisasi_url").val(dataRecord.bukti);
						$('#divupdateorganisasi').hide(); 
						$('#divtambahorganisasi').show();
					}
				},
				{ text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsrenderer: function () {
					return "Del";
					}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridorganisasi").offset();		
						var dataRecord 	= $("#gridorganisasi").jqxGrid('getrowdata', editrow);
						swal({
							title				: 'Apakah anda yakin ?',
							text				: "Perhatian, data yang sudah di hapus tidak bisa di Undo, apakah anda yakin ingin menghapus",
							type				: 'warning',
							showCancelButton	: true,
							confirmButtonClass	: 'btn btn-confirm mt-2',
							cancelButtonClass	: 'btn btn-cancel ml-2 mt-2',
							confirmButtonText	: 'Yes'
						}).then(function () {
							var set01		= dataRecord.no;
							var set11		= dataRecord.id;
							var token   	= document.getElementById('token').value;		
							$.post('{{ route("exDataorganisasi") }}', { _token: token, val01: set01, val10: 'hapus', val11: set11 },
							function(data){
								$.toast({
									heading: 'Info',
									text: data,
									position: 'top-right',
									loaderBg: '#bf441d',
									icon: 'success',
									hideAfter: 5000,
									stack: 1
								});
								$("#gridorganisasi").jqxGrid('updatebounddata');
								return false;
							});
						});
					}
				},
			],
		});
	});
//batas tombol di modal organisasi
//tombol-tombol di modal keluarga
	$("#btnnewkeluarga").click(function(){ 
		$("#keluarga_idne").val('tambah'); 
		$('#divupdatekeluarga').hide();
		$('#divtambahkeluarga').show();
	});
	$("#btnexportkeluarga").click(function () {
		var gridContent = $("#gridkeluarga").jqxGrid('exportdata', 'html');
		$('#tabel_cetak').html(gridContent);		
		$("#tabel_cetak").btechco_excelexport({
			containerid: "tabel_cetak"
			, datatype: $datatype.Table
		});
	});
	$("#btnkembalidrtambahkeluarga").click(function () {
		$('#divupdatekeluarga').show();
		$('#divtambahkeluarga').hide();
	});
	$('#btnsimpandatakeluarga').on('click', function (){	
		var set01=document.getElementById('id_masterno').value;
		var set02=document.getElementById('keluarga_alamat').value;
		var set03=document.getElementById('keluarga_hubklg').value;
		var set04=document.getElementById('keluarga_jenjang').value;
		var set05=document.getElementById('keluarga_nama').value;
		var set06=document.getElementById('keluarga_pekerjaan').value;
		var set07=document.getElementById('keluarga_status').value;
		var set08=document.getElementById('keluarga_tempatlahir').value;
		var set09=document.getElementById('keluarga_tgllahir').value;
		var set10=document.getElementById('keluarga_idne').value;
		var set12=document.getElementById('keluarga_kelamin').value;
		var set13=document.getElementById('keluarga_tglmenikah').value;
		var set16=document.getElementById('keluarga_url').value;
		var set15=document.getElementById('keluarga_nik').value;
		if (set02 == '' || set03 == '' || set04 == '' || set05 == '' || set05 == '' || set06 == '' || set08 == '' || set09 == '' || set10 == ''){ 
			swal({
				title	: 'Stop',
				text	: 'Semua Form Di Isi, Apabila tidak ada data diberi tanda strip (-) ',
				type	: 'warning',
			})
		} else {
			var form_data = new FormData();
				form_data.append('file', null);
				form_data.append('val01', set01);
				form_data.append('val02', set02);
				form_data.append('val03', set03);
				form_data.append('val04', set04);
				form_data.append('val05', set05);
				form_data.append('val06', set06);
				form_data.append('val07', set07);
				form_data.append('val08', set08);
				form_data.append('val09', set09);
				form_data.append('val10', set10);
				form_data.append('val11', set10);
				form_data.append('val12', set12);
				form_data.append('val13', set13);
				form_data.append('val15', set15);
				form_data.append('val16', set16);
				form_data.append('_token', '{{csrf_token()}}');
			$.ajax({
				url: '{{ route("exDatakeluarga") }}',
				data: form_data,
				type: 'POST',
				contentType: false,
				processData: false,
				success: function (data) {
					$.toast({
						heading: 'Info',
						text: data,
						position: 'top-right',
						loaderBg: '#bf441d',
						icon: 'success',
						hideAfter: 5000,
						stack: 1
					});
					$('#divupdatekeluarga').show();
					$('#divtambahkeluarga').hide();
					$("#gridkeluarga").jqxGrid('updatebounddata');
					return false;
				},
				error: function (xhr, status, error) {
					swal({
						title: status,
						text:  xhr.responseText,
						type: 'info',
					});
				}
			});
		}
	});
	$('#btnriwayatkeluarga').click(function () {
		$('#divupdatekeluarga').show();
		$('#divtambahkeluarga').hide();
		$('#halamandataajar').hide();
		$('#halamandataasesor').hide();
		$('#halamandatabkd').hide();
		$('#halamandiklat').hide();
		$('#halamanfungsional').hide();
		$('#halamangaji').hide();
		$('#halamanidentitas').hide();
		$('#halamankeluarga').show();
		$('#halamanevaluasikinerja').hide();
		$('#halamanonline').hide();
		$('#halamanmuka').hide();
		$('#halamanubahpassword').hide();
		$('#halamanmutasi').hide();
		$('#halamanorganisasi').hide();
		$('#halamanpangkat').hide();
		$('#halamanpendidikan').hide();
		$('#halamanpenghargaan').hide();
		$('#halamanseminar').hide();
		$('#halamansertifikasi').hide();
		$('#halamanangkakredit').hide();
		$('#halamandatabkd').hide();
		$('#halamanremun').hide();
		$('#halamanskp').hide();
		var set01	= document.getElementById('id_masterno').value;	
		var source 	= {
			datatype: "json",
			datafields: [
				{ name: 'id'},
				{ name: 'no'},
				{ name: 'nama',type: 'text'},
				{ name: 'kelamin',type: 'text'},
				{ name: 'tglmenikah',type: 'text'},
				{ name: 'hubklg',type: 'text'},
				{ name: 'alamat',type: 'text'},
				{ name: 'jenjang',type: 'text'},
				{ name: 'pekerjaan',type: 'text'},
				{ name: 'status',type: 'text'},
				{ name: 'tgllahir',type: 'text'},
				{ name: 'tmplahir',type: 'text'},
				{ name: 'nik',type: 'text'},
				{ name: 'bukti',type: 'text'},
			],
			type: 'POST',
			data: {_token: '{{csrf_token()}}', val01:set01},
			url: '{{ route("jsonDatakeluarga") }}'
		};
		var dataAdapter = new $.jqx.dataAdapter(source);
		$("#gridkeluarga").jqxGrid({
			width: '100%',
			source: dataAdapter,
			columnsresize: true,
			theme: "energyblue",
			autoheight: true,
			selectionmode: 'multiplecellsextended',
			columns: [
				{ text: 'Nama', datafield: 'nama', width: '20%', cellsalign: 'left', align: 'center'  },
				{ text: 'Hub.Keluarga', datafield: 'hubklg', width: '15%', cellsalign: 'left', align: 'center'  },
				{ text: 'Kelamin', datafield: 'kelamin', width: '15%', cellsalign: 'left', align: 'center'  },
				{ text: 'Tempat Lahir', datafield: 'tmplahir', width: '15%', align: 'center', cellsalign: 'left'},
				{ text: 'Tgl.Lahir', datafield: 'tgllahir', width: '10%', cellsalign: 'left', align: 'center' },
				{ text: 'Tgl.Menikah', datafield: 'tglmenikah', width: '10%', cellsalign: 'left', align: 'center' },
				{ text: 'Pekerjaan', datafield: 'pekerjaan', width: '10%', cellsalign: 'left', align: 'center' },
				{ text: 'Pendidikan', datafield: 'jenjang', width: '10%', cellsalign: 'left', align: 'center'  },
				{ text: 'Status', datafield: 'status', width: '10%', cellsalign: 'left', align: 'center'  },
				{ text: 'NIK', datafield: 'nik', width: '10%', cellsalign: 'left', align: 'center'  },
				{ text: 'File Upload', datafield: 'bukti', align: 'center', cellsalign: 'center',  width: '10%' },
				{ text: 'Edit', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
					return "Edit";
					}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridkeluarga").offset();
						var dataRecord 	= $("#gridkeluarga").jqxGrid('getrowdata', editrow);
						$("#keluarga_alamat").val(dataRecord.alamat);
						$("#keluarga_hubklg").val(dataRecord.hubklg);
						$("#keluarga_kelamin").val(dataRecord.kelamin);
						$("#keluarga_tglmenikah").val(dataRecord.tglmenikah);
						$("#keluarga_idne").val(dataRecord.id);
						$("#keluarga_jenjang").val(dataRecord.jenjang);
						$("#keluarga_nama").val(dataRecord.nama);
						$("#keluarga_pekerjaan").val(dataRecord.pekerjaan);
						$("#keluarga_status").val(dataRecord.status);
						$("#keluarga_tempatlahir").val(dataRecord.tmplahir);
						$("#keluarga_tgllahir").val(dataRecord.tgllahir);
						$("#keluarga_nik").val(dataRecord.nik);
						$("#keluarga_url").val(dataRecord.bukti); 
						$('#divupdatekeluarga').hide();
						$('#divtambahkeluarga').show();
					}
				},
				{ text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsrenderer: function () {
					return "Del";
					}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridkeluarga").offset();		
						var dataRecord 	= $("#gridkeluarga").jqxGrid('getrowdata', editrow);
						swal({
							title				: 'Apakah anda yakin ?',
							text				: "Perhatian, data yang sudah di hapus tidak bisa di Undo, apakah anda yakin ingin menghapus",
							type				: 'warning',
							showCancelButton	: true,
							confirmButtonClass	: 'btn btn-confirm mt-2',
							cancelButtonClass	: 'btn btn-cancel ml-2 mt-2',
							confirmButtonText	: 'Yes'
						}).then(function () {
							var set01		= dataRecord.no;
							var set11		= dataRecord.id;
							var token   	= document.getElementById('token').value;		
							$.post('{{ route("exDatakeluarga") }}', { _token: token, val01: set01, val10: 'hapus', val11: set11 },
							function(data){
								$.toast({
									heading: 'Info',
									text: data,
									position: 'top-right',
									loaderBg: '#bf441d',
									icon: 'success',
									hideAfter: 5000,
									stack: 1
								});
								$("#gridkeluarga").jqxGrid('updatebounddata');
								return false;
							});
						});
					}
				},
			],
			});
		});
//batas tombol di modal keluarga
//tombol-tombol di modal pendidikan
	$("#btnnewpendidikan").click(function(){
		$('#pendidikan_idne').val('tambah');
		$('#divupdatependidikan').hide(); 
		$('#divtambahpendidikan').show(); 
	});
	$('#btnkembalidrtambahpendidikan').on('click', function (){	
		$('#divupdatependidikan').show(); 
		$('#divtambahpendidikan').hide();
	});
	$("#btnexportpendidikan").click(function () {
		var gridContent = $("#gridpendidikan").jqxGrid('exportdata', 'html');
		$('#tabel_cetak').html(gridContent);		
		$("#tabel_cetak").btechco_excelexport({
			containerid: "tabel_cetak"
			, datatype: $datatype.Table
		});
	});
	$('#btnsimpandatapendidikan').on('click', function (){	
		var set01=document.getElementById('id_masterno').value;
		var set02=document.getElementById('pendidikan_jenjang').value;
		var set03=document.getElementById('pendidikan_keterangan').value;
		var set04=document.getElementById('pendidikan_lulus').value;
		var set05=document.getElementById('pendidikan_minat').value;
		var set06=document.getElementById('pendidikan_negara').value;
		var set07=document.getElementById('pendidikan_noijasah').value;
		var set08=document.getElementById('pendidikan_sekolah').value;
		var set09=document.getElementById('pendidikan_status').value;
		var set10=document.getElementById('pendidikan_tahun').value;
		var set11=document.getElementById('pendidikan_tglijasah').value;
		var set12=document.getElementById('pendidikan_idne').value;
		var set14=document.getElementById('pendidikan_url').value;
		if (set14 == '' && set12 == 'tambah'){
			swal({
				title	: 'Stop',
				text	: 'Mohon Upload Filenya terlebih dahulu',
				type	: 'warning',
			})
        } else if (set02 == '' || set03 == '' || set04 == '' || set05 == '' || set05 == '' || set06 == '' || set07 == '' || set08 == '' || set09 == '' || set10 == '' || set11 == ''){ 
			swal({
				title	: 'Stop',
				text	: 'Semua Form Di Isi, Apabila tidak ada data diberi tanda strip (-) ',
				type	: 'warning',
			})
		} else {
			var form_data = new FormData();
				form_data.append('file', null);
				form_data.append('val01', set01);
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
				form_data.append('val13', set12);
				form_data.append('val14', set14);
				form_data.append('_token', '{{csrf_token()}}');
			$.ajax({
				url: '{{ route("exdataPendidikan") }}',
				data: form_data,
				type: 'POST',
				contentType: false,
				processData: false,
				success: function (data) {
					$.toast({
						heading: 'Info',
						text: data,
						position: 'top-right',
						loaderBg: '#bf441d',
						icon: 'success',
						hideAfter: 5000,
						stack: 1
					});
					$('#divupdatependidikan').show();
					$('#divtambahpendidikan').hide();
					$("#gridpendidikan").jqxGrid('updatebounddata');
					return false;
				},
				error: function (xhr, status, error) {
					swal({
						title: status,
						text:  xhr.responseText,
						type: 'info',
					});
				}
			});
		}
	});
	$('#btnriwayatpendidikan').click(function () {
		$('#halamandataajar').hide();
		$('#halamandataasesor').hide();
		$('#halamandatabkd').hide();
		$('#halamandiklat').hide();
		$('#halamanfungsional').hide();
		$('#halamangaji').hide();
		$('#halamanidentitas').hide();
		$('#halamankeluarga').hide();
		$('#halamanevaluasikinerja').hide();
		$('#halamanonline').hide();
		$('#halamanmuka').hide();
		$('#halamanubahpassword').hide();
		$('#halamanmutasi').hide();
		$('#halamanorganisasi').hide();
		$('#halamanpangkat').hide();
		$('#halamanpendidikan').show();
		$('#halamanpenghargaan').hide();
		$('#halamanseminar').hide();
		$('#halamansertifikasi').hide();
		$('#halamanangkakredit').hide();
		$('#halamandatabkd').hide();
		$('#halamanremun').hide();
		$('#halamanskp').hide();
		$('#divupdatependidikan').show(); 
		$('#divtambahpendidikan').hide(); 
	
		var set01	= document.getElementById('id_masterno').value;
		var token	= document.getElementById('token').value;
		var source  = {
			datatype: "json",
			datafields: [
				{ name: 'id'},
				{ name: 'no'},
				{ name: 'nama',type: 'text'},
				{ name: 'nip',type: 'text'},
				{ name: 'jenjang',type: 'text'},
				{ name: 'sekolah',type: 'text'},
				{ name: 'negara',type: 'text'},
				{ name: 'minat',type: 'text'},
				{ name: 'tahunmsk',type: 'text'},
				{ name: 'status',type: 'text'},
				{ name: 'tmtlulus',type: 'text'},
				{ name: 'noijasah',type: 'text'},
				{ name: 'tglijasah',type: 'text'},
				{ name: 'keterangan',type: 'text'},
				{ name: 'bukti',type: 'text'},
			],
			type: 'POST',
			data: {_token: token, val01:set01},
			url: '{{ route("jsondatPpendidikan") }}'
		};
		var dataAdapter = new $.jqx.dataAdapter(source);
		var editrow = -1;
		$("#gridpendidikan").jqxGrid({
			width: '100%',
			source: dataAdapter,
			columnsresize: true,
			theme: "energyblue",
			autoheight: true,
			selectionmode: 'multiplecellsextended',
			columns: [
				{ text: 'Jenjang', datafield: 'jenjang', width: 80, cellsalign: 'left', align: 'center'  },
				{ text: 'PT/Sekolah', datafield: 'sekolah', width: 180, align: 'center', cellsalign: 'left'},
				{ text: 'Tahun Masuk', datafield: 'tahunmsk', width: 70, cellsalign: 'center', align: 'center' },
				{ text: 'Negara', datafield: 'negara', width: 80, cellsalign: 'center', align: 'center' },
				{ text: 'Bidang Ilmu/Minat', datafield: 'minat', width: 150, cellsalign: 'center', align: 'center' },
				{ text: 'Status', datafield: 'status', width: 50, cellsalign: 'center', align: 'center' },
				{ text: 'TMT.Lulus', datafield: 'tmtlulus', width: 100, cellsalign: 'center', align: 'center' },
				{ text: 'No.Ijasah', datafield: 'noijasah', width: 100, cellsalign: 'center', align: 'center' },
				{ text: 'Tgl.Ijasah', datafield: 'tglijasah', width: 100, cellsalign: 'center', align: 'center' },
				{ text: 'Keterangan', datafield: 'keterangan', width: 150, cellsalign: 'center', align: 'center' },
				{ text: 'File Upload', align: 'center', cellsalign: 'center',  width: '10%', datafield: 'bukti', },
				{ text: 'Edit', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
					return "Edit";
					}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridpendidikan").offset();
						var dataRecord 	= $("#gridpendidikan").jqxGrid('getrowdata', editrow);
						$("#pendidikan_jenjang").val(dataRecord.jenjang);
						$("#pendidikan_keterangan").val(dataRecord.keterangan);
						$("#pendidikan_lulus").val(dataRecord.tmtlulus);
						$("#pendidikan_minat").val(dataRecord.minat);
						$("#pendidikan_negara").val(dataRecord.negara).select2().trigger('change');
						$("#pendidikan_noijasah").val(dataRecord.noijasah);
						$("#pendidikan_sekolah").val(dataRecord.sekolah);
						$("#pendidikan_status").val(dataRecord.status);
						$("#pendidikan_tahun").val(dataRecord.tahunmsk);
						$("#pendidikan_tglijasah").val(dataRecord.tglijasah);
						$("#pendidikan_url").val(dataRecord.bukti);	
						$("#pendidikan_idne").val(dataRecord.id);		
						$('#divupdatependidikan').hide(); 
						$('#divtambahpendidikan').show(); 
					}
				},
				{ text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsrenderer: function () {
					return "Del";
					}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridpendidikan").offset();		
						var dataRecord 	= $("#gridpendidikan").jqxGrid('getrowdata', editrow);
						swal({
							title				: 'Apakah anda yakin ?',
							text				: "Perhatian, data yang sudah di hapus tidak bisa di Undo, apakah anda yakin ingin menghapus",
							type				: 'warning',
							showCancelButton	: true,
							confirmButtonClass	: 'btn btn-confirm mt-2',
							cancelButtonClass	: 'btn btn-cancel ml-2 mt-2',
							confirmButtonText	: 'Yes'
						}).then(function () {
							var set01		= dataRecord.no;
							var set13		= dataRecord.id;
							var token   	= document.getElementById('token').value;		
							$.post('{{ route("exdataPendidikan") }}', { _token: token, val01: set01, val12: 'hapus', val13: set13 },
							function(data){
								$.toast({
									heading: 'Info',
									text: data,
									position: 'top-right',
									loaderBg: '#bf441d',
									icon: 'success',
									hideAfter: 5000,
									stack: 1
								});
								$("#gridpendidikan").jqxGrid('updatebounddata');
								return false;
							});
						});
					}
				},
			],
		});
	});
//batas tombol di modal pendidikan
//tombol-tombol di modal diklat
	$("#btnnewdiklat").click(function(){ 
		$('#diklat_idne').val('tambah');
		$('#divupdatediklat').hide(); 
		$('#divtambahdiklat').show(); 
	});
	$('#btnkembalidrtambahdiklat').on('click', function (){	
		$('#divupdatediklat').show(); 
		$('#divtambahdiklat').hide(); 
	});
	$("#btnexportdiklat").click(function () {
		var gridContent = $("#griddiklat").jqxGrid('exportdata', 'html');
		$('#tabel_cetak').html(gridContent);		
		$("#tabel_cetak").btechco_excelexport({
			containerid: "tabel_cetak"
			, datatype: $datatype.Table
		});
	});
	$('#btnsimpandatadiklat').on('click', function (){	
		var set01=document.getElementById('id_masterno').value;
		var set02=document.getElementById('diklat_angkatan').value;
		var set03=document.getElementById('diklat_diklat').value;
		var set04=document.getElementById('diklat_jam').value;
		var set05=document.getElementById('diklat_keterangan').value;
		var set06=document.getElementById('diklat_lulus').value;
		var set07=document.getElementById('diklat_mulai').value;
		var set08=document.getElementById('diklat_nama').value;
		var set09=document.getElementById('diklat_negeri').value;
		var set10=document.getElementById('diklat_nodoc').value;
		var set11=document.getElementById('diklat_penyelenggara').value;
		var set12=document.getElementById('diklat_predikat').value;
		var set13=document.getElementById('diklat_tempat').value;
		var set14=document.getElementById('diklat_tgldok').value;
		var set15=document.getElementById('diklat_idne').value;
		var set17=document.getElementById('diklat_url').value;
		if (set17 == '' && set15 == 'tambah'){
			swal({
				title	: 'Stop',
				text	: 'Mohon Upload Filenya terlebih dahulu',
				type	: 'warning',
			})
        } else if (set02 == '' || set03 == '' || set04 == '' || set05 == '' || set05 == '' || set06 == '' || set07 == '' || set08 == '' || set09 == '' || set10 == '' || set11 == ''){ 
			swal({
				title	: 'Stop',
				text	: 'Semua Form Di Isi, Apabila tidak ada data diberi tanda strip (-) ',
				type	: 'warning',
			})
		} else {
			var form_data = new FormData();
				form_data.append('file', null);
				form_data.append('val01', set01);
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
				form_data.append('val16', set15);
				form_data.append('val17', set17);
				form_data.append('_token', '{{csrf_token()}}');
			$.ajax({
				url			: '{{ route("exdataDiklat") }}',
				data		: form_data,
				type		: 'POST',
				contentType	: false,
				processData	: false,
				success		: function (data) {
					$.toast({
						heading: 'Info',
						text: data,
						position: 'top-right',
						loaderBg: '#bf441d',
						icon: 'success',
						hideAfter: 5000,
						stack: 1
					});
					$('#divupdatediklat').show(); 
					$('#divtambahdiklat').hide(); 
					$("#griddiklat").jqxGrid('updatebounddata');
					return false;
				},
				error: function (xhr, status, error) {
					swal({
						title: status,
						text:  xhr.responseText,
						type: 'info',
					});
				}
			});
		}
	});
	$('#btnriwayatdiklat').click(function () {
		$('#halamandataajar').hide();
		$('#halamandataasesor').hide();
		$('#halamandatabkd').hide();
		$('#halamandiklat').show();
		$('#halamanfungsional').hide();
		$('#halamangaji').hide();
		$('#halamanidentitas').hide();
		$('#halamankeluarga').hide();
		$('#halamanevaluasikinerja').hide();
		$('#halamanonline').hide();
		$('#halamanmuka').hide();
		$('#halamanubahpassword').hide();
		$('#halamanmutasi').hide();
		$('#halamanorganisasi').hide();
		$('#halamanpangkat').hide();
		$('#halamanpendidikan').hide();
		$('#halamanpenghargaan').hide();
		$('#halamanseminar').hide();
		$('#halamansertifikasi').hide();
		$('#halamanangkakredit').hide();
		$('#halamandatabkd').hide();
		$('#halamanremun').hide();
		$('#halamanskp').hide();
		$('#divupdatediklat').show(); 
		$('#divtambahdiklat').hide();
		var set01	= document.getElementById('id_masterno').value;	
		var source 	= {
			datatype: "json",
			datafields: [
				{ name: 'id'},
				{ name: 'no'},
				{ name: 'nama',type: 'text'},
				{ name: 'nip',type: 'text'},
				{ name: 'angkatan',type: 'text'},
				{ name: 'diklat',type: 'text'},
				{ name: 'jam',type: 'text'},
				{ name: 'keterangan',type: 'text'},
				{ name: 'lulus',type: 'text'},
				{ name: 'mulai',type: 'text'},
				{ name: 'namadiklat',type: 'text'},
				{ name: 'negeri',type: 'text'},
				{ name: 'nodoc',type: 'text'},
				{ name: 'penyelenggara',type: 'text'},
				{ name: 'predikat',type: 'text'},
				{ name: 'tempat',type: 'text'},
				{ name: 'tgldok',type: 'text'},
				{ name: 'bukti',type: 'text'},
			],
			type: 'POST',
			data: {_token: token, val01:set01},
			url: '{{ route("jsondataDiklat") }}'
		};		
		var dataAdapter = new $.jqx.dataAdapter(source);
		$("#griddiklat").jqxGrid({
			width: '100%',
			source: dataAdapter,
			columnsresize: true,
			theme: "energyblue",
			autoheight: true,
			selectionmode: 'multiplecellsextended',
			columns: [
				{ text: 'No.Dokumen', datafield: 'nodoc', width: 150, cellsalign: 'left', align: 'center'  },
				{ text: 'Tgl.Dokumen', datafield: 'tgldok', width: 100, align: 'center', cellsalign: 'left'},
				{ text: 'Diklat', datafield: 'diklat', width: 80, cellsalign: 'left', align: 'center' },
				{ text: 'Penyelenggara', datafield: 'penyelenggara', width: 100, cellsalign: 'left', align: 'center' },
				{ text: 'Nama Diklat', datafield: 'namadiklat', width: 100, cellsalign: 'left', align: 'center' },
				{ text: 'Tempat', datafield: 'tempat', width: 50, cellsalign: 'left', align: 'center' },
				{ text: 'Angkatan', datafield: 'angkatan', width: 100, cellsalign: 'left', align: 'center' },
				{ text: 'Mulai', datafield: 'mulai', columngroup: 'pelaksanaan', width: 80, cellsalign: 'center', align: 'center' },
				{ text: 'Lulus', datafield: 'lulus', columngroup: 'pelaksanaan', width: 80, cellsalign: 'center', align: 'center' },
				{ text: 'Jmlh.Jam', datafield: 'jam', columngroup: 'pelaksanaan', width: 50, cellsalign: 'center', align: 'center' },
				{ text: 'Predikat', datafield: 'predikat', columngroup: 'pelaksanaan', width: 150, cellsalign: 'center', align: 'center' },
				{ text: 'Negara', datafield: 'negeri', columngroup: 'pelaksanaan', width: 100, cellsalign: 'center', align: 'center' },
				{ text: 'Keterangan', datafield: 'keterangan', width: 150, cellsalign: 'left', align: 'center' },
				{ text: 'File Upload', datafield: 'bukti',  align: 'center', cellsalign: 'center',  width: '10%' },
                { text: 'Edit', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
					return "Edit";
					}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#griddiklat").offset();
						var dataRecord 	= $("#griddiklat").jqxGrid('getrowdata', editrow);
						$("#diklat_angkatan").val(dataRecord.angkatan);
						$("#diklat_diklat").val(dataRecord.diklat);
						$("#diklat_idne").val(dataRecord.id);
						$("#diklat_jam").val(dataRecord.jam);
						$("#diklat_keterangan").val(dataRecord.keterangan);
						$("#diklat_lulus").val(dataRecord.lulus);
						$("#diklat_mulai").val(dataRecord.mulai);
						$("#diklat_nama").val(dataRecord.namadiklat);
						$("#diklat_negeri").val(dataRecord.negeri);
						$("#diklat_nodoc").val(dataRecord.nodoc);				
						$("#diklat_penyelenggara").val(dataRecord.penyelenggara);
						$("#diklat_predikat").val(dataRecord.predikat);
						$("#diklat_tempat").val(dataRecord.tempat);
						$("#diklat_tgldok").val(dataRecord.tgldok);
						$("#diklat_url").val(dataRecord.bukti);
						$('#divupdatediklat').hide(); 
						$('#divtambahdiklat').show(); 
					}
				},
				{ text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsrenderer: function () {
					return "Del";
					}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#griddiklat").offset();		
						var dataRecord 	= $("#griddiklat").jqxGrid('getrowdata', editrow);
						swal({
							title				: 'Apakah anda yakin ?',
							text				: "Perhatian, data yang sudah di hapus tidak bisa di Undo, apakah anda yakin ingin menghapus",
							type				: 'warning',
							showCancelButton	: true,
							confirmButtonClass	: 'btn btn-confirm mt-2',
							cancelButtonClass	: 'btn btn-cancel ml-2 mt-2',
							confirmButtonText	: 'Yes'
						}).then(function () {
							var set01		= dataRecord.no;
							var set16		= dataRecord.id;
							var token   	= document.getElementById('token').value;		
							$.post('{{ route("exdataDiklat") }}', { _token: token, val01: set01, val15: 'hapus', val16: set16 },
							function(data){
								$.toast({
									heading: 'Info',
									text: data,
									position: 'top-right',
									loaderBg: '#bf441d',
									icon: 'success',
									hideAfter: 5000,
									stack: 1
								});
								$("#griddiklat").jqxGrid('updatebounddata');
								return false;
							});
						});
					}
				},
			],
			columngroups: 
			[
			  { text: 'Pelaksanaan', align: 'center', name: 'pelaksanaan' },
			]
		});
	});
//batas tombol di modal diklat
//tombol-tombol di modal penghargaan
	$("#btnnewpenghargaan").click(function(){ 
		$('#penghargaan_idne').val('tambah');
		$('#penghargaan_url').val('');
		$('#divupdatepenghargaan').hide(); 
		$('#divtambahpenghargaan').show(); 
	});
	$('#btnkembalidrtambahpenghargaan').on('click', function (){	
		$('#divupdatepenghargaan').show();
		$('#divtambahpenghargaan').hide();
	});
	$("#btnexportpenghargaan").click(function () {
		var gridContent = $("#gridpenghargaan").jqxGrid('exportdata', 'html');
		$('#tabel_cetak').html(gridContent);		
		$("#tabel_cetak").btechco_excelexport({
			containerid: "tabel_cetak"
			, datatype: $datatype.Table
		});
	});
	$('#btnsimpandatapenghargaan').on('click', function (){	
		var set01=document.getElementById('id_masterno').value;
		var set02=document.getElementById('penghargaan_keterangan').value;
		var set03=document.getElementById('penghargaan_nama').value;
		var set04=document.getElementById('penghargaan_nodoc').value;
		var set05=document.getElementById('penghargaan_pejabat').value;
		var set06=document.getElementById('penghargaan_pemberi').value;
		var set07=document.getElementById('penghargaan_tgl').value;	
		var set12=document.getElementById('penghargaan_idne').value;
		var set14=document.getElementById('penghargaan_url').value;
		if (set14 == '' && set12 == 'tambah'){
			swal({
				title	: 'Stop',
				text	: 'Mohon Upload Filenya terlebih dahulu',
				type	: 'warning',
			})
        } else if (set02 == '' || set03 == '' || set04 == '' || set05 == '' || set05 == '' || set06 == '' ){ 
			swal({
				title	: 'Stop',
				text	: 'Semua Form Di Isi, Apabila tidak ada data diberi tanda strip (-) ',
				type	: 'warning',
			})
		} else {
			var form_data = new FormData();
				form_data.append('file', null);
				form_data.append('val01', set01);
				form_data.append('val02', set02);
				form_data.append('val03', set03);
				form_data.append('val04', set04);
				form_data.append('val05', set05);
				form_data.append('val06', set06);
				form_data.append('val07', set07);
				form_data.append('val08', '');
				form_data.append('val09', '');
				form_data.append('val10', '');
				form_data.append('val11', '');
				form_data.append('val12', set12);
				form_data.append('val13', set12);
				form_data.append('val14', set14);
				form_data.append('_token', '{{csrf_token()}}');
			$.ajax({
				url: '{{ route("exdataPenghargaan") }}',
				data: form_data,
				type: 'POST',
				contentType: false,
				processData: false,
				success: function (data) {
					$.toast({
						heading: 'Info',
						text: data,
						position: 'top-right',
						loaderBg: '#bf441d',
						icon: 'success',
						hideAfter: 5000,
						stack: 1
					});
					$('#divupdatepenghargaan').show();
					$('#divtambahpenghargaan').hide();
					$("#gridpenghargaan").jqxGrid('updatebounddata');
					return false;
				},
				error: function (xhr, status, error) {
					swal({
						title: status,
						text:  xhr.responseText,
						type: 'info',
					});
				}
			});
		}
	});
	$('#btnriwayatpenghargaan').click(function () {
		$('#divupdatepenghargaan').show();
		$('#divtambahpenghargaan').hide();
		$('#halamandataajar').hide();
		$('#halamandataasesor').hide();
		$('#halamandatabkd').hide();
		$('#halamandiklat').hide();
		$('#halamanfungsional').hide();
		$('#halamangaji').hide();
		$('#halamanidentitas').hide();
		$('#halamankeluarga').hide();
		$('#halamanevaluasikinerja').hide();
		$('#halamanonline').hide();
		$('#halamanmuka').hide();
		$('#halamanubahpassword').hide();
		$('#halamanmutasi').hide();
		$('#halamanorganisasi').hide();
		$('#halamanpangkat').hide();
		$('#halamanpendidikan').hide();
		$('#halamanpenghargaan').show();
		$('#halamanseminar').hide();
		$('#halamansertifikasi').hide();
		$('#halamanangkakredit').hide();
		$('#halamandatabkd').hide();
		$('#halamanremun').hide();
		$('#halamanskp').hide();
		var set01	= document.getElementById('id_masterno').value;	
		var source 	= {
			datatype: "json",
			datafields: [
				{ name: 'id'},
				{ name: 'no'},
				{ name: 'nama',type: 'text'},
				{ name: 'nip',type: 'text'},
				{ name: 'penghargaan',type: 'text'},
				{ name: 'nosk',type: 'text'},
				{ name: 'tanggal',type: 'text'},
				{ name: 'keterangan',type: 'text'},
				{ name: 'pemberi',type: 'text'},
				{ name: 'pejabat',type: 'text'},
				{ name: 'bukti',type: 'text'},
			],
			type: 'POST',
			data: {_token: token, val01:set01},
			url: '{{ route("jsondataPenghargaan") }}'
		};		
		var dataAdapter = new $.jqx.dataAdapter(source);
		$("#gridpenghargaan").jqxGrid({
			width: '100%',
			source: dataAdapter,
			columnsresize: true,
			theme: "energyblue",
			autoheight: true,
			selectionmode: 'multiplecellsextended',
			columns: [
				{ text: 'No.SK', datafield: 'nosk', width: 150, cellsalign: 'left', align: 'center'  },
				{ text: 'Tgl.SK', datafield: 'tanggal', width: 120, align: 'center', cellsalign: 'left'},
				{ text: 'Nama Penghargaan', datafield: 'penghargaan', width: 280, cellsalign: 'left', align: 'center' },
				{ text: 'Pemberi', datafield: 'pemberi', width: 200, cellsalign: 'left', align: 'center' },
				{ text: 'Pejabat', datafield: 'pejabat', width: 200, cellsalign: 'left', align: 'center' },
				{ text: 'Keterangan', datafield: 'keterangan', width: 150, cellsalign: 'left', align: 'center' },
				{ text: 'File Upload', align: 'center', cellsalign: 'center',  width: '10%', datafield: 'bukti', },
				{ text: 'Edit', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
					return "Edit";
					}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridpenghargaan").offset();
						var dataRecord 	= $("#gridpenghargaan").jqxGrid('getrowdata', editrow);				
						$("#penghargaan_keterangan").val(dataRecord.keterangan);
						$("#penghargaan_idne").val(dataRecord.id);
						$("#penghargaan_nama").val(dataRecord.penghargaan);
						$("#penghargaan_nodoc").val(dataRecord.nosk);
						$("#penghargaan_pejabat").val(dataRecord.pejabat);
						$("#penghargaan_pemberi").val(dataRecord.pemberi);
						$("#penghargaan_tgl").val(dataRecord.tanggal);				
						$('#penghargaan_url').val(dataRecord.bukti);
						$('#divupdatepenghargaan').hide(); 
						$('#divtambahpenghargaan').show(); 
					}
				},
				{ text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsrenderer: function () {
					return "Del";
					}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridpenghargaan").offset();		
						var dataRecord 	= $("#gridpenghargaan").jqxGrid('getrowdata', editrow);
						swal({
							title				: 'Apakah anda yakin ?',
							text				: "Perhatian, data yang sudah di hapus tidak bisa di Undo, apakah anda yakin ingin menghapus",
							type				: 'warning',
							showCancelButton	: true,
							confirmButtonClass	: 'btn btn-confirm mt-2',
							cancelButtonClass	: 'btn btn-cancel ml-2 mt-2',
							confirmButtonText	: 'Yes'
						}).then(function () {
							var set01		= dataRecord.no;
							var set13		= dataRecord.id;
							var token   	= document.getElementById('token').value;		
							$.post('{{ route("exdataPenghargaan") }}', { _token: token, val01: set01, val12: 'hapus', val13: set13 },
							function(data){
								$.toast({
									heading: 'Info',
									text: data,
									position: 'top-right',
									loaderBg: '#bf441d',
									icon: 'success',
									hideAfter: 5000,
									stack: 1
								});
								$("#gridpenghargaan").jqxGrid('updatebounddata');
								return false;
							});
						});
					}
				},			
			]		
		});
	});
//batas tombol di modal penghargaan	
});
</script>
@endpush