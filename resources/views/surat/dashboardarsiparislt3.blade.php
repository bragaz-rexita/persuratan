@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Welcome {!! Session('nama') !!}..!!</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('dashboardarsiparis') }}">Refresh</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content" >
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box shadow-lg">
                        <span class="info-box-icon bg-primary">
                            <a href="#" id="topbtnviewarsipin">
                                <i class="fa fa-suitcase"></i>
                            </a>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Surat Masuk</span>
                            <span class="info-box-number countsuratmasuk">0</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box shadow-lg">
                        <span class="info-box-icon bg-success">
                            <a href="#" id="topbtnviewarsipout">
                                <i class="fa fa-rocket"></i>
                            </a>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Surat Keluar</span>
                            <span class="info-box-number countsuratkeluar">0</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box shadow-lg">
                        <span class="info-box-icon bg-info">
                            <a href="#" id="topbtnviewarsipnonomor">
                                <i class="fa fa-pencil-square-o"></i>
                            </a>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Surat Keluar Tanpa Nomor</span>
                            <span class="info-box-number countevent">0</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box shadow-lg">
                        <span class="info-box-icon bg-danger">
                            <a href="#" id="topbtnviewarsipsk">
                                <i class="fa fa-tasks"></i>
                            </a>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">SK / Peraturan</span>
                            <span class="info-box-number countsk">0</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="divawal">
                <div class="col-lg-9">
                    <div id="divviewawal">
                        <div class="card card-info shadow">
                            <div class="card-header">
                                <h3 class="card-title">Kalender</h3>
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
                                <div id='calendar'></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card card-warning direct-chat direct-chat-warning shadow">
                        <div class="card-header">
                            <h3 class="card-title">Lounge</h3>
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
                                    <button type="button" class="btn btn-success" id="sendpesan">Send</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="divriwayat">
                <div class="col-lg-12">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Pengarsipan</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnkembali">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div id="gridriwayat"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="divprosesarsip">
                <div class="col-lg-12">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title" id="judul">Surat Masuk Yang Belum di Arsip</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" id="btntambahmanual">
                                    <i class="fa fa-plus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" id="btnarsipmulti">
                                    <i class="fa fa-list"></i>
                                </button>
                                <button type="button" class="btn btn-tool btnexport">
                                    <i class="fa fa-print"></i>
                                </button>
                                <button type="button" class="btn btn-tool btnkembali">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label>Unit Kerja</label>
                                        <select id="id_satker" class="form-control">
                                            <option value="">Pilih Salah Satu</option>
                                            @foreach($fakultass as $rfakultas)
                                                <option value="{{$rfakultas->fakultas}}">{{$rfakultas->fakpanjang}} ( {{$rfakultas->fakultas}} )</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Status</label>
                                        <select id="id_statuspencarian" class="form-control">
                                            <option value="">Belum di Arsip</option>
                                            <option value="Seluruh">Seluruh Surat</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="id_blncari">Bulan</label>
                                        <select id="id_blncari" class="form-control">
                                            <option value="ALL">ALL</option>
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
                                    <div class="col-lg-2">
                                        <label for="id_thnsrt">Tahun</label>
                                        <input type="text" class="form-control" value="{{date('Y')}}" id="id_thnsrt">
                                    </div>
                                    <div class="col-lg-2">
                                        <button class="btn btn-danger btn-lg btn-block" type="button" id="btncaribulanan">Cari</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="divopensuratkeluar">
                                    <div id="tabelsuratkeluar"></div>
                                </div>
                                <div class="col-md-12" id="divopensuratmasuk">
                                    <div id="tabelsuratmasuk"></div>
                                </div>
                                <div class="col-md-12" id="divopensuratkeluartnpnomor">
                                    <div id="tabelsuratkeluartnpnomor"></div>
                                </div>
                                <div class="col-md-12" id="divopensuratsk">
                                    <div id="tabelsuratsk"></div>
                                </div>
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
<div class="modal fade" id="modalsuratkeluar">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Arsiparis</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label>No.Surat</label>
                            <input type="text" class="form-control" id="out_nomor" readonly="readonly">
                        </div>
                        <div class="col-lg-8">
                            <label>Perihal</label>
                            <input type="text" class="form-control" id="out_perihal" readonly="readonly">
                        </div>	
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Ruang Arsip</label>
                            <input type="text" class="form-control" id="out_ruang">
                        </div>
                        <div class="col-lg-4">
                            <label>Ordner</label>
                            <input type="text" class="form-control" id="out_ordner">
                        </div>
                        <div class="col-lg-4">
                            <label>Lemari</label>
                            <input type="text" class="form-control" id="out_lemari">
                        </div>
                    </div>
                </div>
                <div class="form-group" id="formpemberkasan">
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Nomor Agenda</label>
                            <input type="text" class="form-control" id="out_agenda">
                        </div>
                        <div class="col-lg-4">
                            <label>Tahun Agenda</label>
                            <input type="text" class="form-control" id="out_tahunagenda">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Kode Klasifikasi</label>
                    <div class="input-group margin">
                        <input type="text" class="form-control" placeholder="Klik Tombol Cari" id="out_jenissurat" name="out_jenissurat">
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-flat" type="button" id="btnviewmodalklasifikasi">Open List</button>
                        </span>
                    </div>
                </div>
                <div class="form-group" id="viewmodalklasifikasikeluar"> 
                    <div id="gridklasifikasikeluar"></div>
                </div>
                <div class="form-group">
                    <label for="out_keterangan">Keterangan:</label>
                    <textarea id="out_keterangan" name="out_keterangan"></textarea>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="out_idsurat">
                <input type="hidden" class="form-control" id="out_bentuk">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="btnsimpanout">Simpan</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaldispomulti">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Arsiparis Multi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Pastikan Sudah Centang Surat Yang Akan di Arsipkan Terlebih Dahulu.!!</label>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Ruang Arsip</label>
                            <input type="text" class="form-control" id="multi_ruang">
                        </div>
                        <div class="col-lg-4">
                            <label>Ordner</label>
                            <input type="text" class="form-control" id="multi_ordner">
                        </div>
                        <div class="col-lg-4">
                            <label>Lemari</label>
                            <input type="text" class="form-control" id="multi_lemari">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Kode Klasifikasi</label>
                    <div class="input-group margin">
                        <input type="text" class="form-control" placeholder="Klik Tombol Cari" id="multi_jenissurat" name="multi_jenissurat">
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-flat" type="button" id="btnviewmodalklasifikasimulti">Open List</button>
                        </span>
                    </div>
                </div>
                <div class="form-group" id="viewmodalklasifikasikeluarmulti"> 
                    <div id="gridklasifikasikeluarmulti"></div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="btnsimpanoutmulti">Simpan</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaltambahmanual">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="judulmanual">Form Arsiparis Surat Manual</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-2">
                            <label id="judulnomor">No.Surat</label>
                            <input type="text" class="form-control" id="man_nomor">
                        </div>
                        <div class="col-lg-2">
                            <label>Tgl.Surat</label>
                            <input type="text" class="form-control" id="man_tanggal">
                        </div>
                        <div class="col-lg-8">
                            <label>Perihal</label>
                            <input type="text" class="form-control" id="man_perihal">
                        </div>	
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Ruang Arsip</label>
                            <input type="text" class="form-control" id="man_ruang">
                        </div>
                        <div class="col-lg-4">
                            <label>Ordner</label>
                            <input type="text" class="form-control" id="man_ordner">
                        </div>
                        <div class="col-lg-4">
                            <label>Lemari</label>
                            <input type="text" class="form-control" id="man_lemari">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Kode Klasifikasi</label>
                                <div class="input-group margin">
                                    <input type="text" class="form-control" placeholder="Klik Tombol Cari" id="man_jenissurat" name="man_jenissurat">
                                    <span class="input-group-btn">
                                        <button class="btn btn-info btn-flat" type="button" id="btnviewmodalklasifikasi2">Open List</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for="man_keterangan">Keterangan:</label>
                            <input type="text" class="form-control" id="man_keterangan">
                        </div>
                        <div class="col-lg-4">
                            <label for="man_uploadfile">Upload File</label>
                            <div class="input-group">
                                <input id="man_uploadfile" name="man_uploadfile" type="file" accept=".pdf" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="viewmodalklasifikasikeluar2"> 
                    <div id="gridklasifikasikeluar2"></div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="btnsimpanmanual">Simpan</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalrahasia">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Surat ini belum sepenuhnya selesai di proses</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="rahasia_catatan">Keterangan:</label>
                    <textarea id="rahasia_catatan" name="rahasia_catatan" rows="10" cols="80"></textarea>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="setjenis" id="setjenis" value="riwayat">
