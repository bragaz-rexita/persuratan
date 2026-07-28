@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Persuratan PT</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div id="loading"><img width="50%" src="{{ asset('dist/img/loading.gif') }}" alt="Loading On Duidev"></div>
                <div class="col-md-12 divawal">
                    <div class="card card-widget widget-user-2">
                        <div class="widget-user-header bg-success">
                            <div class="widget-user-image">
							@if (Session('avatar') != '')
							<img class="img-circle elevation-2" src="{!! Session('avatar') !!}" alt="User Avatar">
                            @else 
							<img class="img-circle elevation-2" src="{{ asset('mascot.png') }}" alt="User Avatar">
                            @endif
                            </div>
                            <h3 class="widget-user-username">{{Session('nama')}}</h3>
                            <h5 class="widget-user-desc">{{Session('fakpanjang')}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 divawal">
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title">Form</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformf1"><span class="badge bg-warning notifformrs01">0</span><i class="fa fa-calculator"></i> Tanda Terima Titipan Ijasah</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformf2"><span class="badge bg-warning notifformrs02">0</span><i class="fa fa-star-o"></i> Visitor Tamu</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformf3"><span class="badge bg-warning notifformrs03">0</span><i class="fa fa-truck"></i> Konseling Staf</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformf4"><span class="badge bg-warning notifformrs04">0</span><i class="fa fa-toggle-off"></i> Libur Akreditasi</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformf5"><span class="badge bg-warning notifformrs05">0</span><i class="fa fa-user-plus"></i> Serah Terima</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformf6"><span class="badge bg-warning notifformrs06">0</span><i class="fa fa-street-view"></i> Riwayat Pelatihan</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformf7"><span class="badge bg-warning notifformrs07">0</span><i class="fa fa-archive"></i> Pengajuan</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformf8"><span class="badge bg-warning notifformrs08">0</span><i class="fa fa-check-square-o"></i> Penyelesaian Kewajiban</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformf9"><span class="badge bg-warning notifformrs09">0</span><i class="fa fa-camera-retro"></i> Penggabungan Libur</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformf10"><span class="badge bg-warning notifformrs10">0</span><i class="fa fa-calendar-o"></i> Cuti MS</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformf11"><span class="badge bg-warning notifformrs11">0</span><i class="fa fa-ambulance"></i> Infus On Call</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformf12"><span class="badge bg-warning notifformrs12">0</span><i class="fa fa-h-square"></i> Lembur</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformf13"><span class="badge bg-warning notifformrs13">0</span><i class="fa fa-fa-play-circle"></i> Finger Print</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformf14"><span class="badge bg-warning notifformrs14">0</span><i class="fa fa-bullhorn"></i> Perintah On Call</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformf15"><span class="badge bg-warning notifformrs15">0</span><i class="fa fa-user-md"></i> Ijin Dokter</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformf16"><span class="badge bg-warning notifformrs16">0</span><i class="fa fa-wheelchair"></i> Ijin Staf</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformf17"><span class="badge bg-warning notifformrs17">0</span><i class="fa fa-calculator"></i> Tukar Jadwal</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformf18"><span class="badge bg-warning notifformrs18">0</span><i class="fa fa-bookmark"></i> Pendelegasian Tugas</a></div>
                                <div class="col-12 col-sm-6 col-md-3"><a class="btn btn-app btn-block btnopenformf19"><span class="badge bg-warning notifformrs19">0</span><i class="fa fa-user-plus"></i> Permohonan Karyawan Baru</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 divsuratproses">
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title" id="judul">Proses</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" id="btnkembali"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="gridsuratkeluar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
    <div id="tabel_cetak"></div>
	<div id="timeremaining" class="pull-right"></div>
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <input type="hidden" name="jenissurat" id="jenissurat">
    <input type="hidden" name="petugas" id="petugas">
    <input type="hidden" name="kelompok" id="kelompok">
</div>
@endsection
@push('script')
<script>
    $(function () {
		CKEDITOR.env.isCompatible = true;
	});
	var start = new Date();
	CountDownTimer(start, 'timeremaining');
	function CountDownTimer(dt, id) {
		var end 	= new Date(dt.getTime() + 60000);
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
				getnotifcount();
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
    function openedpage( jQuery ){
        $("html, body").animate({ scrollTop: 0 }, "slow");
        var set01 		= document.getElementById('jenissurat').value;
        var set02 		= document.getElementById('kelompok').value;
        var set03 		= document.getElementById('petugas').value;
		if ($kelompok == 'Suratkeluarnonomer'){

        }
		if ($kelompok == 'Suratkeluar'){

        }
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
            ],
            updaterow: function (rowid, rowdata, commit) {commit(true);},
            type		: 'GET',
            data		: {	jenis:set01, petugas:set02, kelompok:set03, tahun:"{{date('Y')}}", _token: '{{ csrf_token() }}' },
            url			: '{{ route("jarsiparisPaged") }}',
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
                { text: 'Edit/Replace', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', cellsrenderer: function () {
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
                { text: 'Send', editable: false, sortable: false, filterable: false, columntype: 'button', width: '6%', cellsrenderer: function () {
                    return "Send";
                    }, buttonclick: function (row) {		
                        editrow = row;	
                        var offset 		= $("#gridsuratkeluar").offset();		
                        var dataRecord 	= $("#gridsuratkeluar").jqxGrid('getrowdata', editrow);
                        $("#kirim_id").val(dataRecord.id);
                        $("#kirim_nomor").val(dataRecord.nomor);
                        $("#kirim_perihal").val(dataRecord.plainperihal);
                        $("#kirim_kegiatan").val(dataRecord.plainperihal);
                        $("#kirim_tglmulai").val(dataRecord.plaintglsurat);
                        $("#kirim_tglselesai").val(dataRecord.plaintglsurat);
                        $("#kirim_kelompok").val('KELUAR');
                        CKEDITOR.instances['kirim_keterangan'].setData('')
                        $('#divmainmenu').hide();
                        $('#formsurat').hide();
                        $('#formsuratmodelsk').hide();
                        $('#formsuratmodelsp').hide();
                        $('#divtambahpenerima').show();
                        $('#divsuratkeluar').hide();
                        var sourcedetail = {
                            datatype: "json",
                            datafields: [
                                { name: 'idne',type: 'text'},
                                { name: 'idsurat',type: 'text'},
                                { name: 'pejabat',type: 'text'},
                                { name: 'jabatan',type: 'text'},
                                { name: 'fakultas',type: 'text'},
                                { name: 'status',type: 'text'},
                                { name: 'keterangan',type: 'text'},
                            ],
                            type: 'POST',
                            data: {	val01:dataRecord.id, val02:'KELUAR', val03:'',  _token: '{{ csrf_token() }}' },
                            url: '{{ route("detailpenerimasurat") }}',
                        };
                        var datadetail = new $.jqx.dataAdapter(sourcedetail);
                        $("#griddetail").jqxGrid({
                            width			: '100%',
                            filterable		: true,
                            columnsresize	: true,
                            filtermode		: 'excel',
                            theme			: "orange",
                            sortable		: true,
                            autoheight		: true,
                            source			: datadetail,
                            selectionmode	: 'multiplecellsextended',
                            columns			: [
                                { text: 'Nama Pejabat Penerima', datafield: 'pejabat', width: '30%', cellsalign: 'left', align: 'center' },
                                { text: 'Jabatan', datafield: 'jabatan', width: '20%', cellsalign: 'left', align: 'center' },
                                { text: 'Unit', datafield: 'fakultas', width: '20%', cellsalign: 'left', align: 'center' },
                                { text: 'Keterangan', datafield: 'keterangan', width: '20%', cellsalign: 'left', align: 'center' },
                                { text: 'Hapus', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
                                    return "Hapus";
                                    }, buttonclick: function (row) {
                                        editrow = row;
                                        var offset 		= $("#griddetail").offset();
                                        var dataRecord 	= $("#griddetail").jqxGrid('getrowdata', editrow);
                                        swal({
                                            title: 'Apakah Anda Yakin.?',
                                            text: "Arsip yang telah dihapus tidak bisa di recovery. Apakah Anda Yakin.?",
                                            type: 'warning',
                                            showCancelButton: true,
                                            confirmButtonClass: 'btn btn-confirm mt-2',
                                            cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                                            confirmButtonText: 'Yes, Delete It.!'
                                        }).then(function () {
                                            $.post('{{ route("extbhpenerimasurat") }}', { set01: dataRecord.idne, set02: 'HAPUS', set03: 'SAYA YAKIN', _token: '{{ csrf_token() }}' }, function(data){					
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
                                                $("#griddetail").jqxGrid('updatebounddata', 'filter');
                                                return false;
                                            });
                                        });
                                    }
                                },
                            ],
                        });
                    }
                },
                { text: 'Nomor', datafield: 'tlsnomor', width: '6%', cellsalign: 'center', align: 'center'},
                { text: 'Tanggal', datafield: 'tglsurat', width: '14%', cellsalign: 'center', align: 'center'  },
                { text: 'Perihal', datafield: 'perihal', width: '20%', cellsalign: 'left', align: 'center'  },
                { text: 'Pemohon', datafield: 'tulisorg', width: '20%', cellsalign: 'left', align: 'center'  },
                { text: 'Keterangan', datafield: 'status', width: '20%', cellsalign: 'left', align: 'center'  },
                { text: 'Hapus', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', align: 'center', cellsrenderer: function () {
                    return "Hapus";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var offset 		= $("#gridsuratkeluar").offset();
                        var dataRecord 	= $("#gridsuratkeluar").jqxGrid('getrowdata', editrow);
                        swal({
                            title: 'Apakah Anda Yakin.?',
                            text: "Arsip yang telah dihapus tidak bisa di recovery. Apakah Anda Yakin.?",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonClass: 'btn btn-confirm mt-2',
                            cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                            confirmButtonText: 'Yes, Delete It.!'
                        }).then(function () {
                            var set01		= dataRecord.id;
                            $.post('{{ route("hapussrtkeluar") }}', { val01: dataRecord.id, val02: 'MANUAL', val03: 'KELUAR', _token: '{{ csrf_token() }}' }, function(data){					
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
                                $("#gridsuratkeluar").jqxGrid('updatebounddata', 'filter');
                                return false;
                            });
                        });
                    }
                },
            ],
        });
	}
