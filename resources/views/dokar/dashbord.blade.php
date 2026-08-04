@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> User Admin</h1>
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
		<div class="row">
			<div id="loading">
				<img src="{{ asset('dist/img/loading.gif') }}" class="img-responsive" alt="Photo">
			</div>
			<div class="col-md-4 divgrafik">
				<div class="card card-danger shadow">
					<div class="card-header">
						<h3 class="card-title"></h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					<div class="card-body p-0" >
						<div id='divjenispegawai' style="width:100%; height:300px;"></div>
					</div>
				</div>
			</div>
			<div class="col-md-4 divgrafik">
				<div class="card card-primary shadow">
					<div class="card-header">
						<h3 class="card-title"></h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					<div class="card-body p-0" >
						<div id='divjenisgolongan' style="width:100%; height:300px;"></div>
					</div>
				</div>
			</div>
			<div class="col-md-4 divgrafik">
				<div class="card card-warning shadow">
					<div class="card-header">
						<h3 class="card-title"></h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					<div class="card-body p-0" >
						<div id='divpendidikan' style="width:100%; height:300px;"></div>
					</div>
				</div>
			</div>
			<div class="col-md-12 divawal">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">All User</h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
							<button type="button" class="btn btn-tool" id="btntambahpegawai"><i class="fa fa-plus"></i> Tambah Pegawai</button>
							<button type="button" class="btn btn-tool" id="btnuploadpegawai"><i class="fa fa-upload"></i> Upload Pegawai</button>
							<button type="button" class="btn btn-tool" id="btncetakblankcv"><i class="fa fa-print"></i> Blanko</button>
						</div>
					</div>
					<div class="card-body" >
						<div class="form-group">
							<div class="row">
								<div class="form-group col-md-4">
									
								</div>
								<div class="form-group col-md-3">
									<label for="ppabp">Unit Kerja</label>
									<select id="ppabp" name="ppabp" class="form-control">
										<option value="ALLPPABP">ALL</option>
										@if (Session('fakultas') == 'DPM')
											<option value="PT Disa Prima Medika" selected>PT</option>
										@else
											<option value="PT Disa Prima Medika">PT</option>
										@endif
										@if (Session('fakultas') == 'RSPHMLG')
											<option value="RS Prima Husada Malang" selected>PHM</option>
										@else
											<option value="RS Prima Husada Malang">PHM</option>
										@endif
										@if (Session('fakultas') == 'RSPHSKR')
											<option value="RS Prima Husada Sukorejo" selected>PHS</option>
										@else
											<option value="RS Prima Husada Sukorejo">PHS</option>
										@endif
										@if (Session('fakultas') == 'PDP')
											<option value="CV Putra Disa Prima" selected>PDP</option>
										@else
											<option value="CV Putra Disa Prima">PDP</option>
										@endif
										<option value="REKRUTMEN PT DISA PRIMA MEDIKA">REKRUTMEN</option>
									</select>
								</div>
								<div class="form-group col-md-3">
									<label>Status Pegawai</label>
									<div class="input-group margin">
										<select id="status_pegawai" name="status_pegawai" class="form-control">
											<option value="1">Aktif</option>
											<option value="0">Non Aktif</option>
										</select>
										<span class="input-group-btn">
											<button class="btn btn-info btn-flat topbtnopenpegawai" type="button">View</button>
										</span>
									</div>
								</div>
								<div class="form-group col-md-2">
									<button type="button" class="btn btn-primary" id="btnexport"><i class="fa fa-print"></i> Export</button>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
					<div id="gridpegawai"></div>
					</div>
				</div>
			</div>
			<div class="col-md-6 divtabel">
				<div class="card card-info shadow">
					<div class="card-header">
						<h3 class="card-title">Pegawai Yang Mendekati Akhir Kontrak</h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					<div class="card-body" >
						<div id='gridpensiun'></div>
					</div>
				</div>
			</div>
			<div class="col-md-6 divtabel">
				<div class="card card-danger shadow">
					<div class="card-header">
						<h3 class="card-title">STR Mendekati Expired</h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					<div class="card-body" >
						<div id='gridtubel'></div>
					</div>
				</div>
			</div>
			<div class="col-md-12" id="divtambahpegawai">
				<div class="card card-primary shadow">
					<div class="card-header">
						<h3 class="card-title">Tambah Data Pegawai</h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool btnkembalikelist"><i class="fa fa-ban"></i></button>
						</div>
					</div>
					<div class="card-body" >
						<div class="row">
							<div class="col-md-7">
								<div class="form-group">  
									<div class="row">
										<div class="col-md-4 col-lg-4">
											<label for="id_nip">Nomor Kepegawaian</label>
											<input type="text" class="form-control" id="id_nip">
										</div>
										<div class="col-md-4 col-lg-4">
											<label for="id_jenis">Jenis</label>
											<select id="id_jenis" name="id_jenis" size="1" class="form-control">
												<option value="NIP">NIP</option>
												<option value="NIK">NIK</option>
												<option value="NIPK">NIPK</option>
											</select>
										</div>
										<div class="col-md-4 col-lg-4">
											<label for="id_tmtgolongan">TMT Masuk</label>
											<div class="input-group date" data-target-input="nearest">
												<input type="text" class="form-control"id="id_tmtgolongan" name="id_tmtgolongan" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
												<div class="input-group-append">
													<div class="input-group-text"><i class="fa fa-calendar"></i></div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="id_nama">Nama (Tanpa Gelar)</label>
									<input type="text" class="form-control" id="id_nama">
								</div>
								<div class="form-group">  
									<div class="row">
										<div class="col-md-7">
											<label for="id_nokk">No.KK</label>
											<input type="text" class="form-control" id="id_nokk">
										</div>
										<div class="col-md-5">
											<label for="id_ktp">No.KTP</label>
											<input type="text" id="id_ktp" class="form-control">
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-5 col-lg-5">
											<label for="id_tmplhr">Tempat Lahir</label>
											<input type="text" class="form-control" id="id_tmplhr" placeholder="Tempat Lahir">
										</div>
										<div class="col-md-4 col-lg-4">
											<label for="id_tgllhr">Tgl.Lahir</label>
											<div class="input-group date" data-target-input="nearest">
												<input type="text" class="form-control"id="id_tgllhr" name="id_tgllhr" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
												<div class="input-group-append">
													<div class="input-group-text"><i class="fa fa-calendar"></i></div>
												</div>
											</div>
										</div>
										<div class="col-md-3 col-lg-3">
											<label for="id_kelamin">Kelamin</label>
											<select id="id_kelamin" class="form-control">
												<option value="Laki-laki">Laki-Laki</option>
												<option value="Perempuan">Perempuan</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">  
									<div class="row">
										<div class="col-md-4">
											<label for="id_kode">Finger ID</label>
											<input type="text" id="id_kode" class="form-control">
										</div>
										<div class="col-md-4">
											<label for="id_glrdepan">Gelar Depan</label>
											<input type="text" id="id_glrdepan" class="form-control">
										</div>
										<div class="col-md-4">
											<label for="id_glrblakang">Gelar Belakang</label>
											<input type="text" id="id_glrblakang" class="form-control">
										</div> 
									</div>
								</div>
								<div class="form-group">  
									<div class="row">
										<div class="col-md-6 col-lg-6">
											<label for="id_bidangilmu">Kepakaran</label>
											<input type="text" id="id_bidangilmu" class="form-control">
											<input type="hidden" id="id_kepakaran" class="form-control">
										</div>
										<div class="col-md-6 col-lg-6">
											<label for="id_bidangilmu3">Bidang Ilmu</label>
											<input type="text" id="id_bidangilmu3" class="form-control">
										</div> 
									</div>
								</div>
								<div class="form-group">  
									<label for="id_alamatmlg">Alamat di Malang</label>
									<input type="text" class="form-control" id="id_alamatmlg">
								</div>
								<div class="form-group">  
									<label for="id_alamatasal">Alamat di Asal (Sesuai KTP)</label>
									<input type="text" class="form-control" id="id_alamatasal">
								</div>
								<div class="form-group">  
									<div class="row">
										<div class="col-md-6 col-lg-6">
											<label for="id_kelurahan">Kelurahan/Desa (Sesuai KTP)</label>
											<input type="text" class="form-control" id="id_kelurahan">
										</div>
										<div class="col-md-6 col-lg-6">
											<label for="id_kecamatan">Kecamatan (Sesuai KTP)</label>
											<input type="text" class="form-control" id="id_kecamatan">
										</div>
									</div>
								</div>
								<div class="form-group">  
									<div class="row">
										<div class="col-md-6 col-lg-6">
											<label for="id_kota">Kota (Sesuai KTP)</label>
											<input type="text" class="form-control" id="id_kota">
										</div>
										<div class="col-md-6 col-lg-6">	
											<label for="id_propinsi">Propinsi (Sesuai KTP)</label>
											<input type="text" class="form-control" id="id_propinsi">
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 col-lg-6">
											<label for="id_agama">Agama</label>
											<select id="id_agama" class="form-control">
												<option value="Islam">Islam</option>
												<option value="Kristen Protestan">Kristen Protestan</option>
												<option value="Kristen Katholik">Kristen Katholik</option>
												<option value="Hindu">Hindu</option>
												<option value="Buddha">Buddha</option>
												<option value="Konghucu">Konghucu</option>
											</select>
										</div>
										<div class="col-md-6 col-lg-6">
											<label for="id_kawin">Status Perkawinan</label>
											<select id="id_kawin" name="id_kawin" size="1" class="form-control">
												<option value="1000">Belum Kawin</option>
												<option value="1100">Kawin Tanpa Anak</option>
												<option value="1101">Kawin 1 Anak</option>
												<option value="1102">Kawin 2 Anak / Lebih</option>
												<option value="1001">Janda/Duda 1 Anak</option>
												<option value="1002">Janda/Duda 2 Anak / Lebih</option>
											</select>
										</div> 
									</div>
								</div>
								<div class="form-group">  
									<div class="row">
										<div class="col-md-4 col-lg-4">
											<label for="id_hape">No.HP</label>
											<input type="text" id="id_hape" class="form-control">
										</div> 
										<div class="col-md-4 col-lg-4">
											<label for="id_emailub">Email</label>
											<input type="text" id="id_emailub" class="form-control">
										</div>
										<div class="col-md-4 col-lg-4">
											<label for="id_emaillain">Email Alternative</label>
											<input type="text" id="id_emaillain" class="form-control">
										</div>
									</div>
								</div>
								<div class="form-group">  
								<div class="row">
									<div class="col-md-6 col-lg-6">
										<label for="id_unitkerja">Unit Kerja / Departement</label>
										<input type="text" id="id_unitkerja" class="form-control">
									</div>
									<div class="col-md-6 col-lg-6">
										<label for="id_laborat">Satuan Tugas / Kelompok</label>
										<input type="text" id="id_laborat" class="form-control">
									</div> 
								</div>
								</div>
								<div class="form-group">  
									<div class="row">
										<div class="col-md-4 col-lg-4">
											<label for="id_status_jbtn">Status Pegawai</label>
											<select id="id_status_jbtn" size="1" class="form-control">
												<option value="Kontrak">Kontrak</option>
												<option value="Tetap">Tetap</option>
											</select>
										</div>
										<div class="col-md-4 col-lg-4">
											<label for="id_jenispeg">Jenis Pegawai</label>
											<select id="id_jenispeg" size="1" class="form-control">
												<option value="Non Medis">Non Medis</option>
												<option value="Medis">Medis</option>
												<option value="Pejabat">Pejabat</option>
											</select>
										</div>
										<div class="col-md-4 col-lg-4">
											<label for="id_status">Status Kerja</label>
											<select id="id_status" size="1" class="form-control">
												<option value="1">Aktif</option>
												<option value="0">Non Aktif (Mengundurkan Diri / Meninggal / Pensiun)</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">  
									<div class="row">
										<div class="col-md-7 col-lg-7">
											<label for="id_jabatan">Jabatan</label>
											<input type="text" id="id_jabatan" class="form-control">
										</div>
										<div class="col-md-5 col-lg-5">
											<label for="id_tmtjabatan">TMT. Awal Kontrak</label>
											<div class="input-group date" data-target-input="nearest">
												<input type="text" class="form-control"id="id_tmtjabatan" name="id_tmtjabatan" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
												<div class="input-group-append">
													<div class="input-group-text"><i class="fa fa-calendar"></i></div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">  
									<div class="row">
										<div class="col-md-7 col-lg-7">
											<label for="id_cpns">NO STR</label>
											<input type="text" id="id_cpns" class="form-control">
										</div>
										<div class="col-md-5 col-lg-5">
											<label for="id_tmtcpns">Expired</label>
											<div class="input-group date" data-target-input="nearest">
												<input type="text" class="form-control"id="id_tmtcpns" name="id_tmtcpns" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
												<div class="input-group-append">
													<div class="input-group-text"><i class="fa fa-calendar"></i></div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">  
									<div class="row">
										<div class="col-md-7 col-lg-7">
											<label for="id_pns">NO SIP</label>
											<input type="text" id="id_pns" class="form-control">
										</div>
										<div class="col-md-5 col-lg-5">
											<label for="id_tmtpns">Expired</label>
											<div class="input-group date" data-target-input="nearest">
												<input type="text" class="form-control"id="id_tmtpns" name="id_tmtpns" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
												<div class="input-group-append">
													<div class="input-group-text"><i class="fa fa-calendar"></i></div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">  
									<div class="row">
										<div class="col-md-7 col-lg-7">
											<label for="id_gaji">Gaji Pokok</label>
											<input type="text" id="id_gaji" class="form-control">
										</div>
										<div class="col-md-5 col-lg-5">
											<label for="id_tmtgaji">TMT Gaji</label>
											<div class="input-group date" data-target-input="nearest">
												<input type="text" class="form-control"id="id_tmtgaji" name="id_tmtgaji" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
												<div class="input-group-append">
													<div class="input-group-text"><i class="fa fa-calendar"></i></div>
												</div>
											</div>
										</div> 
									</div>
								</div>
							</div>
							<div class="col-md-5">
								<div class="card card-danger">
									<div class="card-header">
										<h3 class="card-title">Terkini</h3>
									</div>
									<div class="card-body">
										<div class="form-group">
											<img src="{{asset('dist/img/takadagambar.jpg')}}" alt="image" width="100%" id="preview">
											<input type="file" id="addfile" style="display: none;"/>
											<button type="button" class="btn btn-danger btn-block" id="btnaddfile">&nbsp;&nbsp;Upload Pas Foto&nbsp;&nbsp;</button></p>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-6 col-lg-6">
													<label for="id_tinggibdn">Tinggi Badan (Cm)</label>
													<input type="text" class="form-control" id="id_tinggibdn">
												</div>
												<div class="col-md-6 col-lg-6">
													<label for="id_beratbdn">Berat Badan (Kg)</label>
													<input type="text" class="form-control" id="id_beratbdn">
												</div> 
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-6 col-lg-6">
													<label for="id_rambut">Bentuk Rambut</label>
													<input type="text" class="form-control" id="id_rambut">
												</div>
												<div class="col-md-6 col-lg-6">
													<label for="id_muka">Bentuk Muka</label>
													<input type="text" class="form-control" id="id_muka">
												</div> 
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-4 col-lg-4">
													<label for="id_warnakulit">Warna Kulit</label>
													<input type="text" class="form-control" id="id_warnakulit">
												</div>
												<div class="col-md-4 col-lg-4">
													<label for="id_cirikusus">Ciri Khusus</label>
													<input type="text" class="form-control" id="id_cirikusus">
												</div>
												<div class="col-md-4 col-lg-4">
													<label for="id_cacattubuh">Cacat Tubuh</label>
													<input type="text" class="form-control" id="id_cacattubuh">
												</div> 
											</div>
										</div>
										<div class="form-group">
											<label for="id_hobi">Kegemaran / Hobi</label>
											<input type="text" class="form-control" id="id_hobi">
										</div>
										<div class="form-group">  
											<label for="id_nomoridi">Nomor IDI</label>
											<input type="text" class="form-control" id="id_nomoridi">
										</div>
										<div class="form-group">  
											<label for="id_keanggotaanprofesi">Keanggotaan Profesi</label>
											<input type="text" class="form-control" id="id_keanggotaanprofesi">
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-6 col-lg-6">
													<label for="id_npwp">NPWP</label>
													<input type="text" class="form-control" id="id_npwp">
												</div>
												<div class="col-md-6 col-lg-6">
													<label for="id_bpjs">BPJS Kesehatan</label>
													<input type="text" class="form-control" id="id_bpjs">
												</div> 
											</div>
										</div>
									</div>
									<div class="card-footer">
										<input type="hidden" class="form-control" id="id_idpeg">
										<button type="button" class="btn btn-danger pull-left btnkembalikeawal" >Cancel</button>
										<button type="button" class="btn btn-success pull-right" id="updatebiodata">Update</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12 divlaporan">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">All User</h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
							<button type="button" class="btn btn-tool" id="btntutuplaporan"><i class="fa fa-close"></i> </button>
						</div>
					</div>
					<div class="card-body" >
						<div id="gridlaporan"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
	<input type="hidden" id="id_ppabp" class="form-control" value="{{ Session('fakpanjang') }}">
	<div class="form-group">
		<label for="id_homebase">Homebase Prodi</label>
		<input type="text" id="id_homebase" class="form-control">
	</div>
	<div class="form-group">
		<label for="id_keterangan">Homebase Non Prodi</label>
		<input type="text" id="id_keterangan" class="form-control">
	</div>
	<div class="form-group">
		<label for="id_kelas">Kelas Remunerasi</label>
		<input type="text" id="id_kelas" class="form-control" value="0">
	</div>
	<div class="form-group">  
		<div class="row">
			<div class="col-md-7 col-lg-7">
				<label for="id_jabfungsional">Jabatan Fungsional</label>
				<input type="text" id="id_jabfungsional" class="form-control">
			</div>
			<div class="col-md-5 col-lg-5">
				<label for="id_tmtfungsional">TMT.Fungsional</label>
				<div class="input-group date" data-target-input="nearest">
					<input type="text" class="form-control"id="id_tmtfungsional" name="id_tmtfungsional" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
					<div class="input-group-append">
						<div class="input-group-text"><i class="fa fa-calendar"></i></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group">  
		<div class="row">
			<div class="col-md-6 col-lg-6">
				<label for="id_niplama">NIP Lama (bila ada)</label>
				<input type="text" class="form-control" id="id_niplama">
			</div>
			<div class="col-md-6 col-lg-6">
				<label for="id_npwp">NPWP</label>
				<input type="text" class="form-control input-mask-npwp" id="id_npwp" data-mask="00.000.000.0-000.000">
			</div>
		</div>
	</div>
	<div class="form-group">  
		<div class="row">
			<div class="col-md-4 col-lg-4">
				<label for="id_nidn">NIDN</label>
				<input type="text" id="id_nidn" class="form-control">
			</div>
			<div class="col-md-4 col-lg-4">
				<label for="id_karpeg">KARPEG</label>
				<input type="text" class="form-control" id="id_karpeg">
			</div>
			<div class="col-md-4 col-lg-4">
				<label for="id_nira">NIRA</label>
				<input type="text" class="form-control" id="id_nira">
			</div> 
		</div>
	</div>
	<div class="form-group">  
		<div class="row">
			<div class="col-md-7 col-lg-7">
				<label for="id_pangkat">Pangkat/Gol.</label>
				<select id="id_pangkat" size="1" class="form-control">
				<option value="">Tidak/Belum Punya</option>
					@foreach($golongan as $row)
						<option value="{{$row->kode}}">{{$row->pangkat}}, {{$row->golongan}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-md-5 col-lg-5">
				<label for="id_tahunmsk">TMT Masuk</label>
				<div class="input-group date" data-target-input="nearest">
					<input type="text" class="form-control"id="id_tahunmsk" name="id_tahunmsk" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
					<div class="input-group-append">
						<div class="input-group-text"><i class="fa fa-calendar"></i></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group">  
		<label for="id_nomorstr">Nomor STR</label>
		<input type="text" class="form-control" id="id_nomorstr">
	</div>
	<div class="form-group">  
		<label for="id_nomorsip1">Nomor SIP 1</label>
		<input type="text" class="form-control" id="id_nomorsip1">
	</div>
	<div class="form-group">  
		<label for="id_nomorsip2">Nomor SIP 2</label>
		<input type="text" class="form-control" id="id_nomorsip2">
	</div>
	<div class="form-group">  
		<label for="id_nomorsip3">Nomor SIP 3</label>
		<input type="text" class="form-control" id="id_nomorsip3">
	</div>
	<div class="form-group">  
		<label for="id_google">Alamat Google Scholar</label>
		<input type="text" class="form-control" id="id_google">
	</div>
	<div class="form-group">  
		<label for="id_shinta">Alamat Shinta</label>
		<input type="text" class="form-control" id="id_shinta">
	</div>
	<div class="form-group">  
		<label for="id_scopus">Scopus ID</label>
		<input type="text" class="form-control" id="id_scopus">
	</div>
	<div class="form-group">  
		<label for="id_orcid">ORCID ID</label>
		<input type="text" class="form-control" id="id_orcid">
	</div>
</div>
<div class="modal fade" id="modaluploadpegawai">
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
                    Catatan : Mohon Download Format File Berikut <a href="/format/pegawai.xlsx">Format Database Pegawai</a><br />File Tersebut telah kami beri petunjuk pengisian, mohon mengikuti petunjuk pengisian dan pastikan format kolom sudah "text"
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-success pull-left" id="btnuploadexcel">Upload</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>	
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@push('script')
<script type="text/javascript">
    $(function () {
		$('.select2').select2({width: '100%'});
		$('#id_tgllhr').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#id_tahunmsk').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#id_tmtjabatan').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#id_tmtgolongan').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#id_tmtfungsional').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#id_tmtcpns').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#id_tmtpns').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#id_tmtgaji').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
    });
	$('#addfile').change(function () {
        if(this.files[0].size > 700000){
            swal({
				title	: 'Stop',
				text	: 'Maksimum file adalah 3Mb',
				type	: 'warning',
			})
            this.value = "";
        } else {
            var imgPath = this.value;
			var ukfile 	= this.files[0].size;
            var ext 	= imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
			if(ext == "jpg" || ext == "jpeg" || ext == "png") {
                readURL(this);
            } else {
				swal({
					title	: 'Stop',
					text	: 'Please select image file (jpg, jpeg, png).',
					type	: 'warning',
				})
			}
        }
    });
	function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
            };
        }
    }
	function removeImage() {
		$("#addfile").val('');
        $('#preview').attr('src', 'dist/img/takadagambar.jpg');
    }
	function openpegawai( jQuery ){
        var _second = 1000;
        var _minute = _second * 60;
        var _hour 	= _minute * 60;
        var _day 	= _hour * 24;
		var _thn 	= _day * 356;
        var now     = new Date();
        var set01	= document.getElementById('ppabp').value;
        var set02	= document.getElementById('status_pegawai').value;
        var sourceinterviewer   = {
            datatype    : "json",
            datafields  : [
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
                { name: 'lama_kenaikan_pangkat', type: 'text'},
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
            data: {_token: "{{ csrf_token() }}", val01:set01, val02:set02, },
            url : '{{ route("jgetallpegawai") }}'
        };
        var djsoninterviewer   = new $.jqx.dataAdapter(sourceinterviewer);
        var photorender = function (row, column, value) {
            var filebukti = $('#gridpegawai').jqxGrid('getrowdata', row).foto;
            var idpegawai = $('#gridpegawai').jqxGrid('getrowdata', row).id;
            if (filebukti != ''){
                var linkbukti = '<div style="background: white;" class="pull-right"><a href="viewbiodata/'+idpegawai+'" target="_blank"><img src="/images/pegawai/'+filebukti+'" height="40" width="40" /></a></div>';
            }
            else {
                var linkbukti = '<div style="background: white;"><a href="viewbiodata/'+idpegawai+'" target="_blank"><img src="mascot.png" height="40"  width="100%"/></a></div>';
            }
            return linkbukti;
        }
        var mkgrender = function (row, column, value) {
            var tanggal = $('#gridpegawai').jqxGrid('getrowdata', row).tmt_golongan;

            if (tanggal == '0000-00-00'){
                
            } else {
                var tanggal     = new Date(tanggal);
                var distance    = now - tanggal;
                if (distance < 0) {
                    var tanggal = 'new';
                } else {
                    var thnne   = Math.floor(distance / _thn);
                    var blnne   = Math.floor(distance / _day);
                    var tanggal = thnne+' Thn '+blnne+' Hari';
                }
            }
            var linkbukti = '<div style="background: white;" class="center">'+tanggal+'</div>';
            
            return tanggal;
        }
        $("#gridpegawai").jqxGrid({
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
                { text: 'Edit', columntype: 'button', align: 'center', width: '5%', editable: false, sortable: false, filterable: false, cellsrenderer: function () {
                    return "Edit";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var offset 		= $("#gridpegawai").offset();
                        var dataRecord 	= $("#gridpegawai").jqxGrid('getrowdata', editrow);
                        $('#divtambahpegawai').show();
						$('.divgrafik').hide();
						$('.divawal').hide();
						$('.divtabel').hide();
						$("#addfile").val('');
						$("#id_ppabp").val(dataRecord.ppabp);
						$("#id_homebase").val(dataRecord.program_studi);
						$("#id_keterangan").val(dataRecord.keterangan);
						$("#id_kelas").val(dataRecord.idremun);
						$("#id_niplama").val(dataRecord.nip_lama);
						$("#id_npwp").val(dataRecord.npwp);
						$("#id_nidn").val(dataRecord.nidn);
						$("#id_karpeg").val(dataRecord.karpeg);
						$("#id_nira").val(dataRecord.nira);
						$("#id_idpeg").val(dataRecord.id);
						$("#id_nip").val(dataRecord.nip_baru);
						$("#id_jenis").val(dataRecord.jenisnip);
						$("#id_tahunmsk").val(dataRecord.thn_masuk);
						$("#id_nama").val(dataRecord.nama);
						$("#id_nokk").val(dataRecord.nokk);
						$("#id_ktp").val(dataRecord.ktp);
						$("#id_tmplhr").val(dataRecord.tmpt_lahir);
						$("#id_tgllhr").val(dataRecord.tgl_lahir);
						$("#id_kelamin").val(dataRecord.jenis_kelamin);
						$("#id_kode").val(dataRecord.kode);
						$("#id_glrdepan").val(dataRecord.depan);
						$("#id_glrblakang").val(dataRecord.belakang);
						$("#id_kepakaran").val(dataRecord.kepakaran);
						$("#id_bidangilmu").val(dataRecord.bidang_ilmu);
						$("#id_bidangilmu3").val(dataRecord.bidang_ilmu3);
						$("#id_alamatmlg").val(dataRecord.alamatmlg);
						$("#id_alamatasal").val(dataRecord.alamat);
						$("#id_kelurahan").val(dataRecord.kelurahan);
						$("#id_kecamatan").val(dataRecord.kecamatan);
						$("#id_kota").val(dataRecord.kota);
						$("#id_propinsi").val(dataRecord.propinsi);
						$("#id_agama").val(dataRecord.agama);
						$("#id_kawin").val(dataRecord.statusnpwp);
						$("#id_hape").val(dataRecord.no_hp);
						$("#id_emailub").val(dataRecord.email_ub);
						$("#id_emaillain").val(dataRecord.email);
						$("#id_unitkerja").val(dataRecord.unit_kerja);
						$("#id_laborat").val(dataRecord.lab);
						$("#id_status_jbtn").val(dataRecord.status_jabatan);
						$("#id_jenispeg").val(dataRecord.jenispeg);
						$("#id_status").val(dataRecord.status);
						$("#id_jabatan").val(dataRecord.jabatan);
						$("#id_tmtjabatan").val(dataRecord.tmtpangkat);
						$("#id_pangkat").val(dataRecord.pangkat);
						$("#id_tmtgolongan").val(dataRecord.tmt_golongan);
						$("#id_jabfungsional").val(dataRecord.jab_fungsional);
						$("#id_tmtfungsional").val(dataRecord.tmt_fungsional);
						$("#id_cpns").val(dataRecord.cpns);
						$("#id_tmtcpns").val(dataRecord.tmt_cpns);
						$("#id_pns").val(dataRecord.pns);
						$("#id_tmtpns").val(dataRecord.tmt_pns);
						$("#id_gaji").val(dataRecord.gajisesuaisk);
						$("#id_tmtgaji").val(dataRecord.tmtgaji);
						$("#id_tinggibdn").val(dataRecord.tinggibdn);
						$("#id_beratbdn").val(dataRecord.beratbdn);
						$("#id_rambut").val(dataRecord.bentukrambut);
						$("#id_muka").val(dataRecord.bentukmuka);
						$("#id_warnakulit").val(dataRecord.warnakulit);
						$("#id_cirikusus").val(dataRecord.cirikusus);
						$("#id_cacattubuh").val(dataRecord.cacattubuh);
						$("#id_hobi").val(dataRecord.hobi);
						$("#id_bpjs").val(dataRecord.bpjs);
						$("#id_nomoridi").val(dataRecord.nomoridi);
						$("#id_keanggotaanprofesi").val(dataRecord.keanggotaanprofesi);
						$("#id_nomorstr").val(dataRecord.nomorstr);
						$("#id_nomorsip1").val(dataRecord.nomorsip1);
						$("#id_nomorsip2").val(dataRecord.nomorsip2);
						$("#id_nomorsip3").val(dataRecord.nomorsip3);
						$("#id_google").val(dataRecord.google);
						$("#id_shinta").val(dataRecord.shinta);
						$("#id_scopus").val(dataRecord.scopus);
						$("#id_orcid").val(dataRecord.orcid);
						var foto = dataRecord.foto;
						if (foto == null || foto == ''){
							$('#preview').attr('src', 'dist/img/takadagambar.jpg');
						} else {
							$('#preview').attr('src', 'images/pegawai/'+foto);
						}
                    }
                },
                { text: 'Penempatan', datafield: 'ppabp', filtertype: 'checkedlist', width: '10%', cellsalign: 'left', align: 'center' },
                { text: 'Foto', width: '3%', cellsrenderer: photorender, editable: false, sortable: false, filterable: false },
                { text: 'Kode Pegawai', width: '10%', datafield: 'nip_baru', cellsalign: 'left', align: 'center'},
                { text: 'Nama', datafield: 'nama_lengkap', width: '15%', cellsalign: 'left', align: 'center' },
                { text: 'Unit Kerja', datafield: 'unit_kerja', width: '13%', cellsalign: 'left', align: 'center' },
                { text: 'Tgl Masuk', datafield: 'tmt_golongan', width: '7%', cellsalign: 'center', align: 'center' },
                { text: 'Masa Kerja', cellsrenderer: mkgrender, width: '8%', cellsalign: 'left', align: 'center', editable: false, sortable: false, filterable: false },
                { text: 'Jabatan', datafield: 'jabatan', width: '13%', cellsalign: 'left', align: 'center' },
                { text: 'Alamat', datafield: 'alamat', width: '15%', cellsalign: 'left', align: 'center' },
                { text: 'No. HP', datafield: 'no_hp', width: '10%', cellsalign: 'center', align: 'center' },
                { text: 'Email', datafield: 'email', width: '10%', cellsalign: 'left', align: 'center' },
                { text: 'Finger ID', datafield: 'kode', width: '7%', cellsalign: 'center', align: 'center' },
                { text: 'Agama', datafield: 'agama', width: '7%', cellsalign: 'center', align: 'center' },
                { text: 'Gol. Pegawai', datafield: 'pangkat', width: '10%', cellsalign: 'center', align: 'center' },
                { text: 'Pendidikan', datafield: 'pend_akhir', width: '10%', cellsalign: 'center', align: 'center' },
                { text: 'Gaji Pokok', datafield: 'gajisesuaisk', width: '7%', cellsalign: 'right', align: 'center' },
                { text: 'Uang Makan', datafield: 'tjberas', width: '7%', cellsalign: 'right', align: 'center' },
                { text: 'Tj.Pengabdian', columngroup: 'tunjangan', datafield: 'tjfungs', width: '7%', cellsalign: 'right', align: 'center' },
                { text: 'Tj.Pendidikan', columngroup: 'tunjangan', datafield: 'tjupns', width: '7%', cellsalign: 'right', align: 'center' },
                { text: 'Tj.Jabatan', columngroup: 'tunjangan', datafield: 'tjstruk', width: '7%', cellsalign: 'right', align: 'center' },
                { text: 'Variabel', columngroup: 'tunjangan', datafield: 'tjlain', width: '7%', cellsalign: 'right', align: 'center' },
                { text: 'Nama Bank', datafield: 'namabank', width: '7%', cellsalign: 'right', align: 'center' },
                { text: 'Nomor Rekening', datafield: 'norek', width: '7%', cellsalign: 'right', align: 'center' },
                { text: 'BPJS Kes', datafield: 'karpeg', width: '7%', cellsalign: 'right', align: 'center' },
                { text: 'BPJS Ket', datafield: 'lama_kenaikan_pangkat', width: '7%', cellsalign: 'right', align: 'center' },
                { text: 'NPWP', datafield: 'npwp', width: '7%', cellsalign: 'left', align: 'center' },
                { text: 'Nomor STR', datafield: 'cpns', width: '10%', cellsalign: 'left', align: 'center' },
                { text: 'Nomor SIP', datafield: 'pns', width: '10%', cellsalign: 'left', align: 'center' },
            ],
            columngroups: 
            [
                { text: 'Tunjangan', align: 'center', name: 'tunjangan' },
            ]
        });
    }
    $(document).ready(function() {
        $('#divtambahpegawai').hide();
		$('#loading').show();
		$("#btnexport").click(function(){		
			var gridContent = $("#gridpegawai").jqxGrid('exportdata', 'json');
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
						var td = document.createElement("td");
							td.setAttribute('style', 'mso-number-format: "\@";');
							td.innerHTML = data[i][col[j]];
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
        $('#btnuploadpegawai').on('click', function (){
			$("#modaluploadpegawai").modal('show');
		});
		$('#btntutuplaporan').on('click', function (){
			$('.divlaporan').hide();
			$('.divawal').show();
		});
		$("#btnuploadexcel").click(function(){
			var val01=document.getElementById('soal_fileexcel');
			if ($('#soal_fileexcel').val() == ''){
				swal({
					title	: 'Stop',
					text	: 'File Kosong',
					type	: 'warning',
				})
			} else {
				var form_data = new FormData();
					form_data.append('val01', 'uploadpegawai');
					form_data.append('set02', '');
					form_data.append('set03', '');
					form_data.append('file', val01.files[0]);
					form_data.append('_token', '{{csrf_token()}}');
				$("#modaluploadpegawai").modal('hide');
				$('#loading').show();
				$.ajax({
					url         : '{{ route("exUploadSuratKepegawaian") }}',
					data        : form_data,
					type        : 'POST',
					contentType : false,
					processData : false,
					success     : function (data) {
						$('#loading').hide();
						$("html, body").animate({ scrollTop: 0 }, "slow");
						var source      = {
							datafields: [
								{ name: 'nip_baru', type: 'text'},
								{ name: 'kode', type: 'text'},
								{ name: 'tmt_golongan', type: 'text'},
								{ name: 'nama', type: 'text'},
								{ name: 'depan', type: 'text'},
								{ name: 'belakang', type: 'text'},
								{ name: 'nokk', type: 'text'},
								{ name: 'nik', type: 'text'},
								{ name: 'tmpt_lahir', type: 'text'},
								{ name: 'tgl_lahir', type: 'text'},
								{ name: 'jenis_kelamin', type: 'text'},
								{ name: 'alamat', type: 'text'},
								{ name: 'kelurahan', type: 'text'},
								{ name: 'kecamatan', type: 'text'},
								{ name: 'kota', type: 'text'},
								{ name: 'provinsi', type: 'text'},
								{ name: 'agama', type: 'text'},
								{ name: 'kawin', type: 'text'},
								{ name: 'no_hp', type: 'text'},
								{ name: 'email', type: 'text'},
								{ name: 'jabatan', type: 'text'},
								{ name: 'jenispeg', type: 'text'},
								{ name: 'unitkerja', type: 'text'},
								{ name: 'status_jabatan', type: 'text'},
								{ name: 'status_pegawai', type: 'text'},
								{ name: 'str', type: 'text'},
								{ name: 'sip', type: 'text'},
								{ name: 'masaberlaku', type: 'text'},
								{ name: 'status', type: 'text'},
								{ name: 'keterangan', type: 'text'},
							],
							localdata: data,
							datatype: "json",
						};
						var dataAdapter = new $.jqx.dataAdapter(source);
						$('.divgrafik').hide();
						$('.divtabel').hide();
						$('.divawal').hide();
						$('.divlaporan').show();
						$("#gridlaporan").jqxGrid({
							width: '100%',
							pageable: true,
							filterable: true,
							showfilterrow: true,
							autoheight: true,
							autorowheight: true,
							source: dataAdapter,
							columnsresize: true,
							theme: "orange",
							selectionmode: 'multiplecellsextended',
							columns: [
								{ text: 'Nama', datafield: 'nama', width: '20%', cellsalign: 'left', align: 'center'  },
								{ text: 'Nomor Pegawai', datafield: 'nip_baru', width: '7%', cellsalign: 'center', align: 'center'  },
								{ text: 'Email', datafield: 'email', width: '8%', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  },
								{ text: 'UnitKerja', datafield: 'unitkerja', width: '15%', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  },
								{ text: 'Jabatan', datafield: 'jabatan', width: '20%', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  },
								{ text: 'Keterangan', datafield: 'keterangan', width: '23%', cellsalign: 'left', align: 'center'  },
								{ text: 'Force Input', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', cellsrenderer: function () {
									return "Input";
									}, buttonclick: function (row) {		
										editrow = row;	
										var offset 		= $("#gridlaporan").offset();		
										var dataRecord 	= $("#gridlaporan").jqxGrid('getrowdata', editrow);
										var cekket      = dataRecord.status;
										if (cekket == 'sukses'){
											swal({
												title   : 'Stop',
												text    : 'Tombol Ini Khusus Yang Berstatus Gagal Input',
												type    : 'warning',
											})
										} else {
											$('#divtambahpegawai').show();
											$('.divgrafik').hide();
											$('.divtabel').hide();
											$("#id_idpeg").val('new');
											$("#id_ppabp").val("{{Session('fakpanjang')}}");
											$("#id_homebase").val('-');
											$("#id_keterangan").val('-');
											$("#id_kelas").val('0');
											$("#id_niplama").val('');
											$("#id_npwp").val('');
											$("#id_nidn").val('');
											$("#id_karpeg").val('');
											$("#id_nira").val('');
											$("#id_nip").val(dataRecord.nip_baru);
											$("#id_jenis").val('NIK');
											$("#id_tahunmsk").val(dataRecord.tmt_golongan);
											$("#id_nama").val(dataRecord.nama);
											$("#id_nokk").val(dataRecord.nokk);
											$("#id_ktp").val(dataRecord.nik);
											$("#id_tmplhr").val(dataRecord.tmpt_lahir);
											$("#id_tgllhr").val(dataRecord.tgl_lahir);
											$("#id_kelamin").val(dataRecord.jenis_kelamin);
											$("#id_kode").val(dataRecord.kode);
											$("#id_glrdepan").val(dataRecord.depan);
											$("#id_glrblakang").val(dataRecord.belakang);
											$("#id_kepakaran").val(dataRecord.kepakaran);
											$("#id_bidangilmu").val('');
											$("#id_bidangilmu3").val('');
											$("#id_alamatmlg").val(dataRecord.alamat);
											$("#id_alamatasal").val(dataRecord.alamat);
											$("#id_kelurahan").val(dataRecord.kelurahan);
											$("#id_kecamatan").val(dataRecord.kecamatan);
											$("#id_kota").val(dataRecord.kota);
											$("#id_propinsi").val(dataRecord.provinsi);
											$("#id_agama").val(dataRecord.agama);
											$("#id_kawin").val(dataRecord.kawin);
											$("#id_hape").val(dataRecord.no_hp);
											$("#id_emailub").val(dataRecord.email);
											$("#id_emaillain").val(dataRecord.email);
											$("#id_unitkerja").val(dataRecord.unitkerja);
											$("#id_laborat").val('');
											$("#id_status_jbtn").val(dataRecord.status_jabatan);
											$("#id_jenispeg").val(dataRecord.jenispeg);
											$("#id_status").val('1');
											$("#id_jabatan").val(dataRecord.jabatan);
											$("#id_tmtjabatan").val('');
											$("#id_pangkat").val('');
											$("#id_tmtgolongan").val(dataRecord.tmt_golongan);
											$("#id_jabfungsional").val('');
											$("#id_tmtfungsional").val('');
											$("#id_cpns").val(dataRecord.str);
											$("#id_tmtcpns").val(dataRecord.masaberlaku);
											$("#id_pns").val(dataRecord.sip);
											$("#id_tmtpns").val(dataRecord.masaberlaku);
											$("#id_gaji").val('0');
											$("#id_tmtgaji").val('');
											$("#id_tinggibdn").val('0');
											$("#id_beratbdn").val('0');
											$("#id_rambut").val('lurus');
											$("#id_muka").val('lonjong');
											$("#id_warnakulit").val('sawo matang');
											$("#id_cirikusus").val('-');
											$("#id_cacattubuh").val('-');
											$("#id_hobi").val('-');
											$("#id_bpjs").val('');
											$("#id_nomoridi").val('');
											$("#id_keanggotaanprofesi").val('');
											$("#id_nomorstr").val('');
											$("#id_nomorsip1").val('');
											$("#id_nomorsip2").val('');
											$("#id_nomorsip3").val('');
											$("#id_google").val('');
											$("#id_shinta").val('');
											$("#id_scopus").val('');
											$("#id_orcid").val('');
											$('#preview').attr('src', 'dist/img/takadagambar.jpg');
											$("html, body").animate({ scrollTop: 0 }, "slow");
										}
									}
								},
							]
						});
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
		$('#loading').hide();
        $('.divawal').show();
		$('.divlaporan').hide();
		$('#btntambahpegawai').on('click', function (){
			$('#divtambahpegawai').show();
			$('.divgrafik').hide();
			$('.divtabel').hide();
			$("#id_idpeg").val('new');
		});
		$('#btncetakblankcv').on('click', function (){
			var token = document.getElementById('token').value;
			$.post('dokar/exblankocv', { _token: token },
			function(data){
			var newWindow = window.open('', '', 'width=800, height=500'),
			document = newWindow.document.open(),
					pageContent =
						'<!DOCTYPE html>\n' +
						'<html>\n' +
						'<head>\n' +
						'<meta charset="utf-8" />\n' +
						'<title>Blank CV</title>\n' +
						'</head>\n' +
						'<body>' + data + '</body>\n</html>';
			document.write(pageContent);
			document.close();
			newWindow.print();
			});
		});	
		$('#btnaddfile').on('click', function (){
			$('#addfile').click();
		});
		$("#updatebiodata").click(function(){
			var set01=document.getElementById('id_idpeg').value;
			var set02=document.getElementById('id_nip').value;
			var set03=document.getElementById('id_nama').value;
			var set04=document.getElementById('id_tmplhr').value;
			var set05=document.getElementById('id_tgllhr').value;
			var set06=document.getElementById('id_ktp').value;
			var set07=document.getElementById('id_kelamin').value;
			var set08=document.getElementById('id_glrdepan').value;
			var set09=document.getElementById('id_glrblakang').value;
			var set10=set08;
			var set11=set09;
			var set12=document.getElementById('id_bidangilmu').value;
			var set13=document.getElementById('id_alamatmlg').value;
			var set14=document.getElementById('id_alamatasal').value;
			var set15=document.getElementById('id_propinsi').value;
			var set16=document.getElementById('id_kota').value;
			var set17=document.getElementById('id_agama').value;
			var set18=document.getElementById('id_kawin').value;
			var set19=document.getElementById('id_status_jbtn').value; //gantidaritelpon
			var set20=document.getElementById('id_hape').value;
			var set21=document.getElementById('id_emailub').value;
			var set22=document.getElementById('id_emaillain').value; //gantidariemaillain
			var set23=document.getElementById('id_unitkerja').value;
			var set24=document.getElementById('id_laborat').value;
			var set25=document.getElementById('id_status').value;
			var set26=document.getElementById('id_jenispeg').value;
			var set27=document.getElementById('id_nidn').value;
			var set28=document.getElementById('id_tahunmsk').value;
			var set29=document.getElementById('id_cpns').value;
			var set30=document.getElementById('id_tmtcpns').value;
			var set31=document.getElementById('id_pns').value;
			var set32=document.getElementById('id_tmtpns').value;
			var set33=document.getElementById('id_jenis').value;
			var set34=document.getElementById('id_niplama').value;
			var set35=document.getElementById('id_karpeg').value;
			var set36=document.getElementById('id_nira').value;
			var set37=document.getElementById('id_npwp').value;
			var set38=document.getElementById('id_bpjs').value;
			var set39=document.getElementById('id_homebase').value;
			var set40=document.getElementById('id_kelurahan').value;
			var set41=document.getElementById('id_kecamatan').value;
			var set42=document.getElementById('id_jabfungsional').value;
			var set43=document.getElementById('id_pangkat').value;
			var set44=document.getElementById('id_tmtgolongan').value;
			var set45=document.getElementById('id_tmtjabatan').value;
			var set46=document.getElementById('id_jabatan').value; //cekdicontroller
			var set47=document.getElementById('id_tmtfungsional').value;
			var set48=document.getElementById('id_kode').value;
			var set49=document.getElementById('id_tinggibdn').value;
			var set50=document.getElementById('id_beratbdn').value;
			var set51=document.getElementById('id_warnakulit').value;
			var set52=document.getElementById('id_rambut').value;
			var set53=document.getElementById('id_muka').value;
			var set54=document.getElementById('id_cirikusus').value;
			var set55=document.getElementById('id_cacattubuh').value;
			var set56=document.getElementById('id_hobi').value;
			var set57=document.getElementById('id_kepakaran').value; // Ganti dari kepakaran
			var set58=document.getElementById('id_nokk').value; // Ganti dari kepakaran
			var set59=document.getElementById('id_bidangilmu3').value;
			var set60=document.getElementById('addfile');
			var set61=document.getElementById('id_kelas').value;
			var set62=document.getElementById('id_gaji').value;
			var set63=document.getElementById('id_tmtgaji').value;
			var set64=document.getElementById('id_ppabp').value;
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
					form_data.append('val60', '');
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
						$('.divawal').show();
						$('.divgrafik').show();
						$('.divtabel').show();
						$("#gridpegawai").jqxGrid('updatebounddata', 'filter');
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
		$('.btnkembalikeawal').on('click', function (){
			$('#divtambahpegawai').hide();
			$('.divawal').show();
			$('.divgrafik').show();
			$('.divtabel').show();
		});
		var sourcejenispegawai = {
			datatype: "json",
			datafields: [
				{ name: 'jenispeg' },
				{ name: 'jumlah' },
			],
			url: 'dokar/statjenispegawai'
		};
		var datajenispegawai 	= new $.jqx.dataAdapter(sourcejenispegawai);
		var settingjenispegawai = {
			title: "Statistik Jenis Pegawai",
			description: "{{ $fakultas }}",
			enableAnimations: true,		
			showBorderLine: true,
			colorScheme: 'scheme01',
			padding: { left: 5, top: 5, right: 5, bottom: 5 },
			titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },		
			source: datajenispegawai,
			seriesGroups:
				[
					{
						type: 'pie',
						showLabels: true,
						series:
						[
							{
								dataField: 'jumlah',
								displayText: 'jenispeg',
								labelRadius: 100,
								initialAngle: 15,
								radius: 50,
								centerOffset: 0,
								formatSettings: { decimalPlaces: 1 }
							}
						]
					}
				]
		};
		$('#divjenispegawai').jqxChart(settingjenispegawai);
		var sourcependidikan = {
			datatype: "json",
			datafields: [
				{ name: 'pendidikan' },				
				{ name: 'jumlah' },			
			],
			url: 'dokar/statpendidikan'
		};
		var datajenispendidikan		= new $.jqx.dataAdapter(sourcependidikan);
		var settingjenispendidikan 	= {
			title: "Statistik Pendidikan Pegawai",
			description: "{{ $fakultas }}",
			enableAnimations: true,		
			showBorderLine: true,
			colorScheme: 'scheme03',
			padding: { left: 5, top: 5, right: 5, bottom: 5 },
			titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },		
			source: datajenispendidikan,
			seriesGroups:
				[
					{
						type: 'pie',
						showLabels: true,
						series:
						[
							{
								dataField: 'jumlah',
								displayText: 'pendidikan',
								labelRadius: 100,
								initialAngle: 15,
								radius: 90,
								centerOffset: 0,
								formatSettings: { decimalPlaces: 1 }
							}
						]
					}
				]
		};
		$('#divpendidikan').jqxChart(settingjenispendidikan);
		var sourcegolongan = {
			datatype: "json",
			datafields: [
				{ name: 'jenisgolongan' },				
				{ name: 'jumlah' },			
			],
			url: 'dokar/statgolongan'
		};
		var datajgolongan 	= new $.jqx.dataAdapter(sourcegolongan);
		var settinggolongan = {
			title: "Statistik Golongan Ruang / Pangkat",
			description: "{{ $fakultas }}",
			enableAnimations: true,
			source: datajgolongan,
			xAxis:
				{
					dataField: 'jenisgolongan',
					displayText: 'Golongan',
					gridLines: { visible: true },
					showGridLines: true,
					labels:
					{
						angle: 90,
						horizontalAlignment: 'right',
						verticalAlignment: 'left',
						rotationPoint: 'left',
						offset: { x: 0, y: 5 }
					}
				},
			colorScheme: 'scheme02',
			seriesGroups:
				[
					{
						type: 'column',
						valueAxis:
						{
							visible: true,
							title: { text: 'Jumlah<br>' }
						},
						series: [
								{ dataField: 'jumlah', displayText: 'Jumlah Pegawai' },							
							]
					}				
				]
		};
		$('#divjenisgolongan').jqxChart(settinggolongan);
		var sumberallpenerima = {
			datatype: "json",
			datafields: [
				{ name: 'id'},
				{ name: 'nama_lengkap', type: 'text'},
				{ name: 'unit_kerja', type: 'text'},
				{ name: 'cpns', type: 'text'},
				{ name: 'tmt_cpns', type: 'text'},
			],
			updaterow: function (rowid, rowdata, commit) {commit(true);},
			url: 'dokar/jstatpangkat',
			cache: false
		};
		var dataallpenerima = new $.jqx.dataAdapter(sumberallpenerima);
		$("#gridtubel").jqxGrid({
			width: '100%',
			filterable: true,
			showfilterrow: true,
			columnsresize: true,
			pageable: true,
			source: dataallpenerima,
			theme: "energyblue",
			columns: [
				{ text: 'Nama', datafield: 'nama_lengkap', width: '30%', cellsalign: 'left', align: 'center'  },
				{ text: 'Unit Kerja', editable: false, sortable: false, filterable: false, datafield: 'unit_kerja', width: '25%', cellsalign: 'left', align: 'center'  },
				{ text: 'Nomor STR', datafield: 'cpns', width: '30%', cellsalign: 'left', align: 'center'  },
				{ text: 'TMT', datafield: 'tmt_cpns', width: '15%', cellsalign: 'left', align: 'center'  },
			],
		});
		var sumberpensiun = {
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
			url			: 'dokar/jstatpensiun',
			root		: 'data',
			totalrecords: 'total',
			cache		: false,
			filter		: function () {
				$("#gridpensgridpensiuniunonly").jqxGrid('updatebounddata', 'filter');
			},
			sort: function () {
				$("#gridpensiun").jqxGrid('updatebounddata', 'sort');
			},
			beforeprocessing: function (data) {
				if (data != null) {
					sumberpensiun.totalrecords = data.total;
				}
			}
		};
		var datajpensiun = new $.jqx.dataAdapter(sumberpensiun);
		$("#gridpensiun").jqxGrid({
			width			: '100%',
			filterable		: true,
			showfilterrow	: true,
			columnsresize	: true,
			virtualmode		: true,
			pageable		: true,
			rendergridrows	: function(obj) {
				return obj.data;
			},
			source			: datajpensiun,
			theme			: "energyblue",
			columns			: [
				{ text: 'Nama', datafield: 'nama_lengkap', width: '30%', cellsalign: 'left', align: 'center'  },
				{ text: 'Unit Kerja', editable: false, sortable: false, filterable: false, datafield: 'unit_kerja', width: '25%', cellsalign: 'left', align: 'center'  },
				{ text: 'Penempatan', filtertype: 'checkedlist', datafield: 'ppabp', width: '30%', cellsalign: 'left', align: 'center'  },
				{ text: 'TMT', datafield: 'tmt_pensiun', width: '15%', cellsalign: 'left', align: 'center'  },
			],
		});
		openpegawai();
		$('.topbtnopenpegawai').click(function(){
			openpegawai();
		});
    });
</script>
@endpush