@endsection
@push('script')
<script type="text/javascript">
	$(function () {
        CKEDITOR.env.isCompatible = true;
        
    });
    function openedpage( jQuery ){
        var token=document.getElementById('token').value;
        $.post('surat/chatgetlist', { _token: token},
        function(data){
            $('#chatbody').html(data);
        });
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
            data: {val01:'Pribadi', val02:'all', val03: '{{Session('nama')}}', val04: '', _token: token},
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
    function openarsip( jQuery ){
        $('#divopensuratkeluar').hide();
        $('#divopensuratmasuk').hide();
        $('#divopensuratkeluartnpnomor').hide();
        $('#divopensuratsk').hide();
        var token   = document.getElementById('token').value;
        var jenis   = document.getElementById('setjenis').value;
        var satker  = document.getElementById('id_satker').value;
        var bulan   = document.getElementById('id_blncari').value;
        var tahun   = document.getElementById('id_thnsrt').value;
        var status  = document.getElementById('id_statuspencarian').value;
        if (jenis == 'keluarnon'){
            $("#judulnomor").html('No. Urut');
            $("#judul").html('Surat Keluar Tanpa Nomor Yang Perlu di Arsipkan');
            var bentuk      = 'KELUARNONOMER';
            var inboxtipe   = 'keluarnonomor';
            var sourcekeluartnpnomor = {
                datatype: "json",
                datafields: [
                    { name: 'id'},
                    { name: 'isisurat', type: 'text'},
                    { name: 'marking', type: 'text'},
                    { name: 'tglbuat', type: 'shortdate'},
                    { name: 'jenissrt', type: 'text'},
                    { name: 'kepada', type: 'text'},
                    { name: 'perihal', type: 'text'},
                    { name: 'pembuat', type: 'text'},
                    { name: 'kelompok', type: 'text'},
                    { name: 'status', type: 'text'},
                    { name: 'arsip', type: 'text'},
                    { name: 'footnote', type: 'text'},
                    { name: 'ruangarsip', type: 'text'},
                    { name: 'ordnerarsip', type: 'text'},
                    { name: 'lemariarsip', type: 'text'},
                    { name: 'faskode', type: 'text'},
                ],
                type: 'POST',
                data: {	jenis:jenis, satker:satker, bulan:bulan, tahun:tahun, status:status, _token: token },
                url: 'surat/jarsiparis',
            };
            var datajkeluartnpnomor = new $.jqx.dataAdapter(sourcekeluartnpnomor);
            $("#tabelsuratkeluartnpnomor").jqxGrid({
                width               : '100%',
                filterable          : true,
                columnsresize       : true,
                showfilterrow       : true,
                autoshowfiltericon  : true,
                autoheight          : true,
                pageable            : true,
                source              : datajkeluartnpnomor,
                theme               : "energyblue",
                columns             : [
                    { text: 'Arsipkan',  editable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '5%', cellsrenderer: function () {
                        return "Action";
                        }, buttonclick: function (row) {
                            editrow = row;	
                            var offset 		= $("#tabelsuratkeluartnpnomor").offset();
                            var dataRecord 	= $("#tabelsuratkeluartnpnomor").jqxGrid('getrowdata', editrow);
                            $("#formpemberkasan").show();
                            $("#out_idsurat").val(dataRecord.id);
                            $("#out_bentuk").val('KELUARNONOMER');
                            $("#out_nomor").val('-');
                            $("#out_perihal").val(dataRecord.perihal);
                            $("#out_ruang").val(dataRecord.ruangarsip);
                            $("#out_lemari").val(dataRecord.lemariarsip);
                            $("#out_ordner").val(dataRecord.ordnerarsip);
                            $("#out_jenissurat").val(dataRecord.faskode);
                            var url	        = '{{URL::to("/")}}/viewsurat/31a6c48f03aaf7ab8085cc6b5bd34990-'+dataRecord.id;
                            var iframe = '<iframe src="'+url+'" width="100%" height="780" style="border: none;" id="document-preview"></iframe>';
                            $("#pdfRenderer").empty();
                            $('#pdfRenderer').html(iframe);
                            $("#viewmodalklasifikasikeluar").hide();
                            $("#modalsuratkeluar").modal('show');
                        }
                    },
                    { text: 'Klasifikasi', datafield: 'faskode', width: '5%', cellsalign: 'left', align: 'center'},
                    { text: 'Tanggal', datafield: 'tglbuat', width: '6%', cellsalign: 'left', align: 'center'},
                    { text: 'Jenis', datafield: 'jenissrt', filtertype: 'checkedlist', width: '9%', cellsalign: 'left', align: 'center' },
                    { text: 'Perihal', datafield: 'perihal', width: '16%', cellsalign: 'left', align: 'center' },
                    { text: 'Kepada', datafield: 'kepada', width: '14%', cellsalign: 'left', align: 'center' },
                    { text: 'Konseptor', datafield: 'pembuat', width: '10%', cellsalign: 'left', align: 'center' },
                    { text: 'Status', datafield: 'status', width: '5%', cellsalign: 'left', align: 'center' },
                    { text: 'Keterangan', datafield: 'arsip', width: '6%', cellsalign: 'left', align: 'center' },
                    { text: 'Catatan', datafield: 'footnote', width: '6%', cellsalign: 'left', align: 'center' },
                    { text: 'R.Arsip', datafield: 'ruangarsip', width: '5%', cellsalign: 'left', align: 'center' },
                    { text: 'No.Box', datafield: 'ordnerarsip', width: '5%', cellsalign: 'left', align: 'center' },
                    { text: 'No.Lemari', datafield: 'lemariarsip', width: '5%', cellsalign: 'left', align: 'center' },
                    { text: 'View', editable: false, sortable: false, filterable: false, columntype: 'button', width: '3%', cellsrenderer: function () {
                        return "View ";
                        }, buttonclick: function (row) {
                            editrow = row;
                            var offset 		= $("#tabelsuratkeluartnpnomor").offset();		
                            var dataRecord 	= $("#tabelsuratkeluartnpnomor").jqxGrid('getrowdata', editrow);
                            var url	        = '{{URL::to("/")}}/viewsurat/31a6c48f03aaf7ab8085cc6b5bd34990-'+dataRecord.id;
                            window.open(url, '_blank');
                            return false;
                        }
                    },
                ],
            });
            $('#divopensuratkeluartnpnomor').show();
        }
        if (jenis == 'keluar'){
            $("#judulnomor").html('No. Surat');
            $("#judul").html('Surat Keluar Yang Perlu di Arsipkan');
            var bentuk      = 'KELUAR';
            var inboxtipe   = 'keluar';
            var sourcekeluar = {
                datatype: "json",
                datafields: [
                    { name: 'id'},
                    { name: 'nomor'},
                    { name: 'noanak', type: 'text'},
                    { name: 'marking', type: 'text'},
                    { name: 'tglsurat', type: 'shortdate'},
                    { name: 'jenissrt', type: 'text'},
                    { name: 'kepada', type: 'text'},
                    { name: 'perihal', type: 'text'},
                    { name: 'pembuat', type: 'text'},
                    { name: 'kelompok', type: 'text'},
                    { name: 'status', type: 'text'},
                    { name: 'arsip', type: 'text'},
                    { name: 'footnote', type: 'text'},
                    { name: 'ruangarsip', type: 'text'},
                    { name: 'ordnerarsip', type: 'text'},
                    { name: 'lemariarsip', type: 'text'},
                    { name: 'faskode', type: 'text'},
                ],
                type: 'POST',
                data: {	jenis:jenis, satker:satker, bulan:bulan, tahun:tahun, status:status, _token: token },
                url: 'surat/jarsiparis',
            };
            var datajkeluar = new $.jqx.dataAdapter(sourcekeluar);
            $("#tabelsuratkeluar").jqxGrid({
                width               : '100%',
                filterable          : true,
                columnsresize       : true,
                showfilterrow       : true,
                autoshowfiltericon  : true,
                autoheight          : true,
                pageable            : true,
                source              : datajkeluar,
                theme               : "energyblue",
                columns             : [
                    { text: 'Arsipkan',  editable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '3%', cellsrenderer: function () {
                        return "Action";
                        }, buttonclick: function (row) {
                            editrow = row;	
                            var offset 		= $("#tabelsuratkeluar").offset();
                            var dataRecord 	= $("#tabelsuratkeluar").jqxGrid('getrowdata', editrow);
                            $("#formpemberkasan").show();
                            $("#out_idsurat").val(dataRecord.id);
                            $("#out_bentuk").val('KELUAR');
                            $("#out_nomor").val(dataRecord.nomor);
                            $("#out_perihal").val(dataRecord.perihal);
                            $("#out_ruang").val(dataRecord.ruangarsip);
                            $("#out_lemari").val(dataRecord.lemariarsip);
                            $("#out_ordner").val(dataRecord.ordnerarsip);
                            $("#out_jenissurat").val(dataRecord.faskode);
                            var url     = '{{URL::to("/")}}/viewsurat/keluar-'+dataRecord.id;
                            var iframe  = '<iframe src="'+url+'" width="100%" height="780" style="border: none;" id="document-preview"></iframe>';
                            $("#pdfRenderer").empty();
                            $('#pdfRenderer').html(iframe);
                            $("#viewmodalklasifikasikeluar").hide();
                            $("#modalsuratkeluar").modal('show');
                        }
                    },
                    { text: 'Klasifikasi', datafield: 'faskode', width: '5%', cellsalign: 'left', align: 'center'},
                    { text: 'Nomor', datafield: 'nomor', width: '4%', cellsalign: 'left', align: 'center'},
                    { text: 'Sub.No', datafield: 'anakno', width: '3%', cellsalign: 'left', align: 'center'},
                    { text: 'Tanggal', datafield: 'tglsurat', width: '6%', cellsalign: 'left', align: 'center'},
                    { text: 'Jenis', datafield: 'jenissrt', filtertype: 'checkedlist', width: '5%', cellsalign: 'left', align: 'center' },
                    { text: 'Perihal', datafield: 'perihal', width: '16%', cellsalign: 'left', align: 'center' },
                    { text: 'Kepada', datafield: 'kepada', width: '10%', cellsalign: 'left', align: 'center' },
                    { text: 'Konseptor', datafield: 'pembuat', width: '10%', cellsalign: 'left', align: 'center' },
                    { text: 'Status', datafield: 'status', width: '5%', cellsalign: 'left', align: 'center' },
                    { text: 'Keterangan', datafield: 'arsip', width: '6%', cellsalign: 'left', align: 'center' },
                    { text: 'Catatan', datafield: 'footnote', width: '6%', cellsalign: 'left', align: 'center' },
                    { text: 'R.Arsip', datafield: 'ruangarsip', width: '5%', cellsalign: 'left', align: 'center' },
                    { text: 'No.Box', datafield: 'ordnerarsip', width: '5%', cellsalign: 'left', align: 'center' },
                    { text: 'No.Lemari', datafield: 'lemariarsip', width: '5%', cellsalign: 'left', align: 'center' },
                    { text: 'View', editable: false, sortable: false, filterable: false, columntype: 'button', width: '3%', cellsrenderer: function () {
                        return "View ";
                        }, buttonclick: function (row) {
                            editrow = row;
                            var offset 		= $("#tabelsuratkeluar").offset();		
                            var dataRecord 	= $("#tabelsuratkeluar").jqxGrid('getrowdata', editrow);
                            var url	        = '{{URL::to("/")}}/viewsurat/keluar-'+dataRecord.id;
                            window.open(url, '_blank');
                            return false;
                        }
                    },
                    { text: 'Riwayat', editable: false, sortable: false, filterable: false, columntype: 'button', width: '3%', cellsrenderer: function () {
                        return "View ";
                        }, buttonclick: function (row) {
                            editrow = row;
                            var offset 		= $("#tabelsuratkeluar").offset();		
                            var dataRecord 	= $("#tabelsuratkeluar").jqxGrid('getrowdata', editrow);
                            var url	        = '{{URL::to("/")}}/trackingid/srtklr-'+dataRecord.marking;
                            window.open(url, '_blank');
                            return false;
                        }
                    },
                ],
            });
            $('#divopensuratkeluar').show();
        }
        if (jenis == 'masuk'){
            $("#judulnomor").html('No. Agenda');
            $("#judul").html('Surat Masuk Yang Perlu di Arsipkan');
            var bentuk      = 'MASUK';
            var inboxtipe   = 'masuk';
            var sourcemasuk = {
                datatype: "json",
                datafields: [
                    { name: 'id'},
                    { name: 'noagenda', type: 'text'},
                    { name: 'marking', type: 'text'},
                    { name: 'tglmasuk', type: 'shortdate'},
                    { name: 'tglsurat', type: 'shortdate'},
                    { name: 'kepada', type: 'text'},
                    { name: 'perihal', type: 'text'},
                    { name: 'pembuat', type: 'text'},
                    { name: 'asalsurat', type: 'text'},
                    { name: 'nosurat', type: 'text'},
                    { name: 'scansurat', type: 'text'},
                    { name: 'arsip', type: 'text'},
                    { name: 'status', type: 'text'},
                    { name: 'ruangarsip', type: 'text'},
                    { name: 'ordnerarsip', type: 'text'},
                    { name: 'lemariarsip', type: 'text'},
                    { name: 'faskode', type: 'text'},
                    { name: 'pembuat', type: 'text'},
                ],
                type: 'POST',
                data: {	jenis:jenis, satker:satker, bulan:bulan, tahun:tahun, status:status, _token: token },
                url: 'surat/jarsiparis',
            };
            var datajmasuk = new $.jqx.dataAdapter(sourcemasuk);
            $("#tabelsuratmasuk").jqxGrid({
                width               : '100%',
                filterable          : true,
                columnsresize       : true,
                showfilterrow       : true,
                autoshowfiltericon  : true,
                autoheight          : true,
                pageable            : true,
                source              : datajmasuk,
                theme               : "energyblue",
                columns             : [
                    { text: 'Arsipkan',  editable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '5%', cellsrenderer: function () {
                        return "Action";
                        }, buttonclick: function (row) {
                            editrow = row;	
                            var offset 		= $("#tabelsuratmasuk").offset();
                            var dataRecord 	= $("#tabelsuratmasuk").jqxGrid('getrowdata', editrow);
                            $("#formpemberkasan").show();
                            $("#out_idsurat").val(dataRecord.id);
                            $("#out_bentuk").val('MASUK');
                            $("#out_nomor").val(dataRecord.nosurat);
                            $("#out_perihal").val(dataRecord.perihal);
                            $("#out_ruang").val(dataRecord.ruangarsip);
                            $("#out_lemari").val(dataRecord.lemariarsip);
                            $("#out_ordner").val(dataRecord.ordnerarsip);
                            $("#out_jenissurat").val(dataRecord.faskode);
                            var url	        = '{{URL::to("/")}}/viewdocbyname/'+dataRecord.scansurat;
                            var iframe  = '<iframe src="'+url+'" width="100%" height="780" style="border: none;" id="document-preview"></iframe>';
                            $("#pdfRenderer").empty();
                            $('#pdfRenderer').html(iframe);
                            $("#viewmodalklasifikasikeluar").hide();
                            $("#modalsuratkeluar").modal('show');
                        }
                    },
                    { text: 'Klasifikasi', datafield: 'faskode', width: '5%', cellsalign: 'left', align: 'center'},
                    { text: 'Agenda', datafield: 'noagenda', width: '5%', cellsalign: 'left', align: 'center' },
                    { text: 'Tgl.Masuk', datafield: 'tglmasuk', width: '6%', cellsalign: 'left', align: 'center'},
                    { text: 'Tgl.Surat', datafield: 'tglsurat', width: '6%', cellsalign: 'left', align: 'center' },
                    { text: 'No.Surat', datafield: 'nosurat', width: '6%', cellsalign: 'left', align: 'center' },
                    { text: 'Pengirim', datafield: 'asalsurat', width: '6%', cellsalign: 'left', align: 'center' },
                    { text: 'Perihal', datafield: 'perihal', width: '13%', cellsalign: 'left', align: 'center' },
                    { text: 'Kepada', datafield: 'kepada', width: '11%', cellsalign: 'left', align: 'center' },
                    { text: 'Uploader', datafield: 'pembuat', filtertype: 'checkedlist', width: '10%', cellsalign: 'left', align: 'center' },
                    { text: 'Keterangan', datafield: 'arsip', width: '6%', cellsalign: 'left', align: 'center' },
                    { text: 'R.Arsip', datafield: 'ruangarsip', width: '5%', cellsalign: 'left', align: 'center' },
                    { text: 'No.Box', datafield: 'ordnerarsip', width: '5%', cellsalign: 'left', align: 'center' },
                    { text: 'No.Lemari', datafield: 'lemariarsip', width: '5%', cellsalign: 'left', align: 'center' },
                    { text: 'Surat', editable: false, sortable: false, filterable: false, columntype: 'button', width: '3%', cellsrenderer: function () {
                        return "View ";
                        }, buttonclick: function (row) {
                            editrow = row;
                            var offset 		= $("#tabelsuratmasuk").offset();		
                            var dataRecord 	= $("#tabelsuratmasuk").jqxGrid('getrowdata', editrow);
                            var url	        = '{{URL::to("/")}}/viewdocbyname/'+dataRecord.scansurat;
                            window.open(url, '_blank');
                            return false;
                        }
                    },
                    { text: 'Disposisi', editable: false, sortable: false, filterable: false, columntype: 'button', width: '3%', cellsrenderer: function () {
                        return "View";
                        }, buttonclick: function (row) {
                            editrow = row;
                            var offset 		= $("#tabelsuratmasuk").offset();		
                            var dataRecord 	= $("#tabelsuratmasuk").jqxGrid('getrowdata', editrow);
                            var url	        = '{{URL::to("/")}}/viewsurat/7a07275b47504815818abc970da769fc-'+dataRecord.id;
                            window.open(url, '_blank');
                            return false;
                        }
                    },
                ],
            });
            $('#divopensuratmasuk').show();
        }
        if (jenis == 'skdanperaturan'){
            $("#judulnomor").html('No. SK/Peraturan');
            var bentuk      = 'skdanperaturan';
            var inboxtipe   = 'skdanperaturan';
            $("#judul").html('SK dan Peraturan Yang Perlu di Arsipkan');
            var sourceskdanpp = {
                datatype: "json",
                datafields: [
                    { name: 'id'},
                    { name: 'kelompok', type: 'text'},
                    { name: 'marking', type: 'text'},
                    { name: 'tanggal', type: 'shortdate'},
                    { name: 'nomor', type: 'text'},
                    { name: 'tahun', type: 'text'},
                    { name: 'penandatangan', type: 'text'},
                    { name: 'pjbtperundang', type: 'text'},
                    { name: 'judul', type: 'text'},
                    { name: 'kodefas', type: 'text'},
                    { name: 'inputor', type: 'text'},
                    { name: 'arsip', type: 'text'},
                    { name: 'catatan', type: 'text'},
                    { name: 'ruangarsip', type: 'text'},
                    { name: 'ordnerarsip', type: 'text'},
                    { name: 'lemariarsip', type: 'text'},
                ],
                type: 'POST',
                data: {	jenis:jenis, satker:satker, bulan:bulan, tahun:tahun, status:status, _token: token },
                url: 'surat/jarsiparis',
            };
            var datajskdanpp = new $.jqx.dataAdapter(sourceskdanpp);
            $("#tabelsuratsk").jqxGrid({
                width               : '100%',
                filterable          : true,
                columnsresize       : true,
                showfilterrow       : true,
                autoshowfiltericon  : true,
                autoheight          : true,
                pageable            : true,
                source              : datajskdanpp,
                theme               : "energyblue",
                columns             : [
                    { text: 'Arsipkan',  editable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '5%', cellsrenderer: function () {
                        return "Action";
                        }, buttonclick: function (row) {
                            editrow = row;	
                            var offset 		= $("#tabelsuratsk").offset();
                            var dataRecord 	= $("#tabelsuratsk").jqxGrid('getrowdata', editrow);
                            $("#formpemberkasan").show();
                            $("#out_idsurat").val(dataRecord.id);
                            $("#out_bentuk").val('skdanperaturan');
                            $("#out_nomor").val(dataRecord.nomor+' TAHUN '+dataRecord.tahun);
                            $("#out_perihal").val(dataRecord.perihal);
                            $("#out_ruang").val(dataRecord.ruangarsip);
                            $("#out_lemari").val(dataRecord.lemariarsip);
                            $("#out_ordner").val(dataRecord.ordnerarsip);
                            $("#out_jenissurat").val(dataRecord.faskode);
                            var url	        = '{{URL::to("/")}}/viewsurat/SKPP-'+dataRecord.id;
                            var iframe  = '<iframe src="'+url+'" width="100%" height="780" style="border: none;" id="document-preview"></iframe>';
                            $("#pdfRenderer").empty();
                            $('#pdfRenderer').html(iframe);
                            $("#viewmodalklasifikasikeluar").hide();
                            $("#modalsuratkeluar").modal('show');
                        }
                    },
                    { text: 'Klasifikasi', datafield: 'kodefas', width: '5%', cellsalign: 'left', align: 'center'},
                    { text: 'Nomor', datafield: 'nomor', width: '5%', cellsalign: 'left', align: 'center'},
                    { text: 'Tanggal', datafield: 'tanggal', width: '6%', cellsalign: 'left', align: 'center'},
                    { text: 'Kelompok', datafield: 'kelompok', filtertype: 'checkedlist', width: '7%', cellsalign: 'left', align: 'center' },
                    { text: 'Tentang', datafield: 'judul', width: '16%', cellsalign: 'left', align: 'center' },
                    { text: 'Penandatangan', datafield: 'penandatangan', width: '11%', cellsalign: 'left', align: 'center' },
                    { text: 'Pengundang', datafield: 'pjbtperundang', width: '10%', cellsalign: 'left', align: 'center' },
                    { text: 'Konseptor', datafield: 'inputor', width: '5%', cellsalign: 'left', align: 'center' },
                    { text: 'Keterangan', datafield: 'arsip', width: '6%', cellsalign: 'left', align: 'center' },
                    { text: 'Catatan', datafield: 'catatan', width: '6%', cellsalign: 'left', align: 'center' },
                    { text: 'R.Arsip', datafield: 'ruangarsip', width: '5%', cellsalign: 'left', align: 'center' },
                    { text: 'No.Box', datafield: 'ordnerarsip', width: '5%', cellsalign: 'left', align: 'center' },
                    { text: 'No.Lemari', datafield: 'lemariarsip', width: '5%', cellsalign: 'left', align: 'center' },
                    { text: 'View', editable: false, sortable: false, filterable: false, columntype: 'button', width: '3%', cellsrenderer: function () {
                        return "View ";
                        }, buttonclick: function (row) {
                            editrow = row;
                            var offset 		= $("#tabelsuratsk").offset();		
                            var dataRecord 	= $("#tabelsuratsk").jqxGrid('getrowdata', editrow);
                            var url	        = '{{URL::to("/")}}/viewsurat/SKPP-'+dataRecord.id;
                            window.open(url, '_blank');
                            return false;
                        }
                    },
                ],
            });
            $('#divopensuratsk').show();
        }
    }
    $(document).ready(function () {
        openedpage();
        var token=document.getElementById('token').value;
        $('#divopensuratkeluar').hide();
        $('#divopensuratmasuk').hide();
        $('#divopensuratkeluartnpnomor').hide();
        $('#divopensuratsk').hide();
        $('#diveksekusi').hide();
        $('#divviewdisposisi').hide();
        $('#divriwayat').hide();
        $('#divskdanperaturan').hide();
        $('#diveditkalender').hide();
        $('#divsuratmasuk').hide();
        $('#divsuratkeluar').hide();
        $('#divprosesarsip').hide();
        $('.btnexport').click(function () {
            var jenis = $('#setjenis').val();
            if (jenis == 'keluarnon'){
                var gridContent = $("#tabelsuratkeluartnpnomor").jqxGrid('exportdata', 'html');
                var tglcetak = '<?php echo date("j F Y");; ?>';
                var newWindow = window.open('', '', 'width=800, height=500'),
                    document = newWindow.document.open(),
                    pageContent =
                        '<!DOCTYPE html>\n' +
                        '<html>\n' +
                        '<head>\n' +
                        '<meta charset="utf-8" />\n' +
                        '<title>Laporan Surat Keluar Tanpa Nomor</title>\n' +
                        '</head>\n' +
                        '<body> <h2>Laporan Surat Keluar Tanpa Nomor</h2> <br /> Print Date : ' + tglcetak + '\n' + gridContent + '\n</body>\n</html>';
                    document.write(pageContent);
                    document.close();
            }
            if (jenis == 'keluar'){
                var gridContent = $("#tabelsuratkeluar").jqxGrid('exportdata', 'html');
                var tglcetak = '<?php echo date("j F Y");; ?>';
                var newWindow = window.open('', '', 'width=800, height=500'),
                    document = newWindow.document.open(),
                    pageContent =
                        '<!DOCTYPE html>\n' +
                        '<html>\n' +
                        '<head>\n' +
                        '<meta charset="utf-8" />\n' +
                        '<title>Laporan Surat Keluar</title>\n' +
                        '</head>\n' +
                        '<body> <h2>Laporan Surat Keluar</h2> <br /> Print Date : ' + tglcetak + '\n' + gridContent + '\n</body>\n</html>';
                    document.write(pageContent);
                    document.close();
            }
            if (jenis == 'masuk'){
                var gridContent = $("#tabelsuratmasuk").jqxGrid('exportdata', 'html');
                var tglcetak = '<?php echo date("j F Y");; ?>';
                var newWindow = window.open('', '', 'width=800, height=500'),
                    document = newWindow.document.open(),
                    pageContent =
                        '<!DOCTYPE html>\n' +
                        '<html>\n' +
                        '<head>\n' +
                        '<meta charset="utf-8" />\n' +
                        '<title>Laporan Surat Masuk</title>\n' +
                        '</head>\n' +
                        '<body> <h2>Laporan Surat Masuk</h2> <br /> Print Date : ' + tglcetak + '\n' + gridContent + '\n</body>\n</html>';
                    document.write(pageContent);
                    document.close();
            }
            if (jenis == 'skdanperaturan'){
                var gridContent = $("#tabelsuratsk").jqxGrid('exportdata', 'html');
                var tglcetak = '<?php echo date("j F Y");; ?>';
                var newWindow = window.open('', '', 'width=800, height=500'),
                    document = newWindow.document.open(),
                    pageContent =
                        '<!DOCTYPE html>\n' +
                        '<html>\n' +
                        '<head>\n' +
                        '<meta charset="utf-8" />\n' +
                        '<title>Laporan SK dan Peraturan</title>\n' +
                        '</head>\n' +
                        '<body> <h2>Laporan SK dan Peraturan</h2> <br /> Print Date : ' + tglcetak + '\n' + gridContent + '\n</body>\n</html>';
                    document.write(pageContent);
                    document.close();
            }
        });
        $('#btncaribulanan').click(function () {
            var jenis   = document.getElementById('setjenis').value;
            openarsip();
        });
        $('#btnviewmodalklasifikasi').click(function () {
            $('#viewmodalklasifikasikeluar').show();
            var set01='All';
            var token=document.getElementById('token').value;
            var source = {
                datatype: "json",
                datafields: [
                    { name: 'idne'},
                    { name: 'klasifikasi', type: 'text'},
                    { name: 'kodeklasifikasi', type: 'text'},
                    { name: 'kodesurat', type: 'text'},
                    { name: 'primer', type: 'text'},
                    { name: 'sekunder', type: 'text'},
                    { name: 'tersier', type: 'text'},
                    { name: 'series', type: 'text'},
                    { name: 'aktif', type: 'text'},
                    { name: 'inaktif', type: 'text'},
                    { name: 'keterangan', type: 'text'},
                ],
                type: 'POST',
                data: {jenis: set01, _token: token},
                url: 'user/jklasifikasi',
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#gridklasifikasikeluar").jqxGrid({
                width: '100%',
                pageable: true,
                autoheight: true,
                filterable: true,
                source: dataAdapter,
                columnsresize: true,
                showfilterrow: true,
                theme: "energyblue",
                selectionmode: 'multiplecellsextended',
                columns: [
                    { text: 'Action',  editable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '7%', cellsrenderer: function () {
                        return "Gunakan";
                        }, buttonclick: function (row) {
                            editrow = row;	
                            var offset 		= $("#gridklasifikasikeluar").offset();		
                            var dataRecord 	= $("#gridklasifikasikeluar").jqxGrid('getrowdata', editrow);
                            $("#out_jenissurat").val(dataRecord.kodesurat);
                            $("#viewmodalklasifikasikeluar").hide();
                        }
                    },
                    { text: 'Primer', datafield: 'kodeklasifikasi', width: '5%', cellsalign: 'center', align: 'center'  },
                    { text: 'Sekunder', datafield: 'sekunder', width: '33%', cellsalign: 'left', align: 'center'  },
                    { text: 'Tersier', datafield: 'tersier', width: '34%', cellsalign: 'left', align: 'center'  },
                    { text: 'Series', datafield: 'series', width: '21%', cellsalign: 'left', align: 'center'  },
                ]
            });
        });
        $('#btnviewmodalklasifikasi2').click(function () {
            $('#viewmodalklasifikasikeluar2').show();
            var set01='All';
            var token=document.getElementById('token').value;
            var source = {
                datatype: "json",
                datafields: [
                    { name: 'idne'},
                    { name: 'klasifikasi', type: 'text'},
                    { name: 'kodeklasifikasi', type: 'text'},
                    { name: 'kodesurat', type: 'text'},
                    { name: 'primer', type: 'text'},
                    { name: 'sekunder', type: 'text'},
                    { name: 'tersier', type: 'text'},
                    { name: 'series', type: 'text'},
                    { name: 'aktif', type: 'text'},
                    { name: 'inaktif', type: 'text'},
                    { name: 'keterangan', type: 'text'},
                ],
                type: 'POST',
                data: {jenis: set01, _token: token},
                url: 'user/jklasifikasi',
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#gridklasifikasikeluar2").jqxGrid({
                width: '100%',
                pageable: true,
                autoheight: true,
                filterable: true,
                source: dataAdapter,
                columnsresize: true,
                showfilterrow: true,
                theme: "energyblue",
                selectionmode: 'multiplecellsextended',
                columns: [
                    { text: 'Action',  editable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '7%', cellsrenderer: function () {
                        return "Gunakan";
                        }, buttonclick: function (row) {
                            editrow = row;	
                            var offset 		= $("#gridklasifikasikeluar2").offset();		
                            var dataRecord 	= $("#gridklasifikasikeluar2").jqxGrid('getrowdata', editrow);
                            $("#man_jenissurat").val(dataRecord.kodesurat);
                            $("#viewmodalklasifikasikeluar2").hide();
                        }
                    },
                    { text: 'Primer', datafield: 'kodeklasifikasi', width: '5%', cellsalign: 'center', align: 'center'  },
                    { text: 'Sekunder', datafield: 'sekunder', width: '33%', cellsalign: 'left', align: 'center'  },
                    { text: 'Tersier', datafield: 'tersier', width: '34%', cellsalign: 'left', align: 'center'  },
                    { text: 'Series', datafield: 'series', width: '21%', cellsalign: 'left', align: 'center'  },
                ]
            });
        });
        $('#btnviewmodalklasifikasimulti').click(function () {
            $('#viewmodalklasifikasikeluarmulti').show();
            var set01='All';
            var token=document.getElementById('token').value;
            var source = {
                datatype: "json",
                datafields: [
                    { name: 'idne'},
                    { name: 'klasifikasi', type: 'text'},
                    { name: 'kodeklasifikasi', type: 'text'},
                    { name: 'kodesurat', type: 'text'},
                    { name: 'primer', type: 'text'},
                    { name: 'sekunder', type: 'text'},
                    { name: 'tersier', type: 'text'},
                    { name: 'series', type: 'text'},
                    { name: 'aktif', type: 'text'},
                    { name: 'inaktif', type: 'text'},
                    { name: 'keterangan', type: 'text'},
                ],
                type: 'POST',
                data: {jenis: set01, _token: token},
                url: 'user/jklasifikasi',
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#gridklasifikasikeluarmulti").jqxGrid({
                width: '100%',
                pageable: true,
                autoheight: true,
                filterable: true,
                source: dataAdapter,
                columnsresize: true,
                showfilterrow: true,
                theme: "energyblue",
                selectionmode: 'multiplecellsextended',
                columns: [
                    { text: 'Action',  editable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '7%', cellsrenderer: function () {
                        return "Gunakan";
                        }, buttonclick: function (row) {
                            editrow = row;	
                            var offset 		= $("#gridklasifikasikeluarmulti").offset();		
                            var dataRecord 	= $("#gridklasifikasikeluarmulti").jqxGrid('getrowdata', editrow);
                            $("#multi_jenissurat").val(dataRecord.kodesurat);
                            $("#viewmodalklasifikasikeluarmulti").hide();
                        }
                    },
                    { text: 'Primer', datafield: 'kodeklasifikasi', width: '5%', cellsalign: 'center', align: 'center'  },
                    { text: 'Sekunder', datafield: 'sekunder', width: '33%', cellsalign: 'left', align: 'center'  },
                    { text: 'Tersier', datafield: 'tersier', width: '34%', cellsalign: 'left', align: 'center'  },
                    { text: 'Series', datafield: 'series', width: '21%', cellsalign: 'left', align: 'center'  },
                ]
            });
        });
        $('.btnkembali').on('click', function (){
            $('#divriwayat').hide();
            $('#divsuratmasuk').hide();
            $('#divsuratkeluar').hide();
            $('#divsuratkeluarnonomer').hide();
            $('#divviewawal').show();
            $('#divawal').show();
            $('#diveksekusi').hide();
            $('#divviewdisposisi').hide();
        });
        $("#btnarsipkan").click(function(){
            var set01 		= document.getElementById('id_idsurat').value;
            var set02		= '<?php echo date("Y-m-d"); ?>';
            var set03		= 'Kirim ke Arsiparis';
            var token 		= document.getElementById('token').value;
            $.post('surat/arsipfo', { val01: set01, val02: set02, val03: set03, _token: token },
            function(data){
                $('#table_list').dataTable().fnDraw();
                var status  = data.status;
                var message = data.message;
                $.toast({
                    heading: status,
                    text: message,
                    position: 'top-right',
                    loaderBg: '#bf441d',
                    icon: 'info',
                    hideAfter: 5000,
                    stack: 1
                });
                $('#divriwayat').hide();
                $('#divsuratmasuk').hide();
                $('#divsuratkeluar').hide();
                $('#divsuratkeluarnonomer').hide();
                $('#divviewawal').show();
                $('#divawal').show();
                $('#diveksekusi').hide();
                $('#divviewdisposisi').hide();
                return false;
            });	
        });
        $('#topbtnviewriwayatarsip').on('click', function (){
            $('#divriwayat').show();
            $('#divskdanperaturan').hide();
            $('#divsuratmasuk').hide();
            $('#divsuratkeluar').hide();
            $('#divsuratkeluarnonomer').hide();
            $('#divawal').hide();
            var jenis   = 'riwayat';
            var source  = {
                datatype: "json",
                datafields: [
                    { name: 'idarsip'},
                    { name: 'idsurat'},
                    { name: 'tabel', type: 'text'},
                    { name: 'perihal', type: 'text'},
                    { name: 'jenis', type: 'text'},
                    { name: 'kode', type: 'text'},
                    { name: 'durasi', type: 'text'},
                    { name: 'keterangan', type: 'text'},
                    { name: 'ruang', type: 'text'},
                    { name: 'ordner', type: 'text'},
                    { name: 'lemari', type: 'text'},
                    { name: 'arsiparis', type: 'text'},
                    { name: 'fakultas', type: 'text'},
                ],
                updaterow: function (rowid, rowdata, commit) {commit(true);},
                type        : 'POST',
                data        : {jenis: jenis, _token: token},
                url         : 'surat/jarsiparis',
                root        : 'data',
                totalrecords: 'total',
                cache       : false,
                filter      : function () {
                    $("#gridriwayat").jqxGrid('updatebounddata', 'filter');
                },
                sort: function () {
                    $("#gridriwayat").jqxGrid('updatebounddata', 'sort');
                },
                beforeprocessing: function (data) {
                    if (data != null) {
                        source.totalrecords = data.total;
                    }
                }
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#gridriwayat").jqxGrid({
                width: '100%',
                virtualmode		: true,
                pageable		: true,
                pagesizeoptions	: ['10', '20', '30', '50', '100'],
                rendergridrows	: function(obj) {
                    return obj.data;
                },
                autoheight: true,
                filterable: true,
                source: dataAdapter,
                columnsresize: true,
                showfilterrow: true,
                theme: "energyblue",
                selectionmode: 'multiplecellsextended',
                columns: [
                    { text: 'Undo', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', cellsrenderer: function () {
                        return "Undo";
                        }, buttonclick: function (row) {
                            editrow = row;	
                            var offset 		= $("#gridriwayat").offset();		
                            var dataRecord 	= $("#gridriwayat").jqxGrid('getrowdata', editrow);
                            var set01		= dataRecord.idarsip;
                            var set02		= dataRecord.idsurat;
                            var set03		= dataRecord.tabel;
                            var token		= document.getElementById('token').value;
                            $.post('surat/undoarsip', { val01: set01, val02: set02, val03: set03, _token: token },
                            function(data){
                                var status  = data.status;
                                var message = data.message;
                                $.toast({
                                    heading: status,
                                    text: message,
                                    position: 'top-right',
                                    loaderBg: '#bf441d',
                                    icon: 'info',
                                    hideAfter: 5000,
                                    stack: 1
                                });	
                                $("#gridriwayat").jqxGrid('updatebounddata');
                                $("#tabeldata").jqxGrid('updatebounddata');
                                return false;
                            });
                        }
                    },
                    { text: 'Jenis Surat', editable: false, sortable: false, filterable: false, datafield: 'tabel', width: '13%', cellsalign: 'center', align: 'center'  },
                    { text: 'Perihal', datafield: 'perihal', width: '23%', cellsalign: 'left', align: 'center'  },
                    { text: 'Klasifikasi', datafield: 'jenis', width: '10%', cellsalign: 'left', align: 'center'  },
                    { text: 'Kode', datafield: 'kode', width: '10%', cellsalign: 'left', align: 'center'  },
                    { text: 'Retensi', datafield: 'durasi', width: '7%', cellsalign: 'left', align: 'center'},
                    { text: 'Ruang', datafield: 'ruang', width: '10%', cellsalign: 'left', align: 'center'  },
                    { text: 'Ordner', datafield: 'ordner', width: '10%', cellsalign: 'left', align: 'center'  },
                    { text: 'Lemari', datafield: 'lemari', width: '10%', cellsalign: 'left', align: 'center' },
                ],
            });
        }); 
        $('#topbtnviewarsipnonomor').on('click', function (){
            $('#divriwayat').hide();
            $('#divskdanperaturan').hide();
            $('#divsuratmasuk').hide();
            $('#divsuratkeluar').hide();
            $('#divprosesarsip').show();
            $('#divawal').hide();
            $("#setjenis").val('keluarnon');
            openarsip();
        });
        $('#topbtnviewarsipout').on('click', function (){
            $('#divriwayat').hide();
            $('#divskdanperaturan').hide();
            $('#divsuratmasuk').hide();
            $('#divprosesarsip').show();
            $('#divsuratkeluarnonomer').hide();
            $('#divawal').hide();
            $("#setjenis").val('keluar');
            openarsip();
        });
        $('#topbtnviewarsipin').on('click', function (){
            $('#divriwayat').hide();
            $('#divskdanperaturan').hide();
            $('#divprosesarsip').show();
            $('#divsuratkeluar').hide();
            $('#divsuratkeluarnonomer').hide();
            $('#divawal').hide();
            $("#setjenis").val('masuk');
            openarsip();
        });
        $('#topbtnviewarsipsk').on('click', function (){
            $('#divprosesarsip').show();
            $('#divriwayat').hide();
            $('#divsuratmasuk').hide();
            $('#divsuratkeluar').hide();
            $('#divsuratkeluarnonomer').hide();
            $('#divawal').hide();
            $("#setjenis").val('skdanperaturan');
            openarsip();
        });
        $('#btneditjadwalpimpinan').on('click', function (){
            $('#diveditkalender').show();
        }); 
        $('#btntambahmanual').on('click', function (){
            var jenis   = document.getElementById('setjenis').value;
            if (jenis == 'keluarnon'){
                $("#judulmanual").html('Surat Keluar Tanpa Nomor Yang Perlu di Arsipkan');
                $("#judulnomor").html('Surat Keluar Tanpa Nomor Yang Perlu di Arsipkan');
            }
            if (jenis == 'keluar'){
                $("#judulmanual").html('Surat Keluar Yang Perlu di Arsipkan');
            }
            if (jenis == 'masuk'){
                $("#judulmanual").html('Surat Masuk Yang Perlu di Arsipkan');
            }
            if (jenis == 'skdanperaturan'){
                $("#judulmanual").html('SK dan Peraturan Yang Perlu di Arsipkan');
            }
            $('#viewmodalklasifikasikeluar2').hide();
            $("#modaltambahmanual").modal('show');
        });
        $("#btnubahpassword").click(function(){
            var id 			= 	document.getElementById('id_username').value;
            var password1 	= 	document.getElementById('id_pass1').value;	
            var password2 	= 	document.getElementById('id_pass2').value;
            var token 		= 	document.getElementById('token').value;
            $.post('user/updatepass', { val01: id, val02: password1, val03: password2, _token: token },
            function(data){			
                var status  = data.status;
                var message = data.message;
                $.toast({
                    heading: status,
                    text: message,
                    position: 'top-right',
                    loaderBg: '#bf441d',
                    icon: 'info',
                    hideAfter: 5000,
                    stack: 1
                });
                return false;
            });	
        });
        $('#btnarsipmulti').on('click', function (){
            $("#modaldispomulti").modal('show');
            $('#viewmodalklasifikasikeluarmulti').hide();
        });
        $('#sendpesan').on('click', function (){
            var kirim=document.getElementById('kirimpsn').value;
            var nama='';
            var foto='';
            var token=document.getElementById('token').value;
            $.post('surat/catting', { val01: kirim, val02: nama, val03: foto, _token: token },
            function(data){
                $('#chatbody').html(data);
            });
        });
        $('#btnsimpanoutmulti').click(function () {
            var set01=document.getElementById('setjenis').value;
            var set02='multi';
            var set03=document.getElementById('multi_ruang').value;
            var set04=document.getElementById('multi_ordner').value;
            var set05=document.getElementById('multi_lemari').value;
            var set06='';
            var set07='';
            var set08=document.getElementById('multi_jenissurat').value;
            var token=document.getElementById('token').value;
            if (set01 == 'keluarnon'){
                var rows = $("#tabelsuratkeluartnpnomor").jqxGrid('selectedrowindexes');
                var selectedRecords = new Array();
                for (var m = 0; m < rows.length; m++) {
                    var row = $("#tabelsuratkeluartnpnomor").jqxGrid('getrowdata', rows[m]);
                    selectedRecords.push(row.idsurat);
                }
            }
            if (set01 == 'keluar'){
                var rows = $("#tabelsuratkeluar").jqxGrid('selectedrowindexes');
                var selectedRecords = new Array();
                for (var m = 0; m < rows.length; m++) {
                    var row = $("#tabelsuratkeluar").jqxGrid('getrowdata', rows[m]);
                    selectedRecords.push(row.idsurat);
                }
            }
            if (set01 == 'masuk'){
                var rows = $("#tabelsuratmasuk").jqxGrid('selectedrowindexes');
                var selectedRecords = new Array();
                for (var m = 0; m < rows.length; m++) {
                    var row = $("#tabelsuratmasuk").jqxGrid('getrowdata', rows[m]);
                    selectedRecords.push(row.idsurat);
                }
            }
            if (set01 == 'skdanperaturan'){
                var rows = $("#tabelsuratsk").jqxGrid('selectedrowindexes');
                var selectedRecords = new Array();
                for (var m = 0; m < rows.length; m++) {
                    var row = $("#tabelsuratsk").jqxGrid('getrowdata', rows[m]);
                    selectedRecords.push(row.idsurat);
                }
            }
            
            if (m == 0){
                swal({
                    title	: 'Stop',
                    text	: 'Mohon Memilih Item terlebih dahulu',
                    type	: 'warning',
                })
            } else if (set03 == '' || set04 == '' || set05 == '' || set08 == ''){
                swal({
                    title	: 'Stop',
                    text	: 'Ruang, Lemari, Ordner dan Kode Klasifikasi Tidak Boleh Kosong',
                    type	: 'warning',
                })
            } else {
                $.post('surat/exarsiparis', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: selectedRecords, _token: token },
                function(data){
                    var status  = data.status;
                    var message = data.message;
                    $.toast({
                        heading: status,
                        text: message,
                        position: 'top-right',
                        loaderBg: '#bf441d',
                        icon: 'info',
                        hideAfter: 5000,
                        stack: 1
                    });
                    $("#modaldispomulti").modal('hide');
                    openedpage();
                    return false;
                });
            }
        });
        $('#btnsimpanout').click(function () {
            var set01=document.getElementById('out_bentuk').value;
            var set02=document.getElementById('out_idsurat').value;
            var set03=document.getElementById('out_ruang').value;
            var set04=document.getElementById('out_ordner').value;
            var set05=document.getElementById('out_lemari').value;
            var set06=document.getElementById('out_agenda').value;
            var set07=CKEDITOR.instances['out_keterangan'].getData()
            var set08=document.getElementById('out_jenissurat').value;
            var set09=document.getElementById('out_tahunagenda').value;
            var set10=document.getElementById('out_files');
            var token=document.getElementById('token').value;
            if (set02 == '' || set03 == '' || set04 == '' || set05 == '' || set06 == '' || set08 == ''){
                swal({
                    title	: 'Stop',
                    text	: 'Nomor Surat, Perihal, Tanggal, Ruang Arsip Tidak Boleh Kosong',
                    type	: 'warning',
                })
            } else {
                $("#modalsuratkeluar").modal('hide');
                var form_data = new FormData();
                    form_data.append('file', set10.files[0]);
                    form_data.append('val01', set01);
                    form_data.append('val02', set02);
                    form_data.append('val03', set03);
                    form_data.append('val04', set04);
                    form_data.append('val05', set05);
                    form_data.append('val06', set06);
                    form_data.append('val07', set07);
                    form_data.append('val08', set08);
                    form_data.append('val09', set09);
                    form_data.append('_token', '{{csrf_token()}}');
                $.ajax({
                    url: '{{ route("exarsiparis") }}',
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
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        openedpage();
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
            }
        });
        $('#btnsimpanmanual').click(function () {
            var set01=document.getElementById('setjenis').value;
            var set02=document.getElementById('man_nomor').value;
            var set03=document.getElementById('man_ruang').value;
            var set04=document.getElementById('man_ordner').value;
            var set05=document.getElementById('man_lemari').value;
            var set06=document.getElementById('man_tanggal').value;
            var set07=document.getElementById('man_perihal').value;
            var set08=document.getElementById('man_jenissurat').value;
            var set09=document.getElementById('man_keterangan').value;
            var set10=document.getElementById('man_uploadfile');
		    var token = document.getElementById('token').value;
            if ($('#man_uploadfile').val() == ''){
                swal({
                    title	: 'Stop',
                    text	: 'Mohon Upload Filenya terlebih dahulu',
                    type	: 'warning',
                })
            } else if (set02 == '' || set03 == '' || set04 == '' || set05 == '' || set06 == '' || set07 == '' || set08 == ''){
                swal({
                    title	: 'Stop',
                    text	: 'Nomor Surat, Perihal, Tanggal, Ruang Arsip Tidak Boleh Kosong',
                    type	: 'warning',
                })
            } else {
                $("#modaltambahmanual").modal('hide');
                var form_data = new FormData();
                    form_data.append('file', set10.files[0]);
                    form_data.append('val01', set01);
                    form_data.append('val02', set02);
                    form_data.append('val03', set03);
                    form_data.append('val04', set04);
                    form_data.append('val05', set05);
                    form_data.append('val06', set06);
                    form_data.append('val07', set07);
                    form_data.append('val08', set08);
                    form_data.append('val09', set09);
                    form_data.append('_token', '{{csrf_token()}}');
                $.ajax({
                    url: '{{ route("exAddArsipManual") }}',
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
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        openedpage();
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
            }
        });
        getnotifcount();
    });
</script>
@endpush