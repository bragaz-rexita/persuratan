@extends('layout.master')

@section('subheader')
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class=" kt-container  d-flex align-items-stretch justify-content-between ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Users </h3>
				<div class="kt-subheader__breadcrumbs">
					<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon-users"></i></a>
					<span class="kt-subheader__breadcrumbs-separator"></span>
					<a href="" class="kt-subheader__breadcrumbs-link">
                        Master User </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
					<a href="" class="kt-subheader__breadcrumbs-link">
						Form User </a>
				</div>
			</div>
			{{-- <div class="kt-subheader__toolbar">

                <div class="kt-subheader__wrapper">
                    <a href="{{route('dashboard')}}" class="btn kt-subheader__btn-secondary">
                        Kembali
                    </a>
                </div>
                
            </div> --}}
		</div>
	</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8">

        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Form User
                    </h3>
                </div>
            </div>

            <!--begin::Form-->
            <form class="kt-form" id="formdata" id="formdata" enctype="multipart/form-data">
                <div class="kt-portlet__body">
                    <div class="kt-section kt-section--first">
                        <h3 class="kt-section__title">Informasi Akun:</h3>
                        <div class="kt-section__body">
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Foto</label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_profile_avatar">
                                        <div class="kt-avatar__holder" id="avatar_holder" style="background-image: url('<?php echo url('dist/assets/media/users/no_avatar.jpeg'); ?>');width: 140px;height:140px"></div>
                                        <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Ubah Foto">
                                            <i class="fa fa-pen"></i>
                                            <input type="file" name="avatar" id="avatar" accept=".png, .jpg, .jpeg">
                                        </label>
                                        <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Batalkan Foto">
                                            <i class="fa fa-times"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Username:</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Input Username" autocomplete="off">
                                    <span class="form-text text-muted">Karaker Username yang diizinkan : A-Z a-z 0-9 . _ - </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Email:</label>
                                <div class="col-lg-6">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Input Email" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Status:</label>
                                <div class="col-lg-6">
                                    <select name="status" id="status" class="form-control">
                                        <option value="">--Pilih--</option>
                                        <option value="1">Aktif</option>
                                        <option value="0">Non Aktif</option>
                                        <option value="9">Blok</option>
                                    </select>    
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Role:</label>
                                <div class="col-lg-6">
                                    <select name="role" id="role" class="form-control">
                                        <option value="">--Pilih--</option>
                                    </select>    
                                </div>
                            </div>
                        </div>
                        <h3 class="kt-section__title">Profil Akun:</h3>
                        <div class="kt-section__body">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Nama:</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Input Nama" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">No HP:</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="Input No HP" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Status Peneliti:</label>
                                <div class="col-lg-6">
                                    <select name="jenis_user" id="jenis_user" class="form-control">
                                        <option value="">--Pilih--</option>
                                    </select>    
                                </div>
                            </div>
                            <div id="form_profil">
                                
                            </div>
                        </div>
                        <div id="alertvalidate"></div>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <button type="button" class="btn btn-success" id="btn_submit">Simpan</button>
                                <a href="{{route('users')}}" class="btn btn-secondary">Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!--end::Form-->
        </div>

        <!--end::Portlet-->
    </div>
    <div class="col-lg-2"></div>

</div>

