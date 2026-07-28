@extends('adminlte3.layoutstandart')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Open Recruitment</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" id="tanggalserver">Open Recruitment</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary card-outline" id="divawal">
          <div class="card-header">
            <h3 class="card-title">Pilihan Formasi Yang Ingin di Pilih (1 akun, 1 pilihan)</h3>
            <div class="card-tools">
              <div class="input-group input-group-sm">
                <input type="text" class="form-control" placeholder="Search data" id="main_valcari">
                <div class="input-group-append">
                  <div class="btn btn-primary" id="btn-search">
                    <i class="fa fa-search"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive mailbox-messages">
              <table class="table table-striped projects" id="table_list">
                  <thead>
                      <tr>
                          <th style="width: 1%">
                              #
                          </th>
                          <th style="width: 31%" class="text-center">
                              Formasi
                          </th>
                          <th style="width: 40%" class="text-center">
                              Keterangan
                          </th>
                      </tr>
                  </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="card card-success card-outline" id="diveditor">
          <div class="card-header">
            <h3 class="card-title">Detail Formasi</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool btnkembali">
                <i class="fa fa-close"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
                <label for="edit_namaps">Unit dan Jabatan</label>
                <input type="text" id="edit_namaps" class="form-control"  disabled="disable"/>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-3">
                  <label>Kebutuhan (Formasi)</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-users"></i></span>
                    </div>
                    <input type="text" id="edit_idpejabat" class="form-control"  disabled="disable"/>
                  </div>
                </div>
                <div class="col-md-3">
                  <label>Status</label>
                  <select id="edit_kodeps" size="1" class="form-control" disabled="disable">
                    <option value="aktif">Aktif</option>
                    <option value="arsip">Non Aktif</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <label>Pendaftaran Mulai</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="text" id="edit_tanggalberdiri" class="form-control" disabled="disable" />
                  </div>
                </div>
                <div class="col-md-2">
                  <label>Sampai Tanggal</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="text" id="edit_tanggalijin" class="form-control" disabled="disable" />
                  </div>
                </div>
                <div class="col-md-2">
                  <label>This Date</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="text" id="edit_tanggalskrg" value="{{date('Y-m-d')}}" class="form-control" disabled="disable" />
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <textarea id="id_namaenglish" name="id_namaenglish" readonly></textarea>
            </div>
          </div>
          <div class="card-footer justify-content-between">
            <input type="hidden" id="edit_idne">
            <button class="btn btn-success pull-left" type="button" id="btnupdatedataps">Daftarkan Diri</button>
            <button class="btn btn-warning pull-left btnkembali" type="button">Batal</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
    <input type="text" id="edit_jenjang" class="form-control"  disabled="disable"/>
</div>
            
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="set_jenis" id="set_jenis" value="aktif">
@endsection
@push('script')
<script type="text/javascript">
  $(function () {
      $('#table_list tbody').on('click', '.btnubah', function () {
          id = $(this).data("id");
          $("#edit_idne").val(id);
          var token 	= document.getElementById('token').value;
          $.post('{{ route("getFirstPengumuman") }}', { val01: id, _token: token },
            function(data){
              var namaenglish = data.namaenglish; 
              var nama        = data.nama; 
              var jenjang     = data.jenjang;
              var idpejabat   = data.idpejabat;
              var kodeps      = data.kodeps; 
              var tanggal     = data.tanggal; 
              var tglskijin   = data.tglskijin; 
              var jenjang     = data.jenjang;
              var campur      = jenjang+' di '+nama;
              $("#edit_namaps").val(campur);
              $("#edit_jenjang").val(jenjang);
              $("#edit_idpejabat").val(idpejabat);
              $("#edit_kodeps").val(kodeps);
              $("#edit_tanggalberdiri").val(tanggal);
              $("#edit_tanggalijin").val(tglskijin);
              $('#id_namaenglish').summernote('code', namaenglish);
              $('#divawal').hide();
              $('#diveditor').show();
          });
            
      });
  });
  $(document).ready(function() {
    const d = new Date();
    let text = d.toDateString();

    $("#tanggalserver").html(text);
          
    $('#id_namaenglish').summernote()
	  $('#divawal').show();
    $('#diveditor').hide();
    $("#btnupdatedataps").click(function(){
        var val01       = document.getElementById('edit_idne').value;
        var val02       = document.getElementById('edit_tanggalberdiri').value;
        var val03       = document.getElementById('edit_tanggalijin').value;
        var val04       = document.getElementById('edit_tanggalskrg').value;
        var currentDate = new Date(val04);
        var from        = new Date(val02);
        var to          = new Date(val03);
        var check       = new Date(currentDate);
        var sesuai      = (check >= from && check <= to);
        if (sesuai){
            var form_data = new FormData();
            form_data.append('set01', val01);
            form_data.append('set02', val02);
            form_data.append('set03', val03);
            form_data.append('_token', '{{csrf_token()}}');
            $.ajax({
                url         : '{{ route("exDaftarkanDiri") }}',
                data        : form_data,
                type        : 'POST',
                contentType : false,
                processData : false,
                success     : function (data) {
                    location.reload();
                },
                error: function (xhr, status, error) {
                    swal({
                        title	: 'Stop',
                        text	: xhr.responseText,
                        type	: 'warning',
                    })
                }
            });
        
        } else {
            swal({
                title	: 'Stop',
                text	: 'Tanggal '+currentDate+' Tidak diantara Tanggal '+val02+' dan Tanggal Akhir Pendaftaran '+val03,
                type	: 'warning',
            })
        }
    });
    $('.btnkembali').click(function () {
      $('#divpeminat').hide();
      $('#divberkas').hide();
      $('#divfrontpage').show();
      $('#divawal').show();
      $('#diveditor').hide();
    });
    $('#btn-clear').click(function(){
        $('.form-filter').val('');
    });
    $('#btn-search').click(function(){
        $('#table_list').dataTable().fnDraw();
    });
    var col_order   = ["nama", "namaenglish"];
    var table 		= $('#table_list').DataTable({
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
              url   : '{{ route("dataPengumuman") }}',
              data  : {
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
                var isi = data.terisi;
                if (isi > 200){
                    str = '<a>'+data.nama+' ( '+data.jenjang+' )</a><br/>'+
                          '<small>Kebutuhan Formasi / Peminat : '+data.idpejabat+' / '+data.terisi+'</small><br/>'+
                          '<small>Berkas Yang di Persyaratkan : '+data.berkas+'</small><br/>'+
                          '<small>Perdaftaran Mulai - Sampai : '+data.tanggal+' - '+data.tglskijin+'</small><br/>'+
                          data.status+'<a class="btn btn-block btn-danger" href="javascript:;" data-id="'+data.id+'"><i class="fa fa-ban"></i>&nbsp;&nbsp;FULL&nbsp;&nbsp;</a>';
                } else {
                    str = '<a>'+data.nama+' ( '+data.jenjang+' )</a><br/>'+
                          '<small>Kebutuhan Formasi / Peminat : '+data.idpejabat+' / '+data.terisi+'</small><br/>'+
                          '<small>Berkas Yang di Persyaratkan : '+data.berkas+'</small><br/>'+
                          '<small>Perdaftaran Mulai - Sampai : '+data.tanggal+' - '+data.tglskijin+'</small><br/>'+
                          data.status+'<a class="btn btn-block btn-success btnubah" href="javascript:;" data-id="'+data.id+'"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Mendaftarkan Diri&nbsp;&nbsp;</a>';
                }
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
  });
</script>
@endpush