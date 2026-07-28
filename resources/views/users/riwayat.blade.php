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
                                <li class="nav-item"><a href="#" id="btnshowonline" class="nav-link"><i class="fa fa-newspaper-o"></i> Seleksi Administratif</a></li>
                                <li class="nav-item"><a href="#" id="btnopentespsikologi" class="nav-link"><i class="fa fa-book"></i> Seleksi Psikologi</a></li>
                                <li class="nav-item"><a href="#" class="btnriwayatdiklat nav-link"><i class="fa fa-trophy"></i> Seleksi Kompetensi</a></li>
                                <li class="nav-item"><a href="#" class="nav-link btnopenkesehatan"><i class="fa fa-pencil"></i> Seleksi Kesehatan</a></li>
                                <li class="nav-item"><a href="#" id="btnoepnskpenerimaanstaf" class="nav-link"><i class="fa fa-font"></i> Penerimaan Staf</a></li>
                                <li class="nav-item"><a href="#" id="btnoepnsuratorientasi" class="nav-link"><i class="fa fa-bookmark"></i> Orientasi</a></li>
                                <li class="nav-item"><a href="#" id="btnopenkredential" class="nav-link"><i class="fa fa-credit-card"></i> Kredensial</a></li>
                                <li class="nav-item"><a href="#" id="btnoepnskpenempatan" class="nav-link"><i class="fa fa-bank"></i> Penempatan</a></li>
                                <li class="nav-item"><a href="#" id="btnriwayatpenghargaan" class="nav-link"><i class="fa fa-pencil"></i> Penilaian Kinerja</a></li>
                                <li class="nav-item"><a href="#" class="nav-link btnopenkesehatan"><i class="fa fa-list"></i> Informasi Kesehatan Staf</a></li>
                                <li class="nav-item"><a href="#" class="btnriwayatdiklat nav-link"><i class="fa fa-list-alt"></i> Riwayat Diklat</a></li>
                                <li class="nav-item"><a href="#" id="btnoepnsuratperingatan" class="nav-link"><i class="fa fa-bullhorn"></i> Riwayat Surat Peringatan</a></li>
                                <li class="nav-item"><a href="#" id="btnoepnsuratpelanggaran" class="nav-link"><i class="fa fa-hand-stop-o"></i> Riwayat Surat Pelanggaran</a></li>
                                <li class="nav-item"><a href="#" id="btnoepnsuratkie" class="nav-link"><i class="fa fa-umbrella"></i> Riwayat KIE</a></li>
                                <li class="nav-item"><a href="#" id="btnshowdepan" class="nav-link"><i class="fa fa-user"></i> Perubahan Data Diri Staf</a></li>
                                <li class="nav-item"><a href="#" id="btnoepnsuratpengundurandiri" class="nav-link"><i class="fa fa-th-large"></i> Pengunduran Diri</a></li>
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
                                <h3 class="profile-username text-center">Berkas Seleksi Administratif {!! Session('fakpanjang') !!}</h3>
                                <p class="text-muted text-center">{!! $biodata->nama_lengkap !!}</p>
                            </div>
                            <div class="card-body">
								<div class="form-group">
									<div id="gridriwayatidentitas"></div>
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
                                            <div class="col-md-4 col-lg-4">
                                                <label for="id_nip">Nomor Kepegawaian</label>
                                                <input type="text" id="id_nip" class="form-control" value="{{$biodata->nip_baru}}">
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
                                                <label for="id_tmtgolongan">TMT Masuk</label>
                                                <div class="input-group date" data-target-input="nearest">
                                                    <input type="text" class="form-control"id="id_tmtgolongan" name="id_tmtgolongan" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{$biodata->tmt_golongan}}"/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                            <div class="col-md-4">
                                                <label for="id_kode">Finger ID</label>
                                                <input type="text" id="id_kode" class="form-control" value="{{$biodata->kode}}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="id_glrdepan">Gelar Depan</label>
                                                <input type="text" id="id_glrdepan" class="form-control" value="{{$biodata->depan}}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="id_glrblakang">Gelar Belakang</label>
                                                <input type="text" id="id_glrblakang" class="form-control" value="{{$biodata->belakang}}">
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6">
                                                <label for="id_bidangilmu">Kepakaran</label>
                                                <input type="text" id="id_bidangilmu" class="form-control" value="{{$biodata->bidang_ilmu}}">
                                                <input type="hidden" id="id_bidangilmu2" class="form-control" value="{{$biodata->bidang_ilmu2}}">
                                                <input type="hidden" id="id_kepakaran" class="form-control" value="{{$biodata->kepakaran}}">
									        </div>
                                            <div class="col-md-6 col-lg-6">
                                                <label for="id_bidangilmu3">Bidang Ilmu</label>
                                                <input type="text" class="form-control" id="id_bidangilmu3" value="{{$biodata->bidang_ilmu3}}">
                                            </div> 
                                        </div>
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
                                            <div class="col-md-4 col-lg-4">
                                                <label for="id_hape">No.HP</label>
                                                <input type="text" id="id_hape" class="form-control" value="{{$biodata->no_hp}}">
                                            </div> 
                                            <div class="col-md-4 col-lg-4">
                                                <label for="id_emailub">Email</label>
                                                <input type="text" id="id_emailub" class="form-control" value="{{$biodata->emailub}}">
                                            </div>
                                            <div class="col-md-4 col-lg-4">
                                                <label for="id_emaillain">Email Alternative</label>
                                                <input type="text" id="id_emaillain" class="form-control" value="{{$biodata->email}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6">
                                                <label for="id_unitkerja">Unit Kerja / Departement</label>
                                                <input type="text" id="id_unitkerja" class="form-control" value="{{$biodata->unit_kerja}}">
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <label for="id_ppabp">Penempatan</label>
                                                <select id="id_ppabp" class="form-control">
                                                    <option value=""></option>
                                                    @php
                                                        $listsppabp   =   ['PT Disa Prima Medika', 'RS Prima Husada Malang', 'RS Prima Husada Sukorejo', 'CV Putra Disa Prima', 'Rekrutmen PT DPM'];
                                                        foreach($listsppabp as $listppapb) {
                                                            if($listppapb == $biodata->ppabp) {
                                                                echo "<option value='$listppapb' selected>$listppapb</option>";
                                                            } else {
                                                                echo "<option value='$listppapb'>$listppapb</option>";
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
                                                <label for="id_status_jbtn">Status Pegawai</label>
                                                <select id="id_status_jbtn" size="1" class="form-control">
                                                    @php
                                                        $lists   =   ['Kontrak', 'Tetap'];
                                                        foreach($lists as $list) {
                                                            if($list == $biodata->status_jabatan) {
                                                                echo "<option value='$list' selected>$list</option>";
                                                            } else {
                                                                echo "<option value='$list'>$list</option>";
                                                            }
                                                        }
                                                    @endphp
                                                </select>
                                            </div>
                                            <div class="col-md-4 col-lg-4">
                                                <label for="id_jenispeg">Jenis Pegawai</label>
                                                <select id="id_jenispeg" size="1" class="form-control">
                                                    @php
                                                        $lists   =   ['Non Medis', 'Medis', 'Pejabat'];
                                                        foreach($lists as $list) {
                                                            if($list == $biodata->jenispeg) {
                                                                echo "<option value='$list' selected>$list</option>";
                                                            } else {
                                                                echo "<option value='$list'>$list</option>";
                                                            }
                                                        }
                                                    @endphp
                                                </select>
                                            </div>
                                            <div class="col-md-4 col-lg-4">
                                                <label for="id_status">Status Kerja</label>
                                                <select id="id_status" size="1" class="form-control">
                                                    @php
                                                        $lists   =   ['1', '0'];
                                                        foreach($lists as $list) {
                                                            if($list == $biodata->status_pegawai) {
                                                                $selectedval = 'selected';
                                                            } else {
                                                                $selectedval = '';
                                                            }
                                                            if ($list == '1'){
                                                                echo '<option value="1" '.$selectedval.'>Aktif</option>';
                                                            } else {
                                                                echo '<option value="0" '.$selectedval.'>Non Aktif (Mengundurkan Diri / Meninggal / Pensiun)</option>';
                                                            }
                                                        }
                                                    @endphp
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-7 col-lg-7">
                                                <label for="id_jabatan">Jabatan</label>
                                                <input type="text" id="id_jabatan" class="form-control" value="{{$biodata->jabatan}}">
                                            </div>
                                            <div class="col-md-5 col-lg-5">
                                                <label for="id_tmtjabatan">TMT. Awal Kontrak</label>
                                                <div class="input-group date" data-target-input="nearest">
                                                    <input type="text" class="form-control"id="id_tmtjabatan" name="id_tmtjabatan" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{$biodata->tmtpangkat}}"/>
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
                                                <input type="text" id="id_cpns" class="form-control" value="{{$biodata->cpns}}">
                                            </div>
                                            <div class="col-md-5 col-lg-5">
                                                <label for="id_tmtcpns">Expired</label>
                                                <div class="input-group date" data-target-input="nearest">
                                                    <input type="text" value="{{$biodata->tmt_cpns}}" class="form-control"id="id_tmtcpns" name="id_tmtcpns" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
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
                                                <input type="text" id="id_pns" class="form-control" value="{{$biodata->pns}}">
                                            </div>
                                            <div class="col-md-5 col-lg-5">
                                                <label for="id_tmtpns">Expired</label>
                                                <div class="input-group date" data-target-input="nearest">
                                                    <input type="text" value="{{$biodata->tmt_pns}}" class="form-control"id="id_tmtpns" name="id_tmtpns" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
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
                                                <input type="text" id="id_gaji" class="form-control" value="{{$biodata->gajisesuaisk}}">
                                            </div>
                                            <div class="col-md-5 col-lg-5">
                                                <label for="id_tmtgaji">TMT Gaji</label>
                                                <div class="input-group date" data-target-input="nearest">
                                                    <input type="text" value="{{$biodata->tmtgaji}}" class="form-control"id="id_tmtgaji" name="id_tmtgaji" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
								<div class="card-footer">
									<input type="hidden" id="id_glrdepan2" class="form-control" value="{{$biodata->gelardepan2}}">
                                    <input type="hidden" id="id_glrblakang2" class="form-control" value="{{$biodata->gelarblakang2}}">
                                    <input type="hidden" id="id_nidn" class="form-control" value="{{$biodata->nidn}}">
                                    <input type="hidden" id="id_tahunmsk" class="form-control" value="{{$biodata->thn_masuk}}">
                                    <input type="hidden" id="id_niplama" class="form-control" value="{{$biodata->nip_lama}}">
                                    <input type="hidden" id="id_karpeg" class="form-control" value="{{$biodata->karpeg}}">
                                    <input type="hidden" id="id_nira" class="form-control" value="{{$biodata->nira}}">
                                    <input type="hidden" id="id_pees" class="form-control" value="{{$biodata->program_studi}}">
                                    <input type="hidden" id="id_jabfungsional" class="form-control" value="{{$biodata->jab_fungsional}}">
                                    <input type="hidden" id="id_pangkat" class="form-control" value="{{$biodata->pangkat}}">
                                    <input type="hidden" id="id_fungsional" class="form-control" value="{{$biodata->fungsional}}">
                                    <input type="hidden" id="id_tmtfungsional" class="form-control" value="{{$biodata->tmt_fungsional}}">
                                    <input type="hidden" id="id_nokk" class="form-control" value="{{$biodata->nokk}}">
									<input type="hidden" id="id_telpon" class="form-control" value="{{$biodata->no_telp}}">
                                    <input type="hidden" id="id_kelas" value="{{$biodata->kelasjabatan}}">
									<input type="hidden" id="id_laborat" value="{{$biodata->lab}}">
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
                                        <div class="row">
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
									<div class="form-group">  
										<label for="id_nomoridi">Nomor IDI</label>
										<input type="text" class="form-control" id="id_nomoridi" value="{{$biodata->nomoridi}}">
									</div>
									<div class="form-group">  
										<label for="id_keanggotaanprofesi">Keanggotaan Profesi</label>
										<input type="text" class="form-control" id="id_keanggotaanprofesi" value="{{$biodata->keanggotaanprofesi}}">
									</div>
                                </div>
                            </div>
                        </div><!-- /kanan -->
                        <div class="col-md-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Data Keluarga</h3>
									<div class="card-tools">
										<button type="button" class="btn btn-tool" data-card-widget="collapse">
											<i class="fa fa-minus"></i>
										</button>
									</div>
                                </div>
                                <div class="card-body" id="modaladdkeluarga">
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
                                    <div class="form-group">
                                        <label>Link Berkas</label>
                                        <input type="text" class="form-control" id="keluarga_url">
                                        <p class="text-muted">Upload Berkas Bapak/Ibu Ke Google Drive Kemudian Share Link Berkas Tersebut menjadi Link Public, kemudian masukkan link tersebut ke input diatas.</p>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="keluarga_file">
                                            <label class="custom-file-label" for="keluarga_file">File KTP / KK / Akte</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="keluarga_idne">
                                        <button type="button" class="btn btn-danger pull-left" id="btnkembalidrtambahkeluarga">Cancel</button>
                                        <button type="button" class="btn btn-success pull-right" id="btnsimpandatakeluarga">Simpan</button>
                                    </div>
                                </div>
                                <div class="card-footer" id="modalkeluarga">
                                    <button class="btn btn-sm bg-maroon" id="btnnewkeluarga">Tambah Data Baru</button>
                                    <button class="btn btn-sm bg-purple" id="btnexportkeluarga">Export Tabel di Bawah</button>
                                    <div id="gridkeluarga"></div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /batas halaman muka -->
                    <div id="halamanidentitas">
                        <div class="card card-primary card-outline" >
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{!!$foto!!}" alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center" id="judulidentitas">Riwayat Tes Psikologi</h3>
                                <p class="text-muted text-center">{!! $biodata->nama_lengkap !!}</p>
                            </div>
                            <div class="card-body divupdateidentitas">
                                <button class="btn bg-maroon psikologi" id="btnnewidentitaspsikologi"> <i class="fa fa-plus"></i> Tambah Data Baru</button>
                                <button class="btn bg-maroon kesehatan" id="btnnewidentitaskesehatan"> <i class="fa fa-plus"></i> Tambah Data Baru</button>
                                <button class="btn bg-maroon kredential" id="btnnewidentitaskredential"> <i class="fa fa-plus"></i> Tambah Data Baru</button>
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
									<label>Nomor / Keterangan</label>
									<input type="text" class="form-control" id="identitas_nomer">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6 col-lg-6">
											<label>Jenis Identitas</label>
											<select id="identitas_jenis" size="1" class="form-control">
												<option value="">Pilih Salah Satu</option>
												<option class="psikologi" value="Psikologi">Psikologi</option>
												<option class="kesehatan" value="Covid 1">Covid 1</option>
												<option class="kesehatan" value="Covid 2">Covid 2</option>
												<option class="kesehatan" value="Covid 3">Covid 3</option>
												<option class="kesehatan" value="Mepthapetamine">Mepthapetamine</option>
												<option class="kesehatan" value="HbsAg Kualitatif">HbsAg Kualitatif</option>
												<option class="kesehatan" value="HIV-Aids">HIV-Aids</option>
												<option class="kesehatan" value="Thorax">Thorax</option>
												<option class="kesehatan" value="Tes Buta Warna dan Pemeriksaan Fisik">Tes Buta Warna dan Pemeriksaan Fisik</option>
												<option class="kesehatan" value="Kesehatan Lain">Tes Kesehatan Lainnya</option>
												<option class="kredential" value="STR">STR</option>
                                                <option class="kredential" value="Surat Ijin Praktek">Surat Ijin Praktek (SIPP/SIPB/SIK)</option>
                                                <option class="kredential" value="RKK">RKK</option>
                                                <option class="kredential" value="SPK">SPK</option>
											</select>
										</div>
										<div class="col-md-6 col-lg-6">
											<label>Berlaku Hingga (Apabila tidak ada Masa Berlaku, di isi tanggal input)</label>
											<input type="text" id="identitas_aktif" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
						                </div>
									</div>
								</div>
								<div class="form-group">
									<label>Link Berkas</label>
									<input type="text" class="form-control" id="identitas_url">
									<p class="text-muted">Upload Berkas Bapak/Ibu Ke Google Drive Kemudian Share Link Berkas Tersebut menjadi Link Public, kemudian masukkan link tersebut ke input diatas.</p>
								</div>
                                <div class="form-group">
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="identitas_file">
										<label class="custom-file-label" for="identitas_file">File Scan Dokumen</label>
									</div>
								</div>
								<div class="form-group">
									<input type="hidden" class="form-control" id="identitas_idne">
									<button type="button" class="btn btn-danger pull-left" id="btnkembalidrtambahidentitas">Cancel</button>
									<button type="button" class="btn btn-success pull-right" id="btnsimpandataidentitas">Simpan</button>
								</div>
							</div>
							<div class="card-footer divupdateidentitas">
                                <div id="grididentitas"></div>
                            </div>
                            <div class="card-body kredential">
                                <button class="btn bg-maroon kredential" id="btnnewpendidikan"> <i class="fa fa-plus"></i> Tambah Data Baru</button>
                                <button class="btn bg-purple" id="btnexportpendidikan"><i class="fa fa-file-excel-o"></i> Export Tabel di Bawah</button>
                            </div>
                            <div class="card-body" id="modaladddatapendidikan">
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
                                <div class="form-group">
									<label>Link Berkas</label>
									<input type="text" class="form-control" id="pendidikan_url">
									<p class="text-muted">Upload Berkas Bapak/Ibu Ke Google Drive Kemudian Share Link Berkas Tersebut menjadi Link Public, kemudian masukkan link tersebut ke input diatas.</p>
								</div>
                                <div class="form-group">
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="pendidikan_file">
										<label class="custom-file-label" for="pendidikan_file">File Scan Dokumen</label>
									</div>
								</div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" id="pendidikan_tahun" value="0000">
                                    <input type="hidden" class="form-control" id="pendidikan_keterangan" value="-">
                                    <input type="hidden" class="form-control" id="pendidikan_idne">
                                    <button type="button" class="btn btn-danger pull-left" id="btnkembalidrtambahpendidikan">Cancel</button>
									<button type="button" class="btn btn-success pull-right" id="btnupdatedatapendidikan">Simpan</button>
                                </div>
                            </div>
                            <div class="card-footer kredential">
                                <div id="gridpendidikan"></div>
                            </div>
                        </div>
                    </div><!-- /batas halaman Identitas -->
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
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="diklat_file">
										<label class="custom-file-label" for="diklat_file">File Scan Dokumen</label>
									</div>
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
                    </div>
                    <div id="halamandatask">
                        <div class="card card-primary card-outline" >
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{!!$foto!!}" alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">Riwayat SK</h3>
                                <p class="text-muted text-center">{!! $biodata->nama_lengkap !!}</p>
                            </div>
                            <div class="card-body divskawal">
								<div class="form-group">
									<div class="row">
										<div class="col-md-3">
											<a href="#" id="btntambahnomorsk" class="btn btn-block btn-primary">
												<i class="fa fa-paper-plane-o"></i> Tambah SK
											</a>
                                        </div>
                                        <div class="col-md-3">
										    <a href="#" id="btnexportsk" class="btn btn-block btn-danger">
												<i class="fa fa-print"></i> Export Tabel di Bawah
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
										<div class="col-lg-2">
                                            <label for="sk_nomor">No. SK (Angka Saja)</label>
                                            <input type="number" class="form-control" id="sk_nomor" name="sk_nomor" value="1">
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="sk_tanggal">Tgl. di Tetapkan</label>
											<div class="input-group date" data-target-input="nearest">
												<input value="{{date('Y-m-d')}}" type="text" class="form-control" id="sk_tanggal" name="sk_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
												<div class="input-group-append">
													<div class="input-group-text"><i class="fa fa-calendar"></i></div>
												</div>
											</div>
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
									<label for="sk_judul">SK/Peraturan Tentang</label>
                                    <input type="text" class="form-control" id="sk_judul" name="sk_judul">
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
                    <div id="halamandatassrtkeluar">
                        <div class="card card-primary card-outline" >
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{!!$foto!!}" alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">Riwayat Surat-Surat</h3>
                                <p class="text-muted text-center">{!! $biodata->nama_lengkap !!}</p>
                            </div>
                            <div class="card-body divsuratkeluar">
								<div class="form-group">
									<div class="row">
										<div class="col-md-3">
											<a href="#" id="btntambahnomormaju" class="btn btn-block btn-warning">
												<i class="fa fa-paper-plane-o"></i> Tambah Surat
											</a>
                                        </div>
                                        <div class="col-md-3">
										    <a href="#" id="btnexportsuratkeluar" class="btn btn-block btn-info">
												<i class="fa fa-print"></i> Export Tabel di Bawah
											</a>
										</div>
										<div class="col-md-4">
											<div id="messagesuratkeluar"></div>
										</div>
									</div>
								</div>
                            </div>
                            <div class="card-footer divsuratkeluar">
								<div id="gridsuratkeluar"></div>
                            </div>
							<div class="card-body divuploadersurat">
                                <div class="form-group"> 
									<div class="row">
										<div class="col-md-3">
											<label>Nomor</label>
											<input type="text" class="form-control" id="upload_nomor" name="upload_nomor">
										</div>
										<div class="col-md-3">
											<label>Tgl. Surat</label>
											<div class="input-group date" data-target-input="nearest">
												<input value="{{date('Y-m-d')}}" type="text" class="form-control" id="upload_tanggal" name="upload_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
												<div class="input-group-append">
													<div class="input-group-text"><i class="fa fa-calendar"></i></div>
												</div>
											</div>
										</div>
										<div class="col-md-6">
                                            <label for="upload_jenissrt">Jenis Surat</label>
                                            <select id="upload_jenissrt" name="upload_jenissrt" size="1" class="form-control" disabled="disable">
                                                <option value="Orientasi">Surat Orientasi</option>
                                                <option value="Peringatan">Surat Peringatan</option>
                                                <option value="Pengunduran Diri">Pengunduran Diri</option>
                                                <option value="Pelanggaran">Surat Pelanggaran</option>
                                            </select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="upload_perihal">Perihal</label>
									<input type="text" class="form-control" id="upload_perihal" name="upload_perihal">
								</div>
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
									<input type="file" id="upload_file" name="upload_file">
									<p class="help-block">File PDF Langsung dari Softfile (Print To PDF)</p>
								</div>
                            </div>
                            <div class="card-footer divuploadersurat">
                                <input type="hidden" id="upload_marking" name="upload_marking">
								<input type="hidden" id="upload_idne" name="upload_idne">
								<button type="button" class="btn btn-success pull-right" id="btnuploadfile">Upload</button>
								<button type="button" class="btn btn-danger pull-left btnkembali">Close</button>
							</div>
                        </div>
                    </div>
                    <div id="halamanpenghargaan">
                        <div class="card card-primary card-outline" >
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{!!$foto!!}" alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">Riwayat Penilaian Kinerja</h3>
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
                </div>
            </div>
		</div>
	</div>
</div>
<div class="modal modal-info fade" id="modaluploader"><!-- /.Modal Upload -->
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
                        <label>Link Berkas</label>
                        <input type="text" class="form-control" id="upload_url">
                        <p class="text-muted">Upload Berkas Bapak/Ibu Ke Google Drive Kemudian Share Link Berkas Tersebut menjadi Link Public, kemudian masukkan link tersebut ke input diatas.</p>
                    </div>
					<div class="form-group">
						<input type="file" id="upload_file" name="upload_file">
						<p class="help-block">File PDF / JPG / PNG (optional)</p>
					</div>
				</div>
			</div>
			<div class="modal-footer justify-content-between">
            	<input type="hidden" id="master">
				<input type="hidden" id="upload_namafile">
				<input type="hidden" class="form-control" id="upload_id">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
				<button type="button" class="btn btn-success" id="btnsimpandataupload">Simpan</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-body -->
</div><!-- /.modal-modal -->
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
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="valkesehatan" id="valkesehatan">
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
        $('#identitas_aktif').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#sk_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#upload_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        
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
    function openkeluarga( jQuery ){
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
				{ text: 'File Upload', align: 'center', cellsalign: 'center',  width: '10%', datafield: 'bukti' },
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
						$("#keluarga_file").val(''); 
						$('#keluarga_file').next('label').html('Select a file');
						$('#modalkeluarga').hide();
						$('#modaladdkeluarga').show();
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
    }
    function opendataidentitas( jQuery ){
        var set01	= document.getElementById('id_masterno').value;
        var set02	= document.getElementById('valkesehatan').value;
        var source  = {
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
            data: {_token: '{{csrf_token()}}', val01:set01, val02:set02},
            url: '{{ route("jsondataIdentitas") }}'
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#grididentitas").jqxGrid({
            width           : '100%',
            source          : dataAdapter,
            columnsresize   : true,
            theme           : "energyblue",
            autoheight      : true,
            selectionmode   : 'multiplecellsextended',
            columns         : [
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
                        $("#identitas_file").val('');
                        $('#identitas_file').next('label').html('Select a file');
                        $('.divupdateidentitas').hide(); 
                        $('#modaladddataidentitas').show();
                        if (set02 == 'Kredential'){
                            $('.psikologi').hide();
                            $('.kesehatan').hide();
                            $('.kredential').show();
                        } else if (set02 == 'Kesehatan'){
                            $('.psikologi').hide();
                            $('.kesehatan').show();
                            $('.kredential').hide();
                        } else {
                            $('.psikologi').show();
                            $('.kesehatan').hide();
                            $('.kredential').hide();
                        }
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
    }
    function opendatask( jQuery ){
        var set01	= document.getElementById('id_masterno').value;
        var set02	= document.getElementById('valkesehatan').value;
        var set03	= document.getElementById('id_emaillain').value;
        var tahun 	= 'peremail';
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
            data		: {	val01:set01, jenissurat:set02, petugas:set03, tahun:tahun, _token: '{{ csrf_token() }}' },
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
                { text: 'Edit', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', cellsrenderer: function () {
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
                { text: 'Kelompok', datafield: 'tlskelompok', width: '10%', cellsalign: 'center', align: 'center'},
                { text: 'Nomor', datafield: 'tlsnomor', width: '10%', cellsalign: 'center', align: 'center'},
                { text: 'Tanggal', datafield: 'tlstanggal', width: '13%', cellsalign: 'center', align: 'center'  },
                { text: 'SK Tentang', datafield: 'tlsjudul', width: '30%', cellsalign: 'left', align: 'center'  },
                { text: 'Keterangan', datafield: 'status', width: '30%', cellsalign: 'left', align: 'center'  },
            ],
        });
    }
    function opendatasuratkeluar( jQuery ){
        var set01	= document.getElementById('id_masterno').value;
        var set02	= document.getElementById('valkesehatan').value;
        var set03	= document.getElementById('id_emaillain').value;
        var tahun 	= 'peremail';
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
            data		: {	val01:set01, jenissurat:set02, petugas:set03, tahun:tahun, _token: '{{ csrf_token() }}' },
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
                { text: 'Edit', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', align: 'center', cellsrenderer: function () {
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
                { text: 'Nomor', datafield: 'tlsnomor', width: '7%', cellsalign: 'center', align: 'center'},
                { text: 'Tanggal', datafield: 'tglsurat', width: '13%', cellsalign: 'center', align: 'center'  },
                { text: 'Perihal', datafield: 'perihal', width: '50%', cellsalign: 'left', align: 'center'  },
                { text: 'Keterangan', datafield: 'status', width: '23%', cellsalign: 'left', align: 'center'  },
            ],
        });
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
		$('#halamandatask').hide();
		$('#halamandatassrtkeluar').hide();
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
        $('#modaladdkeluarga').hide();
        $('#modalkeluarga').show();
    //tombol-tombol di Perubahan Data Diri Staf
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
            var set07=document.getElementById('upload_url').value;	
			if ($('#upload_file').val() == '' && set07 == ''){
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
                form_data.append('val07', set07);
				form_data.append('_token', '{{csrf_token()}}');
				$.ajax({
					url: '{{ route("exUploader") }}',
					data: form_data,
					type: 'POST',
					contentType: false,
					processData: false,
					success: function (data) {
						if (set04 == 'Biodata'){
							var data = 'scan/files/'+set02;
							$("#preview").attr("src",data);
						}
						if (set04 == 'Filess'){
							$("#gridriwayatidentitas").jqxGrid('updatebounddata');
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
			$('#halamandatassrtkeluar').hide();
			$('#halamandatask').hide();
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
			$('#halamandatassrtkeluar').hide();
			$('#halamandatask').hide();
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
			$('#halamanmuka').hide();
			$('#halamanonline').show();
			var set01=document.getElementById('id_masterno').value;
			var set02='cariperid';
			var set03='cariall';
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
                data: {	val01:'Pegawai', val02:set01, _token: "{{ csrf_token() }}" },
                url:  '{{ route("jsonDataSyaratPelamar") }}',
            };
            var fileterupload = function (row, column, value) {
                var filebukti = $('#gridriwayatidentitas').jqxGrid('getrowdata', row).description;
                if (filebukti == ''){
                    var linkbukti = '<div style="background: white;"></div>';
                } else {
                    var linkbukti = '<div style="background: white;"><a class="btn btn-danger btn-sm" href="'+filebukti+'" target="_blank">OPEN FILE</a></div>';
                }
                return linkbukti;
            }
            var datadetail = new $.jqx.dataAdapter(sourcedetail);
            $("#gridriwayatidentitas").jqxGrid({
                width           : '100%',
                autoheight      : true,
                columnsresize   : true,
                theme           : "energyblue",
                source          : datadetail,
                selectionmode   : 'multiplecellsextended',
                columns         : [
                    { text: 'Nama Berkas Syarat', datafield: 'name', width: '50%', cellsalign: 'left', align: 'center'  },
                    { text: 'Kewajiban', datafield: 'type', width: '10%', align: 'center', cellsalign: 'center'},
                    { text: 'Status', cellsrenderer: fileterupload, width: '20%', align: 'center', cellsalign: 'center'},
                    { text: 'Upload', columntype: 'button', width: '10%', cellsalign: 'center', align: 'center', cellsrenderer: function () {
                        return "Upload";
                        }, buttonclick: function (row) {
                            editrow = row;	
                            var offset 		= $("#gridriwayatidentitas").offset();
                            var dataRecord 	= $("#gridriwayatidentitas").jqxGrid('getrowdata', editrow);
                            $("#upload_id").val(dataRecord.id);
                            $("#upload_tabel").val('Filess');
                            $("#upload_data").val(dataRecord.name);
                            $("#upload_file").val('');
                            $('#upload_file').next('label').html('Select a file');
                            $("#modaluploader").modal('show');
                        }
                    },
                    { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', cellsalign: 'center', align: 'center', cellsrenderer: function () {
                        return "Del";
                        }, buttonclick: function (row) {
                            editrow = row;	
                            var offset 		= $("#gridriwayatidentitas").offset();
                            var dataRecord 	= $("#gridriwayatidentitas").jqxGrid('getrowdata', editrow);
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
                                $.post('{{ route("exInputBerkasPelamar") }}', { _token: '{{csrf_token()}}', set01: val01, set02: val02, set03: '', set04: '', set05: 'remove' },
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
                                    $("#gridriwayatidentitas").jqxGrid('updatebounddata');
                                    return false;
                                });
                            });
                        }
                    },
                ]
            });
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
        openkeluarga();
        $("#btnexportkeluarga").click(function () {
			var gridContent = $("#gridkeluarga").jqxGrid('exportdata', 'html');
			$('#tabel_cetak').html(gridContent);		
			$("#tabel_cetak").btechco_excelexport({
				containerid: "tabel_cetak"
				, datatype: $datatype.Table
			});
		});
        $("#btnnewkeluarga").click(function(){
            $("#keluarga_idne").val('tambah'); 
            $("#keluarga_file").val('');
            $('#keluarga_file').next('label').html('Select a file');
            $('#divupdateorganisasi').hide(); 
            $('#modaladdkeluarga').show();
            $('#modalkeluarga').hide();
        });
        $("#btnkembalidrtambahkeluarga").click(function(){
            $('#modaladdkeluarga').hide(); 
            $('#modalkeluarga').show();
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
            var set15=document.getElementById('keluarga_nik').value;
            var set16=document.getElementById('keluarga_url').value;
            var set17=document.getElementById('keluarga_file');
            if (set02 == '' || set03 == '' || set04 == '' || set05 == '' || set05 == '' || set06 == '' || set08 == '' || set09 == '' || set10 == ''){ 
                swal({
                    title	: 'Stop',
                    text	: 'Semua Form Di Isi, Apabila tidak ada data diberi tanda strip (-) ',
                    type	: 'warning',
                })
            } else {
                var form_data = new FormData();
                    form_data.append('file', set17.files[0]);
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
	//tombol-tombol di modal Seleksi Psikologi, Kredential, Kesehatan
        $("#btnkembalidrtambahidentitas").click(function(){
            $('.divupdateidentitas').show(); 
            $('#modaladddataidentitas').hide();
        });
		$("#btnkembalidrtambahpendidikan").click(function(){
            $('.kredential').show(); 
            $('#modaladddatapendidikan').hide();
        });
		$("#btnnewidentitaspsikologi").click(function(){
            $('.psikologi').show();
            $('.kesehatan').hide();
            $('.kredential').hide();
            $('.divupdateidentitas').hide(); 
            $('#modaladddataidentitas').show();
            $("#identitas_idne").val('tambah');
            $("#identitas_file").val('');
            $('#identitas_file').next('label').html('Select a file');
        });
        $("#btnnewidentitaskesehatan").click(function(){
            $('.psikologi').hide();
            $('.kesehatan').show();
            $('.kredential').hide();
            $('.divupdateidentitas').hide(); 
            $('#modaladddataidentitas').show();
            $("#identitas_idne").val('tambah');
            $("#identitas_file").val('');
            $('#identitas_file').next('label').html('Select a file');
        });
        $("#btnnewidentitaskredential").click(function(){
            $('.psikologi').hide();
            $('.kesehatan').hide();
            $('.kredential').show();
            $('.divupdateidentitas').hide(); 
            $('#modaladddataidentitas').show();
            $("#identitas_idne").val('tambah');
            $("#identitas_file").val('');
            $('#identitas_file').next('label').html('Select a file');
        });
        $("#btnnewpendidikan").click(function(){
            $('.kredential').hide();
            $('#modaladddatapendidikan').show();
            $("#pendidikan_idne").val('tambah');
            $("#pendidikan_file").val('');
            $('#pendidikan_file').next('label').html('Select a file');
        });
		$("#btnexportidentitas").click(function () {
			var gridContent = $("#grididentitas").jqxGrid('exportdata', 'html');
			$('#tabel_cetak').html(gridContent);		
			$("#tabel_cetak").btechco_excelexport({
				containerid: "tabel_cetak"
				, datatype: $datatype.Table
			});
		});
        $("#btnexportpendidikan").click(function () {
			var gridContent = $("#gridpendidikan").jqxGrid('exportdata', 'html');
			$('#tabel_cetak').html(gridContent);		
			$("#tabel_cetak").btechco_excelexport({
				containerid: "tabel_cetak"
				, datatype: $datatype.Table
			});
		});
		$('#btnopentespsikologi').click(function () {
			$('#halamanidentitas').show();
			$('#halamandatassrtkeluar').hide();
			$('#halamandatabkd').hide();
			$('#halamandiklat').hide();
			$('#halamanfungsional').hide();
			$('#halamangaji').hide();
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
            $('#modaladddataidentitas').hide();
            $('#modaladddatapendidikan').hide();
            $('.divupdateidentitas').show();
            $('.psikologi').show();
            $('.kesehatan').hide();
            $('.kredential').hide();
		    $("#valkesehatan").val('Psikologi');
		    $("#judulidentitas").html('Riwayat Data Psikologi');
			opendataidentitas();
        });
        $('.btnopenkesehatan').click(function () {
			$('#halamanidentitas').show();
			$('#halamandatassrtkeluar').hide();
			$('#halamandatabkd').hide();
			$('#halamandiklat').hide();
			$('#halamanfungsional').hide();
			$('#halamangaji').hide();
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
            $('#modaladddataidentitas').hide();
            $('#modaladddatapendidikan').hide();
            $('.divupdateidentitas').show();
            $('.psikologi').hide();
            $('.kesehatan').show();
            $('.kredential').hide();
            $("#valkesehatan").val('Kesehatan');
            $("#judulidentitas").html('Riwayat Data Kesehatan');
			opendataidentitas();
		});
        $('#btnopenkredential').click(function () {
			$('#halamanidentitas').show();
			$('#halamandatassrtkeluar').hide();
			$('#halamandatabkd').hide();
			$('#halamandiklat').hide();
			$('#halamanfungsional').hide();
			$('#halamangaji').hide();
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
            $('#modaladddataidentitas').hide();
            $('#modaladddatapendidikan').hide();
            $('.divupdateidentitas').show();
            $('.psikologi').hide();
            $('.kesehatan').hide();
            $('.kredential').show();
            $("#valkesehatan").val('Kredential');
            $("#judulidentitas").html('Riwayat Data Kredential');
			opendataidentitas();
			var set01	= document.getElementById('id_masterno').value;
			
            var sourcependidikan  = {
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
                data: {_token: '{{csrf_token()}}', val01:set01},
                url: '{{ route("jsondatPpendidikan") }}'
            };
            var dataAdapterPendidikan = new $.jqx.dataAdapter(sourcependidikan);
            $("#gridpendidikan").jqxGrid({
                width           : '100%',
                source          : dataAdapterPendidikan,
                columnsresize   : true,
                theme           : "energyblue",
                autoheight      : true,
                selectionmode   : 'multiplecellsextended',
                columns         : [
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
                    { text: 'File Upload', datafield: 'bukti', align: 'center', cellsalign: 'center',  width: '10%' },
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
                            $("#pendidikan_file").val('');
                            $('#pendidikan_file').next('label').html('Select a file');
                            $('.kredential').hide(); 
                            $('#modaladddatapendidikan').show(); 
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
                                $.post('{{ route("exdataPendidikan") }}', { _token: '{{csrf_token()}}', val01: set01, val12: 'hapus', val13: set13 },
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
        $('#btnsimpandataidentitas').on('click', function (){
            var set01=document.getElementById('id_masterno').value;
            var set02=document.getElementById('identitas_jenis').value;
            var set03=document.getElementById('identitas_aktif').value;
            var set04=document.getElementById('identitas_nomer').value;
            var set05=document.getElementById('identitas_idne').value;
            var set06=document.getElementById('identitas_idne').value;
            var set07=document.getElementById('identitas_url').value;
            var set08=document.getElementById('pendidikan_file');
            if ($('#pendidikan_file').val() == '' && set07 == ''){
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
                    form_data.append('file', set08.files[0]);
                    form_data.append('val01', set01);
                    form_data.append('val02', set02);
                    form_data.append('val03', set03);
                    form_data.append('val04', set04);
                    form_data.append('val05', set05);
                    form_data.append('val06', set06);
                    form_data.append('val07', set07);
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
                        $('.kredential').show();
                        $('#modaladddatapendidikan').hide();
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
            var set12=document.getElementById('pendidikan_idne').value;
            var set13=document.getElementById('pendidikan_file');
            var set14=document.getElementById('pendidikan_url').value;
            if ($('#pendidikan_file').val() == '' && set14 == ''){
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
                    form_data.append('file', set13.files[0]);
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
                    url         : '{{ route("exdataPendidikan") }}',
                    data        : form_data,
                    type        : 'POST',
                    contentType : false,
                    processData : false,
                    success     : function (data) {
                        $.toast({
                            heading     : 'Info',
                            text        : data,
                            position    : 'top-right',
                            loaderBg    : '#bf441d',
                            icon        : 'success',
                            hideAfter   : 5000,
                            stack       : 1
                        });
                        $('.kredential').show();
                        $('#modaladddatapendidikan').hide();
                        $("#gridpendidikan").jqxGrid('updatebounddata');
                        return false;
                    },
                    error: function (xhr, status, error) {
                        swal({
                            title   : status,
                            text    : xhr.responseText,
                            type    : 'info',
                        });
                    }
                });
            }
        });
	//tombol-tombol di modal diklat
		$("#btnnewdiklat").click(function(){ 
            $("#divtambahdiklat").show();
            $('#divupdatediklat').hide();
            $("#diklat_idne").val('tambah');
            $("#diklat_file").val('');
            $('#diklat_file').next('label').html('Select a file');
        });
        $("#btnkembalidrtambahdiklat").click(function(){ 
            $("#divtambahdiklat").hide();
            $('#divupdatediklat').show();
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
            var set18=document.getElementById('diklat_file');
            if ($('#diklat_file').val() == '' && set17 == ''){
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
                    form_data.append('file', set18.files[0]);
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
		$('.btnriwayatdiklat').click(function () {
			$('#halamandatask').hide();
			$('#halamandatassrtkeluar').hide();
			$('#halamandatabkd').hide();
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
			$('#halamandiklat').show();
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
                    { text: 'File Upload',datafield: 'bukti',  align: 'center', cellsalign: 'center',  width: '10%' },
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
                            $('#diklat_file').val('');
                            $('#diklat_file').next('label').html('Select a file');
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
    //tombol-tombol di modul Surat Keputusan
        $('#btnoepnskpenerimaanstaf').click(function () {
            $('#halamandatask').show();
			$('#halamandatassrtkeluar').hide();
			$('#halamandatabkd').hide();
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
			$('#halamandiklat').hide();
			$('#divupdatediklat').hide();
			$('#divtambahdiklat').hide();
            $('.divskawal').show();
            $('.divinputsk').hide();
			$("#valkesehatan").val('Penerimaan Staf');
			opendatask();
		});
        $('#btnoepnskpenempatan').click(function () {
            $('#halamandatask').show();
			$('#halamandatassrtkeluar').hide();
			$('#halamandatabkd').hide();
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
			$('#halamandiklat').hide();
			$('#divupdatediklat').hide();
			$('#divtambahdiklat').hide();
            $('.divskawal').show();
            $('.divinputsk').hide();
			$("#valkesehatan").val('Penempatan');
			opendatask();
		});
        $('#btntambahnomorsk').click(function () {
			$("#sk_idne").val('new');
			$("#upload_filesk").val('');
			$('.divinputsk').show();
			$('.divskawal').hide();
		});
        $("#btnexportsk").click(function () {
			var gridContent = $("#gridskdaperaturan").jqxGrid('exportdata', 'html');
			$('#tabel_cetak').html(gridContent);		
			$("#tabel_cetak").btechco_excelexport({
				containerid: "tabel_cetak"
				, datatype: $datatype.Table
			});
		});
        $("#btnuploadfilesk").click(function(){
			var set01 	= document.getElementById('upload_filesk');
			var set02	= document.getElementById('valkesehatan').value;
			var set03	= document.getElementById('sk_tanggal').value;
			var set04	= 'RIWAYATSK';
			var set05	= document.getElementById('sk_kodepjbt').value;
			var set06	= 'SELF';
			var set07	= '';
			var set08	= '';
			var set09	= '';
			var set10	= '';
			var set11	= document.getElementById('sk_idne').value;
			var set12	= document.getElementById('sk_judul').value;
			var set13	= '';
			var set14	= '';
			var set15	= document.getElementById('sk_nomor').value;
			var set16	= document.getElementById('id_emaillain').value;
			if (set03 == '' || set05 == '' || set12 == '' || set15 == ''){
				swal({
					title	: 'Stop',
					text	: 'Nomor, Tanggal dan Judul SK Tidak Boleh Kosong',
					type	: 'warning',
				})
			} else {
				$('#loading').show();
				$('#halamandatask').hide();
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
					url	        : '{{ route("exUploadSuratTTE") }}',
					data        : form_data,
					type        : 'POST',
					contentType : false,
					processData : false,
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
							icon        : icon,
							hideAfter   : 5000,
							stack       : 1
						});
						$('#loading').hide();
						$('#halamandatask').show();
						$('.divinputsk').hide();
						$('.divskawal').show();
						$("#gridskdaperaturan").jqxGrid('updatebounddata', 'filter');
						return false;
					},
					error: function (xhr, status, error) {
						$('#loading').hide();
						$('#halamandatask').show();
						swal({
							title	: 'Stop',
							text	: xhr.responseText,
							type	: 'error',
						})
					}
				});
			}
		});
        $(".btnkembalikelamansk").click(function(){ 
            $('.divinputsk').hide(); 
            $('.divskawal').show();
        });
    //tombol-tombol di modul Surat Keluar
        $('#btnoepnsuratorientasi').click(function () {
            $('#halamandatask').hide();
			$('#halamandatassrtkeluar').show();
			$('#halamandatabkd').hide();
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
			$('#halamandiklat').hide();
			$('#divupdatediklat').hide();
			$('#divtambahdiklat').hide();
            $('.divsuratkeluar').show();
            $('.divuploadersurat').hide();
			$("#valkesehatan").val('Orientasi');
            $("#upload_jenissrt").val('Orientasi');
			opendatasuratkeluar();
		});
        $('#btnoepnsuratperingatan').click(function () {
            $('#halamandatask').hide();
			$('#halamandatassrtkeluar').show();
			$('#halamandatabkd').hide();
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
			$('#halamandiklat').hide();
			$('#divupdatediklat').hide();
			$('#divtambahdiklat').hide();
            $('.divsuratkeluar').show();
            $('.divuploadersurat').hide();
			$("#valkesehatan").val('Peringatan');
            $("#upload_jenissrt").val('Peringatan');
			opendatasuratkeluar();
		});
        $('#btnoepnsuratpengundurandiri').click(function () {
            $('#halamandatask').hide();
			$('#halamandatassrtkeluar').show();
			$('#halamandatabkd').hide();
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
			$('#halamandiklat').hide();
			$('#divupdatediklat').hide();
			$('#divtambahdiklat').hide();
            $('.divsuratkeluar').show();
            $('.divuploadersurat').hide();
			$("#valkesehatan").val('Pengunduran Diri');
            $("#upload_jenissrt").val('Pengunduran Diri');
			opendatasuratkeluar();
		});
        $('#btnoepnsuratpelanggaran').click(function () {
            $('#halamandatask').hide();
			$('#halamandatassrtkeluar').show();
			$('#halamandatabkd').hide();
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
			$('#halamandiklat').hide();
			$('#divupdatediklat').hide();
			$('#divtambahdiklat').hide();
            $('.divsuratkeluar').show();
            $('.divuploadersurat').hide();
			$("#valkesehatan").val('Pelanggaran');
            $("#upload_jenissrt").val('Pelanggaran');
			opendatasuratkeluar();
		});
		$('#btnoepnsuratkie').click(function () {
            $('#halamandatask').hide();
			$('#halamandatassrtkeluar').show();
			$('#halamandatabkd').hide();
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
			$('#halamandiklat').hide();
			$('#divupdatediklat').hide();
			$('#divtambahdiklat').hide();
            $('.divsuratkeluar').show();
            $('.divuploadersurat').hide();
			$("#valkesehatan").val('Pemanggilan KIE Staf');
            $("#upload_jenissrt").val('Pemanggilan KIE Staf');
			opendatasuratkeluar();
		});
        $("#btnexportsuratkeluar").click(function () {
			var gridContent = $("#gridsuratkeluar").jqxGrid('exportdata', 'html');
			$('#tabel_cetak').html(gridContent);		
			$("#tabel_cetak").btechco_excelexport({
				containerid: "tabel_cetak"
				, datatype: $datatype.Table
			});
		});
        $('#btntambahnomormaju').click(function () {
			$("#upload_idne").val('new');
			$("#upload_file").val('');
			$('.divuploadersurat').show();
			$('.divsuratkeluar').hide();
		});
        $("#btnuploadfile").click(function(){
			var set01 	= document.getElementById('upload_file');
			var set02	= document.getElementById('upload_jenissrt').value;
			var set03	= document.getElementById('upload_tanggal').value;
			var set04	= 'RIWAYATSURAT';
			var set05	= document.getElementById('id_namapenandatangan').value;
			var set06	= 'SELF';
			var set07	= '';
			var set08	= '';
			var set09	= '';
			var set10	= '';
			var set11	= document.getElementById('upload_idne').value;
			var set12	= document.getElementById('upload_perihal').value;
			var set13	= '';
			var set14	= '';
			var set15	= document.getElementById('upload_nomor').value;
			var set16	= document.getElementById('id_emaillain').value;
			if (set03 == '' || set05 == '' || set12 == '' || set15 == ''){
				swal({
					title	: 'Stop',
					text	: 'Nomor, Tanggal dan Perihal Tidak Boleh Kosong',
					type	: 'warning',
				})
			} else {
				$('#loading').show();
				$('#halamandatassrtkeluar').hide();
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
					url	        : '{{ route("exUploadSuratTTE") }}',
					data        : form_data,
					type        : 'POST',
					contentType : false,
					processData : false,
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
							icon        : icon,
							hideAfter   : 5000,
							stack       : 1
						});
						$('#loading').hide();
						$('#halamandatassrtkeluar').show();
						$('.divuploadersurat').hide();
						$('.divsuratkeluar').show();
						$("#gridsuratkeluar").jqxGrid('updatebounddata', 'filter');
						return false;
					},
					error: function (xhr, status, error) {
						$('#loading').hide();
						$('#halamandatassrtkeluar').show();
						swal({
							title	: 'Stop',
							text	: xhr.responseText,
							type	: 'error',
						})
					}
				});
			}
		});
        $(".btnkembali").click(function(){ 
            $('.divuploadersurat').hide(); 
            $('.divsuratkeluar').show(); 
        });
    //tombol-tombol di modal penghargaan
        
        $("#btnnewpenghargaan").click(function(){ 
            $('#penghargaan_idne').val('tambah');
            $('#penghargaan_url').val('');
            $('#divupdatepenghargaan').hide(); 
            $('#divtambahpenghargaan').show(); 
        });
        $("#btnexportpenghargaan").click(function () {
            var gridContent = $("#gridpenghargaan").jqxGrid('exportdata', 'html');
            $('#tabel_cetak').html(gridContent);
            $("#tabel_cetak").btechco_excelexport({
                containerid: "tabel_cetak"
                , datatype: $datatype.Table
            });
        });
        $('#btnkembalidrtambahpenghargaan').on('click', function (){
            $('#divupdatepenghargaan').show();
            $('#divtambahpenghargaan').hide();
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
			$('#halamandatask').hide();
			$('#halamandatassrtkeluar').hide();
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
		getnotifcount();
	});
</script>
@endpush