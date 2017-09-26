@extends('layouts.master')

{{-- set title --}}
@section('tittle', 'Dashboard')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    List
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i>Dasbor</a></li>
    <li><a href="active">List</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar Asset</h3>
    </div>
    <a style="margin-left:15px;margin-top:5px;" href="#" id="detail" class="btn btn-primary btn-sm mb15">Detail Peralatan</a>
    <div class="box-body">
      <div id="jstree1">
        @foreach($asset as $row)
                <?php
                  $cekstatus = 'aman';
                  $rowssatu = App\ManajemenAsset::where('parent', $row->id)->get();
                  foreach ($rowssatu as $rowsatu) {
                    if($rowsatu->status=='0'){
                      $cekstatus = 'tidakaman';
                    }
                    $rowsdua = App\ManajemenAsset::where('parent', $rowsatu->id)->get();
                    foreach ($rowsdua as $rowdua) {
                      if($rowdua->status=='0'){
                        $cekstatus = 'tidakaman';
                      }
                      $rowstiga = App\ManajemenAsset::where('parent', $rowdua->id)->get();
                      foreach ($rowstiga as $rowtiga) {
                        if($rowtiga->status=='0'){
                          $cekstatus = 'tidakaman';
                        }
                      }

                    }

                  }
                ?>
        <ul>
					<li onclick="detail({{$row->id}})" id="{!! $row->id !!}"> <font @if($cekstatus=='tidakaman') style="color:red" @endif>{{$row->nama}}</font>
            <?php $rows2 = App\ManajemenAsset::where('parent', $row->id)->where('asset', '0')->get();?>
            @foreach($rows2 as $row2)
              <?php
                $cekstatus2 = 'aman';
                  $rowsdua2 = App\ManajemenAsset::where('parent', $row2->id)->get();
                  foreach ($rowsdua2 as $rowdua2) {
                    if($rowdua2->status=='0'){
                      $cekstatus2 = 'tidakaman';
                    }
                    $rowstiga3 = App\ManajemenAsset::where('parent', $rowdua2->id)->get();
                    foreach ($rowstiga3 as $rowtiga3) {
                      if($rowtiga3->status=='0'){
                        $cekstatus2 = 'tidakaman';
                      }
                    }

                  }
              ?>
            <ul>
              <li onclick="detail({{$row2->id}})" id="{!! $row2->id !!}" data-jstree='{"icon" : "glyphicon glyphicon-equalizer"}'> <font @if($cekstatus2=='tidakaman') style="color:red" @endif>{{$row2->nama}}</font>
                <?php $rows3 = App\ManajemenAsset::where('parent', $row2->id)->where('asset', '0')->get();?>
                @foreach($rows3 as $row3)
                  <?php
                    $cekstatus3 = 'aman';
                        $rowstiga3 = App\ManajemenAsset::where('parent', $row3->id)->get();
                        foreach ($rowstiga3 as $rowtiga3) {
                          if($rowtiga3->status=='0'){
                            $cekstatus3 = 'tidakaman';
                          }
                        }
                  ?>
                <ul>
                  <li onclick="detail({{$row3->id}})" data-jstree='{"icon" : "glyphicon glyphicon-home"}' id="{{$row3->id}}"><font @if($cekstatus3=='tidakaman') style="color:red" @endif>{{$row3->nama}}</font></li>
                </ul>
                @endforeach
              </li>
            </ul>
            @endforeach
          </li>
        </ul>
        @endforeach
      </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
    </div>
    <!-- /.box-footer-->
  </div>

</section>
<!-- /.content -->

<!-- <div class="modal modal-info fade" id="modal-info">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Status</h4>
      </div>
      <div class="modal-body">
        <p>Apakah anda ingin melihat atau mengubah status pada lantai ini?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tidak</button>
        <a href="#" id="link" class="btn btn-outline">Ya</a>
      </div>
    </div>
    <!-- /.modal-content
  </div>
  <!-- /.modal-dialog
</div> -->

<script type="text/javascript">
  $(function() {
    $('#jstree1').jstree();
  });



	$('#jstree1').on("changed.jstree", function (e, data) {
	  var id = data.selected;
	  $("#detail").attr('href','{!! url('list/asset') !!}/' + id);

	});

  // function detail(id) {
	// 	$("#link").attr('href','{!! url('rlist/asset') !!}/' + id);
  //   $('#modal-info').modal();
  // }
</script>
@endsection
