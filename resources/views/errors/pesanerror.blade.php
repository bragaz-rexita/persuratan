@extends('adminlte3.layoutujian')
@section('content')
<div class="content-wrapper" >
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{!! $judulpesan !!}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><a href="{{ url('/') }}">Home</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="error-page">
        <h2 class="headline text-danger"><i class="fa fa-warning"></i></h2>
        <div class="error-content">
            <h3><strong>{!! $kalimatheader !!}</strong></h3>
            <p></p>
            {!! $kalimatbody !!}
        </div>
        </div>
    </section>
</div>
@endsection
