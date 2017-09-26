<?php

namespace App\Http\Controllers\manajemenAsset;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gedung;
use App\Kelas;
use Illuminate\Support\Facades\DB;
use App\Alat;
use App\ManajemenAsset;

class ListController extends Controller
{

  public function index()
  {
    $asset = ManajemenAsset::where('parent', '0')->where('asset', '0')->get();

    $cekstatus = 'aman';

    return view('manajemenasset.list.index')->with('asset', $asset)
    ->with('cekstatus', $cekstatus);
  }

  public function detail($id)
  {
    //$asset = ManajemenAsset::find($idKelas);
    $asset = ManajemenAsset::where('parent', $id)->where('asset', '1')->get();
    return view('manajemenasset.list.list_asset')->with('assets', $asset)
                            ->with('parent', $id);
  }

  public function search(Request $request, $idKelas)
  {
    $nama = $request->nama;
    $status = $request->status;
    $ket = $request->keterangan;

    // validate empty
    if($nama == "" && $status == "" && $ket == ""){
        return redirect(url('list/asset/'.$idKelas));
    }
    else
    {
      if($status=='3' || $status==''){
        $status_sc = "";
      } else {
        $status_sc			= " AND status='".$status."'";
      }
      $nama_sc 		= $nama != "" ? " AND nama LIKE '%".$nama."%'" : "";
      $ket_sc 		= $ket != "" ? " AND keterangan LIKE '%".$ket."%'" : "";

      $alat = DB::select("SELECT * FROM manajemen_asset
                  WHERE parent = '".$idKelas."' AND asset ='1'
                  $status_sc $nama_sc $ket_sc ");

      $arraydata = [$nama,$status,$ket];


      $kelas = Kelas::find($idKelas);
      return view('manajemenasset.list.list_asset')->with('assets', $alat)
                              ->with('parent', $idKelas)
                              ->with('arraydata', $arraydata);
    }
  }

  public function detailAsset($id)
  {
    $alat = ManajemenAsset::find($id);
    return view('manajemenasset.list.asset_detail')->with('alat', $alat);
  }

  public function update(Request $req)
  {
    $alert = "Berhasil mengubah status!";
      $alat = ManajemenAsset::find($req->alatId);
      $alat->status = $req->status;
      $alat->keterangan = $req->keterangan;
      $alat->save();

      return redirect(url('list/asset/'.$req->parentId))
          ->with('alert', $alert);
  }
}
