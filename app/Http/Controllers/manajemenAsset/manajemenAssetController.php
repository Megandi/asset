<?php

namespace App\Http\Controllers\manajemenAsset;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ManajemenAsset;
use DB;

class manajemenAssetController extends Controller
{
    public function dashboard()
    {
      $perbaikanAlat = ManajemenAsset::where('status', '2')->where('asset', '1')->count();
      $totalAlat = ManajemenAsset::where('asset', '1')->count();
      $alatRusak = ManajemenAsset::where('status', '0')->where('asset', '1')->count();
      $alatBaik = ManajemenAsset::where('status', '1')->where('asset', '1')->count();
      return view('manajemenasset.dashboard')->with('perbaikanAlat', $perbaikanAlat)
                            ->with('totalAlat', $totalAlat)
                            ->with('alatRusak', $alatRusak)
                            ->with('alatBaik', $alatBaik);
    }

    public function index()
    {
      $asset = ManajemenAsset::where('parent', '0')->where('asset', '0')->get();

      return view('manajemenasset.manajemen.index')->with('asset', $asset);
    }

    public function load($id)
    {
      $peralatan = ManajemenAsset::where('parent', $id)->where('asset', '1')->get();
      return view('manajemenasset.manajemen.tableperalatan')->with('peralatan', $peralatan);
    }

    public function add()
    {
      return view('manajemenasset.manajemen.tambah');
    }

    public function save(Request $req)
    {
      $alert = "Berhasil menambahkan!";

      $kelas = new ManajemenAsset;
      $kelas->nama = $req->nama;
      $kelas->keterangan = $req->keterangan;
      $kelas->status = $req->status;
      $kelas->asset = $req->asset;
      if($req->inputIdDibawah=='Top'){
        $kelas->parent = '0';
      } else {
        $kelas->parent = $req->inputIdDibawah;
      }
      $kelas->save();

      return redirect(url('manajemenasset'))
          ->with('alert', $alert);
    }

    public function hapus($id)
    {
      $alert = "Berhasil menghapus!";

      $alat = ManajemenAsset::where('parent', $id)->delete();
      ManajemenAsset::destroy($id);

      return redirect(url('manajemenasset'))
          ->with('alert', $alert);
    }

    public function jscari()
    {
      $row_set = [];
      $term = strip_tags(trim($_GET['q']));


      $lantai = DB::table('manajemen_asset')->where('nama', 'like', '%'.$term.'%')->where('asset', '0')->get();

      $query = $lantai;

      if(sizeof($query) > 0){
          foreach ($query as $row){
            $parent = ManajemenAsset::find($row->parent);

            $new_row['id']=htmlentities(stripslashes($row->id));
            if($parent){
              $new_row['text']=htmlentities(stripslashes($row->nama . " - ". $parent->nama));
            } else {
              $new_row['text']=htmlentities(stripslashes($row->nama . " - TOP"));
            }
            $row_set[] = $new_row; //build an array
          }

      }

      $new_row['id']="Top";
      $new_row['text']="Top";
      $row_set[] = $new_row;

      return json_encode($row_set); //format the array into json data

    }

    public function edit($id)
    {
      $asset = ManajemenAsset::find($id);
      return view('manajemenasset.manajemen.edit')->with('asset', $asset);
    }

    public function editsave(Request $req)
    {
      $alert = "Berhasil mengubah!";

      $kelas = ManajemenAsset::find($req->id);
      $kelas->nama = $req->nama;
      $kelas->keterangan = $req->keterangan;
      $kelas->status = $req->status;
      $kelas->asset = $req->asset;
      if($req->inputIdDibawah=='Top'){
        $kelas->parent = '0';
      } else {
        $kelas->parent = $req->inputIdDibawah;
      }
      $kelas->save();

      return redirect(url('manajemenasset'))
          ->with('alert', $alert);
    }
}
