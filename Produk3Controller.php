<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk3;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Produk3Controller extends Controller
{
    public function show()
    {
       return Produk3::all();
    }

    public function detail($id)
    {
    if(Produk3::where('id_produk3', $id)->exists()) {
    $data = DB::table('produk3')->where('produk3.id_produk3', '=', $id)->get();
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
 'nama_produk' => 'required',
 'deskripsi' => 'required',
 'harga' => 'required',
 'foto_product' => 'required'
 ]
 );
 if($validator->fails()) {
 return Response()->json($validator->errors());
 }
 $simpan = Produk3::create([
 'nama_produk' => $request->nama_produk,
 'deskripsi' => $request->deskripsi,
 'harga' => $request->harga,
 'foto_product' => $request->foto_product
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
    'nama_produk' => 'required',
    'deskripsi' => 'required',
    'harga' => 'required',
    'foto_product' => 'required'
    ]);
   
    if($validator->fails()) {
    return Response()->json($validator->errors());
    }
   
    $ubah = Produk3::where('id_produk3', $id)->update([
    'nama_produk' => $request->nama_produk,
    'deskripsi' => $request->deskripsi,
    'harga' => $request->harga,
    'foto_product' => $request->foto_product
    ]);
    if($ubah) {
    return Response()->json(['status' => 1]);
    }
    else {
    return Response()->json(['status' => 0]);
    }
   }
}