<script>
	var _token = '{{ Session::get('token') }}';
    var _action = '{{$action}}';
    var _id = '{{$id}}';

    var KTRegister = function() {
        
        var getComboROle = function(_callback=function(){}) {
            KTApp.blockPage({overlayColor: '#000000',type: 'v2',state: 'success',message: 'Please wait...'});
            $.ajax({
                type        : 'ajax',
                url			: "<?php echo URL::to('/api/auth/role_list'); ?>",
                method      : 'get',
                dataType    : 'json',
                beforeSend: function(request) {
		                    request.setRequestHeader('Authorization', 'Bearer ' + _token);
                },
                success     : function(data){
                                // console.log(data.data);
                                var dt = '<option value="">--Pilih--</option>';
                                if (data.data){
                                    for(i=0;i<data.data.length;i++){
                                        // console.log(data.data[i].no_kk);
                                        dt = dt +"<option value='"+data.data[i].id+"'>"+data.data[i].name+"</option>";
                                    }
                                    
                                }
                                $('#role').html(dt);
                                _callback();
                },
                error: function(e) {
                    _callback();
                    console.log("Not Found");
                }
            });            
        }

        
        var getComboPeneliti = function() {
            // KTApp.blockPage({overlayColor: '#000000',type: 'v2',state: 'success',message: 'Please wait...'});
            $.ajax({
                type        : 'ajax',
                url			: "<?php echo URL::to('/api/refapp'); ?>" + "/cmb_user_peneliti",
                method      : 'get',
                dataType    : 'json',
                success     : function(data){
                                // console.log(data.data);
                                var dt = '<option value="">--Pilih--</option>';
                                if (data.data){
                                    for(i=0;i<data.data.length;i++){
                                        // console.log(data.data[i].no_kk);
                                        dt = dt +"<option value='"+data.data[i].descrip+"'>"+data.data[i].descrip+"</option>";
                                    }
                                    
                                }
                                $('#jenis_user').html(dt);
                },
                error: function(e) {
                    console.log("Not Found");
                }
            });            
        }

        var datajenjang = '<option value="">--Pilih--</option>';
        var getComboJenjang = function(valjenjang=null) {
            var dt;
            KTApp.blockPage({overlayColor: '#000000',type: 'v2',state: 'success',message: 'Please wait...'});
            $.ajax({
                type        : 'ajax',
                url			: "<?php echo URL::to('/api/refapp'); ?>" + "/cmb_jenjang",
                method      : 'get',
                async       : false,
                dataType    : 'json',
                success     : function(data){
                                // console.log(data.data);
                                dt = '<option value="">--Pilih--</option>';
                                if (data.data){
                                    for(i=0;i<data.data.length;i++){
                                        // console.log(data.data[i].no_kk);
                                        selected='';
                                        if(data.data[i].descrip==valjenjang) selected = 'selected';
                                        dt = dt +"<option value='"+data.data[i].descrip+"' "+selected+">"+data.data[i].descrip+"</option>";
                                    }
                                    
                                }
                                // return dt;
                },
                error: function(e) {
                    dt = '<option value="">--Pilih--</option>';
                    // return dt;
                    console.log("Not Found");
                }
            });
            return dt;
        } 

        var datarumpun = '';
        var getDataRumpun = function() {
            KTApp.blockPage({overlayColor: '#000000',type: 'v2',state: 'success',message: 'Please wait...'});
            $.ajax({
                type        : 'ajax',
                url			: "<?php echo URL::to('/api/rumpunilmu_list'); ?>",
                method      : 'get',
                async       : false,
                dataType    : 'json',
                success     : function(data){
                                // console.log(data.data);
                                var dt = '<datalist id="nama_bidang">';
                                if (data.data){
                                    for(i=0;i<data.data.length;i++){
                                        // console.log(data.data[i].no_kk);
                                        dt = dt +"<option value='"+data.data[i].rumpun+"'>";
                                    }
                                    
                                }
                                dt = dt + '</datalist">';
                                datarumpun = dt;
                },
                error: function(e) {
                    console.log("Not Found");
                }
            });            
        }
        
        var datajurusan = '<option value="">--Pilih--</option>';
        var getDataJurusan = function(valjurusan=null) {
            KTApp.blockPage({overlayColor: '#000000',type: 'v2',state: 'success',message: 'Please wait...'});
            var dtjurusan;
            $.ajax({
                type        : 'ajax',
                url			: "<?php echo URL::to('/api/jur_prodi_list'); ?>",
                method      : 'get',
                data        : {is_jurusan:1},
                async       : false,
                dataType    : 'json',
                success     : function(data){
                                // console.log(data.data);
                                dtjurusan = '<option value="">--Pilih--</option>';
                                if (data.data){
                                    for(i=0;i<data.data.length;i++){
                                        // console.log(data.data[i].no_kk);
                                            checked='';
                                            if(valjurusan==data.data[i].kode) checked='selected';
                                            dtjurusan = dtjurusan +"<option value='"+data.data[i].kode+"' "+checked+">"+data.data[i].nama_jur_prodi+"</option>";
                                    }
                                    
                                }
                                datajurusan = dtjurusan;
                },
                error: function(e) {
                    console.log("Not Found");
                }
            });
            return dtjurusan;            
        }

        var getDataProdi = function(valjurusan,valprodi=null){
            KTApp.blockPage({overlayColor: '#000000',type: 'v2',state: 'success',message: 'Please wait...'});
            $.ajax({
                type        : 'ajax',
                url			: "<?php echo URL::to('/api/jur_prodi_list'); ?>",
                method      : 'get',
                data        : {is_jurusan:0, kode_like:valjurusan},
                async       : false,
                dataType    : 'json',
                success     : function(data){
                                // console.log(data.data);
                                var dtprodi = '<option value="">--Pilih--</option>';
                                if (data.data){
                                    for(i=0;i<data.data.length;i++){
                                        // console.log(data.data[i].no_kk);
                                            checked='';
                                            if(valprodi==data.data[i].kode) checked='selected';
                                            dtprodi = dtprodi +"<option value='"+data.data[i].kode+"' "+checked+">"+data.data[i].nama_jur_prodi+"</option>";
                                    }
                                    
                                }
                                $('#prodi').html(dtprodi) ;
                },
                error: function(e) {
                    console.log("Not Found");
                }
            });
        }

        var changeJurusan =  function(){
            $('#jurusan').change(function(){
                var val_jurusan = $('#jurusan').val();
                if(val_jurusan!=''){
                    getDataProdi(val_jurusan);
                }else{
                    $('#prodi').html('<option value="">--Pilih--</option>') ;
                }
            });
        };
		 
        var avatar;
        var formNull = '';
        var formMahasiswa = function(datajenjang,datajurusan,data=null) {
            if(data){
                nim=data.nim;
                universitas=data.universitas;
                fakultas=data.fakultas;
                prodi=data.prodi;
            }else{
                nim='';
                universitas='';
                fakultas='';
                prodi='';
            }
            return '<div class="form-group row">'+
                                    '<label class="col-lg-3 col-form-label">NIM:</label>'+
                                    '<div class="col-lg-6">'+
                                        '<input type="text" class="form-control" value="'+nim+'" name="nim" id="nim" placeholder="Input NIM" autocomplete="off">'+
                                    '</div>'+
                                '</div>'+
                                '<div class="form-group row">'+
                                    '<label class="col-lg-3 col-form-label">Jenjang Pendidikan:</label>'+
                                    '<div class="col-lg-6">'+
                                        '<select name="jenjang" id="jenjang" class="form-control">'+
                                            datajenjang+
                                        '</select>'+    
                                    '</div>'+
                                '</div>'+
                                '<div class="form-group row">'+
                                    '<label class="col-lg-3 col-form-label">Universitas:</label>'+
                                    '<div class="col-lg-6">'+
                                        '<input type="text" class="form-control" value="'+universitas+'" name="universitas" id="universitas" placeholder="Input Universitas" autocomplete="off">'+
                                    '</div>'+
                                '</div>'+
                                '<div class="form-group row">'+
                                    '<label class="col-lg-3 col-form-label">Jurusan:</label>'+
                                    '<div class="col-lg-6">'+
                                        '<select name="jurusan" id="jurusan" class="form-control">'+
                                            datajurusan+
                                        '</select>'+    
                                    '</div>'+
                                '</div>'+
                                '<div class="form-group row">'+
                                    '<label class="col-lg-3 col-form-label">Program Pendidikan:</label>'+
                                    '<div class="col-lg-6">'+
                                        '<select name="prodi" id="prodi" class="form-control">'+
                                            '<option value-"">--Pilih--</option>'+
                                        '</select>'+    
                                    '</div>'+
                                '</div>';
        }
        var formDosen = function(datajenjang,datajurusan,datarumpun,data=null){
            if(data){
                bidang_keahlian=data.bidang_keahlian;
            }else{
                bidang_keahlian='';
            }
            return '<div class="form-group row">'+
                                    '<label class="col-lg-3 col-form-label">Jenjang Pendidikan:</label>'+
                                    '<div class="col-lg-6">'+
                                        '<select name="jenjang" id="jenjang" class="form-control">'+
                                            datajenjang+
                                        '</select>'+    
                                    '</div>'+
                                '</div>'+
                                '<div class="form-group row">'+
                                    '<label class="col-lg-3 col-form-label">Jurusan:</label>'+
                                    '<div class="col-lg-6">'+
                                        '<select name="jurusan" id="jurusan" class="form-control">'+
                                            datajurusan+
                                        '</select>'+    
                                    '</div>'+
                                '</div>'+
                                '<div class="form-group row">'+
                                    '<label class="col-lg-3 col-form-label">Program Pendidikan:</label>'+
                                    '<div class="col-lg-6">'+
                                        '<select name="prodi" id="prodi" class="form-control">'+
                                            '<option value-"">--Pilih--</option>'+
                                        '</select>'+    
                                    '</div>'+
                                '</div>'+
                                '<div class="form-group row">'+
                                    '<label class="col-lg-3 col-form-label">Bidang Keahlian:</label>'+
                                    '<div class="col-lg-6">'+
                                        '<input type="text" class="form-control" value="'+bidang_keahlian+'" list="nama_bidang" name="bidang_keahlian" id="bidang_keahlian" placeholder="Input Bidang Keahlian" autocomplete="off">'+
                                            datarumpun+
                                    '</div>'+
                                '</div>';
        }
        var formUmum = function(data=null){
            if(data){
                instansi=data.instansi;
            }else{
                instansi='';
            }
            return '<div class="form-group row">'+
                                    '<label class="col-lg-3 col-form-label">Instansi:</label>'+
                                    '<div class="col-lg-6">'+
                                        '<input type="text" class="form-control" value="'+instansi+'" name="instansi" id="instansi" placeholder="Input Instansi" autocomplete="off">'+
                                    '</div>'+
                                '</div>';
        }
        
        var loadpage = function(){
			avatar = new KTAvatar('kt_profile_avatar');
            KTApp.blockPage({overlayColor: '#000000',type: 'v2',state: 'success',message: 'Please wait...'});
            if(_action=='add'){
                getComboROle();
                getComboPeneliti();
                // getComboJenjang();
            }else{
                $.ajax({
                    type        : 'ajax',
                    url			: "<?php echo URL::to('/api/auth/show_user'); ?>"+"/"+_id,
                    method      : 'get',
                    dataType    : 'json',
                    beforeSend: function(request) {
                                request.setRequestHeader('Authorization', 'Bearer ' + _token);
                    },
                    success     : function(data){
                                    user =  data.user;
                                    role = data.role;
                                    profile = data.profile;
                                    if (profile.avatar) {
                                        $('#avatar_holder').attr('style', "background-image: url('<?php echo url('storage'); ?>/"+profile.avatar+"') !important;width: 140px;height:140px");
                                    }
                                    $('#username').val(user.username).attr('disabled', true);
                                    $('#email').val(user.email);
                                    $('#status').val(user.status);
                                    getComboROle(function(){
                                        $('#role').val(role.role_id);
                                    });
                                    getComboPeneliti(function(){
                                        $('#jenis_user').val(profile.jenis_user);
                                    
                                    });
                                    switch (role.role_id) {
                                        case 1:
                                            getComboUser('CMB_USER_OPERATOR',function(){
                                                $('#jenis_user').val(profile.jenis_user);
                                            });
                                            break;
                                        case 2:
                                            getComboUser('CMB_USER_REVIEWER',function(){
                                                $('#jenis_user').val(profile.jenis_user);
                                            });
                                            break;
                                        case 3:
                                            getComboUser('CMB_USER_PENELITI',function(){
                                                $('#jenis_user').val(profile.jenis_user);
                                            });
                                            break;
                                    }
                                    $('#nama').val(profile.nama);
                                    $('#no_hp').val(profile.no_hp);
                                    switch (profile.jenis_user) {
                                        case 'MAHASISWA':
                                            datajenjang=getComboJenjang(profile.jenjang);
                                            datajurusan=getDataJurusan(profile.jurusan);
                                            $('#form_profil').html(formMahasiswa(datajenjang,datajurusan,profile));
                                            getDataProdi(profile.jurusan,profile.prodi);
                                            changeJurusan();
                                            break;
                                        case 'DOSEN':
                                            datajenjang=getComboJenjang(profile.jenjang);
                                            datajurusan=getDataJurusan(profile.jurusan);
                                            getDataRumpun();
                                            $('#form_profil').html(formDosen(datajenjang,datajurusan,datarumpun,profile));
                                            getDataProdi(profile.jurusan,profile.prodi);
                                            changeJurusan();
                                            break;
                                        case 'UMUM':
                                            $('#form_profil').html(formUmum(profile));
                                            break;
                                    }
                    },
                    error: function(e) {
                        console.log("Not Found");
                    }
                });   
            }
        }
        
        var handleRegisterFormSubmit = function() {
            $('#role').change(function(e){
                var valrole = $(this).val();
                switch (valrole) {
                    case '1':
                        getComboUser('CMB_USER_OPERATOR');
                        $('#form_profil').html(formNull);
                        break;
                    case '2':
                        getComboUser('CMB_USER_REVIEWER');
                        $('#form_profil').html(formNull);
                        break;
                    case '3':
                        getComboUser('CMB_USER_PENELITI');
                        $('#form_profil').html(formNull);
                        break;
                    default:
                        getComboUser('KOSONG');
                        $('#form_profil').html(formNull);
                        break;
                }
            });
            $('#jenis_user').change(function(e){
                var valjenis = $(this).val();
                switch (valjenis) {
                    case 'MAHASISWA':
                        datajenjang=getComboJenjang();
                        datajurusan=getDataJurusan();
                        $('#form_profil').html(formMahasiswa(datajenjang,datajurusan));
                        changeJurusan();
                        break;
                    case 'DOSEN':
                        datajenjang=getComboJenjang();
                        datajurusan=getDataJurusan();
                        getDataRumpun();
                        $('#form_profil').html(formDosen(datajenjang,datajurusan,datarumpun));
                        changeJurusan();
                        break;
                    case 'UMUM':
                        $('#form_profil').html(formUmum());
                        break;
                    default:
                        $('#form_profil').html(formNull);
                        break;
                }
            });
            $('#btn_submit').click(function(e) {
                KTApp.blockPage({overlayColor: '#000000',type: 'v2',state: 'success',message: 'Please wait...'});
                // $('html, body').animate({ scrollTop: 0 }, 'fast');
                var formdata = new FormData($('#formdata')[0]);
                
                var btn = $(this);
                
                btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
                if(_action=='add'){
                    url = "<?php echo URL::to('/api/auth/add_user'); ?>"; 
                }else{
                    url = "<?php echo URL::to('/api/auth/update_user_admin'); ?>"+"/"+_id;
                }
                $.ajax({
                    type: 'ajax',
                    url: url,
                    method: 'post',
                    data: formdata,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function(request) {
                                request.setRequestHeader('Authorization', 'Bearer ' + _token);
                    },
                    success: function(response, status, xhr) {
                        btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
                        $('#alertvalidate').html('');
					
                        swal.fire("Sukses!", "Data Berhasil disimpan!!", "success").then((result) =>{
                            window.location = "<?php echo URL::to('/users'); ?>/";
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
                        if (jqXHR.status == 404) {
                            alert = '<div class="alert alert-warning alert-styled-left alert-dismissible"">'+
                                    '<button type="button" class="close" data-dismiss="alert"><span>×</span></button>'+
                                    '<span class="font-weight-semibold">Warning!</span> <ul><li>' +
                                jqXHR.responseJSON.message +
                                '</li></ul></div>';
                            $('#alertvalidate').html(alert);
                            swal.fire("Gagal!", "Data Gagal disimpan!! "+jqXHR.responseJSON.message, "error");
                            
                        } else if (jqXHR.status == 422) {
                            var response = JSON.parse(jqXHR.responseText);
                            var errorString = '<ul>';
                            $.each(response.errors, function(key, value) {
                                errorString += '<li>' + value + '</li>';
                            });
                            errorString += '</ul>';

                            alert = '<div class="alert alert-warning alert-styled-left alert-dismissible"">'+
                                    '<button type="button" class="close" data-dismiss="alert"><span>×</span></button>'+
                                    '<span class="font-weight-semibold">Warning!</span> '+ errorString +'</div>';

                            $('#alertvalidate').html(alert);

                            swal.fire("Gagal!", "Data Gagal disimpan!! Inputan harus sesuai", "error");

                        } else {
                            alert = '<div class="alert alert-warning alert-styled-left alert-dismissible"">'+
                                    '<button type="button" class="close" data-dismiss="alert"><span>×</span></button>'+
                                    '<span class="font-weight-semibold">Warning!</span> <ul><li>' +
                                'Data Gagal disimpan!!Terjadi Kesalahan sistem' +
                                '</li></ul></div>';
                            $('#alertvalidate').html(alert);
                            swal.fire("Gagal!", "Data Gagal disimpan!!Terjadi Kesalahan sistem", "error");
                        }
                    }
                });
            });
        }

        
        // Public Functions
        return {
            // public functions
            init: function() {
                loadpage();
                handleRegisterFormSubmit();
            }
        };
    }();

    // Class Initialization
    jQuery(document).ready(function() {
        KTRegister.init();
    });

    function blockui(){
		KTApp.blockPage({overlayColor: '#000000',type: 'v2',state: 'success',message: 'Please wait...'});
	}
	$(document).ajaxStop($.unblockUI); //unblockui jika setiap proses ajax selesai


</script>
@endsection


