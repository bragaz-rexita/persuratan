@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Report Gaji</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content" >
        <div class="container-fluid">
            <div class="card direct-chat direct-chat-primary">
                <div class="card-header">
                    <h3 class="card-title">Menu</h3>
                </div>
                <div class="card-body">
                    <div id="enteni" class="center"><img class="img-responsive" src="dist/img/loading.gif"></div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-success btn-block topbtnopenpegawai"><i class="fa fa-upload"></i>Pegawai</button>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-info btn-block" id="topbtnsetting"><i class="fa fa-upload"></i> Setting</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label for="set_bulan">Bulan</label>
                                    <select id="set_bulan" name="set_bulan" class="form-control">
                                        <option value="1">Jan</option>
                                        <option value="2">Feb</option>
                                        <option value="3">Mar</option>
                                        <option value="4">Apr</option>
                                        <option value="5">May</option>
                                        <option value="6">Jun</option>
                                        <option value="7">Jul</option>
                                        <option value="8">Aug</option>
                                        <option value="9">Sep</option>
                                        <option value="10">Oct</option>
                                        <option value="11">Nov</option>
                                        <option value="12">Dec</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="set_tahun">Tahun</label>
                                    <input type="text" class="form-control" id="set_tahun" name="set_tahun" value="{{ date('Y') }}">
                                </div>
                                <div class="form-group col-md-8">
                                    <label>Jenis Report</label>
                                    <div class="input-group margin">
                                        <select id="set_jenisawal" name="set_jenisawal" class="form-control">
                                            <option value="BB">Gaji Karyawan</option>
                                            <option value="Pajak">Pajak</option>
                                            <option value="Potongan">Potongan + Rek</option>
                                            <option value="Jaspel dan Lembur">Jaspel dan Lembur</option>
                                            <option value="Kompetensi">Kompetensi</option>
                                            <option value="Jabatan">Jabatan</option>
                                            <option value="Rata Rata 3 Bulan">Rata Rata 3 Bulan Terakhir</option>
                                        </select>
                                        <span class="input-group-btn">
                                        <button class="btn btn-info btn-flat" type="button" id="topbtneksekusi">SET</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                </div>
                                <div class="form-group col-md-3">
                                    <a href="#" id="btnhitungawal" class="btn btn-block btn-info">
                                        <i class="fa fa-database"></i> HITUNG AWAL
                                    </a>
                                </div>
                                <div class="form-group col-md-3">
                                    <a href="#" id="btnhitungulang" class="btn btn-block btn-warning">
                                        <i class="fa fa-chrome"></i> HITUNG ULANG *)
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card direct-chat direct-chat-success" id="divawal">
                <div class="card-header">
                    <h3 class="card-title">Laporan Gaji</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-info btn-tool" id="btnexport"> <i class="fa fa-file-excel-o"></i></button>
                    </div>
                </div>
                <div class="card-footer">
                    <div id="gridgaji"></div>
                </div>
            </div>
            <div class="card card-primary" id="divmasterpegawai">
                <div class="card-header">
                    <h3 class="card-title">Master Pegawai</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-info btn-tool" id="btnexportpegawai"> <i class="fa fa-file-excel-o"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="form-group col-md-4">
                                
                            </div>
                            <div class="form-group col-md-3">
                                <label for="ppabp">Unit Kerja</label>
                                <select id="ppabp" name="ppabp" class="form-control">
                                    <option value="ALLPPABP">ALL</option>
                                    @if(isset($arrsdomain) AND !empty($arrsdomain))
                                        @foreach($arrsdomain as $rdomain)
                                            <option value="{{ $rdomain->subsubdomainapps }}">{{ $rdomain->subsubdomainapps }}</option>
                                        @endforeach
                                    @endif
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
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="card-footer" id="divlistpegawai">
                    <div id="gridpegawai"></div>
                </div>
                <div class="card-body" id="diveditorpegawai">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Data Dasar</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">
                                                <label for="id_nip">Nomor Kepegawaian</label>
                                                <input type="text" class="form-control" id="id_nip">
                                            </div>
                                            <div class="col-md-3 col-lg-3">
                                                <label for="id_tmtgolongan">TMT Masuk</label>
                                                <div class="input-group date" data-target-input="nearest">
                                                    <input type="text" class="form-control"id="id_tmtgolongan" name="id_tmtgolongan" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <label for="id_pangkat">Gol. Pegawai</label>
                                                <select id="id_pangkat" size="1" class="form-control">
                                                <option value="">Tidak/Belum Punya</option>
                                                    @if (isset($golongan) AND !empty($golongan))
                                                        @foreach($golongan as $row)
                                                            <option value="{{$row->id}}">{{$row->pangkat}} ( {{$row->golongan}} )</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <label for="id_nama">Nama (Tanpa Gelar)</label>
                                                <input type="text" class="form-control" id="id_nama">
                                            </div>
                                            <div class="col-md-2">
                                                <label for="id_glrdepan">Gelar Depan</label>
                                                <input type="text" id="id_glrdepan" class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label for="id_glrblakang">Gelar Belakang</label>
                                                <input type="text" id="id_glrblakang" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4 col-lg-4">
                                                <label for="id_unitkerja">Unit Kerja / Departement</label>
                                                <input type="text" id="id_unitkerja" class="form-control">
                                            </div>
                                            <div class="col-md-4 col-lg-4">
                                                <label for="id_laborat">Satuan Tugas / Kelompok</label>
                                                <input type="text" id="id_laborat" class="form-control">
                                            </div>
                                            <div class="col-md-4 col-lg-4">
                                                <label for="id_pend_akhir">Pendidikan</label>
                                                <select id="id_pend_akhir" size="1" class="form-control">
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
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">
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
                                            <div class="col-md-3 col-lg-3">
                                                <label for="id_status_jbtn">Status Pegawai</label>
                                                <input type="text" id="id_status_jbtn" class="form-control">
                                            </div>
                                            <div class="col-md-3 col-lg-3">
                                                <label for="id_jenispeg">Jenis Pegawai</label>
                                                <select id="id_jenispeg" size="1" class="form-control">
                                                    <option value="Non Medis">Non Medis</option>
                                                    <option value="Medis">Medis</option>
                                                    <option value="Pejabat">Pejabat</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 col-lg-3">
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
                                            <div class="col-md-4 col-lg-4">
                                                <label for="id_npwp">NPWP</label>
                                                <input type="text" class="form-control" id="id_npwp">
                                            </div>
                                            <div class="col-md-4 col-lg-4">
                                                <label for="id_bpjs">BPJS Kesehatan</label>
                                                <input type="text" class="form-control" id="id_bpjs">
                                            </div>
                                            <div class="col-md-4 col-lg-4">
                                                <label for="id_karpeg">BPJS Tenaga Kerja</label>
                                                <input type="text" class="form-control" id="id_karpeg">
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="card card-danger">
                                        <div class="card-header">
                                            <h3 class="card-title">Gaji Pokok dan Tunjangan</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-7 col-lg-7">
                                                        <label for="id_namabank">Nama Bank</label>
                                                        <input type="text" id="id_namabank" class="form-control">
                                                    </div>
                                                    <div class="col-md-5 col-lg-5">
                                                        <label for="id_norek">Nomor Rekening</label>
                                                        <input type="text" id="id_norek" class="form-control">
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
                                            <div class="form-group row">
                                                <label for="id_tjberas" class="col-sm-5 col-form-label">Uang Makan :</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" id="id_tjberas" name="id_tjberas">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="id_tjfungs" class="col-sm-5 col-form-label">Pengabdian :</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" id="id_tjfungs" name="id_tjfungs">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="id_tjupns" class="col-sm-5 col-form-label">Pendidikan :</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" id="id_tjupns" name="id_tjupns">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="id_tjstruk" class="col-sm-5 col-form-label">Jabatan :</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" id="id_tjstruk" name="id_tjstruk">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="id_tjlain" class="col-sm-5 col-form-label">Variabel :</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" id="id_tjlain" name="id_tjlain">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <input type="hidden" class="form-control" id="id_idpeg">
                                            <button type="button" class="btn btn-danger pull-left topbtnopenpegawai" >Cancel</button>
                                            <button type="button" class="btn btn-success pull-right" id="updatebiodata">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h3 class="card-title">Foto Profil</h3>
                                </div>
                                <div class="card-body">
                                    <img src="{{asset('dist/img/takadagambar.jpg')}}" alt="image" width="100%" id="preview">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="card direct-chat direct-chat-warning" id="divdetail">
                <div class="card-header">
                    <h3 class="card-title">Laporan Detail Gaji</h3>
                    <div class="card-tools">
                        <button class="btn bg-danger btn-sm btnkembali"><i class="fa fa-close"></i></button>
                        <button class="btn bg-success btn-sm" id="btnexportdetail"><i class="fa fa-file-excel-o"></i></button>
                    </div>
                </div>
                <div class="card-footer">
                    <div id="griddetailgaji"></div>
                </div>
            </div>
            <div class="card direct-chat direct-chat-danger" id="divinfo">
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="box box-info">
                                <div class="box-body">
                                    @if(Session::has('message'))
                                        <div class="alert {{ Session::get('alert-class') }} alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <h4><i class="icon fa fa-check"></i> {{ Session::get('status') }}</h4>
                                                {!! Session::get('message') !!}
                                        </div>
                                    @endif
                                    <p>Petunjuk :</p> Underconstruction
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div id="gridaktivasi"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-primary" id="divsetting">
                <div class="card-header">
                    <h3 class="card-title">Setting</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-info btn-tool btnkembali"> <i class="fa fa-close"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item"><a href="#" class="nav-link" id="btnsettinggr"><i class="fa fa-clone"></i> Grade Risk</a></li>
                                <li class="nav-item"><a href="#" class="nav-link" id="btnsettingtj"><i class="fa fa-clone"></i> Tunjangan Jabatan</a></li>
                                <li class="nav-item"><a href="#" class="nav-link" id="btnsettingap"><i class="fa fa-pencil"></i> Apoteker</a></li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                            <div id="gridgraderisk"></div>
                            <div id="gridtunjanganjabatan"></div>
                            <div id="gridapotekr"></div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<input type="hidden" id="getfoto">
<input type="hidden" id="master">
<div class="modal fade" id="modaladduangmakan">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Upload File UM dan Insentif</h4>
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('uploadfilegaji')}}" method="POST" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Bulan</label>
                        <select id="um_bulan" name="um_bulan" class="form-control">
                            <option value="1">Jan</option>
                            <option value="2">Feb</option>
                            <option value="3">Mar</option>
                            <option value="4">Apr</option>
                            <option value="5">May</option>
                            <option value="6">Jun</option>
                            <option value="7">Jul</option>
                            <option value="8">Aug</option>
                            <option value="9">Sep</option>
                            <option value="10">Oct</option>
                            <option value="11">Nov</option>
                            <option value="12">Dec</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Tahun</label>
                        <input type="text" class="form-control" id="um_tahun" name="um_tahun" value="{{date('Y')}}">
                    </div>
                </div>
                <p>Mohon Format File Yang di Upload Adalah XLSX Dengan Kolomnya hanya berisi (No;Nama;NIP;Unit;Insentif;UM;Jml.Bayar)</p>
                <div class="form-group">
                    <input type="hidden" name="jenis" value="um">
                    <input type="file" id="sheetc" name="sheetc">
                </div>
			</div>
			<div class="modal-footer">
                <button type="submit" class="btn btn-info">Upload</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
            </form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="modaleditor">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Editor Gaji Pegawai</h4>
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
					<label for="">Nama Pegawai</label>
					<input type="text" class="form-control" id="edit_nama" disabled="disable">
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label>NIP/NIK</label>
						<input type="text" class="form-control" id="edit_nip" disabled="disable">
					</div>
					<div class="form-group col-md-6">
						<label>Jenis Pegawai</label>
						<input type="text" class="form-control" id="edit_jenis" disabled="disable">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label>Tambahan Gaji</label>
						<input type="text" class="form-control" id="edit_tambahan">
					</div>
					<div class="form-group col-md-6">
						<label>Insentif</label>
						<input type="text" class="form-control" id="edit_insentif">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label>Honorarium Lain</label>
						<input type="text" class="form-control" id="edit_honor">
					</div>
					<div class="form-group col-md-6">
						<label>Uang Makan</label>
						<input type="text" class="form-control" id="edit_makan">
					</div>
				</div>
			</div>
			<div class="modal-footer">
                <input type="hidden" class="form-control" id="edit_idne">
				<button type="button" class="btn btn-info" id="btnsimpaneditgaji">Simpan</button>
				<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
			</div>
        </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- TOKEN -->
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

