@extends('layouts.master')

{{-- set title --}}
@section('tittle', 'Dashboard')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    User
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i>Dasbor</a></li>
    <li><a href="active">User</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  @if(session('alert'))
    <div class="alert alert-info alert-dismissible">
      <h4><i class="icon fa fa-check"></i>{{ session('alert') }}</h4>
    </div>
  @endif
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar User</h3>
      <a style="margin-left:15px;margin-top:5px;" href="{{url('manajemenuser/tambah')}}" id="detail" class="btn btn-primary btn-sm mb15 pull-right">Tambah User</a>
    </div>
    <div class="box-body">
      <div class="box-body table-responsive">
        <table class="table table-bordered">
          <tr>
            <th style="width: 10px">No.</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Email</th>
            <th>Level</th>
            <th>Aksi</th>
          </tr>
          <?php $i = 1; ?>
          @foreach($user as $row)
            <tr>
              <td>{{$i++}}.</td>
              <td>{{$row->name}}</td>
              <td>{{$row->username}}</td>
              <td>{{$row->email}}</td>
              <td>{{$row->leveltype->name}}</td>
              <td><a class="btn btn-danger" href="{{url('manajemenuser/hapus/'.$row->id)}}" onclick="return confirm('Anda yakin ingin menghapus user ini?')" >Hapus</a></td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
    </div>
    <!-- /.box-footer-->
  </div>

</section>
<!-- /.content -->

<script type="text/javascript">

</script>
@endsection
