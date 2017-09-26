@extends('layouts.master')

{{-- set title --}}
@section('tittle', 'Dashboard')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Dashboard
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{$totalAlat}}</h3>

          <p>Total Asset</p>
        </div>
        <div class="icon">
          <i class="fa fa-home"></i>
        </div>
        <div class="box-footer"></div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>{{$alatRusak}}</h3>

          <p>Asset Rusak</p>
        </div>
        <div class="icon">
          <i class="fa fa-warning"></i>
        </div>
        <div class="box-footer"></div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-blue">
        <div class="inner">
          <h3>{{$alatBaik}}</h3>

          <p>Asset Baik</p>
        </div>
        <div class="icon">
          <i class="fa fa-check"></i>
        </div>
        <div class="box-footer"></div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{$perbaikanAlat}}</h3>

          <p>Asset sedang diperbaiki</p>
        </div>
        <div class="icon">
          <i class="fa fa-sticky-note"></i>
        </div>
        <div class="box-footer"></div>
      </div>
    </div>
    <!-- ./col -->
  </div>

</section>
<!-- /.content -->
@endsection
