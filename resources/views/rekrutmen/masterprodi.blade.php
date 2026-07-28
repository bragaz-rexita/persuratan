@extends('adminlte3.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6"><h1>Setting Formasi</h1></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                          <li class="breadcrumb-item active">Formasi</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="row" id="divfrontpage">
                <div class="col-md-3">
                    <a href="#" class="btn btn-primary btn-block mb-3" id="btnopennew">Open New</a>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Folders</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <ul class="nav nav-pills flex-column">
                              <li class="nav-item active"><a href="#" class="nav-link" id="btnaktifonly"><i class="fa fa-inbox"></i> Active<span class="badge bg-primary float-right">{{$aktif}}</span></a></li>
                              <li class="nav-item"><a href="#" class="nav-link" id="btnarsip"><i class="fa fa-envelope"></i> Arsip<span class="badge bg-primary float-right">{{$arsip}}</span></a></li>
                              <li class="nav-item"><a href="#" class="nav-link" id="btnsetting"><i class="fa fa-gears"></i> Setting Ujian</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card card-primary card-outline" id="divawal">
                        <div class="card-header">
                            <h3 class="card-title">Workarea</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="Search data" id="main_valcari">
                                    <div class="input-group-append"><div class="btn btn-primary" id="btn-search"><i class="fa fa-search"></i></div></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive mailbox-messages">
                                <table class="table table-striped projects" id="table_list">
                                    <thead><tr><th style="width: 1%">#</th><th style="width: 8%" class="text-center">Action</th><th style="width: 31%" class="text-center">Formasi</th><th style="width: 40%" class="text-center">Keterangan</th></tr></thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card card-success card-outline" id="diveditor">
                        <div class="card-header">
                            <h3 class="card-title">Add/Edit/Remove</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnkembali"><i class="fa fa-close"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="edit_namaps">Unit Kerja</label>
                                        <select id="edit_namaps" name="edit_namaps" class="form-control select2">
                                            <option value=""></option>
                                            @if(isset($arrsdomain) AND !empty($arrsdomain))
                                                @foreach($arrsdomain as $rdomain)
                                                    <option value="{{ $rdomain->subsubdomainapps }}">{{ $rdomain->subsubdomainapps }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="edit_jenjang">Jabatan</label>
                                        <select id="edit_jenjang" size="1" class="form-control select2">
                                            @if(isset($arralljabatan) AND !empty($arralljabatan))
                                                @foreach($arralljabatan as $rjbt)
                                                    <option value="{{ $rjbt->jabatan }}">{{ $rjbt->jabatan }}</option>
                                                @endforeach
                                            @endif
                                            @if(isset($arrjabatan) AND !empty($arrjabatan))
                                                @foreach($arrjabatan as $rjbt)
                                                    <option value="{{ $rjbt->pejabat }}">{{ $rjbt->pejabat }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Kebutuhan / Formasi (Angka)</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-users"></i></span></div>
                                            <input type="text" id="edit_idpejabat" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Status</label>
                                        <select id="edit_kodeps" size="1" class="form-control">
                                            <option value="aktif">Aktif</option>
                                            <option value="arsip">Non Aktif</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Pendaftaran Mulai</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                                            <input type="text" id="edit_tanggalberdiri" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Sampai Tanggal</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                                            <input type="text" id="edit_tanggalijin" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Keterangan (Maks. 255 Karakter)</label>
                                <textarea id="id_namaenglish" name="id_namaenglish"></textarea>
                            </div>
                        </div>
                        <div class="card-footer justify-content-between">
                            <input type="hidden" id="edit_idne">
                            <button class="btn btn-success pull-left" type="button" id="btnupdatedataps">Simpan</button>
                            <button class="btn btn-danger pull-right" type="button" id="btndelete">Hapus</button>
                            <button class="btn btn-warning pull-left btnkembali" type="button">Batal</button>
                        </div>
                    </div>
                    <div class="card card-info card-outline" id="divberkas">
                        <div class="card-header">
                            <h3 class="card-title">Add/Edit/Remove Persyaratan</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnkembali"><i class="fa fa-close"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama File</label>
                                <input type="text" id="berkas_nama" class="form-control" />
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Status</label>
                                        <select id="berkas_wajib" size="1" class="form-control">
                                            <option value="Wajib">Wajib</option>
                                            <option value="Tidak Wajib">Tidak Wajib</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Format File (Bila Perlu)</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="berkas_file">
                                            <label class="custom-file-label" for="berkas_file">File Format (Bila Ada)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group justify-content-between">
                                <input type="hidden" id="berkas_idne">
                                <button class="btn btn-success pull-left" type="button" id="btnsimpanberkas">Simpan</button>
                                <button class="btn btn-danger btnkembali pull-right" type="button">Batal</button>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div id="accordion">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h4 class="card-title w-100"><a class="d-block w-100" data-toggle="collapse" href="#collapseOne">Berkas Yang di Persyaratkan</a></h4>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                        <div class="card-body">
                                            <div id="gridberkas"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-danger">
                                    <div class="card-header">
                                        <h4 class="card-title w-100"><a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">Soal-Soal Ujian</a></h4>
                                    </div>
                                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                        <div class="card-body" id="accordiondivrekapsoal">
                                            <button type="button" class="btn btn-info" id="btnaddsoal"><i class="fa fa-plus"></i> Show Case List</button>
                                            <div id="gridrekapsoal"></div>
                                        </div>
                                        <div class="card-footer" id="accordiondivaddsoal">
                                            <div id="gridsoal"></div>
                                        </div>
                                        <div class="card-footer" id="accordiondivviewsoal">
                                            <button type="button" class="btn btn-danger" id="btncloseviewsoal"><i class="fa fa-close"></i> Close Case List</button>
                                            <div id="gridviewsoal"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h4 class="card-title w-100"><a class="d-block w-100" data-toggle="collapse" href="#collapseThree">Jadwal Ujian Kompetensi</a></h4>
                                    </div>
                                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <textarea id="id_jadwalujian" name="id_jadwalujian"></textarea>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="button" class="btn btn-danger" id="btnsimpanjadwalujian"><i class="fa fa-save"></i> Simpan</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-warning">
                                    <div class="card-header">
                                        <h4 class="card-title w-100"><a class="d-block w-100" data-toggle="collapse" href="#collapseFour">Jadwal Wawancara</a></h4>
                                    </div>
                                    <div id="collapseFour" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <textarea id="id_jadwalwawancara" name="id_jadwalwawancara"></textarea>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="button" class="btn btn-danger" id="btnsimpanjadwalwawancara"><i class="fa fa-save"></i> Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-warning card-outline" id="divsetting">
                        <div class="card-header">
                            <h3 class="card-title">Setting</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnkembali"><i class="fa fa-close"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="gridsetting"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="divpeminat">
                <div class="col-md-12" id="tabelpeminat">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" id="judulpeminat">Peminat</h3>
                            <div class="card-tools">
                              <button type="button" class="btn btn-tool" id="btnexport"><i class="fa fa-print"></i> Export</button>
                              <button type="button" class="btn btn-tool btnkembali"><i class="fa fa-close"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="gridpeminat"></div>
                        </div>
                    </div>
                </div>
                <div id="tabelverifikasi">
                    <div class="card card-solid">
                        <div class="card-header">
                            <h3 class="card-title">Profil</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-tool kembaliketabelpeminat"><i class="fa fa-close"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <h3 class="d-inline-block d-sm-none org_nama">.</h3>
                                    <div class="col-12">
                                    <img src="boxed-bg.png" class="product-image" alt="Profil Image" id="profilimage">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-8">
                                    <h3 class="my-3 org_nama">.</h3>
                                    <div id="org_deskripsi"></div>
                                    <button type="button" class="btn btn-danger pull-left" id="btnverifikasibiodata">Verifikasi Final</button>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <nav class="w-100">
                                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Berkas Upload</a>
                                        <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Riwayat Pendidikan</a>
                                        <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Riwayat Kerja</a>
                                        <a class="nav-item nav-link" id="product-keluarga-tab" data-toggle="tab" href="#product-keluarga" role="tab" aria-controls="product-keluarga" aria-selected="false">Riwayat Keluarga</a>
                                        <a class="nav-item nav-link" id="product-diklat-tab" data-toggle="tab" href="#product-diklat" role="tab" aria-controls="product-diklat" aria-selected="false">Riwayat Diklat / Kursus / Pelatihan</a>
                                        <a class="nav-item nav-link" id="product-penghargaan-tab" data-toggle="tab" href="#product-penghargaan" role="tab" aria-controls="product-penghargaan" aria-selected="false">Riwayat Penghargaan</a>
                                        <a class="nav-item nav-link" id="product-teskesehatan-tab" data-toggle="tab" href="#product-teskesehatan" role="tab" aria-controls="product-penghargaan" aria-selected="false">Tes Kesehatan</a>
                                    </div>
                                </nav>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="tab-content p-3" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
                                    <div id="gridonline"></div>
                                </div>
                                <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab">
                                    <div id="gridpendidikan"></div>
                                </div>
                                <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab">
                                    <div id="gridorganisasi"></div>
                                </div>
                                <div class="tab-pane fade" id="product-keluarga" role="tabpanel" aria-labelledby="product-keluarga-tab">
                                    <div id="gridkeluarga"></div>
                                </div>
                                <div class="tab-pane fade" id="product-diklat" role="tabpanel" aria-labelledby="product-diklat-tab">
                                    <div id="griddiklat"></div>
                                </div>
                                <div class="tab-pane fade" id="product-penghargaan" role="tabpanel" aria-labelledby="product-penghargaan-tab">
                                    <div id="gridpenghargaan"></div>
                                </div>
                                <div class="tab-pane fade" id="product-teskesehatan" role="tabpanel" aria-labelledby="product-teskesehatan-tab">
                                    <div id="grididentitas"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div id="tempatctk" style="overflow: hidden; display: none;">
    </div>
    <div class="modal fade" id="modalverifikasi">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Verifikasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-4">
                                <label>Jenis</label>
                                <input type="text" class="form-control" id="out_jenis" readonly="readonly">
                            </div>
                            <div class="col-lg-8">
                                <label>Hal</label>
                                <input type="text" class="form-control" id="out_perihal" readonly="readonly">
                            </div>	
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="out_status">Status:</label>
                        <select id="out_status" name="out_status" size="1" class="form-control">
                                <option value="">Verifikasi Berkas Belum Ada</option>
                                <option value="Terverifikasi">Berkas Lamaran Terverifikasi</option>
                                <option value="Diterima">Pelamar di Terima (Isi URL SK Pegawai di keterangan)</option>
                                <option value="Lain">Lain-lain (Tulis di Keterangan)</option>
                            </select>
                        </div>
                    <div class="form-group">
                        <label for="out_keterangan">Keterangan:</label>
                        <textarea id="out_keterangan" name="out_keterangan"></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="hidden" class="form-control" id="out_idsurat">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-success" id="btnsimpanverifikasitext">Simpan</button>	
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <input type="hidden" name="set_jenis" id="set_jenis" value="aktif">
    <input type="hidden" name="set_idpeg" id="set_idpeg" value="0">
@endsection
@push('script')
<script type="text/javascript">
    $(function () {
      $('#edit_tanggalberdiri').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
      $('#edit_tanggalijin').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
      $('#table_list tbody').on('click', '.btnubah', function () {
          id = $(this).data("id");
          $("#edit_idne").val(id);
          var token 	= document.getElementById('token').value;
          $.post('{{ route("getFirstPengumuman") }}', { val01: id, _token: token },
              function(data){
              var namaenglish = data.namaenglish; 
              var nosk        = data.nosk; 
              var jenjang     = data.jenjang;
              var idpejabat   = data.idpejabat;
              var kodeps      = data.kodeps; 
              var tanggal     = data.tanggal; 
              var tglskijin   = data.tglskijin; 
              $("#edit_namaps").val(nosk).select2().trigger('change');
              $("#edit_jenjang").val(jenjang).select2().trigger('change');
              $("#edit_idpejabat").val(idpejabat);
              $("#edit_kodeps").val(kodeps);
              $("#edit_tanggalberdiri").val(tanggal);
              $("#edit_tanggalijin").val(tglskijin);
              $('#id_namaenglish').summernote('code', namaenglish);
              $('#divawal').hide();
              $('#diveditor').show();
          });
      });
      $('#table_list tbody').on('click', '.btnsyarat', function () {
          id = $(this).data("id");
          $("#berkas_idne").val('new');
          $("#berkas_file").val('');
          $("#edit_idne").val(id);
          $('#divawal').hide();
          $('#divberkas').show();
          var token	= document.getElementById('token').value;
          $.post('{{ route("getFirstPengumuman") }}', { val01: id, _token: token },
              function(data){
              var jadwalujian     = data.jadwalujian; 
              var jadwalwawancara = data.jadwalwawancara;
              $('#id_jadwalujian').summernote('code', jadwalujian);
              $('#id_jadwalwawancara').summernote('code', jadwalwawancara);
          });
          var source  = {
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
              data: {_token: token, val01:id, val02:''},
              url: '{{ route("jsonDataSyaratPelamar") }}'
          };
          var dataAdapter = new $.jqx.dataAdapter(source);
          var filerenderer = function (row, column, value) {
              var size      = $('#gridberkas').jqxGrid('getrowdata', row).size;
              var filebukti = $('#gridberkas').jqxGrid('getrowdata', row).title;
              var type      = $('#gridberkas').jqxGrid('getrowdata', row).type;
              if (size == '0'){
                  var linkbukti = '<div style="background: white;">'+type+'</div>';
              } else {
                  var linkbukti = '<div style="background: white;"><a href="'+filebukti+'" target="_blank" class="btn btn-primary btn-sm">'+type+'</a></div>';
              }
              return linkbukti;
          }
          $("#gridberkas").jqxGrid({
              width: '100%',
              source: dataAdapter,
              columnsresize: true,
              theme: "energyblue",
              autoheight: true,
              selectionmode: 'multiplecellsextended',
              columns: [
                  { text: 'Nama Berkas Syarat', datafield: 'name', width: '65%', cellsalign: 'left', align: 'center'  },
                  { text: 'Kewajiban', cellsrenderer: filerenderer, width: '17%', align: 'center', cellsalign: 'center'},
                  { text: 'Edit', columntype: 'button', width: '10%', cellsalign: 'center', align: 'center', cellsrenderer: function () {
                      return "Edit";
                      }, buttonclick: function (row) {
                          editrow = row;	
                          var offset 		= $("#gridberkas").offset();
                          var dataRecord 	= $("#gridberkas").jqxGrid('getrowdata', editrow);
                          $("#berkas_nama").val(dataRecord.name);
                          $("#berkas_wajib").val(dataRecord.type);
                          $("#berkas_idne").val(dataRecord.id);
                          $("#berkas_file").val('');
                          $("#pendidikan_file").val('');
                          $('#divupdatependidikan').hide(); 
                          $('#divtambahpendidikan').show(); 
                      }
                  },
                  { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsrenderer: function () {
                      return "Del";
                      }, buttonclick: function (row) {
                          editrow         = row;	
                          var offset 		= $("#gridberkas").offset();		
                          var dataRecord 	= $("#gridberkas").jqxGrid('getrowdata', editrow);
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
                              var token   = document.getElementById('token').value;		
                              $.post('{{ route("exInputBerkasPelamar") }}', { _token: token, set01: val01, set02: val02, set03: '', set04: '', set05: 'delete' },
                              function(data){
                                  $("#berkas_idne").val('new');
                                  $("#berkas_file").val('');
                                  $.toast({
                                      heading: 'Info',
                                      text: data,
                                      position: 'top-right',
                                      loaderBg: '#bf441d',
                                      icon: 'success',
                                      hideAfter: 5000,
                                      stack: 1
                                  });
                                  $("#gridberkas").jqxGrid('updatebounddata');
                                  return false;
                              });
                          });
                      }
                  },
              ],
          });
          $('#accordiondivaddsoal').hide();
          $('#accordiondivviewsoal').hide();
          var sourcerekapsoal  = {
              datatype: "json",
              datafields: [
                  { name: 'idprodi',type: 'text'},
                  { name: 'kodesoal',type: 'text'},
                  { name: 'tuliskode',type: 'text'},
                  { name: 'jumlah',type: 'text'},
              ],
              type: 'POST',
              data: {_token: token, val01:id, val02:'rekap'},
              url: '{{ route("jsonRekapSoal") }}'
          };
          var jsonRekapSoal = new $.jqx.dataAdapter(sourcerekapsoal);
          $("#gridrekapsoal").jqxGrid({
              width: '100%',
              source: jsonRekapSoal,
              columnsresize: true,
              theme: "energyblue",
              autoheight: true,
              selectionmode: 'multiplecellsextended',
              columns: [
                  { text: 'Kode', datafield: 'tuliskode', width: '75%', cellsalign: 'left', align: 'center'  },
                  { text: 'Jumlah', datafield: 'jumlah',width: '17%', align: 'center', cellsalign: 'center'},
                  { text: 'View', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsrenderer: function () {
                      return "View";
                      }, buttonclick: function (row) {
                      editrow = row;	
                      var offset 		  = $("#gridrekapsoal").offset();		
                      var dataRecord 	= $("#gridrekapsoal").jqxGrid('getrowdata', editrow);
                      var sourcedetail = {
                          datatype: "json",
                          datafields: [
                              { name: 'id',type: 'text'},	
                              { name: 'idsoal',type: 'text'},	
                              { name: 'tipesoal',type: 'text'},
                              { name: 'kode',type: 'text'},
                              { name: 'ceel',type: 'text'},	
                              { name: 'inputor',type: 'text'},
                              { name: 'aktif',type: 'text'},
                              { name: 'aktifview',type: 'text'},
                              { name: 'lampiran',type: 'text'},
                              { name: 'deskripsi',type: 'text'},
                              { name: 'jawaba',type: 'text'},
                              { name: 'jawabb',type: 'text'},
                              { name: 'jawabc',type: 'text'},
                              { name: 'jawabd',type: 'text'},
                              { name: 'jawabe',type: 'text'},
                              { name: 'kuncie',type: 'text'},
                              { name: 'tahun',type: 'text'},
                              { name: 'deskripsitambahan',type: 'text'},
                          ],
                          type: 'POST',
                          data: {	val01:dataRecord.idprodi, val02:dataRecord.kodesoal, _token: token },
                          url:  '{{ route("getDetailSoal") }}',
                          };
                          var datadetail = new $.jqx.dataAdapter(sourcedetail);
                          $('#accordiondivaddsoal').hide();
                          $('#accordiondivviewsoal').show();
                          $("#gridviewsoal").jqxGrid({
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
                                  { text: 'Remove', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsrenderer: function () { return "Remove";}, 
                                      buttonclick: function (row) {
                                          editrow         = row;	
                                          var offset 		= $("#gridviewsoal").offset();
                                          var dataRecord 	= $("#gridviewsoal").jqxGrid('getrowdata', editrow);
                                          swal({
                                              title               : 'Apakah anda yakin ?',
                                              text                : "Soal Ini Akan Kami Remove Sebagai Soal Ujia Yang Bapak/Ibu Pilih",
                                              type                : 'warning',
                                              showCancelButton    : true,
                                              confirmButtonClass  : 'btn btn-confirm mt-2',
                                              cancelButtonClass   : 'btn btn-cancel ml-2 mt-2',
                                              confirmButtonText   : 'Yes'
                                          }).then(function () {
                                              var token	= document.getElementById('token').value;
                                              var set01	= dataRecord.id;
                                              var set02	= dataRecord.idsoal;
                                              $.post('{{ route("exSetSoalProdi") }}', { val01: set01, val02: set02, val03: 'remove', _token: token },
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
                                                  $("#gridrekapsoal").jqxGrid('updatebounddata');
                                                  return false;
                                              });
                                          });
                                      }
                                  },
                                  { text: 'Deskripsi', datafield: 'deskripsi', width: '32%', align: 'center' },
                                  { text: 'Opsi A', datafield: 'jawaba', width: '10%', cellsalign: 'left', align: 'center' },
                                  { text: 'Opsi B', datafield: 'jawabb', width: '10%', cellsalign: 'left', align: 'center'},
                                  { text: 'Opsi C', datafield: 'jawabc', width: '10%', cellsalign: 'left', align: 'center'},
                                  { text: 'Opsi D', datafield: 'jawabd', width: '10%', cellsalign: 'left', align: 'center'},	
                                  { text: 'Opsi E', datafield: 'jawabe', width: '10%', cellsalign: 'left', align: 'center'},
                                  { text: 'Kunci', datafield: 'kuncie', width: '10%', cellsalign: 'center', align: 'center'},
                              ]
                          });
                      }
                  },
              ],
          });
      });
      $('#table_list tbody').on('click', '.btnpeminat', function () {
          id = $(this).data("id");
          $('#tabelpeminat').show();
          $('#tabelverifikasi').hide();
          $("#edit_idne").val(id);
          var token 	= document.getElementById('token').value;
          $.post('{{ route("getFirstPengumuman") }}', { val01: id, _token: token },
              function(data){
              var nama        = data.nama; 
              var jenjang     = data.jenjang;
              var campur      = nama+' Formasi Untuk : '+jenjang
              $("#judulpeminat").html(campur);
          });
          $('#divfrontpage').hide();
          $('#divpeminat').show();
          $('#divpeminat').show();
          $('#divpeminat').show();
          var token	= document.getElementById('token').value;
          var source  = {
              datatype: "json",
              datafields: [
              { name: 'idne'},
              { name: 'countkd', type: 'text'},
              { name: 'selesaikd', type: 'text'},
              { name: 'nilaikd', type: 'text'},
              { name: 'countkb', type: 'text'},
              { name: 'selesaikb', type: 'text'},
              { name: 'nilaikb', type: 'text'},
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
              { name: 'nip', type: 'text'},
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
              { name: 'idremun', type: 'text'},
              { name: 'tlsstatus', type: 'text'},
              { name: 'fotourl', type: 'text'},
              { name: 'total', type: 'text'},
              ],
              type: 'POST',
              data: {_token: token, val01:id},
              url: '{{ route("jsonDataPeminat") }}'
          };
          var dataAdapter   = new $.jqx.dataAdapter(source);
          $("#gridpeminat").jqxGrid({
              width               : '100%',
              showfilterrow       : true,
              rowsheight          : 40,
              filterable          : true,
              columnsresize       : true,
              autoshowfiltericon  : true,
              source              : dataAdapter,
              theme               : "energyblue",
              selectionmode       : 'multiplecellsextended',
              columns             : [
                  { text: 'Verifikasi', columntype: 'button', width: '7%', cellsalign: 'center', align: 'center', editable: false, sortable: false, filterable: false, cellsrenderer: function () { return "View";
                      }, buttonclick: function (row) {
                          editrow         = row;	
                          var offset 		= $("#gridpeminat").offset();
                          var dataRecord 	= $("#gridpeminat").jqxGrid('getrowdata', editrow);
                          var set01       = dataRecord.idne;
                          var set02       = dataRecord.program_studi;
                          $("#set_idpeg").val(set01);
                          $('#tabelpeminat').hide(); 
                          $('#tabelverifikasi').show();
                          $(".org_nama").html(dataRecord.nama_lengkap);
                          $('#profilimage').attr('src', dataRecord.fotourl);
                          $.post('{{ route("getFirstPeminat") }}', { val01: set01, _token: token },
                              function(data){
                              $("#org_deskripsi").html(data);
                          });
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
                          var dataAdapterpendidikan = new $.jqx.dataAdapter(sourcependidikan);
                          var editrow = -1;
                          var filerenderer1 = function (row, column, value) {
                              var filebukti = $('#gridpendidikan').jqxGrid('getrowdata', row).bukti;
                              if (filebukti != ''){
                                  var linkbukti = '<div style="background: white;"><a href="/scan/files/'+filebukti+'" target="_blank"><span class="label label-success">DOWNLOAD</span></a></div>';
                              }
                              else {
                                  var linkbukti = '<div style="background: white;"></div>';
                              }
                              return linkbukti;
                          }
                          $("#gridpendidikan").jqxGrid({
                              width           : '100%',
                              source          : dataAdapterpendidikan,
                              columnsresize   : true,
                              theme           : "energyblue",
                              autoheight      : true,
                              selectionmode   : 'multiplecellsextended',
                              columns         : [
                                  { text: 'File Upload', align: 'center', cellsalign: 'center',  width: 100, cellsrenderer: filerenderer1 },
                                  { text: 'Jenjang', datafield: 'jenjang', width: 70, cellsalign: 'left', align: 'center'  },
                                  { text: 'PT/Sekolah', datafield: 'sekolah', width: 160, align: 'center', cellsalign: 'left'},
                                  { text: 'Tahun Masuk', datafield: 'tahunmsk', width: 70, cellsalign: 'center', align: 'center' },
                                  { text: 'Negara', datafield: 'negara', width: 80, cellsalign: 'center', align: 'center' },
                                  { text: 'Bidang Ilmu/Minat', datafield: 'minat', width: 150, cellsalign: 'center', align: 'center' },
                                  { text: 'Status', datafield: 'status', width: 50, cellsalign: 'center', align: 'center' },
                                  { text: 'TMT.Lulus', datafield: 'tmtlulus', width: 100, cellsalign: 'center', align: 'center' },
                                  { text: 'No.Ijasah', datafield: 'noijasah', width: 100, cellsalign: 'center', align: 'center' },
                                  { text: 'Tgl.Ijasah', datafield: 'tglijasah', width: 100, cellsalign: 'center', align: 'center' },
                                  { text: 'Keterangan', datafield: 'keterangan', width: 145, cellsalign: 'center', align: 'center' },
                              ],
                          });
                          var sourceorganisasi = {
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
                          var filerenderer2 = function (row, column, value) {
                              var filebukti = $('#gridorganisasi').jqxGrid('getrowdata', row).bukti;
                              if (filebukti != ''){
                                  var linkbukti = '<div style="background: white;"><a href="/scan/files/'+filebukti+'" target="_blank"><span class="label label-success">DOWNLOAD</span></a></div>';
                              }
                              else {
                                  var linkbukti = '<div style="background: white;"></div>';
                              }
                              return linkbukti;
                          }	
                          var dataAdapterorganisasi = new $.jqx.dataAdapter(sourceorganisasi);
                          $("#gridorganisasi").jqxGrid({
                              width               : '100%',
                              source              : dataAdapterorganisasi,
                              columnsresize       : true,
                              theme               : "energyblue",
                              autoheight          : true,
                              selectionmode       : 'multiplecellsextended',
                              columns             : [
                                  { text: 'File Upload', align: 'center', cellsalign: 'center',  width: '7%', cellsrenderer: filerenderer2 },
                                  { text: 'Nama Organisasi', datafield: 'namaorganisasi', width: '15%', cellsalign: 'left', align: 'center'  },
                                  { text: 'Kedudukan', datafield: 'kedudukan', width: '17%', cellsalign: 'left', align: 'center'  },
                                  { text: 'No. SK', datafield: 'nosk', width: '10%', align: 'center', cellsalign: 'left'},
                                  { text: 'Mulai', datafield: 'mulai', width: '8%', cellsalign: 'left', align: 'center' },
                                  { text: 'Selesai', datafield: 'selesai', width: '8%', cellsalign: 'left', align: 'center' },
                                  { text: 'Nama Pejabat', datafield: 'namapejabat', width: '12%', cellsalign: 'left', align: 'center'  },
                                  { text: 'Jabatan', datafield: 'jabpejabat', width: '12%', cellsalign: 'left', align: 'center'  },
                                  { text: 'NIP', datafield: 'nippejabat', width: '11%', cellsalign: 'left', align: 'center'  },
                              ],
                          });
                          var sourcekeluarga = {
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
                          var filerenderer3 = function (row, column, value) {
                              var filebukti = $('#gridkeluarga').jqxGrid('getrowdata', row).bukti;
                              if (filebukti != ''){
                                  var linkbukti = '<div style="background: white;"><a href="/scan/files/'+filebukti+'" target="_blank"><span class="label label-success">DOWNLOAD</span></a></div>';
                              }
                              else {
                                  var linkbukti = '<div style="background: white;"></div>';
                              }
                              return linkbukti;
                          }
                          var dataAdapterkeluarga = new $.jqx.dataAdapter(sourcekeluarga);
                          $("#gridkeluarga").jqxGrid({
                              width           : '100%',
                              source          : dataAdapterkeluarga,
                              columnsresize   : true,
                              theme           : "energyblue",
                              autoheight      : true,
                              selectionmode   : 'multiplecellsextended',
                              columns         : [
                                  { text: 'File Upload', align: 'center', cellsalign: 'center',  width: '8%', cellsrenderer: filerenderer3 },
                                  { text: 'Nama', datafield: 'nama', width: '15%', cellsalign: 'left', align: 'center'  },
                                  { text: 'Hub.Keluarga', datafield: 'hubklg', width: '8%', cellsalign: 'left', align: 'center'  },
                                  { text: 'Kelamin', datafield: 'kelamin', width: '8%', cellsalign: 'left', align: 'center'  },
                                  { text: 'Tempat Lahir', datafield: 'tmplahir', width: '9%', align: 'center', cellsalign: 'left'},
                                  { text: 'Tgl.Lahir', datafield: 'tgllahir', width: '8%', cellsalign: 'left', align: 'center' },
                                  { text: 'Tgl.Menikah', datafield: 'tglmenikah', width: '8%', cellsalign: 'left', align: 'center' },
                                  { text: 'Pekerjaan', datafield: 'pekerjaan', width: '9%', cellsalign: 'left', align: 'center' },
                                  { text: 'Pendidikan', datafield: 'jenjang', width: '8%', cellsalign: 'left', align: 'center'  },
                                  { text: 'Status', datafield: 'status', width: '9%', cellsalign: 'left', align: 'center'  },
                                  { text: 'NIK', datafield: 'nik', width: '10%', cellsalign: 'left', align: 'center'  },
                              ],
                          });
                          var sourcediklat = {
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
                          var dataAdapterdiklat = new $.jqx.dataAdapter(sourcediklat);
                          var filerenderer4 = function (row, column, value) {
                              var filebukti = $('#griddiklat').jqxGrid('getrowdata', row).bukti;
                              if (filebukti != ''){
                                  var linkbukti = '<div style="background: white;"><a href="/scan/files/'+filebukti+'" target="_blank"><span class="label label-success">DOWNLOAD</span></a></div>';
                              }
                              else {
                                  var linkbukti = '<div style="background: white;"></div>';
                              }
                              return linkbukti;
                          }
                          $("#griddiklat").jqxGrid({
                              width           : '100%',
                              source          : dataAdapterdiklat,
                              columnsresize   : true,
                              theme           : "energyblue",
                              autoheight      : true,
                              selectionmode   : 'multiplecellsextended',
                              columns         : [
                                  { text: 'File Upload', align: 'center', cellsalign: 'center',  width: '8%', cellsrenderer: filerenderer4 },
                                  { text: 'No.Dokumen', datafield: 'nodoc', width: '10%', cellsalign: 'left', align: 'center'  },
                                  { text: 'Tgl.Dokumen', datafield: 'tgldok', width: '10%', align: 'center', cellsalign: 'left'},
                                  { text: 'Diklat', datafield: 'diklat', width: '12%', cellsalign: 'left', align: 'center' },
                                  { text: 'Penyelenggara', datafield: 'penyelenggara', width: '15%', cellsalign: 'left', align: 'center' },
                                  { text: 'Nama Diklat', datafield: 'namadiklat', width: '8%', cellsalign: 'left', align: 'center' },
                                  { text: 'Tempat', datafield: 'tempat', width: '8%', cellsalign: 'left', align: 'center' },
                                  { text: 'Angkatan', datafield: 'angkatan', width: '7%', cellsalign: 'left', align: 'center' },
                                  { text: 'Mulai', datafield: 'mulai', columngroup: 'pelaksanaan', width: '8%', cellsalign: 'center', align: 'center' },
                                  { text: 'Lulus', datafield: 'lulus', columngroup: 'pelaksanaan', width: '8%', cellsalign: 'center', align: 'center' },
                                  { text: 'Jmlh.Jam', datafield: 'jam', columngroup: 'pelaksanaan', width: '7%', cellsalign: 'center', align: 'center' },
                                  { text: 'Predikat', datafield: 'predikat', columngroup: 'pelaksanaan', width: '7%', cellsalign: 'center', align: 'center' },
                                  { text: 'Negara', datafield: 'negeri', columngroup: 'pelaksanaan', width: '8%', cellsalign: 'center', align: 'center' },
                                  { text: 'Keterangan', datafield: 'keterangan', width: '7%', cellsalign: 'left', align: 'center' },
                              ],
                              columngroups: 
                              [
                                  { text: 'Pelaksanaan', align: 'center', name: 'pelaksanaan' },
                              ]
                          });
                          var sourcepenghargaan = {
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
                          var dataAdapterpenghargaan = new $.jqx.dataAdapter(sourcepenghargaan);
                          var filerenderer5 = function (row, column, value) {
                              var filebukti = $('#gridpenghargaan').jqxGrid('getrowdata', row).bukti;
                              if (filebukti != ''){
                                  var linkbukti = '<div style="background: white;"><a href="/scan/files/'+filebukti+'" target="_blank"><span class="label label-success">DOWNLOAD</span></a></div>';
                              }
                              else {
                                  var linkbukti = '<div style="background: white;"></div>';
                              }
                              return linkbukti;
                          }
                          $("#gridpenghargaan").jqxGrid({
                              width           : '100%',
                              source          : dataAdapterpenghargaan,
                              columnsresize   : true,
                              theme           : "energyblue",
                              autoheight      : true,
                              selectionmode   : 'multiplecellsextended',
                              columns         : [
                                  { text: 'File Upload', align: 'center', cellsalign: 'center',  width: '10%', cellsrenderer: filerenderer5 },
                                  { text: 'No.SK', datafield: 'nosk', width: '12%', cellsalign: 'left', align: 'center'  },
                                  { text: 'Tgl.SK', datafield: 'tanggal', width: '12%', align: 'center', cellsalign: 'left'},
                                  { text: 'Nama Penghargaan', datafield: 'penghargaan', width: '22%', cellsalign: 'left', align: 'center' },
                                  { text: 'Pemberi', datafield: 'pemberi', width: '22%', cellsalign: 'left', align: 'center' },
                                  { text: 'Pejabat', datafield: 'pejabat', width: '12%', cellsalign: 'left', align: 'center' },			
                                  { text: 'Keterangan', datafield: 'keterangan', width: '10%', cellsalign: 'left', align: 'center' },
                              ]		
                          });
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
                              data: {	val01:set02, val02:set01, _token: token },
                              url:  '{{ route("jsonDataSyaratPelamar") }}',
                          };
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
                              width           : '100%',
                              autoheight      : true,
                              columnsresize   : true,
                              theme           : "energyblue",
                              source          : datadetail,
                              selectionmode   : 'multiplecellsextended',
                              columns         : [
                                  { text: 'Nama Berkas Syarat', datafield: 'name', width: '50%', cellsalign: 'left', align: 'center'  },
                                  { text: 'Kewajiban', datafield: 'type', width: '15%', align: 'center', cellsalign: 'center'},
                                  { text: 'Status', cellsrenderer: fileterupload, width: '35%', align: 'center', cellsalign: 'center'},
                              ]
                          });
                          var sourceidentitas 	= {
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
                              url: '{{ route("jsondataIdentitas") }}'
                          };
                          var dataAdapteridentitas = new $.jqx.dataAdapter(sourceidentitas);
                          var filerenderer6 = function (row, column, value) {
                              var filebukti = $('#grididentitas').jqxGrid('getrowdata', row).bukti;
                              if (filebukti != ''){
                                  var linkbukti = '<div style="background: white;"><a href="/scan/files/'+filebukti+'" target="_blank"><span class="label label-success">DOWNLOAD</span></a></div>';
                              }
                              else {
                                  var linkbukti = '<div style="background: white;"></div>';
                              }
                              return linkbukti;
                          }
                          $("#grididentitas").jqxGrid({
                              width           : '100%',
                              source          : dataAdapteridentitas,
                              columnsresize   : true,
                              theme           : "energyblue",
                              autoheight      : true,
                              selectionmode   : 'multiplecellsextended',
                              columns: [
                                  { text: 'Jenis', datafield: 'jenisid', width: '30%', align: 'center', cellsalign: 'left'},
                                  { text: 'Aktif', datafield: 'aktif', width: '15%', cellsalign: 'left', align: 'center'  },
                                  { text: 'Keterangan', datafield: 'nomer', width: '40%', cellsalign: 'left', align: 'center' },
                                  { text: 'File Upload', align: 'center', cellsalign: 'center',  width: '15%', cellsrenderer: filerenderer6 },
                              ],
                          });
                      
                      }
                  },
                  { text: 'Foto', width: '3%', datafield: 'foto', editable: false, sortable: false, filterable: false },
                  { text: 'Nama', datafield: 'nama_lengkap', width: '13%', align: 'center' },
                  { text: 'CBT', datafield: 'total', width: '4%', cellsalign: 'center', align: 'center' },
                  { text: 'Wawancara', datafield: 'idremun', width: '7%', cellsalign: 'center', align: 'center' },
                  { text: 'Email', datafield: 'email', width: '12%', cellsalign: 'left', align: 'center' },
                  { text: 'No. HP', datafield: 'no_hp', width: '9%', cellsalign: 'left', align: 'center' },
                  { text: 'NIK', datafield: 'nik', width: '9%', cellsalign: 'left', align: 'center' },
                  { text: 'Alamat', datafield: 'alamat', width: '13%', cellsalign: 'left', align: 'center' },
                  { text: 'Kelamin', datafield: 'jenis_kelamin', filtertype: 'checkedlist', width: '7%', cellsalign: 'left', align: 'center' },
                  { text: 'Tempat Lahir', datafield: 'tmpt_lahir', width: '8%', cellsalign: 'left', align: 'center' },
                  { text: 'Tanggal Lahir', datafield: 'tgl_lahir', width: '8%', cellsalign: 'left', align: 'center' },
              ],
          });
      });
      $('.select2').select2({width: '100%'});
    });
    $(document).ready(function() {
        $("#btnexport").click(function () {
            var gridContent = $("#gridpeminat").jqxGrid('exportdata', 'html');	
            var newWindow = window.open('', '', 'width=1240, height=500'),
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
        $("#btnsetting").click(function () {
          $('#divpeminat').hide();
          $('#divberkas').hide();
          $('#divfrontpage').show();
          $('#diveditor').hide();
          $('#divawal').hide();
          $('#divsetting').show();
          var token	= document.getElementById('token').value;
          var source  = {
              datatype: "json",
              datafields: [
                  { name: 'idne'},
                  { name: 'nama', type: 'text'},
                  { name: 'ujian', type: 'text'},
                  { name: 'created_by', type: 'text'},
                  { name: 'jadwal', type: 'text'}
              ],
              type: 'POST',
              data: {_token: token, val01:'setting'},
              url: '{{ route("jsonSetting") }}'
          };
          var dataAdapter   = new $.jqx.dataAdapter(source);
          $("#gridsetting").jqxGrid({
              width               : '100%',
              showfilterrow       : true,
              rowsheight          : 40,
              filterable          : true,
              columnsresize       : true,
              autoshowfiltericon  : true,
              source              : dataAdapter,
              theme               : "energyblue",
              selectionmode       : 'multiplecellsextended',
              columns             : [
                  { text: 'Change', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsalign: 'center', align: 'center', cellsrenderer: function () {return "Change";
                      }, buttonclick: function (row) {
                          editrow         = row;	
                          var offset      = $("#gridsetting").offset();		
                          var dataRecord 	= $("#gridsetting").jqxGrid('getrowdata', editrow);
                          swal({
                              title				: 'Apakah anda yakin ?',
                              text				: "Setting Akan di Set On / Off Sesuai dengan Status Terakhir",
                              type				: 'warning',
                              showCancelButton	: true,
                              confirmButtonClass	: 'btn btn-confirm mt-2',
                              cancelButtonClass	: 'btn btn-cancel ml-2 mt-2',
                              confirmButtonText	: 'Yes'
                          }).then(function () {
                              var form_data = new FormData();
                                  form_data.append('set01', dataRecord.idne);
                                  form_data.append('set02', '');
                                  form_data.append('set03', 'onoff');
                                  form_data.append('set04', null);
                                  form_data.append('set05', null);
                                  form_data.append('set06', null);
                                  form_data.append('_token', '{{csrf_token()}}');
                              $.ajax({
                              url         : '{{ route("exInputSetting") }}',
                              data        : form_data,
                              type        : 'POST',
                              contentType : false,
                              processData : false,
                              success     : function (data) {
                                  $.toast({
                                      heading     : data.status,
                                      text        : data.message,
                                      position    : 'top-right',
                                      loaderBg    : data.warna,
                                      icon        : data.icon,
                                      hideAfter   : 5000,
                                      stack       : 1
                                  });
                                  $("#gridsetting").jqxGrid('updatebounddata');
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
                          });
                      }
                  },
                  { text: 'Nama', datafield: 'nama', width: '35%', align: 'center' },
                  { text: 'Jadwal', datafield: 'jadwal', width: '50%', cellsalign: 'left', align: 'center' },
                  { text: 'Status', datafield: 'ujian', width: '7%', cellsalign: 'center', align: 'center' },
                  { text: 'Updated By', datafield: 'created_by', width: '35%', align: 'center' },
              ],
          });
        });
        $('#out_keterangan').summernote()
        $('#id_jadwalujian').summernote()
        $('#id_jadwalwawancara').summernote()
        $('#id_namaenglish').summernote()
        $('#accordiondivaddsoal').hide();
        $('#accordiondivviewsoal').hide();
        $('#divsetting').hide();
        $('#divpeminat').hide();
        $('#divberkas').hide();
        $('#divawal').show();
        $('#diveditor').hide();
        $("#btnverifikasibiodata").click(function(){
            var idpeg=document.getElementById('set_idpeg').value;
            $("#out_jenis").val('Biodata');
            $("#out_perihal").val('Berkas Isian');
            $("#out_idsurat").val(idpeg);
            $('#out_keterangan').summernote('code', '');
            $('#modalverifikasi').modal('show');
        });
        $("#btncloseviewsoal").click(function(){
            $('#accordiondivaddsoal').hide();
            $('#accordiondivviewsoal').hide();
        });
        $("#btnaddsoal").click(function(){
            $('#accordiondivaddsoal').show();
            $('#accordiondivviewsoal').hide();
        });
        $("#btnsimpanberkas").click(function(){
            var val01=document.getElementById('edit_idne').value;
            var val02=document.getElementById('berkas_idne').value;
            var val03=document.getElementById('berkas_nama').value;
            var val04=document.getElementById('berkas_wajib').value;
            var val05=document.getElementById('berkas_file');
            if (val03 == ''){
                swal({
                    title	: 'Stop',
                    text	: 'Form Wajib di Lengkapi, Apabila ada data yg kosong / tidak diketahui, maka diberi tanda (-) / strip',
                    type	: 'warning',
                })
            } else {
                var form_data = new FormData();
                    form_data.append('set01', val01);
                    form_data.append('set02', val02);
                    form_data.append('set03', val03);
                    form_data.append('set04', val04);
                    form_data.append('set05', 'input');
                    form_data.append('file', val05.files[0]);
                    form_data.append('_token', '{{csrf_token()}}');
                $.ajax({
                    url         : '{{ route("exInputBerkasPelamar") }}',
                    data        : form_data,
                    type        : 'POST',
                    contentType : false,
                    processData : false,
                    success     : function (data) {
                        $("#berkas_idne").val('new');
                        $("#berkas_file").val('');
                        $("#gridberkas").jqxGrid('updatebounddata');
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        $.toast({
                            heading     : 'Info',
                            text        : data,
                            position    : 'top-right',
                            loaderBg    : '#bf441d',
                            icon        : 'success',
                            hideAfter   : 5000,
                            stack       : 1
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
        $("#btnupdatedataps").click(function(){
            var val01=document.getElementById('edit_idne').value;
            var val02=document.getElementById('edit_email').value;
            var val03=document.getElementById('edit_fax').value;
            var val06=document.getElementById('edit_alamat').value;
            var val07=document.getElementById('edit_jenjang').value;
            var val08=document.getElementById('edit_mulai').value;
            var val09=document.getElementById('edit_namafak').value;
            var val10=document.getElementById('edit_namaps').value;
            var val11=document.getElementById('edit_namapt').value;
            var val12=document.getElementById('edit_nim').value;
            var val13=document.getElementById('edit_noskberdiri').value;
            var val14=document.getElementById('edit_noskijin').value;
            var val15=document.getElementById('edit_pejabatberdiri').value;
            var val16=document.getElementById('edit_pejabatijin').value;
            var val17=document.getElementById('edit_tanggalberdiri').value;
            var val18=document.getElementById('edit_tanggalijin').value;
            var val19=document.getElementById('edit_telepon').value;
            var val20=document.getElementById('edit_website').value;
            var val21=document.getElementById('edit_kaprodinama').value;
            var val22=document.getElementById('edit_kaprodijabatan').value;
            var val23=document.getElementById('edit_kaprodijenis').value;
            var val24=document.getElementById('edit_kaprodinip').value;
            var val25=document.getElementById('edit_kajurnama').value;
            var val26=document.getElementById('edit_kajurjabatan').value;
            var val27=document.getElementById('edit_kajurjenis').value;
            var val28=document.getElementById('edit_kajurnip').value;
            var val29=$('#id_namaenglish').summernote('code');
            var val30=document.getElementById('edit_kodeps').value;
            var val31=document.getElementById('edit_idpejabat').value;
            if (val10 == '' ||  val07 == '' || val17 == '' || val18 == '' || val29 == ''){
                swal({
                    title	: 'Stop',
                    text	: 'Form Wajib di Lengkapi, Apabila ada data yg kosong / tidak diketahui, maka diberi tanda (-) / strip',
                    type	: 'warning',
                })
            } else {
                var form_data = new FormData();
                    form_data.append('set01', val01);
                    form_data.append('set02', val02);
                    form_data.append('set03', val03);
                    form_data.append('set04', null);
                    form_data.append('set05', null);
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
                    form_data.append('set21', val21);
                    form_data.append('set22', val22);
                    form_data.append('set23', val23);
                    form_data.append('set24', val24);
                    form_data.append('set25', val25);
                    form_data.append('set26', val26);
                    form_data.append('set27', val27);
                    form_data.append('set28', val28);
                    form_data.append('set29', val29);
                    form_data.append('set30', val30);
                    form_data.append('set31', val31);
                    form_data.append('_token', '{{csrf_token()}}');
                $.ajax({
                    url         : '{{ route("exInputPengumuman") }}',
                    data        : form_data,
                    type        : 'POST',
                    contentType : false,
                    processData : false,
                    success     : function (data) {
                        $('#divawal').show();
                        $('#diveditor').hide();
                        $.toast({
                            heading     : 'Info',
                            text        : data,
                            position    : 'top-right',
                            loaderBg    : '#bf441d',
                            icon        : 'success',
                            hideAfter   : 5000,
                            stack       : 1
                        });
                        $('#table_list').dataTable().fnDraw();
                        $("html, body").animate({ scrollTop: 0 }, "slow");
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
        $("#btnsimpanjadwalwawancara").click(function(){
            var val01=document.getElementById('edit_idne').value;
            var val02=$('#id_jadwalwawancara').summernote('code');
            var val03='wawancara';
            if (val02 == ''){
                swal({
                    title	: 'Stop',
                    text	: 'Form Wajib di Lengkapi, Apabila ada data yg kosong / tidak diketahui, maka diberi tanda (-) / strip',
                    type	: 'warning',
                })
            } else {
                var form_data = new FormData();
                    form_data.append('set01', val01);
                    form_data.append('set02', val02);
                    form_data.append('set03', val03);
                    form_data.append('set04', null);
                    form_data.append('set05', null);
                    form_data.append('set06', null);
                    form_data.append('_token', '{{csrf_token()}}');
                $.ajax({
                    url         : '{{ route("exInputSetting") }}',
                    data        : form_data,
                    type        : 'POST',
                    contentType : false,
                    processData : false,
                    success     : function (data) {
                        $.toast({
                            heading     : data.status,
                            text        : data.message,
                            position    : 'top-right',
                            loaderBg    : data.warna,
                            icon        : data.icon,
                            hideAfter   : 5000,
                            stack       : 1
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
        $("#btnsimpanjadwalujian").click(function(){
            var val01=document.getElementById('edit_idne').value;
            var val02=$('#id_jadwalujian').summernote('code');
            var val03='ujian';
            if (val02 == ''){
                swal({
                    title	: 'Stop',
                    text	: 'Form Wajib di Lengkapi, Apabila ada data yg kosong / tidak diketahui, maka diberi tanda (-) / strip',
                    type	: 'warning',
                })
            } else {
                var form_data = new FormData();
                    form_data.append('set01', val01);
                    form_data.append('set02', val02);
                    form_data.append('set03', val03);
                    form_data.append('set04', null);
                    form_data.append('set05', null);
                    form_data.append('set06', null);
                    form_data.append('_token', '{{csrf_token()}}');
                $.ajax({
                    url         : '{{ route("exInputSetting") }}',
                    data        : form_data,
                    type        : 'POST',
                    contentType : false,
                    processData : false,
                    success     : function (data) {
                        $.toast({
                            heading     : data.status,
                            text        : data.message,
                            position    : 'top-right',
                            loaderBg    : data.warna,
                            icon        : data.icon,
                            hideAfter   : 5000,
                            stack       : 1
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
        $("#btnsimpanverifikasitext").click(function(){
            var val01=document.getElementById('out_idsurat').value;
            var val02=$('#out_keterangan').summernote('code');
            var val03=document.getElementById('out_jenis').value;
            var val04=document.getElementById('out_status').value;
            var val05=document.getElementById('set_idpeg').value;
            $('#modalverifikasi').modal('hide');
            var form_data = new FormData();
                form_data.append('set01', val01);
                form_data.append('set02', val02);
                form_data.append('set03', val03);
                form_data.append('set04', val04);
                form_data.append('set05', val05);
                form_data.append('set06', null);
                form_data.append('_token', '{{csrf_token()}}');
            $.ajax({
                url         : '{{ route("exInputSetting") }}',
                data        : form_data,
                type        : 'POST',
                contentType : false,
                processData : false,
                success     : function (data) {
                $.toast({
                    heading     : data.status,
                    text        : data.message,
                    position    : 'top-right',
                    loaderBg    : data.warna,
                    icon        : data.icon,
                    hideAfter   : 5000,
                    stack       : 1
                });
                if (val03 == 'Biodata'){
                    $.post('{{ route("getFirstPeminat") }}', { val01: val05, _token: '{{csrf_token()}}' },
                    function(data){
                        $("#org_deskripsi").html(data);
                    });
                }
                if (val03 == 'Berkas Pendidikan'){
                    $("#gridpendidikan").jqxGrid('updatebounddata');
                }
                if (val03 == 'Berkas Riwayat Kerja'){
                    $("#gridorganisasi").jqxGrid('updatebounddata');
                }
                if (val03 == 'Berkas Keluarga'){
                    $("#gridkeluarga").jqxGrid('updatebounddata');
                }
                if (val03 == 'Berkas Diklat'){
                    $("#griddiklat").jqxGrid('updatebounddata');
                }
                if (val03 == 'Berkas Penghargaan'){
                    $("#gridpenghargaan").jqxGrid('updatebounddata');
                }
                if (val03 == 'Berkas Upload'){
                    $("#gridonline").jqxGrid('updatebounddata');
                }
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
        });
        $("#btndelete").click(function(){
            var val01=document.getElementById('edit_idne').value;
            var val02=document.getElementById('edit_email').value;
            var val03=document.getElementById('edit_fax').value;
            var val06=document.getElementById('edit_alamat').value;
            var val07=document.getElementById('edit_jenjang').value;
            var val08=document.getElementById('edit_mulai').value;
            var val09=document.getElementById('edit_namafak').value;
            var val10=document.getElementById('edit_namaps').value;
            var val11=document.getElementById('edit_namapt').value;
            var val12=document.getElementById('edit_nim').value;
            var val13=document.getElementById('edit_noskberdiri').value;
            var val14=document.getElementById('edit_noskijin').value;
            var val15=document.getElementById('edit_pejabatberdiri').value;
            var val16=document.getElementById('edit_pejabatijin').value;
            var val17=document.getElementById('edit_tanggalberdiri').value;
            var val18=document.getElementById('edit_tanggalijin').value;
            var val19=document.getElementById('edit_telepon').value;
            var val20=document.getElementById('edit_website').value;
            var val21=document.getElementById('edit_kaprodinama').value;
            var val22=document.getElementById('edit_kaprodijabatan').value;
            var val23=document.getElementById('edit_kaprodijenis').value;
            var val24=document.getElementById('edit_kaprodinip').value;
            var val25=document.getElementById('edit_kajurnama').value;
            var val26=document.getElementById('edit_kajurjabatan').value;
            var val27=document.getElementById('edit_kajurjenis').value;
            var val28=document.getElementById('edit_kajurnip').value;
            var val29=$('#id_namaenglish').summernote('code');
            var val30=document.getElementById('edit_kodeps').value;
            var val31=document.getElementById('edit_idpejabat').value;
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
                    form_data.append('set01', 'hapus');
                    form_data.append('set02', val01);
                    form_data.append('set03', val03);
                    form_data.append('set04', null);
                    form_data.append('set05', null);
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
                    form_data.append('set21', val21);
                    form_data.append('set22', val22);
                    form_data.append('set23', val23);
                    form_data.append('set24', val24);
                    form_data.append('set25', val25);
                    form_data.append('set26', val26);
                    form_data.append('set27', val27);
                    form_data.append('set28', val28);
                    form_data.append('set29', val29);
                    form_data.append('set30', val30);
                    form_data.append('set31', val31);
                    form_data.append('_token', '{{csrf_token()}}');
                $.ajax({
                    url         : '{{ route("exInputPengumuman") }}',
                    data        : form_data,
                    type        : 'POST',
                    contentType : false,
                    processData : false,
                    success     : function (data) {
                        $('#divawal').show();
                        $('#diveditor').hide();
                        $.toast({
                            heading: 'Info',
                            text: data,
                            position: 'top-right',
                            loaderBg: '#bf441d',
                            icon: 'success',
                            hideAfter: 5000,
                            stack: 1
                        });
                        $('#table_list').dataTable().fnDraw();
                        $("html, body").animate({ scrollTop: 0 }, "slow");
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
            });
        });
        $('.kembaliketabelpeminat').click(function () {
            $('#tabelpeminat').show();
            $('#tabelverifikasi').hide();
        });
        $('.btnkembali').click(function () {
            $('#divpeminat').hide();
            $('#divberkas').hide();
            $('#divfrontpage').show();
            $('#divawal').show();
            $('#diveditor').hide();
            $('#divsetting').hide();
        });
        $('#btnopennew').click(function () {
            $("#edit_idne").val('new');
            $('#divawal').hide();
            $('#diveditor').show();
            var namaenglish = '<table width="100%" cellspacing="0" cellpadding="0" border="0" style="table table-striped table-bordered">'+
                            '<tr><td width="60%">NAMA BAGIAN YANG DIBUTUHKAN</td><td width="40%">-</td></tr>'+
                            '<tr><td>JENIS KELAMIN</td><td>Laki-laki / Perempuan</td></tr>'+
                            '<tr><td>USIA</td><td>Maks. 35 Tahun</td></tr>'+
                            '<tr><td>PENDIDIKAN</td><td>S1 Manajemen SDM / Lainnya sesuai bidang</td></tr>'+
                            '<tr><td>STR</td><td>-</td></tr>'+
                            '<tr><td>PENGALAMAN</td><td>Diutamakan memiliki pengalaman minimal 2 tahun dibidangnya</td></tr>'+
                            '<tr><td>SERTIFIKAT</td><td>Diutamakan memiliki sertifikat pelatihan</td></tr>'+
                            '<tr><td>LAIN-LAIN</td><td>&nbsp;</td></tr>'+
                            '</table>';
            $('#id_namaenglish').summernote('code', namaenglish);
        });
        $('#btnaktifonly').click(function () {
          $('#divpeminat').hide();
          $('#divberkas').hide();
          $('#divfrontpage').show();
          $('#divawal').show();
          $('#diveditor').hide();
          $('#divsetting').hide();
          $("#set_jenis").val('aktif');
          $('#table_list').dataTable().fnDraw();
        });
        $('#btnarsip').click(function () {
          $('#divpeminat').hide();
          $('#divberkas').hide();
          $('#divfrontpage').show();
          $('#divawal').show();
          $('#diveditor').hide();
          $('#divsetting').hide();
          $("#set_jenis").val('arsip');
          $('#table_list').dataTable().fnDraw();
        });
        $('#btn-clear').click(function(){
            $('.form-filter').val('');
        });
        $('#btn-search').click(function(){
            $('#table_list').dataTable().fnDraw();
        });
        var col_order   = ["nama", "namaenglish"];
        var table 		  = $('#table_list').DataTable({
            responsive  : true, 
            dom         : "<'row'<'col-sm-12'tr>>\
                        <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
            lengthMenu  : [10, 25, 50, 100],
            pageLength  : 10,
            ordering    : true,
            processing  : true,
            serverSide  : true,
            autoWidth   : false,
            ajax        : function(data, callback, settings) {
            $.ajax({
                url         : '{{ route("dataPengumuman") }}',
                data        : {
                    limit   : settings._iDisplayLength,
                    page    : Math.ceil(settings._iDisplayStart / settings._iDisplayLength) + 1,
                    jenis   : $('#set_jenis').val(),
                    valcari : $('#main_valcari').val(),
                    order   : col_order[settings.aaSorting[0][0]]+' '+settings.aaSorting[0][1],
                },
                type        : "GET",
                beforeSend  : function(request) {
                    request.setRequestHeader('Authorization', 'Bearer ' + token);
                },
                success: function(res) {
                    callback({
                        recordsTotal    : res.total,
                        recordsFiltered : res.total,
                        data            : res.data
                    });
                },
            })
            },
            columns: [	
                {
                    "data"      : "id",
                    "orderable" : false,
                    render      : function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    "data"      : {
                        id      : "id",
                    },
                    "orderable" : false,
                    "render"    : function(data, type, full, meta) {
                        str     = '<div class="btn-group-vertical"><a class="btn btn-xs btn-danger btnubah" href="javascript:;" data-id="'+data.id+'"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Edit&nbsp;&nbsp;</a><p></p>'+
                                    '<a class="btn btn-xs btn-info btnsyarat" href="javascript:;" data-id="'+data.id+'"><i class="fa fa-copy"></i>&nbsp;Syarat</a><p></p>'+
                                    '<a class="btn btn-xs btn-success btnpeminat" href="javascript:;" data-id="'+data.id+'"><i class="fa fa-users"></i>&nbsp;Peminat</a></div>';
                        return str;
                    }
                },
                {
                    "data"      : {
                    id          : "id",
                    namaenglish : "namaenglish",
                    nama        : "nama",
                    namafak     : "namafak",
                    jenjang     : "jenjang",
                    idpejabat   : "idpejabat",
                    tanggal     : "tanggal",
                    tglskijin   : "tglskijin",
                    status      : "status",
                    soalkd      : "soalkd",
                    soalkb      : "soalkb",
                    berkas      : "berkas",
                    terisi      : "terisi",
                    },
                    "orderable" : true,
                    "render"    : function(data, type, full, meta) {
                        str = '<a>'+data.nama+' ( '+data.jenjang+' )</a><br/>'+
                            '<small>Kebutuhan Formasi / Peminat : '+data.idpejabat+' / '+data.terisi+'</small><br/>'+
                            '<small>Berkas Yang di Persyaratkan : '+data.berkas+'</small><br/>'+
                            '<small>Soal Kompetensi Dasar : '+data.soalkd+'</small><br/>'+
                            '<small>Soal Kompetensi Bidang : '+data.soalkb+'</small><br/>'+
                            data.status;
                        return str;
                    }
                },
                {
                    "data"      : {
                    namaenglish : "namaenglish",
                    },
                    "orderable" : true,
                    "render"    : function(data, type, full, meta) {
                        str = '<div class="direct-chat-messages">'+data.namaenglish+'</div>';
                        return str;
                    }
                },
            ],
            "initComplete"  : function(settings, json) {
            }
        });
        var sourcetabungan = {
            datatype: "json",
            datafields: [
                { name: 'idsoal',type: 'text'},	
                { name: 'tipesoal',type: 'text'},
                { name: 'kode',type: 'text'},
                { name: 'ceel',type: 'text'},	
                { name: 'inputor',type: 'text'},
                { name: 'aktif',type: 'text'},
                { name: 'aktifview',type: 'text'},
                { name: 'lampiran',type: 'text'},
                { name: 'deskripsi',type: 'text'},
                { name: 'jawaba',type: 'text'},
                { name: 'jawabb',type: 'text'},
                { name: 'jawabc',type: 'text'},
                { name: 'jawabd',type: 'text'},
                { name: 'jawabe',type: 'text'},
                { name: 'kuncie',type: 'text'},
                { name: 'tahun',type: 'text'},
                { name: 'deskripsitambahan',type: 'text'},
            ],
            url: '{{ route("jsonGetSoalAktif") }}',
            cache: false,
        };
        var datatabungan = new $.jqx.dataAdapter(sourcetabungan);
        $("#gridsoal").jqxGrid({
            width           : '100%',
            filterable      : true,
            columnsresize   : true,
            filtermode      : 'excel',
            theme           : "energyblue",
            autoheight      : true,
            altrows         : true,
            source          : datatabungan,
            selectionmode   : 'singlecell',
            columns: [		
                { text: 'Import', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsrenderer: function () { return "Import";
                    }, buttonclick: function (row) {
                        editrow         = row;
                        var offset      = $("#gridsoal").offset();
                        var dataRecord 	= $("#gridsoal").jqxGrid('getrowdata', editrow);
                        swal({
                            title               : 'Apakah anda yakin ?',
                            text                : "Soal Ini Akan Kami Set Sebagai Soal Ujian Untuk Prodi Yang Bapak/Ibu Pilih",
                            type                : 'warning',
                            showCancelButton    : true,
                            confirmButtonClass  : 'btn btn-confirm mt-2',
                            cancelButtonClass   : 'btn btn-cancel ml-2 mt-2',
                            confirmButtonText   : 'Yes'
                        }).then(function () {
                            var token	    = document.getElementById('token').value;
                            var set01	    = document.getElementById('edit_idne').value;
                            var set02	    = dataRecord.idsoal;
                            $.post('{{ route("exSetSoalProdi") }}', { val01: set01, val02: set02, val03: 'import', _token: token },
                                function(data){					
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
                                $("#gridrekapsoal").jqxGrid('updatebounddata');
                                return false;
                            });
                        });
                    }
                },
                { text: 'KODE', datafield: 'kode', width: '8%', align: 'center' },
                { text: 'Deskripsi', datafield: 'deskripsi', width: '28%', align: 'center' },
                { text: 'Opsi A', datafield: 'jawaba', width: '10%', cellsalign: 'left', align: 'center' },
                { text: 'Opsi B', datafield: 'jawabb', width: '10%', cellsalign: 'left', align: 'center'},
                { text: 'Opsi C', datafield: 'jawabc', width: '10%', cellsalign: 'left', align: 'center'},
                { text: 'Opsi D', datafield: 'jawabd', width: '10%', cellsalign: 'left', align: 'center'},	
                { text: 'Opsi E', datafield: 'jawabe', width: '10%', cellsalign: 'left', align: 'center'},
                { text: 'Kunci', datafield: 'kuncie', width: '6%', cellsalign: 'center', align: 'center'},
            ],
        });
    });
</script>
@endpush