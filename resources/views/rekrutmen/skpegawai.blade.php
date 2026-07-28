@extends('adminlte3.layoutstandart')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>SK Pegawai</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active">SK Pegawai</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="row">
    <div class="embed-responsive embed-responsive-16by9" style="height:100vh">
        <iframe class="embed-responsive-item" src="{{$url}}"></iframe>
    </div>
    </div>
  </section>
</div>
@endsection