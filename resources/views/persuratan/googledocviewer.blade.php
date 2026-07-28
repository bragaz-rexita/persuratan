@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Setting Pejabat</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
				<div class="col-md-12">
                <iframe src="http://docs.google.com/gview?url={!!$url!!}&embedded=true" style="width:600px; height:500px;" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </section>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection