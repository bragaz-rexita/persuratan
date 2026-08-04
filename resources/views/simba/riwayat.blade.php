@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> {!! Session('namaaplikasi') !!}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('portaludin') }}">Home</a></li>
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
							<ul class="nav nav-pills flex-column">
								<li class="nav-item"><a href="{{ url('/') }}/cv/{{$biodata->no}}" class="nav-link" target="_blank" id="topbtncetakcv"><i class="fa fa-print"></i> Cetak CV</span></a></li>
                                <li class="nav-item"><a href="#" id="btnshowdepan" class="nav-link"><i class="fa fa-user"></i> Biodata</a></li>
                                <li class="nav-item"><a href="#" id="btnshowonline" class="nav-link"><i class="fa fa-newspaper-o"></i> Riwayat SK/Surat</a></li>
                                <li class="nav-item"><a href="#" id="btnmatakuliah" class="nav-link"><i class="fa fa-book"></i> Data Ajar / Akademik</a></li>
                                <li class="nav-item"><a href="#" id="btnmutasi" class="nav-link"><i class="fa fa-transfer"></i> Perubahan / Mutasi Pegawai</a></li>
                                <li class="nav-item"><a href="#" id="btnriwayatdiri" class="nav-link"><i class="fa fa-pencil"></i> Riwayat Identitas</a></li>
                                <li class="nav-item"><a href="#" id="btnriwayatpendidikan" class="nav-link"><i class="fa fa-font"></i> Riwayat Pendidikan</a></li>
                                <li class="nav-item"><a href="#" id="btnriwayatpangkat" class="nav-link"><i class="fa fa-bookmark"></i> Riwayat Pangkat</a></li>
                                <li class="nav-item"><a href="#" id="btnriwayatfungsional" class="nav-link"><i class="fa fa-credit-card"></i> Riwayat Fungsional</a></li>
                                <li class="nav-item"><a href="#" id="btnriwayatsertifikasi" class="nav-link"><i class="fa fa-euro"></i> Riwayat Sertifikasi	</a></li>
                                <li class="nav-item"><a href="#" id="btnriwayatgaji" class="nav-link"><i class="fa fa-export"></i> Kenaikan Gaji</a></li>
                                <li class="nav-item"><a href="#" id="btnriwayatdiklat" class="nav-link"><i class="fa fa-list"></i> Riwayat Diklat</a></li>
                                <li class="nav-item"><a href="#" id="btnriwayatpenghargaan" class="nav-link"><i class="fa fa-list-alt"></i> Riwayat Penghargaan</a></li>
                                <li class="nav-item"><a href="#" id="btnriwayatkeluarga" class="nav-link"><i class="fa fa-th-list"></i> Riwayat Keluarga</a></li>
                                <li class="nav-item"><a href="#" id="btnriwayatseminar" class="nav-link"><i class="fa fa-th-large"></i> Riwayat Seminar</a></li>
                                <li class="nav-item"><a href="#" id="btnriwayatorganisasi" class="nav-link"><i class="fa fa-tag"></i> Riwayat Organisasi</a></li>
                                <li class="nav-item"><a href="#" id="btndataasesor" class="nav-link"><i class="fa fa-users"></i> Data Asesor</a></li>
							</ul>
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
                                <h3 class="profile-username text-center">SK/Surat Yang di Terbitkan Melalui {!! Session('fakpanjang') !!}</h3>
                                <p class="text-muted text-center">{!! $biodata->nama_lengkap !!}</p>
                            </div>
                            <div class="card-body">
								<div class="form-group">
									<div id="gridriwayatidentitas"></div>
								</div><!-- /.box-body -->
							</div>
							<div class="card-footer">
								<div class="form-group">
									<div id="tabeldataout"></div>
								</div><!-- /.box-body -->
                            </div>
                        </div>
                    </div><!-- /batas halaman Berkas -->
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
                                    <input type="hidden" class="form-control" id="id_masterno" value="{{$biodata->id}}">
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
                                                        $lists   =   ['1000', '1100', '1101', '1102', '1001', '1002'];
                                                        foreach($lists as $list) {
                                                            if($list == $biodata->statusnpwp) {
                                                                echo "<option value='$list' selected>";
                                                            } else {
                                                                echo "<option value='$list'>";
                                                            }
															if($list == '1000'){ echo "Belum Kawin</option>";}
                                                        	if($list == '1100'){ echo "Kawin Tanpa Anak</option>";}
                                                        	if($list == '1101'){ echo "Kawin 1 Anak</option>";}
                                                        	if($list == '1102'){ echo "Kawin 2 Anak / Lebih</option>";}
                                                        	if($list == '1001'){ echo "Janda/Dua Kawin 1 Anak</option>";}
                                                        	if($list == '1002'){ echo "Janda/Dua Kawin 2 Anak / Lebih</option>";}
                                                        }
                                                    @endphp
                                                </select>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6">
                                                <label for="id_nip">Nomor Induk Kepegawaian</label>
                                                <input type="text" id="id_nip" class="form-control" value="{{$biodata->nip_baru}}">
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                            	<label for="id_emaillain">Email</label>
                                        		<input type="text" id="id_emaillain" class="form-control" value="{{$biodata->email}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
											<div class="col-md-4 col-lg-4">
                                                <label for="id_hape">No.HP</label>
                                                <input type="text" id="id_hape" class="form-control" value="{{$biodata->no_hp}}">
                                            </div>
											<div class="col-md-4 col-lg-4">
                                                <label for="id_npwp">NPWP</label>
                                                <input type="text" class="form-control" id="id_npwp" value="{{$biodata->npwp}}">
                                            </div>
                                            <div class="col-md-4 col-lg-4">
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
									<input type="hidden" id="id_emailub" class="form-control" value="{{$biodata->emailub}}">
                                    <input type="hidden" id="id_glrdepan2" class="form-control" value="{{$biodata->gelardepan2}}">
                                    <input type="hidden" id="id_glrblakang2" class="form-control" value="{{$biodata->gelarblakang2}}">
                                    <input type="hidden" id="id_bidangilmu" class="form-control" value="{{$biodata->bidang_ilmu}}">
                                    <input type="hidden" id="id_bidangilmu2" class="form-control" value="{{$biodata->bidang_ilmu2}}">
                                    <input type="hidden" id="id_unitkerja" class="form-control" value="{{$biodata->unit_kerja}}">
                                    <input type="hidden" id="id_laborat" class="form-control" value="{{$biodata->lab}}">
                                    <input type="hidden" id="id_jabatan" class="form-control" value="{{$biodata->jabatan}}">
                                    <input type="hidden" id="id_nidn" class="form-control" value="{{$biodata->nidn}}">
                                    <input type="hidden" id="id_tahunmsk" class="form-control" value="{{$biodata->thn_masuk}}">
                                    <input type="hidden" id="id_cpns" class="form-control" value="{{$biodata->cpns}}">
                                    <input type="hidden" id="id_tmtcpns" class="form-control" value="{{$biodata->tmt_cpns}}">
                                    <input type="hidden" id="id_pns" class="form-control" value="{{$biodata->pns}}">
                                    <input type="hidden" id="id_tmtpns" class="form-control" value="{{$biodata->tmt_pns}}">
                                    <input type="hidden" id="id_jenis" class="form-control" value="{{$biodata->jenisnip}}">
                                    <input type="hidden" id="id_niplama" class="form-control" value="{{$biodata->nip_lama}}">
                                    <input type="hidden" id="id_karpeg" class="form-control" value="{{$biodata->karpeg}}">
                                    <input type="hidden" id="id_nira" class="form-control" value="{{$biodata->nira}}">
                                    <input type="hidden" id="id_pees" class="form-control" value="{{$biodata->program_studi}}">
                                    <input type="hidden" id="id_jabfungsional" class="form-control" value="{{$biodata->jab_fungsional}}">
                                    <input type="hidden" id="id_pangkat" class="form-control" value="{{$biodata->pangkat}}">
                                    <input type="hidden" id="id_tmtgolongan" class="form-control" value="{{$biodata->tmt_golongan}}">
                                    <input type="hidden" id="id_tmtjabatan" class="form-control" value="{{$biodata->tmtpangkat}}">
                                    <input type="hidden" id="id_fungsional" class="form-control" value="{{$biodata->fungsional}}">
                                    <input type="hidden" id="id_tmtfungsional" class="form-control" value="{{$biodata->tmt_fungsional}}">
                                    <input type="hidden" id="id_kode" class="form-control" value="{{$biodata->kode}}">
                                    <input type="hidden" id="id_kepakaran" class="form-control" value="{{$biodata->kepakaran}}">
									<input type="hidden" id="id_nokk" class="form-control" value="{{$biodata->nokk}}">
									<input type="hidden" id="id_telpon" class="form-control" value="{{$biodata->no_telp}}">
                                    <input type="hidden" id="id_status_jbtn" class="form-control" value="{{$biodata->status_jabatan}}">
									<input type="hidden" id="id_status" value="{{$biodata->status_pegawai}}">
									<input type="hidden" id="id_jenispeg" value="{{$biodata->jenispeg}}">
									<input type="hidden" id="id_kelas" value="{{$biodata->kelasjabatan}}">
									<input type="hidden" id="id_gaji" value="{{$biodata->gajisesuaisk}}">
									<input type="hidden" id="id_tmtgaji" value="{{$biodata->tmtgaji}}">
									<input type="hidden" id="id_ppabp" value="{{$biodata->ppabp}}">
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
                                </div>
                            </div>
                        </div><!-- /kanan -->
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
                        <div class="box box-success">
                            <div class="box-header with-border">
                            <h3 class="box-title">Riwayat Identitas Pegawai</h3>
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
                                <button class="btn btn-xs bg-maroon" id="btnnewidentitas">Tambah Data Baru</button>
                                <button class="btn btn-xs bg-purple" id="btnexportidentitas">Export Tabel di Bawah</button>
                                <div id="grididentitas"></div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /batas halaman Identitas -->
                    <div id="halamanpendidikan">
                        <div class="box box-success">
                            <div class="box-header with-border">
                            <h3 class="box-title">Riwayat Pendidikan Pegawai</h3>
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
                                <button class="btn btn-xs bg-maroon" id="btnnewpendidikan">Tambah Data Baru</button>
                                <button class="btn btn-xs bg-purple" id="btnexportpendidikan">Export Tabel di Bawah</button>
                                <div id="gridpendidikan"></div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Riwayat SK Tugas / Ijin Belajar Online</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div id="gridriwayatpendidikan"></div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
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
                        <div class="box box-success">
                            <div class="box-header with-border">
                            <h3 class="box-title">Riwayat Diklat Pegawai</h3>
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
                                <button class="btn btn-xs bg-maroon" id="btnnewdiklat">Tambah Data Baru</button>
                                <button class="btn btn-xs bg-purple" id="btnexportdiklat">Export Tabel di Bawah</button>
                                <div id="griddiklat"></div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /batas halaman Diklat -->
                    <div id="halamanpenghargaan">
                        <div class="box box-success">
                            <div class="box-header with-border">
                            <h3 class="box-title">Riwayat Penghargaan Pegawai</h3>
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
                                <button class="btn btn-xs bg-maroon" id="btnnewpenghargaan">Tambah Data Baru</button>
                                <button class="btn btn-xs bg-purple" id="btnexportpenghargaan">Export Tabel di Bawah</button>
                                <div id="gridpenghargaan"></div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /batas halaman Penghargaan -->
                    <div id="halamankeluarga">
                        <div class="box box-success">
                            <div class="box-header with-border">
                            <h3 class="box-title">Riwayat Keluarga</h3>
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
                                <button class="btn btn-xs bg-maroon" id="btnnewkeluarga">Tambah Data Baru</button>
                                <button class="btn btn-xs bg-purple" id="btnexportkeluarga">Export Tabel di Bawah</button>
                                <div id="gridkeluarga"></div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /batas halaman Keluarga -->
                    <div id="halamanseminar">
                        <div class="box box-success">
                            <div class="box-header with-border">
                            <h3 class="box-title">Riwayat Seminar</h3>
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
                                <button class="btn btn-xs bg-maroon" id="btnnewseminar">Tambah Data Baru</button>
                                <button class="btn btn-xs bg-purple" id="btnexportseminar">Export Tabel di Bawah</button>
                                <div id="gridseminar"></div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /batas halaman Seminar -->
                    <div id="halamanorganisasi">
                        <div class="box box-success">
                            <div class="box-header with-border">
                            <h3 class="box-title">Riwayat Organisasi</h3>
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
                                <button class="btn btn-xs bg-maroon" id="btnneworganisasi">Tambah Data Baru</button>
                                <button class="btn btn-xs bg-purple" id="btnexportorganisasi">Export Tabel di Bawah</button>
                                <div id="gridorganisasi"></div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
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
                </div>
            </div>
		</div>
	</div>
</div>
<div class="modal modal-info" id="modaluploader"><!-- /.Modal Upload -->
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Form Uploader</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
				<h4 class="modal-title">Form Data Sertifikat</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
				<h4 class="modal-title">Form Data Ajar</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
							<label>Jabatan Akademik</label>
							<select id="dataajar_jabatan" class="form-control">		
							<option value="TP">Tenaga Pengajar</option>
							<option value="AA">Asisten Ahli</option>
							<option value="L">Lektor</option>
							<option value="LK">Lektor Kepala</option>
							<option value="GB">Guru Besar</option>
							</select>
						</div>
						<div class="col-md-6 col-lg-6">
							<label>Program Studi</label>
							<select id="dataajar_kodeps" class="form-control">		
								<option value="">Pilih Salah Satu</option>
								@php
									$keys = array_keys($klasifps);
									for($i = 0; $i < count($klasifps); $i++) {
								@endphp
										<optgroup label="{{ $klasifikasips[$i] }}">
										@php
											foreach($klasifps[$keys[$i]] as $key => $value) {
										@endphp
											<option value="{{ $value['id'] }}">{{ $value['nama'] }}</option>
										@php
									}
										@endphp
										</optgroup>
								@php
								}
								@endphp
							</select>
						</div>
					</div>
					</div>
					<div class="form-group">
					<div class="row">		
						<div class="col-md-8 col-lg-8">
							<label>Matakuliah</label>
							<select id="dataajar_matakuliah" class="form-control select2">		
								<option value="">Pilih Salah Satu</option>
								@php
									$keys = array_keys($listmk);
									for($i = 0; $i < count($listmk); $i++) {
								@endphp
										<optgroup label="{{ $groupmk[$i] }}">
										@php
											foreach($listmk[$keys[$i]] as $key => $value) {
										@endphp
											<option value="{{ $value['namamk'] }}">{{ $value['tulisanne'] }}</option>
										@php
									}
										@endphp
										</optgroup>
								@php
								}
								@endphp
							</select>
						</div>
						<div class="col-md-4 col-lg-4">
							<label>Kesesuaian</label>
							<select id="dataajar_sesuai" class="form-control">		
								<option value="1">Sesuai Dengan Bidang Keahlian</option>
								<option value="0">Tidak Sesuai Dengan Bidang Keahlian</option>
							</select>
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
				<h4 class="modal-title">Form Riwayat Asessor</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
<div class="modal modal-info" id="modaladddataorganisasi"><!-- /.Modal Seminar -->
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Form Riwayat Organisasi</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
							<label>Tanggal Mulai</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" class="form-control" id="organisasi_mulai">
							</div>
						</div>		
						<div class="col-md-6 col-lg-6">
							<label>Tanggal Selesai</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" class="form-control" id="organisasi_selesai">
							</div>
						</div>
					</div>
					</div>
					<div class="form-group">
					<label>No. SK</label>
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
				</div>
			</div>
			<div class="modal-footer">
				<input type="hidden" class="form-control" id="organisasi_id">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
				<div id="divtambahorganisasi">		
					<button type="button" class="btn btn-success" id="btnsimpandataorganisasi">Simpan</button>
				</div>
				<div id="divupdateorganisasi">
					<button type="button" class="btn btn-danger pull-left" id="btnhapusorganisasi">Hapus Data Ini</button>
					<button type="button" class="btn btn-warning" id="btnupdatedataorganisasi">Update</button>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-body -->
</div><!-- /.modal-modal -->
<div class="modal modal-info" id="modaladddataseminar"><!-- /.Modal Seminar -->
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Form Riwayat Seminar Yang di Ikuti</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
<div class="modal modal-info" id="modaladdkeluarga"><!-- /.Modal Keluarga -->
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Form Riwayat Keluarga</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
						<label>Nama</label>
						<input type="text" class="form-control" id="keluarga_nama">
					</div>
					<div class="form-group">
						<div class="row">				 	
						<div class="col-md-8">
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
						<div class="col-md-4">				  
							<label>TGL Pernikahan</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" id="keluarga_tglmenikah" class="form-control">
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
							<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" id="keluarga_tgllahir" class="form-control">
							</div>
						</div>
						</div>
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<input type="text" class="form-control" id="keluarga_alamat">
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
				</div>
			</div>
			<div class="modal-footer">
				<input type="hidden" class="form-control" id="keluarga_idne">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
				<div id="divtambahkeluarga">		
					<button type="button" class="btn btn-success" id="btnsimpandatakeluarga">Simpan</button>
				</div>
				<div id="divupdatekeluarga">
					<button type="button" class="btn btn-danger pull-left" id="btnhapuskeluarga">Hapus Data Ini</button>
					<button type="button" class="btn btn-warning" id="btnupdatedatakeluarga">Update</button>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-body -->
