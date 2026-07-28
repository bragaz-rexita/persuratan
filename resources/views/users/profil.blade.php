@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Welcome {!! $biodata->nama_lengkap !!} </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ Request::url() }}">{{ Route::current()->getName() }}</a></li>
            </ol>
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
								<a id="btnquizioner" class="btn btn-block btn-social btn-warning">
									<i class="fa fa-wechat"></i> Chat Room
								</a>
								<a href="/berkaspelamar"  class="btn btn-block btn-social btn-primary">
									<i class="fa fa-print"></i> Cetak CV
								</a>
								<a id="btnubahpassword" class="btn btn-block btn-social btn-info">
									<i class="fa fa-users"></i> Ubah Password
								</a>
								@if (Session('fakultas') == 'BS')
									@if (Session('previlage') == 'peserta' OR Session('previlage') == 'warga')
									<a id="btnshowonline" class="btn btn-block btn-social btn-primary">
										<i class="fa fa-upload"></i> Upload Persyaratan
									</a>
									<a id="btnkerjakan" class="btn btn-block btn-social btn-success">
										<i class="fa fa-pencil"></i> Soal Ujian
									</a>
									<a id="btnpengumuman" class="btn btn-block btn-social btn-danger">
										<i class="fa fa-graduation-cap"></i> Pengumuman
									</a>
									@endif
								@endif
								<a id="btnshowdepan" class="btn btn-block btn-social btn-secondary">
									<i class="fa fa-user"></i> Biodata
								</a>
							</div>
						</div>
					</div>
                </div>
                <div class="col-md-9">
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
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="berkas_file">
										<label class="custom-file-label" for="berkas_file">File </label>
									</div>
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
                        <div class="col-lg-7 col-md-7">
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h3 class="card-title">Biodata.</h3>
									<div class="card-tools">
										<button type="button" class="btn btn-tool" data-card-widget="collapse">
											<i class="fa fa-minus"></i>
										</button>
									</div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-7">
                                                <label for="id_nama">Nama (Tanpa Gelar)</label>
                                                <input type="text" class="form-control" id="id_nama" value="{!!$biodata->nama!!}">
                                            </div>
                                            <div class="col-md-5">
                                                <label for="id_ktp">No.KTP</label>
                                                <input type="text" id="id_ktp" class="form-control" value="{{$biodata->ktp}}">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control" id="id_masterno" value="{{$biodata->id}}">
                                    
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
										<label for="id_alamatasal">Alamat di Asal (Sesuai KTP)</label>
										<input type="text" class="form-control" id="id_alamatasal" value="{{$biodata->alamat}}">
									</div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6">
                                                <label for="id_kelurahan">Kelurahan/Desa (Sesuai KTP)</label>
												@if(isset($settings) && !empty($settings))
													<select id="id_kelurahan" class="form-control select2">
                                                    	<option value=""> Pilih Salah Satu</option>
                                                		@foreach($settings as $rows)
															@if ($rows['desa'] == $biodata->kelurahan)
																<option val01="{!! $rows['kecamatan'] !!}" val02="{!! $rows['kabupaten'] !!}" val03="{!! $rows['provinsi'] !!}" value="{!! $rows['desa'] !!}" selected>{!! $rows['desa'] !!}</option>
															@else
																<option val01="{!! $rows['kecamatan'] !!}" val02="{!! $rows['kabupaten'] !!}" val03="{!! $rows['provinsi'] !!}" value="{!! $rows['desa'] !!}">{!! $rows['desa'] !!}</option>
															@endif
														@endforeach
													</select>
                                            	@else
													<input type="text" class="form-control" id="id_kelurahan" value="{{$biodata->kelurahan}}">
												@endif
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
                                                <label for="id_telpon">No.Telp</label>
                                                <input type="text" id="id_telpon" class="form-control" value="{{$biodata->no_telp}}">
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
                    </div><!-- /batas halaman muka -->
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
					<div id="halamantest">
                        <div class="card card-success card-outline" >
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{!!$foto!!}" alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">Pilih Ujian Sesuai Jadwal</h3>
                                <p class="text-muted text-center">{!! $biodata->nama_lengkap !!}</p>
                            </div>
                            <div class="card-body" id="divtambahonline">
								<ul>
                                    <li>Berdoalah sebelum memulai ujian</li>
                                    <li>Setiap Ujian Mempunyai 2 Timer :
                                        <ol>
                                            <li>Timer Berdasarkan On / Off Pengawas</li>
                                            <li>Timer Sesuai Waktu yang di tentukan</li>
                                        </ol>
                                    </li>
                                    <li>Timer akan berjalan ketika Soal Ujian Pertama di buka</li>
                                    <li>Timer berlaku untuk keseluruhan soal ujian dan tidak ada timer untuk masing-masing soal</li>
                                </ul>
							</div>
							<div class="card-footer">
								<div id="gridtest"></div>
                            </div>
                        </div>
                    </div><!-- /batas halaman Ujian -->
                    <div id="halamanpengumuman">
                        <div class="card card-danger card-outline" >
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{!!$foto!!}" alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">Pengumuman Hasil Ujian</h3>
                                <p class="text-muted text-center">{!! $biodata->nama_lengkap !!}</p>
                            </div>
                            <div class="card-body">
                                <div class="error-page">
                                    <h2 class="headline text-danger"><i class="fa fa-warning"></i></h2>
                                    <div class="error-content">
                                        <h3><strong>PERHATIAN</strong></h3>
                                        <p></p>
                                        Sertifikat Yang Tertampil di Sini Adalah DRAFT (BELUM DI TANDATANGANI SECARA ELEKTRONIK), Sertifikat yang telah di tandatangani secara elektronik akan kami kirimkan ke Laman Ini. Terimakasih atas perhatiannya
                                    </div>
                                </div>
							</div>
							<div class="card-footer">
								<div id="gridpengumuman"></div>
                            </div>
                        </div>
                    </div><!-- /batas halaman Pengumuman -->
                    <div id="halamanquiz">
						<div class="card card-warning direct-chat direct-chat-warning shadow">
							<div class="card-header">
								<h3 class="card-title">Lounge</h3>
								<div class="card-tools">
									<div id="timeremaining"></div>
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
										<button type="button" class="btn btn-success" id="sendpesan">Send</button>
									</span>
								</div>
							</div>
						</div>
                    </div><!-- /batas halaman Quiz -->
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
			<div class="form-group">
				<label for="id_kepakaran">Kepakaran</label>
				<input type="text" class="form-control" id="id_kepakaran" value="{{$biodata->kepakaran}}">
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
					</div> 
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
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="jenisujian" id="jenisujian" value="{{ Session('previlage') }}">

