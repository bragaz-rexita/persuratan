@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
        </div>
      </div>
    </div>
    <div class="content" >
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-cog"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Pegawai</span>
                            <span class="info-box-number btn" id="btnopenpegawai">{{$jumlahpegawai}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-4">
                        <div class="card card-primary shadow">
                            <div class="card-header">
                                <h3 class="card-title">Control</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
									<div class="row">
                                        <div class="col-md-6">
										    <label for="set_bulan">Bulan</label>
                                        	<select id="set_bulan" class="form-control">
                                                <option value="">Pilih Bulan Jadwal</option>
                                                <option value="01">Jan</option>
                                                <option value="02">Feb</option>
                                                <option value="03">Mar</option>
                                                <option value="04">Apr</option>
                                                <option value="05">May</option>
                                                <option value="06">Jun</option>
                                                <option value="07">Jul</option>
                                                <option value="08">Aug</option>
                                                <option value="09">Sep</option>
                                                <option value="10">Oct</option>
                                                <option value="11">Nov</option>
                                                <option value="12">Dec</option>
                                            </select>
										</div>
                                        <div class="col-md-6">
										    <label for="set_tahun">Tahun</label>
                                        	<input type="text" class="form-control" id="set_tahun" name="set_tahun" value="{{date('Y')}}"/>
										</div>
									</div>
								</div>
                            </div>
                            <div class="card-footer">
                                <div id="gridpegawai"></div>
                            </div>
                        </div>
                        <div class="card card-warning shadow">
                            <div class="card-header">
                                <h3 class="card-title">Laporan</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="report_mulai">Start</label>
                                            <input type="text" class="form-control" id="report_mulai" name="report_mulai" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="report_akhir">End</label>
                                            <input type="text" class="form-control" id="report_akhir" name="report_akhir" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-danger pull-left" id="btnlihatlaporan">Lihat Only</button>
                                <button type="button" class="btn btn-success pull-right" id="btngeneratelaporan">Hitung</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div id="loading" class="col-md-12">
                            <img src="{{ asset('loading.gif') }}" class="img-responsive" alt="Photo">
                        </div>
                        <div class="card card-warning divpegawai shadow">
                            <div class="card-header">
                                <h3 class="card-title">Database Pegawai</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" id="btntambahpegawai">
                                        <i class="fa fa-plus"></i> Tambah Data
                                    </button>
                                    <button type="button" class="btn btn-tool btnkembali">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="masterpegawai"></div>
                            </div>
                        </div>
                        <div class="card card-warning divlaporan shadow">
                            <div class="card-header">
                                <h3 class="card-title">Laporan</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool btnkembali">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="message"></div>
                            </div>
                        </div>
                        <div class="card card-info divawal">
                            <div class="card-header">
                                <h3 class="card-title">Workspace</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool divawal" id="btnexportdataawal">
                                        <i class="fa fa-print"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool divreport" id="btnexportdatareport">
                                        <i class="fa fa-print"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body divawal">
                                <div id="gridkerja"></div>
                            </div>
                            <form class="kt-form" id="form-data-upload" enctype="multipart/form-data">
							{{ csrf_field() }}
                            <div class="card-body divinputjadwal">
                                <div class="form-group row">
                                    <label for="id_nama" class="col-sm-4 col-form-label">Nama / Pin Finger <span class="text-danger">*</span>:</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="id_nama" name="id_nama" disabled="disable">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="id_pin" name="id_pin"  disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 1:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday01" name="id_sifday01" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday01" name="labelday01" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 2:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday02" name="id_sifday02" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday02" name="labelday02" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 3:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday03" name="id_sifday03" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday03" name="labelday03" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 4:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday04" name="id_sifday04" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday04" name="labelday04" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 5:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday05" name="id_sifday05" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday05" name="labelday05" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 6:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday06" name="id_sifday06" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday06" name="labelday06" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 7:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday07" name="id_sifday07" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday07" name="labelday07" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 8:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday08" name="id_sifday08" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday08" name="labelday08" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 9:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday09" name="id_sifday09" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday09" name="labelday09" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 10:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday10" name="id_sifday10" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday10" name="labelday10" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 11:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday11" name="id_sifday11" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday11" name="labelday11" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 12:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday12" name="id_sifday12" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday12" name="labelday12" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 13:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday13" name="id_sifday13" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday13" name="labelday13" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 14:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday14" name="id_sifday14" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday14" name="labelday14" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 15:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday15" name="id_sifday15" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday15" name="labelday15" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 16:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday16" name="id_sifday16" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday16" name="labelday16" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 17:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday17" name="id_sifday17" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday17" name="labelday17" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 18:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday18" name="id_sifday18" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday18" name="labelday18" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 19:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday19" name="id_sifday19" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday19" name="labelday19" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 20:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday20" name="id_sifday20" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday20" name="labelday20" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 21:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday21" name="id_sifday21" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday21" name="labelday21" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 22:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday22" name="id_sifday22" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday22" name="labelday22" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 23:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday23" name="id_sifday23" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday23" name="labelday23" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 24:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday24" name="id_sifday24" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday24" name="labelday24" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 25:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday25" name="id_sifday25" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday25" name="labelday25" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 26:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday26" name="id_sifday26" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday26" name="labelday26" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 27:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday27" name="id_sifday27" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday27" name="labelday27" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 28:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday28" name="id_sifday28" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday28" name="labelday28" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 29:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday29" name="id_sifday29" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday29" name="labelday29" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 30:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday30" name="id_sifday30" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday30" name="labelday30" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 31:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday31" name="id_sifday01" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday31" name="labelday31" disabled="disable">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Day 32:</label>
                                    <div class="col-sm-4">
                                        <select id="id_sifday32" name="id_sifday32" class="form-control">
                                            <option value="06:30-14:00">Sif Pagi (06:30-14:00)</option>
                                            <option value="14:00-21:00">Sif Siang (14:00-21:00)</option>
                                            <option value="21:00-07:00">Sif Malang (21:00-07:00)</option>
                                            <option value="10:00-18:00">Middle Sif (10:00-18:00)</option>
                                            <option value="08:00-16:00">Non Sif (08:00-16:00)</option>
                                            <option value="03:00-12:00">Sif Pagi Dapur (03:00-12:00)</option>
                                            <option value="06:00-15:00">Sif Siang Dapur (06:00-15:00)</option>
                                            <option value="09:00-18:00">Middle Sif Dapur (09:00-18:00)</option>
                                            <option value="12:00-20:00">Middle Pantry (12:00-20:00)</option>
                                            <option value="07:00-15:00">Middle Sif 2 (07:00-15:00)</option>
                                            <option value="09:00-17:00">Middle Sif 3 (09:00-17:00)</option>
                                            <option value="09:00-17:00">Pagi QC (09:00-17:00)</option>
                                            <option value="OFF">Libur</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="labelday32" name="labelday32" disabled="disable">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer divinputjadwal">
                                <button type="button" class="btn btn-danger pull-left btnkembali">Cancel</button>
								<button type="button" class="btn btn-success pull-right" id="btnsimpansuratpertemplate">Simpan</button>
                            </div>
                            </form>
                            <div class="card-body divreport">
                                <div id="gridreport"></div>
                            </div>
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
<div class="modal fade" id="modalubahpegawai">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Change Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="spv_nama">Nama</label>
                    <input type="text" id="spv_nama" name="spv_nama" class="form-control" />
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="spv_nomor">PIN Finger</label>
                            <input type="text" id="spv_nomor" name="spv_nomor" class="form-control" />
                        </div>
                        <div class="col-lg-8">
                            <label for="spv_asalpeserta">Unit Kerja</label>
                            <input type="text" id="spv_asalpeserta" name="spv_asalpeserta" class="form-control" disabled="disable" />
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" id="spv_id" name="spv_id" />
                <button type="button" class="btn btn-success pull-left" id="btnubahspv">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>	
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="setiddesa" id="setiddesa" value="new">
@endsection
@push('script')
<script type="text/javascript">
    $(function () {
        $('.select2').select2({width: '100%'});
        $('#report_mulai').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#report_akhir').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
    });
    $(document).ready(function() {
        $('#loading').hide();
        $('.divpegawai').hide();
        $('.divlaporan').hide();
        $('.divreport').hide();
        $('.divinputjadwal').hide();
        $('.divawal').show();
        $('#btnopenpegawai').click(function () {
            $('.divpegawai').show();
            $('.divlaporan').hide();
            $('.divreport').hide();
            $('.divinputjadwal').hide();
            $('.divawal').hide();
        });
        $('#btntambahpegawai').click(function () {
            $('#spv_id').val('new');
            $("#modalubahpegawai").modal('show');
        });
        $("#btnubahspv").click(function(){
                var set01 = document.getElementById('spv_nama').value;
                var set02 = document.getElementById('spv_nomor').value;
                var set03 = document.getElementById('spv_asalpeserta').value;
                var set04 = document.getElementById('spv_id').value;
                if (set01 == '' || set02 == '' || set03 == ''){
                    swal({
                        title	: 'Stop',
                        text	: 'Mohon Lengkap Form Anda',
                        type	: 'warning',
                    })
                } else {
                    var form_data = new FormData();
                        form_data.append('set01', set01);
                        form_data.append('set02', set02);
                        form_data.append('set03', set03);
                        form_data.append('set04', set04);
                        form_data.append('file', null);
                        form_data.append('_token', '{{csrf_token()}}');
                    $("#modalubahspv").modal('hide');
                    $.ajax({
                        url         : '{{ route("exInputPegawai") }}',
                        data        : form_data,
                        type        : 'POST',
                        contentType : false,
                        processData : false,
                        success     : function (data) {
                            $.toast({
                                heading: 'Info',
                                text: data,
                                position: 'top-right',
                                loaderBg: '#bf441d',
                                icon: 'success',
                                hideAfter: 5000,
                                stack: 1
                            });
                            $("#gridlistcase").jqxGrid('updatebounddata', 'filter');
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
        $('#btnlihatlaporan').click(function () {
            var set01=document.getElementById('report_mulai').value;
            var set02=document.getElementById('report_akhir').value;
            if (set01 == '' || set02 == ''){
                swal({
                    title   : 'Perhatian',
                    text    : 'Tanggal Mulai dan Akhir Laporan Wajib di Isi',
                    type    : 'error',
                })
            } else {
                var token=document.getElementById('token').value;
                $('.divawal').hide();
                $('#divreport').show();
                $('#loading').show();
                var source = {
                    datatype: "json",
                    datafields: [
                        { name: 'pegawai_pin',type: 'number'},	
                        { name: 'pegawai_nip',type: 'string'},
                        { name: 'nomor_telp',type: 'string'},
                        { name: 'status',type: 'string'},	
                        { name: 'nama',type: 'string'},
                        { name: 'kerja',type: 'string'},
                        { name: 'libur',type: 'string'},
                        { name: 'terlambat',type: 'string'},
                        { name: 'tepatwaktu',type: 'string'},
                        { name: 'totalketerlambaran',type: 'string'},
                    ],
                    type: 'POST',
                    data: {val01: set01, val02: set02, val03: 'view', _token: token},
                    url : '{{ route("jsonLaporan") }}',
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                $("#gridreport").jqxGrid({
                    width           : '100%',
                    pageable        : true,
                    autoheight      : true,
                    filterable      : true,
                    source          : dataAdapter,
                    sortable        : true,
                    columnsresize   : true,
                    showfilterrow   : true,
                    theme           : "energyblue",
                    selectionmode   : 'singlecells',
                    altrows         : true,
                    columns         : [
                        { text: 'Nama', datafield: 'nama', width: '20%', cellsalign: 'left', align: 'center'  },
                        { text: 'Unitkerja', datafield: 'nomor_telp', width: '20%', cellsalign: 'left', align: 'center'  },
                        { text: 'PIN', datafield: 'pegawai_pin', width: '10%', cellsalign: 'center', align: 'center'  },
                        { text: 'Hari Kerja', datafield: 'kerja', width: '10%', cellsalign: 'center', align: 'center'  },
                        { text: 'Sif Off', datafield: 'libur', width: '10%', cellsalign: 'center', align: 'center'  },
                        { text: 'Telat (hari)', datafield: 'terlambat', width: '10%', cellsalign: 'center', align: 'center'  },
                        { text: 'Tepat Waktu (hari)', datafield: 'tepatwaktu', width: '10%', cellsalign: 'center', align: 'center'  },
                        { text: 'Total Keterlambatan', datafield: 'totalketerlambaran', width: '10%', cellsalign: 'right', align: 'center'  },
                    ]
                });
                $('#loading').hide();
            }
        });
        $('#btngeneratelaporan').click(function () {
            var set01=document.getElementById('report_mulai').value;
            var set02=document.getElementById('report_akhir').value;
            if (set01 == '' || set02 == ''){
                swal({
                    title   : 'Perhatian',
                    text    : 'Tanggal Mulai dan Akhir Laporan Wajib di Isi',
                    type    : 'error',
                })
            } else {
                var token=document.getElementById('token').value;
                $('.divawal').hide();
                $('#divreport').show();
                $('#loading').show();
                var source = {
                    datatype: "json",
                    datafields: [
                        { name: 'pegawai_pin',type: 'number'},	
                        { name: 'pegawai_nip',type: 'string'},
                        { name: 'nomor_telp',type: 'string'},
                        { name: 'status',type: 'string'},	
                        { name: 'nama',type: 'string'},
                        { name: 'kerja',type: 'string'},
                        { name: 'libur',type: 'string'},
                        { name: 'terlambat',type: 'string'},
                        { name: 'tepatwaktu',type: 'string'},
                        { name: 'totalketerlambaran',type: 'string'},
                    ],
                    type: 'POST',
                    data: {val01: set01, val02: set02, val03: 'hitung', _token: token},
                    url : '{{ route("jsonLaporan") }}',
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                $("#gridreport").jqxGrid({
                    width           : '100%',
                    pageable        : true,
                    autoheight      : true,
                    filterable      : true,
                    source          : dataAdapter,
                    sortable        : true,
                    columnsresize   : true,
                    showfilterrow   : true,
                    theme           : "energyblue",
                    selectionmode   : 'singlecells',
                    altrows         : true,
                    columns         : [
                        { text: 'Nama', datafield: 'nama', width: '20%', cellsalign: 'left', align: 'center'  },
                        { text: 'Unitkerja', datafield: 'nomor_telp', width: '20%', cellsalign: 'left', align: 'center'  },
                        { text: 'PIN', datafield: 'pegawai_pin', width: '10%', cellsalign: 'center', align: 'center'  },
                        { text: 'Hari Kerja', datafield: 'kerja', width: '10%', cellsalign: 'center', align: 'center'  },
                        { text: 'Sif Off', datafield: 'libur', width: '10%', cellsalign: 'center', align: 'center'  },
                        { text: 'Telat (hari)', datafield: 'terlambat', width: '10%', cellsalign: 'center', align: 'center'  },
                        { text: 'Tepat Waktu (hari)', datafield: 'tepatwaktu', width: '10%', cellsalign: 'center', align: 'center'  },
                        { text: 'Total Keterlambatan', datafield: 'totalketerlambaran', width: '10%', cellsalign: 'right', align: 'center'  },
                    ]
                });
                $('#loading').hide();
            }
        });
        $("#btnsimpansuratpertemplate").click(function(){
            $('#loading').show();
            $("html, body").animate({ scrollTop: 0 }, "slow");
            var formdata 	= new FormData($('#form-data-upload')[0]);
                formdata.append('_token', '{{csrf_token()}}');
            $.ajax({
                url	            : '{{ route("exSimpanJadwal") }}',
                data            : formdata,
                type            : 'POST',
                contentType     : false,
                processData     : false,
                success: function (data) {
                    $('#message').html(data);
                    $('.divreport').hide();
                    $('.divawal').hide();
                    $('.divinputjadwal').hide();
                    $('.divlaporan').show();
                    $('#loading').hide();
                    return false;
                },
                error: function (xhr, status, error) {
                    $('#loading').hide();
                    swal({
                        title	: 'Stop',
                        text	: xhr.responseText,
                        type	: 'error',
                    })
                }
            });
        });
        $(".btnkembali").click(function () {
            $('.divpegawai').hide();
            $('.divreport').hide();
            $('.divinputjadwal').hide();
            $('.divawal').show();
            $('.divlaporan').hide();
        });
        $("#btnexportdataawal").click(function () {
            var gridContent = $("#gridkerja").jqxGrid('exportdata', 'html');	
            var newWindow   = window.open('', '', 'width=640, height=500'),
                document 	= newWindow.document.open(),
                pageContent =
                    '<!DOCTYPE html>\n' +
                    '<html>\n' +
                    '<head>\n' +
                    '<meta charset="utf-8" />\n' +
                    '<title>REPORT</title>\n' +
                    '</head>\n' +
                    '<body>' + gridContent + '</body>\n</html>';
                document.write(pageContent);
                document.close();
        });
        $("#btnexportdatareport").click(function () {
            var gridContent = $("#gridreport").jqxGrid('exportdata', 'html');	
            var newWindow   = window.open('', '', 'width=640, height=500'),
                document 	= newWindow.document.open(),
                pageContent =
                    '<!DOCTYPE html>\n' +
                    '<html>\n' +
                    '<head>\n' +
                    '<meta charset="utf-8" />\n' +
                    '<title>REPORT</title>\n' +
                    '</head>\n' +
                    '<body>' + gridContent + '</body>\n</html>';
                document.write(pageContent);
                document.close();
        });
        var sourcedesa = {
            datatype    : "json",
            datafields  : [
                { name: 'pegawai_pin',type: 'number'},	
                { name: 'pegawai_nip',type: 'string'},
                { name: 'nomor_telp',type: 'string'},
                { name: 'status',type: 'string'},	
                { name: 'nama',type: 'string'},
            ],
            updaterow   : function (rowid, rowdata, commit) {commit(true);},
            url         : '{{ route("jsonPegawai") }}',
            
        };
        var datajDesa = new $.jqx.dataAdapter(sourcedesa);
        $("#gridpegawai").jqxGrid({
            width           : '100%',
            filterable      : true,
            columnsresize   : true,
            showfilterrow   : true,
            sortable        : true,
            autoheight      : true,
            pageable        : true,
            source          : datajDesa,
            altrows         : true,
            theme           : "energyblue",
            columns: [
                { text: 'Nama', datafield: 'nama', width: '65%', align: 'center' },
                { text: 'Pin', datafield: 'pegawai_pin', width: '20%', align: 'center' },
                { text: 'Jadwal', editable: false, sortable: false, filterable: false, columntype: 'button', width: '15%', cellsrenderer: function () {
                    return "Buat";
                    }, buttonclick: function (row) {
                        editrow = row;	
                        var offset 		= $("#gridpegawai").offset();		
                        var dataRecord 	= $("#gridpegawai").jqxGrid('getrowdata', editrow);
                        var set01       = document.getElementById('set_bulan').value;
                        var set02       = document.getElementById('set_tahun').value;
                        if (set01 == '' || set02 == ''){
                            swal({
                                title	: 'Stop',
                                text	: 'Mohon Set Bulan dan Tahun Terlebih dahulu',
                                type	: 'warning',
                            })
                        } else {
                            $.post('{{ route("getvalpegAbsen") }}', { val01: dataRecord.pegawai_pin, val02: set01, val03: set02, _token: '{{ csrf_token() }}' },function(data){
                                $("#id_nama").val(dataRecord.nama);
                                $("#id_pin").val(dataRecord.pegawai_pin);
                                $("#id_sifday01").val(data.sifday01);
                                $("#id_sifday02").val(data.sifday02);
                                $("#id_sifday03").val(data.sifday03);
                                $("#id_sifday04").val(data.sifday04);
                                $("#id_sifday05").val(data.sifday05);
                                $("#id_sifday06").val(data.sifday06);
                                $("#id_sifday07").val(data.sifday07);
                                $("#id_sifday08").val(data.sifday08);
                                $("#id_sifday09").val(data.sifday09);
                                $("#id_sifday10").val(data.sifday10);
                                $("#id_sifday11").val(data.sifday11);
                                $("#id_sifday12").val(data.sifday12);
                                $("#id_sifday13").val(data.sifday13);
                                $("#id_sifday14").val(data.sifday14);
                                $("#id_sifday15").val(data.sifday15);
                                $("#id_sifday16").val(data.sifday16);
                                $("#id_sifday17").val(data.sifday17);
                                $("#id_sifday18").val(data.sifday18);
                                $("#id_sifday19").val(data.sifday19);
                                $("#id_sifday20").val(data.sifday20);
                                $("#id_sifday21").val(data.sifday21);
                                $("#id_sifday22").val(data.sifday22);
                                $("#id_sifday23").val(data.sifday23);
                                $("#id_sifday24").val(data.sifday24);
                                $("#id_sifday25").val(data.sifday25);
                                $("#id_sifday26").val(data.sifday26);
                                $("#id_sifday27").val(data.sifday27);
                                $("#id_sifday28").val(data.sifday28);
                                $("#id_sifday29").val(data.sifday29);
                                $("#id_sifday30").val(data.sifday30);
                                $("#id_sifday31").val(data.sifday31);
                                $("#id_sifday32").val(data.sifday32);
                                $("#labelday01").val(data.labelday01);
                                $("#labelday02").val(data.labelday02);
                                $("#labelday03").val(data.labelday03);
                                $("#labelday04").val(data.labelday04);
                                $("#labelday05").val(data.labelday05);
                                $("#labelday06").val(data.labelday06);
                                $("#labelday07").val(data.labelday07);
                                $("#labelday08").val(data.labelday08);
                                $("#labelday09").val(data.labelday09);
                                $("#labelday10").val(data.labelday10);
                                $("#labelday11").val(data.labelday11);
                                $("#labelday12").val(data.labelday12);
                                $("#labelday13").val(data.labelday13);
                                $("#labelday14").val(data.labelday14);
                                $("#labelday15").val(data.labelday15);
                                $("#labelday16").val(data.labelday16);
                                $("#labelday17").val(data.labelday17);
                                $("#labelday18").val(data.labelday18);
                                $("#labelday19").val(data.labelday19);
                                $("#labelday20").val(data.labelday20);
                                $("#labelday21").val(data.labelday21);
                                $("#labelday22").val(data.labelday22);
                                $("#labelday23").val(data.labelday23);
                                $("#labelday24").val(data.labelday24);
                                $("#labelday25").val(data.labelday25);
                                $("#labelday26").val(data.labelday26);
                                $("#labelday27").val(data.labelday27);
                                $("#labelday28").val(data.labelday28);
                                $("#labelday29").val(data.labelday29);
                                $("#labelday30").val(data.labelday30);
                                $("#labelday31").val(data.labelday31);
                                $("#labelday32").val(data.labelday32);
                                $('.divpegawai').hide();
                                $('.divlaporan').hide();
                                $('.divreport').hide();
                                $('.divinputjadwal').show();
                                
                            });
                        }
                        
                    }
                },
            ],                
        });
        $("#masterpegawai").jqxGrid({
            width           : '100%',
            filterable      : true,
            columnsresize   : true,
            showfilterrow   : true,
            sortable        : true,
            autoheight      : true,
            pageable        : true,
            source          : datajDesa,
            altrows         : true,
            theme           : "energyblue",
            columns: [
                { text: 'Select', columntype: 'button', width: '7%', editable: false, sortable: false, filterable: false, cellsrenderer: function () { return "Select";
                    }, buttonclick: function (row) {
                        editrow             = row;
                        var offset 		    = $("#masterpegawai").offset();
                        var dataRecord 	    = $("#masterpegawai").jqxGrid('getrowdata', editrow);
                        $('#spv_nama').val(dataRecord.nama);
                        $('#spv_nomor').val(dataRecord.pegawai_pin);
                        $('#spv_asalpeserta').val(dataRecord.nomor_telp);
                        $('#spv_id').val(dataRecord.pegawai_pin);
                        $("#modalubahpegawai").modal('show');
                    }
                },
                { text: 'Nama', datafield: 'nama', width: '30%', align: 'center' },
                { text: 'Pin', datafield: 'pegawai_pin', width: '20%', align: 'center' },
                { text: 'Unit Kerja', datafield: 'nomor_telp', width: '30%', align: 'center' },
            ],                
        });
    });
</script>
@endpush