</div><!-- /.modal-modal -->
<div class="modal modal-info" id="modaladddatamutasi"><!-- /.Modal Mutasi -->
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Form Riwayat Perubahan Status / Mutasi</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
<div class="modal modal-info" id="modaladddataidentitas"><!-- /.Modal Identitas -->
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Form Riwayat Identitas</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
							<label>Aktif</label>
							<select id="identitas_aktif" size="1" class="form-control">
								<option value="">Pilih Salah Satu</option>
								<option value="Aktif">Aktif</option>
								<option value="Non Aktif">Non Aktif</option>
							</select>
						</div>		
						<div class="col-md-6 col-lg-6">
							<label>Jenis Identitas</label>
							<select id="identitas_jenis" size="1" class="form-control">
								<option value="">Pilih Salah Satu</option>
								<!--
								<option value="CTKP">CTKP (Calon Tenaga Kependidikan Tetap)</option>
								<option value="TKP">TKP</option>
								<option value="CPNS">CPNS</option>
								<option value="PNS">PNS</option>
								<option value="NIP">NIP</option>
								<option value="NIK">NIK</option>
								<option value="NIDN">NIDN</option>
								-->
								<option value="KARPEG">KARPEG</option>
								<option value="NPWP">NPWP</option>
								<option value="BPJS Kesehatan">BPJS Kesehatan</option>
								<option value="BPJS Ketenagakerjaan">BPJS Ketenagakerjaan</option>
								<option value="BPJS Pensiun">BPJS Pensiun</option>
								<option value="IDI">IDI</option>
								<option value="PROFESI">PROFESI</option>
								<option value="STR">STR</option>
								<option value="SIP1">SIP1</option>
								<option value="SIP2">SIP2</option>
								<option value="SIP3">SIP3</option>
							</select>
						</div>
					</div>
					</div>
					<div class="form-group">
						<label>No. Identitas</label>
						<input type="text" class="form-control" id="identitas_nomer">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<input type="hidden" class="form-control" id="identitas_idne">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
				<div id="divtambahidentitas">		
					<button type="button" class="btn btn-success" id="btnsimpandataidentitas">Simpan</button>
				</div>
				<div id="divupdateidentitas">
					<button type="button" class="btn btn-danger pull-left" id="btnhapusidentitas">Hapus Data Ini</button>
					<button type="button" class="btn btn-warning" id="btnupdatedataidentitas">Update</button>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal modal-info" id="modaladddatapendidikan"><!-- /.Modal Pendidikan -->
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Form Riwayat Pendidikan</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
							<label>Jenjang</label>
							<select id="pendidikan_jenjang" size="1" class="form-control">
								<option value="">Pilih Salah Satu</option>
								<option value="SD">SD/Sederajat</option>
								<option value="SMP">SMP/Sederajat</option>
								<option value="SMA">SMA/Sederajat</option>
								<option value="D1">D1</option>
								<option value="D2">D2</option>
								<option value="D3">D3</option>
								<option value="S1">D4/S1</option>
								<option value="Profesi">Profesi</option>
								<option value="S2">S2</option>
								<option value="Spesialis 1">Spesialis 1</option>
								<option value="Spesialis 2">Spesialis 2</option>
								<option value="S3">S3</option>						
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
						<input type="text" class="form-control" id="pendidikan_negara">
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<label>Bidang Ilmu / Peminatan</label>
								<input type="text" class="form-control" id="pendidikan_minat">
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
							<input type="text" id="pendidikan_lulus" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
						</div>		
						<div class="col-md-6 col-lg-6">
							<label>No.Ijasah</label>
							<input type="text" class="form-control" id="pendidikan_noijasah">
						</div>
						<div class="col-md-3">				  
							<label>TGL Ijasah</label>
							<input type="text" id="pendidikan_tglijasah" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
						</div>
					</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<input type="hidden" class="form-control" id="pendidikan_tahun" value="0000">
				<input type="hidden" class="form-control" id="pendidikan_keterangan" value="-">
				<input type="hidden" class="form-control" id="pendidikan_idne">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
				<div id="divtambahpendidikan">		
					<button type="button" class="btn btn-success" id="btnsimpandatapendidikan">Simpan</button>
				</div>
				<div id="divupdatependidikan">
					<button type="button" class="btn btn-danger pull-left" id="btnhapuspendidikan">Hapus Data Ini</button>
					<button type="button" class="btn btn-warning" id="btnupdatedatapendidikan">Update</button>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal modal-info" id="modaladddatapangkat"><!-- /.Modal Kepangkatan -->
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Form Riwayat Kepangkatan</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
								<label for="pangkat_tglsk">Tgl. SK</label>
								<div class="input-group date" data-target-input="nearest">
									<input type="text" class="form-control"id="pangkat_tglsk" name="pangkat_tglsk" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
									<div class="input-group-append">
										<div class="input-group-text"><i class="fa fa-calendar"></i></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Asal SK</label>
						<select id="pangkat_asalsk" size="1" class="form-control">
							<option value="">Pilih Salah Satu</option>
							<option value="Direktur RS">Direktur RS</option>
							<option value="Direktur PT">Direktur PT</option>
							<option value="Presiden">Presiden</option>
							<option value="Menteri">Menteri</option>
							<option value="Rektor">Rektor</option>
						</select>
					</div>
					<div class="form-group">
						<label>Penjelasan</label>
						<select id="pangkat_penjelasan" size="1" class="form-control">
							<option value="">Pilih Salah Satu</option>
							<option value="PKWTT">PKWTT</option>
							<option value="PKWT">PKWT</option>
							<!--
							<option value="Dosen PNS">Dosen PNS</option>
							<option value="Dosen NON PNS">Dosen Non PNS</option>
							<option value="Dosen Pensiun - PK">Dosen Purna Perjanjian Kerja</option>
							<option value="Dosen Profesional - PK">Dosen Profesional Perjanjian Kerja</option>
							<option value="Dosen Tidak Tetap">Dosen Tidak Tetap</option>
							<option value="Dosen Kontrak">Dosen Kontrak</option>
							<option value="Tendik PNS">Tendik PNS</option>
							<option value="Tendik NON PNS">Tendik Non PNS</option>
							<option value="Tendik KONTRAK">Tendik Kontrak</option>
							-->
						</select>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<label for="pangkat_tmt">TMT</label>
								<div class="input-group date" data-target-input="nearest">
									<input type="text" class="form-control"id="pangkat_tmt" name="pangkat_tmt" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
									<div class="input-group-append">
										<div class="input-group-text"><i class="fa fa-calendar"></i></div>
									</div>
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
							<input type="text" class="form-control" value="{{$masakerja}}" disabled="disable">
						</div>		
						<div class="col-md-6 col-lg-6">
							<label>Masa Kerja Golongan</label>
							<input type="text" class="form-control" value="{{ $masagolongan }}" disabled="disable">
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
				<h4 class="modal-title">Form Riwayat Fungsional</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
						<label>Jabatan Fungsional</label>
						<select id="fungsional_fungsional" size="1" class="form-control">
							<option value="">Pilih Salah Satu</option>
							@foreach($jabatan as $rjabatan)
								<option value="{{ $rjabatan['kode'] }}">{{ $rjabatan['nama'] }}</option>
							@endforeach
						</select>
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
				<h4 class="modal-title">Form Riwayat Sertifikasi Dosen</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
				<h4 class="modal-title">Form Riwayat Perubahan Gaji</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
