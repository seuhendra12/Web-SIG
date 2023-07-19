<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\JenisSampah;
use App\Models\RT;
use App\Models\RW;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
  public function index()
  {
    return view('frontend.index',[
      'jenis_sampah' => JenisSampah::get(),
      'transaksi_sampah' =>Transaksi::get(),
    ]);
  }
  public function profile()
  {

    return view('frontend.profile', [
      'rts' => RT::get(),
      'rws' => RW::get(),
    ]);
  }

  public function simpan_profile(Request $request, $id){
    $user = User::find($id);

    $validator = Validator::make($request->all(), [
      'nik' => "required|size:16|unique:profiles,nik,$id",
      'name' => 'required',
      'tempat_lahir' => 'required',
      'tanggal_lahir' => 'required',
      'jenis_kelamin' => 'required',
      'email' => "required|email|unique:users,email,$user->id",
      'no_telepon' => 'required',
      'alamat' => 'required',
      'rt' => 'required',
      'rw' => 'required',
    ]);

    if ($validator->fails()) {
      return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    }

    $user->update([
      'name' => $request->input('name'),
    ]);

    $profile = $user->profile;
    $profile->update([
      'nik' => $request->input('nik'),
      'tempat_lahir' => $request->input('tempat_lahir'),
      'tanggal_lahir' => $request->input('tanggal_lahir'),
      'jenis_kelamin' => $request->input('jenis_kelamin'),
      'no_telepon' => $request->input('no_telepon'),
      'alamat' => $request->input('alamat'),
      'rt_id' => $request->input('rt'),
      'rw_id' => $request->input('rw'),
    ]);

    // Set flash message berhasil
    Session::flash('success', 'Profile berhasil disimpan');

    return redirect('/');
  }
}
