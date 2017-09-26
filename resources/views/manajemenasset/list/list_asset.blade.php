@extends('layouts.master')

{{-- set title --}}
@section('tittle', 'Assets')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Detail Peralatan
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i>Dasbor</a></li>
    <li><a href="{{url('list')}}"><i class="fa fa-list"></i>List</a></li>
    <li><a href="active">Detail Peralatan</a></li>
  </ol>
</section>



<!-- Main content -->
<section class="content">
  @if(session('alert'))
    <div class="alert alert-info alert-dismissible">
      <h4><i class="icon fa fa-check"></i>{{ session('alert') }}</h4>
    </div>
  @endif
  <div class="row">
    <div class="col-xs-12">
      {{-- search --}}
      <!-- Search FIX -->
      <form class="form" action="{{ url('/list/asset/'.$parent.'/search') }}" method="post">
        {{csrf_field()}}
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Pencarian</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Nama</label>
                  <input type="text" name="nama" class="form-control"  @if(isset($arraydata[0])) value="{{$arraydata[0]}}" @endif>
                </div>
                <div class="form-group">
                  <label class="control-label">Status</label>
                  <select name="status" class="form-control">
                    <option value="3"  @if(isset($arraydata[1])) @if($arraydata[1]=='3') selected @endif @endif>All</option>
                    <option value="0" @if(isset($arraydata[1])) @if($arraydata[1]=='0') selected @endif @endif>Rusak</option>
                    <option value="1" @if(isset($arraydata[1])) @if($arraydata[1]=='1') selected @endif @endif>Baik</option>
                    <option value="2" @if(isset($arraydata[1])) @if($arraydata[1]=='2') selected @endif @endif>Sedang diperbaiki</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Keterangan</label>
                  <textarea name="keterangan" rows="3" class="form-control" style="margin-bottom:10px;"> @if(isset($arraydata[2])) {{$arraydata[2]}} @endif</textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <div class="pull-right">
              <a style="width : 90px;" href="{{url('list/asset/'.$parent)}}" type="button" onclick="return confirm('Are you sure want to reset?')" class="btn btn-warning">Reset</a>
              <button style="width : 90px;" type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
      </form>

      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">List Assets</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table class="table table-bordered">
            <tr>
              <th style="width: 10px">No.</th>
              <th>Nama Peralatan</th>
              <th>Asset</th>
              <th>Status</th>
              <th>Keterangan</th>
              <th>Aksi</th>
            </tr>
            <?php $i = 1; ?>
            @foreach($assets as $row)
              <tr>
                <td>{{$i++}}.</td>
                <td>{{$row->nama}}</td>
                <?php $parentt = App\ManajemenAsset::find($row->parent); ?>
                <td>{{$parentt->nama}}</td>
                @if($row->status == '1')
                  <td style="background-color:#3498db;color:white">Baik</td>
                @elseif($row->status == '2')
                  <td style="background-color:#f39c12;color:white">Sedang diperbaiki</td>
                @else
                  <td style="background-color:#f56954;color:white">Rusak</td>
                @endif
                <td>{{$row->keterangan}}</td>
                <td><a class="btn btn-info" href="{{ url('list/asset/detail/'.$row->id) }}">Ubah Status</a></td>
              </tr>
            @endforeach
          </table>
        </div>
        <!-- /.box-body
        <div class="box-footer clearfix">
          <ul class="pagination pagination-sm no-margin pull-right">
            <li><a href="#">&laquo;</a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">&raquo;</a></li>
          </ul>
        </div>-->
      </div>
    </div>
  </div>
</section>
<!-- /.content -->

@endsection