<div class="modal modal-info" id="modaladddatadiklat"><!-- /.Modal Diklat -->
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Form Riwayat Diklat</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
							<label>No.Dokumen</label>
							<input type="text" class="form-control" id="diklat_nodoc">					
						</div>		
						<div class="col-md-6 col-lg-6">
							<label>Tgl.Dokumen</label>
							<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" id="diklat_tgldok" class="form-control">
							</div>
						</div>
					</div>
					</div>
					<div class="form-group">
					<div class="row">
						<div class="col-md-5 col-lg-5">
							<label>Diklat</label>
							<select id="diklat_diklat" size="1" class="form-control">
								<option value="">Pilih Salah Satu</option>
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
						<div class="col-md-6 col-lg-6">
							<label>Tgl.Mulai</label>
							<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" class="form-control" id="diklat_mulai">	
							</div>
						</div>		
						<div class="col-md-6 col-lg-6">
							<label>Tgl.Lulus</label>
							<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" id="diklat_lulus" class="form-control">
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
							<label>Luar Negeri</label>
							<select id="diklat_negeri" size="1" class="form-control">
								<option value="">Pilih Salah Satu</option>
								<option value="Luar Negeri">Luar Negeri</option>
								<option value="Dalam Negeri">Dalam Negeri</option>
							</select>				
						</div>		
						<div class="col-md-7 col-lg-7">
							<label>Keterangan</label>					
							<input type="text" class="form-control" id="diklat_keterangan">
						</div>
					</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<input type="hidden" class="form-control" id="diklat_idne">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
				<div id="divtambahdiklat">		
					<button type="button" class="btn btn-success" id="btnsimpandatadiklat">Simpan</button>
				</div>
				<div id="divupdatediklat">
					<button type="button" class="btn btn-danger pull-left" id="btnhapusdiklat">Hapus Data Ini</button>
					<button type="button" class="btn btn-warning" id="btnupdatedatadiklat">Update</button>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal modal-info" id="modaladddatapenghargaan"><!-- /.Modal Penghargaan -->
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Form Riwayat Penghargaan</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
							<input type="text" class="form-control" id="penghargaan_nodoc">					
						</div>		
						<div class="col-md-6 col-lg-6">
							<label>Tgl.SK</label>
							<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" id="penghargaan_tgl" class="form-control">
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
		<label>Golongan</label>
		<select id="pangkat_golongan" size="1" class="form-control">
			<option value="-">Pilih Salah Satu</option>
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
		$('#pangkat_tglsk').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#pangkat_tmt').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });

		$("#mutasi_tanggal").datepicker({format: 'yyyy-mm-dd'});
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
	$('.select2').select2({width: '100%'});
	$(document).ready(function () {
		var token = document.getElementById('token').value;
		$("#gaji_gaji").autoNumeric(
			'init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'}
		);
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
		$('#btngeneratedatakinerja').click(function () {
			var set01 = document.getElementById('id_masterno').value;
			var set02 = document.getElementById('ekd_semester').value;
			var set03 = document.getElementById('ekd_tahun').value;
			$.post('../simba/golekdatakegiatandosen', { _token: token, val01: set01, val02: set02, val03: set03 },
			function(data){		
				$('#divviewekd').html(data);
				return false;
			});
		});
		$("#btnexportdataremun").click(function () {
			var gridContent = $("#griddataremun").jqxGrid('exportdata', 'html');
			$('#tabel_cetak').html(gridContent);		
			$("#tabel_cetak").btechco_excelexport({
				containerid: "tabel_cetak"
				, datatype: $datatype.Table
			});
		});
		$('#btngeneratedata').click(function () {
			var set01 = document.getElementById('id_masterno').value;
			var set02 = document.getElementById('remun_tahun').value;	
			var sumberdatadosen = {
				datatype: "json",
				datafields: [
					{ name: 'idne'},
					{ name: 'nama',type: 'text'},
					{ name: 'kodedosen',type: 'text'},
					{ name: 'kodejenis',type: 'text'},
					{ name: 'kodedosen',type: 'text'},
					{ name: 'tulis',type: 'text'},
					{ name: 'deskripsi',type: 'text'},					
					{ name: 'sks',type: 'text'},
					{ name: 'namamhs',type: 'text'},
					{ name: 'nimmhs',type: 'text'},
					{ name: 'semester', type: 'text'},
					{ name: 'tanggal', type: 'text'},
					{ name: 'satuan', type: 'text'},
					{ name: 'kegiatan', type: 'text'},
					{ name: 'angka', type: 'text'},
					{ name: 'bukti', type: 'text'},
					{ name: 'nmfile', type: 'text'},
					{ name: 'marking', type: 'text'},
					{ name: 'tabel', type: 'text'},
				],
				type: 'POST',
				data: {	_token: token, val01:set01, val02:set02 },
				url: '../simba/datadetaktifidosenthn',
			};
			var dadetdosen = new $.jqx.dataAdapter(sumberdatadosen);
			var editrow = -1;
			var filerenderer = function (row, column, value) {
				var filebukti = $('#griddataremun').jqxGrid('getrowdata', row).nmfile;
				var masterno = $('#griddataremun').jqxGrid('getrowdata', row).no;
				if (filebukti != ''){
					var linkbukti = '<div style="background: white;"><a href="../images/'+masterno+'/'+filebukti+'" target="_blank"><span class="label label-success">DOWNLOAD</span></a></div>';
				}
				else {
					var linkbukti = '<div style="background: white;"></div>';
				}
				return linkbukti;
			}
			$("#griddataremun").jqxGrid({
				width: '100%',
				filterable: true,
				columnsresize: true,
				showfilterrow: true,
				theme: "orange",
				sortable: true,
				autoheight: true,
				source: dadetdosen,
				altrows: true,
				columns: [
					{ text: 'Kode', datafield: 'kodejenis', width: '7%', cellsalign: 'left', align: 'center' },
					{ text: 'Deskripsi Kode Jenis', datafield: 'tulis', width: '20%', cellsalign: 'left', align: 'center' },
					{ text: 'Deskripsi', datafield: 'deskripsi', width: '23%', cellsalign: 'left', align: 'center' },
					{ text: 'SKS', datafield: 'sks', width: '5%', cellsalign: 'left', align: 'center' },
					{ text: 'Nama Mahasiswa', datafield: 'namamhs', width: '5%', cellsalign: 'left', align: 'center' },
					{ text: 'NIM', datafield: 'nimmhs', width: '5%', cellsalign: 'left', align: 'center' },
					{ text: 'Semester', datafield: 'semester', width: '5%', cellsalign: 'left', align: 'center' },
					{ text: 'Satuan', datafield: 'satuan', width: '5%', cellsalign: 'left', align: 'center' },
					{ text: 'Kegiatan', datafield: 'kegiatan', width: '5%', cellsalign: 'left', align: 'center' },
					{ text: 'Angka', datafield: 'angka', width: '5%', cellsalign: 'left', align: 'center' },
					{ text: 'Bukti', datafield: 'bukti', width: '5%', cellsalign: 'left', align: 'center' },
					{ text: 'File Upload', align: 'center', cellsalign: 'center',  width: '8%', cellsrenderer: filerenderer },
				],
			});
		});
		$('#pendidikan').click(function () {
			var set01 = document.getElementById('id_masterno').value;
			$.post('../simba/ctkpendidikan', { _token: token, val01: set01},
			function(data){		
				$('#hasilcari').html(data);
				return false;
			});
		});
		$('#penelitian').click(function () {
			var set01 = document.getElementById('id_masterno').value;	
			$.post('../simba/ctkpenelitian', { _token: token, val01: set01},
			function(data){		
				$('#hasilcari').html(data);
				return false;
			});
		});
		$('#pengabdian').click(function () {
			var set01 = document.getElementById('id_masterno').value;	
			$.post('../simba/ctkpengabdian', { _token: token, val01: set01},
			function(data){		
				$('#hasilcari').html(data);
				return false;
			});
		});
		$('#penunjang').click(function () {
			var set01 = document.getElementById('id_masterno').value;	
			$.post('../simba/ctkpenunjang', { _token: token, val01: set01},
			function(data){		
				$('#hasilcari').html(data);
				return false;
			});
		});
		$('#mukaak').click(function () {
			var set01 = document.getElementById('id_masterno').value;	
			$.post('../simba/ctkmukaak', { _token: token, val01: set01},
			function(data){		
				$('#hasilcari').html(data);
				return false;
			});
		});
		$('#rekapak').click(function () {
			var set01 = document.getElementById('id_masterno').value;	
			$.post('../simba/rekapak', { _token: token, val01: set01},
			function(data){		
				$('#hasilcari').html(data);
				return false;
			});
		});
		$('#btnuploadfoto').on('click', function (){	
			$('#id_fotoprofile').click();
		});
		$('#btnsimpandataupload').on('click', function (){
			var set01=document.getElementById('upload_id').value;
			var set02=document.getElementById('upload_namafile').value;
			var set03=document.getElementById('upload_data').value;
			var set04=document.getElementById('upload_tabel').value;
			var set05=document.getElementById('upload_file');
			var set06=document.getElementById('id_masterno').value;	
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
				form_data.append('val06', set06);
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
						alert(xhr.responseText);
					}
				});
			}
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
			$('#halamanonline').hide();
			$('#halamanmuka').hide();
			$('#halamanonline').show();
			var set01=document.getElementById('id_masterno').value;
			var set02='cariperid';
			var set03='cariall';
			var token=document.getElementById('token').value;
			var sourcedetail = {
				datatype: "json",
				datafields: [
					{ name: 'idsurat', type: 'text'},
					{ name: 'jenissk', type: 'text'},
					{ name: 'paraf1', type: 'text'},
					{ name: 'paraf2', type: 'text'},
					{ name: 'paraf3', type: 'text'},		
					{ name: 'paraf4', type: 'text'},
					{ name: 'penandatangan', type: 'text'},
					{ name: 'sparaf1', type: 'text'},
					{ name: 'sparaf2', type: 'text'},
					{ name: 'sparaf3', type: 'text'},
					{ name: 'sparaf4', type: 'text'},
					{ name: 'spenandatangan', type: 'text'},
					{ name: 'menimbang', type: 'text'},
					{ name: 'mengingat', type: 'text'},
					{ name: 'menetapkan', type: 'text'},
					{ name: 'tmt', type: 'text'},
					{ name: 'idpeg', type: 'text'},
					{ name: 'nama', type: 'text'},
					{ name: 'nip', type: 'text'},
					{ name: 'golongan', type: 'text'},
					{ name: 'statuspeg', type: 'text'},
					{ name: 'jenispeg', type: 'text'},
					{ name: 'unitkerjapeg', type: 'text'},
					{ name: 'jabatanpeg', type: 'text'},
					{ name: 'kelas', type: 'text'},
					{ name: 'nilai', type: 'text'},
					{ name: 'tgp', type: 'text'},
					{ name: 'insentif', type: 'text'},
					{ name: 'konseptor', type: 'text'},
					{ name: 'unitkonseptor', type: 'text'},
					{ name: 'nomor', type: 'text'},
					{ name: 'tahun', type: 'text'},
					{ name: 'tanggal', type: 'text'},
				],
				type: 'POST',
				data: {	val01:set01, val02:set02, val03:set03, _token: token },
				url: '../dokar/jgetdetailpangkat',
			};
			var datadetail = new $.jqx.dataAdapter(sourcedetail);
			$("#gridriwayatidentitas").jqxGrid({
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
					{ text: 'Preview', editable: false, sortable: false, filterable: false,columntype: 'button', width: '8%', align: 'center', cellsrenderer: function () {
						return "Preview";
						}, buttonclick: function (row) {		
							editrow = row;	
							var offset 		= $("#gridriwayatidentitas").offset();		
							var dataRecord 	= $("#gridriwayatidentitas").jqxGrid('getrowdata', editrow);
							window.open("{{URL::to("/")}}/viewsurat/58ddd975e88084b35fc973ab7518d4ba-"+dataRecord.idsurat, '_blank');
						}
					},
					{ text: 'Jenis', datafield: 'jenissk', filtertype: 'checkedlist', width: '37%', cellsalign: 'left', align: 'center'  },
					{ text: 'Penanda Tangan', datafield: 'penandatangan', width: '15%', cellsalign: 'left', align: 'center'  },
					{ text: 'Nomor', datafield: 'nomor', width: '25%', cellsalign: 'left', align: 'center'  },
					{ text: 'Tanggal', datafield: 'tanggal', width: '15%', cellsalign: 'left', align: 'center'  },
				]
			});
			var jenis='riwayatpribadi';
			var source = {
				datatype: "json",
				datafields: [
					{ name: 'idsurat'},
					{ name: 'marking', type: 'text'},
					{ name: 'nomor', type: 'text'},
					{ name: 'tglmasuk', type: 'text'},
					{ name: 'tglsurat', type: 'text'},
					{ name: 'kepada', type: 'text'},
					{ name: 'nosurat', type: 'text'},
					{ name: 'asalsurat', type: 'text'},
					{ name: 'perihal', type: 'text'},
					{ name: 'klasifikasi', type: 'text'},
					{ name: 'bentuk', type: 'text'},
					{ name: 'pembuat', type: 'text'},
					{ name: 'status', type: 'text'},
					{ name: 'scansurat', type: 'text'},
					{ name: 'faskode', type: 'text'},
					{ name: 'subkode', type: 'text'},
					{ name: 'ruangarsip', type: 'text'},
					{ name: 'ordnerarsip', type: 'text'},
					{ name: 'lemariarsip', type: 'text'},
					{ name: 'boleh', type: 'text'},
					{ name: 'selesai', type: 'text'},
					{ name: 'terakhir', type: 'text'},
				],
				type: 'POST',
				data: {jenis: jenis, _token: token},
				url: '{{ route("jarsiparis") }}',
			};
			var dataAdapter = new $.jqx.dataAdapter(source);
			$("#tabeldataout").jqxGrid({
				width: '100%',
				pageable: true,
				autoheight: true,
				source: dataAdapter,
				columnsresize: true,
				theme: "energyblue",
				selectionmode: 'multiplecellsextended',
				columns: [
					{ text: 'Surat', columntype: 'button', width: '15%', cellsrenderer: function () {
						return "Preview";
						}, buttonclick: function (row) {
							editrow = row;	
							var offset 		= $("#tabeldataout").offset();		
							var dataRecord 	= $("#tabeldataout").jqxGrid('getrowdata', editrow);
							window.open("{{URL::to("/")}}/viewsurat/keluar-"+dataRecord.idsurat, '_blank');
						}
					},
					{ text: 'No.Surat', datafield: 'nomor', width: '15%', cellsalign: 'left', align: 'center'},
					{ text: 'Tanggal', datafield: 'tglsurat', width: '15%', cellsalign: 'left', align: 'center' },
					{ text: 'Perihal', datafield: 'perihal', width: '35%', cellsalign: 'left', align: 'center'  },
					{ text: 'Konseptor', datafield: 'pembuat', width: '20%', cellsalign: 'left', align: 'center'  },
				],
			});
		});
		$('#btnevaluasikinerja').on('click', function (){
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
			$('#halamanevaluasikinerja').show();
			$('#halamanonline').hide();
			$('#halamanmuka').hide();
			return false;
		});
		$('#btndatremun').on('click', function (){
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
			$('#halamanremun').show();
			$('#halamanskp').hide();
			$('#halamanevaluasikinerja').hide();
			$('#halamanonline').hide();
			$('#halamanmuka').hide();
			return false;
		});
		$('#btndatangkakredit').on('click', function (){
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
			$('#halamanangkakredit').show();
			$('#halamandatabkd').hide();
			$('#halamanremun').hide();
			$('#halamanskp').hide();
			$('#halamanevaluasikinerja').hide();
			$('#halamanonline').hide();
			$('#halamanmuka').hide();
			return false;
		});
		$('#btndatskp').on('click', function (){
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
			$('#halamanskp').show();
			$('#halamanevaluasikinerja').hide();
			$('#halamanonline').hide();
			$('#halamanmuka').hide();
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
			var set10=document.getElementById('id_glrdepan2').value;
			var set11=document.getElementById('id_glrblakang2').value;
			var set12=document.getElementById('id_bidangilmu').value;
			var set13=document.getElementById('id_alamatmlg').value;
			var set14=document.getElementById('id_alamatasal').value;
			var set15=document.getElementById('id_propinsi').value;
			var set16=document.getElementById('id_kota').value;
			var set17=document.getElementById('id_agama').value;
			var set18=document.getElementById('id_kawin').value;
			var set19=document.getElementById('id_status_jbtn').value;
			var set20=document.getElementById('id_hape').value;
			var set21=document.getElementById('id_emailub').value;
			var set22=document.getElementById('id_emaillain').value;
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
			var set39=document.getElementById('id_pees').value;
			var set40=document.getElementById('id_kelurahan').value;
			var set41=document.getElementById('id_kecamatan').value;
			var set42=document.getElementById('id_jabfungsional').value;
			var set43=document.getElementById('id_pangkat').value;
			var set44=document.getElementById('id_tmtgolongan').value;
			var set45=document.getElementById('id_tmtjabatan').value;
			var set46=document.getElementById('id_jabatan').value;
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
			var set57=document.getElementById('id_kepakaran').value;
			var set58=document.getElementById('id_nokk').value;
			var set59=document.getElementById('id_bidangilmu3').value;
			var set60=document.getElementById('id_fotoprofile');
			var set61=document.getElementById('id_kelas').value;
			var set62=document.getElementById('id_gaji').value;
			var set63=document.getElementById('id_tmtgaji').value;
			var set64=document.getElementById('id_ppabp').value;
			if (set21 == ''){ var set21 = set22;}
			if (set02 == ''){ 
				swal({
					title	: 'Stop',
					text	: 'NIP/NIK Wajib di Isi',
					type	: 'warning',
				})
			} else if (set21 == ''){ 
				swal({
					title	: 'Stop',
					text	: 'Email Wajib di Isi',
					type	: 'warning',
				})
			} else {
				var form_data = new FormData();
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
						return false;
					},
					error: function (xhr, status, error) {
						alert(xhr.responseText);
					}
				});
			}
		});
		$('#cetak').click(function () {
			var divToPrint=document.getElementById('printiki');
			newWin= window.open("");
			newWin.document.write(divToPrint.outerHTML);
			newWin.print();
			return false;
		});
		$("#export").click(function () {
			$("#printiki").btechco_excelexport({
				containerid: "printiki"
				, datatype: $datatype.Table
			});
		});
		$("#btnexportdataremun").click(function () {
			$('#griddataremun').html(gridContent);		
			$("#griddataremun").btechco_excelexport({
				containerid: "griddataremun"
				, datatype: $datatype.Table
			});
		});
	//tombol-tombol di modal data SKP
		$("#btnexportdataskp").click(function () {
			var gridContent = $("#griddataskp").jqxGrid('exportdata', 'html');
			$('#tabel_cetak').html(gridContent);		
			$("#tabel_cetak").btechco_excelexport({
				containerid: "tabel_cetak"
				, datatype: $datatype.Table
			});
		});
		$('#btngendataskp').click(function () {
			var set01 = document.getElementById('id_masterno').value;
			var set02 = document.getElementById('skp_tahun').value;	
			var sumberdatadosen = {
				datatype: "json",
				datafields: [
					{ name: 'nomer',type: 'text'},
					{ name: 'nama',type: 'text'},
					{ name: 'kodedosen',type: 'text'},
					{ name: 'kegiatan',type: 'text'},
					{ name: 'bobot',type: 'text'},
					{ name: 'angkakredit',type: 'text'},					
					{ name: 'kuantitas',type: 'text'},
					{ name: 'satuan',type: 'text'},
					{ name: 'mutu',type: 'text'},
					{ name: 'waktu', type: 'text'},
					{ name: 'satuanwaktu', type: 'text'},
					{ name: 'biaya', type: 'text'},
				],
				type: 'POST',
				data: {	_token: token, val01:set01, val02:set02 },
				url: '../simba/datadetaktifidosenthn',
			};
			var dadetdosen = new $.jqx.dataAdapter(sumberdatadosen);
			var editrow = -1;
			$("#griddataskp").jqxGrid({
				width: '100%',
				filterable: true,
				columnsresize: true,
				showfilterrow: true,
				theme: "energyblue",
				sortable: true,
				autoheight: true,
				source: dadetdosen,
				altrows: true,
				columns: [
					{ text: 'No', datafield: 'nomer', width: '7%', cellsalign: 'left', align: 'center' },
					{ text: 'Kegiatan Tugas Jabatan', datafield: 'kegiatan', width: '27%', cellsalign: 'left', align: 'center' },
					{ text: 'Bobot', datafield: 'bobot', width: '8%', cellsalign: 'left', align: 'center' },
					{ text: 'AK', datafield: 'angkakredit', width: '8%', cellsalign: 'left', align: 'center' },
					{ text: 'Kuantitas', datafield: 'kuantitas', width: '8%', cellsalign: 'left', align: 'center' },
					{ text: 'Satuan', datafield: 'satuan', width: '8%', cellsalign: 'left', align: 'center' },
					{ text: 'KUAL/MUTU', datafield: 'mutu', width: '8%', cellsalign: 'left', align: 'center' },
					{ text: 'Waktu', datafield: 'waktu', width: '8%', cellsalign: 'left', align: 'center' },
					{ text: 'Satuan', datafield: 'satuanwaktu', width: '8%', cellsalign: 'left', align: 'center' },
					{ text: 'Biaya', datafield: 'biaya', width: '10%', cellsalign: 'left', align: 'center' },
				],
			});
		});
	//batas data SKP
	//tombol-tombol di modal data ajar
		$("#btnnewdataajar").click(function(){ $("#modaldataajar").modal('show'); $('#divupdatedataajar').hide(); $('#divtambahdataajar').show(); });
		$("#btnnewdatasertifikat").click(function(){ $("#modaldatasertifikat").modal('show'); $('#divupdatedatasertifikat').hide(); $('#divtambahdatasertifikat').show(); });
		$("#btnexportdatasertifikat").click(function () {
			var gridContent = $("#griddatasertifikat").jqxGrid('exportdata', 'html');
			$('#tabel_cetak').html(gridContent);		
			$("#tabel_cetak").btechco_excelexport({
				containerid: "tabel_cetak"
				, datatype: $datatype.Table
			});
		});
		$("#btnexportdataajar").click(function () {
			var gridContent = $("#griddataajar").jqxGrid('exportdata', 'html');
			$('#tabel_cetak').html(gridContent);		
			$("#tabel_cetak").btechco_excelexport({
				containerid: "tabel_cetak"
				, datatype: $datatype.Table
			});
		});
		$('#btnsimpandataajar').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('dataajar_jabatan').value;
			var set03=document.getElementById('dataajar_kodeps').value;
			var set04=document.getElementById('dataajar_matakuliah').value;
			var set05=document.getElementById('dataajar_sesuai').value;
			var set06=document.getElementById('dataajar_lingkup').value;
			var set07='tambah';
			var set08='';
			$.post('../simba/exdataajardosen', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08 },
			function(data){
				$("#modaldataajar").modal('hide');
				$("#griddataajar").jqxGrid('updatebounddata');
				$('#logprogram').html(data);
				return false;
			});
		});
		$('#btnupdatedataajar').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('dataajar_jabatan').value;
			var set03=document.getElementById('dataajar_kodeps').value;
			var set04=document.getElementById('dataajar_matakuliah').value;
			var set05=document.getElementById('dataajar_sesuai').value;
			var set06=document.getElementById('dataajar_lingkup').value;
			var set07='ubah';
			var set08=document.getElementById('dataajar_id').value;
			$.post('../simba/exdataajardosen', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08 },
			function(data){
				$("#modaldataajar").modal('hide');
				$("#griddataajar").jqxGrid('updatebounddata');
				$('#logprogram').html(data);
				return false;
			});
		});
		$('#btnhapusdataajar').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('dataajar_jabatan').value;
			var set03=document.getElementById('dataajar_kodeps').value;
			var set04=document.getElementById('dataajar_matakuliah').value;
			var set05=document.getElementById('dataajar_sesuai').value;
			var set06=document.getElementById('dataajar_lingkup').value;
			var set07='hapus';
			var set08=document.getElementById('dataajar_id').value;
			$.post('../simba/exdataajardosen', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08 },
			function(data){
				$("#modaldataajar").modal('hide');
				$("#griddataajar").jqxGrid('updatebounddata');
				$('#logprogram').html(data);
				return false;
			});
		});
		$('#btnsimpandatasertifikat').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('sertifikat_jenis').value;
			var set03=document.getElementById('sertifikat_negara').value;
			var set04=document.getElementById('sertifikat_pemberi').value;
			var set05=document.getElementById('sertifikat_tahun').value;
			var set06=document.getElementById('sertifikat_nama').value;
			var set07='tambah';
			var set08='';
			$.post('../simba/exdatasertifikat', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08 },
			function(data){
				$("#modaldatasertifikat").modal('hide');
				$("#griddatasertifikat").jqxGrid('updatebounddata');
				$('#logprogram').html(data);
				return false;
			});
		});
		$('#btnupdatedatasertifikat').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('sertifikat_jenis').value;
			var set03=document.getElementById('sertifikat_negara').value;
			var set04=document.getElementById('sertifikat_pemberi').value;
			var set05=document.getElementById('sertifikat_tahun').value;
			var set06=document.getElementById('sertifikat_nama').value;
			var set07='ubah';
			var set08=document.getElementById('sertifikat_id').value;
			$.post('../simba/exdatasertifikat', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08 },
			function(data){
				$("#modaldatasertifikat").modal('hide');
				$("#griddatasertifikat").jqxGrid('updatebounddata');
				$('#logprogram').html(data);
				return false;
			});
		});
		$('#btnhapusdatasertifikat').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('sertifikat_jenis').value;
			var set03=document.getElementById('sertifikat_negara').value;
			var set04=document.getElementById('sertifikat_pemberi').value;
			var set05=document.getElementById('sertifikat_tahun').value;
			var set06=document.getElementById('sertifikat_nama').value;
			var set07='hapus';
			var set08=document.getElementById('sertifikat_id').value;
			$.post('../simba/exdatasertifikat', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08 },
			function(data){
				$("#modaldatasertifikat").modal('hide');
				$("#griddatasertifikat").jqxGrid('updatebounddata');
				$('#logprogram').html(data);
				return false;
			});
		});
		$('#btnmatakuliah').click(function () {
			$('#halamandataajar').show();
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
			var set01=document.getElementById('id_masterno').value;	
			var source = {
				datatype: "json",
				datafields: [
					{ name: 'id'},
					{ name: 'no'},
					{ name: 'nama',type: 'text'},
					{ name: 'nip',type: 'text'},
					{ name: 'jabatanakad',type: 'text'},
					{ name: 'matakuliah',type: 'text'},
					{ name: 'sks',type: 'text'},
					{ name: 'tulis',type: 'text'},
					{ name: 'kodeps',type: 'text'},
					{ name: 'jenjang',type: 'text'},
					{ name: 'sesuai',type: 'text'},
					{ name: 'sesuaia',type: 'text'},
					{ name: 'sesuaib',type: 'text'},
					{ name: 'bukti',type: 'text'},
				],
				type: 'POST',
				data: {_token: token, val01:set01},
				url: "../simba/jsondatajdataajar"
			};
			var filerenderer = function (row, column, value) {
				var filebukti = $('#griddataajar').jqxGrid('getrowdata', row).bukti;
				var masterno = $('#griddataajar').jqxGrid('getrowdata', row).no;
				if (filebukti != ''){
					var linkbukti = '<div style="background: white;"><a href="../images/'+masterno+'/'+filebukti+'" target="_blank"><span class="label label-success">DOWNLOAD</span></a></div>';
				}
				else {
					var linkbukti = '<div style="background: white;"></div>';
				}
				return linkbukti;
			}
			var dataAdapter = new $.jqx.dataAdapter(source);
			$("#griddataajar").jqxGrid({
				width: '100%',
				source: dataAdapter,
				columnsresize: true,
				theme: "energyblue",
				autoheight: true,
				selectionmode: 'multiplecellsextended',
				columns: [
					{ text: 'Nama', datafield: 'nama', width: '20%', cellsalign: 'left', align: 'center'  },
					{ text: 'NIP', datafield: 'nip', width: '15%', cellsalign: 'left', align: 'center'  },
					{ text: 'Matakuliah', datafield: 'matakuliah', width: '15%', cellsalign: 'left', align: 'center'  },
					{ text: 'SKS', datafield: 'sks', width: '10%', cellsalign: 'left', align: 'center'  },
					{ text: 'PS', datafield: 'tulis', width: '15%', align: 'center', cellsalign: 'left'},
					{ text: 'Sesuai', datafield: 'sesuaia', width: '10%', cellsalign: 'left', align: 'center' },
					{ text: 'Tidak Sesuai', datafield: 'sesuaib', width: '10%', cellsalign: 'left', align: 'center' },
					{ text: 'File Upload', align: 'center', cellsalign: 'center',  width: '10%', cellsrenderer: filerenderer },
					{ text: 'Bukti', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
						return "Upload";
						}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#griddataajar").offset();
						var dataRecord 	= $("#griddataajar").jqxGrid('getrowdata', editrow);
						$("#upload_id").val(dataRecord.id);
						$("#upload_tabel").val('Data Ajar');
						$("#upload_data").val(dataRecord.matakuliah);
						$("#modaluploader").modal('show');
						}
					},
					{ text: 'Edit/Delete', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
						return "Edit";
						}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#griddataajar").offset();
						var dataRecord 	= $("#griddataajar").jqxGrid('getrowdata', editrow);
						$("#dataajar_id").val(dataRecord.id);
						$("#dataajar_jabatan").val(dataRecord.jabatanakad);
						$("#dataajar_kodeps").val(dataRecord.kodeps);
						$("#dataajar_matakuliah").val(dataRecord.matakuliah);
						$("#dataajar_sesuai").val(dataRecord.sesuai);
						$("#modaldataajar").modal('show');
						$('#divupdatedataajar').show(); 
						$('#divtambahdataajar').hide();
						}
					},			
				],
			});
			var set01=document.getElementById('id_masterno').value;	
			var sourcesertifikat = {
				datatype: "json",
				datafields: [
					{ name: 'id'},
					{ name: 'no'},
					{ name: 'nama',type: 'text'},
					{ name: 'nip',type: 'text'},
					{ name: 'jenis',type: 'text'},
					{ name: 'tahun',type: 'text'},
					{ name: 'namasertifikat',type: 'text'},
					{ name: 'instansi',type: 'text'},
					{ name: 'negara',type: 'text'},
					{ name: 'nmfile',type: 'text'},
					
				],
				type: 'POST',
				data: {_token: token, val01:set01},
				url: "../simba/jsondatajdatasertifikat"
			};
			
			var filerenderer = function (row, column, value) {
				var filebukti = $('#griddatasertifikat').jqxGrid('getrowdata', row).nmfile;
				var masterno = $('#griddatasertifikat').jqxGrid('getrowdata', row).no;
				if (filebukti != ''){
					var linkbukti = '<div style="background: white;"><a href="../images/'+masterno+'/'+filebukti+'" target="_blank"><span class="label label-success">DOWNLOAD</span></a></div>';
				}
				else {
					var linkbukti = '<div style="background: white;"></div>';
				}
				return linkbukti;
			}
			
			var datajsertifikat = new $.jqx.dataAdapter(sourcesertifikat);
			$("#griddatasertifikat").jqxGrid({
				width: '100%',
				source: datajsertifikat,
				columnsresize: true,
				theme: "energyblue",
				autoheight: true,
				selectionmode: 'multiplecellsextended',
				columns: [
					{ text: 'Nama', datafield: 'nama', width: '20%', cellsalign: 'left', align: 'center'  },
					{ text: 'NIP', datafield: 'nip', width: '15%', cellsalign: 'left', align: 'center'  },
					{ text: 'Nama Sertifikat', datafield: 'namasertifikat', width: '15%', cellsalign: 'left', align: 'center'  },
					{ text: 'Jenis', datafield: 'jenis', width: '10%', cellsalign: 'left', align: 'center'  },
					{ text: 'Instansi', datafield: 'instansi', width: '15%', align: 'center', cellsalign: 'left'},
					{ text: 'Negara', datafield: 'negara', width: '10%', cellsalign: 'left', align: 'center' },
					{ text: 'Tahun', datafield: 'tahun', width: '10%', cellsalign: 'left', align: 'center' },
					{ text: 'File Upload', align: 'center', cellsalign: 'center',  width: '10%', cellsrenderer: filerenderer },
					{ text: 'Bukti', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
						return "Upload";
						}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#griddatasertifikat").offset();
						var dataRecord 	= $("#griddatasertifikat").jqxGrid('getrowdata', editrow);
						$("#upload_id").val(dataRecord.id);
						$("#upload_tabel").val('Data Sertifikat');
						$("#upload_data").val(dataRecord.namasertifikat);
						$("#modaluploader").modal('show');
						}
					},
					{ text: 'Edit/Delete', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
						return "Edit";
						}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#griddatasertifikat").offset();
						var dataRecord 	= $("#griddatasertifikat").jqxGrid('getrowdata', editrow);
						$("#sertifikat_id").val(dataRecord.id);
						$("#sertifikat_jenis").val(dataRecord.jabatanakad);
						$("#sertifikat_negara").val(dataRecord.kodeps);
						$("#sertifikat_pemberi").val(dataRecord.matakuliah);
						$("#sertifikat_tahun").val(dataRecord.sesuai);
						$("#modaldatasertifikat").modal('show');
						$('#divupdatedatasertifikat').show(); 
						$('#divtambahdatasertifikat').hide();
						}
					},			
				],
			});
		});
	//batas tombol di modal asesor
	//tombol-tombol di modal asesor
		$("#btnnewasesor").click(function(){ $("#modaladddataasesor").modal('show'); $('#divupdateasesor').hide(); $('#divtambahasesor').show(); });
		$("#btnexportasesor").click(function () {
			var gridContent = $("#gridasesor").jqxGrid('exportdata', 'html');
			$('#tabel_cetak').html(gridContent);		
			$("#tabel_cetak").btechco_excelexport({
				containerid: "tabel_cetak"
				, datatype: $datatype.Table
			});
		});
		$('#btnsimpandataasesor').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('asesor_dosen1').value;
			var set03=document.getElementById('asesor_dosen2').value;
			var set04=document.getElementById('asesor_keterangan').value;
			var set05=document.getElementById('asesor_semester').value;
			var set06=document.getElementById('asesor_tahunakad').value;
			var set07='tambah';
			var set08='';
			$.post('../simba/exdataasesor', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08 },
			function(data){
				$("#modaladddataasesor").modal('hide');
				$("#gridasesor").jqxGrid('updatebounddata');
				$('#logprogram').html(data);
				return false;
			});
		});
		$('#btnupdatedataasesor').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('asesor_dosen1').value;
			var set03=document.getElementById('asesor_dosen2').value;
			var set04=document.getElementById('asesor_keterangan').value;
			var set05=document.getElementById('asesor_semester').value;
			var set06=document.getElementById('asesor_tahunakad').value;
			var set07='ubah';
			var set08=document.getElementById('asesor_id').value;
			$.post('../simba/exdataasesor', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08 },
			function(data){
				$("#modaladddataasesor").modal('hide');
				$("#gridasesor").jqxGrid('updatebounddata');
				$('#logprogram').html(data);
				return false;
			});
		});
		$('#btnhapusasesor').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('asesor_dosen1').value;
			var set03=document.getElementById('asesor_dosen2').value;
			var set04=document.getElementById('asesor_keterangan').value;
			var set05=document.getElementById('asesor_semester').value;
			var set06=document.getElementById('asesor_tahunakad').value;
			var set07='hapus';
			var set08=document.getElementById('asesor_id').value;
			$.post('../simba/exdataasesor', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08 },
			function(data){
				$("#modaladddataasesor").modal('hide');
				$("#gridasesor").jqxGrid('updatebounddata');
				$('#logprogram').html(data);
				return false;
			});
		});
		$('#btndataasesor').click(function () {
			$('#halamandataasesor').show();
			$('#halamandataajar').hide();
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
			var set01=document.getElementById('id_masterno').value;	
			var source =
				{
					datatype: "json",
					datafields: [
						{ name: 'id'},
						{ name: 'no'},
						{ name: 'nama',type: 'text'},
						{ name: 'nip',type: 'text'},
						{ name: 'dosen1',type: 'text'},
						{ name: 'dosen2',type: 'text'},
						{ name: 'keterangan',type: 'text'},
						{ name: 'semester',type: 'text'},
						{ name: 'tahunakad',type: 'text'},
						{ name: 'bukti',type: 'text'},
					],
					type: 'POST',
					data: {_token: token, val01:set01},
					url: "../simba/jsondataasesor"
				};
				
				var filerenderer = function (row, column, value) {
					var filebukti = $('#gridasesor').jqxGrid('getrowdata', row).bukti;
					var masterno = $('#gridasesor').jqxGrid('getrowdata', row).no;
					if (filebukti != ''){
						var linkbukti = '<div style="background: white;"><a href="../images/'+masterno+'/'+filebukti+'" target="_blank"><span class="label label-success">DOWNLOAD</span></a></div>';
					}
					else {
						var linkbukti = '<div style="background: white;"></div>';
					}
					return linkbukti;
				}
			
				var dataAdapter = new $.jqx.dataAdapter(source);
				$("#gridasesor").jqxGrid({
				width: '100%',
				source: dataAdapter,
				columnsresize: true,
				theme: "energyblue",
				autoheight: true,
				selectionmode: 'multiplecellsextended',
				columns: [
					{ text: 'Nama', datafield: 'nama', width: '20%', cellsalign: 'left', align: 'center'  },
					{ text: 'NIP', datafield: 'nip', width: '15%', cellsalign: 'left', align: 'center'  },
					{ text: 'Asesor 1', datafield: 'dosen1', width: '15%', cellsalign: 'left', align: 'center'  },
					{ text: 'Asesor 2', datafield: 'dosen2', width: '15%', cellsalign: 'left', align: 'center'  },
					{ text: 'Keterangan', datafield: 'keterangan', width: '15%', align: 'center', cellsalign: 'left'},
					{ text: 'Semester', datafield: 'semester', width: '10%', cellsalign: 'left', align: 'center' },
					{ text: 'Tahun Akademik', datafield: 'tahunakad', width: '10%', cellsalign: 'left', align: 'center' },
					{ text: 'File Upload', align: 'center', cellsalign: 'center',  width: '10%', cellsrenderer: filerenderer },
					{ text: 'Bukti', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
						return "Upload";
						}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridasesor").offset();
						var dataRecord 	= $("#gridasesor").jqxGrid('getrowdata', editrow);
						var set01 		= dataRecord.semester;
						var set02 		= dataRecord.tahunakad;
						var tulis		= set01 + ' ' + $set02;
						$("#upload_id").val(dataRecord.id);
						$("#upload_tabel").val('Data Asesor');
						$("#upload_data").val(tulis);
						$("#modaluploader").modal('show');
						}
					},
					{ text: 'Edit/Delete', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
						return "Edit";
						}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridasesor").offset();
						var dataRecord 	= $("#gridasesor").jqxGrid('getrowdata', editrow);
						$("#asesor_dosen1").val(dataRecord.dosen1);
						$("#asesor_dosen2").val(dataRecord.dosen1);
						$("#asesor_id").val(dataRecord.id);
						$("#asesor_keterangan").val(dataRecord.keterangan);
						$("#asesor_semester").val(dataRecord.semester);
						$("#asesor_tahunakad").val(dataRecord.tahunakad);
						$("#modaladddataasesor").modal('show');
						$('#divupdateasesor').show(); 
						$('#divtambahasesor').hide();
						}
					},			
				],
			});
		});
	//batas tombol di modal asesor
	//tombol-tombol di modal organisasi
		$("#btnneworganisasi").click(function(){ $("#modaladddataorganisasi").modal('show'); $('#divupdateorganisasi').hide(); $('#divtambahorganisasi').show(); });
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
			var set10='tambah';
			var set11='';
			$.post('../simba/exdataorganisasi', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, val11: set11 },
			function(data){
				$("#modaladddataorganisasi").modal('hide');
				$("#gridorganisasi").jqxGrid('updatebounddata');
				$('#logprogram').html(data);
				return false;
			});
		});
		$('#btnupdatedataorganisasi').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('organisasi_jabpejabat').value;
			var set03=document.getElementById('organisasi_kedudukan').value;
			var set04=document.getElementById('organisasi_mulai').value;
			var set05=document.getElementById('organisasi_nama').value;
			var set06=document.getElementById('organisasi_namapejabat').value;
			var set07=document.getElementById('organisasi_nippejabat').value;
			var set08=document.getElementById('organisasi_nosk').value;
			var set09=document.getElementById('organisasi_selesai').value;
			var set10='ubah';
			var set11=document.getElementById('organisasi_id').value;
			$.post('../simba/exdataorganisasi', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, val11: set11 },
			function(data){
				$("#modaladddataorganisasi").modal('hide');
				$("#gridorganisasi").jqxGrid('updatebounddata');
				$('#logprogram').html(data);
				return false;
			});
		});
		$('#btnhapusorganisasi').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('organisasi_jabpejabat').value;
			var set03=document.getElementById('organisasi_kedudukan').value;
			var set04=document.getElementById('organisasi_mulai').value;
			var set05=document.getElementById('organisasi_nama').value;
			var set06=document.getElementById('organisasi_namapejabat').value;
			var set07=document.getElementById('organisasi_nippejabat').value;
			var set08=document.getElementById('organisasi_nosk').value;
			var set09=document.getElementById('organisasi_selesai').value;
			var set10='hapus';
			var set11=document.getElementById('organisasi_id').value;
			$.post('../simba/exdataorganisasi', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, val11: set11 },
			function(data){
				$("#modaladddataorganisasi").modal('hide');
				$("#gridorganisasi").jqxGrid('updatebounddata');
				$('#logprogram').html(data);
				return false;
			});
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
			var set01=document.getElementById('id_masterno').value;	
			var source =
				{
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
					data: {_token: token, val01:set01},
					url: "../simba/jsondataorganisasi"
				};
				var filerenderer = function (row, column, value) {
					var filebukti = $('#gridorganisasi').jqxGrid('getrowdata', row).bukti;
					var masterno = $('#gridorganisasi').jqxGrid('getrowdata', row).no;
					if (filebukti != ''){
						var linkbukti = '<div style="background: white;"><a href="../images/'+masterno+'/'+filebukti+'" target="_blank"><span class="label label-success">DOWNLOAD</span></a></div>';
					}
					else {
						var linkbukti = '<div style="background: white;"></div>';
					}
					return linkbukti;
				}
				
				var dataAdapter = new $.jqx.dataAdapter(source);
				$("#gridorganisasi").jqxGrid(
				{
				width: '100%',
				source: dataAdapter,
				columnsresize: true,
				theme: "energyblue",
				autoheight: true,
				selectionmode: 'multiplecellsextended',
				columns: [
					{ text: 'Nama', datafield: 'nama', width: '20%', cellsalign: 'left', align: 'center'  },
					{ text: 'NIP', datafield: 'nip', width: '15%', cellsalign: 'left', align: 'center'  },
					{ text: 'Nama Organisasi', datafield: 'namaorganisasi', width: '15%', cellsalign: 'left', align: 'center'  },
					{ text: 'Kedudukan', datafield: 'kedudukan', width: '15%', cellsalign: 'left', align: 'center'  },
					{ text: 'No. SK', datafield: 'nosk', width: '15%', align: 'center', cellsalign: 'left'},
					{ text: 'Mulai', datafield: 'mulai', width: '10%', cellsalign: 'left', align: 'center' },
					{ text: 'Selesai', datafield: 'selesai', width: '10%', cellsalign: 'left', align: 'center' },
					{ text: 'Nama Pejabat', datafield: 'namapejabat', width: '10%', cellsalign: 'left', align: 'center'  },
					{ text: 'Jabatan', datafield: 'jabpejabat', width: '10%', cellsalign: 'left', align: 'center'  },
					{ text: 'NIP', datafield: 'nippejabat', width: '10%', cellsalign: 'left', align: 'center'  },
					{ text: 'File Upload', align: 'center', cellsalign: 'center',  width: '10%', cellsrenderer: filerenderer },
					{ text: 'Bukti', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
						return "Upload";
						}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridorganisasi").offset();
						var dataRecord 	= $("#gridorganisasi").jqxGrid('getrowdata', editrow);
						$("#upload_id").val(dataRecord.id);
						$("#upload_tabel").val('Data Organisasi');
						$("#upload_data").val(dataRecord.namaorganisasi);
						$("#modaluploader").modal('show');
						}
					},
					{ text: 'Edit/Delete', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
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
						$("#modaladddataorganisasi").modal('show');
						$('#divupdateorganisasi').show(); 
						$('#divtambahorganisasi').hide();
						}
					},			
				],
			});
		});
	//batas tombol di modal organisasi
	//tombol-tombol di modal seminar
		$("#btnnewseminar").click(function(){ $("#modaladddataseminar").modal('show'); $('#divupdateseminar').hide(); $('#divtambahseminar').show(); });
		$("#btnexportseminar").click(function () {
			var gridContent = $("#gridseminar").jqxGrid('exportdata', 'html');
			$('#tabel_cetak').html(gridContent);		
			$("#tabel_cetak").btechco_excelexport({
				containerid: "tabel_cetak"
				, datatype: $datatype.Table
			});
		});
		$('#btnsimpandataseminar').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('seminar_kedudukan').value;
			var set03=document.getElementById('seminar_lokasi').value;
			var set04=document.getElementById('seminar_nama').value;
			var set05=document.getElementById('seminar_penyelenggara').value;
			var set06=document.getElementById('seminar_tahun').value;
			var set07=document.getElementById('seminar_tingkat').value;
			var set08='tambah';
			var set09='';
			$.post('../simba/exdataseminar', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09 },
			function(data){
				$("#modaladddataseminar").modal('hide');
				$("#gridseminar").jqxGrid('updatebounddata');
				$('#logprogram').html(data);
				return false;
			});
		});
		$('#btnupdatedataseminar').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('seminar_kedudukan').value;
			var set03=document.getElementById('seminar_lokasi').value;
			var set04=document.getElementById('seminar_nama').value;
			var set05=document.getElementById('seminar_penyelenggara').value;
			var set06=document.getElementById('seminar_tahun').value;
			var set07=document.getElementById('seminar_tingkat').value;
			var set08='ubah';
			var set09=document.getElementById('seminar_id').value;
			$.post('../simba/exdataseminar', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09 },
			function(data){
				$("#modaladddataseminar").modal('hide');
				$("#gridseminar").jqxGrid('updatebounddata');
				$('#logprogram').html(data);
				return false;
			});
		});
		$('#btnhapusseminar').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('seminar_kedudukan').value;
			var set03=document.getElementById('seminar_lokasi').value;
			var set04=document.getElementById('seminar_nama').value;
			var set05=document.getElementById('seminar_penyelenggara').value;
			var set06=document.getElementById('seminar_tahun').value;
			var set07=document.getElementById('seminar_tingkat').value;
			var set08='hapus';
			var set09=document.getElementById('seminar_id').value;
			$.post('../simba/exdataseminar', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09 },
			function(data){
				$("#modaladddataseminar").modal('hide');
				$("#gridseminar").jqxGrid('updatebounddata');
				$('#logprogram').html(data);
				return false;
			});
		});
		$('#btnriwayatseminar').click(function () {
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
			$('#halamanseminar').show();
			$('#halamansertifikasi').hide();
			$('#halamanangkakredit').hide();
			$('#halamandatabkd').hide();
			$('#halamanremun').hide();
			$('#halamanskp').hide();
			var set01=document.getElementById('id_masterno').value;	
			var source =
				{
					datatype: "json",
					datafields: [
						{ name: 'id'},
						{ name: 'no'},
						{ name: 'nama',type: 'text'},
						{ name: 'nip',type: 'text'},
						{ name: 'kedudukan',type: 'text'},
						{ name: 'lokasi',type: 'text'},
						{ name: 'namaacara',type: 'text'},
						{ name: 'penyelenggara',type: 'text'},
						{ name: 'tahun',type: 'text'},
						{ name: 'tingkat',type: 'text'},
						{ name: 'bukti',type: 'text'},
					],
					type: 'POST',
					data: {_token: token, val01:set01},
					url: "../simba/jsondataseminar"
				};
				var filerenderer = function (row, column, value) {
					var filebukti = $('#gridseminar').jqxGrid('getrowdata', row).bukti;
					var masterno = $('#gridseminar').jqxGrid('getrowdata', row).no;
					if (filebukti != ''){
						var linkbukti = '<div style="background: white;"><a href="../images/'+masterno+'/'+filebukti+'" target="_blank"><span class="label label-success">DOWNLOAD</span></a></div>';
					}
					else {
						var linkbukti = '<div style="background: white;"></div>';
					}
					return linkbukti;
				}
				var dataAdapter = new $.jqx.dataAdapter(source);
				$("#gridseminar").jqxGrid(
				{
				width: '100%',
				source: dataAdapter,
				columnsresize: true,
				theme: "energyblue",
				autoheight: true,
				selectionmode: 'multiplecellsextended',
				columns: [
					{ text: 'Nama', datafield: 'nama', width: '20%', cellsalign: 'left', align: 'center'  },
					{ text: 'NIP', datafield: 'nip', width: '15%', cellsalign: 'left', align: 'center'  },
					{ text: 'Kedudukan', datafield: 'kedudukan', width: '15%', cellsalign: 'left', align: 'center'  },
					{ text: 'Lokasi', datafield: 'lokasi', width: '15%', align: 'center', cellsalign: 'left'},
					{ text: 'Nama Acara', datafield: 'namaacara', width: '10%', cellsalign: 'left', align: 'center' },
					{ text: 'Penyelenggara', datafield: 'penyelenggara', width: '10%', cellsalign: 'left', align: 'center' },
					{ text: 'Tahun', datafield: 'tahun', width: '10%', cellsalign: 'left', align: 'center'  },
					{ text: 'Tingkat', datafield: 'tingkat', width: '10%', cellsalign: 'left', align: 'center'  },
					{ text: 'File Upload', align: 'center', cellsalign: 'center',  width: '10%', cellsrenderer: filerenderer },
					{ text: 'Bukti', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
						return "Upload";
						}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridseminar").offset();
						var dataRecord 	= $("#gridseminar").jqxGrid('getrowdata', editrow);
						$("#upload_id").val(dataRecord.id);
						$("#upload_tabel").val('Data Seminar');
						$("#upload_data").val(dataRecord.namaacara);
						$("#modaluploader").modal('show');
						}
					},
					{ text: 'Edit/Delete', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
						return "Edit";
						}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridseminar").offset();
						var dataRecord 	= $("#gridseminar").jqxGrid('getrowdata', editrow);
						$("#seminar_id").val(dataRecord.id);
						$("#seminar_kedudukan").val(dataRecord.kedudukan);
						$("#seminar_lokasi").val(dataRecord.lokasi);
						$("#seminar_nama").val(dataRecord.namaacara);
						$("#seminar_penyelenggara").val(dataRecord.penyelenggara);
						$("#seminar_tahun").val(dataRecord.tahun);
						$("#seminar_tingkat").val(dataRecord.tingkat);
						$("#modaladddataseminar").modal('show');
						$('#divupdateseminar').show(); 
						$('#divtambahseminar').hide();
						}
					},			
				],
			});
		});
	//batas tombol di modal seminar
	//tombol-tombol di modal keluarga
		$("#btnnewkeluarga").click(function(){ $("#modaladdkeluarga").modal('show'); $('#divupdatekeluarga').hide(); $('#divtambahkeluarga').show(); });
		$("#btnexportkeluarga").click(function () {
			var gridContent = $("#gridkeluarga").jqxGrid('exportdata', 'html');
			$('#tabel_cetak').html(gridContent);		
			$("#tabel_cetak").btechco_excelexport({
				containerid: "tabel_cetak"
				, datatype: $datatype.Table
			});
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
			var set10='tambah';
			var set12=document.getElementById('keluarga_kelamin').value;
			var set13=document.getElementById('keluarga_tglmenikah').value;
			$.post('../simba/exdatakeluarga', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, val11: '', val12: set12, val13: set13 },
			function(data){
				$("#modaladdkeluarga").modal('hide');
				$("#gridkeluarga").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
			});
		});
		$('#btnupdatedatakeluarga').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('keluarga_alamat').value;
			var set03=document.getElementById('keluarga_hubklg').value;
			var set04=document.getElementById('keluarga_jenjang').value;
			var set05=document.getElementById('keluarga_nama').value;
			var set06=document.getElementById('keluarga_pekerjaan').value;
			var set07=document.getElementById('keluarga_status').value;
			var set08=document.getElementById('keluarga_tempatlahir').value;
			var set09=document.getElementById('keluarga_tgllahir').value;
			var set10='ubah';
			var set11=document.getElementById('keluarga_idne').value;
			var set12=document.getElementById('keluarga_kelamin').value;
			var set13=document.getElementById('keluarga_tglmenikah').value;
			$.post('../simba/exdatakeluarga', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, val11: set11, val12: set12, val13: set13 },
			function(data){
				$("#modaladdkeluarga").modal('hide');
				$("#gridkeluarga").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
			});
		});
		$('#btnhapuskeluarga').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('keluarga_alamat').value;
			var set03=document.getElementById('keluarga_hubklg').value;
			var set04=document.getElementById('keluarga_jenjang').value;
			var set05=document.getElementById('keluarga_nama').value;
			var set06=document.getElementById('keluarga_pekerjaan').value;
			var set07=document.getElementById('keluarga_status').value;
			var set08=document.getElementById('keluarga_tempatlahir').value;
			var set09=document.getElementById('keluarga_tgllahir').value;
			var set10='hapus';
			var set11=document.getElementById('keluarga_idne').value;
			var set12=document.getElementById('keluarga_kelamin').value;
			var set13=document.getElementById('keluarga_tglmenikah').value;
			$.post('../simba/exdatakeluarga', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, val11: set11, val12: set12, val13: set13 },
			function(data){
				$("#modaladdkeluarga").modal('hide');
				$("#gridkeluarga").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
			});
		});
		$('#btnriwayatkeluarga').click(function () {
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
			var set01=document.getElementById('id_masterno').value;	
			var source =
				{
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
						{ name: 'bukti',type: 'text'},
					],
					type: 'POST',
					data: {_token: token, val01:set01},
					url: "../simba/jsondatakeluarga"
				};
				var filerenderer = function (row, column, value) {
					var filebukti = $('#gridkeluarga').jqxGrid('getrowdata', row).bukti;
					var masterno = $('#gridkeluarga').jqxGrid('getrowdata', row).no;
					if (filebukti != ''){
						var linkbukti = '<div style="background: white;"><a href="../images/'+masterno+'/'+filebukti+'" target="_blank"><span class="label label-success">DOWNLOAD</span></a></div>';
					}
					else {
						var linkbukti = '<div style="background: white;"></div>';
					}
					return linkbukti;
				}
				
				var dataAdapter = new $.jqx.dataAdapter(source);
				$("#gridkeluarga").jqxGrid(
				{
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
					{ text: 'File Upload', align: 'center', cellsalign: 'center',  width: '10%', cellsrenderer: filerenderer },
					{ text: 'Bukti', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
						return "Upload";
						}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridkeluarga").offset();
						var dataRecord 	= $("#gridkeluarga").jqxGrid('getrowdata', editrow);
						$("#upload_id").val(dataRecord.id);
						$("#upload_tabel").val('Data Anggota Keluarga');
						$("#upload_data").val(dataRecord.nama);
						$("#modaluploader").modal('show');
						}
					},
					{ text: 'Edit/Delete', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
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
						$("#modaladdkeluarga").modal('show');
						$('#divupdatekeluarga').show(); 
						$('#divtambahkeluarga').hide();
						}
					},			
				],
			});
		});
	//batas tombol di modal keluarga
	//tombol-tombol di modal mutasi
		$("#btnnewmutasi").click(function(){ $("#modaladddatamutasi").modal('show'); $('#divupdatemutasi').hide(); $('#divtambahmutasi').show(); });
		$("#btnexportmutasi").click(function () {
			var gridContent = $("#gridmutasi").jqxGrid('exportdata', 'html');
			$('#tabel_cetak').html(gridContent);		
			$("#tabel_cetak").btechco_excelexport({
				containerid: "tabel_cetak"
				, datatype: $datatype.Table
			});
		});
		$('#btnsimpandatamutasi').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('mutasi_keterangan').value;
			var set03=document.getElementById('mutasi_nosk').value;
			var set04=document.getElementById('mutasi_status').value;
			var set05=document.getElementById('mutasi_tanggal').value;
			var set06='tambah';
			var set07='';
			$.post('../simba/exdatamutasi', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07 },
			function(data){
				$("#modaladddatamutasi").modal('hide');
				$("#gridmutasi").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
			});
		});
		$('#btnupdatedatamutasi').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('mutasi_keterangan').value;
			var set03=document.getElementById('mutasi_nosk').value;
			var set04=document.getElementById('mutasi_status').value;
			var set05=document.getElementById('mutasi_tanggal').value;
			var set06='ubah';
			var set07=document.getElementById('mutasi_idne').value;
			$.post('../simba/exdatamutasi', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07 },
			function(data){
				$("#modaladddatamutasi").modal('hide');
				$("#gridmutasi").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
			});
		});
		$('#btnhapusmutasi').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('mutasi_keterangan').value;
			var set03=document.getElementById('mutasi_nosk').value;
			var set04=document.getElementById('mutasi_status').value;
			var set05=document.getElementById('mutasi_tanggal').value;
			var set06='hapus';
			var set07=document.getElementById('mutasi_idne').value;
			$.post('../simba/exdatamutasi', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07 },
			function(data){
				$("#modaladddatamutasi").modal('hide');
				$("#gridmutasi").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
			});
		});
		$('#btnmutasi').click(function () {
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
			$('#halamanmutasi').show();
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
			var set01=document.getElementById('id_masterno').value;	
			var source =
				{
					datatype: "json",
					datafields: [
						{ name: 'id'},
						{ name: 'no'},
						{ name: 'status',type: 'text'},
						{ name: 'nosk',type: 'text'},
						{ name: 'tanggal',type: 'text'},
						{ name: 'keterangan',type: 'text'},
						{ name: 'nama',type: 'text'},
						{ name: 'nip',type: 'text'},
						{ name: 'bukti',type: 'text'},
					],
					type: 'POST',
					data: {_token: token, val01:set01},
					url: "../simba/jsondatamutasi"
				};
				var dataAdapter = new $.jqx.dataAdapter(source);
				var editrow = -1;
				var filerenderer = function (row, column, value) {
					var filebukti = $('#gridmutasi').jqxGrid('getrowdata', row).bukti;
					var masterno = $('#gridmutasi').jqxGrid('getrowdata', row).no;
					if (filebukti != ''){
						var linkbukti = '<div style="background: white;"><a href="../images/'+masterno+'/'+filebukti+'" target="_blank"><span class="label label-success">DOWNLOAD</span></a></div>';
					}
					else {
						var linkbukti = '<div style="background: white;"></div>';
					}
					return linkbukti;
				}
				$("#gridmutasi").jqxGrid({
				width: '100%',
				source: dataAdapter,
				columnsresize: true,
				theme: "energyblue",
				autoheight: true,
				selectionmode: 'multiplecellsextended',
				columns: [
					{ text: 'Nama', datafield: 'nama', width: '20%', cellsalign: 'left', align: 'center'  },
					{ text: 'NIP', datafield: 'nip', width: '15%', cellsalign: 'left', align: 'center'  },
					{ text: 'Status', datafield: 'status', width: '10%', cellsalign: 'left', align: 'center'  },
					{ text: 'No.SK', datafield: 'nosk', width: '15%', align: 'center', cellsalign: 'left'},
					{ text: 'Tanggal', datafield: 'tanggal', width: '10%', cellsalign: 'left', align: 'center' },
					{ text: 'Keterangan', datafield: 'keterangan', width: '20%', cellsalign: 'left', align: 'center' },
					{ text: 'File Upload', align: 'center', cellsalign: 'center',  width: '10%', cellsrenderer: filerenderer },
					{ text: 'Bukti', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
						return "Upload";
						}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridmutasi").offset();
						var dataRecord 	= $("#gridmutasi").jqxGrid('getrowdata', editrow);
						$("#upload_id").val(dataRecord.id);
						$("#upload_tabel").val('Data Mutasi');
						$("#upload_data").val(dataRecord.nosk);
						$("#modaluploader").modal('show');
						}
					},
					{ text: 'Edit/Delete', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
						return "Edit";
						}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridmutasi").offset();
						var dataRecord 	= $("#gridmutasi").jqxGrid('getrowdata', editrow);
						$("#mutasi_keterangan").val(dataRecord.keterangan);
						$("#mutasi_nosk").val(dataRecord.nosk);
						$("#mutasi_status").val(dataRecord.status);
						$("#mutasi_tanggal").val(dataRecord.tanggal);
						$("#mutasi_idne").val(dataRecord.id);
						$("#modaladddatamutasi").modal('show');
						$('#divupdatemutasi').show(); 
						$('#divtambahmutasi').hide();
						}
					},			
				],
			});
		});
	//batas tombol di modal mutasi
	//tombol-tombol di modal identitas
		$("#btnnewidentitas").click(function(){ $("#modaladddataidentitas").modal('show'); $('#divupdateidentitas').hide(); $('#divtambahidentitas').show(); });
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
			var set02=document.getElementById('identitas_aktif').value;
			var set03=document.getElementById('identitas_jenis').value;
			var set04=document.getElementById('identitas_nomer').value;
			var set05='tambah';
			var set06='';
			$.post('../simba/exdataidentitas', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06 },
			function(data){
				$("#modaladddataidentitas").modal('hide');
				$("#grididentitas").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
			});
		});
		$('#btnupdatedataidentitas').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('identitas_aktif').value;
			var set03=document.getElementById('identitas_jenis').value;
			var set04=document.getElementById('identitas_nomer').value;
			var set05='ubah';
			var set06=document.getElementById('identitas_idne').value;
			$.post('../simba/exdataidentitas', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06 },
			function(data){
				$("#modaladddataidentitas").modal('hide');
				$("#grididentitas").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
			});
		});
		$('#btnhapusidentitas').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('identitas_aktif').value;
			var set03=document.getElementById('identitas_jenis').value;
			var set04=document.getElementById('identitas_nomer').value;
			var set05='hapus';
			var set06=document.getElementById('identitas_idne').value;
			$.post('../simba/exdataidentitas', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06 },
			function(data){
				$("#modaladddataidentitas").modal('hide');
				$("#grididentitas").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
			});
		});
		$('#btnriwayatdiri').click(function () {
			$('#halamandataajar').hide();
			$('#halamandataasesor').hide();
			$('#halamandatabkd').hide();
			$('#halamandiklat').hide();
			$('#halamanfungsional').hide();
			$('#halamangaji').hide();
			$('#halamanidentitas').show();
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
			var set01=document.getElementById('id_masterno').value;
			
			var source = {
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
				data: {_token: token, val01:set01},
				url: "../simba/jsondataidentitas"
			};		
			var dataAdapter = new $.jqx.dataAdapter(source);
			var editrow = -1;
			var filerenderer = function (row, column, value) {
				var filebukti = $('#grididentitas').jqxGrid('getrowdata', row).bukti;
				var masterno = $('#grididentitas').jqxGrid('getrowdata', row).no;
				if (filebukti != ''){
					var linkbukti = '<div style="background: white;"><a href="../images/'+masterno+'/'+filebukti+'" target="_blank"><span class="label label-success">DOWNLOAD</span></a></div>';
				}
				else {
					var linkbukti = '<div style="background: white;"></div>';
				}
				return linkbukti;
			}
			$("#grididentitas").jqxGrid({
				width: '100%',
				source: dataAdapter,
				columnsresize: true,
				theme: "energyblue",
				autoheight: true,
				selectionmode: 'multiplecellsextended',
				columns: [
					{ text: 'Nama', datafield: 'nama', width: '30%', cellsalign: 'left', align: 'center'  },
					{ text: 'NIP', datafield: 'nip', width: '20%', cellsalign: 'left', align: 'center'  },
					{ text: 'Status', datafield: 'aktif', width: '10%', cellsalign: 'left', align: 'center'  },
					{ text: 'Jenis', datafield: 'jenisid', width: '15%', align: 'center', cellsalign: 'left'},
					{ text: 'No.Identitas', datafield: 'nomer', width: '15%', cellsalign: 'left', align: 'center' },
					{ text: 'File Upload', align: 'center', cellsalign: 'center',  width: '10%', cellsrenderer: filerenderer },
					{ text: 'Bukti', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
						return "Upload";
						}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#grididentitas").offset();
						var dataRecord 	= $("#grididentitas").jqxGrid('getrowdata', editrow);
						$("#upload_id").val(dataRecord.id);
						$("#upload_tabel").val('Data Identitas');
						$("#upload_data").val(dataRecord.nomer);
						$("#modaluploader").modal('show');
						}
					},
					{ text: 'Edit/Delete', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
						return "Edit";
						}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#grididentitas").offset();
						var dataRecord 	= $("#grididentitas").jqxGrid('getrowdata', editrow);
						$("#identitas_aktif").val(dataRecord.aktif);
						$("#identitas_jenis").val(dataRecord.jenisid);
						$("#identitas_nomer").val(dataRecord.nomer);
						$("#identitas_idne").val(dataRecord.id);			
						$("#modaladddataidentitas").modal('show');
						$('#divupdateidentitas').show(); 
						$('#divtambahidentitas').hide();
						}
					},			
				],
			});
		});
	//batas tombol di modal identitas
	//tombol-tombol di modal pendidikan
		$("#btnnewpendidikan").click(function(){ $("#modaladddatapendidikan").modal('show'); $('#divupdatependidikan').hide(); $('#divtambahpendidikan').show(); });
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
			var set12='tambah';
			var set13='';
			$.post('../simba/exdatapendidikan', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, val11: set11, val12: set12, val13: set13 },
			function(data){
				$("#modaladddatapendidikan").modal('hide');
				$("#gridpendidikan").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
				});		
			});
		$('#btnupdatedatapendidikan').on('click', function (){	
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
			var set12='ubah';
			var set13=document.getElementById('pendidikan_idne').value;
			$.post('../simba/exdatapendidikan', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, val11: set11, val12: set12, val13: set13 },
			function(data){
				$("#modaladddatapendidikan").modal('hide');
				$("#gridpendidikan").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
				});		
			});
		$('#btnhapuspendidikan').on('click', function (){	
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
			var set12='hapus';
			var set13=document.getElementById('pendidikan_idne').value;
			$.post('../simba/exdatapendidikan', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, val11: set11, val12: set12, val13: set13 },
			function(data){
				$("#modaladddatapendidikan").modal('hide');
				$("#gridpendidikan").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
				});		
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
			var set01	= document.getElementById('id_masterno').value;
			var set02	= 'cariperid';
			var set03	= 'caritubel';
			var token	= document.getElementById('token').value;
			var sourcedetail = {
				datatype: "json",
				datafields: [
					{ name: 'idsurat', type: 'text'},
					{ name: 'jenissk', type: 'text'},
					{ name: 'paraf1', type: 'text'},
					{ name: 'paraf2', type: 'text'},
					{ name: 'paraf3', type: 'text'},		
					{ name: 'paraf4', type: 'text'},
					{ name: 'penandatangan', type: 'text'},
					{ name: 'sparaf1', type: 'text'},
					{ name: 'sparaf2', type: 'text'},
					{ name: 'sparaf3', type: 'text'},
					{ name: 'sparaf4', type: 'text'},
					{ name: 'spenandatangan', type: 'text'},
					{ name: 'menimbang', type: 'text'},
					{ name: 'mengingat', type: 'text'},
					{ name: 'menetapkan', type: 'text'},
					{ name: 'tmt', type: 'text'},
					{ name: 'idpeg', type: 'text'},
					{ name: 'nama', type: 'text'},
					{ name: 'nip', type: 'text'},
					{ name: 'golongan', type: 'text'},
					{ name: 'statuspeg', type: 'text'},
					{ name: 'jenispeg', type: 'text'},
					{ name: 'unitkerjapeg', type: 'text'},
					{ name: 'jabatanpeg', type: 'text'},
					{ name: 'kelas', type: 'text'},
					{ name: 'nilai', type: 'text'},
					{ name: 'tgp', type: 'text'},
					{ name: 'insentif', type: 'text'},
					{ name: 'konseptor', type: 'text'},
					{ name: 'unitkonseptor', type: 'text'},
					{ name: 'nomor', type: 'text'},
					{ name: 'tahun', type: 'text'},
					{ name: 'tanggal', type: 'text'},
				],
				type: 'POST',
				data: {	val01:set01, val02:set02, val03:set03, _token: token },
				url: '../dokar/jgetdetailpangkat',
			};
			var datadetail = new $.jqx.dataAdapter(sourcedetail);
			$("#gridriwayatpendidikan").jqxGrid({
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
					{ text: 'Preview', editable: false, sortable: false, filterable: false,columntype: 'button', width: '8%', align: 'center', cellsrenderer: function () {
						return "Preview";
						}, buttonclick: function (row) {		
							editrow = row;	
							var offset 		= $("#gridriwayatpendidikan").offset();		
							var dataRecord 	= $("#gridriwayatpendidikan").jqxGrid('getrowdata', editrow);
							window.open("{{URL::to("/")}}/viewsurat/58ddd975e88084b35fc973ab7518d4ba-"+dataRecord.idsurat, '_blank');
						}
					},
					{ text: 'Jenis', datafield: 'jenissk', filtertype: 'checkedlist', width: '22%', cellsalign: 'center', align: 'center'  },
					{ text: 'Penanda Tangan', datafield: 'spenandatangan', width: '10%', cellsalign: 'left', align: 'center'  },
					{ text: 'Nomor', datafield: 'nomor', width: '10%', cellsalign: 'left', align: 'center'  },
					{ text: 'Tanggal', datafield: 'tanggal', width: '10%', cellsalign: 'left', align: 'center'  },
					{ text: 'Paraf1', datafield: 'sparaf1', width: '10%', cellsalign: 'left', align: 'center'  },
					{ text: 'Paraf2', datafield: 'sparaf2', width: '10%', cellsalign: 'left', align: 'center'  },
					{ text: 'Paraf3', datafield: 'sparaf3', width: '10%', cellsalign: 'left', align: 'center'  },
					{ text: 'Paraf4', datafield: 'sparaf4', width: '10%', cellsalign: 'left', align: 'center'  },
				]
			});
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
				url: "../simba/jsondatapendidikan"
			};
			var dataAdapter = new $.jqx.dataAdapter(source);
			var editrow = -1;
			var filerenderer = function (row, column, value) {
				var filebukti = $('#gridpendidikan').jqxGrid('getrowdata', row).bukti;
				var masterno = $('#gridpendidikan').jqxGrid('getrowdata', row).no;
				if (filebukti != ''){
					var linkbukti = '<div style="background: white;"><a href="../images/'+masterno+'/'+filebukti+'" target="_blank"><span class="label label-success">DOWNLOAD</span></a></div>';
				}
				else {
					var linkbukti = '<div style="background: white;"></div>';
				}
				return linkbukti;
			}
			$("#gridpendidikan").jqxGrid({
				width: '100%',
				source: dataAdapter,
				columnsresize: true,
				theme: "energyblue",
				autoheight: true,
				selectionmode: 'multiplecellsextended',
				columns: [
					{ text: 'Nama', datafield: 'nama', width: 150, cellsalign: 'left', align: 'center'  },
					{ text: 'NIP', datafield: 'nip', width: 100, cellsalign: 'left', align: 'center'  },
					{ text: 'Jenjang', datafield: 'jenjang', width: 50, cellsalign: 'left', align: 'center'  },
					{ text: 'PT/Sekolah', datafield: 'sekolah', width: 100, align: 'center', cellsalign: 'left'},
					{ text: 'Tahun Masuk', datafield: 'tahunmsk', width: 50, cellsalign: 'center', align: 'center' },
					{ text: 'Negara', datafield: 'negara', width: 80, cellsalign: 'center', align: 'center' },
					{ text: 'Bidang Ilmu/Minat', datafield: 'minat', width: 150, cellsalign: 'center', align: 'center' },
					{ text: 'Status', datafield: 'status', width: 50, cellsalign: 'center', align: 'center' },
					{ text: 'TMT.Lulus', datafield: 'tmtlulus', width: 100, cellsalign: 'center', align: 'center' },
					{ text: 'No.Ijasah', datafield: 'noijasah', width: 100, cellsalign: 'center', align: 'center' },
					{ text: 'Tgl.Ijasah', datafield: 'tglijasah', width: 100, cellsalign: 'center', align: 'center' },
					{ text: 'Keterangan', datafield: 'keterangan', width: 150, cellsalign: 'center', align: 'center' },
					{ text: 'File Upload', align: 'center', cellsalign: 'center',  width: '10%', cellsrenderer: filerenderer },
					{ text: 'Bukti', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
						return "Upload";
						}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridpendidikan").offset();
						var dataRecord 	= $("#gridpendidikan").jqxGrid('getrowdata', editrow);
						$("#upload_id").val(dataRecord.id);
						$("#upload_tabel").val('Data Pendidikan');
						$("#upload_data").val(dataRecord.noijasah);
						$("#modaluploader").modal('show');
						}
					},
					{ text: 'Edit/Delete', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
						return "Edit";
						}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridpendidikan").offset();
						var dataRecord 	= $("#gridpendidikan").jqxGrid('getrowdata', editrow);
						$("#pendidikan_jenjang").val(dataRecord.jenjang);
						$("#pendidikan_keterangan").val(dataRecord.keterangan);
						$("#pendidikan_lulus").val(dataRecord.tmtlulus);
						$("#pendidikan_minat").val(dataRecord.minat);
						$("#pendidikan_negara").val(dataRecord.negara);
						$("#pendidikan_noijasah").val(dataRecord.noijasah);
						$("#pendidikan_sekolah").val(dataRecord.sekolah);
						$("#pendidikan_status").val(dataRecord.status);
						$("#pendidikan_tahun").val(dataRecord.tahunmsk);
						$("#pendidikan_tglijasah").val(dataRecord.tglijasah);
						$("#pendidikan_idne").val(dataRecord.id);			
						$("#modaladddatapendidikan").modal('show');
						$('#divupdatependidikan').show(); 
						$('#divtambahpendidikan').hide();
						}
					},			
				],
			});
		});
	//batas tombol di modal pendidikan
	//tombol-tombol di modal pangkat
		$("#btnnewpangkat").click(function(){ $("#modaladddatapangkat").modal('show'); $('#divupdatepangkat').hide(); $('#divtambahpangkat').show(); });
		$("#btnexportpangkat").click(function () {
			var gridContent = $("#gridpangkat").jqxGrid('exportdata', 'html');
			$('#tabel_cetak').html(gridContent);		
			$("#tabel_cetak").btechco_excelexport({
				containerid: "tabel_cetak"
				, datatype: $datatype.Table
			});
		});
		$('#btnsimpandatapangkat').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('pangkat_asalsk').value;
			var set03=document.getElementById('pangkat_bulankurang').value;
			var set04=document.getElementById('pangkat_bulantambah').value;
			var set05=document.getElementById('pangkat_gaji').value;
			var set06=document.getElementById('pangkat_golongan').value;
			var set07=document.getElementById('pangkat_keterangan').value;
			var set08=document.getElementById('pangkat_nosk').value;
			var set09=document.getElementById('pangkat_penandatangan').value;
			var set10=document.getElementById('pangkat_penjelasan').value;
			var set11=document.getElementById('pangkat_tahunkurang').value;
			var set12=document.getElementById('pangkat_tahuntambah').value;
			var set13=document.getElementById('pangkat_tmt').value;
			var set14=document.getElementById('pangkat_tglsk').value;	
			var set15='tambah';
			var set16='';
			$.post('../simba/exdatapangkat', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, val11: set11, val12: set12, val13: set13, val14: set14, val15: set15, val16: set16 },
			function(data){
				$("#modaladddatapangkat").modal('hide');
				$("#gridpangkat").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
				});
			});
		$('#btnupdatedatapangkat').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('pangkat_asalsk').value;
			var set03=document.getElementById('pangkat_bulankurang').value;
			var set04=document.getElementById('pangkat_bulantambah').value;
			var set05=document.getElementById('pangkat_gaji').value;
			var set06=document.getElementById('pangkat_golongan').value;
			var set07=document.getElementById('pangkat_keterangan').value;
			var set08=document.getElementById('pangkat_nosk').value;
			var set09=document.getElementById('pangkat_penandatangan').value;
			var set10=document.getElementById('pangkat_penjelasan').value;
			var set11=document.getElementById('pangkat_tahunkurang').value;
			var set12=document.getElementById('pangkat_tahuntambah').value;
			var set13=document.getElementById('pangkat_tmt').value;
			var set14=document.getElementById('pangkat_tglsk').value;
			var set15='ubah';
			var set16=document.getElementById('pangkat_idne').value;
			$.post('../simba/exdatapangkat', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, val11: set11, val12: set12, val13: set13, val14: set14, val15: set15, val16: set16 },
			function(data){
				$("#modaladddatapangkat").modal('hide');
				$("#gridpangkat").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
			});
		});
		$('#btnhapuspangkat').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('pangkat_asalsk').value;
			var set03=document.getElementById('pangkat_bulankurang').value;
			var set04=document.getElementById('pangkat_bulantambah').value;
			var set05=document.getElementById('pangkat_gaji').value;
			var set06=document.getElementById('pangkat_golongan').value;
			var set07=document.getElementById('pangkat_keterangan').value;
			var set08=document.getElementById('pangkat_nosk').value;
			var set09=document.getElementById('pangkat_penandatangan').value;
			var set10=document.getElementById('pangkat_penjelasan').value;
			var set11=document.getElementById('pangkat_tahunkurang').value;
			var set12=document.getElementById('pangkat_tahuntambah').value;
			var set13=document.getElementById('pangkat_tmt').value;
			var set14=document.getElementById('pangkat_tglsk').value;	
			var set15='hapus';
			var set16=document.getElementById('pangkat_idne').value;
			$.post('../simba/exdatapangkat', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, val11: set11, val12: set12, val13: set13, val14: set14, val15: set15, val16: set16 },
			function(data){
				$("#modaladddatapangkat").modal('hide');
				$("#gridpangkat").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
			});
		});
		$('#btnriwayatpangkat').click(function () {
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
			$('#halamanpangkat').show();
			$('#halamanpendidikan').hide();
			$('#halamanpenghargaan').hide();
			$('#halamanseminar').hide();
			$('#halamansertifikasi').hide();
			$('#halamanangkakredit').hide();
			$('#halamandatabkd').hide();
			$('#halamanremun').hide();
			$('#halamanskp').hide();
			var set01	= document.getElementById('id_masterno').value;
			var set02	= 'cariperid';
			var set03	= 'caripangkat';
			var token	= document.getElementById('token').value;
			var source 	= {
				datatype: "json",
				datafields: [
					{ name: 'id'},
					{ name: 'no'},
					{ name: 'nama',type: 'text'},
					{ name: 'nip',type: 'text'},
					{ name: 'nosk',type: 'text'},
					{ name: 'tglsk',type: 'text'},
					{ name: 'asalsk',type: 'text'},
					{ name: 'penjelasan',type: 'text'},
					{ name: 'golongan',type: 'text'},
					{ name: 'tmtpangkat',type: 'text'},
					{ name: 'gajipokok',type: 'text'},
					{ name: 'penandatangan',type: 'text'},
					{ name: 'tahuntambah',type: 'text'},
					{ name: 'bulantambah',type: 'text'},
					{ name: 'tahunkurang',type: 'text'},
					{ name: 'bulankurang',type: 'text'},
					{ name: 'keterangan',type: 'text'},
					{ name: 'bukti',type: 'text'},
				],
				type: 'POST',
				data: {_token: token, val01:set01},
				url: "../simba/jsondatapangkat"
			};
			var dataAdapter = new $.jqx.dataAdapter(source);
			var editrow = -1;
			var filerenderer = function (row, column, value) {
				var filebukti = $('#gridpangkat').jqxGrid('getrowdata', row).bukti;
				var masterno = $('#gridpangkat').jqxGrid('getrowdata', row).no;
				if (filebukti != ''){
					var linkbukti = '<div style="background: white;"><a href="../images/'+masterno+'/'+filebukti+'" target="_blank"><span class="label label-success">DOWNLOAD</span></a></div>';
				}
				else {
					var linkbukti = '<div style="background: white;"></div>';
				}
				return linkbukti;
			}
			$("#gridpangkat").jqxGrid({
				width: '100%',
				source: dataAdapter,
				columnsresize: true,
				theme: "energyblue",
				autoheight: true,
				selectionmode: 'multiplecellsextended',
				columns: [
					{ text: 'Nama', datafield: 'nama', width: 150, cellsalign: 'left', align: 'center'  },
					{ text: 'NIP', datafield: 'nip', width: 100, cellsalign: 'left', align: 'center'  },
					{ text: 'No.SK', datafield: 'nosk', width: 100, cellsalign: 'left', align: 'center'  },
					{ text: 'Tgl.SK', datafield: 'tglsk', width: 100, align: 'center', cellsalign: 'left'},
					{ text: 'Asal SK', datafield: 'asalsk', width: 80, cellsalign: 'left', align: 'center' },
					{ text: 'Penjelasan', datafield: 'penjelasan', width: 100, cellsalign: 'left', align: 'center' },
					{ text: 'Golongan', datafield: 'golongan', width: 50, cellsalign: 'left', align: 'center' },
					{ text: 'TMT', datafield: 'tmtpangkat', width: 100, cellsalign: 'left', align: 'center' },
					{ text: 'Gaji Pokok', datafield: 'gajipokok', width: 100, cellsalign: 'right', align: 'center' },
					{ text: 'Penanda Tangan', datafield: 'penandatangan', width: 100, cellsalign: 'left', align: 'center' },
					{ text: 'THN', datafield: 'tahuntambah', columngroup: 'tambahan', width: 50, cellsalign: 'center', align: 'center' },
					{ text: 'BLN', datafield: 'bulantambah', columngroup: 'tambahan', width: 50, cellsalign: 'center', align: 'center' },
					{ text: 'THN', datafield: 'tahunkurang', columngroup: 'pengurangan', width: 50, cellsalign: 'center', align: 'center' },
					{ text: 'BLN', datafield: 'bulankurang', columngroup: 'pengurangan', width: 50, cellsalign: 'center', align: 'center' },
					{ text: 'Keterangan', datafield: 'keterangan', width: 150, cellsalign: 'left', align: 'center' },
					{ text: 'File Upload', align: 'center', cellsalign: 'center',  width: 120, cellsrenderer: filerenderer },
					{ text: 'Bukti', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
						return "Upload";
						}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridpangkat").offset();
						var dataRecord 	= $("#gridpangkat").jqxGrid('getrowdata', editrow);
						$("#upload_id").val(dataRecord.id);
						$("#upload_tabel").val('Data Pangkat');
						$("#upload_data").val(dataRecord.nosk);
						$("#modaluploader").modal('show');
						}
					},
					{ text: 'Edit/Delete', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
						return "Edit";
						}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridpangkat").offset();
						var dataRecord 	= $("#gridpangkat").jqxGrid('getrowdata', editrow);
						$("#pangkat_asalsk").val(dataRecord.asalsk);
						$("#pangkat_bulankurang").val(dataRecord.bulankurang);
						$("#pangkat_bulantambah").val(dataRecord.bulantambah);
						$("#pangkat_gaji").val(dataRecord.gajipokok);
						$("#pangkat_golongan").val(dataRecord.golongan);
						$("#pangkat_idne").val(dataRecord.id);
						$("#pangkat_keterangan").val(dataRecord.keterangan);
						$("#pangkat_nosk").val(dataRecord.nosk);
						$("#pangkat_penandatangan").val(dataRecord.penandatangan);
						$("#pangkat_penjelasan").val(dataRecord.penjelasan);
						$("#pangkat_tahunkurang").val(dataRecord.tahunkurang);
						$("#pangkat_tahuntambah").val(dataRecord.tahuntambah);
						$("#pangkat_tglsk").val(dataRecord.tglsk);
						$("#pangkat_tmt").val(dataRecord.tmtpangkat);
						$("#modaladddatapangkat").modal('show');
						$('#divupdatepangkat').show(); 
						$('#divtambahpangkat').hide();
						}
					},			
				],
				columngroups: 
				[
				{ text: 'Tambahan', align: 'center', name: 'tambahan' },
				{ text: 'Pengurangan', align: 'center', name: 'pengurangan' }
				]
			});
		});
	//batas tombol di modal pangkat
	//tombol-tombol di modal fungsional
		$("#btnnewfungsional").click(function(){ $("#modaladddatafungsional").modal('show'); $('#divupdatefungsional').hide(); $('#divtambahfungsional').show(); });
		$("#btnexportfungsional").click(function () {
			var gridContent = $("#gridfungsional").jqxGrid('exportdata', 'html');
			$('#tabel_cetak').html(gridContent);		
			$("#tabel_cetak").btechco_excelexport({
				containerid: "tabel_cetak"
				, datatype: $datatype.Table
			});
		});
		$('#btnsimpandatafungsional').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('fungsional_angkakredit').value;
			var set03=document.getElementById('fungsional_asalsk').value;
			var set04=document.getElementById('fungsional_fungsional').value;
			var set05=document.getElementById('fungsional_keterangan').value;
			var set06=document.getElementById('fungsional_namaunitkerja').value;
			var set07=document.getElementById('fungsional_nosk').value;
			var set08=document.getElementById('fungsional_penandatangan').value;
			var set09=document.getElementById('fungsional_tglsk').value;
			var set10=document.getElementById('fungsional_tmt').value;
			var set11=document.getElementById('fungsional_tunjangan').value;
			var set12=document.getElementById('fungsional_unitkerja').value;
			var set13='tambah';
			var set14='';
			$.post('../simba/exdatafungsional', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, val11: set11, val12: set12, val13: set13, val14: set14 },
			function(data){
				$("#modaladddatafungsional").modal('hide');
				$("#gridfungsional").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
				});		
			});
		$('#btnupdatedatafungsional').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('fungsional_angkakredit').value;
			var set03=document.getElementById('fungsional_asalsk').value;
			var set04=document.getElementById('fungsional_fungsional').value;
			var set05=document.getElementById('fungsional_keterangan').value;
			var set06=document.getElementById('fungsional_namaunitkerja').value;
			var set07=document.getElementById('fungsional_nosk').value;
			var set08=document.getElementById('fungsional_penandatangan').value;
			var set09=document.getElementById('fungsional_tglsk').value;
			var set10=document.getElementById('fungsional_tmt').value;
			var set11=document.getElementById('fungsional_tunjangan').value;
			var set12=document.getElementById('fungsional_unitkerja').value;
			var set13='ubah';
			var set14=document.getElementById('fungsional_idne').value;
			$.post('../simba/exdatafungsional', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, val11: set11, val12: set12, val13: set13, val14: set14 },
			function(data){
				$("#modaladddatafungsional").modal('hide');
				$("#gridfungsional").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
				});		
			});
		$('#btnhapusfungsional').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('fungsional_angkakredit').value;
			var set03=document.getElementById('fungsional_asalsk').value;
			var set04=document.getElementById('fungsional_fungsional').value;
			var set05=document.getElementById('fungsional_keterangan').value;
			var set06=document.getElementById('fungsional_namaunitkerja').value;
			var set07=document.getElementById('fungsional_nosk').value;
			var set08=document.getElementById('fungsional_penandatangan').value;
			var set09=document.getElementById('fungsional_tglsk').value;
			var set10=document.getElementById('fungsional_tmt').value;
			var set11=document.getElementById('fungsional_tunjangan').value;
			var set12=document.getElementById('fungsional_unitkerja').value;
			var set13='hapus';
			var set14=document.getElementById('fungsional_idne').value;
			$.post('../simba/exdatafungsional', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, val11: set11, val12: set12, val13: set13, val14: set14 },
			function(data){
				$("#modaladddatafungsional").modal('hide');
				$("#gridfungsional").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
				});		
			});
		$('#btnriwayatfungsional').click(function () {
			$('#halamandataajar').hide();
			$('#halamandataasesor').hide();
			$('#halamandatabkd').hide();
			$('#halamandiklat').hide();
			$('#halamanfungsional').show();
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
			var set01=document.getElementById('id_masterno').value;
			var source 	= {
				datatype: "json",
				datafields: [
					{ name: 'id'},
					{ name: 'no'},
					{ name: 'nama',type: 'text'},
					{ name: 'nip',type: 'text'},
					{ name: 'nosk',type: 'text'},
					{ name: 'tglsk',type: 'text'},
					{ name: 'asalsk',type: 'text'},
					{ name: 'tmt',type: 'text'},
					{ name: 'unit',type: 'text'},
					{ name: 'namaunit',type: 'text'},
					{ name: 'jabatan',type: 'text'},
					{ name: 'penandatangan',type: 'text'},
					{ name: 'tunjangan',type: 'text'},
					{ name: 'angkakredit',type: 'text'},
					{ name: 'keterangan',type: 'text'},
					{ name: 'bukti',type: 'text'},
				],
				type: 'POST',
				data: {_token: token, val01:set01},
				url: "../simba/jsondatafungsional"
			};		
			var dataAdapter = new $.jqx.dataAdapter(source);
			var editrow = -1;
			var filerenderer = function (row, column, value) {
				var filebukti = $('#gridfungsional').jqxGrid('getrowdata', row).bukti;
				var masterno = $('#gridfungsional').jqxGrid('getrowdata', row).no;
				if (filebukti != ''){
					var linkbukti = '<div style="background: white;"><a href="../images/'+masterno+'/'+filebukti+'" target="_blank"><span class="label label-success">DOWNLOAD</span></a></div>';
				}
				else {
					var linkbukti = '<div style="background: white;"></div>';
				}
				return linkbukti;
			}
			$("#gridfungsional").jqxGrid({
				width: '100%',
				source: dataAdapter,
				columnsresize: true,
				theme: "energyblue",
				autoheight: true,
				selectionmode: 'multiplecellsextended',
				columns: [
					{ text: 'Nama', datafield: 'nama', width: 150, cellsalign: 'left', align: 'center'  },
					{ text: 'NIP', datafield: 'nip', width: 100, cellsalign: 'left', align: 'center'  },
					{ text: 'No.SK', datafield: 'nosk', width: 100, cellsalign: 'left', align: 'center'  },
					{ text: 'Tgl.SK', datafield: 'tglsk', width: 100, align: 'center', cellsalign: 'left'},
					{ text: 'Asal SK', datafield: 'asalsk', width: 80, cellsalign: 'left', align: 'center' },
					{ text: 'Unit', datafield: 'unit', width: 100, cellsalign: 'left', align: 'center' },
					{ text: 'Nama Unit', datafield: 'namaunit', width: 50, cellsalign: 'left', align: 'center' },
					{ text: 'TMT', datafield: 'tmt', width: 100, cellsalign: 'left', align: 'center' },
					{ text: 'Jabatan Fungsional', datafield: 'jabatan', width: 100, cellsalign: 'right', align: 'center' },
					{ text: 'Penanda Tangan', datafield: 'penandatangan', width: 100, cellsalign: 'left', align: 'center' },
					{ text: 'Tunjangan', datafield: 'tunjangan', width: 150, cellsalign: 'left', align: 'center' },
					{ text: 'Angka Kredit', datafield: 'angkakredit', width: 150, cellsalign: 'left', align: 'center' },
					{ text: 'Keterangan', datafield: 'keterangan', width: 150, cellsalign: 'left', align: 'center' },
					{ text: 'File Upload', align: 'center', cellsalign: 'center',  width: '10%', cellsrenderer: filerenderer },
					{ text: 'Bukti', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
						return "Upload";
						}, buttonclick: function (row) {
							editrow = row;	
							var offset 		= $("#gridfungsional").offset();
							var dataRecord 	= $("#gridfungsional").jqxGrid('getrowdata', editrow);
							$("#upload_id").val(dataRecord.id);
							$("#upload_tabel").val('Data Fungsional');
							$("#upload_data").val(dataRecord.nosk);
							$("#modaluploader").modal('show');
						}
					},
					{ text: 'Edit/Delete', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
						return "Edit";
						}, buttonclick: function (row) {
							editrow = row;	
							var offset 		= $("#gridfungsional").offset();
							var dataRecord 	= $("#gridfungsional").jqxGrid('getrowdata', editrow);
							$("#fungsional_angkakredit").val(dataRecord.angkakredit);
							$("#fungsional_asalsk").val(dataRecord.asalsk);
							$("#fungsional_fungsional").val(dataRecord.jabatan);
							$("#fungsional_keterangan").val(dataRecord.keterangan);
							$("#fungsional_namaunitkerja").val(dataRecord.namaunit);
							$("#fungsional_nosk").val(dataRecord.nosk);
							$("#fungsional_penandatangan").val(dataRecord.penandatangan);
							$("#fungsional_tglsk").val(dataRecord.tglsk);
							$("#fungsional_tmt").val(dataRecord.tmt);
							$("#fungsional_tunjangan").val(dataRecord.tunjangan);
							$("#fungsional_unitkerja").val(dataRecord.unit);
							$("#fungsional_idne").val(dataRecord.id);				
							$("#modaladddatafungsional").modal('show');
							$('#divupdatefungsional').show(); 
							$('#divtambahfungsional').hide();
						}
					},			
				],		
			});
		});
	//batas tombol di modal fungsional
	//tombol-tombol di modal sertifikasi
		$("#btnnewsertifikasi").click(function(){ $("#modaladddatasertifikasi").modal('show'); $('#divupdatesertifikasi').hide(); $('#divtambahsertifikasi').show(); });
		$("#btnexportsertifikasi").click(function () {
			var gridContent = $("#gridsertifikasi").jqxGrid('exportdata', 'html');
			$('#tabel_cetak').html(gridContent);		
			$("#tabel_cetak").btechco_excelexport({
				containerid: "tabel_cetak"
				, datatype: $datatype.Table
			});
		});
		$('#btnsimpandatasertifikasi').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('sertifikasi_bidang').value;
			var set03=document.getElementById('sertifikasi_keterangan').value;
			var set04=document.getElementById('sertifikasi_nopes').value;
			var set05=document.getElementById('sertifikasi_noreg').value;
			var set06=document.getElementById('sertifikasi_penandatangan').value;
			var set07=document.getElementById('sertifikasi_ptp').value;
			var set08=document.getElementById('sertifikasi_tgl').value;	
			var set09='tambah';
			var set10='';
			$.post('../simba/exdatasertifikasi', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10 },
			function(data){
				$("#modaladddatasertifikasi").modal('hide');
				$("#gridsertifikasi").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
				});		
			});
		$('#btnupdatedatasertifikasi').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('sertifikasi_bidang').value;
			var set03=document.getElementById('sertifikasi_keterangan').value;
			var set04=document.getElementById('sertifikasi_nopes').value;
			var set05=document.getElementById('sertifikasi_noreg').value;
			var set06=document.getElementById('sertifikasi_penandatangan').value;
			var set07=document.getElementById('sertifikasi_ptp').value;
			var set08=document.getElementById('sertifikasi_tgl').value;	
			var set09='ubah';
			var set10=document.getElementById('sertifikasi_idne').value;
			$.post('../simba/exdatasertifikasi', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10 },
			function(data){
				$("#modaladddatasertifikasi").modal('hide');
				$("#gridsertifikasi").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
				});		
			});
		$('#btnhapussertifikasi').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('sertifikasi_bidang').value;
			var set03=document.getElementById('sertifikasi_keterangan').value;
			var set04=document.getElementById('sertifikasi_nopes').value;
			var set05=document.getElementById('sertifikasi_noreg').value;
			var set06=document.getElementById('sertifikasi_penandatangan').value;
			var set07=document.getElementById('sertifikasi_ptp').value;
			var set08=document.getElementById('sertifikasi_tgl').value;	
			var set09='hapus';
			var set10=document.getElementById('sertifikasi_idne').value;
			$.post('../simba/exdatasertifikasi', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10 },
			function(data){
				$("#modaladddatasertifikasi").modal('hide');
				$("#gridsertifikasi").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
				});		
			});
		$('#btnriwayatsertifikasi').click(function () {
			$('#halamandataasesor').hide();
			$('#halamandataajar').hide();
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
			$('#halamansertifikasi').show();
			$('#halamanangkakredit').hide();
			$('#halamandatabkd').hide();
			$('#halamanremun').hide();
			$('#halamanskp').hide();
			var set01 	= document.getElementById('id_masterno').value;	
			var source 	= {
					datatype: "json",
					datafields: [
						{ name: 'id'},
						{ name: 'no'},
						{ name: 'nama',type: 'text'},
						{ name: 'nip',type: 'text'},
						{ name: 'bidang',type: 'text'},
						{ name: 'keterangan',type: 'text'},
						{ name: 'nopes',type: 'text'},
						{ name: 'noreg',type: 'text'},
						{ name: 'penandatangan',type: 'text'},
						{ name: 'ptp',type: 'text'},
						{ name: 'tgl',type: 'text'},
						{ name: 'bukti',type: 'text'},
					],
					type: 'POST',
					data: {_token: token, val01:set01},
					url: "../simba/jsondatasertifikasi"
				};		
				var dataAdapter = new $.jqx.dataAdapter(source);
				var editrow = -1;
				var filerenderer = function (row, column, value) {
					var filebukti = $('#gridsertifikasi').jqxGrid('getrowdata', row).bukti;
					var masterno = $('#gridsertifikasi').jqxGrid('getrowdata', row).no;
					if (filebukti != ''){
						var linkbukti = '<div style="background: white;"><a href="../images/'+masterno+'/'+filebukti+'" target="_blank"><span class="label label-success">DOWNLOAD</span></a></div>';
					}
					else {
						var linkbukti = '<div style="background: white;"></div>';
					}
					return linkbukti;
				}
				$("#gridsertifikasi").jqxGrid(
				{
				width: '100%',
				source: dataAdapter,
				columnsresize: true,
				theme: "energyblue",
				autoheight: true,
				selectionmode: 'multiplecellsextended',
				columns: [
					{ text: 'Nama', datafield: 'nama', width: 150, cellsalign: 'left', align: 'center'  },
					{ text: 'NIP', datafield: 'nip', width: 100, cellsalign: 'left', align: 'center'  },
					{ text: 'No.Registrasi', datafield: 'noreg', width: 100, cellsalign: 'left', align: 'center'  },
					{ text: 'Tgl.Sertifikasi', datafield: 'tgl', width: 100, align: 'center', cellsalign: 'left'},
					{ text: 'No.Peserta', datafield: 'nopes', width: 80, cellsalign: 'left', align: 'center' },
					{ text: 'PTP SERDOS', datafield: 'ptp', width: 100, cellsalign: 'left', align: 'center' },
					{ text: 'Penanda Tangan', datafield: 'penandatangan', width: 100, cellsalign: 'left', align: 'center' },
					{ text: 'Rumpun/Bidang Ilmu', datafield: 'bidang', width: 150, cellsalign: 'left', align: 'center' },			
					{ text: 'Keterangan', datafield: 'keterangan', width: 150, cellsalign: 'left', align: 'center' },
					{ text: 'File Upload', align: 'center', cellsalign: 'center',  width: '10%', cellsrenderer: filerenderer },
					{ text: 'Bukti', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
						return "Upload";
						}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridsertifikasi").offset();
						var dataRecord 	= $("#gridsertifikasi").jqxGrid('getrowdata', editrow);
						$("#upload_id").val(dataRecord.id);
						$("#upload_tabel").val('Data Sertifikasi');
						$("#upload_data").val(dataRecord.noreg);
						$("#modaluploader").modal('show');
						}
					},
					{ text: 'Edit/Delete', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
						return "Edit";
						}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridsertifikasi").offset();
						var dataRecord 	= $("#gridsertifikasi").jqxGrid('getrowdata', editrow);
						$("#sertifikasi_bidang").val(dataRecord.bidang);
						$("#sertifikasi_idne").val(dataRecord.id);
						$("#sertifikasi_keterangan").val(dataRecord.keterangan);
						$("#sertifikasi_nopes").val(dataRecord.nopes);
						$("#sertifikasi_noreg").val(dataRecord.noreg);
						$("#sertifikasi_penandatangan").val(dataRecord.penandatangan);
						$("#sertifikasi_ptp").val(dataRecord.ptp);
						$("#sertifikasi_tgl").val(dataRecord.tgl);
						$("#modaladddatasertifikasi").modal('show');
						$('#divupdatesertifikasi').show(); 
						$('#divtambahsertifikasi').hide();
						}
					},			
				],		
				});
			});
		//batas tombol di modal sertifikasi
		//tombol-tombol di modal gaji
		$("#btnnewgaji").click(function(){ $("#modaladddatagaji").modal('show'); $('#divupdategaji').hide(); $('#divtambahgaji').show(); });
		$("#btnexportgaji").click(function () {
			var gridContent = $("#gridgaji").jqxGrid('exportdata', 'html');
			$('#tabel_cetak').html(gridContent);		
			$("#tabel_cetak").btechco_excelexport({
				containerid: "tabel_cetak"
				, datatype: $datatype.Table
			});
		});
		$('#btnsimpandatagaji').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('gaji_gaji').value;
			var set03=document.getElementById('gaji_perubahan').value;
			var set04=document.getElementById('gaji_sk').value;
			var set05=document.getElementById('gaji_tmt').value;		
			var set06='tambah';
			var set07='';
			$.post('../simba/exdatagaji', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07 },
			function(data){
				$("#modaladddatagaji").modal('hide');
				$("#gridgaji").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
				});		
			});
		$('#btnupdatedatagaji').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('gaji_gaji').value;
			var set03=document.getElementById('gaji_perubahan').value;
			var set04=document.getElementById('gaji_sk').value;
			var set05=document.getElementById('gaji_tmt').value;	
			var set06='ubah';
			var set07=document.getElementById('gaji_idne').value;
			$.post('../simba/exdatagaji', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07 },
			function(data){
				$("#modaladddatagaji").modal('hide');
				$("#gridgaji").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
				});		
			});
		$('#btnhapusgaji').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('gaji_gaji').value;
			var set03=document.getElementById('gaji_perubahan').value;
			var set04=document.getElementById('gaji_sk').value;
			var set05=document.getElementById('gaji_tmt').value;		
			var set06='hapus';
			var set07=document.getElementById('gaji_idne').value;
			$.post('../simba/exdatagaji', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07 },
			function(data){
				$("#modaladddatagaji").modal('hide');
				$("#gridgaji").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
				});		
			});
		$('#btnriwayatgaji').click(function () {
			$('#halamandataajar').hide();
			$('#halamandataasesor').hide();
			$('#halamandatabkd').hide();
			$('#halamandiklat').hide();
			$('#halamanfungsional').hide();
			$('#halamangaji').show();
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
			var set01	= document.getElementById('id_masterno').value;
			var set02	= 'cariperid';
			var set03	= 'cariperid';
			var token	= document.getElementById('token').value;
			var sourcedetail = {
				datatype: "json",
				datafields: [
					{ name: 'idne'},
					{ name: 'idpeg', type: 'text'},
					{ name: 'nomor', type: 'text'},
					{ name: 'kodesurat', type: 'text'},
					{ name: 'tahun', type: 'text'},
					{ name: 'tglsurat', type: 'text'},
					{ name: 'perihal', type: 'text'},
					{ name: 'nama', type: 'text'},
					{ name: 'nik', type: 'text'},
					{ name: 'golongan', type: 'text'}, 
					{ name: 'unitkerja', type: 'text'}, 
					{ name: 'gapoklama', type: 'text'}, 
					{ name: 'skppejabat', type: 'text'}, 
					{ name: 'skptanggal', type: 'text'}, 
					{ name: 'skpnomor', type: 'text'}, 
					{ name: 'idtblgajilm', type: 'text'},
					{ name: 'ketgajilm', type: 'text'},
					{ name: 'tmtgapoklama', type: 'text'},
					{ name: 'tmtgapoklm', type: 'text'}, 
					{ name: 'thnkerjalama', type: 'text'}, 
					{ name: 'blnkerjalama', type: 'text'}, 
					{ name: 'idtblgajibr', type: 'text'}, 
					{ name: 'ketgajibr', type: 'text'}, 
					{ name: 'gapokbaru', type: 'text'}, 
					{ name: 'tmtgapokbaru', type: 'text'}, 
					{ name: 'thnkerjabaru', type: 'text'}, 
					{ name: 'blnkerjabaru', type: 'text'}, 
					{ name: 'golgajibaru', type: 'text'}, 
					{ name: 'penutup', type: 'text'},
					{ name: 'tembusan1', type: 'text'}, 
					{ name: 'tembusan2', type: 'text'}, 
					{ name: 'tembusan3', type: 'text'}, 
					{ name: 'tembusan4', type: 'text'},
					{ name: 'tembusan5', type: 'text'}, 
					{ name: 'tembusan6', type: 'text'}, 
					{ name: 'paraf1', type: 'text'}, 
					{ name: 'paraf2', type: 'text'}, 
					{ name: 'paraf3', type: 'text'}, 
					{ name: 'paraf4', type: 'text'}, 
					{ name: 'atasnama', type: 'text'}, 
					{ name: 'pejabat', type: 'text'}, 
					{ name: 'namapejabat', type: 'text'}, 
					{ name: 'nippejabat', type: 'text'}, 
					{ name: 'tandatangan', type: 'text'},
					{ name: 'footnote', type: 'text'},
					{ name: 'konseptor', type: 'text'},
					{ name: 'fakultas', type: 'text'},
					{ name: 'status', type: 'text'},
					{ name: 'tlstglnomor', type: 'text'},
					{ name: 'ketpangkat', type: 'text'},
				],
				type: 'POST',
				data: {	val01:set01, val02:set02, val03:set03, _token: token },
				url: '../dokar/jgetdetailkgb',
			};
			var datadetail = new $.jqx.dataAdapter(sourcedetail);
			$("#gridriwayatgaji").jqxGrid({
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
					{ text: 'Cetak', editable: false, sortable: false, filterable: false,columntype: 'button', width: 50, align: 'center', cellsrenderer: function () {
						return "Print";
						}, buttonclick: function (row) {		
							editrow = row;	
							var offset 		= $("#gridriwayatgaji").offset();		
							var dataRecord 	= $("#gridriwayatgaji").jqxGrid('getrowdata', editrow);
							var url 		= "{{URL::to("/")}}/viewkgb/"+dataRecord.idne;
							var windowName 	= dataRecord.marking;
							var windowSize 	= "width=800,height=800";
							window.open(url, windowName, windowSize);
							event.preventDefault();
							return false;
						}
					},
					{ text: 'No.Surat', datafield: 'nomor', width: 70, cellsalign: 'left', align: 'center' },
					{ text: 'Tgl.Surat', datafield: 'tglsurat', width: 100, cellsalign: 'left', align: 'center' },
					{ text: 'Nama', columngroup: 'pegawai', datafield: 'nama', width: 200, cellsalign: 'left', align: 'center' },
					{ text: 'NIK', columngroup: 'pegawai', datafield: 'nik', width: 150, cellsalign: 'left', align: 'center' },
					{ text: 'Pangkat/Gol', columngroup: 'pegawai', datafield: 'golongan', width: 60, cellsalign: 'left', align: 'center' },
					{ text: 'Unit Kerja', columngroup: 'pegawai', datafield: 'unitkerja', width: 150, cellsalign: 'left', align: 'center' },
					{ text: 'Gapok Lama', columngroup: 'pegawai', datafield: 'gapoklama', width: 90, cellsalign: 'right', align: 'center' },
					{ text: 'Tabel Gaji', columngroup: 'pegawai', datafield: 'ketgajilm', width: 90, cellsalign: 'right', align: 'center' },
					{ text: 'Pejabat', columngroup: 'skp', datafield: 'skppejabat', width: 150, cellsalign: 'left', align: 'center' },
					{ text: 'Tanggal, Nomor', columngroup: 'skp', datafield: 'tlstglnomor', width: 150, cellsalign: 'left', align: 'center' },
					{ text: 'TMT Gapok Lama', columngroup: 'skp', datafield: 'tmtgapoklm', width: 150, cellsalign: 'left', align: 'center' },
					{ text: 'THN', columngroup: 'mkglama', datafield: 'thnkerjalama', width: 50, cellsalign: 'left', align: 'center' },
					{ text: 'BLN', columngroup: 'mkglama', datafield: 'blnkerjalama', width: 50, cellsalign: 'left', align: 'center' },
					{ text: 'Gapok Baru', columngroup: 'baru', datafield: 'gapokbaru', width: 150, cellsalign: 'left', align: 'center' },
					{ text: 'Tabel Gaji', columngroup: 'baru', datafield: 'ketgajibr', width: 90, cellsalign: 'right', align: 'center' },
					{ text: 'THN', columngroup: 'mkgbaru', datafield: 'thnkerjabaru', width: 50, cellsalign: 'left', align: 'center' },
					{ text: 'BLN', columngroup: 'mkgbaru', datafield: 'blnkerjabaru', width: 50, cellsalign: 'left', align: 'center' },
					{ text: 'Gol.Gaji', columngroup: 'baru', datafield: 'golgajibaru', width: 50, cellsalign: 'left', align: 'center' },
					{ text: 'TMT Gapok Baru', columngroup: 'baru', datafield: 'tmtgapokbaru', width: 150, cellsalign: 'left', align: 'center' },
					{ text: 'Tembusan 1', datafield: 'tembusan1', width: 150, cellsalign: 'left', align: 'center' },
				],
				columngroups: 
				[
				{ text: 'Data Pegawai', align: 'center', name: 'pegawai' },
				{ text: 'Atas dasar SKP terakhir tentang gaji/pangkat', align: 'center', name: 'skp' },
				{ text: 'Penetapan Gaji Baru', align: 'center', name: 'baru' },
				{ text: 'MKG', parentgroup: 'skp', align: 'center', name: 'mkglama' },
				{ text: 'MKG', parentgroup: 'baru', align: 'center', name: 'mkgbaru' },
				]
			});
			var source 	= {
				datatype: "json",
				datafields: [
					{ name: 'id'},
					{ name: 'no'},
					{ name: 'nama',type: 'text'},
					{ name: 'nip',type: 'text'},
					{ name: 'gaji',type: 'text'},
					{ name: 'perubahan',type: 'text'},
					{ name: 'nosk',type: 'text'},
					{ name: 'tmt',type: 'text'},
					{ name: 'bukti',type: 'text'},
				],
				type: 'POST',
				data: {_token: token, val01:set01},
				url: "../simba/jsondatagaji"
			};		
			var dataAdapter = new $.jqx.dataAdapter(source);
			var editrow = -1;
			var filerenderer = function (row, column, value) {
				var filebukti = $('#gridgaji').jqxGrid('getrowdata', row).bukti;
				var masterno = $('#gridgaji').jqxGrid('getrowdata', row).no;
				if (filebukti != ''){
					var linkbukti = '<div style="background: white;"><a href="../images/'+masterno+'/'+filebukti+'" target="_blank"><span class="label label-success">DOWNLOAD</span></a></div>';
				}
				else {
					var linkbukti = '<div style="background: white;"></div>';
				}
				return linkbukti;
			}
			$("#gridgaji").jqxGrid({
				width: '100%',
				source: dataAdapter,
				columnsresize: true,
				theme: "energyblue",
				autoheight: true,
				selectionmode: 'multiplecellsextended',
				columns: [
					{ text: 'Nama', datafield: 'nama', width: '30%', cellsalign: 'left', align: 'center'  },
					{ text: 'NIP', datafield: 'nip', width: '15%', cellsalign: 'left', align: 'center'  },
					{ text: 'Gaji', datafield: 'gaji', width: '10%', cellsalign: 'left', align: 'center'  },
					{ text: 'Perubahan', datafield: 'perubahan', width: '15%', align: 'center', cellsalign: 'left'},
					{ text: 'No.SK', datafield: 'nosk', width: '10%', cellsalign: 'left', align: 'center' },
					{ text: 'TMT', datafield: 'tmt', width: '10%', cellsalign: 'left', align: 'center' },
					{ text: 'File Upload', align: 'center', cellsalign: 'center',  width: '10%', cellsrenderer: filerenderer },
					{ text: 'Bukti', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
						return "Upload";
						}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridgaji").offset();
						var dataRecord 	= $("#gridgaji").jqxGrid('getrowdata', editrow);
						$("#upload_id").val(dataRecord.id);
						$("#upload_tabel").val('Data Gaji');
						$("#upload_data").val(dataRecord.nosk);
						$("#modaluploader").modal('show');
						}
					},
					{ text: 'Edit/Delete', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
						return "Edit";
						}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridgaji").offset();
						var dataRecord 	= $("#gridgaji").jqxGrid('getrowdata', editrow);
						$("#gaji_gaji").val(dataRecord.gaji);
						$("#gaji_idne").val(dataRecord.id);
						$("#gaji_perubahan").val(dataRecord.perubahan);
						$("#gaji_sk").val(dataRecord.nosk);
						$("#gaji_tmt").val(dataRecord.tmt);
						$("#modaladddatagaji").modal('show');
						$('#divupdategaji').show(); 
						$('#divtambahgaji').hide();
						}
					},			
				],		
			});
		});
		//batas tombol di modal gaji
		//tombol-tombol di modal diklat
		$("#btnnewdiklat").click(function(){ $("#modaladddatadiklat").modal('show'); $('#divupdatediklat').hide(); $('#divtambahdiklat').show(); });
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
			var set15='tambah';	
			var set16='';
			$.post('../simba/exdatadiklat', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, val11: set11, val12: set12, val13: set13, val14: set14, val15: set15, val16: set16 },
			function(data){
				$("#modaladddatadiklat").modal('hide');
				$("#griddiklat").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
				});		
			});
		$('#btnupdatedatadiklat').on('click', function (){	
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
			var set15='ubah';
			var set16=document.getElementById('diklat_idne').value;
			$.post('../simba/exdatadiklat', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, val11: set11, val12: set12, val13: set13, val14: set14, val15: set15, val16: set16 },
			function(data){
				$("#modaladddatadiklat").modal('hide');
				$("#griddiklat").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
				});		
			});
		$('#btnhapusdiklat').on('click', function (){	
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
			var set15='hapus';	
			var set16=document.getElementById('diklat_idne').value;
			$.post('../simba/exdatadiklat', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, val11: set11, val12: set12, val13: set13, val14: set14, val15: set15, val16: set16 },
			function(data){
				$("#modaladddatadiklat").modal('hide');
				$("#griddiklat").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
				});		
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
			var set01=document.getElementById('id_masterno').value;	
			var source =
				{
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
					url: "../simba/jsondatadiklat"
				};		
				var dataAdapter = new $.jqx.dataAdapter(source);
				var editrow = -1;
				var filerenderer = function (row, column, value) {
					var filebukti = $('#griddiklat').jqxGrid('getrowdata', row).bukti;
					var masterno = $('#griddiklat').jqxGrid('getrowdata', row).no;
					if (filebukti != ''){
						var linkbukti = '<div style="background: white;"><a href="../images/'+masterno+'/'+filebukti+'" target="_blank"><span class="label label-success">DOWNLOAD</span></a></div>';
					}
					else {
						var linkbukti = '<div style="background: white;"></div>';
					}
					return linkbukti;
				}
				$("#griddiklat").jqxGrid(
				{
				width: '100%',
				source: dataAdapter,
				columnsresize: true,
				theme: "energyblue",
				autoheight: true,
				selectionmode: 'multiplecellsextended',
				columns: [
					{ text: 'Nama', datafield: 'nama', width: 150, cellsalign: 'left', align: 'center'  },
					{ text: 'NIP', datafield: 'nip', width: 100, cellsalign: 'left', align: 'center'  },
					{ text: 'No.Dokumen', datafield: 'nodoc', width: 100, cellsalign: 'left', align: 'center'  },
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
					{ text: 'File Upload', align: 'center', cellsalign: 'center',  width: '10%', cellsrenderer: filerenderer },
					{ text: 'Bukti', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
						return "Upload";
						}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#griddiklat").offset();
						var dataRecord 	= $("#griddiklat").jqxGrid('getrowdata', editrow);
						$("#upload_id").val(dataRecord.id);
						$("#upload_tabel").val('Data Diklat');
						$("#upload_data").val(dataRecord.namadiklat);
						$("#modaluploader").modal('show');
						}
					},
					{ text: 'Edit/Delete', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
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
						$("#modaladddatadiklat").modal('show');
						$('#divupdatediklat').show(); 
						$('#divtambahdiklat').hide();
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
		$("#btnnewpenghargaan").click(function(){ $("#modaladddatapenghargaan").modal('show'); $('#divupdatepenghargaan').hide(); $('#divtambahpenghargaan').show(); });
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
			var set08='tambah';	
			var set09='';
			$.post('../simba/exdatapenghargaan', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09 },
			function(data){
				$("#modaladddatapenghargaan").modal('hide');
				$("#gridpenghargaan").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
				});		
			});
		$('#btnupdatedatapenghargaan').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('penghargaan_keterangan').value;
			var set03=document.getElementById('penghargaan_nama').value;
			var set04=document.getElementById('penghargaan_nodoc').value;
			var set05=document.getElementById('penghargaan_pejabat').value;
			var set06=document.getElementById('penghargaan_pemberi').value;
			var set07=document.getElementById('penghargaan_tgl').value;	
			var set08='ubah';
			var set09=document.getElementById('penghargaan_idne').value;
			$.post('../simba/exdatapenghargaan', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09 },
			function(data){
				$("#modaladddatapenghargaan").modal('hide');
				$("#gridpenghargaan").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
				});		
			});
		$('#btnhapuspenghargaan').on('click', function (){	
			var set01=document.getElementById('id_masterno').value;
			var set02=document.getElementById('penghargaan_keterangan').value;
			var set03=document.getElementById('penghargaan_nama').value;
			var set04=document.getElementById('penghargaan_nodoc').value;
			var set05=document.getElementById('penghargaan_pejabat').value;
			var set06=document.getElementById('penghargaan_pemberi').value;
			var set07=document.getElementById('penghargaan_tgl').value;	
			var set08='hapus';	
			var set09=document.getElementById('penghargaan_idne').value;
			$.post('../simba/exdatapenghargaan', { _token: token, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09 },
			function(data){
				$("#modaladddatapenghargaan").modal('hide');
				$("#gridpenghargaan").jqxGrid('updatebounddata');
				$('#logprogram').html(data);	
				return false;
				});		
			});
		$('#btnriwayatpenghargaan').click(function () {
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
			$('#halamanpenghargaan').show();
			$('#halamanseminar').hide();
			$('#halamansertifikasi').hide();
			$('#halamanangkakredit').hide();
			$('#halamandatabkd').hide();
			$('#halamanremun').hide();
			$('#halamanskp').hide();
			var set01=document.getElementById('id_masterno').value;	
			var source =
				{
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
					url: "../simba/jsondatapenghargaan"
				};		
				var dataAdapter = new $.jqx.dataAdapter(source);
				var editrow = -1;
				var filerenderer = function (row, column, value) {
					var filebukti = $('#gridpenghargaan').jqxGrid('getrowdata', row).bukti;
					var masterno = $('#gridpenghargaan').jqxGrid('getrowdata', row).no;
					if (filebukti != ''){
						var linkbukti = '<div style="background: white;"><a href="../images/'+masterno+'/'+filebukti+'" target="_blank"><span class="label label-success">DOWNLOAD</span></a></div>';
					}
					else {
						var linkbukti = '<div style="background: white;"></div>';
					}
					return linkbukti;
				}
				
				$("#gridpenghargaan").jqxGrid(
				{
				width: '100%',
				source: dataAdapter,
				columnsresize: true,
				theme: "energyblue",
				autoheight: true,
				selectionmode: 'multiplecellsextended',
				columns: [
					{ text: 'Nama', datafield: 'nama', width: 150, cellsalign: 'left', align: 'center'  },
					{ text: 'NIP', datafield: 'nip', width: 100, cellsalign: 'left', align: 'center'  },
					{ text: 'No.SK', datafield: 'nosk', width: 100, cellsalign: 'left', align: 'center'  },
					{ text: 'Tgl.SK', datafield: 'tanggal', width: 100, align: 'center', cellsalign: 'left'},
					{ text: 'Nama Penghargaan', datafield: 'penghargaan', width: 80, cellsalign: 'left', align: 'center' },
					{ text: 'Pemberi', datafield: 'pemberi', width: 100, cellsalign: 'left', align: 'center' },
					{ text: 'Pejabat', datafield: 'pejabat', width: 100, cellsalign: 'left', align: 'center' },			
					{ text: 'Keterangan', datafield: 'keterangan', width: 150, cellsalign: 'left', align: 'center' },
					{ text: 'File Upload', align: 'center', cellsalign: 'center',  width: '10%', cellsrenderer: filerenderer },
					{ text: 'Bukti', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
						return "Upload";
						}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridpenghargaan").offset();
						var dataRecord 	= $("#gridpenghargaan").jqxGrid('getrowdata', editrow);
						$("#upload_id").val(dataRecord.id);
						$("#upload_tabel").val('Data Penghargaan');
						$("#upload_data").val(dataRecord.penghargaan);
						$("#modaluploader").modal('show');
						}
					},
					{ text: 'Edit/Delete', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
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
						$("#modaladddatapenghargaan").modal('show');
						$('#divupdatepenghargaan').show(); 
						$('#divtambahpenghargaan').hide();
						}
					},			
				]		
			});
		});
		//batas tombol di modal penghargaan
		getnotifcount();
	});
</script>
@endpush