@endsection
@push('script')
<script>
	$(function () {
		bsCustomFileInput.init();
		$('#id_tgllhr').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
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
	$("#id_kelurahan").on('change', function () {
		var kelurahan 	= $(this).find('option:selected').attr('value');
		var kecamatan   = $(this).find('option:selected').attr('val01');
		var kota   		= $(this).find('option:selected').attr('val02');
		var provinsi    = $(this).find('option:selected').attr('val03');
		if(typeof(kecamatan) != "undefined" && kecamatan !== null) {
        	$("#id_kecamatan").val(kecamatan);
		}
		if(typeof(kota) != "undefined" && kota !== null) {
        	$("#id_kota").val(kota);
		}
		if(typeof(provinsi) != "undefined" && provinsi !== null) {
        	$("#id_propinsi").val(provinsi);
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
	$('.select2').select2({width: '100%'});
	function openedpage( jQuery ){
		var token=document.getElementById('token').value;
		$.post('surat/chatgetlist', { _token: token},
		function(data){
			$('#chatbody').html(data);
		});
	}
	window.onload = openedpage;
	setTimeout(function () { 
      openedpage();
    }, 60 * 10000);
	var start = new Date();
    CountDownTimer(start, 'timeremaining');
    function CountDownTimer(dt, id)
    {
        var end 	= new Date(dt.getTime() + 10000);
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
	var token = document.getElementById('token').value;
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
	$('#halamanquiz').hide();
	$('#halamantest').hide();
	$('#halamanpengumuman').hide();
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
	$("#export").click(function () {
		$("#printiki").btechco_excelexport({
			containerid: "printiki"
			, datatype: $datatype.Table
		});
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
	$('#sendpesan').on('click', function (){		
		var kirim   = document.getElementById('kirimpsn').value;
		var nama    = '';
		var foto    = '';
		var token   = document.getElementById('token').value;
		$.post('surat/catting', { val01: kirim, val02: nama, val03: foto, _token: token },
		function(data){
			$('#chatbody').html(data);
		});
	});
    $('#btnsimpandataupload').on('click', function (){
		var set01=document.getElementById('upload_id').value;
		var set02=document.getElementById('upload_namafile').value;
		var set03=document.getElementById('upload_data').value;
		var set04=document.getElementById('upload_tabel').value;
		var set05=document.getElementById('upload_file');
		if ($('#upload_file').val() == ''){
			swal({
				title	: 'Stop',
				text	: 'File Wajib di Isi',
				type	: 'warning',
			})
		} else {
			var form_data = new FormData();
			form_data.append('val01', set01);
			form_data.append('val02', set02);
			form_data.append('val03', set03);
			form_data.append('val04', set04);
			form_data.append('val05', set05.files[0]);
			form_data.append('_token', '{{csrf_token()}}');
			$.ajax({
				url: '../simba/exuploader',
				data: form_data,
				type: 'POST',
				contentType: false,
				processData: false,
				success: function (data) {
					if (set04 == 'Biodata'){
						var data = 'scan/files/'+set02;
						$("#preview").attr("src",data);
					}
					if (set04 == 'Data Ajar'){
						$("#griddataajar").jqxGrid('updatebounddata');
					}
					if (set04 == 'Data Sertifikat'){
						$("#griddatasertifikat").jqxGrid('updatebounddata');
					}
					if (set04 == 'Data Asesor'){
						$("#gridasesor").jqxGrid('updatebounddata');
					}
					if (set04 == 'Data Organisasi'){
						$("#gridorganisasi").jqxGrid('updatebounddata');
					}
					if (set04 == 'Data Seminar'){
						$("#gridseminar").jqxGrid('updatebounddata');
					}
					if (set04 == 'Data Anggota Keluarga'){
						$("#gridkeluarga").jqxGrid('updatebounddata');
					}
					if (set04 == 'Data Mutasi'){
						$("#gridmutasi").jqxGrid('updatebounddata');
					}
					if (set04 == 'Data Identitas'){
						$("#grididentitas").jqxGrid('updatebounddata');
					}
					if (set04 == 'Data Pendidikan'){
						$("#gridpendidikan").jqxGrid('updatebounddata');
					}
					if (set04 == 'Data Pangkat'){
						$("#gridpangkat").jqxGrid('updatebounddata');
					}
					if (set04 == 'Data Fungsional'){
						$("#gridfungsional").jqxGrid('updatebounddata');
					}
					if (set04 == 'Data Sertifikasi'){
						$("#gridsertifikasi").jqxGrid('updatebounddata');
					}
					if (set04 == 'Data Gaji'){
						$("#gridgaji").jqxGrid('updatebounddata');
					}
					if (set04 == 'Data Diklat'){
						$("#griddiklat").jqxGrid('updatebounddata');
					}
					if (set04 == 'Data Penghargaan'){
						$("#gridpenghargaan").jqxGrid('updatebounddata');
					}
					$("#modaluploader").modal('hide');
					$('#logprogram').html(data);
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
	$('#btnquizioner').on('click', function (){
		$('#halamanquiz').show();
	    $('#halamanmuka').hide();
        $('#halamanpengumuman').hide();
		$('#halamantest').hide();
		$('#halamanonline').hide();
		return false;
	});
    $('#btnshowdepan').on('click', function (){
		$('#halamanquiz').hide();
	    $('#halamanmuka').show();
        $('#halamanpengumuman').hide();
		$('#halamantest').hide();
		$('#halamanonline').hide();
		return false;
	});
	$('#btnkerjakan').on('click', function (){
		$('#halamanquiz').hide();
	    $('#halamanpengumuman').hide();
	    $('#halamantest').show();
		$('#halamanmuka').hide();
		$('#halamanonline').hide();
		$('#divtambahonline').hide();
		var val01=document.getElementById('id_prodi').value;
		var val02=document.getElementById('id_masterno').value;
		var val03=document.getElementById('jenisujian').value;
		var token=document.getElementById('token').value;
		var sourcedetail = {
			datatype: "json",
			datafields: [
                { name: 'id'},
                { name: 'ceel', type: 'text'},
                { name: 'kode', type: 'text'},
                { name: 'mulai', type: 'text'},
                { name: 'selesai', type: 'text'},
                { name: 'namaujian', type: 'text'},
                { name: 'supervisor', type: 'text'},
                { name: 'tlssupervisor', type: 'text'},
                { name: 'tipe', type: 'text'},
                { name: 'status', type: 'text'},
                { name: 'marking', type: 'text'},
                { name: 'jumlah', type: 'text'},
			    { name: 'timer', type: 'text'},
			],
			type: 'POST',
			data: {	set01: val02, set02:'cariujian', _token: token },
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
                { text: 'Start', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsrenderer: function () {
					return "Start";
					}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridtest").offset();		
						var dataRecord 	= $("#gridtest").jqxGrid('getrowdata', editrow);
						swal({
							title: 'Siapkah Memulai Ujian ?',
							text: "Timer Akan Aktif Apabila Telah Melewati Waktu Start Dan Soal Sudah di Buka",
							type: 'warning',
							showCancelButton: true,
							confirmButtonClass: 'btn btn-confirm mt-2',
							cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
							confirmButtonText: 'Yes'
						}).then(function () {
							$.post('{{ route("exInputBankSoal") }}', { set01: 'setujian', set02: dataRecord.marking, set03: '', _token: '{{ csrf_token() }}' },
                            function(data){
                                var set03	= 'test';
                                setTimeout(function () { 
                                    window.location.href = set03;
                                }, 2000);
								swal({
									title	: 'Info',
									text	: data,
									type	: 'warning',
								})
                                return false;
                            });	
						});
					}
				},
				{ text: 'Exam Name', datafield: 'namaujian', width: '36%', align: 'center', cellsalign: 'left' },
                { text: 'Start', datafield: 'mulai', width: '18%', align: 'center', cellsalign: 'left' },
                { text: 'Finish', datafield: 'selesai', width: '18%', align: 'center', cellsalign: 'left' },
                { text: 'Timer', datafield: 'timer', width: '10%', cellsalign: 'center', align: 'center' },
			    { text: 'Case', datafield: 'jumlah', width: '10%', cellsalign: 'center', align: 'center' },
			]
		});
	});
    $('#btnpengumuman').on('click', function (){
		$('#halamanquiz').hide();
	    $('#halamanpengumuman').show();
		$('#halamantest').hide();
		$('#halamanmuka').hide();
		$('#halamanonline').hide();
		$('#divtambahonline').hide();
		var id      = "{{Session('id')}}";
		var val01   = document.getElementById('id_prodi').value;
		var val02   = document.getElementById('id_masterno').value;
		var token   = document.getElementById('token').value;
		var sourcedetail = {
			datatype: "json",
			datafields: [
                { name: 'id'},
                { name: 'ceel', type: 'text'},
                { name: 'kode', type: 'text'},
                { name: 'mulai', type: 'text'},
                { name: 'selesai', type: 'text'},
                { name: 'namaujian', type: 'text'},
                { name: 'supervisor', type: 'text'},
                { name: 'tlssupervisor', type: 'text'},
                { name: 'tipe', type: 'text'},
                { name: 'status', type: 'text'},
                { name: 'marking', type: 'text'},
                { name: 'jumlah', type: 'text'},
			    { name: 'timer', type: 'text'},
			    { name: 'pengumuman', type: 'text'},
			],
			type: 'POST',
			data: {	set01: val02, set02:'Pengumuman', _token: token },
			url:  '{{ route("jsonaktiftest") }}',
		};
		var datadetail = new $.jqx.dataAdapter(sourcedetail);
		$("#gridpengumuman").jqxGrid({
			width: '100%',
			filterable: true,
			columnsresize: true,
			theme: "energyblue",
			sortable: true,
			autoheight: true,
			pageable: true,
			source: datadetail,
			columns: [
                { text: 'Hasil', editable: false, sortable: false, filterable: false,columntype: 'button', width: '8%', align: 'center', cellsrenderer: function () {
					return "View";
					}, buttonclick: function (row) {		
						editrow = row;	
						var offset 		= $("#gridpengumuman").offset();
						var dataRecord 	= $("#gridpengumuman").jqxGrid('getrowdata', editrow);
                        var statusujian = dataRecord.pengumuman;
                        if (statusujian == '1'){
                            window.open("{{URL::to("/")}}/karpes/dd1f14bce8311-"+dataRecord.id+"-b9504e032cde2424102", '_blank');
                        } else {
                            swal({
                                title	: 'Stop',
                                text	: 'Pengumuman Belum di Buka, Mohon Bersabar Untuk Info Lebih Lanjut',
                                type	: 'warning',
                            })
                        }
					}
				},
                { text: 'Exam Name', datafield: 'namaujian', width: '28%', align: 'center', cellsalign: 'left' },
                { text: 'Start', datafield: 'mulai', width: '18%', align: 'center', cellsalign: 'left' },
                { text: 'Finish', datafield: 'selesai', width: '18%', align: 'center', cellsalign: 'left' },
                { text: 'Timer', datafield: 'timer', width: '10%', cellsalign: 'center', align: 'center' },
			    { text: 'Case', datafield: 'jumlah', width: '10%', cellsalign: 'center', align: 'center' },
			    { text: 'Status', datafield: 'status', width: '8%', cellsalign: 'center', align: 'center' },
			]
		});
	});
    $('#btnshowonline').on('click', function (){
		$('#halamanquiz').hide();
	    $('#halamanpengumuman').hide();
	    $('#halamantest').hide();
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
			data: {	val01:'Ujian Dinas', val02:set02, _token: token },
			url:  '{{ route("jsonDataSyaratPelamar") }}',
		};
		var filerenderer = function (row, column, value) {
			var size      = $('#gridonline').jqxGrid('getrowdata', row).size;
			var filebukti = $('#gridonline').jqxGrid('getrowdata', row).title;
			var type      = $('#gridonline').jqxGrid('getrowdata', row).type;
			if (filebukti == ''){
				var linkbukti = '<div style="background: white;"></div>';
			} else {
				var linkbukti = '<div style="background: white;"><a href="'+filebukti+'" target="_blank" class="btn btn-primary btn-sm">Download</a></div>';
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
				{ text: 'Nama Berkas Syarat', datafield: 'name', width: '35%', cellsalign: 'left', align: 'center'  },
				{ text: 'Kewajiban', datafield: 'type', width: '25%', align: 'center', cellsalign: 'center'},
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
		var val05=document.getElementById('berkas_file');
		if ($('#berkas_file').val() == ''){
			swal({
				title	: 'Stop',
				text	: 'File Belum di Pilih',
				type	: 'warning',
			})
		} else {
			var form_data = new FormData();
				form_data.append('set01', val01);
				form_data.append('set02', val01);
				form_data.append('set03', '');
				form_data.append('set04', '');
				form_data.append('set05', 'inputberkas');
				form_data.append('file', val05.files[0]);
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
});
</script>
@endpush