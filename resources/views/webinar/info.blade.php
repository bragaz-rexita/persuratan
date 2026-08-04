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
            <div class="row" >
                <div class="col-md-12">
                    <div class="card card-solid">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-5">
									<div class="card card-body">
										<div class="row">
											<div class="col-lg-6">
												<a href="{{ url('/') }}/hadir/{{$revent->id}}"  class="btn btn-block btn-primary">
													<i class="fa fa-plus"></i><span class="pull-right">Isi Presensi</span>
												</a>
											</div>
											<div class="col-lg-6">
												<a href="https://www.facebook.com/sharer/sharer.php?u={{ url('/') }}/register/{{$revent->id}}"  class="btn btn-block btn-danger">
													<i class="fa fa-facebook"></i><span class="pull-right">Share to Facebook</span>
												</a>
											</div>
										</div>
										
									</div>
									<div class="card card-footer">
										<div id='gridlatest'></div>
									</div>
                                </div>
                                <div class="col-12 col-sm-7">
									<div class="card card-widget widget-user-2">
										<div class="widget-user-header bg-success">
											<div class="widget-user-image">
											<img class="img-circle elevation-2" src="{{asset('agenda.webp')}}" alt="User Avatar">
											</div>
											<h3 class="widget-user-username">Agenda : {!! $revent->nama !!}</h3>
											<h5 class="widget-user-desc">Tempat, Waktu : {!! $revent->tempat !!}, {!! $revent->mulai !!}</h5>
										</div>
									</div>
									<div class="card card-body">
										<div class="row">
											<div class="col-lg-7">
												<ul class="">
													<li><a href="#">Start : <span class="pull-right badge bg-blue">{!! $revent->mulai !!}</span></a></li>
													<li><a href="#">Until <span class="pull-right badge bg-red">{!! $revent->akhir !!}</span></a></li>
													<li><a href="#">Open Register : <span class="pull-right badge bg-yellow">{!! $revent->daftarmulai !!}</span></a></li>
													<li><a href="#">Close Register : <span class="pull-right badge bg-green">{!! $revent->daftarakhir !!}</span></a></li>
												</ul>
											</div>
											<div class="col-lg-5">
												{!! $qrcode !!}
											</div>
										</div>
										<div class="form-group">
											<iframe src="{!! $linkwebniar !!}" width="100%" height="780" style="border: none;" id="document-preview"></iframe>
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
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="setid" id="setid" value="{{ $revent->id }}">
@endsection
@push('script')
<script>
    function opendatapegawai( jQuery ){
		var set01	= document.getElementById('setid').value;
		var token	= document.getElementById('token').value;
		var source 	= {
			datatype: "json",
			datafields: [
				{ name: 'nama', type: 'text'},
				{ name: 'foto', type: 'text'}
			],
			type: 'POST',
			data: {val01: set01, _token: token},
			url: '{{ route("getListpartisipanok") }}',
		};
		var photorenderer = function (row, column, value) {
            var name = $('#gridlatest').jqxGrid('getrowdata', row).foto;
            if (name == ''){ imgurl = 'dist/img/mrin/logo.png'; }
            else { imgurl = name; }
            var img = '<div style="background: white;"><img style="margin:2px; margin-left: 10px;" width="50" height="50" src="' + imgurl + '"></div>';
            return img;
        }
		var dataAdapter = new $.jqx.dataAdapter(source);
		$("#gridlatest").jqxGrid({
			width: '100%',
			height: 50,
			sortable: true,
			autoheight: true,
			autorowheight: true,
			pageable: true,
			source: dataAdapter,
			altrows: true,
			theme: "energyblue",
			columns: [
                { text: 'Picture', width: '20%', cellsrenderer: photorenderer, editable: false, sortable: false, filterable: false },
                { text: 'Name', datafield: 'nama', width: '80%', cellsalign: 'left', align: 'center' },
                
            ]  
		});
	}
	$(document).ready(function () {
        opendatapegawai();
    });
</script>
@endpush