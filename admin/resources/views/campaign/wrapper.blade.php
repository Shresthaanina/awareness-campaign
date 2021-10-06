@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> <i class="fa fa-list fa-fw"></i> Campaigns</h1>
          </div>
          <div class="col-sm-6">
            @include('shared.breadcrumbs')
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
          @endif
          @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
          @endif
          @yield('sub-content')
        </div><!--/. container-fluid -->
      </section>
      <!-- /.content -->
@endsection
