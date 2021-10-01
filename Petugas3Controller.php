<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Petugas3;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Petugas3Controller extends Controller
{
    public function show()
    {
       return Petugas3::all();
    }

    public function detail($id)
    {
    if(Petugas3::where('id_petugas3', $id)->exists()) {
    $data = DB::table('petugas3')->where('petugas3.id_petugas3', '=', $id)->get();
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
 'nama_petugas' => 'required',
 'username' => 'required',
 'password' => 'required',
 'level' => 'required'
 ]
 );
 if($validator->fails()) {
 return Response()->json($validator->errors());
 }
 $simpan = Petugas3::create([
 'nama_petugas' => $request->nama_petugas,
 'username' => $request->username,
 'password' => Hash::make($request->password),
 'level' => $request->level
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
    'nama_petugas' => 'required',
    'username' => 'required',
    'password' => 'required'
    ]);
   
    if($validator->fails()) {
    return Response()->json($validator->errors());
    }
   
    $ubah = Petugas3::where('id_petugas3', $id)->update([
    'nama_petugas' => $request->nama_petugas,
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
