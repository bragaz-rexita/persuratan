@extends('adminlte3.layoutstandart')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> User Admin</h1>
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
        <div id="loading">
            <img src="{{ asset('dist/img/loading.gif') }}" class="img-responsive" alt="Photo">
        </div>
        <div class="card" id="divawal">
            <div class="card-header">
                <h3 class="card-title">All User</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body p-0" >
                <table class="table table-striped projects" id="table_list">
                    <thead>
                        <tr>
                            <th colspan="3">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-danger btn-icon btn-sm" id="btn-clear"><i class="fa fa-remove"></i></button>
                                    <button type="button" class="btn btn-success btn-icon btn-sm" id="btn-search"><i class="fa fa-search"></i></button>
                                </div>
                            </th>
                            <th>
                                <input type="text" class="form-control form-filter" id="s_jenispeg" name="s_jenispeg"/>
							</th>
                            <th>
                                <input type="text" class="form-control form-filter" id="s_nama_lengkap" name="s_nama_lengkap"/>
							</th>
                            <th>
                                <input type="text" class="form-control form-filter" id="s_alamat" name="s_alamat"/>
							</th>
                            <th>
                                <input type="text" class="form-control form-filter" id="s_no_hp" name="s_no_hp"/>
							</th>
                            <th>
                                <input type="text" class="form-control form-filter" id="s_email" name="s_email"/>
							</th>
                        </tr>
                        <tr>
                            <th style="width: 1%">
                                #
                            </th>
                            <th style="width: 7%" class="text-center">
                                Foto
                            </th>
                            <th style="width: 18%" class="text-center">
                                Action
                            </th>
                            <th style="width: 10%" class="text-center">
                                Previlage
                            </th>
                            <th style="width: 29%" class="text-center">
                                Nama Lengkap
                            </th>
                            <th style="width: 25%" class="text-center">
                                Asal
                            </th>
                            <th style="width: 10%" class="text-center">
                                No.HP
                            </th>
                            <th style="width: 10%" class="text-center">
                                Email
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
	</div>
</div>
<div class="modal fade" id="modalubahdata">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Editor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="id_nama" class="col-form-label">Nama</label>
                    <input type="text" class="form-control" id="id_nama">
                </div>
                <div class="form-group">
                    <label for="id_alamat" class="col-form-label">Alamat</label>
                    <input type="text" class="form-control" id="id_alamat">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="id_previlage" class="col-form-label">Privilage</label>
                        <select id="id_previlage" name="id_previlage" size="1" class="form-control">
                            @if (Session('fakultas') == 'BS')
                                <option value="administarator">administarator</option>
                                <option value="inputor">inputor</option>
                                <option value="verifikator">Verifikator</option>
                                <option value="penguji">Penguji Lisan</option>
                                <option value="warga">Reset ke Pendaftar</option>
                            @elseif (Session('fakultas') == 'AIPKI')
                                <option value="administrasi">Administrasi (Persuratan)</option>
                                <option value="warga">Reset ke Pendaftar</option>
                            @else
                                <option value="administrasi">Sekretaris ( Admin Persuratan )</option>
                                <option value="Admin SDM">Administrasi Kepegawaian (SDM)</option>
                                <option value="Pelamar">Pelamar</option>
                                <option value="warga">Reset ke Pendaftar</option>
                            @endif
                            @if(isset($pejabat) AND !empty($pejabat))
                                @foreach($pejabat as $rpejabats)
                                    <option value="{{ $rpejabats['pejabat'] }}">{{ $rpejabats['pejabat'] }}</option>
                                @endforeach
                            @endif
                            @if(isset($kelompoklain) AND !empty($kelompoklain))
                                @foreach($kelompoklain as $rkelompoklain)
                                    <option value="{{ $rkelompoklain['namakelompok'] }}">{{ $rkelompoklain['namakelompok'] }}</option>
                                @endforeach
                            @endif
                            <option value="Arsip">Arsip (Data Non Aktif)</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="id_nik" class="col-form-label">NIK</label>
                        <input type="text" class="form-control" id="id_nik">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="id_email" class="col-form-label">Email</label>
                        <input type="text" class="form-control" id="id_email">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="id_nohp" class="col-form-label">No. HP</label>
                        <input type="text" class="form-control" id="id_nohp">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="id_tanya" class="col-form-label">Ubah Password.?</label>
                        <select id="id_tanya" name="id_tanya" size="1" class="form-control">
                            <option value="Tidak">Tidak</option>
                            <option value="Ubah">Ubah</option>
                        </select>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="id_baru" class="col-form-label">Password Baru</label>
                        <input type="text" class="form-control" id="id_baru">
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>	
                <input type="hidden" class="form-control" id="id_idne">
                <button type="button" class="btn btn-success" id="btnsimpan">Save</button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@push('script')
