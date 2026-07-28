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
								<a id="btnshowdepan" class="btn btn-block btn-social btn-secondary">
									<i class="fa fa-user"></i> Biodata
								</a>
								<a href="/berkaspelamar"  class="btn btn-block btn-social btn-primary">
									<i class="fa fa-print"></i> Cetak CV
								</a>
								<a id="btnubahpassword" class="btn btn-block btn-social btn-info">
									<i class="fa fa-users"></i> Ubah Password
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
                                    <h3 class="card-title">Biodata</h3>
									<div class="card-tools">
										<button type="button" class="btn btn-tool" data-card-widget="collapse">
											<i class="fa fa-minus"></i>
										</button>
									</div>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" class="form-control" id="id_masterno" value="{{$biodata->idpeg}}">
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
												<select id="id_kelurahan" class="form-control select2">
                                                    <option value=""> Pilih Salah Satu</option>
                                                    @if(isset($settings) && !empty($settings))
														@foreach($settings as $rows)
															@if ($rows['desa'] == $biodata->kelurahan)
																<option val01="{!! $rows['kecamatan'] !!}" val02="{!! $rows['kabupaten'] !!}" val03="{!! $rows['provinsi'] !!}" value="{!! $rows['desa'] !!}" selected>{!! $rows['desa'] !!}</option>
															@else
																<option val01="{!! $rows['kecamatan'] !!}" val02="{!! $rows['kabupaten'] !!}" val03="{!! $rows['provinsi'] !!}" value="{!! $rows['desa'] !!}">{!! $rows['desa'] !!}</option>
															@endif
														@endforeach
													@endif
                                                </select>
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
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@push('script')
<script>
	$(function () {
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
		$("#id_kecamatan").val(kecamatan);
		$("#id_kota").val(kota);
		$("#id_propinsi").val(provinsi);
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
	$('#updatebiodata').on('click', function (){
		var set01=document.getElementById('id_masterno').value;
		var set02=document.getElementById('id_nip').value;
		var set03=document.getElementById('id_nama').value;
		var set04=document.getElementById('id_tmplhr').value;
		var set05=document.getElementById('id_tgllhr').value;
		var set06=document.getElementById('id_ktp').value;
		var set07=document.getElementById('id_kelamin').value;
		var set08=document.getElementById('id_glrdepan').value;
		var set09=document.getElementById('id_glrblakang').value;
		var set10=''; //document.getElementById('id_glrdepan2').value;
		var set11=''; //document.getElementById('id_glrblakang2').value;
		var set12=''; //document.getElementById('id_bidangilmu').value;
		var set13=document.getElementById('id_alamatmlg').value;
		var set14=document.getElementById('id_alamatasal').value;
		var set15=document.getElementById('id_propinsi').value;
		var set16=document.getElementById('id_kota').value;
		var set17=document.getElementById('id_agama').value;
		var set18=document.getElementById('id_kawin').value;
		var set19=document.getElementById('id_telpon').value;
		var set20=document.getElementById('id_hape').value;
		var set21=document.getElementById('id_emailub').value;
		var set22=document.getElementById('id_emaillain').value;
		var set23=''; //document.getElementById('id_unitkerja').value;
		var set24=''; //document.getElementById('id_laborat').value;
		var set25=''; //document.getElementById('id_status').value;
		var set26=''; //document.getElementById('id_jabatan').value;
		var set27=''; //document.getElementById('id_nidn').value;
		var set28=document.getElementById('id_tahunmsk').value;
		var set29=''; //document.getElementById('id_cpns').value;
		var set30=''; //document.getElementById('id_tmtcpns').value;
		var set31=''; //document.getElementById('id_pns').value;
		var set32=''; //document.getElementById('id_tmtpns').value;
		var set33=document.getElementById('id_jenis').value;
		var set34=''; //document.getElementById('id_niplama').value;
		var set35=''; //document.getElementById('id_karpeg').value;
		var set36=''; //document.getElementById('id_nira').value;
		var set37=document.getElementById('id_npwp').value;
		var set38=document.getElementById('id_bpjs').value;
		var set39=''; //document.getElementById('id_pees').value;
		var set40=document.getElementById('id_kelurahan').value;
		var set41=document.getElementById('id_kecamatan').value;
		var set42=''; //document.getElementById('id_jabfungsional').value;
		var set43=''; //document.getElementById('id_pangkat').value;
		var set44=''; //document.getElementById('id_tmtgolongan').value;
		var set45=''; //document.getElementById('id_tmtjabatan').value;
		var set46=''; //document.getElementById('id_fungsional').value;
		var set47=''; //document.getElementById('id_tmtfungsional').value;
		var set48=document.getElementById('id_kode').value;
		var set49=document.getElementById('id_tinggibdn').value;
		var set50=document.getElementById('id_beratbdn').value;
		var set51=document.getElementById('id_warnakulit').value;
		var set52=document.getElementById('id_rambut').value;
		var set53=document.getElementById('id_muka').value;
		var set54=document.getElementById('id_cirikusus').value;
		var set55=document.getElementById('id_cacattubuh').value;
		var set56=document.getElementById('id_hobi').value;
		var set57=document.getElementById('id_kepakaran').value;
		var set58=''; //document.getElementById('id_bidangilmu2').value;
		var set59=document.getElementById('id_bidangilmu3').value;
		var set60=document.getElementById('id_fotoprofile');
		var set99=document.getElementById('id_tandatangan');
		if (set06 == ''){ 
			swal({
				title	: 'Stop',
				text	: 'NIK Wajib di Isi',
				type	: 'warning',
			})
		}
		else if (set22 == ''){ 
			swal({
				title	: 'Stop',
				text	: 'Email UB Wajib di isi, bila belum memiliki mohon di isi dengan email aktif manapun apapun',
				type	: 'warning',
			})
		}
		else {
			var form_data = new FormData();
			form_data.append('file', set60.files[0]);
			form_data.append('tandatangan', set99.files[0]);
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
			form_data.append('val60', ''); //document.getElementById('id_nomoridi').value
			form_data.append('val61', ''); //document.getElementById('id_keanggotaanprofesi').value
			form_data.append('val62', ''); //document.getElementById('id_nomorstr').value
			form_data.append('val63', ''); //document.getElementById('id_nomorsip1').value
			form_data.append('val64', ''); //document.getElementById('id_nomorsip2').value
			form_data.append('val65', ''); //document.getElementById('id_nomorsip3').value
			form_data.append('val66', ''); //document.getElementById('id_google').value
			form_data.append('val67', ''); //document.getElementById('id_shinta').value
			form_data.append('val68', ''); //document.getElementById('id_scopus').value
			form_data.append('val69', ''); //document.getElementById('id_orcid').value
			form_data.append('_token', '{{csrf_token()}}');
			$.ajax({
				url: '{{ route("exBiodata") }}',
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
});
</script>
@endpush