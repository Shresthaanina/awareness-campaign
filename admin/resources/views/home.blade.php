@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
          {{--<div class="col-sm-6">
            <ol class="float-sm-right">
              <a href="{{ route('sales.create') }}" class="btn btn-primary btn-sm font-weight-bold">Add Sales</a>
              <a href="{{ route('purchases.create') }}" class="btn btn-primary btn-sm font-weight-bold">Add Purchase</a>
            </ol>
          </div>--}}
        </div>
      </div><!-- /.container-fluid -->
    </section>
@endsection