<script type="text/javascript">
    $(function () {
        $('#table_list tbody').on('click', '.btnubah', function () {
            id              = $(this).data("id"); 
            jenispeg        = $(this).data("jenispeg"); 
            nama_lengkap    = $(this).data("nama_lengkap"); 
            nik             = $(this).data("nik"); 
            alamat          = $(this).data("alamat"); 
            no_hp      		= $(this).data("no_hp");
            email      	    = $(this).data("email");
            $("#id_idne").val(id);
            $("#id_nama").val(nama_lengkap);
            $("#id_alamat").val(alamat);
            $("#id_previlage").val(jenispeg);
            $("#id_nik").val(nik);
            $("#id_email").val(email);
            $("#id_nohp").val(no_hp);
            $('#modalubahdata').modal('show');
        });
        $('#table_list tbody').on('click', '.btnreset', function () {
            id = $(this).data("id");
            email = $(this).data("email");
            swal({
                title: 'Apakah anda yakin ?',
                text: "Account Will Be Resetter, And Email Verification will be resend",
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-confirm mt-2',
                cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                confirmButtonText: 'Yes'
            }).then(function () {
                $('#loading').show();
                $('#divawal').hide();
                var formdata = new FormData();
                    formdata.set('val01', id);
				    formdata.set('val02', email);
				    formdata.set('val03', '');
				    formdata.set('val04', '');
					formdata.set('val05', '');
					formdata.set('val06', '');
					formdata.set('val07', '');
					formdata.set('val08', '');
					formdata.set('val09', '');
					formdata.set('val10', 'emailresetter');
					formdata.set('_token','{{ csrf_token() }}');
                url='{{ route("exEditProfil") }}';
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
                        $('#loading').hide();
                        $('#divawal').show();
                        swal({
                            title   : response.status,
                            text    : response.message,
                            type    : response.type,
                        });
                        $('#table_list').dataTable().fnDraw();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#loading').hide();
                        $('#divawal').show();
                        swal({
                            title: textStatus,
                            text:  jqXHR.responseText,
                            type: 'info',
                        });
                    }
                });
            });
        });
    });
    $(document).ready(function() {
        $('#loading').hide();
        $('#btnsimpan').click(function () {
            var set01=document.getElementById('id_idne').value;
            var set02=document.getElementById('id_nama').value;
            var set03=document.getElementById('id_alamat').value;
            var set04=document.getElementById('id_previlage').value;
            var set05=document.getElementById('id_nik').value;
            var set06=document.getElementById('id_email').value;
            var set07=document.getElementById('id_nohp').value;
            var set08=document.getElementById('id_tanya').value;
            var set09=document.getElementById('id_baru').value;
            var token=document.getElementById('token').value;
            if (set08 == 'Ubah' && set09 == ''){
                swal({
                    title: 'Mohon lengkapi',
                    text: 'Isi Password Terlebih Dahulu',
                    type: 'info',
                });
            } else {
                if (set01 == '' || set02 == '' || set03 == '' || set04 == '' || set05 == '' || set06 == '' || set07 == ''){
                    swal({
                        title: 'Mohon lengkapi',
                        text: 'Semua Data Wajib di Isi',
                        type: 'info',
                    });
                } else {
                    $('#modalubahdata').modal('hide');
                    var formdata = new FormData();
                        formdata.set('val01', set01);
                        formdata.set('val02', set02);
                        formdata.set('val03', set03);
                        formdata.set('val04', set04);
                        formdata.set('val05', set05);
                        formdata.set('val06', set06);
                        formdata.set('val07', set07);
                        formdata.set('val08', set08);
                        formdata.set('val09', set09);
                        formdata.set('val10', 'ubahprofil');
                        formdata.set('_token',token);
                    url='{{ route("exEditProfil") }}';
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
                            $('#loading').hide();
                            $('#divawal').show();
                            swal({
                                title   : response.status,
                                text    : response.message,
                                type    : response.type,
                            });
                            $('#table_list').dataTable().fnDraw();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            $('#loading').hide();
                            $('#divawal').show();
                            swal({
                                title: textStatus,
                                text:  jqXHR.responseText,
                                type: 'info',
                            });
                        }
                    });
                }
            }
        });
        $('#btn-clear').click(function(){
            $('.form-filter').val('');
        });
        $('#btn-search').click(function(){
            $('#table_list').dataTable().fnDraw();
        });
        var col_order   = ["jenispeg", "nama_lengkap", "nik", "alamat", "no_hp", "email"];
        var table 		= $('#table_list').DataTable({
            responsive: true, 
            dom: "<'row'<'col-sm-12'tr>>\
            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
            lengthMenu: [10, 25, 50, 100],
            pageLength: 10,
            ordering:true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: function(data, callback, settings) {
                $.ajax({
                    url: '{{ route("dataUserAll") }}',
                    data: {
                        limit           : settings._iDisplayLength,
                        page            : Math.ceil(settings._iDisplayStart / settings._iDisplayLength) + 1,
                        jenispeg        : $('#s_jenispeg').val(),
                        nama_lengkap    : $('#s_nama_lengkap').val(),
                        nik             : $('#s_nik').val(),
                        alamat          : $('#s_alamat').val(),
                        no_hp           : $('#s_no_hp').val(),
                        email           : $('#s_email').val(),
                        order           : col_order[settings.aaSorting[0][0]]+' '+settings.aaSorting[0][1],
                    },
                    type: "GET",
                    beforeSend: function(request) {
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
                        foto	: "foto",
                    },
                    "orderable" : false,
                    "render"    : function(data, type, full, meta) {
                        if (data.foto == ''){
                            str = '<img alt="Avatar" class="table-avatar" src="mascot.png">';
                        } else {
                            str = '<img alt="Avatar" class="table-avatar" src="images/pegawai/'+data.foto+'">';
                        }
                        return str;
                    }
                },
                {
                    "data"      : {
                        id              : "id",
                        jenispeg        : "jenispeg",
                        nama_lengkap    : "nama_lengkap",
                        nik             : "nik",
                        alamat          : "alamat",
                        no_hp  		    : "no_hp",
                        email  	        : "email",
                    },
                    "orderable" : false,
                    "render"    : function(data, type, full, meta) {
                        str = '<div class="btn-group"><a class="btn btn-xs btn-app bg-primary btnubah" href="javascript:;" data-id="'+data.id+'" data-jenispeg="'+data.jenispeg+'" data-nama_lengkap="'+data.nama_lengkap+'" data-nik="'+data.nik+'" data-alamat="'+data.alamat+'" data-no_hp="'+data.no_hp+'" data-email="'+data.email+'" ><i class="fa fa-recycle"></i> Edit</a>'+
                                '<a class="btn btn-xs btn-app bg-info" href="logkhusus/'+data.email+'"><i class="fa fa-user-secret"></i> LogOn</a>'+
                                '<a class="btn btn-xs btn-app bg-warning btnreset" href="javascript:;" data-id="'+data.id+'" data-email="'+data.email+'" ><i class="fa fa-users"></i> Password Resetter</a></div>';
                        return str;
                    }
                },
                {
                    "data": "jenispeg",
                },
                {
                    "data": "nama_lengkap",
                },
                {
                    "data": "alamat",
                },
                {
                    "data": "no_hp",
                },
                {
                    "data": "email",
                },
            ],

            "initComplete": function(settings, json) {
                
            }
        });
    });
</script>
@endpush