@endsection
@push('script')
<script type="text/javascript">
    $(function () {
		$('.select2').select2({width: '100%'});
		$('#id_tmtgaji').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#id_tmtgolongan').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
    });
    function openpegawai( jQuery ){
        var _second = 1000;
        var _minute = _second * 60;
        var _hour 	= _minute * 60;
        var _day 	= _hour * 24;
        var _thn 	= _day * 356;
        var now     = new Date();
        var set01=document.getElementById('ppabp').value;
        var set02=document.getElementById('status_pegawai').value;
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
            if (filebukti != ''){
                var linkbukti = '<div style="background: white;" class="pull-right"><a href="/images/pegawai/'+filebukti+'" target="_blank"><img src="/images/pegawai/'+filebukti+'" height="40" /></a></div>';
            }
            else {
                var linkbukti = '<div style="background: white;"><img src="dist/img/takadagambar.jpg" height="40" /></div>';
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
                        $("#id_nip").val(dataRecord.nip_baru);
                        $("#id_tmtgolongan").val(dataRecord.tmt_golongan);
                        $("#id_pangkat").val(dataRecord.kelasjabatan);
                        $("#id_nama").val(dataRecord.nama);
                        $("#id_glrdepan").val(dataRecord.depan);
                        $("#id_glrblakang").val(dataRecord.belakang);
                        $("#id_unitkerja").val(dataRecord.unit_kerja);
                        $("#id_laborat").val(dataRecord.lab);
                        $("#id_kawin").val(dataRecord.statusnpwp);
                        $("#id_status_jbtn").val(dataRecord.status_jabatan);
                        $("#id_jenispeg").val(dataRecord.jenispeg);
                        $("#id_status").val(dataRecord.status);
                        $("#id_npwp").val(dataRecord.npwp);
                        $("#id_bpjs").val(dataRecord.lama_kenaikan_pangkat);
                        $("#id_karpeg").val(dataRecord.karpeg);
                        $("#id_idpeg").val(dataRecord.id);
                        $("#id_gaji").val(dataRecord.gajisesuaisk);
                        $("#id_tmtgaji").val(dataRecord.tmtgaji);
                        $("#id_tjberas").val(dataRecord.tjberas);
                        $("#id_tjfungs").val(dataRecord.tjfungs);
                        $("#id_tjupns").val(dataRecord.tjupns);
                        $("#id_tjstruk").val(dataRecord.tjstruk);
                        $("#id_tjlain").val(dataRecord.tjlain);
                        $("#id_namabank").val(dataRecord.namabank);
                        $("#id_norek").val(dataRecord.norek);
                        $("#id_pend_akhir").val(dataRecord.pend_akhir);
                        var foto = dataRecord.foto;
                        if (foto == null || foto == ''){
                            $('#preview').attr('src', 'dist/img/takadagambar.jpg');
                        } else {
                            $('#preview').attr('src', 'images/pegawai/'+foto);
                        }
                        $('#divlistpegawai').hide();
                        $('#diveditorpegawai').show();
                    }
                },
                { text: 'Foto', width: '5%', cellsrenderer: photorender, editable: false, sortable: false, filterable: false },
                { text: 'Kode Pegawai', width: '10%', datafield: 'nip_baru', cellsalign: 'left', align: 'center'},
                { text: 'Nama', datafield: 'nama_lengkap', width: '15%', cellsalign: 'left', align: 'center' },
                { text: 'Penempatan', datafield: 'ppabp', filtertype: 'checkedlist', width: '10%', cellsalign: 'left', align: 'center' },
                { text: 'Unit Kerja', datafield: 'unit_kerja', width: '13%', cellsalign: 'left', align: 'center' },
                { text: 'Tgl Masuk', datafield: 'tmt_golongan', width: '7%', cellsalign: 'center', align: 'center' },
                { text: 'Masa Kerja', cellsrenderer: mkgrender, width: '8%', cellsalign: 'left', align: 'center', editable: false, sortable: false, filterable: false },
                { text: 'Gol. Pegawai', datafield: 'pangkat', width: '10%', cellsalign: 'center', align: 'center' },
                { text: 'Pendidikan', datafield: 'pend_akhir', width: '10%', cellsalign: 'center', align: 'center' },
                { text: 'Gaji Pokok', datafield: 'gajisesuaisk', width: '7%', cellsalign: 'right', align: 'center' },
                { text: 'Uang Makan', datafield: 'tjberas', width: '7%', cellsalign: 'right', align: 'center' },
                { text: 'Pengabdian', columngroup: 'tunjangan', datafield: 'tjfungs', width: '7%', cellsalign: 'right', align: 'center' },
                { text: 'Pendidikan', columngroup: 'tunjangan', datafield: 'tjupns', width: '7%', cellsalign: 'right', align: 'center' },
                { text: 'Jabatan', columngroup: 'tunjangan', datafield: 'tjstruk', width: '7%', cellsalign: 'right', align: 'center' },
                { text: 'Variabel', columngroup: 'tunjangan', datafield: 'tjlain', width: '7%', cellsalign: 'right', align: 'center' },
                { text: 'Nama Bank', datafield: 'namabank', width: '7%', cellsalign: 'right', align: 'center' },
                { text: 'Nomor Rekening', datafield: 'norek', width: '7%', cellsalign: 'right', align: 'center' },
                { text: 'BPJS Kes', datafield: 'karpeg', width: '7%', cellsalign: 'right', align: 'center' },
                { text: 'BPJS Ket', datafield: 'lama_kenaikan_pangkat', width: '7%', cellsalign: 'right', align: 'center' },
            ],
            columngroups: 
            [
                { text: 'Tunjangan', align: 'center', name: 'tunjangan' },
            ]
        });
    }
    $(document).ready(function () {
        $("#id_gaji").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
        $("#id_tjberas").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
        $("#id_tjfungs").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
        $("#id_tjupns").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
        $("#id_tjstruk").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
        $("#id_tjlain").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
        $('#divsetting').hide();
        $('#divmasterpegawai').hide();
        $('#divdetail').hide();
        $('#divawal').hide();
        $('#enteni').hide();
        //divmasterpegawai
            $('.topbtnopenpegawai').click(function(){
                $('#enteni').show();
                openpegawai();
                $('#divlistpegawai').show();
                $('#diveditorpegawai').hide();
                $('#divmasterpegawai').show();
                $('#divinfo').hide();
                $('#divdetail').hide();
                $('#divawal').hide();
                $('#enteni').hide();
            });
            $("#updatebiodata").click(function(){
                var set01=document.getElementById('id_idpeg').value;
                var set02=document.getElementById('id_nip').value;
                var set03=document.getElementById('id_tmtgolongan').value;
                var set04=document.getElementById('id_pangkat').value;
                var set05=document.getElementById('id_nama').value;
                var set06=document.getElementById('id_glrdepan').value;
                var set07=document.getElementById('id_glrblakang').value;
                var set08=document.getElementById('id_norek').value;
                var set09=document.getElementById('id_unitkerja').value;
                var set10=document.getElementById('id_laborat').value;
                var set11=document.getElementById('id_kawin').value;
                var set12=document.getElementById('id_status_jbtn').value;
                var set13=document.getElementById('id_jenispeg').value;
                var set14=document.getElementById('id_status').value;
                var set15=document.getElementById('id_npwp').value;
                var set16=document.getElementById('id_bpjs').value;
                var set17=document.getElementById('id_karpeg').value;
                var set18=document.getElementById('id_gaji').value;
                var set19=document.getElementById('id_tmtgaji').value; //gantidaritelpon
                var set20=document.getElementById('id_tjberas').value;
                var set21=document.getElementById('id_tjfungs').value;
                var set22=document.getElementById('id_tjupns').value; //gantidariemaillain
                var set23=document.getElementById('id_tjstruk').value;
                var set24=document.getElementById('id_tjlain').value;
                var set25=document.getElementById('id_namabank').value;
                
                if (set01 == '' || set02 == '' || set05 == '' || set18 == '' || set04 == '' || set09 == ''){
                    swal({
                        title	: 'Stop',
                        text	: 'Data Wajib Seperti Nama, Nomor Pegawai, Gaji, Golongan Pegawai dan Unit Kerja mohon dilengkapi terlebih dahulu',
                        type	: 'warning',
                    })
                } else {
                    var form_data 	= new FormData();
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
                        form_data.append('val26', document.getElementById('id_pend_akhir').value);
                        form_data.append('_token', '{{csrf_token()}}');
                    $.ajax({
                        url: '{{ route("updatemstpegawaigaji") }}',
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
                            $('#divlistpegawai').show();
                            $('#diveditorpegawai').hide();
                            openpegawai();
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
        //endmasterpegawai
        var sourcekeaktipan = {
            datatype: "json",
            datafields: [
                { name: 'tahun',type: 'text'},	
                { name: 'bulan',type: 'text'},
                { name: 'status',type: 'text'},
                { name: 'tlsstatus',type: 'text'},
            ],
            url: '{{route("jdataaktifbku")}}',
            cache: false,
        };
        var datakeaktipan = new $.jqx.dataAdapter(sourcekeaktipan);
        $("#gridaktivasi").jqxGrid({
            width: '100%',
            autoheight: true,
            theme: "energyblue",
            source: datakeaktipan,
            selectionmode: 'multiplecellsextended',
            columns: [
                { text: 'Tahun', datafield: 'tahun',width: '20%', cellsalign: 'center', align: 'center' },
                { text: 'Bulan', datafield: 'bulan', width: '20%', cellsalign: 'center', align: 'center' },
                { text: 'Status', datafield: 'tlsstatus', width: '40%', cellsalign: 'left', align: 'center' },
                { text: 'On/Off', columntype: 'button', align: 'center', width: '20%', cellsrenderer: function () {
                    return "On/Off";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var offset 		= $("#gridaktivasi").offset();
                        var dataRecord 	= $("#gridaktivasi").jqxGrid('getrowdata', editrow);
                        var set01		= dataRecord.bulan;
                        var set02		= dataRecord.tahun;
                        var set03		= dataRecord.status;
                        if (set03 == ''){ 
                            swal({
                                title: 'Stop',
                                text: 'No Data to Actived',
                                type: 'warning',
                            })
                        } else {
                            $.post('gaji/exaktivasigaji', { val01: set01, val02: set02, val03: set03, _token: "{{ csrf_token() }}" },
                            function(data){
                                $.toast({
                                    heading: data.status,
                                    text: data.message,
                                    position: 'top-right',
                                    loaderBg: data.warna,
                                    icon: data.icon,
                                    hideAfter: 5000,
                                    stack: 1
                                });	
                                $("#gridaktivasi").jqxGrid('updatebounddata');
                                return false;
                            });
                        }
                    }
                },
            ]
        });
        $('#btnsimpaneditgaji').click(function(){
            var set01=document.getElementById('edit_idne').value;
            var set02=document.getElementById('edit_tambahan').value;
            var set03=document.getElementById('edit_honor').value;
            var set04=document.getElementById('edit_makan').value;
            var set05=document.getElementById('edit_insentif').value;
            var token   =   document.getElementById('token').value;
            $.post('{{route("exgaji")}}',  { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, _token: token },
            function(data){
                if(data['status'] == 'error') {
                    $.toast({
                        heading: 'GAGAL',
                        text: data['message'],
                        position: 'top-right',
                        loaderBg: '#bf441d',
                        icon: 'error',
                        hideAfter: 5000,
                        stack: 1
                    });
                } else {
                    $.toast({
                        heading: 'Berhasil',
                        text: data['message'],
                        position: 'top-right',
                        loaderBg: '#5ba035',
                        icon: 'success',
                        hideAfter: 5000,
                        stack: 1
                    });
                }
                $("#modaleditor").modal('hide');
                $("#gridgaji").jqxGrid('updatebounddata', 'filter');
                $("#griddetailgaji").jqxGrid('updatebounddata', 'filter');
                return false;
            });
        });
        $('.btnkembali').click(function(){
            $('#divdetail').hide();
            $('#divawal').show();
            $('#divsetting').hide();
        });
        $('#topbtnsetting').click(function(){
            $('#divsetting').show();
            $('#divmasterpegawai').hide();
            $('#divdetail').hide();
            $('#divawal').hide();
            $('#divinfo').hide();
            $('#enteni').hide();
        });
        $('#topbtnuploadkpri').click(function(){
            $("#modaladdkpri").modal('show');
        });
        $('#topbtnuploadsass').click(function(){
            $("#modaladdsass").modal('show');
        });
        $('#topbtnuploadum').click(function(){
            $("#modaladduangmakan").modal('show');
        });
        $('#btnexport').click(function(){
            var gridContent = $("#gridgaji").jqxGrid('exportdata', 'json');
            $('#enteni').show();
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
                            if (pjg == 9 || pjg == 10){
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
            $('#enteni').hide();
            return false;
        });
        $('#btnexportpegawai').click(function(){
            var gridContent = $("#gridpegawai").jqxGrid('exportdata', 'json');
            $('#enteni').show();
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
                            if (pjg == 9 || pjg == 10){
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
            $('#enteni').hide();
            return false;
        });
        $('#btnexportdetail').click(function(){
            var gridContent = $("#griddetailgaji").jqxGrid('exportdata', 'json');
            $('#enteni').show();
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
            $('#enteni').hide();
            return false;
        });
        $('#topbtneksekusi').click(function(){
            var set01=document.getElementById('set_bulan').value;
            var set02=document.getElementById('set_tahun').value;
            var setjenis=document.getElementById('set_jenisawal').value;
            var token   =   document.getElementById('token').value;
            $('#enteni').show();
            $('#divinfo').hide();
		    if (setjenis == 'Gaji PNPN' || setjenis == 'Gaji Pegawai Kontrak'){
                var sourcedetail = {
                    datatype: "json",
                    datafields: [
                        { name: 'nomer', type: 'text'},
                        { name: 'idne', type: 'text'},
                        { name: 'idpeg', type: 'text'},
                        { name: 'bulan', type: 'text'},
                        { name: 'tahun', type: 'text'},
                        { name: 'nip', type: 'text'},
                        { name: 'nama', type: 'text'},
                        { name: 'namapdbank', type: 'text'},
                        { name: 'kdgol', type: 'text'},
                        { name: 'norek', type: 'text'},
                        { name: 'jenispeg', type: 'text'},
                        { name: 'statpeg', type: 'text'},
                        { name: 'kdkawin', type: 'text'},
                        { name: 'sutri', type: 'number'},
                        { name: 'anak', type: 'number'},
                        { name: 'beras', type: 'number'},
                        { name: 'tottunjangan', type: 'number'},
                        { name: 'gajikotor', type: 'number'},
                        { name: 'gajibersih', type: 'number'},
                        { name: 'bpjskes', type: 'number'},
                        { name: 'gajidlmdft', type: 'number'},
                        { name: 'gajigpp', type: 'number'},
                        { name: 'pinjkpri', type: 'number'},
                        { name: 'pinjukp', type: 'number'},
                        { name: 'pinjbank', type: 'number'},
                        { name: 'totpinjaman', type: 'number'},
                        { name: 'potrutin', type: 'number'},
                        { name: 'potbpjs', type: 'number'},
                        { name: 'totpotongan', type: 'number'},
                        { name: 'totbayar', type: 'number'},
                        { name: 'hutang', type: 'number'},
                        { name: 'makan', type: 'number'},
                        { name: 'insentif', type: 'number'},
                        { name: 'honor', type: 'number'},
                        { name: 'tambahangaji', type: 'number'},
                    ],
                    type: 'POST',
                    data: {	val01:set01, val02:set02, val03:setjenis, _token: token },
                    url: '{{route("detailgajisass")}}',
                };
                var datadetail = new $.jqx.dataAdapter(sourcedetail);
                $('#divdetail').show();
                $('#divawal').hide();
                $('#enteni').hide();
                $("#griddetailgaji").jqxGrid({
                    width: '100%',
                    source: datadetail,
                    filterable: true,
                    showfilterrow: true,
                    columnsresize: true,
                    theme: "energyblue",
                    autoheight: true,
                    autorowheight: false,
                    pageable: true,
                    altrows: true,
                    selectionmode: 'multiplecellsextended',
                    columns: [
                        { text: 'Tnp. Pinjaman', editable: false, sortable: false, filterable: false, align: 'center',  columntype: 'button', width: 80, cellsrenderer: function () {
                            return "Cetak";
                            }, buttonclick: function (row) {		
                            editrow = row;	
                            var offset 		= $("#griddetailgaji").offset();
                            var dataRecord 	= $("#griddetailgaji").jqxGrid('getrowdata', editrow);
                            var set01		= dataRecord.idpeg;
                            var set02		= dataRecord.bulan;
                            var set03		= dataRecord.tahun;
                            var token   =   document.getElementById('token').value;
                            $.post('{{route("cetakslipgaji")}}', { val01: set01, val02: set02, val03: set03, _token: token },
                            function(data){		
                                var newWindow = window.open('', '', 'width=800, height=500'),
                                    document = newWindow.document.open(),
                                            pageContent =
                                                '<!DOCTYPE html>\n' +
                                                '<html>\n' +
                                                '<head>\n' +
                                                '<meta charset="utf-8" />\n' +
                                                '<title>Sistem Informasi Gaji Pegawai</title>\n' +
                                                '</head>\n' +
                                                '<body>' + data + '</body>\n</html>';
                                    document.write(pageContent);
                                    document.close();
                                    return false;
                                });						 
                            }
                        },
                        { text: 'Pinjaman Saja', editable: false, sortable: false, filterable: false, align: 'center',  columntype: 'button', width: 80, cellsrenderer: function () {
                            return "Cetak";
                            }, buttonclick: function (row) {		
                            editrow = row;	
                            var offset 		= $("#griddetailgaji").offset();
                            var dataRecord 	= $("#griddetailgaji").jqxGrid('getrowdata', editrow);						
                            var set01		= dataRecord.idpeg;
                            var set02		= dataRecord.bulan;
                            var set03		= dataRecord.tahun;
                            var token   =   document.getElementById('token').value;
                            $.post('{{route("cetakslipgajikpri")}}', { val01: set01, val02: set02, val03: set03, _token: token },
                            function(data){		
                                var newWindow = window.open('', '', 'width=800, height=500'),
                                    document = newWindow.document.open(),
                                            pageContent =
                                                '<!DOCTYPE html>\n' +
                                                '<html>\n' +
                                                '<head>\n' +
                                                '<meta charset="utf-8" />\n' +
                                                '<title>Sistem Informasi Gaji Pegawai</title>\n' +
                                                '</head>\n' +
                                                '<body>' + data + '</body>\n</html>';
                                    document.write(pageContent);
                                    document.close();
                                    return false;
                                });						 
                            }
                        },
                        { text: 'Slip Lengkap', editable: false, sortable: false, filterable: false, align: 'center',  columntype: 'button', width: 80, cellsrenderer: function () {
                            return "Cetak";
                            }, buttonclick: function (row) {		
                            editrow = row;	
                            var offset 		= $("#griddetailgaji").offset();
                            var dataRecord 	= $("#griddetailgaji").jqxGrid('getrowdata', editrow);						
                            var set01		= dataRecord.idpeg;
                            var set02		= dataRecord.bulan;
                            var set03		= dataRecord.tahun;
                            var token   =   document.getElementById('token').value;
                            $.post('{{route("cetakslipgajilengkap")}}', { val01: set01, val02: set02, val03: set03, _token: token },
                            function(data){		
                                var newWindow = window.open('', '', 'width=800, height=500'),
                                    document = newWindow.document.open(),
                                            pageContent =
                                                '<!DOCTYPE html>\n' +
                                                '<html>\n' +
                                                '<head>\n' +
                                                '<meta charset="utf-8" />\n' +
                                                '<title>Sistem Informasi Gaji Pegawai</title>\n' +
                                                '</head>\n' +
                                                '<body>' + data + '</body>\n</html>';
                                    document.write(pageContent);
                                    document.close();
                                    return false;
                                });						 
                            }
                        },
                        { text: 'Edit', columntype: 'button', width: 80, editable: false, sortable: false, filterable: false, align: 'center',  cellsrenderer:function () {
                            return "SET";
                            }, buttonclick: function (row) {
                            editrow = row;	
                            var offset 		= $("#griddetailgaji").offset();
                            var dataRecord 	= $("#griddetailgaji").jqxGrid('getrowdata', editrow);
                            $("#edit_honor").val(dataRecord.honor);
                            $("#edit_tambahan").val(dataRecord.tambahangaji);
                            $("#edit_idne").val(dataRecord.idne);
                            $("#edit_insentif").val(dataRecord.insentif);
                            $("#edit_jenis").val(dataRecord.jenispeg);
                            $("#edit_makan").val(dataRecord.makan);
                            $("#edit_nama").val(dataRecord.nama);
                            $("#edit_nip").val(dataRecord.nip);
                            $("#modaleditor").modal('show');
                            }
                        },
                        { text: 'No', datafield: 'nomer', width: 40, cellsalign: 'left', align: 'center' },
                        { text: 'NIK', datafield: 'nip', width: 150, cellsalign: 'left', align: 'center' },
                        { text: 'Nama', datafield: 'nama', width: 200, cellsalign: 'left', align: 'center' },
                        { text: 'Gol', datafield: 'kdgol', width: 40, cellsalign: 'left', align: 'center' },
                        { text: 'No. Rekening', datafield: 'norek', width: 120, cellsalign: 'left', align: 'center' },
                        { text: 'Gaji Kotor', cellsformat: 'n', datafield: 'gajikotor', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Tunj.Suami/Istri', cellsformat: 'n', datafield: 'sutri', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Tunj.Anak', cellsformat: 'n', datafield: 'anak', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Tot.Tunj.Beras', cellsformat: 'n', datafield: 'beras', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'BPJS', cellsformat: 'n', datafield: 'potbpjs',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Gaji-BPJS', cellsformat: 'n', datafield: 'gajidlmdft',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Pinj.KPRI', cellsformat: 'n', datafield: 'pinjkpri',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Pinj.UKP', cellsformat: 'n', datafield: 'pinjukp',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Pinj.Bank', cellsformat: 'n', datafield: 'pinjbank',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Pot. Rutin', cellsformat: 'n', datafield: 'potrutin',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Total Potongan', cellsformat: 'n', datafield: 'totpotongan',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Gaji Bersih yang dibayarkan', cellsformat: 'n', datafield: 'gajibersih',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Total Hutang Gaji', cellsformat: 'n', datafield: 'hutang',  width: 80, cellsalign: 'right', align: 'center' },
                    ]
                });
            } else if (setjenis == 'Gaji Bersih PNS'){
                var sourcedetail = {
                    datatype: "json",
                    datafields: [
                        { name: 'nomer', type: 'text'},
                        { name: 'idne', type: 'text'},
                        { name: 'idpeg', type: 'text'},
                        { name: 'bulan', type: 'text'},
                        { name: 'tahun', type: 'text'},
                        { name: 'nip', type: 'text'},
                        { name: 'nama', type: 'text'},
                        { name: 'namapdbank', type: 'text'},
                        { name: 'kdgol', type: 'text'},
                        { name: 'norek', type: 'text'},
                        { name: 'jenispeg', type: 'text'},
                        { name: 'statpeg', type: 'text'},
                        { name: 'kdkawin', type: 'text'},
                        { name: 'gapok', type: 'number'},
                        { name: 'sutri', type: 'number'},
                        { name: 'anak', type: 'number'},
                        { name: 'beras', type: 'number'},
                        { name: 'tottunjangan', type: 'number'},
                        { name: 'gajikotor', type: 'number'},
                        { name: 'gajibersih', type: 'number'},
                        { name: 'bpjskes', type: 'number'},
                        { name: 'gajidlmdft', type: 'number'},
                        { name: 'gajigpp', type: 'number'},
                        { name: 'pinjkpri', type: 'number'},
                        { name: 'pinjukp', type: 'number'},
                        { name: 'pinjbank', type: 'number'},
                        { name: 'totpinjaman', type: 'number'},
                        { name: 'potrutin', type: 'number'},
                        { name: 'potwajib', type: 'number'},
                        { name: 'potbpjs', type: 'number'},
                        { name: 'totpotongan', type: 'number'},
                        { name: 'totbayar', type: 'number'},
                        { name: 'hutang', type: 'number'},
                        { name: 'makan', type: 'number'},
                        { name: 'insentif', type: 'number'},
                        { name: 'honor', type: 'number'},
                        { name: 'tambahangaji', type: 'number'},
                    ],
                    type: 'POST',
                    data: {	val01:set01, val02:set02, val03:setjenis, _token: token },
                    url: '{{route("detailgajisass")}}',
                };
                var datadetail = new $.jqx.dataAdapter(sourcedetail);
                $('#divdetail').show();
                $('#divawal').hide();
                $('#enteni').hide();
                $("#griddetailgaji").jqxGrid({
                    width: '100%',
                    source: datadetail,
                    filterable: true,
                    showfilterrow: true,
                    columnsresize: true,
                    theme: "energyblue",
                    autoheight: true,
                    autorowheight: false,
                    pageable: true,
                    altrows: true,
                    selectionmode: 'multiplecellsextended',
                    columns: [
                        { text: 'Tnp. Pinjaman', editable: false, sortable: false, filterable: false, align: 'center',  columntype: 'button', width: 80, cellsrenderer: function () {
                            return "Cetak";
                            }, buttonclick: function (row) {		
                            editrow = row;	
                            var offset 		= $("#griddetailgaji").offset();
                            var dataRecord 	= $("#griddetailgaji").jqxGrid('getrowdata', editrow);
                            var set01		= dataRecord.idpeg;
                            var set02		= dataRecord.bulan;
                            var set03		= dataRecord.tahun;
                            var token   =   document.getElementById('token').value;
                            $.post('{{route("cetakslipgaji")}}', { val01: set01, val02: set02, val03: set03, _token: token },
                            function(data){		
                                var newWindow = window.open('', '', 'width=800, height=500'),
                                    document = newWindow.document.open(),
                                            pageContent =
                                                '<!DOCTYPE html>\n' +
                                                '<html>\n' +
                                                '<head>\n' +
                                                '<meta charset="utf-8" />\n' +
                                                '<title>Sistem Informasi Gaji Pegawai</title>\n' +
                                                '</head>\n' +
                                                '<body>' + data + '</body>\n</html>';
                                    document.write(pageContent);
                                    document.close();
                                    return false;
                                });						 
                            }
                        },
                        { text: 'Pinjaman Saja', editable: false, sortable: false, filterable: false, align: 'center',  columntype: 'button', width: 80, cellsrenderer: function () {
                            return "Cetak";
                            }, buttonclick: function (row) {		
                            editrow = row;	
                            var offset 		= $("#griddetailgaji").offset();
                            var dataRecord 	= $("#griddetailgaji").jqxGrid('getrowdata', editrow);						
                            var set01		= dataRecord.idpeg;
                            var set02		= dataRecord.bulan;
                            var set03		= dataRecord.tahun;
                            var token   =   document.getElementById('token').value;
                            $.post('{{route("cetakslipgajikpri")}}', { val01: set01, val02: set02, val03: set03, _token: token },
                            function(data){		
                                var newWindow = window.open('', '', 'width=800, height=500'),
                                    document = newWindow.document.open(),
                                            pageContent =
                                                '<!DOCTYPE html>\n' +
                                                '<html>\n' +
                                                '<head>\n' +
                                                '<meta charset="utf-8" />\n' +
                                                '<title>Sistem Informasi Gaji Pegawai</title>\n' +
                                                '</head>\n' +
                                                '<body>' + data + '</body>\n</html>';
                                    document.write(pageContent);
                                    document.close();
                                    return false;
                                });						 
                            }
                        },
                        { text: 'Slip Lengkap', editable: false, sortable: false, filterable: false, align: 'center',  columntype: 'button', width: 80, cellsrenderer: function () {
                            return "Cetak";
                            }, buttonclick: function (row) {		
                            editrow = row;	
                            var offset 		= $("#griddetailgaji").offset();
                            var dataRecord 	= $("#griddetailgaji").jqxGrid('getrowdata', editrow);						
                            var set01		= dataRecord.idpeg;
                            var set02		= dataRecord.bulan;
                            var set03		= dataRecord.tahun;
                            var token   =   document.getElementById('token').value;
                            $.post('{{route("cetakslipgajilengkap")}}', { val01: set01, val02: set02, val03: set03, _token: token },
                            function(data){		
                                var newWindow = window.open('', '', 'width=800, height=500'),
                                    document = newWindow.document.open(),
                                            pageContent =
                                                '<!DOCTYPE html>\n' +
                                                '<html>\n' +
                                                '<head>\n' +
                                                '<meta charset="utf-8" />\n' +
                                                '<title>Sistem Informasi Gaji Pegawai</title>\n' +
                                                '</head>\n' +
                                                '<body>' + data + '</body>\n</html>';
                                    document.write(pageContent);
                                    document.close();
                                    return false;
                                });						 
                            }
                        },
                        { text: 'Edit', columntype: 'button', width: 80, editable: false, sortable: false, filterable: false, align: 'center', cellsrenderer:function () {
                            return "SET";
                            }, buttonclick: function (row) {
                            editrow = row;	
                            var offset 		= $("#griddetailgaji").offset();
                            var dataRecord 	= $("#griddetailgaji").jqxGrid('getrowdata', editrow);
                            $("#edit_honor").val(dataRecord.honor);
                            $("#edit_tambahan").val(dataRecord.tambahangaji);
                            $("#edit_idne").val(dataRecord.idne);
                            $("#edit_insentif").val(dataRecord.insentif);
                            $("#edit_jenis").val(dataRecord.jenispeg);
                            $("#edit_makan").val(dataRecord.makan);
                            $("#edit_nama").val(dataRecord.nama);
                            $("#edit_nip").val(dataRecord.nip);
                            $("#modaleditor").modal('show');
                            }
                        },
                        { text: 'No', datafield: 'nomer', width: 40, cellsalign: 'left', align: 'center' },
                        { text: 'NIK', datafield: 'nip', width: 150, cellsalign: 'left', align: 'center' },
                        { text: 'Nama', datafield: 'nama', width: 200, cellsalign: 'left', align: 'center' },
                        { text: 'Gol', datafield: 'kdgol', width: 40, cellsalign: 'left', align: 'center' },
                        { text: 'No. Rekening', datafield: 'norek', width: 120, cellsalign: 'left', align: 'center' },
                        { text: 'Gaji Pokok', cellsformat: 'n', datafield: 'gapok', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Tunjangan', cellsformat: 'n', datafield: 'tottunjangan', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Gaji Kotor', cellsformat: 'n', datafield: 'gajikotor', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Potongan Wajib Pegawai', cellsformat: 'n', datafield: 'potwajib', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Gaji GPP', cellsformat: 'n', datafield: 'gajigpp', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Pinj.KPRI', cellsformat: 'n', datafield: 'pinjkpri',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Pinj.UKP', cellsformat: 'n', datafield: 'pinjukp',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Pinj.Bank', cellsformat: 'n', datafield: 'pinjbank',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Pot. Rutin', cellsformat: 'n', datafield: 'potrutin',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Total Potongan', cellsformat: 'n', datafield: 'totpotongan',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'BAYAR', cellsformat: 'n', datafield: 'totbayar',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'HUTANG', cellsformat: 'n', datafield: 'hutang',  width: 80, cellsalign: 'right', align: 'center' },
                    ]
                });
            } else if (setjenis == 'Potongan Rutin Lengkap'){
                var sourcedetail = {
                    datatype: "json",
                    datafields: [
                        { name: 'nomer', type: 'text'},
                        { name: 'idne', type: 'text'},
                        { name: 'idpeg', type: 'text'},
                        { name: 'bulan', type: 'text'},
                        { name: 'tahun', type: 'text'},
                        { name: 'nip', type: 'text'},
                        { name: 'nama', type: 'text'},
                        { name: 'namapdbank', type: 'text'},
                        { name: 'kdgol', type: 'text'},
                        { name: 'norek', type: 'text'},
                        { name: 'statpeg', type: 'text'},
                        { name: 'kdkawin', type: 'text'},
                        { name: 'sutri', type: 'number'},
                        { name: 'anak', type: 'number'},
                        { name: 'beras', type: 'number'},
                        { name: 'potrutin', type: 'number'},
                        { name: 'potbpjs', type: 'number'},
                        { name: 'gajikotor', type: 'number'},
                        { name: 'gajibersih', type: 'number'},
                        { name: 'kpri', type: 'number'},
                        { name: 'korpri', type: 'number'},
                        { name: 'arisan', type: 'number'},
                        { name: 'idewe', type: 'number'},
                        { name: 'sumbangan', type: 'number'},
                        { name: 'potpfkbul', type: 'number'},
                        { name: 'potpfk2', type: 'number'},
                        { name: 'potpfk10', type: 'number'},
                        { name: 'potpph', type: 'number'},
                        { name: 'potswrum', type: 'number'},
                        { name: 'potkelbtj', type: 'number'},
                        { name: 'potlain', type: 'number'},
                        { name: 'pottabrum', type: 'number'},
                        { name: 'tabukp', type: 'number'},
                        { name: 'bpjsbu', type: 'number'},
                        { name: 'bpjsket', type: 'number'},
                        { name: 'bpjskes', type: 'number'},
                    ],
                    type: 'POST',
                    data: {	val01:set01, val02:set02, val03:setjenis, _token: token },
                    url: '{{route("detailgajisass")}}',
                };
                var datadetail = new $.jqx.dataAdapter(sourcedetail);
                $('#divdetail').show();
                $('#divawal').hide();
                $('#enteni').hide();
                $("#griddetailgaji").jqxGrid({
                    width: '100%',
                    source: datadetail,
                    filterable: true,
                    showfilterrow: true,
                    columnsresize: true,
                    theme: "energyblue",
                    autoheight: true,
                    autorowheight: false,
                    pageable: true,
                    altrows: true,
                    selectionmode: 'multiplecellsextended',
                    columns: [
                        { text: 'No', datafield: 'nomer', width: 40, cellsalign: 'left', align: 'center' },
                        { text: 'NIP', datafield: 'nip', width: 150, cellsalign: 'left', align: 'center' },
                        { text: 'Nama', datafield: 'nama', width: 200, cellsalign: 'left', align: 'center' },
                        { text: 'Gol', datafield: 'kdgol', width: 40, cellsalign: 'left', align: 'center' },
                        { text: 'Potongan S. WAJIB KPRI', cellsformat: 'n', datafield: 'kpri', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Tabungan UKP', cellsformat: 'n', datafield: 'tabukp',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'KORPRI', cellsformat: 'n', datafield: 'korpri',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'ARISAN', cellsformat: 'n', datafield: 'arisan',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Dharma Wanita', cellsformat: 'n', datafield: 'idewe',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Sumbangan', cellsformat: 'n', datafield: 'sumbangan',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'potpfkbul', cellsformat: 'n', datafield: 'potpfkbul',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'potpfk2', cellsformat: 'n', datafield: 'potpfk2',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'potpfk10', cellsformat: 'n', datafield: 'potpfk10',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'potpph', cellsformat: 'n', datafield: 'potpph',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'potswrum', cellsformat: 'n', datafield: 'potswrum',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'potkelbtj', cellsformat: 'n', datafield: 'potkelbtj',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'potlain', cellsformat: 'n', datafield: 'potlain',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'pottabrum', cellsformat: 'n', datafield: 'pottabrum',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'tabukp', cellsformat: 'n', datafield: 'tabukp',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'potrutin', cellsformat: 'n', datafield: 'potrutin',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Total Pot.Rutin', cellsformat: 'n', datafield: 'potrutin',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'BPJS Kesehatan', cellsformat: 'n', datafield: 'bpjskes',  width: 80, cellsalign: 'right', align: 'center' },										
                        { text: 'BPJS RSUB', cellsformat: 'n', datafield: 'bpjsbu',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'BPJS Ketenagakerjaan', cellsformat: 'n', datafield: 'bpjsket',  width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Total BPJS', cellsformat: 'n', datafield: 'potbpjs',  width: 80, cellsalign: 'right', align: 'center' },
                    ]
                });
            } else if (setjenis == 'Potongan Rutin ARISAN'){
                var sourcedetail = {
                    datatype: "json",
                    datafields: [
                        { name: 'nomer', type: 'text'},
                        { name: 'idne', type: 'text'},
                        { name: 'idpeg', type: 'text'},
                        { name: 'bulan', type: 'text'},
                        { name: 'tahun', type: 'text'},
                        { name: 'nip', type: 'text'},
                        { name: 'nama', type: 'text'},
                        { name: 'bank', type: 'text'},
                        { name: 'namapdbank', type: 'text'},
                        { name: 'kdgol', type: 'text'},
                        { name: 'norek', type: 'text'},
                        { name: 'jenispeg', type: 'text'},
                        { name: 'keterangan', type: 'text'},
                        { name: 'arisan', type: 'text'},
                        { name: 'fungsional', type: 'text'},
                    ],
                    type: 'POST',
                    data: {	val01:set01, val02:set02, val03:setjenis, _token: token },
                    url: '{{route("detailgajisass")}}',
                };
                var datadetail = new $.jqx.dataAdapter(sourcedetail);
                $('#divdetail').show();
                $('#divawal').hide();
                $('#enteni').hide();
                $("#griddetailgaji").jqxGrid({
                    width: '100%',
                    source: datadetail,
                    filterable: true,
                    showfilterrow: true,
                    columnsresize: true,
                    theme: "energyblue",
                    autoheight: true,
                    autorowheight: false,
                    pageable: true,
                    altrows: true,
                    selectionmode: 'multiplecellsextended',
                    columns: [
                        { text: 'No', datafield: 'nomer', width: 40, cellsalign: 'left', align: 'center' },
                        { text: 'Nama', datafield: 'namapdbank', width: 200, cellsalign: 'left', align: 'center' },
                        { text: 'NIK', datafield: 'nip', width: 150, cellsalign: 'left', align: 'center' },
                        { text: 'Gol', datafield: 'kdgol', width: 40, cellsalign: 'left', align: 'center' },
                        { text: 'Sumber', datafield: 'jenispeg', width: 80, cellsalign: 'left', align: 'center' },
                        { text: 'Fungsional', datafield: 'fungsional',  width: 200, cellsalign: 'left', align: 'center' },
                        { text: 'Penempatan', datafield: 'keterangan',  width: 280, cellsalign: 'left', align: 'center' },
                        { text: 'No.Anggota/Norek', datafield: 'norek',  width: 120, cellsalign: 'left', align: 'center' },
                        { text: 'Nominal', cellsformat: 'n', datafield: 'arisan',  width: 80, cellsalign: 'right', align: 'center' }
                    ]
                });
            } else if (setjenis == 'Potongan Rutin IDW'){
                var sourcedetail = {
                    datatype: "json",
                    datafields: [
                        { name: 'nomer', type: 'text'},
                        { name: 'idne', type: 'text'},
                        { name: 'idpeg', type: 'text'},
                        { name: 'bulan', type: 'text'},
                        { name: 'tahun', type: 'text'},
                        { name: 'nip', type: 'text'},
                        { name: 'nama', type: 'text'},
                        { name: 'bank', type: 'text'},
                        { name: 'namapdbank', type: 'text'},
                        { name: 'kdgol', type: 'text'},
                        { name: 'norek', type: 'text'},
                        { name: 'jenispeg', type: 'text'},
                        { name: 'keterangan', type: 'text'},
                        { name: 'idewe', type: 'text'},
                        { name: 'fungsional', type: 'text'},
                    ],
                    type: 'POST',
                    data: {	val01:set01, val02:set02, val03:setjenis, _token: token },
                    url: '{{route("detailgajisass")}}',
                };
                var datadetail = new $.jqx.dataAdapter(sourcedetail);
                $('#divdetail').show();
                $('#divawal').hide();
                $('#enteni').hide();
                $("#griddetailgaji").jqxGrid({
                    width: '100%',
                    source: datadetail,
                    filterable: true,
                    showfilterrow: true,
                    columnsresize: true,
                    theme: "energyblue",
                    autoheight: true,
                    autorowheight: false,
                    pageable: true,
                    altrows: true,
                    selectionmode: 'multiplecellsextended',
                    columns: [
                        { text: 'No', datafield: 'nomer', width: 40, cellsalign: 'left', align: 'center' },
                        { text: 'NIP', datafield: 'nip', width: 150, cellsalign: 'left', align: 'center' },
                        { text: 'Nama', datafield: 'nama', width: 200, cellsalign: 'left', align: 'center' },
                        { text: 'Gol', datafield: 'kdgol', width: 40, cellsalign: 'left', align: 'center' },
                        { text: 'Sumber', datafield: 'jenispeg', width: 80, cellsalign: 'left', align: 'center' },
                        { text: 'Fungsional', datafield: 'fungsional',  width: 200, cellsalign: 'left', align: 'center' },
                        { text: 'Penempatan', datafield: 'keterangan',  width: 280, cellsalign: 'left', align: 'center' },
                        { text: 'No.Anggota/Norek', datafield: 'norek',  width: 120, cellsalign: 'left', align: 'center' },
                        { text: 'Nominal', cellsformat: 'n', datafield: 'idewe',  width: 80, cellsalign: 'right', align: 'center' }
                    ]
                });
            } else if (setjenis == 'Potongan Rutin KORPRI'){
                var sourcedetail = {
                    datatype: "json",
                    datafields: [
                        { name: 'nomer', type: 'text'},
                        { name: 'idne', type: 'text'},
                        { name: 'idpeg', type: 'text'},
                        { name: 'bulan', type: 'text'},
                        { name: 'tahun', type: 'text'},
                        { name: 'nip', type: 'text'},
                        { name: 'nama', type: 'text'},
                        { name: 'bank', type: 'text'},
                        { name: 'namapdbank', type: 'text'},
                        { name: 'kdgol', type: 'text'},
                        { name: 'norek', type: 'text'},
                        { name: 'jenispeg', type: 'text'},
                        { name: 'keterangan', type: 'text'},
                        { name: 'korpri', type: 'text'},
                        { name: 'fungsional', type: 'text'},
                    ],
                    type: 'POST',
                    data: {	val01:set01, val02:set02, val03:setjenis, _token: token },
                    url: '{{route("detailgajisass")}}',
                };
                var datadetail = new $.jqx.dataAdapter(sourcedetail);
                $('#divdetail').show();
                $('#divawal').hide();
                $('#enteni').hide();
                $("#griddetailgaji").jqxGrid({
                    width: '100%',
                    source: datadetail,
                    filterable: true,
                    showfilterrow: true,
                    columnsresize: true,
                    theme: "energyblue",
                    autoheight: true,
                    autorowheight: false,
                    pageable: true,
                    altrows: true,
                    selectionmode: 'multiplecellsextended',
                    columns: [
                        { text: 'No', datafield: 'nomer', width: 40, cellsalign: 'left', align: 'center' },
                        { text: 'NIP', datafield: 'nip', width: 150, cellsalign: 'left', align: 'center' },
                        { text: 'Nama', datafield: 'nama', width: 200, cellsalign: 'left', align: 'center' },
                        { text: 'Gol', datafield: 'kdgol', width: 40, cellsalign: 'left', align: 'center' },
                        { text: 'Sumber', datafield: 'jenispeg', width: 80, cellsalign: 'left', align: 'center' },
                        { text: 'Fungsional', datafield: 'fungsional',  width: 200, cellsalign: 'left', align: 'center' },
                        { text: 'Penempatan', datafield: 'keterangan',  width: 280, cellsalign: 'left', align: 'center' },
                        { text: 'No.Anggota/Norek', datafield: 'norek',  width: 120, cellsalign: 'left', align: 'center' },
                        { text: 'Nominal', cellsformat: 'n', datafield: 'korpri',  width: 80, cellsalign: 'right', align: 'center' }
                    ]
                });
            } else if (setjenis == 'Potongan Rutin KPRI'){
                var sourcedetail = {
                    datatype: "json",
                    datafields: [
                        { name: 'nomer', type: 'text'},
                        { name: 'idne', type: 'text'},
                        { name: 'idpeg', type: 'text'},
                        { name: 'bulan', type: 'text'},
                        { name: 'tahun', type: 'text'},
                        { name: 'nip', type: 'text'},
                        { name: 'nama', type: 'text'},
                        { name: 'bank', type: 'text'},
                        { name: 'namapdbank', type: 'text'},
                        { name: 'kdgol', type: 'text'},
                        { name: 'norek', type: 'text'},
                        { name: 'jenispeg', type: 'text'},
                        { name: 'keterangan', type: 'text'},
                        { name: 'kpri', type: 'text'},
                        { name: 'fungsional', type: 'text'},
                    ],
                    type: 'POST',
                    data: {	val01:set01, val02:set02, val03:setjenis, _token: token },
                    url: '{{route("detailgajisass")}}',
                };
                var datadetail = new $.jqx.dataAdapter(sourcedetail);
                $('#divdetail').show();
                $('#divawal').hide();
                $('#enteni').hide();
                $("#griddetailgaji").jqxGrid({
                    width: '100%',
                    source: datadetail,
                    filterable: true,
                    showfilterrow: true,
                    columnsresize: true,
                    theme: "energyblue",
                    autoheight: true,
                    autorowheight: false,
                    pageable: true,
                    altrows: true,
                    selectionmode: 'multiplecellsextended',
                    columns: [
                        { text: 'No', datafield: 'nomer', width: 40, cellsalign: 'left', align: 'center' },
                        { text: 'NIP', datafield: 'nip', width: 150, cellsalign: 'left', align: 'center' },
                        { text: 'Nama', datafield: 'nama', width: 200, cellsalign: 'left', align: 'center' },
                        { text: 'Gol', datafield: 'kdgol', width: 40, cellsalign: 'left', align: 'center' },
                        { text: 'Sumber', datafield: 'jenispeg', width: 80, cellsalign: 'left', align: 'center' },
                        { text: 'Fungsional', datafield: 'fungsional',  width: 200, cellsalign: 'left', align: 'center' },
                        { text: 'Penempatan', datafield: 'keterangan',  width: 280, cellsalign: 'left', align: 'center' },
                        { text: 'No.Anggota/Norek', datafield: 'norek',  width: 120, cellsalign: 'left', align: 'center' },
                        { text: 'Nominal', cellsformat: 'n', datafield: 'kpri',  width: 80, cellsalign: 'right', align: 'center' }
                    ]
                });
            } else if (setjenis == 'Potongan Rutin SUMBANGAN'){
                var sourcedetail = {
                    datatype: "json",
                    datafields: [
                        { name: 'nomer', type: 'text'},
                        { name: 'idne', type: 'text'},
                        { name: 'idpeg', type: 'text'},
                        { name: 'bulan', type: 'text'},
                        { name: 'tahun', type: 'text'},
                        { name: 'nip', type: 'text'},
                        { name: 'nama', type: 'text'},
                        { name: 'bank', type: 'text'},
                        { name: 'namapdbank', type: 'text'},
                        { name: 'kdgol', type: 'text'},
                        { name: 'norek', type: 'text'},
                        { name: 'jenispeg', type: 'text'},
                        { name: 'keterangan', type: 'text'},
                        { name: 'sumbangan', type: 'text'},
                        { name: 'fungsional', type: 'text'},
                    ],
                    type: 'POST',
                    data: {	val01:set01, val02:set02, val03:setjenis, _token: token },
                    url: '{{route("detailgajisass")}}',
                };
                var datadetail = new $.jqx.dataAdapter(sourcedetail);
                $('#divdetail').show();
                $('#divawal').hide();
                $('#enteni').hide();
                $("#griddetailgaji").jqxGrid({
                    width: '100%',
                    source: datadetail,
                    filterable: true,
                    showfilterrow: true,
                    columnsresize: true,
                    theme: "energyblue",
                    autoheight: true,
                    autorowheight: false,
                    pageable: true,
                    altrows: true,
                    selectionmode: 'multiplecellsextended',
                    columns: [
                        { text: 'No', datafield: 'nomer', width: 40, cellsalign: 'left', align: 'center' },
                        { text: 'NIP', datafield: 'nip', width: 150, cellsalign: 'left', align: 'center' },
                        { text: 'Nama', datafield: 'nama', width: 200, cellsalign: 'left', align: 'center' },
                        { text: 'Gol', datafield: 'kdgol', width: 40, cellsalign: 'left', align: 'center' },
                        { text: 'Sumber', datafield: 'jenispeg', width: 80, cellsalign: 'left', align: 'center' },
                        { text: 'Fungsional', datafield: 'fungsional',  width: 200, cellsalign: 'left', align: 'center' },
                        { text: 'Penempatan', datafield: 'keterangan',  width: 280, cellsalign: 'left', align: 'center' },
                        { text: 'No.Anggota/Norek', datafield: 'norek',  width: 120, cellsalign: 'left', align: 'center' },
                        { text: 'Nominal', cellsformat: 'n', datafield: 'sumbangan',  width: 80, cellsalign: 'right', align: 'center' }
                    ]
                });
            } else if (setjenis == 'Potongan Rutin UKP'){
                var sourcedetail = {
                    datatype: "json",
                    datafields: [
                        { name: 'nomer', type: 'text'},
                        { name: 'idne', type: 'text'},
                        { name: 'idpeg', type: 'text'},
                        { name: 'bulan', type: 'text'},
                        { name: 'tahun', type: 'text'},
                        { name: 'nip', type: 'text'},
                        { name: 'nama', type: 'text'},
                        { name: 'bank', type: 'text'},
                        { name: 'namapdbank', type: 'text'},
                        { name: 'kdgol', type: 'text'},
                        { name: 'norek', type: 'text'},
                        { name: 'jenispeg', type: 'text'},
                        { name: 'keterangan', type: 'text'},
                        { name: 'tabukp', type: 'text'},
                        { name: 'fungsional', type: 'text'},
                    ],
                    type: 'POST',
                    data: {	val01:set01, val02:set02, val03:setjenis, _token: token },
                    url: '{{route("detailgajisass")}}',
                };
                var datadetail = new $.jqx.dataAdapter(sourcedetail);
                $('#divdetail').show();
                $('#divawal').hide();
                $('#enteni').hide();
                $("#griddetailgaji").jqxGrid({
                    width: '100%',
                    source: datadetail,
                    filterable: true,
                    showfilterrow: true,
                    columnsresize: true,
                    theme: "energyblue",
                    autoheight: true,
                    autorowheight: false,
                    pageable: true,
                    altrows: true,
                    selectionmode: 'multiplecellsextended',
                    columns: [
                        { text: 'No', datafield: 'nomer', width: 40, cellsalign: 'left', align: 'center' },
                        { text: 'NIP', datafield: 'nip', width: 150, cellsalign: 'left', align: 'center' },
                        { text: 'Nama', datafield: 'nama', width: 200, cellsalign: 'left', align: 'center' },
                        { text: 'Gol', datafield: 'kdgol', width: 40, cellsalign: 'left', align: 'center' },
                        { text: 'Sumber', datafield: 'jenispeg', width: 80, cellsalign: 'left', align: 'center' },
                        { text: 'Fungsional', datafield: 'fungsional',  width: 200, cellsalign: 'left', align: 'center' },
                        { text: 'Penempatan', datafield: 'keterangan',  width: 280, cellsalign: 'left', align: 'center' },
                        { text: 'No.Anggota/Norek', datafield: 'norek',  width: 120, cellsalign: 'left', align: 'center' },
                        { text: 'Nominal', cellsformat: 'n', datafield: 'tabukp',  width: 80, cellsalign: 'right', align: 'center' }
                    ]
                });
            } else if (setjenis == 'Tunjangan'){
                var sourcedetail = {
                    datatype: "json",
                    datafields: [
                        { name: 'nomer', type: 'text'},
                        { name: 'idne', type: 'text'},
                        { name: 'idpeg', type: 'text'},
                        { name: 'bulan', type: 'text'},
                        { name: 'tahun', type: 'text'},
                        { name: 'nip', type: 'text'},
                        { name: 'nama', type: 'text'},
                        { name: 'namapdbank', type: 'text'},
                        { name: 'kdgol', type: 'text'},
                        { name: 'norek', type: 'text'},
                        { name: 'statpeg', type: 'text'},
                        { name: 'kdkawin', type: 'text'},
                        { name: 'gapok', type: 'number'},
                        { name: 'sutri', type: 'number'},
                        { name: 'anak', type: 'number'},
                        { name: 'beras', type: 'number'},
                        { name: 'tjupns', type: 'number'},
                        { name: 'tjstruk', type: 'number'},
                        { name: 'tjfungs', type: 'number'},
                        { name: 'tjdaerah', type: 'number'},
                        { name: 'tjpencil', type: 'number'},
                        { name: 'tjkompen', type: 'number'},
                        { name: 'pembul', type: 'number'},
                        { name: 'tjpph', type: 'number'},
                        { name: 'tjlain', type: 'number'},
                        { name: 'tottunjangan', type: 'number'},
                        { name: 'gajikotor', type: 'number'},
                    ],
                    type: 'POST',
                    data: {	val01:set01, val02:set02, val03:setjenis, _token: token },
                    url: '{{route("detailgajisass")}}',
                };
                var datadetail = new $.jqx.dataAdapter(sourcedetail);
                $('#divdetail').show();
                $('#divawal').hide();
                $('#enteni').hide();
                $("#griddetailgaji").jqxGrid({
                    width: '100%',
                    source: datadetail,
                    filterable: true,
                    showfilterrow: true,
                    columnsresize: true,
                    theme: "energyblue",
                    autoheight: true,
                    autorowheight: false,
                    pageable: true,
                    altrows: true,
                    selectionmode: 'multiplecellsextended',
                    columns: [
                        { text: 'No', datafield: 'nomer', width: 40, cellsalign: 'left', align: 'center' },
                        { text: 'NIP', datafield: 'nip', width: 150, cellsalign: 'left', align: 'center' },
                        { text: 'Nama', datafield: 'nama', width: 200, cellsalign: 'left', align: 'center' },
                        { text: 'Gol', datafield: 'kdgol', width: 40, cellsalign: 'left', align: 'center' },
                        { text: 'Gaji Pokok', cellsformat: 'n', datafield: 'gapok', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Tunj.Suami/Istri', cellsformat: 'n', datafield: 'sutri', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Tunj.Anak', cellsformat: 'n', datafield: 'anak', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Tunj.Beras', cellsformat: 'n', datafield: 'beras', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Tunj.UPNS', cellsformat: 'n', datafield: 'tjupns', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Tunj.Struktural', cellsformat: 'n', datafield: 'tjstruk', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Tunj.Fungsional', cellsformat: 'n', datafield: 'tjfungs', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Tunj.Daerah', cellsformat: 'n', datafield: 'tjdaerah', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Tunj.Terpencil', cellsformat: 'n', datafield: 'tjpencil', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Tunj.Kompen', cellsformat: 'n', datafield: 'tjkompen', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Pembulatan', cellsformat: 'n', datafield: 'pembul', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Tunj.PPH', cellsformat: 'n', datafield: 'tjpph', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Tunj.Lain', cellsformat: 'n', datafield: 'tjlain', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Total Tunjangan', cellsformat: 'n', datafield: 'tottunjangan', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Gaji Kotor', cellsformat: 'n', datafield: 'gajikotor', width: 80, cellsalign: 'right', align: 'center' },
                    ]
                });
            } else if (setjenis == 'Rekapitulasi Potongan'){
                var sourcedetail = {
                    datatype: "json",
                    datafields: [
                        { name: 'nomer', type: 'text'},
                        { name: 'uraian', type: 'text'},
                        { name: 'pns', type: 'number'},
                        { name: 'pnpn', type: 'number'},
                        { name: 'kontrak', type: 'number'},
                        { name: 'jumlah', type: 'number'},
                    ],
                    type: 'POST',
                    data: {	val01:set01, val02:set02, val03:setjenis, _token: token },
                    url: '{{route("detailgajisass")}}',
                };
                var datadetail = new $.jqx.dataAdapter(sourcedetail);
                $('#divdetail').show();
                $('#divawal').hide();
                $('#enteni').hide();
                $("#griddetailgaji").jqxGrid({
                    width: '100%',
                    source: datadetail,
                    columnsresize: true,
                    filterable: true,
                    showfilterrow: true,
                    theme: "energyblue",
                    autoheight: true,
                    autorowheight: false,
                    pageable: false,
                    altrows: true,
                    selectionmode: 'multiplecellsextended',
                    columns: [
                        { text: 'No', datafield: 'nomer', width: '5%', cellsalign: 'left', align: 'center' },
                        { text: 'Uraian', datafield: 'uraian', width: '55%', cellsalign: 'left', align: 'center' },
                        { text: 'PNS', cellsformat: 'n', datafield: 'pns', width: '10%', cellsalign: 'right', align: 'center' },
                        { text: 'PNPN', cellsformat: 'n', datafield: 'pnpn', width: '10%', cellsalign: 'right', align: 'center' },
                        { text: 'KONTRAK',  cellsformat: 'n', datafield: 'kontrak', width: '10%', cellsalign: 'right', align: 'center' },
                        { text: 'JUMLAH', cellsformat: 'n', datafield: 'jumlah', width: '10%', cellsalign: 'right', align: 'center' },
                    ]
                });
            } else if (setjenis == 'Uang Makan'){
                var sourcedetail = {
                    datatype: "json",
                    datafields: [
                        { name: 'nomer', type: 'text'},
                        { name: 'idne', type: 'text'},
                        { name: 'idpeg', type: 'text'},
                        { name: 'bulan', type: 'text'},
                        { name: 'tahun', type: 'text'},
                        { name: 'nip', type: 'text'},
                        { name: 'nama', type: 'text'},
                        { name: 'bank', type: 'text'},
                        { name: 'namapdbank', type: 'text'},
                        { name: 'kdgol', type: 'text'},
                        { name: 'norek', type: 'text'},
                        { name: 'jenispeg', type: 'text'},
                        { name: 'keterangan', type: 'text'},
                        { name: 'uangmakan', type: 'text'},
                        { name: 'potuangmakan', type: 'number'},
                        { name: 'terimauangmakan', type: 'number'},
                        { name: 'fungsional', type: 'number'},
                    ],
                    type: 'POST',
                    data: {	val01:set01, val02:set02, val03:setjenis, _token: token },
                    url: 'j{{route("detailgajisass")}}',
                };
                var datadetail = new $.jqx.dataAdapter(sourcedetail);
                $('#divdetail').show();
                $('#divawal').hide();
                $('#enteni').hide();
                $("#griddetailgaji").jqxGrid({
                    width: '100%',
                    source: datadetail,
                    columnsresize: true,
                    filterable: true,
                    showfilterrow: true,
                    theme: "energyblue",
                    autoheight: true,
                    autorowheight: false,
                    pageable: true,
                    altrows: true,
                    selectionmode: 'multiplecellsextended',
                    columns: [
                        { text: 'No', datafield: 'nomer', width: 40, cellsalign: 'left', align: 'center' },
                        { text: 'Nama', datafield: 'namapdbank', width: 200, cellsalign: 'left', align: 'center' },
                        { text: 'NIK', datafield: 'nip', width: 150, cellsalign: 'left', align: 'center' },
                        { text: 'Unit Kerja', datafield: 'keterangan', width: 280, cellsalign: 'left', align: 'center' },
                        { text: 'Uang Makan',  cellsformat: 'n', datafield: 'uangmakan', width: 120, cellsalign: 'right', align: 'center' },
                        { text: 'Potongan', cellsformat: 'n', datafield: 'potuangmakan', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Diterima', cellsformat: 'n', datafield: 'terimauangmakan', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Rekening', datafield: 'norek', width: 180, cellsalign: 'left', align: 'center' },
                    ]
                });
            } else if (setjenis == 'Insentif'){
                var sourcedetail = {
                    datatype: "json",
                    datafields: [
                        { name: 'nomer', type: 'text'},
                        { name: 'idne', type: 'text'},
                        { name: 'idpeg', type: 'text'},
                        { name: 'bulan', type: 'text'},
                        { name: 'tahun', type: 'text'},
                        { name: 'nip', type: 'text'},
                        { name: 'nama', type: 'text'},
                        { name: 'bank', type: 'text'},
                        { name: 'namapdbank', type: 'text'},
                        { name: 'kdgol', type: 'text'},
                        { name: 'norek', type: 'text'},
                        { name: 'jenispeg', type: 'text'},
                        { name: 'keterangan', type: 'text'},
                        { name: 'insentif', type: 'text'},
                        { name: 'potinsentif', type: 'number'},
                        { name: 'terimainsentif', type: 'number'},
                        { name: 'fungsional', type: 'number'},
                    ],
                    type: 'POST',
                    data: {	val01:set01, val02:set02, val03:setjenis, _token: token },
                    url: '{{route("detailgajisass")}}',
                };
                var datadetail = new $.jqx.dataAdapter(sourcedetail);
                $('#divdetail').show();
                $('#divawal').hide();
                $('#enteni').hide();
                $("#griddetailgaji").jqxGrid({
                    width: '100%',
                    source: datadetail,
                    columnsresize: true,
                    filterable: true,
                    showfilterrow: true,
                    theme: "energyblue",
                    autoheight: true,
                    autorowheight: false,
                    pageable: true,
                    altrows: true,
                    selectionmode: 'multiplecellsextended',
                    columns: [
                        { text: 'No', datafield: 'nomer', width: 40, cellsalign: 'left', align: 'center' },
                        { text: 'Nama', datafield: 'namapdbank', width: 200, cellsalign: 'left', align: 'center' },
                        { text: 'NIK', datafield: 'nip', width: 150, cellsalign: 'left', align: 'center' },
                        { text: 'Unit Kerja', datafield: 'keterangan', width: 280, cellsalign: 'left', align: 'center' },
                        { text: 'Insentif',  cellsformat: 'n', datafield: 'insentif', width: 120, cellsalign: 'right', align: 'center' },
                        { text: 'Potongan', cellsformat: 'n', datafield: 'potinsentif', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Diterima', cellsformat: 'n', datafield: 'terimainsentif', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Rekening', datafield: 'norek', width: 180, cellsalign: 'left', align: 'center' },
                    ]
                });
            } else if (setjenis == 'BPJS Kesehatan'){
                var sourcedetail = {
                    datatype: "json",
                    datafields: [
                        { name: 'nomer', type: 'text'},
                        { name: 'idne', type: 'text'},
                        { name: 'idpeg', type: 'text'},
                        { name: 'bulan', type: 'text'},
                        { name: 'tahun', type: 'text'},
                        { name: 'nip', type: 'text'},
                        { name: 'nama', type: 'text'},
                        { name: 'bank', type: 'text'},
                        { name: 'namapdbank', type: 'text'},
                        { name: 'norek', type: 'text'},									
                        { name: 'statpeg', type: 'text'},
                        { name: 'keterangan', type: 'text'},
                        { name: 'noangbpsjkes', type: 'text'},
                        { name: 'gajikotor', type: 'text'},									
                        { name: 'bpjskes', type: 'text'},									
                    ],
                    type: 'POST',
                    data: {	val01:set01, val02:set02, val03:setjenis, _token: token },
                    url: '{{route("detailgajisass")}}',
                };
                var datadetail = new $.jqx.dataAdapter(sourcedetail);
                $('#divdetail').show();
                $('#divawal').hide();
                $('#enteni').hide();
                $("#griddetailgaji").jqxGrid({
                    width: '100%',
                    source: datadetail,
                    columnsresize: true,
                    filterable: true,
                    showfilterrow: true,
                    theme: "energyblue",
                    autoheight: true,
                    autorowheight: false,
                    pageable: true,
                    altrows: true,
                    selectionmode: 'multiplecellsextended',
                    columns: [
                        { text: 'No', datafield: 'nomer', width: 40, cellsalign: 'left', align: 'center' },
                        { text: 'Nama', datafield: 'namapdbank', width: 200, cellsalign: 'left', align: 'center' },
                        { text: 'NIK', datafield: 'nip', width: 150, cellsalign: 'left', align: 'center' },
                        { text: 'Unit Kerja', datafield: 'keterangan', width: 150, cellsalign: 'left', align: 'center' },
                        { text: 'Gaji Kotor',  cellsformat: 'n', datafield: 'gajikotor', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'BPJS', cellsformat: 'n', datafield: 'bpjskes', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Bank', datafield: 'bank', width: 180, cellsalign: 'left', align: 'center' },
                        { text: 'Rekening', datafield: 'norek', width: 180, cellsalign: 'left', align: 'center' },
                        { text: 'No.Anggota', datafield: 'noangbpsjkes', width: 100, cellsalign: 'left', align: 'center' },
                    ]
                });
            } else if (setjenis == 'BPJS BPU'){
                var sourcedetail = {
                    datatype: "json",
                    datafields: [
                        { name: 'nomer', type: 'text'},
                        { name: 'idne', type: 'text'},
                        { name: 'idpeg', type: 'text'},
                        { name: 'bulan', type: 'text'},
                        { name: 'tahun', type: 'text'},
                        { name: 'nip', type: 'text'},
                        { name: 'nama', type: 'text'},
                        { name: 'bank', type: 'text'},
                        { name: 'namapdbank', type: 'text'},
                        { name: 'norek', type: 'text'},									
                        { name: 'statpeg', type: 'text'},
                        { name: 'keterangan', type: 'text'},
                        { name: 'gajikotor', type: 'text'},									
                        { name: 'bpjsbu', type: 'text'},
                        { name: 'iuranbpsjrsub', type: 'text'},
                        { name: 'noangbpsjrsub', type: 'text'},
                    ],
                    type: 'POST',
                    data: {	val01:set01, val02:set02, val03:setjenis, _token: token },
                    url: '{{route("detailgajisass")}}',
                };
                var datadetail = new $.jqx.dataAdapter(sourcedetail);
                $('#divdetail').show();
                $('#divawal').hide();
                $('#enteni').hide();
                $("#griddetailgaji").jqxGrid({
                    width: '100%',
                    source: datadetail,
                    columnsresize: true,
                    filterable: true,
                    showfilterrow: true,
                    theme: "energyblue",
                    autoheight: true,
                    autorowheight: false,
                    pageable: true,
                    altrows: true,
                    selectionmode: 'multiplecellsextended',
                    columns: [
                        { text: 'No', datafield: 'nomer', width: 40, cellsalign: 'left', align: 'center' },
                        { text: 'Nama', datafield: 'namapdbank', width: 200, cellsalign: 'left', align: 'center' },
                        { text: 'NIK', datafield: 'nip', width: 150, cellsalign: 'left', align: 'center' },
                        { text: 'Unit Kerja', datafield: 'keterangan', width: 150, cellsalign: 'left', align: 'center' },
                        { text: 'Gaji Kotor',  cellsformat: 'n', datafield: 'gajikotor', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Tagihan',  cellsformat: 'n', datafield: 'iuranbpsjrsub', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Pegawai',  cellsformat: 'n', datafield: 'bpjsbu', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'PNBP', cellsformat: 'n',  datafield: 'total', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Bank', datafield: 'bank', width: 180, cellsalign: 'left', align: 'center' },
                        { text: 'Rekening', datafield: 'norek', width: 180, cellsalign: 'left', align: 'center' },
                        { text: 'No.Anggota', datafield: 'noangbpsjrsub', width: 100, cellsalign: 'left', align: 'center' },
                    ]
                });
            } else if (setjenis == 'BPJS Ketenagakerjaan'){
                var sourcedetail = {
                    datatype: "json",
                    datafields: [
                        { name: 'nomer', type: 'text'},
                        { name: 'idne', type: 'text'},
                        { name: 'idpeg', type: 'text'},
                        { name: 'bulan', type: 'text'},
                        { name: 'tahun', type: 'text'},
                        { name: 'nip', type: 'text'},
                        { name: 'nama', type: 'text'},
                        { name: 'bank', type: 'text'},
                        { name: 'namapdbank', type: 'text'},
                        { name: 'norek', type: 'text'},
                        { name: 'noangbpsjket', type: 'text'},
                        { name: 'statpeg', type: 'text'},
                        { name: 'keterangan', type: 'text'},
                        { name: 'gajikotor', type: 'text'},
                        { name: 'upahjkn', type: 'text'},
                        { name: 'bayarjknket', type: 'text'},
                        { name: 'iuranjknket', type: 'text'},
                        { name: 'totaljknket', type: 'text'},
                    ],
                    type: 'POST',
                    data: {	val01:set01, val02:set02, val03:setjenis, _token: token },
                    url: '{{route("detailgajisass")}}',
                };
                var datadetail = new $.jqx.dataAdapter(sourcedetail);
                $('#divdetail').show();
                $('#divawal').hide();
                $('#enteni').hide();
                $("#griddetailgaji").jqxGrid({
                    width: '100%',
                    source: datadetail,
                    columnsresize: true,
                    filterable: true,
                    showfilterrow: true,
                    theme: "energyblue",
                    autoheight: true,
                    autorowheight: false,
                    pageable: true,
                    altrows: true,
                    selectionmode: 'multiplecellsextended',
                    columns: [
                        { text: 'No', datafield: 'nomer', width: 40, cellsalign: 'left', align: 'center' },
                        { text: 'Nama', datafield: 'namapdbank', width: 200, cellsalign: 'left', align: 'center' },
                        { text: 'NIK', datafield: 'nip', width: 150, cellsalign: 'left', align: 'center' },
                        { text: 'Unit Kerja', datafield: 'keterangan', width: 150, cellsalign: 'left', align: 'center' },
                        { text: 'Gaji Kotor', cellsformat: 'n', datafield: 'gajikotor', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Upah JKN', cellsformat: 'n', datafield: 'upahjkn', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Iuran JKN Pegawai (3%)',  cellsformat: 'n', datafield: 'bayarjknket', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Iuran JKN KP (PNBP 6.24%)',  cellsformat: 'n', datafield: 'iuranjknket', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Jumlah Iuran JKN',  cellsformat: 'n', datafield: 'totaljknket', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Bank', datafield: 'bank', width: 180, cellsalign: 'left', align: 'center' },
                        { text: 'Rekening', datafield: 'norek', width: 100, cellsalign: 'left', align: 'center' },
                        { text: 'No.Anggota', datafield: 'noangbpsjket', width: 80, cellsalign: 'left', align: 'center' },
                    ]
                });
            } else if (setjenis == 'Template Upah'){
                var sourcedetail = {
                    datatype: "json",
                    datafields: [
                        { name: 'nomer', type: 'text'},
                        { name: 'nik', type: 'text'},
                        { name: 'nip', type: 'text'},
                        { name: 'kpj', type: 'text'},
                        { name: 'kodetk', type: 'text'},
                        { name: 'nama', type: 'text'},
                        { name: 'tgllahir', type: 'text'},
                        { name: 'gajikotor', type: 'number'},
                        { name: 'rapel', type: 'text'},
                        { name: 'blth', type: 'text'},
                        { name: 'npp', type: 'text'},
                    ],
                    type: 'POST',
                    data: {	val01:set01, val02:set02, val03:setjenis, _token: token },
                    url: '{{route("detailgajisass")}}',
                };
                var datadetail = new $.jqx.dataAdapter(sourcedetail);
                $('#divdetail').show();
                $('#divawal').hide();
                $('#enteni').hide();
                $("#griddetailgaji").jqxGrid({
                    width: '100%',
                    source: datadetail,
                    columnsresize: true,
                    filterable: true,
                    showfilterrow: true,
                    theme: "energyblue",
                    autoheight: true,
                    autorowheight: false,
                    pageable: true,
                    altrows: true,
                    selectionmode: 'multiplecellsextended',
                    columns: [
                        { text: 'No', datafield: 'nomer', width: 40, cellsalign: 'left', align: 'center' },
                        { text: 'NIK', datafield: 'nik', width: 150, cellsalign: 'left', align: 'center' },
                        { text: 'NIK', datafield: 'nip', width: 150, cellsalign: 'left', align: 'center' },
                        { text: 'KPJ', datafield: 'kpj', width: 150, cellsalign: 'left', align: 'center' },
                        { text: 'KODETK', datafield: 'kodetk', width: 150, cellsalign: 'left', align: 'center' },
                        { text: 'Nama', datafield: 'namapdbank', width: 200, cellsalign: 'left', align: 'center' },								
                        { text: 'TGL.LAHIR', datafield: 'tgllahir', width: 100, cellsalign: 'left', align: 'center' },
                        { text: 'UPAH', cellsformat: 'n', datafield: 'gajikotor', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'RAPEL', cellsformat: 'n', datafield: 'rapel', width: 80, cellsalign: 'left', align: 'center' },
                        { text: 'BLN THN', datafield: 'blth', width: 100, cellsalign: 'left', align: 'center' },
                        { text: 'NPP', datafield: 'npp', width: 80, cellsalign: 'left', align: 'center' },
                    ]
                });
            } else {
                var sourcedetail = {
                    datatype: "json",
                    datafields: [
                        { name: 'nomer', type: 'text'},
                        { name: 'idne', type: 'text'},
                        { name: 'idpeg', type: 'text'},
                        { name: 'bulan', type: 'text'},
                        { name: 'tahun', type: 'text'},
                        { name: 'nip', type: 'text'},
                        { name: 'nama', type: 'text'},
                        { name: 'bank', type: 'text'},
                        { name: 'namapdbank', type: 'text'},
                        { name: 'kdgol', type: 'text'},
                        { name: 'norek', type: 'text'},
                        { name: 'statpeg', type: 'text'},
                        { name: 'sudahbyr', type: 'number'},
                        { name: 'belumbyr', type: 'number'},
                        { name: 'totalhtg', type: 'number'},
                        { name: 'nominal', type: 'number'},
                        { name: 'cicilanke', type: 'number'},
                    ],
                    type: 'POST',
                    data: {	val01:set01, val02:set02, val03:setjenis, _token: token },
                    url: '{{route("detailgajisass")}}',
                };
                var datadetail = new $.jqx.dataAdapter(sourcedetail);
                $('#divdetail').show();
                $('#divawal').hide();
                $('#enteni').hide();
                $("#griddetailgaji").jqxGrid({
                    width: '100%',
                    source: datadetail,
                    columnsresize: true,
                    filterable: true,
                    showfilterrow: true,
                    theme: "energyblue",
                    autoheight: true,
                    autorowheight: false,
                    pageable: true,
                    altrows: true,
                    selectionmode: 'multiplecellsextended',
                    columns: [
                        { text: 'No', datafield: 'nomer', width: 40, cellsalign: 'left', align: 'center' },
                        { text: 'NIP', datafield: 'nip', width: 180, cellsalign: 'left', align: 'center' },
                        { text: 'Nama', datafield: 'nama', width: 250, cellsalign: 'left', align: 'center' },
                        { text: 'Gol', datafield: 'kdgol', width: 40, cellsalign: 'left', align: 'center' },
                        { text: 'Bank', datafield: 'bank', width: 180, cellsalign: 'left', align: 'center' },
                        { text: 'Norek', datafield: 'norek', width: 180, cellsalign: 'left', align: 'center' },
                        { text: 'Cicilan Ke', datafield: 'cicilanke', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Jml Cicilan', datafield: 'totalhtg', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Sisa Cicilan', datafield: 'belumbyr', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Terbayar', cellsformat: 'n', datafield: 'sudahbyr', width: 80, cellsalign: 'right', align: 'center' },
                        { text: 'Nominal',  cellsformat: 'n', datafield: 'nominal', width: 100, cellsalign: 'right', align: 'center' },
                    ]
                });
            }
        });
        $('#btnhitungawal').click(function(){
            var set01   = document.getElementById('set_bulan').value;
            var set02   = document.getElementById('set_tahun').value;
            var setjenis= document.getElementById('set_jenisawal').value;
            var token   = document.getElementById('token').value;
            $('#enteni').show();
            $('#divinfo').hide();
            $('#divdetail').hide();
            var sourcedetail = {
                datatype: "json",
                datafields: [
                    { name: 'nomer', type: 'text'},
                    { name: 'idne', type: 'text'},
                    { name: 'idpeg', type: 'text'},
                    { name: 'bulan', type: 'text'},
                    { name: 'tahun', type: 'text'},
                    { name: 'nip', type: 'text'},
                    { name: 'nama', type: 'text'},
                    { name: 'bank', type: 'text'},
                    { name: 'namapdbank', type: 'text'},
                    { name: 'kdgol', type: 'text'},
                    { name: 'norek', type: 'text'},
                    { name: 'jenispeg', type: 'text'},
                    { name: 'statpeg', type: 'text'},
                    { name: 'kdkawin', type: 'text'},
                    { name: 'gapok', type: 'number'},
                    { name: 'sutri', type: 'number'},
                    { name: 'anak', type: 'number'},
                    { name: 'beras', type: 'number'},
                    { name: 'tjupns', type: 'number'},
                    { name: 'tjstruk', type: 'number'},
                    { name: 'tjfungs', type: 'number'},
                    { name: 'tjdaerah', type: 'number'},
                    { name: 'tjpencil', type: 'number'},
                    { name: 'tjkompen', type: 'number'},
                    { name: 'pembul', type: 'number'},
                    { name: 'tjpph', type: 'number'},
                    { name: 'tjlain', type: 'number'},
                    { name: 'tottunjangan', type: 'number'},
                    { name: 'gajikotor', type: 'number'},
                    { name: 'kpri', type: 'number'},
                    { name: 'korpri', type: 'number'},
                    { name: 'arisan', type: 'number'},
                    { name: 'idewe', type: 'number'},
                    { name: 'sumbangan', type: 'number'},
                    { name: 'potpfkbul', type: 'number'},
                    { name: 'potpfk2', type: 'number'},
                    { name: 'potpfk10', type: 'number'},
                    { name: 'potpph', type: 'number'},
                    { name: 'potswrum', type: 'number'},
                    { name: 'potkelbtj', type: 'number'},
                    { name: 'potlain', type: 'number'},
                    { name: 'pottabrum', type: 'number'},
                    { name: 'tabukp', type: 'number'},
                    { name: 'bpjsbu', type: 'number'},
                    { name: 'bpjsket', type: 'number'},
                    { name: 'bpjskes', type: 'number'},
                    { name: 'totpotongan', type: 'number'},
                    { name: 'pinjkpri', type: 'number'},
                    { name: 'pinjukp', type: 'number'},
                    { name: 'pinjbank', type: 'number'},
                    { name: 'totpinjaman', type: 'number'},
                    { name: 'totbayar', type: 'number'},
                    { name: 'hutang', type: 'number'},
                    { name: 'makan', type: 'number'},
                    { name: 'insentif', type: 'number'},
                    { name: 'honor', type: 'number'},
                    { name: 'tambahangaji', type: 'number'},
                ],
                type: 'POST',
                data: {	val01:set01, val02:set02, _token: token },
                url: '{{route("generatedataawal")}}',
            };
            var datadetail = new $.jqx.dataAdapter(sourcedetail);
            $('#enteni').hide();
            $('#divawal').show();
            $("#gridgaji").jqxGrid({
                width: '100%',
                source: datadetail,
                columnsresize: true,
                theme: "energyblue",
                filterable: true,
                showfilterrow: true,
                autoheight: true,
                pageable: true,
                altrows: true,
                selectionmode: 'multiplecellsextended',
                columns: [
                    { text: 'Tnp. Pinjaman', editable: false, sortable: false, filterable: false, align: 'center', columntype: 'button', width: 80, cellsrenderer: function () {
                        return "Cetak";
                        }, buttonclick: function (row) {		
                        editrow = row;	
                        var offset 		= $("#gridgaji").offset();
                        var dataRecord 	= $("#gridgaji").jqxGrid('getrowdata', editrow);
                        var set01		= dataRecord.idpeg;
                        var set02		= dataRecord.bulan;
                        var set03		= dataRecord.tahun;
                        var token   =   document.getElementById('token').value;
                        $.post('{{route("cetakslipgaji")}}', { val01: set01, val02: set02, val03: set03, _token: token },
                        function(data){		
                            var newWindow = window.open('', '', 'width=800, height=500'),
                                document = newWindow.document.open(),
                                        pageContent =
                                            '<!DOCTYPE html>\n' +
                                            '<html>\n' +
                                            '<head>\n' +
                                            '<meta charset="utf-8" />\n' +
                                            '<title>Sistem Informasi Gaji Pegawai</title>\n' +
                                            '</head>\n' +
                                            '<body>' + data + '</body>\n</html>';
                                document.write(pageContent);
                                document.close();
                                return false;
                            });						 
                        }
                    },
                    { text: 'Pinjaman Saja', editable: false, sortable: false, filterable: false, align: 'center', columntype: 'button', width: 80, cellsrenderer: function () {
                        return "Cetak";
                        }, buttonclick: function (row) {		
                        editrow = row;	
                        var offset 		= $("#gridgaji").offset();
                        var dataRecord 	= $("#gridgaji").jqxGrid('getrowdata', editrow);
                        var set01		= dataRecord.idpeg;
                        var set02		= dataRecord.bulan;
                        var set03		= dataRecord.tahun;
                        var token   =   document.getElementById('token').value;
                        $.post('{{route("cetakslipgajikpri")}}', { val01: set01, val02: set02, val03: set03, _token: token },
                        function(data){		
                            var newWindow = window.open('', '', 'width=800, height=500'),
                                document = newWindow.document.open(),
                                        pageContent =
                                            '<!DOCTYPE html>\n' +
                                            '<html>\n' +
                                            '<head>\n' +
                                            '<meta charset="utf-8" />\n' +
                                            '<title>Sistem Informasi Gaji Pegawai</title>\n' +
                                            '</head>\n' +
                                            '<body>' + data + '</body>\n</html>';
                                document.write(pageContent);
                                document.close();
                                return false;
                            });						 
                        }
                    },
                    { text: 'Slip Lengkap', editable: false, sortable: false, filterable: false, align: 'center', columntype: 'button', width: 80, cellsrenderer: function () {
                        return "Cetak";
                        }, buttonclick: function (row) {		
                        editrow = row;	
                        var offset 		= $("#gridgaji").offset();
                        var dataRecord 	= $("#gridgaji").jqxGrid('getrowdata', editrow);
                        var set01		= dataRecord.idpeg;
                        var set02		= dataRecord.bulan;
                        var set03		= dataRecord.tahun;
                        var token   =   document.getElementById('token').value;
                        $.post('{{route("cetakslipgajilengkap")}}', { val01: set01, val02: set02, val03: set03, _token: token },
                        function(data){		
                            var newWindow = window.open('', '', 'width=800, height=500'),
                                document = newWindow.document.open(),
                                        pageContent =
                                            '<!DOCTYPE html>\n' +
                                            '<html>\n' +
                                            '<head>\n' +
                                            '<meta charset="utf-8" />\n' +
                                            '<title>Sistem Informasi Gaji Pegawai</title>\n' +
                                            '</head>\n' +
                                            '<body>' + data + '</body>\n</html>';
                                document.write(pageContent);
                                document.close();
                                return false;
                            });						 
                        }
                    },
                    { text: 'Edit', columntype: 'button', editable: false, sortable: false, filterable: false, width: 80, align: 'center', cellsrenderer:function () {
                        return "SET";
                        }, buttonclick: function (row) {
                        editrow = row;	
                        var offset 		= $("#gridgaji").offset();
                        var dataRecord 	= $("#gridgaji").jqxGrid('getrowdata', editrow);
                        $("#edit_honor").val(dataRecord.honor);
                        $("#edit_idne").val(dataRecord.idne);
                        $("#edit_honor").val(dataRecord.honor);
                        $("#edit_tambahan").val(dataRecord.tambahangaji);
                        $("#edit_insentif").val(dataRecord.insentif);
                        $("#edit_jenis").val(dataRecord.jenispeg);
                        $("#edit_makan").val(dataRecord.makan);
                        $("#edit_nama").val(dataRecord.nama);
                        $("#edit_nip").val(dataRecord.nip);
                        $("#modaleditor").modal('show');
                        }
                    },
                    { text: 'No',  editable: false, sortable: false, filterable: false, datafield: 'nomer', width: 40, cellsalign: 'left', align: 'center' },
                    { text: 'Jenis Peg.', filtertype: 'checkedlist', datafield: 'jenispeg', width: 150, cellsalign: 'left', align: 'center' },
                    { text: 'NIK', datafield: 'nip', width: 150, cellsalign: 'left', align: 'center' },
                    { text: 'Nama', datafield: 'nama', width: 200, cellsalign: 'left', align: 'center' },
                    { text: 'Gol', filtertype: 'checkedlist', datafield: 'kdgol', width: 40, cellsalign: 'left', align: 'center' },
                    { text: 'Bank', filtertype: 'checkedlist',  datafield: 'bank', width: 120, cellsalign: 'left', align: 'center' },					
                    { text: 'No. Rekening', datafield: 'norek', width: 120, cellsalign: 'left', align: 'center' },
                    { text: 'Gaji Pokok', cellsformat: 'n', datafield: 'gapok', width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'Tunj.Suami/Istri', cellsformat: 'n', datafield: 'sutri', width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'Tunj.Anak', cellsformat: 'n', datafield: 'anak', width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'Tunj.Beras', cellsformat: 'n',  datafield: 'beras', width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'Tunj.UPNS', cellsformat: 'n', datafield: 'tjupns', width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'Tunj.Struktural', cellsformat: 'n', datafield: 'tjstruk', width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'Tunj.Fungsional', cellsformat: 'n', datafield: 'tjfungs', width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'Tunj.Daerah', cellsformat: 'n', datafield: 'tjdaerah', width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'Tunj.Terpencil', cellsformat: 'n', datafield: 'tjpencil', width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'Tunj.Kompen', cellsformat: 'n', datafield: 'tjkompen', width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'Pembulatan', cellsformat: 'n', datafield: 'pembul', width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'Tunj.PPH', cellsformat: 'n', datafield: 'tjpph', width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'Tunj.Lain', cellsformat: 'n', datafield: 'tjlain', width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'Total Tunjangan', cellsformat: 'n', datafield: 'tottunjangan', width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'Gaji Kotor', cellsformat: 'n', datafield: 'gajikotor', width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'Potongan S. WAJIB KPRI', cellsformat: 'n', datafield: 'kpri', width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'Tabungan UKP', cellsformat: 'n', datafield: 'tabukp',  width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'KORPRI', cellsformat: 'n', datafield: 'korpri',  width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'ARISAN', cellsformat: 'n', datafield: 'arisan',  width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'Dharma Wanita', cellsformat: 'n', datafield: 'idewe',  width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'Sumbangan', cellsformat: 'n', datafield: 'sumbangan',  width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'potpfkbul', cellsformat: 'n', datafield: 'potpfkbul',  width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'potpfk2', cellsformat: 'n', datafield: 'potpfk2',  width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'potpfk10', cellsformat: 'n', datafield: 'potpfk10',  width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'potpph', cellsformat: 'n', datafield: 'potpph',  width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'potswrum', cellsformat: 'n', datafield: 'potswrum',  width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'potkelbtj', cellsformat: 'n', datafield: 'potkelbtj',  width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'potlain', cellsformat: 'n', datafield: 'potlain',  width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'pottabrum', cellsformat: 'n', datafield: 'pottabrum',  width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'BPJS Kesehatan', cellsformat: 'n', datafield: 'bpjskes',  width: 80, cellsalign: 'right', align: 'center' },										
                    { text: 'BPJS RSUB', cellsformat: 'n', datafield: 'bpjsbu',  width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'BPJS Ketenagakerjaan', cellsformat: 'n', datafield: 'bpjsket',  width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'Total Potongan', cellsformat: 'n', datafield: 'totpotongan',  width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'KPRI', cellsformat: 'n', datafield: 'pinjkpri',  width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'UKP', cellsformat: 'n', datafield: 'pinjukp',  width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'BANK', cellsformat: 'n', datafield: 'pinjbank',  width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'Total Pinjaman', cellsformat: 'n', datafield: 'totpinjaman',  width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'Gaji Bersih', cellsformat: 'n', datafield: 'totbayar',  width: 80, cellsalign: 'right', align: 'center' },
                    { text: 'Total Hutang Gaji', cellsformat: 'n', datafield: 'hutang',  width: 80, cellsalign: 'right', align: 'center' },
                ]
            });
        });
        $('#btnhitungulang').click(function(){
            var set01		= document.getElementById('set_bulan').value;
            var set02		= document.getElementById('set_tahun').value;
            var setjenis	= document.getElementById('set_jenisawal').value;
            var token   	= document.getElementById('token').value;
            $('#enteni').show();
            $('#divdetail').hide();
            
            var sourcedetail = {
                datatype: "json",
                datafields: [
                    { name: 'nomer', type: 'text'},
                    { name: 'uraian', type: 'text'},
                    { name: 'pns', type: 'number'},
                    { name: 'pnpn', type: 'number'},
                    { name: 'kontrak', type: 'number'},
                    { name: 'jumlah', type: 'number'},
                ],
                type: 'POST',
                data: {	val01:set01, val02:set02, val03:setjenis, _token: token },
                url: '{{route("datajgajian")}}',
            };
            var datadetail = new $.jqx.dataAdapter(sourcedetail);
            $('#divdetail').show();
            $('#divawal').hide();
            $('#enteni').hide();
            $("#griddetailgaji").jqxGrid({
                width: '100%',
                source: datadetail,
                columnsresize: true,
                filterable: true,
                theme: "energyblue",
                autoheight: true,
                autorowheight: false,
                pageable: false,
                altrows: true,
                selectionmode: 'multiplecellsextended',
                columns: [
                    { text: 'No', datafield: 'nomer', width: '5%', cellsalign: 'left', align: 'center' },
                    { text: 'Uraian', datafield: 'uraian', width: '55%', cellsalign: 'left', align: 'center' },
                    { text: 'PNS', cellsformat: 'n', datafield: 'pns', width: '10%', cellsalign: 'right', align: 'center' },
                    { text: 'PNPN', cellsformat: 'n', datafield: 'pnpn', width: '10%', cellsalign: 'right', align: 'center' },
                    { text: 'KONTRAK',  cellsformat: 'n', datafield: 'kontrak', width: '10%', cellsalign: 'right', align: 'center' },
                    { text: 'JUMLAH', cellsformat: 'n', datafield: 'jumlah', width: '10%', cellsalign: 'right', align: 'center' },
                ]
            });
        });
    });
</script>
@endpush