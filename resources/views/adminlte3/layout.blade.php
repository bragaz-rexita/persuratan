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
		<meta content="
            @if (isset($domainapps01))
                {{ $domainapps01 }}
            @elseif (Session('domainapps01') !== null)
                {{ Session('domainapps01') }}
            @else
            {{ config('global.sekolah') }}
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
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2, user-scalable=yes">
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
        @include('adminlte3.css')
    </head>
    <body class="hold-transition sidebar-collapse layout-top-nav">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand-md navbar-light navbar-blue">
                <div class="container">
                <a href="/e-office/dashboardagendaris" class="navbar-brand">
                    <img src="
                            @if (isset($logo01))
                            {{ asset($logo01) }}
                            @elseif (Session('logo01') !== null)
                            {{ Session('logo01') }}
                            @else
                            {{ asset('duidev-softwarehouse.png') }}
                            @endif" alt="Duidev Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">
                    @if (isset($namaapps01))
                        {{ $namaapps01 }}
                    @elseif (Session('namaapps01') !== null)
                        {{ Session('namaapps01') }}
                    @else
                        {{ config('global.swandhananama') }}
                    @endif
                    </span>
                </a>
                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
                        </li>
                        @php
                            $servername = $_SERVER['SERVER_NAME'];
                            if ($servername == 'https://siapdok.duidev.com' OR $servername == 'http://siapdok.duidev.com' OR $servername == 'siapdok.duidev.com'){
                        @endphp
                            @include('adminlte3.sco-topmenu')
                        @php
                            } else {
                        @endphp
                            @include('adminlte3.topmenu')
                        @php
                            }
                        @endphp
                        
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#"><i class="fa fa-bell"></i>
                                <span class="badge badge-warning navbar-badge counttotalnotif">0</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header texttotalnotif">0 Notifications</span>
                            <div id="textnotif">
                            
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fa fa-arrows-alt"></i>
                            </a>
                        </li>
                        @if (Session('previlage') !== null)
                            <li class="nav-item dropdown user-menu">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                @if (isset($foto))
                                    <img src="{!!$foto!!}" class="user-image img-circle elevation-2" alt="User Image">
                                @elseif (Session('avatar') != '' AND Session('avatar') !== null)
                                    <img src="{!! Session('avatar') !!}" class="user-image img-circle elevation-2" alt="User Image">
                                @else 
                                    <img src="{{ asset('mascot.png') }}" class="user-image img-circle elevation-2" alt="User Image">
                                @endif
                                <span class="d-none d-md-inline">{!! Session('nama') !!}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <li class="user-header bg-primary">
                                    @if (isset($foto))
                                        <img src="{!!$foto!!}" class="img-circle elevation-2" alt="User Image">
                                    @elseif (Session('avatar') != '' AND Session('avatar') !== null)
                                        <img src="{!! Session('avatar') !!}" class="img-circle elevation-2" alt="User Image">
                                    @else 
                                        <img src="{{ asset('mascot.png') }}" class="img-circle elevation-2" alt="User Image">
                                    @endif
                                    <p>
                                    {!! Session('nama') !!}
                                    <small>{!! Session('previlage') !!} - {!! Session('fakultas') !!}</small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <a href="{{ url('profiluser') }}" class="btn btn-default btn-flat">Profile</a>
                                    @if (Session('sekolah_id_sekolah') !== null)
                                    <a href="{{ route('signout') }}" class="btn btn-default btn-flat float-right">Sign out</a>
                                    @else
                                    <a href="{{ route('logoutlt3') }}" class="btn btn-default btn-flat float-right">Sign out</a>
                                    @endif
                                </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item dropdown user-menu">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    <img src="{{ asset('mascot.png') }}" class="user-image img-circle elevation-2" alt="User Image">
                                    <span class="d-none d-md-inline">Welcome</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <li class="user-header bg-primary">
                                    <img src="{{ asset('mascot.png') }}" class="img-circle elevation-2" alt="User Image">
                                    <p>
                                    @if (isset($domainapps01))
                                        {{ $domainapps01 }}
                                    @elseif (Session('domainapps01') !== null)
                                        {{ Session('domainapps01') }}
                                    @else
                                        {{ config('global.swandhananama') }}
                                    @endif
                                    <small>
                                    @if (isset($subdomainapps01))
                                        {{ $subdomainapps01 }}
                                    @elseif (Session('subdomainapps01') !== null)
                                        {{ Session('subdomainapps01') }}
                                    @else
                                        {{ config('global.swandhanauniv') }}
                                    @endif
                                    </small>
                                    </p>
                                </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </nav>
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="/" class="brand-link">
                    <img src="@if (isset($logo01))
                            {{ asset($logo01) }}
                            @elseif (Session('logo01') !== null)
                            {{ Session('logo01') }}
                            @else
                            {{ asset('duidev-softwarehouse.png') }}
                            @endif" alt="Duidev Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">
                        @if (isset($namaapps01))
                        {{ $namaapps01 }}
                        @elseif (Session('namaapps01') !== null)
                        {{ Session('namaapps01') }}
                        @else
                        {{ config('global.Title') }}
                        @endif
                    </span>
                </a>
                <div class="sidebar">
                    @if(Session('previlage') !== null)
                        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                            <div class="image">
                                @if (isset($foto))
                                    <img src="{!!$foto!!}" class="img-circle elevation-2" alt="User Image">
                                @elseif (Session('avatar') != '')
                                    <img src="{!! Session('avatar') !!}" class="img-circle elevation-2" alt="User Image">
                                @else 
                                    <img src="{{ asset('mascot.png') }}" class="img-circle elevation-2" alt="User Image">
                                @endif
                            </div>
                            <div class="info">
                            <a href="{{ url('profiluser') }}" class="d-block">{!! Session('nama') !!}</a>
                            </div>
                        </div>
                    @else
                        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                            <div class="image">
                                <img src="{{ asset('mascot.png') }}" class="img-circle elevation-2" alt="User Image">
                            </div>
                            <div class="info">
                                <a href="#" class="d-block">
                                    @if (isset($domainapps01))
                                    {{ $domainapps01 }}
                                    @elseif (Session('domainapps01') !== null)
                                    {{ Session('domainapps01') }}
                                    @else
                                    {{ config('global.swandhanauniv') }}
                                    @endif
                                </a>
                            </div>
                        </div>
                    @endif
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        @php
                            $servername = $_SERVER['SERVER_NAME'];
                            if ($servername == 'https://siapdok.duidev.com' OR $servername == 'http://siapdok.duidev.com' OR $servername == 'siapdok.duidev.com'){
                        @endphp
                            @include('adminlte3.sco-sidebar')
                        @php
                            } else {
                        @endphp
                            @include('adminlte3.sidebar')
                        @php
                            }
                        @endphp
                        </ul>
                    </nav>
                </div>
            </aside>
            @yield('content')
            
        </div>
        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
                <b>
                    @if (isset($namaapps01))
                    {{ $namaapps01 }}
                    @elseif (Session('namaapps01') !== null)
                    {{ Session('namaapps01') }}
                    @else
                    {{ config('global.Title') }}
                    @endif
                </b>
            </div>
            <strong>Copyright &copy; 2022 <a href="
                @if (isset($lamanapps01))
                {{ $lamanapps01 }}
                @elseif (Session('lamanapps01') !== null)
                {{ Session('lamanapps01') }}
                @else
                {{ config('global.swandhanaurl') }}
                @endif">
                @if (isset($lamanapps01))
                {{ $lamanapps01 }}
                @elseif (Session('lamanapps01') !== null)
                {{ Session('lamanapps01') }}
                @else
                {{ config('global.swandhanaurl') }}
                @endif
            </a>.</strong> All rights reserved.
        </footer>
	    @include('adminlte3.js')
        @stack('script')
        <script type="text/javascript">
            function getnotifcount( jQuery ){
                $.post('{{ route("cekNotifikasi") }}', { _token: '{{ csrf_token() }}'},
                function(data){
                    $(".qrname").html(data.markingname);
                    $('.qrimage').attr('src', data.qrcode);
                    $("#textnotif").html(data.textnotif);
                    $(".counttotalnotif").html(data.counttotalnotif);
                    $(".texttotalnotif").html(data.counttotalnotif+' Notifications');
                    $(".countmailbox").html(data.countmailbox);
                    $(".countmohonttd").html(data.countmohonttd);
                    $(".countsuratmasuk").html(data.countsuratmasuk);
                    $(".countmemo").html(data.countmemo);
                    $(".countnotadinas").html(data.countnotadinas);
                    $(".countsuratkeluar").html(data.countsuratkeluar);
                    $(".countsk").html(data.countsk);
                    $(".countevent").html(data.countevent);
                    $(".notifcutitahunan").html(data.notifcutitahunan);
                    $(".notifcutiagama").html(data.notifcutiagama);
                    $(".notifijinplgcepat").html(data.notifijinplgcepat);
                    $(".notifijinkeluarkantor").html(data.notifijinkeluarkantor);
                    $(".notifpermintaanpegawai").html(data.notifpermintaanpegawai);
                    $(".notifmutasirotasi").html(data.notifmutasirotasi);
                    $(".notifkomunikasi").html(data.notifkomunikasi);
                    $(".notifpengangkatanjabatan").html(data.notifpengangkatanjabatan);
                    $(".notifpemberhentianjabatan").html(data.notifpemberhentianjabatan);
                    $(".notifpegawaitetap").html(data.notifpegawaitetap);
                    $(".notifdoktertetap").html(data.notifdoktertetap);
                    $(".notifpenerimaanstaf").html(data.notifpenerimaanstaf);
                    $(".notifpenonaktifanstaf").html(data.notifpenonaktifanstaf);
                    $(".notifpengaktifanstaf").html(data.notifpengaktifanstaf);
                    $(".notifmutasi").html(data.notifmutasi);
                    $(".notifpenonaktifandokter").html(data.notifpenonaktifandokter);
                    $(".notiforientasikerja").html(data.notiforientasikerja);
                    $(".notifpkwt").html(data.notifpkwt);
                    $(".notifpkwtt").html(data.notifpkwtt);
                    $(".notifspo").html(data.notifspo);
                    $(".notifedaran").html(data.notifedaran);
                    $(".notifperingatan").html(data.notifperingatan);
                    $(".notifbalasanpenambahanstaf").html(data.notifbalasanpenambahanstaf);
                    $(".notifpermohonan").html(data.notifpermohonan);
                    $(".notiftugas").html(data.notiftugas);
                    $(".notifpemberitahuan").html(data.notifpemberitahuan);
                    $(".notiftanggapanresign").html(data.notiftanggapanresign);
                    $(".notifreferensikerja").html(data.notifreferensikerja);
                    $(".notifketeranganaktif").html(data.notifketeranganaktif);
                    $(".notifpemutusanhubungan").html(data.notifpemutusanhubungan);
                    $(".notifpemanggilancalonkaryawan").html(data.notifpemanggilancalonkaryawan);
                    $(".notiflolosseleksi").html(data.notiflolosseleksi);
                    $(".notifpemberitahuanmcu").html(data.notifpemberitahuanmcu);
                    $(".notifundangan").html(data.notifundangan);
                    $(".notifpemanggilankie").html(data.notifundangan);
                    $(".notifketerangantidakbekerja").html(data.notifketerangantidakbekerja);
                    $(".notifformrs01").html(data.notifformrs01);
                    $(".notifformrs02").html(data.notifformrs02);
                    $(".notifformrs03").html(data.notifformrs03);
                    $(".notifformrs04").html(data.notifformrs04);
                    $(".notifformrs05").html(data.notifformrs05);
                    $(".notifformrs06").html(data.notifformrs06);
                    $(".notifformrs07").html(data.notifformrs07);
                    $(".notifformrs08").html(data.notifformrs08);
                    $(".notifformrs09").html(data.notifformrs09);
                    $(".notifformrs10").html(data.notifformrs10);
                    $(".notifformrs11").html(data.notifformrs11);
                    $(".notifformrs12").html(data.notifformrs12);
                    $(".notifformrs13").html(data.notifformrs13);
                    $(".notifformrs14").html(data.notifformrs14);
                    $(".notifformrs15").html(data.notifformrs15);
                    $(".notifformrs16").html(data.notifformrs16);
                    $(".notifformrs17").html(data.notifformrs17);
                    $(".notifformrs18").html(data.notifformrs18);
                    $(".notifformrs19").html(data.notifformrs19);
                });
            }
        </script>
    </body>
</html>