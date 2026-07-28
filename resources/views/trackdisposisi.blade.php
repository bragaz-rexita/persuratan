<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<title>
            @if (isset($namaapps01))
                {{ $namaapps01 }}
            @elseif (Session('namaapps01') !== null)
                {{ Session('namaapps01') }}
            @else
                {{ config('global.Title') }}
            @endif
        </title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<meta content="
            @if (isset($domainapps01))
                {{ $domainapps01 }}
            @elseif (Session('domainapps01') !== null)
                {{ Session('domainapps01') }}
            @else{{ 
                config('global.sekolah') }}
            @endif" name="description" />
        <meta content="
			@if (isset($subdomainapps01))
				{{ $subdomainapps01 }}
			@elseif (Session('subdomainapps01') !== null)
				{{ Session('subdomainapps01') }}
			@else
				{{ config('global.kota') }}
			@endif" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
		<link rel="icon" href="
            @if (isset($logo01))
            {{ asset($logo01) }}
            @elseif (Session('logo01') !== null)
            {{ Session('logo01') }}
            @else
            {{ asset('duidev-softwarehouse.png') }}
            @endif">
        <link rel="apple-touch-icon" href="
            @if (isset($logo01))
            {{ asset($logo01) }}
            @elseif (Session('logo01') !== null)
            {{ Session('logo01') }}
            @else
            {{ asset('duidev-softwarehouse.png') }}
            @endif">
			<!-- App css -->
        @include('base.partials.css')
    </head>
	<body class="hold-transition skin-purple layout-top-nav" style="background-image: url('{{asset('dist/img/bgub.jpg')}}'); background-repeat: no-repeat; background-position: center;">
		<div class="wrapper" >
			<div class="content-wrapper">
				<section class="content" >
					<div class="row">
						<div class="col-md-12">
							<div class="box box-widget widget-user">
								<div class="widget-user-header bg-black" style="background: url('{{asset('dist/img/bgub3.jpg')}}') center center;">
									<h3 class="widget-user-username">Sistem Monitoring Progres Pemrosesan Surat</h3>
									<a href="/">
										<h5 class="widget-user-desc">
											@if (isset($namaapps01))
												{{ $namaapps01 }}
											@elseif (Session('namaapps01') !== null)
												{{ Session('namaapps01') }}
											@else
												{{ config('global.Title') }}
											@endif
										</h5>
									</a>
								</div>
								<div class="widget-user-image">
									<img class="img-circle" src="{{asset('duidev-softwarehouse.png')}}" alt="Duidev Software House Malang Jawa Timur Indonesia">
								</div>
								<div class="box-footer">
									<div class="row invoice-info">
										<div class="col-sm-3 invoice-col">
										  <strong>Surat Dari</strong>
										  <address>
											<p><strong>
											@if(isset($datadiri->asalsurat))
												{!! $datadiri->asalsurat !!}
											@elseif (isset($datadiri->inputor))
												{!! $datadiri->inputor !!}
											@elseif (isset($datadiri->pembuat))
												{!! $datadiri->pembuat !!}
											@elseif (isset($datadiri->konseptor))
												{!! $datadiri->konseptor !!}
											@else
												-
											@endif
											</strong></p>
										  </address>
										</div>
										<div class="col-sm-6 invoice-col">
										 	<address>
											@if(isset($datadiri->perihal))
												Perihal
												{!! $datadiri->perihal !!}
												<p><strong>Kepada : {!! $datadiri->kepada !!}</strong></p>
											@elseif (isset($datadiri->jenissk))
												Jenis SK
												{!! $datadiri->jenissk !!}
												<p><strong>Tentang : {!! $datadiri->judulsk !!}</strong></p>
											@elseif (isset($datadiri->jenissrt))
												Jenis Surat
												{!! $datadiri->jenissrt !!}
												<p><strong>Perihal : {!! $datadiri->perihal !!}</strong></p>
											@elseif (isset($datadiri->konseptor))
												Jenis Surat
												{!! $datadiri->jenissrt !!}
												<p><strong>Kepada : {!! $datadiri->kepada !!}</strong></p>
											@else
												-
											@endif
											</address>
										</div>
										<div class="col-sm-3 invoice-col">
										  <strong>Catatan</strong>
										  <address>
											<p><strong>
											@if(isset($datadiri->footnote))
												{!! $datadiri->footnote !!}
											@elseif (isset($datadiri->arsip))
												{!! $datadiri->arsip !!}
											@elseif (isset($datadiri->catatan))
												{!! $datadiri->catatan !!}
											@else
												-
											@endif
											</strong></p>
										  </address>
										</div>
										
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<ul class="timeline">
								@if(isset($pengumumans) && !empty($pengumumans))
									@foreach($pengumumans as $pengumuman)
									<li class="time-label">
										<span class="bg-{{ $pengumuman['urutanwerno'] }}">
											{!! $pengumuman['tanggal'] !!}
										</span>
									</li>
									<li>
									  <div class="timeline-item">
										<span class="time"><i class="fa fa-clock-o"></i> {{ $pengumuman['kapan'] }}</span>
										<h3 class="timeline-header"><font color="{{ $pengumuman['urutanwerno'] }}">{!! $pengumuman['siapa'] !!}</font></h3>
										<div class="timeline-body">
											{!! $pengumuman['pengumuman'] !!}
										</div>
									  </div>
									</li>
									@endforeach
								@endif
							</ul>
						</div>
					</div>
				</section>
			</div>
			<footer class="main-footer">
				<div class="pull-right hidden-xs">
					<b>
						@if (isset($namaapps01))
						{{ $namaapps01 }}
						@elseif (Session('namaapps01') !== null)
						{{ Session('namaapps01') }}
						@else
						config('global.Title')
						@endif
					</b>
				</div>
				<strong>Copyright &copy; 2022 <a href="https://duidev.com">DuiDev Software House</a></strong> All rights reserved.
			</footer>
		</div>
		<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
		@include('base.partials.js')
	</body>
</html>
