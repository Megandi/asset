<?php

namespace App\Http\Controllers\manajemenUser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\levelType;

class manajemenUserController extends Controller
{
    public function index()
    {
      $user = User::all();
      return view('manajemenuser.index')->with('user', $user);
    }

    public function add()
    {
      $leveltype = leveltype::all();
      return view('manajemenuser.tambah')->with('leveltype', $leveltype);
    }

    public function save(Request $req)
    {
      $alert = "Berhasil menghapus!";
      $user = new User;
      $user->name = $req->nama;
      $user->username = $req->username;
      $user->email = $req->emailinput;
      $user->password = bcrypt($req->passwordinput);
      $user->status = '1';
      $user->id_level = $req->level;
      $user->save();
      return redirect(url('manajemenuser'))
          ->with('alert', $alert);
    }

    public function delete($id)
    {
      User::destroy($id);
      $alert = "Berhasil menghapus!";

      return redirect(url('manajemenuser'))
          ->with('alert', $alert);

    }
}
