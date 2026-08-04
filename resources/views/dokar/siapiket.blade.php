@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Sistem Informasi Monitoring Jadwal Kerja Pegawai</h1>
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
                <div class="col-lg-12">
                    <div class="card card-primary"  id="divawal">
                        <div class="card-header">
                            <h3 class="card-title">Data Jadwal Yang Telah di Setorkan</h3>
                            <div class="card-tools">
                                <button class="btn btn-tool" id="btnexport"><i class="fa fa-file-excel-o"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="loading">
                                <img src="{{ asset('dist/img/loading.gif') }}" class="img-responsive" alt="Photo">
                            </div>
                            <div id="diveditor">
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
									<div class="row">
										<div class="col-lg-6 col-md-6">
											<label for="idparaf1">Paraf 1 Oleh:</label>
											<select id="idparaf1" name="idparaf1" size="1" class="form-control select2">
												<option value="">Pilih Salah Satu</option>
												<option value="SELF">Di Paraf Sendiri</option>
												@foreach($pejabats as $rpejabats)
													<option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
												@endforeach
											</select>
										</div>
										<div class="col-lg-6 col-md-6">
											<label for="idparaf2">Paraf 2 Oleh:</label>
											<select id="idparaf2" name="idparaf2" size="1" class="form-control select2">
												<option value="">Pilih Salah Satu</option>
												@foreach($pejabats as $rpejabats)
													<option value="{{ $rpejabats['id'] }}">{{ $rpejabats['pejabat'] }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-lg-6 col-md-6">
											<label for="idparaf3">Paraf 3 Oleh:</label>
											<select id="idparaf3" name="idparaf3" size="1" class="form-control select2">
												<option value="">Pilih Salah Satu</option>
												@foreach($pejabats as $rpejabats)
													<option value="{{ $rpejabats['id'] }}">{{ $rpejabats['pejabat'] }}</option>
												@endforeach
											</select>
										</div>
										<div class="col-lg-6 col-md-6">
											<label for="idparaf4">Paraf 4 Oleh:</label>
											<select id="idparaf4" name="idparaf4" size="1" class="form-control select2">
												<option value="">Pilih Salah Satu</option>
												@foreach($pejabats as $rpejabats)
													<option value="{{ $rpejabats['id'] }}">{{ $rpejabats['pejabat'] }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-danger pull-left" id="btncanceledit">Cancel</button>
                                    <button type="button" class="btn btn-success pull-right" id="btnsimpaneditor">Simpan</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div id='gridsuratkeluartanpanomor'></div>
                        </div>
                    </div>
                    <div class="card card-danger" id="divdetail">
                        <div class="card-header">
                            <h3 class="card-title" id="judul">Detail Jadwal</h3>
                            <div class="card-tools">
                                <button class="btn btn-tool" id="btntutupdetail"><i class="fa fa-close"></i></button>
                                <button class="btn btn-tool" id="btnexportdetail"><i class="fa fa-file-excel-o"></i></button>
                            </div>
                        </div>
                        <div class="card-body" id="diveditdetailjadwal">
                            <div class="form-group row">
                                <label for="id_nama" class="col-sm-3 col-form-label">Nama / Pin Finger <span class="text-danger">*</span>:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="id_nama" name="id_nama" readonly="readonly">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="id_range" name="id_range"  readonly="readonly">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="id_pin" name="id_pin"  readonly="readonly">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" id="hari">Sif/KTL/PSW</label>
                                <div class="col-sm-3">
                                    <select id="id_sif" name="id_sif" class="form-control">
                                        <option value="05:30-13:30">Sif Pagi (05:30-13:30)</option>
                                        <option value="06:00-14:00">Sif Pagi (06:00-14:00)</option>
                                        <option value="06:30-14:30">Sif Pagi (06:30-14:30)</option>
                                        <option value="11:00-19:00">Sif Middle (11:00-19:00)</option>
                                        <option value="13:00-21:00">Sif Siang (13:00-21:00)</option>
                                        <option value="14:00-22:00">Sif Siang (14:00-22:00)</option>
                                        <option value="22:00-06:00">Sif Malam (22:00-06:00)</option>
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
                                        <option value="Cuti">Cuti</option>
                                        <option value="LL">Libur Luaran</option>
                                        <option value="DL">Dinas Luar</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="ktl" name="ktl">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="psw" name="psw">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-danger pull-left" id="btncanceleditdetail">Cancel</button>
                                <button type="button" class="btn btn-success pull-right" id="btnsimpaneditordetail">Simpan</button>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div id='griddetail'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
    <div id="tabel_cetak"></div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="marking" id="marking" value="">
<input type="hidden" name="pembuat" id="pembuat" value="">
<input type="hidden" name="fakultas" id="fakultas" value="">
<input type="hidden" name="idne" id="idne" value="">

@endsection
@push('script')
<script>
    $(document).ready(function () {
        var token = document.getElementById('token').value;
        var sourcetblsrtkeluartnpnomor = {
            datatype: "json",
            datafields: [
                { name: 'id'},
                { name: 'nama_lengkap', type: 'text'},
                { name: 'tglbuat', type: 'text'},
                { name: 'fakultas', type: 'text'},
                { name: 'pembuat', type: 'text'},
                { name: 'perihal', type: 'text'},
                { name: 'isisurat', type: 'text'},
                { name: 'marking', type: 'text'},
                { name: 'idpejabat', type: 'text'},
                { name: 'paraf1', type: 'text'},
                { name: 'paraf2', type: 'text'},
                { name: 'paraf3', type: 'text'},
                { name: 'paraf4', type: 'text'},
                { name: 'tandatangan', type: 'text'},
                { name: 'footnote', type: 'text'},
            ],
            url: '{{route("getJadwalSIAPIKET")}}',
            cache: false,
        };
        var datajpejabat = new $.jqx.dataAdapter(sourcetblsrtkeluartnpnomor);
        $("#gridsuratkeluartanpanomor").jqxGrid({
            width: '100%',
            showfilterrow: true,
            filterable: true,
            columnsresize: true,
            autoshowfiltericon: true,
            pageable: true,
            autoheight: true,
            theme: "energyblue",
            source: datajpejabat,
            selectionmode: 'multiplecellsextended',
            columns: [
                { text: 'Edit', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', align: 'center', cellsrenderer: function () {
                    return "Edit";
                    }, buttonclick: function (row) {
                        editrow = row;	
                        var offset 		= $("#gridsuratkeluartanpanomor").offset();		
                        var dataRecord 	= $("#gridsuratkeluartanpanomor").jqxGrid('getrowdata', editrow);
                        $("#idne").val(dataRecord.id);
                        $("#marking").val(dataRecord.marking);
                        $("#upload_perihal").val(dataRecord.perihal);
                        $("#id_namapenandatangan").val(dataRecord.idpejabat).select2().trigger('change');
                        $("#idparaf1").val(dataRecord.paraf1).select2().trigger('change');
                        $("#idparaf2").val(dataRecord.paraf2).select2().trigger('change');
                        $("#idparaf3").val(dataRecord.paraf3).select2().trigger('change');
                        $("#idparaf4").val(dataRecord.paraf4).select2().trigger('change');
                        $('#diveditor').show();
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                    }
                },
                { text: 'Surat', editable: false, sortable: false, filterable: false,columntype: 'button', width: '5%', align: 'center', cellsrenderer: function () {
                    return "Preview";
                    }, buttonclick: function (row) {
                        editrow         = row;
                        var offset 		= $("#gridsuratkeluartanpanomor").offset();
                        var dataRecord 	= $("#gridsuratkeluartanpanomor").jqxGrid('getrowdata', editrow);
                        window.open("{{URL::to("/")}}/trackingid/srtklr-"+dataRecord.marking, '_blank');
                    }
                },
                { text: 'Detail', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
                    return "Detail";
                    }, buttonclick: function (row) {
                        editrow         = row;
                        var offset 		= $("#gridsuratkeluartanpanomor").offset();
                        var dataRecord 	= $("#gridsuratkeluartanpanomor").jqxGrid('getrowdata', editrow);
                        $("#marking").val(dataRecord.marking);
                        $("#pembuat").val(dataRecord.pembuat);
                        $("#fakultas").val(dataRecord.fakultas);
                        $("#judul").html(dataRecord.perihal);
                        $("#idne").val(dataRecord.id);
                        $('#divdetail').show();
                        $('#divawal').hide();
                        $('#diveditdetailjadwal').hide();
                        var sourcedetail = {
                            datatype: "json",
                            datafields: [
                                { name: 'id',type: 'string'},
                                { name: 'pin',type: 'string'},	
                                { name: 'nama',type: 'string'},
                                { name: 'unit',type: 'string'},
                                { name: 'jabatan',type: 'string'},	
                                { name: 'tanggal',type: 'string'},
                                { name: 'rangepresensi',type: 'string'},
                                { name: 'shift',type: 'string'},
                                { name: 'mulaikerja',type: 'string'},
                                { name: 'akhirkerja',type: 'string'},
                                { name: 'presensimulai',type: 'string'},
                                { name: 'presensiakhir',type: 'string'},
                                { name: 'ktl',type: 'string'},
                                { name: 'psw',type: 'string'},
                                { name: 'total',type: 'string'},
                                { name: 'created_by',type: 'string'},
                                { name: 'updated_by',type: 'string'},
                            ],
                            type: 'POST',
                            data: {	val01:dataRecord.isisurat, val02:dataRecord.pembuat, val03:dataRecord.fakultas,  _token: '{{ csrf_token() }}' },
                            url : '{{ route("detailSIAPiket") }}',
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
                                { text: 'Edit', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', align: 'center', cellsrenderer: function () {
                                    return "Edit";
                                    }, buttonclick: function (row) {
                                        editrow         = row;
                                        var offset 		= $("#griddetail").offset();
                                        var dataRecord 	= $("#griddetail").jqxGrid('getrowdata', editrow);
                                        $("#id_nama").val(dataRecord.nama);
                                        $("#id_range").val(dataRecord.rangepresensi);
                                        $("#id_pin").val(dataRecord.pin);
                                        $("#labelday").val(dataRecord.tanggal);
                                        $("#id_sif").val(dataRecord.shift);
                                        $("#idne").val(dataRecord.id);
                                        $('#diveditdetailjadwal').show();
                                        $("html, body").animate({ scrollTop: 0 }, "slow");
                                    }
                                },
                                { text: 'Nama', datafield: 'nama', width: 200, cellsalign: 'left', align: 'center'  },
                                { text: 'Unitkerja', datafield: 'unit', width: 100, cellsalign: 'left', align: 'center'  },
                                { text: 'PIN', datafield: 'pin', width: 50, cellsalign: 'center', align: 'center'  },
                                { text: 'Jabatan', datafield: 'jabatan', width: 150, cellsalign: 'left', align: 'center'  },
                                { text: 'Tanggal', datafield: 'tanggal', width: 90, cellsalign: 'left', align: 'center'  },
                                { text: 'Jadwal Masuk', datafield: 'mulaikerja', width: 150, cellsalign: 'left', align: 'center'  },
                                { text: 'Jadwal Pulang', datafield: 'akhirkerja', width: 150, cellsalign: 'left', align: 'center'  },
                                { text: 'Presensi Masuk', datafield: 'presensimulai', width: 150, cellsalign: 'left', align: 'center'  },
                                { text: 'Presensi Pulang', datafield: 'presensiakhir', width: 150, cellsalign: 'left', align: 'center'  },
                                { text: 'Keterlambatan', datafield: 'ktl', width: 120, cellsalign: 'center', align: 'center'  },
                                { text: 'Pulang Lebih Awal', datafield: 'psw', width: 130, cellsalign: 'center', align: 'center'  },
                                { text: 'Total (Detik)', datafield: 'total', width: 100, cellsalign: 'center', align: 'center'  },
                            ],
                        });
                    }
                },
                { text: 'Pengirim', datafield: 'nama_lengkap', width: '15%', cellsalign: 'left', align: 'center' },
                { text: 'Jadwal', datafield: 'perihal', filtertype: 'checkedlist', width: '20%', cellsalign: 'left', align: 'center' },
                { text: 'tgl Kirim', datafield: 'tglbuat', filtertype: 'date', width: '10%', cellsalign: 'left', align: 'center' },
                { text: 'Kelompok', datafield: 'fakultas', filtertype: 'checkedlist', width: '10%', cellsalign: 'left', align: 'center' },
                { text: 'Tandatangan', datafield: 'tandatangan', width: '10%', cellsalign: 'left', align: 'center' },
                { text: 'Catatan', datafield: 'footnote', width: '20%', cellsalign: 'left', align: 'center' },
            ]
        });
        $("#btnsimpaneditor").click(function(){
            var set05=document.getElementById('id_namapenandatangan').value;
            var set06=document.getElementById('idparaf1').value;
            var set07=document.getElementById('idparaf2').value;
            var set08=document.getElementById('idparaf3').value;
            var set09=document.getElementById('idparaf4').value;
            var set10=document.getElementById('marking').value;
            var set12=document.getElementById('upload_perihal').value;
            if (set05 == '' || set12 == ''){
                swal({
                    title	: 'Stop',
                    text	: 'Perihal dan Penandatangan Tidak Boleh Kosong',
                    type	: 'warning',
                })
            } else {
                $('#loading').show();
                $('#diveditor').hide();
                var form_data = new FormData();
                    form_data.append('file', null);
                    form_data.append('val02', '');
                    form_data.append('val03', '');
                    form_data.append('val04', set04);
                    form_data.append('val05', 'nonomor');
                    form_data.append('val06', set06);
                    form_data.append('val07', set07);
                    form_data.append('val08', set08);
                    form_data.append('val09', set09);
                    form_data.append('val10', set10);
                    form_data.append('val11', '');
                    form_data.append('val12', set12);
                    form_data.append('val13', '');
                    form_data.append('val14', '');
                    form_data.append('_token', '{{csrf_token()}}');
                $.ajax({
                    url	: '{{ route("exUploadSuratTTE") }}',
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
                            heading     : status,
                            text        : message,
                            position    : 'top-right',
                            loaderBg    : warna,
                            iconv       : icon,
                            hideAfter   : 5000,
                            stack       : 1
                        });
                        $('#loading').hide();
                        $("#gridsuratkeluartanpanomor").jqxGrid('updatebounddata', 'filter');
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
        $("#btnsimpaneditordetail").click(function(){
            var set11=document.getElementById('idne').value;
            var set12=document.getElementById('id_sif').value;
            var set13=document.getElementById('ktl').value;
            var set14=document.getElementById('psw').value;
            if (set12 == '' || set11 == ''){
                swal({
                    title	: 'Stop',
                    text	: 'ID dan Sif Tidak Boleh Kosong',
                    type	: 'warning',
                })
            } else {
                $('#loading').show();
                $('#diveditor').hide();
                var form_data = new FormData();
                    form_data.append('file', null);
                    form_data.append('val02', '');
                    form_data.append('val03', '');
                    form_data.append('val04', '');
                    form_data.append('val05', 'changesif');
                    form_data.append('val06', '');
                    form_data.append('val07', '');
                    form_data.append('val08', '');
                    form_data.append('val09', '');
                    form_data.append('val10', '');
                    form_data.append('val11', set11);
                    form_data.append('val12', set12);
                    form_data.append('val13', set13);
                    form_data.append('val14', set14);
                    form_data.append('_token', '{{csrf_token()}}');
                $.ajax({
                    url	: '{{ route("exUploadSuratTTE") }}',
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
                            heading     : status,
                            text        : message,
                            position    : 'top-right',
                            loaderBg    : warna,
                            iconv       : icon,
                            hideAfter   : 5000,
                            stack       : 1
                        });
                        $('#loading').hide();
                        $("#griddetail").jqxGrid('updatebounddata', 'filter');
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
        $('#divdetail').hide();
        $('#diveditor').hide();
        $('#loading').hide();
        $("#btntutupdetail").click(function(){
            $('#divdetail').hide();
            $('#divdetail').hide();
            $('#diveditor').hide();
            $('#divawal').show();
        });
        $("#btncanceledit").click(function(){
            $('#diveditor').hide();
        });
        $("#btncanceleditdetail").click(function(){
            $('#diveditdetailjadwal').hide();
        });
        $("#btnexport").click(function(){
            var gridContent = $("#gridsuratkeluartanpanomor").jqxGrid('exportdata', 'json');
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
        $("#btnexportdetail").click(function(){
            var gridContent = $("#griddetail").jqxGrid('exportdata', 'json');
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
    });
</script>
@endpush