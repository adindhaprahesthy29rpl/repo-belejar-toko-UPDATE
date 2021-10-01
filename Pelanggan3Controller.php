<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pelanggan3;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Pelanggan3Controller extends Controller
{
    public function show()
    {
       return Pelanggan3::all();
    }

    public function detail($id)
    {
    if(Pelanggan3::where('id_pelanggan3', $id)->exists()) {
    $data = DB::table('pelanggan3')->where('pelanggan3.id_pelanggan3', '=', $id)->get();
    return Response()->json($data);
   }
else {
    return Response()->json(['message' => 'Tidak ditemukan' ]);
}
}

    public function store(Request $request)
 {
 $validator=Validator::make($request->all(),
 [
 'nama' => 'required',
 'alamat' => 'required',
 'telp' => 'required',
 'username' => 'required',
 'password' => 'required'
 ]
 );

 if($validator->fails()) {
 return Response()->json($validator->errors());
 }

 $simpan = Pelanggan3::create([
 'nama' => $request->nama,
 'alamat' => $request->alamat,
 'telp' => $request->telp,
 'username' => $request->username,
 'password' => Hash::make($request->password)
 ]);

 if($simpan) {
 return Response()->json(['status'=>1]);
 }
 else {
 return Response()->json(['status'=>0]);
 }
 }

    public function update($id, Request $request)  {
    $validator=Validator::make($request->all(),
    [
    'nama' => 'required',
    'alamat' => 'required',
    'telp' => 'required',
    'username' => 'required',
    'password' => 'required'
    ]);
   
    if($validator->fails()) {
    return Response()->json($validator->errors());
    }
   
    $ubah = Pelanggan3::where('id_pelanggan3', $id)->update([
    'nama' => $request->nama,
    'alamat' => $request->alamat,
    'telp' => $request->telp,
    'username' => $request->username,
    'password' => $request->password
    ]);
    if($ubah) {
    return Response()->json(['status' => 1]);
    }
    else {
    return Response()->json(['status' => 0]);
    }
   }
}
