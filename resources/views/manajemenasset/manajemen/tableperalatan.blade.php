<table class="table">
  <tr>
    <th style="width: 10px">No.</th>
    <th>Asset</th>
    <th>Nama Peralatan</th>
    <th>Opsi</th>
  </tr>
  <?php $i=1; ?>
  @if($peralatan->isEmpty())
    <tr>
      <td colspan="4"><center>Tidak ada daftar peralatan</center></td>
    </tr>
  @else
    @foreach($peralatan as $row)
    <tr>
      <td>{{$i++}}.</td>
      @if($row->parent!='0')
        <?php $assett = App\ManajemenAsset::find($row->parent); ?>
        <td>{{$assett->nama}}</td>
      @else
        <td>Sebagai Header</td>
      @endif
      <td>{{$row->nama}}</td>
      <td>
        <a href="{{url('manajemenasset/edit/'.$row->id)}}" class="btn btn-info">Edit</a>
        <a href="{{url('manajemenasset/hapus/'.$row->id)}}" onclick="return confirm('Are you sure you want to delete this data ?')" class="btn btn-danger">Hapus</a>
      </td>
    </tr>
    @endforeach
  @endif
</table>
