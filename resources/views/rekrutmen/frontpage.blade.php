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
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fa fa-cog"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Pendaftar Baru</span>
                            <span class="info-box-number">{{$pendaftar}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fa fa-cog"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Terverfikasi</span>
                            <span class="info-box-number">{{$pelamar}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fa fa-cog"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Diterima</span>
                            <span class="info-box-number">{{$diterima}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fa fa-cog"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Tidak di Terima</span>
                            <span class="info-box-number">{{$ditolak}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Latest User</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <ul class="users-list clearfix">
                                @if(isset($users) && !empty($users))
                                    @foreach($users as $rows)
                                    <li>
                                        @if ($rows['photo'] != '')
                                            <img class="img-size-50" src="{{$rows['photo']}}" alt="User Image">
                                        @else
                                            <img class="img-size-50" src="mascot.png" alt="User Image">
                                        @endif
                                        <a class="users-list-name" href="#">{!! $rows['nama'] !!}</a>
                                        <span class="users-list-date">{{ \Carbon\Carbon::parse($rows['created_at'])->isoFormat('MMM Do YYYY')}}</span>
                                    </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ url('/') }}/usersadmin">View All Users</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-success">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Open Recruitment</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>Jenjang</th>
                                            <th>Program Studi</th>
                                            <th>Fakultas</th>
                                            <th>Formasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($pengumuman) && !empty($pengumuman))
                                        @foreach($pengumuman as $rpengumuman)
                                        <tr>
                                            <td><a href="{{ url('/') }}/masterprodi">{!! $rpengumuman['jenjang'] !!}</a></td>
                                            <td>{!! $rpengumuman['nama'] !!}</td>
                                            <td><span class="badge badge-success">{!! $rpengumuman['namafak'] !!}</span></td>
                                            <td>
                                                <div class="sparkbar" data-color="#00a65a" data-height="20">{!! $rpengumuman['idpejabat'] !!}</div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            <a href="{{ url('/') }}/masterprodi" class="btn btn-sm btn-secondary float-right">View All</a>
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
@endsection
