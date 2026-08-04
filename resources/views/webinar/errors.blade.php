@extends('adminlte3.layoutstandart')
@section('content')
<div class="content-wrapper" >
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{$judul}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><a href="{{ url('/') }}">Home</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="error-page">
            <h2 class="headline text-danger">T_T</h2>
            <div class="error-content">
                <h3><i class="fa fa-exclamation-triangle text-danger"></i>{{$judul}}</h3>
				<p>
					{!!$errore!!}<br />
				</p>
                <p>
                We could not find the page you were looking for. <br /><a href="{{url()->current()}}">{{url()->current()}}</a><br />
                Meanwhile, you may <a href="{{ url('/') }}">return to dashboard</a> or try using the search form.
                </p>
            </div>
        </div>
    </section>
</div>
@endsection