$(document).ready(function () {
	getnotifcount();
    $('.select2').select2({width: '100%'});
    $('#divsuratproses').hide();
	$('#loading').hide();
	$('.btnopenformf1').on('click', function (){
        var judul       = 'Form Tanda Terima Titipan Ijasah';
        var jenissurat  = 'Tanda Terima Titipan Ijasah';
        var kelompok    = 'Suratkeluarnonomer';
        var petugas     = "{{Session('previlage')}}";
        $('.divawal').hide();
		$('.divsuratproses').show();
		$("#judul").html(judul);
		$("#jenissurat").val(jenissurat);
		$("#petugas").val(petugas);
		$("#kelompok").val(kelompok);
        openedpage();
    });
    $('.btnopenformf2').on('click', function (){
        var judul       = 'Form Visitor Tamu';
        var jenissurat  = 'Visitor Tamu';
        var kelompok    = 'Suratkeluarnonomer';
        var petugas     = "{{Session('previlage')}}";
        $('.divawal').hide();
		$('.divsuratproses').show();
		$("#judul").html(judul);
		$("#jenissurat").val(jenissurat);
		$("#petugas").val(petugas);
		$("#kelompok").val(kelompok);
	    openedpage();
    });
    $('.btnopenformf3').on('click', function (){
        var judul       = 'Form Konseling Staf';
        var jenissurat  = 'Konseling Staf';
        var kelompok    = 'Suratkeluarnonomer';
        var petugas     = "{{Session('previlage')}}";
        $('.divawal').hide();
		$('.divsuratproses').show();
		$("#judul").html(judul);
		$("#jenissurat").val(jenissurat);
		$("#petugas").val(petugas);
		$("#kelompok").val(kelompok);
	    openedpage();
    });
    $('.btnopenformf4').on('click', function (){
        var judul       = 'Form Libur Akreditasi';
        var jenissurat  = 'Libur Akreditasi';
        var kelompok    = 'Suratkeluarnonomer';
        var petugas     = "{{Session('previlage')}}";
        $('.divawal').hide();
		$('.divsuratproses').show();
		$("#judul").html(judul);
		$("#jenissurat").val(jenissurat);
		$("#petugas").val(petugas);
		$("#kelompok").val(kelompok);
	    openedpage();
    });
    $('.btnopenformf5').on('click', function (){
        var judul       = 'Form Serah Terima';
        var jenissurat  = 'Serah Terima';
        var kelompok    = 'Suratkeluarnonomer';
        var petugas     = "{{Session('previlage')}}";
        $('.divawal').hide();
		$('.divsuratproses').show();
		$("#judul").html(judul);
		$("#jenissurat").val(jenissurat);
		$("#petugas").val(petugas);
		$("#kelompok").val(kelompok);
	    openedpage();
    });
    $('.btnopenformf6').on('click', function (){
        var judul       = 'Form Riwayat Pelatihan';
        var jenissurat  = 'Riwayat Pelatihan';
        var kelompok    = 'Suratkeluarnonomer';
        var petugas     = "{{Session('previlage')}}";
        $('.divawal').hide();
		$('.divsuratproses').show();
		$("#judul").html(judul);
		$("#jenissurat").val(jenissurat);
		$("#petugas").val(petugas);
		$("#kelompok").val(kelompok);
	    openedpage();
    });
    $('.btnopenformf7').on('click', function (){
        var judul       = 'Form Pengajuan RS';
        var jenissurat  = 'Pengajuan RS';
        var kelompok    = 'Suratkeluarnonomer';
        var petugas     = "{{Session('previlage')}}";
        $('.divawal').hide();
		$('.divsuratproses').show();
		$("#judul").html(judul);
		$("#jenissurat").val(jenissurat);
		$("#petugas").val(petugas);
		$("#kelompok").val(kelompok);
	    openedpage();
    });
    $('.btnopenformf8').on('click', function (){
        var judul       = 'Form Penyelesaian Kewajiban';
        var jenissurat  = 'Penyelesaian Kewajiban';
        var kelompok    = 'Suratkeluarnonomer';
        var petugas     = "{{Session('previlage')}}";
        $('.divawal').hide();
		$('.divsuratproses').show();
		$("#judul").html(judul);
		$("#jenissurat").val(jenissurat);
		$("#petugas").val(petugas);
		$("#kelompok").val(kelompok);
	    openedpage();
    });
    $('.btnopenformf9').on('click', function (){
        var judul       = 'Form Penggabungan Libur';
        var jenissurat  = 'Penggabungan Libur';
        var kelompok    = 'Suratkeluarnonomer';
        var petugas     = "{{Session('previlage')}}";
        $('.divawal').hide();
		$('.divsuratproses').show();
		$("#judul").html(judul);
		$("#jenissurat").val(jenissurat);
		$("#petugas").val(petugas);
		$("#kelompok").val(kelompok);
	    openedpage();
    });
    $('.btnopenformf10').on('click', function (){
        var judul       = 'Form Cuti MS';
        var jenissurat  = 'Cuti MS';
        var kelompok    = 'Suratkeluarnonomer';
        var petugas     = "{{Session('previlage')}}";
        $('.divawal').hide();
		$('.divsuratproses').show();
		$("#judul").html(judul);
		$("#jenissurat").val(jenissurat);
		$("#petugas").val(petugas);
		$("#kelompok").val(kelompok);
	    openedpage();
    });
    $('.btnopenformf11').on('click', function (){
        var judul       = 'Form Infus On Call';
        var jenissurat  = 'Infus On Call';
        var kelompok    = 'Suratkeluarnonomer';
        var petugas     = "{{Session('previlage')}}";
        $('.divawal').hide();
		$('.divsuratproses').show();
		$("#judul").html(judul);
		$("#jenissurat").val(jenissurat);
		$("#petugas").val(petugas);
		$("#kelompok").val(kelompok);
	    openedpage();
    });
    $('.btnopenformf12').on('click', function (){
        var judul       = 'Form Lembur';
        var jenissurat  = 'Lembur';
        var kelompok    = 'Suratkeluarnonomer';
        var petugas     = "{{Session('previlage')}}";
        $('.divawal').hide();
		$('.divsuratproses').show();
		$("#judul").html(judul);
		$("#jenissurat").val(jenissurat);
		$("#petugas").val(petugas);
		$("#kelompok").val(kelompok);
	    openedpage();
    });
    $('.btnopenformf13').on('click', function (){
        var judul       = 'Form Finger Print';
        var jenissurat  = 'Finger Print';
        var kelompok    = 'Suratkeluarnonomer';
        var petugas     = "{{Session('previlage')}}";
        $('.divawal').hide();
		$('.divsuratproses').show();
		$("#judul").html(judul);
		$("#jenissurat").val(jenissurat);
		$("#petugas").val(petugas);
		$("#kelompok").val(kelompok);
        openedpage();
    });
    $('.btnopenformf14').on('click', function (){
        var judul       = 'Form Perintah On Call';
        var jenissurat  = 'Perintah On Call';
        var kelompok    = 'Suratkeluarnonomer';
        var petugas     = "{{Session('previlage')}}";
        $('.divawal').hide();
		$('.divsuratproses').show();
		$("#judul").html(judul);
		$("#jenissurat").val(jenissurat);
		$("#petugas").val(petugas);
		$("#kelompok").val(kelompok);
        openedpage();
    });
    $('.btnopenformf15').on('click', function (){
        var judul       = 'Form Ijin Dokter';
        var jenissurat  = 'Ijin Dokter';
        var kelompok    = 'Suratkeluarnonomer';
        var petugas     = "{{Session('previlage')}}";
        $('.divawal').hide();
		$('.divsuratproses').show();
		$("#judul").html(judul);
		$("#jenissurat").val(jenissurat);
		$("#petugas").val(petugas);
		$("#kelompok").val(kelompok);
        openedpage();
    });
    $('.btnopenformf16').on('click', function (){
        var judul       = 'Form Ijin Staf';
        var jenissurat  = 'Ijin Staf';
        var kelompok    = 'Suratkeluarnonomer';
        var petugas     = "{{Session('previlage')}}";
        $('.divawal').hide();
		$('.divsuratproses').show();
		$("#judul").html(judul);
		$("#jenissurat").val(jenissurat);
		$("#petugas").val(petugas);
		$("#kelompok").val(kelompok);
        openedpage();
    });
    $('.btnopenformf17').on('click', function (){
        var judul       = 'Form Tukar Jadwal';
        var jenissurat  = 'Tukar Jadwal';
        var kelompok    = 'Suratkeluarnonomer';
        var petugas     = "{{Session('previlage')}}";
        $('.divawal').hide();
		$('.divsuratproses').show();
		$("#judul").html(judul);
		$("#jenissurat").val(jenissurat);
		$("#petugas").val(petugas);
		$("#kelompok").val(kelompok);
        openedpage();
    });
    $('.btnopenformf18').on('click', function (){
        var judul       = 'Form Pendelegasian Tugas';
        var jenissurat  = 'Pendelegasian Tugas';
        var kelompok    = 'Suratkeluarnonomer';
        var petugas     = "{{Session('previlage')}}";
        $('.divawal').hide();
		$('.divsuratproses').show();
		$("#judul").html(judul);
		$("#jenissurat").val(jenissurat);
		$("#petugas").val(petugas);
		$("#kelompok").val(kelompok);
        openedpage();
    });
    $('.btnopenformf19').on('click', function (){
        var judul       = 'Form Permohonan Karyawan Baru';
        var jenissurat  = 'Permohonan Karyawan Baru';
        var kelompok    = 'Suratkeluarnonomer';
        var petugas     = "{{Session('previlage')}}";
        $('.divawal').hide();
		$('.divsuratproses').show();
		$("#judul").html(judul);
		$("#jenissurat").val(jenissurat);
		$("#petugas").val(petugas);
		$("#kelompok").val(kelompok);
        openedpage();
    });
    $('#btnkembali').on('click', function (){
        $('.divawal').show();
		$('.divsuratproses').hide();
        $("html, body").animate({ scrollTop: 0 }, "slow");
	});
});
</script>
@endpush