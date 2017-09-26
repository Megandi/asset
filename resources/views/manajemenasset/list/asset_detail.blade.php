@extends('layouts.master')

{{-- set title --}}
@section('tittle', 'Dashboard')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h4>

  </h4>
  <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li><a href="active">Detail Asset</a></li>
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

    <form action="{{url('list/asset/detail/post')}}" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="alatId" value="{{$alat->id}}">
      <input type="hidden" name="parentId" value="{{$alat->parent}}">
      <div class="col-lg-8">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">{{$alat->nama}}</h3>
          </div>
          <div class="box-body">
            <table width="100%">
              <tr>
                <th>Status saat ini</th>
                <th style="padding-top:10px"><input disabled class="form-control" @if($alat->status=='1') value="Baik" @elseif($alat->status=='2') value="Sedang diperbaiki" style="color:#f39c12" @else value="Rusak" style="color:#f56954" @endif></th>
              </tr>
              <tr>
                <th>Status Terbaru</th>
                <th style="padding-top:10px">
                  <select name="status" class="form-control">
                    <?php $cek1 = App\levelAkses::where('id_level', Auth::User()->id_level)->where('id_menu', '6')->get(); ?>
                    @if(sizeof($cek1)==1)
                    @if($cek1[0]->r==1)
                    <option value="2" style="color:yellow">Sedang diperbaiki</option>
                    @endif
                    @endif

                    <?php $cek1 = App\levelAkses::where('id_level', Auth::User()->id_level)->where('id_menu', '5')->get(); ?>
                    @if(sizeof($cek1)==1)
                    @if($cek1[0]->r==1)
                    <option value="1" style="color:blue">Baik</option>
                    @endif
                    @endif

                    <?php $cek1 = App\levelAkses::where('id_level', Auth::User()->id_level)->where('id_menu', '7')->get(); ?>
                    @if(sizeof($cek1)==1)
                    @if($cek1[0]->r==1)
                    <option value="0" style="color:red">Rusak</option>
                    @endif
                    @endif
                  </select>
                </th>
              </tr>
              <tr>
                <th>Keterangan</th>
                <th style="padding-top:10px"><textarea required name="keterangan" class="form-control" rows="3">{{$alat->keterangan}}</textarea></th>
              </tr>
            </table>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a href="{{url('list/asset/'.$alat->parent)}}" class="btn btn-primary">Kembali</a>
            <button class="btn btn-info pull-right">Simpan</button>
          </div>
          <!-- /.box-footer-->
        </div>
      </div>
    </form>
  </div>
</section>
<!-- /.content -->

@endsection
