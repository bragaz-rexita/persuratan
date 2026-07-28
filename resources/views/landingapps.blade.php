@extends('adminlte3.layoutstandart')
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
            <div class="row" >
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#depan" data-toggle="tab">Portal</a></li>
                                <li class="nav-item"><a class="nav-link" href="#formonline" data-toggle="tab">All Apps</a></li>
                                <li class="nav-item"><a class="nav-link" href="#telemedicine" data-toggle="tab">Contact Us</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="divawal">
                                <div class="active tab-pane" id="depan">
                                    <div class="row">
                                    @if(isset($klients) && !empty($klients))
                                            @foreach($klients as $rows)
                                            <div class="col-md-6">
                                                <div class="card card-widget collapsed-card">
                                                    <div class="card-header">
                                                        <div class="user-block">
                                                            <img class="img-circle" src="{!! $rows['icon'] !!}" alt="User Image">
                                                            <span class="username"><a href="#">{!! $rows['name'] !!}</a></span>
                                                            <span class="description"> {!! $rows['domainapps'] !!}</span>
                                                        </div>
                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="attachment-block clearfix">
                                                            <img class="attachment-img" src="{!! $rows['logofrontapps'] !!}" alt="Attachment Image">
                                                            <div class="attachment-pushed">
                                                                <h4 class="attachment-heading">{!! $rows['name'] !!}</h4>
                                                                <div class="attachment-text">
                                                                    {!! $rows['domainapps'] !!}
                                                                    <br />{!! $rows['subdomainapps'] !!}
                                                                    <br />{!! $rows['subsubdomainapps'] !!}
                                                                    <br />{!! $rows['addressapps'] !!} {!! $rows['kota'] !!}
                                                                    <br />{!! $rows['emailapps'] !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn btn-default btn-sm"><a href="{!! $rows['lamanportal'] !!}"><i class="fa fa-share"></i> Open Link</a></button>
                                                        <span class="float-right text-muted">{!! $rows['domain'] !!}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        @else
                                            <div class="col-sm-2">
                                                <a href="#" data-toggle="lightbox" data-title="{!! config('global.Title') !!}" data-gallery="gallery">
                                                    <img src="{{ asset('dist/img/logo.png') }}" class="img-fluid mb-2" alt="{!! config('global.Title') !!}"/>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane" id="formonline">
                                    <div class="duidevproduct-list">
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://radiology.duidev.com/';">
                                            <div class="duidevproduct_image"> 
                                            <img src="https://radiology.duidev.com/assets/images/avatars/logomini.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>Radiology Information System</p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://simbian.kejati-jatim.go.id/';">
                                            <div class="duidevproduct_image"> 
                                            <img src="https://simbian.kejati-jatim.go.id/images/img-01.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>SIMBIAN - KEJATI SBY</p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'http://ajpi.fp.ub.ac.id/';">
                                            <div class="duidevproduct_image"> 
                                            <img src="https://duidev.com/public/duidev-softwarehouse.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>Asosiasi Jurnal Pertanian Indonesia</p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://sigap.ub.ac.id/login.php';">
                                            <div class="duidevproduct_image"> 
                                            <img src="https://sigap.ub.ac.id/images/mascot.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>Sistem Informasi Gaji Pegawai (SIGAP)</p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://sco.ub.ac.id/cekandroid/{{$firebaseid}}';">
                                            <div class="duidevproduct_image"> 
                                            <img src="https://sco.ub.ac.id/logo-ub.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>Smart and Collaborative Office UB</p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://sco.ub.ac.id/safehome/{{$firebaseid}}';">
                                            <div class="duidevproduct_image"> 
                                            <img src="https://sco.ub.ac.id/logo-safehouse.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>SafeHouse UB</p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://sco.ub.ac.id/bazishome/{{$firebaseid}}';">
                                            <div class="duidevproduct_image"> 
                                            <img src="https://banksoal.duidev.com/duidev-softwarehouse.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>Badan Amil Zakat UB</p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://insitu.fk.ub.ac.id/cekandroid/{{$firebaseid}}';">
                                            <div class="duidevproduct_image"> 
                                            <img src="https://duidev.com/public/duidev-softwarehouse.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>Fakultas Kedokteran UB</p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://siatfp.ub.ac.id/cekandroid/{{$firebaseid}}';">
                                            <div class="duidevproduct_image"> 
                                            <img src="https://duidev.com/public/duidev-softwarehouse.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>Fakultas Pertanian UB</p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://fia.ub.ac.id/sifia/cekandroid/{{$firebaseid}}';">
                                            <div class="duidevproduct_image"> 
                                            <img src="https://sco.ub.ac.id/logo-ub.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>Fakultas Ilmu Administrasi UB</p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://sco.ub.ac.id/sivoka';">
                                            <div class="duidevproduct_image"> 
                                            <img src="https://sco.ub.ac.id/logo-ub.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>Fakultas Vokasi UB</p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://sco.ub.ac.id/mipa';">
                                            <div class="duidevproduct_image"> 
                                            <img src="https://sco.ub.ac.id/logo-ub.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>Fakultas MIPA UB</p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://fikes.ub.ac.id';">
                                            <div class="duidevproduct_image"> 
                                            <img src="https://sco.ub.ac.id/logo-ub.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>Fakultas Ilmu Kesehatan UB</p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://wakepen.duidev.com/';">
                                            <div class="duidevproduct_image"> 
                                            <img src="https://duidev.com/public/duidev-softwarehouse.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>Aplikasi Kependudukan RT/RW </p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://simbian.duidev.com/webinar';">
                                            <div class="duidevproduct_image"> 
                                            <img src="https://firrec.org/wp-content/uploads/2020/07/logo.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>Webinar System</p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://fikes.ub.ac.id/loginsikomet';">
                                            <div class="duidevproduct_image"> 
                                            <img src="https://duidev.com/public/duidev-softwarehouse.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>Sistem Informasi Etik Penelitian</p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://pasangkayu.duidev.com';">
                                            <div class="duidevproduct_image"> 
                                            <img src="https://duidev.com/public/duidev-softwarehouse.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>Sistem Informasi IPM dan IPG</p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://sco.ub.ac.id/simpen';">
                                            <div class="duidevproduct_image"> 
                                            <img src="https://sco.ub.ac.id/logo-ub.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>Sistem Peminjaman Ruang</p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://ar-rahman.duidev.com';">
                                            <div class="duidevproduct_image"> 
                                            <img src="https://duidev.com/public/duidev-softwarehouse.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>Masjid Ar Rohman </p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://amil.sdimohammadhatta.sch.id/cekandroid/{{$firebaseid}}';">
                                            <div class="duidevproduct_image"> 
                                            <img src="https://simbian.duidev.com/logo/1602884372logo.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>SD Islam Mohammad Hatta</p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://gmm.duidev.com/frontpage?id=3?firebaseid={{$firebaseid}}';">
                                            <div class="duidevproduct_image"> 
                                                <img src="https://gmm.duidev.com/logo/1603375609logo.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>MI Maarif Sukun 1</p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://gmm.duidev.com/frontpage?id=4?firebaseid={{$firebaseid}}';">
                                            <div class="duidevproduct_image"> 
                                                <img src="https://gmm.duidev.com/logo/1603375659logo.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>MI Maarif Sukun 2</p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://gmm.duidev.com/frontpage?id=5?firebaseid={{$firebaseid}}';">
                                            <div class="duidevproduct_image"> 
                                                <img src="https://gmm.duidev.com/logo/1632284089logo.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>SMP Islam Maarif 02</p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://gmm.duidev.com/frontpage?id=6?firebaseid={{$firebaseid}}';">
                                            <div class="duidevproduct_image"> 
                                                <img src="https://gmm.duidev.com/logo/1603375704logo.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>SMK Islam Maarif</p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://simbian.duidev.com/frontpage?id=7?firebaseid={{$firebaseid}}';">
                                            <div class="duidevproduct_image"> 
                                            <img src="https://simbian.duidev.com/logo/1609804637logo.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>SMK Wachid Hasyim Surabaya</p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://simbian.duidev.com/frontpage?id=1?firebaseid={{$firebaseid}}';">
                                            <div class="duidevproduct_image"> 
                                            <img src="https://simbian.duidev.com/logo/1653361770logo.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>SDIT SALSABILA KEPANJEN</p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://alqalam.duidev.com/sch/{{$firebaseid}}';">
                                            <div class="duidevproduct_image"> 
                                            <img src="https://simbian.duidev.com/logo/1643895019logo.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>Al Qalam Malang</p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://banksoal.duidev.com';">
                                            <div class="duidevproduct_image"> 
                                            <img src="https://banksoal.duidev.com/duidev-softwarehouse.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>Bank Soal</p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://aipki.duidev.com';">
                                            <div class="duidevproduct_image"> 
                                            <img src="https://aipki.duidev.com/duidev-softwarehouse.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>AIPKI</p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://rsph.duidev.com';">
                                            <div class="duidevproduct_image"> 
                                            <img src="https://aipki.duidev.com/duidev-softwarehouse.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>RSPH</p>
                                            </div>
                                        </div>
                                        <div class="duidevproduct 1" onclick="window.location.href = 'https://pj.duidev.com/frontpage?id=10?firebaseid={{$firebaseid}}';">
                                            <div class="duidevproduct_image"> 
                                            <img src="https://pj.duidev.com/logo/1662246561logo.png" /> 
                                            </div>
                                            <div class="duidevproduct_title title-white">
                                                <p>Pesantren Jumat</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="telemedicine">
                                    <div class="card card-widget widget-user-2">
                                        <div class="widget-user-header bg-success">
                                            <div class="widget-user-image">
                                                <img class="img-circle elevation-2" src="https://duidev.com/public/DP.jpg" alt="User Avatar">
                                            </div>
                                            <h3 class="widget-user-username">Profil Perusahaan</h3>
                                            <h5 class="widget-user-desc">CV. Swandhana</h5>
                                        </div>
                                    </div>
                                    <div class="card card-primary shadow">
                                        <div class="card-header">
                                            <h3 class="card-title">About Me</h3>
                                        </div>
                                        <div class="card-body">
                                            <strong><i class="fa fa-book mr-1"></i> Bidang Jasa</strong>
                                            <p class="text-muted">Pengadaan Aplikasi Berbasis Website, Company Profile, Blog, etc</p>
                                            <hr>
                                            <strong><i class="fa fa-map-marker mr-1"></i> Alamat</strong>
                                            <p class="text-muted">Jl. Sebuku X/18 Bunulrejo Blimbing Malang</p>
                                            <hr>
                                            <strong><i class="fa fa-pencil mr-1"></i> Skills</strong>
                                            <p class="text-muted">
                                                <span class="badge badge-danger">UI Design</span>
                                                <span class="badge badge-success">Coding</span>
                                                <span class="badge badge-info">Javascript</span>
                                                <span class="badge badge-warning">PHP</span>
                                                <span class="badge badge-primary">Laravel</span>
                                            </p>
                                            <hr>
                                            <strong><i class="fa fa-file mr-1"></i> Notes</strong>
                                            <p class="text-muted"><a href="http://wa.me/6281359108565" target="_blank">WA ME : 081359108565</a>; Email : swandhana17@gmail.com</p>
                                        </div>
                                        <div class="card-footer">
                                            <a href="https://duidev.com/public/format/duidev_profile.gif" target="_blank"><img src="https://duidev.com/public/format/swandhana.gif" alt="Company Profile" width="100%"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<style>
    .duidevproduct-list {
        z-index: 0;
        width: 100%;
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
    }

    .duidevproduct {
        margin: 30px auto;
        width: 300px;
        height: 300px;
        border-radius: 20px;
        box-shadow: 5px 5px 30px 7px rgba(0,0,0,0.25), -5px -5px 30px 7px rgba(0,0,0,0.22);
        cursor: pointer;
        transition: 0.4s;
        background-color: #3498db;
    }
    
    .duidevproduct .duidevproduct_image {
    width: inherit;
    height: inherit;
    border-radius: 20px;
    }

    .duidevproduct .duidevproduct_image img {
    margin-top: 10px;
    margin-left: 30px;
    width: 240px;
    height: 240px;
    border-radius: 20px;
    object-fit: cover;
    }

    .duidevproduct .duidevproduct_title {
        text-align: center;
        border-radius: 0px 0px 20px 20px;
        font-family: sans-serif;
        font-weight: bold;
        font-size: 16px;
        margin-top: -40px;
        padding: 10px;
        height: 60px;
        background-color: #2980b9;
    }

    .duidevproduct:hover {
    transform: scale(0.9, 0.9);
    box-shadow: 5px 5px 30px 15px rgba(0,0,0,0.25), 
        -5px -5px 30px 15px rgba(0,0,0,0.22);
    }

    .title-white {
    color: white;
    }

    .title-yellow {
    color: yellow;
    }

    .title-black {
    color: black;
    }

    @media  all and (max-width: 500px) {
    .duidevproduct-list {
        /* On small screens, we are no longer using row direction but column */
        flex-direction: column;
    }
    }
</style>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@push('script')
<script type="text/javascript">
    $(function () {
        $('.select2').select2({width: '100%'});
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });
    });
    function submitForm(e) {
        var keyCode = e.keyCode ? e.keyCode : e.which;
        if (keyCode == 13){
            $('#btnlogin').click();
        }
    }
    $(document).ready(function() {
        $('#loading').hide();
        $('#divlupapassword').hide();
        $('#divterimakasih').hide();
        $('.rujukan').hide();
        $('#btnkelogin').click(function () {
            $('#formisitelemedi').show();
            $('#divlupapassword').hide();
        });
        $('#btnlupapassword').click(function () {
            $('#formisitelemedi').hide();
            $('#divlupapassword').show();
        });
        $('#btnsimpan').click(function () {
            var set01=document.getElementById('id_nama').value;
            var set02=document.getElementById('id_ktp').value;
            var set03=document.getElementById('id_email').value;
            var set04=document.getElementById('id_hape').value;
            var token=document.getElementById('token').value;
            if (set01 == ''){ 
                swal({
                    title   : 'Mohon lengkapi',
                    text    : 'Nama Lengkap Wajib di Isi',
                    type    : 'info',
                });
            } else if (set02 == ''){ 
                swal({
                    title   : 'Mohon lengkapi',
                    text    : 'Afiliasi Belum Terisi',
                    type    : 'info',
                });
            } else if (set03 == ''){
                swal({
                    title   : 'Mohon lengkapi',
                    text    : 'Email Aktif Wajib di Isi',
                    type    : 'info',
                });
            } else if (set04 == ''){ 
                swal({
                    title   : 'Mohon lengkapi',
                    text    : 'No. HP Wajib di Isi',
                    type    : 'info',
                });
            } else {
                $('#loading').show();
                $('#divawal').hide();
                var formdata = new FormData();
                    formdata.set('val01',set01);
				    formdata.set('val02',set02);
				    formdata.set('val03',set03);
				    formdata.set('val04',set04);
					formdata.set('val05','new');
					formdata.set('val08','{{date("Y-m-d")}}');
					formdata.set('val09','{{date("Y-m-d")}}');
					formdata.set('_token',token);
                url='{{ route("exDaftarBaru") }}';
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
                        $('#status').html(response.status);
                        $('#pesan').html(response.message);
                        $('#divisian').hide();
                        $('#divterimakasih').show();
                        $('#loading').hide();
                        $('#divawal').show();
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
        });
        $('#btnkirimemail').click(function () {
            var set01=document.getElementById('lupa_email').value;
            var token=document.getElementById('token').value;
            if (set01 == ''){
                swal({
                    title: 'Mohon lengkapi',
                    text: 'Email Aktif Wajib di Isi',
                    type: 'info',
                });
            } else {
                $('#loading').show();
                $('#divawal').hide();
                
                var formdata = new FormData();
                    formdata.set('val01',set01);
				    formdata.set('val02','resetpassword');
				    formdata.set('val03','');
				    formdata.set('val04','');
					formdata.set('_token',token);
                url='{{ route("exResetPassword") }}';
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
                            title: response.status,
                            text:  'Welcome '+response.message,
                            type: 'info',
                        });
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
        });
        $('#btnlogin').click(function () {
            var set01=document.getElementById('login_email').value;
            var set02=document.getElementById('login_password').value;
            var token=document.getElementById('token').value;
            if (set01 == ''){
                swal({
                    title: 'Mohon lengkapi',
                    text: 'Email Aktif Wajib di Isi',
                    type: 'info',
                });
            } else if (set02 == ''){
                swal({
                    title: 'Mohon lengkapi',
                    text: 'Password Wajib di Isi',
                    type: 'info',
                });
            } else {
                $('#loading').show();
                $('#divawal').hide();
                var formdata = new FormData();
                    formdata.set('email',set01);
				    formdata.set('password',set02);
					formdata.set('_token',token);
                url='{{ route("exLogin") }}';
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
                            title: 'Success',
                            text:  'Welcome '+response.user.nama,
                            type: 'info',
                        });
                        location.reload();
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
        });
    });
</script>
@endpush