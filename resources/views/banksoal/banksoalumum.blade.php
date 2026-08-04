@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Bank Soal</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active">Bank Soal</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="row">
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
              <li class="nav-item active">
                <a href="#" class="nav-link" id="btnviewskdonly">
                  <i class="fa fa-inbox"></i> Kompetensi Dasar
                  <span class="badge badge-primary float-right">{{$skd}}</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" id="btnviewskbonly">
                  <i class="fa fa-inbox"></i> Kompetensi Bidang
                  <span class="badge badge-primary float-right">{{$skb}}</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" id="btnarsip">
                  <i class="fa fa-envelope"></i> Arsip
                  <span class="badge badge-primary float-right">{{$arsip}}</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" id="btnexport">
                  <i class="fa fa-print"></i> Export
                </a>
              </li>
            </ul>
          </div>
          <div class="card-footer">
            <div id="gridstatistik"></div>
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
              <table class="table products-list" id="table_list">
                  <thead>
                      <tr>
                        <th class="text-center">
                          Deskripsi Soal
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
            <h3 class="card-title">Add/Edit/Remove</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool btnkembali">
                <i class="fa fa-close"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label>Status</label>
                  <select id="id_code" class="form-control select2">
                    <option value="KD">Kompetensi Dasar</option>
                    <option value="KB">Kompetensi Bidang</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>Kelompok Soal</label>
                  <input type="text" class="form-control" id="id_ceel" placeholder="Kelompok Soal">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Case Deskription</label>
              <textarea id="id_deskripsi" rows="5" cols="20"></textarea>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-6 col-md-6">
                  <span class="label label-lg label-success arrowed-right">Option A</span>
                  <textarea id="id_optiona" rows="5" cols="20"></textarea>
                </div>
                <div class="col-lg-6 col-md-6">
                  <span class="label label-lg label-success arrowed-right">Option B</span>
                  <textarea id="id_optionb" rows="5" cols="20"></textarea>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-6 col-md-6">
                  <span class="label label-lg label-success arrowed-right">Option C</span>
                  <textarea id="id_optionc" rows="5" cols="20"></textarea>
                </div>
                <div class="col-lg-6 col-md-6">
                  <span class="label label-lg label-success arrowed-right">Option D</span>
                  <textarea id="id_optiond" rows="5" cols="20"></textarea>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-6 col-md-6">
                  <span class="label label-lg label-success arrowed-right">Option E</span>
                  <textarea id="id_optione" rows="5" cols="20"></textarea>
                </div>
                <div class="col-lg-6 col-md-6">
                  <span class="label label-lg label-success arrowed-right">Keys</span>
                  <select id="id_keys" class="form-control">
                    <option value="">Please Select</option>
                    <option value="A">Option A</option>
                    <option value="B">Option B</option>
                    <option value="C">Option C</option>
                    <option value="D">Option D</option>
                    <option value="E">Option E</option>
                  </select>
                  <button type="button" class="btn btn-primary btn-block" id="btnopengambar">Tambah Lampiran Gambar</button></p>
                  <div class="form-group" id="divlampiran">
                    <img src="boxed-bg.png" alt="image" id="preview" class="img-size-50">
                    <input type="file" id="id_fotoprofile" style="display: none;"/>
                    <button type="button" class="btn btn-danger btn-block" id="btnuploadfoto">&nbsp;&nbsp;Upload Lampiran Foto&nbsp;&nbsp;</button></p>
                  </div>
                </div>
              </div>
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
              <button type="button" class="btn btn-tool btnkembali">
                <i class="fa fa-close"></i>
              </button>
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
            <div id="gridberkas"></div>
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
<input type="hidden" name="set_jenis" id="set_jenis" value="1">
@endsection
@push('script')
<script type="text/javascript">
  $(function () {
      $('#table_list tbody').on('click', '.btnubah', function () {
        id = $(this).data("id");
        $("#edit_idne").val(id);
        var token 	= document.getElementById('token').value;
        $.post('{{ route("getFirstSoal") }}', { val01: id, _token: token },function(data){
          var idsoal    = data.idsoal;
          var kode      = data.kode;
          var kunci     = data.kunci;
          var deskripsi = data.deskripsi;
          var opsia     = data.opsia;
          var opsib     = data.opsib;
          var opsic     = data.opsic;
          var opsid     = data.opsid;
          var opsie     = data.opsie;
          var ceel      = data.ceel;
          var lampiran  = data.lampiran;
          if (lampiran == ''){
            $('#preview').attr('src', 'boxed-bg.png');
          } else {
            $('#divlampiran').show();
            $('#preview').attr('src', lampiran);
          }
          $("#id_code").val(kode).select2().trigger('change');
          $("#id_ceel").val(ceel);
          $('#id_deskripsi').summernote('code', deskripsi);
          $('#id_optiona').summernote('code', opsia);
          $('#id_optionb').summernote('code', opsib);
          $('#id_optionc').summernote('code', opsic);
          $('#id_optiond').summernote('code', opsid);
          $('#id_optione').summernote('code', opsie);
          $("#id_keys").val(kunci);
          $("#id_fotoprofile").val('');
          $('#divawal').hide();
          $('#diveditor').show();
        });
      });
      $('.select2').select2({width: '100%'});
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
  $(document).ready(function() {
    $('#id_deskripsi').summernote()
		$('#id_optiona').summernote()
		$('#id_optionb').summernote()
		$('#id_optionc').summernote()
		$('#id_optiond').summernote()
		$('#id_optione').summernote()
		$('#divlampiran').hide();
    $('#divberkas').hide();
    $('#divawal').show();
    $('#diveditor').hide();
    $('#btnopengambar').on('click', function (){	
      $('#divlampiran').show();
    });
    $('#btnuploadfoto').on('click', function (){	
      $('#id_fotoprofile').click();
    });
    $("#btnupdatedataps").click(function(){
      var val01=document.getElementById('edit_idne').value;
      var val02=document.getElementById('id_code').value;
      var val03=document.getElementById('id_ceel').value;
      var val04=$('#id_deskripsi').summernote('code');
      var val05=$('#id_optiona').summernote('code');
      var val06=$('#id_optionb').summernote('code');
      var val07=$('#id_optionc').summernote('code');
      var val08=$('#id_optiond').summernote('code');
      var val09=$('#id_optione').summernote('code');
      var val10=document.getElementById('id_keys').value;
      var val11=document.getElementById('id_fotoprofile');
      if (val02 == '' ||  val04 == '' || val05 == '' || val06 == '' || val07 == '' || val08 == '' || val09 == '' || val10 == ''){
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
          form_data.append('set05', val05);
          form_data.append('set06', val06);
          form_data.append('set07', val07);
          form_data.append('set08', val08);
          form_data.append('set09', val09);
          form_data.append('set10', val10);
          form_data.append('file', val11.files[0]);
          form_data.append('_token', '{{csrf_token()}}');
        $.ajax({
          url         : '{{ route("exInputBankSoal") }}',
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
      }
    });
    $("#btndelete").click(function(){
      var val01=document.getElementById('edit_idne').value;
      var val02=document.getElementById('id_code').value;
      var val03=document.getElementById('id_ceel').value;
      var val04=$('#id_deskripsi').summernote('code');
      var val05=$('#id_optiona').summernote('code');
      var val06=$('#id_optionb').summernote('code');
      var val07=$('#id_optionc').summernote('code');
      var val08=$('#id_optiond').summernote('code');
      var val09=$('#id_optione').summernote('code');
      var val10=document.getElementById('id_keys').value;
      var val11=document.getElementById('id_fotoprofile');
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
          form_data.append('file', null);
          form_data.append('_token', '{{csrf_token()}}');
        $.ajax({
            url         : '{{ route("exInputBankSoal") }}',
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
    $("#btncekkembaran").click(function(){
      var val01=$('#id_deskripsi').summernote('code');
      if (val01 == ''){
        swal({
          title	: 'Stop',
          text	: 'Deskripsi Soal Wajib di Isi Untuk di Bandingkan',
          type	: 'warning',
        })
      } else {
          $.post('{{ route("exCeksoalkembar") }}', {  set01: val01, _token: '{{ csrf_token() }}' },
          function(data){			
              var newWindow = window.open('', '', 'width=800, height=500'),
                  document = newWindow.document.open(),
                  pageContent =
                      '<!DOCTYPE html>\n' +
                      '<html>\n' +
                      '<head>\n' +
                      '<meta charset="utf-8" />\n' +
                      '<title>Cek Result</title>\n' +
                      '</head>\n' +
                      '<body>' + data + '\n</body>\n</html>';
                  document.write(pageContent);
                  document.close();
          });
      }
    });
    $("#btnexport").click(function(){
      var val01=document.getElementById('set_jenis').value;
      $.post('{{ route("exaddtotxt") }}', {  set01: val01, _token: '{{ csrf_token() }}' },
      function(data){			
          var newWindow = window.open('', '', 'width=800, height=500'),
              document = newWindow.document.open(),
              pageContent =
                  '<!DOCTYPE html>\n' +
                  '<html>\n' +
                  '<head>\n' +
                  '<meta charset="utf-8" />\n' +
                  '<title>Exported Files</title>\n' +
                  '</head>\n' +
                  '<body>' + data + '\n</body>\n</html>';
              document.write(pageContent);
              document.close();
      });
    });
    $('.btnkembali').click(function () {
      $('#divberkas').hide();
      $('#divawal').show();
      $('#diveditor').hide();
    });
    $('#btnopennew').click(function () {
      $("#edit_idne").val('new');
      $('#preview').attr('src', 'boxed-bg.png');
      $('#divlampiran').hide();
      $('#divawal').hide();
      $('#diveditor').show();
      $('#id_deskripsi').summernote('code', '');
      $('#id_optiona').summernote('code', '');
      $('#id_optionb').summernote('code', '');
      $('#id_optionc').summernote('code', '');
      $('#id_optiond').summernote('code', '');
      $('#id_optione').summernote('code', '');
      $("#id_keys").val('');
    });
    $('#btnviewskdonly').click(function () {
      $("#set_jenis").val('KD');
      $('#table_list').dataTable().fnDraw();
    });
    $('#btnviewskbonly').click(function () {
      $("#set_jenis").val('KB');
      $('#table_list').dataTable().fnDraw();
    });
    $('#btnarsip').click(function () {
      $("#set_jenis").val('0');
      $('#table_list').dataTable().fnDraw();
    });
    $('#btn-clear').click(function(){
        $('.form-filter').val('');
    });
    $('#btn-search').click(function(){
        $('#table_list').dataTable().fnDraw();
    });
    var col_order   = ["deskripsi", "tahun"];
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
              url   : '{{ route("getBankSoal") }}',
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
            "data"      : {
              idsoal    : "idsoal",
              kode      : "kode",
              tipesoal  : "tipesoal",
              deskripsi : "deskripsi",
              jawaba    : "jawaba",
              jawabb    : "jawabb",
              jawabc    : "jawabc",
              jawabd    : "jawabd",
              jawabe    : "jawabe",
              lampiran  : "lampiran",
              kuncie    : "kuncie",
              showjawab : "showjawab",
            },
            "orderable" : true,
            render      : function (data, type, row, meta) {
              nomor = meta.row + meta.settings._iDisplayStart + 1;
              var aktif     = data.aktif;
              var lampiran  = data.lampiran;
              if (aktif == 1){
                var aktif = '<span class="badge badge-success float-right">'+data.kode+'</span>'
              } else {
                var aktif = '<span class="badge badge-danger float-right">'+data.kode+'</span>'
              }
              if (lampiran == ''){
                var lampiran = '<img src="boxed-bg.png" alt="Product Image" class="img-size-50">'
              } else {
                var lampiran = '<img src="'+data.lampiran+'" alt="Product Image" class="img-size-50">'
              }
              str   = '<div class="item"><div class="product-img">'+lampiran+'</div>'+
                    '<div class="product-info">'+
                    nomor+'. <a href="javascript:void(0)" class="product-title btnubah" data-id="'+data.idsoal+'">'+data.deskripsi+
                      aktif+'</a><br />'+
                      '<span class="product-description">'+data.showjawab+'</span>'+
                    '</div></div>';
              return str;
            }
          },
        ],
        "initComplete"  : function(settings, json) {
        }
    });
    var sumbergrafik2 = {
      datatype: "json",
      datafields: [
        { name: 'ceel', type: 'text'},
        { name: 'kode', type: 'text'},
        { name: 'jumlah', type: 'text'},
      ],
      type: 'POST',
      data: {set01:'rekap', set02:'', set03:'', _token: '{{ csrf_token() }}'},
      url: '{{ route("jsonallcase") }}'
    };
    var datagrafik2 = new $.jqx.dataAdapter(sumbergrafik2);
    $("#gridstatistik").jqxGrid({
      width: '100%',
      columnsresize: true,
      sortable: true,
      source: datagrafik2,
      theme: "energyblue",
      columns: [
        { text: 'Kode', datafield: 'kode', width: '25%', cellsalign: 'center', align: 'center'  },
        { text: 'Kelompok', datafield: 'ceel', width: '50%', cellsalign: 'left', align: 'center'  },
        { text: 'Jumlah', datafield: 'jumlah', width: '25%', cellsalign: 'center', align: 'center'  },
      ]
    });
  });
</script>
@endpush